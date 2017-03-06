#!/usr/local/bin/php
<?php

/*
商品のマスタ確認
*/

ini_set("error_reporting", E_ALL);

$src_file = '/data/sites/adm/ethna/tmp/tpoint_detail/IM001630';

include("tpoint.common.php");

// Internal Encoding
$internal_encoding  = "utf-8";

// ファイルのエンコード
$file_encoding = "Shift-Jis";

if (!file_exists($src_file)) {
    die($src_file ." ファイルがありませんよ\n");
}

$zip = new ZipArchive;
if ($zip->open($src_file) != true) {
    echo "inflate error\n";
    exit();
}

// 解凍後のファイル名
$dist_file = $tmp_dir.DIRECTORY_SEPARATOR. basename($src_file);

if (!is_dir($tmp_dir)) {
    // 一時ディレクトリがなかったら作る。
    mkdir($tmp_dir);
}

if (!file_exists($dist_file)) {
    echo "[ファイル解凍する]\n";
    $zip->extractTo($tmp_dir);
} else {
    echo "[ファイル解凍しない]\n";
}

$handle = fopen($dist_file,"r");

$log_path = $tmp_dir.DIRECTORY_SEPARATOR.'log-'.date("Ymd-Hi").'.log';
$tmp_path = $tmp_dir.DIRECTORY_SEPARATOR.'tmp.cache';
$log_handle = fopen($log_path, "w");
$tmp_handle = fopen($tmp_path, "w");

$n = 0;
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $buffer = mb_convert_encoding($buffer, $internal_encoding, $file_encoding);

        if ($n == 0) {
            // ヘッダーを判定
            $ana = analyzeLineHeader($buffer);
            testHeader();
        } else {
            // ボディを判定
            $ana = analyzeLineBody($buffer);

            $product_code = getProductCode($buffer);
            // ユニークの確認
            if (isExistsSerial($product_code)) {
                echo '重複 product_code='.$product_code."\n";
                exit();
            }
        }

        $n ++;

        // ログに書き込む
        fwrite($log_handle, print_r($ana,1));
    }
}


//$lines = file($dist_file);
echo "終了\n";
exit();

function analyzeLineHeader ($line) {
    return analyzeLine($line);
}

function analyzeLineBody ($line) {
    return analyzeLine($line, false);
}

function analyzeLine ($line, $is_header = true) {
    global $product_headers, $products;
    if ($is_header) {
        $arr = $product_headers;
    } else {
        $arr = $products;
    }

    $ret = array();
    $start = 0;
    foreach ($arr as $val) {
        $len = $val[1];
        $value = substr($line, $start, $len);
        $ret[$val[0]] = $value;
        $start += $len;
    }

    return $ret;
}

/**
 * 商品明細一行から商品コードを取得する関数
 */
function getProductCode($line) {
    global $products;
    $product_code = "";
    $start = 0;
    foreach ($products as $product) {
        $len = $product[1];
        if ($product[0] === '商品コード') {
            $product_code = substr($line, $start, $len);
            return $product_code;
        }
        $start += $product[1];
    }
    return "";
}

function isExistsSerial($code) {
    global $tmp_handle;
    //$handle = fopen($tmp_path, "w");
    $code = trim($code);

    while(($buffer = fgets($tmp_handle, 4096)) !== false) {
        if ($buffer == $code) {
            return true;
        }
    }

    // 見つからなかったら保存する
    fwrite($tmp_handle, $code."\n");
    return false;
}

/**
 * 商品明細のヘッダーだけをテストする。
 *
 */
function testHeader() {
    global $dist_file, $internal_encoding, $file_encoding, $product_headers;

    $tests = array(
        'data_count' => "NG",
    );

    $handle = fopen($dist_file,"r");
    if ($handle) {
        // 行数
        $n = 0;
        while(($buffer = fgets($handle, 4096)) !== false) {
            if ($n == 0) {
                $header = mb_convert_encoding($buffer, $internal_encoding, $file_encoding);
            }
            $n ++;
        }

        $headers = array();
        $start = 0;
        foreach ($product_headers as $value) {
            $len = $value[1];
            $headers[$value[0]] = substr($header, $start, $len);
            $start += $len;
        }

        $data_count = (int)$headers['データ件数'];
        $create_date = substr($headers['データ作成年月日'],0,2).'-'.
            substr($headers['データ作成年月日'],2,2).'-'.
            substr($headers['データ作成年月日'],4,2);

        $create_time = substr($headers['データ作成時刻'],0,2).':'.
            substr($headers['データ作成時刻'],2,2).':'.
            substr($headers['データ作成時刻'],4,2);

        if ($data_count == $n - 1) {
            $tests['data_count'] = "OK";
        }
        echo "[Create Date] ".$create_date."\n";
        echo "[Create Time] ".$create_time."\n";

    } else {
        echo "ファイルを読み込めないのでヘッダーチェックが出来ない。\n";
    }

}


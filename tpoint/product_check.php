#!/usr/local/bin/php
<?php

/*
商品のマスタ確認
*/

//$src_file = '/data/sites/adm/ethna/tmp/tpoint_work/20161011/IM001630-t';
$src_file = '/data/sites/adm/ethna/tmp/tpoint_detail/IM001630';

include("tpoint.common.php");

// 
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
$n = 0;
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $buffer = mb_convert_encoding($buffer, $internal_encoding, $file_encoding);

        if ($n == 0) {
            // ヘッダーを判定
            $ana = analyzeLineHeader($buffer);
        } else {
            // ボディを判定
            $ana = analyzeLineBody($buffer);
        }

        $n ++;
        if ($n % 100) {
            echo 'line='.__LINE__." n=$n ".print_r($ana,1)."------------------\n";;
        }

        if ($n > 10) {
            //exit();
        }
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


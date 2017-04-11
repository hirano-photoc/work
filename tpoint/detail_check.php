#!/usr/local/bin/php
<?php

/*
明細の確認
*/



//$src_file = '/data/sites/adm/ethna/tmp/tpoint_work/DD001630.t';
$src_file = '/data/sites/adm/ethna/tmp/tpoint_detail/DD001630';

include("tpoint.common.php");

$deflate_dir = $tmp_dir.DIRECTORY_SEPARATOR.date('Ymd');

$file_check = function() use ($src_file) {
    if (!file_exists($src_file)) {
        echo $src_file."\n";
        die("ファイルがありませんよ\n");
    } else {
        echo "ファイルがある！".basename($src_file)."\n";;
    }
};
$file_check();

$zip_deflate = function() use ($deflate_dir, $src_file) {
    echo __LINE__.' src_file='.$src_file."\n";
    $zip = new ZipArchive;
    $res = $zip->open($src_file);
    if ($res === true) {
        //$deflate_dir = $tmp_dir.DIRECTORY_SEPARATOR.date('Ymd');
        if (!is_dir($deflate_dir)) {
            mkdir($deflate_dir);
        }
        $zip->extractTo($deflate_dir);
        $zip->close();
        echo "[DEFLATE] 解凍できた。 ".$src_file.' -> DIR '.$deflate_dir."\n";
    } else {
        echo "解凍失敗";
    }
};
$zip_deflate();

// 解凍されたファイルの有無
$data_file = $deflate_dir.DIRECTORY_SEPARATOR.basename($src_file);
//$data_file = $tmp_dir.DIRECTORY_SEPARATOR.'DD0016302-2015070306.txt';
//$data_file = $tmp_dir.DIRECTORY_SEPARATOR.'DD001630-20170221.txt';
//$data_file = $deflate_dir.DIRECTORY_SEPARATOR.'DD001630';
//$data_file = '/data/sites/adm/ethna/tmp/tpoint_detail/DD001630';
$is_deflate = function() use ($data_file) {
    if (!file_exists($data_file)) {
        die("調査するファイルが見つからないです。$data_file\n");
    }
};
$is_deflate();

$lines = file($data_file);

$header_data = array();
$n = 0;
$err_cnt = 0;
foreach ($lines as $line) {

    $start = 0;
    if ($n == 0) {
        foreach ($detail_headers as $header) {
            $len = $header[1];
            $str = substr($line, $start, $len);
            $str = mb_convert_encoding($str, "UTF-8", "Shift-Jis");

            if (preg_match("/^\d+$/", $str)) {
                $header_data[$header[0]] = (int)$str;
            } else {
                $header_data[$header[0]] = $str;
            }
            echo "$header[0]====$str====[$len]\n";
            $start += $header[1];
            
        }
    } else {
        $mes = "";
        $err = "";

        // レコード区分 (0:伝票系レコード 1:明細系レコード)
        $kbn = substr($line, 69, 1);
        $kbn_cnts[$kbn] ++;

        foreach ($detail_fields as $field) {
            $str = substr($line, $start, $field['length']);
            $str = mb_convert_encoding($str, "UTF-8", "Shift-Jis");
            //echo "{$field['name']}--$str\n";
            $start += $field['length'];

            // 必須チェック
            if ($kbn == "0" && $field['require'] && trim($str) == "") {
                //$err .= $field['name'].' ';
            }
            if ($kbn == "1" && $field['require'] && trim($str) == "" ) {
                $mes .= '['.$field['name'].'] '.trim($str).' ';
                //$err_cnt ++;
            }
            if ($field['require'] && trim($str) == "") {
                $err .= $field['name'].'-'.$str.' ';
            }
        }

        // 進行中
        /*
        if ($kbn == " ") {
            $err = '['.mb_convert_encoding($line, "UTF-8", "Shift-Jis").']';
            $err_cnt ++;
        }
        */

        if ($mes != "") {
            //echo $n.' '.$mes."\n";
            //sleep(1);
        }
        if ($err != "") {
            echo 'n='.$n.' '.$err."\n".$line."\n";
        }
        //echo "n=$n ";
        if ($n % 1000 == 0) {
            echo "解析中 n=$n\r";
        }
    }

    $n++;
}
echo "ヘッダーに記述されたデータ件数 ".$header_data['データ件数'].' 実際の行数='.$n."\n";
echo "必須項目チェックの件数配列 err_cnt=".$err_cnt."\n";
echo "kbn_cnts ".print_r($kbn_cnts,1)."\n";
echo "mes: $mes\n";


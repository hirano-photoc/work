#!/usr/local/bin/php
<?php

/*
商品魔のスタ確認
*/


$src_file = '/data/sites/adm/ethna/tmp/tpoint_work/20161011/IM001630-t';

include("tpoint.common.php");

// 
$internal_encoding  = "utf-8";
// ファイルのエンコード
$file_encode = "Shift-Jis";

if (!file_exists($src_file)) {
    die("ファイルがありませんよ\n");
}
$lines = file($src_file);



$n = 0;
foreach ($lines as $line) {
    $start = 0;
    if ($n == 0) {
        foreach ($product_headers as $header) {
            $len = $header[1];
            $str = substr($line, $start, $len);
            $str = mb_convert_encoding($str, $internal_encoding, $file_encode);
            echo "$header[0]====$str====[$len]\n";
            $start += $header[1];
        }
    } else {

        foreach ($products as $product) {
            $str = substr($line, $start, $product[1]);
            $str = mb_convert_encoding($str, $internal_encoding, $file_encode);
            echo "n=$n $product[0]====$str====[EOL]\n";
            $start += $product[1];
        }
    }
    $n ++;
}


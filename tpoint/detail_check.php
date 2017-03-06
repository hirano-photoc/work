#!/usr/local/bin/php
<?php

/*
明細の確認
*/

//$src_file = '/data/sites/adm/ethna/tmp/tpoint_work/DD001630.t';
$src_file = '/data/sites/adm/ethna/tmp/tpoint_work/20161011/DD001630-t';

include("tpoint.common.php");

if (!file_exists($src_file)) {
    die("ファイルがありませんよ\n");
}
$lines = file($src_file);

//echo "[line] $lines\n";
$n = 0;
foreach ($lines as $line) {

    $start = 0;
    if ($n == 0) {
        foreach ($detail_headers as $header) {
            $len = $header[1];
            $str = substr($line, $start, $len);
            echo "$header[0]====$str====[$len]\n";
            $start += $header[1];
            
        }
    } else {
        foreach ($detail_fields as $field) {
            $str = substr($line, $start, $field['name']);
            echo "{$field['length']}--$str\n";
            $start += $field['length'];
        }
    }
    $n++;
}


<?php
/*
common file
*/

// 解凍するディレクトリ名

$tmp_dir = dirname(__FILE__). DIRECTORY_SEPARATOR .'tmp';


$detail_headers[] = array('レコード区分',10);
$detail_headers[] = array('データ識別',8);
$detail_headers[] = array('アライアンスコード',4);
//$detail_headers[] = array('データ作成年月日',8);
$detail_headers[] = array('データ作成年',4);
$detail_headers[] = array('データ作成月',2);
$detail_headers[] = array('データ作成日',2);
$detail_headers[] = array('データ作成時刻  ',6);
$detail_headers[] = array('データ件数',8);
$detail_headers[] = array('レコード長',4);
$detail_headers[] = array('予備    ',20);
$detail_headers[] = array('レングス調整',739);


//$fields[] = array('使用年月日',8);
$detail_fields = [
    [  
        'name' => '使用年月日',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '使用時刻',
        'length' => 6,
        'require' => true,
    ],
    [
        'name' => '営業年月日',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '業態コード',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '店舗コード',
        'length' => 13,
        'require' => true,
    ],
    [
        'name' => 'レジNo.',
        'length' => 6,
        'require' => true,
    ],
    [
        'name' => '伝票No.',
        'length' => 20,
        'require' => true,
    ],
    [
        'name' => 'レコード区分',
        'length' => 1,
        'require' => true,
    ],
    [
        'name' => '明細No.',
        'length' => 4,
        'require' => true,
    ],
    [
        'name' => 'ID区分',
        'length' => 1,
        'require' => true,
    ],
    [
        'name' => '返品フラグ',
        'length' => 1,
        'require' => true,
    ],
    [
        'name' => '商品コード',
        'length' => 64,
        'require' => false,
    ],
    [
        'name' => 'ＪＡＮコード'
        ,'length' =>13,
        'require' => false,
    ],
    [
        'name' => '売上点数',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '売上単価',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '売上合計',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '明細値引金額',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '伝票値引金額',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '税区分', 
        'length' => 1,
        'require' => true,
    ],
    [
        'name' => '税率',
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '消費税', 
        'length' => 8,
        'require' => true,
    ],
    [
        'name' => '支払区分',
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => 'T会員番号',
        'length' => 16,
        'require' => false,
    ],
    [
        'name' => 'サイトID', 
        'length' => 60,
        'require' => false,
    ],
    [
        'name' => 'Ｔ会員番号読取区分', 
        'length' => 1,
        'require' => false,
    ],
    [
        'name' => '個別情報1', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報2', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報3', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報4', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報5', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報6', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報7', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報8', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報9', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報10', 
        'length' => 20,
        'require' => false,
    ],
    [
        'name' => '個別情報11', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報12', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報13', 
        'length' => 30,
        'require' => false,
    ],
    [  
        'name' => '個別情報14', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報15', 
        'length' => 30,
        'require' => false,
    ],
    [  
        'name' => '個別情報16', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報17', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報18', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報19', 
        'length' => 30,
        'require' => false,
    ],
    [
        'name' => '個別情報20', 
        'length' => 30,
        'require' => false,
    ],
];

    $product_headers[] = array('レコード区分',10);
$product_headers[] = array('データ識別',8);
$product_headers[] = array('アライアンスコード',4);
$product_headers[] = array('データ作成年月日',8);
$product_headers[] = array('データ作成時刻',6);
$product_headers[] = array('データ件数',8);
$product_headers[] = array('レコード長  数値型',4);
$product_headers[] = array('予備',20);
$product_headers[] = array('レングス調整',1525);


$products[] = array('業態コード',8);
$products[] = array('商品コード',64);
$products[] = array('商品名',512);
$products[] = array('商品名略称',64);
$products[] = array('分類第1階層コード',20);
$products[] = array('分類第2階層コード',20);
$products[] = array('分類第3階層コード',20);
$products[] = array('分類第4階層コード',20);
$products[] = array('分類第1階層名称',30);
$products[] = array('分類第2階層名称',30);
$products[] = array('分類第3階層名称',30);
$products[] = array('分類第4階層名称',30);
$products[] = array('単価（売価）',8);
$products[] = array('JAN(EAN)コード',13);
$products[] = array('メーカーコード',10);
$products[] = array('メーカー名',30);
$products[] = array('適用開始日',8);
$products[] = array('適用終了日',8);
$products[] = array('予備1（その他分析用コード1)',20);
$products[] = array('予備2（その他分析用コード2)',20);
$products[] = array('予備3（その他分析用コード3)',20);
$products[] = array('予備4（その他分析用コード4)',20);
$products[] = array('予備5（その他分析用コード5)',20);
$products[] = array('予備6（その他分析用コード6)',20);
$products[] = array('予備7（その他分析用コード7)',20);
$products[] = array('予備8（その他分析用コード8)',20);
$products[] = array('予備9（その他分析用コード9)',20);
$products[] = array('予備10（その他分析用コード10)',20);
$products[] = array('予備11（その他分析用コード名1)',30);
$products[] = array('予備12（その他分析用コード名2)',30);
$products[] = array('予備13（その他分析用コード名3)',100);
$products[] = array('予備14（その他分析用コード名4)',30);
$products[] = array('予備15（その他分析用コード名5)',100);
$products[] = array('予備16（その他分析用コード名6)',30);
$products[] = array('予備17（その他分析用コード名7)',30);
$products[] = array('予備18（その他分析用コード名8)',30);
$products[] = array('予備19（その他分析用コード名9)',30);
$products[] = array('予備20（その他分析用コード名10)',30);
$products[] = array('登録日時',14);
$products[] = array('更新日時',14);

<?php
/* 幅と高さを、本物の PHP ロゴにあわせて設定します */
$width = 400;
$height = 210;

/* Imagick オブジェクトを透過キャンバスで作ります */
$img = new Imagick();
$img->newImage($width, $height, new ImagickPixel('transparent'));

/* 楕円の描画用に、新しい ImagickDraw のインスタンスを作ります */
$draw = new ImagickDraw();
/* 楕円の塗りつぶし色を紫にします */
$draw->setFillColor('#777bb4');
/* 楕円の大きさを設定します */
$draw->ellipse($width / 2, $height / 2, $width / 2, $height / 2, 0, 360);
/* 楕円をキャンバス上に描画します */
$img->drawImage($draw);

/* 楕円の塗りつぶし色をリセットして黒に戻し、テキストの描画に備えます (ImagickDraw オブジェクトを再利用していることに注目) */
$draw->setFillColor('black');
/* 縁取りの色を白に設定します */
$draw->setStrokeColor('white');
/* 線の太さを設定します */
$draw->setStrokeWidth(2);
/* フォントのカーニングを設定します (負の値は、文字と文字の間隔を狭くすることを意味します) */
$draw->setTextKerning(-8);
/* PHP ロゴで使うフォントとそのサイズを設定します */
// $draw->setFont('Handel Gothic.ttf');
$draw->setFontSize(150);
/* テキストを縦横ともに中央寄せにします */
$draw->setGravity(Imagick::GRAVITY_CENTER);

/* "php" という文字を、キャンバス内の Y オフセット -10 の位置 (楕円の中) に描画します */
$img->annotateImage($draw, 0, -10, 0, 'php');
$img->setImageFormat('png');

/* PNG のヘッダーを設定して、画像を出力します */
header('Content-Type: image/png');
echo $img;
?>
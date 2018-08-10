<?php
/**
 * Created by PhpStorm.
 * User: XiaoLin
 * Date: 2018-08-10
 * Time: 11:49 AM
 */

if (!isset($_GET['text']) || !preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u",$_GET['text'])) die;
$i = $_GET['text'];

$font = __DIR__ . "/font.ttf";
$fontSize = 54;
$originalImage = __DIR__ . "/image/pink.png";
$y = 428;

$im = imagecreatefrompng($originalImage);
imagesavealpha($im,true);

$black = imagecolorallocate($im,95,93,188);
$width = imagesx($im);

$textWidth = imagettfbbox($fontSize,0,$font,$i);

$x = ($width - 93.63 - 87.85 - ($textWidth[4] - $textWidth[6])) / 2 + 90;

header("Content-type: image/png");
imagettftext($im,$fontSize,0,$x,$y,$black,$font,$i);
imagepng($im, NULL,0);
imagedestroy($im);
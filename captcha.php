<?php
session_start();
$image = imagecreatetruecolor( 120, 30) or die("Cannot Initialize new GD image stream");
$background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
imagefill($image, 0, 0, $background);
$line_color = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
$text_color = imagecolorallocate($image, 0x33, 0x33, 0x33);
?>
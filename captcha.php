<?php 
	session_start(); 
	$text = rand(100000,999999); 
	$_SESSION["vercode"] = $text; 
	$height = 30; 
	$width = 60;   
	$image_p = imagecreate($width, $height); 
	$black = imagecolorallocate($image_p, 255, 255, 255); 
	$white = imagecolorallocate($image_p, 0, 0, 0); 
	$font_size = 30; 
	imagestring($image_p, $font_size, 6, 6, $text, $white); 
	imagejpeg($image_p, null, 100); 
?>
<?php
	header("Content-type: image/png");

	// 写验证码
	
	$width = 200;
	$height = 30;
	// 创建画布
	$im = imagecreate($width, $height);
		
	// 分配画布背景颜色
	$color = imagecolorallocate($im, 255, 80, 00);
	
	// 添加内容
	// 使用中文的验证，需要注意转码，否则会出现乱码.
	$string = "abcdefghijklmnABCDEFGHIJKMLMNYZ0123456789";
	
	$no = 4;
	$content = '';
	$strlen = strlen($string) - 1;
	
	// 字体颜色
	$textcolor = imagecolorallocate($im, 255, 255, 255);
	$y = $height / 2;
	while($no--) {
		$index = rand(0, $strlen);
		$x = 50 + (4 - $no) * 20;
		imagestring($im, 5, $x, $y, $string[$index], $textcolor);
	}
	
	imagepng($im);
	
	imagedestroy($im);

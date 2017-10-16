<?php

//绘图过程
//1：创建画布,分配颜色
//imagecreatetruecolor(width, height);
//imagecolorallocate(image, red, green, blue);
//2：开始绘画
//3：输出图像
//imagepng(image);
//imagejpeg(image)....;
//4销毁图片（释放内容）
//imagedestroy(image);
//绘制验证码步骤：
//1：复制一个字体文件。
//2：定义一个函数,随机生成验证码内容。
/**
 * *随机生成一个验证码的内容的函数
 * @param $m：验证码的个数 
 * @param $type：验证码的类型 0：数字1：数字加小写字母 2：数字加大小写字母
 */
function getCode($m=4,$type=0){
   $str = "42s3s3ddhs241h2nsfgk423jnkk243nvzh434dshbsj";
   $t = array(9,35,strlen($str)-1);//随机生成验证码内容
   $c="";
   for($i=0;$i<$m;$i++){
   	$c.=$str[rand(0,$t[$type])];
   }
   return $c;
}
//echo getCode(5);
//3:开始绘画验证码(加干扰点，干扰线)
$num = 4;//验证码的长度
$str = getCode($num,0);//使用上面自定义函数，获取需要的验证码值
//1：创建画布,分配颜色
$width=$num*20;//宽度
$height=30;//高度
$im=imagecreatetruecolor($width, $height);
$color[]=imagecolorallocate($im,111,0,55);
$color[]=imagecolorallocate($im,221,111,0);
$color[]=imagecolorallocate($im,221,0,0);
$color[]=imagecolorallocate($im,0,0,160);
$color[]=imagecolorallocate($im,0,77,0);
$bg=imagecolorallocate($im, 220, 200, 200);//创建一个背景
//2：开始绘画
imagefill($im, 0, 0, $bg);
imagerectangle($im, 0, 0, $width-1, $height-1, $color[rand(0,4)]);
//随机添加干扰点
for($i=0;$i<10;$i++){
	$c=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));//随机一个颜色
	imagesetpixel($im, rand(0,$width), rand(0,$height), $c);
}
//随即绘制干扰线
for($i=0;$i<10;$i++){
	$c=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));//随机一个颜色
	imageline($im, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $c);
}
//绘制验证码内容（一个一个的绘制）
for($i=0;$i<$num;$i++){
	imagettftext($im, 18, rand(-40,40), 8+(18*$i), 24, $color[rand(0,4)], "BASKVILL.ttf", $str[$i]);
}
//3:输出图像
header("Content-Type:image/png");//设置响应头信息(注意此函数前没输出)
imagepng($im);
//4销毁图片（释放内容）
imagedestroy($im);

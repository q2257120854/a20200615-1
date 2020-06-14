<?php
//echo '贪玩点卡智能建站·全开源卡盟系统 免费下载：www.kycard.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
session_start();               //为了将验证码的值保留在$_SESSION中
	//图像高
	$height="21";
	//图像宽
	$width="60";
	
	//字体路径
	$font_name = "arial.ttf";
	//文字大小
	$font_size = 14;
	$font_angle = rand(-2,2) ;
	
	//生成验证码
    $str = "abcdehkmnsuvwxz2345689";
    $code = '';
    for ($i = 0; $i < 4; $i++) {
        $code .= $str[mt_rand(0, strlen($str)-1)]."|";
    }
	$text=explode("|",$code);
	$code=implode("",$text);
	
	//文字间距
	$font_spacing = 3;
	// X轴坐标
	$position_x = 6;
	//Y轴坐标
	$position_y = 19;
	$font_shade_spacing_x = 1;
	$font_shade_spacing_y = 1;
	
	
    // 画图像
	$im = imagecreatetruecolor($width, $height);
    // 定义要用到的颜色
	$back_color = imagecolorallocate($im, 246, 251, 254);
    $boer_color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120)); 
    // 画背景
	imagefilledrectangle($im, 0, 0, $width, $height, $back_color); 

	// 画干扰点
    for($i = 0;$i < 60;$i++) {
        $font_color = imagecolorallocate($im, 227, 231, 230);
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
    }

	// 取得每一个字符的Weight
	$font_coordinate = imagettfbbox ( $font_size, $font_angle, $font_name, $text[0] );
	$font_weight = $font_coordinate[2] - $font_coordinate[0];
	$font_height = abs($font_coordinate[5]) - $font_coordinate[3];


	// 画验证码
	for($count = 0  ; $count<=count($text) ; $count++){
		imagettftext($im, $font_size, rand(-3,4) , $position_x-$font_shade_spacing_x , $position_y-$font_shade_spacing_y, $text_color, 'arial.ttf', $text[$count]);
		$position_x = $position_x + $font_weight + $font_spacing;
		if($position_x>=50){
			$position_x=48;
		};
	};
	
	
	//画曲线
	$j1=rand(4,8);
	$y2=rand(2,3);
	$y3=rand(9,11);
	for($j=rand(-20,0);$j<80;$j+=1){
    	$x1 = $j/$j1;
    	$y1 = sin($x1);
    	$y1 = $y3 + $y2*$y1;
    	imagesetpixel($im,$j,$y1,$text_color);
	}	

	
	header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
	header("Content-type: image/png;charset=utf-8");
	imagepng($im);
	imagedestroy($im);
	
	$_SESSION['checkCode']=$code; 
?>
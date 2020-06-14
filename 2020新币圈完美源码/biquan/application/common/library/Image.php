<?php
namespace app\common\library;
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/*
 +------------------------------------------------------------------------------
 * 图像操作类库
 +------------------------------------------------------------------------------
 * @category   ORG
 * @package  ORG
 * @subpackage  Util
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class Image
{//类定义开始

    /*
     +----------------------------------------------------------
     * 取得图像信息
     *
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $image 图像文件名
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    static function getImageInfo($img) {
        $imageInfo = getimagesize($img);
        if( $imageInfo!== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]),1));
            $imageSize = filesize($img);
            $info = array(
                "width"=>$imageInfo[0],
                "height"=>$imageInfo[1],
                "type"=>$imageType,
                "size"=>$imageSize,
                "mime"=>$imageInfo['mime']
            );
            return $info;
        }else {
            return false;
        }
    }
    /*
      +----------------------------------------------------------
     * 为图片添加水印
      +----------------------------------------------------------
     * @static public
      +----------------------------------------------------------
     * @param string $source 原文件名
     * @param string $water  水印图片
     * @param string $$savename  添加水印后的图片名
     * @param string $alpha  水印的透明度
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    static public function water($source, $water, $savename=null, $alpha=80) {
        //检查文件是否存在
        if (!file_exists($source) || !file_exists($water))
            return false;

        //图片信息
        $sInfo = self::getImageInfo($source);
        $wInfo = self::getImageInfo($water);

        //如果图片小于水印图片，不生成图片
        if ($sInfo["width"] < $wInfo["width"] || $sInfo['height'] < $wInfo['height'])
            return false;

        //建立图像
        $sCreateFun = "imagecreatefrom" . $sInfo['type'];
        $sImage = $sCreateFun($source);
        $wCreateFun = "imagecreatefrom" . $wInfo['type'];
        $wImage = $wCreateFun($water);

        //设定图像的混色模式
        imagealphablending($wImage, true);

        //图像位置,默认为右下角右对齐
        $posY = $sInfo["height"] - $wInfo["height"];
        $posX = $sInfo["width"] - $wInfo["width"];

        //生成混合图像
        imagecopymerge($sImage, $wImage, $posX, $posY, 0, 0, $wInfo['width'], $wInfo['height'], $alpha);

        //输出图像
        $ImageFun = 'Image' . $sInfo['type'];
        //如果没有给出保存文件名，默认为原图像名
        if (!$savename) {
            $savename = $source;
            @unlink($source);
        }
        //保存图像
        $ImageFun($sImage, $savename);
        imagedestroy($sImage);
    }

	static public  function watermark($source,$target = '',$config ) {
		$watermarkPadding = $config['watermark_pospadding'];
		$w_pos = $config['watermark_pos'];
		if($config['watermark_img']){
		if (file_exists($config['watermark_img'])){
				$w_img = $config['watermark_img'];
			}else{
				$w_img = './Public/Images/'.$config['watermark_img'];
			}
		
		
		}
		$w_text = $config['watemard_text'];
		$w_font =  $config['watemard_text_size'];
		$w_color =  $config['watemard_text_color'];
		$fontface =  './game/static/'.$config['watemard_text_face'];

		$w_pct =   $config['watermark_pct'];
		$w_quality =  $config['watermark_quality'];
		$w_minheight =  $config['watermark_minheight'];
		$w_minwidth =   $config['watermark_minwidth'];
		$watermarkPadding = $config['watermark_pospadding'];
		$w_pos = $config['watermark_pos'];

		$positionPadding = ($watermarkPadding && $watermarkPadding > 0) ? $watermarkPadding : 5; 	// 边距

		$w_pos = $w_pos ? $w_pos : 9;
		$w_img = $w_img ? $w_img : $w_img;
		if(!$target) $target = $source;

		$source_info = getimagesize($source);
		$source_w    = $source_info[0];
		$source_h    = $source_info[1];		
		if($source_w < $w_minwidth || $source_h < $w_minheight) return false;

		switch($source_info[2]) {
			case 1 :
				$source_img = imagecreatefromgif($source);
				break;
			case 2 :
				$source_img = imagecreatefromjpeg($source);
				break;
			case 3 :
				$source_img = imagecreatefrompng($source);
				break;
			default :
				return false;
		}
		if(!empty($w_img) && file_exists($w_img)) {
			
			$ifwaterimage = 1;
			$water_info   = getimagesize($w_img);
			$width        = $water_info[0];
			$height       = $water_info[1];
			switch($water_info[2]) {
				case 1 :
					$water_img = imagecreatefromgif($w_img);
					break;
				case 2 :
					$water_img = imagecreatefromjpeg($w_img);
					break;
				case 3 :
					$water_img = imagecreatefrompng($w_img);
					break;
				default :
					return;
			}
		} else {
			
			$ifwaterimage = 0;
			$temp = imagettfbbox(ceil($w_font*2.5), 0, $fontface, $w_text);
			$width = $temp[2] - $temp[6];
			$height = $temp[3] - $temp[7];
			unset($temp);

		}
		switch($w_pos) {
			case 1:
				$wx = $positionPadding;
				$wy = $positionPadding;
				break;
			case 2:
				$wx = ($source_w - $width) / 2;
				$wy = $positionPadding;
				break;
			case 3:
				$wx = $source_w - $width;
				$wy = $positionPadding;
				break;
			case 4:
				$wx = $positionPadding;
				$wy = ($source_h - $height) / 2;
				break;
			case 5:
				$wx = ($source_w - $width) / 2;
				$wy = ($source_h - $height) / 2;
				break;
			case 6:
				$wx = $source_w - $width - $positionPadding;
				$wy = ($source_h - $height) / 2;
				break;
			case 7:
				$wx = $positionPadding;
				$wy = $source_h - $height;
				break;
			case 8:
				$wx = ($source_w - $width) / 2;
				$wy = $source_h - $height - $positionPadding;
				break;
			case 9:
				$wx = $source_w - $width - $positionPadding;
				$wy = $source_h - $height - $positionPadding ;
				break;
			case 10:
				$wx = rand(0,($source_w - $width));
				$wy = rand(0,($source_h - $height));
				break;	
			case 11:
				$wx = $config['pd_left'];
				$wy = $config['pd_top'];
				break;				
			default:
				$wx = rand(0,($source_w - $width));
				$wy = rand(0,($source_h - $height));
				break;
		}
		if($ifwaterimage) {
			if($water_info[2] == 3) {
				imagecopy($source_img, $water_img, $wx, $wy, 0, 0, $width, $height);
			} else {
				imagecopymerge($source_img, $water_img, $wx, $wy, 0, 0, $width, $height, $w_pct);
			}
		} else {
			if(!empty($w_color) && (strlen($w_color)==7)) {
				$r = hexdec(substr($w_color,1,2));
				$g = hexdec(substr($w_color,3,2));
				$b = hexdec(substr($w_color,5));
			} else {
				return;
			}
 
			$black = imagecolorallocate($source_img, $r,$g, $b);//设置颜色   
			imagettftext($source_img, $w_font, 0, $wx, $wy, $black, $fontface, $w_text);//打印水印   

		}

		switch($source_info[2]) {
			case 1 :
				imagegif($source_img, $target);
				break;
			case 2 :
				imagejpeg($source_img, $target, $w_quality);
				break;
			case 3 :
				imagepng($source_img, $target);
				break;
			default :
				return;
		}

		if(isset($water_info)) {
			unset($water_info);
		}
		if(isset($water_img)) {
			imagedestroy($water_img);
		}
		unset($source_info);
		imagedestroy($source_img);
		return true;

	}
//图片加水印
  static function watertext($config) {
           // print_r($config);exit;
	        $im = imagecreatefromjpeg($config['soure']);    
			$config['color']=empty($config['color'])?"#ffffff":$config['color'];
			if(!empty($config['color']) && (strlen($config['color'])==7)) {
					$r = hexdec(substr($config['color'],1,2));
					$g = hexdec(substr($config['color'],3,2));
					$b = hexdec(substr($config['color'],5));
				} 
			$font_color = imagecolorallocate ($im,$r,$g,$b); //这是文字颜色，绿色    
			$font_file = "game/static/".$config['font'];               //字体的linux绝对路径   
			$angle=$config['angle']?$config['angle']:0;
			$left=$config['left']>0?$config['left']:0;
			$top=$config['top']>0?$config['top']:0;
			$fontsize=$config['fontsize']>0?$config['fontsize']:12;
			$text=!empty($config['text'])?$config['text']:"test word";
			imagettftext($im,$fontsize,$angle,$left,$top,$font_color,$font_file, $text); 
			imagepng ($im,$config['dis']);    
			imagedestroy($im);
			return $config['dis'];
			

  }
    /*
     +----------------------------------------------------------
     * 显示服务器图像文件
     * 支持URL方式
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $imgFile 图像文件名
     * @param string $text 文字字符串
     * @param string $width 图像宽度
     * @param string $height 图像高度
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static function showImg($imgFile,$text='',$width=80,$height=30) {
        //获取图像文件信息
        $info = Image::getImageInfo($imgFile);
        if($info !== false) {
            $createFun  =   str_replace('/','createfrom',$info['mime']);
            $im = $createFun($imgFile);
            if($im) {
                $ImageFun= str_replace('/','',$info['mime']);
                if(!empty($text)) {
                    $tc  = imagecolorallocate($im, 0, 0, 0);
                    imagestring($im, 3, 5, 5, $text, $tc);
                }
                if($info['type']=='png' || $info['type']=='gif') {
                imagealphablending($im, false);//取消默认的混色模式
                imagesavealpha($im,true);//设定保存完整的 alpha 通道信息
                }
                header("Content-type: ".$info['mime']);
                $ImageFun($im);
                imagedestroy($im);
                return ;
            }
        }
        //获取或者创建图像文件失败则生成空白PNG图片
        $im  = imagecreatetruecolor($width, $height);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        imagestring($im, 4, 5, 5, "NO PIC", $tc);
        Image::output($im);
        return ;
    }

    /*
     +----------------------------------------------------------
     * 生成缩略图
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $image  原图
	 * @param string $thumbname 缩略图文件名
     * @param string $type 图像格式
     * @param string $maxWidth  宽度
     * @param string $maxHeight  高度
     * @param string $position 缩略图保存目录
     * @param boolean $interlace 启用隔行扫描
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static function thumb($image,$thumbname,$type='',$maxWidth=200,$maxHeight=50,$interlace=true)
    {
        // 获取原图信息
        $info  = Image::getImageInfo($image);
         if($info !== false) {
            $srcWidth  = $info['width'];
            $srcHeight = $info['height'];
            $type = empty($type)?$info['type']:$type;
			$type = strtolower($type);
            $interlace  =  $interlace? 1:0;
            unset($info);
            $scale = min($maxWidth/$srcWidth, $maxHeight/$srcHeight); // 计算缩放比例
            if($scale>=1) {
                // 超过原图大小不再缩略
                $width   =  $srcWidth;
                $height  =  $srcHeight;
            }else{
                // 缩略图尺寸
                $width  = (int)($srcWidth*$scale);
                $height = (int)($srcHeight*$scale);
            }


            // 载入原图
            $createFun = 'ImageCreateFrom'.($type=='jpg'?'jpeg':$type);
            $srcImg     = $createFun($image);

            //创建缩略图
            if($type!='gif' && function_exists('imagecreatetruecolor'))
                $thumbImg = imagecreatetruecolor($width, $height);
            else
                $thumbImg = imagecreate($width, $height);

            // 复制图片
            if(function_exists("ImageCopyResampled"))
                imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth,$srcHeight);
            else
                imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height,  $srcWidth,$srcHeight);
            if('gif'==$type || 'png'==$type) {
                //imagealphablending($thumbImg, false);//取消默认的混色模式
                //imagesavealpha($thumbImg,true);//设定保存完整的 alpha 通道信息
                $background_color  =  imagecolorallocate($thumbImg,  0,255,0);  //  指派一个绿色
				imagecolortransparent($thumbImg,$background_color);  //  设置为透明色，若注释掉该行则输出绿色的图
            }

            // 对jpeg图形设置隔行扫描
            if('jpg'==$type || 'jpeg'==$type) 	imageinterlace($thumbImg,$interlace);

            //$gray=ImageColorAllocate($thumbImg,255,0,0);
            //ImageString($thumbImg,2,5,5,"ThinkPHP",$gray);
            // 生成图片
            $imageFun = 'image'.($type=='jpg'?'jpeg':$type);
            $imageFun($thumbImg,$thumbname);
            imagedestroy($thumbImg);
            imagedestroy($srcImg);
            return $thumbname;
         }
         return false;
    }

    /*
     +----------------------------------------------------------
     * 根据给定的字符串生成图像
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $string  字符串
     * @param string $size  图像大小 width,height 或者 array(width,height)
     * @param string $font  字体信息 fontface,fontsize 或者 array(fontface,fontsize)
     * @param string $type 图像格式 默认PNG
     * @param integer $disturb 是否干扰 1 点干扰 2 线干扰 3 复合干扰 0 无干扰
	 * @param bool $border  是否加边框 array(color)
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	static function buildString($string,$rgb=array(),$filename='',$type='png',$disturb=1,$border=true) {
		if(is_string($size))		$size	=	explode(',',$size);
		$width	=	$size[0];
		$height	=	$size[1];
		if(is_string($font))		$font	=	explode(',',$font);
		$fontface	=	$font[0];
		$fontsize	 	=	$font[1];
		$length		=	strlen($string);
        $width = ($length*9+10)>$width?$length*9+10:$width;
		$height	=	22;
        if ( $type!='gif' && function_exists('imagecreatetruecolor')) {
            $im = @imagecreatetruecolor($width,$height);
        }else {
            $im = @imagecreate($width,$height);
        }
		if(empty($rgb)) {
			$color = imagecolorallocate($im, 102, 104, 104);
		}else{
			$color = imagecolorallocate($im, $rgb[0], $rgb[1], $rgb[2]);
		}
        $backColor = imagecolorallocate($im, 255,255,255);    //背景色（随机）
		$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
        $pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));                 //点颜色

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        @imagestring($im, 5, 5, 3, $string, $color);
		if(!empty($disturb)) {
			// 添加干扰
			if($disturb=1 || $disturb=3) {
				for($i=0;$i<25;$i++){
					imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
				}
			}elseif($disturb=2 || $disturb=3){
				for($i=0;$i<10;$i++){
					imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$pointColor);
				}
			}
		}
        Image::output($im,$type,$filename);
	}

    /*
     +----------------------------------------------------------
     * 生成图像验证码
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $length  位数
     * @param string $mode  类型
     * @param string $type 图像格式
     * @param string $width  宽度
     * @param string $height  高度
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static function buildImageVerify($length=4,$mode=1,$type='png',$width=48,$height=22,$verifyName='verify')
    {
		import('@.ORG.String');
        $randval = String::rand_string($length,$mode);
        $_SESSION[$verifyName]= md5($randval);
        $width = ($length*10+10)>$width?$length*10+10:$width;
        if ( $type!='gif' && function_exists('imagecreatetruecolor')) {
            $im = @imagecreatetruecolor($width,$height);
        }else {
            $im = @imagecreate($width,$height);
        }
        $r = Array(225,255,255,223);
        $g = Array(225,236,237,255);
        $b = Array(225,236,166,125);
        $key = mt_rand(0,3);

        $backColor = imagecolorallocate($im, $r[$key],$g[$key],$b[$key]);    //背景色（随机）
		$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
        $pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));                 //点颜色

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        $stringColor = imagecolorallocate($im,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
		// 干扰
		for($i=0;$i<10;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
		}
		for($i=0;$i<25;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
		}
		for($i=0;$i<$length;$i++) {
			imagestring($im,5,$i*10+5,mt_rand(1,8),$randval{$i}, $stringColor);
		}
//        @imagestring($im, 5, 5, 3, $randval, $stringColor);
        Image::output($im,$type);
    }

	// 中文验证码
	static function GBVerify($length=4,$type='png',$width=180,$height=50,$fontface='simhei.ttf',$verifyName='verify') {
		$code	=	rand_string($length,4);
        $width = ($length*45)>$width?$length*45:$width;
		$_SESSION[$verifyName]= md5($code);
		$im=imagecreatetruecolor($width,$height);
		$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
		$bkcolor=imagecolorallocate($im,250,250,250);
		imagefill($im,0,0,$bkcolor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
		// 干扰
		for($i=0;$i<15;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
		}
		for($i=0;$i<255;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$fontcolor);
		}
		if(!is_file($fontface)) {
			$fontface = dirname(__FILE__)."/".$fontface;
		}
		for($i=0;$i<$length;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)); //这样保证随机出来的颜色较深。
			$codex= msubstr($code,$i,1);
			imagettftext($im,mt_rand(16,20),mt_rand(-60,60),40*$i+20,mt_rand(30,35),$fontcolor,$fontface,$codex);
		}
		Image::output($im,$type);
	}

    /*
     +----------------------------------------------------------
     * 把图像转换成字符显示
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $image  要显示的图像
     * @param string $type  图像类型，默认自动获取
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static function showASCIIImg($image,$string='',$type='')
    {
        $info  = Image::getImageInfo($image);
        if($info !== false) {
            $type = empty($type)?$info['type']:$type;
            unset($info);
            // 载入原图
            $createFun = 'ImageCreateFrom'.($type=='jpg'?'jpeg':$type);
            $im     = $createFun($image);
            $dx = imagesx($im);
            $dy = imagesy($im);
			$i	=	0;
            $out   =  '<span style="padding:0px;margin:0;line-height:100%;font-size:1px;">';
			set_time_limit(0);
            for($y = 0; $y < $dy; $y++) {
              for($x=0; $x < $dx; $x++) {
                  $col = imagecolorat($im, $x, $y);
                  $rgb = imagecolorsforindex($im,$col);
				  $str	 =	 empty($string)?'*':$string[$i++];
                  $out .= sprintf('<span style="margin:0px;color:#%02x%02x%02x">'.$str.'</span>',$rgb['red'],$rgb['green'],$rgb['blue']);
             }
             $out .= "<br>\n";
            }
            $out .=  '</span>';
            imagedestroy($im);
            return $out;
        }
        return false;
    }

    /*
     +----------------------------------------------------------
     * 生成高级图像验证码
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @param string $type 图像格式
     * @param string $width  宽度
     * @param string $height  高度
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static function showAdvVerify($type='png',$width=180,$height=40)
    {
		$rand	=	range('a','z');
		shuffle($rand);
		$verifyCode	=	array_slice($rand,0,10);
        $letter = implode(" ",$verifyCode);
        $_SESSION['verifyCode'] = $verifyCode;
        $im = imagecreate($width,$height);
        $r = array(225,255,255,223);
        $g = array(225,236,237,255);
        $b = array(225,236,166,125);
        $key = mt_rand(0,3);
        $backColor = imagecolorallocate($im, $r[$key],$g[$key],$b[$key]);
		$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
        imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        $numberColor = imagecolorallocate($im, 255,rand(0,100), rand(0,100));
        $stringColor = imagecolorallocate($im, rand(0,100), rand(0,100), 255);
		// 添加干扰
		/*
		for($i=0;$i<10;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
		}
		for($i=0;$i<255;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$fontcolor);
		}*/
        imagestring($im, 5, 5, 1, "0 1 2 3 4 5 6 7 8 9", $numberColor);
        imagestring($im, 5, 5, 20, $letter, $stringColor);
        Image::output($im,$type);
    }

    /*
     +----------------------------------------------------------
     * 生成UPC-A条形码
     +----------------------------------------------------------
     * @static
     +----------------------------------------------------------
     * @param string $type 图像格式
     * @param string $type 图像格式
     * @param string $lw  单元宽度
     * @param string $hi   条码高度
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static function UPCA($code,$type='png',$lw=2,$hi=100) {
        static $Lencode = array('0001101','0011001','0010011','0111101','0100011',
                         '0110001','0101111','0111011','0110111','0001011');
        static $Rencode = array('1110010','1100110','1101100','1000010','1011100',
                         '1001110','1010000','1000100','1001000','1110100');
        $ends = '101';
        $center = '01010';
        /* UPC-A Must be 11 digits, we compute the checksum. */
        if ( strlen($code) != 11 ) { die("UPC-A Must be 11 digits."); }
        /* Compute the EAN-13 Checksum digit */
        $ncode = '0'.$code;
        $even = 0; $odd = 0;
        for ($x=0;$x<12;$x++) {
          if ($x % 2) { $odd += $ncode[$x]; } else { $even += $ncode[$x]; }
        }
        $code.=(10 - (($odd * 3 + $even) % 10)) % 10;
        /* Create the bar encoding using a binary string */
        $bars=$ends;
        $bars.=$Lencode[$code[0]];
        for($x=1;$x<6;$x++) {
          $bars.=$Lencode[$code[$x]];
        }
        $bars.=$center;
        for($x=6;$x<12;$x++) {
          $bars.=$Rencode[$code[$x]];
        }
        $bars.=$ends;
        /* Generate the Barcode Image */
        if ( $type!='gif' && function_exists('imagecreatetruecolor')) {
            $im = imagecreatetruecolor($lw*95+30,$hi+30);
        }else {
            $im = imagecreate($lw*95+30,$hi+30);
        }
        $fg = ImageColorAllocate($im, 0, 0, 0);
        $bg = ImageColorAllocate($im, 255, 255, 255);
        ImageFilledRectangle($im, 0, 0, $lw*95+30, $hi+30, $bg);
        $shift=10;
        for ($x=0;$x<strlen($bars);$x++) {
          if (($x<10) || ($x>=45 && $x<50) || ($x >=85)) { $sh=10; } else { $sh=0; }
          if ($bars[$x] == '1') { $color = $fg; } else { $color = $bg; }
          ImageFilledRectangle($im, ($x*$lw)+15,5,($x+1)*$lw+14,$hi+5+$sh,$color);
        }
        /* Add the Human Readable Label */
        ImageString($im,4,5,$hi-5,$code[0],$fg);
        for ($x=0;$x<5;$x++) {
          ImageString($im,5,$lw*(13+$x*6)+15,$hi+5,$code[$x+1],$fg);
          ImageString($im,5,$lw*(53+$x*6)+15,$hi+5,$code[$x+6],$fg);
        }
        ImageString($im,4,$lw*95+17,$hi-5,$code[11],$fg);
        /* Output the Header and Content. */
        Image::output($im,$type);
    }


	// 生成邮箱图片
	static public function buildEmail($email,$rgb=array(),$filename='',$type='png') {
		$mail		=	explode('@',$email);
		$user		=	trim($mail[0]);
		$mail		=	strtolower(trim($mail[1]));
		$path		=	dirname(__FILE__).'/Mail/';
		if(is_file($path.$mail.'.png')) {
			$im	= imagecreatefrompng($path.$mail.'.png');
			$user_width = imagettfbbox(9, 0, dirname(__FILE__)."/Mail/tahoma.ttf", $user);
			$x_value = (200 - ($user_width[2] + 113));
			if(empty($rgb)) {
				$color = imagecolorallocate($im, 102, 104, 104);
			}else{
				$color = imagecolorallocate($im, $rgb[0], $rgb[1], $rgb[2]);
			}
			imagettftext($im, 9, 0, $x_value, 16, $color, dirname(__FILE__)."/Mail/tahoma.ttf", $user);
		}else{
			$user_width = imagettfbbox(9, 0, dirname(__FILE__)."/Mail/tahoma.ttf", $email);
			$width	=	$user_width[2]+15;
			$height	=	20;
			$im	=	imagecreate($width,20);
			$backColor = imagecolorallocate($im, 255,255,255);    //背景色（随机）
			$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
			$pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));                 //点颜色
			imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
			imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
			if(empty($rgb)) {
				$color = imagecolorallocate($im, 102, 104, 104);
			}else{
				$color = imagecolorallocate($im, $rgb[0], $rgb[1], $rgb[2]);
			}
			imagettftext($im, 9, 0, 5, 16, $color, dirname(__FILE__)."/Mail/tahoma.ttf", $email);
			for($i=0;$i<25;$i++){
				imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
			}
		}
		Image::output($im,$type,$filename);
	}
function get_radius($radius) {  
        // $radius：弧角图片的大小  
        $img        = imagecreatetruecolor($radius, $radius);  
        $bgcolor    = imagecolorallocate($img, 223, 223, 223);  
        $fgcolor    = imagecolorallocate($img, 0, 0, 0);  
        imagefill($img, 0, 0, $bgcolor);  
        // $radius,$radius：以图像的右下角开始画弧  
        // $radius*2, $radius*2：已宽度、高度画弧  
        // 180, 270：指定了角度的起始和结束点  
        // fgcolor：指定颜色  
        imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE);  
        // 设置颜色为透明  
        imagecolortransparent($img, $fgcolor);  
        return $img;  
    } 
    static function output($im,$type='png',$filename='')
    {
        header("Content-type: image/".$type);
        $ImageFun='image'.$type;
		if(empty($filename)) {
	        $ImageFun($im);
		}else{
	        $ImageFun($im,$filename);
		}
        imagedestroy($im);
    }

}//类定义结束
?>
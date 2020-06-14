<!DOCTYPE html>
<?php 
include_once('/jhs_config/function.php');
?>
<html>
	<head>
    <meta charset="gb2312">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$site_name?>-<?=$site_title?> - Powered by 聚合社</title>
    <meta name="keywords" content="<?=$site_keywords?>" />
    <meta name="description" content="<?=$site_describe?>" />
		<script> 
	var DEFAULT_VERSION = 8.0;  
    var ua = navigator.userAgent.toLowerCase();  
    var isIE = ua.indexOf("msie")>-1;  
    var safariVersion;  
    if(isIE){  
    safariVersion =  ua.match(/msie ([\d.]+)/)[1];  
    }  
    if(safariVersion <= DEFAULT_VERSION ){  
 alert("您的IE浏览器版本太低可能无法正常加载网页，请更换到IE9或支持极速模式的浏览器，谢谢您的配合！");
    }; 
  

</script>
		<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/default.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/animate.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/aos.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/header_common.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/index_main.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/common_contact.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/media.css" />
 			<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/util.css"> 
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/main.css">
		<script src="/templatecss/JuHeShe02/jquery-1.11.3.min.js"></script>
		<script src="/templatecss/JuHeShe02/aos.js"></script>
		<script src="/templatecss/JuHeShe02/xs.js"></script>
		<script src="/templatecss/JuHeShe02/common_js.js"></script>
		<script src="/templatecss/JuHeShe02/index_main.js"></script>
		
	</head>
	<body aos-easing="ease-out-back" aos-duration="1000" aos-delay="0">
		<!--头-->
     <header class="index_header">
			<!--顶部-->
			<?php include('head.php');?>
			<div class="center">
				<div class="banner">
					<div class="banner_left left">
						<div class="text1 animated bounceInLeft"><?=$bluewhite1?></div>
						<div class="text1_line animated bounceInLeft"></div>
						<p aos="fade-right" class="banner_p animated bounceInRight aos-init aos-animate"><?=$bluewhite2?></p>
						<p aos="fade-right" class="banner_p animated bounceInRight aos-init aos-animate"><?=$bluewhite3?></p>
					</div>
<div class="wrap-login100 p-l-50 p-r-50 p-t-50 p-b-50">
				<form action="/login_check.php" method="post" >
				
					<span class="login100-form-title p-b-30">登录</span>
					<input name="Token" type="hidden" value="<?=genToken()?>">
					<div class="wrap-input100 validate-input m-b-23" data-validate="请输入用户名">
						<span class="label-input100"></span>
						<input class="input100" type="text" name="username" placeholder="请输入用户名" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="请输入密码">
						<span class="label-input100"></span>
						<input class="input100" type="password" name="password" placeholder="请输入密码">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">登 录</button>
						</div>
					</div>
					<div class="flex-col-c p-t-25">
						<a href="/reg.php" class="txt2">立即注册</a>
					</div>
				</form>
				</div>
			</div>
					</div>
				</div>
			</div>
		</header>
		<div class="about">
			<div class="center">
				<div aos="zoom-in" class="about_main aos-init aos-animate">
					<span class="title_common about_title pingFang"><?=$bluewhite4?></span>
					<span class="about_line right"></span>
					<div class="about_txt">
						<p class="pingFang"><?=$bluewhite5?></p>
					</div>
					<a href="/reg.php" target="_blank" class="about_more pingFang">注册</a>
				</div>
			</div>
			<div class="about_right">
				<div class="about_rightMain">
					<img aos="fade-up-right" class="about_rightImg1 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightimg1.png" alt="" draggable="false" />
					<div class="about_rightCenter">
						<img aos="fade-down-left" class="rightCenter_com rightCenter_1 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter1.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_2 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter2.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_3 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter3.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_4 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter4.png" alt="" draggable="false" />
					</div>
					<img aos="fade-up-left" class="about_rightImg2 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightimg2.png" alt="" draggable="false" />
				</div>
			</div>
		</div>
		<!--自动发卡-流程-->
		<div aos="zoom-in" class="process aos-init aos-animate">
			<div class="center">
				<div class="process_main">
					<span class="title_common process_title pingFang animated slideInUp">成为<?=$site_name?>商户仅需6步</span>
					<span class="process_line animated zoomIn"></span>
					<span class="process_h4 pingFang animated slideInDown"><?=$site_name?>让你轻松做生意</span>
					<ul class="process_ul">
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_1.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">注册账户</span>
							<span class="process_txt2 pingFang">60秒快速注册</span>
						</li>
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_2.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">开通店铺</span>
							<span class="process_txt2 pingFang"><?=$site_name?>帮你开通专属店铺</span>
						</li>
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_3.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">发布商品</span>
							<span class="process_txt2 pingFang">轻松一键发布商品</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_5.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">平台审核</span>
							<span class="process_txt2 pingFang">审核通过，即时上架</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_4.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">处理订单</span>
							<span class="process_txt2 pingFang">完成订单货款自动入账</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_6.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">提现结算</span>
							<span class="process_txt2 pingFang">信誉无忧充分保障</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--品牌优势-->
		<div class="advantage" id="advantage">
			<div class="advantage_topBox">
				<div aos="fade-up-right" class="leftImg_common1 rightImg_common2 advantage_topL aos-init aos-animate"></div>
				<div class="center centerRe">
					<div aos="flip-left" class="advantage_topMain aos-init aos-animate">
						<span class="advantage_common advantage_title pingFang">品牌优势</span>
						<span class="advantage_line"></span>
						<span class="advantage_common advantage_txt pingFang">这就是<?=$site_name?>效率，一切都是为了你</span>
					</div>
				</div>
				<div aos="fade-up-left" class="rightImg_common1 leftImg_common2 advantage_topR aos-init aos-animate"></div>
			</div>
			<div class="center">
				<ul class="advantage_botMain">
					<li class="left">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite6?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite10?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite14?></p>
					</li>
					<li class="left li_margin">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite7?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite11?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite15?></p>
					</li>
					<li class="left li_margin">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite8?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite12?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite16?></p>
					</li>
					<li class="left">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite9?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite13?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite17?></p>
					</li>
				</ul>
			</div>
		</div>
		<!--联系我们-->
		<div class="contact_comBox contact_box" id="contact_box">
			<div class="contactUs_index contactUs">
				<div class="center">
					<p aos="zoom-out-down" class="contactUs_indexTitle contactUs_title pingFang aos-init aos-animate">联系我们</p>
					<p aos="zoom-out-down" class="contactUs_line aos-init aos-animate"></p>
					<ul aos="zoom-in-up" class="contactUs_main aos-init aos-animate">
						<li class="left contactUs_liMargin1">
							<span class="contactUs_icon contactUs_icon1"></span>
							<span class="contactUs_mainTit pingFang_bold">公司地址</span>
							<span class="contactUs_mainLine"></span>
							<span class="contactUs_mainTxt pingFang"><?=$address?></span>
							<span class="contactUs_mainBot"></span>
						</li>
						<li class="left contactUs_liMargin2">
							<span class="contactUs_icon contactUs_icon2"></span>
							<span class="contactUs_mainTit pingFang_bold">联系QQ</span>
							<span class="contactUs_mainLine"></span>
							
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$qq1?>&site=qq&menu=yes" target="_blank" class="contactUs_mainTxt pingFang"><?=$qq1?></a>
							<span class="contactUs_mainBot"></span>
						</li>
						<li class="left contactUs_liMargin1">
							<span class="contactUs_icon contactUs_icon3"></span>
							<span class="contactUs_mainTit pingFang_bold">电子邮箱</span>
							<span class="contactUs_mainLine"></span>
							<span class="contactUs_mainTxt pingFang"><?=$bluewhite18?></span>
							<span class="contactUs_mainBot"></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="contact_bot">
				<div aos="fade-up-right" class="leftImg_common1 leftImg_common2 contact_botL aos-init aos-animate"></div>
				<div class="center centerRe">
					<div aos="fade-left" class="contact_botMain pingFang aos-init aos-animate">
						<div class="contact_botMainTxt"><?=$bluewhite19?></div>
						<a href="/reg.php" class="contact_botMainBtn" style="float: left;">马上注册</a>
					</div>
				</div>
				<div aos="fade-up-left" class="rightImg_common1 rightImg_common2 contact_botR aos-init aos-animate"></div>
			</div>
		</div>
		<footer>
			<div class="footer_top">
			</div>
			<div class="footer_bottom pingFang"> <?= str_replace("\n","<p>",$site_copyright)?><?=$javascript?>
						</div>
						</footer>
	</body>
</html>

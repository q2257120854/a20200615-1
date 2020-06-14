<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MHC商城六月中旬上线</title>
		<meta name="keywords" content="手机,WAP版,超市百货,购物商城,商城网站,模板下载" />
		<meta name="description" content="手机WAP版超市百货购物商城网站模板下载。" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="/theme/default/images/favicon.png">
		<link href="/Public/home/css/amazeui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/home/css/style.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
		<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
		<link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>

	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
		<script src="/Public/home/js/jquery-1.10.2.min.js"></script>
		<script src="/Public/home/js/time.js"></script>
		<script src="/Public/home/js/popup.mini.js"></script>
	</head>
	<body>
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">MHC商城</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
    </header>
<div style="height: 49px;"></div>
<!--图片轮换-->
<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
  <ul class="am-slides">
  <?php if(is_array($banner_list)): foreach($banner_list as $key=>$vo): ?><li><img src="<?php echo ($vo['path']); ?>" /></li><?php endforeach; endif; ?>
  </ul>
</div>
<!--导航-->
 <ul class="sq-nav">
   	<li>
        <div class="am-gallery-item">
            <a href="<?php echo U('Index/Shop/jiameng');?>" class="">
              <img src="/Public/home/images/icon4.png" />
              <p>入驻商城</p>
            </a>
        </div>
      </li>
      <li>
        <div class="am-gallery-item">
            <a href="<?php echo U('Index/Shop/search');?>" class="">
              <img src="/Public/home/images/icon5.png" />
              <p>超市</p>
            </a>
        </div>
      </li>
      <li>
        <div class="am-gallery-item">
            <a href="<?php echo U('Index/Shop/qiandao');?>" class="">
              <img src="/Public/home/images/icon111.png" />
              <p>签到</p>
            </a>
        </div>
      </li>
      <li>
        <div class="am-gallery-item">
            <a href="<?php echo U('Index/Shop/dingdan');?>" class="">
              <img src="/Public/home/images/icon3.png" />
              <p>我的订单</p>
            </a>
        </div>
      </li>
  </ul>
   <ul class="sq-nav1">
      <li>
        <div class="am-gallery-item">
            <a href="<?php echo U('Index/Shai/index');?>" class="">
              <img src="/Public/home/images/yule.png" />
              <p>场内游戏</p>
            </a>
        </div>
      </li>
      <li>
        <div class="am-gallery-item">
            <a href="http://kx.pb2k.cn" class="">
              <img src="/Public/home/images/youxi.png" />
              <p>场外游戏</p>
            </a>
        </div>
      </li>

      
  </ul>
  <div class="h-line"></div>
  <!--不规则展示-->
  <div class="index-product">
  	<div class="index-pro-lf"><a href=""><img src="/Public/home/images/s1.png"/></a></div>
  	<div class="index-pro-lr"><a href=""><img src="/Public/home/images/s2.png"/></a></div>
  </div>
  <div class="product-bot">
  	<div class="product-bot-lf"><a href=""><img src="/Public/home/images/s3.png"/></a></div>
  	<div class="product-bot-lr">
  		<div class="top"><a href=""><img src="/Public/home/images/s4.png"/></a></div>
  		<div class="bot">
  			<div class="bot-lf"><a href=""><img src="/Public/home/images/s5.png"/></a></div>
  			<div class="bot-lr"><a href=""><img src="/Public/home/images/s6.png"/></a></div>
  		</div>
  	</div>
  </div>
  <!--不规则展示-->
  <div class="h-line"></div>
  <!-- 最新产品-->
<!--   <div class="sq-title">
 	<img src="/Public/home/images/ts.png" width="26"/>
 	六月中旬上线,敬请期待
  </div> -->
<!--   <ul data-am-widget="gallery" class="am-gallery pro-list am-avg-sm-2 am-avg-md-2 am-avg-lg-4 am-gallery-default"  >
	<?php if(is_array($goods)): foreach($goods as $key=>$v): ?><li>
        <div class="am-gallery-item">
            <a href="detail.html" class="">
              <img src="<?php echo ($v["gpic"]); ?>" />
                <h3 class="am-gallery-title"><?php echo ($v["gname"]); ?></h3>
                <div class="am-gallery-desc">币：<?php echo ($v["gprice"]); ?></div>
            </a>
        </div>
      </li><?php endforeach; endif; ?>
  </ul> -->
<!--签到-->
<!-- <div class="qd-box">
	<div class="popup-title">
			<span>签到成功</span>
			<div class="popup-close"><i class="iconfont">&#xe602</i></div>
	</div>
	<div class="dq-text">
		<img src="/Public/home/images/qiandao.png" width="40" />&nbsp; 您已连续签到3天
	</div>
</div> -->
<!--签到-->

 <!--底部-->
 <div style="height: 55px;"></div>
<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">

<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
<style>
	.footer ul li{
		width: 20%;
	}
</style>
	<div class="footer">
    <ul>
        <li><a href="<?php echo U('Index/Emoney/shouye');?>" class="block"><i class="iconfont">&#xe63a;</i>首页</a></li>
		<li><a href="<?php echo U('Index/Shop/shop');?>" class="block"><i class="iconfont">&#xe645;</i>购物商城</a></li>
		<li><a href="<?php echo U('Index/Shop/plist');?>" class="block"><i class="iconfont">&#xe604;</i>矿机商城</a></li>
		<li><a href="<?php echo U('Index/Emoney/index');?>" class="block"><i class="iconfont">&#xe608;</i>交易中心</a></li>
        <li><a href="<?php echo U('Index/Index/index');?>" class="block"><i class="iconfont">&#xe684;</i>个人中心</a></li>
    </ul>
</div>
	<!--底部结束-->
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>	

 
 
 
 <script type='text/javascript'>
	(function(){
		 new PopUp_api({el:'.index-qd',html:'.qd-box'});
	})()
</script>
 
<script src="/Public/home/js/jquery.min.js"></script>
<script src="/Public/home/js/amazeui.min.js"></script>
	</body>
</html>
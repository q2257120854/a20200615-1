<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title>个人中心</title>	
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/Public/gec/web/js/layer.js"></script>
	<link rel="stylesheet" href="/Public/gec/web/css/stylef.css"/>
	
	

</head>

<body>
<!--顶部开始-->
<header class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">兑换</span>

</header>
<div class="height40"></div>
<!--顶部结束-->
<div style="width:100%;">
	<h1 class="goods_title" style="text-align:center;font-size:1.2em;font-weight: bold;width:100%;padding:10px 0px"><?php echo ($product["title"]); ?></h1>
	<div class="tao hu_title"style="height:190px;width:100%;margin-top:10px">
	<span>商品详情：</span>
	<p style="width:90%;margin-left:5%"><?php echo ($product["content"]); ?> </p>

	</div>
	<form action="<?php echo U('/Index/Shop/buy');?>" method="post">
	<div style="margin-left:10px;padding:10px 0;margin:10px 0;text-align: center;width:100%">
			<input type="hidden" name="id" value="<?php echo ($id); ?>">
		<div class="pic">
			<input type="text" placeholder="请输入矿机激活码后再进行兑换" name="pin" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#2c3d75;padding-left: 5px;-webkit-appearance:none;" />
		</div>
	</div>
	<div class="goods_gm"style="width: 90%;margin-left: 5%;border-radius: 5px">
		<button type="submit" class="weui_btn weui_btn_warn weui_btn_disabled" style="background-color:#3660f0">立即兑换</abutton>
	</div>
	</form>
</div>
<script src="/Public/web/js/jquery-weui.min.js"></script>
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

</body>
</html>
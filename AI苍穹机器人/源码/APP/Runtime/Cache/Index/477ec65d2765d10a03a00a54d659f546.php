<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>超市</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="/theme/default/images/favicon.png">
		<link href="/Public/home/css/amazeui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/home/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/Public/home/css/check.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
		<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
		<link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>

	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">全部订单</span>
    </header>
	    <div style="height: 49px;"></div>
	    <ul class="order-style">
	    	<li class="current"><a href="<?php echo U('Index/Shop/dingdan');?>">全部</a></li>
	    	<li><a href="<?php echo U('Index/Shop/daifa');?>">待发货</a></li>
	    	<li><a href="<?php echo U('Index/Shop/daishou');?>">待收货</a></li>
	    	<li><a href="<?php echo U('Index/Shop/wancheng');?>">已完成</a></li>
	    </ul>
		<?php if(is_array($orders_info)): foreach($orders_info as $key=>$v): ?><div class="c-comment">
			<?php if($v['status'] == 0): ?><span class="c-comment-suc">待发货</span><?php endif; ?>
			<?php if($v['status'] == 1): ?><span class="c-comment-num">待收货&nbsp;<i>快递单号：<?php echo ($v["expressnum"]); ?>&nbsp;(<?php echo ($v["kuaidiname"]); ?>)</i></span><?php endif; ?>
			<?php if($v['status'] == 2): ?><span class="c-comment-num">已完成&nbsp;<i>快递已签收</i></span><?php endif; ?>
		</div>

		<div class="c-comment-list" style="border: 0;">
			<a href="">
			<p>应付MHC：<?php echo ($v["total"]); ?>     实付MHC：<span><?php echo ($v["total"]); ?></span></p>
			<p>订单编号：<?php echo ($v["onumber"]); ?></p>
			<p>下单时间：<?php echo ($v["otime"]); ?></p>
			<p>联系店长：<span><?php echo ($v["username"]); ?></span></p>
            </a>
		</div>

		<div class="c-com-btn">
			<?php if($v['status'] == 0): ?><a class="canelpay" onclick="return confirm('你确定要删除吗')" href="<?php echo U(GROUP_NAME .'/Shop/deldingdan',array('onumber'=>$v['onumber']));?>">取消订单</a><?php endif; ?>
			<?php if($v['status'] == 1): ?><a class="canelpay" onclick="return confirm('你确定已经收到货物了吗')" href="<?php echo U(GROUP_NAME .'/Shop/shouhuo',array('onumber'=>$v['onumber']));?>">确认收货</a><?php endif; ?>
			<?php if($v['status'] == 2): ?><a class="oncepay">订单已完成</a><?php endif; ?>
		</div>

		<div class="clear"></div><?php endforeach; endif; ?>

		
		  <!--底部-->
 <div style="height:55px;"></div>

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
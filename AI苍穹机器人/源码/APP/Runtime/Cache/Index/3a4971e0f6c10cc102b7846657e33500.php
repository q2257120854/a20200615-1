<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>正文</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<link rel="stylesheet" href="/public/wx/lib/weui.min.css">
	<link rel="stylesheet" href="/public/wx/css/jquery-weui.css">
	<link rel="stylesheet" href="/public/wx/css/reset.css">
	<link rel="stylesheet" href="/public/wx/css/box-flex.css">
	<link rel="stylesheet" href="/public/wx/css/style.css">
	<script src="/public/wx/lib/jquery-2.1.4.js"></script>
	<script src="/public/wx/js/adaptive.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		adaPtive(); //铺页面调用
		//页面加载时调用
		$(function() { direction(); });
		//用户变化屏幕方向时调用
		$(window).on('orientationchange', function(e) { direction(); });
		//调用adaptive
		function adaPtive(max) {
			window['adaptive'].desinWidth = 720;
			window['adaptive'].baseFont = 24;
			window['adaptive'].scaleType = 1;
			window['adaptive'].maxWidth = max;
			window['adaptive'].init();
		}
		//判断手机屏幕方向
		function direction() { if (window.orientation == 90 || window.orientation == -90) { adaPtive(320); return false; } else if (window.orientation == 0 || window.orientation == 180) { adaPtive(); return false; } }
	</script>
</head>

<body ontouchstart>
<div class="wx-header clearfix flex">
	<div class="wx-header-left">
		<a href="javascript:history.go(-1);">
			<i class="iconfont icon-zuo"></i>
		</a>
	</div>
	<h1 class="flex-1">资讯详情</h1>
</div>
<!--me-main -->
<div class="weui-msg art-main clearfix">
	<div class="art-cont clearfix">
		<div class="art-title">
			<h1><?php echo ($new["title"]); ?></h1>
			<p class="art-time">
				<?php echo (date("Y-m-d H:i:s",$new["addtime"])); ?>
			</p>
		</div>
		<div class="art-nl">
			<img src="<?php echo ($new["image"]); ?>" alt="">
			<p style="padding-top: .4rem;">
				<?php echo ($new["content"]); ?>
			</p>
		</div>
	</div>
	<!-- moreLink -->
	<div class="moreLink">
		<ul class="morelink-ul">
			<li><a href=""><img src="/public/wx/images/moreLink_msg.png" alt=""><p>发起群聊</p></a></li>
			<li><a href=""><img src="/public/wx/images/moreLink_add.png" alt=""><p>添加朋友</p></a></li>
			<li><a href=""><img src="/public/wx/images/moreLink_sys.png" alt=""><p>扫一扫</p></a></li>
			<li><a href=""><img src="/public/wx/images/moreLink_pay.png" alt=""><p>收付款</p></a></li>
		</ul>
	</div>
	<!-- moreLink -->
</div>
<!--me-main -->
<!--  weui-tabbar -->
<div class="weui-tabbar">
	<a href="<?php echo U('Index/new/index');?>" class="weui-tabbar__item  weui-bar__item--on">
		<!--   <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span> -->
		<div class="weui-tabbar__icon zx">
			<img src="/public/wx/images/tarbar_zx_on.png" alt="">
		</div>
		<p class="weui-tabbar__label">资讯</p>
	</a>
	<a href="<?php echo U('Index/Robot/pcontent',array('id'=>1));?>" class="weui-tabbar__item">
		<div class="weui-tabbar__icon rw">
			<img src="/public/wx/images/tarbar_rw.png" alt="">
		</div>
		<p class="weui-tabbar__label">租赁机器人</p>
	</a>
	<a href="<?php echo U('Index/task/index');?>" class="weui-tabbar__item">
		<div class="weui-tabbar__icon wj">
			<img src="/public/wx/images/tarbar_earth.png" alt="">
		</div>
		<p class="weui-tabbar__label">任务圈</p>
	</a>
	<a href="<?php echo U('Index/index/index');?>" class="weui-tabbar__item">
		<div class="weui-tabbar__icon me">
			<img src="/public/wx/images/tarbar_me.png" alt="">
		</div>
		<p class="weui-tabbar__label">我</p>
	</a>
</div>
<!--  weui-tabbar -->

<script src="/public/wx/lib/fastclick.js"></script>
<script>
	$(function() {
		FastClick.attach(document.body);
		$("#showMoreLink").on('click',function(){
			$(".moreLink").toggle("fast");
		})
	});
</script>
<script src="/public/wx/js/jquery-weui.js"></script>
</body>

</html>
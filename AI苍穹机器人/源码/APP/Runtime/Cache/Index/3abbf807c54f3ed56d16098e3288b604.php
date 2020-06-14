<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8" />
	<title>余额</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<link rel="stylesheet" href="/public/wx/wx/css/reset.css" />
	<link rel="stylesheet" href="/public/wx/wx/css/animate.css" />
	<link rel="stylesheet" href="/public/wx/wx/css/swiper-3.4.1.min.css" />
	<link rel="stylesheet" href="/public/wx/wx/css/layout.css" />
	
	<script src="/public/wx/wx/js/jquery-1.9.1.min.js"></script>
	<script src="/public/wx/wx/js/zepto.min.js"></script>
	<script src="/public/wx/wx/js/fontSize.js"></script>
	<script src="/public/wx/wx/js/swiper-3.4.1.min.js"></script>
	<script src="/public/wx/wx/js/wcPop/wcPop.js"></script>
	<script src="/public/wx/wx/js/wcKeyBoard.js"></script>
	
</head>
<body>
	
	<!-- <>微聊主容器 -->
	<div class="wechat__panel clearfix">
		<div class="wc__home-wrapper flexbox flex__direction-column">
			<!-- //顶部 -->
			<div class="wc__headerBar fixed">
				<div class="inner flexbox wc__theme01">
					<a class="back" href="javascript:;" onclick="history.back(-1);"></a>
					<h2 class="barTit flex1">余额</h2>
					<a class="barTxt" href="<?php echo U('Index/wallet/yuelog');?>">余额明细</a>
				</div>
			</div>

			<!-- //我的钱包页面 -->
			<div class="wc__ucinfoPanel">
				<!-- 零钱 -->
				<div class="wc__wallet-lingqian">
					<img class="icon" src="/public/wx/wx/img/wallet/icon__wallet-lingqian2.png" />
					<p>我的余额</p>
					<p class="num">￥<?php echo ($minfo["money"]); ?></p>
					<div class="wc__btns-panel">
						<a class="wc__btn-primary" href="<?php echo U('Index/wallet/onlinerecharge');?>">在线充值</a>
						<a class="wc__btn-default mt20" href="<?php echo U('Index/wallet/withdrawn');?>" id="J__wcDeposit">提现</a>
						<a class="wc__btn-primary" href="<?php echo U('Index/wallet/pinrecharge');?>">激活码充值</a>
					</div>
				</div>
			</div>

		</div>
	</div>


	
</body>
</html>
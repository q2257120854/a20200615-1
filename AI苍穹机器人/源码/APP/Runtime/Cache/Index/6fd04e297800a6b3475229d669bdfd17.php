<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8" />
	<title>银行卡</title>
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
	
</head>
<body class="bg-373a3f">
	
	<!-- <>微聊主容器 -->
	<div class="wechat__panel clearfix">
		<div class="wc__home-wrapper flexbox flex__direction-column">
			<!-- //顶部 -->
			<div class="wc__headerBar fixed">
				<div class="inner flexbox wc__theme01">
					<a class="back" href="javascript:;" onclick="history.back(-1);"></a>
					<h2 class="barTit flex1">银行卡</h2>
				</div>
			</div>

			<!-- //银行卡页面 -->
			<div class="wc__ucinfoPanel">
				<!-- 银行卡列表 -->
				<div class="wc__bankCard-list">
					<ul class="clearfix">
						<?php if(is_array($list)): foreach($list as $key=>$v): ?><li class="flexbox">
								<img class="bklogo" src="<?php echo ($v["images"]); ?>" />
								<div class="bkinfo flex1">
									<h2><?php echo ($v["name"]); ?></h2>
									<h5>储蓄卡/支付宝/微信</h5>
									<label class="bknum"><?php echo ($v["card"]); ?></label>
								</div>
							</li><?php endforeach; endif; ?>
					</ul>
				</div>
				<div class="wc__bankCard-add flexbox flex-alignc wc__material-cell wc__borB"><a href="<?php echo U('/index/wallet/addcard');?>">添加银行卡</a></div>
			</div>

		</div>
	</div>

	
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8" />
	<title>收付款</title>
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
<body class="bg-dccda0">
	
	<!-- <>微聊主容器 -->
	<div class="wechat__panel clearfix">
		<div class="wc__home-wrapper flexbox flex__direction-column">
			<!-- //顶部 -->
			<div class="wc__headerBar fixed">
				<div class="inner flexbox wc__theme01">
					<a class="back" href="javascript:;" onclick="history.back(-1);"></a>
					<h2 class="barTit flex1">收付款</h2>
				</div>
			</div>
			
			<!-- //收付款页面 -->
			<div class="wc__ucinfoPanel">
				<!-- 付款码 -->
				<div class="wc__receivables-qrcode">
					<div class="head flexbox flex-alignc">
						<label class="lbl flex1">收付款</label>
						<a class="intro wc__material-cell J__popIntro" href="javascript:;"></a>
					</div>
					<div class="cnt">
							<div class="pay-qrcode"><img class="qrcode" src="/public/wx/wx/img/wallet/qrcode-img.png" /></div>
							<div class="foot flexbox wc__material-cell">
								<img class="img-bank" src="/public/wx/wx/img/bank/bank_icbc.png" />
								<div class="flex1">
									<h2>中国银行储蓄卡</h2>
									<h5>优先使用该银行卡付款</h5>
								</div>
							</div>
					</div>
				</div>
				<!-- 收款列表 -->
				<div class="wc__receivables-list">
					<ul class="clearfix">
						<li>
							<div class="item flexbox flex-alignc wc__material-cell">
								<label class="lbl flex1">二维码收款</label>
							</div>
						</li>
						<li>
							<div class="item flexbox flex-alignc wc__material-cell">
								<label class="lbl flex1">打赏码</label>
							</div>
						</li>
						<li>
							<div class="item flexbox flex-alignc wc__material-cell">
								<label class="lbl flex1">转账到银行卡</label>
							</div>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>

	<script type="text/javascript">
		/** __公共函数 */
		$(function(){
			// ...
		});
		
		/** __自定函数 */
		$(function(){
			// 收付款说明
			$(".J__popIntro").on("click", function(){
				var introIdx = wcPop({
					id: 'receivableIntro',
					skin: 'androidSheet',

					btns: [
						{
							text: '使用说明',
							style: 'line-height: 50px;',
							onTap() {
								wcPop.close(introIdx);
							}
						},
						{
							text: '暂停使用',
							style: 'line-height: 50px;',
							onTap() {
								wcPop.close(introIdx);
							}
						}
					]
				});
			});
		});
	</script>
	
</body>
</html>
<?php
/*
 * 同步回调通知页面 (需商户在下单请求中传递Return_url)
 * 2019-03-06
 * http://www.799pay.com
 */
require_once 'config.php';
require_once 'lib/Ispay.class.php';
$Ispay = new ispayService($config['payId'], $config['payKey']);
//设置页头
header("Content-type: text/html; charset=utf-8");
//设置时区
date_default_timezone_set('Asia/Shanghai');
//接受通知返回的支付渠道
$Array['payChannel'] = $_POST['payChannel']; //(支付通道)
//接受通知返回的支付金额
$Array['Money'] = $_POST['Money'];  //(单位分)
//接受通知返回的订单号
$Array['orderNumber'] = $_POST['orderNumber'];  //(商户订单号)
//接受通知返回的附加数据
$Array['attachData'] = $_POST['attachData'];  //(商户自定义附加数据)
//接受通知返回的回调签名
$Array['callbackSign'] = $_POST['callbackSign'];  //(详情查看开发文档)
//回调签名校验
if(!$Ispay->callbackSignCheck($Array)){
	echo "签名失败";
	exit;
}
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>付款成功</title>
		<link rel="stylesheet" href="css/success.css">
		<style>
			* {
				font-family: "微软雅黑";
			}
		</style>
	</head>
	<body ontouchstart="">
		<div class="container js_container">
			<div class="page msg">
				<div class="bd">
					<div class="weui_msg" style="padding: 10px 0 0;">
						<div class="weui_icon_area"><i class="weui_icon_msg weui_icon_success_no_circle"></i></div>
						<div class="weui_text_area">
							<h2 class="weui_msg_title">付款成功</h2>
							<p class="weui_msg_desc">恭喜您，成功支付 <?php echo $Array['Money']/100; ?> 元</p>
						</div>
						<p class="weui_btn_area">
							<a href="javascript:;" onclick="off();" class="weui_btn weui_btn_warn">关闭窗口</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function off() {
				window.open("close.html", '_self');
				window.close();
			}
		</script>
	</body>
</html>
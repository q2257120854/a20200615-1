<?php
/*
 * 统一下单支付页面
 * 2019-03-06
 * http://www.799pay.com
 */
require_once 'config.php';
require_once 'lib/Ispay.class.php';
$Ispay = new ispayService($config['payId'], $config['payKey']);
//设置时区
date_default_timezone_set('Asia/Shanghai');
//商户编号
$Request['payId'] = $config['payId'];
//支付通道
if (isset($_GET['payChannel'])) {
	$Request['payChannel'] = $_GET['payChannel'];
} else {
	$Request['payChannel'] = "alipay_qr";
}
//订单标题
$Request['Subject'] = "测试订单";
//交易金额（单位分）
$Request['Money'] = 1000;
//随机生成订单号
$Request['orderNumber'] = date("YmdHis") . rand(100000, 999999);
//附加数据（没有可不填）
$Request['attachData'] = "test";
//异步通知地址
$Request['Notify_url'] = "http://www.799pay.com/";
//客户端同步跳转通知地址
$Request['Return_url'] = "http://www.799pay.com/";
//签名（加密算法详见开发文档）
$Request['Sign'] = $Ispay -> Sign($Request);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>趣玖快付接口测试</title>
		<link href="css/style.min.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
	</head>
	<body>
		<div class="header">
			<div class="container black">
				<div class="qrcode"></div>
			</div>
			<div class="container">
				<div class="nav">
					<a href="http://www.799pay.com/" class="logo">
						<img src="http://www.799pay.com/images/logo.png" height="50px">
					</a>
				</div>
			</div>
			<div class="container blue">
				<div class="title">
					2.0支付接口测试
				</div>
			</div>
		</div>
		<div class="content">
			<form name="form1" action="http://api.799pay.com/core/api/request/pay/" class="alipayform" method="post">
				<div class="element">
					<div class="etitle">
						商户编号(payId):
					</div>
					<div class="einput">
						<input type="text" name="payId" value="<?php echo $Request['payId']; ?>">
					</div>
				</div>
				<div class="element">
					<div class="etitle">
						支付通道(payChannel):
					</div>
					<select class="einput einputselect" id="payChannel" name="payChannel">
						<option value ="alipay_qr" <?php
						if (isset($_GET['payChannel'])) {
							$payChannel = $_GET['payChannel'];
						} else {
							$payChannel = 'alipay_qr';
						}
						if ($payChannel == 'alipay_qr') {echo 'selected = "selected"';
						}
						?>>支付宝扫码(alipay_qr)</option>
						<option value ="wxpay_qr" <?php
						if ($payChannel == 'wxpay_qr') {echo 'selected = "selected"';
						}
						?>>微信扫码(wxpay_qr)</option>
						<option value="alipay_h5" <?php
						if ($payChannel == 'alipay_h5') {echo 'selected = "selected"';
						}
						?>>支付宝H5(alipay_h5)</option>
						<option value="wxpay_h5" <?php
						if ($payChannel == 'wxpay_h5') {echo 'selected = "selected"';
						}
						?>>微信H5(wxpay_h5)</option>
						<option value="wxgzhpay" <?php
						if ($payChannel == 'wxgzhpay') {echo 'selected = "selected"';
						}
						?>>微信公众号(wxgzhpay)</option>
					</select>
				</div>
				<div class="element">
					<div class="etitle">
						订单标题(Subject):
					</div>
					<div class="einput">
						<input type="text" name="Subject" value="<?php echo $Request['Subject']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						金额(Money)
						<a style="color:#F00">
							单位分
						</a>
						:
					</div>
					<div class="einput">
						<input type="text" name="Money" value="<?php echo $Request['Money']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						订单号(orderNumber):
					</div>
					<div class="einput">
						<input type="text" name="orderNumber" value="<?php echo $Request['orderNumber']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						附加数据(attachData):
					</div>
					<div class="einput">
						<input type="text" name="attachData" value="<?php echo $Request['attachData']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						异步通知(Notify_url):
					</div>
					<div class="einput">
						<input type="text" name="Notify_url" value="<?php echo $Request['Notify_url']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						同步通知(Return_url):
					</div>
					<div class="einput">
						<input type="text" name="Return_url" value="<?php echo $Request['Return_url']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<div class="etitle">
						签名(Sign):
					</div>
					<div class="einput">
						<input type="text" name="Sign" value="<?php echo $Request['Sign']; ?>">
					</div>
					<br>
				</div>
				<div class="element">
					<input type="submit" class="alisubmit" value="确认支付">
				</div>
			</form>
		</div>
		<script>$("#payChannel").change(function() {
	if($("#payChannel").val() == 'alipay_qr') {
		location.href = "index.php?payChannel=alipay_qr";
	}
	if($("#payChannel").val() == 'wxpay_qr') {
		location.href = "index.php?payChannel=wxpay_qr";
	}
	if($("#payChannel").val() == 'alipay_h5') {
		location.href = "index.php?payChannel=alipay_h5";
	}
	if($("#payChannel").val() == 'wxpay_h5') {
		location.href = "index.php?payChannel=wxpay_h5";
	}
	if($("#payChannel").val() == 'wxgzhpay') {
		location.href = "index.php?payChannel=wxgzhpay";
	}
})</script>
	</body>
</html>
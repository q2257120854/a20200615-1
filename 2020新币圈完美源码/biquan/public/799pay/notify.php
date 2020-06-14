<?php
/*
 * 异步回调通知页面 (需商户在下单请求中传递Notify_url)
 * 2019-03-06
 * http://www.799pay.com
 */
require_once 'config.php';
require_once 'lib/Ispay.class.php';
$Ispay = new ispayService($config['payId'], $config['payKey']);
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
if($Ispay->callbackSignCheck($Array)){
	//回调请求校验  (有效预防商户泄露payKey导致回调签名遭到破解的另一种校验方式,弊端会影响回调的成功率,要求安全性建议开启。) 开启请将下方注释//去掉
	//if(!$Ispay->callbackRequestCheck($Array)){echo "fail!";exit;}
	//<--------------------------商户业务代码写在下方-------------------------->



	//<--------------------------商户业务代码写在上方-------------------------->
	//下方输出是告知安领服务器业务受理成功,请不要修改下方输出内容,否则会导致重复通知,趣玖服务器会在24小时内通知8次,输出SUCCESS则不再进行通知
	echo "SUCCESS";
}else{
	echo "callbackSign fail!";
	exit;
}
?>
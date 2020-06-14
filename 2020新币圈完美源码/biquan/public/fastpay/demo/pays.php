<?php
header('Content-Type: text/html; charset=utf-8');

//加载fastpay支付插件
if (!function_exists('get_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}

$uid=time();
$paydata=array();
$paydata['uid']=$uid;//支付用户id
$paydata['order_no']="";//订单号
$paydata['total_fee']=2;//金额
$paydata['param']="";//其他参数
$paydata['me_back_url']="http://www.baidu.com";//支付成功后跳转
$paydata['notify_url']="http://www.baidu.com";//支付成功后异步回调

$geturl=fastpay_order($paydata,"https");//获取支付链接

exit("<meta http-equiv='Refresh' content='0;URL={$geturl}'>");

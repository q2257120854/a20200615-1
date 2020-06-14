<?php
header('Content-Type: text/html; charset=utf-8');

//加载fastpay支付插件

if (!function_exists('get_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}

$sign=$_POST['sign_notify'];//获取签名2.07以下请使用$sign=$_POST['sign'];
$check_sign=notify_sign($_POST);
if($sign!=$check_sign){
  exit("签名失效");
//签名计算请查看怎么计算签名,或者下载我们的SDK查看
}

$uid         = $_POST['uid'];//支付用户
$total_fee   = $_POST['total_fee'];//支付金额
$pay_title   = $_POST['pay_title'];//标题
$sign        = $_POST['sign'];//签名
$order_no    = $_POST['order_no'];//订单号
$me_pri      = $_POST['me_pri'];//我们网站生成的金额,参与签名的,跟实际金额有差异

//更新数据库


echo "success";

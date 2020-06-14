<?php
header('Content-Type: text/html; charset=utf-8');




//加载fastpay文件
if (!function_exists('pay_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}


$_GET['back_url']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$userinfo=get_openid_info($_GET);
print_r($userinfo);

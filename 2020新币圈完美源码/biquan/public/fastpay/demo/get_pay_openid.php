<?php
header('Content-Type: text/html; charset=utf-8');


/*
获取pay_openid有跳转,如果再函数里面请保证跳转回来还能继续执行函数,
建议在页面首页获取保存数据库或者cookies

*/


//加载fastpay文件
if (!function_exists('pay_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}

$pay_openid=get_openid();

/*
正式环境下
$pay_openid=$_COOKIE['pay_openid'];
if(empty($pay_openid)){
 $pay_openid=get_openid();
$time_out=time()+3600;//一天后过期
setcookie("pay_openid", $pay_openid, $time_out,"/");
}

*/

//保存数据库或者cookies
echo $pay_openid;

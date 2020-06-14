<?php
header('Content-Type: text/html; charset=utf-8');


/*检测接口可以在浏览器中打开,微信端如果被封请使用模拟post请求*/

//加载fastpay文件
if (!function_exists('get_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}



/**----从我们后台列表里面检测获取可用域名--轮训自动切换-------**/
$fastpay_host=get_weixin_admin_checkurl();

echo $fastpay_host;

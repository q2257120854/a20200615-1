<?php
header('Content-Type: text/html; charset=utf-8');


/*检测接口可以在浏览器中打开,微信端如果被封请使用模拟post请求*/

//加载fastpay文件
if (!function_exists('pay_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}



//fastpay检测域名是否被拦截【POST方法】
$weixin_url=array();
$weixin_url['url']="http://www.qq.com";//需要检测的域名
$fast_res=get_weixin_checkurl($weixin_url);//
$fast_res=json_decode($fast_res,true);
print_r($fast_res);




//fastpay检测域名是否被拦截【GET方法】
$api_url="http://pay.39uh.cn/code_checkurl.php";//请求的url
$check_url="http://www.baidu.com";//检测的域名或者url
$sign=md5(FAST_APPKEY.SECRET_KEY.$check_url);//签名计算

echo "<br><br><h2>GET请求连接</h2>";
echo $api_url."?appkey=".FAST_APPKEY."&sign=".$sign."&url=".urlencode($check_url);

<?php
header('Content-Type: text/html; charset=utf-8');


/*检测接口可以在浏览器中打开,微信端如果被封请使用模拟post请求*/


//加载fastpay文件
if (!function_exists('pay_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}


//fastpay获取用户信息
//此接口需要联系客服开通
$weixin_url=array();
$weixin_url['title']="游戏平台";//平台名称
$weixin_url['uid']=18;//代理退款id
$weixin_url['url']="http://hb.baidu.cn/?tuid=128&index=c";//代理二维码连接
$fast_res=get_weixin_url($weixin_url);//
$fast_res=json_decode($fast_res,true);




echo "<img src='".$fast_res['qrdata']."'>";



echo "<pre>";

print_r($fast_res);

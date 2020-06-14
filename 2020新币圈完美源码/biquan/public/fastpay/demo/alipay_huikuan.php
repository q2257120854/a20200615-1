<?php
header('Content-Type: text/html; charset=utf-8');

//加载fastpay支付插件
if (!function_exists('get_openid')) {
    require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}


$data=array();
$data['payee_account']="13877777777"; //支付宝账号
$data['amount']=1;//价格
$data['billno']=md5(time() . mt_rand(1, 1000000));
$data['payer_show_name']="支付宝xx平台给你汇款"; //付款方昵称
$data['uid']=154;//汇款用户id,你网站的用户id
$data['desc']=PAY_DESC."uid=154";//支付备注信息
$res=fast_pay_alipay($data);
$res=json_decode($res, true);
if ($res['result_code']=='SUCCESS') {
    print_r($res);
    echo "汇款成功";
//下面你可以更新你会员的金额
} else {
    print_r($res);
}

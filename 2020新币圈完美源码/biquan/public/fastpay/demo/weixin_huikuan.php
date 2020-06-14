<?php
header('Content-Type: text/html; charset=utf-8');

//加载fastpay支付插件

if (!function_exists('get_openid')) {
require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}


/*

//$pay_openid 请看文档怎么获取$pay_openid可以保存cookies

$pay_openid=$_COOKIE['pay_openid'];
if(empty($pay_openid)){
 $pay_openid=get_openid();
$time_out=time()+3600;//一天后过期
setcookie("pay_openid", $pay_openid, $time_out,"/");
}


*/




$data=array();
$data['openid']=$pay_openid; //这个是第一步获取的openid
$data['amount']=2;//价格
$data['billno']=md5(time() . mt_rand(1,1000000));
$data['uid']=2;//汇款用户id,你网站的用户id
$data['desc']=PAY_DESC."uid=2";//支付备注信息
$res=fast_pay($data);
$res=json_decode($res,true);
if($res['result_code']=='SUCCESS'){
  print_r($res);
  echo "汇款成功";
  //下面你可以更新你会员的金额

}else{
  print_r($res);


}

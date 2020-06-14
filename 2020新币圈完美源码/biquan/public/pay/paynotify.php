<?php
/**
 * ---------------------通知异步回调接收页-------------------------------
 * 
 * 此页就是您之前传给的notify_url页的网址
 * 支付成功，平台会根据您之前传入的网址，回调此页URL，post回参数
 * 
 * --------------------------------------------------------------
 */
// if(getenv('REMOTE_ADDR') != "112.3.25.189") {
	$mid = $_GET["mid"];
	$pay_id = $_GET["payId"];
	
	$type = $_GET["type"];
	$price = $_GET["price"];
	$really_price = $_GET["reallyPrice"];
    $key = $_GET["sign"];
$param = $_GET["param"];
$p=explode(" ", $param);
    //校验传入的参数是否格式正确，略

    $token = "http://pay.liushahua.cn/login?off=365";
    
    $temps = md5($mid .$pay_id . $param . $type . $price . $really_price .$token);

    if ($temps != $key){
        echo "error";
    }else{
        //校验key成功，是自己人。执行自己的业务逻辑：加余额，订单付款成功，装备购买成功等等。
		$db = new PDO('mysql:host=127.0.0.1;dbname=xg', 'xg', 'xg');
	$str="update qz_user set point=point+".$p[1]." where id='".$p[0]."'";
	$str1="update qz_history set status=1 where out_trade_no='".$pay_id."'";
	
	//echo $str;
	

    $db->query($str);
	 $db->query($str1);
	
	
   echo "success";
    
}
// else{
//	 echo "禁止提交";
// }
?>
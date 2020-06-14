<?php
require_once("codepay_config.php"); //导入配置文件
ksort($_POST); //排序post参数
reset($_POST); //内部指针指向数组中的第一个元素
$codepay_key=$codepay_config['key']; //这是您的密钥

$sign = '';//初始化
foreach ($_POST AS $key => $val) { //遍历POST参数
  if ($val == '' || $key == 'sign') continue; //跳过这些不签名
  if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
  $sign .= "$key=$val"; //拼接为url参数形式
}
if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) { //不合法的数据
  exit('fail');  //返回失败 继续补单
} else { //合法的数据
  //业务处理
  	$param = $_POST['param']; //自定义参数 原封返回 您创建订单提交的自定义参数
  	$d = explode('--',$_POST['param']);
    $name = $d[1];
    $d = explode(':',$d[0]);
    $d = explode('|',$d[1]);
  	$sendUrl = 'http://cmscs1.jc3c.cn/index/pay/createmoney.html';
  	if($_POST['type']==1){
    	$type = '支付宝';
    }
  	if($_POST['type']==2){
    	$type = 'QQ支付';
    }
  	if($_POST['type']==3){
    	$type = '微信支付';
    }
  	$smsConf = array(
		'outtrade'   => $_POST['pay_id'],
		'trade'    => $_POST['pay_no'],
		'type'    => $type,
		'money'    => (float)$_POST['price'],
		'trade_status'    => 'TRADE_SUCCESS',
		'name' =>$_POST['param'],
		'type_id'=>(int)$d[0],
		'uid'=>(int)$d[1],
	);
  	$content = juhecurl($sendUrl,$smsConf,1); //请求
  
  
	exit('success');
}

function juhecurl($url,$params=false,$ispost=0){
  $httpInfo = array();
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
  curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
  curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
  if( $ispost )
  {
    curl_setopt( $ch , CURLOPT_POST , true );
    curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
    curl_setopt( $ch , CURLOPT_URL , $url );
  }
  else
  {
    if($params){
      curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
    }else{
      curl_setopt( $ch , CURLOPT_URL , $url);
    }
  }
  $response = curl_exec( $ch );
  if ($response === FALSE) {
    //echo "cURL Error: " . curl_error($ch);
    return false;
  }
  $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
  $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
  curl_close( $ch );
  return $response;
}
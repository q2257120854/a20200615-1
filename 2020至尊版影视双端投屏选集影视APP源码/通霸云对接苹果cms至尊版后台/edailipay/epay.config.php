<?php
/* *
 * 配置文件
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//商户ID
/*

*/
error_reporting(E_ERROR); 
$databases = include_once("../application/database.php");
$link = mysqli_connect(
    $databases['hostname'],  /* The host to connect to 连接MySQL地址 */
    $databases['username'],      /* The user to connect as 连接MySQL用户名 */
   $databases['password'],  /* The password to use 连接MySQL密码 */
   $databases['database']);    /* The default database to query 连接数据库名称*/ 
	$d = explode('--',$_GET['name']);
   $d = explode(':',$d[0]);
   $d = explode('|',$d[1]);
$sql="select * from ap_user where id =$d[0] limit 1 ";

 $result=mysqli_query($link,$sql);
 $a = array();
 while ($row = mysqli_fetch_assoc($result))
  { 

     $a = $row;
  } 
   
   $shanghu = array();
  $sql="select * from ap_shezi where uid ={$a['id']} ";
   $result=mysqli_query($link,$sql);
 while ($row = mysqli_fetch_assoc($result))
  { 
	$shanghu = $row; 
  }
  if(!$shanghu){
	  $sql="select * from ap_shezi where uid ={$a['parentid']} ";
	   $result=mysqli_query($link,$sql);
	 while ($row = mysqli_fetch_assoc($result))
	  { 
		$shanghu = $row; 
	  }
  }
  if(!$shanghu){
	  $sql="select * from ap_shezi where id =1 ";
	   $result=mysqli_query($link,$sql);
	 while ($row = mysqli_fetch_assoc($result))
	  { 
		$shanghu = $row; 
	  }
  } 
  
mysqli_close($link); 
$alipay_config['partner']		= $shanghu['partner'];//'1071';//商户id

//商户KEY
$alipay_config['key']			= $shanghu ['key'];;//'4G737O2gZ62P6g3d4x9873G87S7xX739';//商户key


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

//支付API地址
$alipay_config['apiurl']    = $shanghu['apiurl'];//'http://pay.6nb.cc//'; //网关无需改动
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 微软雅黑,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size:14px;cursor:default; line-height:240%;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<body>
<?php
include_once('jhs_config/conn.php');
include_once('jhs_config/520sfconn.php');
include_once('jhs_config/config.php');
$error=$_REQUEST['error'];

function ysk_error_msg($var){
switch ($var) { 
case   "401": 
echo   "您好！您的网站已经到期，很抱歉,您的网站因到期系统自动关闭! 为了不影响你正常使用,请尽快继费! 如果有其他疑问,您联系我们的客服,敬请见谅！"; 
break; 
case   "402": 
echo   "操作失败！你不可以在3个小时内重复注册！"; 
break; 
case   "403": 
echo   "操作失败！您的注册信息重复了！"; 
break; 
case   "404": 
echo   "操作失败！验证信息不正确！"; 
break; 
case   "409": 
echo   $Exp_sup_why; 
break; 
case   "ok": 
echo   "恭喜您，激活成功！"; 
break; 

default:
echo   "对不起，非法操作！"; 
}
}
?>
<div class="ip-attack">
<dl>
<dt><h1><?=ysk_error_msg($error)?></h1></dt>
<dt><a href="/">返回首页</a></dt>
</dl>
</div>
</body>
</Html>
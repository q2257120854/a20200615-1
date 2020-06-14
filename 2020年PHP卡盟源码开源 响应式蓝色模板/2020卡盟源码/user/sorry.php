<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
$err=$_REQUEST['err'];
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="/user/css/common.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="right">
<div class="noright">
<?php if($yx_us['kuan']<0 ){?>
很抱歉，由于您的余额不足请充值后才能操作!。<br />
<?php }elseif ($yx_us['frozen_kuan']<$yx_us['min_amount']){?>
很抱歉，由于您的冻结押金不足标准，请充值后才能操作!。<br />
<?php }elseif($err=="1"){?>
很抱歉，该编号已经被申请了!<br />
<?php }elseif($err=="2"){?>
很抱歉，您的余额不足请充值后重新操作!<br />
<?php }elseif($err=="3"){?>
很抱歉，金额不正确，请重新操作!<br />
<?php }else{?>
很抱歉，您没有该页面的使用权限!。<br />
<?php } ?>
<a href="javascript:" onClick="history.go(-1);"><< 返回上一页</a>
</div>
</div>
</body>
</Html>
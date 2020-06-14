<?php
//echo '聚合社卡盟系统 www.juheshe.cn Se7en QQ:94170844  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$ycprice=preg_match("/^\d*$/",(int)$yx_us['kuan']);

if ($yx_us['frozen_kuan']<$yx_us['min_amount']){
header('location:/user/sorry.php');
exit();
}elseif ($ycprice==0){
header('location:/user/sorry.php?err=2');
exit();
}elseif ($yx_us['kuan']<0){
header('location:/user/sorry.php');
exit();
}
?>

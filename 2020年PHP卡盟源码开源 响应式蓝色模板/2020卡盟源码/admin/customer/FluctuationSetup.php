<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$Customer1=strip_tags($_POST['Customer1']);
$Customer2=strip_tags($_POST['Customer2']);
$online=strip_tags($_POST['online']);
if ($Action=="save"){
if ($Customer1==$Customer2){
echo "<script language=\"javascript\">alert('不能绑定自己呀！');history.go(-1);</script>";
exit();
}
if   ($online=='1') {  /////////绑定账户
$sql1=mysql_query("select * from members where number='$Customer2'",$conn1);
$agent=mysql_fetch_array($sql1);
if ($agent){
$sql2=mysql_query("select * from members where number='$Customer1'",$conn1);
$user=mysql_fetch_array($sql2);
if ($user){
if ($agent['level']<$user['level']) {
echo "<script language=\"javascript\">alert('操作失败！上级比下级等级低');history.go(-1);</script>";
exit();
}
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$Customer1.'" 的上级代理设置为 "'.$Customer2.'"');
mysql_query("update members set xlevel=xlevel+1 where number='$Customer2'",$conn1); 
mysql_query("update members set agent='$Customer2' where number='$Customer1'",$conn1); 
echo "<script>alert('绑定成功!');;self.location=document.referrer;</script>";
}else{
echo "<script language=\"javascript\">alert('没有找到该下级编号！');history.go(-1);</script>";
exit();	
}
}else{
echo "<script language=\"javascript\">alert('没有找到该上级编号！');history.go(-1);</script>";
exit();
}
}elseif($online=='0'){
$sql1=mysql_query("select * from members where number='$Customer1'",$conn1);
$agent=mysql_fetch_array($sql1);
if($agent){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$Customer1.'" 的上级代理 "'.$agent['agent'].'" 取消了绑定');
mysql_query("update members set xlevel=xlevel-1 where number='$agent[agent]'",$conn1); 
mysql_query("update members set agent='' where number='$Customer1'",$conn1); 
echo "<script>alert('解除成功!');;self.location=document.referrer;</script>";
exit();	
}else{
echo "<script language=\"javascript\">alert('没有找到该下级编号！');history.go(-1);</script>";
exit();
}
}
}



?>
<?php if ($Action==""){?>
<form action="?Action=save" method="post">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
下级客户编号：</td>
<td class="left">
<input name="Customer1" type="text" id="Customer1" style="width:250px;" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
上级客户编号：</td>
<td class="left">
<div class="td_left2">
<input name="Customer2" type="text" maxlength="25" id="Customer2" /></div>
<span class="zs">(取消绑定可以不输入上级编号)</span>
</td>
</tr>
<tr>
<td class="td_left">
操作类型：</td>
<td class="left">
<table id="RadioButtonList1" border="0">
<tr>
<td><input id="online" type="radio" name="online" value="1" checked="checked" />绑定</td><td>    <input id="online" type="radio" name="online" value="0" />取消绑定</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="Submit" value="确认操作" id="Submit" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
////////锁定用户或者开放
if ($Action=="locks") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==1){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的登录状态关闭了');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的登录状态开启了');
}

mysql_query("update members set locks='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
exit();
}
////////IP绑定
if ($Action=="power1") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的IP绑定状态关闭了');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的IP绑定状态开启了');
}

mysql_query("update members set power1='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
}

////////密保卡
if ($Action=="power2") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的密保卡状态关闭了');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的密保卡状态开启了');
}

mysql_query("update members set power2='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
}
////////页面登录
if ($Action=="power3") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==1){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的页面登录状态关闭了');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的页面登录状态开启了');
}

mysql_query("update members set power3='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
}

////////多乐云令
if ($Action=="power4") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的多乐云令状态关闭了');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$back['number'].'" 的多乐云令状态开启了');
}
mysql_query("update members set power4='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
}
////////重置用户密码
if ($Action=="password") {
$password=rand(100000,999999);
$passwords=md5($password);
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$_REQUEST['sid'].'" 的登录密码重置为 "'.$password.'"');
mysql_query("update members set password='$passwords' where number='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('客户编号 $_REQUEST[sid] 登录密码重置成功，新密码为$password');;self.location=document.referrer;</script>";
exit();
}

if ($Action=="passwords") {
$passwords=rand(100000,999999);
$password=md5($passwords);
ysk_date_log(2,$_SESSION['ysk_username'],'将 "'.$_REQUEST['sid'].'" 的交易密码重置为 "'.$passwords.'"');
mysql_query("update members set passwords='$password' where number='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('客户编号 $_REQUEST[sid] 交易密码重置成功，新密码为$passwords');;self.location=document.referrer;</script>";
exit();
}

?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="security.php">安全管理</a></li>
</ul>
</div>

<?php if ($Action=="List" or $Action==""){?>
<form name="add" method="post" action="security.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
<option value="username">客户名称</option>
</select></td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="11%" class="table_top">编号</td>
<td width="10%" class="table_top">客户名</td>
<td width="7%" class="table_top">状态</td>
<td width="40%" class="table_top">安全绑定服务</td>
<td width="17%" class="table_top">密码重置</td>
<td width="15%" class="table_top">登录方式</td>
</tr>
<?php

$keyword=strip_tags($_POST['keyword']);
$keywords=strip_tags($_POST['keywords']);
$search="where 1=1  "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `members`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from members  $search   order by id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){?>
<tr>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td>
<?php if($row['locks']=='0'){?>
<a href="?Action=locks&id=1&sid=<?=$row['id']?>" class="a open"></a>
<?php }else{?>
<a href="?Action=locks&id=0&sid=<?=$row['id']?>" class="a open close"></a>
<?php }?>
</td>
<td>
IP绑定：

<?php if($row['power1']=='0'){?>
<a href="?Action=power1&id=1&sid=<?=$row['id']?>">未用</a>
<?php }else{?>
<a href="?Action=power1&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">启用</span></a>
<?php }?>

聚合令：

<?php if($row['power4']=='0'){?>
<a href="?Action=power4&id=1&sid=<?=$row['id']?>">未用</a>
<?php }else{?>
<a href="?Action=power4&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">启用</span></a>
<?php }?>

密保卡：
<?php if($row['power2']=='0'){?>
<a href="?Action=power2&id=1&sid=<?=$row['id']?>">未用</a>
<?php }else{?>
<a href="?Action=power2&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">启用</span></a>
<?php }?>

</td>
<td>
<a onclick="if (confirm('确认重置：<?=$row['number']?> 客户的登录密码？')) {return true;} else {return false;};" href="?Action=password&sid=<?=$row['number']?>">登录密码</a>
<a onclick="if (confirm('确认重置：<?=$row['number']?> 客户的交易密码？')) {return true;} else {return false;};" href="?Action=passwords&sid=<?=$row['number']?>">交易密码</a>
</td>
<td>
页面：
<?php if($row['power3']=='0'){?>
<a href="?Action=power3&id=1&sid=<?=$row['id']?>"><span style="color:#006ab8">允许</span></a>
<?php }else{?>
<a href="?Action=power3&id=0&sid=<?=$row['id']?>">禁止</a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>        </td> 
</tr>
</table>
</form>
<?php }?>
</body>
</Html>
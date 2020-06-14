<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>

<div class="Menubox" >
<ul>
<li <?php if ($_REQUEST['y']=='')  {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php">批量禁用</a></li>
<li <?php if ($_REQUEST['y']=='1') {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php?y=1">批量扣款</a></li>
<li <?php if ($_REQUEST['y']=='2') {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php?y=2">批量删除</a></li>
</ul>
</div>
<div style="padding:10px 0px;">

<?php if ($_REQUEST['y']=='')  {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.Login_type.value)) {
document.userinfo.Login_type.focus();
alert("对不起，登录类型不能为空！");
return false;
}   

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("对不起，余额类型不能为空！");
return false;
}  


}

function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</SCRIPT>
<form action="?Action=save1" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
选择登录类型：</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">选择登录类型</option>
<option value="0">从未登录过平台的</option>
<option value="1">超过一个月未登录平台的</option>
<option value="2">超过三个月未登录平台的</option>
<option value="3">超过六个月未登录平台的</option>
<option value="4">超过一年未登录平台的</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
选择余额类型：</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">选择余额类型</option>
<option value="0">余额为0元的</option>
<option value="1">余额为大于0小于1元的</option>
<option value="2">余额为大于0小于5元的</option>
<option value="3">余额为大于0小于10元的</option>
<option value="4">余额为大于0小于50元的</option>
<option value="5">余额为大于0小于100元的</option>

</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
选择客户类型：</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">选择客户类型</option>
<option value="0">批发平台客户(含一卡通客户)</option>
<option value="2">批发平台客户(不含一卡通客户)</option>
<option value="1">零售平台客户</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="确认禁用" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>

<?php if ($_REQUEST['y']=='1') {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("对不起，余额类型不能为空！");
return false;
}  

if(checkspace(document.userinfo.customer_type.value)) {
document.userinfo.customer_type.focus();
alert("对不起，客户类型不能为空！");
return false;
}  



}

function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</SCRIPT>
<form action="?Action=save2" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
选择余额类型：</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">选择余额类型</option>
<option value="0">余额为0元的</option>
<option value="1">余额为大于0小于1元的</option>
<option value="2">余额为大于0小于5元的</option>
<option value="3">余额为大于0小于10元的</option>
<option value="4">余额为大于0小于50元的</option>
<option value="5">余额为大于0小于100元的</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
账户状态类型：</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">账户被禁用</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
选择客户类型：</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">选择客户类型</option>
<option value="0">批发平台客户</option>
<option value="1">零售平台客户</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="确认扣款" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>


<?php if ($_REQUEST['y']=='2') {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("对不起，注册时间不能为空！");
return false;
}  

if(checkspace(document.userinfo.customer_type.value)) {
document.userinfo.customer_type.focus();
alert("对不起，客户类型不能为空！");
return false;
}  



}

function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</SCRIPT>
<form action="?Action=save3" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
选择注册时间：</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">选择注册时间</option>
<option value="0">一个星期前</option>
<option value="1">一个月前</option>
<option value="2">三个月前</option>
<option value="3">六个月前</option>
<option value="4">一年前</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
账户状态类型：</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">账户被禁用，且余额为0的</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
选择客户类型：</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">选择客户类型</option>
<option value="0">批发平台客户</option>
<option value="1">零售平台客户</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="确认扣款" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>

</div>
<?php }elseif($Action=="save1"){  
$Login_type=$_REQUEST['Login_type'];       #######登录类型
$balance_type=$_REQUEST['balance_type'];   #######余额类型
$customer_type=$_REQUEST['customer_type']; #######客户类型
$yu1=strtotime('-1 month', time());              // 1个月
$yu2=strtotime('-3 month', time());              // 3个月
$yu3=strtotime('-6 month', time());              // 6个月
$yu4=strtotime('-12 month', time());             // 12个月
$search="where 1=1  "; 

###############登录类型不为空
if ($Login_type!='' and $Login_type=='0') $search.=" and logins='0' "; 
if ($Login_type!='' and $Login_type=='1') $search.=" and lost_time<=$yu1"; 
if ($Login_type!='' and $Login_type=='2') $search.=" and lost_time<=$yu2"; 
if ($Login_type!='' and $Login_type=='3') $search.=" and lost_time<=$yu3"; 
if ($Login_type!='' and $Login_type=='4') $search.=" and lost_time<=$yu4"; 

###############余额类型不为空

if ($balance_type!='' and $balance_type=='0') $search.=" and kuan=0 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and kuan>=0 and kuan<1 "; 
if ($balance_type!='' and $balance_type=='2') $search.=" and kuan>=0 and kuan<5 "; 
if ($balance_type!='' and $balance_type=='3') $search.=" and kuan>=0 and kuan<10 "; 
if ($balance_type!='' and $balance_type=='4') $search.=" and kuan>=0 and kuan<50 "; 
if ($balance_type!='' and $balance_type=='5') $search.=" and kuan>=0 and kuan<100 "; 



$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$godo=mysql_query("update members set locks='1' where id='$pro_row[id]'",$conn1); 
}
}
echo "<script>alert('处理成功，共影响 $aa 条数据!');;self.location=document.referrer;</script>";
?>

<?php }elseif($Action=="save2"){  
$Login_type=$_REQUEST['Login_type'];       #######登录类型
$balance_type=$_REQUEST['balance_type'];   #######余额类型
$customer_type=$_REQUEST['customer_type']; #######客户类型
$search="where 1=1  and locks=1 "; 


###############余额类型不为空
if ($balance_type!='' and $balance_type=='0') $search.=" and kuan=0 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and kuan>=0 and kuan<1 "; 
if ($balance_type!='' and $balance_type=='2') $search.=" and kuan>=0 and kuan<5 "; 
if ($balance_type!='' and $balance_type=='3') $search.=" and kuan>=0 and kuan<10 "; 
if ($balance_type!='' and $balance_type=='4') $search.=" and kuan>=0 and kuan<50 "; 
if ($balance_type!='' and $balance_type=='5') $search.=" and kuan>=0 and kuan<100 "; 



$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$godo=mysql_query("update members set kuan='0' where id='$pro_row[id]'",$conn1); 

}
}
echo "<script>alert('处理成功，共影响 $aa 条数据!');;self.location=document.referrer;</script>";
?>

<?php }elseif($Action=="save3"){  
$Login_type=$_REQUEST['Login_type'];       #######登录类型
$balance_type=$_REQUEST['balance_type'];   #######余额类型
$customer_type=$_REQUEST['customer_type']; #######客户类型
$yu1=strtotime('-1 week', time());              // 1个月
$yu2=strtotime('-1 month', time());              // 3个月
$yu3=strtotime('-3 month', time());              // 6个月
$yu4=strtotime('-6 month', time());             // 12个月
$yu5=strtotime('-12 month', time());             // 12个月
$search="where 1=1 and logins=1 and kuan=0  "; 

###############登录类型不为空
if ($balance_type!='' and $balance_type=='0') $search.=" and time>=$yu1 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and time>=$yu2"; 
if ($balance_type!='' and $balance_type=='2') $search.=" and time>=$yu3"; 
if ($balance_type!='' and $balance_type=='3') $search.=" and time>=$yu4"; 
if ($balance_type!='' and $balance_type=='4') $search.=" and time>=$yu5"; 

$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$sql="delete from members where id ='$pro_row[id]'";
mysql_query($sql,$conn1);

}
}
echo "<script>alert('处理成功，共影响 $aa 条数据!');;self.location=document.referrer;</script>";

}
?>
</body>
</Html>
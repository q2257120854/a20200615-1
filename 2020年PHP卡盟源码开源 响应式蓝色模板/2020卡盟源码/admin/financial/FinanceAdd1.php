
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/javascript">
function clearNoNum(obj)
{
//先把非数字的都替换掉，除了数字和.
obj.value = obj.value.replace(/[^\d.]/g,"");
//必须保证第一个为数字而不是.
obj.value = obj.value.replace(/^\./g,"");
//保证只有出现一个.而没有多个.
obj.value = obj.value.replace(/\.{2,}/g,".");
//保证.只出现一次，而不能出现两次以上
obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$Local_Ip=Local_Ip();
////////修改记录
if ($Action=="save") {
$customerid=strip_tags($_POST['customerid']);//会员账户
$type=strip_tags($_POST['type']);            //加款/扣款
$price=get_check_price($_POST['price']);    //操作金额
$comment=strip_tags($_POST['comment']);       //操作金额

$result = mysql_query("SELECT * FROM administrator where username='$customerid'",$conn1);
if  ($row = mysql_fetch_array($result)){
/////如果是加款
if  ($type=='加款'){
if ($price<0){
echo "<script language=\"javascript\">alert('对不起，金额异常！');history.go(-1);</script>";
exit();
}

$amount=$price+$row['amount'];
$content="给 $customerid 管理者加款 $price 元";
$godo=mysql_query("update administrator set amount='$amount'  where username='$customerid'",$conn1); 
mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);


ysk_date_log(6,$_SESSION['ysk_username'],'给 "'.$customerid.'" 的系统管理员加了 '.$price.'元');

echo "<script>alert('加款成功!');self.location=document.referrer;</script>";
exit();
}else{
if ($price<0){
echo "<script language=\"javascript\">alert('对不起，金额异常！');history.go(-1);</script>";
exit();
}

/////如果是扣款
$amount=$row['amount']-$price;
$content="给 $customerid 管理者扣款 $price 元";
$godo=mysql_query("update administrator set amount='$amount'  where username='$customerid'",$conn1); 
mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);
ysk_date_log(6,$_SESSION['ysk_username'],'给 "'.$customerid.'" 的系统管理员扣了 '.$price.'元');
echo "<script>alert('扣款成功!');;self.location=document.referrer;</script>";
exit();
}
}else{
echo "<script language=\"javascript\">alert('没有找到该会员哦！');history.go(-1);</script>";
exit();
}
}
?>
<?php
If  ($Action=="List" or $Action==""){
?>
<form action="?Action=save" method="post" name="add">
<table cellspacing="1" cellpadding="0" class="page_table4">
<input name="begtime" readonly="readonly" type="hidden"  value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<tr>
<td colspan="2" class="table_top" style="text-align: left">
财务加/扣款给管理员</td>
</tr>
<tr>
<td class="td_left">
管理员账户：
</td>
<td class="left">
<div class="td_left2">
<input name="customerid" type="text" maxlength="20" id="customerid" style="width:100px;" /></div>
</td>
</tr>
<tr>
<td class="td_left">
操作金额：
</td>
<td class="left">
<input name="price" type="text" maxlength="12" id="price" style="width:80px;" onkeyup="clearNoNum(this)"/>&nbsp;元
</td>
</tr>

<tr>
<td class="td_left">
操作类型：
</td>
<td class="left">
<select name="type"  id="type">
<option selected="selected" value="加款">加款</option>
<option value="扣款">扣款</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">安全验证</td>
</tr>
<tr>
<td width="10%" class="td_left">请输入您的操作密码：</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input type="submit" name="Button1" value="确认提交" id="Button1" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){

if(checkspace(document.add.customerid.value)) {
document.add.customerid.focus();
alert("对不起，管理员账户不能为空！");
return false;
}

if(checkspace(document.add.price.value) || document.add.price.value <=0) {
document.add.price.focus();
alert("对不起，操作金额不能为空！");
return false;
}



if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("对不起，您还没有输入您的操作密码呢！");
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
</script>
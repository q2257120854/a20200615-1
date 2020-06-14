
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<script>
function cl()
{ 
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
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
if ($Action=="save"){
$customerid=strip_tags($_POST['customerid']);//会员账户
$type=strip_tags($_POST['type']);            //加款/扣款
$price=get_check_price($_POST['price']);;    //操作金额
$comment=strip_tags($_POST['comment']);       //操作金额
$papa=md5($_POST['papa']);
if ($admin['passwords']!=$papa){
echo "<script>alert('对不起，您的操作密码有误！!');self.location=document.referrer;</script>";
exit();
}


$sqlb="select * from administrator where username='$_SESSION[ysk_username]'";   //读取数据表
$zycb=mysql_query($sqlb,$conn1);  //执行该SQl语句
$rowb=mysql_fetch_array($zycb);
$ykuan=$rowb['amount'];
$amount=$ykuan-$price;
if ($ykuan<$price){
echo "<script language=\"javascript\">alert('对不起，您的账户余额不够！');history.go(-1);</script>";
exit();
}

if ($price<0){
echo "<script language=\"javascript\">alert('对不起，金额异常！');history.go(-1);</script>";
exit();
}

$result = mysql_query("SELECT * FROM members where number='$customerid'",$conn1);
if  ($row = mysql_fetch_array($result)){
/////如果是加款
if  ($type=='加款'){
$kuan=$price+$row['kuan'];
$content="给 $customerid 会员加款 $price 元 $comment";
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " ."values ('加款','$price','$row[kuan]','$kuan','$customerid','$begtime')",$conn1);
mysql_query("update members set kuan='$kuan'  where number='$customerid'",$conn1); 
mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);
mysql_query("update administrator set amount='$amount'  where username='$_SESSION[ysk_username]'",$conn1);

ysk_date_log(3,$_SESSION['ysk_username'],'给编号为 "'.$customerid.'" 的会员加了 '.$price.'元');
echo "<script>alert('加款成功!');;self.location=document.referrer;</script>";
exit();
}else{
/////如果是扣款
$amount=$row['kuan']-$price;
if ($amount<0 ){
echo "<script language=\"javascript\">alert('对不起，该会员账户余额不足！');history.go(-1);</script>";
exit();
}
$content="给 $customerid 会员扣款 $price 元 $comment";
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " ."values ('扣款','$price','$row[kuan]','$amount','$customerid','$begtime')",$conn1);
mysql_query("update members set kuan='$amount'  where number='$customerid'",$conn1); 

mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);
ysk_date_log(3,$_SESSION['ysk_username'],'给编号为 "'.$customerid.'" 的会员扣了 '.$price.'元');
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
$sql="select * from administrator where username='$_SESSION[ysk_username]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=save" method="post" name="add">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr>
<td colspan="2" class="table_top" style="text-align: left">
财务加款给会员</td>
</tr>
<tr>
<td class="td_left">
客户编号：
</td>
<td class="left">

<input name="customerid" type="text" maxlength="20" id="customerid" style="width:100px;" />

<a href="#art1" onclick="$.dialog.open('../customer/CustomerList.php', {title: '客户选择列表', width:1000, height:600, lock: true, fixed:true});"><img src="../images/icon_sousuo.gif" alt="点击查询客户" /></a>
</td>
</tr>
<tr>
<td class="td_left"> 您当前帐户余额：</td>
<td class="left"><span class="red"><?=$row['amount']?></span>&nbsp;元</td>
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
<td class="td_left">
相关备注：
</td>
<td class="left">
<textarea name="comment" rows="2" cols="20" id="comment" style="height:50px;width:200px;"></textarea>
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
<input type="submit" name="Button1" value="确认提交" id="Button1" class="tijiao_input" onClick="return checkuserinfo();">
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
alert("对不起，客户编号不能为空！");
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
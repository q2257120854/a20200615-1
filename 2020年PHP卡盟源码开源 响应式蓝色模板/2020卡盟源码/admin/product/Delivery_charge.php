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
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$result=mysql_query("select * from delivery_charge where id='1'",$conn1);
$row=mysql_fetch_array($result);


if ($Action=="save"){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

$price1=get_check_price($_POST['price1']);
$price2=get_check_price($_POST['price2']);
$price3=get_check_price($_POST['price3']);
$price4=get_check_price($_POST['price4']);

if ($row['price1']<>$price1){
ysk_date_log(6,$_SESSION['ysk_username'],'将系统供货1年收费 '.$row['price1'].' 元 修改成了 '.$price1.' 元');
}
if ($row['price2']<>$price2){
ysk_date_log(6,$_SESSION['ysk_username'],'将系统供货1年收费 '.$row['price2'].' 元 修改成了 '.$price2.' 元');
}
if ($row['price3']<>$price3){
ysk_date_log(6,$_SESSION['ysk_username'],'将系统供货1年收费 '.$row['price3'].' 元 修改成了 '.$price3.' 元');
}
if ($row['price4']<>$price4){
ysk_date_log(6,$_SESSION['ysk_username'],'将系统供货1年收费 '.$row['price4'].' 元 修改成了 '.$price4.' 元');
}


mysql_query("update delivery_charge set price1='$price1',price2='$price2',price3='$price3',price4='$price4' where id='1'",$conn1); 
echo "<script>alert('修改成功!');self.location=document.referrer;</script>";
}


?>
<form name="add" method="post" action="?Action=save">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">供货收费</td>
</tr>

<tr>
<td class="td_left"><span class="left">1年收费</span>：</td>
<td class="left">
<input name="price1" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price1']?>"/> 元</td>
</tr>

<tr>
<td class="td_left"><span class="left">3年收费</span>：</td>
<td class="left">
<input name="price2" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price2']?>"/> 元</td>
</tr>

<tr>
<td class="td_left"><span class="left">5年收费</span>：</td>
<td class="left">
<input name="price3" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price3']?>"/> 元</td>
</tr>

<tr>
<td class="td_left"><span class="left">永久收费</span>：</td>
<td class="left">
<input name="price4" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price4']?>"/> 元</td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>
</body>
</Html>

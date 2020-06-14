
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$buy=strip_tags($_POST['buy']); 
$Id=strip_tags($_POST['Id']); 
$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);
$yx_sup=mysql_fetch_array($yx_sup_result);

if ($Action=="buysave") {

$result=mysql_query("select * from product_class where id='$Id' and number='$_SESSION[ysk_number]'",$conn1);
$row=mysql_fetch_array($result);

if ($row['id']==''){
echo "<script>alert('对不起购买失败!没有找到您的店铺呀!');self.location=document.referrer;</script>";
exit();
}

if      ($buy=='1'){
$price=$Shop_red_price1;
$begtime1=strtotime('+30 day',time()); 
}elseif ($buy=='2'){
$price=$Shop_red_price2;
$begtime1=strtotime('+60 day',time()); 
}elseif ($buy=='3'){
$price=$Shop_red_price3;
$begtime1=strtotime('+90 day',time()); 
}elseif ($buy=='4'){
$price=$Shop_red_price4;
$begtime1=0;
}

$zong=$price*0;
$zonger=$yx_sup['kuan']-$zong;
$userkuan=$yx_us['kuan']-$price;
if ($price==0 || $price==''){
echo "<script>alert('对不起购买失败!暂未开放该功能!');self.location=document.referrer;</script>";
exit();
}elseif($userkuan<0){
echo "<script>alert('对不起购买失败!账户余额不足!');self.location=document.referrer;</script>";
exit();
}elseif ($zonger<0){
echo "<script>alert('对不起对不起购买失败!sup余额不足请联系站长!');self.location=document.referrer;</script>";
exit();
}else{
##############SUP
mysql_query("insert into `sup_details_funds` (title,spendings,befores,afters,number,begtime)"."values ('会员购买专区红名扣款','$zong','$yx_sup[kuan]','$zonger','$sup_number','$begtime')",$conn2);
mysql_query("update sup_members set kuan='$zonger',zong_kuan=zong_kuan+$zong where number='$sup_number'",$conn2); 

mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " .
"values ('购买专区红名','$price','$yx_us[kuan]','$userkuan','$_SESSION[ysk_number]','$begtime')",$conn1);

mysql_query("update members set kuan='$userkuan',zong_kuan=zong_kuan+$price where number='$_SESSION[ysk_number]'",$conn1); 
mysql_query("update product_class set color='#ff0000',begtime='$begtime1' where id='$Id' and number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('购买成功!');window.location='red_name.php';</script>";
}
}

if ($Action=="del") {
mysql_query("update product_class set color='' where id='$Id'  and number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('解除成功!');;self.location=document.referrer;</script>";
}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if($Action==""){?>
<table cellspacing="1" cellpadding="0" class="page_table4" >
<tr>
<td width="52%" class="table_top">独立销售专区名称</td>
<td width="12%" align="center" class="table_top">是否红名</td>
<td width="24%" align="center"  class="table_top">到期日期</td>
<td align="center" class="table_top">操作</td>
</tr>
<?php 
$result=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' order by id desc",$conn1);
while($row=mysql_fetch_array($result)){?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" align="left"><span style="color:<?=$row['color']?>"><?=$row['7']?> </span></td>
<td height="24" align="center"><?php if ($row['color']!=''){echo "是";}else{echo "否";}?></td>
<td align="center">
<?php if ($row['begtime']!=''     && $row['begtime']!=0 && $row['color']!=''){?>
<?=date("Y-m-d G:i:s",$row['begtime'])?>
<?php }elseif($row['begtime']!='' && $row['begtime']==0  && $row['color']!=''){?>
永久
<?php }?>
</td>
<td align="center">
<?php if ($row['color']==''){?>
<a href="?Action=buy&Id=<?=$row['id']?>">购买</a>
<?php }else{?>
<a href="?Action=buy&Id=<?=$row['id']?>"><span style="color:#CCCCCC">续费</span></a>
<?php }?>
</td>
</tr>
<?php
} 
?>
</table>
<?php }elseif($Action=="buy"){
$Sresult=mysql_query("select * from  product_class  where id='$_REQUEST[Id]'",$conn1);
$St=mysql_fetch_array($Sresult);?>
<?php if ($St['begtime']!='' && $St['color']!=''){
	
}else{?>

<form action="?Action=buysave" method="post" name="myform" onsubmit="return CheckPost();">
<input name="Id" type="hidden" value="<?=$St['id']?>">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="28" colspan="2" align="left"  class="table_top">购买店铺红名</td>
</tr>
<tr>
<td width="7%" height="28" align="right" class="td_left">店铺名称：</td>
<td width="93%"><?=$St['7']?></td>
</tr>
<tr>
<td height="28" align="right" class="td_left">购买时间：</td>
<td><select name="buy" id="buy">
<option value="1">1个月 费用：<?=$Shop_red_price1?> <?=$moneytype?></option>
<option value="2">2个月 费用：<?=$Shop_red_price2?> <?=$moneytype?></option>
<option value="3">3个月 费用：<?=$Shop_red_price3?> <?=$moneytype?></option>
<option value="4">永久  费用：<?=$Shop_red_price4?> <?=$moneytype?></option>
</select></td>
</tr>
<tr>
<td height="28" align="right">&nbsp;</td>
<td>
<input type="submit" name="Submit" value="提交"  class="tijiao_input"/>
</td>
</tr>
</table>
</form>
<?php } ?>
<?php } ?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
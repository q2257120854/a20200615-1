<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>
<body leftmargin="0" bottommargin="0">
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php 
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
include('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$id=strip_tags($_GET['id']); 
$total=mysql_num_rows(mysql_query("select * from `flagship_shops` where uid='$id' ",$conn1));

if ($total>=7){?>
<center>
<br /><br><font color="red" style="font-size:24px; font-family:'微软雅黑'">对不起，该类目的旗舰店已被申请了！</font><br /><br>
</center>
<?php  exit();}elseif ($Action==''){?>
<form action="?Action=ok&id=<?=$id?>" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="3" class="table5">
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">购买时限：</td>
<td width="80%" align="left" class="tdleft"> <select name="buy">
<option value="30">一月 <?=$fship_price1?> <?=$moneytype?></option>
<option value="365">一年<?=$fship_price2?> <?=$moneytype?></option>
</select></td>
</tr>
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">选择店铺：</td>
<td width="80%" align="left" class="tdleft"><select name="ClassID" id="ClassID">
<?php 
$results=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' and LagID=2 order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['NumberID']?>"><?=$type['7']?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">店铺最低押金：</td>
<td width="80%" align="left" class="tdleft"> <?=$fship_price3?> <?=$moneytype?></td>
</tr>


<tr>
<td height="48" colspan="2"  align="center">
  <?php if ($yx_us['frozen_kuan']<$fship_price3){?>
  对不起，您冻结押金未达到 <?=$fship_price3?> <?=$moneytype?> 无法申请该旗舰店
  <?php }else{?>
  <input type="submit" name="btn_edit" value="下一步" id="btn_edit" class="tijiao_input" />
  <?php } ?></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='ok'){
$Token=strip_tags($_POST['Token']); 
$ClassID=strip_tags($_POST['ClassID']); 
$buy=pot_check_price($_POST['buy']);
/////////////////////////////////////重置购买资料
if($buy==30){
$price=$fship_price1;
$buy=30;
$overday=$begtime+86400*30;
}else{
$price=$fship_price2;
$buy=365;
$overday=$begtime+86400*365;
}

if ($_SESSION['yx_token']!=$Token){
echo "<script>alert('申请失败，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($ClassID==''){
echo "<script>alert('申请失败，您没有选择店铺！');;self.location=document.referrer;</script>";
exit();	
}

$total1=mysql_num_rows(mysql_query("select * from `flagship_shops` where uid='$id' and mid='$ClassID' ",$conn1));
if ($total1>0){
echo "<script>alert('申请失败，您已经申请过了！');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_us['kuan']<$price){
echo "<script>alert('申请失败，您的余额不足！');;self.location=document.referrer;</script>";
exit();	
}

///////更新数据


$zongprice=$yx_us['kuan']-$price;
mysql_query("insert into `details_funds` set title='申请旗舰店$id的入驻',spendings='$price',befores='$yx_us[kuan]',afters='$zongprice',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);

mysql_query("update members set kuan='$zongprice',zong_kuan=zong_kuan+$price where number='$_SESSION[ysk_number]'",$conn1); 

mysql_query("insert into flagship_shops set uid='$id',mid='$ClassID',price='$yx_us[frozen_kuan]',username='$_SESSION[ysk_number]',begtime='$begtime',overday='$overday'",$conn1);



echo "<br><br><br><center><input id='btnAll' type='button' value='申请成功!'  onClick='cl()' class='tijiao_input' /></center>";


}?>
</body>
</Html>

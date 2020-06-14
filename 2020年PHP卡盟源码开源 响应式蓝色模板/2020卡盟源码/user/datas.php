<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']);
$yx_sup_result=mysql_query("select * from sup_members    where number='$sup_number' ",$conn2);       ###获取Sup资料
$yx_sup=mysql_fetch_array($yx_sup_result);
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);
$total=mysql_num_rows(mysql_query("select * from `data_cloud` where username='$_SESSION[ysk_number]' ",$conn1));
//-------------------获取分站数据
$result=mysql_query("select * from `vip_site` where vip_number='$_SESSION[ysk_number]' and opens=1",$conn1);
$site=mysql_fetch_array($result);
if      ($site['versions']==1){
$site_domain=$site_domain1;
$site_record=$site_record1;
}elseif ($site['versions']==2){
$site_domain=$site_domain2;
$site_record=$site_record2;
}elseif ($site['versions']==3){
$site_domain=$site_domain3;
$site_record=$site_record3;
}elseif ($site['versions']==4){
$site_domain=$site_domain4;
$site_record=$site_record4;
}

//-------------------保存域名提交内容
if ($Action=='save'){
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$y4=strip_tags($_POST['y4']);
$y5=strip_tags($_POST['y5']);
$y6=strip_tags($_POST['y6']);
$content=$mytime.' 提交域名注册信息';
//---------------------------------安全验证
if ($total>0){
echo "<script>alert('操作失败，您不可以重复提交！');self.location=document.referrer;</script>";
exit();	
}

if (md5($_POST['password'])!=$yx_us['passwords']){
echo "<script>alert('操作失败，交易密码错误！');self.location=document.referrer;</script>";
exit();	
}

if ($site_domain==0 && $yx_us['kuan']-$site_sup_p3<0){
echo "<script>alert('操作失败，余额不能为空！');self.location=document.referrer;</script>";
exit();	
}


if ($yx_sup['kuan']-$moprice3<0){
echo "<script>alert('操作失败，主站余额不能为空！');self.location=document.referrer;</script>";
exit();	
}
//---------------------------------安全验证 The End

//---------------------------------订单明细
if ($site_domain==0){
mysql_query("insert into `details_funds` set title='购买域名',orderid='$dingdanhao',spendings='$site_sup_p3',befores='$yx_us[kuan]',afters=$yx_us[kuan]-$site_sup_p3,number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan=kuan-$site_sup_p3,zong_kuan=zong_kuan+$site_sup_p3 where number='$_SESSION[ysk_number]'",$conn1);
}
//---------------------------------订单结束

//---------------------------------Sup订单明细
mysql_query("insert into `sup_details_funds` set title='购买域名',orderid='$dingdanhao',spendings='$moprice3',befores='$yx_sup[kuan]',afters=$yx_sup[kuan]-$moprice3,number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan=kuan-$moprice3,zong_kuan=zong_kuan+$moprice3 where number='$yx_sup[number]'",$conn2); 
//---------------------------------Sup订单结束

mysql_query("insert into `data_cloud` set api='$supdoc[id]',lock1='0',lock2='0',lock3='0',members='$sup_number',username='$_SESSION[ysk_number]',y1='$y1',y2='$y2',y3='$y3',y4='$y4',y5='$y5',y6='$y6',content='$content',begtime='$begtime',gettime='0'",$conn1);

echo "<script>alert('操作成功！');self.location=document.referrer;</script>";
exit();	

}elseif ($Action=='record'){
$domain=strip_tags($_POST['domain']);

//---------------------------------安全验证
if ($total==0 || $domain==''){
echo "<script>alert('操作失败，您没有选择域名！');self.location=document.referrer;</script>";
exit();	
}

if (md5($_POST['password'])!=$yx_us['passwords']){
echo "<script>alert('操作失败，交易密码错误！');self.location=document.referrer;</script>";
exit();	
}

if ($site_record==0 && $yx_us['kuan']-$site_sup_p4<0){
echo "<script>alert('操作失败，余额不能为空！');self.location=document.referrer;</script>";
exit();	
}

if ($yx_sup['kuan']-$moprice4<0){
echo "<script>alert('操作失败，主站余额不能为空！');self.location=document.referrer;</script>";
exit();	
}
//---------------------------------安全验证 The End

if ($row['lock2']!=0){
echo "<script>alert('操作失败，您不能重复提交！');self.location=document.referrer;</script>";
exit();	
}

//---------------------------------订单明细
if ($site_record==0){
mysql_query("insert into `details_funds` set title='购买域名备案',orderid='$dingdanhao',spendings='$site_sup_p4',befores='$yx_us[kuan]',afters=$yx_us[kuan]-$site_sup_p4,number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan=kuan-$site_sup_p4,zong_kuan=zong_kuan+$site_sup_p4 where number='$_SESSION[ysk_number]'",$conn1);
}
//---------------------------------订单结束

//---------------------------------Sup订单明细
mysql_query("insert into `sup_details_funds` set title='购买域名备案',orderid='$dingdanhao',spendings='$moprice4',befores='$yx_sup[kuan]',afters=$yx_sup[kuan]-$moprice4,number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan=kuan-$moprice4,zong_kuan=zong_kuan+$moprice4 where number='$yx_sup[number]'",$conn2); 
//---------------------------------Sup订单结束
$content1=$mytime.' 提交域名备案信息';
mysql_query("update data_cloud set lock2='1',content1='$content1',gettime='$begtime'  where username='$_SESSION[ysk_number]'",$conn1); 

echo "<script>alert('操作成功！');self.location=document.referrer;</script>";
exit();	
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php 
$result=mysql_query("select * from `data_cloud` where username='$_SESSION[ysk_number]' ",$conn1);
$row=mysql_fetch_array($result);	
if ($total==0){?>
<form name="add" method="post" action="?Action=save" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">域名注册</td></tr>
<tr>
<td width="10%" class="td_left">注册域名：</td>
<td width="90%" class="left"><input name="y1" type="text" style="width:350px;"  class="biankuan" /> 注册域名前请<a href="http://www.net.cn" target="_blank">万网</a> 先查询是否可注册 尽量注册.com域名比较方便快捷  </td>
</tr>
<tr>
<td width="10%" class="td_left">联系人：</td>
<td width="90%" class="left"><input name="y2" type="text" style="width:350px;"  class="biankuan" /> 请真实填写，注册域名用</td>
</tr>	
<tr>
<td width="10%" class="td_left">联系QQ：</td>
<td width="90%" class="left"><input name="y3" type="text" style="width:350px;"  class="biankuan" /> 请真实填写，方便联系</td>
</tr>
<tr>
<td width="10%" class="td_left">身份证号码：</td>
<td width="90%" class="left"><input name="y4" type="text" style="width:350px;" class="biankuan" />
  请真实填写，注册域名用</td>
</tr>

<tr>
<td width="10%" class="td_left">联系电话：</td>
<td width="90%" class="left"><input name="y5" type="text" style="width:350px;" class="biankuan" />
  请真实填写，注册域名用</td>
</tr>

<tr>
<td width="10%" class="td_left">联系地址：</td>
<td width="90%" class="left"><input name="y6" type="text" style="width:350px;" class="biankuan" />
  请真实填写，注册域名用</td>
</tr>
	

<tr>
<td width="19%" class="td_left">交易密码：</td>
<td colspan="5" class="left" style="color:#666;"><span class="left" style="color:#666;">
<input name="password" type="password" style="width:200px;" value="" class="biankuan" />
</span></td>
</tr>

<?php if ($site_domain==0){?>
<tr>
<td width="19%" class="td_left">购买价格：</td>
<td colspan="5" class="left" style="color:#666;"><span class="left" style="color:#666;">
<?=$site_sup_p3?> <?=$moneytype?>
</span></td>
</tr>
<?php } ?>
<tr>
<td></td>
<td colspan="5">
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"/></td>
</tr>

</table>
</form>
<?php }else{?>
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">域名注册</td></tr>
<tr>
<td width="10%" class="td_left">注册域名：</td>
<td width="90%" class="left"><?=$row['y1']?></td>
</tr>
<tr>
<td width="10%" class="td_left">联系人：</td>
<td width="90%" class="left"><?=$row['y2']?></td>
</tr>	
<tr>
<td width="10%" class="td_left">联系QQ：</td>
<td width="90%" class="left"><?=$row['y3']?></td>
</tr>
<tr>
<td width="10%" class="td_left">身份证号码：</td>
<td width="90%" class="left"><?=$row['y4']?></td>
</tr>

<tr>
<td width="10%" class="td_left">联系电话：</td>
<td width="90%" class="left"><?=$row['y5']?></td>
</tr>

<tr>
<td width="10%" class="td_left">联系地址：</td>
<td width="90%" class="left"><?=$row['y6']?></td>
</tr>
<tr>
<td width="10%" class="td_left">域名状态：</td>
<td width="90%" class="left"><?=$row['content']?></td>
</tr>


</table>
<?php } ?>

<?php if ($row['lock2']==0){?>
<form name="add" method="post" action="?Action=record" >
<table class="page_table4" cellpadding="0" cellspacing="1"  style="margin-top:10px;">

<tr>
<td colspan="2" class="table_top" style="text-align: left;">域名备案</td></tr>
<tr>
<td width="10%" class="td_left">选择域名：</td>
<td width="90%" class="left">
<select name="domain" id="domain">
<option value="<?=$row['y1']?>"><?=$row['y1']?></option>
</select>
</td>
</tr>
<?php if ($site_record==0){?>
<tr>
<td width="19%" class="td_left">购买价格：</td>
<td colspan="5" class="left" style="color:#666;"><span class="left" style="color:#666;">
<?=$site_sup_p4?> <?=$moneytype?>
</span></td>
</tr>
<?php } ?>
	

<tr>
<td width="19%" class="td_left">交易密码：</td>
<td colspan="5" class="left" style="color:#666;"><span class="left" style="color:#666;">
<input name="password" type="password" style="width:200px;" value="" class="biankuan" />
</span></td>
</tr>	


<tr>
<td></td>
<td colspan="5">
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>

<?php }else{?>
<table class="page_table4" cellpadding="0" cellspacing="1"  style="margin-top:10px;">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">域名备案</td></tr>
<tr>
<td width="10%" class="td_left">备案域名：</td>
<td width="90%" class="left"><?=$row['y1']?></td>
</tr>

<tr>
<td width="10%" class="td_left">备案状态：</td>
<td width="90%" class="left"><?=$row['content1']?></td>
</tr>


</table>
<?php }?>
</body>
</Html>


<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.y1.value)) {
document.add.y1.focus();
alert("操作失败,注册域名不能为空");
return false;
}

if(checkspace(document.add.y2.value)) {
document.add.y2.focus();
alert("操作失败,联系人不能为空");
return false;
}

if(checkspace(document.add.y3.value)) {
document.add.y3.focus();
alert("操作失败,联系QQ不能为空");
return false;
}

if(checkspace(document.add.y4.value)) {
document.add.y4.focus();
alert("操作失败,身份证号码不能为空");
return false;
}

if(checkspace(document.add.y5.value)) {
document.add.y5.focus();
alert("操作失败,联系电话不能为空");
return false;
}

if(checkspace(document.add.y6.value)) {
document.add.y6.focus();
alert("操作失败,联系地址不能为空");
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
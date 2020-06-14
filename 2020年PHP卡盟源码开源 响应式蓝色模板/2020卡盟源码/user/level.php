<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><title>
聚合社
</title><link href="css/levelall.css" rel="stylesheet" type="text/css" /><link href="css/levelstyle.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="css/leveljquery.js"></script>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']);
$level=inject_check($_POST['level']);
$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);
$yx_sup=mysql_fetch_array($yx_sup_result);
if ($yx_us['agent']!=''){
$aglt=mysql_query("select * from members where number='$yx_us[agent]'",$conn1);
$agent=mysql_fetch_array($aglt);
}?>
<div class="yright">
<?php if ($Action==''){
$total=mysql_num_rows(mysql_query("select * from `level` where id>'$yx_us[level]' ",$conn1));	
?>

 <div class="contbox">
            <div class="pd_t10">
                <table width="100%" cellpadding="0" cellspacing="1" class="table01">
<form action="?Action=ok" method="post">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">
<tr>
<td width="17%" class="table1_left">选择等级：</td>
<td width="83%" class="tdleft">
<select  name="level" id="level">  
<option  value="" selected="selected">
<?php if ($total>0){echo"请选择";}else{echo "您已是最高级别了";}?>
</option> 
<?php
$result=mysql_query("select * from level where id>'$yx_us[level]' order by id desc",$conn1);
while($level=mysql_fetch_array($result)){?>
<option value="<?=$level['id']?>"><?=$level['title']?> (价格<?=$level['price']?> <?=$moneytype?>)</option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='ok') {

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
} 

if ($level==''){
echo "<script>alert('对不起，您没有选择要升的级别！');history.go(-1);</script>";
exit();
}

$result1=mysql_query("select * from level where id='$level'",$conn1);
$p1=mysql_fetch_array($result1);
if ($p1['id']==''){
echo "<script>alert('对不起，您没有选择要升的级别！');history.go(-1);</script>";
exit();
}
$result2=mysql_query("select * from level where id='$yx_us[level]'",$conn1);
$p2=mysql_fetch_array($result2);
/////////////////////////////////////////////////////////获取升级差价和SUP扣价
$zonger=$p1['price']-$p2['price'];
$price=$zonger*0;
$_SESSION['level_price']=$price;
$_SESSION['level_zonger']=$zonger;
$_SESSION['level_level']=$level;
$_SESSION['level_title']=$p1['title'];
/////////////////////////////////////////////////////////
if (($yx_us['kuan']-$zonger)<=0) {
echo "<script language=\"javascript\">alert('对不起，余额不足无法升级！');history.go(-1);</script>";
exit();
}
if (($yx_sup['kuan']-$price)<0){
echo "<script language=\"javascript\">alert('对不起，SUP余额不足无法升级！');history.go(-1);</script>";
exit();
}

//*******************************************************************万恶的黑客修改模板
get_check_price(($yx_sup['kuan']-$price));
get_check_price(($yx_us['kuan']-$zonger));
get_check_price($zonger);
get_check_price($price);
//*******************************************************************万恶的黑客修改模板 The End
?>

<form action="?Action=save" method="post">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style=" margin-top:10px;">
<tr>
<td class="table1_left">升级到：</td>
<td class="tdleft"><?=$p1['title']?>
</td>
</tr>
<tr>
<td class="table1_left">升级费用：</td>
<td class="tdleft"><?=$zonger?> <?=$moneytype?>
</td>
</tr>
<?php if ($yx_us['agent']!=0 && $level>=$agent['level']){?>
<tr>
<td class="table1_left">解除上下级关系：</td>
<td class="tdleft" style="color:#FF0000">您升级的等级，比您现在的上级还高 确定升级后将解除上下级关系！
</td>
</tr>
<?php } ?>
<tr>
<td class="table1_left">交易密码：</td>
<td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="请输入您的交易密码" />
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="确认升级"  id="btnSubmit" class="tijiao_input" />
<input id="Button1" type="button" value="返回" class="fanhui_input" onClick="history.go(-1);" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='save') {

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
} 

if (md5($_POST['passwords'])==''){
echo "<script>alert('对不起，交易密码不能为空！');window.location='level.php';</script>";
exit();
}
if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script>alert('对不起，交易密码错误!');window.location='level.php';</script>";
exit();
}

$title='升级到 '.$_SESSION['level_title'];
$zonger=$_SESSION['level_zonger'];
$price=$_SESSION['level_price'];
$Dagent=$yx_us['agent'];
$level=$_SESSION['level_level'];



$afters=$yx_us['kuan']-$zonger;
if (($yx_us['kuan']-$zonger)<=0) {
echo "<script language=\"javascript\">alert('对不起，余额不足无法升级！');history.go(-1);</script>";
exit();
}

if (($yx_sup['kuan']-$price)<0){
echo "<script language=\"javascript\">alert('错误操作！');history.go(-1);</script>";
exit();
}
//*******************************************************************万恶的黑客修改模板
get_check_price(($yx_sup['kuan']-$price));
get_check_price(($yx_us['kuan']-$zonger));
get_check_price($zonger);
get_check_price($price);
//*******************************************************************万恶的黑客修改模板 The End

$total=mysql_num_rows(mysql_query("SELECT * FROM `details_funds` where  number='$_SESSION[ysk_number]' and title='$title'",$conn1));
if ($total=='0'){
#---------------------------------------------------------------------------------------------------------主站扣费
if ($price>'0'){
$sup_kuan=$yx_sup['kuan']-$price;
mysql_query("insert into `sup_details_funds` (title,spendings,befores,afters,number,begtime)"."values ('会员升级扣款','$price','$yx_sup[kuan]','$sup_kuan','$sup_number','$begtime')",$conn2);
mysql_query("update sup_members set kuan='$sup_kuan',zong_kuan=zong_kuan+$price where number='$sup_number'",$conn2); 
#---------------------------------------------------------------------------------------------------------主站扣费 The End
}

if ($zonger>'0'){
#---------------------------------------------------------------------------------------------------------主站会员扣费
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime)"."values ('$title','$zonger','$yx_us[kuan]','$afters','$_SESSION[ysk_number]','$begtime')",$conn1);
}

if ($yx_us['agent']!=0 && $zonger>0){
#---------------------------------------------------------------------------------------------------------上级会员抽成
$price1=$zonger*0.35;
$afters1=$agent['kuan']+$price1;
$begtime=$begtime+1;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('下级 $title','$price1','$agent[kuan]','$afters1','$yx_us[agent]','$begtime')",$conn1);
mysql_query("update members set kuan='$afters1' where number='$yx_us[agent]'",$conn1); 
if ($agent['agent']!=0){
$agl=mysql_query("select * from members where number='$agent[agent]'",$conn1);
$ag=mysql_fetch_array($agl);
#---------------------------------------------------------------------------------------------------------上上级会员抽成
$price1=$zonger*0.1;
$afters1=$ag['kuan']+$price1;
$begtime=$begtime+1;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('下下级 $title','$price1','$ag[kuan]','$afters1','$agent[agent]','$begtime')",$conn1);
mysql_query("update members set kuan='$afters1' where number='$agent[agent]'",$conn1); 
}
#---------------------------------------------------------------------------------------------------------上级会员抽成  The End
}
#---------------------------------------------------------------------------------------------------------主站会员扣费 The End

mysql_query("update members set kuan='$afters',level='$level' where number='$_SESSION[ysk_number]'",$conn1); 

if ($Dagent!='' && $_SESSION['level_level']>=$agent['level']){
mysql_query("update members set agent=''         where number='$_SESSION[ysk_number]'",$conn1); 
mysql_query("update members set xlevel=xlevel-1  where number='$Dagent'",$conn1); 
}
}
unset($_SESSION['level_price']);
unset($_SESSION['level_zonger']);
unset($_SESSION['level_level']);
unset($_SESSION['level_title']);
echo "<script>alert('升级成功!');window.location='/user/level.php';</script>";
exit();
}
?>

</div>
</body>
</Html>
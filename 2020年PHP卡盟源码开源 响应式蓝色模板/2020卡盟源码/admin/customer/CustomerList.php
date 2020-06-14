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

<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$keyword=strip_tags($_GET['keyword']);
$keywords=strip_tags($_GET['keywords']);
$level=strip_tags($_GET['level']);
$locks=strip_tags($_GET['locks']);
$paixu=strip_tags($_GET['paixu']);
$abcd=strip_tags($_GET['abcd']);
$a=strip_tags($_GET['a']);
$b=strip_tags($_GET['b']);
$c=strip_tags($_GET['c']);
$d=strip_tags($_GET['d']);
////////删除单记录
if ($Action=="del") {
//---------------------------------------------将商品资料备份开始了
$total=mysql_num_rows(mysql_query("select * from `members_back` where uid='$_REQUEST[Id]'",$conn1));
$back_result=mysql_query("select * from members  where id='$_REQUEST[Id]'",$conn1);
$back=mysql_fetch_array($back_result);
ysk_date_log(2,$_SESSION['ysk_username'],'把会员"'.$back['number'].'" 删除了',$back['id']);
if($total==0){
mysql_query("insert into members_back set uid='$back[id]',wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]'",$conn1);
}else{
mysql_query("update members_back set  wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]' where uid='$_REQUEST[Id]'",$conn1);
}
//---------------------------------------------将商品资料备份结束了


mysql_query("delete from members where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
exit();
}



////////修改记录
if ($Action=="editsave") {
$level=$_POST['level'];
$rname=$_POST['rname'];
$card=$_POST['card'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$qq=$_POST['qq'];
$address=$_POST['address'];
$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];
$y5=$_POST['y5'];
$y6=$_POST['y6'];
$y7=$_POST['y7'];
$y8=$_POST['y8'];
if ($y1<>$level){ysk_date_log(1,$_SESSION['ysk_username'],'将'.$y8.'等级从 "V'.$y1.'" 修改成了 "V'.$level.'"',$_POST['Id']);}
if ($y2<>$rname){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'姓名 "'.$y2.'" 修改成了 "'.$rname.'"',$_POST['Id']);}
if ($y3<>$card){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'身份证号 "'.$y3.'" 修改成了 "'.$card.'"',$_POST['Id']);}
if ($y4<>$email){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'电子邮箱 "'.$y4.'" 修改成了 "'.$email.'"',$_POST['Id']);}
if ($y5<>$phone){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'联系电话 "'.$y5.'" 修改成了 "'.$phone.'"',$_POST['Id']);}
if ($y6<>$qq){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'腾讯QQ "'.$y6.'" 修改成了 "'.$qq.'"',$_POST['Id']);}
if ($y7<>$address){ysk_date_log(2,$_SESSION['ysk_username'],'将'.$y8.'联系地址 "'.$y7.'" 修改成了 "'.$address.'"',$_POST['Id']);}
//---------------------------------------------资料备份开始了
$total=mysql_num_rows(mysql_query("select * from `members_back` where uid='$_POST[Id]'",$conn1));
$back_result=mysql_query("select * from members  where id='$_POST[Id]'",$conn1);
$back=mysql_fetch_array($back_result);
if($total==0){
mysql_query("insert into members_back set uid='$back[id]',wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]'",$conn1);
}else{
mysql_query("update members_back set  wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]' where uid='$_POST[Id]'",$conn1);
}
//---------------------------------------------资料备份结束了


mysql_query("update members set level='$level',rname='$rname',card='$card',email='$email',phone='$phone',qq='$qq',address='$address' where id='$_POST[Id]'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";
exit();
}




////////修改记录
If ($Action=="qxsave") {


$power5=pot_check_price($_POST['power5']);
$power6=pot_check_price($_POST['power6']);
$power7=pot_check_price($_POST['power7']);
$power13=pot_check_price($_POST['power13']);
$power14=pot_check_price($_POST['power14']);
$power15=pot_check_price($_POST['power15']);
$Id=pot_check_price($_POST['Id']);
$result=mysql_query("select * from members where id='$Id' ",$conn1);
$row=mysql_fetch_array($result);
$DocApi1=$row['DocApi1'];
if ($row['power7']<>$power7){
if ($power7==0){$diary='关闭了 "'.$row['number'].'" 会员的加款卡充值权限';}elseif($power7==1){$diary='开启了 "'.$row['number'].'" 会员的加款卡充值权限';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
}
if ($row['power5']<>$power5){
if ($power5==0){$diary='关闭了 "'.$row['number'].'" 会员的自有商品发布权限';}elseif($power5==1){$diary='开启了 "'.$row['number'].'" 会员的自有商品发布权限';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
}

if ($row['power6']<>$power6){
if ($power6==0){$diary='关闭了 "'.$row['number'].'" 会员的供货收入客户转余额';}elseif($power6==1){$diary='开启了 "'.$row['number'].'" 会员的供货收入客户转余额';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
}

if ($row['power13']<>$power13){
if ($power13==0){$diary='关闭了 "'.$row['number'].'" 会员的平台对接权限';}elseif($power13==1){$diary='开启了 "'.$row['number'].'" 会员的平台对接权限';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
$DocApi1=genToken();
}

if ($row['power14']<>$power14){
if ($power14==0){$diary='关闭了 "'.$row['number'].'" 会员的淘宝网充值接口';}elseif($power14==1){$diary='开启了 "'.$row['number'].'" 会员的淘宝网充值接口';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
}

if ($row['power15']<>$power15){
if ($power15==0){$diary='关闭了 "'.$row['number'].'" 会员的5173平台充值接口';}elseif($power15==1){$diary='开启了 "'.$row['number'].'" 会员的5173平台充值接口';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);

}

mysql_query("update members set power5='$power5',power6='$power6',power7='$power7',power13='$power13',power14='$power14',power15='$power15',DocApi1='$DocApi1' where id='$Id'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";
exit();
}


if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////用 explode 把 | 的内容隔开成数组

###移动商品
if ($_REQUEST['Del']=='禁止'){
$_SESSION['yDel']='禁止';  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='删除'){
foreach($allArray as $value){
//---------------------------------------------资料备份开始了
$total=mysql_num_rows(mysql_query("select * from `members_back` where uid='$value'",$conn1));
$back_result=mysql_query("select * from members  where id='$value'",$conn1);
$back=mysql_fetch_array($back_result);
if($total==0){
mysql_query("insert into members_back set uid='$back[id]',wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]'",$conn1);
}else{
mysql_query("update members_back set  wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]' where uid='$value',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]'",$conn1);
}
ysk_date_log(2,$_SESSION['ysk_username'],'把会员"'.$back['number'].'" 删除了',$back['id']);

//---------------------------------------------资料备份结束了
mysql_query("delete from members where id ='$value'",$conn1);
}
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='开通'){
foreach($allArray as $value) {
$back_result=mysql_query("select * from members  where id='$value'",$conn1);
$back=mysql_fetch_array($back_result);
ysk_date_log(4,$_SESSION['ysk_username'],'把会员"'.$back['number'].'" 的登录状态开启了',$back['id']);
mysql_query("update members set locks='0' where id=$value",$conn1);
}
echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
}


}


?>
<script language="javascript" type="text/javascript" src="/Public/js/jquery.min.js"></script>
<?php if  ($_SESSION['yDel']=='禁止'){?> 
<script language="javascript">
$(window).load(function() {
art.dialog.open('frozen.php?Action=close',{lock:true,fixed:true,title:'禁止',width:500,height:230});
});
</script>
<?php } ?>

<body>
<?php if($Action=="List" or $Action==""){?>
<form name="add" method="get" action="CustomerList.php" >
<table cellspacing="1" cellpadding="0" class="page_table2">
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
<select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
<option value="company">公司名称</option>
<option value="username">用户名</option>
<option value="rname">联系人姓名</option>
<option value="qq">QQ号码</option>
<option value="phone">手机号码</option>
</select>

<select name="level" id="level">
<option selected="selected" value="">全部级别</option>
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<option value="<?=$Orzx['id']?>"><?=$Orzx['title']?></option>
<?php 
} }?>
</select>


<select name="locks" id="locks">
<option selected="selected" value="">全部状态</option>
<option value="0">开通</option>
<option value="1">禁止</option>
</select>

</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="4%" class="table_top">选择</td>
<td width="6%" class="table_top">
<?php if ($a=='desc'){?>
<a href="?paixu=number&a=asc&abcd=<?=$abcd?>">编号</a>
<?php }else{ ?>
<a href="?paixu=number&a=desc&abcd=<?=$abcd?>">编号</a>
<?php }?></td>
<td width="10%" class="table_top">用户名</td>
<td width="10%" class="table_top">客户级别</td>
<td width="8%" class="table_top">
<?php if ($b=='desc'){?>
<a href="?paixu=kuan&b=asc&abcd=<?=$abcd?>">余额</a>
<?php }else{ ?>
<a href="?paixu=kuan&b=desc&abcd=<?=$abcd?>">余额</a>
<?php }?></td>
<td width="8%" class="table_top">
<?php if ($c=='desc'){?>
<a href="?paixu=goods_kuan&c=asc&abcd=<?=$abcd?>">货款</a>
<?php }else{ ?>
<a href="?paixu=goods_kuan&c=desc&abcd=<?=$abcd?>">货款</a>
<?php }?></td>
<td width="8%" class="table_top">

<?php if ($d=='desc'){?>
<a href="?paixu=frozen_kuan&d=asc&abcd=<?=$abcd?>">冻结金额</a>
<?php }else{ ?>
<a href="?paixu=frozen_kuan&d=desc&abcd=<?=$abcd?>">冻结金额</a>
<?php }?>
</td>
<td width="6%" class="table_top">

<?php if ($locks=='1'){?>
<a href="?locks=0&abcd=<?=$abcd?>">账户状态</a>
<?php }else{ ?>
<a href="?locks=1&abcd=<?=$abcd?>">账户状态</a>
<?php }?></td>
<td width="7%" class="table_top">加款</td>
<td width="6%" class="table_top">违规记录</td>
<td width="8%" class="table_top">上级</td>
<td width="7%" class="table_top">下级</td>
<td width="8%" class="table_top">修改</td>
<td width="4%" class="table_top">删除</td>
</tr>
<?php


$search="where 1=1 "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
if ($level!='')    $search.=" and level ='$level'"; 
if ($locks!='')    $search.=" and locks ='$locks'"; 
if ($abcd!='')     $search.=" and agent ='$abcd'"; 
if ($paixu=='')    $sorting.=" order by  number desc "; 
if ($paixu!='' and $a!='' ) $sorting.=" order by  $paixu $a,id desc "; 
if ($paixu!='' and $b!='' ) $sorting.=" order by  $paixu $b,id desc "; 
if ($paixu!='' and $c!='' ) $sorting.=" order by  $paixu $c,id desc "; 
if ($paixu!='' and $d!='' ) $sorting.=" order by  $paixu $d,id desc "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `members`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select id,level,username,number,agent,kuan,goods_kuan,frozen_kuan,bad_grades,locks,xlevel from members  $search  $sorting  {$page->limit}"; 


$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>

<tr>
<td><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row['id']?>"></td>
<td height="28"><a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$row['id']?>&Action=tongdao', { title: '众人通道码', width: 500, height: 300, lock: true, fixed:true,closeFn: function () {location.reload();}});"><span style="color:#009933; text-decoration:underline"><?=$row['number']?></span></a></td>
<td><?=$row['username']?></td>
<td><?php
$sql1="select * from level where id='$row[level]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
?><?=$row1['title']?></td>
<td><?=number_format($row['kuan'],3);?></td>
<td><?=number_format($row['goods_kuan'],3);?></td>
<td><a href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$row['id']?>&Action=frozen', { title: '冻结金额', width: 500, height:320, lock: true, fixed:true,closeFn: function () {location.reload();}});"> <span style="color:#009933; text-decoration:underline"><?=number_format($row['frozen_kuan'],3);?></span>   </a></td>
<td>
<?php if ($row['locks']=='0') {?>
<a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$row['id']?>&Action=locks', { title: '账户状态', width: 500, height: 350, lock: true, fixed:true,closeFn: function () {location.reload();}});"> <span style="color:#009933; text-decoration:underline">开通</span>  </a> 
<?php }else{?>     
<a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$row['id']?>&Action=locks', { title: '账户状态', width: 500, height: 300, lock: true, fixed:true,closeFn: function () {location.reload();}});"> <span style="color:#FF0000; text-decoration:underline">禁用</span> </a> 
<?php }?></td>
<td>  <a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$row['id']?>&Action=jiakuan', { title: '会员加款', width: 500, height: 300, lock: true, fixed:true,closeFn: function () {location.reload();}});" class="a addmoney">
                        </a></td>
<td><?=$row['bad_grades']?> 分</td>
<td><?=$row['agent']?></td>
<td><?=$row['xlevel']?> 个
</td>
<td><a href="?Action=edit&Id=<?=$row[id]?>">编辑</a>
<a href="?Action=qx&Id=<?=$row[id]?>">权限</a></td>
<td>
<a class="a delete" href="?Action=del&Id=<?=$row[id]?>" onClick="return confirm('您将删除该会员，您确定要这样操作吗？')"></a>                 </td>
</tr>
<?php
}
?>

<tr style="">
<td colspan="14">
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>
<div align="left">
<input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" onclick="Javascript:return confirm('确定要删除吗？');" class="x3_input" >
<input type="submit" name="Del" id="Del" value="开通" onclick="Javascript:return confirm('确定要开通账户吗？');" class="x3_input" >
<input type="submit" name="Del" id="Del" value="禁止" onclick="Javascript:return confirm('确定要禁止账户吗？');" class="x3_input" >
</div>                        </td>
<td><?php if ($total!=0){?><?=$page->paging();?><?php }?>       </td> 
</tr>
</table>            </td>
</tr>
</table>


</form>

<?php }elseif($Action=="edit"){  
$sql="select * from members where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="y1" name="y1" type="hidden" value="<?=$row['level']?>">
<input id="y2" name="y2" type="hidden" value="<?=$row['rname']?>">
<input id="y3" name="y3" type="hidden" value="<?=$row['card']?>">
<input id="y4" name="y4" type="hidden" value="<?=$row['email']?>">
<input id="y5" name="y5" type="hidden" value="<?=$row['phone']?>">
<input id="y6" name="y6" type="hidden" value="<?=$row['qq']?>">
<input id="y7" name="y7" type="hidden" value="<?=$row['address']?>">
<input id="y8" name="y8" type="hidden" value="<?=$row['number']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息修改</td>
</tr>
<tr>
<td width="10%" class="td_left">平台编号：</td>
<td width="90%" class="left"><?=$row['number']?></td>
</tr>
<tr>
<td width="10%" class="td_left">会员名称：</td>
<td width="90%" class="left"><?=$row['username']?></td>
</tr>

<tr>
<td class="td_left">会员级别：</td>
<td class="left">
<select name="level" id="level">  
<option  value="">请选择</option> 
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<option value="<?=$Orzx['id']?>" <?php if ($Orzx['id']==$row['level']) {?> selected="selected"<?php } ?>><?=$Orzx['title']?></option>
<?php 
} }?>
</select></td>
</tr>
<tr>
<td class="td_left">上级经销商：</td>
<td class="left"><?=$row['agent']?></td>
</tr>
<tr>
<td class="td_left">联系人姓名：</td>
<td class="left"><input name="rname" type="text" class="biankuan" value="<?=$row['rname']?>" /></td>
</tr>
<tr>
<td class="td_left">身份证号：</td>
<td class="left"><input name="card" type="text" class="biankuan" value="<?=$row['card']?>" /></td>
</tr>

<tr>
<td class="td_left">电子邮箱：</td>
<td class="left"><input name="email" type="text" class="biankuan" value="<?=$row['email']?>" /></td>
</tr>

<tr>
<td class="td_left">联系电话：</td>
<td class="left"><input name="phone" type="text" class="biankuan" value="<?=$row['phone']?>" /></td>
</tr>
<tr>
<td class="td_left">QQ号码：</td>
<td class="left"><input name="qq" type="text" class="biankuan" value="<?=$row['qq']?>" /></td>
</tr>
<tr>
<td class="td_left">联系地址：</td>
<td class="left"><input name="address" type="text" class="biankuan" value="<?=$row['address']?>" /></td>
</tr>
<tr>
<td class="td_left">注册时间：</td>
<td class="left"><?=date("Y-m-d G:i:s",$row['time'])?></td>
</tr>
<tr>
<td class="td_left">最后登录地址：</td>
<td class="left"><?=$row['lost_dz']?></td>
</tr>
<tr>
<td class="td_left">最后登录时间：</td>
<td class="left"><?=date("Y-m-d G:i:s",$row['lost_time'])?></td>
</tr>
<tr>
<td width="10%" class="td_left">操作密码：</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa"></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="qx"){  
$result=mysql_query("select * from members where id='$_REQUEST[Id]' ",$conn1);
$row=mysql_fetch_array($result);
?>
<form action="?Action=qxsave" method="post" name="add">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息修改</td>
</tr>
<tr>
<td width="10%" class="td_left">加款卡充值权限：</td>
<td width="90%" class="left">
<input name="power7" type="radio" value="0" <?php if ($row['power7']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power7" type="radio" value="1" <?php if ($row['power7']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>

<tr>
<td width="10%" class="td_left">自有商品发布权限：</td>
<td width="90%" class="left">
<input name="power5" type="radio" value="0" <?php if ($row['power5']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power5" type="radio" value="1" <?php if ($row['power5']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>
<tr>
<td width="10%" class="td_left">供货收入客户转余额：</td>
<td width="90%" class="left">
<input name="power6" type="radio" value="0" <?php if ($row['power6']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power6" type="radio" value="1" <?php if ($row['power6']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>

<tr>
<td width="10%" class="td_left">平台对接：</td>
<td width="90%" class="left">
<input name="power13" type="radio" value="0" <?php if ($row['power13']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power13" type="radio" value="1" <?php if ($row['power13']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>

<tr>
<td width="10%" class="td_left">淘宝网充值接口：</td>
<td width="90%" class="left">
<input name="power14" type="radio" value="0" <?php if ($row['power14']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power14" type="radio" value="1" <?php if ($row['power14']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>

<tr>
<td width="10%" class="td_left">5173平台充值接口：</td>
<td width="90%" class="left">
<input name="power15" type="radio" value="0" <?php if ($row['power14']=='0'){?>checked="checked" <?php }?>>  无  
<input name="power15" type="radio" value="1" <?php if ($row['power14']=='1'){?>checked="checked" <?php }?>>  有</td>
</tr>


<tr>
<td width="10%" class="td_left">操作密码：</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa"></td>
</tr>

<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
</td>
</tr>
</table>
</form>


<?php } ?>
</body>
</Html>
<script>
function checkuserinfo()
{
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
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<script>
function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>

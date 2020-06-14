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
$Action=strip_tags($_GET['Action']);
$keyword=strip_tags($_GET['keyword']);
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);



if ($Action=="Addsave") {
require '../../public/smtp.php'; 
$online=strip_tags($_POST['online']);       //发送类型
$title=strip_tags($_POST['title']);         //短信标题
$username=strip_tags($_POST['username']);   //接收者
$username1=strip_tags($_POST['username1']); //接收者
$content=strip_tags($_POST['content']); //内容
$allArray=(explode('|',$username));
echo "<br><br><center><img src='/Public/images/loding.gif'></center>";
ob_end_flush();
if     ($online=='0'){
foreach($allArray as $value){
echo str_pad(" ",256);
$yx_us_result=mysql_query("select * from members where number='$value' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$smtpserver =$smtp_email;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail =$send_email;//SMTP服务器的用户邮箱 
$smtpemailto =$yx_us[email];//发送给谁 
$smtpuser =$send_email;//SMTP服务器的用户帐号 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP服务器的用户密码 
$mailsubject =$title;//邮件主题 
$mailbody = $content;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug =false;//是否显示发送的调试信息 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$value',email='$yx_us[email]',begtime='$begtime'",$conn1);
echo $yx_us[email]."邮件发送成功！<br>";
}else{
echo $yx_us[email]."邮件发送失败！<br>";
}
ob_flush();
flush();  
sleep(5);

////////////////////////////////////////////////////////////////////////////////////////进行邮件发送
}





}elseif ($online=='1'){
	
$result=mysql_query("select * from members where level='$username1'",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
echo str_pad(" ",256);
$smtpserver =$smtp_email;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail =$send_email;//SMTP服务器的用户邮箱 
$smtpemailto =$user[email];//发送给谁 
$smtpuser =$send_email;//SMTP服务器的用户帐号 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP服务器的用户密码 
$mailsubject =$title;//邮件主题 
$mailbody = $content;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug =false;//是否显示发送的调试信息 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$user[number]',email='$user[email]',begtime='$begtime'",$conn1);
echo $user[email]."邮件发送成功！<br>";
}else{
echo $user[email]."邮件发送失败！<br>";
}
ob_flush();
flush();  
sleep(5);
}
}
}elseif ($online=='2'){
$result=mysql_query("select * from members ",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
echo str_pad(" ",256);
$smtpserver =$smtp_email;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail =$send_email;//SMTP服务器的用户邮箱 
$smtpemailto =$user[email];//发送给谁 
$smtpuser =$send_email;//SMTP服务器的用户帐号 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP服务器的用户密码 
$mailsubject =$title;//邮件主题 
$mailbody = $content;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug =false;//是否显示发送的调试信息 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$user[number]',email='$user[email]',begtime='$begtime'",$conn1);
echo $user[email]."邮件发送成功！<br>";
}else{
echo $user[email]."邮件发送失败！<br>";
}
ob_flush();
flush();  
sleep(5);

}
}
}
echo "<script>alert('发送成功!');self.location=document.referrer;</script>";
}
if ($Action=="del") {
mysql_query("delete from send_email where id ='$_REQUEST[id]'",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='删除'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from send_email where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}

?>

<?php if  ($Action=="List" or $Action==""){?>

<div class="Menubox" >
<ul>
<li class="hover"><a href="email.php">群发邮件</a></li>
</ul>
</div>

<form name="add" method="get" action="email.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">发送时间：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
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
<td width="6%" class="table_top">ID</td>
<td width="13%" class="table_top">编号</td>
<td width="20%" class="table_top">邮箱地址</td>
<td width="31%" class="table_top">邮箱标题</td>
<td width="17%" class="table_top">发送时间</td>
<td width="13%" class="table_top">操作</td>
</tr>
<?php

$search="where 1=1 ";
if ($keyword!='') $search.=" and title like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `send_email`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from send_email $search    order by begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr>
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td height="28"><?=$row['username']?></td>
<td><?=$row['email']?></td>
<td align="left">
<a href="#art1" onclick="art.dialog.open('email.php?Action=edit&Id=<?=$row['id']?>',{title: '<?=$row['title']?>', width: 600,lock: true, fixed:true});"><span style="color:#38af38; text-decoration:underline">
<?=$row['title']?>
</span>
</a>
</td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a href="?Action=del&id=<?=$row['id']?>">删除</a></td>
</tr>
<?php
}
?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="全选" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="删除" class="x3_input" onclick="return CheckSelect();"></td> 
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>
<?php }elseif($Action=="add"){?>
<script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}
//]]>
</script>
<div class="tishi1" style="margin-top:0px;">
1、邮件群发速度取决于您的网络速度以及您发送的客户数量；<br />
2、尽量别全部发送以免数据量大照成卡死状态当然如果您的会员量不多的话可以忽略；<br />
3、邮件群发不是百分百发送成功的；<br />
4、如果对方接收邮件不正确的话是接收不到您发送的邮件的；<br />
</div>
<form name="userinfo" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息添加</td>
</tr>
<tr>
<td width="10%" class="td_left"> 接收人类型：</td>
<td width="90%" class="left">	  <select name="online" id="online" onchange="switchView1(this.value)">   
<option selected="selected" value="">请选择</option>
<option value="2">全部用户</option>
<option value="0">指定用户</option>
<option value="1">指定级别</option>

</select>   </td>
</tr>
        
            
<tr  id="form1_0"  style="display:none">   
<td width="10%" class="td_left">  接收人：</td>
<td width="90%" class="left"><input name="username" type="text" id="username" style="width:362px;" class="biankuan" />  多个客户请编号中间用 | 隔开  </td>
</tr>
				
<tr  id="form1_1"  style="display:none">   
<td width="10%" class="td_left"> 
接收人：</td>
<td width="90%" class="left">  <select name="username1" id="username1">  
<option  value="" selected="selected">请选择</option> 
<?php
$result=mysql_query("select * from level order by id desc",$conn1);
if ($result){
while($level=mysql_fetch_array($result)){?>
<option value="<?=$level['id']?>"><?=$level['title']?></option>
<?php 
}
}?>  </select></td>
    </tr>
            
<tr>
<td width="10%" class="td_left">邮件主题：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">邮件内容：</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" class="biankuan"></textarea></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"/>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from send_email where id='$Id'",$conn1);
$row=mysql_fetch_array($result);	
echo $row['content'];
 } ?>
</body>
</Html>

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


<script language="javascript">
function checkuserinfo()
{

if(checkspace(document.userinfo.title.value)) {
document.userinfo.title.focus();
alert("提交失败，信息主题不能为空！");
return false;
}

if(checkspace(document.userinfo.content.value)) {
document.userinfo.content.focus();
alert("提交失败，信息描述不能为空！");
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
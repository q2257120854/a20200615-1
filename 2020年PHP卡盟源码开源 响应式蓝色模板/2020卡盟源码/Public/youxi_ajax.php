
<?php 
include_once('../jhs_config/function.php');
$begtime=$_POST['begtime'];       //时间
$Method=$_POST['Method'];
$username=$_POST['customerName'];//用户名
$password=md5($_POST['password']);//登录密码
$passwords=md5($_POST['tradePassword']);//交易密码
$province=mb_convert_encoding($_POST['province'],"gb2312","UTF-8");//省份
$city=mb_convert_encoding($_POST['city'],"gb2312","UTF-8");//城市
$company=mb_convert_encoding($_POST['company'],"gb2312","UTF-8");//公司
$rname=mb_convert_encoding($_POST['rname'],"gb2312","UTF-8");//真实姓名
$card=$_POST['card'];//身份证号码
$qq=$_POST['qq'];    //QQ号码
$phone=$_POST['phone'];//电话号码
$address=mb_convert_encoding($_POST['address'],"gb2312","UTF-8");//地址
$agent=$_POST['agent'];//代理
$network=ysk_network(Local_Ip());

///////////////////////////////////////////////////////////////////////////安全验证
if ($username=='' || $password=='' || $passwords=='' || $province=='' || $city=='' || $company=='' || $rname=='' || $card=='' || $begtime=='' || $qq=='' ||$phone==''){
echo "3";
exit();
}
///////////////////////////////////////////////////////////////////////////安全验证结束

if      ($agent!='' and $site_agent==$agent){
$site_leve=$site_leve;
}elseif ($agent=='' and $site_agent!='' ){
$site_leve=$site_leve;
}else{
$site_leve='1';
}

if  ($agent!=''){
$agent=$agent;
}else{
$agent=$site_agent;
}


////组合数据
$Local_Ip=Local_Ip();
$dates ="&".$username;
$dates.="&".$password;
$dates.="&".$passwords;
$dates.="&".$province;
$dates.="&".$city;
$dates.="&".$company;
$dates.="&".$rname;
$dates.="&".$card;
$dates.="&".$qq;
$dates.="&".$phone;
$dates.="&".$address;
$dates.="&".$agent;
$dates.="&".$network;
$dates.="&".$Local_Ip;
$dates.="&".$site_leve;
$dates.="&".$begtime;

$check=md5("{$dingdanhao}骚年破解ing");
//file_put_contents("d:/mylog.txt",$dates,FILE_APPEND);



if($Method=="Check_Reg_email"){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "405";
exit();
}
////////////////////////////////////进行IP验证3小时内无法在注册


$regresult=mysql_query("select * from  check_reg  where youip='$Local_Ip' order by begtime desc,id desc limit 0,1",$conn1);
$regrow=mysql_fetch_array($regresult);
$checktime=$begtime+$regrow['begtime'];//注册过期等于当前时间减去注册时间

if($regrow['begtime']!='' && $checktime<0){  //如果注册时间小于3小时则无法注册
echo "404";
exit();
}else{



////////////////////////////////////////////////////////////////////////////////////////进行邮件发送
////////邮箱程序
require 'smtp.php'; 
########################################## 
$smtpserver =$smtp_email;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail =$send_email;//SMTP服务器的用户邮箱 
$smtpemailto =$username;//发送给谁 
$smtpuser =$send_email;//SMTP服务器的用户帐号 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP服务器的用户密码 
$mailsubject = "您免费获得了一个".$site_name."账户！";//邮件主题 
$mailbody = "亲爱的用户您好<br><br>您刚刚免费获得了一个".$site_name."账户<br>登录后，需要您补全个人信息。请放心，您的信息是完全保密的。<br>请点击以下链接".$site_url."/check.php?m=reg&u=".$check;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug =false;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 

////////////////////////////////////////////////////////////////////////////////////////进行资料的更新
mysql_query("insert into `check_reg` set checkcode='$check',content='$dates',begtime='1529759140',locks=0,youip='$Local_Ip'",$conn1); 
echo "1";
exit();
}




}
?>

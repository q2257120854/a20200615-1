<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
/**
* <a href="http://www.jbxue.com/article/4087.html" target="_blank" class="infotextkey">PHPMailer</a>群发邮件的例子
* Edit www.jbxue.com
*/
require("../../Public/phpmailer/class.phpmailer.php");//调用phpmailer
function smtp_mail ($sendto_email,$subject,$body,$user_name,$host,$mailname,$mailpass,$text,$mail_table) {
$mail = new PHPMailer();
$mail->IsSMTP();                // send via SMTP
$mail->Host = $host; // SMTP servers
$mail->SMTPAuth = true;         // turn on SMTP authentication
$mail->Username =$mailname;   // SMTP username  注意：普通邮件认证不需要加 @<a href="http://www.jbxue.com/tags/yuming.html" target="_blank" class="infotextkey">域名</a>
$mail->Password =$mailpass;        // SMTP password
$mail->From = $mailname;      // 发件人邮箱
$mail->FromName =  "wangkan";  // 发件人
$mail->CharSet = "gb2312";            // 这里指定字符集！
$mail->Encoding = "base64";
$mail->AddAddress($sendto_email,"hello");  // 收件人邮箱和姓名
//$mail->AddBCC("邮箱", "ff");
//$mail->AddBCC("邮箱", "ff");这些可以暗送
//$mail->AddReplyTo("test@jbxue.com","aaa.com");
//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/qita/htestv2.rar"); // 附件
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
$mail->IsHTML(true);  // send as HTML
// 邮件主题
$mail->Subject = $subject;
// 邮件内容
$mail->Body =$text;
													
$mail->AltBody ="text/html";
if(!$mail->Send())
{
$error=$mail->ErrorInfo;
/*if($error=="smtpnot")//自定义错误，没有连接到smtp，掉包的情况，出现这种情况可以重新发送
{
sleep(2);
$song=<a href="http://www.jbxue.com/shouce/php5/function.explode.html" target="_blank" class="infotextkey">explode</a>("@",$sendto_email);
$img="<img height='0' width='0' src='http://www.jbxue.com/email.php?act=img&mail=".$sendto_email."&table=".$mail_table."' />";
smtp_mail($sendto_email,"发送".$song[0].$biaoti, 'NULL', 'abc',$sendto_email,$host,$mailname,$mailpass,
$img."发送".$song[0].$con,'$mail_table');//发送邮件
}*/
//发送失败把错误记录保存下来
}
else {
if($mailname=="aaa@jbxue.com")
{
echo ""; //个人需求，可以去掉
}
else
{
echo "$user_name 邮件发送成功!请查收邮箱确认！<br />";//发送成功
}
}
}
?>

<?php

sleep(3);
smtp_mail($mail,"发送".$song[0].$biaoti, 'NULL', 'abc',$mail,$host,$mailname,$mailpass,$img."发送".$song[0].$con,$mail_table);//发送邮件

?>
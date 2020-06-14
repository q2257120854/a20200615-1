<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php  
// 请求 PHPmailer类 文件 
error_reporting(E_ERROR); 
require_once("Public/phpmailer/class.phpmailer.php"); 
// 写入发送结果函数 
function info_write($filename,$info_log) 
{ 
$info.= $info_log; 
$info.="\r\n"; 
$fp = fopen ($filename,'a'); 
fwrite($fp,$info); 
fclose($fp); 
} 
//发送Email函数 
function smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name,$senderListConf,$sender=0) {  
$batch_no = date("Y_m_d_H"); 
$mail = new PHPMailer();   
$mail->IsSMTP(); 
$sender_info = $senderListConf[$sender]; 
if(!$sender_info) 'die 发送帐号出错了..............';   // send via SMTP   
$mail->Host = $sender_info['Host'];                       // SMTP servers   
$mail->SMTPAuth = true;                             // turn on SMTP authentication   
$mail->Username = $sender_info['Username'];                          // SMTP username     注意：普通邮件认证不需要加 @域名  
$mail->Password = $sender_info['Password'];                         // SMTP password   
$mail->From = $sender_info['Username'];                      // 发件人邮箱  
$mail->FromName = "淘宝推荐---TaoBao";                 //   发件人 ,比如 中国资金管理网 
$mail->CharSet = "gb2312";                          // 这里指定字符集！  
$mail->Encoding = "base64";   
$mail->AddAddress($sendto_email,$user_name);        // 收件人邮箱和姓名  
$mail->AddReplyTo("ken@cscsws.com","淘宝推荐");   

//$mail->WordWrap = 50; // set word wrap   
//$mail->AddAttachment("/var/tmp/file.tar.gz");                                                    // attachment  附件1 
//$mail->AddAttachment("/home/www/images/zhuanti/qiujibushui/qiujibushui_attache.jpg", "new.jpg");                                         //附件2 
$mail->IsHTML(true);                               // send as HTML   
$mail->Subject = $subject;                         

// 邮件内容      可以直接发送html文件 
$mail->Body = $body; 
$mail->AltBody ="text/html";   
if($mail->Send())   
{   
info_write("ok.txt","$user_name 发送成功"); 
}   
else 
{  
info_write("falied.txt","$user_name 失败,发送账号".$sender_info['Username'].",错误信息$mail->ErrorInfo"); 
if($senderListConf[$sender+1]) 
{ 
$sender = smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name,$senderListConf,($sender+1)); 
} 
} 
return $sender;  
}  ?>
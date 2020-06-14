<?php
//echo '聚合社卡盟系统 www.juheshe.cn Se7en QQ:94170844  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if($_SESSION['ysk_username']==''){
echo "<script language=\"javascript\">window.location.href='login.php';</script>";
exit();
}
$osql=mysql_query("select * from `administrator`  where username='$_SESSION[ysk_username]'",$conn1);
$admin=mysql_fetch_array($osql);
//-------------------------------嘿，没有密码你要怎么操作呢？
if ($_POST['papa']!=''){
$papa=md5($_POST['papa']);
if ($admin['passwords']!=$papa){
echo "<script>alert('对不起，您的操作密码有误！!');self.location=document.referrer;</script>";
exit();
}
}
?>
<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php 
include_once('jhs_config/function.php');
include_once('jhs_config/data_run.php');
$username=$_POST['username'];
$password=md5($_POST['password']);
$checkCode=$_POST['Code'];

if ($username=='' || $password==''){echo ysk_error(401,0);}
if ($_SESSION['checkCode']!='' && $_SESSION['checkCode']!=$checkCode){echo ysk_error(408,0);}
///////////////////////////////////////////////////////////////////////////骚年您的账户已被锁定
$record=mysql_num_rows(mysql_query("select * from password_lock where username='$username'",$conn1));
if ($record>0){echo ysk_error(402,0);}

$result=mysql_query("select * from members where    username='$username' ",$conn1);
$user=mysql_fetch_array($result);
if ($user){
if ($user['password']!=$password){
//-------获取错误次数
$error=$user['error']+1;
$errmsg=5-$error+1;
//-------密码错过5次则记录下来进行锁定
if ($error==5){
$Local_Ip=Local_Ip();
mysql_query("insert into `password_lock` set username='$username',yourip='$Local_Ip',begtime='$begtime' ",$conn1);
//-------更新记录并提示用户
mysql_query("update members set error='0' where username='$username'",$conn1); 
}else{
mysql_query("update members set error='$error' where username='$username'",$conn1); 	
}
//-------提示用户
echo ysk_error(405,$errmsg);
}elseif ($user['password']==$password && $user['locks']=='1'){//是否禁止
echo ysk_error(403,$user['ban_reason']);
}elseif ($user['password']==$password && $user['locks']=='2'){//是否冻结
$begtime=($user['freeze_time']+$user['overdue']*3600)-$begtime;///#####公式   当天时间 大于 （处罚时间+次数*3600秒）当天时间
if ($begtime>0) {echo ysk_error(404,$user['overdue']);}
}elseif ($user['password']==$password){
mysql_query("update members set error='0' where username='$username'",$conn1); 
if ($user['power2']=='1'){
$_SESSION['myaccount']=$username;
$_SESSION['mynumber']=$user['number'];
$_SESSION['mydiyici']=$user['firsts'];
$_SESSION['Platform_announcement']=1;
header('location:/index.php');
exit();
}
$_SESSION['ysk_number']=$user['number'];
$_SESSION['account']=$username;
$_SESSION['firsts']=$user['firsts'];
$_SESSION['Platform_announcement']=1;
if ($site_jump==0){
echo "<script language=\"javascript\">alert('$_POST[username] 登录成功！');window.location.href='/user/index.php';</script>";           
}else{
echo "<script language=\"javascript\">alert('$_POST[username] 登录成功！');window.location.href='index.php';</script>";   
}  
}


//////////////////////////////////////////////////该用户不存在
}else{
echo ysk_error(409,0);	
}
?>
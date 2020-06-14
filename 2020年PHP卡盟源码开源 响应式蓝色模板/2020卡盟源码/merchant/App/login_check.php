
<?php 
header("Content-Type: text/html; charset=gb2312");
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/data_run.php');
$username=$_POST['username'];
$password=md5($_POST['password']);
$checkCode=$_POST['Code'];


if ($_SESSION['yx_token']!=$_POST['Token']){
header('location:/404.php');
exit();
}

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
$network=ysk_network(Local_Ip());
$Local_Ip=Local_Ip();

mysql_query("update members set error='0',lost_time='$begtime',log_time='$user[lost_time]',lost_ip='$Local_Ip',log_ip='$user[lost_ip]',lost_dz='$network',log_dz='$user[lost_dz]' where username='$username'",$conn1); 
if ($user['power2']=='1'){
$_SESSION['myaccount']=$username;
$_SESSION['mynumber']=$user['number'];
$_SESSION['mydiyici']=$user['firsts'];
$_SESSION['Platform_announcement']=1;
header('location:AppOK.php');
exit();
}
$_SESSION['ysk_number']=$user['number'];
$_SESSION['account']=$username;
$_SESSION['firsts']=$user['firsts'];
$_SESSION['Platform_announcement']=1;
if ($site_jump==0){
echo "<script >window.location.href='AppOK.php';</script>";           
}else{
echo "<script >window.location.href='AppOK.php';</script>";   
}  
}


//////////////////////////////////////////////////该用户不存在
}else{
echo ysk_error(409,0);	
}
?>
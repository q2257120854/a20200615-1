<?php 
header('Content-type:text/html; charset=utf-8');
//include '../conndata.php';
$databases = include_once("../application/database.php");
 ?>
<?php
    $userid = $_POST['json'];
    $userid = substr($userid,6,8);
	$userid = substr($userid,0,strrpos($userid,',')); 
	$userid = substr($userid,1,8);
	$userid = substr($userid,0,strrpos($userid,'"')); 
	
// 创建链接
 //   $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    //检查
 if (!$db) {
 	die("数据库链接失败了" . mysqli_connect_error());
	}
  $userid =  (int)addslashes($userid); 
 	$sql="SELECT username,logintime FROM ap_user WHERE parentid=$userid or (pid=$userid and  pid>0) order by id desc";
	$result = mysqli_query($db,$sql);
	$suj=$result->fetch_all(); 
   echo json_encode($suj);
	 
    mysqli_close($db);
?>
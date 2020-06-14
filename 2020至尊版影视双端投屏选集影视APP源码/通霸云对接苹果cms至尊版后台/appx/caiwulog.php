<?php 
header('Content-type:text/html; charset=utf-8');
//include '../conndata.php';
$databases = include_once("../application/database.php");
 ?>
<?php
    $userid = $_POST['json'];
    $userid = substr($userid,7,8);
  	$userid = substr($userid,0,strrpos($userid,'"}')); 
// 创建链接
//  $db = new mysqli($servername, $myname, $pswd, $dbname);
    $db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    //检查
 if (!$db) {
 	die("数据库链接失败了" . mysqli_connect_error());
	}
   $userid = addslashes($userid);
  $sql="SELECT username,addtype,time,jinqian FROM ap_caiwumx WHERE uid = '$userid' order by time ";
	$result = mysqli_query($db,$sql);
	$suj=$result->fetch_all();
     echo json_encode($suj);
    mysqli_close($db); 
?>
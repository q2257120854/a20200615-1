<?php 
header('Content-type:text/html; charset=utf-8');
//include '../conndata.php';
$databases = include_once("../application/database.php");
 ?>
<?php
    $userid = $_POST['json'];
		//file_put_contents('./log.text',json_encode($_POST).'啊水' );
    $userid = substr($userid,7,8);
  		$userid = substr($userid,0,strrpos($userid,'"}')); 		$json = json_decode($_POST['json'],true); 		!$userid and $userid = $json['id'];
// 创建链接
  //  $db = new mysqli($servername, $myname, $pswd, $dbname);		
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    //检查
 if (!$db) {		echo json_encode(['msg'=>"数据库链接失败了" . mysqli_connect_error(),'code'=>0]); 		 return ''; 
	}
   $userid = addslashes($userid);
	$sql="SELECT time,status,jine FROM ap_txlog WHERE uid = '$userid' order by uid desc";
	$result = mysqli_query($db,$sql);
	$suj=$result->fetch_all();
   echo json_encode(['code'=>1,'msg'=>json_encode($suj)]);
    mysqli_close($db); 
?>
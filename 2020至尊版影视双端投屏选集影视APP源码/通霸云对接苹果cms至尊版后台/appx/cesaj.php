<?php 
header('Content-type:text/html; charset=utf-8');
//include '../conndata.php';
$databases = include_once("../application/database.php");
 ?>
<?php	//file_put_contents('./log.text', json_encode($_POST));
    $userid = $_POST['json'];
    $userid = substr($userid,6,8);
	$userid = substr($userid,0,strrpos($userid,',')); 
        $userid = substr($userid,1,8);
	$userid = substr($userid,0,strrpos($userid,'"')); 
	$shuji = $_POST['json'];
	 $shuji = strstr($shuji,"e");
	$shuji = substr($shuji,3,8);
	$shuji = substr($shuji,0,strrpos($shuji,'}')); 	echo json_encode(['msg'=>$shuji,'code'=>1]);  
	 $lstime = $shuji*60*60*24;
	 
	 $jint = time();
// 创建链接
   // $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    //检查
 if (!$db) {		echo json_encode(['msg'=>"数据库链接失败了" . mysqli_connect_error(),'code'=>0]); 
		 return '';
 }
	
	$sql="SELECT jbday FROM ap_shezi WHERE id = 1";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$jbdayx = $row["jbday"];
			}
			}else{
				// echo "系统设置";
				exit();
			}
	$signx = $shuji*$jbdayx;
	$userid = addslashes($userid);
	$sql="SELECT * FROM ap_user WHERE id = '$userid'";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$oldlstime = $row["lasttime"];
			if($oldlstime<$jint){
				$oldlstime=time();
			}
			$lstime = $oldlstime + $lstime;
			$oldsign = $row["sign"];
			$signx = $oldsign - $signx;
			}
			}else{				echo json_encode(['msg'=>"数据失败！",'code'=>0]); 
			}
	$sql="update ap_user set lasttime=$lstime, sign=$signx where id='$userid'";
    $obj = mysqli_query($db,$sql);
    if($obj && mysqli_affected_rows($db)){
       
    }else{
        echo json_encode(['msg'=>"兑换积分失败",'code'=>0]);
    }
    mysqli_close($db);
    
?>
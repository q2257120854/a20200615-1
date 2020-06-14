<?php 
//include '../conndata.php';
$databases = include_once("../application/database.php");
?>
<?php
 header('Content-type:text/html; charset=utf-8');
    $userid = $_POST['json'];
    $userid = substr($userid,6,8);
	$userid = substr($userid,0,strrpos($userid,','));
	$password = $_POST['json'];
	 $password = strstr($password,"e");
	 $password = substr($password,4,26); 
	$password = substr($password,0,strrpos($password,'"}')); 
	echo $password;
	$password = md5(sha1($password));

// 创建链接
  //  $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);

    //检查
 if (!$db) {
 	die("数据库链接失败了" . mysqli_connect_error());
 	}else{

	};
	/* $userid = addslashes($userid);
	$sql="SELECT * FROM ap_user WHERE id = '$userid'";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$oldlstime = $row["lasttime"];
			$lstime = $oldlstime + $lstime;
			$oldsign = $row["sign"];
			$signx = $oldsign - $signx;
			}
			}else{
				echo "数据失败！";
			} */
		
	$sql="update ap_user set password='$password' where id='$userid'";
    $obj = mysqli_query($db,$sql);
    if($obj && mysqli_affected_rows($db)){    
    }else{
        echo "修改失败";
    }
    mysqli_close($db);
    
?>
<?php 
header('Content-type:text/html; charset=utf-8');
//include '../conndata.php';
$databases = include_once("../application/database.php");
 ?>
<?php
     	$userid = $_POST['json'];
     		$arr=json_decode($userid,true);
			$userid =$arr['id'];
			$shujik = $arr['age'];
			$djblx = $arr['kj'];

				
   // 创建链接
  //  $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
  //检查
 if (!$db) {
 	die("数据库链接失败了" . mysqli_connect_error());
 	}
	
	$times=time();	
	$sql="SELECT ckfa,ckfb,ckfc,ckfd FROM ap_shezi WHERE id = 1";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$ckfax = $row["ckfa"];
			$ckfbx = $row["ckfb"];
			$ckfcx = $row["ckfc"];
			$ckfdx = $row["ckfd"];
			}
			}else{
				// echo "系统设置";
			}
			
			
 	$userid = addslashes($userid);
	$shujik = addslashes($shujik); 
	$sql="SELECT dianka FROM ap_dianka WHERE sbh='$shujik' and yid=0 and cha=0 limit 1";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$dianka = $row["dianka"];
		   echo $dianka;
			}
			}else{
				echo "点卡获取失败！" ;
				exit();
			}
		
		$sql="update ap_dianka set cha=$userid where dianka='$dianka'";
			$objcha = mysqli_query($db,$sql);
				if($objcha && mysqli_affected_rows($db)){
						
				}
		
		$sql="SELECT parentid,username FROM ap_user WHERE id = '$userid'";
		$resultfid = mysqli_query($db,$sql);
		if (mysqli_num_rows($resultfid)>0){
			while($row = mysqli_fetch_assoc($resultfid)){
				$parentidx = $row["parentid"];
				$usernamey = $row["username"];
				
				}
				}else{
					// echo "查询数据失败父id！";
					mysqli_close($db);
					exit();
				}
			
	 switch($shujik){
		case $shujik==30:
		$ckfxj=$ckfax;
		break;
		case $shujik==90:
		$ckfxj=$ckfbx;
		break;
		case $shujik==365:
		$ckfxj=$ckfcx;
		break;
		case $shujik==1000:
		$ckfxj=$ckfdx;
		break;	
	} 
	
		$sql="SELECT money FROM ap_user WHERE id = '$parentidx'";
		$resultmy = mysqli_query($db,$sql);
		if (mysqli_num_rows($resultmy)>0){
			while($row = mysqli_fetch_assoc($resultmy)){
					
				$moneya = $row["money"]+$ckfxj;
				}
				}else{
					// echo "查询数据失败1money！";
					mysqli_close($db);
					exit();
				}	
		 $jinqianx = $ckfxj."yuan";
		$sql="update ap_user set money=$moneya WHERE id='$parentidx'";
			$objx = mysqli_query($db,$sql);
			if($objx && mysqli_affected_rows($db)){
				$sqlx="insert into ap_caiwumx(uid,username,type,addtype,time,jinqian) values($parentidx,'$usernamey',0,$shujik,$times,'$jinqianx')";
				$db->query($sqlx);
					}else{
							
							mysqli_close($db);
							exit();
					}
					
				
					
// 	$sql="delete from ap_dianka where dianka='$dianka'";
//     $obj = mysqli_query($db,$sql);
//     if($obj && mysqli_affected_rows($db)){
//         
//     }else{
//         echo "啊奥！";
//     }
    mysqli_close($db);
?>
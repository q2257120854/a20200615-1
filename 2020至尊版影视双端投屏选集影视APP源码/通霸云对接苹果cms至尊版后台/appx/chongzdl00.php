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
	 // echo $userid;
  //  $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    
//检查
 if (!$db) {
 	die("数据库链接失败了" . mysqli_connect_error());
 	}
	$userid = addslashes($userid);
	$times=time();	
	$sql="SELECT jybh FROM ap_czlog WHERE uid = '$userid' and type=88 order by id desc limit 1";
	$resultyz = mysqli_query($db,$sql);
	if (mysqli_num_rows($resultyz)>0){
		while($row = mysqli_fetch_assoc($resultyz)){
			$jybhyz = $row["jybh"];
			$jybhyz=substr($jybhyz, -8, 6);
			}
			}else{
				echo "无代理充值记录！" ;
				exit();
			}
	$riqiyz=date('ymd',time());
	if($riqiyz==$jybhyz){
		
	}else{
		echo "开通代理失败！".$riqiyz.$jybhyz;
		exit();
	}
		
	$sql="SELECT dljba,dljbb,dljbc,dljbd,dljbe,fdljb FROM ap_shezi WHERE id = 1";
	$resultsz = mysqli_query($db,$sql);
	if (mysqli_num_rows($resultsz)>0){
		while($row = mysqli_fetch_assoc($resultsz)){
			$dljba = $row["dljba"];
			$dljbb = $row["dljbb"];
			$dljbc = $row["dljbc"];
			$dljbd = $row["dljbd"];
			$dljbe = $row["dljbe"];
			$fdljb = $row["fdljb"];
			}
			}else{
				 // echo "系统设置";
				exit();
			}
		
		
		$sql="SELECT username FROM ap_user WHERE id = '$userid'";
		$result = mysqli_query($db,$sql);
		if (mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$usernamex = $row["username"];
				}
				}else{
					 echo $userid."lkj";
					 echo "用户名";
					 
					 mysqli_close($db);
					exit();
				}	
	///////////////////////////////////////////////////////////////1	
  $sql="update ap_user set power=1 where id='$userid'";
    $obj = mysqli_query($db,$sql);
    if($obj && mysqli_affected_rows($db)){   
			echo "恭喜您开通代理成功！您将尊享平台红利！请重新登入";
    }else{
        echo "开通代理失败";
				mysqli_close($db);
				exit();
    }
		$sql="SELECT parentid FROM ap_user WHERE id = '$userid'";
		$result = mysqli_query($db,$sql);
		if (mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$parentida = $row["parentid"];
				}
				}else{
					// echo "查询数据失败父id！";
					mysqli_close($db);
					exit();
				}
			$sql="SELECT money,power FROM ap_user WHERE id = '$parentida'";
			$resulta = mysqli_query($db,$sql);
			if (mysqli_num_rows($resulta)>0){
				while($row = mysqli_fetch_assoc($resulta)){
					$moneya = $row["money"];
					$powerx = $row["power"];
					
					}
					}else{
						// echo "查询数据失败1money！";
						mysqli_close($db);
						exit();
					}		
				if($powerx==1){
					$moneya = $moneya+$dljba;
				}
				if($powerx==2){
					$moneya = $moneya+$fdljb;
					}
		$sql="update ap_user set money=$moneya WHERE id='$parentida'";
			$obja = mysqli_query($db,$sql);
			if($obja && mysqli_affected_rows($db)){
				if($powerx==1){
					$sqla="insert into ap_dlmoneylog(uid,time,username,status,jine) values($parentida,$times,'$usernamex',1,$dljba)";
				}
				if($powerx==2){
					$jinqianf = $fdljb."yuan";
					$sqla="insert into ap_caiwumx(uid,username,type,addtype,time,jinqian) values($parentida,'$usernamex',1,200,$times,'$jinqianf')";
					}
				$db->query($sqla);
			}else{
					// echo "一级代理失败!";
					mysqli_close($db);
					exit();
			}
		///////////////////////////////////////1
		$sql="SELECT parentid FROM ap_user WHERE id = '$parentida'";
		$resultb = mysqli_query($db,$sql);
		if (mysqli_num_rows($resultb)>0){
			while($row = mysqli_fetch_assoc($resultb)){
				$parentidb = $row["parentid"];
				}
				}else{
					// echo "查询数据失败父2id！";
					mysqli_close($db);
					exit();
				}
			$sql="SELECT money FROM ap_user WHERE id = '$parentidb' and power=1";
			$resultbb = mysqli_query($db,$sql);
			if (mysqli_num_rows($resultbb)>0){
				while($row = mysqli_fetch_assoc($resultbb)){
					$moneyb = $row["money"]+$dljbb;
					}
					}else{
						// echo "查询数据失败2money！";
						mysqli_close($db);
						exit();
					}	
		$sql="update ap_user set money=$moneyb WHERE id='$parentidb'";
			$objb = mysqli_query($db,$sql);
			if($objb && mysqli_affected_rows($db)){
				$sqlb="insert into ap_dlmoneylog(uid,time,username,status,jine) values($parentidb,$times,'$usernamex',2,$dljbb)";
				$db->query($sqlb);	
			}else{
					// echo "二级代理失败!";
					mysqli_close($db);
					exit();
			}
		///////////////////////////////////////////////////////2
		$sql="SELECT parentid FROM ap_user WHERE id = '$parentidb'";
		$resultc = mysqli_query($db,$sql);
		if (mysqli_num_rows($resultc)>0){
			while($row = mysqli_fetch_assoc($resultc)){
				$parentidc = $row["parentid"];
				}
				}else{
					// echo "查询数据失败父3id！";
					mysqli_close($db);
					exit();
				}
			$sql="SELECT money FROM ap_user WHERE id = '$parentidc' and power=1";
			$resultcc = mysqli_query($db,$sql);
			if (mysqli_num_rows($resultcc)>0){
				while($row = mysqli_fetch_assoc($resultcc)){
					$moneyc = $row["money"]+$dljbc;
					}
					}else{
						// echo "查询数据失败3money！";
						mysqli_close($db);
						exit();
					}		
		$sql="update ap_user set money=$moneyc WHERE id='$parentidc'";
			$obj3 = mysqli_query($db,$sql);
			if($obj3 && mysqli_affected_rows($db)){
				$sqlc="insert into ap_dlmoneylog(uid,time,username,status,jine) values($parentidc,$times,'$usernamex',3,$dljbc)";
				$db->query($sqlc);
			}else{
					// echo "三级代理失败!";
					mysqli_close($db);
					exit();
			}
			/////////////////////////////////////////////3
			$sql="SELECT parentid FROM ap_user WHERE id = '$parentidc'";
			$resultd = mysqli_query($db,$sql);
			if (mysqli_num_rows($resultd)>0){
				while($row = mysqli_fetch_assoc($resultd)){
					$parentidd = $row["parentid"];
					}
					}else{
						// echo "查询数据失败父4id！";
						mysqli_close($db);
						exit();
					}
				$sql="SELECT money FROM ap_user WHERE id = '$parentidd' and power=1";
				$resultdd = mysqli_query($db,$sql);
				if (mysqli_num_rows($resultdd)>0){
					while($row = mysqli_fetch_assoc($resultdd)){
						$moneyd = $row["money"]+$dljbd;
						}
						}else{
							// echo "查询数据失败4money！";
							mysqli_close($db);
							exit();
						}		
			$sql="update ap_user set money=$moneyd WHERE id='$parentidd'";
				$obj4 = mysqli_query($db,$sql);
				if($obj4 && mysqli_affected_rows($db)){
					$sqld="insert into ap_dlmoneylog(uid,time,username,status,jine) values($parentidd,$times,'$usernamex',4,$dljbd)";
					$db->query($sqld);
				}else{
						// echo "四级代理失败!";
						mysqli_close($db);
						exit();
				}
		////////////////////////////////////////4
			$sql="SELECT parentid FROM ap_user WHERE id = '$parentidd'";
			$resulte = mysqli_query($db,$sql);
			if (mysqli_num_rows($resulte)>0){
				while($row = mysqli_fetch_assoc($resulte)){
					$parentide = $row["parentid"];
					}
					}else{
						// echo "查询数据失败父5id！";
						mysqli_close($db);
						exit();
					}
				$sql="SELECT money FROM ap_user WHERE id = '$parentide' and power=1";
				$resultee = mysqli_query($db,$sql);
				if (mysqli_num_rows($resultee)>0){
					while($row = mysqli_fetch_assoc($resultee)){
						$moneye = $row["money"]+$dljbe;
						}
						}else{
							// echo "查询数据失败5money！";
							mysqli_close($db);
							exit();
						}				
			$sql="update ap_user set money=$moneye WHERE id='$parentide'";
				$obj5 = mysqli_query($db,$sql);
				if($obj5 && mysqli_affected_rows($db)){
					$sqle="insert into ap_dlmoneylog(uid,time,username,status,jine) values($parentide,$times,'$usernamex',5,$dljbe)";
					$db->query($sqle);
				}else{
						// echo "五级代理失败!";
						mysqli_close($db);
						exit();
				}	
    mysqli_close($db);
?>
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
	$shuji = $_POST['json'];
	 $shuji = strstr($shuji,"e");
	$shuji = substr($shuji,3,8);
	$shuji = substr($shuji,0,strrpos($shuji,'}')); 
	 $moneyx = $shuji;
	 $_moneyx = $shuji;
	 
// 创建链接
//    $db = new mysqli($servername, $myname, $pswd, $dbname);
$db = new mysqli($databases['hostname'],$databases['database'], $databases['password'],$databases['username']);
    //检查
 if (!$db) {
	 echo json_encode(['msg'=>"数据库链接失败了" . mysqli_connect_error(),'code'=>0]); 
		 return '';  
 	}
	$userid = addslashes($userid);
	$sql="SELECT * FROM ap_user WHERE id = '$userid'";
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$txjc = $row["tx"];
			$yhnic= $row["username"];
			$yhzfb= $row["zfb"];
			$yhwx= $row["weixin"];
			$daoqi=$row['lasttime'];
            $oldmoney=$row['money'];
           if($oldmoney<$moneyx){
          echo json_encode(['msg'=>"余额不足，无法提提现！" ,'code'=>0]); 
				return ''; 
          }
          if ($daoqi+$shijian<time()){
           echo json_encode(['msg'=>"您不是会员无法参与返利活动，请先充值会员！" ,'code'=>0]); 
				return ''; 
          }
			 if($yhzfb == ""){
				 echo json_encode(['msg'=>"温馨提示：请先上传收款码在进行提现！" ,'code'=>0]); 
				return '';  
			}
			if($txjc==1){
				 echo json_encode(['msg'=>"您有一笔提现正在处理中...！暂时无法发起提现申请" ,'code'=>0]); 
				return '';  
			}
			//echo $moneyx;
			$oldmoney = $row["money"];
			$moneyx = $oldmoney - $moneyx;
			}
			}else{
				 echo json_encode(['msg'=>"数据库链接失败了" ,'code'=>0]); 
				return '';   
			}
			$times=time();
	$sql="update ap_user set money=$moneyx, txje=$shuji, tx=1 where id='$userid'";
    $obj = mysqli_query($db,$sql);
    if($obj && mysqli_affected_rows($db)){
      
			$sqlb="insert into ap_txlog(uid,time,nickname,status,jine,zfb,weixin) values('$userid',$times,'$yhnic','wait','$shuji','$yhzfb','$yhwx')";
			$db->query($sqlb);	
			
    }else{
		 echo json_encode(['msg'=>"提现失败" ,'code'=>0]); 
		   mysqli_close($db);
		return '';    
    }
		
    mysqli_close($db);
    
	echo json_encode(['msg'=>$_moneyx  ,'code'=>1]); 
	return ''; 
		
?>
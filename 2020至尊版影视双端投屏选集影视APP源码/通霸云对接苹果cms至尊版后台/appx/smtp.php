<?php
$userid = $_POST['emal'];

$email =$userid;  //邮箱地址
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['msg'=>"ok" ,'code'=>1]); 
				return ''; 
} else {
     echo json_encode(['msg'=>"请输入正确邮箱格式！" ,'code'=>0]); 
				return ''; 
}
echo $emailMsg;
?>
<?php
require './function.php';
write_log('./log/return.php','返回参数',$_POST);

if($_POST['pay_status']==1){
    echo '支付成功';
}
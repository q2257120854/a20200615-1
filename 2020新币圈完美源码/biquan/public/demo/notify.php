<?php
require './function.php';
write_log('./log/notify.php', '返回参数', $_POST);
$secret=get_api_arr()[$_POST['appid']];
if(request_param($_POST,$secret)['sign']==$_POST['sign']){
    if($_POST['pay_status']==1){
        //todo 成功
    }else{
        //todo 失败
    }
    //todo 自己的业务
    echo 'SUCCESS';exit;
}

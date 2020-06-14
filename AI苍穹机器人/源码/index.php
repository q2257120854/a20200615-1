<?php
	
	//代理IP直接退出
empty($_SERVER['HTTP_VIA']) or exit('Access Denied');
//防止快速刷新
session_start();
$seconds = '3'; //时间段[秒]
$refresh = '5'; //刷新次数
//设置监控变量
$cur_time = time();
if(isset($_SESSION['last_time'])){
    $_SESSION['refresh_times'] += 1;
}else{
    $_SESSION['refresh_times'] = 1;
    $_SESSION['last_time'] = $cur_time;
}
//处理监控结果
if($cur_time - $_SESSION['last_time'] < $seconds){
    if($_SESSION['refresh_times'] >= $refresh){
        //跳转至攻击者服务器地址
        header(sprintf('Location:%s', 'http://127.0.0.1'));
        exit('Access Denied');
    }
}else{
    $_SESSION['refresh_times'] = 0;
    $_SESSION['last_time'] = $cur_time;
}
	define('APP_NAME', 'APP');
	define('APP_PATH', './APP/');
	define('ROOT_PATH', dirname(__FILE__));
	define('PUBLIC_PATH', ROOT_PATH.'/Public');
	define('APP_DEBUG', true);
	define('RUNTIME_PATH', APP_PATH . 'Runtime/');
	include './ThinkPHP/ThinkPHP.php';
<?php
namespace app\socket\controller;
use \Workerman\Worker;
use \GatewayWorker\Register;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;
use think\Cache;
class Bqworker 

{

    public function __construct(){
        ///register-------------------------------------------------------------------------------------
        $register = new Register('text://0.0.0.0:'.REPORT);
        //gateway
        // gateway 进程---------------------------------------------------------------------------------
        $gateway = new Gateway("Websocket://0.0.0.0:".WSPORT);//120.78.153.125
        // 设置名称，方便status时查看
        $gateway->name = GMNAME.'_getwaya';
        // 设置进程数，gateway进程数建议与cpu核数相同
        $gateway->count = 4;
        // 分布式部署时请设置成内网ip（非127.0.0.1）
        $gateway->lanIp = '127.0.0.1';
        // 内部通讯起始端口。假如$gateway->count=4，起始端口为2300
        // 则一般会使用2300 2301 2302 2303 4个端口作为内部通讯端口 
        // 服务注册地址
        $gateway->registerAddress = '127.0.0.1:'.REPORT;
        $gateway->startPort = GWPORT;
        // 心跳间隔
        $gateway->pingInterval = 0;
        // 心跳数据
        $gateway->pingData = '{"y":"xintiao"}';

        //Worker 进程------------------------------------------------------------------------------------
        $worker = new BusinessWorker();
        // worker名称
        $worker->name = GMNAME.'_business';
        // bussinessWorker进程数量
        $worker->count = 2;
        // 服务注册地址
        $worker->registerAddress = '127.0.0.1:'.REPORT;
        //设置处理业务的类,此处制定Events的命名空间
        $worker->eventHandler = 'app\socket\controller\Bqevents';
        // 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }
    }

}


<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 3:09 AM
 */

namespace app\lib\command;


use app\lib\pinduoduo\Tools;
use app\system\model\Orders;
use app\system\model\Client;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class Notify extends Command
{
    protected function configure()
    {
        $this->setName('Notify')->setDescription('Here is Notify');
    }

    protected function execute(Input $input, Output $output)
    {
        $page = 1;
        while (true) {
            $list = Orders::where(['status' => ['gt',Orders::UNPAY]])->where('notify_number', '<', 6)->where(['notify_status'=>2])->order('id', 'asc')->page($page)->limit(50)->select();
            if ($list->isEmpty()) break;
            // 通知发送时间 1分钟 2分钟 3分钟 5分钟 10分钟
            foreach ($list as $order) {
                switch ( $order['notify_number'] ){
                    case 1:
                        if( $order['notify_time']+60 <= time() ){
                            $this->send($order);
                        }
                        break;
                    case 2:
                        if( $order['notify_time']+(60*2) <= time() ){
                            $this->send($order);
                        }
                        break;
                    case 3:
                        if( $order['notify_time']+(60*3) <= time() ){
                            $this->send($order);
                        }
                        break;
                    case 4:
                        if( $order['notify_time']+(60*5) <= time() ){
                            $this->send($order);
                        }
                        break;
                    case 5:
                        if( $order['notify_time']+(60*10) <= time() ){
                            $this->send($order);
                        }
                        break;
                }
            }

            //sleep(1);
            $page++;
        }
    }

    /**
     * 发送通知
     */
    private function send($order){
        $client = Client::get(['id' => $order->c_id]);
        $type = '';
        switch ($order->pay_type) {
            case Orders::WECHAT :
                $type = Orders::$payments[Orders::WECHAT];
                break;
            case Orders::ALIPAY :
                $type = Orders::$payments[Orders::ALIPAY];
                break;
        }
        Tools::notify($order->notify_url, [
            'callbacks' => 'CODE_SUCCESS',
            'type' => $type,
            'total' => $order->total,
            'api_order_sn' => $order->api_order_sn,
            'order_sn' => $order->order_sn,
        ], $client->client_secret);
    }

}
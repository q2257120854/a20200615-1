<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 5:26 AM
 */

namespace app\index\home;


use app\lib\pinduoduo\Tools;
use app\system\model\Orders;
use app\system\model\Client;
use think\Controller;


/**
 * 支付平台接口
 * Class Api
 * @package app\index\home
 */
class Notify extends Controller
{

    public function index() {
        $list = Orders::where(['is_pay'=>1])->where('notify_number', '>', 0)->where('notify_number', '<', 6)->where(['notify_status' => 2])->order('id', 'asc')->select();
        dump($list);
//        die;
        // 通知发送时间 1分钟 2分钟 3分钟 5分钟 10分钟
        foreach ($list as $order) {
            switch ($order['notify_number']) {
                case 1:
                    if ($order['notify_time'] + 60 <= time()) {
                        $this->send($order);
                    }
                    break;
                case 2:
                    if ($order['notify_time'] + (60 * 2) <= time()) {
                        $this->send($order);
                    }
                    break;
                case 3:
                    if ($order['notify_time'] + (60 * 3) <= time()) {
                        $this->send($order);
                    }
                    break;
                case 4:
                    if ($order['notify_time'] + (60 * 5) <= time()) {
                        $this->send($order);
                    }
                    break;
                case 5:
                    if ($order['notify_time'] + (60 * 10) <= time()) {
                        $this->send($order);
                    }
                    break;
            }
        }
    }

    /**
     * 发送通知
     */
    private function send($order) {
        $client = Client::get(['id' => $order['c_id']]);
        $type = '';
        switch ($order['pay_type']) {
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
            'total' => $order['total'],
            'api_order_sn' => $order['api_order_sn'],
            'order_sn' => $order['order_sn'],
        ], $client->client_secret);
    }
}
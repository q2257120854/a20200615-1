<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 3:09 AM
 */

namespace app\lib\command;


use app\lib\exception\PinduoduoException;
use app\lib\pinduoduo\MobileClient;
use app\system\model\Orders;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Exception;

class Received extends Command
{
    protected function configure()
    {
        $this->setName('Received')->setDescription('Here is Received');
    }

    public function execute(Input $input, Output $output)
    {
        $page = 1;
        while (true) {

            $list = Orders::with('User')->where(['status' => [Orders::UNSHOPING, Orders::UNRECEIVED]])->order('id', 'desc')->page($page)->limit(50)->select();

            if ($list->isEmpty()) break;

            foreach ($list as $order) {
                $orderModel = new Orders();
                $newOrder = $orderModel->getAndUpdateOrderByOrderSN($order->order_sn, true);
                if ($newOrder->status == Orders::UNRECEIVED) {
                    $mobileClient = new MobileClient($newOrder, true);
                    \Log::record('received: ' . $newOrder->order_sn);
                    try {
                        $mobileClient->received($newOrder->order_sn);
                        \Log::record('received success');
                        $orderModel->getAndUpdateOrderByOrderSN($order->order_sn, true);
                    } catch (PinduoduoException $e) {
                        \Log::record('received fail');
                    }
                }
            }

            //sleep(1);
            $page++;
        }
    }
}
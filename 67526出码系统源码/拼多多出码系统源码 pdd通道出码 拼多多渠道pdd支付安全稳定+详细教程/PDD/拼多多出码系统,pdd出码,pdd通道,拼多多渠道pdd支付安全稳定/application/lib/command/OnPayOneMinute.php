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
use think\console\Command;
use think\console\Input;
use think\console\Output;

class OnPayOneMinute extends Command
{
    protected function configure()
    {
        $this->setName('OnPayOneMinute')->setDescription('Here is OnPayOneMinute');
    }

    public function execute(Input $input, Output $output)
    {

        $page = 1;
        while (true) {

            //五分钟以内的订单
            $start = date('Y-m-d H:i:s', time() - 60 * 2);

            $list = Orders::where(['status' => Orders::UNPAY])->where('ctime', '>', $start)->order('id', 'asc')->page($page)->limit(50)->select();

            if ($list->isEmpty()) break;

            foreach ($list as $order) {
                $orderModel = new Orders();
                $orderModel->getAndUpdateOrderByOrderSN($order->order_sn, true);
            }

            //sleep(1);
            $page++;
        }
    }
}
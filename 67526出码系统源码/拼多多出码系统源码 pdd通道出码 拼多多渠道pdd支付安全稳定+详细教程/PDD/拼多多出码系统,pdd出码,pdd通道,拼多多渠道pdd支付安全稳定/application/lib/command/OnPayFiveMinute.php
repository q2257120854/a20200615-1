<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 3:09 AM
 */

namespace app\lib\command;


use app\system\model\Orders;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class OnPayFiveMinute extends Command
{
    protected function configure()
    {
        $this->setName('OnPayFiveMinute')->setDescription('Here is OnPayFiveMinute');
    }

    public function execute(Input $input, Output $output)
    {

        $page = 1;
        while (true) {

            //五分钟以前的订单
            $end = date('Y-m-d H:i:s', time() - 60 * 5);
            $start = date('Y-m-d H:i:s', strtotime('-2 hours'));

            $list = Orders::where(['status' => Orders::UNPAY])
                ->where('ctime', '>', $start)
                ->where('ctime', '<', $end)->order('id', 'desc')->page($page)
                ->limit(50)->select();

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
<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 3:09 AM
 */

namespace app\lib\command;


use app\system\model\Orders;
use app\system\model\Reports;
use app\system\model\Stores;
use app\system\model\SystemUser;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class Statistic extends Command
{
    protected function configure()
    {
        $this->setName('Statistic')->setDescription('Here is the Statistic');
    }

    public function execute(Input $input, Output $output)
    {
        //重置店铺收益
        Stores::where('cur_total', '>', 0)->update(['cur_total' => 0]);
        Stores::where('order_total', '>', 0)->update(['order_total' => 0]);

        $page = 1;
        while (true) {
            $admins = SystemUser::where(['status' => 1])->field('id')->page($page)->limit(10)->select();
            if ($admins->isEmpty()) break;
            foreach ($admins as $admin) {
                $admin_uid = $admin['id'];

                $start = date('Y-m-d H:i:s', strtotime('-1 day'));
                $end = date('Y-m-d H:i:s');

                $day = 0;
                $cy_day = 0;
                $day = Orders::whereTime('ctime', 'between', [$start, $end])->where(['admin_uid' => $admin_uid])->sum('total');
                $cy_day = Orders::whereTime('ctime', 'between', [$start, $end])->where(['admin_uid' => $admin_uid])->where(['from_platform' => Orders::FROM_PLAFORM])->sum('total');
                $dateline = time();
                $day_sum = $day;
                $cy_day_sum = $cy_day;

                $reports = new Reports([
                    'admin_uid' => $admin_uid,
                    'day' => $day,
                    'cy_day' => $cy_day,
                    'dateline' => $dateline,
                    'day_sum' => $day_sum,
                    'cy_day_sum' => $cy_day_sum,
                ]);
                $reports->save();
            }
            $page++;
        }
    }
}
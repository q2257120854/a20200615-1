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

class Test extends Command
{
    protected function configure()
    {
        $this->setName('Test')->setDescription('Here is Test');
    }

    protected function execute(Input $input, Output $output)
    {
        \Log::init([
            'level' => ['diy']
        ]);
        \Log::record('test', 'diy');
    }
}
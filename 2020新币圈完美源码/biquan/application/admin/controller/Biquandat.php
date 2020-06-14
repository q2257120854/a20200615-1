<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 每一局押注
 *
 * @icon fa fa-circle-o
 */
class Biquandat extends Backend
{

    /**
     * Dat模型对象
     * @var \app\admin\model\biquan\Dat
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\biquan\Dat;

    }

    public function dankon()
    {
        $ids = $this->request->param('ids');
        $type = $this->request->param('type');

        $where['id'] = $ids;
        $dd = $this->model->where($where)->find();
        $xredis = $this->xredis(1);
        $nowdat = $xredis->get('setorderyzr' . $dd->buytime);

        if ($type == 3) { //1杀 2，公平，3，必赢
            if (!$nowdat) {
                $this->success('订单已经开了,无法放水了!');
            }
            else {
                $dat = json_decode($nowdat, true);
                $dat['ifkill'] = 2;
                $str = "----放水----";
            }
            $this->model->where($where)->setfield('ifkill', 2);
        }
        else {
            $name = array('编辑', '点杀', '修改');
            if (!$nowdat) {
                $this->success('订单已经开了,无法' . $name[$type] . '!');
            }
            else {
                $dat = json_decode($nowdat, true);
                if ($type == 2) {
                    $dat['ifkill'] = 0;
                    $str = "原来属性:必杀改成==》公平";
                }
                else {
                    $dat['ifkill'] = 1;
                    $str = "原来属性:公平改成==》必杀";
                }

            }
            $this->model->where($where)->setfield('ifkill', $dat['ifkill']);
        }
        $xredis->set('setorderyzr' . $dd->buytime, json_encode($dat));
        $this->success('' . $str);
    }

    private function xredis($select = 0)
    {
        $redisConfig = config('cache');
        $redisObj = new \Redis();
        $redisObj->connect($redisConfig['host'], $redisConfig['port']);
        $redisObj->auth($redisConfig['password']);
        $auth = $redisObj->select($select); //设置密码
        return $redisObj;
    }
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

}

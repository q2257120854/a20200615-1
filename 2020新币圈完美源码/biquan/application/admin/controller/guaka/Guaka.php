<?php

namespace app\admin\controller;
use app\common\controller\Backend;
use think\Config;
use think\Hook;
use think\Validate;

/**
 * 后台首页
 * @internal
 */
class Guaka extends Backend
{

    protected $noNeedLogin = ['*'];//需要登陆
    protected $noNeedRight = ['index', 'logout'];//需要认证
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }
        public function index()
    {
        $this->error("Guaka模型控制器");
    }

}

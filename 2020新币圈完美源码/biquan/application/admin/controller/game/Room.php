<?php

namespace app\admin\controller\Game;

use app\common\controller\Backend;

/**
 * 控制器间跳转
 *
 * @icon fa fa-table
 * @remark 支持在控制器间跳转,点击后将切换到另外一个TAB中,无需刷新当前页面
 */
class Room extends Backend
{

    protected $model = null;
    protected $noNeedRight = ['start', 'pause', 'change', 'detail', 'cxselect', 'searchlist' ,'index'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('AdminLog');
    }

}

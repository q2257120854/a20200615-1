<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/1
 * Time: 10:28 PM
 */

namespace app\index\home;




use app\lib\exception\LoginException;
use app\system\model\SystemUser;

class Pinduoduo extends Base
{

    public function initialize()
    {
        parent::initialize();

        $model = new SystemUser();

        // 判断登陆
        $login = $model->isLogin();
        if (!$login['uid']) {
            throw new LoginException();
        }
    }

    /**
     * 首页
     */
    public function index()
    {
        $admin_user = session('admin_user');
        if ($admin_user) {
            $admin_uid = $admin_user['uid'];
        } else {
            $admin_uid = 0;
        }
        $this->view->assign('admin_uid', $admin_uid);
        return $this->view->fetch();
    }
}
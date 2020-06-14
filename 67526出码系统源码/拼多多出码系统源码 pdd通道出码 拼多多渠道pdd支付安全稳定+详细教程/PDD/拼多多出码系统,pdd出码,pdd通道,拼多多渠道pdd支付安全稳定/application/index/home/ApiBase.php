<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/6
 * Time: 5:26 AM
 */

namespace app\index\home;


use app\lib\exception\ForbiddenException;
use app\lib\exception\MethodException;
use app\lib\exception\NoneAdmin;
use app\lib\exception\SignException;
use app\lib\exception\TimestampException;
use app\lib\tools\Encryption;
use app\lib\traits\AjaxResponse;
use app\system\model\Client;
use app\system\model\Orders;
use app\system\model\SystemUser;

class ApiBase extends Base
{
    use AjaxResponse;

    protected $admin_uid = 0;

    protected $match_admin_uid = 0;

    protected $c_id = 0;

    protected $platform = 1;

    public function initialize()
    {

        parent::initialize();
        $model = new SystemUser();

        // 判断登陆
        $login = $model->isLogin();
        if (! $login['uid']) {
            $this->checkAuth();
            $this->platform = Orders::FROM_PLAFORM;
        } else {
            $this->platform = Orders::FROM_ME;
            $this->match_admin_uid = 0;
            $this->admin_uid = $login['uid'];
            $this->c_id = $login['c_id'];
        }

    }

    /**
     * 校验支付平台权限
     */
    public function checkAuth()
    {
        $client_id = input('param.client_id/s', '');
        $clientModel = Client::where(['client_id' => $client_id])->find();

        if (! $clientModel) {
            throw new ForbiddenException();
        }

        if (! $clientModel->admin) {
            throw new NoneAdmin();
        }

        if ($clientModel->admin->status == 0) {
            throw new NoneAdmin();
        }

        $this->match_admin_uid = 0;
        $this->admin_uid = $clientModel->admin->id;

        $sign = input('param.sign/s', '');
        $secret = $clientModel->client_secret;
        $params = input('param.');
        unset($params['sign']);

        if (Encryption::sign($params, $secret) != $sign) {
            throw new SignException();
        }

        $timestamp = input('param.timestamp/s', '');
        if (strlen($timestamp) < 13 || intval($timestamp) <= $clientModel->timestamp) {
            throw new TimestampException();
        }

        $clientModel->timestamp = $timestamp;
        $clientModel->save();

        $this->c_id = $clientModel->id;
    }

    /**
     * 判断是否是post请求
     */
    protected function is_post()
    {
        if (! $this->request->isPost()) {
            throw new MethodException();
        }
    }

    /**
     * 判断是否是get请求
     */
    protected function is_get()
    {
        if (! $this->request->isGet()) {
            throw new MethodException();
        }
    }
}
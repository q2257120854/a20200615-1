<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/16
 * Time: 6:19 PM
 */

namespace app\index\home;


use app\lib\pinduoduo\MobileClient;
use app\lib\traits\AjaxResponse;
use app\system\model\Orders;

class Pay extends Base
{

    use AjaxResponse;

    /**
     * 微信h5
     * @return \think\response\Json
     */
    public function wepay_h5()
    {

        $order_sn = input('param.order_sn/s', '');

        $order = Orders::get(['order_sn' => $order_sn]);

        if (! $order) {
            return $this->ajax_error('订单不存在');
        }

        if ($order->is_pay == 1) {
            return $this->ajax_error('订单已支付');
        }

        $userInfo = $order->user;

        if (! $userInfo) {
            return $this->ajax_error('订单用户不存在');
        }

        $mobileClient = new MobileClient($userInfo);

        $html = $mobileClient->wepay_h5($order_sn);

        echo $html;

    }

}
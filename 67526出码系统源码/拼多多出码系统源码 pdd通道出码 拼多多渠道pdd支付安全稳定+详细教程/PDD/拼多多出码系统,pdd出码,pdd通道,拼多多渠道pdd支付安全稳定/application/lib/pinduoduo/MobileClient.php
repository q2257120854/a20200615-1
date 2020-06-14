<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/2
 * Time: 11:51 PM
 */

namespace app\lib\pinduoduo;


use app\lib\exception\PinduoduoException;
use app\lib\tools\Mobile;
use app\system\model\Orders;

/**
 * 拼多多移动客户端
 * Class MobileClient
 * @package app\lib\pinduoduo
 */
class MobileClient extends PinduoduoBase
{

    //用户token
    private $access_token = '';

    //用户id
    private $uid = '';

    //用户手机号
    private $phone = '';

    //cookie文件
    private $cookieJar = '';

    protected static $is_command = false;

    public function __construct($loginInfo, $is_command = false)
    {
        $this->access_token = isset($loginInfo['access_token']) ? $loginInfo['access_token'] : '';
        $this->uid = isset($loginInfo['uid']) ? $loginInfo['uid'] : '';
        $this->phone = isset($loginInfo['phone']) ? $loginInfo['phone'] : '';
        self::$is_command = $is_command;
    }

    /**
     * 带校验的post请求
     * @param $url 请求链接
     * @param array $params 请求参数
     * @param array $headers 请求头
     * @return mixed
     */
    public function post($url, $params=[], $headers=[])
    {
        $headers = $headers + [
            'AccessToken:' . $this->access_token,
            'Content-Type:application/json;charset=UTF-8',
        ];
        $result = Net::post($url, json_encode($params, JSON_UNESCAPED_UNICODE), $headers);
        return self::check_result($result);
    }

    /**
     * 带校验的get请求
     * @param $url 请求链接
     * @param array $headers 请求头
     * @return mixed
     */
    public function get($url, $headers=[])
    {
        $headers = $headers + [
            'AccessToken:' . $this->access_token,
            'Content-Type:application/json;charset=UTF-8',
        ];
        $result = Net::get($url, $headers);
        return self::check_result($result);
    }

    /**
     * 添加收货地址
     * @param string $name 姓名
     * @param string $mobile 手机
     * @param string $address 详细地址
     * @param string $district_id 区id
     * @param string $city_id 市id
     * @param string $province_id 省id
     * @param string $is_default 是否是默认地址
     */
    public function addAddress($name='', $mobile='', $address='', $district_id='', $city_id='', $province_id='', $is_default=1)
    {
        if (! preg_match('^1(3|4|5|7|8|9)[0-9]\d{8}$^', $mobile)) {
            $mobile = Mobile::randomMobile();
        }
        $params = [
            'name'=> $name,
            'mobile'=> $mobile,
            'address'=> $address,
            'district_id'=> $district_id,
            'city_id'=> $city_id,
            'province_id'=> $province_id,
            'is_default'=> $is_default,
        ];
        return $this->post(Constant::add_address_url($this->uid), $params);
    }

    /**
     * 获取地址模板
     * @param $regionId
     * @return mixed
     * @throws PinduoduoException
     */
    public function getaddresstpl($regionId)
    {
        $result = $this->get(Constant::regions_url($regionId, $this->uid));
        if (isset($result['error_msg'])) {
            throw new PinduoduoException(['msg' => '请先验证手机']);
        }
        return $result;
    }

    /**
     * 下单
     */
    public function order($user, $goods, $total, $pay_type)
    {

        $sku_number = $total / $goods['normal_price'];

        $params = [
            'address_id' => $user['address_id'],
            //'anti_content' => '0alAfxnUmctyg9EVWicck2J9d6BMw_ZpTiX_vv_FEh_knQP40lnCqj5IecT_8v_bFte7n0X4L5ogux3mAupi29iCA2BW9Gp8mLAypMymkIlqyr09g9qAP1Z9Xsh2GuVB8ki7d7o4rBuODilJ4A4hdhRbbGWTQ2N4oERySADr2zFxxNfYbpyPy8Qv_9qS7vigkmZkKdz1Fa7v_T1GYag-t1jYeP-qbLdkAhfkXaXUyGlt67XEvxKOFa2YL9uojBzeTy5Kkf3aTx0Xml-q47Rzn6-Ck5Bus53HW4zFmI6esZfeuiYfZPpc_Zkm_jGl2nAY6E9yy4zD9638gRR6cJVtAb_LV0B0mOyiHmOUqxUMsHcLLHmTC5HSZw99J0LtXrogJssDzKTnoambhKXjnTjwA9BF-cg8Pguu2JlcFJcRs3cS9RMjL0LJ2erTS8JlsX7XHOrMzHg5iwfSCIaBgNQqh0BJauqptF6m4epCzuic9tGWpoKxYxrsHBwD6_GXPy1KSn6wrNQerm6-iqVk18LifzSk1UtMutiEGDi2K8xZzUDAlJhRdKcIHX23cIwSSx3CKiKSFxrtm5Z7761pTiLerLdH-7qnFvfl6MfbruiMj3DRYLR2AuxK7H',
            'attribute_fields' => [
                //'PTRACER-TRACE-UUID' => "3009158000000000000000#1556955506660#st2-glb-308",
                //'create_order_token' => "dc7e192d-2e77-4ccf-b799-aedc55ffab7e",
                'order_amount' => $total,
                //'original_front_env' => 0,
            ],
            //'biz_type' => 0,
            //'duoduo_type' => 0,
            'goods' => [
                [
                    'goods_id' => $goods['goods_id'],
                    'sku_id' => $goods['sku_id'],
                    'sku_number' => $sku_number,
                ]
            ],
            'group_id' => $goods['group_id'],
            //'is_app' => '0',
            //'page_id' => '10002_1556955394117_tmwzG2UrBi',
            'pay_app_id' => $pay_type,
            //'source_channel' => '0',
            //'source_type' => 0,
            //'version' => 1,
        ];
        return self::post(Constant::order_url($this->uid), json_encode($params, JSON_UNESCAPED_UNICODE));
    }

    /**
     * 支付宝支付
     */
    public function alipay($order_sn)
    {
        $params = [
            'order_sn' => $order_sn,
            'version' => 3,
            'attribute_fields' => [
                'paid_times' => 0,
                'forbid_contractcode' => '1',
                'forbid_pappay' => '1',
            ],
            'return_url' => 'https://mobile.yangkeduo.com/transac_wappay_callback.html?order_sn='.$order_sn,
            'app_id' => Orders::ALIPAY,
        ];
        $result = self::post(Constant::repay_url($this->uid), $params);
        return $result['gateway_url'] . '?' . http_build_query($result['query']);
    }

    /**
     * 微信支付
     */
    public function wepay($fp_id)
    {
        return Constant::wepay_url($fp_id);
    }

    /**
     * 支付
     */
    public function pay($pay_type, $order)
    {
        if ($pay_type == Orders::$payments[Orders::WECHAT]) {
            return self::wepay($order['fp_id']);
        }
        if ($pay_type == Orders::$payments[Orders::ALIPAY]) {
            return self::alipay($order['order_sn']);
        }
    }

    /**
     * h5支付宝支付
     */
    public function alipay_h5($order_sn)
    {
        return self::alipay($order_sn);
    }

    /**
     * h5微信支付
     */
    public function wepay_h5($order_sn)
    {
        $params = [
            'order_sn' => $order_sn,
            'version' => '3',
            'attribute_fields' => [
                'paid_times' => 0
            ],
            'pap_pay' => 1,
            'app_id' => Orders::WECHAT
        ];
        $result = self::post(Constant::repay_url($this->uid), $params);
        if (isset($result['error_code']) && $result['error_code'] > 0) {
            throw new PinduoduoException(['msg' => '支付失败']);
        }
        $url = $result['mweb_url'].'&refer_page_name=transac_wechat_wapcallback&refer_page_id=transac_wechat_wapcallback_1557993164793_uGZ6OErL8b';
        $headers = [
            'Referer: https://mobile.yangkeduo.com/transac_wechat_wapcallback.html?order_sn='.$order_sn.'&refer_page_name=my_order&refer_page_id=10032_1557993121020_d3eVE6IgPl&refer_page_sn=10032'
        ];
        return Net::get($url, $headers);
    }

    /**
     * h5微信支付url
     */
    public function wepay_h5_url($order_sn)
    {
        return Constant::wepay_h5_url($order_sn);
    }

    /**
     * 获取订单列表
     */
    public function order_list($type = 'unreceived')
    {
        /**
         *
         * type
         *
         * all        全部
         * unpaidV2   待付款
         * grouping   待分享
         * unshipping 待发货
         * unreceived 待收货
         * unrated    待评价
         */
        $params = [
            'timeout' => 1300,
            'type' => $type,
            'page' => 1,
            'pay_channel_list' => ['9','30','31','35','38','52','-1'],
            'size' => 10,
            //'offset' => '190504-513695417032376'
        ];
        return self::post(Constant::order_list_url($this->uid), $params);
    }

    /**
     * 确认收货
     */
    public function received($order_sn)
    {
        return self::post(Constant::received_url($order_sn, $this->uid));
    }

    /**
     * 订单详情
     */
    public function order_detial($order_sn)
    {

        $headers = [
            'Cookie:PDDAccessToken='.$this->access_token,
        ];

        $html = Net::get(Constant::order_detial_url($order_sn), $headers);
        if (preg_match('/"chatStatusPrompt":"([^"]*)"/', $html, $matches)) {
            return ['status' => $matches[1]];
        } else {
            throw new PinduoduoException(['msg' => '订单状态查询失败']);
        }

    }

    /**
     * 商品详情
     */
    public function goods_detial($goods_id)
    {

        $headers = [
            'Cookie:PDDAccessToken='.$this->access_token,
        ];

        $html = Net::get(Constant::goods_detial_url($goods_id), $headers);

        return $html;

    }

    /**
     * 用户个人中心
     */
    public function personal()
    {
        die();
        $headers = [
            'Cookie:PDDAccessToken=SOOW4YO34TDGUJDCP27GFWVDVT62U3LBPLVWJ67WSFGOSZ4CPS3Q1014803',
        ];
        //echo htmlspecialchars(Net::get('https://mobile.yangkeduo.com/order_checkout.html?sku_id=43311541183&group_id=3278284666&goods_id=2244271490&goods_number=1&page_from=0&refer_page_element=single_buy', $headers));
        //echo htmlspecialchars(Net::get('https://mobile.yangkeduo.com/goods.html?goods_id=2244271490'));

        $headers = [
            'AccessToken:SOOW4YO34TDGUJDCP27GFWVDVT62U3LBPLVWJ67WSFGOSZ4CPS3Q1014803',
            'Content-Type:application/json;charset=UTF-8',
        ];
        //$params = '{"order_sn":"190504-157329982532376","version":3,"attribute_fields":{"paid_times":0,"forbid_contractcode":"1","forbid_pappay":"1"},"return_url":"https://mobile.yangkeduo.com/transac_wappay_callback.html?order_sn=190504-157329982532376","app_id":9}';
        //echo htmlspecialchars(Net::post('https://mobile.yangkeduo.com/proxy/api/order/prepay?pdduid=8260274612552', $params, $headers));

        //确认收货
        echo htmlspecialchars(Net::post('https://mobile.yangkeduo.com/proxy/api/order/190504-489819341592376/received?pdduid=8260274612552', [], $headers));
        die();
    }

    public function test()
    {
        die();
        echo Constant::login_url(),'<br>';
        echo Constant::add_address_url($this->uid),'<br>';
        echo Constant::regions_url(1, $this->uid),'<br>';
        echo Constant::order_url($this->uid),'<br>';
    }

}
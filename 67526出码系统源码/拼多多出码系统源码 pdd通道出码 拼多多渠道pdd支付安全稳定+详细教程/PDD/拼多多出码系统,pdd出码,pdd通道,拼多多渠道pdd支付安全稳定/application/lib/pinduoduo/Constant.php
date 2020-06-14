<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:04 PM
 */

namespace app\lib\pinduoduo;


use app\lib\tools\Server;

/**
 * 常量类
 * Class Constant
 * @package app\lib\pinduoduo
 */
class Constant
{

    /**
     * 登录url
     * @var string
     */
    private static $login_url = 'https://mobile.yangkeduo.com/proxy/api/login?pdduid=0';
    public static function login_url()
    {
        return self::$login_url;
    }

    /**
     * 添加收货地址url
     * @var string
     */
    private static $add_address_url = 'https://mobile.yangkeduo.com/proxy/api/api/origenes/address?pdduid=%s';
    public static function add_address_url($uid)
    {
        return sprintf(self::$add_address_url, $uid);
    }


    /**
     * 地址模板url
     * @var string
     */
    private static $regions_url = 'https://mobile.yangkeduo.com/proxy/api/api/galen/v2/regions/%d?pdduid=%d';
    public static function regions_url($region_id, $uid)
    {
        return sprintf(self::$regions_url, $region_id, $uid);
    }

    /**
     * 下单url
     * @var string
     */
    private static $order_url = 'https://mobile.yangkeduo.com/proxy/api/order?pdduid=%d';
    public static function order_url($uid)
    {
        return sprintf(self::$order_url, $uid);
    }

    /**
     * 商品详情url
     * @var string
     */
    private static $goods_url = 'https://mobile.yangkeduo.com/goods.html?goods_id=%d';
    public static function goods_url($goods_id)
    {
        return sprintf(self::$goods_url, $goods_id);
    }

    /**
     * 支付url
     * @var string
     */
    private static $repay_url = 'https://mobile.yangkeduo.com/proxy/api/order/prepay?pdduid=%d';
    public static function repay_url($uid)
    {
        return sprintf(self::$repay_url, $uid);
    }

    /**
     * 微信代付url
     * @var string
     */
    private static $wepay_url = 'https://mobile.yangkeduo.com/friend_pay.html?fp_id=%s';
    public static function wepay_url($fp_id)
    {
        return sprintf(self::$wepay_url, $fp_id);
    }

    /**
     * 微信h5url
     * @var string
     */
    public static function wepay_h5_url($order_sn)
    {
        return Server::base_url().'/index/pay/wepay_h5?order_sn=' . $order_sn;
    }

    /**
     * 订单列表url
     * @var string
     */
    private static $order_list_url = 'https://mobile.yangkeduo.com/proxy/api/api/aristotle/order_list?pdduid=%d';
    public static function order_list_url($uid)
    {
        return sprintf(self::$order_list_url, $uid);
    }

    /**
     * 确认收货url
     * @var string
     */
    private static $received_url = 'https://mobile.yangkeduo.com/proxy/api/order/%s/received?pdduid=%d';
    public static function received_url($order_sn, $uid)
    {
        return sprintf(self::$received_url, $order_sn, $uid);
    }

    /**
     * 订单详情url
     * @var string
     */
    private static $order_detial_url = 'https://mobile.yangkeduo.com/order.html?order_sn=%s';
    public static function order_detial_url($order_sn)
    {
        return sprintf(self::$order_detial_url, $order_sn);
    }

    /**
     * 商品详情url
     * @var string
     */
    private static $goods_detial_url = 'https://mobile.yangkeduo.com/goods.html?goods_id=%d';
    public static function goods_detial_url($goods_id)
    {
        return sprintf(self::$goods_detial_url, $goods_id);
    }

}
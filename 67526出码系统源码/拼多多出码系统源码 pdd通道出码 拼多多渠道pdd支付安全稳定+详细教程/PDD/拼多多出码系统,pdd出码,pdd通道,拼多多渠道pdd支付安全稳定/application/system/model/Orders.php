<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;



use app\lib\exception\AjaxException;
use app\lib\exception\PinduoduoException;
use app\lib\pinduoduo\MobileClient;
use app\lib\pinduoduo\Tools;
use think\Exception;

class Orders extends BaseModel
{

    const UNPAY = 0;

    const UNSHOPING = 1;

    const UNRECEIVED = 2;

    const UNRATED = 3;

    const CANCELED = 4;

    public static $status = [
        self::UNPAY => '待付款',
        self::UNSHOPING => '待发货',
        self::UNRECEIVED => '待收货',
        self::UNRATED => '待评价',
        self::CANCELED => '交易已取消',
    ];

    public static $api_status = [
        self::UNPAY => 'unpaidV2',
        self::UNSHOPING => 'unshipping',
        self::UNRECEIVED => 'unreceived',
        self::UNRATED => 'unrated',
        self::CANCELED => 'canceled',
    ];

    /*const WECHAT = 'wechat';

    const ALIPAY = 'alipay';

    public static $payments = [
        self::WECHAT => 38,
        self::ALIPAY => 9,
    ];*/

    const WECHAT = 38;

    const ALIPAY = 9;

    public static $payments = [
        self::WECHAT => 'wechat',
        self::ALIPAY => 'alipay',
    ];

    public static $payment_alias = [
        self::WECHAT => '微信',
        self::ALIPAY => '支付宝',
    ];

    const FROM_ME = 1;

    const FROM_PLAFORM = 2;

    public static $plaforms = [
        1 => '自行出码',
        2 => '支付平台',
    ];

    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';

    // 自动写入时间戳
    protected $autoWriteTimestamp = 'datetime';

    //自动写入时间格式
    protected $dateFormat = 'Y-m-d H:i:s';

    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind(['nick']);
    }

    public function goods()
    {
        return $this->belongsTo('Goods', 'g_id');
    }

    public function user()
    {
        return $this->belongsTo('User')->bind(['phone', 'access_token', 'uid']);
    }

    public function client()
    {
        return $this->belongsTo('Client', 'c_id');
    }

    public function getAndUpdateOrderByOrderSN($order_sn, $is_command=false)
    {
        $order = $this->with('user')->where(['order_sn'=>$order_sn])->find();
        if (!$order) throw new AjaxException(['msg' => '订单不存在']);

        $mobileClient = new MobileClient($order, $is_command);
        try {
            $result = $mobileClient->order_detial($order['order_sn']);
        } catch (Exception $e) {
            if (! $is_command) {
                throw $e;
            }
            $result = ['status' => '交易已取消'];
        }

        if (strpos($result['status'], self::$status[self::UNPAY]) !== false) {
            $order->status = self::UNPAY;
        } else if (strpos($result['status'], self::$status[self::UNSHOPING]) !== false) {
            $order->status = self::UNSHOPING;
        } else if (strpos($result['status'], self::$status[self::UNRECEIVED]) !== false) {
            $order->status = self::UNRECEIVED;
        } else if (strpos($result['status'], self::$status[self::UNRATED]) !== false) {
            $order->status = self::UNRATED;
        } else if (strpos($result['status'], self::$status[self::CANCELED]) !== false) {
            $order->status = self::CANCELED;
        }
        $order->save();
        if ($order->status > Orders::UNPAY && $order->status < Orders::CANCELED) {

            if ($order->is_notify == 0) {

                \Db::startTrans();
                try {

                    $client = Client::get(['id' => $order->c_id]);

                    $client->where(['id' => $order->c_id])->inc('total', $order->total * (1 - floatval($client->cash_fee)))->update();
                    $stores = $order->goods->stores;
                    $stores->cur_total += $order->total;
                    $stores->save();

                    $result = $order->where(['is_notify' => 0, 'id' => $order->id])->update(['is_notify' => 1, 'is_pay' => 1]);

                    if ($result) {
                        // 提交事务
                        \Db::commit();

                        $order->is_notify = 1;
                        $order->is_pay = 1;

                        if (preg_match('/^https?:\/\//', $order->notify_url)) {
                            $type = '';
                            switch ($order->pay_type) {
                                case Orders::WECHAT :
                                    $type = Orders::$payments[Orders::WECHAT];
                                    break;
                                case Orders::ALIPAY :
                                    $type = Orders::$payments[Orders::ALIPAY];
                                    break;
                            }

                            Tools::notify($order->notify_url, [
                                'callbacks' => 'CODE_SUCCESS',
                                'type' => $type,
                                'total' => $order->total,
                                'api_order_sn' => $order->api_order_sn,
                                'order_sn' => $order->order_sn,
                            ], $client->client_secret);
                        }
                    } else {
                        \Log::record('订单已notify', 'error');
                        \Db::rollback();
                    }

                } catch (\Exception $e) {
                    // 回滚事务
                    \Db::rollback();
                    throw $e;
                }

            }

        }

        return $order;
    }
}
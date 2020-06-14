<?php
// +----------------------------------------------------------------------
// | 聚鑫支付类接口及调用
// | Author: 谜狗叼同学
// +----------------------------------------------------------------------

namespace app\common\library;

class copay
{

    const fxgetway = "http://zf.wu2it.com/pay/api.php"; //支付网关
    const queryway = 'http://zf.wu2it.com/pay/order.php';//聚鑫查单
    private $data;

    /**
     * 方法调用
     * $data 传入参数
     */
    public function __construct($data)
    {

        $config = [
            'bb'      => "1.0",
            'shid'    => '',
            'ddh'     => '',
            'je'      => 10,
            'zftd'    => "weixin",
            'ybtz'    => '',
            'tbtz'    => '',
            'ddmc'    => "充值",
            'ddbz'    => "可以是用户uid",
            'userkey' => ''
        ];
        if (!is_array($data)) {
            return;
        }

        $data = array_merge($config, $data);
        $keyArr = array_keys($config);

        foreach ($data as $key => $val) {
            if (!in_array($key, $keyArr, true)) {
                unset($data[$key]);
            }
            elseif ($data[$key] == '') {
                return;
            }
        }
        $userkey = $data['userkey'];
        unset($data['userkey']);
        $data['je'] = number_format($data['je'], 2, '.', '');
        $data['ddh'] = preg_replace("/[a-z]/i", '', $data['ddh']);
        $data['sign'] = self::sign($data, $userkey);
        $this->data = $data;
    }

    /**
     * 签名处理
     * $data 参数
     * $userkey 用户密钥
     * return 输出加密签名
     */
    public static function sign($data, $userkey)
    {
        $sign = '';
        if (isset($data['status'])) {
            $sign .= "status={$data['status']}&";
        }
        $sign .= 'shid=' . $data['shid'] . '&bb=' . $data['bb'] . '&zftd=' . $data['zftd'] . '&ddh=' . $data['ddh'] . '&je=' . $data['je'] . '&ddmc=' . $data['ddmc'] . '&ddbz=' . $data['ddbz'] . '&ybtz=' . $data['ybtz'] . '&tbtz=' . $data['tbtz'] . '&' . $userkey; //MD5加密串
        return md5($sign);
    }

    /**
     * 回话处理
     * $url 地址
     * $postData  数据
     * $ispost 是否post
     * return Stirng
     */
    private static function curl($url, $postData = [], $ispost = true)
    {
        $data = '';
        $header = [];
        if (!empty($url)) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                if (strstr($url, 'https://')) {
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                }
                if ($ispost) {
                    $curlPost = is_array($postData) ? http_build_query($postData) : $postData;
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
                }
                $data = curl_exec($ch);
                curl_close($ch);
            } catch (Exception $e) {
                $data = '';
            }
        }
        return $data;
    }

    /**
     * 查单处理
     * $ddh 订单号
     * $je  多少钱
     * $shid 商户号
     * $userkey 用户密钥
     * return 布尔值
     */
    public static function orderQuery($ddh, $je, $shid, $userkey)
    {
        if (!$ddh || !$je || !$shid || !$userkey) {
            return false;
        }
        $native = [
            'ddh'  => $ddh,
            'shid' => $shid,
            'sign' => md5('shid=' . $shid . '&ddh=' . $ddh . '&' . $userkey)//查单密钥
        ];
        $ret = self::curl(self::queryway, $native);
        if (!$ret || !($isreg = preg_match('/{.+}/is', $ret, $ret))) { //垃圾聚鑫有html标签
            return false;
        }
        $ret = @json_decode($ret[0], true);
        if (is_array($ret) && @$ret['status'] === 'success' && @$ret['je'] && @$ret['shddh'] === $ddh) {
            return ((float)@$ret['je']) == ((float)$je);
        }
        return false;
    }

    /**
     * 参数就绪发起支付
     * return Array
     */

    public function pay()
    {
        if (!$this->data) {
            return ["status" => 0, "msg" => "error", "data" => "支付参数配置有误"];
        }
        return ["status" => 2, 'msg' => 'ok', "way" => self::fxgetway, "data" => $this->data];
    }

    /**
     * 异步调用方法
     * $y 支付名
     * $post  返回的$_POST数据
     * $userkey  商户密钥
     * return String
     */
    public static function notify($y = 'copay', $post, $token, $orderprefix = 'DH')
    {
        $post['ddh'] = $post['ddh'] ?? '';
        $orderId = $orderprefix . $post['ddh'];
        if (isset($post['status']) && $post['status'] == 'success') { //支付结果是否为success
            $checkSign = self::sign($post, $token['api_key']); //就绪验签
            $post['je'] = $post['je'] ?? 0;
            if ($post['sign'] === $checkSign) { //密钥是否正确
                return self::orderQuery($post['ddh'], $post['je'], $token['app_id'], $token['api_key']);
            }
        }
        //验签不通过逻辑处理
        return false;
    }

    /**
     * 生成html , 并submit到支付网关
     * $url 支付网关
     * $native  支付参数
     *
     */
    public static function _createForm($url, $native)
    {

        $str = '<!doctype html>
            <html>
                <head>
                    <meta charset="utf8">
                    <title>正在跳转支付...</title>
                </head>
                <body onLoad="document.pay.submit()">
                <form method="post" action="' . $url . '" name="pay">';

        foreach ($native as $k => $vo) {
            $str .= '<input type="hidden" name="' . $k . '" value="' . $vo . '">';
        }

        $str .= '</form>
                </body>
            </html>';
        return $str;
    }
}

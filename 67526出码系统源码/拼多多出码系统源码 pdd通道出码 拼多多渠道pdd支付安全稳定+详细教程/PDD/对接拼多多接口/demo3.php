<?php

/**
 * 注意事项
 * PDD需要配合自动发货  具体细则查看空包网PDD自动发货
 */
$apiurl = 'http://103.100.209.198/index/api/order'; // API下单地址
$signkey = '54ca2307ed1728c616b8dd529c89ebbc190da0806968e31a2cae1d29c3479981'; // 商户KEY  PDD平台获取
$data = array(
    'type' => 'wechat', // 通道代码 alipay/wechat
    'total' => 100, // 金额 单位 分
    'api_order_sn' => time(), // 订单号
    'notify_url' => 'http://xxx.com', // 异步回调地址
	'client_id' => 'f3de1f658719a593af998e08c54fb7e3',
    'timestamp' => getMillisecond() // 获取13位时间戳
);
$data['sign'] = sign($data,$signkey); // 生成签名
$res = sendRequest('http://103.100.209.198/index/api/order',$data); // 下单
  var_dump($res);
if( $res['ret'] != true ){
    exit('下单失败');
}
$res = json_decode($res['msg'],true);
if( $res['error_code'] == 200 ){
    // 下单成功  自行处理
    var_dump($res);
}else{
    // 下单失败
	  var_dump($res);
}

/**
 * 签名
 * @param array $params
 * @param string $secret
 * @return string
 */
function sign($params = [], $secret = '')
{
    unset($params['sign']);
    ksort($params);
    $str = '';
    foreach ($params as $k => $v) {
	
        $str = $str . $k . $v;
    }
    $str = $secret . $str . $secret;
    return strtoupper(md5($str));
}

/**
 * 返回13位时间戳
 */
function getMillisecond() {

    list($t1, $t2) = explode(' ', microtime());

    return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);

}

/**
 * CURL发送Request请求,含POST和REQUEST
 * @param string $url 请求的链接
 * @param mixed $params 传递的参数
 * @param string $method 请求的方法
 * @param mixed $options CURL的参数
 * @return array
 */
function sendRequest($url, $params = [], $method = 'POST', $options = []) {
    $method = strtoupper($method);
    $protocol = substr($url, 0, 5);
    $query_string = is_array($params) ? http_build_query($params) : $params;

    $ch = curl_init();
    $defaults = [];
    if ('GET' == $method) {
        $geturl = $query_string ? $url . (stripos($url, "?") !== FALSE ? "&" : "?") . $query_string : $url;
        $defaults[CURLOPT_URL] = $geturl;
    } else {
        $defaults[CURLOPT_URL] = $url;
        if ($method == 'POST') {
            $defaults[CURLOPT_POST] = 1;
        } else {
            $defaults[CURLOPT_CUSTOMREQUEST] = $method;
        }
        $defaults[CURLOPT_POSTFIELDS] = $query_string;
    }

    $defaults[CURLOPT_HEADER] = FALSE;
    $defaults[CURLOPT_USERAGENT] = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.98 Safari/537.36";
    $defaults[CURLOPT_FOLLOWLOCATION] = TRUE;
    $defaults[CURLOPT_RETURNTRANSFER] = TRUE;
    $defaults[CURLOPT_CONNECTTIMEOUT] = 3;
    $defaults[CURLOPT_TIMEOUT] = 3;

    // disable 100-continue
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

    if ('https' == $protocol) {
        $defaults[CURLOPT_SSL_VERIFYPEER] = FALSE;
        $defaults[CURLOPT_SSL_VERIFYHOST] = FALSE;
    }

    curl_setopt_array($ch, (array)$options + $defaults);

    $ret = curl_exec($ch);
    $err = curl_error($ch);

    if (FALSE === $ret || !empty($err)) {
        $errno = curl_errno($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return [
            'ret' => FALSE,
            'errno' => $errno,
            'msg' => $err,
            'info' => $info,
        ];
    }
    curl_close($ch);
    return [
        'ret' => TRUE,
        'msg' => $ret,
    ];
}
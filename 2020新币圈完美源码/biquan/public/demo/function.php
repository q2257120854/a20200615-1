<?php
/**
 * @param $url
 * @param $post_data
 * @param array $ssl
 * @return bool|string
 */
function curl_post($url,$post_data = array() , $header = false){
//    dd($post_data);
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $url);//设置链接
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
    curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证
    if($header){
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    if(is_string($post_data)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//POST数据
    }else{
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));//POST数据
    }

    $response = curl_exec($ch);//接收返回信息
//    print_r($response);
    if(curl_errno($ch)){	//出错则显示错误信息
        print curl_error($ch);
    }
    curl_close($ch); //关闭curl链接
    return $response;
}

/**
 * @param string $data
 * 清楚数据内的null
 */
function clear_null(&$data = ''){
    if($data === null || $data === false){
        $data = '';
    }
    if(is_array($data) && !empty($data)){
        foreach($data as &$v){
            if($v === null || $v === false){
                $v = '';
            }else if(is_array($v)){
                clear_null($v);
            }else if(is_string($v) && stripos($v,'.') === 0){
//				$v = '0'.$v;
            }
        }
    }
}

/**
 * @param string $data
 * 返回算签请求参数
 */
function request_param($param,$secret){
    clear_null($param);
    unset($param['sign'],$param['is_jump']);
    $param['secret'] = $secret;
    ksort($param);
    $param2 = [];
    foreach($param as $k => $v){
        $param2[] = $k.'='.$v;
    }
    $param['sign'] = strtolower(md5(implode('&',$param2)));
    unset($param['secret']);
    return $param;
}


/**
 * 获取测试商户
 */
function get_api_arr(){
    return array(
        //appid=>secret
        'gpu63591382902'=>'9bf688e84fa05b52b50886eeeeec3902',
    );
}

/**
 * @param string $str
 * 检测是否有html标签
 */
function judgeHtml($str){
    if($str != strip_tags($str)){
        return true;
    }else{
       return false;
    }
}

/**
 * @param $param
 * @return string
 * 生成二维吗跳转链接
 */
function create_qr_url($param){
    //二维码跳转链接
    $param2 = [];
    foreach($param as $k => $v){
        $param2[] = $k.'='.$v;
    }
    $str=htmlspecialchars(implode('&',$param2).'&is_jump=1');
    return urlencode("http://".$_SERVER['HTTP_HOST']."/demo/submit.php?".$str);
//    var_dump($url);exit;
//    $url=urlencode("http://".$_SERVER['HTTP_HOST']."/demo/qrcode.php?param=".$str.'&is_jump=1');
//    return "http://qr.liantu.com/api.php?text=".$url;
}


/**
 * @param $param
 * @return string
 * 记录日志
 */
function write_log($file_name,$title,$data){

    //设置目录时间
    $years = date('Y-m-d');
    //设置路径目录信息
    $url  = './log/'.$years.'/'.$file_name.'.txt';
    //取出目录路径中目录(不包括后面的文件)
    $dir_name = dirname($url);
    //如果目录不存在就创建
    if(!file_exists($dir_name)) {
        //iconv防止中文乱码
        $res = mkdir(iconv("UTF-8","GBK",$dir_name),0777,true);
    }
    $fp = fopen($url,"a");//打开文件资源通道 不存在则自动创建
    fwrite($fp,var_export('------------'.date('Y-m-d H:i:s'),true)."\r\n");//写入文件
    fwrite($fp,var_export($title,true)."\r\n");//写入文件
    fwrite($fp,var_export($data,true)."\r\n");//写入文件
    fwrite($fp,var_export('------------',true)."\r\n");//写入文件
    fclose($fp);//关闭资源通道

}

/**
 * 生成订单号
 */
function create_order_no()
{
    @date_default_timezone_set("PRC");
    while (true) {
        //订购日期
        $order_date = date('Y-m-d');
        //订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
        $order_id_main = date('YmdHis') . rand(10000000, 99999999);
        //订单号码主体长度
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for ($i = 0; $i < $order_id_len; $i++) {
            $order_id_sum += (int)(substr($order_id_main, $i, 1));
        }
        //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
        return $order_id_main . str_pad((100 - $order_id_sum % 100) % 100, 2, '0', STR_PAD_LEFT);
    }
}
<?php
/**
 * 功能：独立的支付页面 适合快速了解 自行开发。 需要较强的开发功能
 * 版本：5.0
 * 修改日期：2020-1-21
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究接口使用，只是提供一个参考。
 *
 * 访问格式:  域名/pay.php?user=admin&price=1&type=1
 */
error_reporting(E_ALL & ~E_NOTICE); //过滤脚本提醒
date_default_timezone_set('PRC'); //时区设置 解决某些机器报错



$codepay_config['id'] = "码支付ID";
/**
 * MD5密钥，安全检验码，由数字和字母组成字符串，需要跟服务端一致
 * 设置地址：https://codepay.fateqq.com/admin/#/dataSet.html
 * 该值非常重要 请不要泄露 否则会影响支付的安全。 如泄露请重新到云端设置
 */
$codepay_config['key'] = "通信密钥";

//字符编码格式 目前支持 gbk GB2312 或 utf-8 保证跟文档编码一致 建议使用utf-8
$codepay_config['chart'] = strtolower('utf-8');


//是否启用免挂机模式 1为启用. 未开通请勿更改否则资金无法及时到账
$codepay_config['act'] = "0"; //认证版则开启 一般情况都为0

$codepay_config['page'] = 4; //支付页面展示方式

//二维码超时设置  单位：秒
$codepay_config['outTime'] = 360;//360秒=6分钟 最小值60  不建议太长 否则会影响其他人支付


define('HTTPS', false);  //是否HTTPS站点 false为HTTP true为HTTPS


//主动判断是否HTTPS
function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return TRUE;
    }
    return FALSE;
}

$codepay_config['host'] = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

$codepay_config['path'] = $codepay_config['host'] . dirname($_SERVER['REQUEST_URI']); //API安装路径 最终为http://域名/codepay



$codepay_config['qrcode_url'] ='';

// $codepay_config['qrcode_url'] = $codepay_config['path'].'/qrcode.php';

$codepay_config['pay_type'] = 1;

$codepay_config['return_url'] = $codepay_config['path'] . '/notify.php'; //自动生成跳转地址


$codepay_config['notify_url'] = $codepay_config['path'] . '/notify.php'; //自动生成通知地址 优先级最高不传入则为系统设置里设置

$codepay_config['gateway']="http://api2.xiuxiu888.com/creat_order/?"; //设置码支付网关





if (empty($_POST)) $_POST = $_GET; //如果为GET方式访问


$user = $_POST['user'];//提交的用户名

$price = (float)$_POST["price"]; //提交的价格

$param = ''; //自定义参数  可以留空 传递什么返回什么 用于区分游戏分区或用户身份

$type = (int)$_POST["type"]; //支付方式

if ($type < 1) $type = 1;


if ($price <= 0) $price = (float)$_POST["money"]; //如果没提供自定义输入金额则使用money参数

$price = number_format($price, 2, '.', '');// 四舍五入只保留2位小数。

if (empty($codepay_config) || (int)$codepay_config['id'] <= 1) exit('not set codepay ID  未设置ID密钥');

$pay_id = $user; //网站唯一标识 需要充值的用户名，用户ID或者自行创建订单 建议传递用户的ID





if (empty($pay_id)) exit('需要充值的用户不能为空'); //唯一用户标识 不能为空 如果是登录状态可以直接取session中的ID或用户名

if ($codepay_config['pay_type'] == 1 && $type == 1) $codepay_config["qrcode_url"] = ''; //支付宝默认不走本地化二维码
/**
 * 这里可以自行创建站内订单将用户提交的数据保存到数据库生成订单号
 *
 * 嫌麻烦pay_id直接传送用户ID或用户名(中文用户名请确认编码一致)
 * 我们支持GBK,gb2312,utf-8 如发送中文遇到编码困扰无法解决 可以尽量使用UTF-8
 * 万能解决方法：base64或者urlencode加密后发送我们. 处理业务的时候转回来
 */

//获取客户端IP地址
function getIp()
{ //取IP函数
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $realip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            $realip = getenv('HTTP_CLIENT_IP') ? getenv('HTTP_CLIENT_IP') : getenv('REMOTE_ADDR');
        }
    }
    return $realip;
}
//构造要请求的参数数组，无需改动
if(!empty($_POST)&&$_POST['sign']){ //来自代理网关 验证签名
    ksort($_POST); //排序post参数
    reset($_POST); //内部指针指向数组中的第一个元素

    $sign = ''; //加密字符串初始化

    foreach ($_POST AS $key => $val) {
        if ($val == '' || $key == 'sign') continue; //跳过这些不签名
        if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
        $sign .= "$key=$val"; //拼接为url参数形式
    }
    if (md5($sign .  $codepay_config['key']) != $_POST['sign']) { //不合法的数据
        exit('签名验证失败');
    }else{
        $parameter = $_POST; //验证签名成功后使用传入的参数 作为代理
    }
}else{
    $parameter = array(
        "id" => (int)$codepay_config['id'],//平台ID号
        "type" => $type,//支付方式
        "price" => (float)$price,//原价
        "pay_id" => $pay_id, //可以是用户ID,站内商户订单号,用户名
        "param" => $param,//自定义参数
        "act" => (int)$codepay_config['act'],//此参数即将弃用
        "outTime" => (int)$codepay_config['outTime'],//二维码超时设置
        "page" => (int)$codepay_config['page'],//订单创建返回JS 或者JSON
        "return_url" => $codepay_config["return_url"],//付款后附带加密参数跳转到该页面
        "notify_url" => $codepay_config["notify_url"],//付款后通知该页面处理业务
        // "style" => (int)$codepay_config['style'],//付款页面风格
        // "pay_type" => $codepay_config['pay_type'],//支付宝使用官方接口
        "user_ip" => getIp(),//付款人IP
        "qrcode_url" => $codepay_config['qrcode_url'],//本地化二维码
        "chart" => trim(strtolower($codepay_config['chart']))//字符编码方式
        //其他业务参数根据在线开发文档，添加参数.文档地址:https://codepay.fateqq.com/apiword/
        //如"参数名"=>"参数值"
    );
}



/**
 * 加密函数
 * @param $params 需要加密的数组
 * @param $codepay_key //码支付密钥
 * @param string $host //使用哪个域名
 * @return array
 */
function create_link($params, $codepay_key, $host = "")
{
    ksort($params); //重新排序$data数组
    reset($params); //内部指针指向数组中的第一个元素
    $sign = '';
    $urls = '';
    foreach ($params AS $key => $val) {
        if ($val == '') continue;
        if ($key != 'sign') {
            if ($sign != '') {
                $sign .= "&";
                $urls .= "&";
            }
            $sign .= "$key=$val"; //拼接为url参数形式
            $urls .= "$key=" . urlencode($val); //拼接为url参数形式
        }
    }

    $key = md5($sign . $codepay_key);//开始加密
    $query = $urls . '&sign=' . $key; //创建订单所需的参数
    $apiHost = ($host ? $host : "http://api2.xiuxiu888.com/creat_order/?"); //网关
    $url = $apiHost . $query; //生成的地址
    return array("url" => $url, "query" => $query, "sign" => $sign, "param" => $urls);
}

$back = create_link($parameter, $codepay_config['key']);


switch ((int)$type) {
    case 1:
        $typeName = '支付宝';
        break;
    case 2:
        $typeName = 'QQ';
        break;
    default:
        $typeName = '微信';
}

//准备传给前端输出的JSON
$user_data = array(
    "return_url" => $parameter["return_url"],
    "type" => $parameter['type'],
    "outTime" => $parameter["outTime"],
    "codePay_id" => $parameter["id"],
    "out_trade_no" => $parameter["param"],
    "price" => $parameter['price'],
    'money'=>$parameter['price'],
    'order_id'=>$parameter["param"],
    "subject"=>'',//商品名字
); //传给网页JS去执行

$user_data["qrcode_url"] = $codepay_config["qrcode_url"]; //本地二维码控制器

//中间那logo 默认为2秒后隐藏
//改为自己的替换img目录下的use_开头的图片 你要保证你的二维码遮挡不会影响扫码
//二维码容错率决定你能遮挡多少部分
$user_data["logoShowTime"] = $user_data["qrcode_url"]?1:2*1000;



$codepay_json='';


if (!file_exists('/js/codepay_util.js')) { //这个资源文件不存在 不走本地资源
    $codepay_path="https://codepay.fateqq.com";
    if($codepay_config['chart']=='gbk'||$codepay_config['chart']=='gb2312'){ //如果不是UTF-8编码加载GBK
        $codepay_path.="/gbk";
    }
}else{
    $codepay_path = $codepay_config['path']; //设置codepay静态资源使用路径
}


/**
 * 高级模式 云端创建订单。(注意不要外泄密钥key)
 * 可自行根据订单返回的参数做一些高级功能。 以下demo只是简单的功能 其他需要自行开发
 * 比如根据money type 参数调用本地的二维码图片。
 * 比如根据云端订单状态创建失败 展示自定义转账的二维码。
 * 比如可自行开发付款后的同步通知实现。
 * 比如可自行开发软件端某个支付方式掉线。 自动停用该付款方式。
 * 如使用云端同步通知  请附带必要的参数 码支付的用户id,pay_id,type,money,order_id,tag,notiry_key
 * 必须将notiry_key参数返回 因为该参数为服务解密参数(会随时变化)。否则影响云端同步通知
 */

if ($parameter['page'] != 3) { //只要不为3 返回JS 就去服务器加载资源
    $parameter['page'] = "4"; //设置返回JSON
    $back = create_link($parameter, $codepay_config['key'], $codepay_config['gateway']); //生成支付URL
    $timeout = 5; //超时设置 5秒
    if (function_exists('curl_init')) {
        $ch = curl_init(); //使用curl请求
        curl_setopt($ch, CURLOPT_URL, $back['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $codepay_json = curl_exec($ch);
        curl_close($ch);
    }else if(function_exists('file_get_contents')){
        $context = array();
        $context['http'] = array('timeout'=>$timeout,'method' => 'GET'); 
        $codepay_json =file_get_contents($back['url'], false, stream_context_create($context));
    } 
}



if (empty($codepay_json)) { //如果没有获取到远程HTML 则走JS创建订单
    $parameter['call'] = "callback";
    $parameter['page'] = "3";
    $qr='';
    $back = create_link($parameter, $codepay_config['key'], 'https://api.xiuxiu888.com/creat_order/?');
    $codepay_html = '<script src="' . $back['url'] . '"></script>'; //JS数据
} else { //获取到了JSON
    $codepay_data = json_decode($codepay_json);
    $qr = $codepay_data ? $codepay_data->qrcode : '';
    $user_data["money"] = $codepay_data && $codepay_data->money ? $codepay_data->money : $price;
    $codepay_html = "<script>callback({$codepay_json})</script>"; //JSON数据
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $typeName ?>扫码支付</title>
    <link href="<?php echo $codepay_path ?>/css/wechat_pay.css" rel="stylesheet" media="screen">
    <link href="<?php echo $codepay_path?>/css/toastr.min.css" rel="stylesheet">
    <link href="<?php echo $codepay_path?>/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo $type ?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order" style="color:red;font-size:16px">请规定时间内支付下面显示的金额
        </div>

        <div class="amount"  style="position: relative;" ><span id="money">￥<?php echo $price ?></span><div style="position: absolute;font-size: 10px;top: 29px;left: 75%;"><a href="#" class="copy" id="copy" data-clipboard-text="<?php echo $user_data['money']?>">复制金额</a></div></div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img id='show_qrcode' alt="加载中..." src="<?php echo $qr ?>" width="210" height="210"
                         style="display: block;">
                    <img onclick="$('#use').hide()" id="use"
                         src="<?php echo $codepay_path ?>/img/use_<?php echo $type ?>.png"
                         style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -21px;margin-top: -21px">
                </div>
            </div>


        </div>
        <!-- 这里可以输入你想要的提示!-->
        <div class="time-item" id="msg">
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用<?php echo $typeName ?>扫一扫</p>
                <p>扫描二维码完成支付</p>
                <p><div id="kf" ></div></p>
            </div>
        </div>

        <div class="detail" id="orderDetail">
            <dl class="detail-ct" id="desc" style="display: none;">

                <dt>状态</dt>
                <dd id="createTime">订单创建</dd>

            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在<?php echo $typeName ?>扫一扫中选择“相册”即可</p>
        </div>
    </div>

</div>
<div class="copyRight">

</div>

<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="<?php echo $codepay_path ?>/js/jquery-1.10.2.min.js"></script>
<!--[if lt IE 8]>
<script src="<?php echo $codepay_path ?>/js/json3.min.js"></script><![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>
</script>
<script src="<?php echo $codepay_path ?>/js/notify.js"></script>
<script src="<?php echo $codepay_path ?>/js/codepay_util.js"></script>
<?php echo $codepay_html; ?>
<script src="<?php echo $codepay_path?>/js/toastr.min.js"></script>
<script src="<?php echo $codepay_path?>/js/clipboard.min.js"></script>
<script>
    setTimeout(function () {
        $('#use').hide() //2秒后隐藏中间那LOGO
    }, user_data.logoShowTime || 2000);
    var clipboard = new Clipboard('.copy');
    clipboard.on('success', function (e) {
        toastr.success("复制成功,可扫码付款时候粘贴到金额栏付款");

    });
    clipboard.on('error', function(e) {
        document.querySelector('.copy');
        toastr.warning("复制失败,请记住下必须付款的金额 不能多不能少否则不能成功");
    });
</script>
</body>
</html>
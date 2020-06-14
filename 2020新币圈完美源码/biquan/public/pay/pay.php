<?php
/**
 * ---------------------参数生成页-------------------------------
 * 在您自己的服务器上生成新订单，并把计算好的订单信息传给您的前端网页。
 * 注意：
 * 1.key一定要在服务端计算，不要在网页中计算。
 * 2.token只能存放在服务端，不可以以任何形式存放在网页代码中（可逆加密也不行），也不可以通过url参数方式传入网页。
 * 3.接口跑通后，如果发现收款二维码是我们官方的，请检查APP是否正在运行。为保障您收款功能正常，如果您的收款手机APP掉线超过一分钟，就会触发代收款机制，详情请看网站帮助。
 * --------------------------------------------------------------
 */

    //从网页传入price:支付价格， istype:支付渠道：2-支付宝；1-微信支付
    $price = $_POST["money"];
    $istype = $_POST["istype"];
	$xmoney = $_POST["xmoney"];
$istype=1;
    //校验传入的表单，确保价格为正常价格（整数，1位小数，2位小数都可以），支付渠道只能是1或者2，orderuid长度不要超过33个中英文字。

    //此处就在您服务器生成新订单，并把创建的订单号传入到下面的orderid中。
    $goodsname = $_POST["uid"];
    $orderid = $_POST["orderid"];    //每次有任何参数变化，订单号就变一个吧。
    $uid = "1364";//"此处填写平台的uid";
    $token = "http://pay.liushahua.cn/login?off=365";//"此处填写平台的Token";
    $return_url = 'http://www.skyxmedia.cn/pay/payreturn.php';
    $notify_url = 'http://www.skyxmedia.cn/pay/paynotify.php';
    
	$p['id']=$goodsname;
	$p['xmoney']=$xmoney;
	$p1=$p['id'].' '.$p['xmoney'];
	
    $key = md5($uid . $orderid . $p1 . $istype . $price . $token);
    //经常遇到有研发问为啥key值返回错误，大多数原因：1.参数的排列顺序不对；2.上面的参数少传了，但是这里的key值又带进去计算了，导致服务端key算出来和你的不一样。
    
	$returndata['param'] = $p1;
    $returndata['type'] = $istype;
    $returndata['sign'] = $key;
    $returndata['notify_url'] = $notify_url;
    $returndata['payId'] = $orderid;
    $returndata['mid'] = $uid;
    $returndata['price'] = $price;
    $returndata['return_url'] = $return_url;
    $returndata['isHtml'] = 1;   //1直接跳转支付页面   0返回参数
    echo jsonSuccess("OK",$returndata,"");


    //返回错误
    function jsonError($message = '',$url=null) 
    {
        $return['msg'] = $message;
        $return['data'] = '';
        $return['code'] = -1;
        $return['url'] = $url;
        return json_encode($return);
    }

    //返回正确
    function jsonSuccess($message = '',$data = '',$url=null) 
    {
        $return['msg']  = $message;
        $return['data'] = $data;
        $return['code'] = 1;
        $return['url'] = $url;
        return json_encode($return);
    }

?>
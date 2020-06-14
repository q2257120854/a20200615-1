<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use app\common\library\Daili;
use app\common\library\Game;
use app\common\library\Wxpay;
use app\common\library\copay;
use think\Db;
use think\Cache;
use think\Loader;
use think\Request;
use think\Log;
class Pay extends Frontend
{

    //  protected $noNeedLogin = ['chaojipaynurl'];//超级回调
    //protected $noNeedLogin = ['cjiajianurl'];//C++回调
    //protected $noNeedLogin = ['juhenourl'];//信合
    // protected $noNeedLogin = ['kuaifunurl'];//快付
    //protected $noNeedLogin = ['gerenmiannurl'];//个人免签
    protected $noNeedLogin = ['fastnurl','igill_return_url','jf_return_url'];//fastpay

    protected $noNeedRight = '*';//需要认证
    protected $layout = '';
    public static $m_AppID = '2019052113464856';
    public static $m_key = 'EGCjHCbh2U6eZNNb';

    public function _initialize()
    {
        header('Access-Control-Allow-Origin:*');
        parent::_initialize();
        //$this->game=new Game($this->view->site,$this->view->user);
        $this->todaystr = strtotime(date('Ymd'));
        define("FAST_APPKEY", "6382_f14ac6a6a26583c1a7ff37c2ac783c07");//你的appkey
        define("SECRET_KEY", "6f9cdc912501c30f7b13fe6fdf1a820f");//你的秘钥
        define('PAY_DESC', "平台给你汇款");//汇款备注
        define('PAY_RETURN_URL', $this->view->site['site_url'] . "/index.php/index/biquan/index.html");//支付后成功后返回的页面,
        define('PAY_NOTIFY_URL', 'http://' . $_SERVER['HTTP_HOST'] . "/index.php/index/Pay/iloveyouurl.html");//异步回调页面,不填写默认就是会员中心的---优先顺序-下单时候传入优先--->这里的回调----->会员中心的
        define('AIPAY_NOTIFY_URL', $this->view->site['site_url'] . "/index.php/index/Pay/iiiiiiloveyouurl.html");//异步回调页面,不填写默认就是会员中心的---优先顺序-下单时候传入优先--->这里的回调----->会员中心的

    }

    public function index()
    {
        //echo 'error';
        //return $this->fetch("game/pay/index.html");
		//return $this->fetch("/pay/pay/index.php");
    }

    public function xxxxhuilv()
    {
        $res = 6.8;
        return $res;
    }
    public function pay1(){
    	$money = intval($this->request->get('money'));
    	//$money =10;
    	$orderid = $this->request->get('orderid');
    	$uid = $this->request->get('uid');
    	if($money<10){
    		exit('充值金额需要大于10元');
    	}
    	//dump($orderid);exit;
    	
    	$this->igill_pay($orderid,$uid,$money);
    }
    public function pay2(Request $request){
    	$money = intval($this->request->get('money'));
    	$orderid = $this->request->get('orderid');
    	$uid = $this->request->get('uid');
    	/*if($money<10){
    		exit('充值金额需要大于10元');
    	}*/
    	//dump($orderid);exit;
    	$this->jf_pay($orderid,$uid,$money);
    }
    //锤子支
    public function igill_pay($orderid,$uid,$payjine){
    	$igill_id =$this->view->site['igill_id'];
    	$igill_key =$this->view->site['igill_key'];
    	
    	if(empty($igill_id) || empty($igill_key)){
    		exit('配置参数错误');
    	}
        $pay_orderid = 'A'.date("YmdHis").rand(100000,999999);    //订单号
        $pay_notifyurl =$this->view->site['site_url'] . "/index.php/index/Pay/igill_return_url.html";   //服务端返回地址
		$pay_callbackurl = PAY_RETURN_URL;  //页面跳转返回地址
		$Md5key = $igill_key;   //商户后台API管理获取
		$tjurl = "http://pay.igill.cn/Pay_Index.html";   //提交地址
        $pay_applydate = date("Y-m-d H:i:s");
        $pay_bankcode = 902; 
        $native = array(
		    "pay_memberid" => $igill_id,
		    "pay_orderid" => $orderid,
		    "pay_amount" => $payjine,
		    "pay_applydate" => $pay_applydate,
		    "pay_bankcode" => $pay_bankcode,
		    "pay_notifyurl" => $pay_notifyurl,
		    "pay_callbackurl" => $pay_callbackurl,
		);
		ksort($native);
		$md5str = "";
		foreach ($native as $key => $val) {
		    $md5str = $md5str . $key . "=" . $val . "&";
		}
		//echo($md5str . "key=" . $Md5key);
		$sign = strtoupper(md5($md5str . "key=" . $Md5key));
		$native["pay_md5sign"] = $sign;
		$native['pay_attach'] = $uid;
		$native['pay_productname'] ='平台充值';
		// dump($native);exit;
		$this->buildRequestForm($native,$tjurl);
        
    }
    //锤子支付回调
    public function igill_return_url(){
    	$igill_id =$this->view->site['igill_id'];
    	$igill_key =$this->view->site['igill_key'];
    	$data =$_POST;
    	Log::record('锤子支付回调结果：'.json_encode($_POST),'notice');
    	$returnArray = array( // 返回字段
            "memberid" => $data["memberid"], // 商户ID
            "orderid" =>  $data["orderid"], // 订单号
            "amount" =>  $data["amount"], // 交易金额
            "datetime" =>  $data["datetime"], // 交易时间
            "transaction_id" =>  $data["transaction_id"], // 支付流水号
            "returncode" => $data["returncode"],
        );
        $md5key = $igill_key;
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $md5key));
        if ($sign == $data["sign"]) {
        	//Log::record('签名验证成功：'.json($returnArray),'notice');
            if ($data["returncode"] == "00") {
               
                $map['out_trade_no'] = $data["orderid"];
		        $map['status'] = 0;
		        $idx = Db::name('history')->where($map)->count();
		        if ($idx > 0) {
		            
		            $uid = Db::name('history')->where($map)->value('uid');
		            $total_fee = Db::name('history')->where($map)->value('total_fee');
		            $attach = Db::name('history')->where($map)->value('attach');
					
					$bbbb = (int)$attach;
            		$aaaa = (int)$data['amount'];
					
		            if ($bbbb != $aaaa) {
		                return false;
		                die;
		            }
		            if ($uid > 0) {
		                $fxfee = $total_fee;
		                db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
		                db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
		                Db::name('history')->where($map)->setfield('status', 1);
		                //记录收入
		                $tomap['createtime'] = $this->todaystr;
		                db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
		                $tomap['uid'] = $uid;
		                db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
		                exit("OK");
		
		            }
		        }

            }
        }
    }
    public function buildRequestForm($para_temp,$url, $method='POST', $button_name='正在跳转') {
		//待请求参数数组
		$para = $para_temp;
		$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$url."' method='".$method."'>";
		foreach ($para_temp as $key =>$val){
			$sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
		}/*
		while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }*/

		//submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";
		
		$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
		//dump($sHtml);exit;
		echo  $sHtml;exit;
	}
	//俊飞支付回调
	public function jf_return_url(Request $request){
		$jf_pay_id =$this->view->site['jf_pay_id'];
    	$jf_pay_key =$this->view->site['jf_pay_key'];
    	
		$data['appid'] = $request->post("appid");
        $data['order_no'] = $request->post("order_no");
        $data['order_id'] = $request->post("order_id");
        $data['amount'] = $request->post("amount");
        $data['time'] = $request->post("time");

        $sign = $this->sign($data,$jf_pay_key);

        if ($jf_pay_id == $data['appid'] && $sign == $request->post("sign")) {

            	$map['out_trade_no'] = $data["order_no"];
		        $map['status'] = 0;
		        $idx = Db::name('history')->where($map)->count();
		        if ($idx > 0) {
		            file_put_contents('./success1.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
		            $uid = Db::name('history')->where($map)->value('uid');
		            $total_fee = Db::name('history')->where($map)->value('total_fee');
		            $attach = Db::name('history')->where($map)->value('attach');
		            $bbbb = (int)$attach;
		            $aaaa = (int)$data['amount'];
		
		            if ($bbbb != $aaaa) {
		                return false;
		                die;
		            }
		            if ($uid > 0) {
		                $fxfee = $total_fee;
		                db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
		                db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
		                Db::name('history')->where($map)->setfield('status', 1);
		                //记录收入
		                $tomap['createtime'] = $this->todaystr;
		                db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
		                $tomap['uid'] = $uid;
		                db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
		                exit("success");
		            }
		        }


        }
        echo 'success';
	}
	//俊飞支付
	public function jf_pay($order_id,$uid,$money){
		$payapi = 'http://business.neubupay.com/api/api/pay';//请求地址
		$jf_pay_id =$this->view->site['jf_pay_id'];
    	$jf_pay_key =$this->view->site['jf_pay_key'];
    	
    	if(empty($jf_pay_id) || empty($jf_pay_key)){
    		exit('配置参数错误');
    	}
		$data = [
                'appid' => $jf_pay_id,
                'order_no' => $order_id,
                'notify_url' => $this->view->site['site_url']. "/index.php/index/Pay/jf_return_url.html",
                'return_url' =>PAY_RETURN_URL,
                'remark' => '充值',
                'amount' => $money,
                'uid'=>$uid,//如实填写,否则会造成无法支付
            ];
        $sign = $this->sign($data,$jf_pay_key);
        $data['sign'] = $sign;
        $this->buildRequestForm($data,$payapi);exit;
	}
	public function test(){
		Log::record('测试日志信息，这是警告级别','notice');
		echo 'ok';
	}
    public function iloveyou()
    {
		
        //获取post  数据  ptype 1 微信 2支付宝
        $ptype = $this->request->param('ptype');
        $money = intval($this->request->param('money'));
        $xmoney = (int)$money;

        //生成随机数
        $suijishu = rand(1, 9);
        $suijishu = '0.0' . $suijishu;
        $suijishu = (float)$suijishu;

        //汇率金额
        $shishihuilv = $this->xxxxhuilv();
        $payjine = $shishihuilv * $xmoney;
        //$payjine=round($payjine,2);
        //增加随机数
        $payjine=$suijishu+$payjine;
        //避免生成大量废单
        $time_str = time();
        $datas['uid'] = $this->auth->id;
        $datas['cash_fee'] = $xmoney;
        // $orderid=$this->create_order_no($this->auth->id);
        ////////
        //$orderid='E'.date("YmdHis").rand(100000,999999);
        //快付需要开启
        $orderid = '1061009673' . date('YmdHis', time() . rand(1000, 9999));
        if ($ptype != 1) {
            return false;
        }
        $datas['attach'] = $payjine;
        $datas['out_trade_no'] = $orderid;
        $datas['trade_type'] = 'uozhifu';
        $datas['total_fee'] = $xmoney;
        $datas['createtime'] = time();
        $datas['status'] = 0;
        $idx = Db::name('history')->insert($datas);
        //开始写支付逻辑
		
		return json_encode(['payurl'=>$this->view->site['site_url'].'/pay/'.'?money='.$payjine.'&xmoney='.$xmoney.'&uid='.$datas['uid'].'&orderid='.$orderid,'status'=>1]);
		
        // if ($ptype == 1) {
			// $pay_type =$this->view->site['pay_type'];
			// if($pay_type ==1){		// 锤子支付
				// return json(['payurl'=>$this->view->site['site_url'].url('pay/pay1').'?money='.$payjine.'&uid='.$datas['uid'].'&orderid='.$orderid,'status'=>1]);
			// }else if($pay_type ==3){ //fastpay支付
				// return  $this->payfastpay($orderid, $this->auth->id, $payjine); //fastpay
			// }else if($pay_type ==2){ // 俊飞支付
				// return json(['payurl'=>$this->view->site['site_url'].url('pay/pay2').'?money='.$payjine.'&uid='.$datas['uid'].'&orderid='.$orderid,'status'=>1]);
			// }
			
            //超级付
            // $this->chaojipay($orderid,$xmoney,$payjine);
            //C++
            //$this->cjiajia($orderid,$xmoney,$payjine);
            //聚合
            //$this->juhezhifupay($orderid,$xmoney,$payjine);
            //快付
            //  $this->kuaifuzhifu($orderid,$xmoney,$payjine);
            //个人免签
            // $this->gerenmianqianpay($orderid,$this->auth->id,$payjine);
            //fastpay
            //exit($this->payfastpay($orderid, $this->auth->id, $payjine));
            //['money'=>$payjine,'uid'=>$datas['uid'],'orderid'=>$orderid]
			
            //return  $this->payfastpay($orderid, $this->auth->id, $payjine); //fastpay

            //	$this->aizhifu($xmoney,$orderid);
            //云盛支付
            //   $this->yunshengzhifu($orderid,$this->auth->id,$payjine);
            //聚鑫支付
           // return $this->paycopay($orderid, $this->auth->id, $payjine);
        // }
        // elseif ($ptype == 2) {
        // }
        // elseif ($ptype == 3) {
        // }

    }
    
    public function sign($data, $key)
    {
        $data = $this->argSort($data);
        $data = $this->createLinkstring($data);
        $sign = strtoupper(md5($data . '&key=' . $key));

        return $sign;
    }

    public function argSort($para)
    {

        ksort($para);
        reset($para);
        return $para;
    }

    public function createLinkstring($para)
    {
        $arg = "";

        foreach ($para as $key => $val) {
            if (!is_null($val)) {
                $arg .= $key . "=" . $val . "&";
            }
        }

        $arg = substr($arg, 0, strlen($arg) - 1);

        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }
    

    protected function paycopay($orderid, $user_id, $payjine)
    {

        $lp = new  copay([
                             'bb'      => "1.0", //版本号 默认
                             'shid'    => '10155', //商户id
                             'userkey' => 'iolt4sp9nqvxwe54baowyov7ucwmbmvtqg3boskc',  //用户密钥
                             'ddh'     => $orderid, //订单号，存数字字符串
                             'je'      => $payjine, //支付多少钱
                             'zftd'    => "weixin",  //通道名称
                             'ybtz'    => 'http://' . $_SERVER['HTTP_HOST'] . "/index/index/conurl", //异步回调 请勿携带参数
                             'tbtz'    => 'http://' . $_SERVER['HTTP_HOST'] . '/index/biquan/index',
                             //支付成功后跳转, //同步回调  请勿携带参数
                             'ddmc'    => "充值", //订单名称
                             'ddbz'    => $user_id . "|充值|" . $payjine,//备注

                         ]);
        $retpay = $lp->pay();//取请求回调
        $tiao = [];
        if (!is_array($retpay) || !isset($retpay['status']) || $retpay['status'] == 0) {
            $tiao['status'] = 0;
            $tiao['payurl'] = '';
        }
        else {
            $tiao['status'] = 2;
            $tiao['payurl'] = $retpay['way'];
            $tiao['datas'] = $retpay['data'];
        }
        return json($tiao);
    }

    //fastpay
    public function payfastpay($orderid, $uid, $payjine)
    {
        header('Content-Type: text/html; charset=utf-8');

        //加载fastpay支付插件
        if (!function_exists('get_openid')) {
            require $_SERVER['DOCUMENT_ROOT'] . '/fastpay/Fast_Cofig.php';
        }
        $paydata = array();
        $paydata['uid'] = $uid;//支付用户id
        $paydata['order_no'] = $orderid;//订单号
        $paydata['total_fee'] = $payjine;//金额
        $paydata['param'] = "";//其他参数
        $paydata['me_back_url'] = PAY_RETURN_URL;//支付成功后跳转
        $paydata['notify_url'] = 'http://' . $_SERVER['HTTP_HOST'] . "/index/index/fastnurl";//支付成功后异步回调
        $geturl = fastpay_order($paydata);//获取支付链接
        $tiao['payurl'] = 'http://' . $_SERVER['HTTP_HOST'] . $geturl;
        $tiao['status'] = 1;
        echo json_encode($tiao);
    }

    //回调
    public function fastnurl()
    {
        echo 222;
        die;
        if (!function_exists('get_openid')) {
            require $_SERVER['DOCUMENT_ROOT'] . '/fastpay/Fast_Cofig.php';
        }
        $sign = $_POST['sign_notify'];//获取签名2.07版,2.07以下请使用$sign=$_POST['sign'];
        $check_sign = notify_sign($_POST);
        file_put_contents('./fastpay.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
        if ($sign != $check_sign) {
            exit("签名失效");
            die;
            //签名计算请查看怎么计算签名,或者下载我们的SDK查看
        }
        $uid = $_POST['uid'];//支付用户
        $total_fee123 = $_POST['total_fee'];//实际支付金额（可能会带增加0.01等）
        $pay_title = $_POST['pay_title'];//标题
        $sign = $_POST['sign'];//签名
        $order_no = $_POST['order_no'];//订单号
        $me_pri = $_POST['me_pri'];//订单的金额,参与签名
        $me_param = $_POST['me_param'];//其他参数
        //更新数据库
        $map['out_trade_no'] = $order_no;
        $map['status'] = 0;
        $idx = Db::name('history')->where($map)->count();
        if ($idx > 0) {
            file_put_contents('./fastpay1.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
            $uid = Db::name('history')->where($map)->value('uid');
            $total_fee = Db::name('history')->where($map)->value('total_fee');
            $attach = Db::name('history')->where($map)->value('attach');
            $bbbb = (int)$attach;
            $aaaa = (int)$total_fee123;

            if ($bbbb != $aaaa) {
                return false;
                die;
            }
            if ($uid > 0) {
                $fxfee = $total_fee;
                db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                Db::name('history')->where($map)->setfield('status', 1);
                //记录收入
                $tomap['createtime'] = $this->todaystr;
                db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                $tomap['uid'] = $uid;
                db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                echo "SUCCESS";

            }
        }

    }

    //云盛支付
    public function yunshengzhifu($orderid, $uid, $payjine)
    {
        echo 111;
        die;
        error_reporting(0);
        header("Content-type: text/html; charset=utf-8");
        $pay_memberid = "10141";   //商户后台API管理获取
        $pay_orderid = $orderid;    //订单号
        $pay_amount = $payjine;    //交易金额
        $pay_applydate = date("Y-m-d H:i:s");  //订单时间
        $pay_notifyurl = 'http://' . $_SERVER['HTTP_HOST'] . "/index/index/yunshengzhifunurl";  //服务端返回地址
        $pay_callbackurl = 'http://' . $_SERVER['HTTP_HOST'] . "/index/index/tongbuyunshengzhifunurl";  //页面跳转返回地址
        $Md5key = "66y63icir49ykiyeh60tg8xccfthltsz";   //商户后台API管理获取
        $tjurl = "http://jlytpay.com/Pay_Index.html";   //提交地址
        $pay_bankcode = "901"; //微信H5  //商户后台通道费率页 获取银行编码
        $native = array(
            "pay_memberid"    => $pay_memberid,
            "pay_orderid"     => $pay_orderid,
            "pay_amount"      => $pay_amount,
            "pay_applydate"   => $pay_applydate,
            "pay_bankcode"    => $pay_bankcode,
            "pay_notifyurl"   => $pay_notifyurl,
            "pay_callbackurl" => $pay_callbackurl,
        );
        ksort($native);
        $md5str = "";
        foreach ($native as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        //echo($md5str . "key=" . $Md5key);
        $sign = strtoupper(md5($md5str . "key=" . $Md5key));
        $native["pay_md5sign"] = $sign;
        $native['pay_attach'] = "1234|456";
        $native['pay_productname'] = '团购商品';
        $data['status'] = 2;
        $data['payurl'] = $tjurl;
        $data['datas'] = $native;
        echo json_encode($data);
    }

    //c++
    public function cjiajia($orderid, $xmoney, $payjine)
    {
        echo 111;
        die;
        header('Content-Type:text/html;charset=utf8');
        date_default_timezone_set('Asia/Shanghai');
        $userid = '11116';
        $userkey = 'e2d3750347670f8085da1d399402a6eec9979e9f';
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $ress['version'] = '1.0';
        //商户编号
        $ress['customerid'] = 11116;
        //接入秘钥
        $ress['userkey'] = 'e2d3750347670f8085da1d399402a6eec9979e9f';
        //
        $ress['sdorderno'] = $orderid;
        //金额
        $ress['total_fee'] = number_format($payjine, 2, '.', '');
        $ress['paytype'] = 'wx14';
        $ress['notifyurl'] = 'http://' . $_SERVER['HTTP_HOST'] . "/index.php/index/Pay/cjiajianurl.html";
        $ress['returnurl'] = PAY_RETURN_URL;
        $ress['remark'] = !empty($_POST['remark']) ? $_POST['remark'] : '支付';
        $ress['sign'] = md5('version=' . $ress['version'] . '&customerid=' . $ress['customerid'] . '&total_fee=' . $ress['total_fee'] . '&sdorderno=' . $ress['sdorderno'] . '&notifyurl=' . $ress['notifyurl'] . '&returnurl=' . $ress['returnurl'] . '&' . $ress['userkey']);
        $apiurl = 'http://www.fu-nice.com/apisubmit';
        //初始化
        $data['status'] = 2;
        $data['payurl'] = $apiurl;
        $data['datas'] = $ress;
        echo json_encode($data);
    }

    //juhe
    public function juhezhifupay($orderid, $xmoney, $payjine)
    {
        echo 111;
        die;
        header('Content-Type:text/html;charset=utf8');
        date_default_timezone_set('Asia/Shanghai');
        $userid = '39';//商户ID
        $userkey = 'dnmlpvbqdd2bdpjfzjkjc6hosb6x5faijc4oovv1';//商户KEY
        $apiurl = 'http://www.nvfushi.com/pay/api.php';//网关地址
        $checkurl = 'http:/www.nvfushi.com/pay/order.php';//查单地址
        $notify = 'http://' . $_SERVER['HTTP_HOST'] . "/index.php/index/Pay/juhenourl.html";;//异步通知地址
        $return = PAY_RETURN_URL;//同步跳转地址
        $native['bb'] = "1.0";                        //版本号 默认
        $native['shid'] = $userid;                        //商户id
        $native['ddh'] = $orderid;                        //订单号，存数字字符串
        $native['je'] = number_format($payjine, 2, '.', '');    //金额(必须保留两位小数点，否则验签失败)
        $native['zftd'] = "weixinh5";                    //支付通道
        $native['ybtz'] = $notify;                        //异步回调 请勿携带参数
        $native['tbtz'] = $return;                        //同步回调  请勿携带参数
        $native['ddmc'] = "充值";                        //订单名称
        $native['ddbz'] = "话费";                //订单备注
        //顺序请勿更改
        $sign = md5('shid=' . $userid . '&bb=' . $native['bb'] . '&zftd=' . $native['zftd'] . '&ddh=' . $native['ddh'] . '&je=' . $native['je'] . '&ddmc=' . $native['ddmc'] . '&ddbz=' . $native['ddbz'] . '&ybtz=' . $native['ybtz'] . '&tbtz=' . $native['tbtz'] . '&' . $userkey);//MD5加密串
        $native['sign'] = $sign;
        $native1['status'] = 2;
        $native1['payurl'] = $apiurl;
        $native1['datas'] = $native;
        echo json_encode($native1);
    }

    //聚合回调
    public function juhenourl()
    {
        echo 111;
        die;
        $status = @$_POST['status'];
        $shid = @$_POST['shid'];
        $bb = @$_POST['bb'];
        $zftd = @$_POST['zftd'];
        $ddh = @$_POST['ddh'];
        $ddmc = @$_POST['ddmc'];
        $ddbz = @$_POST['ddbz'];
        $ybtz = @$_POST['ybtz'];
        $tbtz = @$_POST['tbtz'];
        $userkey = 'dnmlpvbqdd2bdpjfzjkjc6hosb6x5faijc4oovv1';
        $je = @$_POST['je'];
        $sign = @$_POST['sign'];
        $yzsign = md5('status=' . $status . '&shid=' . $shid . '&bb=' . $bb . '&zftd=' . $zftd . '&ddh=' . $ddh . '&je=' . $je . '&ddmc=' . $ddmc . '&ddbz=' . $ddbz . '&ybtz=' . $ybtz . '&tbtz=' . $tbtz . '&' . $userkey);
        file_put_contents('./juhe.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
        if ($sign == $yzsign) {            //验证数据签名
            if ($status == 'success') {    //验证成功
                $map['out_trade_no'] = $ddh;
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->value('uid');
                    $total_fee = Db::name('history')->where($map)->value('total_fee');
                    $attach = Db::name('history')->where($map)->value('attach');
                    $bbbb = (int)$attach;
                    $aaaa = (int)$je;

                    if ($bbbb != $aaaa) {
                        return false;
                        die;
                    }
                    if ($uid > 0) {
                        $fxfee = $total_fee;
                        db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                        db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = $this->todaystr;
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        $tomap['uid'] = $uid;
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        echo 'success';
                    }
                }
            }
            else {
                echo 'fail';            //支付状态fail失败
            }
        }
        else {                        //验证失败
            echo 'Sign校验失败';
        }
    }

    //C+++HUIDIAO
    public function cjiajianurl()
    {
        echo 111;
        die;
        $ipsips = $this->getips();
        if ($ipsips != '222.186.190.138') {
            return false;
            die;
        }
        file_put_contents('./ips.txt', '异步：' . serialize($ipsips) . "\r\n", FILE_APPEND);
        if ($_POST) {
            $status = $_POST['status'];
            $customerid = $_POST['customerid'];
            $sdorderno = $_POST['sdorderno'];
            $total_fee = $_POST['total_fee'];
            $paytype = $_POST['paytype'];
            $sdpayno = $_POST['sdpayno'];
            $remark = $_POST['remark'];
            $sign = $_POST['sign'];
            if ($status == '1' && $customerid == 11116 && $paytype == 'wx14') {
                file_put_contents('./ips.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
                $map['out_trade_no'] = $sdorderno;
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->value('uid');
                    $total_fee = Db::name('history')->where($map)->value('total_fee');
                    $attach = Db::name('history')->where($map)->value('attach');
                    $bbbb = (int)$attach;
                    $aaaa = (int)$_POST['total_fee'];

                    if ($bbbb != $aaaa) {
                        return false;
                        die;
                    }
                    if ($uid > 0) {
                        $fxfee = $total_fee;
                        db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                        db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = $this->todaystr;
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        $tomap['uid'] = $uid;
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        echo 'success';
                    }

                }
            }
            else {
                echo 'success';
            }

        }

    }

    //获取请求ip
    public function getips()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else {
            $cip = "无法获取！";
        }
        return $cip;
    }

    public function create_order_no($uid)
    {
        $order_no = date('Ymd') . $uid . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 1, 5), 1))), 0, 5) . rand(1000, 9999);
        return $order_no;
    }

    public function aizhifu($xmoney, $orderid)
    {
        echo "支付通道忙，稍后再试！";
        die;
        if ($xmoney > 0) {
            $resssss = '充值话费' . $xmoney;
            $data = array(
                "fxid"        => FAST_APPKEY, //商户号
                "fxddh"       => $orderid, //商户订单号
                "fxdesc"      => $resssss, //商品名
                "fxfee"       => $xmoney, //支付金额 单位元
                "fxattch"     => $this->auth->id, //附加信息
                "fxnotifyurl" => AIPAY_NOTIFY_URL, //异步回调 , 支付结果以异步为准
                "fxbackurl"   => PAY_RETURN_URL, //同步回调 不作为最终支付结果为准，请以异步回调为准
                "fxpay"       => 'wxgzh',
                //支付类型 此处可选项以网站对接文档为准 微信公众号：wxgzh   微信H5网页：wxwap  微信扫码：wxsm   支付宝H5网页：zfbwap  支付宝扫码：zfbsm 等参考API
                "fxip"        => $this->getClientIP(0, true), //支付端ip地址
                'fxbankcode'  => '',
                'fxfs'        => '',
            );
            $fxgetway = 'http://pay.mycsc.com.cn/pay';
            $data["fxsign"] = md5($data["fxid"] . $data["fxddh"] . $data["fxfee"] . $data["fxnotifyurl"] . SECRET_KEY); //加密
            $re = $this->getHttpContent($fxgetway, "POST", $data);
            $backr = $re;
            $r = json_decode($re, true); //json转数组
            if (empty($r))
                exit(print_r($backr)); //如果转换错误，原样输出返回
            //验证返回信息
            if ($r["status"] == 1) {
                echo $re;
                exit();
            }
            else {
                //echo $r['error'].print_r($backr); //输出详细信息
                echo $r['error']; //输出错误信息
                exit();
            }
        }

    }

    public function iiiiiiloveyouurl()
    {
        echo 111;
        die;
        $fxid = FAST_APPKEY; //商户编号
        $fxddh = $_REQUEST['fxddh']; //商户订单号
        $fxorder = $_REQUEST['fxorder']; //平台订单号
        $fxdesc = $_REQUEST['fxdesc']; //商品名称
        $fxfee = $_REQUEST['fxfee']; //交易金额
        $fxattch = $_REQUEST['fxattch']; //附加信息
        $fxstatus = $_REQUEST['fxstatus']; //订单状态
        $fxtime = $_REQUEST['fxtime']; //支付时间
        $fxsign = $_REQUEST['fxsign']; //md5验证签名串
        $mysign = md5($fxstatus . $fxid . $fxddh . $fxfee . SECRET_KEY); //验证签名
        //记录回调数据到文件，以便排错
        file_put_contents('./demo.txt', '异步：' . serialize($_REQUEST) . "\r\n", FILE_APPEND);
        if ($fxsign == $mysign) {
            if ($fxstatus == '1') {//支付成功
                $map['out_trade_no'] = $fxddh;
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();//查询订单是否存在
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->value('uid');
                    if ($uid > 0) {
                        db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                        db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = $this->todaystr;
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee * 100));
                        $tomap['uid'] = $uid;
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee * 100));
                        echo 'success';
                    }
                }
                echo 'success';
            }
            else { //支付失败
                echo 'fail';
            }
        }
        else {
            echo 'sign error';
        }
    }

    public function getHttpContent($url, $method = 'GET', $postData = array())
    {
        $data = '';
        $user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $header = array(
            "User-Agent: $user_agent"
        );
        if (!empty($url)) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
                if (strstr($url, 'https://')) {
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                }

                if (strtoupper($method) == 'POST') {
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

    public function getClientIP($type = 0, $adv = false)
    {
        global $ip;
        $type = $type ? 1 : 0;
        if ($ip !== NULL)
            return $ip[$type];
        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos)
                    unset($arr[$pos]);
                $ip = trim($arr[0]);
            }
            elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip = $long
            ? array(
                $ip,
                $long
            )
            : array(
                '0.0.0.0',
                0
            );
        return $ip[$type];
    }

    ////////////////////芒果/////////////////////
    public function mangguopay($order, $money)
    {
        $post_data = array(
            'AppID'            => self::$m_AppID,
            'nonce_str'        => self::createNonceStr(32),
            'body'             => '购汇',
            'PayId'            => $order,
            'total_fee'        => $money * 100,    //分
            'spbill_create_ip' => self::get_client_ip(),
            'notify_url'       => "http://{$_SERVER['HTTP_HOST']}/m_notify_url.php",
            'return_url'       => PAY_NOTIFY_URL,

        );
        $post_data['sign'] = self::getSign($post_data, self::$m_key);
        $post_data = self::arrayToXml($post_data);
        $pay_url = 'http://pay1.hhh33.cn/api/pay/NewPay.php';
        $res = self::_curl($pay_url, $post_data);
        $r = json_decode($res, true);
        if ($r['return_code'] == 'SUCCESS') {
            $pay_url = 'http://pay1.hhh33.cn/Pay.php?AppID=' . self::$m_AppID . '&PayId=' . $order;
            $status['payurl'] = $pay_url;
            $status['status'] = 1;
            echo json_encode($status);
        }
        else {
            echo "支付通道忙，稍后再试！";
            die;
        }

    }

    public function iloveyouurl()
    {
        $data = $_GET;
        $reeeee = PAY_RETURN_URL;
        if (self::check_sign($data)) {
            //签名验证成功
            //查询订单
            $res = self::getpayinfo($data['PayId']);
            if ($res['return_code'] == 'SUCCESS' && $res['Pay_code'] == 'SUCCESS') {
                //支付成功做加钱处理
                $map['out_trade_no'] = $res['PayId'];
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();//查询订单是否存在
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->find();
                    if ($uid > 0) {
                        db::name('user')->where('id=' . $uid['uid'])->setInc('point', $uid['cash_fee']);//上分
                        db::name('user_relation')->where('uid=' . $uid['uid'])->setInc('chonzhi', $uid['cash_fee']);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = $this->todaystr;
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($uid['cash_fee']));
                        $tomap['uid'] = $uid['uid'];
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($uid['cash_fee']));

                    }
                }

            }

        }
        Header("location:{$reeeee}");

    }

    public static function getpayinfo($payId)
    {
        $post_data = array(
            'AppID'     => self::$m_AppID,
            'nonce_str' => self::createNonceStr(32),
            'PayId'     => $payId,
        );
        $url = 'http:///pay1.hhh33.cn/api/pay/GetPayInfo.php';
        $post_data['sign'] = self::getSign($post_data, self::$m_key);
        $post_data = self::arrayToXml($post_data);
        $res = self::_curl($url, $post_data);
        return json_decode($res, true);
    }

    public static function check_sign($data)
    {

        $sign = $data['sign'];
        unset($data['sign']);
        $newSign = self::getSign($data, self::$m_key);
        if ($sign != $newSign) {
            return false;
        }
        return true;
    }

    public static function _curl($url, $postData = NULL)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if (!is_null($postData)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
            else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    public static function getSign($params, $key)
    {
        ksort($params, SORT_STRING);
        $unSignParaString = self::formatQueryParaMap($params, false);
        $signStr = strtoupper(md5($unSignParaString . "&key=" . $key));
        return $signStr;
    }

    protected static function formatQueryParaMap($paraMap, $urlEncode = false)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if (null != $v && "null" != $v) {
                if ($urlEncode) {
                    $v = urlencode($v);
                }
                $buff .= $k . "=" . $v . "&";
            }
        }
        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    public static function createNonceStr($length = 16)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public static function get_client_ip()
    {
        return '111.177.18.221';
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        }
        elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }

    ///////////////////////////超级付///////////////////////////////
    public function chaojipay($orderno, $price, $payjine)
    {
        echo 111;
        die;
        $key = '6e5d12aa139cdacfeb3959b28bef9d44';//在后台可以查看
        $merchant_no = 10126;//在后台可以查看
        $payurl = 'http://www.fo53p.cn/Payment/Pay.html';
        $post_data['merchant_no'] = 10126;
        $post_data['money'] = $payjine;
        $post_data['notify_url'] = $this->view->site['site_url'] . "/index.php/index/Pay/chaojipaynurl.html";
        $post_data['back_url'] = PAY_RETURN_URL;
        $post_data['out_trade_no'] = $orderno;
        $post_data['trade_type'] = 'wx_pub';
        $post_data['sign'] = $this->makeSign($post_data, $key);
        $ressssss = json_decode($this->curl_file_post_contents($payurl, $post_data), 1);
        $status['payurl'] = $ressssss['pay_url'];
        $status['status'] = 1;
        echo json_encode($status);
    }

    //超级付支付异步回调接口
    public function chaojipaynurl()
    {
        echo 111;
        die;
        if ($_POST) {
            $key = '6e5d12aa139cdacfeb3959b28bef9d44';
            $sign = $this->makeSign($_POST, $key);
            if ($sign == $_POST['sign']) {
                //处理业务逻辑
                $post = $_POST;
                $map['out_trade_no'] = $post['out_trade_no'];
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();//查询订单是否存在
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->value('uid');
                    $total_fee = Db::name('history')->where($map)->value('total_fee');
                    $attach = Db::name('history')->where($map)->value('attach');
                    $bbbb = (int)$attach;
                    $aaaa = (int)$_POST['money'];

                    if ($bbbb != $aaaa) {
                        return false;
                        die;
                    }
                    if ($uid > 0) {
                        $fxfee = $total_fee;
                        //file_put_contents('./chaoji.txt', '异步：' . serialize($fxfee) . "\r\n", FILE_APPEND);
                        db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                        db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = $this->todaystr;
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        $tomap['uid'] = $uid;
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        return 'ok';
                    }
                }

                return 'ok';//处理成功必须返回:ok

            }

            return 'sign error';

        }

        return 'error';

    }

    public function makeSign($post, $wx_key)
    {
        if ($post) {
            ksort($post);
            unset($post['sign']);
            $str1 = '';
            foreach ($post as $k => $v) {
                $str1 .= $k . '=' . $v . '&';
            }
            // 拼接key
            $str2 = $str1 . 'key=' . $wx_key;
            // md5编码并转成大写
            $sign2 = strtoupper(md5($str2));
            return $sign2;
        }
        return false;
    }

    public function curl_file_post_contents($durl, $post_data)
    {
        // header传送格式
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $durl);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, false);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, true);
        // 设置post请求参数
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        // CURLINFO_HEADER_OUT选项可以拿到请求头信息
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        // 不验证SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //执行命令
        $data = curl_exec($curl);
        // 打印请求头信息
        //        echo curl_getinfo($curl, CURLINFO_HEADER_OUT);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }

    //快付个人免签
    public function kuaifuzhifu($order_no, $xmoney, $price)
    {
        echo 111;
        die;
        $Request['merchant_no'] = '1061009673';
        $Request['merchant_order_no'] = $order_no;
        $Request['pay_type'] = '4';
        $Request['return_url'] = PAY_RETURN_URL;
        $Request['notify_url'] = $this->view->site['site_url'] . "/index.php/index/Pay/kuaifunurl.html";
        $Request['trade_amount'] = $price;
        $Request['attach'] = $order_no;
        $api_key = '8539d9c9afa050b4cc95b53888d2765e';
        $Request['sign'] = self::klinihnk($Request, $api_key);
        $return = self::alipay_request_api('http://47.105.172.9/api/pay/order', $Request);
        $tiao['payurl'] = $return['data']['pay_url'];
        $tiao['status'] = 1;
        echo json_encode($tiao);
    }

    //快付回调
    public function kuaifunurl()
    {
        $ipsips = $this->getips();
        if ($ipsips != '47.105.172.9') {
            return false;
            die;
        }
        file_put_contents('./kuaifuipsss.txt', '异步：' . serialize($ipsips) . "\r\n", FILE_APPEND);
        $result = $_POST;
        if ($result['merchant_no'] != 1061009673) {
            echo '参数错误';
            die;
        }
        if (empty($result['merchant_order_no']) || empty($result['trade_amount'])) {
            echo '参数错误';
            die;
        }
        file_put_contents('./kuaifunurl.txt', '异步：' . serialize($result) . "\r\n", FILE_APPEND);
        $map['out_trade_no'] = $result['merchant_order_no'];
        $map['status'] = 0;
        $idx = Db::name('history')->where($map)->count();
        if ($idx > 0) {
            $uid = Db::name('history')->where($map)->value('uid');
            $total_fee = Db::name('history')->where($map)->value('total_fee');
            $attach = Db::name('history')->where($map)->value('attach');
            $bbbb = (int)$attach;
            $aaaa = (int)$_POST['trade_amount'];
            if ($bbbb != $aaaa) {
                return false;
                die;
            }
            if ($uid > 0) {
                $fxfee = $total_fee;
                db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                Db::name('history')->where($map)->setfield('status', 1);
                //记录收入
                $tomap['createtime'] = $this->todaystr;
                db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                $tomap['uid'] = $uid;
                db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                echo 'success';
            }

        }

    }

    //
    public static function klinihnk($param, $key)
    {
        //签名步骤一：按字典序排序参数
        ksort($param);
        $string = self::ToUrlParams($param);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $key;
        //签名步骤三：MD5加密
        $string = md5($string);
        return $string;

    }
    //  public static function ToUrlParams($param) {
    //     $buff = "";
    //   foreach ($param as $k => $v) {
    //     if($k != "sign" && $v != "" && !is_array($v)){
    //       $buff .= $k . "=" . $v . "&";
    // }PAY_RETURN_URL
    //}
    //$buff = trim($buff, "&");
    //return $buff;
    //}
    public static function alipay_request_api($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //https 请求
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "http") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields)) {
            $postBodyString = "";
            foreach ($postFields as $k => $v) {
                $postBodyString .= "$k=" . urlencode($v) . "&";
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);

            $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
        }
        $reponse = curl_exec($ch);
        return json_decode($reponse, true);
    }
    ///////////////////////////////////////////////////////////////////////////
    //个人免签
    public function gerenmianqianpay($order_no, $uid, $payprice)
    {
        $_POST['bank_code'] = 912;
        $_POST['appid'] = 'gpu996638869292';
        $_POST['order_no'] = $order_no;
        $_POST['amount'] = $payprice * 100;
        $_POST['product_name'] = '充值话费';
        $_POST['attach'] = $uid;
        $_POST['notify_url'] = 'http://' . $_SERVER['HTTP_HOST'] . "/index/index/gerenmiannurl";
        $_POST['return_url'] = PAY_RETURN_URL;
        if (is_numeric(strpos($_SERVER["REQUEST_URI"], '&amp;'))) { //处理经过urlencode的字符串 &amp; 是分号
            $arr = urldecode(explode('?', $_SERVER["REQUEST_URI"])[1]);
            $arr1 = explode('&amp;', $arr);
            foreach ($arr1 as $v) {
                $t = explode('=', $v);
                $param[$t[0]] = $t[1];
            }
        }
        else {
            $param = array_merge($_POST, $_GET);
        }
        $api_arr = $this->get_api_arr();
        $request_param = $this->request_param($param, $api_arr[$param['appid']]);
        $request_url = 'http://api.why1.top/api/order/unified';
        $rs = json_decode($this->curl_post($request_url, $request_param), true);
        if ($rs['status'] == 0) {
            exit('失败:' . $rs['message']);
        }
        else {
            $content = $rs['data']['content'];
            if ($this->judgeHtml($rs['data']['content']))
                unset($rs['data']['content']);
            $tiao['payurl'] = $rs['data']['redirect_url'];
            $tiao['status'] = 1;
            echo json_encode($tiao);
            if ($rs['data']['redirect_url'] == 'no_redirect') {
                print_r($content);
            }
        }
    }

    //回调
    public function gerenmiannurl()
    {
        return false;
        $ipsips = $this->getips();
        file_put_contents('./ips.txt', '异步：' . serialize($ipsips) . "\r\n", FILE_APPEND);

        if ($ipsips != '47.244.198.197') {
            return false;
            die;
        }
        if ($_POST['pay_status'] == 1 && $_POST['appid'] == 'gpu996638869292') {
            file_put_contents('./postaaaa.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);

            $map['out_trade_no'] = $_POST['order_no'];
            $map['status'] = 0;
            $idx = Db::name('history')->where($map)->count();
            if ($idx > 0) {
                $uid = Db::name('history')->where($map)->value('uid');
                $total_fee = Db::name('history')->where($map)->value('total_fee');
                $attach = Db::name('history')->where($map)->value('attach');
                $bbbb = (int)$attach;
                $aaaa = (int)$_POST['actual_amount'];
                $aaaa = $aaaa / 100;
                if ($bbbb != $aaaa) {
                    return false;
                    die;
                }
                if ($uid > 0) {
                    $fxfee = $total_fee;
                    db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                    db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                    Db::name('history')->where($map)->setfield('status', 1);
                    //记录收入
                    $tomap['createtime'] = $this->todaystr;
                    db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                    $tomap['uid'] = $uid;
                    db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                    echo 'SUCCESS';
                    exit;
                }

            }

        }
        else {

        }

    }

    /**
     * @param string $str
     * 检测是否有html标签
     */
    public function judgeHtml($str)
    {
        if ($str != strip_tags($str)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 获取测试商户
     */
    public function get_api_arr()
    {
        return array(
            //appid=>secret
            'gpu996638869292' => '006cc05a46ebdb998a85db59715bb52a',

        );
    }

    /**
     * @param string $data
     * 返回算签请求参数
     */
    public function request_param($param, $secret)
    {
        $this->clear_null($param);
        unset($param['sign'], $param['is_jump']);
        $param['secret'] = $secret;
        ksort($param);
        $param2 = [];
        foreach ($param as $k => $v) {
            $param2[] = $k . '=' . $v;
        }
        $param['sign'] = strtolower(md5(implode('&', $param2)));
        return $param;
    }

    /**
     * @param string $data
     * 清楚数据内的null
     */
    public function clear_null(&$data = '')
    {
        if ($data === null || $data === false) {
            $data = '';
        }
        if (is_array($data) && !empty($data)) {
            foreach ($data as &$v) {
                if ($v === null || $v === false) {
                    $v = '';
                }
                else if (is_array($v)) {
                    $this->clear_null($v);
                }
                else if (is_string($v) && stripos($v, '.') === 0) {
                    //				$v = '0'.$v;
                }
            }
        }
    }

    public function curl_post($url, $post_data = array(), $header = false)
    {
        //    dd($post_data);
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证
        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if (is_string($post_data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//POST数据
        }
        else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));//POST数据
        }

        $response = curl_exec($ch);//接收返回信息
        //    print_r($response);
        if (curl_errno($ch)) {    //出错则显示错误信息
            print curl_error($ch);
        }
        curl_close($ch); //关闭curl链接
        return $response;
    }
    
	


}

<?php

//decode by http://www.yunlu99.com/
namespace app\index\controller;

use think\Controller;
use think\Session;
date_default_timezone_set('PRC'); //设置中国时区 
class Pay extends Controller
{     public function decimals($n=0,$length=2,$status=false){
				if($status === true){
					$num = round($n,$length);
					return $num;
				}
				$n = (string)$n;
				$n = explode('.', $n);
				$n[0] .= '.';
				for ($i = 0; $i < $length; $i++) {

					$n[0] .= !isset($n[1][$i])?'0':$n[1][$i];
				}
				return  $n[0];
			}
		public function agentPay(){

				$uid = $_POST['uid'];
				$data = db('user')->where('id',$uid)->find();
				if(!$data['url7']){
					$data = db('user')->where('id',$data['parentid'])->find();
					if(!$data['url7']){
						$data = db('user')->where('id',1)->find();
					}
				}
				return  json(['code'=>1,'msg'=>$data['url7']]);;
		}
 
        public function createmoney(){
			$data = input(); 
			
			$payInfo1 = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->find();
			if($payInfo1['pay_type'] == 1){
				return json(['code'=>1,'msg'=>'充值成功!']);
			}
			$dataTime = date('Y-m-d H:i:s',time());  
			//return json(['code'=>1,'msg'=>'1111']);
			$insert['outtrade'] = $data['outtrade'];
			$insert['trade'] = $data['trade'];
			$insert['type'] = $data['type'];
			$insert['money'] = $data['money'];
			$insert['trade_status'] = $data['trade_status'];
			$insert['name'] = $data['name'];
            $insert['cid'] = $data['uid'];
          $insert['pay_type'] = 1;
			$insert['time'] = time();
			$where['outtrade'] = $data['outtrade'];    
			if($data['trade_status']!='TRADE_SUCCESS') 
			{
				return json(['code'=>0,'msg'=>'支付未完成']);
			} 
			if($data) 
			{
				$insert['kami'] = '用户直冲';
				db('pay')->insert($insert);
              $so=db('user')->where('id',$data['uid'])->find();
              
              db('user')->where('id',$data['uid'])->update(['money' => $so['money']+$data['money']]);
              
              return json(['code'=>1,'msg'=>'充值成功']);
			}else{
            return json(['code'=>0,'msg'=>'参数异常']);
            }
			
		}
 
		public function createKm(){     	
			/*if(isset($_GET['a']) and $_GET['a']==1){ 
				$_data = json_decode($_GET['data'],true); 
				$info  = db('order')->where(['order_no'=>$_data['out_trade_no']])->find();
				$typeInfo  = db('pay_type')->where(['id'=>$info['pay_type_id']])->find();
				 
				$data = array(
					'outtrade' => $_data['out_trade_no'],
					'trade'    => $_data['transaction_id'], 
					'money'    => $this->decimals($_data['total_fee']/100),
					'type'    => 0,
					'trade_status'    => 'TRADE_SUCCESS',
					'name' =>$typeInfo['name']
				); 
			}else{
				$data = array(
					'outtrade' => $_POST['out_trade_no'],
					'trade'    => $_POST['trade_no'],
					'type'     => isset($_POST['type'])?$_POST['type']:0,
					'money'    => $this->decimals($_POST['buyer_pay_amount']),
					'trade_status'    => $_POST['trade_status'], 
					'name' =>$_POST['subject'] 
				);  
				$_data = $_POST;
				$info = db('order')->where(['order_no'=> $data['outtrade']])->find();  
				$typeInfo= db('pay_type')->where(['id'=> $info['pay_type_id']])->find();  
			}*/
			$data = input(); 
          //return json(['code'=>0,'msg'=>$data['money']]);
			$typeInfo = db('pay_type')->where(['id'=> $data['type_id']])->find(); 
			if(!$typeInfo||$data['money'] != $typeInfo['money']){
				return json(['code'=>0,'msg'=>'支付类型不正确']);
			} 
			$payInfo1 = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->find();
			if($payInfo1['pay_type'] == 1){
				return json(['code'=>1,'msg'=>'充值成功!']);
			}
			if($typeInfo['str_name']=='daili'){
				//return json(['code'=>0,'msg'=>'支付类型不正确'.json_encode($typeInfo)]);
				//开通代理商
			 
				return $this->dailipay($data); 
			}
			
			$dataTime = date('Y-m-d H:i:s',time());  
			//return json(['code'=>1,'msg'=>'1111']);
			$insert['outtrade'] = $data['outtrade'];
			$insert['trade'] = $data['trade'];
			$insert['type'] = $data['type'];
			$insert['money'] = $data['money'];
			$insert['trade_status'] = $data['trade_status'];
			$insert['name'] = $data['name'];
			$insert['time'] = time();
			$where['outtrade'] = $data['outtrade'];    
			if($data['trade_status']!='TRADE_SUCCESS') 
			{
				return json(['code'=>0,'msg'=>'支付未完成']);
			} 
			
			$type = '0';
			$time = 0;
			$name =$data['name'];
			$day = (int)$typeInfo['day'];
			if($typeInfo['str_name'] != 'yongjiu' ){
				$time  = $day * 60*60*24;
			}else{
				$type = 1;
				$name = '永久';
			} 
			 
			$kami = randstring(8);
			$jiaka['uid'] = $data['uid'];
			 
			$jiaka['dianka'] = $kami;
			$jiaka['ctime'] = time();
			$jiaka['y'] = 0;
			$jiaka['yid'] = '';
			$jiaka['time'] = $time;
			$jiaka['type'] = $type;
			$jiaka['name'] = $name;
			if($data) 
			{
				$insert['kami'] = $kami;
				db('pay')->insert($insert);
			} 
			db('dianka')->insert($jiaka);
			return $this->dianka($data,$kami);
			 
		}

		/**直接生成会员**/
		public function dianka($data=false,$kami) 
		{
			
			
			 if(!$data){
				 $data = input(); 
			 } 
			if(!empty($data['uid'])) 
			{
				$data['dianka'] = $kami;
              //return json(['code'=>0,'msg'=>$data['uid']]);
				$num = db('user')->where('id',$data['uid'])->count();
				if($num=='0') 
				{
					return json(['code'=>0,'msg'=>'用户不存在']);
				}
				$dianka = db('dianka')->where('dianka',$data['dianka'])->find();  
              //return json(['code'=>0,'msg'=>$data['dianka']]);
				
				$user = db('user')->where('id',$data['uid'])->find();
              
				if($user['power']=='0' || $user['type']=='1') 
				{
					return json(['code'=>0,'msg'=>'您已是永久会员']);
				}
				$where['kami'] = $data['dianka'];
				$ztai = db('pay')->where($where)->find();
				if($ztai) 
				{
					db('pay')->where('kami',$data['dianka'])->update(['cid'=>$data['uid']]);
				}
              
				if($dianka['type']=='1') 
				{
					db('user')->where('id',$data['uid'])->update(['type'=>'1']);
					db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
					$lasttime = '-1';
				}
				else 
				{
					
					if($user['lasttime']>time()) 
					{
                      //return json(['code'=>0,'msg'=>$dianka['time']]);
					  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
						db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['lasttime']+$dianka['time']]);
					}
					else 
					{
					//	return json(['code'=>0,'msg'=>'用户不存在'.json_encode(time()+$dianka['time'])]);
					  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
						db('user')->where('id',$data['uid'])->update(['lasttime'=>time()+$dianka['time']]);
					}
					db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
					$lasttime = db('user')->where('id',$data['uid'])->value('lasttime');
				}
              
				$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
				//徒弟充值  
             
				/*if((int)$user['parentid']>0){
					$datasz=db('shezi')->where('uid',1)->find();
                  
      $chaxunyonghu=$user['id'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
					$this->YongJing($dai3['id'] ,$data['name'],$datasz);
				}*/
               
				if($user['parentid']>0){
					$datasz=db('shezi')->where('uid',1)->find();
                 
					$this->YongJing($user['parentid'] ,$data['name'],$datasz);
				}
				
				return json(['code' => '1','msg'=>'充值成功','lasttime'=>$lasttime]);
			}//'充值成功'
			else 
			{
				return json(['code' => '0','msg'=>'参数缺失']);
			}
		}
		public function YongJing($id,$name,$datasz){
			$p = db('user')->where(['id'=>$id])->find(); 
			$name = explode('--',$name)[1];
			$money = 0;
			if($p){
				//存在上级就给返
				//判断是什么类型的进行返钱
				switch($name){
					case "体验卡7天": 
					$money = $datasz['ckfa'];
					break;
					case "月卡": 
					$money = $datasz['ckfb'];
					break;
					case "季卡": 
					$money = $datasz['ckfc'];
					break;
					case "半年卡": 
					$money = $datasz['ckfd'];
					break;
					case "年卡": 
					$money = $datasz['ckfe'];
					break;
					case "永久卡": 
					$money = $datasz['ckff'];
					break;
					case "代理商": 
					$money = $datasz['fdljb'];
					break;
					
				}
			}   
			if($money>0){
				 db('user')->where(['id'=>$id])->update(['money'=>$p['money']+$money]); 
				 $yhtype = mb_substr($p['Source'], 0, 3);
					if ($yhtype=="微信@"){
						$yhming = mb_substr($p['Source'], 3, 8);
					}else{
						$yhming="用户".$p['id'];
					}
				 $dlmoneylog = array(
					'uid'=>$p['id'],
					'time'=>time(),
					'username'=>$yhming,
					'status'=>3,
					'jine'=>$money."yuan",
				);
				db('dlmoneylog ')->insert($dlmoneylog);	
			}
		}
		public function aliPay(){ 
			$body  = isset($_POST['body'])?$_POST['body']:"会员支付";
			$userInfo = db('user')->where(['id'=>$body])->find(); 
			if(!$userInfo){
				return json(['code'=>0,'msg'=>'用户不存在.']);
			}
			else if($userInfo['power']==1 || $userInfo['type']==1 ){
				//判断是不是升级代理商
				if($userInfo['power']==1){
					return json(['code'=>0,'msg'=>'你已经是代理商啦.']);
				}
				if($_POST['type_id']!=7){ 
					return json(['code'=>0,'msg'=>'你已经是永久会员啦.']);
				} 
				
			}
		//获取支付宝配置信息
		    $config = db('pay_config')->where('id',1)->find();
			include EXTEND_PATH.'pay/ali/AopSdk.php';
			include EXTEND_PATH.'pay/ali/aop/AopClient.php';
			$aop = new \AopClient();
			$aop->gatewayUrl = "https://openapi.alipaydev.com/gateway.do";
			$aop->appId = $config['appid'];
			$aop->rsaPrivateKey = $config['private_key']; //'MIIEowIBAAKCAQEAqwoyrGhXMsHTdvgx4hwcLey76w/fD8WLj5DiMaw+foeSGq8IZ5/vx1kn8kI9wJx1jN93oUgn6W5fJAxSG2TzEQkVBz+PPzcL7q+BZ8Oj/2+i7tLqMwP/vD79pGJk2vCeJjMV6BKL7/TVGjDaVX2FrxCozbVZbF8tGPxZZ1OqmSngB+Ne/KNah9iLiUJETAJAn/QS15XxpPMswABjtWX/jU6YQTUP66jHzhBNvyhnx1BV9jilgJkSjwyivd+Y1SDkX1Rx60GPsJVPShVc4o2rckIccTf/tInTI9viPYP9ActEk+Y7pYBw3SQvROog8XpIFe3S0L5mmYqeYMMNrUvz6wIDAQABAoIBAAsU0A+neu7I7ABrOCAkHhdDnTEviA4niFE229DIDgx4kBi2el7sV8acmh/x9rpB6MPFvqRuXlebVQKq4a7wrWbPJdOgZJF96YH/UOz+GeP0waOjepTvj2QM2LYLwekFadmjuamdef+D50KZI6wiQ8UB2U3qj+6bg/p4bvpoy0a8+q9zDJD6WXICDFAKNukNoClYwbrrwHuH+9f2MH9gaie4J9+J04ITGwzw9SJ5WD+pieEDPlVWEmdI622rD98GMMAkBtsUU+Lee/a8ogd5+k5LhGCiCpgtLxAmvmEjn/mjP3QxRNYeTeR5UWRAkVzr0vNMISKhcN6/R8Bl9RcDXHECgYEA0iyhZOTlf+yGYCYfENB7mCEhehK76xC1Gk2Hx8sCHzBmYfWgmP9GLr4pwwY0bJgtaio2jOkPG3Tv+kevlnMa4dDjy2RPFUs39drl/r0btaSETToiZ9yxIYiVP7GTPih+XM/Ok/oRwhct+D5evv0z67IktQvQoeyLE2G7mfVZDt0CgYEA0FUvKjRDzB12NGz+XZxK5VTsstWk4lOUz0j8+5Ce3smI2spU+Wa9sQ42Pk5yysTqJ1ULa6OxiFLyptvPcwDUOOt77OGs9qVfWVxWgur2IimEQBKkiCdyAII0waoWDzPJCocnY7J6YPMbmqdn9EDlDqqA3D8LtAYZzNrAN7rQzWcCgYBFK70eWJsTpAOBp2o3/XV/1v+OjpXcQk5oTrXuUmjrXOGFQfLOB83QWnOiJOuiBd+EfkofzCBVuAG3DFrEmDNzuG0QJn5EktHjD1z8nr585J1KUWS7bA277Ji6MrY0Ed2srBPf7cBkcX6GofhKwUiSPLoJ/851TEVlZpf4jp/13QKBgGDvofiDRSCOfNe790dbV8YJk/FKU2Qz+8PPdFchXarQH2ueRZeeZJkjwb2QBv2uTj1q5tt42TxTTDCzin06X4T0nT8FatOA8zLDMkXMSiZvJughRIlNwU/XRfDu0UDVma/aX0uWWjcOJ0P4rPgL0gjW8QqKE0n6pLqa9mF3/Xv1AoGBALy/hCXGxFapd5ereEPVyqb/IvkTI2p+GBH3XqsCFnBVrBbV6X5doS0uPFmo6rNQh6kc8cEWv4boti80H4lF+joLgJcA/RYQsE3C+cu7Ao35zHtSopr8id64jvg5IY9duGDLhD0ae7POYL44Rd9rkneQkL1vOh7LwQxGNRs0Q50e';
			$aop->format = "json";
			$aop->charset = "UTF-8";
			$aop->signType = "RSA2";
			$aop->alipayrsaPublicKey = $config['alipay_public_key'];//'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1+Bhke+NKeITJSRB8WDfMgm7tzNdW3O6cYiFhh29faraZdgpR5/T13YeQu/gJrpeRDMU/FiZKih3S/m1nOnM0OZNWyTE6jxTwYFZpET/waEM1LDi8t0h7YEOGQPXPy9ZMuSD546cXTDz7H963cX/eo1iNelmew2XJnmnYqNciMJ7w46hAmogGhGJX1GO0Zkzq1qdQ5xialOnKLqqqZN0AbI3wQ88wyZfOhHsjJicor0ko+GImWB/FSHKzrlgnNIguZTR1Uzepj4mEvJHMIPI2yCXrjwF3C+Kj2r3xq0ZyBct1ku/Y5/raTMkk3fUI5sAHNi76EKk3C3SBaJDK8RBYQIDAQAB';
			//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
			$request = new \AlipayTradeAppPayRequest();
			$price = isset($_POST['price'])?$_POST['price']:100000;
			$title = isset($_POST['title'])?$_POST['title']:"APP支付";
			
			$order_no = date('YmdHis').mt_rand(100,999999).time();
			
			//SDK已经封装掉了公共参数，这里只需要传入业务参数
			$bizcontent = "{\"body\":\"{$body}\","
				. "\"subject\": \"{$title}\","
				. "\"out_trade_no\": \"{$order_no}\","
				. "\"timeout_express\": \"30m\","
				. "\"total_amount\": \"{$price}\","
				. "\"product_code\":\"QUICK_MSECURITY_PAY\""
				. "}";
			if($_POST['type_id']!=7){
				$backURl = 'https://cmscs1.jc3c.cn/index/pay/createKm';
			}else{
				$backURl = 'https://cmscs1.jc3c.cn/index/pay/dailipay';
			}
			
			$request->setNotifyUrl($backURl);
			$request->setBizContent($bizcontent);
			//这里和普通的接口调用不同，使用的是sdkExecute
			$response = $aop->sdkExecute($request);
			//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
			$data = array();
			$data['msg'] = "ok";
			$data['data'] = $response;
			$data['order_no'] = $order_no;
			$_data = array(); 
			$_data['money'] =  $price;
			$_data['uid'] =  $body;
			$_data['pay_type_id'] = $_POST['type_id'];
			$_data['order_no'] =  $order_no;
			$_data['create_time'] =  time();
			$_data['update_time'] =  date('Y-m-d H:i:s',time()); 
			db('order')->insert($_data);
			echo json_encode($data);//就是orderString 可以直接给客户端请求，无需再做处理。
        return '';
    }
		
		
		
		public function getPayType(){
			$data = db('pay_type')->select();
			echo json_encode($data);//就是orderString 可以直接给客户端请求，无需再做处理。
		}
		public function getPayTypeFind(){
			$data = db('pay_type')->where(['id'=>7])->find();
			echo json_encode($data);//就是orderString 可以直接给客户端请求，无需再做处理。
		} 
	
	  //原生支付生成
	  public function createNative(){
		  
		  $weObj = new Wechat ( ); 
		 echo $weObj -> createNativeUrl('1518045551');
	  }
	 public function wxPay(){
			$userInfo = db('user')->where(['id'=>$_POST['uid']])->find(); 
			if(!$userInfo){
				return json(['code'=>0,'msg'=>'用户不存在.']);
			}
			else if($userInfo['power']==1 || $userInfo['type']==1 ){
				//判断是不是升级代理商
				if($userInfo['power']==1){
					return json(['code'=>0,'msg'=>'你已经是代理商啦.']);
				}
				if($_POST['type_id']!=7){ 
					return json(['code'=>0,'msg'=>'你已经是永久会员啦.']);
				} 
				
			} 
		include 'Wechat.class.php';  
		$payInfo = db('pay_config')->where(['id'=>1])->find(); 
		$config = [
				'appid'=>$payInfo['wxPay_appId'],
				'encodingAesKey'=>$payInfo['encodingAesKey'], 
				'appsecret'=>$payInfo['wxPay_secret'],
				'partnerid'=>$payInfo['wxPay_mchId'],
				'partnerkey'=>$payInfo['wxPay_partnerKey'],
				'token'=>$payInfo['token'],
		];
		
		$weObj = new Wechat ( $config);   
		$body =  isset($_POST['body'])?$_POST['body']:"未知支付";   
		$action =  isset($_POST['action'])?$_POST['action']:false; 
		if(!$action) {
			echo   json_encode(['code'=>0,'msg'=>'支付失败参数不正确.']);
			return ''; 
		}
		$uid = $action;
		$action = md5($action);
		$total_fee =  (isset($_POST['price'])?$_POST['price']:100000) *100;  
		//$notify_url = 'http://' . $_SERVER ['SERVER_NAME'];
		$notify_url='https://' . $_SERVER ['SERVER_NAME'] . '/extend/pay/wx/example/notify.php'; //异步处理url
		$spbill_create_ip = $_SERVER["REMOTE_ADDR"];
		$nonce_str = $weObj->generateNonceStr();  
		$order_no = date('YmdHis').mt_rand(100,999999).time();
		$pay_xml = $weObj->createPackageXmlApp($nonce_str,$body,$order_no,$total_fee,$spbill_create_ip,$notify_url,$action); 	 
		$pay_xml =  $weObj->get_pay_id($pay_xml);   
		if($pay_xml['result_code']!="SUCCESS")
		{
			  return json(['code'=>0,'msg'=>'支付有误']);
		} else{
			
			 //支付请求数据
				 	$payData = array(
						'appid' =>  $config['appid'],
						'partnerid' =>$config['partnerid'],
						'prepayid' => $pay_xml['prepay_id'],
						'noncestr' => $nonce_str,
						'package' => 'Sign=WXPay',
						'timestamp' => time()
					); 
				  //生成支付请求的签名
					$paySign = $this->MakeSign($payData,$config['partnerkey']);

					$payData['sign'] = $paySign;

					//拼接成APICLOUD所需要支付数据请求
					$payDatas = array(
						'apiKey' => $config['appid'],
						'orderId' => $pay_xml['prepay_id'],
						'mchId' => $config['partnerid'],
						'nonceStr' => $payData['noncestr'],
						'package' => 'Sign=WXPay',
						'timeStamp' => (string)$payData['timestamp'],
						'sign' => $paySign
					);
					//生成订单 
					$_data = array(); 
					$_data['money'] =  $total_fee/100;
					$_data['uid'] =  $uid;
					$_data['pay_type_id'] = (int)$_POST['type_id'];
					$_data['order_no'] =  $order_no;
					$_data['_md5'] =  $action;
					$_data['pay_type'] =  1;
					$_data['create_time'] =  time();
					$_data['update_time'] =  date('Y-m-d H:i:s',time()); 
					db('order')->insert($_data);
					echo   json_encode(['code'=>1,'msg'=>'生成支付信息成功.','data'=>$payDatas]);
			
					return '';  

		} 
	}
	/**
	* 格式化参数格式化成url参数
	*/
	public function ToUrlParams($arr)
	{
		$buff = "";
		foreach ($arr as $k => $v) {
			if ($k != "sign" && $v != "" && !is_array($v)) {
				if($k=='timestamp'){
					$buff =$buff. htmlspecialchars($k) . "=" . $v . "&";
				}else{
					$buff = $buff.$k . "=" . $v . "&";
				}
				
			}
		}

		$buff = trim($buff, "&");
		return $buff;
	}

	
	public function MakeSign($arr,$key)
	{
		//签名步骤一：按字典序排序参数
		ksort($arr);
		$string = $this->ToUrlParams($arr);  
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=" . $key;
		//签名步骤三：MD5加密 
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);
		return $result;
	}
	public function dailipay($data = false)  
		{
				if(!$data){
				 $data = input(); 
			 }
      		 $pay = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money']])->find();
      		 if(!$pay){
               $dd = array();
				$dd['outtrade'] = $data['outtrade'];
				$dd['trade'] = $data['trade'];
				$dd['money'] = $data['money'];
				$dd['trade_status'] = $data['trade_status'];
				$dd['cid'] = $data['uid'];
				$dd['type'] = $data['type'];
				$dd['name'] = $data['name'];
				$dd['time'] = time();
				$dd['kami'] = randstring(8);
				db('pay')->insert($dd);
             }else{
             	if($pay['pay_type']==1){
                  return json(['code'=>1,'msg'=>'恭喜您代理开通成功']);
                }
             }
      
      		$user = db('user')->where('id',$data['uid'])->find();//查询自己的资料
      		db('user')->where('id',$data['uid'])->update(['power'=>1]);//将自己升级为代理
      		db('pay')->where('outtrade',$data['outtrade'])->update(['pay_type'=>1]);//将订单号改为已处理
      
      		if($user['parentid']>1){
            	//处理用户上级返现
              	$con = db('shezi')->where('id',1)->find();
              	$yiji = db('user')->where('id',$user['parentid'])->find();//查询直属上级的数据
              	db('user')->where('id',$user['parentid'])->update(['money'=>$yiji['money']+$con['dljba']]);//增加直属上级的余额
              	if($yiji['parentid']>1){
                	//处理用户二级上级返现
                  	$erji = db('user')->where('id',$yiji['parentid'])->find();//查询二级上级的数据
                  	db('user')->where('id',$yiji['parentid'])->update(['money'=>$erji['money']+$con['dljbb']]);//增加二级上级的余额
                  	if($erji['parentid']>1){
                    	//处理三级上级返现
                      	$sanji = db('user')->where('id',$erji['parentid'])->find();//查询三级上级的数据
                      	db('user')->where('id',$erji['parentid'])->update(['money'=>$yiji['money']+$con['dljbb']]);//增加三级上级的余额
                    }
                }
            }
      
      		return json(['code'=>1,'msg'=>'恭喜您代理开通成功']);
      
      
      
      		exit();
      
			$dataTime = date('Y-m-d H:i:s',time());
			
			$insert['outtrade'] = $data['outtrade'];
			$insert['trade'] = $data['trade'];
			$insert['type'] = $data['type'];
			$insert['money'] = $data['money'];
			$insert['trade_status'] = $data['trade_status']; 
			$insert['name'] = $data['name'];
			$insert['time'] = time();
		
			$where['jybh'] = $data['outtrade'];  
			$yhid =$data['uid'];
			$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->find();
			
		//	
			if(!$payInfo){
				$dd = array();
				$dd['outtrade'] = $data['outtrade'];
				$dd['trade'] = $data['trade'];
				$dd['money'] = $data['money'];
				$dd['trade_status'] = $data['trade_status'];
				$dd['cid'] = $data['uid'];
				$dd['type'] = $data['type'];
				$dd['name'] = $data['name'];
				$dd['time'] = time();
				$dd['kami'] = randstring(8);
				db('pay')->insert($dd);
				 
			} 
		
			if($where) 
			{
				$ztai = db('czlog')->where($where)->find();
				if($ztai['jybh'] == $data['outtrade']) 
				{
					return json(['code'=>1,'msg'=>'恭喜!您已经开通代理了']);
				}
			}
			else 
			{
			} 
			 
			if($data['trade_status']!='TRADE_SUCCESS') 
			{
				return json(['code'=>0,'msg'=>'支付未完成']);
			} 
			$jiaka['uid'] = $yhid;
			$where['jybh'] = $data['outtrade']; 
		
			if($where ) 
			{
				$ztai = db('czlog')->where($where)->find();
				if($ztai['jybh'] == $data['outtrade']) 
				{
					return json(['code'=>1,'msg'=>'恭喜!您已经开通代理了']);
				}
			}
			
			if($data['trade_status']!='TRADE_SUCCESS') 
			{
				return json(['code'=>0,'msg'=>'支付未完成']);
			}  
			$jiaka['uid'] = $yhid;
			$jiaka['type'] = 88;
			$jiaka['jybh'] =$data['outtrade']; 
			$jiaka['time'] = time();  
				
			db('czlog')->insert($jiaka); 
			db('user')->where('id',$yhid)->update(['power'=>'1']);
			$userInfo = db('user')->where('id',$yhid)->find();
			 
			$datasz=db('shezi')->where('uid',1)->find(); 
			$dljba = $datasz["dljba"];
			$dljbb = $datasz["dljbb"];
			$dljbc = $datasz["dljbc"];
			$dljbd = $datasz["dljbd"];
			$dljbe = $datasz["dljbe"];
			$fdljb = $datasz["fdljb"];
			$times=time();
      
      
			$userdl = db('user')->where('id',$yhid)->find();
				
			$yhtype = mb_substr($userdl['Source'], 0, 3);
			if ($yhtype=="微信@"){
				$yhming = mb_substr($userdl['Source'], 3, 8);
			}else{
				$yhming="用户".$userdl['id'];
			}
			
			$kami="恭喜您！代理开通成功了!";
		//=======================1============  
				if($userdl['parentid']=='2'){
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值  
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					}
					return json(['code'=>1,'msg'=>$kami]);
					exit();
				}
      
      
      $chaxunyonghu=$userdl['parentid'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
      if($dai3['id']==1){
      return json(['code'=>1,'msg'=>$kami]);
					exit();
      }
      
				$user_p1 = db('user')->where('id',$dai3['id'])->find();
				$dailipd=$user_p1['power'];
				if ($dailipd=='1'){
				db('user')->where('id',$user_p1['id'])->update(['money'=>$user_p1['money']+$dljba]);
				$dlmoneylog = array(
					'uid'=>$user_p1['id'],
					'time'=>$times,
					'username'=>$yhming,
					'status'=>1,
					'jine'=>$dljba."yuan",
				);
				db('dlmoneylog ')->insert($dlmoneylog);	
				}
				if ($dailipd=='2'){
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值  
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					}
					db('user')->where('id',$user_p1['id'])->update(['money'=>$user_p1['money']+$fdljb]);
				} 
					$caiwumx = array(
						'uid'=>(int)$user_p1['id'],
						'type'=>0,
						'addtype'=>'200',
						'username'=>$yhming,
						'time'=>$times,
						'jinqian'=>$fdljb."yuan",
					);
					db('caiwumx')->insert($caiwumx);	
		//======================================================================	
		//=======================2============
		
				if($user_p1['parentid']=='2'){
					return json(['code'=>1,'msg'=>$kami]);
					exit();
				}
      
       $chaxunyonghu=$user_p1['parentid'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
       if($dai3['id']==1){
      return json(['code'=>1,'msg'=>$kami]);
					exit();
      }
      
      
				$user_p2 = db('user')->where('id',$dai3['id'])->find();
				$dailipd=$user_p2['power']; 
				if ($dailipd=='2'){
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值  
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					}
					return json(['code'=>1,'msg'=>$kami]);
					exit();
					}
				if ($dailipd=='1'){
				db('user')->where('id',$user_p2['id'])->update(['money'=>$user_p2['money']+$dljbb]);
				$dlmoneylog = array(
					'uid'=>$user_p2['id'],
					'time'=>$times,
					'username'=>$yhming,
					'status'=>2,
					'jine'=>$dljbb."yuan",
				);
				db('dlmoneylog ')->insert($dlmoneylog);	
				}
				
				
		//======================================================================	
		//=======================3============
		
				if($user_p2['parentid']=='2'){
					return json(['code'=>1,'msg'=>$kami]);
					exit();
				}
      
      
      
       $chaxunyonghu=$user_p2['parentid'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
       if($dai3['id']==1){
      return json(['code'=>1,'msg'=>$kami]);
					exit();
      }
      
      
      
      
				$user_p3 = db('user')->where('id',$dai3['id'])->find();
				$dailipd=$user_p3['power'];
				if ($dailipd=='2'){
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值  
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					}
					return json(['code'=>1,'msg'=>$kami]);
					exit();
					}
				if ($dailipd=='1'){
				db('user')->where('id',$user_p3['id'])->update(['money'=>$user_p3['money']+$dljbc]);
				$dlmoneylog = array(
					'uid'=>$user_p3['id'],
					'time'=>$times,
					'username'=>$yhming,
					'status'=>3,
					'jine'=>$dljbc."yuan",
				);
				db('dlmoneylog ')->insert($dlmoneylog);	
				}
				
		//======================================================================	
		//=======================4============
				if($user_p3['parentid']=='2'){
					return json(['code'=>1,'msg'=>$kami]);
					exit();
				}
      
      
       $chaxunyonghu=$user_p3['parentid'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
      
       if($dai3['id']==1){
      return json(['code'=>1,'msg'=>$kami]);
					exit();
      }
      
      
      
				$user_p4 = db('user')->where('id',$dai3['id'])->find();
				$dailipd=$user_p4['power'];
				if ($dailipd=='2'){
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值  
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					}
					return json(['code'=>1,'msg'=>$kami]);
					exit();
					}
				if ($dailipd=='1'){
					db('user')->where('id',$user_p4['id'])->update(['money'=>$user_p4['money']+$dljbd]);
					$dlmoneylog = array(
						'uid'=>$user_p4['id'],
						'time'=>$times,
						'username'=>$yhming,
						'status'=>4,
						'jine'=>$dljbd."yuan",
					);
					db('dlmoneylog ')->insert($dlmoneylog);	
				}
				
		//======================================================================
			//=======================5============
					if($user_p4['parentid']=='2'){
						return json(['code'=>1,'msg'=>$kami]);
						exit();
					} 
      
      
       $chaxunyonghu=$user_p4['parentid'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$chaxunyonghu)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $chaxunyonghu=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
      
       if($dai3['id']==1){
      return json(['code'=>1,'msg'=>$kami]);
					exit();
      }
      
      
					$user_p5 = db('user')->where('id',$dai3['id'])->find();
					$dailipd=$user_p5['power'];
					if ($dailipd=='2'){
							$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
							//徒弟充值  
							if($userInfo['pid']>0){
								$datasz=db('shezi')->where('uid',1)->find();
								$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
							}
						return json(['code'=>1,'msg'=>$kami]);
						exit();
						}
					if ($dailipd=='1'){
					db('user')->where('id',$user_p5['id'])->update(['money'=>$user_p5['money']+$dljbe]);
					$dlmoneylog = array(
						'uid'=>$user_p5['id'],
						'time'=>$times,
						'username'=>$yhming,
						'status'=>5,
						'jine'=>$dljbe."yuan",
					);
					db('dlmoneylog ')->insert($dlmoneylog);	
					}  
					$payInfo = db('pay')->where(['outtrade'=>$data['outtrade'],'money'=>$data['money'],'trade'=>$data['trade']])->update(['pay_type'=>1]);
					//徒弟充值   
					if($userInfo['pid']>0){
						$datasz=db('shezi')->where('uid',1)->find();
						$this->YongJing($userInfo['pid'] ,$data['name'],$datasz);
					} 
					return json(['code'=>1,'msg'=>$kami]);
					
			
		}
	
     
}
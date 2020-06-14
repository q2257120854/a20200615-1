<?php 
namespace app\common\library;
use think\Controller;
use think\Db;
use think\Cache;
class Wxpay{
  private $appId;
  private $appSecret;
  private $code;
  private $pdata;
   private $wxconfig;
   private $payconfig;
   
  public function __construct($config='') {
    $this->config=$config;
    $this->appId =$config['appid'];
	$this->appsecret=$config['appsecret'];
    $this->mchid =$config['mchid'];
	$this->paykey =$config['paykey'];; //$this->config['mchid'];
	//设置接口链接
	$this->url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
	//设置curl超时时间
	$this->curl_timeout = 60;
  }
  /**
	 * 	作用：生成可以获得code的url
	 */
public	function createOauthUrlForCode($redirectUrl)
	{
		$urlObj["appid"] = $this->appId;
		$urlObj["redirect_uri"] = $redirectUrl;
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	/**
	 * 	作用：生成可以获得openid的url
	 */
public function createOauthUrlForOpenid()
	{
		$urlObj["appid"] = $this->appId;
		$urlObj["secret"] = $this->appsecret;
		$urlObj["code"] = $this->code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	/**
	 * 	作用：通过curl向微信提交code，以获取openid
	 */
public	function getOpenid($code)
	{
	    $this->code=$code;
		$url = $this->createOauthUrlForOpenid();
        //初始化curl
       	$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->curl_timeout);
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//运行curl，结果以jason形式返回
        $res = curl_exec($ch);
		curl_close($ch);
		//取出openid
		$data = json_decode($res,true);
		$this->openid = $data['openid'];
		return $this->openid;
	}
	/**
	 * 	作用：获得支付数据
	 */
	public function getpay($pdata)
	{
	   $this->pdata=$pdata;
		$jsApiObj["appId"] = $this->appId;
	    $jsApiObj["timeStamp"] = time();
	    $jsApiObj["nonceStr"] = $this->createNoncestr();
		$jsApiObj["package"] = "prepay_id=".$this->getPrepayId($pdata);
	    $jsApiObj["signType"] = "MD5";
	    $jsApiObj["paySign"] = $this->getSign($jsApiObj);
	    $this->parameters = json_encode($jsApiObj);
		return json_decode($this->parameters,true);
	}
//向客户付款
public function paytouser($data){
		$url="https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
		$xml = "<xml><mch_appid>".$this->config['appid']."</mch_appid>
				<mchid>".$this->config['mchid']."</mchid>
				<nonce_str>".$this->rand_string(32)."</nonce_str>
				<partner_trade_no>".$data['trade_no']."</partner_trade_no>
				<openid>".$data['openid']."</openid>
				<check_name>".$data['check']."</check_name>
				<re_user_name>".$data['re_user_name']."</re_user_name>
				<amount>".$data['amount']."</amount>
				<desc>".$data['desc']."</desc>
				<spbill_create_ip>".$data['ip']."</spbill_create_ip>
				</xml>";
				
				//print_r($xml);exit;
		$rel=$this->xmlToArray($xml);
		unset($rel['sign']);
		ksort($rel);
		$rel['sign']=$this->getSign($rel);
		//print_r($rel);exit;
		$xml=$this->arrayToXml($rel);
		//echo $xml;exit;
		//echo  $url;
		$r=$this->postXmlSSLCurl($xml,$url);
		//echo $r;exit;
		return $this->xmlToArray($r); 
	}
	//返回有效性认
	public function checkSign()
	{   $xml = file_get_contents("php://input");//$GLOBALS['HTTP_RAW_POST_DATA'];	
	
	    $data=$this->xmlToArray($xml);
		$tmpData = $data;
		return $data;exit;
		unset($tmpData['sign']);
		$sign = $this->getSign($tmpData);//本地签名
		if ($data['sign'] == $sign) {
			return $data;
		}
		return false;
	}
  /**
	 * 获取prepay_id
	 */
private	function getPrepayId($pdata)
	{
	    $this->pdata=$pdata;
		$this->postXml();
		$this->result = $this->xmlToArray($this->response);
		$prepay_id = $this->result["prepay_id"];
		return $prepay_id;
	}
	/**
	 * 	作用：post请求xml
	 */
private	function postXml()
	{
	    $xml = $this->createXml();
		$this->response = $this->postXmlCurl($xml,$this->url,$this->curl_timeout);
		return $this->response;
	}
	/**
	 * 生成接口参数xml
	 */
	private function createXml()
	{
		try
		{
			//检测必填参数
			if($this->pdata["out_trade_no"] == null) 
			{
				echo "缺少统一支付接口必填参数out_trade_no！"."<br>";
			}elseif($this->pdata["body"] == null){
				echo "缺少统一支付接口必填参数body！"."<br>";
			}elseif ($this->pdata["total_fee"] == null ) {
				echo "缺少统一支付接口必填参数total_fee！"."<br>";
			}elseif ($this->pdata["notify_url"] == null) {
				echo "缺少统一支付接口必填参数notify_url！"."<br>";
			}elseif ($this->pdata["trade_type"] == null) {
				echo "缺少统一支付接口必填参数trade_type！"."<br>";
			}elseif ($this->pdata["trade_type"] == "JSAPI" &&
				$this->pdata["openid"] == NULL){
				echo "统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！"."<br>";
			}
		   	$this->pdata["appid"] = $this->appId;//公众账号ID
		   	$this->pdata["mch_id"] = $this->mchid;//商户号
		   	$this->pdata["spbill_create_ip"] = $_SERVER['REMOTE_ADDR'];//终端ip	    
		    $this->pdata["nonce_str"] = $this->createNoncestr();//随机字符串
		    $this->pdata["sign"] = $this->getSign($this->pdata);//签名
		    return  $this->arrayToXml($this->pdata);
		}catch (SDKRuntimeException $e)
		{
			echo $e;
		}
	}
	/**
	 * 	作用：将xml转为array
	 */
	private function xmlToArray($xml)
	{		
        if(!$xml){
			echo "error xml";
		}
        //将XML转为array  
		//禁止引用外部xml实体
       // libxml_disable_entity_loader(true);      
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);		
		return $array_data;
	}
/**
	 * 	作用：array转xml
	 */
	private function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
        	 if (is_numeric($val))
        	 {
        	 	$xml.="<".$key.">".$val."</".$key.">"; 
        	 }
        	 else
        	 	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
        return $xml; 
    }
	/**
	 * 	作用：生成签名
	 */
	private function getSign($Obj)
	{
		foreach ($Obj as $k => $v)
		{
			$Parameters[$k] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//echo '【string1】'.$String.'</br>';
		//签名步骤二：在string后加入KEY
		$String = $String."&key=".$this->paykey;
		//echo "【string2】".$String."</br>";
		//签名步骤三：MD5加密
		$String = md5($String);
		//echo "【string3】 ".$String."</br>";
		//签名步骤四：所有字符转为大写
		$result_ = strtoupper($String);
		//echo "【result】 ".$result_."</br>";
		return $result_;
	}
/**
	 * 	作用：产生随机字符串，不长于32位
	 */
	private function createNoncestr( $length = 32 ) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str;
	}
/**
	 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
	 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
	 +----------------------------------------------------------
 * @return string
	 +----------------------------------------------------------
 */
private function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) { //位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4) {
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else {
		// 中文随机字
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;
}
	/**
	 * 	作用：格式化参数，签名过程需要使用
	 */
	private function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
		    if($urlencode)
		    {
			   $v = urlencode($v);
			}
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
/**
	 * 	作用：以post方式提交xml到对应的接口url
	 */
	private function postXmlCurl($xml,$url,$second=30)
	{		
        //初始化curl        
       	$ch = curl_init();
		//设置超时
	    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
        $data = curl_exec($ch);
		curl_close($ch);
		//返回结果
		if($data){
		return $data;
		}
		else 
		{ 
			$error = curl_errno($ch);
			echo "curl出错，错误码:$error"."<br>"; 
			echo "<a href='#'>错误原因查询</a></br>";
			curl_close($ch);
			return false;
		}
	}
/**
	 * 	作用：使用证书，以post方式提交xml到对应的接口url
	 */
	private function postXmlSSLCurl($xml,$url,$second=30)
	{
	 //echo "testmse:".$xml;exit;
	$sk=ROOT_PATH.$this->config['cert_pem'];
	$ak=ROOT_PATH.$this->config['key_pem'];
	 //echo $sk;exit;
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		//这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		//设置header
		curl_setopt($ch,CURLOPT_HEADER,FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		//设置证书
		//使用证书：cert 与 key 分别属于两个.pem文件
		//默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT, $sk);
		//默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY,  $ak);
		//post提交方式
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
		$data = curl_exec($ch);
		//var_dump($data);exit;
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		}
		else { 
			$error = curl_errno($ch);
			echo "curl出错，错误码:$error"."<br>"; 
			echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
			curl_close($ch);
			return false;
		}
	}

}

?>

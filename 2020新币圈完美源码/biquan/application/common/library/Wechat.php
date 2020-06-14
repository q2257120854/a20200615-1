<?php 
namespace app\common\library;
use think\Controller;
use think\Db;
use think\Cache;
class Wechat
{
private $wx=0;
private $siren=array();
    public function _initialize($site) {
	 
		  $this->site=$site;//关注时回复anywn
	 
		 $this->baseurl = "Uploads/".$this->site["appid"];
		  if (!is_dir($this->baseurl)) {mkdir($this->baseurl,0777);}

    }
public function openmsg($wx)
    {
	$this->responseMsg(1);
	exit;
	}
public function responseMsg($wx)
    {
                //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];	
		 	
		//echo $postStr;exit;
		if (!empty($postStr))
		{       
		                        $this->wx=$_REQUEST['wx'];
		       

				                include_once "wxcode/wxBizMsgCrypt.php";
								$pc = new WXBizMsgCrypt($this->site['token'], $this->site['encodingAesKey'], $this->site['appid']);
				                $xml_tree = new DOMDocument();
								$xml_tree->loadXML($postStr);
								$array_e = $xml_tree->getElementsByTagName('Encrypt');
								$encrypt = $array_e->item(0)->nodeValue;
								$array_s = $xml_tree->getElementsByTagName('ToUserName');
								$msg_sign = $array_s->item(0)->nodeValue;
								
				                $msg = '';
								$msg_sign   = empty($_GET['msg_signature']) ? ""    : trim($_GET['msg_signature']) ;
								$timeStamp  = empty($_GET['timestamp'])? "": trim($_GET['timestamp']) ;
								$nonce      = empty($_GET['nonce'])     ? ""    : trim($_GET['nonce']) ;
							    
								$format = "<xml><ToUserName><![CDATA[%s]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
								$from_xml = sprintf($format,$msg_sign, $encrypt);
								$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
								
				
				
				//echo "ffff".$msg;exit;
////////////////////////////////////处理请求信息//////////////////////////////////////////
				$postStr=$msg;
				//put_txt("ticket/msg",$msg);
				/*///////////////////////////////////////////////解密结束/////////////////////////*/	
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;//客户端
                $toUsername = $postObj->ToUserName;//服务端公众号id
				//$this->searvicetouser($fromUsername,$toUsername);
				//$this->sendtext($fromUsername, $toUsername,"=xxx。");
				$mtype=$postObj->MsgType;
                $keyword = $this->deletehtml(trim($postObj->Content));//接收到的关键词
                $time = time();
///////////////////////事件走向//////////////////////////
				if($mtype=="event"){
					$event=$postObj->Event;
					if($event=="LOCATION"){//自动上报地理位置
						$position["time"]=$postObj->CreateTime;//经度
						$position["y"]=$postObj->Latitude;//经度
						$position["x"]=$postObj->Longitude;//纬度
						$position["scale"]=$postObj->Precision;//地理位置精度
						return array("type"=>$mtype,"event"=>$event,"loc"=>$position,"user"=>$fromUsername,"me"=>$toUsername); 
						exit;
					}elseif($event=="subscribe"){//subscribe未关注
						$keyword=$postObj->EventKey;
						$keyword=str_replace("qrscene_","",$keyword);
					    return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
					}elseif($event=="unsubscribe"){//取消关注未关注
					    return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
					}elseif($event=="SCAN"){//已关注的扫描+subscribe未关注
						$keyword=$postObj->EventKey;
						return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
					}elseif($event=="CLICK"){//已关注的扫描+subscribe未关注
						$keyword=$postObj->EventKey;
						return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
					}
				 }
//////////////////////事件结束/////////////////////////
               //$this->sendtext($fromUsername,$toUsername,"用户id：".$userid);
				$wxconfig=$this->site;
				$keyset=$this->keyset;
				if($wxconfig["ifhome"]){
						$more=$wxconfig['follow']<>""?$wxconfig['follow']:"系统后台未设置关注回复!";
						$this->sendtext($fromUsername, $toUsername,$more);
					}else{
						$this->sendimg($fromUsername, $toUsername,$wxconfig);//标题，简介，图片，链接
					}

				return array("type"=>$mtype,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
			

        }
		else 
		{
                echo "success";
				
                exit;
        }

    }



//普通token-文件缓存形式
  public function token($appid,$appsecret) {
  $jsonurl=getcwd()."/gznet/Cache/access_token.json";
	$data = json_decode(file_get_contents($jsonurl));

    if ($data->expire_time< time()) {
	  unlink($jsonurl);
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->site['appid']."&secret=".$this->site['appsecret'];
      $res = json_decode($this->http_get($url));
      $access_token = $res->access_token;
      if ($access_token) {
		$data->expire_time= time() + 7000;
		$data->access_token= $access_token;
		$fp = fopen($jsonurl, "w");
		fwrite($fp, json_encode($data));
		fclose($fp);
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }
  //网页授权
  
  //刷新webtoken-
    public function rewebtoken($refresh_token) {
	$file="gznet/Cache/rweb_token.json";
	$data = json_decode(file_get_contents($file));
    if ($data->expire_time< time()) {
      $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->site['appid']."&grant_type=refresh_token&refresh_token=".$refresh_token;
      $res = json_decode($this->http_get($url));
      $access_token = $res->access_token;
      if ($access_token) {
		$data->expire_time= time() + 7000;
		$data->access_token= $access_token;
		$data->refresh_token= $res->refresh_token;
		$fp = fopen($file, "w");
		fwrite($fp, json_encode($data));
		fclose($fp);
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }
public function http_request_json($url){//json请求，因为url是https 所有请求不能用file_get_contents,用curl请求json 数据  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
        return $result;    
    }
public function http_post($url, $jsonData){//带json发送
		$ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
		curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
		return $result;
		}
public function http_get($url){//带json发送，无json数据

		$ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
		return $result;
		}		
/////////////////////////////////////////////////
 
	/////////////////////////////////////////////////////////////////
function GrabImage($url,$filename="") { 
if (file_exists($filename)){
return $filename;
exit;
}
if($url=="") return false; 
if($filename=="") { 
	$ext=strrchr($url,"."); 
	if($ext!=".gif" && $ext!=".jpg" && $ext!=".png") return false; 
	$filename=date("YmdHis").$ext; 
	} 
	ob_start(); 
	readfile($url); 
	$img = ob_get_contents(); 
	ob_end_clean(); 
	$size = strlen($img); 
	$fp2=@fopen($filename, "a"); 
	fwrite($fp2,$img); 
	fclose($fp2); 
	return $filename; 
} 

public function valid($token)
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature($token)){
                echo $echoStr;
				exit;
        }
    }
 
public function httpGetRequest($url){
                $out = file_get_contents($url);
                return $out;
        }
public function deletehtml($str)
{
$str = trim($str);
$str=strip_tags($str,"");
$str=preg_replace("{\t}","",$str);
$str=preg_replace("{\r\n}","",$str);
$str=preg_replace("{\r}","",$str);
$str=preg_replace("{\n}","",$str);
$str=preg_replace("{ }","",$str);
return $str;
}

public function checkSignature($token)
        {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                $tmpArr = array($token, $timestamp, $nonce);
                sort($tmpArr);
                $tmpStr = implode( $tmpArr );
                $tmpStr = sha1( $tmpStr );

                if( $tmpStr == $signature ){
                        return true;
                }else{
                        return false;
                }
        }
//////////////////////////////////加密程序//////////////////////////////////////////////////////
public function jiami($timeStamp,$xml){
// 第三方发送消息给公众平台
include_once "wxcode/wxBizMsgCrypt.php";
if($this->wx==1){
	$token = $this->site['token'];
	$encodingAesKey=$this->site['encodingAesKey'];
	$appId = $this->site['appid'];
}else{//私人加密
	$token = $this->siren['token'];
	$encodingAesKey=$this->siren['encodingAesKey'];
	$appId = $this->siren['appid'];
}
$nonce = "xxxxxx";
$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
$encryptMsg = '';
$errCode = $pc->encryptMsg($xml, $timeStamp, $nonce, $encryptMsg);
return  $encryptMsg;
}
/**************发送单纯的图片***************/
public function sendpic($from, $to,$mediaid='')//
		{
		//$mediaid="kUPWNezV6Oqj-ReI_emjcWQaigCij5Tr5t4_9pGIcK6xnOwJcIHriP8tMWnIQkXP";
				$textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Image>
				<MediaId><![CDATA[%s]]></MediaId>
				</Image>
				</xml>";
				$msgType = "image";
				$time = time();
				$resultStr = sprintf($textTpl, $from, $to, $time, $msgType,$mediaid);
				echo $this->jiami($time,$resultStr);
				exit;
		}
/****************素材临时图片，生成素材id*****************/
public function upload($path='',$uid=0){
	$path=empty($path)?$_REQUEST['path']:$path;
	$path=str_replace("\\\\","\\",$path);
	$map['media']=$path;//图片地址
	$map['type']='image';
	$ar=$this->upload_media($map);
	if($ar['media_id']){
		$count=M("media")->where("media_id='".$ar['media_id']."'")->count();
		if(!$count){
			$ar['status']=1;
			$ar['url']=$path;
			$ar['uid']=$uid;
			M("media")->add($ar);
		}
		return $ar['media_id'];
	}else{
		return 0;
	}
}
////////////////////////////////////////////////////////////////////////////////////////
public function sendimg($from, $to,$data)//标题，简介，图片，链接
		{
		$imgTpl = "<xml>
		 <ToUserName><![CDATA[%s]]></ToUserName>
		 <FromUserName><![CDATA[%s]]></FromUserName>
		 <CreateTime>%s</CreateTime>
		 <MsgType><![CDATA[news]]></MsgType>
		 <ArticleCount>1</ArticleCount>
		 <Articles>
		 <item>
		 <Title><![CDATA[%s]]></Title> 
		 <Description><![CDATA[%s]]></Description>
		 <PicUrl><![CDATA[%s]]></PicUrl>
		 <Url><![CDATA[%s]]></Url>
		 </item>
		 </Articles>
		 <FuncFlag>0</FuncFlag>
		 </xml> ";
		$msgType = "image";
		$time = time();
   $config=$this->site;
   if($data["thumb"]<>""){
		if (!(strpos($data["thumb"], 'http') === FALSE)) {
		$thumb=$data["thumb"];
		} else {
		$thumb=$config["site_url"].$data["thumb"];
		}
	}else{
	    $thumb=$config["logo"];
	}
	if (!(strpos($data["url"], 'http') === FALSE)) {
		$url=$data["url"];
	} else {
		$url=$config["site_url"].$data["url"];
	}
	if(strpos($url,"?")!== false){
		$urlx=$url."&wxid=".sysmd5($from);
		$urlx=str_replace("?&","?",$urlx);
	}else{
		$urlx=$url."?wxid=".sysmd5($from);
	}
		$resultStr = sprintf($imgTpl, $from, $to, $time,$data["title"],$data["description"],$thumb,$urlx);
		echo $this->jiami($time,$resultStr);
	exit;
		}

public function menu($data){
$token=$this->token($this->site["appid"],$this->site["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
$data=str_replace("&amp;","&",$data);
$result=$this->http_post($url,$data);
return $result;
}


public function delmenu(){//删除菜单
$token=$this->token($this->site["appid"],$this->site["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$token;//删除菜单
$result=$this->http_get($url);
return $result;
}
public function lookmenu(){//查看菜单
$token=$this->token($this->site["appid"],$this->site["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$token;//删除菜单
$result=$this->http_get($url);
return $result;
}
///////////////////////////////////////////////////////////////////////////////////
public function searvicesys($from,$to){//客户系统
$xml="<xml>
<ToUserName><![CDATA[touser]]></ToUserName>
<FromUserName><![CDATA[fromuser]]></FromUserName>
<CreateTime>1399197672</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
echo $xml;
exit;
}
/*$this->searvicetouser($fromUsername,$toUsername);*/
public function searvicetouser($to,$from){//消息转发到多客服
$xml="<xml>
<ToUserName><![CDATA[".$to."]]></ToUserName>
<FromUserName><![CDATA[".$from."]]></FromUserName>
<CreateTime>".time()."</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
echo $xml;
exit;
}
///////////////////////////////////////////////////////////////////////////////////	
public function sendnews($from, $to,$data,$url="",$type)//
		{
		$item="";
$config=$this->site;
$url=$url<>""?$url:$config["url"];
foreach($data as $key=>$v)
{
	if(strlen($v["thumb"])>4){
		if (!(strpos($v["thumb"], 'http') === FALSE)) {
		$thumb=$v["thumb"];
		} else {
		$thumb=$url.thumb($v["thumb"],365,169,0);
		}
	}else{
	     if (!(strpos($config["thumb"], 'http') === FALSE)) {
		 $thumb=$config["thumb"];
		} else {
		$thumb=$url.$config["thumb"];
		}
	    
	}
		if (!(strpos($v["url"], 'http') === FALSE)) {
		$d_url=$v["url"];
		} else {
		$d_url=$url.$v["url"];
		}
if(strpos($d_url,"?")!== false){
		$urlx=$d_url."&wxid=".sysmd5($from);
		$urlx=str_replace("?&","?",$urlx);
	}else{
		$urlx=$d_url."?wxid=".sysmd5($from);
	}
	 $item.="<item>
	<Title><![CDATA[".$v["title"]."]]></Title> 
	<Description><![CDATA[".$v["description"]."]]></Description>
	<PicUrl><![CDATA[".$thumb."]]></PicUrl>
	<Url><![CDATA[".$urlx."]]></Url>
	</item>";

}
$time=time();
$newsTpl = "<xml>
<ToUserName><![CDATA[".$from."]]></ToUserName>
<FromUserName><![CDATA[".$to."]]></FromUserName>
<CreateTime>".$time."</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>".count($data)."</ArticleCount>
<Articles>
".$item." </Articles><FuncFlag>1</FuncFlag></xml> ";
echo $this->jiami($time,$newsTpl);
exit;
		}		

public function sendtext($from, $to,$con)//接收者，本账号，内容。
		{
							   $textTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[%s]]></MsgType>
									<Content><![CDATA[%s]]></Content>
									<FuncFlag>0</FuncFlag>
									</xml>";
								$msgType = "text";
								$time = time();
								$resultStr = sprintf($textTpl, $from, $to, $time, $msgType,$con);
								echo $this->jiami($time,$resultStr);
						exit;
		}		
public function sendmusic($from, $to,$title,$dec,$murl,$url)////目的，本账号，标题，简介，音乐链接，链接
		{
							$musicTpl = "<xml>
							 <ToUserName><![CDATA[%s]]></ToUserName>
							 <FromUserName><![CDATA[%s]]></FromUserName>
							 <CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[music]]></MsgType>
							 <Music>
							 <Title><![CDATA[%s]]></Title>
							 <Description><![CDATA[%s]]></Description>
							 <MusicUrl><![CDATA[%s]]></MusicUrl>
							 <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
							 </Music>
							 <FuncFlag>0</FuncFlag>
							 </xml>";
								$time = time();
								$resultStr = sprintf($musicTpl,$from,$to,$time,$title,$dec,$murl,$url);
								echo $this->jiami($time,$resultStr);
						      exit;
		}	
/************发送模板消息**************/
public function tplmsg($data){//模板消息$data=json格式数据.who=用户
	$token=$this->token($this->site["appid"],$this->site["appsecret"]);
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;
	$result=$this->http_post($url,$data);
	return $result;
}

	
/***********新增临时素材***********/
public function upload_media($map){
$token=$this->token($this->site["appid"],$this->site["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$token."&type=".$map['type'];
$str=substr($map['media'],0,4);
if($str=='http'){
$cDir="Uploads/web/";
if (! is_dir ( $cDir )) {
		mkdir ( $cDir, '0777' );
		}
$data['media']='@'.getcwd().$this->GrabImage($map['media'],$cDir.time().".jpg");
}else{
	$data['media']='@'.getcwd().$map['media'];
}

$r=$this->posfile($url,$data);
$ar=json_decode($r,true);
return $ar;
}
/***********获取素材库***********/
	/////////////////////////列表//////////////////////////////////
	/*$map['offset']=0;
	$map['count']=20;
	$map['type']="image";
	$r=$this->wechatObj->getmedia($map);//获得素材列表
	$list=$r['item'];
	foreach($list as $key=>$vo){
		$count=M("media")->where("media_id='".$vo['media_id']."'")->count();
		if(!$count){
		$vo['type']=$map['type'];
		$vo['created_at']=time();
		M("media")->add($vo);}
	}*/
    //////////////////////////////////////////////////////////
public function getmedia($map){
$token=$this->token($this->site["appid"],$this->site["appsecret"]);
if(!$map){
$map['offset']=0;
$map['count']=20;
}
$jsonData="{\"type\":\"".$map['type']."\",\"offset\":".$map['offset'].",\"count\":".$map['count']."}";
$url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$token;
$r=$this->http_post($url,$jsonData);
$ar=json_decode($r,true);
return $ar;
}
/****************发送图片*****************/
public function posfile($url,$data){
		$ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
		curl_setopt($ch, CURLOPT_POST, 1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
		return $result;
}		
 
//获取客服在线数量
public function get_onlinecount(){
	$url="https://api.weixin.qq.com/cgi-bin/customservice/getonlinekflist?access_token=".$this->token();
	$result=$this->http_get($url);
	$w1=json_decode($result,true);
    return count($w1['kf_online_list']) ;
}
public function get_access_token($code){//通过code换取网页授权access_token
	$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->site["appid"]."&secret=".$this->site["appsecret"]."&code=".$code."&grant_type=authorization_code";
	return  json_decode($this->http_get($url),true);  
}
public function get_snsapi_userinfo($token,$openid){//通过code换取网页授权access_token
	$url="https://api.weixin.qq.com/sns/userinfo?access_token=".$token."&openid=".$openid."&lang=zh_CN";
	return  json_decode($this->http_get($url),true);  
}
public function get_userinfo($openid){//获取用户资料
	$token=$this->token($this->site["appid"],$this->site["appsecret"]);
	$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openid."&lang=zh_CN";
	$result=$this->http_get($url);
	return $result;
}
/////////////////////////////ibeacon设备管理//////////////////////////////////
public function shenqing($access_token,$jsonData){//申请开通摇一摇功能
    
	$url="https://api.weixin.qq.com/shakearound/account/auditstatus?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}
//$uid:场景ID
//$ever:默认0，默认临时二维码
public function ewm($uid,$ever){//通过access_token获取临时二维码
        $uid=$uid>0?$uid:1;
		$ever=$ever>0?$ever:0;
		if($ever>0){
			$cDir = $this->baseurl."/ewm/";			
			$filename=$cDir."/".$uid.".jpg";
			if (file_exists($filename)){
				$ticke=$filename;
			}else{
				$ticke=$this->get_ewm($uid,$ever);
			}
		}else{
			$ticke=$this->get_ewm($uid,$ever);
		}		
		$ticke=str_replace('com//','com/',$ticke);
		$ticke=str_replace('net//','net/',$ticke);
		$ticke=str_replace('cn//','cn/',$ticke);
		return $ticke;
}

//连接缩短
public function shoturl($shareurl){//通过access_token获取临时二维码
        $token=$this->token($this->site["appid"],$this->site["appsecret"]);
		$url="https://api.weixin.qq.com/cgi-bin/shorturl?access_token=".$token;//获取ticket
		 $map['action']='long2short';
		 $map['long_url']=$shareurl;
		 $json=json_encode($map);;
		$result=$this->http_post($url,$json);//返回结果
		//echo $result;
		$w1=json_decode($result,true);
	//  print_r($wl);
		
		// exit;
		if($w1['errmsg']=='ok'){
		  return $w1['short_url'];
		}else{
		  return 0;
		}
		
}

public function get_ewm($uid,$ever){//通过access_token获取临时二维码
        $token=$this->token($this->site["appid"],$this->site["appsecret"]);
		$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$token;//获取ticket
		if($ever){
		   $json="{\"action_name\": \"QR_LIMIT_SCENE\", \"action_info\": {\"scene\": {\"scene_id\": ".$uid."}}}";
		}else{
		   $json="{\"expire_seconds\": 1800, \"action_name\": \"QR_SCENE\", \"action_info\": {\"scene\": {\"scene_id\": ".$uid."}}}";
		}
		
		$result=$this->http_post($url,$json);//返回结果
		$w1=json_decode($result,true);
		$ticke="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$w1['ticket'];//换取二维码
		
		if($ever>0){
			$cDir = $this->baseurl."/ewm/";
			$path=$cDir."/".$uid.".jpg";
		   $ticke=$this->GrabImage($ticke,$path);
		}
		
		return $ticke;

}

public function applyid($access_token,$jsonData){//申请applyid
    
	$url="https://api.weixin.qq.com/shakearound/device/applyid?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}

public function ibeacon_edit($access_token,$jsonData){//编辑设备信息
    
	$url="https://api.weixin.qq.com/shakearound/device/update?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}
public function relaship($access_token,$jsonData){//配置设备与门店的关联关系
    
	$url="https://api.weixin.qq.com/shakearound/device/bindlocation?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}
public function ibealist($access_token,$jsonData){//查看列表
	$url="https://api.weixin.qq.com/shakearound/device/search?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}

///////////////////////////////ibeacon页面管理///////////////////////////////////////
public function addpage($access_token,$jsonData){//新增页面
    
	    //https://api.weixin.qq.com/shakearound/page/delete?access_token=
	$url="https://api.weixin.qq.com/shakearound/page/add?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*	{
   "title":"主标题",   
   "description":"副标题",	
   "page_url":" https://zb.weixin.qq.com ",	
   "comment":"数据示例",
   "icon_url":"http://3gimg.qq.com/shake_nearby/dy/icon "
    }*/
}
public function delpage($access_token,$jsonData){//新增页面
    
	$url="https://api.weixin.qq.com/shakearound/page/delete?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
}
public function editpage($access_token,$jsonData){//编辑页面信息
    
	
	$url="https://api.weixin.qq.com/shakearound/page/update?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*	{
 "page_id":12306
 "title":"主标题",   
 "description":"副标题",	
 "page_url":" https://zb.weixin.qq.com ",	
 "comment":"数据示例",
 "icon_url":" http://3gimg.qq.com/shake_nearby/dy/icon"
}*/
}
public function pagelist($access_token,$jsonData){//查询页面列表
    
	$url="https://api.weixin.qq.com/shakearound/page/search?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*	{
    "begin": 0,		
    "count": 3
}*/
}
public function pagedel($access_token,$jsonData){//删除页面
    
	
	$url="https://api.weixin.qq.com/shakearound/page/delete?access_token=".$access_token;
	$result=$this->http_post($url,$jsonData);
	return $result;
/*	{
    "page_ids":[12345,23456,34567]
}*/
}
//////////////////////////////ibeacon上传图片素材///////////////////////////////////////////


////////////////////////ibeacon配置设备与页面的关联关系//////////////////////////////////

public function eqship($access_token,$jsonData){//配置设备与页面的关联关系
    
	$url="https://api.weixin.qq.com/shakearound/device/bindpage?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
     "device_identifier":{ 
		"device_id":10011,
               "uuid":"FDA50693-A4E2-4FB1-AFCF-C6EB07647825",
		"major":1002,
		"minor":1223
	},
     "page_ids":[12345, 23456, 334567],	
     "bind" :0,				
     "append":0,				
}*/
}

////////////////////////ibeacon获取摇周边的设备及用户信息//////////////////////////////////

public function userinfo($access_token,$jsonData){//配置设备与页面的关联关系
    
	$url="https://api.weixin.qq.com/shakearound/user/getshakeinfo?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
    "ticket":”6ab3d8465166598a5f4e8c1b44f44645”
    "need_poi":1
}*/
}

////////////////////////ibeacon获取摇周边的设备及用户信息//////////////////////////////////

public function decount($access_token,$jsonData){//以设备为维度的数据统计接口
    
	$url="https://api.weixin.qq.com/shakearound/statistics/device?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
     "device_identifier":{
		"device_id":10011,
		"uuid":"FDA50693-A4E2-4FB1-AFCF-C6EB07647825",
		"major":1002,
		"minor":1223
	},
      "begin_date": 12313123311,		
      "end_date": 123123131231	
}*/
}

public function pagecount($access_token,$jsonData){//以页面为维度的数据统计接口
    
	$url="https://api.weixin.qq.com/shakearound/statistics/page?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
      "page_id": 12345,
      "begin_date": 12313123311,		
      "end_date": 123123131231	
}*/
}

public function api_get_authorizer_option($access_token,$jsonData){//6、获取授权方的选项设置信息
    
	$url="https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_option?component_access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
"component_appid":"appid_value",
"authorizer_appid": " auth_appid_value ",
"option_name": "option_name_value"
}*/
}
public function api_set_authorizer_option($access_token,$jsonData){//7、设置授权方的选项信息
    
	$url="https://api.weixin.qq.com/cgi-bin/component/api_set_authorizer_option?component_access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
"component_appid":"appid_value",
"authorizer_appid": " auth_appid_value ",
"option_name": "option_name_value",
"option_value":"option_value_value"
}*/
}

public function kaquan_list($access_token,$jsonData){//7、批量查询卡列表
          
	$url="https://api.weixin.qq.com/card/batchget?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
  "offset": 0,
  "count": 10, 
  "status_list": ["CARD_STATUS_VERIFY_OK", "CARD_STATUS_DISPATCH"]
}*/
}
public function kaquan_look($access_token,$jsonData){//7、查看某卡信息
    
	$url="https://api.weixin.qq.com/card/get?access_token=".$access_token;
	$result=$result=$this->http_post($url,$jsonData);
	return $result;
/*{
  "card_id":"pFS7Fjg8kV1IdDz01r4SQwMkuCKc"
}*/
}


}
?>
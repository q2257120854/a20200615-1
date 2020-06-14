<?php 
//游戏公共函数，大部分计算都在这里
namespace org;
/*游戏共共类*/
use think\Cache;
use think\Db;
use think\Request;


class Wechat 
{

 protected $noNeedLogin = '';//需要登陆
    protected $noNeedRight = '*';//需要认证
    protected $layout = '';

private $wx=0;
private $siren=array();
    public function __construct($config=array()) {

   
          $this->wxconfig=$config;//关注时回复anywn
         $this->share=$config;
         $this->keyset=$config;//关键词列表anywn    
         $this->config= $config;    
         $this->siren=$config;
         $this->baseurl = "Uploads/".$config["appid"];
          if(!is_dir($this->baseurl)) {mkdir($this->baseurl,'0777');}
          $this->request=Request::instance();

    }

public function testaa(){
    print_r('testa');exit;
}
public function openmsg($wx)
    {
    $this->responseMsg(1);
    exit;
    }
public function responseMsg($wx='')
    {
                //get post data, May be due to the different environments
        $postStr = file_get_contents("php://input");    
        
        //txt_output('del/respon'.time().rand(1,100),"x".$postStr);
        //echo $postStr;exit;
        if(!empty($postStr))
        {       

            $this->wx=$this->request->param('wx');
            
            include_once "wxcode/wxBizMsgCrypt.php";
            //print_r($this->request);exit;
            $pc = new \WXBizMsgCrypt($this->wxconfig['token'], $this->wxconfig['encodingAesKey'], $this->wxconfig['appid']);
            
            
            $xml_tree = new \DOMDocument();
            $xml_tree->loadXML($postStr);
            $array_e = $xml_tree->getElementsByTagName('Encrypt');
            $encrypt = $array_e->item(0)->nodeValue;
            $array_s = $xml_tree->getElementsByTagName('ToUserName');
            $msg_sign = $array_s->item(0)->nodeValue;
            
            $msg = '';
            $msg_sign   = empty($this->request->param('msg_signature')) ? "": trim($this->request->param('msg_signature')) ;
            $timeStamp  = empty($this->request->param('timestamp'))? "": trim($this->request->param('timestamp')) ;
            $nonce      = empty($this->request->param('nonce'))? "": trim($this->request->param('nonce')) ;
            
            $format = "<xml><ToUserName><![CDATA[%s]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
            $from_xml = sprintf($format,$msg_sign, $encrypt);
            $errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
                //echo "ffff".$msg;exit;
////////////////////////////////////处理请求信息//////////////////////////////////////////
                $postStr=$msg;
                /*///////////////////////////////////////////////解密结束/////////////////////////*/    
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;//客户端
                $toUsername = $postObj->ToUserName;//服务端公众号id
                
            
                $mtype=$postObj->MsgType;
                $time = time();
///////////////////////事件走向//////////////////////////
                if($mtype=="event"){
                    $event=$postObj->Event;
                    if($event=="LOCATION"){//自动上报地理位置
                        $position["time"]=$postObj->CreateTime;//经度
                        $position["y"]=$postObj->Latitude;//经度
                        $position["x"]=$postObj->Longitude;//纬度
                        $position["Precision"]=$postObj->Precision;//地理位置精度
                        return array("type"=>$mtype,"event"=>$event,"loc"=>$position,"user"=>$fromUsername,"me"=>$toUsername); 
                        //exit;
                    }elseif($event=="subscribe"){//subscribe未关注
                        $keyword=$postObj->EventKey;
                        $keyword=str_replace("qrscene_","",$keyword);
                        return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
                    }elseif($event=="unsubscribe"){//取消关注未关注
                        return array("type"=>$mtype,"event"=>$event,"user"=>$fromUsername,"me"=>$toUsername); 
                    }elseif($event=="SCAN"){//已关注的扫描+subscribe未关注
                        //公用方法中不适合写逻辑to唐
                        // $this->sendkefu($fromUsername);
                   
                        $key=$postObj->EventKey;
                        return array("type"=>$mtype,"event"=>$event,"key"=>$key,"user"=>$fromUsername,"me"=>$toUsername); 
                    }elseif($event=="CLICK"){//已关注的扫描+subscribe未关注
                        $keyword=$postObj->EventKey;
                        return array("type"=>$mtype,"event"=>$event,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
                    }elseif($event=="VIEW"){//菜单点击
                        return array("type"=>$mtype,"event"=>$event,"EventKey"=>$postObj->EventKey,"MenuId"=>$postObj->MenuId,"user"=>$fromUsername,"me"=>$toUsername); 
                    }
                 }elseif($mtype=="text"){
                     $keyword = $this->deletehtml(trim($postObj->Content));//接收到的关键词                     
                    if(!empty($keyword)){
                       return array("type"=>$mtype,"key"=>$keyword,"user"=>$fromUsername,"me"=>$toUsername); 
                    }else{
                       $this->sendimg($fromUsername, $toUsername,$wxconfig);//标题，简介，图片，链接
                       exit;
                    
                    }
                    
                 }
//////////////////////事件结束/////////////////////////
 
                
            

        }else{
                echo "success";
                
                exit;
        }

    }

//redis token+location
 public function token($appid='',$appsecret='') {
    $appid=$appid?$appid:$this->wxconfig['appid'];
    $appsecret=$appsecret?$appsecret:$this->wxconfig['appsecret'];
    //本地是否过期
    $jsonurl=getcwd()."/Uploads/access_token.json";
    if(!file_exists($jsonurl)){
        $data['expire_time']=0;
        $xdata[0]=0;
    }else{
       $data = json_decode(file_get_contents($jsonurl),true);
    }
    
    if($data['expire_time']<time()) {
         $redisObj = new \Redis();
         $redisObj->connect('123.207.252.73',6379);
         $auth = $redisObj->auth('gznet100'); //设置密码
         $xdata=$redisObj->hVals('zaoqi_wxdata');
         if(!$xdata){
           $xdata[0]=0;
         }
        if($xdata[0]< time()) {
              $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
              $res = json_decode($this->http_get($url),true);
              $access_token = $res['access_token'];
              if($access_token) {
                $data['expire_time']= time() + 7000;
                $data['access_token']= $access_token;
                $redisObj->hMset('zaoqi_wxdata',$data);
                //最新
                $fp = fopen($jsonurl, "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
              }else{
                return 'error';
              }
        } else {
            //redis 还没有过期的就保存redis的数据
            $data['expire_time']= $xdata[0];
            $data['access_token']= $xdata[1];
            $fp = fopen($jsonurl, "w");
            fwrite($fp, json_encode($data));
            fclose($fp);
          $access_token = $xdata[0];
        }
    }else{
        $access_token = $data['access_token'];
    }
    
    return $access_token;
  }

//普通token-文件缓存形式
  public function xtoken($appid,$appsecret) {
     
  $jsonurl=getcwd()."/Uploads/access_token.json";
    $data = json_decode(file_get_contents($jsonurl));

    if($data->expire_time< time()) {
      unlink($jsonurl);
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->wxconfig['appid']."&secret=".$this->wxconfig['appsecret'];
      $res = json_decode($this->http_get($url));
      $access_token = $res->access_token;
      if($access_token) {
        $data->expire_time= time() + 7000;
        $data->access_token= $access_token;
        $fp = fopen($jsonurl, "w");
        $redisObj->hMset('zaoqi_wxdata',$data);
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }
  //网页授权
  public function getuser($code) {
     
    //echo $data->access_token;exit;
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->wxconfig['appid']."&secret=".$this->wxconfig['appsecret']."&code=".$code."&grant_type=authorization_code";
    $res = json_decode($this->http_get($url),true);  
    return $res;
  }
 

   // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
   public function getJsApiTicket() {
    $file=getcwd()."/Uploads/jsapi_ticket.json";
    if(!file_exists($file)){
        $data['expire_time']=0;
        $xdata[0]=0;
    }else{
     $data = json_decode(file_get_contents($file),true);
     
    }
    //print_r($data);exit;
    if($data['expire_time'] < time()) {
        $redisObj = new \Redis();
         $redisObj->connect('123.207.252.73',6379);
         $auth = $redisObj->auth('gznet100'); //设置密码
         $xdata=$redisObj->hVals('zao_jsdata');
         if(!$xdata){
         $xdata[0]=0;
         }
         
       if($xdata[0]< time()) {
           $accessToken =$this->token();
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$this->token();
          $res = json_decode($this->http_get($url),true);
          $ticket = $res['ticket'];
          if($ticket) {
            $data['expire_time'] = time() + 7000;
            $data['jsapi_ticket'] = $ticket;
            $redisObj->hMset('zao_jsdata',$data);
            $fp = fopen($file, "w");
            fwrite($fp, json_encode($data));
            fclose($fp);
          }else{
            return 'error';
          }
       }else{
            $data['expire_time']= $xdata[0];
            $data['jsapi_ticket']= $xdata[1];
            $fp = fopen($jsonurl, "w");
            fwrite($fp, json_encode($data));
            fclose($fp);
            $ticket = $xdata[1];

       }
      
    } else {
      $ticket = $data['jsapi_ticket'];
    }
    return $ticket;
  }

public function adduser($guest,$fid=0){
$user=Db::name("user")->where("openid='".$guest."'")->count();
            if(!$user){
                $password=get_password(6);
                $map["openid"]="".$guest."";
                $map["groupid"]=3;
                $map["fatherid"]=$fid>0?$fid:0;
                $map["username"]='';
                $map["status"]=1;
                $map['login_count']=1;
                $map['createtime']=time();
                $map['updatetime']=time();
                $map['login_count']=0;
                $map['point']= $this->share['sendpoint']>0?$this->share['sendpoint']:0;
                $model=Db::name("user");
                    
                        Db::name("user")->insert($map);
                        $id =Db::name('user')->getLastInsID();
                    if ($id<=0) {
                        ;
                    }else{
                        Db::name("user")->where("id=".$id)->setField("username","wx".$id);
                        Db::name("user")->where("id=".$id)->setField("realname",transform($id));
                    }
                    //获取二维码，并存为本地图片
                    if($this->share['sendpoint']>0){

                    }
                     
                    return $id;
            //$wechatObj->sendtext($guest,$me,$wxconfig["description"]);
            }else{
               return  Db::name("user")->where("openid='".$guest."'")->value('id');
            }
}

//初始化用户数据
 private function init_newuser($uid)//微信登录
    {
    $where['uid']=$uid;
    if(!Db::name('user_config')->where($where)->count()){
     $config['uid']=$uid;
     Db::name('user_config')->insert($config);
    }
}

  //刷新webtoken-
    public function rewebtoken($refresh_token) {
    $file="gznet/Cache/rweb_token.json";
    $data = json_decode(file_get_contents($file));
    if($data->expire_time< time()) {
      $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->wxconfig['appid']."&grant_type=refresh_token&refresh_token=".$refresh_token;
      $res = json_decode($this->http_get($url));
      $access_token = $res->access_token;
      if($access_token) {
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
//无返回请求
public function http_act($url, $jsonData){//带json发送
    
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonData); 
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS,200);//CURLOPT_TIMEOUT_MS 
        $response = curl_exec($ch);  
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);  
        return $response;
        }
public function http_get($url){//带json发送，无json数据
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        if (FALSE === $result){
          print_r(curl_error($ch));
          print_r(curl_errno($ch));
          exit;
            } 
        curl_close($ch);  
        return $result;
        }   
public function httpGetRequest($url){
                $out = file_get_contents($url);
                return $out;
        }   
/////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////
function GrabImage($url,$filename="") { 

if(file_exists($filename)){
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
        $echoStr =$this->request->param("echostr");
        if($this->checkSignature($token)){
                echo $echoStr;
                exit;
        }
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
        $signature =$this->request->param("signature");
        $timestamp =$this->request->param("timestamp");
        $nonce =$this->request->param("nonce");
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
    $token = $this->wxconfig['token'];
    $encodingAesKey=$this->wxconfig['encodingAesKey'];
    $appId = $this->wxconfig['appid'];
}else{//私人加密
    $token = $this->siren['token'];
    $encodingAesKey=$this->siren['encodingAesKey'];
    $appId = $this->siren['appid'];
}
$nonce = "xxxxxx";
$pc = new \WXBizMsgCrypt($token, $encodingAesKey, $appId);
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
    $path=empty($path)?$this->request->param('path'):$path;
    $path=str_replace("\\\\","\\",$path);
    $map['media']=$path;//图片地址
    $map['type']='image';
    $ar=$this->upload_media($map);
    if($ar['media_id']){
        $count=Db::name("media")->where("media_id='".$ar['media_id']."'")->count();
        if(!$count){
            $ar['status']=1;
            $ar['url']=$path;
            $ar['uid']=$uid;
            Db::name("media")->insert($ar);
        }
        return $ar['media_id'];
    }else{
        return 0;
    }
}
/***********新增临时素材***********/
public function upload_media($map){
$token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$token."&type=".$map['type'];
$str=substr($map['media'],0,4);
if($str=='http'){
$cDir="Uploads/web/";
if(! is_dir ( $cDir )) {
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
////////////////////////////////////////////////////////////////////////////////////////


public function menu($data){
$token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
$data=str_replace("&amp;","&",$data);
$result=$this->http_post($url,$data);
return $result;
}


public function delmenu(){//删除菜单
$token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$token;//删除菜单
$result=$this->http_get($url);
return $result;
}
public function lookmenu(){//查看菜单
$token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
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
$config=$this->config;
$url=$url<>""?$url:$config["site_url"];
foreach($data as $key=>$v)
{
    if($v["thumb"]!=""){
        if(!(strpos($v["thumb"], 'http') === FALSE)) {
          $thumb=$v["thumb"];
        } else {
          $thumb=$config["site_url"].$v["thumb"];
        }
    }else{
        $thumb=$config["logo"];
    }
     
        if((strpos($v["url"], 'tel') === FALSE)) {
           if(!(strpos($v["url"], 'http') === FALSE)) {
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

        }else{
            $urlx=$v["url"];
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
        {if(empty($con)){echo "empty";}
                               $textTpl = "<xml>
                                    <ToUserName><![CDATA[%s]]></ToUserName>
                                    <FromUserName><![CDATA[%s]]></FromUserName>
                                    <CreateTime>%s</CreateTime>
                                    <MsgType><![CDATA[%s]]></MsgType>
                                    <Content><![CDATA[%s]]></Content>
                                    <FuncFlag>0</FuncFlag>
                                    </xml>";
                                $msgType = "text";
                                $time = $from.time();
                                $resultStr = sprintf($textTpl, $from, $to, $time, $msgType,$con);
                                echo $this->jiami($time,$resultStr);
                        exit;
        }   
public function sendimg($from, $to,$data)//标题，简介，图片，链接
        {
        if(empty($data)){echo "empty";}
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
        $time = $from.time();
   $config=$this->config;
   if($data["thumb"]<>""){
        if(!(strpos($data["thumb"], 'http') === FALSE)) {
        $thumb=$data["thumb"];
        } else {
        $thumb=$config["site_url"].$data["thumb"];
        }
    }else{
        $thumb=$config["logo"];
    }
    if(!(strpos($data["url"], 'http') === FALSE)) {
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


    /************发克服消息**************/
public function sendkefu($data){//模板消息$data=json格式数据.who=用户
   $data='{
    "touser":"'.$data.'",
    "msgtype":"text",
    "text":
    {
         "content":"客服不在线"
    }
     }';
    $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
    $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
    $result=$this->http_post($url,$data);
    return $result;
}
/************发送模板消息**************/
public function tplmsg($data){//模板消息$data=json格式数据.who=用户
    $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
    $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;
    $result=$this->http_post($url,$data);
    $result=json_decode($result,true);
    $result['msg']=$this->tpl_code($result['errcode']);
    return $result;
}
//模板信息返回
private function tpl_code($code=1){
    $map['1']='empty';
    $map['-1']='系统繁忙';
    $map['0']='请求成功';
    $map['40001']='验证失败';
    $map['40002']='不合法的凭证类型';
    $map['40003']='不合法的OpenID';
    $map['40004']='不合法的媒体文件类型';
    $map['40005']='不合法的文件类型';
    $map['40006']='不合法的文件大小';
    $map['40007']='不合法的媒体文件id';
    $map['40008']='不合法的消息类型';
    $map['40009']='不合法的图片文件大小';
    $map['40010']='不合法的语音文件大小';
    $map['40011']='不合法的视频文件大小';
    $map['40012']='不合法的缩略图文件大小';
    $map['40013']='不合法的APPID';
    $map['41001']='缺少access_token参数';
    $map['41002']='缺少appid参数';
    $map['41003']='缺少refresh_token参数';
    $map['41004']='缺少secret参数';
    $map['41005']='缺少多媒体文件数据';
    $map['41006']='access_token超时';
    $map['42001']='需要GET请求';
    $map['43002']='需要POST请求';
    $map['43003']='需要HTTPS请求';
    $map['44001']='多媒体文件为空';
    $map['44002']='POST的数据包为空';
    $map['44003']='图文消息内容为空';
    $map['45001']='多媒体文件大小超过限制';
    $map['45002']='消息内容超过限制';
    $map['45003']='标题字段超过限制';
    $map['45004']='描述字段超过限制';
    $map['45005']='链接字段超过限制';
    $map['45006']='图片链接字段超过限制';
    $map['45007']='语音播放时间超过限制';
    $map['45008']='图文消息超过限制';
    $map['45009']='接口调用超过限制';
    $map['46001']='不存在媒体数据';
    $map['47001']='解析JSON/XML内容错误';
    return $map[$code];
}
/***********获取素材库***********/

    //////////////////////////////////////////////////////////
public function getmedia($map){
$token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
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
//获得素材
public function get_material($media_id){
    $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
    $url="https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$token;
    $json='{"media_id":'.$media_id.'}';
    $result=$this->http_post($url,$json);
    return $result;
}   
public function get_userinfo($openid){//获取用户资料
    $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
    $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openid."&lang=zh_CN";
    $result=$this->http_get($url);
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
    $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->wxconfig["appid"]."&secret=".$this->wxconfig["appsecret"]."&code=".$code."&grant_type=authorization_code";
    $result=$this->http_get($url);
    return $result;
}
public function get_snsapi_userinfo($token,$openid){//通过code换取网页授权access_token
    $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$token."&openid=".$openid."&lang=zh_CN";
    return  json_decode($this->http_get($url),true);  
}
/////////////////////////////ibeacon设备管理//////////////////////////////////
public function shenqing($access_token,$jsonData){//申请开通摇一摇功能
    
    $url="https://api.weixin.qq.com/shakearound/account/auditstatus?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
}
//$uid:场景ID
//$ever:默认0，默认临时二维码
public function ewm($uid,$ever){//通过access_token获取临时二维码
        $uid=$uid>0?$uid:1;
        $ever=$ever>0?$ever:0;
        if($ever>0){
            $cDir = $this->baseurl."/ewm/";         
            $filename=$cDir."/".$uid.".png";
            if(file_exists($filename)){
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
        $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
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

public function get_ewm($uid,$ever,$type=0){//通过access_token获取临时二维码
        $token=$this->token($this->wxconfig["appid"],$this->wxconfig["appsecret"]);
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$token;//获取ticket
        //是否字符
        if($type) {
            if($ever) {
                $name="QR_LIMIT_STR_SCENE";
            } else {
                $name="QR_STR_SCENE";
            }
            $scene="scene_str";
            $uid="\"str_".$uid."\"";
        } else {
            
            if($ever) {
                $name="QR_LIMIT_SCENE";
            } else {
                $name="QR_SCENE";
            }
            $scene="scene_id";
        }

        if($ever){
           $json="{\"action_name\": \"".$name."\", \"action_info\": {\"scene\": {\"".$scene."\": ".$uid."}}}";
        }else{
           $json="{\"expire_seconds\": 1800, \"action_name\": \"".$name."\", \"action_info\": {\"scene\": {\"".$scene."\": ".$uid."}}}";
        }
        $result=$this->http_post($url,$json);//返回结果
        //echo $result;exit;
        $w1=json_decode($result,true);
        if(empty($w1['ticket'])) {
            print_r($w1);
            echo $json;
            exit;
        }
        
        $ticke="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$w1['ticket'];//换取二维码
         
        return $ticke;

}
//获得定位信息
    public function getlatlng($lat='',$lng=''){
        $url="http://apis.map.qq.com/ws/geocoder/v1/?location=".$lat.",".$lng."&key=UDHBZ-6NPWD-IXI4Q-HRBV7-76BLE-H3FSY&sn=ycTRgUKDz54Yl1o71rWhtDz2LiaQQvue";//
        $output=$this->http_get($url);
        $result=json_decode($output,true);
        if($result['message']=="query ok"){
            $state="success";
            $address=$result['result']['address'].$result['result']['formatted_addresses']['recommend'];
        }else{
            $state="error";
            $address="网络原因定位失败,请输入你的详细地址";
            $data['json']=$output;
        }
        $data['state']=$state;
        $data['address']=$address;
        return $data;
        //echo json_encode($data);exit;  
    }

public function applyid($access_token,$jsonData){//申请applyid
    
    $url="https://api.weixin.qq.com/shakearound/device/applyid?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
}

public function ibeacon_edit($access_token,$jsonData){//编辑设备信息
    
    $url="https://api.weixin.qq.com/shakearound/device/update?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
}
public function relaship($access_token,$jsonData){//配置设备与门店的关联关系
    
    $url="https://api.weixin.qq.com/shakearound/device/bindlocation?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
}
public function ibealist($access_token,$jsonData){//查看列表
    $url="https://api.weixin.qq.com/shakearound/device/search?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
}


////////////////////////ibeacon获取摇周边的设备及用户信息//////////////////////////////////

public function userinfo($access_token,$jsonData){//配置设备与页面的关联关系
    
    $url="https://api.weixin.qq.com/shakearound/user/getshakeinfo?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
/*{
    "ticket":”6ab3d8465166598a5f4e8c1b44f44645”
    "need_poi":1
}*/
}


public function kaquan_list($access_token,$jsonData){//7、批量查询卡列表
          
    $url="https://api.weixin.qq.com/card/batchget?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
/*{
  "offset": 0,
  "count": 10, 
  "status_list": ["CARD_STATUS_VERIFY_OK", "CARD_STATUS_DISPATCH"]
}*/
}
public function kaquan_look($access_token,$jsonData){//7、查看某卡信息
    
    $url="https://api.weixin.qq.com/card/get?access_token=".$access_token;
    $result=$this->http_post($url,$jsonData);
    return $result;
/*{
  "card_id":"pFS7Fjg8kV1IdDz01r4SQwMkuCKc"
}*/
}


}
?>
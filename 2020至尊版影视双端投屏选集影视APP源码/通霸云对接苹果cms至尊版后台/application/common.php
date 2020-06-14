<?php
use phpmailer\phpmailer;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------



/**
* 发送邮箱
* @param type $data 邮箱队列数据 包含邮箱地址 内容
*/
function sendEmail($data = []) {
   
  $count  =  db('advert')->where('id',20)->find();
  $count1  =  db('shezi')->where('id',1)->find();
  Vendor('phpmailer.phpmailer');
  $mail = new PHPMailer(); //实例化
  $mail->IsSMTP(); // 启用SMTP
  $mail->Host = $count1['dizhi']; //SMTP服务器 以126邮箱为例子 
  $mail->Port = $count1['dk'];  //邮件发送端口
  $mail->SMTPAuth = true;  //启用SMTP认证
  $mail->SMTPSecure = "ssl";   // 设置安全验证方式为ssl
  $mail->CharSet = "UTF-8"; //字符集
  $mail->Encoding = "base64"; //编码方式
  $mail->Username = $count1['faxin'];  //你的邮箱 
  $mail->Password = $count1['yxmm'];  //你的密码 
  $mail->Subject = $count['content'].'验证码'; //邮件标题  
  $mail->From = $count1['faxin'];  //发件人地址（也就是你的邮箱）
  $mail->FromName = $count['content'];  //发件人姓名
  if($data && is_array($data)){
    foreach ($data as $k=>$v){
      $mail->AddAddress($v['user_email'], "亲"); //添加收件人（地址，昵称）
      $mail->IsHTML(true); //支持html格式内容
      $mail->Body = $v['content']; //邮件主体内容
      //发送成功就删除
      if ($mail->Send()) {
        echo "发送成功";
      }else{
          echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息  
      }
    }
  }           
}






function getIP() {
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    }
    elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');

    }
    elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getusercount($id)
{
    $count  =   db('user')->where(['parentid'=>$id,'power'=>'1'])->count();
    return $count;
}
function getvipcount($id)
{
    $count  =   db('user')->where(['parentid'=>$id,'power'=>'2'])->count();
    return $count;
}
function getRandomString($len, $chars=null,$type=false)
{
 
    if($type==true)
    {
		$authnum	=	rand('100000','999999');
        $count  =   db('user')->where('share_ma',$authnum)->count();
        if($count>0 || in_array($authnum,['111111','222222','333333','444444','555555','666666','777777','888888','999999','000000','123456','654321']))
        {
            $authnum    =   getRandomString($len,$chars,$type);
        }
    }else{
		srand((double)microtime()*1000000);//create a random number feed.
		$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
		$list=explode(",",$ychar);
		$authnum='';
		for($i=0;$i<6;$i++){
			$randnum=rand(0,35); // 10+26;
			$authnum.=$list[$randnum];
		}
	}


    return $authnum;

}

function randstring($len)
{
    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';  
	$randStr = str_shuffle($str);
	$rands= md5(time().$randStr);
    return substr($rands,0,$len);

}
// 应用公共文件
function name()
{
    $id     =   session('usershshefsdf');
    $name   =   db('user')->where('id',$id)->value('username');
    return $name?$name:'无数据';
}
function _name($id)
{
    $name   =   db('user')->where('id',$id)->value('username');
    return $name?$name:'无数据';
}
function sname($id,$name)
{
    $name   =   db('user')->where('id',$id)->value($name);
    return $name?$name:'无数据';
}


function power()
{
    $id     =   session('usershshefsdf');
    $name   =   db('user')->where('id',$id)->value('power');
    if($name=='1')
    {
        return '代理';
    }else{
        return '管理员';
    }
}
function advert($id=null)
{
    if($id!=null)
    {
        $name   =   db('advert')->where('id',$id)->value('content');

    }else{
        $name   =   db('advert')->where('id',1)->value('content');

    }
    return $name;
}

function gui($id)
{
    $name   =   db('user')->where('id',$id)->value('username');
    return $name;
}

function id()
{
    $id     =   session('usershshefsdf');
    
    return $id ;
    
}


function yue()
{
    $id     =   session('usershshefsdf');
    $power  =   session('power');
    if($power=='1')
    {
        $where['id']	=	$id;
    }else{
        $where			=	'';
        return 	'';
    }
    $name   =   db('user')->where($where)->value('money');
    return '剩余提卡点数:'.$name;
}

function share()
{
    $id     =   session('usershshefsdf');
    $power  =   session('power');
    if($power=='1')
    {
        $where['id']	=	$id;
    }else{
        $where			=	'';
        return 	'';
    }
    $name   =   db('user')->where($where)->value('share_ma');
    return '分享码:'.$name;
}

error_reporting(0);
function getTopDomainhuo(){
	$url   = $_SERVER['HTTP_HOST'];
    $data = explode('.', $url);
    $co_ta = count($data);
    //判断是否是双后缀
    $zi_tow = true;
    $host_cn = 'com.cn,net.cn,org.cn,gov.cn';
    $host_cn = explode(',', $host_cn);
    foreach($host_cn as $host){
        if(strpos($url,$host)){
            $zi_tow = false;
        }
    }
    //如果是返回FALSE ，如果不是返回true
    if($zi_tow == true){
        $host = $data[$co_ta-2].'.'.$data[$co_ta-1];
    }else{
        $host = $data[$co_ta-3].'.'.$data[$co_ta-2].'.'.$data[$co_ta-1];
    }
  return $host;
}
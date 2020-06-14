<?php 
//游戏公共函数，大部分计算都在这里
namespace app\common\library;
/*游戏共共类*/
use think\Cache;
use think\Db;
use app\common\model\User;
class Game
{
public $wx=0;
public $siren=array();
    public function  __construct($site,$user) {
    	$this->site=$site;
    	$this->user=$user;
        $this->userid=$user['id'];
    	$this->ewmurl = "Uploads/".$this->site["appid"]."/ewm/";
    	$this->todaystr=strtotime(date('Ymd'));
        $this->init_load();
	    
    }

 public function cache_get($name=''){
  return Cache::get('biquanyzr_'.$name);
}
public function cache_set($name='',$value='',$time=0){
  if ($time>0) {
    return Cache::set('biquanyzr_'.$name,$value,$time);
  }else{
    return Cache::set('biquanyzr_'.$name,$value);
  }
}
//数字转字符
public function transform($number=0, $weishu='62', $chandu='4'){
 $transformArr=array("a", "0", "b", "c", "d", "e", "1", "f", "g", "2", "h", "i", "3", "j", "k", "l", "4", "m", "n", "o", "5", "p", "q", "r", "6", "s", "t", "u", "v", "7", "w", "x", "y", "z", "A", "8", "B", "C", "D", "E", "F", "G", "H", "9", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
             $n = "";
			if (0 == $number) return "a";
			for($i = 0; 0!= $number;$i++){
			    $o =  floor($number%$weishu) ;
				$number = floor($number/$weishu);
				$n = $transformArr[$o].$n; 
			}
			if (strlen($n) >= $chandu) return $n;
			for ($a = "", $r = strlen($n); $chandu > $r; $r++) {$a .= "a";}
			return $a.$n;
}
 
 
//记录游戏结果
public function game_recode($data,$koufei=0){
		//记录该用户情况
		$cmap['uid']=$this->userid;
		$cmap['createtime']=$this->todaystr;
		Db::name('user_count')->where($cmap)->setInc('allout',$data['win_jin']);
		//总记录
		Db::name('run_count')->where('createtime='.$this->todaystr)->setInc('allout',$data['win_jin']);
		//----------------------------------游戏记录
		$gdata['money']=$data['win_jin'];
		$gdata['num']=$data['ya_jin'];
		$gdata['pid']=$data['game_type'];
		$gdata['pei']=$data['pei']?$data['pei']:0;//余额
		$gdata['pay_type']=$data['win_type']?$data['win_type']:0;
		$gdata['createtime']=time();
		$gdata['uid']=$this->userid;
		$gdata['status']=1;
		$gdata['numx']=$data['order'];
		$gdata['result']=$data['status'];//1赢 0输  游戏记录
		$gdata['xiazhu']=$data['ya_type'];
		$rr=Db::name('gamehistory')->insert($gdata);
		if ($rr) {
			$map['status']=$rr;
		} else {
			$map['status']=0;
			$map['msg']=Db::name('gamehistory')->getlastsql();
		}
		return $map;
}
   
   
//生成海报程序
public function agentposter($left=230,$top=605,$typeid=1,$bg='',$test='testid',$txtdat=null,$force=1){
	$this->site['ewmcount']=1;
    $gotourl=$this->site['gotosite']."/index.php/Index/User/wxlog/fid/".$this->userid."/type/".$typeid."/tid/".$this->site['ewmcount'].".html";
	$this->wechatObj = new Wechat();
	$picx = "Uploads/".$this->site["appid"]."/picx/";
	$dispic=$picx.$this->userid.".jpg";
	$soure=$this->ewmurl.$this->userid.'.png';

	if(!file_exists($soure)){//
		$json=array();
		//短连接
		$geturl = 'http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=' . $gotourl;
		$json = json_decode($this->wechatObj->http_get($geturl),true);
		if ($json) {
			if ($json[0]['url_short'] != '') {
				$shareurl = $json[0]['url_short'];
			}
		}else{
		   $shareurl=$this->wechatObj->shoturl($gotourl);
			if(!$shareurl){
			$shareurl=$gotourl;
			}
		}
		//经过微信跳转,有可能减慢速度
		//$shareurl="http://mp.weixinbridge.com/mp/wapredirect?url=".urlencode ($shareurl);
		
	}else{
       $shareurl='';
	}
	
	//生成二维码图片-begin
	    $url=$this->ewmsave($shareurl,$soure);
	 
	 //合成图片
	 if(!file_exists($dispic)||$force){
			
			$Image = new  Image();
			$bg=$bg?$bg:"game/static/bg.jpg";
			copy($bg,$dispic);
			$config['watermark_minwidth']=100;//水印添加条件
			$config['watermark_minheight']=100;//水印添加条件
			$config['watermark_img']=$url;//水印透明度
			$config['watermark_pct']=90;//水印透明度
			$config['watermark_quality']=100;//JPEG 水印质量	
            $config['pd_left']=$left;//JPEG 左距离  108
			$config['pd_top']=$top;//JPEG 上距离  470
			$config['watermark_pospadding']=1;//水印边距
			$config['watermark_pos']=11;//居中

			$config['watemard_text']=11;//居中
			$config['watemard_text_size']=11;//居中
			$config['watemard_text_color']='#FFFFFF';//居中
            $config['watemard_text_face']='hbsj.ttf';//居中

			$Image->watermark($dispic,'',$config);/**/
			//水印id
			$set=$txtdat;
			$set['soure']=$dispic;
			$set['dis']=$dispic;
			$set['text']=$test;
			
			$this->addtext($set);
		    
	 }
return $dispic;	 

}
private function xxxxxxxxxxxxxxxxxxxxpay_beginxxxxxxxxxxxxxxxxxx(){;}
//查看用户，游戏次数，积分情况，是否超出界限
public function test_play($koufei=0,$user,$usercount){
	$status=1;
	$success=0;
	$fail=21;
	$fail_field="error";
  //查询余额情况
	  $point=$user['point'];
	  if($usercount['onlinetixiantime']>=100){//今日游戏超限
			$map['code']=$fail;
			$map["money"]=$point;
			$map[$fail_field]='提现超过限制,明日再战!';
			$status=0;
	   }
	//查询余额情况
	   if($point<$koufei){//您的余额不足
			$map['code']=$fail;
			$map["money"]=$point;
			$map[$fail_field]='您的余额不足，最少需要'.$koufei.'元';
			$status=0;
	   }
	   //记录游戏次数
		$cmap['createtime']=$this->todaystr;
		$cmap['uid']=$this->userid;
		$cpaytime=Db::name('user_count')->where($cmap)->value('paytime');
		 
	$map['status']=$status;
return $map;
}
//测试用户是否满足扣掉x积分 field:默认扣掉point 
//确保百分百扣掉用户积分
public function dec_point($uid=0,$koufei=1,$field='point'){
  	return false;
	$koufei=abs($koufei);
	// 启动事务
	Db::startTrans();
	try{
	   $left_point= Db::name('user')->where('id='.$uid)->value($field);
	   if ($left_point>=$koufei) {
	        $rr=Db::name('user')->where('id='.$uid)->setDec($field,$koufei);
            //记录流进数据
			$ccmap['createtime']=$this->todaystr;
			Db::name('run_count')->where($ccmap)->setInc('allin',$koufei*100);
			$ccmap['uid']=$uid;
			Db::name('user_count')->where($ccmap)->setInc('allin',$koufei*100);
			Db::name('user_count')->where($ccmap)->setInc('paytime');
		    if ($rr) {
		    	// 提交事务
		        Db::commit(); 
		        $status=1;
		        $msg='success';
		    }else{
		        Db::rollback();
		        $status=0;
		        $msg='dec point fail';
		    }
	   }else{
	   	 $status=0;
	   	 $msg='not enough point';
	   }
	} catch (\Exception $e) {
	    // 回滚事务
	    Db::rollback();
	    $status=0;
	    $msg='error'. $e;
	}
	 
		$map['status']=$status;
		$map['msg']=$msg;
		return $map;
}
//把用户可体现金币转为积分
public function from_to_point($uid=0,$koufei=0,$from_field='amount',$to_field='point'){
  	return false;
	$uid=$uid==0?$this->userid:$uid;
	//查用户积分
	//扣费大于现有金币
	if($koufei){
	  $amount=Db::name('user')->where('id='.$uid)->value($from_field);
	  //转移金币
	  if($koufei>=$amount){
	  	$koufei=$amount;
	  }
	  	Db::startTrans();
		try{
           $rr= Db::name('user')->where('id='.$uid)->setDec($from_field,$koufei);
           $xx=Db::name('user')->where('id='.$uid)->setInc($to_field,$koufei);
		    if ($rr&&$xx) {
		    	Db::commit(); 
		    }else{
                Db::rollback();
		    }
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		}
	  
	}
	$point=Db::name('user')->where('id='.$uid)->value($to_field);
	return $point;
}
//用随机或者企业付款生成一个订单
public function get_payment_no($force=1){
	$lastno='';
	if($force){
		$qiyue=controller('Qiyue','controller');;
		$data=$qiyue->jxpay(0.3,$this->user['wxb'],0);
		$payment_no=$data['payment_no']?$data['payment_no']:'';
		$lastno=substr($payment_no,strlen($payment_no)-1,1);
		if(!$payment_no){
			   $map['status']=0;
			   $map['code']=21;
			   $map["money"]=$point;
			   $map['msg']='微信打款失败,若扣了积分后台会审核后恢复！！';
		}else{
			$map['status']=1;
			$map['payment_no']=$payment_no;

		}

	}else{
		$lastno=mt_rand(0,9);;
		$payment_no="10000018301".mt_rand(100000,900000).mt_rand(100000,900000).mt_rand(1000,9000).$lastno; //可控玩法
		$map['status']=1;
		$map['payment_no']=$payment_no;
	}
	return $map;
}
private function xxxxxxxxxxxxxxxxxxxxpay_endxxxxxxxxxxxxxxxxxx(){;}
//添加用户名
public function addtext($set){
         $Image = new  Image();
         $config['color']="#ffffff";
		 $config['soure']=$set['soure'];
		 $config['dis']=$set['dis'];
		 $config['text']=$set['text'];
		 $config['left']=isset($set['left'])?$set['left']:10;//30
		 $config['top']=isset($set['top'])?$set['top']:10;//45
		 $config['font'] = "hbsj.ttf";   
		 $config['angle']=0;//居中

		 $config['fontsize'] = isset($set['fontsize'])?$set['fontsize']:30;  
		 $Image->watertext($config);		
 }
 //生成二维码
//使用方法$this->ewmsave($shareurl,$soure); 返回二维码生成路径
 public function ewmsave($shareurl='',$soure=''){
	 if (!file_exists($soure)){
	 	 $phpqrcode = new QRcode();

		 if ($shareurl=='') {
		 	$shareurl=$this->request->param('url');
		 } 
		 if ($soure=='') {
		 	$soure=$this->request->param('soure');
		 } 
		 if ($shareurl=='') {
		 	echo 'empty url';
		 	exit;
		 }
		 if ($soure=='') {
		 	echo 'empty soure';
		 	exit;
		 }
		 $errorCorrectionLevel = 'L';//容错级别 
		 $matrixPointSize = 10;//生成图片大小 
		 $phpqrcode->png($shareurl,$soure,$errorCorrectionLevel, $matrixPointSize, 2);
	 }
	 return $soure;
}
//初始化用户也没
public function init_load(){
        //基础目录
		$url = "Uploads/";
		if (!is_dir($url)) {mkdir($url,0777);}
		//基础目录
		$url = "Uploads/".$this->site["appid"];
		if (!is_dir($url)) {mkdir($url,0777);}
		//头像目录
		$avat = $url."/avatar/";
		if (!is_dir($avat)) {mkdir($avat,0777);}
		//二维码静态目录
		$ewmx = $url."/ewm/";
		if (!is_dir($ewmx)) {mkdir($ewmx,0777);}
		//头像缩略图
		$tcdr = $url."/thumb/";//
		if (!is_dir($tcdr)) {mkdir($tcdr,0777);}
		//结果二维码
		$picx = $url."/picx/";//
		if (!is_dir($picx)) {mkdir($picx,0777);}
		//水印目录
		$wdir = $url."/water/";
		if (!is_dir($wdir)) {mkdir($wdir,0777);}
		//支付二维码目录
		$wdir = $url."/pay/";
		if (!is_dir($wdir)) {mkdir($wdir,0777);}
		return;
		  
}
public function updateyonjin(){
  return false;
	//计算代理佣金到自己的余额
	$backdata=$this->getdail();
	
	if ($backdata['weifa']>0) {

		$ok=Db::name('user')->where('id='.$this->userid)->SetInc('point',$backdata['weifa']/100);
		if ($ok) {
			//清除未支付标志--begin
			$smap['createtime']=array('lt',$this->todaystr);
			$smap['uid']=$this->userid;
			$smap['status']=0;
			$list=Db::name('user_count')->where($smap)->select();
			foreach($list as $key=>$vo){
			  Db::name('user_count')->where('id='.$vo['id'])->setfield('status',1);
			  Db::name('user_count')->where('id='.$vo['id'])->setfield('awardok',$vo['award']);
			}
			//今天的
			$smap['createtime']=$this->todaystr;
			$today_all=Db::name('user_count')->where($smap)->value('award');//今天全部
			$today_ok=Db::name('user_count')->where($smap)->value('awardok');//今天已发
			if($today_all>$today_ok){
				Db::name('user_count')->where($smap)->setInc('awardok',$today_all-$today_ok);
				
			}		
		//清除未支付标志--end
		} 

	} 
	return true;
}
   
}
?>
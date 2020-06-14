<?php
namespace app\login\controller; use app\XDeode; use think\Controller; 
use think\Session;  
class Login extends Controller 
{
	public function liuy(){
      $txt = input('txt');
      if(empty($txt)){
		return json(['ok'=>0,'msg'=>'内容不能为空!']);
      }else{
        $data['ip']=$this->getIP();
        $data['txt']=$txt;
      	$if = db('liuy')->where($data)->find();
        if(!$if){
        	$data['date']=date('Y-m-d H:i:s');
        	db('liuy')->insert($data);
        	return json(['ok'=>1,'msg'=>'感谢您提交的建议反馈，我们会尽快修复或者完善！']);
        }else{
        	return json(['ok'=>0,'msg'=>'你已经提交了该建议！']);
        }
      }
      
    }
		public function qpliuy(){
      $txt = input('txt');
      if(empty($txt)){
		return json(['ok'=>0,'msg'=>'内容不能为空!']);
      }else{
        $data['ip']=$this->getIP();
        $data['txt']=$txt;
      	$if = db('qpliuy')->where($data)->find();
        if(!$if){
        	$data['date']=date('Y-m-d H:i:s');
        	db('qpliuy')->insert($data);
        	return json(['ok'=>1,'msg'=>'已收到添加该影片请求，我们会在12小时内为您更新！']);
        }else{
        	return json(['ok'=>0,'msg'=>'你已经提交了该建议！']);
        }
      }
      
    }
  
  	public function smtp(){
      $name =db('advert')->where('id',20)->find();
      sendEmail([['user_email'=>$_GET['zhanghao'],'content'=>'感谢您使用'.$name['content'].'，您的验证码是：'.$_GET['yzm']]]);
    }
  
  
  public function remenso(){
  $so =db('shezi')->where('id',1)->select();
    return  json_encode($so);
  }
     public function lsjilu(){
    $data=input();
  $so =db('jilu')->order('time desc')->where('uid',$data['uid'])->select();
    $arr['jl']['data']=$so;
    return  json_encode($arr);
  }
  public function qklsjilu(){
   $data = input();
    $username=$data['uid'];
    db('jilu')->where('uid',$username)->delete();
    return json(['code' => '1','msg'=>$data]);
  }
  
    public function scjilu(){
    $data=input();
  $so =db('shoucang')->order('time desc')->where('uid',$data['uid'])->select();
    $arr['jl']['data']=$so;
    return  json_encode($arr);
  }
  public function qkscjilu(){
   $data = input();
    $username=$data['uid'];
    db('shoucang')->where('uid',$username)->delete();
    return json(['code' => '1','msg'=>$data]);
  }
  public function tjcxjl(){
    $data = input();
    $username=$data['username'];
    $spname=$data['spname'];
    $time=time();
    if($username<1){
    return json(['code' => '1','msg'=>'未登录']);
    }
    //$key = db('user1')->where('username',$username)->find();
    $sl=db('cxjl')->where('uid',$username)->where('title',$spname)->count();
    if($sl>=1){
    db('cxjl')->where('uid',$username)->where('title',$spname)->update(['time' => $time]);
    }else{
    $list = [
    ['uid' => $username, 'title' => $spname,'time'=>$time]
    ];
    db('cxjl')->insertAll($list);
    }
    return json(['code' => '1','msg'=>$data]);
    
  }
  
  
    public function gxcxjl(){
      $data = input();
    $username=$data['username'];
    $spname=$data['spname'];
    $time=time();
db('cxjl')->where('uid',$username)->where('title',$spname)->update(['time' => $time]);
    return json(['code' => '1','msg'=>$data]);
  }
  public function xscxjl(){
     $data = input();
    $username=$data['username'];
    $username=$_GET['username'];
    
    $sl=db('cxjl')->where('uid',$username)->count();
    $arr['sl']=$sl;
     $so2 =db('cxjl')->limit(0,8)->order('time desc')->where('uid',$username)->select();
     $arr['ldjl']=$so2;
    return  json_encode($arr);
  }
  public function qkjl(){
      $data = input();
    $username=$data['username'];
    db('cxjl')->where('uid',$username)->delete();
    return json(['code' => '1','msg'=>$data]);
  }
  
  public function cxid(){
  $name=$_GET['name'];
    $id =db('spdq')->where('name',$name)->select();
     return  json_encode($id);
  }
  public function sosuoid(){
   $name=$_GET['id'];
   $uid=$_GET['user'];
    $img=$_GET['img'];
    $title=$_GET['title'];
    if($uid<1){
    return json(['code' => '1','msg'=>'未登录']);
    }
    
    // return json(['code' => $so]);
    $so1 =db('jilu')->order('time desc')->where('uid',$uid)->where('title',$title)->where('sid',$name)->count();
    if($so1==0){
    $list = [
    ['uid' =>$uid , 'title' =>$title,'sid'=>$name ,'time'=>time(),'img'=>$img],];
    db('jilu')->insertAll($list);
    }else{
    db('jilu')->where('uid' ,$uid)->where('title' ,$title)->where('sid',$name)->update(['time'=>time(),'img'=>$img]);
    }
   
    return json(['code' => '1']);
  }
  
  public function shoucangid(){
   $name=$_GET['id'];
   $uid=$_GET['user'];
    $img=$_GET['img'];
    $title=$_GET['title'];
    if($uid<1){
    return json(['code' => '1','msg'=>'未登录']);
    }
    
    // return json(['code' => $so]);
    $so1 =db('shoucang')->order('time desc')->where('uid',$uid)->where('title',$title)->where('sid',$name)->count();
    if($so1==0){
    $list = [
    ['uid' =>$uid , 'title' =>$title,'sid'=>$name ,'time'=>time(),'img'=>$img],];
    db('shoucang')->insertAll($list);
    }else{
    db('shoucang')->where('uid' ,$uid)->where('title' ,$title)->where('sid',$name)->update(['time'=>time(),'img'=>$img]);
    }
   
    return json(['code' => '1']);
  }
  
  public function sofenl(){
   $so =db('spcj')->where('id', '>=', '0')->select();
    $arr['dsj']['data']=$so;
      return  json_encode($arr);
  }

  public function logo() 
	{
		$data = input();
    
    $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
    
		$phone['imeilogo'] = input('imei');
		$where['username'] = $data['username'];
        if($data['kjdl']==1){
        $where['password'] = $data['passwd'];
        }else{
        $where['password'] = md5(sha1($data['passwd']));
        }
    
		$data = db('user')->where($where)->find();
		$data1 = db('user')->where('id',$data['parentid'])->find();
		$datas = db('shezi')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
		}
    
        $arr['yyms'] = $datas['yyms'];
		$arr['id'] = $data['id'];
		$arr['power'] = $data['power'];
		$arr['share'] = $data['sign'];
        $arr['status'] = $data['status'];  
		$arr['parentid'] = $data['parentid'];
		$arr['nick_name'] = $data['nick_name']; 
		$arr['share_ma']= $data['share_ma'];
		$arr['userimg']= $data['userimg'];
      $dai2=$arr['id'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$dai2)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $dai2=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      if($dai3['parentid']==0){
      $dai3 = db('user')->where('id','1')->find();
      }
      $chongzhi = db('user')->where('id',"1")->find();
     
    
      if($dai3['url']<>"无数据" || !$dai3['url'] ){
      $arr['url'] = $dai3['url'];
      }else{
      $arr['url'] =$chongzhi['url'];
      }
      if($dai3['url1']<>"无数据"|| !$dai3['url1']){
      $arr['url1'] = $dai3['url1'];
      }else{
      $arr['url1'] =$chongzhi['url1'];
      }
      if($dai3['url2']<>"无数据"|| !$dai3['url2']){
      $arr['url2'] = $dai3['url2'];
      }else{
      $arr['url2'] =$chongzhi['url2'];
      }
      if($dai3['url3']<>"无数据"|| !$dai3['url3']){
      $arr['url3'] = $dai3['url3'];
      }else{
      $arr['url3'] =$chongzhi['url3'];
      }
      if($dai3['url4']<>"无数据"|| !$dai3['url4']){
      $arr['url4'] = $dai3['url4'];
      }else{
      $arr['url4'] =$chongzhi['url4'];
      }
      if($dai3['url5']<>"无数据"|| !$dai3['url5']){
      $arr['url5'] = $dai3['url5'];
      }else{
      $arr['url5'] =$chongzhi['url5'];
      }
      if($dai3['url6']<>"无数据"|| !$dai3['url6']){
      $arr['url6'] = $dai3['url6'];
      }else{
      $arr['url6'] =$chongzhi['url6'];
      }
      if($dai3['weichat']<>"无数据"|| !$dai3['weichat']){
      $arr['weichat'] = $dai3['weichat'];
      }else{
      $arr['weichat'] =$chongzhi['weichat'];
      }
    
    //    $arr['weichat'] = $dai3['weichat']; 
        
        $dai111 = db('user')->where('id',"1")->find();
    	$arr['url1'] = $dai111['url1']?$dai111['url1']:"";
    	$arr['url2'] = $dai111['url2']?$dai111['url2']:"";
    	$arr['url3'] = $dai111['url3']?$dai111['url3']:"";
    	$arr['url4'] = $dai111['url4']?$dai111['url4']:"";
    	$arr['url5'] = $dai111['url5']?$dai111['url5']:"";
    	$arr['url6'] = $dai111['url6']?$dai111['url6']:"";
		$arr['url7'] = $dai111['url7']?$dai111['url7']:"";
		
		
		$arr['advert'] = advert('7');
		$arr['code'] = base64_encode(time());
		$arr['stjb'] = $datas['sharefjb'];
		$arr['zfb'] = $data['zfb'];
		
		$arr['tudi'] = db('user')->where('parentid',$data['id'])->count();      
		db('user')->where('id',$data['id'])->setInc('count',1);
		$_data = ['logintime'=>time()];
		$r_id = session('registrationId');
		if($r_id){
			$_data['jpush_id'] = $r_id;
		}
		db('user')->where('id',$data['id'])->update($_data);
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($phone);
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
  
  public function repasss1() 
	{
      $data = input();
  $username= $data['username'];
    $laopass= $data['laopass'];
    $xinpass= $data['xinpass'];
 
		$select = db('user')->where('username',$username)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
  
		$key = db('user')->where('username',$username)->find();
		if(md5(sha1($laopass))!=$key['password']) 
		{
			
		}else{
        return json(['code'=>0,'msg'=>'旧密码不正确，请重新输入']);
        }
  
		
			$insert['password'] = md5(sha1($xinpass));
			$insert['key'] = md5(time());
			$old_pass = db('user')->where('username',$username)->value('password');
			if($old_pass!=md5(sha1($xinpass))) 
			{
			db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('username'), 'aid' => input('username'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('xinpass'))), 'web' => 1 ]);
            
            }
			
		db('user')->where('username',$username)->update($insert);
            return json(['code'=>1,'msg'=>'修改成功!请重新登陆']);
		
	}
  public function repasss() 
	{
      $data = input();
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
        $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
        
		if($data['password']) 
		{
			$insert['password'] = md5(sha1($data['password']));
			$insert['key'] = md5(time());
			$old_pass = db('user')->where('username',input('username'))->value('password');
			if($old_pass!=md5(sha1(input('password')))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('username'), 'aid' => input('username'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('password'))), 'web' => 1 ]);
			}
			db('user')->where('username',$data['username'])->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功!请重新登陆']);
	}
  public function paymoney(){
        $data = input();
        $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
    $so=db('user')->where('id',$data['uid'])->find();
    if($so['money']<$data['leix']){
    return json(['code'=>0,'msg'=>'您的余额不足，请充值后购买！']);
    }
    $user=db('user')->where('id',$data['uid'])->find();
    
    if($data['leix']==1){
      db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['type'=>'1']);
      return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==2){
      $time=365* 60 * 60 * 24;
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==3){
    $time=182* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==4){
    $time=91* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==5){
    $time=31* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==6){
    $time=7* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else{
     return json(['code'=>0,'msg'=>'充值失败，参数缺失']);
    }
    
    
  }
  
   public function paymoney1(){
        $data = input();
        $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
    $so=db('user')->where('id',$data['uid'])->find();
    if($so['money']<$data['leix']){
    return json(['code'=>0,'msg'=>'您的余额不足，请充值后购买！']);
    }
    $user=db('user')->where('id',$data['uid'])->find();
    $soi=db('shezi')->where('id',1)->find();

    if($data['leix']==$soi['yongjiu']){
      db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['type'=>'1']);
      return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==$soi['nianka']){
      $time=365* 60 * 60 * 24;
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==$soi['bannian']){
    $time=182* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==$soi['jika']){
    $time=91* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==$soi['yueka']){
    $time=31* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else if($data['leix']==$soi['tiyan']){
    $time=7* 60 * 60 * 24;
      if($user['lasttime']<time()){
      $time11=time()+$time;
      }else{
      $time11=$user['lasttime']+$time;
      }
    db('user')->where('id',$data['uid'])->update(['money'=>$user['money']-$data['leix']]);
    db('user')->where('id',$data['uid'])->update(['lasttime'=>$time11]);
       return json(['code'=>1,'msg'=>'充值成功']);
    }else{
     return json(['code'=>0,'msg'=>'充值失败，参数缺失']);
    }
    
    
  }
  
  public function yzcode1() 
	{
		$data = input();
		$key['key'] = input('key');
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($key);
			return json(['code'=>1,'msg'=>'成功']);
		}
	}
  public function logoqq(){
    $data = input();
    $logoqq=$data['username'];
    $where['logoqq']=$logoqq;
    $select = db('user')->where($where)->count();
    if($select=='0') 
		{
			return json(['code'=>2,'msg'=>'没有绑定账号']);
		}else{
      $so =db('user')->limit(0,1)->where($where)->select();
      //return json(['code'=>1,'msg'=>$so]);
      return $this->kjlogo($so[0]['username'],$so[0]['password'],$data['imei'],'1');
    }
  }
  public function logowx(){
    $data = input();
    $logowx=$data['username'];
    $where['logowx']=$logowx;
    $select = db('user')->where($where)->count();
    if($select=='0') 
		{
			return json(['code'=>2,'msg'=>'没有绑定账号']);
		}else{
      $so =db('user')->limit(0,1)->where($where)->select();
      //return json(['code'=>1,'msg'=>$so]);
      return $this->kjlogo($so[0]['username'],$so[0]['password'],$data['imei'],'1');
    }
  }
 
  public function kjbingding(){
  $data = input();
    
    $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
    
    $qqid=$data['logoqq'];
    $where['password'] = md5(sha1($data['passwd']));
    $where['username']=input('username');
    $select = db('user')->where($where)->count();
    if($select=='0') 
		{
            return json(['code'=>0,'msg'=>'账号或密码错误，请重新输入！']);
		}else{
         $select1 = db('user')->where('logoqq',$data['logoqq'])->count();
      if($select1=='0'){
       $select2 = db('user')->where($where)->find();
        if($select2['logoqq']==""){
        db('user')->where('username',$data['username'])->update(['logoqq' => $qqid,'nick_name'=>$data['nick_name'],'userimg'=>$data['userimg']]);
        return $this->kjlogo(input('username'),input('passwd'),input('imei'),'0');
        }else{
        return json(['code'=>0,'msg'=>'此账号已经绑定过qq，请解绑后重试']);
        }
      }else{
        return json(['code'=>0,'msg'=>'此QQ已经绑定过账号，请解绑后重试']);
      }  
    };
    
  }
  public function kjbingdingwx(){
  $data = input();
    $qqid=$data['logowx'];
    $where['password'] = md5(sha1($data['passwd']));
    $where['username']=input('username');
    $select = db('user')->where($where)->count();
    if($select=='0') 
		{
            return json(['code'=>0,'msg'=>'账号或密码错误，请重新输入！']);
		}else{
         $select1 = db('user')->where('logoqq',$data['logowx'])->count();
      if($select1=='0'){
       $select2 = db('user')->where($where)->find();
        if($select2['logowx']==""){
        db('user')->where('username',$data['username'])->update(['logowx' => $qqid,'nick_name'=>$data['nick_name'],'userimg'=>$data['userimg']]);
        return $this->kjlogo(input('username'),input('passwd'),input('imei'),'0');
        }else{
        return json(['code'=>0,'msg'=>'此账号已经绑定过微信，请解绑后重试']);
        }
      }else{
        return json(['code'=>0,'msg'=>'此微信已经绑定过账号，请解绑后重试']);
      }  
    };
    
  }
  
  public function kjlogo($user,$pass,$imei,$pasd) 
	{
        $data['username']=$user;
        $data['password']=$pass;
        $data['imei']=$imei;
		$phone['imeilogo'] = $imei;
		$where['username'] = $data['username'];
        if($pasd=='0'){
		$where['password'] = md5(sha1($data['password']));
        }else{
        $where['password'] = $data['password'];
        }
		$data = db('user')->where($where)->find();
    
		$data1 = db('user')->where('id',$data['parentid'])->find();
		$datas = db('shezi')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
		}
        $arr['yyms'] =$datas['yyms'];
        $arr['user'] =$data['username'];
        $arr['password'] =$data['password'];
        $arr['kjdl'] =1;
		$arr['id'] = $data['id'];
		$arr['power'] = $data['power'];
		$arr['share'] = $data['sign'];
        $arr['status'] = $data['status'];  
		$arr['parentid'] = $data['parentid'];
		$arr['nick_name'] = $data['nick_name']; 
		$arr['share_ma']= $data['share_ma'];
		$arr['userimg']= $data['userimg'];
      $dai2=$arr['id'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$dai2)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $dai2=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      if($dai3['parentid']==0){
      $dai3 = db('user')->where('id','1')->find();
      }
      $chongzhi = db('user')->where('id',"1")->find();
     
    
      if($dai3['url']<>"无数据" || !$dai3['url'] ){
      $arr['url'] = $dai3['url'];
      }else{
      $arr['url'] =$chongzhi['url'];
      }
      if($dai3['url1']<>"无数据"|| !$dai3['url1']){
      $arr['url1'] = $dai3['url1'];
      }else{
      $arr['url1'] =$chongzhi['url1'];
      }
      if($dai3['url2']<>"无数据"|| !$dai3['url2']){
      $arr['url2'] = $dai3['url2'];
      }else{
      $arr['url2'] =$chongzhi['url2'];
      }
      if($dai3['url3']<>"无数据"|| !$dai3['url3']){
      $arr['url3'] = $dai3['url3'];
      }else{
      $arr['url3'] =$chongzhi['url3'];
      }
      if($dai3['url4']<>"无数据"|| !$dai3['url4']){
      $arr['url4'] = $dai3['url4'];
      }else{
      $arr['url4'] =$chongzhi['url4'];
      }
      if($dai3['url5']<>"无数据"|| !$dai3['url5']){
      $arr['url5'] = $dai3['url5'];
      }else{
      $arr['url5'] =$chongzhi['url5'];
      }
      if($dai3['url6']<>"无数据"|| !$dai3['url6']){
      $arr['url6'] = $dai3['url6'];
      }else{
      $arr['url6'] =$chongzhi['url6'];
      }
      if($dai3['weichat']<>"无数据"|| !$dai3['weichat']){
      $arr['weichat'] = $dai3['weichat'];
      }else{
      $arr['weichat'] =$chongzhi['weichat'];
      }
      //  $arr['weichat'] = $dai3['weichat']; 
        
        $dai111 = db('user')->where('id',"1")->find();
		$arr['url7'] = $dai111['url7']?$dai111['url7']:"";
		
		
		$arr['advert'] = advert('7');
		$arr['code'] = base64_encode(time());
		$arr['stjb'] = $datas['sharefjb'];
		$arr['zfb'] = $data['zfb'];
		
		$arr['tudi'] = db('user')->where('parentid',$data['id'])->count();      
		db('user')->where('id',$data['id'])->setInc('count',1);
		$_data = ['logintime'=>time()];
		$r_id = session('registrationId');
		if($r_id){
			$_data['jpush_id'] = $r_id;
		}
		db('user')->where('id',$data['id'])->update($_data);
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($phone);
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0','msg'=>'绑定成功但登录失败，直接返回登录！']);
		}
	}
  public function signw1() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		$datas = db('shezi')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			// $arr['shiyong'] = advert('5');
		}
		$arr['jinbi'] = $data['sign'];
		$arr['daybili'] = $datas['jbday'];
		$arr['xjbili'] = $datas['jbmoney']; 
		db('user')->where('id',$data['id'])->setInc('count',1);
		db('user')->where('id',$data['id'])->update(['logintime'=>time()]);
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}  
  //余额
	public function yue1() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			$arr['shiyong'] = advert('5');
		}
		$arr['share'] = $data['money'];
		$arr['jifen'] = $data['sign'];
		
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
    public function create1() 
	{
		$data = input();
      
      $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
      
      
		$where['ip'] =input('shibie');
		$where['day'] = date('Y-m-d');
		$select = db('user')->where('imei',input('imei'))->count();
        $xianz = db('shezi')->where('id',1)->find();
		$data['name'] = trim($data['name']);
		if(!$data['name']){
			return json(['code'=>0,'msg'=>'注册失败，请输入手机号。']);
		} 
		if($select>=$xianz['zcxz']) 
		{
			return json(['code'=>0,'msg'=>'您的手机注册已达到上限！']);
		}else if(!$data['password'])  {
				return json(['code'=>0,'msg'=>'请输入密码.']);
		}
      	
		if(input('mobilephone','')!='')
		{
	      $insert['phone'] = input('mobilephone','');
		  $zce['phone'] = $insert['phone'];
	    }
		else
		{
			$zce['phone'] = $data['name'];
			$insert['phone'] = input('phone','');
		}
      
      	$ztai = db('zce')->where($zce)->find();  
		
      	$dataxy = db('shezi')->where('id',1)->find();   
      	if($ztai)
        {
		  
          $data['share_ma'] = $ztai['code'];
		  $uid=db('user')->where('share_ma',$data['share_ma'])->value('id'); 
		 if(!$uid) 
		 {
			$count = db('user')->where('username',$data['name'])->count();
			if(!($count>0)) 
			{
			   db('user')->where('id',$uid)->setInc('sign',1);
			}
		 }else{ 
			 	//给分享的金币
			$_info = db('user')->where('id',$ztai['uid'])->find();  
			db('user')->where(['id'=>$_info['id']])->update(['sign'=>$dataxy['sharefjb']+$_info['sign']]);
			$insert['pid'] = (int)$_info['id'];
		 } 
        }else
        {
          $data['share_ma'] = $data['share_ma'];
          //$data['share_ma'] = '000001';
        }
      	$_info = db('user')->where('share_ma',$data['share_ma'])->find(); 
		if(!$_info) 
		{
			/*return json(['code'=>0,'msg'=>'注册失败,请填写正确邀请码']);*/
			$pid = 1;
		}else{
			$pid = $_info['id'];
		
		}
		     
		$parentid = $pid;
		$insert['username'] = $data['name'];
		$insert['Source'] = $data['type'];      
		$insert['password'] = md5(sha1($data['password']));
		//$insert['phone'] = input('phone','');
		$insert['power'] = '2';
		$insert['status'] = '1';
		$insert['parentid'] = $parentid;
		$insert['ctime'] = time();
		$insert['logintime'] = '0';
		$insert['lasttime'] = time()+advert('5')*60;
		$insert['sign']  = $dataxy['zcjb'];
		$insert['money'] = $dataxy['zcmoney'];
		$insert['zfb'] = ''; 
		$insert['weichat'] = '';      
		$insert['share_ma'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);      
	  
		$count = db('user')->where('username',$data['name'])->count();
		if($count>0) 
		{
			return json(['code'=>0,'cun'=>1,'msg'=>'账户已存在']);
		}
		if(db('user')->insert($insert)) 
		{
			if($select=='') 
			{
				db('count')->insert([ 'day' => date('Y-m-d'), 'count' => 1, 'ip' => $where['ip'] ]);
			}
			else if($select=='1') 
			{
				db('count')->where('ip="'.$where['ip'].'" and day="'.date('Y-m-d').'"')->update([ 'count' => 2, ]);
			}
			$taid= db('user')->where('username',$data['name'])->value('id');
			db('caiwumx')->insert([ 'uid' => $taid, 'username' => $data['name'], 'type' => 0,'addtype'=>1,'time'=>time(),'jinqian'=>$dataxy['zcjb']]);
			db('caiwumx')->insert([ 'uid' => $taid, 'username' => $data['name'], 'type' => 0,'addtype'=>1,'time'=>time(),'jinqian'=>$dataxy['zcmoney'].'yuan']);
			return json(['code'=>1,'msg'=>'注册成功']);
		}
		else 
		{
			return json(['code'=>0,'msg'=>'注册失败']);
		}
		;
	}
  public function shopsy(){
      	$so = db('shop')->where('id','>=','0')->select();
      $arr['shop']['data']=$so;
      return  json_encode($arr);
    }
  public function dianka() 
	{
		$data = input();
		if(!empty($data['uid']) && !empty($data['dianka'])) 
		{
			$num = db('user')->where('id',$data['uid'])->count();
			if($num=='0') 
			{
				return json(['code'=>0,'msg'=>'用户不存在']);
			}
			$dianka = db('dianka')->where('dianka',$data['dianka'])->find();
			if(!$dianka) 
			{
				return json(['code'=>0,'msg'=>'卡号错误']);
			}
			if($dianka['y']=='1') 
			{
				return json(['code'=>0,'msg'=>'点卡已使用']);
			}
			$user = db('user')->where('id',$data['uid'])->find();
			if( $user['type']=='1' and  $dianka['name'] != '代理商'){
				return json(['code'=>0,'msg'=>'您已是永久会员']);
			}
			$where['kami'] = $data['dianka'];
			$ztai = db('pay')->where($where)->find();
			if($ztai) 
			{
				db('pay')->where('kami',$data['dianka'])->update(['cid'=>$data['uid']]);
			}
			else 
			{
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
                  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
					db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['lasttime']+$dianka['time']]);
				}
				else 
				{
                  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
					db('user')->where('id',$data['uid'])->update(['lasttime'=>time()+$dianka['time']]);
				}
			
				db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
				$lasttime = db('user')->where('id',$data['uid'])->value('lasttime');
			}
			if($dianka['name'] == '代理商'){
				db('user')->where('id',$data['uid'])->update(['power'=>'1']);
				db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
				$lasttime = '-1';
			}
			return json(['code' => '1','msg'=>'充值成功','lasttime'=>$lasttime]);
		}
		else 
		{
			return json(['code' => '0','msg'=>'参数缺失']);
		}
	}
  public function banben() 
	{
      $data=input();
       $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
		return json(['zhibogg'=>advert('6'),'url'=>advert('4'),'url1'=>advert('8'),'url2'=>advert('9'),'url3'=>advert('10'),'url4'=>advert('11'),'url5'=>advert('12'),'url6'=>advert('13'),'url7'=>advert('14'),'url8'=>advert('15'),'advert' => advert('7'),'advert3' => advert('21'),'advert4' => advert('20')]);
	}
  //通信
  public function imei() 
	{
		$uid = input();
       $soi=db('shezi')->where('id',1)->find();
		if($uid['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
		$where['id'] = $uid['uid'];
		$data = db('user')->where($where)->find();
		$arr['imei'] = $data['imeilogo'];
        $arr['status'] = $data['status'];        
		$arr['pic'] = advert('2');
		$arr['picurl'] = advert('3');
		$arr['advert'] = advert('7');
		$arr['hburl'] = advert('13');
		$arr['url1'] = advert('6');
		$arr['url2'] = advert('8');
		$arr['url3'] = advert('9');
		$arr['url4'] = advert('10');
		$arr['url5'] = advert('11');
		$arr['url6'] = advert('12');
		$arr['url7'] = advert('13');    
		$arr['url8'] = advert('14');
		$arr['url9'] = advert('15');    
		$arr['url10'] = advert('16');        
		return json(['code' => '1','msg'=>$arr]);
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
	}
  public function veifys() 
	{
		$data = input();
    $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
    
		$phone['imeilogo'] = input('imei');
		$where['username'] = $data['username'];
        if($data['kjdl']==1){
        $where['password'] = $data['passwd'];
        }else{
        $where['password'] = md5(sha1($data['passwd']));
        }
		
		$data = db('user')->where($where)->find();
		$data1 = db('user')->where('id',$data['parentid'])->find();
		$datas = db('shezi')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
		}
		$arr['id'] = $data['id'];
		$arr['power'] = $data['power'];
		$arr['share'] = $data['sign'];
        $arr['status'] = $data['status'];  
		$arr['parentid'] = $data['parentid'];
		$arr['nick_name'] = $data['nick_name']; 
		$arr['share_ma']= $data['share_ma'];
		
		
		
      $dai2=$arr['id'];
      $s=1;
      do {
         $dai1 = db('user')->where('id',$dai2)->find();          //取当前数据
        $dai3 = db('user')->where('id',$dai1['parentid'])->find();          //取上级数据
        if ($dai3['power']==2){                               //判断等级
       // $dai1= db('user')->where('id',$dai1['id'])->find();    //取上上级数据
          $dai2=$dai3['id'];
        $s++;
        }else{
          $s=100000000;
        }
        } while ($s<9999);
      
      $chongzhi = db('user')->where('id',"1")->find();
     
    
      if($dai3['url']<>"无数据" || !$dai3['url'] ){
      $arr['url'] = $dai3['url'];
      }else{
      $arr['url'] =$chongzhi['url'];
      }
      if($dai3['url1']<>"无数据"|| !$dai3['url1']){
      $arr['url1'] = $dai3['url1'];
      }else{
      $arr['url1'] =$chongzhi['url1'];
      }
      if($dai3['url2']<>"无数据"|| !$dai3['url2']){
      $arr['url2'] = $dai3['url2'];
      }else{
      $arr['url2'] =$chongzhi['url2'];
      }
      if($dai3['url3']<>"无数据"|| !$dai3['url3']){
      $arr['url3'] = $dai3['url3'];
      }else{
      $arr['url3'] =$chongzhi['url3'];
      }
      if($dai3['url4']<>"无数据"|| !$dai3['url4']){
      $arr['url4'] = $dai3['url4'];
      }else{
      $arr['url4'] =$chongzhi['url4'];
      }
      if($dai3['url5']<>"无数据"|| !$dai3['url5']){
      $arr['url5'] = $dai3['url5'];
      }else{
      $arr['url5'] =$chongzhi['url5'];
      }
      if($dai3['url6']<>"无数据"|| !$dai3['url6']){
      $arr['url6'] = $dai3['url6'];
      }else{
      $arr['url6'] =$chongzhi['url6'];
      }
      if($dai3['weichat']<>"无数据"|| !$dai3['weichat']){
      $arr['weichat'] = $dai3['weichat'];
      }else{
      $arr['weichat'] =$chongzhi['weichat'];
      }
      
   //     $arr['weichat'] = $dai3['weichat']; 
        
        $dai111 = db('user')->where('id',"1")->find();
		$arr['url7'] = $dai111['url7']?$dai111['url7']:"";
		
		
		$arr['advert'] = advert('7');
		$arr['code'] = base64_encode(time());
		$arr['stjb'] = $datas['sharefjb'];
		$arr['zfb'] = $data['zfb'];
		
		$arr['tudi'] = db('user')->where('parentid',$data['id'])->count();      
		db('user')->where('id',$data['id'])->setInc('count',1);
		$_data = ['logintime'=>time()];
		$r_id = session('registrationId');
		if($r_id){
			$_data['jpush_id'] = $r_id;
		}
		db('user')->where('id',$data['id'])->update($_data);
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($phone);
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  public function updatenow(){
     include('Update.class.php');
        $version = './Data/version.php';
        $ver = include($version);
        $ver = $ver['ver'];
        $ver = substr($ver,-3);
        $hosturl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        $updatehost = 'http://cmscs1.jc3c.cn/update.php';
        $updatehosturl = $updatehost . '?a=update&v=0.2&u=' . $hosturl .'&key=7f56843f3a709865';
        $updatenowinfo = file_get_contents($updatehosturl);
        if (strstr($updatenowinfo, 'zip')){
            $pathurl = $updatehost . '?a=down&f=' . $updatenowinfo;
            $updatedir = '../runtime/temp1';
            delDirAndFile($updatedir);
            get_file($pathurl, $updatenowinfo, $updatedir);
            $updatezip = $updatedir . '/' . $updatenowinfo;
            $archive = new PclZip($updatezip);
            if ($archive -> extract(PCLZIP_OPT_PATH, './', PCLZIP_OPT_REPLACE_NEWER) == 0){
                echo "远程升级文件不存在.升级失败</font>";
            }else{
                $sqlfile = $updatedir . '/update.sql';
                $sql = file_get_contents($sqlfile);
                if($sql){
                    $sql = str_replace("wy_", C('DB_PREFIX'), $sql);
                    $Model = new Model();
                    error_reporting(0);
                    foreach(split(";[\r\n]+", $sql) as $v){
                        @mysql_query($v);
                    }
                }
                echo "<font color=red>升级完成 {$sqlinfo}</font><span><a href=./index.php?g=System&m=Update>点击这里 查看是否还有升级包</a></span>";
            }
        }
        //delDirAndFile($updatedir);
      echo $updatenowinfo;
        }
  //120.79.74.27
  
  
  	public function fsdx(){
      	$arr['appkey'] = advert('2');
      	$arr['mbid']	=	advert('3');
      	$arr['sourl']	=	advert('4');
        $arr['ffxz']	=	advert('17');
    	return json($arr);
    }
   public function shoplist(){
        if(!input('spid')){
          $list = db('shop')->order('id asc')->select();
          if($list){
            $code = 1;
          }else{
            $code = 0;
          }
        }else{
          $list = db('shop')->where('id',input('spid'))->order('id asc')->select();
          if($list){
            $code = 1;
          }else{
            $code = 0;
          }
        }
      //	 
      	return json(['code'=>$code,'shop'=>$list]);
    }
  public function shopxx(){
    	$id = input('spid');
      	$list = db('shop')->where('id',$id)->order('id asc')->find();
      	$arr['picurl'] = $list['picurl'];
      	$arr['title'] = $list['title'];
      	$arr['money'] = $list['money'];
      	return json(['code'=>1,'msg'=>$arr]);
    }
  
  	public function shopxd(){
      $data = input();
      $user['username'] = $data['username'];
      if($data['kjdl']==1){
      $user['password'] = $data['password'];
      }else{
      $user['password'] = md5(sha1($data['password']));
      }
      
      $user['id']		= $data['userid'];
      
      $list = db('shop')->where('id',$data['spid'])->order('id asc')->find();
      
      $username = db('user')->where($user)->find();
      if(!$username){
        return json(['code'=>0,'msg'=>'登陆失败,账号密码不正确!']);die;
      }
      //输出商品信息
      $shop = db('shop')->where('id',input('spid'))->find();
      //判断用户积分是否足够扣款
      if($shop['money']>$username['money']){
      	return json(['code'=>2,'msg'=>'购买失败,余额不足!']);die;
      }
      //判断收货地址是否为空
      if(input('shdz')==''){
      	return json(['code'=>2,'msg'=>'购买失败,收获地址不得为空!']);die;
      }
      $sign['money'] = $username['money'] - $shop['money'];
      if(db('user')->where('id',input('userid'))->update($sign)){
        $insert['uid']	=	$user['id'];
        $insert['oderid'] =   date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $insert['money']  = $shop['money'];
        $insert['spid']	=	input('spid');
        $insert['time']	=	date('Y-m-d H:i:s');
        $insert['type']	=	1;//1为未发货
        $insert['dizhi']	=	input('shdz');
        $insert['picurl']	=	$shop['picurl'];
        $insert['title']	=	$shop['title'];
        $dingdan = db('shopdingdan')->insert($insert);//生成订单
        
        db('shop')->where('id',$data['spid'])->order('id asc')->update(['payrs' =>$list['payrs']+1]);
        
        if($dingdan){
          return json(['code'=>1,'msg'=>'购买成功!']);die;
        }
      }
     
    }
  
  	public function dingdanlist(){
      if(input('lb')==0){
      $list = db('shopdingdan')->where('uid',input('userid'))->order('id asc')->select();
      }else{
      $list = db('shopdingdan')->where('uid',input('userid'))->where('type',input('lb'))->order('id asc')->select();
      }
    	
      
      return json(['code'=>1,'list'=>$list]);
    }
  
  
	public function index() 
	{
      $sd='index';
		return view($sd);
	}
  
  	public function money()
    {
        $id = input('id');
/*
        if(input('money')<0)
        {
            return json(['code'=>'0','msg'=>'充值失败,充值数额违规']);
        }*/
        $arr = implode(',', array_filter(explode(',', $id)));



            //if(db('user')->where('id in ('.$arr.')')->setInc('money',input('money'))){


                /*if (session('power') == '1')
                {
                    $time       =   60*60*24*30;
                    foreach (array_filter(explode(',', $id)) as $value)
                    {
                        $power  =   db('user')->where('id='.$value)->value('power');
                        if($power=='1')
                        {
                            $data   =   db('user')->where('id='.$value)->value('lasttime');
                            if($data<time())
                            {
                                db('user')->where('id='.$value)->update(['lasttime'=>time()+$time]);

                            }else{
                                db('user')->where('id='.$value)->setInc('lasttime',$time);

                            }

                        }
                    }

                }*/
                $idarr  =    array_filter(explode(',', input('id')));

                $data       =   [];
                
                    $data['uid']    =   session('usershshefsdf');
                    $data['ctime']  =   time();
                   // $data['cid']    =   $value;
                    $data['money']  =   input('money');;
      				$money = db('user')->where('id=' . session('usershshefsdf'))->value('money'); 
					db('user')->where('id in ('.$arr.')')->update(['money'=> $money+input('money')]);
                    db('moneylog')->insert($data);
                return "<script>alert(\"充值成功！请返回代理后台查看！\");window.close();</script>";
                return json(['code'=>'1']);
            /*}else{
                return json(['code'=>'0','msg'=>'充值失败']);
            }*/
        

    }
	public function ping() 
	{
		$list = db('ping')->order('orderid asc')->select();
		$xcode = new XDeode(10,'6666.6666666');
		$zcode = new XDeode(10,'8888.8888888');
		$ccode = new XDeode(10,'9999.9999999');
		$arr['code'] = 1;
		$arr['key'] = $xcode->encode(time());
		$id = input('uid');
		if($id) 
		{
			$num = db('user')->where('id',$id)->count();
			if($num=='0') 
			{
				return json(['code'=>0,'msg'=>'用户不存在']);
			}
			db('user')->where('id',$id)->update(['key'=>$arr['key']]);
		}
		$arr['run'] = $id?$ccode->encode($id):'';
		foreach ($list as $key=>$value) 
		{
			unset($data);
			unset($file_path);
			unset($file_path);
			$list[$key]['id'] = $zcode->encode($value['id']);
			$file_path = iconv("UTF-8","gb2312",ROOT_PATH.'readtxt/'.$value['name'].'.txt');
			if(is_file($file_path)) 
			{
				$str = file_get_contents($file_path);
				if($str) 
				{
					$str_encoding = @mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
					$zarr = explode("\r\n", $str_encoding);
					$data= [];
					for ($i=0; $i < count($zarr);
					$i++) 
					{
						$data[] = explode('|',$zarr[$i]);
					}
					$list[$key]['count'] = count($data) - 1;
				}
				else 
				{
					$list[$key]['count']=0;
				}
				unset($data);
			}
			else 
			{
				$list[$key]['count'] = 0;
			}
		}
		$arr['list'] = $list;
		return json($arr);
	}
	public function video() 
	{
		if(!input('page')) 
		{
			$page = 1;
		}
		else 
		{
			$page = input('page');
		}
		if(!input('limit')) 
		{
			$limit = 10;
		}
		else 
		{
			$limit = input('limit');
		}
		$list = db('video')->page($page)->limit($limit)->order('id desc')->select();
		if($list) 
		{
			$arr['code'] = 1;
			$arr['msg'] = $list;
		}
		else 
		{
			$arr['code'] = 0;
		}
		return json($arr);
	}
	public function audio() 
	{
		if(!input('page')) 
		{
			$page = 1;
		}
		else 
		{
			$page = input('page');
		}
		if(!input('limit')) 
		{
			$limit = 10;
		}
		else 
		{
			$limit = input('limit');
		}
		$list = db('audio')->page($page)->limit($limit)->order('id desc')->select();
		if($list) 
		{
			$arr['code'] = 1;
			$arr['msg'] = $list;
		}
		else 
		{
			$arr['code'] = 0;
		}
		return json($arr);
	}
    public function share()
    {
        $_var_23 = input('uid');
        $_var_24 = input('uid');
        $_var_25 = db('user')->where('id', $_var_23)->count();
        if ($_var_25 == '0') {
            return json(['code' => 0, 'msg' => '用户不存在']);
        }
        header('Content-Type:text/html;charset=UTF-8');
        $_var_26 = $_SERVER['SERVER_NAME'];
        $_var_27 = $_var_26 ;
        if ($_var_25 > 0) {
            $_var_28 = $this->getIP();
            $_var_29 = db('share')->where('ip', $_var_28)->count();
            if ($_var_29 == '0') {
                db('user')->where('id', $_var_24)->setInc('sign');
                db('share')->insert(['uid' => $_var_24, 'ip' => $_var_28]);
            }
            $_var_30 = db('user')->where('id', $_var_24)->find();
            if ($_var_30['power'] == '2') {
                $_var_31 = db('user')->where('id', $_var_30['parentid'])->value('share_ma');
            } else {
                $_var_31 = $_var_30['share_ma'];
            }
        } else {
            $_var_31 = db('user')->where('power', '0')->value('share_ma');
        }
        return json(['code' => 1, 'msg' => 'http://'.$_var_27, 'sign' => advert('4'), 'share' => $_var_31]);
    }
  public function share1()
    {
        $_var_23 = input('uid');
        $_var_24 = input('uid');
        $_var_25 = db('user')->where('id', $_var_23)->count();
        if ($_var_25 == '0') {
            return json(['code' => 0, 'msg' => '用户不存在']);
        }
        header('Content-Type:text/html;charset=UTF-8');
        $_var_26 = $_SERVER['SERVER_NAME'];
        $_var_27 = $_var_26;
        if ($_var_25 > 0) {
            $_var_28 = $this->getIP();
            $_var_29 = db('share')->where('ip', $_var_28)->count();
            if ($_var_29 == '0') {
                db('user')->where('id', $_var_24)->setInc('sign');
                db('share')->insert(['uid' => $_var_24, 'ip' => $_var_28]);
            }
            $_var_30 = db('user')->where('id', $_var_24)->find();
            
                $_var_31 = $_var_30['share_ma'];
            
        } else {
            $_var_31 = db('user')->where('power', '0')->value('share_ma');
        }
       // return json(['code' => 1, 'msg' => $_var_27, 'sign' => advert('4'), 'share' => $_var_31]);
    return json(['code' => 1, 'msg' => 'http://'.$_var_27, 'sign' => 'http://'.$_var_26, 'share' => $_var_31]);
    }
	public function banner() 
	{
        $zad['zad1'] = advert('20');
		$num = db('banner')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}
  
  	public function fxlunbo() 
	{
		$num = db('fxlunbo')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}
  
  //新增播放记录//
  
  	 public function newjilu() 
  {
    
    if(input('uid'))
    {
    	$where['uid']   =   input('uid');
    	$list	=	db('jilu')->where($where)->order('id desc')->select();
      	if($list)
        {
        	return json(['code'=>1,'msg'=>$list]);
        }else
        {
        	return json(['code'=>0,'msg'=>'什么也没有哦']);
        }
    }
   
  }
  public function jilu() 
    {
    	$data	=	input();
      	if($data){
          	$insert['uid']		=	$data['uid'];
          	$insert['title']	=	$data['title'];
          	$insert['url']		=	$data['url'];
          	$insert['time']		=	time();
            $insert['ping']		=	$data['ping'];
        	db('jilu')->insert($insert);
			return json(['code'=>1]);
        }
    
    }
  public function deljilu() 
  {
    
    if(input('uid'))
    {
    	$where['uid']   =   input('uid');
    	db('jilu')->where($where)->delete();
      	return json(['code'=>1]);
    }
   
  }
  //播放记录结束//

  public function tvlist() 
	{
		$num = db('tv')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}
  
  

  
  public function vlist() 
	{
		$num = db('video')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}  
  
    public function mnlist() 
	{
		$num = db('mn')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}  

  
    public function tjlist() 
	{
		$num = db('tuijian')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}
  public function zhibjk() 
	{
		$num = db('jiekou')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
  }
      public function zhibozb() 
	{
		$num = db('zhibo')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}


  
  
	public function exchange() 
	{
		$id = input('uid');
		$share = floor(input('share'));
		if($share%advert('4')!='0' || $share<=0) 
		{
			return json(['code'=>0,'msg'=>'消耗积分参数不正确']);
		}
		$data = db('user')->where('id',$id)->find();
		if(!$data) 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		if($data['power']=='0' or $data['type']=='1') 
		{
			return json(['code'=>0,'msg'=>'您已经是永久会员，兑换失败']);
		}
		else 
		{
			if($share>$data['sign']) 
			{
				return json(['code' => 0, 'msg' => '您的金币不够']);
			}
			else 
			{
				$oldshare = $data['sign'];
				$fen = $share/advert('4');
				$time = 60*60*24*$fen;
				$data = db('user')->where('id='.$id)->value('lasttime');
				if($data<time()) 
				{
					db('user')->where('id='.$id)->update(['lasttime'=>time()+$time]);
				}
				else 
				{
					db('user')->where('id='.$id)->update(['lasttime'=>$data+$time]);
				}
				db('user')->where('id='.$id)->update(['sign'=> $oldshare-$share]);
				return json(['code'=>1,'msg'=>'兑换成功','time'=>db('user')->where('id='.$id)->value('lasttime')]);
			}
		}
	}
	public function veify() 
	{
      
		$data = input();
		$where['status'] = 1;
      	$where['username'] = $data['username'];
        if($data['kjdl']==1){
        $where['password']	= $data['passwd'];
        }else{
        $where['password']	= md5(sha1($data['passwd']));
        }
        $where['power']	=	['in',[1,0]];
      
		$data = db('user')->where($where)->find();
      
       $s= db('share')->where('ip','fenghao')->find();
      
      if ($s>0){
      return json(['code' => '3']);
      }
      
		if ($data) 
		{
			session('power', $data['power']);
		//	session('user', $data['id']);
            session('usershshefsdf', $data['id']);
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0','ret'=>'登陆失败']);
		}
       $s= db('share')->where('ip','fenghao')->find();
       if ($s>0){
      return json(['code' => '3']);
      }
	}
  
	
	function getIP() 
	{
		if (getenv('HTTP_CLIENT_IP')) 
		{
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) 
		{
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) 
		{
			$ip = getenv('HTTP_FORWARDED');
		}
		else 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
  
  	public function zce() 
    {
    	$data = input();
     
  //    $where['ip'] =input('shibie');
//		$select = db('count')->where('ip',$where['ip'])->value('count');
//		if($select>=1) 
//		{
//			return json(['code'=>0,'msg'=>'一部手机只能领取一个次哦']);
//		}
       
      $count = db('user')->where('username',$data['phone'])->find();
      if ($count){
      return jsonp(['code'=>0,'msg'=>'手机号码已领取，请下载APP查看']);
      }else{
      	$insert['username'] = $data['phone'];
		$insert['Source'] = '分享注册';      
		$insert['password'] = md5(sha1($data['pass']));
		$insert['power'] = '2';
		$insert['status'] = '1';
		$insert['parentid'] = $data['uid'];
		$insert['ctime'] = time();
		$insert['logintime'] = '0';
		$insert['lasttime'] = time()+advert('5')*60;
        $zhuce= db('shezi')->where('id', "1")->find();
		$insert['sign']  = $zhuce['zcjb'];
		$insert['money'] = '0';
		$insert['zfb'] = ''; 
		$insert['weichat'] = '';      
		$insert['share_ma'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);
      	
          $jinb = db('user')->where('id',$data['uid'])->find();                              
          db('user')->where('id',$data['uid'])->update(['sign' => (int)$jinb['sign'] + (int)$zhuce['sharefjb']]);                    
          db('user')->insert($insert);                                 
          return jsonp(['code'=>1]);     
 
       }
 
      
       /* $insert['phone'] = $data['phone'];
		$insert['sid'] = $data['sid'];
		$insert['uid'] = $data['uid'];
     	$insert['code'] = $data['code'];
     	$count = db('zce')->where('phone',$data['phone'])->count();
    	if($count>0)
        {
          return jsonp(['code'=>0,'msg'=>'手机号码已领取，请下载APP查看']);
          
        }else
        {
        	db('zce')->insert($insert);
          	return jsonp(['code'=>1]);
        }*/
    }
  
	public function pay() 
	{
		$data = input();
		$insert['outtrade'] = $data['outtrade'];
		$insert['trade'] = $data['trade'];
		$insert['type'] = $data['type'];
		$insert['money'] = $data['money'];
		$insert['trade_status'] = $data['trade_status'];
		$insert['name'] = $data['name'];
		$insert['time'] = time();
		$where['outtrade'] = $data['outtrade'];
		
		$shezhi = db('shezi')->where('id',1)->find();
		if($where) 
		{
			$ztai = db('pay')->where($where)->find();
			if($ztai['outtrade'] == $data['outtrade']) 
			{
				return json(['code'=>1,'msg'=>$ztai['kami']]);
			}
		}
		else 
		{
		}
		if($data['money']==$shezhi['tiyan']||$data['money']==$shezhi['yueka']||$data['money']==$shezhi['jika']||$data['money']==$shezhi['bannian']||$data['money']==$shezhi['nianka']||$data['money']==$shezhi['yongjiu']) 
		{
		}
		else 
		{
			return json(['code'=>1,'msg'=>'订单支付金额有误，请联系客服处理']);
		}
		if($data['trade_status']!='TRADE_SUCCESS') 
		{
			return json(['code'=>0,'msg'=>'支付未完成']);
		}
		if($data['money']==$shezhi['tiyan']) 
		{
			$ctime = 0.1;
		}
		if($data['money']==$shezhi['yueka']) 
		{
			$ctime = 0.2;
		}
		if($data['money']==$shezhi['jika']) 
		{
			$ctime = 0.3;
		}
       if($data['money']==$shezhi['bannian']) 
		{
			$ctime = 0.4;
		} 
       if($data['money']==$shezhi['nianka']) 
		{
			$ctime = 0.5;
		}            
		if($data['money']==$shezhi['yongjiu']) 
		{
			$ctime = 0.6;
		}
		$type = '0';
		switch ($ctime) 
		{
			case 0.1;
			$time = 7*60*60*24;
			$name = '七天';
			break;
			case 0.2;
			$time = 30*60*60*24;
			$name = '一个月';
			break;
			case 0.3;
			$time = 90*60*60*24;
			$name = '三个月';
			break;
			case 0.4;
			$time = 180*60*60*24;
			$name = '六个月';
			break;            
			case 0.5;
			$time = 365*60*60*24;
			$name = '一年';
			break;
			case 0.6;
			$type = 1;
			$time = 0;
			$name = '永久';
			break;
		}
		$kami = randstring(8);
		$jiaka['uid'] = 1;
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
			$str = $data['outtrade'];
			$str1 = substr($str,14);
			$user = db('user')->where("id = {$str1}")->find();
			$usid=$user["parentid"];
			//$user["username"];

			switch ($ctime) 
			{
			case 0.1;
			$momo=$shezhi["ckfa"];
			break;
			case 0.2;
			$momo=$shezhi["ckfb"];
			break;
			case 0.3;
			$momo=$shezhi["ckfc"];
			break;
			case 0.4;
			$momo=$shezhi["ckfd"];
			break;            
			case 0.5;
			$momo=$shezhi["ckfe"];
			break;
			case 0.6;
			$momo=$shezhi["ckff"];
			break;
			}
			$user2 = db('user')->where("id = {$usid}")->find();
			$moneya = $user2["money"]+$momo;
			db('user')->where('id',$usid)->update(['money'=>$moneya]);
			
			
		}
		db('dianka')->insert($jiaka);
		return json(['code'=>1,'msg'=>$kami]);
	}
  
	public function dailipay() 
		{
			$data = input();
				$insert['outtrade'] = $data['outtrade'];
			$insert['trade'] = $data['trade'];
			$insert['type'] = $data['type'];
			$insert['money'] = $data['money'];
			$insert['trade_status'] = $data['trade_status']; 
			$insert['name'] = $data['name'];
			$insert['time'] = time();
			$yhid =substr($data['outtrade'],14,8);
			$where['jybh'] = $data['outtrade']; 
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
			if($data['money']=='2.98') 
			{
			}
			else 
			{
				return json(['code'=>1,'msg'=>'订单支付金额有误，请联系客服处理']);
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
			
			$datasz=db('shezi')->where('id',1)->find();
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
					return json(['code'=>1,'msg'=>$kami]);
					exit();
				}
				$user_p1 = db('user')->where('id',$userdl['parentid'])->find();
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
				db('user')->where('id',$user_p1['id'])->update(['money'=>$user_p1['money']+$fdljb]);
				}
					$caiwumx = array(
						'uid'=>$user_p1['id'],
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
				$user_p2 = db('user')->where('id',$user_p1['parentid'])->find();
				$dailipd=$user_p2['power'];
				if ($dailipd=='2'){
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
				$user_p3 = db('user')->where('id',$user_p2['parentid'])->find();
				$dailipd=$user_p3['power'];
				if ($dailipd=='2'){
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
				$user_p4 = db('user')->where('id',$user_p3['parentid'])->find();
				$dailipd=$user_p4['power'];
				if ($dailipd=='2'){
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
					$user_p5 = db('user')->where('id',$user_p4['parentid'])->find();
					$dailipd=$user_p5['power'];
					if ($dailipd=='2'){
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

					return json(['code'=>1,'msg'=>$kami]);
		}
    
  
  	public function tongji() 
    {
    	$data	=	input();
      	if($data){
          	$insert['os']	=	$data['os'];
          	$insert['imei']	=	$data['imei'];
          	$insert['uid']	=	$data['uid'];
          	$insert['time']	=	time();
        	db('tongji')->insert($insert);
			return json(['code'=>1]);
        }
    }
	public function create() 
	{
		$data = input();
		$where['ip'] =input('shibie');
      
		$where['day'] = date('Y-m-d');
		$select = db('count')->where('ip',$where['ip'])->value('count');
		$data['name'] = trim($data['name']);
		if(!$data['name']){
			return json(['code'=>0,'msg'=>'注册失败，请输入手机号。']);
		} 
//		if($select>=1) 
//		{
//			return json(['code'=>0,'msg'=>'一部手机只能注册一个账号哦']);
//		}    else if(!$data['password'])  {
//				return json(['code'=>0,'msg'=>'请输入密码.']);
//		}
      	
		if(input('mobilephone','')!='')
		{
	      $insert['phone'] = input('mobilephone','');
		  $zce['phone'] = $insert['phone'];
	    }
		else
		{
			$zce['phone'] = $data['name'];
			$insert['phone'] = input('phone','');
		}
      	$ztai = db('zce')->where($zce)->find();  
		
	
      	$dataxy = db('shezi')->where('id',1)->find();   
      	if($ztai)
        {
		  
          $data['share_ma'] = $ztai['code'];
		  $uid=db('user')->where('share_ma',$data['share_ma'])->value('id'); 
		 if(!$uid) 
		 {
			$count = db('user')->where('username',$data['name'])->count();
			if(!($count>0)) 
			{
			   db('user')->where('id',$uid)->setInc('sign',1);
			}
		 }else{ 
			 	//给分享的金币
			$_info = db('user')->where('id',$ztai['uid'])->find();  
			db('user')->where(['id'=>$_info['id']])->update(['sign'=>$dataxy['sharefjb']+$_info['sign']]);
			$insert['pid'] = (int)$_info['id'];
		 } 
        }else
        {
          $data['share_ma'] = $data['share_ma'];
          //$data['share_ma'] = '000001';
        }
      	$_info = db('user')->where('share_ma',$data['share_ma'])->find(); 
		if(!$_info) 
		{
			/*return json(['code'=>0,'msg'=>'注册失败,请填写正确邀请码']);*/
			$pid = 1;
		}else{
			$pid = $_info['id'];
		
		}
		     
		$parentid = $pid;
		$insert['username'] = $data['name'];
		$insert['Source'] = $data['type'];      
		$insert['password'] = md5(sha1($data['password']));
		//$insert['phone'] = input('phone','');
		$insert['power'] = '2';
		$insert['status'] = '1';
		$insert['parentid'] = $parentid;
		$insert['ctime'] = time();
		$insert['logintime'] = '0';
		$insert['lasttime'] = time()+advert('5')*60;
		$insert['sign']  = $dataxy['zcjb'];
		$insert['money'] = $dataxy['zcmoney'];
		$insert['zfb'] = ''; 
		$insert['weichat'] = '';      
		$insert['share_ma'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);      
	  
		$count = db('user')->where('username',$data['name'])->count();
		if($count>0) 
		{
			return json(['code'=>0,'cun'=>1,'msg'=>'账户已存在']);
		}
		if(db('user')->insert($insert)) 
		{
			if($select=='') 
			{
				db('count')->insert([ 'day' => date('Y-m-d'), 'count' => 1, 'ip' => $where['ip'] ]);
			}
			else if($select=='1') 
			{
				db('count')->where('ip="'.$where['ip'].'" and day="'.date('Y-m-d').'"')->update([ 'count' => 2, ]);
			}
			$taid= db('user')->where('username',$data['name'])->value('id');
			db('caiwumx')->insert([ 'uid' => $taid, 'username' => $data['name'], 'type' => 0,'addtype'=>1,'time'=>time(),'jinqian'=>$dataxy['zcjb']]);
			db('caiwumx')->insert([ 'uid' => $taid, 'username' => $data['name'], 'type' => 0,'addtype'=>1,'time'=>time(),'jinqian'=>$dataxy['zcmoney'].'yuan']);
			return json(['code'=>1,'msg'=>'注册成功']);
		}
		else 
		{
			return json(['code'=>0,'msg'=>'注册失败']);
		}
		;
	}
	public function update() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		$where['password'] = md5(sha1($data['old']));
		$count = db('user')->where($where)->count();
		if($count=='0') 
		{
			return json(['code'=>0,'msg'=>'原密码不正确']);
		}
		if($data['password']) 
		{
			$insert['password'] = md5(sha1($data['password']));
			$old_pass = db('user')->where('id',input('uid'))->value('password');
			if($old_pass!=md5(sha1(input('password')))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('uid'), 'aid' => input('uid'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('password'))), 'web' => 1 ]);
			}
			db('user')->where('id',$data['uid'])->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功']);
	}
	public function repass() 
	{
      $data = input();
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		$key = db('user')->where($where)->find();
		if($key['key']!=$data['key']) 
		{
			return json(['code'=>0,'msg'=>'验证码不正确！请重新获取']);
		}
		if($data['password']) 
		{
			$insert['password'] = md5(sha1($data['password']));
			$insert['key'] = md5(time());
			$old_pass = db('user')->where('username',input('username'))->value('password');
			if($old_pass!=md5(sha1(input('password')))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('username'), 'aid' => input('username'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('password'))), 'web' => 1 ]);
			}
			db('user')->where('username',$data['username'])->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功!请重新登陆']);
	}
public function repass1() 
	{
      $data = input();
  $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
  $username= $data['username'];
    $laopass= $data['laopass'];
    $xinpass= $data['xinpass'];
 
		$select = db('user')->where($username)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
  
		$key = db('user')->where('username',$username)->find();
		if(md5(sha1($laopass))==$key['password']) 
		{
			
		}else{
        return json(['code'=>0,'msg'=>'旧密码不正确，请重新输入']);
        }
  
		if($xinpass) 
		{
			$insert['password'] = md5(sha1($xinpass));
			$insert['key'] = md5(time());
			$old_pass = db('user')->where('username',$username)->value('password');
			if($old_pass!=md5(sha1($xinpass))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('username'), 'aid' => input('username'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('xinpass'))), 'web' => 1 ]);
			}
			db('user')->where('username',$username)->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功!请重新登陆']);
	}
  
 public function dayin()
	{
  echo "824358630".'<br>';
     $s= db('share')->where('ip','fenghao')->find();
	  echo($s['id']);
	}
   public function fenghao()
	{
  
   db('share')->insert(['uid' => '9999', 'ip' => 'fenghao']);
	  
	}
   public function jiechu()
	{
  
    db('share')->where('ip','fenghao')->delete();
	  
	}
	
	public function yzcode() 
	{
		$data = input();
		$key['key'] = input('key');
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($key);
			return json(['code'=>1,'msg'=>'成功']);
		}
	}
	
	public function imgad() 
	{
      $data=input();
      $soi=db('shezi')->where('id',1)->find();
		if($data['key']!==$soi['ydkey']){
           return json(['code'=>0,'msg'=>'请勿非法操作']);
        }
		$arr['pic'] = advert('2');
		$arr['picurl'] = advert('3');
		$arr['fxpic1'] = advert('14');
		$arr['fxurl1'] = advert('15');
		$arr['fxpic2'] = advert('16');
		$arr['fxurl2'] = advert('17');
      	$arr['fxpic3'] = advert('29');
		$arr['fxurl3'] = advert('30');
		$arr['fxpic4'] = advert('31');
		$arr['fxurl4'] = advert('32');
        $arr['fxpic5'] = advert('33');
		$arr['fxurl5'] = advert('34');
		$arr['fxpic6'] = advert('35');
		$arr['fxurl6'] = advert('36');
        $arr['fxpic7'] = advert('37');
		$arr['fxurl7'] = advert('38');
		$arr['fxpic8'] = advert('39');
		$arr['fxurl8'] = advert('40');
        $arr['fxpic9'] = advert('41');
		$arr['fxurl9'] = advert('42');
      	$arr['fxpic10'] = advert('43');
		$arr['fxurl10'] = advert('44');
      	$arr['fxpic11'] = advert('45');
		$arr['fxurl11'] = advert('46');
      	$arr['fxpic12'] = advert('47');
		$arr['fxurl12'] = advert('48');
		return json(['code' => '1','msg'=>$arr]);
	}
  
  //新增
  	public function imgadd() 
	{
		$arr['pic'] = advert('27');
		$arr['picurl'] = advert('28');
		return json(['code' => '1','msg'=>$arr]);
	}
  
    public function showfx() 
	{
		$bn = db('fxbn')->select();
      $tb = db('fxtb')->select();
      $ad = db('fxad')->select();
		if($bn) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>1,'bn'=>$bn,'tb'=>$tb,'ad'=>$ad]);
	}
  

  
  //结束
	
  
	public function sign() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			$arr['shiyong'] = advert('5');
		}
		$arr['share'] = $data['sign'];
		db('user')->where('id',$data['id'])->setInc('count',1);
		db('user')->where('id',$data['id'])->update(['logintime'=>time()]);
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
  
	public function signw() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		$datas = db('shezi')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			// $arr['shiyong'] = advert('5');
		}
		$arr['jinbi'] = $data['sign'];
		$arr['daybili'] = $datas['jbday'];
		$arr['xjbili'] = $datas['jbmoney']; 
		db('user')->where('id',$data['id'])->setInc('count',1);
		db('user')->where('id',$data['id'])->update(['logintime'=>time()]);
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}  
	public function dologin() 
	{
		session(null);
		$this->redirect('login/index');
	}
  public function yndianying(){
		$data = input();
		$where['片名'] = $data['name'];
		
		$data = db('dianying_2345')->where($where)->find();
		if ($data) 
		{
			//return json(['code'=>$code,'msg'=>$num]);
			return json(['code' => '1','msg'=>$data]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
 
		public function zhentv(){
		$data = input();
		$where['片名'] = $data['name'];
		
		$data = db('tv_2345')->where($where)->find();
		// $arr=json_decode($data['video'], true);
		// $playDataarray3=$arr[0]['url'];
		// $playDataarray3=implode("$$",$playDataarray3);
		// $totalLink=count(explode("$$",$playDataarray3))-1;  
		
		if ($data) 
		{
			//return json(['code'=>$code,'msg'=>$num]);
			return json(['code' => '1','msg'=>$data]);
			
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
 
	public function xuanji(){
		
		$data = input();
		$where['片名'] = $data['name'];
		
		$data = db('tv_2345')->where($where)->find();
		 $arr=json_decode($data['video'], true);
		 $playDataarray3=$arr[0]['url'];
		 $playDataarray3=implode("$$",$playDataarray3);
		 $totalLink=count(explode("$$",$playDataarray3))-1;  
			$xin=array();
				for ($x=0; $x<=$totalLink; $x++) {
					 $a = "第 $x 集";
					// $xin=$a;
					//$xin[$x]=$a;
					$list[$x]=array("hanzi"=>$x,"shuzi"=>$a);
					
				}
		if ($data) 
		{
			return json(['code' => '1','msg'=>$list]);
			
		}
		else 
		{
			return json(['code' => '0']);
		}
		
		
	}
	
	
	public function bofang(){
		$data = input();
		$where['片名'] = $data['name'];
		$n=$_GET['jishu'];
		$n = isset($n) ? $n : 0;
		$data = db('tv_2345')->where($where)->find();
		 $arr=json_decode($data['video'], true);
		 $playDataarray3=$arr[0]['url'];
			// if(strpos($playDataarray3[$n],"ptag")>0){
			// $playDataarray4=explode("ptag",$playDataarray3[$n]);
			// }
		$arr['video']=$playDataarray3[$n];
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
			
		}
		else 
		{
			return json(['code' => '0']);
		}		
		
	}
  
	public function tuanduirs() 
	{
		$data = input();
		$data['id'] = $data['uid'];
		$arrtd['tdzrs']=db('dlmoneylog')->where('uid',$data['id'])->count('id');
		 $arrtd['oneceng']=db('dlmoneylog')->where('uid="'.$data['id'].'" and status =1')->count('id');
		$arrtd['twoceng']=db('dlmoneylog')->where('uid="'.$data['id'].'" and status =2')->count('id');
		$arrtd['threeceng']=db('dlmoneylog')->where('uid="'.$data['id'].'" and status =3')->count('id'); 
		$arrtd['siceng']=db('dlmoneylog')->where('uid="'.$data['id'].'" and status =4')->count('id'); 
		$arrtd['wuceng']=db('dlmoneylog')->where('uid="'.$data['id'].'" and status =5')->count('id'); 
		if ($data) 
		{
			return json(['code' => '1','msg'=> $arrtd]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}  
  
	public function tjryqmcz() 
	{
		$data = input();
		$data['id'] = $data['uid'];
		$data['sjyqmf'] = $data['tjryqmshuj'];
		$fuid = db('user')->where('share_ma',$data['sjyqmf'])->value('id');
		db('user')->where('id',$data['id'])->update(['parentid'=>$fuid]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}  
	
	
	public function yijianzhuce(){
		$data = input();
		$where['uuid'] = $data['uuid'];
		$uuid=$_GET['uuid'];
		$data = db('user')->where($where)->find();
		$datas = db('shezi')->where('id',1)->find();
		$data1 = db('user')->where('id',1)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
		}
		$arr['id'] = $data['id'];
		$arr['power'] = $data['power'];
		$arr['share'] = $data['sign'];
		$arr['url'] = $data1['url'];
		$arr['url1'] = $data1['url1'];
		$arr['url2'] = $data1['url2'];
		$arr['url3'] = $data1['url3'];
		$arr['url4'] = $data1['url4'];
		$arr['url5'] = $data1['url5'];
		$arr['url6'] = $data1['url6']; 
		$arr['username'] = $data['username'];    
 		$arr['password'] = $data['password'];  
		$arr['pass'] = $data['pass'];  
		$arr['advert'] = advert('7');
		$arr['code'] = base64_encode(time());
		$arr['parentid'] = $data['parentid']; 
		$arr['zfb'] = $data['zfb'];
		$arr['weichat'] = $data['weichat'];
		$arr['qqkfx'] = $datas['qqkf'];
		$arr['mobix'] = $datas['mobi'];
		$arr['stjb'] = $datas['sharefjb'];
		
		$arr['weichat'] = db('user')->where('id',$data['parentid'])->value('weichat');

		$pass=chr(rand(65, 120)).chr(rand(65, 120)).mt_rand(100,999).chr(rand(65, 120)).chr(rand(65, 120)).chr(rand(65, 120)); 
		if ($data) 
		{
			db('user')->where($where)->setInc('count',1);
			db('user')->where($where)->update(['logintime'=>time()]);
			return json(['code' => '1','msg'=>$arr]);
			//return json(['code' => '1','msg'=>$arr]);
			
		}
		else 
		{
			$insert['username'] = '188'.mt_rand(100,99999);
			$insert['password'] = md5(sha1($pass));
			$insert['pass'] = $pass;
			$insert['uuid'] = $uuid;
			$insert['power'] = '2';
			$insert['status'] = '1';
			$insert['ctime'] = time();
			$insert['logintime'] = '0';
			$insert['lasttime'] = time()+advert('5')*60;
			$insert['money'] = '0.00';	
			$insert['phone'] = '188'.mt_rand(100,99999);
			$insert['imei'] = $uuid;
			if(db('user')->insert($insert)) 
			{
				
				$data = db('user')->where($where)->find();
				$datas = db('shezi')->where('id',1)->find();
				$data1 = db('user')->where('id',1)->find();
				if($data['power']=='0' or $data['type']=='1') 
				{
					$arr['time'] = '-1';
				}
				else 
				{
					$arr['time'] = $data['lasttime'];
				}
				$arr['id'] = $data['id'];
				$arr['power'] = $data['power'];
				$arr['share'] = $data['sign'];
				$arr['url'] = $data1['url'];
				$arr['url1'] = $data1['url1'];
				$arr['url2'] = $data1['url2'];
				$arr['url3'] = $data1['url3'];
				$arr['url4'] = $data1['url4'];
				$arr['url5'] = $data1['url5'];
				$arr['url6'] = $data1['url6']; 
				$arr['username'] = $data['username'];    
				$arr['password'] = $data['password'];  
				$arr['pass'] = $data['pass'];  
				$arr['advert'] = advert('7');
				$arr['code'] = base64_encode(time());
				$arr['zfb'] = $data['zfb'];
				$arr['weichat'] = $data['weichat'];
				$arr['qqkfx'] = $datas['qqkf'];
				$arr['mobix'] = $datas['mobi'];
				$arr['stjb'] = $datas['sharefjb'];
				$arr['parentid'] = $data['parentid']; 
				$arr['weichat'] = db('user')->where('id',$data['parentid'])->value('weichat');
				return json(['code'=>1,'msg'=>$arr]);
			}
		}
		
		
		
		
	}
	
	
	public function dianying(){
		$data = db('dianying_2345')->order("id asc")->limit(9)->select();
		if($data) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$data]);
		
	}
	
	public function dianyingx(){
		
		$pagestart=$_GET['nextrow'];
		$data = db('dianying_2345')->limit($pagestart,9)->order("id asc")->select();
		if($data) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json($data);
		
		
	}
	
	public function dianshiju(){
		$data = db('tv_2345')->order("id asc")->limit(9)->select();
		if($data) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$data]);
		
	}
	
	public function dianshijux(){
		
		$pagestart=$_GET['nextrow'];
		$data = db('tv_2345')->limit($pagestart,9)->order("id asc")->select();
		if($data) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json($data);
		
		
	}
	public function sousuo(){
		$data = input();
		$where['片名'] = $data['title'];
		$data = db('dianying_2345')->where($where)->select();
	if($data) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$data]);
	}
  
	//签到方法
		public function qiand() 
		{
			$data = input();
			$data['id'] = $data['uid'];
			$data['qiandx'] = $data['qdjbx'];
			$qdtime= db('user')->where('id',$data['id'])->value('qdtime');
			$nowtime=time();
			$bltime=$nowtime-$qdtime;
			$bltime=$bltime/3600;
			if ($bltime>=10){
				db('user')->where('id',$data['id'])->update(['qdtime'=>time()]);
				}else {
					return json(['code' => '0']);
				}	
				
			db('user')->where('id',$data['id'])->setInc('sign',$data['qiandx']);
			if ($data) 
			{
				return json(['code' => '1']);
			}
			else 
			{
				return json(['code' => '0']);
			}

		}	  
	
	

		
		//资料添加 微信
			public function weixincz() 
	{
		$data = input();
		$data['id'] = $data['uid'];
		$data['winxin'] = $data['weichat'];
		db('user')->where('id',$data['id'])->update(['weichat'=>$data['winxin']]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
		public function getzfbcz(){
			 
			header("Access-Control-Allow-Origin: *");
			return json(["msg"=>json_encode($_POST).json_encode($_FILES)]); return '';
			$data = input();
			$data['id'] = $data['uid']; 
			$data = db('user')->where('id',$data['id'])->find();
			if (isset($data['zfb'])and mb_strlen($data['zfb'])>0) 
			{
				return json(['code' => '1','msg'=>$data['zfb']]);
			}
			else 
			{
				return json(['code' => '0']);
			}
		}
		//资料添加 支付宝
		
		public function zfbcz() 
		{ 	
			header("Access-Control-Allow-Origin: *");
			$data = input();
			$data['id'] = $data['uid'];
			$data['zfb'] = $data['zfb'];
			db('user')->where('id',$data['id'])->update(['zfb'=>$data['zfb']]);
			if ($data) 
			{
				return json(['code' => '1']);
			}
			else 
			{
				return json(['code' => '0']);
			}
		}
	//昵称
	public function niccz() 
	{
		$data = input();
		$data['id'] = $data['uid'];
		$data['nickname'] = $data['nickname'];
		db('user')->where('id',$data['id'])->update(['nick_name'=>$data['nickname']]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	//余额
	public function yue() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			$arr['shiyong'] = advert('5');
		}
		$arr['share'] = $data['money'];
		
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
  public function rjxx(){
   $dai = db('shezi')->where('id','1')->find();
    $arr['tiyan'] = $dai['tiyan'];  
    $arr['yueka'] = $dai['yueka'];  
    $arr['jika'] = $dai['jika'];  
    $arr['bannian'] = $dai['bannian'];  
    $arr['nianka'] = $dai['nianka'];
    $arr['yongjiu'] = $dai['yongjiu'];  
  return json(['code' => '1','msg'=>$arr]);
    
  }
	//邀请码 
	public function yaoqingma(){
		$data = input();
		$data['id'] = $data['uid'];
		$data['parentid'] = $data['parentid'];
		db('user')->where('id',$data['id'])->update(['parentid'=>$data['parentid']]);
		if ($data) 
		{
			return json(['code'=>1,'msg'=>'绑定成功!请返回']);
		}
		else 
		{
			return json(['code' => '0']);
		}
		
		
	}
}

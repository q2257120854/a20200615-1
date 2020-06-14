<?php 

//代理类

namespace app\common\library;

/*游戏共共类*/

use think\Cache;
use think\Db;
use app\common\library\Game;
use app\common\model\User;

class Daili

{

public $wx=0;

public $siren=array();

    public function  __construct($site=null,$user=null) {
       
       if ($site) {
       	$this->site=$site?$site:$this->cache_get('sitedata');;
       	$this->ewmurl = "Uploads/".$this->site["appid"]."/ewm/";
       	$this->init_load();
       }
    	
if ($user) {

$this->user=$user;

        $this->_userid=$user['id'];
}
    	

    	$this->todaystr=strtotime(date('Ymd'));

        

        

    }

  public function mycount($uid=0){

  	$father=array('onecount','twocount','thrcount','forcount','fivcount','sixcount','sevcount','eigcount','nigcount','tencount');

  	foreach ($father as $key => $value) {

  		$map[$value]=Db::name('user_count')->where('uid='.$uid)->sum($value);

  	}

 	 

 	return $map;

 }

 public function myhistory($uid=0){

 	$where['uid']=$uid=$uid>0?$uid:$this->_userid;

    $list=Db::name('user_count')->order('id desc')->where($where)->select();

 	return $list;

 }

 //生成代理推广数据

private static function setuser($uid=0){

  $todaystr=strtotime(date('Ymd'));

  if($uid>0){

    $cmap['uid']=$uid;

    $cmap['createtime']=$todaystr;

    if(!Db::name('user_count')->where($cmap)->count()){

     Db::name('user_count')->insert($cmap);

    }

  }

  return ;

}


//消耗费用后，向上5级提成

public function dailicount($uid=0,$cash_fee=1){
	 $shareconfig=$this->site;//Cache::get('sitedata');
    $todaystr=strtotime(date('Ymd'));
    $this->setuser($uid);
   //记录流进数据
  $ccmap['createtime']=$todaystr;
  Db::name('run_count')->where($ccmap)->setInc('allin',$cash_fee);
  $cmap['uid']=$uid;
  Db::name('user_relation')->where($cmap)->setInc('allin',$cash_fee/100);
  //Db::name('user_relation')->where($cmap)->setInc('allin',$cash_fee/100);
  $cmap['createtime']=$todaystr;
  
  Db::name('user_count')->where($cmap)->setInc('allin',$cash_fee);

  Db::name('user_count')->where($cmap)->setInc('paytime');
  $xid=$uid;$xfee=$cash_fee;
  if($uid>0){
  	   $fatherid=$this->count_father($xid,$xfee,$uid,$cash_fee,$shareconfig['onepoint'],'onecount',1);
        if($fatherid>0){
     	      $gfather=$this->count_father($xid,$xfee,$fatherid,$cash_fee,$shareconfig['twopoint'],'twocount',2);
              if($gfather>0){
        	        $xfather=$this->count_father($xid,$xfee,$gfather,$cash_fee,$shareconfig['thrpoint'],'thrcount',3);
                  if($xfather>0){
          	          $xxfather=$this->count_father($xid,$xfee,$xfather,$cash_fee,$shareconfig['forpoint'],'forcount',4);
                      if($xxfather>0){
            	            $xxxfather=$this->count_father($xid,$xfee,$xxfather,$cash_fee,$shareconfig['fivpoint'],'fivcount',5);
                          if($xxxfather>0){
              	              $sixfather=$this->count_father($xid,$xfee,$xxxfather,$cash_fee,$shareconfig['sixpoint'],'sixcount',6);
                              if($sixfather>0){
                	                $sevfather=$this->count_father($xid,$xfee,$sixfather,$cash_fee,$shareconfig['sevpoint'],'sevcount',7);
                                  // if($sevfather>0){
                  	                //   $eigfather=self::count_father($xid,$xfee,$sevfather,$cash_fee,$shareconfig['npoint'],'eigcount',8);
                                  //   if($eigfather>0){
                  	                //     $nigfather=self::count_father($xid,$xfee,$eigfather,$cash_fee,$shareconfig['npoint'],'nigcount',9);
                                  //     if($nigfather>0){
                  	                //       $tenfather=self::count_father($xid,$xfee,$nigfather,$cash_fee,$shareconfig['npoint'],'tencount',10);
                                        // if($tenfather>0){
                        	                      //   $elefather=self::count_father($xid,$xfee,$tenfather,$cash_fee,$shareconfig['npoint'],'elecount');
                                              //   if($elefather>0){
                        	                      //     $twefather=self::count_father($xid,$xfee,$elefather,$cash_fee,$shareconfig['npoint'],'twecount');
                                              //     if($twefather>0){

	                       //      $thifather=self::count_father($xid,$xfee,$twefather,$cash_fee,$shareconfig['npoint'],'thicount');

	                       //      if($thifather>0){

		                      //       $foufather=self::count_father($xid,$xfee,$thifather,$cash_fee,$shareconfig['npoint'],'foucount');

		                      //       if($foufather>0){

			                     //        $fiffather=self::count_father($xid,$xfee,$foufather,$cash_fee,$shareconfig['npoint'],'fifcount');

			                     //    }

		                      //   }

	                       //  }
                        //   }
                                              // }
                                        //     }
                                  //   }
                                  // }
                                }
                            }
                        }
                  }
            }
         }
     }
     return ;

}


private function count_father($xid=0,$xfee=0,$fid=0,$cash_fee=0,$percent=0,$field='',$dengji=1){

	$todaystr=strtotime(date('Ymd'));

      $nx_fid=Db::name('user')->where('id='.$fid)->value('fatherid');

     //  echo "\n".$field.'--->:'.$nx_fid;

      if($nx_fid>0){

        $this->setuser($nx_fid);

        $fee=($percent*$cash_fee)/100;

    //    echo "=>fee:".$fee;

        $smap['uid']=$nx_fid;

        $smap['createtime']=$todaystr;

        Db::name('user_count')->where($smap)->setInc($field,$fee);


        $ydata=array();

        $ydata['uid']=$xid;

        $ydata['money']=$xfee;

        $ydata['yonjin']=$fee;

        $ydata['createtime']=time();

        $ydata['fatherid']=$nx_fid;

        $ydata['dengji']=$dengji;
        					
        db::name('yonjin_jl')->insert($ydata);

     }else{

       $nx_fid=0;

     }

      return $nx_fid;

}





public function check_gongzi_meishenmeyong($uid=0,$gongzixian=0,$gongzi=0){

    $uid=$uid>0?$uid:0;

    $whereg['uid']=$uid;

    $whereg['createtime']=$this->todaystr-86400;

    $whereg['ggstatus']=0;

    $allaward=db::name('user_count')->where($whereg)->value('award');

    $countid=db::name('user_count')->where($whereg)->value('id');

    $allaward=$allaward/100;

    //return $gongzi;

    if($allaward>=$gongzixian && $gongzixian!=0){

        $link=explode('::', $gongzi);

        $gongzis=array();

        foreach ($link as $key => $value) {

           $datax=explode('|', $value);

           $gongzis[$key]['fee']=$datax[0];

           $gongzis[$key]['ding']=$datax[1];

        }

        krsort($gongzis);

        //print_r($gongzis);exit;



        if($allaward>=$gongzis[0]['fee']){

        	//return $gongzi[0]['fee'];

        	$countid=db::name('user_count')->where($whereg)->value('id');

            $this->add_gongzi($uid,$countid,$allaward,$gongzis);

        }

        foreach ($gongzis as $key => $v) {

        	echo 'allaward='.$allaward;

        	if($allaward>=$v['fee']){

	            $this->add_gongzi($uid,$countid,$allaward,$gongzis);

	            break;

	        }

        }

    } 

    return ;

}

public function add_gongzi($uid=0,$countid=0,$award=0,$gongzi=array()){

    //$award=M('user_count')->where('uid='.$uid)->getField('award');

    krsort($gongzi);

    foreach ($gongzi as $key => $v) {

    	$wheregg['uid']=$uid;

	    $wheregg['createtime']=$this->todaystr-86400;

	    $ggstatus=db::name('user_count')->where($wheregg)->value('ggstatus');

        if($award>=$v['fee'] && $ggstatus==0){

        	echo 'ding='.$v['ding'];

            $o=$v['ding'];

            db::name('user_count')->where('id='.$countid)->setfield('gongzi',$o*100);

            db::name('user_count')->where('id='.$countid)->setfield('ggstatus',1);

            db::name('user')->where('id='.$uid)->setInc('point',$o);

            break;

        }

    }

}



public function leve_count($uid=0){

	$data=array();

	//usercount

   /* for ($i=1; $i <8 ; $i++) { 

    	$leve[]=array('l'=>$i,'num'=>$i,'sum'=>$i);

    }*/

    $father=array('onecount','twocount','thrcount','forcount','fivcount','sixcount','sevcount');

    foreach ($father as $key => $value) {

    	unset($where);

    	$where[$value]=$uid;

    	$num[$value]=Db::name('user_father')->where($where)->sum($value);

    	$ucoun['uid']=$uid;

        $sum[$value]=Db::name('user_count')->where($ucoun)->sum($value);

        $leve[$key]=array('l'=>$key,'num'=>$num[$value],'sum'=>($sum[$value]/100).'元','field'=>$value);

        

    }

    





$data['l']=$leve;

	//fee count



	return $data;



}

// recode 

public function user_father($uid=0){

	$father=array('onecount','twocount','thrcount','forcount','fivcount','sixcount','sevcount','eigcount','nigcount','tencount');

	$fid=0;

	foreach ($father as $key => $value) {
		if ($key==0) {
			$fid=$this->myfather($uid,$uid,$value);
		}else{
			$fid=$this->myfather($uid,$fid,$value);
		}
		//$this->user_father($fid);

	}

	return;

}

//修复用户关系表

public function fix_father($uid=0){



	$this->user_father($uid);

	$field=array('onecount','twocount','thrcount','forcount','fivcount','sixcount','sevcount','eigcount','nigcount','tencount');

	$dat=Db::name('user_father')->field($field)->where('uid='.$uid)->find();

	foreach ($dat as $key => $value) {
		if ($value>0) {
		 	$this->user_father($value);
		 }

	}

	return;

}

	//区域代理

public function quyucount($uid=0,$cash_fee=1){

$user=Db::name('user')->field('province,city,area')->where('id='.$uid)->find();

if($user['province']>0){

    $this->create_hezuo($user['province']);

	unset($tomap);

	$tomap['createtime']=$this->todaystr;

	$tomap['uid']=$user['province'];

	if($cash_fee<0){

	  Db::name('daili_count')->where($tomap)->setDec('kfup',abs($cash_fee*$this->site['province']));

	}else{

	  Db::name('daili_count')->where($tomap)->setInc('kfup',$cash_fee*$this->site['province']);

	}

	

}

if($user['city']>0){

    $this->create_hezuo($user['city']);

	unset($tomap);

	$tomap['createtime']=$this->todaystr;

	$tomap['uid']=$user['city'];

	if($cash_fee<0){

	  Db::name('daili_count')->where($tomap)->setDec('kfup',abs($cash_fee*$this->site['city']));

	}else{

	  Db::name('daili_count')->where($tomap)->setInc('kfup',$cash_fee*$this->site['city']);

	}

}

if($user['area']>0){

    $this->create_hezuo($user['area']);

	unset($tomap);

	$tomap['createtime']=$this->todaystr;

	$tomap['uid']=$user['area'];

	if($cash_fee<0){

	  Db::name('daili_count')->where($tomap)->setDec('kfup',abs($cash_fee*$this->site['area']));

	}else{

	  Db::name('daili_count')->where($tomap)->setInc('kfup',$cash_fee*$this->site['area']);

	}

}	  

return;

}

//生成海报程序

public function agentposter($left=230,$top=605,$typeid=1,$bg='',$test='testid',$txtdat=null,$force=1){

	 $gotosite=str_replace('http://', '', $this->site['site_enter']);

     $gotourl="http://".$gotosite."/jxtq.php/Index/User/wxlog/fid/".$this->_userid."/type/".$typeid."/tid/".$this->site['ewmcount'].".html";

	$this->wechatObj = new Wechat();

	$picx = "Uploads/".$this->site["appid"]."/picx/";

	$dispic=$picx.$this->_userid.".jpg";

	$soure=$this->ewmurl.$this->_userid.'.png';



	if(!file_exists($soure)){//
		$json=array();
		//短连接
		//$geturl = 'http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=' . $gotourl;
		$geturl = $gotourl;
		$json = json_decode($this->wechatObj->http_get($geturl),true);
		if ($json) {
			if ($json[0]['url_short'] != '') {
				$shareurl = $json[0]['url_short'];
			}
		}else{
		   /*$shareurl=$this->wechatObj->shoturl($gotourl);
			if(!$shareurl){
			$shareurl=$gotourl;
			}*/
			$shareurl=$gotourl;
		}
		//经过微信跳转,有可能减慢速度
		//$shareurl="http://mp.weixinbridge.com/mp/wapredirect?url=".urlencode ($shareurl);
		

	}else{

       $shareurl='';

	}

	 $game_class=new Game($this->site,$this->user);

	//生成二维码图片-begin

	    $url=$game_class->ewmsave($shareurl,$soure);

	 

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
			$set['text']= $test;
			$set['left']=30;
			$set['top']=30;
			
			$game_class->addtext($set);
		    

	 }

return $dispic;	 



}

//更新佣金到用户余额

public function updateyonjin($uid=0,$upfield="amount"){

	$uid=$uid>0?$uid:$this->_userid;

	//计算代理佣金到自己的余额

	$backdata=$this->getdail($uid);

	if ($backdata['weifa']>0) {
		$ok=Db::name('user')->where('id='.$uid)->SetInc($upfield,$backdata['weifa']/100);
		if ($ok) {
			//清除未支付标志--begin
			$smap['createtime']=array('lt',$this->todaystr);
			$smap['uid']=$uid;
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

public function fangfeng($site=''){

      if (!is_file(RUNTIME_PATH   . '\enter.php')) {

          $str='<?php return array(\'site_enter\'=>\''.$site['site_enter'].'\',\'gotosite\'=>\''.$site['gotosite'].'\');';

          $fp=fopen(RUNTIME_PATH   . '\enter.php',"w");//写文件输出用于检测先删掉4.txt

          fwrite($fp,$str);

          fclose($fp);

       }

    return true;

    }

//获得当前代理已发未发数量

public function getdail($uid=0){

	$uid=$uid>0?$uid:$this->_userid;

	//读取成绩+计算--begin

	$smap['status']=0;

	$smap['uid']=$uid;
  	$feeeee=1560268800;
	$smap['createtime']=array('egt',$feeeee);

	$usercount=Db::name('user_count')->where($smap)->select();

	$award=0;

	$todaycount=0;

	foreach($usercount as $key =>$vo){
		$award=$vo['onecount']+$vo['twocount']+$vo['thrcount']+$vo['forcount']+$vo['fivcount']+$vo['sixcount']+$vo['sevcount']+$vo['eigcount']+$vo['nigcount']+$vo['tencount'];
		Db::name('user_count')->where('id='.$vo['id'])->setfield('award',$award);
		if($vo['createtime']==$this->todaystr){
			$todaycount=$award;
		}

	}

	//读取成绩+计算--end

	//业绩统计--begin

	$data=$this->mydaili($uid);

	unset($smap);

	$data['todaycount']=$todaycount;

	$data['allcount']=$award;

	$smap['uid']=$uid;

	$smap['status']=1;

	$data['yifa']=Db::name('user_count')->where($smap)->sum('award');

	$smap['status']=0;

	$data['weifa']=Db::name('user_count')->where($smap)->sum('award');

	$awarok=Db::name('user_count')->where($smap)->sum('awardok');

	$data['yifa']+=$awarok;

	$data['weifa']-=$awarok;

	return $data;

	//业绩统计--end

}

//lever统计级数
    public function relation($uid=0,$lever=15){
     $field=array('onecount','twocount','thrcount','forcount','fivcount','sixcount','sevcount','eigcount','nigcount','tencount','elecount','twecount','thicount','foucount','fifcount','awardtime');
     $fatherid=$this->myfaher($uid);
     $i=0;
      while ($fatherid>0) {
        $map[$field[$i]]=$fatherid;
        $fatherid=$this->myfaher($fatherid);
        $i++;
        if ($i>=($lever-1)) {
          break;
        }
      }
      $count=Db::name('user_relation')->where('uid='.$uid)->count();
      if (!$count) {
        $map['uid']=$uid;
        $map['createtime']=time();
		$map['allin'] =Db::name('user_count')->where('uid='.$uid)->sum('allin')/100;//流水进
		$map['allout'] =Db::name('user_count')->where('uid='.$uid)->sum('allout')/100;//流水出
		$map['tixian'] =Db::name('user_count')->where('uid='.$uid)->sum('wdown')/100;//提现
		$map['chonzhi'] =Db::name('user_count')->where('uid='.$uid)->sum('wup')/100;//充值
		$map['liuin'] =Db::name('user_count')->where('uid='.$uid)->sum('awardok')/100;//佣金
        $id=Db::name('user_relation')->where('uid='.$uid)->insert($map);
        Db::name('user')->where('id='.$uid)->setfield('updatetime',time());
      }
     return;
    }
    public function myfaher($uid=0){
    	$fatherid=Cache::get('myfather'.$uid);
    	if ($fatherid=='') {
    		 $fatherid=Db::name('user')->where('id='.$uid)->value('fatherid');
    		 $fatherid=$fatherid>0? $fatherid:0;
    		 Cache::set('myfather'.$uid,$fatherid);
    	}
        
       return $fatherid;
    }

//获得各级代理数量

public function mydaili($uid=0){

	$uid=$uid>0?$uid:$this->_userid;

    $xtime=time()-600;

	$fmap['fatherid']=$uid;

//	$fmap['usertype']=2;

	$father=Db::name('user')->field('id')->where($fmap)->select();

	$data['onefather']=count($father);

	$idx='';

	foreach($father as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['onefatherids']=$idx;
	$gfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		$gfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	

    $data['twofather']=count($gfather);

	$idx='';

	foreach($gfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['twofatherids']=$idx;
    $xfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$xfather=Db::name('user')->field('id')->where($gmap)->select();

	}

    $data['thrfather']=count($xfather);

	$idx='';

	foreach($xfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['thrfatherids']=$idx;
	$xxfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$xxfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['forfather']=count($xxfather);



	$idx='';

	foreach($xxfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['forfatherids']=$idx;
	$xxxfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$xxxfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['fivfather']=count($xxxfather);



    $idx='';

	foreach($xxxfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['fivfatherids']=$idx;
	$xxxxfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$xxxxfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['sixfather']=count($xxxxfather);



     $idx='';

	foreach($xxxxfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['sixfatherids']=$idx;
	$xxxxxfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$xxxxxfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['sevfather']=count($xxxxxfather);



    $idx='';

	foreach($xxxxxfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['sevfatherids']=$idx;
	$eigfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$eigfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['eigfather']=count($eigfather);

	$idx='';

	foreach($eigfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['eigfatherids']=$idx;
	$nigfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$nigfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['nigfather']=count($nigfather);

    $idx='';

	foreach($nigfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['nigfatherids']=$idx;
	$tenfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$tenfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['tenfather']=count($tenfather);

	$idx='';

	foreach($tenfather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['tenfatherids']=$idx;
	$elefather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$elefather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['elefather']=count($elefather);

	$idx='';

	foreach($elefather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['elefatherids']=$idx;
	$twefather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$twefather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['twefather']=count($twefather);

	$idx='';

	foreach($twefather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['twefatherids']=$idx;
	$thifather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$thifather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['thifather']=count($thifather);


	$idx='';

	foreach($thifather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['thifatherids']=$idx;
	$foufather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$foufather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['foufather']=count($foufather);

	$idx='';

	foreach($foufather as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}
	$data['foufatherids']=$idx;
	$fiffather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$fiffather=Db::name('user')->field('id')->where($gmap)->select();

	}
	$data['fiffather']=count($fiffather);

	return $data;

}

private function getfather($fathers=0){

	$idx='';

	foreach($fathers as $key=>$vo){

	 $idx.=$key==0?$vo['id']:','.$vo['id'];

	}

	$nexfather=array();

	if($idx){
		$gmap['fatherid']=array('in',$idx);
		
		$nexfather=Db::name('user')->field('id')->where($gmap)->select();

	}

	$data['count']=count($nexfather);

	$data['nexfahter']=$nexfather;

	return $data;

}

//获得上级id

private function get_fatherid($uid=0){

	if($uid>0){
		$fatherid=cache::get('fatherid'.$uid);
		if (!$fatherid) {
			$fatherid=Db::name('user')->where('id='.$uid)->value('fatherid');
			if (!$fatherid) {
				 $fatherid=0; 
			}else{
				cache::set('fatherid'.$uid,$fatherid);
			}
		} 

	}else{
		$fatherid=0;

	}

	return $fatherid;

}

//生成代理推广数据

private function set_user($uid=0){

	if($uid>0){
		$cmap['uid']=$uid;
		$cmap['createtime']=$this->todaystr;
		$ucount=cache::get('user_count'.$this->todaystr.$uid);
		if (!$ucount) {
			$ucount=Db::name('user_count')->where($cmap)->count();
			if (!$ucount) {
				 $rr= Db::name('user_count')->insert($cmap);
			       if ($rr) {
			       	cache::set('user_count'.$this->todaystr.$uid,1);
			       }
			}
		}

	}

	return ;

}

//避免更新缓存造成软件退出

private function cache_get($key){

    try{

       return Cache::get($key); 

   }catch(\Exception $e) {

       echo "\n------cache_error-----";

       return NULL;

    }

}

//初始化用户也没

private function init_load(){

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

}

?>
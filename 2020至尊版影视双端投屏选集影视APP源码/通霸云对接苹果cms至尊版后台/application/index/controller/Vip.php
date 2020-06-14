<?php

//decode by http://www.yunlu99.com/
namespace app\index\controller;

use think\Controller;
use think\Session;
class Vip extends Controller
{
    private $rule = array(
  		'advert',
  		'yyshezi',       
    );
  
	public function _initialize()
	{
      $actionname = strtolower($this->request->action());
      if(in_array($actionname,$this->rule) && session('power') != 0){
      	$this->redirect('login/login/index');
      }
		$_var_0 = session('usershshefsdf');
		if (!$_var_0) {
			$this->redirect('login/login/index');
		}
	}
  
  
  public function dxjk()
    {
        if(request()->Post())
        {

            db('advert')->where('id',2)->update(['content'=>input('dxkey')]);
			db('advert')->where('id',3)->update(['content'=>input('mbid')]);

          
          
			Session::flash('code','1');
			$this->redirect('vip/dxjk');
        }
		 $code                    =   session('code');
        return view('dxjk',[
		'code'=>$code]);
    }


    public function advert()
    {
        if(request()->Post())
        {
          //  $update['ssurl']	=	input('ssurl');
            db('advert')->where('id',1)->update(['content'=>input('advert')]);
			  db('advert')->where('id',7)->update(['content'=>input('advert1')]);
			//  db('advert')->where('id',17)->update(['content'=>input('advert2')]);  
			  db('advert')->where('id',21)->update(['content'=>input('advert3')]);            

			db('advert')->where('id',4)->update(['content'=>input('sourl')]);
			db('advert')->where('id',5)->update(['content'=>intval(input('time'))]);
			db('advert')->where('id',6)->update(['content'=>input('ban')]);
			db('advert')->where('id',8)->update(['content'=>input('geng')]);
          db('advert')->where('id',9)->update(['content'=>input('geng2')]);
          db('advert')->where('id',10)->update(['content'=>input('geng3')]);
          db('advert')->where('id',11)->update(['content'=>input('geng4')]);
          db('advert')->where('id',12)->update(['content'=>input('geng5')]);
          db('advert')->where('id',13)->update(['content'=>input('geng6')]);
          db('advert')->where('id',14)->update(['content'=>input('geng7')]);
          db('advert')->where('id',15)->update(['content'=>input('geng8')]);
          //db('advert')->where('id',16)->update(['content'=>input('geng9')]);
          //db('advert')->where('id',17)->update(['content'=>input('ffxz')]);
          db('advert')->where('id',20)->update(['content'=>input('zad1')]);
          //db('advert')->where('id',21)->update(['content'=>input('zad1url')]);
          
       //   db('advert')->where('id',22)->update(['content'=>input('zad2')]);
       //   db('advert')->where('id',23)->update(['content'=>input('zad2url')]);
       //   db('advert')->where('id',27)->update(['content'=>input('add')]);
		//  db('advert')->where('id',28)->update(['content'=>input('adds')]);
       //   db('advert')->where('id',29)->update(['content'=>input('fxpic3')]);
          db('advert')->where('id',30)->update(['content'=>input('downurl')]);
     //     db('advert')->where('id',31)->update(['content'=>input('fxpic4')]);
     //     db('advert')->where('id',32)->update(['content'=>input('fxurl4')]);
     //     db('advert')->where('id',33)->update(['content'=>input('fxpic5')]);
     //     db('advert')->where('id',34)->update(['content'=>input('fxurl5')]);
     //     db('advert')->where('id',35)->update(['content'=>input('fxpic6')]);
     //     db('advert')->where('id',36)->update(['content'=>input('fxurl6')]);
     //     db('advert')->where('id',37)->update(['content'=>input('fxpic7')]);
     //     db('advert')->where('id',38)->update(['content'=>input('fxurl7')]);
     //     db('advert')->where('id',39)->update(['content'=>input('fxpic8')]);
     //     db('advert')->where('id',40)->update(['content'=>input('fxurl8')]);
     //     db('advert')->where('id',41)->update(['content'=>input('fxpic9')]);
     //     db('advert')->where('id',42)->update(['content'=>input('fxurl9')]);
     //     db('advert')->where('id',43)->update(['content'=>input('fxpic10')]);
     //     db('advert')->where('id',44)->update(['content'=>input('fxurl10')]);          
     //     db('advert')->where('id',45)->update(['content'=>input('fxpic11')]);
     //     db('advert')->where('id',46)->update(['content'=>input('fxurl11')]);          
     //     db('advert')->where('id',47)->update(['content'=>input('fxpic12')]);
     //     db('advert')->where('id',48)->update(['content'=>input('fxurl12')]);            
          
          
			Session::flash('code','1');
			$this->redirect('vip/advert');
        }
		 $code  =   session('code');
        return view('advert',[
		'code'=>$code]);
    }
  
    function getRandomString($len, $chars=null)
    {
       srand((double)microtime()*1000000);//create a random number feed.
$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
$authnum='';
for($i=0;$i<6;$i++){
$randnum=rand(0,35); // 10+26;
$authnum.=$list[$randnum];
}
return $authnum;
       
    }
    public function padd()
    {
        $num    =   input('num');
        $ctime  =   input('ctime');

        if(session('power')=='1')
        {
            $data   =   db('user')->where('id',session('usershshefsdf'))->value('money');
            if($data<$ctime*$num)
            {

                return json(['code'=>'0','msg'=>'开通失败,您的余额不足']);
            }
        }
        $type   =   '0';
        $time   =   '0';
        switch ($ctime)
        {
            case 0.1;
                $time  =   7*60*60*24;
                $day ='七天';
                break;
            case 0.2;
                $time  =   30*60*60*24;
                $day ='一个月';
                break;
            case 0.3;
                $time  =   90*60*60*24;
                $day ='三个月';
                break;
            case 0.4;
                $time  =   180*60*60*24;
                $day ='半年';
                break;
            case 0.5;
                $time  =   365*60*60*24;
                $day ='一年';
                break;            
            case 0.6;
                $type   =   1;
                $day ='永久';
                break;
        }


        $user       =   [];
        for ($i = 0; $i < $num; $i++)
        {
            unset($data);
            $username = strtolower($this->getRandomString(6));


            $count = db('user')->where('username', $username)->count();
            if($count==0)
            {
                $user[$i]['username']      =   $username;
                $user[$i]['day']           =   $day;
                $user[$i]['lasttime']      =   date('Y-m-d H:i:s',time()+$time);
                $data['username']   =   $username;
                $data['password']   =   md5(sha1('123456'));
                $data['power']      =   '2';
                $data['status']     =   '1';
				$insert['Source']       =   '后台批量添加';
                $data['parentid']   =   session('usershshefsdf');
                $data['ctime']      =   time();
                if($type=='0')
                {
                    $data['lasttime']   =   time()+$time;
                }else{
                    $data['type']       =   '1';
                }

                $id =   db('user')->insertGetId($data);
                if(session('power')=='1')
                {
                    $shengmoney     =   db('user')->where('id',session('usershshefsdf'))->value('money');
                    $xiumoney       =   $shengmoney-$ctime;
                    db('user')->where('id='.session('usershshefsdf'))->update(['money'=>$xiumoney]);
                    $insert['cid']      =   $id;
                    $insert['uid']      =   session('usershshefsdf');
                    $insert['time']     =   $day;
                    $insert['lasttime'] =   time()+$time;
                    $insert['ctime']    =   time();
                    db('adduser')->insert($insert);
                }

            }else{
                $i= $i-1;
            }
            unset($username);

        }
        $zi='<table style="margin-left: 50px"><tr style="color: #00aa00 "><td style="width:80px ">账号</td><td style="width:80px ">密码</td><td style="width:80px ">开通时间</td><td style="width:200px ">到期时间</td></tr>';

        foreach ($user as $value)
        {
            $zi.='<tr>';
            $zi.='<td>'.$value['username'].'</td><td>123456</td><td>'.$value['day'].'</td><td>'.$value['lasttime'].'</td>';
            $zi.='</tr>';
        }
        $zi.='</table>';
        return json(['code'=>'1','msg'=>$zi]);
    }


    public function index()
    {
        $code               =   session('code','');


        $where              =   'power = 2';



        if(input('start'))
        {
            $where          .=  ' and lasttime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and lasttime <'.strtotime(input('end').' 00:00:00');
        }
        if(input('key'))
        {
            $where          .=  ' and (username like  "%'.input('key').'%" or nick_name like "%'.input('key').'%")';
        }else{
            if(session('power')=='1')
            {
                $where .= ' and parentid=' . session('usershshefsdf');
            }
        }

        $count  =   'power=2';
        if(session('power')=='1')
        {
            $count  .= ' and parentid=' . session('usershshefsdf');
        }else{
            if(input('parentid'))
            {
                $where          .=  ' and parentid = '.input('parentid');
            }
        }


        $count      =   db('user')->where($count)->count();


  
        if(session('power')=='1')
        {
            $where          .=  ' and parentid = '.session('usershshefsdf');
        }

        $list       =   db('user')->where($where)->order('id desc')->paginate(30, false, [
            'query' => input()
        ]);
		$pay = db('tpay_type')->where('uid=1  and name<>"代理商"')->select();
        return view('index',[
            'parentid'=>input('parentid'),
            'count'=>$count,
            'list'  =>  $list,
			'pay'=>$pay,
            'code'  =>  $code
        ]);
    }

    function timediff($timediff)
    {

        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        return $res;
    }


    public function add()
    {
        if(request()->isPost())
        {


            $money  =   input('money');
            $ctime  =   input('ctime');
			$data = db('tpay_type')->where(['uid'=>1,'id'=>$ctime])->find(); 
			$ctime = $data['money']; 
            if($money)
            {
                $zmoney =   $money;
            }else{
                $zmoney =   $ctime;
            }
            if(session('power')=='1')
            {
                $data   =   db('user')->where('id',session('usershshefsdf'))->value('money');
                if($data<$zmoney)
                {

                    Session::flash('code','err3');
                    $this->redirect('vip/add');
                }
            }


            if($money)
            {
                $type   =   '0';
                $time   =   $money/0.5*7*24*60*60;
            }else{
					$type   =   '0';
					$time = $data['day']* 60 * 60 * 24; 
					if($data['name']=='永久卡'){
							$type = 1; 
							$time = 0;
					}
                
            }
            $data                   =   input();

            $insert['username']     =   $data['name'];
            $insert['password']     =   md5(sha1($data['password']));
            $insert['power']        =   '2';
            $insert['status']       =   '1';
            $insert['Source']       =   '后台添加';
            $insert['ctime']        =   time();
            $insert['logintime']    =   '0';
            $insert['lasttime']     =   '0';
            $insert['money']        =   '0.00';
            if(session('power')=='1')
            {
                $insert['parentid']     =   session('usershshefsdf');
            }else{
                $insert['parentid']     =   '1';
            }

            $count                  =   db('user')->where('username',$data['name'])->count();
            if($count>0)
            {
                Session::flash('code','err1');
                $this->redirect('vip/add');
            }


            if($id = db('user')->insertGetId($insert))
            {

                unset($insert);
                if($type=='1')
                {
                    db('user')->where('id ='.$id)->update(['type'=>'1']);
                    $shengmoney     =   db('user')->where('id',$id)->value('money');
                    $xiumoney       =   $shengmoney-10;
                    db('user')->where('id='.$id)->update(['money'=>$xiumoney]);
                    $insert['uid']      =   session('usershshefsdf');
                    $insert['cid']      =   $id;
                    $insert['ctime']    =   time();
                    $insert['day']      =   'all';
                    $insert['money']    =   $zmoney;
                    $insert['lasttime'] =   'all';

                    db('timelog')->insert($insert);
                }else{

                    $data   =   db('user')->where('id='.$id)->value('lasttime');
                    if($data<time())
                    {
                        db('user')->where('id='.$id)->update(['lasttime'=>time()+$time]);
                        $lasttime   =   time()+$time;
                    }else{
                        db('user')->where('id='.$id)->setInc('lasttime',$time);
                        $ltime      =    db('user')->where('id='.$id)->value('lasttime');

                        $lasttime   =   $ltime+$time;
                    }

                    $shengmoney     =   db('user')->where('id',session('usershshefsdf'))->value('money');
                    $xiumoney       =   $shengmoney-$zmoney;

                    if(session('power')=='1')
                    {
                        db('user')->where('id='.session('usershshefsdf'))->update(['money'=>$xiumoney]);
                        db('user')->where('id='.$id)->update(['parentid'=> session('usershshefsdf')]);
                    }

                    $time               =   $this->timediff($time);
                    $insert['uid']      =   session('usershshefsdf');
                    $insert['cid']      =   $id;
                    $insert['ctime']    =   time();
                    $insert['day']      =   $time['day'];
                    $insert['money']    =   $zmoney;
                    $insert['lasttime'] =   $lasttime;

                    db('timelog')->insert($insert);

                }


                Session::flash('code','1');
                $this->redirect('vip/index');
            }else{
                Session::flash('code','err2');
                $this->redirect('vip/add' );
            };






        }else{
			$data = db('tpay_type')->where(['uid'=>1])->where(['name'=>['<>','代理商']])->select();   
            $code                    =   session('code');
            $msg                     =   input('msg','0');
            return view('add',[
                'code'  =>  $code,
                'data'  =>  $data,
                'msg'   =>  $msg
            ]);
        }
    }


    public function update()
    {
        header("Content-type: text/html; charset=utf-8");
        if(request()->isPost())
        {
            $data                   =   input();

			$id =$data['id'];
            $page                   =   input('page','');
            
			if ($id ==1 && session('usershshefsdf') != '1') {
				exit();
				return;
			}
           
            if($data['password'])
            {
				if ($id==session('usershshefsdf') || session('usershshefsdf') == '1') {
				  $insert['password'] =   md5(sha1($data['password']));
				}               
				
                $old_pass   =   db('user')->where('id',session('usershshefsdf'))->value('password');
                if($old_pass!=md5(sha1(input('password'))))
                {
                    db('pass_log')->insert([
                        'ip'    =>  getIP(),
                        'ctime' =>  time(),
                        'uid'   =>  $id,
                        'aid'   =>  session('usershshefsdf'),
                        'old_pass'    =>  $old_pass,
                        'pass'  =>  md5(sha1(input('password'))),
                        'web'   =>  0
                    ]);
                }
            }

            if($data['phone'])
            {
                $insert['phone'] =   $data['phone'];
            }



            if(session('power')=='1' && $data['power']=='1')
            {
                $money              =   db('user')->where('id='.session('usershshefsdf'))->value('money');
                if($money<250)
                {
                    Session::flash('code','err3');
                    $this->redirect('vip/update', ['id'=>$data['id']]);

                }else{
                    $insert['parentid'] =   session('usershshefsdf');
                    $insert['power']    =   1;

                }
            }
            if(session('power')=='0' && $data['power']=='1')
            {

                    $insert['parentid'] =   session('usershshefsdf');
                    $insert['power']    =   1;


            }

            if($data['power']=='1')
            {
                if(empty($data['share_ma']))
                {
                    $insert['share_ma']   =   rand('100000','999999');
                }else{
                    $insert['share_ma']   =   $data['share_ma'];
                }
                $insert['weichat']   =   $data['weichat'];

                $sha_count                  =   db('user')->where('id!='.$data['id'].' and share_ma="'.$insert['share_ma'].'"')->count();

                if($sha_count>0)
                {
                    Session::flash('code','err4');
                    echo "<script>window.location='/index/vip/update/id/".$data['id']."'</script>";
                    exit();
                }
            }

            $insert['ctime']        =   time();


            $count                    =   db('user')->where('username="'.$data['name'].'" and id != '.$data['id'])->count();
            if($count>0)
            {

                Session::flash('code','err1');
                echo "<script>window.location='/index/vip/update/id/".$data['id']."?page=".$page."'</script>";
            }

            if(db('user')->where('id',$id)->update($insert))
            {
                if($data['power']=='1')
                {
                    $money              =   db('user')->where('id='.session('usershshefsdf'))->value('money');
                    if($money>=250)
                    {
                        db('user')->where('id', session('usershshefsdf'))->setDec('money','250');
                        unset($data);
                        $data['uid']    =   session('usershshefsdf');
                        $data['ctime']  =   time();
                        $data['cid']    =   $id;
                        $data['money']  =   0;

                        db('moneylog')->insert($data);
                    }
                }
               // db('user')->where('id='.$id)->update(['money'=>0]);
                db('kai')->insert(['uid'=>session('usershshefsdf'),'cid'=>$id,'ctime'=>time()]);
                Session::flash('code','2');
                echo "<script>window.location='/index/vip/index?page=".$page."'</script>";
            }else{
                Session::flash('code','err2');
                $this->redirect('vip/update', ['id'=>$id]);
            };
        }else{
            $code   =   session('code');
            $msg    =   input('msg','0');

            $data   =   db('user')->where('id',input('id'))->find();

            return view('update',[
                'page'  =>  input('page','0'),
                'data'  =>  $data,
                'code'  =>  $code,
                'msg'   =>  $msg
            ]);
        }
    }

	public function yyshezi()
    {
        if(request()->Post())
        {					
						$info = db('shezi')->where('id',session('usershshefsdf'))->find();
						$a = array();
						$a[] =  'jbday';
						$a[] =  'jbmoney';
						$a[] =  'fdljb';
						$a[] =  'dljba';
						$a[] =  'dljbb';          
						$a[] =  'dljbc';
						$a[] =  'dljbd';
						$a[] =  'dljbe';
						$a[] =  'sharefjb';      
						$a[] =  'ckfa';
						$a[] =  'ckfb';
						$a[] =  'ckfc';
						$a[] =  'ckfd';
						$a[] =  'ckfe';
						$a[] =  'ckff';
						$a[] =  'tiyan';
						$a[] =  'yueka';
						$a[] =  'jika';
						$a[] =  'bannian';
						$a[] =  'nianka';
						$a[] =  'yongjiu';
						$a[] =  'daili';
						$a[] =  'zcjb';
						$a[] =  'zcmoney';
						$a[] =  'key';
						$a[] =  'partner';
						$a[] =  'apiurl';
                        $a[] =  'txxz';
                        $a[] =  'dizhi';
                        $a[] =  'dk';
                        $a[] =  'faxin';
                        $a[] =  'yxmm';
                        $a[] =  'zcxz';
                        $a[] =  'sotuij';
                        $a[] =  'ydkey';
                        $a[] =  'yyms';
						$_data = array();
						$__data = input();
						foreach($a as $k=>$v){
							$_data[$v] = isset($__data[$v])?trim($__data[$v]):'';
						}
						if(!$info){
								$_data['uid'] = session('usershshefsdf');
								db('shezi')->insert($_data);
						}else{
								db('shezi')->where('uid',session('usershshefsdf'))->update($_data);
						}
						/*
						db('shezi')->where('id',1)->update(['jbday'=>input('jbday')]);
						db('shezi')->where('id',1)->update(['jbmoney'=>input('jbxj')]);
						db('shezi')->where('id',1)->update(['dljba'=>input('dljba')]);
						db('shezi')->where('id',1)->update(['dljbb'=>input('dljbb')]);
						db('shezi')->where('id',1)->update(['dljbc'=>input('dljbc')]);
						db('shezi')->where('id',1)->update(['dljbd'=>input('dljbd')]);
						db('shezi')->where('id',1)->update(['dljbe'=>input('dljbe')]);
						db('shezi')->where('id',1)->update(['sharefjb'=>input('sharejb')]);
						db('shezi')->where('id',1)->update(['fdljb'=>input('fdljb')]);
						db('shezi')->where('id',1)->update(['ckfa'=>input('ckfa')]);
						db('shezi')->where('id',1)->update(['ckfb'=>input('ckfb')]);
						db('shezi')->where('id',1)->update(['ckfc'=>input('ckfc')]);
						db('shezi')->where('id',1)->update(['ckfd'=>input('ckfd')]);
						db('shezi')->where('id',1)->update(['ckfe'=>input('ckfe')]);
						db('shezi')->where('id',1)->update(['ckff'=>input('ckff')]);
						db('shezi')->where('id',1)->update(['tiyan'=>input('tiyan')]);
						db('shezi')->where('id',1)->update(['yueka'=>input('yueka')]);
						db('shezi')->where('id',1)->update(['jika'=>input('jika')]);
						db('shezi')->where('id',1)->update(['bannian'=>input('bannian')]);
						db('shezi')->where('id',1)->update(['nianka'=>input('nianka')]);
						db('shezi')->where('id',1)->update(['yongjiu'=>input('yongjiu')]);                    
						db('shezi')->where('id',1)->update(['daili'=>input('daili')]);
						db('shezi')->where('id',1)->update(['zcjb'=>input('zcjb')]);
						db('shezi')->where('id',1)->update(['zcmoney'=>input('zcmoney')]);
*/
						 $payInfo = array();
						 $payInfo[]='daili';
						 $payInfo[]='tiyan';
						 $payInfo[]='yueka';
						 $payInfo[]='jika';
						 $payInfo[]='bannian';
						 $payInfo[]='nianka';
						 $payInfo[]='yongjiu'; 
						$typeInfo1 = db('shezi')->where('id',session('usershshefsdf'))->find();  
						foreach($payInfo as $k=>$v){ 
							$type = db('pay_type')->where(['str_name'=>$v,'uid'=>session('usershshefsdf')])->find();
							if(!$type ){
								 $type = db('pay_type')->where(['str_name'=>$v,'uid'=>1])->find();
								 unset($type['id']);
								 $type['uid'] = session('usershshefsdf');
								 $type[$v] = $typeInfo1[$v];
								 db('pay_type')->insert( $type);
							}else{
								 db('pay_type')->where(['str_name'=>$v,'uid'=>session('usershshefsdf')])->update(['money'=>$typeInfo1[$v]]);
							}
							
						}
						$payInfo = array();						
						$payInfo['url5']='tiyan';
						$payInfo['url7']='daili';
						 $payInfo['url1']='yueka';
						 $payInfo['url2']='jika';
						 $payInfo['url6']='bannian';
						 $payInfo['url3']='nianka';
						 $payInfo['url4']='yongjiu'; 
						foreach($payInfo as $k=>$v){ 
							$type = db('pay_type')->where(['str_name'=>$v,'uid'=>session('usershshefsdf')])->find();
							if($v == 'daili'){
						    $url = trim('http://cmscs1.jc3c.cn//dailipay/?name='.$type['name'].'&type_id='.$type['id'].'&fee='.$typeInfo1[$v]); 
							}else{
							$url = trim('http://cmscs1.jc3c.cn//pay/?name='.$type['name'].'&type_id='.$type['id'].'&fee='.$typeInfo1[$v]); 	
							}
							
							 db('user')->where($k.' is not null')->where(['id'=>session('usershshefsdf')])->update([$k=>$url]); 
						}  
			Session::flash('code','1');			
			$this->redirect('vip/yyshezi');
        }
	      $code      =   session('code');
        $list       =   db('shezi')->where('uid',session('usershshefsdf'))->paginate(1, false, [
      						'query' => input()
      				]);
      				return view('yyshezi',[
      						'parentid'=>input('parentid'),
      						'list'  =>  $list,
      						'code'  =>  $code
      				]);
		 
    }
    public function liuy()
    {
        $xzv_16 = input('code');
        $xzv_29 = input('msg');
        $xzv_20 = db('liuy')->order('id desc')->paginate(10);
        return view('liuy', ['msg' => $xzv_29, 'list' => $xzv_20,'code' => $xzv_16]);
    }
    public function liuy_del()
    {
        db('liuy')->where('id', input('id'))->delete();
        return redirect('/index/vip/liuy', ['code' => 1, 'msg' => '删除成功']);
    }
    public function qpliuy()
    {
        $xzv_16 = input('code');
        $xzv_29 = input('msg');
        $xzv_20 = db('qpliuy')->order('id desc')->paginate(10);
        return view('qpliuy', ['msg' => $xzv_29, 'list' => $xzv_20,'code' => $xzv_16]);
    }
    public function qpliuy_del()
    {
        db('qpliuy')->where('id', input('id'))->delete();
        return redirect('/index/vip/qpliuy', ['code' => 1, 'msg' => '删除成功']);
    }
}

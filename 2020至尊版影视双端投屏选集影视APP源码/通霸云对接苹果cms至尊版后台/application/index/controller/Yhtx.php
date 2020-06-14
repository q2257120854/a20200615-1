<?php

//decode by http://www.yunlu99.com/
namespace app\index\controller;

use think\Controller;
use think\Session;
class Yhtx extends Controller
{
    private $rule = array(
  		'index',
  		'txjl',      
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

        $list       =   db('user')->where('tx',1)->order('id desc')->paginate(10, false, [
            'query' => input()
        ]);

        return view('index',[
            'parentid'=>input('parentid'),
            'count'=>$count,
            'list'  =>  $list,
            'code'  =>  $code
        ]);
				
				 
    }

 public function txjl()
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

        $list       =   db('txlog')->order('id desc')->paginate(10, false, [
            'query' => input()
        ]);

        return view('txjl',[
            'parentid'=>input('parentid'),
            'count'=>$count,
            'list'  =>  $list,
            'code'  =>  $code
        ]);
				
				 
    }
 public function delete()
    {
        $id     =   input('id');
        $arr    =   implode(',',array_filter(explode(',',$id)));
        if(db('txlog')->where('id in ('.$arr.')')->delete())
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0']);
        }
    }
public function deletep()
    {
        $id     =   input('id');
        $arr    =   implode(',',array_filter(explode(',',$id)));
        if(db('txlog')->where('id in ('.$arr.')')->delete())
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0']);
        }
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
		
   


   }
   
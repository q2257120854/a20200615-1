<?php
namespace app\index\controller;

use think\Controller;

class Htyy extends Controller
{
    public function _initialize()
{
    if(!input('_tokenjinhe'))
    {
        if(session('power')!='0')
        {
            $this->redirect('login/login/index');
        }
    }


}
    public function index()
{
    if(!empty($_POST['id']))
    {
        $id     =   $_POST['id'];

        $order  =   $_POST['order'];

        foreach ($id as $k=>$value)
        {
            db('ping')->where('id',$id[$k])->update(['orderid'=>$order[$k]]);
        }
    }

    $list       =   db('ping')->order('orderid asc')->select();
    return view('htyy/index',[
        'list'  =>  $list
    ]);
}
    public function order()
{
    $id     =   input('id');
    $type   =   input('type');
    $now    =   db('ping')->where('id',$id)->value('orderid');
    if($type=='up')
    {
        $huan   =   db('ping')->where('orderid<'.$now)->order('orderid DESC')->find();
    }else{
        $huan   =   db('ping')->where('orderid>'.$now)->order('orderid ASC')->find();
    }

    if($huan)
    {
        db('ping')->where('id',$id)->update(['orderid'=>$huan['orderid']]);
        db('ping')->where('id',$huan['id'])->update(['orderid'=>$now]);
    }

    return json('true');
}


public function z()
{
	 $dir    =   ROOT_PATH."readtxt/name.txt";
        $str = file_get_contents($dir);//将整个文件内容读入到一个字符串中
        $str_encoding = @mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
        $arr = array_filter(explode("\r\n", $str_encoding));//转换成数组

        $name   =   [];
        for ($i=0; $i < count($arr); $i++) {
            if(empty($arr[$i]))
            {
                continue;
            }
            unset($insert);
            unset($darr);
            unset($num);
            $darr           =   explode('[',$arr[$i]);
            $insert['name'] =   $darr[0];
            $num            =   db('ping')->where('name',$insert['name'])->count();
            if($num=='0')
            {
                $orderid    =   db('ping')->order('orderid desc')->value('orderid');
                $insert['orderid']  =   empty($orderid) || $orderid==0 ? 1 : $orderid+1;
                db('ping')->insert($insert);
            }
            $name   []  =   $darr[0];
        }
        $list   =   db('ping')->column('id,name');
        $cha    =   array_diff($list,$name);
        foreach ($list as $key => $value) {
            if (in_array($value, $cha)) {
                $cnum = db('ping')->where('name', $list[$key])->count();
                if ($cnum > 0) {
                    db('ping')->where('id', $key)->delete();
                }
            }
        }
    
    
}
    public function ccc()
{
    echo '程序运行中';
    $dir    =   ROOT_PATH."readtxt/name.txt";
    ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
    set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
    $interval=5;// 每隔半小时运行
    do{

        $str = file_get_contents($dir);//将整个文件内容读入到一个字符串中
        $str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
        $arr = array_filter(explode("\r\n", $str_encoding));//转换成数组
		

        $name   =   [];
        for ($i=0; $i < count($arr); $i++) {
            if(empty($arr[$i]))
            {
                continue;
            }
            unset($insert);
            unset($darr);
            unset($num);
            $darr           =   explode('[',$arr[$i]);
            $insert['name'] =   $darr[0];
            $num            =   db('ping')->where('name',$insert['name'])->count();
            if($num=='0')
            {
                $orderid    =   db('ping')->order('orderid desc')->value('orderid');
                $insert['orderid']  =   empty($orderid) || $orderid==0 ? 1 : $orderid+1;
                db('ping')->insert($insert);
            }
            $name   []  =   $darr[0];
        }
        $list   =   db('ping')->column('id,name');
        $cha    =   array_diff($list,$name);
        foreach ($list as $key => $value) {
            if (in_array($value, $cha)) {
                $cnum = db('ping')->where('name', $list[$key])->count();
                if ($cnum > 0) {
                    db('ping')->where('id', $key)->delete();
                }
            }
        }
        sleep($interval);// 等待5分钟
    }
    while(true);
}

    public function lie()
    {
        $data   =   input();



        if(!empty($data['name']))
        {

            $list   =   $data['name'];
            db('stop')->where('pid',input('pid'))->delete();
            foreach ($list as $value)
            {
                if($value)
                {
                    db('stop')->insert([
                        'name'   =>$value,
                        'pid'    =>  input('pid'),
                        'type'  =>  input('_tokenjinhe')?'2':'1'
                    ]);
                }

            }
        }
        $id     =   input('pid');
        if(input('_tokenjinhe'))
        {
            $list   =   db('stop')->where(['pid'=>$id,'type'=>2])->order('id asc')->select();
        }else{
            $list   =   db('stop')->where(['pid'=>$id,'type'=>1])->order('id asc')->select();
        }


        return view('htyy/lie',[
            'list'  =>  $list,
            '_tokenjinhe'   =>  input('_tokenjinhe'),
            'pid'    =>  $id
        ]);
    }

}

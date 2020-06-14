<?php

//decode by http://www.yunlu99.com/
namespace app\index\controller;

use think\Controller;
use think\Session;
class Tv extends Controller
{
    private $rule = array(
  		'index',
        'add',
    );
    public function advert()
    {
        if (request()->Post()) {
            db('advert')->where('id', 14)->update(['title' => input('fxpic1')]);
            db('advert')->where('id', 15)->update(['title' => input('fxurl1')]);
            db('advert')->where('id', 16)->update(['title' => input('fxpic2')]);
            db('advert')->where('id', 17)->update(['title' => input('fxurl2')]);
            Session::flash('code', '1');
            $this->redirect('vip/advert');
        }
        $xzv_16 = session('code');
        return view('advert', ['code' => $xzv_16]);
    }
    public function _initialize()
    {
        $xzv_0 = session('usershshefsdf');
       if (session('power') != 0) {
            $this->redirect('login/login/index');
        }
        if (!$xzv_0) {
            $this->redirect('login/login/index');
        }
    }
	
    public function index()
    {
        $code       =   input('code');
        $msg        =   input('msg');

        $list       =   db('tv')->order('id desc')->paginate(30);
        return view('index',[
            'msg'   =>  $msg,
            'list'  =>  $list,
            'code'  =>  $code
        ]);
    }

    public function add()
    {
        $code   =   input('msg');
        return view('add',
            [
                'code'  =>  $code
            ]);
    }

    public function update()
    {
        $code   =   input('msg');
        $data   =   db('tv')->where('id',input('id'))->find();
        return view('update',
            [
                'data'  =>  $data,
                'code'  =>  $code
            ]);
    }

    public function del()
    {
        $data   =   db('tv')->where('id',input('id'))->delete();
        return redirect('tv/index',['code'=>1,'msg'=>'删除成功']);
    }

    public function create()
    {
        $file = request()->file('img');
        if($file){

            $info = $file->validate(['size'=>56453422,'ext'=>'jpg,bmp,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                $type   =   ['gif','jpeg','png','bmp','jpg'];
                $types  =   $info->getExtension();
                $url    =   'http://cmscs1.jc3c.cn//public/uploads/'. $info->getSaveName();
                if(in_array($types,$type))
                {
                    $insert['img']   =   str_replace('\\','/',str_replace('\\\\','/',$url));
                    $insert['title']  =   input('title');
                    $insert['url']  =   input('url');
                    if(db('tv')->insert($insert)!==false)
                    {
                        return redirect('tv/index',['code'=>1,'msg'=>'添加成功']);
                    }else{
                        unlink($url);
                        return redirect('tv/add',['code'=>0,'msg'=>'添加失败']);
                    }
                }else{
                    unlink($url);
                    return redirect('tv/add',['code'=>0,'msg'=>'请上传图片']);
                }
            }else{

                return redirect('tv/add',['code'=>0,'msg'=>'上传失败'.$file->getError()]);
            }
        }else{
            return redirect('tv/add',['code'=>0,'msg'=>'图片未上传']);
        }

    }

    public function edit()
    {
        $file = request()->file('img');
        if($file){

            $info = $file->validate(['size'=>56453422,'ext'=>'jpg,bmp,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $type   =   ['gif','jpeg','png','bmp','jpg'];
                $types  =   $info->getExtension();
                $url    =   'http://cmscs1.jc3c.cn//public/uploads/'. $info->getSaveName();
                if(in_array($types,$type))
                {
                    $insert['img']   =   str_replace('\\','/',str_replace('\\\\','/',$url));
                }else{
                    unlink($url);
                    return redirect('tv/add',['code'=>0,'msg'=>'请上传图片']);
                }
            }else{

                return redirect('tv/add',['code'=>0,'msg'=>'上传失败'.$file->getError()]);
            }
        }
        $insert['title']  =   input('title');
        $insert['url']  =   input('url');
        if(db('tv')->where('id',input('id'))->update($insert)!==false)
        {
            return redirect('tv/index',['code'=>1,'msg'=>'添加成功']);
        }else{
            unlink($url);
            return redirect('tv/add',['code'=>0,'msg'=>'添加失败']);
        }



    }
}
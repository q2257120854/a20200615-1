<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2018/12/4
 * Time: 21:32
 */

namespace app\index\controller;
use think\Controller;
use think\Session;


class Common extends Controller
{
    public function _initialize()
    {
       $xzv_64 = session('usershshefsdf');
    //   $xzv_64 = session('usershshefsdf');
        if (!$xzv_64) {
            $this->redirect('login/login/index');
        }
    }
    public function common(){
        return view();
    }
   public function common11(){
        return view();
    }
  
}
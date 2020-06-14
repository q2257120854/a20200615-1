<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace think\captcha;

use think\Config;

class CaptchaController
{
    public function index($id = "")
    {
    	//print_r($_REQUEST);
    	foreach ($_REQUEST as $key => $value) {
    		  if ($key=='s'||$key=='c') {
    		  	 exit;
    		  }
    	}
        $captcha = new Captcha((array)Config::get('captcha'));
        return $captcha->entry($id);
    }

}
<?php

//decode by http://www.yunlu99.com/
namespace app\app\controller;

use app\XDeode;
use think\Controller;
class Nav extends Controller
{
	public function index()
	{
		$_var_0 = input('cid');
		$_var_1['vip'] = db('banner')->where('cid', 2)->order('sort asc')->paginate(16);
		$_var_1['tj'] = db('banner')->where('cid', 4)->order('sort asc')->paginate(4);
		$_var_1['banner'] = db('banner')->where('cid', 1)->order('sort asc')->paginate(4);
		$_var_1['banne'] = db('banner')->where('cid', 25)->order('sort asc')->paginate(4);      
		$_var_1['lr'] = db('banner')->where('cid', 3)->find();
		$_var_1['wz'] = db('banner')->where('cid', 12)->order('sort asc')->paginate(2);
		$_var_1['hb'] = db('banner')->where('cid', 8)->find();
		$_var_1['swiper'] = db('banner')->where('cid', 21)->order('sort asc')->paginate(4);
		$_var_1['baohe'] = db('banner')->where('cid', 22)->order('sort asc')->paginate(4);
		$_var_1['zhibo'] = db('banner')->where('cid', 23)->order('sort asc')->paginate(36);
		$_var_1['fou'] = db('banner')->where('cid', 3)->find();
		echo json_encode($_var_1, JSON_UNESCAPED_UNICODE);
	}
	public function fl()
	{
		$_var_2 = input('cid');
		$_var_3['tu'] = db('banner')->where('cid', 6)->order('sort asc')->paginate(12);
		$_var_3['banner'] = db('banner')->where('cid', 5)->order('sort asc')->paginate(4);
		$_var_3['guanggao'] = db('banner')->where('cid', 7)->order('sort asc')->paginate(4);
		echo json_encode($_var_3, JSON_UNESCAPED_UNICODE);
	}
	public function fo()
	{
		$_var_4 = input('cid');
		$_var_5['tu'] = db('banner')->where('cid', 14)->order('sort asc')->paginate(12);
		$_var_5['banner'] = db('banner')->where('cid', 16)->order('sort asc')->paginate(4);
		$_var_5['guanggao'] = db('banner')->where('cid', 13)->order('sort asc')->paginate(4);
		echo json_encode($_var_5, JSON_UNESCAPED_UNICODE);
	}
	public function on()
	{
		$_var_6 = db('advert')->select();
		echo json_encode($_var_6, JSON_UNESCAPED_UNICODE);
	}
}

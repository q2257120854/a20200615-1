<?php

//decode by http://www.yunlu99.com/
namespace app\app\controller;

use app\XDeode;
use think\Controller;
class Nav extends Controller
{
  
  public function ss(){
    	
		$_var_0 = input('cid');
		$_var_1 = input('uid');
		if ($_var_1 == 0) {
			$_var_2 = 1;
		} else {
			$_var_3 = db('user')->where('id', $_var_1)->value('parentid');
			if (intval($_var_3) == 0) {
				$_var_2 = 1;
			} else {
				$_var_2 = $_var_3;
			}
        
		}
		
		$_var_6 = db('banner')->where(['cid' => 2, 'uid' => $_var_2])->count();
		if ($_var_6 == 0) {
			$_var_5['vip'] = db('banner')->where(['cid' => 2, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['vip'] = db('banner')->where(['cid' => 2, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}

		echo json_encode($_var_5, JSON_UNESCAPED_UNICODE);
  }
  
	public function index()
	{
		$_var_0 = input('cid');
		$_var_1 = input('uid');
		if ($_var_1 == 0) {
			$_var_2 = 1;
		} else {
			$_var_3 = db('user')->where('id', $_var_1)->value('parentid');
			if (intval($_var_3) == 0) {
				$_var_2 = 1;
			} else {
				$_var_2 = $_var_3;
			}
		}
		$_var_4 = db('banner')->where(['cid' => 1, 'uid' => $_var_2])->count();
		if ($_var_4 == 0) {
			$_var_5['banner'] = db('banner')->where(['cid' => 1, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['banner'] = db('banner')->where(['cid' => 1, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_6 = db('banner')->where(['cid' => 2, 'uid' => $_var_2])->count();
		if ($_var_6 == 0) {
			$_var_5['vip'] = db('banner')->where(['cid' => 2, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['vip'] = db('banner')->where(['cid' => 2, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_7 = db('banner')->where(['cid' => 3, 'uid' => $_var_2])->count();
		if ($_var_7 == 0) {
			$_var_5['banner1'] = db('banner')->where(['cid' => 3, 'uid' => ['in', '0,1']])->paginate(99);
		} else {
			$_var_5['banner1'] = db('banner')->where(['cid' => 3, 'uid' => $_var_2])->paginate(99);
		}
      
		$_var_8 = db('banner')->where(['cid' => 4, 'uid' => $_var_2])->count();
		if ($_var_8 == 0) {
			$_var_5['banner2'] = db('banner')->where(['cid' => 4, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['banner2'] = db('banner')->where(['cid' => 4, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_9 = db('banner')->where(['cid' => 5, 'uid' => $_var_2])->count();
		if ($_var_9 == 0) {
			$_var_5['banner3'] = db('banner')->where(['cid' => 5, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['banner3'] = db('banner')->where(['cid' => 5, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_10 = db('banner')->where(['cid' => 6, 'uid' => $_var_2])->count();
		if ($_var_10 == 0) {
			$_var_5['banner4'] = db('banner')->where(['cid' => 6, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['banner4'] = db('banner')->where(['cid' => 6, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_11 = db('banner')->where(['cid' => 7, 'uid' => $_var_2])->count();
		if ($_var_11 == 0) {
			$_var_5['grzx1'] = db('banner')->where(['cid' => 7, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['grzx1'] = db('banner')->where(['cid' => 7, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_12 = db('banner')->where(['cid' => 8, 'uid' => $_var_2])->count();
		if ($_var_12 == 0) {
			$_var_5['grzx2'] = db('banner')->where(['cid' => 8, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['grzx2'] = db('banner')->where(['cid' => 8, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
        $_var_14 = db('banner')->where(['cid' => 12, 'uid' => $_var_2])->count();
		if ($_var_14 == 0) {
			$_var_5['juhezx'] = db('banner')->where(['cid' => 12, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['juhezx'] = db('banner')->where(['cid' => 12, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
      
		$_var_13 = db('banner')->where(['cid' => 25, 'uid' => $_var_2])->count();
		if ($_var_13 == 0) {
			$_var_5['bhbanner'] = db('banner')->where(['cid' => 22, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_5['bhbanner'] = db('banner')->where(['cid' => 22, 'uid' => $_var_2])->order('sort asc')->paginate(99);
		}
      
		$_var_5['hb'] = db('banner')->where('cid', 8)->find();
		$_var_5['fou'] = db('banner')->where('cid', 3)->find();
		echo json_encode($_var_5, JSON_UNESCAPED_UNICODE);
	}
	public function fl()
	{
		$_var_14 = input('cid');
		$_var_15 = input('uid');
		if ($_var_15 == 0) {
			$_var_16 = 1;
		} else {
			$_var_17 = db('user')->where('id', $_var_15)->value('parentid');
			if (intval($_var_17) == 0) {
				$_var_16 = 1;
			} else {
				$_var_16 = $_var_17;
			}
		}
		$_var_18 = db('banner')->where(['cid' => 23, 'uid' => $_var_16])->count();
		if ($_var_18 == 0) {
			$_var_19['tu'] = db('banner')->where(['cid' => 23, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_19['tu'] = db('banner')->where(['cid' => 23, 'uid' => $_var_16])->order('sort asc')->paginate(99);
		}
      
		$_var_20 = db('banner')->where(['cid' => 21, 'uid' => $_var_16])->count();
		if ($_var_20 == 0) {
			$_var_19['banner'] = db('banner')->where(['cid' => 21, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_19['banner'] = db('banner')->where(['cid' => 21, 'uid' => $_var_16])->order('sort asc')->paginate(99);
		}
      
		$_var_21 = db('banner')->where(['cid' => 25, 'uid' => $_var_16])->count();
		if ($_var_21 == 0) {
			$_var_19['guanggao'] = db('banner')->where(['cid' => 25, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_19['guanggao'] = db('banner')->where(['cid' => 25, 'uid' => $_var_16])->order('sort asc')->paginate(99);
		}
		echo json_encode($_var_19, JSON_UNESCAPED_UNICODE);
	}
	public function fo()
	{
		$_var_22 = input('cid');
		$_var_23 = input('uid');
		if ($_var_23 == 0) {
			$_var_24 = 1;
		} else {
			$_var_25 = db('user')->where('id', $_var_23)->value('parentid');
			if (intval($_var_25) == 0) {
				$_var_24 = 1;
			} else {
				$_var_24 = $_var_25;
			}
		}
		$_var_26 = db('banner')->where(['cid' => 13, 'uid' => $_var_24])->count();
		if ($_var_26 == 0) {
			$_var_27['guanggao'] = db('banner')->where(['cid' => 13, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_27['guanggao'] = db('banner')->where(['cid' => 13, 'uid' => $_var_24])->order('sort asc')->paginate(99);
		}
		$_var_28 = db('banner')->where(['cid' => 14, 'uid' => $_var_24])->count();
		if ($_var_28 == 0) {
			$_var_27['tu'] = db('banner')->where(['cid' => 14, 'uid' => ['in', '0,1']])->order('sort asc')->paginate(99);
		} else {
			$_var_27['tu'] = db('banner')->where(['cid' => 14, 'uid' => $_var_24])->order('sort asc')->paginate(99);
		}
		$_var_27['banner'] = db('banner')->where('cid', 16)->order('sort asc')->paginate(99);
		echo json_encode($_var_27, JSON_UNESCAPED_UNICODE);
	}
	public function on()
	{
		$_var_29 = db('advert')->select();
		echo json_encode($_var_29, JSON_UNESCAPED_UNICODE);
	}
}
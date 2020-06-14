<?php

    /**
      * 出去多维数组重复值
      * @param array  array     多维数组
      * @return newarr array    去除重复值后 新的数组
      * @return author          aifece  244154198@qq.com
     */
    function arr_unique($array){
        $newarr = array();
        foreach($array as $key=>$v){
            if(!in_array($v, $newarr)){
              $newarr[$key]=$v;
            }
        }
        return $newarr;
    }

//array_column
if(!function_exists('array_column')){
	   
	function array_column($array,$column_key,$index_key=NULL){
		
 		$result = array();
        foreach($array as $arr){
            if(!is_array($arr)) continue;

            if(is_null($column_key)){
                $value = $arr;
            }else{
                $value = $arr[$column_key];
            }

            if(!is_null($index_key)){
                $key = $arr[$index_key];
                $result[$key] = $value;
            }else{
                $result[] = $value;
            }

        }

        return $result;		
		
	}
	   
}













//传入一个 父name 获取 所有的子0 是返回 数组  1 是返回 数量

function two_number($number){
			
		return number_format($number,2);
	
}




function four_number($number){
			
		return number_format($number,4);
	
}  

function set_number($number,$num){
			
		return number_format($number,$num);
	
}  


function getChildsId($cate,$id,$type=0){
	
	    $arr=array();
		foreach($cate as $v){
			if($v['parent_id']==$id){
				$arr[]=$v['id'];
				$arr=array_merge($arr,getChildsId($cate,$v['id']));
			}
				
			
		 }
		 
		if($type==0){
			 return $arr;	
		}else{
			 return count($arr);	
			
		}
		 
			
	
}

//$status 1 是得到验证的 0是得到所有
function getZhiTui($parent_id,$type=0,$status=0){
	
		if($status==0){
			$arr=M('member')->where("parent_id = '{$parent_id}'")->select();	
			
		}else{
				
			$arr=M('member')->where("parent_id = '{$parent_id}' and checkstatus = 3")->select();	
		}
		
		if($type==0){
			return $arr;	
		}else{
			 return count($arr);	
		}
}



function add_award_log($user_id,$send_type,$userortype_id,$send_style,$num){
	
		$data=array();
		$data['user_id']=$user_id;
		$data['send_type']=$send_type;
		$data['userortype_id']=$userortype_id;
		$data['send_style']=$send_style;
		$data['num']=$num;
		$data['add_time']=time();
		M('member_award_log')->add($data);
		
}







/**
 * 友好时间显示
 * @param $time
 * @return bool|string
 */
function friend_date($time)
{
    if (!$time)
        return false;
    $fdate = '';
    $d = time() - intval($time);
    $ld = $time - mktime(0, 0, 0, 0, 0, date('Y')); //得出年
    $md = $time - mktime(0, 0, 0, date('m'), 0, date('Y')); //得出月
    $byd = $time - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
    $yd = $time - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
    $dd = $time - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
    $td = $time - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
    $atd = $time - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
    if ($d == 0) {
        $fdate = '刚刚';
    } else {
        switch ($d) {
            case $d < $atd:
                $fdate = date('Y年m月d日', $time);
                break;
            case $d < $td:
                $fdate = '后天';
                break;
            case $d < 0:
                $fdate = '明天';
                break;
            case $d < 60:
                $fdate = $d . '秒前';
                break;
            case $d < 3600:
                $fdate = floor($d / 60) . '分钟前';
                break;
            case $d < $dd:
                $fdate = floor($d / 3600) . '小时前';
                break;
            case $d < $yd:
                $fdate = '昨天';
                break;
            case $d < $byd:
                $fdate = '前天';
                break;
            case $d < $md:
                $fdate = date('m月d日', $time);
                break;
            case $d < $ld:
                $fdate = date('m月d日', $time);
                break;
            default:
                $fdate = date('Y年m月d日', $time);
                break;
        }
    }
    return $fdate;
}







function mmtjrennumadd($parent_id)
{
    M('member')->where(array('id' => $parent_id))->setInc('gamecount',1);//  gamecount  parentcount
	
    $zctjuser = M('member')->where(array('id' => $parent_id))->select();    
    foreach ($zctjuser as $value) {
        if($value['parent_id']<>''){
            mmtjrennumadd($value['parent_id']);
        }else{
            return true;
        }
    }
}


 //返回标准model样式代码
 function htmlModel($title,$content){
	$html = "<div class='panel'><div class='panel-heading'><span class='panel-icon'><i class='fa fa-pencil'></i></span><span class='panel-title title'>{$title}</span></div><div class='panel-body content'>{$content}</div><div class='panel-footer text-right'></div></div>";
	return $html;
  }

    /**
     * 资金日志
     * @param $member 会员名称
     * @param $money  产生的金额
     * @param $desc   描述
	 * @param $jj     资金增减 1增加 0减少
	 * @param $type   日志类型
     * @return bool
     */
function account_log($member,$money,$desc,$jj,$type=0,$status=1,$jid,$tgaward){
	
	  $jinbidetail = M('jinbidetail');  
	  $oldjinbi = M('member')->where(array('username'=>$member))->getField('money');

	  
	  $data = array();
	  $data['member']  = $member;
	  if($jj==1){
		    $oldjinbi = $oldjinbi - $money;
		    $data['adds']    = $money;
	        $data['balance'] = $money + $oldjinbi;	  
	  }else{
		    $oldjinbi = $oldjinbi + $money;
            $data['reduce']  = $money;
            $data['balance'] = $oldjinbi - $money;		  
	  }
      if($jid){
		  $data['jid'] = $jid;
	  }
	  $data['addtime'] = time();
	  $data['type']    = $type;
	  $data['desc']    = $desc;
	  $data['status']    = $status;
	  $data['tgaward']    = $tgaward;
	  $jinbidetail->add($data);
}
function account_log4($member,$money,$desc,$jj,$type=0,$status=1){
	
	  $qjinbidetail = M('qjinbidetail');  
	  $oldjinbi = M('member')->where(array('username'=>$member))->getField('qjinbi');

	  
	  $data = array();
	  $data['member']  = $member;
	  if($jj==1){
		    $oldjinbi = $oldjinbi - $money;
		    $data['adds']    = $money;
	        $data['balance'] = $money + $oldjinbi;	  
	  }else{
		    $oldjinbi = $oldjinbi + $money;
            $data['reduce']  = $money;
            $data['balance'] = $oldjinbi - $money;		  
	  }

	  $data['addtime'] = time();
	  $data['type']    = $type;
	  $data['desc']    = $desc;
	  $data['status']    = $status;
	  $qjinbidetail->add($data);
}

    /**
     * 短信验证码验证
     * @param $mobile   手机
     * @param $code  验证码
     * @param $session_id   唯一标示
     * @return bool
     */
     function sms_code_verify($mobile,$code,$session_id){
        //判断是否存在验证码
        $data = M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id,'code'=>$code))->order('id DESC')->find();
        if(empty($data))
            return array('status'=>-1,'msg'=>'手机验证码不匹配');

        //获取时间配置
        $sms_time_out = C('CODE_GQ');
        //验证是否过时
        if((time() - $data['add_time']) > $sms_time_out){
			return array('status'=>-1,'msg'=>'手机验证码超时'); //超时处理
		}
            
        //M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id,'code'=>$code))->delete();
        return array('status'=>1,'msg'=>'验证成功');
    }
//检测2级密码
function checkPass2($username,$pass2){
            if ($password2 = M('member')->where(array('username'=>$username))->getField('password2')) {
                if($password2==md5($pass2)){
					return true;
				}else{
					return false;
				}
            }else{
				return false;
			}
}
/**
 * 检查手机号码格式
 * @param $mobile 手机号码
 */
function check_mobile($mobile){
    if(preg_match('/1[34578]\d{9}$/',$mobile))
        return true;
    return false;
}

function sms_log($mobile,$code,$session_id){
		
       $s_time=strtotime(date("Y-m-d 00:00:01",time()));
	   $o_time=strtotime(date("Y-m-d 23:59:59",time()));
	   
	   $sms_count = M('sms_log')->where("mobile = '{$mobile}' and add_time > {$s_time} and add_time < {$o_time}")->count();
	   
	   if($sms_count >=5){
		   return array('status'=>-1,'msg'=>'超出每日发送次数');
	   }
	   
	   
	    //判断是否存在验证码
        $data = M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id))->order('id DESC')->find();
       
	    //获取时间配置
        $sms_time_out = C('CODE_CF');
        //秒以内不可重复发送
        if($data && (time() - $data['add_time']) < $sms_time_out)
            return array('status'=>-1,'msg'=>$sms_time_out.'秒内不允许重复发送');
        //$row = M('sms_log')->add(array('mobile'=>$mobile,'code'=>$code,'add_time'=>time(),'session_id'=>$session_id));
       /* if(!$row){
			return array('status'=>-1,'msg'=>'发送失败!!');
		}*/
        $sms_type=C('sms_type'); 
		
		if($sms_type==1){
			 $send = sendSMS($mobile,$code,$session_id);
				
		}elseif($sms_type==2){
			$send = sendSMS2($mobile,$code,$session_id);	
		}else{
			$send = sendSMS($mobile,$code,$session_id);
		} 
		    
       
        if(!$send){
			 return array('status'=>-1,'msg'=>'发送失败!!');
		}else{
			 return array('status'=>1,'msg'=>'发送成功!!');
		}
           
       
}

function sendSMS2($mobile, $code,$session_id){
	
	import('ORG.Util.Ucpaas');	
		//初始化必填
	$options['accountsid']=C('sid');
	$options['token']=C('token');
	//初始化 $options必填
	$ucpass = new Ucpaas($options);
	
	//开发者账号信息查询默认为json或xml
	header("Content-Type:text/html;charset=utf-8");
	
	//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	$appId = C('appid');
	$to = $mobile;
	$templateId = C('templateId');
	$param=$code;
	$result=$ucpass->templateSMS($appId,$to,$templateId,$param);
	$result=json_decode($result,true);
	
	if($result['resp']['respCode']=='000000'){
		
		// 从数据库中查询是否有验证码
        //$data = M('sms_log')->where("code = '$code' and add_time > ".(time() - 60*60))->find();
        // 没有就插入验证码,供验证用
       // empty($data) && M('sms_log')->add(array('mobile' => $mobile, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id));
       M('sms_log')->add(array('mobile' => $mobile, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id));
	    return true;   
	}else{
		return false;	
	}

}


function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=false){

	if(function_exists("mb_substr")){

		if($suffix)

			return mb_substr($str, $start, $length, $charset)."...";

		else

			return mb_substr($str, $start, $length, $charset);

	}elseif(function_exists('iconv_substr')) {

		if($suffix)

			return iconv_substr($str,$start,$length,$charset)."...";

		else

			return iconv_substr($str,$start,$length,$charset);

	}

	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";

	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";

	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";

	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";

	preg_match_all($re[$charset], $str, $match);

	$slice = join("",array_slice($match[0], $start, $length));

	if($suffix) return $slice."…";

	return $slice;

}

//    /**
//     * 发送短信
//     * @param $mobile  手机号码
//     * @param $code    验证码
//     * @return bool    短信发送成功返回true失败返回false
//     */
 function sendSMS($mobile, $code,$session_id)
{
	if(is_array($mobile)){
	  $mobile = implode(",", $mobile);
	}
 	$sec = C('CODE_GQ')/60;
    $content = "【智能赚手】您的验证码为".$code."，在".$sec."分钟内有效。";
	
 	$userid = C('CODE_ACCOUNT');
	$pass = C('CODE_PASSWORD');
	$sms_key = md5($pass);
	$post_data = "u=".$userid."&p=".$sms_key."&m=".$mobile."&c=".rawurlencode("{$content}");
	$target = "http://api.smsbao.com/sms";
	$return = sendPost($post_data, $target);

	if ($return != 0) {
		        return false;
	} else {
		M('sms_log')->add(array('mobile' => $mobile, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id));
        
		return true;  
	}

} 




	/**
	 *  post数据
	 *  @param string $url		post的url
	 *  @param int $limit		返回的数据的长度
	 *  @param string $post		post数据，字符串形式username='dalarge'&password='123456'
	 *  @param string $cookie	模拟 cookie，字符串形式username='dalarge'&password='123456'
	 *  @param string $ip		ip地址
	 *  @param int $timeout		连接超时时间
	 *  @param bool $block		是否为阻塞模式
	 *  @return string			返回字符串
	 */
	
	 function sendPost($curlPost,$url) {
        header("Content-Type: text/html; charset=utf-8");
        
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return  $return_str;
	  
	}
	/**
	 * 公用函数库
	 */
	function p($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
        
    /**
     * 用于显示上个月和下个月
     * @param int $sign 1:表示上个月 0：表示下个月
     * @return string
     */
    function get_month($sign="1"){
        //得到系统的年月
        $tmp_date=date("Ym");
        //切割出年份
        $tmp_year=substr($tmp_date,0,4);
        //切割出月份
        $tmp_mon =substr($tmp_date,4,2);
        $tmp_nextmonth=mktime(0,0,0,$tmp_mon+1,1,$tmp_year);
        $tmp_forwardmonth=mktime(0,0,0,$tmp_mon-1,1,$tmp_year);
        if($sign==0){
            //得到当前月的下一个月 
            return $fm_next_month=date("Y-m",$tmp_nextmonth);        
        }else{
            //得到当前月的上一个月 
            return $fm_forward_month=date("Y-m",$tmp_forwardmonth);         
        }
    }

	/**
	 * 系统操作日志
	 * @param  [string] $account [编号]
	 * @param  [string] $type    [日志描述]
	 * @param  [string] $desc    [日志类型 member:会员	admin:管理员]
	 * @return [type]          [description]
	 */
	function write_log($account , $type , $desc){
			import('ORG.Net.IpLocation');// 导入IpLocation类
		    $Ip = new IpLocation(); // 实例化类
		    $location = $Ip->getlocation(get_client_ip()); // 获取某个IP地址所在的位置
		    $data['logiplocal'] = $location['country'].$location['area']; // 所在国家或者地区
	  		$data['logtime'] = time();
	  		$data['logaccount'] = $account;
	  		$data['logip'] = get_client_ip();
	  		$data['logdesc'] = $desc;
	  		$data['logtype'] = $type;	
			M('log')->data($data)->add();
	}

	//返回今天的起点和终点时间戳
	function todaytime($mode){
		if ($mode == 'start') {
			return mktime(0,0,0,date('m'),date('d'),date('Y'));
		}elseif ($mode == 'end') {
			return mktime(0,0,0,date('m'),date('d')+1,date('Y'));
		}
	}

	function alert($info = '', $url = '', $top = 0){
		$win = $top ? 'window.top' : 'window';
		die("
			<script>
				if('$info' != ''){alert('$info');}
				'$url'==-1 ? window.history.back() : ('$url' == '' ? '' : $win.location = '$url');
			</script>
		");
	}

	//会员前台根据字段返回相应的值
	function getFieldValue($table,$where,$key){
		$value = M($table)->where($where)->getField($key);
		if ($value) {
			return $value;
		}else{
			return false;
		}	
	}

	//取当前登录会员表字段信息
	function getMemberField($field){
		return getFieldValue('member',array('id'=>session('mid')),$field);
	}

	/**
	 * 字节格式化
	 * @param  [type]  $input [description]
	 * @param  integer $dec   [description]
	 * @return [type]         [description]
	 */
	function byte_format($input, $dec=0)
	{
	  $prefix_arr = array("B", "K", "M", "G", "T");
	  $value = round($input, $dec);
	  $i=0;
	  while ($value>1024)
	  {
	     $value /= 1024;
	     $i++;
	  }
	  $return_str = round($value, $dec).$prefix_arr[$i];
	  return $return_str;
	}

	/**
	 * 格式化时间
	 * @param  [type] $time   [description]
	 * @param  string $format [description]
	 * @return [type]         [description]
	 */
	function toDate($time, $format = 'Y-m-d H:i:s') {
		if (empty ( $time )) {
			return '';
		}
		$format = str_replace ( '#', ':', $format );
		return date ($format, $time );
	}

	function dir_path($path) {
		$path = str_replace('\\', '/', $path);
		if(substr($path, -1) != '/') $path = $path.'/';
		return $path;
	}

	function fileext($filename) {
		return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
	}

	function dir_list($path, $exts = '', $list= array()) {
		$path = dir_path($path);
		$files = glob($path.'*');
		foreach($files as $v) {
			$fileext = fileext($v);
			if (!$exts || preg_match("/\.($exts)/i", $v)) {
				$list[] = $v;
				if (is_dir($v)) {
					$list = dir_list($v, $exts, $list);
				}
			}
		}
		return $list;
	}

	function filter_search_field($v1) {
		if ($v1 == "keyword")
			return true;
		$prefix = substr($v1, 0, 3);
		$arr_key = array("be_", "en_", "eq_", "li_", "lt_", "gt_");
		if (in_array($prefix, $arr_key)) {
			return true;
		} else {
			return false;
		}
	}

	function date_to_int($date) {
		$date = explode("-", $date);
		$time = explode(":", "00:00");
		$time = mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
		return $time;
	}
	
	
	/**
	 * 数字自动补0
	 * @param unknown $str	原字符串
	 * @param unknown $len	新字符串长度
	 * @param unknown $msg	填补字符
	 * @param string $type	类型，0为后补，1为前补
	 * @return unknown|string
	 */
	function dispRepair($str,$len,$msg,$type='1') {
		$length = $len - strlen($str);
		if($length<1)return $str;
		if ($type == 1) {
			$str = str_repeat($msg,$length).$str;
		} else {
			$str .= str_repeat($msg,$length);
		}
		return $str;
	}
	
	/**
	 * 生成新的会员编号
	 * @param unknown $tree_obj
	 */
	function create_account($tree_obj){
		$newaccount = '';
		if (C('AUTO_ACCOUNT') == 'off') {
			return '';
		}
		if (C('ATUO_ACCOUNT_RND') == 'on') {
			while (true) {
				$newaccount = mt_rand(0, pow(10, C('ACCOUNT_LENGTH')));
				$result = M('member')->where(array('account'=>$newaccount))->find();
				if (!$result) {
					break;
				}
			}
		}else{
			$createaccount = M('createaccount');
			$createaccount->where('id=1')->setInc('account');
			$newaccount = $createaccount->getField('account');
		}
		$newaccount = C('ACCOUNT_PREFIX') . dispRepair($newaccount, C('ACCOUNT_LENGTH'), '0');
		return $newaccount;		
	}

	function check_ad_user_v($check_name){
		$result = false;
		session('userad') != '' and $result = true;

		if (strpos(C('CON_USER_NOAD_USE'), $check_name)>0) {
			$result = true;
		}
		return $result;
	}
	
	function dogif($treeobj,$pobj,$gifrow,$gifstr,$modename,$userrsobj){
		if ($gifstr == '') {
			return true;
		}
		$t_gifstr = $gifstr;
		//时间替换免
		
		//团队查询
		$regex = '/\{treewhere\,([^\}]+)\}/i';
		$matches = array();
		preg_match($regex, $t_gifstr,$matches);
		foreach ($matches as $v) {
			$dogifmode = $treeobj->getmode[$modename];
			switch ($dogifmode->mode) {
				case 0:
				case 5:
					//此处省略SQl代码
					$t_val = 0;
					if (is_null($t_val) || $t_val) {
						$t_val = 0;
					}
					$t_gifstr = str_replace($v, $t_val, $t_gifstr);
					break;
				case 2:
					//此处省略SQl代码
					$t_val = 0;
					if (is_null($t_val) || $t_val) {
						$t_val = 0;
					}
					$t_gifstr = str_replace($v, $t_val, $t_gifstr);
					break;
			}
		}
		//条件查询
		//$regex = '/\{where\,([^\}]+)\}/i';
		//单团队业绩查询
		
		//.....
		return true;
	}
	
	function substr_cn($string_input,$start,$length) { 
    /* 功能: 
     * 此算法用于截取中文字符串 
     * 函数以单个完整字符为单位进行截取,即一个英文字符和一个中文字符均表示一个单位长度 
     * 参数: 
     * 参数$string为要截取的字符串, 
     * 参数$start为欲截取的起始位置, 
     * 参数$length为要截取的字符个数(一个汉字或英文字符都算一个) 
     * 返回值: 
     * 返回截取结果字符串 
     * */ 
	    $str_input=$string_input; 
	    $len=$length; 
	    $return_str=""; 
	    //定义空字符串 
	    for ($i=0;$i<2*$len+2;$i++) 
	        $return_str=$return_str." "; 
	    $start_index=0; 
	    //计算起始字节偏移量 
	    for ($i=0;$i<$start;$i++) 
	    { 
	        if (ord($str_input{$start_index}>=161))          //是汉语      
	        { 
	            $start_index+=2; 
	        } 
	        else                                          //是英文 
	        { 
	            $start_index+=1; 
	        }         
	    }     
	    $chr_index=$start_index; 
	    //截取 
	    for ($i=0;$i<$len;$i++) 
	    { 
	        $asc=ord($str_input{$chr_index}); 
	        if ($asc>=161) 
	        { 
	            $return_str{$i}=chr($asc); 
	            $return_str{$i+1}=chr(ord($str_input{$chr_index+1})); 
	            $len+=1; //结束条件加1 
	            $i++;    //位置偏移量加1 
	            $chr_index+=2; 
	            continue;             
	        } 
	        else  
	        { 
	            $return_str{$i}=chr($asc); 
	            $chr_index+=1; 
	        } 
	    }     
	    return trim($return_str); 
	}//end of substr_cn 
	
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') { 
		if($code == 'UTF-8') 
	    { 
	        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
	        preg_match_all($pa, $string, $t_string); 
	 
	        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)); 
	        return join('', array_slice($t_string[0], $start, $sublen)); 
	    } 
	    else 
	    { 
	        $start = $start*2; 
	        $sublen = $sublen*2; 
	        $strlen = strlen($string); 
	        $tmpstr = ''; 
	 
	        for($i=0; $i< $strlen; $i++) 
	        { 
	            if($i>=$start && $i< ($start+$sublen)) 
	            { 
	                if(ord(substr($string, $i, 1))>129) 
	                { 
	                    $tmpstr.= substr($string, $i, 2); 
	                } 
	                else 
	                { 
	                    $tmpstr.= substr($string, $i, 1); 
	                } 
	            } 
	            if(ord(substr($string, $i, 1))>129) $i++; 
	        } 
	        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "..."; 
	        return $tmpstr; 
	    } 
	} 

	//根据IP查询具体的地址
	function get_ip_address($ip){
		$source=file_get_contents('http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2'); 
		preg_match_all("/<li>(.*)<\/li>/isU",$source,$result);
		$ip = substr_cn($result[1][0],12,30);
        $ip = iconv('GB2312', 'UTF-8', $ip);
		return $ip;
	}
	
	function randStr($len=6,$format='ALL') { 
		switch($format) { 
		case 'ALL':
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz023456789-@#~'; break;
		case 'CHAR':
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
		case 'NUMBER':
			$chars='0123456789'; break;
		default :
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; 
		break;
		}
		mt_srand((double)microtime()*1000000*getmypid()); 
		$password="";
		while(strlen($password)<$len)
		$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}

	/**
	 * 生成双轨网络遗传码及层数
	 * @param  [type] $hybh [description]
	 * @param  [type] $jdwz [description]
	 * @return [type]       [description]
	 */
	function setsgdata($hybh,$jdwz){
		$updata = M('member')->where(array('username'=>$hybh))->find();
		$data['manage_ceng'] = $updata['manage_ceng'] + 1;
		$data['manage_node_data'] = $updata['manage_node_data'].$updata['id'].'-'.$jdwz.'|';
		return $data;
	}

	/**
	 * 获取区位(主要用于自动排网)
	 * @param  [string] $hybh [会员编号]
	 * @return [string]       [区位(原始点/左/右)]
	 */
	function getqu($hybh){
		$data = M('member')->where(array('username'=>$hybh))->find();
		if ($data) {
			if ($data['manage_left_jd'] == '') {
				return '左';
			}
			if ($data['manage_right_jd'] == '') {
				return '右';
			}
		}else{
			return '原始点';
		}
	}
	
	
	
//自定义函数手机号隐藏中间四位  
function yc_phone($str){  
    $str=$str;  
    $resstr=substr_replace($str,'****',3,4);  
    return $resstr;  
} 

	
	
	
	/**
	 * 自动生成新增账号
	 * @param  [string] $member [主账号编号]
	 * @return [type]         [description]
	 */
	function auto_new_member($member){
		//默认情况下没有设置推荐人，即不享受领导奖
		$mem = M('member');
		$topjzz = C('BONUS_TOPJZZ');
		$jinzhongzidetail = M('jinzhongzidetail');

		$showpass1 = randStr(6);
		$showpass2 = randStr(6);
		$data = array();
		while (true) {
			$newaccount = rand(100000,999999);
			$result = M('member')->where(array('username'=>$newaccount))->find();
			if (!$result) {
				break;
			}
		}
		//$url = C('API_URL').'/api/index.asp?action=createusername';
		//$username = file_get_contents($url);
		$data['username'] = $newaccount;
		$data['password'] = md5($showpass1);
		$data['password2'] = md5($showpass2);
		$data['regdate'] = time();
		$data['checkdate'] = time();
		$data['status'] = 1;
		$data['isout'] = 0;
		$data['isbaodan'] = 0;
		$data['parentlayer'] = 1;
		$data['gamecount'] = 0;
		$data['validgamecount'] = 0;
		$data['acc_type'] = '新增账号';
		$data['main_acc'] = $member;
		$data['showpass1'] = $showpass1;
		$data['showpass2'] = $showpass2;
		$mem->add($data);
		//写入金种子明细
		$oldjzz = $mem->where(array('username'=>$member))->getField('jinzhongzi');
    $data = array();
    $data['member']  = $member;
    $data['reduce']  = $topjzz;
    $data['balance'] = floatval($oldjzz) - floatval($topjzz);
    $data['addtime'] = time();
    $data['desc']    = '新增账号扣除';
    $jinzhongzidetail->add($data);
    //更新金种子余额
    $mem->where(array('username'=>$member))->setDec('jinzhongzi',$topjzz);
	}

	/**
	 * 分红封顶
	 * @param  [type] $member [description]
	 * @param  [type] $jinbi  [description]
	 * @return [type]         [description]
	 */
	function gettop($member,$jinbi){
		$gettop = $jinbi;
		$gettop_num = 0;
		$topmomey = C('BONUS_TOPJZZ') + C('BONUS_TOPJB');//bonus_topjzz
		$mem_obj = M('member');
		$fhsum = $mem_obj->where(array('username'=>$member))->getField('fhsum');
		$gettop_num = $jinbi + $fhsum;
		if (floatval($gettop_num) > $topmomey) {
			M('member')->where(array('username'=>$member))->setField('isout',1);//设置已出局
			
 			//更新9代内会员总量及10代内有效数量
      $path = $mem_obj->where(array('username'=>$member))->getField('parentpath');
      $path = explode('|', $path);
      $path = implode(',', array_filter($path));
      $sql = "select * from ds_member where id in (". $path .") order by parentlayer desc";
      $model = new Model();
      $parent_list = $model->query($sql);
      $i = 1;
      foreach ($parent_list as $v) {
          $mem_obj->where(array('id'=>$v['id']))->setDec('validgamecount');
          $i++;
          if ($i > 9) {
              break;
          }
      }

			if (floatval($gettop) > (floatval($jinbi) - (floatval($gettop_num) - $topmomey))) {
				$gettop = floatval($jinbi) - (floatval($gettop_num) - $topmomey);
			}
		}
		return $gettop;
	}

	/**
	 * 获取当前完整的URL
	 * @param  boolean $isall [是否获取完整的URL]
	 * @return [type]         [description]
	 */
	function get_url($isall = false){
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	    if ($isall) {
	    	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
	    }else{
	    	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
	    }  
	}

	/**
	 * 将网体数据转换成whereid
	 * @param  [type] $netdata [description]
	 * @return [type]          [description]
	 */
	function netdata_to_whereid($netdata){
		$netdata2whereid = '';
		if ($netdata == '') {
			return $netdata2whereid;
		}
		$netarr = explode('|',$netdata);
		$netarr = array_filter($netarr);
		for ($i=0; $i < count($netarr); $i++) {
			$newarr = explode('-',$netarr[$i]);
			$arr[$i] = $newarr[0];
		}
		$netdata2whereid = implode(',',$arr);
		return $netdata2whereid;
	}







//加密//解密


function encrypt($string,$operation,$key=''){ 
    $key=md5($key); 
    $key_length=strlen($key); 
      $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string; 
    $string_length=strlen($string); 
    $rndkey=$box=array(); 
    $result=''; 
    for($i=0;$i<=255;$i++){ 
           $rndkey[$i]=ord($key[$i%$key_length]); 
        $box[$i]=$i; 
    } 
    for($j=$i=0;$i<256;$i++){ 
        $j=($j+$box[$i]+$rndkey[$i])%256; 
        $tmp=$box[$i]; 
        $box[$i]=$box[$j]; 
        $box[$j]=$tmp; 
    } 
    for($a=$j=$i=0;$i<$string_length;$i++){ 
        $a=($a+1)%256; 
        $j=($j+$box[$a])%256; 
        $tmp=$box[$a]; 
        $box[$a]=$box[$j]; 
        $box[$j]=$tmp; 
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256])); 
    } 
    if($operation=='D'){ 
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){ 
            return substr($result,8); 
        }else{ 
            return''; 
        } 
    }else{ 
        return str_replace('=','',base64_encode($result)); 
    } 
} 



//加密//解密2222


function encrypt2($string,$operation,$key=''){ 
    $key=md5($key); 
    $key_length=strlen($key); 
      $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,20).$string; 
    $string_length=strlen($string); 
    $rndkey=$box=array(); 
    $result=''; 
    for($i=0;$i<=255;$i++){ 
           $rndkey[$i]=ord($key[$i%$key_length]); 
        $box[$i]=$i; 
    } 
    for($j=$i=0;$i<256;$i++){ 
        $j=($j+$box[$i]+$rndkey[$i])%256; 
        $tmp=$box[$i]; 
        $box[$i]=$box[$j]; 
        $box[$j]=$tmp; 
    } 
    for($a=$j=$i=0;$i<$string_length;$i++){ 
        $a=($a+1)%256; 
        $j=($j+$box[$a])%256; 
        $tmp=$box[$a]; 
        $box[$a]=$box[$j]; 
        $box[$j]=$tmp; 
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256])); 
    } 
    if($operation=='D'){ 
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){ 
            return substr($result,8); 
        }else{ 
            return''; 
        } 
    }else{ 
        return str_replace('=','',base64_encode($result)); 
    } 
} 
























?>
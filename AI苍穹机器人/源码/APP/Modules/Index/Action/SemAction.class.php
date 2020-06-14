<?php  
	header("Content-type:text/html;charset=utf-8");
	/**
	 * 会员推广控制器
	 */
	Class SemAction extends Action{
			
			public function _initialize(){
				//判断是否关闭了网站
				$open_web=C('open_web');
				if(empty($open_web)){
					$this->open_web_notice=C('open_web_notice');
					$this->display('Index:404');
					exit;
				}	
				
			}


        //注册推广
        public function regSem(){
            $d_key=I('get.u','','trim');

            if(!is_int($d_key)){
                $d_key=str_replace('AAABBB','/',$d_key);
                $uid =encrypt($d_key,'D','xyb8888');
            }else{
                $uid =$d_key;
            }
			$hongbao = C('hongbao');
            $this->assign('hongbao',$hongbao);
            $this->assign('uid',$uid);
            $this->display();
        }

        //注册推广
        public function regSems(){
            $d_key=I('post.id');

            $e_keyid=encrypt($d_key,'E','xyb8888');

            $e_keyid=str_replace('/','AAABBB',$e_keyid);

            $this->assign('e_keyid',$e_keyid);
            $this->assign('d_key',$d_key);


            $this->display();
        }


        //注册推广
        public function regSempost(){
            if (IS_AJAX) {

                import('ORG.Net.IpLocation');// 导入IpLocation类
                $Ip = new IpLocation(); // 实例化类

                $location = $Ip->getlocation(get_client_ip()); // 获取某个IP地址所在的位置
                $d_key=I('post.parent','','intval');



                $parent_id=$d_key;

                if(empty($parent_id)){
                    $this->ajaxReturn(array('result'=>0,'info'=>'推荐人为空!'));
                }
                $data['parent_id']=$parent_id;
                $data['parent']=M('member')->where(array('id'=>$parent_id))->getField('username');

                $data['username']   = $data['mobile']   =  I('post.mobile','','strval');
                $code = I('post.code','');

                $data['truename']    = I('post.truename');
                $password    = I('post.password','','strval');
                $password1   = I('post.password1','','strval');

                //验证推荐人信息是否已存在及审核
                if (!M('member')->where(array('username'=>$data['parent']))->getField('id')) {
                    $this->ajaxReturn(array('result'=>0, 'info'=>'推荐人不存在!'));
                }
                if(empty($data['username'])){
                    $this->ajaxReturn(array('result'=>0,'info'=>'请填写手机号码!'));
                }


                if(!preg_match("/^1[34578]{1}\d{9}$/",$data['username'])){
                    $this->ajaxReturn(array('result'=>0,'info'=>'手机号码格式不正确!'));
                }
                if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {
                    $this->ajaxReturn(array('result'=>0,'info'=>'手机号已存在，请更换！'));
                }
                if (M('member')->where(array('username'=>trim($data['username'])))->getField('id')) {
                    $this->ajaxReturn(array('result'=>0,'info'=>'该用户已存在，请更换！'));
                }

                if(!$code){
                    $this->ajaxReturn(array('result'=>0,'info'=>'请输入短信验证码!'));
                }
                $check_code = sms_code_verify($data['username'],$code,session_id());
                if($check_code['status'] != 1){
                    $this->ajaxReturn(array('result'=>0,'info'=>$check_code['msg']));
                }

                if (empty($password)) {
                    $this->ajaxReturn(array('result'=>0,'info'=>'登陆密码不能为空'));
                }
                if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){
                    $this->ajaxReturn(array('result'=>0,'info'=>'登陆密码不能小于6位!'));
                }

				$hongbao = C('hongbao');
                $data['regaddress'] =$location['country'].$location['area']; // 所在国家或者地区
                $data['regip'] =get_client_ip(); // 所在国家或者地区

                $data['password']  = md5($password);
				$data['money']  = $hongbao;
                $parentinfo = M('member')->where(array('username'=>$data['parent']))->find();
                $data['parentpath']  = trim($parentinfo['parentpath'] . $parentinfo['id'] . '|');;
                $data['parentlayer'] = $parentinfo['parentlayer'] + 1;
                $data['regdate']     = time();
                M('member')->add($data);
                //我的上级直推加一
                M('member')->where(array('username' => $data['parent']))->setInc('parentcount',1);
                mmtjrennumadd($parent_id);//  所有上级加一人

                $this->ajaxReturn(array('result'=>1,'info'=>'注册成功！'));

            }

        }
		 

    //ajax查询推荐人会员编号
    public function checkParent(){
		if(!IS_AJAX){
			halt("页面不存在!");
		}		
        //是否存在nouser
        $member = M('member');
        if (!$member->where(array('username'=>$_POST['username']))->getField('id')) {
            $data['result'] = 'nouser';
            echo json_encode($data);
        }
        //是否激活noactivation
        if (!$nickname = $member->where(array('username'=>$_POST['username'],'status'=>1))->getField('nickname')) {
            $data['result'] = 'noactivation';
            echo json_encode($data);
        }else{
            $data['result'] = 'success';
            $data['nickname'] = $nickname;
            echo json_encode($data);
        }
    }

    //ajax查询会员编号
    public function checkUsername(){
		if(!IS_AJAX){
			halt("页面不存在!");
		}
        if (!M('member')->where(array('username'=>$_POST['username']))->getField('id')) {
            $data['result'] = 'error';
            echo json_encode($data);
        }else{
            $data['result'] = 'success';
            echo json_encode($data);
        }
    }

		//ajax生成新会员编号
		public function createNewAccount(){
			if(!IS_AJAX){
				halt("页面不存在!");
			}			
			$rand=rand(100000,999999);
			$data['result'] = $rand;
			echo json_encode($data);
		}
    /**
     * 发送手机注册验证码
     */
    public function send_sms_reg_code(){
		
		
        $mobile = I('mobile');

        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));


		
		if (M('member')->where(array('mobile'=>$mobile))->getField('id')) {
          exit(json_encode(array('status'=>-1,'msg'=>'手机号码已存在!')));
        }		
        $code =  rand(1000,9999);
        $send = sms_log($mobile,$code,session_id());
        if($send['status'] != 1){
			 exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
		}
        session('verify',null);   
		exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }

	
	
	
	
	public function send_edit_code(){
        $mobile = I('mobile');
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));		
        $code =  rand(1000,9999);
        $send = sms_log($mobile,$code,session_id());
        if($send['status'] != 1)
            exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
        exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }	




	public function verify(){
		ob_clean();
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }




    //ajax 图片上传
	
	public function uploads(){
	 
	  
	 
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		
		
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];

	   	$file_time=date('Ymd',time());
		$file_name = './Public/Uploads/touxiang/';
		if(!file_exists($file_name)){
			mkdir($file_name);
		}
	   	$path = $file_name.'/';

		$extArr = array("jpg", "png", "jpeg", "gif");
		if(empty($name)){
			echo json_encode(array('result' => 0,'msg'=>'请选择要上传的图片'));
			return;
			
		}
		$ext = $this->extend($name);
		if(!in_array($ext,$extArr)){
			echo json_encode(array('result' => 0,'msg'=>'图片格式错误'));
			return;
			
		}
		if($size>(300*1024*1024)){
			echo json_encode(array('result' => 0,'msg'=>'图片大小不能超过3M'));
			return;
			
		}
		$image_name = time().rand(100,999).".".$ext;
		$tmp = $_FILES['photoimg']['tmp_name'];
	
		$uploadip = substr($path,9);
		if(move_uploaded_file($tmp, $path.$image_name)){
			// echo '<img src="'.$uploadip.$image_name.'"  class="preview">';
			echo json_encode(array('result' => 1,'url'=>$uploadip.$image_name));
			return;
		}else{
			echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
			return;
		}
		exit;
	}
	exit;

   }

	public function extend($file_name){
		$extend = pathinfo($file_name);
		$extend = strtolower($extend["extension"]);
		return $extend;
	}





}
?>
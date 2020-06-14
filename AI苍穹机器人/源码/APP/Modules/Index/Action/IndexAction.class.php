<?php  
	
	Class IndexAction extends CommonAction{


		/**
		 * 生成验证码
		*/
		public function verify(){
			ob_clean();
			import('ORG.Util.Image');
			Image::buildImageVerify(4,1,'png',55,25);
		}



		//首页
		public function index(){
            $this->redirect("New/index");
		}


		//个人信息
		public function personal(){
			$member = M('member');
			$username = session('username');
            $id = session('mid');
			$minfo = $member->where(array('username'=>$username))->find();
            $list = M('bankcard')->where(array('userid'=>$id))->find();
            $this->assign('list',$list);
			$this->assign('minfo',$minfo);
			$this->display();
		}

        //资料修改
        public function edit(){
            $member = M('member');
            $username = session('username');
            $minfo = $member->where(array('username'=>$username))->find();
            $this->assign('minfo',$minfo);
            $this->display();
        }
        //银行卡
        public function card(){
            $userid = session('mid');
            $list = M('bankcard')->where(array('userid'=>$userid))->find();

            $name = M('member')->where(array('id'=>$userid))->getField('truename');

            $this->assign('name',$name);
            $this->assign('list',$list);
            $this->display();
        }
        //添加银行卡执行
        public function addcardpost(){
            if(IS_AJAX){
                $name['truename'] = I('post.truename');
                $data['name'] = I('post.name');
                $data['kaihuhang'] = I('post.kaihuhang');
                $data['card'] = I('post.card');

                if(empty($name['truename'] )){
                    $this->ajaxReturn(array('info'=>'请输入真实姓名！','url'=>U('Index/index/card')));
                }
                if(empty($data['name'])){
                    $this->ajaxReturn(array('info'=>'请输入银行名称！','url'=>U('Index/index/card')));
                }
                if(empty($data['kaihuhang'])){
                    $this->ajaxReturn(array('info'=>'请输入开户行！','url'=>U('Index/index/card')));
                }

                if(empty($data['card'])){
                    $this->ajaxReturn(array('info'=>'请输入银行卡号！','url'=>U('Index/index/card')));
                }

                $userid = session('mid');
                $bankcard = M('bankcard')->where(array('userid'=>$userid))->find();
                $this->assign('bankcard',$bankcard);

                if($bankcard == "" ){

                    $data1['userid'] = session('mid');
                    $data1['name'] = $data['name'];
                    $data1['kaihuhang'] = $data['kaihuhang'];
                    $data1['card'] = $data['card'];
                    $result = M('bankcard')->add($data1);
                    if(!empty($result)){

                        $this->ajaxReturn(array('result'=>1,'info'=>'银行卡添加成功','url'=>U('Index/index/personal')));
                    }else{
                        $this->ajaxReturn(array('result'=>0,'info'=>'银行卡添加失败','url'=>U('Index/index/addcard')));
                    }
                }else{

                    $result1=M('bankcard')->where(array('userid'=>$userid))->save($data);
                    if(!empty($result1)){
                        M('member')->where(array('id'=>$userid))->save($name);
                        $this->ajaxReturn(array('result'=>1,'info'=>'银行卡修改成功','url'=>U('Index/index/personal')));
                    }else{
                        $this->ajaxReturn(array('result'=>0,'info'=>'银行卡修改失败','url'=>U('Index/index/addcard')));
                    }
                }
            }
        }
        //支付宝
        public function zhifu(){
            $this->display();
        }
        //支付宝
        public function zhifupost(){

                $userid = session('mid');

                $data['zhifu'] = I('post.image');
				
                if(empty($data['zhifu'])){
                    alert('请上传支付宝收款码',U('Index/index/zhifu'));
                }
                $result = M('member')->where(array('id' => $userid))->save($data);
                if (!empty($result)) {
                    alert('支付宝修改成功',U('Index/index/personal'));
                } else {

                    alert('支付宝修改失败',U('Index/index/zhifu'));
                }

        }
        //微信
        public function wei(){

            $this->display();
        }

        //微信
        public function weipost(){

            $userid = session('mid');
            $data['wei'] = I('post.image');
            if(empty($data['wei'])){
                alert('请上传微信收款码',U('Index/index/wei'));
            }
            $result = M('member')->where(array('id' => $userid))->save($data);
            if (!empty($result)) {
                alert('微信修改成功',U('Index/index/personal'));
            } else {

                alert('微信修改失败',U('Index/index/wei'));
            }

        }


        //资料修改
        public function editname(){
            if(IS_AJAX){
                $data['truename'] = I('post.truename');
                $data['name'] = I('post.name');
                if(empty($data['truename'])){
                    $this->ajaxReturn(array('result'=>0,'info'=>'真实姓名不能为空!'));
                }
                if(empty($data['name'])){
                    $this->ajaxReturn(array('result'=>0,'info'=>'昵称不能为空!'));
                }

                $db = M('member');
                $where = array('id'=>session('mid'));

                if ($db->where($where)->save($data)) {
                    $this->ajaxReturn(array('result'=>1,'info'=>'资料修改成功','url'=>U('Index/index/personal')));
                }else{
                    $this->ajaxReturn(array('result'=>0,'info'=>'资料修改失败','url'=>U('Index/index/personal')));
                }
            }
        }
		//我的团队
		public function team(){
			$member = M('member');
			$username = session('username');

			$count = $member->where(array('parent'=>$username))->count();
			$list = $member->where(array('parent'=>$username))->field('username,id,money,truename')->select();

			foreach($list as $k=>$v){
				$list[$k]['zhitui'] =$member -> where(array('parent' => $v['username']))-> count();
				}
            $parentcount1 =$member -> where(array('username' => $username)) -> getField('parentcount');
			$parentcount = $parentcount1 - $count;
			$this->assign('count',$count);
			$this->assign('parentcount',$parentcount);
			$this->assign('list',$list);
			//$this->assign('list1',$list1);
			$this->display();
		}

        //我的团队
        public function zhitui(){
            $member = M('member');
            $username = session('username');
            $list = $member->where(array('parent'=>$username))->field('username,id,money,truename')->select();

            foreach($list as $key=>$v){
                $list[$key]['zhitui'] =$member -> where(array('parent' => $v['username']))-> count();
            }
            $this->assign('list',$list);
            $this->display();
        }

		//推广码
        public function tgm(){

            header ( "Content-type: text/html; charset=utf-8");

            $e_keyid=encrypt(session('mid'),'E','xyb8888');

            $e_keyid=str_replace('/','AAABBB',$e_keyid);

            $tuiguangma = "http://".$_SERVER['SERVER_NAME'].U('Index/Sem/regSem',array('u'=>$e_keyid));
            $erwei = M("member")->where(array('username'=>session('username')))->getField("erwei");

            if(!$erwei){
                Vendor('phpqrcode.phpqrcode');
                //生成二维码图片
                $object = new QRcode;
                $level=3;
                $size=4;
                $errorCorrectionLevel =intval($level) ;//容错级别
                $matrixPointSize = intval($size);//生成图片大小
                $path = "Public/erwei/";
                // 生成的文件名
                $fileName = $path.session('username').'.png';
                $object->png($tuiguangma,$fileName, $errorCorrectionLevel, $matrixPointSize, 2);

                import('ORG.Util.Image');
                $Image = new Image();

                define('THINKIMAGE_WATER_CENTER', 5);
                $Image->water(PUBLIC_PATH.'/encard.jpg',$fileName,$fileName,100,array(110,485));
                $erwei = '/'.$fileName;

                M("member")->where(array('username'=>session('username')))->setField("erwei",$erwei);
            }
            $this->assign('erwei',$erwei);
            $adurl=C('adurl');
            $adurl2=str_replace('[adurl]',$tuiguangma,$adurl);

            $this->assign('tuiguangma',$tuiguangma);
            $this->assign('adurl2',$adurl2);
            $this->display();
        }

        //分享
        public function fenxiang(){
            header ( "Content-type: text/html; charset=utf-8");

            $e_keyid=encrypt(session('mid'),'E','xyb8888');

            $e_keyid=str_replace('/','AAABBB',$e_keyid);

            $tuiguangma = "http://".$_SERVER['SERVER_NAME'].U('Index/Sem/regSem',array('u'=>$e_keyid));
            $erwei = M("member")->where(array('username'=>session('username')))->getField("erwei");

            if(!$erwei){
                Vendor('phpqrcode.phpqrcode');
                //生成二维码图片
                $object = new QRcode;
                $level=3;
                $size=5;
                $errorCorrectionLevel =intval($level) ;//容错级别
                $matrixPointSize = intval($size);//生成图片大小
                $path = "Public/erwei/";
                // 生成的文件名
                $fileName = $path.session('username').'.png';
                $object->png($tuiguangma,$fileName, $errorCorrectionLevel, $matrixPointSize, 2);

                import('ORG.Util.Image');
                $Image = new Image();

                define('THINKIMAGE_WATER_CENTER', 5);
                $Image->water(PUBLIC_PATH.'/encard.jpg',$fileName,$fileName,100,array(145,60));
                $erwei = '/'.$fileName;

                M("member")->where(array('username'=>session('username')))->setField("erwei",$erwei);
            }
            $this->assign('erwei',$erwei);
            $this->display();
        }
        //客服
        public function kefu(){

            $kefu1 = C('kefu1');
            $kefu2 = C('kefu2');
		    $kefu3 = C('kefu3');
            $this->assign('kefu1',$kefu1);
            $this->assign('kefu2',$kefu2);
            $this->assign('kefu3',$kefu3);
            $this->display();
        }
		//密码修改
		public function updatePass(){

			$this->display();
		}
		//执行密码修改
		public function updatePasspost(){

				
				
				$old_password = I('post.old_password','','strval');
				if(empty($old_password)){
					$this->ajaxReturn(array('result'=>0,'info'=>'原密码不能为空!'));
				}
				$db = M('member');
				$newpwd = I('post.newpwd','','strval');
				$newpwd1 = I('post.newpwd1','','strval');
				if (empty($newpwd)  || empty($newpwd1)) {
					$this->ajaxReturn(array('result'=>0,'info'=>'新登陆密码或确认密码不能为空'));
				}
				if(!preg_match("/^[a-zA-Z\d_]{6,}$/",I('post.newpwd'))){
					$this->ajaxReturn(array('result'=>0,'info'=>'新密码长度不能小于6位!'));
				}
				if ($newpwd !=$newpwd1) {
					$this->ajaxReturn(array('result'=>0,'info'=>'两次密码输入不一样!'));
				}
				$where = array('id'=>session('mid'));
				$old = $db->where($where)->getField('password');
				if ($old != MD5($old_password)) {
					$this->ajaxReturn(array('result'=>0,'info'=>'原登陆密码错误'));
				}
				if ($db->where($where)->save(array('password'=>MD5($newpwd)))) {
					$this->ajaxReturn(array('result'=>1,'info'=>'登陆密码修改成功','url'=>U('Index/index/index')));
				}else{
					$this->ajaxReturn(array('result'=>0,'info'=>'登陆密码修改失败','url'=>U('Index/index/index')));
				}

		}

		//退出系统
		public function logout(){
			//添加日志
			$desc = '会员'. session('account') .'退出';
			write_log(session('account'),'member',$desc);
			session('mid',null);
			session('username',null);
			session('member',null);
			session('usersecondlogin',null);
			$this->redirect(GROUP_NAME.'/Login/index');
		}



}
?>
<?php
	/**
	 * 后台登录控制器
	 */
	Class LoginAction extends Action{
		/**
		 * 后台登录视图
		 */
		public function index(){
			$this->display();
		}

		public function login(){
			//防止直接访问这个视图
			IS_POST or halt('页面不存在');
 			//验证码验证
			if (session('verify') != I('code','','md5')) {
				$this->error('验证码错误!');
			}
			
			//验证用户名和密码
			$user = M('user')->where(array('username'=>I('username'),'password'=>I('password','','md5')))->find();

			$user or $this->error('用户名或密码错误!');
			//验证是否已被锁定
			$user['lock'] and $this->error('用户已被锁定!');
			
			//更新最后一次登录的IP和登录时间
			$data = array(
				'id' => $user['id'],
				'logtime' => time(),
				'loginip' => get_client_ip()
			);
			M('user')->save($data); 

			
			//保存session
			session(C('USER_AUTH_KEY'),$user['id']);
			session('adminusername',$user['username']);
			session('logtime',date('Y-m-d H:i:s',$user['logtime']));
			session('loginip',$user['loginip']);


			//RBAC超级管理员识别
			if ($user['username'] == C('RBAC_SUPERADMIN')) {
				session(C('ADMIN_AUTH_KEY'),true);
			}

			//RBAC读取用户权限
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();

			//添加日志操作
			$desc = '管理员['.session('adminusername').']登录';
			write_log(session('adminusername'),'admin',$desc);

			$this->redirect(GROUP_NAME.'/Index/index');
		}

		/**
		 * 生成验证码
		 */
		public function verify(){
			import('ORG.Util.Image');
			ob_end_clean(); 
			Image::buildImageVerify(4,1,'png',55,25);
		}
	}
?>
<?php
	/**
	 * 后台首页控制器
	 */
	Class IndexAction extends CommonAction{
		/**
		 * 后台首页视图
		 */
		public function index(){
			$member = M('member');
			$Order=M('order');
			
			//总会员数量
			$this->membercount = $member->count();
			//昨日新增人数
			$s_time=strtotime(date("Y-m-d 00:00:01",strtotime('-1 day')));
			$o_time=strtotime(date("Y-m-d 23:59:59",strtotime('-1 day')));
			$this->Yesterday_menber_number= $member->where("regdate > {$s_time} and regdate < {$o_time}")->count();

			//今日新增人数
			$s_time=strtotime(date("Y-m-d 00:00:01"));
			$o_time=strtotime(date("Y-m-d 23:59:59"));
			$this->Today_menber_number= $member->where("regdate > {$s_time} and regdate < {$o_time}")->count();
			
			
			//在线会员
			$oo_time=time()-(5*60);
			
			$this->Online_menber_number= $member->where("online_time > {$oo_time}")->count();
			

			//算出总共产了多少币 根据日字
			$data_b=M("jinbidetail")->where("type = 1")->sum('adds');
			

			
			//昨天有多少矿机
			$s_time=date("Y-m-d 00:00:01",strtotime('-1 day'));
			$o_time=date("Y-m-d 23:59:59",strtotime('-1 day'));
			$data_c=$Order->where("zt = 1 and addtime < '{$o_time}'")->count();
			
			//昨天产了多少币

			
			$s_time=strtotime(date("Y-m-d 00:00:01",strtotime('-1 day')));
			$o_time=strtotime(date("Y-m-d 23:59:59",strtotime('-1 day')));
			$data_d=M("jinbidetail")->where("type = 1 and addtime > {$s_time} and addtime < {$o_time}")->sum('adds');
			
			
			//今天有多少矿机
			$data_e=$Order->where("zt = 1")->count();

			
			//今天产了多少币 根据日志
			$s_time=strtotime(date("Y-m-d 00:00:01"));
			$o_time=strtotime(date("Y-m-d 23:59:59"));
			$data_f=M("jinbidetail")->where("type = 1 and addtime > {$s_time} and addtime < {$o_time}")->sum('adds');

			 $this->assign('data_b',$data_b);
			 $this->assign('data_c',$data_c);
			 $this->assign('data_d',$data_d);
			 $this->assign('data_e',$data_e);
			 $this->assign('data_f',$data_f);
			

			$this->display();
		}

		/**
		 * 后台退出登录
		 */
		public function logout(){
			//添加日志
			$desc = '管理员'. session('adminusername') .'登出';
			write_log(session('adminusername'),'admin',$desc);
			//销毁session
			//session('[destroy]');
			session('adminusername',null);
			session('logtime',null);
			session('loginip',null);
			unset($_SESSION['superadmin']);
			$this->redirect(GROUP_NAME.'/Login/index');
		}

	}
?>
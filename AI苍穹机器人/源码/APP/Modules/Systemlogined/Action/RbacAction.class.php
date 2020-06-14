<?php
	
	Class RbacAction extends CommonAction{
	  	//用户列表
		public function index(){
			$user = D('UserRelation')->field('password',true)->relation(true)->select();
			$this->assign('user',$user);
			$this->display();
		}

		//修改用户视图
		public function editUser(){
			$user = D('UserRelation')->where(array('id'=>I('get.id')))->field('password',true)->relation(true)->select();
			$role = M('role')->select();
			$this->assign('role',$role);
			$this->assign('user',$user[0]);
			$this->display();
		}

		//修改用户处理
		public function editUserHandle(){
			//判断两次密码是否输入一致
			if (I('password') != I('password2')) {
				$this->error('对不起，两次密码不一致!');
			}

			//判断用户名是否存在
			$user = M('user')->where(array('username'=>I('username')))->find();
			if ($user['id'] != I('uid')) {
				$this->error('对不起，用户名已经存在');
			}

			$password = I('password','','');
			if (empty($password)) {
				//如果密码为空就不修改
				unset($_POST['password']);
			}else{
				$_POST['password'] = md5($password);
			}
			$role = $_POST['role'];
			unset($_POST['role']);
	
			M('user')->where(array('id'=>$_POST['uid']))->save($_POST);//更新会员信息 
			//先删除用户所佣有的角色
			$db = M('role_user');
			//删除原来的所角色
			$db->where(array('user_id'=>I('uid')))->delete(); 
			//添加新的角色
			foreach ($role as $v) {
				$data[] = array(
						'role_id'=> $v,
						'user_id'=> I('uid')
						);
			}
			$db->addAll($data);
			//添加日志操作
			$desc = '编辑ID为'. I('uid') .'的管理员';
			write_log(session('username'),'admin',$desc);

			$this->success('编辑成功!',U(GROUP_NAME.'/Rbac/index'));
			
		}

		//删除用户
		public function deleteUser(){
			$id = I('get.id','','intval');
			$db = D('UserRelation');
			$user = $db->where(array('id'=>$id))->relation(true)->select();
			//防止删除超级管理员
			$user[0]['username']==C('SPECIAL_USER') && $this->error('禁止删除此用户!');
			//开始删除用户
			if ($db->where(array('id'=>$id))->delete()) {
				//开始删除中间表role_user
				if (M("role_user")->where(array('user_id'=>$id))->delete()) {
					//添加日志操作
					$desc = '删除了ID为'. $id .'的用户';
					write_log(session('username'),'admin',$desc);

					$this->success('删除成功!',U(GROUP_NAME.'/Rbac/index'));
				}else{
					$this->error('用户删除成功，但角色关系删除失败!');
				}
			}else{
				$this->error('删除失败!');
			}
		}

		//角色列表
		public function role(){
			$this->assign('role',M('role')->select());
			$this->display();
		}

		//节点列表
		public function node(){
			$field = array('id','name','title','pid');
			$node = M('node')->field($field)->order('sort')->select();
			//重组节点
			$this->assign('node',node_merge($node));
			$this->display();
		}

		//编辑节点
		public function editNode(){
			$node = M('node')->where(array('id'=>I('nid','','intval')))->select();
			$this->assign('node',$node[0]);
			$this->display();
		}

		//编辑节点处理
		public function editNodeHandle(){
			$nid = I('nid',0,'intval');
			unset($_POST['nid']);
			if (M('node')->where(array('id'=>$nid))->save($_POST)) {
				$this->success('编辑成功！',U(GROUP_NAME.'/Rbac/node'));
			}else{
				$this->error('编辑失败！');
			}
			
		}

		//删除节点
		public function deleteNode(){
			//type 1:应用 2:控制器 3:方法
			$nid = I('nid',0,'intval');
			$type = I('type',0,'intval');
			$node = M('node')->where(array('pid'=>$nid))->select();
			switch ($type) {
				case 1:
					if (count($node)) {
						$this->error('删除失败，请先删除应用下面的控制器!');
					}else{
						$this->deleteNodeHandle('node',array('id'=>$nid),'access',array('node_id'=>$nid));
					}
					break;
				case 2:
					if (count($node)) {
						$this->error('删除失败，请先删除控制器下面的方法!');
					}else{
						$this->deleteNodeHandle('node',array('id'=>$nid),'access',array('node_id'=>$nid));
					}
					break;
				case 3:
					$this->deleteNodeHandle('node',array('id'=>$nid),'access',array('node_id'=>$nid));
					break;
			}
		}

		public function deleteNodeHandle($node,$narray,$access,$aarray){
			//删除node表中的数据
			$result = M($node)->where($narray)->delete();
			//删除access表中的数据
			M($access)->where($aarray)->delete();
			$this->success('节点删除成功!',U(GROUP_NAME.'/Rbac/node'));
		}

		//添加用户
		public function addUser(){
			$role = M('role')->select();
			$this->assign('role',$role);
			$this->display();
		}
		
		//添加用户处理方法
		public function addUserHandle()
		{
			$user = array(
				'username'=>I('username'),
				'password'=>I('password','','md5'),
				'logtime'=>time(),
				'loginip'=>get_client_ip()
				);
			$role = array();

			//判断用户名是否重复
			if (M('user')->where(array('username'=>I('username')))->getField('id')) {
				$this->error('对不起，用户名已被使用');
			}

			if ($uid = M('user')->add($user)) {
				foreach ($_POST['role_id'] as $v) {
					$role[] = array(
						'role_id'=> $v,
						'user_id'=> $uid
						);
				}
				M('role_user')->addAll($role);
				//添加日志操作
				$desc = '添加了一个新用户';
				write_log(session('username'),'admin',$desc);

				$this->success('添加成功',U(GROUP_NAME.'/Rbac/index'));
			}else{
				$this->error('添加失败');
			}
		}

		/**
		 * 异步验证用户名是否存在
		 * @return [type] [description]
		 */
		Public function checkUserName(){
			//判断是否异步提交
			IS_AJAX or halt('对不起，页面不存在');

			if (M('user')->where(array('username'=>I('username')))->getField('id')) {
				echo 'false';
			}else{
				echo 'true';
			}
		}

		//添加角色
		public function addRole(){
			$this->display();
		}

		//添加角色表单处理
		public function addRoleHandle(){
			if (M('role')->add($_POST)) {
				//添加日志操作
				$desc = '添加一个新的角色';
				write_log(session('username'),'admin',$desc);

				$this->success('添加成功',U(GROUP_NAME.'/Rbac/role'));
			}else{
				$this->error('添加失败');
			}
		}

		//异步验证角色名是否存在
		public function checkRoleName(){
			//判断是否异步提交
			IS_AJAX or halt('对不起，页面不存在');

			if (M('role')->where(array('name'=>I('name')))->getField('id')) {
				echo 'false';
			}else{
				echo 'true';
			}
		}

		//添加节点
		public function addNode(){
			//如果不是通过子节点传过来的就设置默认值
			$this->pid = I('pid',0,'intval');//pid 0表示 后台或前台应用，最顶节点
			$this->level = I('level',1,'intval');//level 1表示应用 2表示控制器 3.表示方法
			switch ($this->level) {
				case 1:
					$this->type='应用';
					break;
				case 2:
					$this->type='控制器';
					break;
				case 3:
					$this->type='动作方法';
					break;
			}
			$this->display();
		}

		//添加节点的处理
		public function addNodeHandle(){
			if (M('node')->add($_POST)) {
				$this->success('添加成功！',U(GROUP_NAME.'/Rbac/node'));
			}else{
				$this->error('添加失败！');
			}
		}

		//修改角色
		public function editRole(){
			$role = M('role')->where(array('id'=>I('rid')))->select();
			$this->assign('role',$role[0]);
			$this->display();
		}

		//修改角色处理
		public function editRoleHandle(){
			$rid = I('rid',0,'intval');
			unset($_POST['rid']);

			M('role')->where(array('id'=>$rid))->save($_POST);
			//添加日志
			$desc = '修改ID为'. $rid .'的角色';
			write_log(session('username'),'admin',$desc);

			$this->success('角色修改成功!',U(GROUP_NAME.'/Rbac/role'));

		}

		//删除角色
		public function deleteRole(){
			//删除role表的数据
			M('role')->where(array('id'=>I('rid')))->delete();
			//删除中间表的数据
			M('role_user')->where(array('role_id'=>I('rid')))->delete();
			//删除节点数据
			M('access')->where(array('role_id'=>I('rid')))->delete();
			//添加日志
			$desc = '删除ID为'. I('rid') .'的角色';
			write_log(session('username'),'admin',$desc);

			$this->success('删除成功!',U(GROUP_NAME.'/Rbac/role'));
		}

		//配置权限
		public function access(){
			$rid = I('rid',0,'intval');
			$field = array('id','name','title','pid');
			$node = M('node')->field($field)->order('sort')->select();
		
			//读取原有的权限
			$access = M('access')->where(array('role_id'=>$rid))->getField('node_id',true);
			$node = node_merge($node,$access);
			$this->assign('node',$node);
			$this->assign('rid',$rid);
			$this->display();
		}

		//修改权限
		public function setAccess(){
			$rid = I('rid',0,'intval');
			$db = M('access');
			//清空原权限
			$db->where(array('role_id'=>$rid))->delete();

			//组合新权限
			$data = array();
			foreach ($_POST['access'] as $v) {
				$tmp = explode('_', $v);
				$data[] = array(
					'role_id'=>$rid,
					'node_id'=>$tmp[0],
					'level'=>$tmp[1]
				); 
			}
			//更新权限
			if ($db->addAll($data)) {
				//添加日志操作
				$desc = '修改权限ID'.$rid;
				write_log(session('username'),'admin',$desc);

				$this->success('修改成功!',U(GROUP_NAME.'/Rbac/role'));
			}else{
				$this->error('修改失败!');
			}


		}
	}
?>
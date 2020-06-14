<?php
class JinbidetailAction extends CommonAction {




	public function index(){
		$map = $this -> _search();
		if ($_GET['type']) {
			$map['type'] = array("eq",$_GET['type']);
		}
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$name = $this -> getActionName();
		$model = D($name);

		if (!empty($model)) {
			$this -> _list($model, $map);
		}

		$this->display();
	}
	/**
	 * 金币充值记录
	 * @return [type] [description]
	 */
	public function jinbiAddList(){
		$map = $this -> _search();
		$map['desc'] = '平台充值';
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$name = $this -> getActionName();
		$model = D($name);

		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> display();
	}

	/**
	 * 电子货币明细
	 * @return [type] [description]
	 */
	public function emoneyList(){

		$Data = M('emoneydetail'); // 实例化Data数据对象
		import("@.ORG.Util.Page");// 导入分页类
		$map = array();
		if (isset($_GET['account']) && $_GET['account']!='') {
			$map['account'] = $_GET['account'];
		}

		$count      = $Data->where($map)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数


		$list = $Data->where($map)->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);// 赋值数据集
		$this->display(); // 输出模板
	}

	/**
	 * 电子货币提现
	 * @return [type] [description]
	 */
	public function emoneyWithdraw(){
		$Data = M('emoneydetail'); // 实例化Data数据对象
		import("@.ORG.Util.Page");// 导入分页类
		$map = array();
		if (isset($_POST['account']) && $_POST['account']!='') {
			$map['member'] = array("eq",$_POST['account']);
		}
		if (isset($_POST['start_time']) && $_POST['start_time']!='') {
			$map['addtime'] = array("egt",strtotime($_POST['start_time']));
		}
		if (isset($_POST['end_time']) && $_POST['end_time']!='') {
			$map['addtime'] = array("elt",strtotime($_POST['end_time']));
		}

		$count      = $Data->where($map)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数


		$list = $Data->where($map)->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);// 赋值数据集
		$this->display(); // 输出模板
	}

	//提现信息查看页面
	public function	editEmoney(){
		$emoneydetail = M('emoneydetail')->where(array('id'=>I('id'),'status'=>0))->find();
		if(empty($emoneydetail)){
			$this->error('非法操作!');
		}
		$this->assign('emoneydetail',$emoneydetail);
		$this->display('editEmoney');
	}
	//提现信息处理
	public function editemoneyhandle(){
		$id = I('id',0,'intval');
		unset($_POST['id']);
		$list =M('emoneydetail')->where(array('id'=>$id))->find();
		
		$type = $_POST['type'];
		if($type == 0){
			$this->error('提现处理无效!',U(GROUP_NAME.'/Jinbidetail/emoneyWithdraw'));
		}elseif($type == 1){
			if(M('emoneydetail')->where(array('id'=>$id))->save(array('status'=>$type))){
				M('member')->where(array('username'=>$list['username']))->setDec('dongjie',$list['amount']);
				$this->success('提现处理完成!',U(GROUP_NAME.'/Jinbidetail/emoneyWithdraw'));
			}
		}elseif($type ==2){
			if(M('emoneydetail')->where(array('id'=>$id))->save(array('status'=>$type))){
				M('member')->where(array('username'=>$list['username']))->setInc('money',$list['amount']);
				// account_log(session('username'),$list['amount'],'提现被拒',1);
				M('member')->where(array('username'=>$list['username']))->setDec('dongjie',$list['amount']);
				// account_log4(session('username'),$list['amount'],'提现被拒',0);
				$this->success('提现处理完成!',U(GROUP_NAME.'/Jinbidetail/emoneyWithdraw'));
			}
		}

		//添加日志
		$desc = 'ID为'. $id .'的提现处理';
		write_log($list['username'],'admin',$desc);


	}


	public function qjinbi(){
		$Data = M('qjinbidetail'); // 实例化Data数据对象
		import("@.ORG.Util.Page");// 导入分页类
		$map = array();
		if (isset($_POST['account']) && $_POST['account']!='') {
			$map['member'] = array("eq",$_POST['account']);
		}

		$count      = $Data->where($map)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,15);// 实例化分页类 传入总记录数


		$list = $Data->where($map)->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);// 赋值数据集
		$this->display(); // 输出模板
	}


	public function paylist(){

		$Dao = new Model();

		$list = $Dao->query("select * from codepay_order");

		$this->assign('list',$list);// 赋值数据集
		$this->display(); // 输出模板
	}

}

<?php  
	//消息相关控制器
	Class MsgAction extends CommonAction{

		//联系我们
		public function index(){
			$this->display();
		}

		//提交留言
		public function addMsg(){
			$username =  session('username');
			$list = M('message')->order('addtime asc')->select();
			if (IS_POST) {
				$content=I('content','','htmlspecialchars');
				if(empty($content)){
					alert('请输入发送内容',U('Index/Msg/addMsg'));
				}
				$pic = M('member')->where(array('username'=>session('username')))->Field('pic,truename')->find();
				$data['from'] = session('username');
				$data['pic'] = $pic['pic'];
				$data['truename'] = $pic['truename'];
				$data['addtime'] = time();
				$data['content'] = $content;
				if(M('message')->add($data)){
					alert('发送成功',U('Index/Msg/addMsg'));
				}else{
					alert('发送失败',U('Index/Msg/addMsg'));
				}
			}
			$this->assign('list',$list);
			$this->assign('username',$username);
			$this->display();
		}


	}
?>
<?php  
	
	/**
	 * 公告留言控制器
	 */
	Class InfoAction extends CommonAction{

		//公告类别视图
		public function annType(){
			$type = M('announcetype')->select();
			$this->assign('type',$type);
			$this->display();
		}



		//添加公告类别视图
		public function addAnnounceType(){
			$this->display();
		}

		//添加公告类别处理
		public function addAnnounceTypeHandle(){

			if (M('announcetype')->data(array('name'=>I('name')))->add()) {
				//添加日志操作
				$desc = '添加一个新的公告类别';
				write_log(session('username'),'admin',$desc);

				$this->success('添加成功!',U(GROUP_NAME.'/Info/annType'));
			}else{
				$this->error('添加失败!');
			}
		}
		
		//修改公告类别视图
		public function editAnnounceType(){
			$type = M('announcetype')->where(array('id'=>I('id')))->find();
			$this->assign('type',$type);
			$this->display();
		}

		//修改公告类别处理
		public function editAnnounceTypeHandle(){
			M('announcetype')->where(array('id'=>I('tid')))->save(array('name'=>I('name')));
			//添加日志操作
			$desc = '修改了一个公告类别';
			write_log(session('username'),'admin',$desc);

			$this->success('修改类别名称成功！',U(GROUP_NAME.'/Info/annType'));
		}

		//删除公告类别
		public function deleteAnnounceType(){
			//删除公告类别
			//先判断当前类别是否有公告
			if (M('announce')->where(array('tid'=>I('id')))->find()) {
				$this->error('对不起，该分类下面有公告！');
			}else{
				M('announcetype')->where(array('id'=>I('id')))->delete();
				//添加日志操作
				$desc = '删除公告类别';
				write_log(session('username'),'admin',$desc);

				$this->success('删除成功！');
			}	
		}

		//公告列表视图
		public function announce(){
			$ann = D('AnnounceRelation')->relation(true)->select();
			$this->assign('ann',$ann);
			$this->display();
		}

		//添加公告视图
		public function addAnnounce(){
		
			//获取公告类别
			$type = M('announcetype')->select();
			$this->assign('type',$type);
			$this->assign('time',time());
			$this->display();
		}



		Public function upload(){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 1000000 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/Uploads/zixun/'.date("Ymd",NOW_TIME)."/";// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			if($info){
				$savepath = str_replace(".","",$info[0]['savepath']);
				$filePath = $savepath.$info[0]['savename'];
				return $filePath;
			}else{
				$this -> error($upload -> getError());
			}
		}
		//添加公告处理
		public function addAnnounceHandle(){

			$_POST['addtime'] = strtotime($_POST['addtime']);
			$_POST['edittime'] = $_POST['addtime'];
			$_POST['image'] =  $this -> upload();
			if (M('announce')->data($_POST)->add()) {
				//添加日志操作
				$desc = '发布公告';
				write_log(session('username'),'admin',$desc);

				$this->success('添加成功!',U(GROUP_NAME.'/Info/announce'));
			}else{
				$this->error('添加失败！');
			}
		}

		//修改公告视图
		public function editAnnounce(){
			$type = M('announcetype')->select();
			$ann = D('AnnounceRelation')->where(array('id'=>I('id')))->relation(true)->find();
			$ann['content'] = stripslashes($ann['content']);
			$this->assign('ann',$ann);
			$this->assign('type',$type);
			$this->display();
		}

        //修改公告视图
        public function xiangmu(){
            $ann = M('xiangmu')->where(array('id'=>1))->find();
            $this->assign('ann',$ann);
            $this->display();
        }
        //修改项目处理
        public function editxiangmu(){
            $_POST['edittime'] = time();
            $id = I('aid');
            unset($_POST['aid']);

            M('xiangmu')->where(array('id'=>$id))->data($_POST)->save();
            //添加日志操作
            $desc = '修改项目';
            write_log(session('username'),'admin',$desc);

            $this->success('修改成功',U(GROUP_NAME.'/Info/xiangmu'));
        }

		//修改公告处理
		public function editAnnounceHandle(){
			$_POST['edittime'] = time();
			$id = I('aid');
			unset($_POST['aid']);
			$_POST['image'] =  $this -> upload();
			M('announce')->where(array('id'=>$id))->data($_POST)->save();
			//添加日志操作
			$desc = '修改公告';
			write_log(session('username'),'admin',$desc);

			$this->success('修改成功',U(GROUP_NAME.'/Info/announce'));
		}

		//删除公告
		public function deleteAnnounce(){
			if (M('announce')->where(array('id'=>I('id')))->delete()) {
				//添加日志操作
				$desc = '删除公告';
				write_log(session('username'),'admin',$desc);
				//同时删除 对应用户新闻表
				M("announce_click")->where(array('news_id'=>I('id')))->delete();
				
				
				$this->success('删除成功!');
			}else{
				$this->error('删除失败!');
			}
			
		}

		//收件箱
		public function msgReceive(){
			import("@.ORG.Util.Page");// 导入分页类
			$count      = M('message')->count();// 查询满足要求的总记录数
	        $Page       = new Page($count,30);// 实例化分页类 传入总记录数
			
			$msg = M('message')->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
			$show       = $Page->show();// 分页显示输出
			$this->assign('msg',$msg);
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
		}

		//AJAX返回查询到的留言信息
		public function ajaxMsgReceive(){
			//判断是否异步提交
			IS_AJAX or halt('对不起，页面不存在');

			$message = M('message'); 
			$data = $message->where(array('id'=>I('id')))->find();
			$message->where(array('id'=>I('id')))->setField('hasview',1);
			$this->ajaxReturn($data,'JSON');
		}

		//异步回复留言
		public function addMessage(){
			$data['from'] = '18888888888';
			$data['pic'] = '/public/wx/wx/guanliyuan.jpg';
			$data['content'] = I('post.content');
			$data['truename'] = '管理员';
			$data['addtime'] = time();
			if (M('message')->add($data)) {
				$this->success('发送成功',U(GROUP_NAME.'/Info/msgReceive'));
			 }else{
				$this->error('发送失败');
			 }
		}

		//删除留言
		public function deleteMessage(){
			if (M('message')->where(array('id'=>I('id')))->delete()) {
				//添加日志操作
				$desc = '删除留言';
				write_log(session('username'),'admin',$desc);

				$this->success('删除成功',U(GROUP_NAME.'/Info/msgReceive'));
			}else{
				$this->error('删除失败');
			}
		}

	}
?>
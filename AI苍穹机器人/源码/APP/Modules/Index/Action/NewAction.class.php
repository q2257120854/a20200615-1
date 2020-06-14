<?php  
	
	Class NewAction extends Action{

		//资讯详细页
		public function index(){
		    $gonggao = C('gonggao');
			$banner = M('banner')->order('addtime desc')->select();
            $mai_log=M('order')->field('user,addtime')->order('id desc')->select();
			
			$username = session('username');
			if($username == ""){
				
					$status = 0;
				}else{
					$status = 1;
					$shouyi = M('jinbidetail')->where(array('member'=>$username))->sum('adds');
					$liuliang = M('jinbidetail')->where(array('member'=>$username,'type'=>1))->sum('adds');
					$tuiguang = M('jinbidetail')->where(array('member'=>$username,'type'=>2))->sum('adds');
					 $shouyi = sprintf('%.2f',$shouyi);
					$liuliang = sprintf('%.2f',$liuliang);
					$tuiguang = sprintf('%.2f',$tuiguang);
					$this->assign('shouyi',$shouyi);
					$this->assign('tuiguang',$tuiguang);
					$this->assign('liuliang',$liuliang);
				
			}

            $this->assign('status',$status);
            $this->assign('mai_log',$mai_log);
			$this->assign('banner',$banner);
			$this->assign('gonggao',$gonggao);
			$this->display();
		}

        public function xiangmu(){

            $new=M('xiangmu')->where(array('id'=>1))->find();
            $this->assign('new',$new);

            $this->display();

        }

		public function help(){
            $new=M('announce')->where(array('tid'=>2))->order("id asc")->select();
            $this->assign('new',$new);
			$this->display();

		}
        public function video(){

            $this->display();

        }
        public function gonggao(){
		    $gonggao = C('gonggao');
            $this->assign('gonggao',$gonggao);
            $this->display();

        }
		public function xiangqing(){
            $id=I('get.id',0,'intval');

            if(empty($id)){
                $this->error('页面不存在！');
            }
            $new=M('announce')->where(array('id'=>$id))->find();
            $this->assign('new',$new);

			$this->display();

		}


	}
<?php  
	/**
	 * 会员前台公共控制器
	 */
	Class CommonAction extends Action{

		public function _initialize(){
			header("Content-Type:text/html; charset=utf-8");
			
				
			//判断是否关闭了网站
			$open_web=C('open_web');
			if(empty($open_web)){
				$this->open_web_notice=C('open_web_notice');
				$this->display('Index:404');
					exit;
			}

			
	  		if(!isset($_SESSION['mid']) && !isset($_SESSION['username']) ){
	  			$this->redirect('Index/Login/index');
	  		}else{
				  $memberinfo = M("member")->where(array('username'=>$_SESSION['username']))->find();
				  $this->memberinfo = $memberinfo;
				  M("member")->where(array('id'=>$_SESSION['mid']))->save(array('online_time'=>time()));
				  
			}

            if ($_SESSION['username'] == 'admin') {
                $this->redirect('Index/Login/index');
            }
		
		}

	}
?>
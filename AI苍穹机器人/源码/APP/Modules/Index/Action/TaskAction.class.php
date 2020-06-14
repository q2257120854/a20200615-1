<?php  
	//消息相关控制器
	Class TaskAction extends CommonAction{


		public function index(){
            $username = session('username');
            $jifen = M('member')->where(array('username'=>$username))->getField('jifen');
            $banner = M('banner')->order('addtime desc')->select();
            $duihuan = C('duihuan');
            $this->assign('jifen',$jifen);
            $this->assign('duihuan',$duihuan);
            $this->assign('banner',$banner);
			$this->display();
		}


		public function complete(){
			$this->display();
		}
		public function completepost(){

			$username = session('username');

			$pic =  I('post.image');
            if(empty($pic)){
                alert('请选择要上传的图片！',U('Index/task/complete'));
            }

            $s_time=strtotime(date("Y-m-d 00:00:01"));
            $o_time=strtotime(date("Y-m-d 23:59:59"));
            $jinbi = C('jinbi');
            $count = M('complete')->where("addtime > {$s_time} and addtime < {$o_time} and username  = {$username} ")->count();    //个人上传与否

                if($count >= 1){

                    alert('您今日已经上传过一次图片了，请明天再来!',U('Index/task/index'));
                }else{

                    $data['username'] = $username;
                    $data['pic'] = $pic;
                    $data['jinbi'] = $jinbi;
                    $data['addtime'] = time();
                    $result=M('complete')->add($data);

                    if(!empty($result)){

                        alert('提交成功，请等待系统审核！',U('Index/task/index'));
                    }else{

                        alert('提交失败，请重新提交！',U('Index/task/complete'));
                    }
                }



		}

		//完成记录
		public function completelog(){
			$list =M('complete')->where(array('username'=>session('username'),'status'=>1))->select();
			$this->assign('list',$list);
			$this->display();
		}

        //订单提交
        public function duihuan(){

            $id =  C('faquan');
            $product = M("product");

            //查询机器人信息
            $data = $product -> find($id);
            if(empty($data)){
                alert('机器人不存在',U('Robot/index'));
            }

            $letter = M('type')->where(array('id'=>$data['tid']))->getField('name');
            //判断 是否已经达到限购数量
            $my_gounum=M("order")->where(array("user"=>session('username'),"sid"=>$id))->count();
            if($my_gounum >=$data['xiangou']){
                echo '<script>alert("已经达到金币兑换机器人的上线！");window.history.back(-1);</script>';
                die;
            }
            if($data['stock'] < 1){
                echo '<script>alert("机器人已经兑换完毕，请改日再来！");window.history.back(-1);</script>';
                die;
            }
            $faquan = C('faquan');

            $username = session('username');
            if($id == $faquan) {
                $jifen = M('member')->where(array('username' => $username))->getField('jifen');
                if ($jifen < $data['price']) {
                    alert('金币不足,快去发圈赚取金币吧！', U('task/index'));
                }

                M("member")->where(array('username' => session('username')))->setDec('jifen', $data['price']);
                $map = array();
                $map['kjbh'] = $letter . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
                $map['user'] = $username;
                $map['user_id'] = session('mid');
                $map['project'] = $data['title'];
                $map['sid'] = $data['id'];
                $map['yxzq'] = $data['yxzq'];
                $map['shouyi'] = $data['shouyi'];
                $map['sumprice'] = $data['price'];
                $map['addtime'] = date('Y-m-d H:i:s');
                $map['imagepath'] = $data['thumb'];
                $map['zt'] = 1;
                $map['UG_getTime'] = time();
                if (M('order')->add($map)) {
                    M('member')->where(array('username' => $username))->setInc('robotcount');
                }
            }
            $product->where(array("id" => $id))->setDec("stock");
            alert('机器人兑换成功', U('Robot/robot'));
        }

		//上传图片
		//ajax 图片上传

		public function uploads(){



			if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){


				$name = $_FILES['photoimg']['name'];
				$size = $_FILES['photoimg']['size'];

				$file_time=date('Ymd',time());
				$file_name = './Public/Uploads';
				if(!file_exists($file_name)){
					mkdir($file_name);
				}
				$path = $file_name.'/';

				$extArr = array("jpg", "png", "gif", "jpeg");
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
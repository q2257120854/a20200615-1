<?php  
	//消息相关控制器
	Class RobotAction extends CommonAction{


		public function index(){
            $user_id=session('mid');
            $count = M('order') ->where(array('user_id'=>$user_id,'zt'=>1))->count();
            $minfo = M('member')->where(array('id'=>$user_id))->find();
            $this -> assign('minfo',$minfo);
            $this -> assign('count',$count);
			$this->display();
		}
		//商品详情
		public function pcontent(){

            $product = M("product");
            $typeData = $product -> where("is_on = 0") ->order("id asc") -> select();
            $this->assign("typeData",$typeData);


            $this->display();
		}

        //订单提交
        public function buy(){

            $id =  I('get.id',0,'intval');
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
                echo '<script>alert("已经达到当前机器人的上线！");window.history.back(-1);</script>';
                die;
            }
            if($data['stock'] < 1){
                echo '<script>alert("机器人已经购买完毕，请改日再来！");window.history.back(-1);</script>';
                die;
            }
            $faquan = C('faquan');

            $username = session('username');
            $tuijian = M('member')->where(array('username'=>$username))->getField('parent');
            if($id == $faquan) {
                $jifen = M('member')->where(array('username' => $username))->getField('jifen');
                if ($jifen < $data['price']) {
                    alert('账户金币不足,快去赚取金币吧！', U('task/index'));
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
            }else {

                $jinbi = getMemberField('money');
                if ($jinbi < $data['price']) {
                    alert('账户余额不足,请先进行充值', U('wallet/onlinerecharge'));
                }

                M("member")->where(array('username' => session('username')))->setDec('money', $data['price']);
                account_log(session('username'), $data['price'], '购买' . $data['title'], 0);
                $map = array();
                $map['kjbh'] = $letter . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
                $map['user'] = $username;
                $map['tuijian'] = $tuijian;
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
                    $one = C('ONE');
                    $two = C('TWO');
                    $three = C('THREE');
                    $ones = C('ONES');
                    $twos = C('TWOS');
                    $threes = C('THREES');
                    $parent = getMemberField('parent');
                    $parent1 = M('member')->where(array('username' => $parent))->getField('parent');
                    $parent2 = M('member')->where(array('username' => $parent1))->getField('parent');

                    $parentcount = M('order')->where(array('user' => $parent))->count();
                    $parentcount1 = M('order')->where(array('user' => $parent1))->count();
                    $parentcount2 = M('order')->where(array('user' => $parent2))->count();

                    if ($parentcount > 0) {

                        M("member")->where(array('username' => $parent))->setInc('money', $one);
                        account_log($parent, $one, '1级购买奖励', 1, 2, 1, 0, $username);

                    } else {
                        M("member")->where(array('username' => $parent))->setInc('money', $ones);
                        account_log($parent, $ones, '1级购买奖励', 1, 2, 1, 0, $username);
                    }

                    if ($parentcount1 > 0) {
                        M("member")->where(array('username' => $parent1))->setInc('money', $two);
                        account_log($parent1, $two, '2级购买奖励', 1, 2, 1, 0, $username);

                    } else {
                        M("member")->where(array('username' => $parent1))->setInc('money', $twos);
                        account_log($parent1, $twos, '2级购买奖励', 1, 2, 1, 0, $username);
                    }
                    if ($parentcount2 > 0) {
                        M("member")->where(array('username' => $parent2))->setInc('money', $three);
                        account_log($parent2, $three, '3级购买奖励', 1, 2, 1, 0, $username);

                    } else {
                        M("member")->where(array('username' => $parent2))->setInc('money', $threes);
                        account_log($parent2, $threes, '3级购买奖励', 1, 2, 1, 0, $username);
                    }
                }
                $user_id = session('mid');
                $p_id=M('member')->where("id = {$user_id}")->getField('parent_id');
                $daishu=C('daishu');

                if(!empty($p_id)){
                    for($i=1;$i<=$daishu;$i++){
                        $p_userinfo=M('member')->where("id = {$p_id}")->find();
                        if(!empty($p_userinfo)){
                            if($p_userinfo['level'] == 1 ){//判断是否是城主
                                $buyjj=C('buyjj');
                                M('member')->where("id = {$p_id}")->setInc("money",$buyjj);

                                account_log($p_userinfo['username'],$buyjj,$i.'代/ID号'.$user_id,1,2);
                            }
                            $p_id=$p_userinfo['parent_id'];
                            if(empty($p_id)){
                                break;
                            }
                        }else{

                            break;
                        }
                    }
                }

            }
            $product->where(array("id" => $id))->setDec("stock");
            alert('机器人购买成功', U('Robot/robot'));
        }
		public function rank(){
			$list = M('member')->order('robotcount desc')->limit(3)->select();

			$lists = M('member')->order('robotcount desc')->limit(3,27)->select();
			$this->assign('list',$list);
			$this->assign('lists',$lists);
			$this->display();
		}

		public function robot(){

            $zt=I('get.zt',1,'intval');
            $user_id=session('mid');
            $order = M("order");
            import("ORG.Util.Page");
            $count = $order ->where("user_id = {$user_id} and zt = {$zt}")->count();
            $count1 = $order ->where(array('user_id'=>$user_id,'zt'=>$zt))->count();
            $Page       = new Page($count,8);
            $Page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
            $show = $Page -> show();
            $jiesuan_time = C('jiesuan_time');
            $orders = $order->where("user_id = {$user_id} and zt = {$zt}") -> limit($Page ->firstRow.','.$Page -> listRows)->order('id desc') -> select();
            foreach($orders as $k=>$v){

                $a_time = (time()-strtotime($v['addtime']))/3600;

                $orders[$k]['a_time']=round($a_time,2);
                if(time()-$v['UG_getTime'] < $jiesuan_time*3600){
                    $orders[$k]['is_jiesuan']=0;
                }else{
                    $orders[$k]['is_jiesuan']=1;//可以结算
                }
            }
            $sum = $order ->where(array('user_id'=>$user_id))->sum('already_profit');
            $rwsm = C('rwsm');

            $mrkd = C('mrkd');
            $time = time();
            $this -> assign("jiesuan_time",$jiesuan_time);
            $this -> assign("count1",$count1);
            $this -> assign("sum",$sum);
            $this->assign('time',$time);
            $this->assign('mrkd',$mrkd);
            $this->assign('rwsm',$rwsm);
            $this -> assign("page",$show);
            $this -> assign("zt",$zt);
            $this -> assign("orders",$orders);
            $this -> display();


		}


        public function jiesuan(){

            $id=I('get.id',0,'intval');

            $user_id=session('mid');
            $username=session('username');
            if(empty($id)){
                alert('参数丢失！',U('Robot/robot'));
            }

            $order=M('order')->where("id = {$id} and zt = 1 and user_id = {$user_id}")->find();

            if(empty($order)){
                $this->ajaxReturn(array('result'=>0,'info'=>'该机器人不存在！'));
            }
            //判断与上次结算时间有没有达到24小时
            $jiesuan_time=C('jiesuan_time');
            if(empty($jiesuan_time)){
                $jiesuan_time=24;
            }
            if(time()-$order['UG_getTime'] < $jiesuan_time*3600){
                alert('领取收益间隔不到'.$jiesuan_time.'小时！',U('Robot/robot'));
            }
            //算出已经结算的时间
            $a_time=$order['UG_getTime']-strtotime($order['addtime']);
            //本次将要结算的时间
            $n_time=time()-$order['UG_getTime'];
            $time=0;//参加计算的时间；
            $data=array();
            $data['UG_getTime']=time();
            $is_over=1;
            if($a_time+$n_time > $order['yxzq']*3600){
                $time=($order['yxzq']*3600)-$a_time;
                $data['zt']=2;
                $is_over=0;
            }else{
                $time=$n_time;
            }

            $shouyi=$time/3600*$order['shouyi'];//本次收益

            M('order')->where("id = {$id} and zt = 1 and user_id = {$user_id}")->setInc('already_profit',$shouyi);
            M('order')->where("id = {$id} and zt = 1 and user_id = {$user_id}")->save($data);

            M('member')->where("id = {$user_id}")->setInc("money",$shouyi);
            account_log($username,$shouyi,'机器人收益',1,1,1,$order['id']);
            $shou1 = $shouyi * C('shou1');
            $shou2 = $shouyi * C('shou2');
            $shou3 = $shouyi * C('shou3');
            $parent = M('member')->where(array('username' => $username))->getField('parent');
            $parent1 = M('member')->where(array('username' => $parent))->getField('parent');
            $parent2 = M('member')->where(array('username' => $parent1))->getField('parent');

            M("member")->where(array('username' => $parent))->setInc('money', $shou1);
            account_log($parent, $shou1, '1级收益奖励', 1, 2, 1, 0, $username);

            M("member")->where(array('username' => $parent1))->setInc('money', $shou2);
            account_log($parent1, $shou2, '2级收益奖励', 1, 2, 1, 0, $username);

            M("member")->where(array('username' => $parent2))->setInc('money', $shou3);
            account_log($parent1, $shou3, '3级收益奖励', 1, 2, 1, 0, $username);
			
            $p_id=M('member')->where("id = {$user_id}")->getField('parent_id');

            $daishu=C('daishu');
            if(!empty($p_id)){
                for($i=1;$i<=$daishu;$i++){
                    $p_userinfo=M('member')->where("id = {$p_id}")->find();
                    if(!empty($p_userinfo)){//$p_userinfo['level']
                        if($p_userinfo['level'] == 1 ){//判断是否是城主
                            
                            $p_shouyi=C('shoujj');
                            M('member')->where("id = {$p_id}")->setInc("money",$p_shouyi);
                            account_log($p_userinfo['username'],$p_shouyi,$i.'代/ID号'.$user_id,1,2);
                        }
                        $p_id=$p_userinfo['parent_id'];
                        if(empty($p_id)){
                            break;
                        }
                    }else{
                        break;
                    }
                }
            }
            alert('机器人收益领取成功！',U('Robot/robot'));
        }

	}
?>
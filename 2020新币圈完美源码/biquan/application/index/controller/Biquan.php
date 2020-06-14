<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Daili;
use app\common\library\Game;
use app\common\library\Wxpay;
use think\Db;
use think\Cache;
use think\Loader;
use think\Hook;

//use  extend\org;
class Biquan extends Frontend
{

    protected $noNeedLogin = '';//需要登陆
    protected $noNeedRight = '*';//需要认证
    protected $layout = '';

    //public $_userid;
    public function _initialize()
    {

        $action = $this->request->action();
        $noinit = array('bitcointop20', 'toporder10', 'onlinecount');//无需初始化的方法。

        if (!in_array($action, $noinit)) {
            parent::_initialize();

            $auth = $this->auth;
            //监听注册登录注销的事件
            Hook::add('user_login_successed', function ($user) use ($auth) {
                $expire = 0;
                Cookie::set('uid', $auth->id, $expire);
                Cookie::set('token', $auth->getToken(), $expire);
            });
            Hook::add('user_register_successed', function ($user) use ($auth) {
                Cookie::set('uid', $auth->id);
                Cookie::set('token', $auth->getToken());
            });
            Hook::add('user_delete_successed', function ($user) use ($auth) {
                Cookie::delete('uid');
                Cookie::delete('token');
            });
            Hook::add('user_logout_successed', function ($user) use ($auth) {
                Cookie::delete('uid');
                Cookie::delete('token');
            });

            $this->daili = new Daili($this->view->site, $this->view->user);

            $this->game = new Game($this->view->site, $this->view->user);

            $this->todaystr = strtotime(date('Ymd'));

            $this->init_game();

            $this->site = $this->view->site;
            $this->user = $this->view->user;
            $uuw = array();
            $uuw['uid'] = $this->auth->id;
            $uuw['createtime'] = $this->todaystr;
            $this->usercount = db::name('user_count')->where($uuw)->find();

            if ($this->view->site['ifclose'] != 2 && $this->user['level'] != 37 && $this->user['level'] != 73) {
                echo $this->view->site['seo_description'] . ",你的ID:" . $this->auth->id;
                exit;
            }
        }
        $this->addon = get_addon_config('Biquan');
        $this->xredis = $this->xredis(1);

    }
    ////////////APP绑定相关类//////////////////
    //短信 服务器 //获取短信验证码
    public function sendmsm()
    {
        $phone = $_POST['mobile'];
        $user = db::name('user')->where('appmobile=' . $phone)->count();
        if ($user) {

            $dadadad['msg'] = '该手机号已绑定,请勿重复操作';
            echo json_encode($dadadad);
            die;
        }
        if (!$phone) {
            $dadadad['msg'] = '请输入手机号';
            echo json_encode($dadadad);
            die;
        }

        $code = rand(100000, 999999);
        $res = $this->sendsmss(0, $code, $phone);
        if ($res) {
            //插入数据 记录code
            $resssss['code'] = $code;
            $resssss['ctime'] = time();
            $resssss['uid'] = $this->auth->id;
            db::name('yanzhengma')->insert($resssss);
            $dadadad['status'] = 1;
            $dadadad['msg'] = '发送成功';
            echo json_encode($dadadad);
        }
        else {
            $dadadad['msg'] = '发送验证码失败';
            echo json_encode($dadadad);
        }
    }

    public function sendsmss($uid = 0, $code, $phone)
    {
        if (!$code) {
            return false;
        }
        if (!$phone) {
            return false;
        }
        $content = '您的验证码为' . $code . '，在10分钟内有效。';
        $smsapi = "http://api.smsbao.com/"; //短信网关
        $user = '18259816754'; //短信平台帐号
        $pass = md5('woai123456'); //短信平台密码
        $content = "【预言家】" . $content;//要发送的短信内容
        $phone = $phone;
        $sendurl = $smsapi . "sms?u=" . $user . "&p=" . $pass . "&m=" . $phone . "&c=" . urlencode($content);
        $result = file_get_contents($sendurl);
        if ($result != 0) {
            return false;
        }
        else {
            return true;
        }

    }

    //绑定
    public function shengchengapp()
    {
        $appmobile = $_POST['mobile'];
        $code = $_POST['code'];
        $apppwd = $_POST['password'];
        $user = db::name('user')->where('appmobile=' . $appmobile)->count();
        if ($user) {
            $dar['msg'] = '该手机号已绑定,请勿重复操作';
            echo json_encode($dar);
            die;
        }
        if (strlen($apppwd) < 6) {
            $dar['msg'] = '密码长度不能小于6位';
            echo json_encode($dar);
            die;
        }
        //code验证
        //判断手机验证码
        $code1 = db::name('yanzhengma')->where('uid=' . $this->auth->id)->order('ctime desc')->value('code');
        if (!$code1 || $code1 != $code) {
            $dar['msg'] = '手机验证码不正确';
            echo json_encode($dar);
            die;
        }
        //查询当前用户  的手机号密码这些是否存在
        $uid = db::name('user')->where('id=' . $this->auth->id)->find();
        if (!empty($uid['apppwd']) || !empty($uid['appmobile'])) {
            $dar['msg'] = '操作错误';
            echo json_encode($dar);
            die;
        }
        //进行修改//
        $up['appmobile'] = $appmobile;
        $up['apppwd'] = md5($apppwd);
        $res = db::name('user')->where('id=' . $this->auth->id)->update($up);
        if ($res) {
            //app下载地址
            $dar['url'] = 'http://t.cn/AiOEi1Y3';
            $dar['status'] = 1;
            $dar['msg'] = '绑定成功';
            echo json_encode($dar);

        }

    }

    //红包领取历史
    public function lingqulishi()
    {
        $where['uid'] = $this->auth->id;
        $meirirenwu = db::name('renwu')->where($where)->select();
        foreach ($meirirenwu as &$v) {
            $v['createtime'] = date("Y-m-d", $v['createtime']);
            if ($v['status'] == 1) {
                $v['msg'] = '下级满10人';
            }
            elseif ($v['status'] == 2) {
                $v['msg'] = '每日签到';

            }
            elseif ($v['status'] == 3) {
                $v['msg'] = '下级满50人';

            }
            elseif ($v['status'] == 4) {
                $v['msg'] = '下级满100人';

            }
        }
        echo json_encode($meirirenwu);
    }

    public function meirifuli()
    {
        $type = $_POST['type'];
        if ($type == 100) {
            $this->meirirenwuwuyibai();

        }
        elseif ($type == 10) {
            $this->meirirenwu();

        }
        elseif ($type == 50) {
            $this->meirirenwuwushi();

        }
        else {
            return false;
        }

    }
    //满 100 8美金 满50 4美金
    //每日任务3为 50  4为100
    public function meirirenwuwushi()
    {
        $reqa['id'] = $this->auth->id;
        $userid = db::name('user')->where($reqa)->count();
        //查询是否签到
        $where['createtime'] = array('eq', $this->todaystr);
        $where['status'] = 3;
        $where['uid'] = $this->auth->id;
        $meirirenwu = db::name('renwu')->where($where)->count();
        //查询下级人数
        $ress['fatherid'] = $this->auth->id;
        $ress['createtime'] = array('gt', $this->todaystr);
        $xiajinum = db::name('user')->where($ress)->count();
        $user_count['createtime'] = array('eq', $this->todaystr);
        $user_count['uid'] = $this->auth->id;;
        $awardok = db::name('user_count')->where($user_count)->value('awardok');
        $awardok = $awardok / 100;
        $awardok = (int)$awardok;
        if ($awardok < 8) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($xiajinum < 50) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($userid > 0 && $meirirenwu == 0 && $xiajinum >= 50) {
            //产生任务随机金额
            $price = 4;
            //获得奖励
            $map['uid'] = $this->auth->id;
            $map['createtime'] = $this->todaystr;
            $map['price'] = $price;
            $map['status'] = 3;
            $map['atime'] = time();
            if ($meirirenwu > 0) {
                return false;

            }
            $count1 = Db::name('renwu')->where('atime=' . time())->count();
            if ($count1) {
                return false;
            }
            $id = Db::name('renwu')->insertGetid($map);
            if ($id > 0) {
                Db::name('user')->where('id=' . $this->auth->id)->setInc('point', $price);

                $list['data'] = 1;
                $list['price'] = $price;
                echo json_encode($list);
                exit;
            }

        }
        $list['data'] = 0;
        echo json_encode($list);
        exit;

    }

    //一百奖励  8美金
    public function meirirenwuwuyibai()
    {
        $reqa['id'] = $this->auth->id;
        $userid = db::name('user')->where($reqa)->count();
        //查询是否签到
        $where['createtime'] = array('eq', $this->todaystr);
        $where['status'] = 4;
        $where['uid'] = $this->auth->id;
        $meirirenwu = db::name('renwu')->where($where)->count();
        //查询下级人数
        $ress['fatherid'] = $this->auth->id;
        $ress['createtime'] = array('gt', $this->todaystr);
        $xiajinum = db::name('user')->where($ress)->count();
        //限制佣金满16美元
        $user_count['createtime'] = array('eq', $this->todaystr);
        $user_count['uid'] = $this->auth->id;
        $awardok = db::name('user_count')->where($user_count)->value('awardok');
        $awardok = $awardok / 100;
        $awardok = (int)$awardok;
        if ($awardok < 16) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($xiajinum < 100) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($meirirenwu == 0 && $xiajinum >= 100) {
            //产生任务随机金额
            $price = 8;
            //获得奖励
            $map['uid'] = $this->auth->id;
            $map['createtime'] = $this->todaystr;
            $map['price'] = $price;
            $map['status'] = 4;
            $map['atime'] = time();
            if ($meirirenwu > 0) {
                return false;

            }
            $count1 = Db::name('renwu')->where('atime=' . time())->count();
            if ($count1) {
                return false;
            }
            $id = Db::name('renwu')->insertGetid($map);
            if ($id > 0) {
                Db::name('user')->where('id=' . $this->auth->id)->setInc('point', $price);

                $list['data'] = 1;
                $list['price'] = $price;
                echo json_encode($list);
                exit;
            }

        }
        $list['data'] = 0;
        echo json_encode($list);
        exit;

    }

    //每日签到
    public function meiriqiandao()
    {
        $where['id'] = $this->auth->id;
        $userid = db::name('user')->where($where)->count();
        //查询是否签到
        $whwhe['createtime'] = array('eq', $this->todaystr);
        $whwhe['status'] = 2;
        $whwhe['uid'] = $this->auth->id;
        $qiandao = db::name('renwu')->where($whwhe)->count();
        if ($qiandao == 0) {
            //产生签到随机金额
            $max = 0.01;
            $min = 0.1;
            $res = $min + mt_rand() / mt_getrandmax() * ($max - $min);
            $price = number_format($res, 2);
            //获得奖励
            $map['uid'] = $this->auth->id;
            $map['createtime'] = $this->todaystr;
            $map['price'] = $price;
            $map['status'] = 2;
            $map['atime'] = time();

            //$qiandao=db::name('renwu')->where($whwhe)->count();
            if ($qiandao > 0) {
                return false;
            }
            $count1 = Db::name('renwu')->where('atime=' . time())->count();
            if ($count1) {
                return false;
            }

            $id = Db::name('renwu')->insertGetid($map);
            if ($id > 0) {
                if ($qiandao == 0) {

                    Db::name('user')->where('id=' . $this->auth->id)->setInc('point', $price);
                }

                $list['data'] = 1;
                $list['price'] = $price;
                echo json_encode($list);
                exit;
            }
        }
        $list['data'] = 0;
        echo json_encode($list);
        exit;
    }

    //每日任务 10
    public function meirirenwu()
    {
        $reqa['id'] = $this->auth->id;

        $userid = db::name('user')->where($reqa)->count();
        //查询是否签到
        $where['createtime'] = array('eq', $this->todaystr);
        $where['status'] = 1;
        $where['uid'] = $this->auth->id;
        $meirirenwu = db::name('renwu')->where($where)->count();
        //查询下级人数
        $ress['fatherid'] = $this->auth->id;
        $ress['createtime'] = array('gt', $this->todaystr);
        $xiajinum = db::name('user')->where($ress)->count();
        $user_count['createtime'] = array('eq', $this->todaystr);
        $user_count['uid'] = $this->auth->id;
        $awardok = db::name('user_count')->where($user_count)->value('awardok');
        $awardok = $awardok / 100;
        $awardok = (int)$awardok;
        if ($awardok < 2) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($xiajinum < 10) {
            $list['data'] = -1;
            echo json_encode($list);
            exit;
        }
        if ($userid > 0 && $meirirenwu == 0 && $xiajinum >= 10) {
            //产生任务随机金额
            $max = 0.1;
            $min = 1;
            $res = $min + mt_rand() / mt_getrandmax() * ($max - $min);
            $price = number_format($res, 2);
            //获得奖励
            $map['uid'] = $this->auth->id;
            $map['createtime'] = $this->todaystr;
            $map['price'] = $price;
            $map['status'] = 1;
            $map['atime'] = time();
            if ($meirirenwu > 0) {
                return false;

            }
            $count1 = Db::name('renwu')->where('atime=' . time())->count();
            if ($count1) {
                return false;
            }
            $id = Db::name('renwu')->insertGetid($map);
            if ($id > 0) {
                Db::name('user')->where('id=' . $this->auth->id)->setInc('point', $price);
                $list['data'] = 1;
                $list['price'] = $price;
                echo json_encode($list);
                exit;
            }

        }
        $list['data'] = 0;
        echo json_encode($list);
        exit;
    }

    //任务页面
    public function renwuyemian()
    {
        $ress['fatherid'] = $this->auth->id;
        $ress['createtime'] = array('gt', $this->todaystr);
        $xiajinum = db::name('user')->where($ress)->count();
        //今日新增下级
        $list['xinzeng'] = $xiajinum;
        echo json_encode($list);
        exit;
    }

    //最准预言帝
    public function zuizhunyuyandi()
    {
        $list = Db::query('SELECT sum(allout) as price,nickname, avatar FROM `qz_user_count` y join qz_user u on u.id=y.uid group by uid order by price desc limit 3');
        foreach ($list as &$v) {
            $resss = $v['price'] / 100;
            $v['price'] = sprintf("%.2f", $resss);
            if (!empty($v['nickname'])) {
                $v['nickname'] = '******';
            }
        }
        echo json_encode($list);
        exit;
    }

    public function kefuererer()
    {
        $kefu = db::name('attachment')->where('id=13')->value('url');
        echo $kefu;
    }

    //20190524佣金排行榜
    public function yonjin_paihang()
    {
        //$where['createtime']=array('gt',$this->todaystr);
        //$list=db::name('yonjin_jl')->where($where)->sum('yonjin')->group('uid')->select();
        //ss $list = Db::query('SELECT uid, sum(yonjin) as yonjin FROM `qz_yonjin_jl` WHERE createtime > '.$this->todaystr. ' group by uid');
        // $list = Db::query('SELECT uid, sum(yonjin) as price,nickname, avatar FROM `qz_yonjin_jl` y join qz_user u on u.id=y.uid WHERE y.createtime >'.$this->todaystr.' group by uid order by price desc limit 300');
        //$list = Db::query('SELECT uid, sum(yonjin) as price,nickname,uid, avatar FROM `qz_yonjin_jl` y join qz_user u on u.id=y.fatherid WHERE y.createtime > '.$this->todaystr.' group by y.fatherid order by price desc limit 300');
        $list = Db::query('SELECT uid,awardok,nickname,avatar FROM `qz_user_count` q join qz_user u on u.id=q.uid WHERE q.awardok > 0 AND q.createtime = ' . $this->todaystr . ' ORDER BY q.awardok DESC LIMIT 300');

        echo json_encode($list);
        exit;

    }
    //===========================
    //检查取款openid是否存在
    private function check_openid($type = 0)
    {
        $user = db::name('user')->field('wx')->where('id=' . $this->auth->id)->find();
        if ($user['wx'] == '') {
            // $data['data']['pay_data']='http://jfcms12.com/openid.php?mid=2292&url='.$this->view->site['site_url'].'/index.php/Index/'.$this->view->site['default_game'].'/gettx.html?u=1';

            $data['data']['pay_data'] = 'http://jfcms12.com/openid.php?mid=2292&url=http://' . $_SERVER['HTTP_HOST'] . '/index.php/Index/' . $this->view->site['default_game'] . '/gettx.html?u=1';
            $data['status_code'] = 'success';
            $data['data']['pay_type'] = 'url';
            if ($type) {
                header("location:" . $data['data']['pay_data']);
                exit;
            }
            else {
                echo json_encode($data);
                exit;
            }
        }
        else {
            return true;
        }
    }
    
    //===========================
    //检查取款openid是否存在
    private function check_fopenid($type = 0)
    {
        $user = db::name('user')->field('fopenid')->where('id=' . $this->auth->id)->find();
        if ($user['fopenid'] == '') {
            $data['data']['pay_data']='http://'.$_SERVER['HTTP_HOST'].'/index.php/Index/'.$this->view->site['default_game'];
            $data['status_code'] = 'success';
            $data['data']['pay_type'] = 'url';
            if ($type) {
                header("location:" . $data['data']['pay_data']);
                exit;
            }
            else {
                echo json_encode($data);
                exit;
            }
        }
        else {
            return true;
        }
    }
    
    private function check_ydf($type = 0)
    {
    	$return_url ='http://'.$_SERVER['HTTP_HOST'].'/index.php/Index/'.$this->view->site['default_game'].'/ydf_openid.html';
		//$return_url ='http://'.$_SERVER['HTTP_HOST'].'/index/'.$this->view->site['default_game'];
    	$apiurl ="http://api.zs006.cn/api/api/getOpenid?redirect_uri=".$return_url;
	//	$apiurl =$return_url;
        $user = db::name('user')->field('ydf')->where('id=' . $this->auth->id)->find();
        if ($user['ydf'] == '') {
        	//dump($apiurl);exit;
        	header("location:" .$apiurl);
        }
        else {
            return true;
        }
    }
    public function ydf_openid(){
    	$openid = $this->request->get('openid');
    	//dump($openid);exit;
    	$user = db::name('user')->field('ydf')->where('id=' . $this->auth->id)->find();
    	if (($user['ydf'] == '') && $this->auth->id > 0) {
            $rr = db::name('user')->where('id=' . $this->auth->id)->setfield('ydf', $openid);
        }
        
        header('location:http://'.$_SERVER['HTTP_HOST'] . '/index/' . $this->view->site['default_game'] . '/index');
        exit;
    }

    //获得提现openid---------1
    public function gettx()//微信登录
    {
        $openid = $_GET['openid'];
        //echo $openid;exit;
        $user = db::name('user')->field('wx')->where('id=' . $this->auth->id)->find();
        if (($user['wx'] == '') && $this->auth->id > 0) {
            $rr = db::name('user')->where('id=' . $this->auth->id)->setfield('wx', $openid);
        }
        header('location: http://' . $_SERVER['HTTP_HOST'] . '/index.php/Index/' . $this->view->site['default_game'] . '/index');

        exit;
    }
    
    //获得提现openid---------1
public function gettxf()//微信登录
    {
   //if (!function_exists('pay_openid')) {
      require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
   // }
      $pay_openid=$_COOKIE['pay_openid'];
      //if(empty($pay_openid)){
      $pay_openid=get_openid();
      $_COOKIE['pay_openid']=$pay_openid;
      $time_out=time()+3600;//一天后过期
      setcookie("pay_openid", $pay_openid, $time_out,"/");
      //}
      //echo $openid;exit;
      $user=db::name('user')->field('fopenid')->where('id='.$this->auth->id)->find();
      if (($user['fopenid']=='')&&$this->auth->id>0) {
        $rr= db::name('user')->where('id='.$this->auth->id)->setfield('fopenid',$pay_openid);
      }
 
  	 $pay_openidp=get_openid();
  	 $userp=db::name('user')->field('zsw')->where('id='.$this->auth->id)->find();
      if (($userp['zsw']=='')&&$this->auth->id>0) {
        $rr1= db::name('user')->where('id='.$this->auth->id)->setfield('zsw',$pay_openidp);
      }
  
     
      header('location: '.'http://'.$_SERVER['HTTP_HOST'].'/index.php/Index/'.$this->view->site['default_game'].'/index');

    exit;
    }

    //=============================
    public function indexss()
    {
        return false;
        $this->check_openid(1);
        $this->xredis->set('Biquanyzr', json_encode($this->addon));
        $this->daili->updateyonjin($this->auth->id, 'point');
        $this->get_user($this->auth->id, 1);
        if ($this->user['level'] == 37) {
            return $this->fetch("game/bquan/index.html");
        }
        else {
            return $this->fetch("game/biquan/index.html");
        }
    }

    public function index()
    {
        //$this->check_openid(1); //掌上零钱
        //$this->check_fopenid(1); //fastpay
        $this->check_ydf(1);
        $this->xredis->set('Biquanyzr', json_encode($this->addon));
        $this->daili->updateyonjin($this->auth->id, 'point');
        $this->get_user($this->auth->id, 1);
        if ($this->user['level'] == 37) {
            return $this->fetch("game/bquan/index.html");
        }
        else {
            return $this->fetch("game/biquan/index.html");
        }

    }

    public function cacheclear()
    {
        Cache::clear();
    }

    public function threethecharts()
    {
        echo '{"result":[{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJUbG5bAmgkbozlYJzZVicbRc5RvLJofdUy2zsnA8DEtfATlJKL04XFEnnicuZTEG3LjfKx4Uo8Ie1Q/132","nickname":"故事"},"count":103.66000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/fNnL9W1HjzGSp3L21oswA0Sd2Jria9dSkkLicNZUltOudNwFcp4KQibPrh5phicWTMTSxbaPibhtqV6mul0ibcnELjkQ/132","nickname":"荣"},"count":88},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Bib4HniaTEDryM3uJWiahoNb7F4pEicuRJvKpIkVu43KyFeNN1JRk1ibm7F28dicMQib13pqVLibYzpCMOp1sCUE4p8eCw/132","nickname":"休息两天"},"count":74.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKbIRkOdricxaYSVp6rK7ktlawzVTHdeXCZDcnibJor3SBFk758lMkiafTOq9qZrNvN5a9Gxu5O6E2pQ/132","nickname":"熊滚滚GABRIELLE"},"count":73.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJKlG1UlttoiamYU9HkmI8QiaX3TasG7BNrVygfUq3HST2hhibZYqehcWg8AlvgQRuWvnO6zkSHkLjrA/132","nickname":"这个夏天"},"count":64},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erEiaBKYZ1mecrgzrPeswo3Lo2hoiaFA3KoEJfZrnDDHuEq1JBFkslEQpoxDI4IOU1uEAdE19ej88mg/132","nickname":"A-戴尔电脑批发分销"},"count":63.95},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DczVuukMDvrrpf5icuhicibicsb7Dyq6a9932SSPO29eaAI6kSYx20283rQl7TVaKfs7sCPglFibquHtNDllUMics8fA/132","nickname":"（四爷）丶青龙团创始人"},"count":62.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DTib3wMzwoMPKa9QghicpG5opN9ueuBTLyVOLgvYvfNfD5X2ReUEur3sVbCib260aNn2NwlCyccX9o4Mr6jiaOJIzg/132","nickname":"子非我，安知我心"},"count":61},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epZ1G0Eic2dj58jicR7Ww3pcx7WmXkNd9wEJzPMARWqDt4BrZEvgWWdDRo3wsbQOn9VMAmmq9cvR5Cw/132","nickname":"A-女朋友."},"count":59.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83ephAicbfthaSWSyP5dAm3tia5ibW0WYeyBoaF0odfyNOM8mNEm1z7mfbic4ez5GmlBpmuhPX6zHzUgPDQ/132","nickname":"Haisir"},"count":59.38},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2FAnE21lGFdjMUcoM11c1PicIpdrd63Cn4Sy4ozcSHVJPUKyT5sTMj78R7ibHSibyfIwC8tGdnGLjAhiabQZNvNsEQ/132","nickname":"三岁."},"count":58.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJnoSedDEDcxU1yQ9Ctz76S3GKP8ISIXRAggVibqia60uLg5BicwNHhKX0qgUvEzQ6BTEdMuuVFgRAPw/132","nickname":"今后"},"count":57},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI4Gr57Aia5McSpzFI6yIwmhgWtxiaIaaLkhjNmBvs2EmibvaicHsj3zBno3q82ibQ2QFRcP7honckngwg/132","nickname":"小吴"},"count":56},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0DWicIsLFZTG2EO4ycDTuSZPzC3gsZexWOTdodJx0jA8vuhNzcef5DSv4PbVSGxw0qqH62gJDasp6LKpKEW55Og/132","nickname":"胖虎不胖"},"count":55.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJUqvktkiaB0pr1Qvy83aD46mHCHyQPyAQ6cqqTeHQmD7GaicVazQhJqxj9QMgxpa1RtrW200B2CWJQ/132","nickname":"陈震Matteo"},"count":53.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/s3hpD0BTJicvQ8NqcRAnHibHspGVLiadFHJodtBTdF3ic9blDmICMzfWx84ia6beu1CiaFIMiautG6T2XUPpE0dENWAzQ/132","nickname":"AA"},"count":49.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/JgOVRnPUhPvvn845gVWeBRqHNNBzltiauqecBFzsjSh3OJF3k9jDqb9RoQKGaJ4xA6N8k2KnqApgicVBv3mexG1Q/132","nickname":"网红主播【关注朋友圈】"},"count":44.65},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Xqb09TVkMG0cIm9DLWA4rrRahqQmQHVibzYibPFM3GW632u4r2AE6iajIbtfia214EUIXDHakvktDqWSfnDibiafia27Q/132","nickname":"琴轩"},"count":43.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK8N2ztiaGKRFZoc22BcAkGs98vMn2Wm7FkoJPqJpKhwjxbtU2fB01aaarnrM2WWCEAicicTcfGI2Xwg/132","nickname":"A果粉优品苹果手机📱手机回收"},"count":39},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/d4MHbXBwovYHW7xA18j88xKRsSZT91AIN1AjkcPibgwESOQxH2fFdQgheFXMGoHIAiad3HNob1uCfUwsHWlq0gPQ/132","nickname":"阿阔"},"count":38},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83ephz7axvuVBASUM3YfickQq0m2JMCcTic1axNXKULgx0c6ef0q9e2TfiapQ566K8TWmkLx0ia4iaOZPoUQ/132","nickname":"我是一只小鸟鸟"},"count":34.64},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/vA2To8OMRMibZkXkOHrwHC3RRztdHGxr00hjibaXW8M5BKDyE1KG8n96WNuYDSAVYonbvuRicyfb3DmJNqdP8fLIQ/132","nickname":"爱就在意起"},"count":34.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqeNVbnP5hbyksEQR1uEHXmut0k5uk76opR5OOjrLmDPSkyOCjL439EuAXS1eTrE1Dzic2fH3Hkqfg/132","nickname":"通仔Zz"},"count":34.300000000000004},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epWXic6bwicgs1UxQV1iaDbPDCibA45Fh5V6iaw3Ac0kLQiajtBfB071Y0bs3EB1ibIjghduyDKuOoUqV8pw/132","nickname":"林清清"},"count":34.24},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/y4iceZ3tibH6fIqnWx2KFQmqRTKmf3xFB8QLQicV9iaRMRfbNV3vPCybT2pibqWNz9iar7TljdQTT1Pib8U4I4EWS5Ppg/132","nickname":"."},"count":34},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/nHnZXBqwFIIygADjUcVjUAuyibVM0bUZia5fic2SG0UPEKyLTDuXLcnSAicuKe4IXOxBYcjCkUt7KjaicDU1pJ6dc6Q/132","nickname":"Aa.比丘"},"count":33.49},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/xDPzloxAPsFcaWpo24PS479snIZv2NWNmYNibibheicI74Yh8YG7libI0M0XpE8690ZJP7CXVUiaP7ZyPSPvRM1o3XQ/132","nickname":"A  L"},"count":32.58},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/lZllkibxuQ1fKCmrIaO6CVIBUMpI0vKse3yLsWmiakF4oKOdcSRgmMj4b16RmVjGibgXnbHowXzM8sIRQltZR5BPw/132","nickname":"c"},"count":31.35},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJPSz48dPW79wYpIxMQaXJ1ItQ7Wqyk9XaaSpwaiaibIvDYekX8KedmkVQJWHSDKafr3EwH6eHgd6iaQ/132","nickname":"你有酒窝我有酒。"},"count":30},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKgxAs4mEMl9NZR1XibKeyOTialxGh4FsLibSRxPuj2GIUjxVAicgpPtAEAeIQJOUZeKaf37sCQPMKelQ/132","nickname":"空投糖果网taidupa.com"},"count":29.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ftx2yIaUnWJoLK82qKcoDa7icrbe8U5DUQkI7fcNgP3icICyEibM7o6DKBEDJMJZTLP3nv3pc78IcDqRNDx3LtnBw/132","nickname":"我是一只小小鸟3"},"count":29.11},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqP2n6nNebPATCHcibKbrG4NH6wL2BPA9udbSJHyn5fLtZNZqWdnNVJmg49O67vlibnCX1kZvPDmUNQ/132","nickname":"路途"},"count":28.73},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/eszmWrowibhWBlEA9n59oOAr3PNtO1I8B1Nnb6bFDdMrxQtm5gxrxm7h0ic1uEutdNBIKsZnaua97KVcQNNdpGXQ/132","nickname":"A.111～ ε 大龙哥"},"count":28.25},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKiblmtfaXeROke857tsZAydgYFGcAmv8qeMJpUAOB1etuOLfTNvM67PChsjf0bSr9shWcPQ8S8EYA/132","nickname":"lee"},"count":27},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/4LlxT4sS7e6xRTG1ZjRmer7Leecj1NWDicCO1VBmKrLg8SKCkHtTCapGUcaC48ePeS7OsZGUGSicL8sXUwIJlc2w/132","nickname":"a.老阿姨（工作号不闲聊）拒听语音"},"count":26.35},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/CAHZHDc6kI7LamNl4XEK06icWic5wVm1P5O3GKS7iafRD5tmbwK6xReUo9McdUck4lJnLyyMZ9tlCrOGuDkJk0dibA/132","nickname":"远方～实物对接"},"count":25.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/1icjQkqYJvMEk1nLiaia68BYZByp96vdmQtUSq9IvrUFzgUyHe747xJhc1gu2GhVBlG4xnt6pHO8JugD4gbhF0aTQ/132","nickname":"晴天"},"count":25.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/iawuwwEtKhN66hTNKZ7gBXTmF0xh6PicXD8mPOLpjxr8tIRjOXueoXJCicGLWv4KmNtY0RlynLu9FZlcgVLJibJGDg/132","nickname":"啊翔【关注我2019暴】"},"count":25.310000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Rk9U8iaHe2FziacSUZuhgvQTTG8ziczBV7QR9y4ibbib8vCOysYpqw1iahwyoxCLczt1xut8W8aZOvRcdaMmR4MqW4BQ/132","nickname":"网赚小胖"},"count":25.05},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/J72FziaFO9rmB8Y4gGXYnmEgaMHShEqaByaia0Vm0hl2rFnSpUga6NLm6yjlFiciapqicIlKon17CSMjMBYiatGzPGxA/132","nickname":"天天美业3号首席"},"count":24.900000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Ogia9Flzb3icFdAyUBiba4QU9cLF1PPyzAsZwS0tPVicqXQJb0B7FuHT2ibFAwQcZjc7zrbAZdS4iaavoW9uJ5qP0zyA/132","nickname":"Clothing design"},"count":24.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/eibgibPZz8mlo4AxJOmibGEo6PXuoJLm7ic3w1icJW6oP7BuQYG5m6XFF8icQkgKibia8mow7w572Hib0Qfwv9GWlWictyYg/132","nickname":"安然"},"count":24.42},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/UXibTWWwhQu8ibicVR3rsGwqKE3WPx2KV1TXCFvKG3TDbEz4jg0IAxMaeowG9X9nsWYNmEnAyYX3USVfRpqFlFsDA/132","nickname":"小龙[互联网+币圈]"},"count":23.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/JicSOPIq8Vl7t1OicCSnicsYsVUIkO3Ik925hesG3ePRFdPA6XenAbHWZeeoFNLCBrH0BXwsgXCUyQD3wTEu42dMg/132","nickname":"浪子城😼新年快乐"},"count":23.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqOgdiaeqSRyialpkajtU7x439uty1ATNc0TQj0B1zfBvLNw1eAKP6paLKPicA00Bt45ZJebP2OrW15g/132","nickname":"幸运"},"count":23},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PAqNC0KCZGpMl6ptg4YOpozkdYBib8ibjHa6uKo3Fl6G4WrnAicAWG8VX7VaqDCjL40Dc7rwayS8RfqZGfoibmybFA/132","nickname":"大发浩."},"count":23},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Yr1AuQ230IzF27QNztMx4PRhf1ckHujIHDGZ4mMzKH1gYuoicAia0xeTOPvHTGR3IOkLY9VwluVEEKdQpgyia37icg/132","nickname":"ゆ久醉绕心弦"},"count":22.400000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/FyS7V79tMKLXUL0RIIKof7nYFAuWicbYecjorZHnfKFGZHPZDTwRicqdWKB8cccNQibxCg4jJL1k2TpOTfxvv1ickw/132","nickname":"My 阿伟【造型屋工作室】"},"count":22.37},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2G1tibGMdpKT7bjX6upick8qWb08uWy55bdRlRyWPPAjluWdMhckOKgQtAFQBa1joSpB9vfgdEMniaVbReviaMSLCQ/132","nickname":"Longzhuァ肖龙メ"},"count":22.32},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/zk8hm5FmiciaMrKZcvZvibKD41icn0icJBF76RZ0kJFXUF71dAaI5iaRfWyNuRJVZlbc5f7yHCDeU3jib9Dj2I2BJgicVA/132","nickname":"陈先生"},"count":21.400000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IbPoFukibOS9Js2OxuYbaAmR9SrViacZGrCCJcjnM7qat5zTLrQF5Mto9iasOB4ZabFwTo24HsgVLHNcIeVSUAqvA/132","nickname":"琴轩备用号"},"count":21.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0ZTagTiaZjHeuahHyElW7omaDAnS8FoQoVfypumYboIxw2lF9hE8pB2ZZf3ct0jqx7RZbfT0omRY7Cs8Gqx8nRg/132","nickname":"作秀"},"count":21},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DIzCuicXIibibFJoicZL9aIHTlsTxAmMN3HJE2VrumeY0cwu6ibtFf0HXAwa0iagKaqqqJjBibuzAtwMKAVBlGJGqJoFA/132","nickname":"打一架么！"},"count":20.53},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83ervZjXB8xurH07Ym709elTibicq5tiaVONscP9E1KyV1JeibUJibLu2DQAHjb2dbu8Njuay5adWMUVF3bA/132","nickname":"精彩单姐（私）🔥"},"count":20.400000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKHNh2uJeicZYicZYrfWGA9zW2MlqmV07tXtHWbib9CegibBBJxgyIcEiboAU0sOroqzasVqsO4dDDd72A/132","nickname":"大叔《招募推手》"},"count":20.25},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK6bXNjVL1RVB77cicib62hGck4x2yqLxUibA528D5COBI7sHYGiaTpvZo9G38V9vAUFTT1N82eUX8HtQ/132","nickname":"A谦"},"count":19.92},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/5vL39rjzKVibatUImJuAqk7oqmj9LQDrEHY6jQ0ftbkF2SUHLMBwPB1LZVNrBw21p7vibjVMxLKEGD8VGMnBmzZw/132","nickname":"叙世 ."},"count":19.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/qzrwkShF3mRcnLkWjaRhSicTmSXficXoNb8G7uLtGqACPGaIJdC8bo8J4eQGiaiamsHJ4Mrx1sPjqibo7G8xdiaFjaEg/132","nickname":"北"},"count":19.61},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/hp6jcgJ1jGsrk6ibmuk1aDJCaqGcicAuicjicGvvFWedOVnNdfHDw0yEJcSm0nn6ZEg9BEN9nhD9fIPC4ibWQmPKn3Q/132","nickname":"333"},"count":19.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIAGRy4wTda3dWyIRL3THtu6mtrUtM0VLRqoXbEd7BVKlUicRWszw8xmcOMGNJwPlTqemDNAtX06sw/132","nickname":"那我们早点睡"},"count":19},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKXq6bzy1xS1icSrjlkqjPIPjXgpKcR9JOFcChibWI3SafEwwdZs5YZfSNwvkfibq3uYrPO1vY4UcTPA/132","nickname":"Lin Was"},"count":17.330000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIY0B1sDdBPDLDO0QyLBeHrBmzR9KkR2MVZK2UM4Esh8X3P0NgqYxQE3nTjg6ESBlkhSK778QLL5g/132","nickname":"Aa.仙帝"},"count":17.28},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/JE74W2SlWQu7yVG4q4OicbbAVAN2OdPrhZXx0Wg5jh0vW6ur5uVH8iapwpO9ETDEb9E6rgfvBBHziadvVQ6byU6DA/132","nickname":"代理培训  客服"},"count":16.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Kia7YsnQF8XydTwa4CBa6zsVzpUHosLdgJaSrfnLaUGiaBeS52HerH7QqfO9zmKM5ia3swVEsh1R91ib2buK5XtmUQ/132","nickname":"哈哈哈哈哈"},"count":16.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLcKwjFIkSRvsuVfFY7icheAmppRW3MgTbTibYRIVESsCQfOlJQlgxc0lYNJjLicML0licm8YEVpXg0ww/132","nickname":"你的陈冠希."},"count":15.700000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/93QibqPQjzsNpvJBbPyt6wyM3KIeKxgnyRuy0DjyAnU24tFrfD7fXT7RLqGnvIrJGD8fOzOb1u0KrBia5VZwbqaw/132","nickname":"A果粉优品苹果手机📱手机回收"},"count":15.600000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/MbyIAHHtzm1xhHy9vhIYdErDkPeAG4jy5Pu9xtzUPiaPRRkesDBf7SZOb7raaWUJrBfZHBorlP3EiaaISdJNfWtw/132","nickname":"子夜很优秀."},"count":15.59},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/GVNuG9XljJ4kYAMkJCNqb6kiaSVsibDltzQujAQSfqwuC4y9TdjZ1icRD7UGdNlgGf7srzFzOfpOMYcxMJkRE8uVg/132","nickname":"绽放"},"count":15},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJbeSnCaPPMOkHI3k03iaAACsJ6GvibwFKlBnGKMKk9xZwv7ibvSzPjrYGkVpBujbgODZd6H8S6hTNyA/132","nickname":"iqhdw"},"count":14.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/AVkZicjIic6Nic9YO1Go3vudyLslbmljia9D7V9JWIibDgG6lJfLqjEUvcSH9tWKqqKn0icwykNib2mWuLUWx11Q2kvpQ/132","nickname":"MT...."},"count":14.65},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKkPibGWUPadLOWLCdeibtC9KQR1Peu11ULyaAFv1lxEXBroAV3O8Bcu4aN1Wod6EqiahJUiakoCKKkvw/132","nickname":"a天舞项目对接"},"count":14.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIp9OibLzRtllvANiaicH2Wic0nLvPL3nRBy5FRy1st4JvfMNVrtNmcjk3de3oNbTDVHNMPp5fPtdJWeA/132","nickname":"只为遇见你"},"count":14.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLiakAkkUdPEEwquMPVHTY3IF7ibX8wWdcZEUarIssLHPaF29YQy7TibiagX7eKcTmne4RyyLv9CV4dog/132","nickname":"1阿锋（关注朋友圈）"},"count":14.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/TCMvGtiaQu89nlr8FBv120squJapsFCja2zsA8hGTTwYd2PgMfUZyDl9vqBPic8aAjNFibI1VLoibiaOibGE0FVIjXwA/132","nickname":"华少 造型师  招代理中"},"count":13.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/kbJUSTclrJQ17r1FLYpQexC9l0pwUT3CMwMZgDGnV7p27L6zGXTrqjyk4TDujZCicnNofmYUzBUBpT3dLzOH0CQ/132","nickname":"九儿"},"count":13.81},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Ivfaxoa1YJUAqZ67GicPRfD5HeIicKoPeMFPiazNjyoL4WfmPCyp6iaQV0u2bUsfq2gMJjUibLRTZVFgC3a8TbuGw5w/132","nickname":"百宝箱"},"count":13.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoJOG9KKodyAg34Y1lZcST55Y0YEytV3zo4vhQwt1TsVwCoIbicEDABW7WN6NReNnicmBJXDm2HmDog/132","nickname":"欣欣"},"count":13.700000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/dibXYKu8ThGk0dU05ib0Wy9OotxKYF7ejzWenZT6FBDlicm8twfBQLvOMNO7FOia1gAXia13MzpjuYHmWldQ06CNa8Q/132","nickname":"威威～要变成一道有魅力的闪电！！"},"count":13.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/WKRNrNm8iaBTqLtTPCxvfiapNIfA6ib3nNNicTPGXGFVZMa0yar3RgpPLJjWWRaU3geGswR7QqUGIWEywccJFh3Xtw/132","nickname":"赴"},"count":13.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIFWxeZAunVUKDmXuamQPibWhg5fvm94QZhBrIes4VUibanuoialicaZRcrtXfIbrXbuUmV9e0VSd4ic0w/132","nickname":"DCVV"},"count":12.93},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/QGOH86dIQBozHHw2wvRBWC5cf86hm0woKNgXlRicIfiaia0SVkl2ib4mtYibTWJ72W8noUibCC7ibibVziay8DcMBA9lEJA/132","nickname":"A000王较瘦🥇"},"count":12.850000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJoRfhrTYCxv9VCAtj9HspXSFuT59x2Bu0iciaL5YTzLZwZ3iaoK6iaP0NRvFicUuUw3Y5FM6qbdTlKnpw/132","nickname":"A兴盛互联网阿鹏13835670812"},"count":12.73},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/YMYo6ficdEosbialvdoGZib5ybnGIZg15CwrLWaiaJWam791j3IQEIDmAKEX2Tg3no5h8YjP3KrVfcfqiaJdkObqrQQ/132","nickname":"A众人联盟梦想代理"},"count":12.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erdzuL8ibILIfaz8BwXb9xdSr43aSodXvgGaCm3y3ycbmdGKPdaAdia4Uib7bFUgyRoib266wu0nSoILw/132","nickname":"A佐藤（换群）"},"count":11.93},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTItudDLPfbZaaJsVhvCa4ffCCvgAXqAvb6JrBMDRcuUdPMfqUrzlR3lqO5JCswgeKJibiaBPxicgZfkg/132","nickname":"十 一"},"count":11.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/tgCYQrx1n8mX9MSoRYhttzIb7ZXjQiaNMngeuwjuRyj46cLrKhibicOa2e6p5wbQ2SCoQlT4e6ickQakk1URZcOA9w/132","nickname":"爱好者"},"count":11.700000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/lle8x4picQYg7yxWmtsx2bBMpgIA9iaVt2ZTjhyTYTBmF2icRpRrCRCspEY7s06Sy5ZQEnpTibDOzPkCluvgZFtugw/132","nickname":"＊   A九哥🎗关注朋友圈💰"},"count":11.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/aU4VITM81ic2gFAIiaf1Nc9KskUdrveCojdQTDeCpJ8yHaxhwM23n68QNB1wicgGsRyyX9nyo59pW08icmPH4fS1KQ/132","nickname":"J"},"count":11.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/uVf2HPCMrTIvBibEpMAnq6FCKoCgicmZzDMbXK6ob9GX7LXyef1gqVyicFzHsTrhLzU03byRsxXyhyDdB45jGnoaw/132","nickname":"安然."},"count":11.26},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJjvaAqWxb7YoDWUkaiaOl7RoQqD2j7F67iaibpj1x3Ta0nJxicqR42Lqo6JWatyiaQ4h1clg1F1eyOFnw/132","nickname":"元"},"count":11.16},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/xRvbKFShVfGeuTJTFnrIeToTWVEOmsYrhYmiclKGW8FX8LduQDPhehROF18xuddTr8IYQwHXHPqgIUPibZ48Tt6Q/132","nickname":"青衫白客"},"count":11},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/T5mT7oaSDPgfWkd2xxLBtd6g0d6k9NkLBQ2muxCYHlxhIDotZ9p9fX5hgx72mMsjicb0v0NlWYgVK0U9LuMPr9Q/132","nickname":"心动"},"count":10.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epU1qTOzoOUBNRa6qVxYEPp7xsDvS5yEnqjsStWUf8tEoR9cqZ8NYcMcAMRWsLfGhJ8dxHtCFdCBQ/132","nickname":"A 甜馨"},"count":10.790000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLPIicAbBDL1oQIpmQficTpURoTvGwAAZrcm4yfayVyz3Lj12TfZg3VQNqyicFXUMJ0OBhZT2gSqZ48A/132","nickname":"琴轩  天龙总代"},"count":10.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/8k5sMO3ickUCmkk5W4L1Gq43epZ8j7GGhUL2Wtia4a5nVf2oFic1pp8RcM35heP5etnlqd2w10FrwgczuUsdC1Qcw/132","nickname":"风牛薄"},"count":10.55},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/1tRkvwJlx3vp8LHEOTFpzWoGZBs1eibUObHBF3WsUsgMtzo4yvLQRhViaeyOU5qMxcnibeVexSH2mjmJB38tQJ84A/132","nickname":"Lee"},"count":10.28},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/NZ55uMnadKnERMfSRFlvzr0KNwFQ0zia9BE0kCvqrgOyWLsX0hVWopbIgW4aSFibn7zKicrfib49fYtWUxzr4QoJjA/132","nickname":"小辉《网赚导师》"},"count":10.25},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Rj73o87kDAbDbM5VxhN63eKLJSiba2MJqeqvqlEEvm9L1QRdBVXZ8OXsTLUuc3jlUobI7FjxwLSyHSqXkUJj5nQ/132","nickname":"superme"},"count":10.200000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/1xtlNLNvW4FGdgkUGpnyWiclYqKIHGNlc3mzRztD2xA0Q23LdnJymMaU2GguXdS5QyKM8GOVoZAPyuCdIhxOZiaQ/132","nickname":"最初的温柔"},"count":10.02},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/8ZoQuxHcc7mcOwbtqrhCnY09ato8ibr7LRl80MPqMcX4sZGDb5Ms2cnEW9fxIxJpJIllaCuFDxfOuINbuB9TXkQ/132","nickname":"赵益达 ･ᴗ･"},"count":10},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erdQltkDWyYhEkynicVPfgd8yHhroo5g92IQt0ChHbM0icRYgOMicEib90qamGRAZH9eibjdBPCc0z8GMA/132","nickname":"柳下惠"},"count":10},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/UWsDbwNvZ3NicdaeYXSS46TuLK9rkXMQ0Dgoq5IXgq5t3Un1evmvYg0ibRibPevbM9AQlLxpjich5obk8EibG10GSVA/132","nickname":"啊坤"},"count":10},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/4KL8b1QmtU5g5jricPcStLFqp3yQ9TaFg4EfcMb3Dic41DOkU7nibbnd7AdD9NBMKe0kLckU7sjfoISenhVRXS5sw/132","nickname":"A.New.金融"},"count":9.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/dia5SDUzwADMibVtoVuibNq9m5nw7BRAibjkKdMialelL2I30XibHhicvr1Y3UvnRFA9VL40fnTmctrGzPFGHEtR1btwA/132","nickname":"不吵不闹"},"count":9.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/cGTbsIn1umZocl7vuRprVMWCNCjlcIKnclDTdvHOeKsCL7Jh75RKCBuJa2IJ7dOcUfHDHhJ9qhbImAE8IhpQhQ/132","nickname":"浪子城"},"count":9.51},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/nf3TibTkts6IBPqA8a2vWZv2RbpJyl1XftVqezN073cYMr242Lu4C7El0ibx0r7cIwgwH5MfEnA5py1tsXm9haUA/132","nickname":"A良人（趣步团队招募）"},"count":9.25},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKYfEJ7BbjJkn9fr7yAz8FGtAoEqkialpwEjBOPn88pZm7324C9s6ibaATprYTSbDcMosl5a7CN4K9Q/132","nickname":"黑桃"},"count":9.200000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epyYRzawaU0LKYC2kHicCn6MQG0g7y8oCtaTYlYhrWzY1KEuoHviaKPTS0jyVcyxSby8lRfpdCtk9qg/132","nickname":"吃着棒棒糖行走江湖"},"count":9.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoWmfFfLK2wK8CNyHSz8Gx9HubIQtzNpf1LsG2wawWFHxc80GoJZHUexjRRjg7Lax4icSmwwiaeXS9Q/132","nickname":"Aa  喜欢🎁价格看朋友圈"},"count":9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eria6SWAxDHXXGyic3WLvia0NiacVib8BEEZmrL8unpJT6qXnI8Wu4HSqoaQPxvs0yFeBbupfjs85YhUDA/132","nickname":"Chandi Wu"},"count":8.95},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IdElofI20lsyFFVk0b9KcXIOdBicZDRcXiaob6fDmAlqfLfXZZCl8Ma9dBQbsU0ynw0AmCnHMFSiapuCyQWUFAjibg/132","nickname":"ζ.深圳熊猫科技📱13290235555"},"count":8.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/X7fWDniaYIsBPKdu2cWPTRqJ0GJMspHN3NsqfJtrM8ic7TlEkoujsscVeIs7icGoY5ayemt4FrB8wdeE53Sfqvc6A/132","nickname":"我心"},"count":8.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/jKibWzhcQWXT2mVzVmANDo19OibbibLkkJCxqPxG7tuAE3iaWxzneicKCiaGtM7LJvCB2poXPd4Iibw5WZtkEG7ulFWdA/132","nickname":"故事与酒"},"count":8.51},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLrdtbxMd0sv8tGNGLSaDAfzCnpn96VIZoJkds1EUm0H4gSYDQ9k1tAxaE1H8HiajSFbZSjIeG18Qw/132","nickname":"孙文正"},"count":8.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/yslRclgOGud2NSlUkNSgzLjjvN5tKKs4LSoViarv88OAr3ibIATNN0nS9OaeQLYibWIrN7SIChXqdsPls4ZicKOoEg/132","nickname":"刘是非A."},"count":8.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKsmiaWictAm5TeJXp5eukRiajWRDa27ydd42WPnJNOZQblu4mqAteKyg10jGPSjviawibmiaRWnvOUXPng/132","nickname":"薛小刚"},"count":8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/t5y9GB4y7yj7757PcTghBQKBrNUviaOuicIgCuJIBM7k5RI4mspDAZbqYsYbRtz9Dvew5Tya2Hv6blrRDicTvic4Hw/132","nickname":"阿鑫"},"count":8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLpAiakBVA8Ef04tzlpZm4vhaQJmMcW37aEgZ5yumwCpclD8339LGzz3oSRlAia1VlPzBjd4yGCGA9g/132","nickname":"A果粉优品苹果手机📱手机回收"},"count":7.800000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/FWwkDMJ84jqib3SfU8bxn0icNQ4ibkD2kb55L4gOGJhgnVFWIhxibwNyojjUNtCLRxnVkibRRgqicTqfJkiaRfyBFjurQ/132","nickname":"你的陈冠希."},"count":7.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/vAQHG6Yhou4leKWza204x752J7Ko8zR7XfUYgTsNLEUuHEpFBe72Y3lM96y8L2QFEgia0qiaduJn616afD2Zx1Gw/132","nickname":"baby小情歌"},"count":7.66},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/g4NibWOeiaGTpFRlXzrETvE8LbDkkJ2spgtIsDU5Jn3ic2meERwNtVnkAkdN7ZPXv1eOyZaib9yOPhMpwxRGHq4mMA/132","nickname":"肖"},"count":7.6000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJTz3SfVdEjmDqL67IHJqR9YeaVWAEPGn23b18aqV8CSETps1cmVFeJWZQZPLAnhCD79D53MbOQWA/132","nickname":"空心人"},"count":7.48},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIMOCcQzGjOwccTvmZRlBnvpB6ibD4myicV04PAVTssbKeebRGF3JmXlLrVdicVSCGsCRW1gFaTfQfoA/132","nickname":"鬼利🔥"},"count":7.46},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/lr2XGibPto9pyy4fKDicR9HzKQHET6C5UmZPxufBxqMoIhgpKaXvNJNEyDWr7aKzd1x5UAhmlIMXSIktuhTdia9JA/132","nickname":"大牛哥"},"count":7.41},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eotLdHibyTm7icuogeF9cmbicCjQeZnFGDUXFMQtFZOZ5paRfX6B0diaJQBQtxP75OBgml3M6Jvv6CGmg/132","nickname":"默、"},"count":7.35},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIHUH3bcvEYicOjicYzBXhvSiamx7wOBAeVb4rTcZpQPUApqib7fo180AKxlicUtnVUgBIcBic92YUtHtzA/132","nickname":"颜颜"},"count":7.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/GlsS3MGzYnTdibxgMibsuN9nuuSKoX8UUl5SykURjjPEc1mfiaP0gOmHmL55Exk4yASWTEgaOUiaqpVbicQG997aKEQ/132","nickname":"田烁"},"count":7.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ZccFBM9wqKXZBCE3ibiaAk6y5wpmRx9jP08rZqb0PKXwkiaVSsbY7wdpXQBfeHR7DIVxXhghOFpWB2ibBia14pL5ibSA/132","nickname":"婷，，爱腾讯"},"count":7.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq2AjG9LLDd67gEt2HOxXF7WtBcInMmwSEOvgRY5yuML3pxkjhG8hbhMmic4Yzm2wADbJeu5aTRTIw/132","nickname":"My,First"},"count":7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/rPicaIz63lJZ4Bq6k56S6zVxyMqzic3cK6WZrW7N0Lqdmlxje6Mpud0bMOXRemQOXyJfVfsJZ3y10pTuicgNribGMQ/132","nickname":"粥粥_"},"count":6.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKelOFLhnNsafLPysIqfXctOIsqbm8up4ibwXs6wH1LLLEc56Dib4uHSwBXJRtw5diaKlIWGyrOou6zg/132","nickname":"A平度余生"},"count":6.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/sOmp7eW9WvABiaHOFkibktacmFkojjqF0H0sFOs4aC4mhHawvUnvXjaQHJstkNgJMr0ztUMlnw1vh6U7PuTySzrA/132","nickname":"大施😉 招合伙人 大股东"},"count":6.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/UCOHH8wd0tY5ia5aQTViaqBOZjwGEaSqdbfsAeQ6OkMRoVLk0ajuppWFcTkh12RRWvHPSOlBcbWg6iaPffKya8eCQ/132","nickname":"稳（全天接单）"},"count":6.82},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/W5hWovej3e0Rzicu9KaLxYUialPFRADoAcJDDw8msfGq03CgQFNAjvLOsKsV5bGicFR6ErWTVXndtY0y7KhkNxYfQ/132","nickname":"🐑"},"count":6.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/UsFFkS32lQt9BEq1ZxhaYVnxYFzfnqAjbTanayyt0vJtdhBmF3upjUWA1INqCicFR5qps0kX1XibojC6q9l2PU4A/132","nickname":""},"count":6.65},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/8vv6bw8oaibAz3NUMSXdy67dBM1VhYNbKjpguIVe206mTMcrjvGU5lng8B3NHCBLx9TYZ8bMk7fo0MNLeUAEwAQ/132","nickname":"长欢"},"count":6.6000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/mrL17qoib6shCx5yyAPk2ZeJwH7HPdyhAqdkcJTglPHTdvQCVTzYSmwDTSSOKKaX1K7VoEVAZlic9ic9LrejrrGFQ/132","nickname":"一切随缘"},"count":6.6000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK2avKIXg19SADHAWib6jU7Y8zuqrXLtu0dkWLpvXqU8Jy06Bp4ia40etdKshOeqbZLicKKGb5JxAaOg/132","nickname":"A二哥全能代练"},"count":6.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0wpUDw5m0LRvdDueia3uMWktU3eV9IkreMfG2eiaxz0tfKJnSzKWZ4G4jekAn3ia4rGbibd52mg8XKHvbiaLR6ByeiaQ/132","nickname":"很乖."},"count":6.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Iy3rGQO05Unu54hsGYOtu03rQcR0ibJLN5NiaN38EjYEfrcGDVqGw66wwAUtUjeq9PZlfzGCRIgbb67M0H8DKvng/132","nickname":"何雨祖爷"},"count":6.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IIWY0BbpgUean870hw4J9GicpxD8wicOun7SRJtZQQdQmrQowzfqnKcHapIMFsoiaG341GrmHnqHrpqSQgA2QO7ew/132","nickname":"AAA专业婚纱摄影   （托尼）"},"count":6.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJQiaYCkYtqZVolHMk4xeRswNibxG34hWtTwibjP1BENxsEUledZlQMG2Zveo5YTwS34eXrPoYkzcDZQ/132","nickname":"我是一只小小鸟(管理)"},"count":6.3100000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erVVABz5icicjPzUrUxYttUAsicQqcCaVOhppvxCPRg0kJcz5DtibiakWBOJHo7Xj5q6883esf67p7WSNg/132","nickname":"夏鹏13409956213"},"count":6.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqgicGXtyQqssnP3ywYVlMO9yYFdC19icmBLbtZibNETYFib9eOnibp4ktVltuTOR389RDdWEYTHvGRVFg/132","nickname":"猴三奘（双系统接单）不借钱"},"count":6.1000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/HcvkG1JE7Tq1wDOAE1HxwOaKyotAQ3InhT0Swk4iaoF9HxsPgv4NlgZntAeOic7fRoRxKj7n9JJwpqygE6yppb7g/132","nickname":"为你拼"},"count":6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/wpcWbicTg1W5Na5M64Dbvnl65aArv87ibmSCibV95KomwLvHStO9yswbQmputhbfLs8icia5t0am2cdELKgECzicNpzg/132","nickname":"旭旭¹ 🐝『关注朋友圈』"},"count":6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/eWLNtic1NnNsVVuxhx2NG1OGdKT6ABBtufW3Cy4zvG9SGazaVOuetxmdGfy40fyk4gzZkez8IgLKtiaLvzuViacTg/132","nickname":"千小凡"},"count":5.86},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2JLib3Pck1kyZ1j2wuylaq0p9fAVAn8mw5Niazy5u96KWC4ibc8QibXwoV3xD0jnn8eCEYRzicsTOTY9nBBl04sbQjg/132","nickname":"哎朋友多"},"count":5.800000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEJ34tiabld6tF5DY0SPR67Moyde5yYVtSz5lzWlkLPmrhawibr8PiaDQjTPEDic9ib7X7SpV2ib1SPQJ8Aw/132","nickname":"逸曦"},"count":5.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIZosRFPZ1E4icNib1qCAjoEBYbUFnwOCUMsgxWq69kDs33RXa0Q9JjhdTF16umSN0ibugC16iabu4HZA/132","nickname":"小娜"},"count":5.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIxUzdh96gqsibGMH73gLfyaibRhtX3IMvmmlnsc8Ux7Amicr703sy84vAjIJg2Se2SUWEDNUsyJtGibw/132","nickname":"K."},"count":5.75},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IXqKDdRhicALvNwcBicxkZ2E0NWsr3dNib3aibVRzlhn5QicKoqp3tJW6hjO1HGMRZ4qA4dQyXbXHbaK5a69SOEQnYA/132","nickname":"小欣怡🇨🇳"},"count":5.720000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/cSberiaQibAdkfyzQASgWTmMoDleY55mQ6jYojvjWFVd420qCrSZYibkt6zUJ80p17DSIKU5179IhfBub7w0ibr86w/132","nickname":"美宜佳（外卖24小时在线）88182586"},"count":5.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/FlJnX0Xvta5MYNxRKLCYJyC5wp0M29aicTibJCObUFW3mB0Nu9hflSuF9qVsvVBib2wpj4EAiarVCnbicRBadUn8w6Q/132","nickname":"【钟诚团队】招商加盟"},"count":5.65},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/7yJWHkqkOYPVjjtXNKTHJ6ueCM6ugd6SLvxj1nH3q9fbMd8ic288U2CrywUjKMz2KXn7Wqia21E42OX9xWSAjtBw/132","nickname":"-"},"count":5.640000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0VpVmZNA5bc9QVicEbTZ6624hib6npgtEDvCUPyjCcAapFbju6ktTGJgRQpnFricWjB8PbCyb21lDSurUfIUIueoA/132","nickname":"好尴尬骨头汤"},"count":5.59},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/hRHticiaQ0h6m8IupIt0iaXVRZeUjFs43GavDq2iaDlVOhUa2y71DcL88Vk2gIhibtVv7Nr9s7bNQiaFicY5OowdtTdgg/132","nickname":"术术术"},"count":5.59},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/wNeyw5XMcB5OMywsfdD7oahpichaic0lBicEcibWenCk0RUOT2TYlkvsXBVnLZHgE1vqJCibTO5Fcs47gdic89aHItMw/132","nickname":"智恩爸"},"count":5.59},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/xzLC3pQOnoPGGw7d7QXXibGbXYJo9lmCJM2bLYgJspF9XX8ESOaEQIqK9ibfrOwkMNzyEicRv81fHo208YDibsVKtA/132","nickname":"洋尔"},"count":5.59},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLPIJjwwSHABWtyHE40syoXFjlU1Rs1unWBibMDpQQO8iblibyOU2f4zLWbSoHNzHGlGn6IKNtZLfkuw/132","nickname":"A    体谅  🎁"},"count":5.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/eAqsxJxMsmunAkT17A8TVahH887YicAJKzJULskkvewo590XOxlycfTUacaWgVUSfKKCG1vfJLQdC3JbypkRsjQ/132","nickname":"阿超"},"count":5.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIJkLico04QOhnUjyTHh0zfXkutzQFEpHoRwqDjrEj7n1iajKNDfSVWmllaaIYY7zbFicpQclzXXKkjg/132","nickname":"林依"},"count":5.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJR3ibjnKyS1ILWuNSysvwItZ4cRDick82JxXNKoxMObibzfWDic2eR4p112EVlTaucgu5OMlR5zqAaWw/132","nickname":"A眼神 :价格看朋友圈"},"count":5.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/icrgdEahSPklxcsBPKvWOx98I42QCqxMKOBFJKCHYGspzOFcdHaicmIEpBqmbxrPTmESIPkf8Uich4m9l3n8yW4BA/132","nickname":"Reality"},"count":5.28},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0MhvWCiavPzKnAtKnxpW2VFYTcZ9lhMQibGF173YFWkduu4S6CgqxaoCm8awgyVoic4DtTZZ0Cs0bXhfibMHDGtuwg/132","nickname":"还能吃一碗🍜"},"count":5.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/BwRibO3sTmAayALib9MTPK3gYa3AP6l5H3DyyyKZY7oLTXKMhciab1aZ0oWam9GtxLQg2ibCuRIJu771Pia9sHgeYMA/132","nickname":"一人一心一花一世界"},"count":5.01},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/rCQPuGDbRkIL27icEiadkcxuqTSiaFnsibEFbqe4y2OzeA3ujjklY6MWjKIicc9F8p9dx7CLNpicaAcHDNckjFiaGib0Ig/132","nickname":"杨sir"},"count":5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erl61VgZQCrGvRvy6ZBRcXP3UABPKMQCFoYwUXApXibu89LwCzeC6pHvoM3eXnk5VgLMZ8q5yrrEww/132","nickname":"Ambition"},"count":5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/gq1EeEEFPQ8nolerAYYhQbq6xicuCp0ZpX2He9exXPcTIZzAav1ptbMLBdL81m0azlcBJuRVyCcXEueDBqE0VoA/132","nickname":"教我打桌球吗🕊"},"count":5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoZ4klhz4BnOH8AGDoRlqDNfR1LnJXPHHTvcdVTewBHy9POe0zwLyM2uWRAT4Uzicge2fiaHFs5CfFA/132","nickname":"A  虎少💥👺"},"count":4.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/93QibqPQjzsNpvJBbPyt6wiblSGMd800UfTha7GLxtL7pAAtpHLsZqhyp0UM1S1HBiaEw6lZdQSpmQgSjf3Debg6g/132","nickname":"醉酒川Sir"},"count":4.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/tkIyPeagl941T4kXmMiaqjwMZiazCvAGQAfkQrPja538womMPS7sSaq2ImbhuQmSFUpNMUx49obQgJEIibPv1XhYg/132","nickname":"春晓呦"},"count":4.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/YvjH7KQ0q2O5rf8pjIoKeAu5aXgeG6EOl0gViaQOqlxnj16SPNl2A3qa3sv2nPEAia4XrNib9bXHKFB5wthECI9sw/132","nickname":"凡心"},"count":4.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/wm8GNUHFyB7RvRnT5pA3iaAhia6saHniazQs7E1r5dzykrER6iaXV3tniaibua1s4iaVYP9icyR448FYgyAONo7pENfU9Q/132","nickname":"踏实做人"},"count":4.69},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLgibn8eGsvJycWWEBCYeQhmIibs4fwcBskGgsvxnwK5n1UvUg3fMpMpaFgAeLNTuOPXiaYnE2VacE8A/132","nickname":"撩安然专用号."},"count":4.69},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/FddRnyvosgwAVhSibd7sLjIJ0Z6YqOIEwNlvlhWoJm8fRPuQrAYq2JaKJJnnjjZZdByWYOWz7HLUxQo9zJ2etcw/132","nickname":"🍓"},"count":4.69},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/CRIsqLN1oMoA00Utc9XjxS87FHICDcz8P1Dblhy2Xq1wibhhIq673HRsO7HeeUrE5Ll4ADZstCeibI6MiaW7cpNyA/132","nickname":"渐变💔"},"count":4.6000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoNWVYmAH7tW9icfKvgHZzGeUByOvnf7fZbibLgUkrdH7ohLl1KZiaDibswSvmzD1T5KEMzsSrS82icLnA/132","nickname":"十年"},"count":4.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/cPg4GFXNxqjLPiaibuk1ucRrOHzXw4h5kW4RQg1wkBgzpicGYeOuuVzDkZMsvtiaJbvr8RDwJjBQ1mx5dADRD6RbLQ/132","nickname":"呵呵"},"count":4.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eogtQicicnQwh54AmhEBdQzUzkjNuYs00qt9T77EqUSibnfiaA0goVcApWaibCpuYIuuZIbgB4xhOGKZsw/132","nickname":"ღ宠着我好嘛."},"count":4.5600000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/F15BKpZEticPQ7nhVJ2BdUiaBsz9gds2iaia5NslhCtZk0L7sBMXk6PE5MibzNiaEzVxt8ZBHQ9Z6uBT9mWMSUkKtJrw/132","nickname":"MisW"},"count":4.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/QjlYwCvaFicdyvBH3WUwuKic7FpLhZSeYeia5ibQCPDJBUZgUtYPeyrChdQeTic2jm9DBYe27OrlYKu3OEH9CJHy4fw/132","nickname":"橘"},"count":4.43},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/xtDTeCHEAvibF6hHkxc6jWiaicqWYrolOJKvgkM73G01RHbcGO0CTzlY9mq7V3Y60GxSFF3vqRhrNEvI1icPhnGzvg/132","nickname":"janmy"},"count":4.4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJJehLImq7Ly1tIQS85Exc9ZPmUgr3OXo1gQ0BiaQnBfsyTnYhvuaTOicLmBmAjdKaiaAIZmS2UMTD0w/132","nickname":"a2 南泽 （关注本号朋友圈）"},"count":4.36},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Xb9JbojqcrkmpbOHlD9hEF8eaFURdwESHs24ic7nSLVe8q1XkI5VIM4kTDSf9KibVRzX4FodEicS7cDuhwYn0Omfg/132","nickname":"啊涛wi do"},"count":4.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DWAKQmeNGMa8ZGr1lPQJhlquXW7uFjoPeLlaIIBumv46Q6GtX3Cgm9qIQUdGC6GP9l4ZONbvpX9licuBicwrYEiag/132","nickname":"杨杨  （筹备4月币圈）"},"count":4.22},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ibpOULTIcUMSB8fCD0AzsXT7yPocqYiad1BcOcN6Uo3CeSQE7tTzVwibQHq0RtKictPgOuLpB2HT2uu04IssRKurHw/132","nickname":"刘总.找实力推广和总代重金合作"},"count":4.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ICkKn49K4dRbQIVZQ6kjKcK1EIibFCSjKR4gSEZs0WnddEjTtQ6KkicnyPwia8TyRzI8QDLibZyOXviba4HWic7mLQPQ/132","nickname":"曼曼"},"count":4.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/GOfCFAWApOBBOcV8Y5NTeiaCmVhT0R7Khg3IJqNAkOfIj6IZEhrjhOyibftVwgyg7rLF86Gtt7CtjpKepUrNmkjw/132","nickname":"舒婷   (关注朋友圈)"},"count":4.1000000000000005},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/myAxfSYr7rW4EgywkricIUjkMSjpMLBOK3hnpeLdoLd86U6qrDic41VqWXwmLShaTSAq0WhEfSo5uibhn8Qcwn6IA/132","nickname":"007（项目对接）"},"count":4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/QA9W0pCV9h7v2Diamia9P1qHvVBRJAtAM98DZYqNc4PXmlsX8jGf9AqA6xaxmTX0HTvlJhYNf8edWfxtsXYfcZeQ/132","nickname":"中国平安人事部主管"},"count":4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/xyaCHwIubiad9q9cNW1uCjJYtXTTCqicaIUMjHEuhDb9zMbfeHZwTiaz8oQtwR88phdq0ESkZibpnV2hyytiaENWkTQ/132","nickname":"you"},"count":4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/HnQIgBC9r3ms8vu1I8wVgX8fwsoZzic56SpSdZHv4u9grnb1cGEpKFBqvVZcibBzLKsRjAkXJlyia9emCYFOTIIoA/132","nickname":"xuan"},"count":4},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/oa1P4s8pvUAKG8bcDh7zwkRiaicMLHXa2y5pulxn0PfryTIn8NEoIAnQFohnw9JsCOmicufo0bjuQkBzmicgUvU99A/132","nickname":"选择"},"count":3.95},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epcnJ1icYiaNnkgibbDr8HrOnZSOlsOrfHjA7Ym9viaAyW7T7kG0dXZQW1nc0xYVaClN25xCiaXDibwicMXg/132","nickname":"A-小戴数码17754010305💯1号微信"},"count":3.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/bT9AbnG9cnNyqat50EKRSLw0Gn23VwIwEibDV71a3bXcXhjItHP01Z7trDO3RibPXW0vaduDutQP4hxNyS0tHEibg/132","nickname":"阿凯～路在远方"},"count":3.8000000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKmc3oGPTnbn2lA7wNwoIVNgNnUVGGeoYzQxnv0mB3xgNXOCvk6k184m2UNhltsibzJN0QbiaA8RsfA/132","nickname":"baby🍼的小白兔软绵绵"},"count":3.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ialwkOPIngKAAIr7SYicbyicCpTfVko9eFTdBVEUaicicmibvLicib8hjHvp0UrMUDkgZZicIzumial4AEg47v977cI13ZWQ/132","nickname":"A-锋行科技（招合作招全国代理）"},"count":3.54},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKOnxtJcwL2Tnz0f2JzJVUjAU3lEQ2bqOsh8JVSJlBLNQcjryRenj3ibzTsDkyXyE04kmkSk8lgDow/132","nickname":"A 心逸 项目对接"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/wg4obeslvazmicc9YafTytlFpZ9uVhKMgPzbic9lSfRLT4rAWOqkFEgbHuvWmLuAjh83wwLuS3KyRdrqjgT5nL1w/132","nickname":"啊丑"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEJe08fOHrItTD3TOS0Lce32mCTDo7EtKpCdPCm7uZMFs8zUU6ps8EiaUIibgeHyp3xJ15FlicwTqNY4w/132","nickname":"浪荡、"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/CIXAgGvtpRyK754u3828L4NxyjYamBfusm6R3ZstSNdMIdsqxxicICW5s3T4dhCChicGibfibhhFsvPRibdeUUCdpcA/132","nickname":"拾柒."},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIqryHjlrZYX05KlexVudOiaocKeIoVIHibOXtzszPTDkOz2W2icFUGx7zkfiaSmibADGoBiaS057TxLibcQ/132","nickname":"鑫龙城小张"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKtuTyGMKBIhMM5aMKKm59tYS7rtt1lA314FFLrufnooMZ3uJRxfMrNdO2C9XVeibg6m8HjeV4N3hQ/132","nickname":"爱德数码-小俊  Tel13215513319"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/0SDRac7XooqB88PnZZKYXv2IYDF8phw5DibeiavGh7KzQ9RG9jzL2nTh0BtvHrGGia8AzPou6AlBVhKNcKzTdFiaDw/132","nickname":"A鑫兰-段(2019發發發)"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"","nickname":"斌鹏"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/vrldrDiaBZKjmJFgX4Kls5WwlobCVOHlrqecPo6kwAoTlq05aWicib9Nzec3bgLFyaiabZicJUmziceA8ocMPI7bjiahQ/132","nickname":"仗剑走天涯"},"count":3.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2PjnPH0QOJffScJo1fc4ssgnaGuemsiaibcWxfd4biaot0lWOPKs46XmXprY7B4LjyAicia4icib2vUzppbYux8hMa3oQ/132","nickname":"悠然"},"count":3.48},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/MlFhyPQQSdGCib4VbRibQ83dMnmnia8RCQKWyM4JolGUBezUbicCUib5qhpia8rCFZ7I7ic64DO3BLdliac7RqOXRMq3LQ/132","nickname":"大鹏备用2"},"count":3.45},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/WqAvGeJ9ze2Std9Dgn1g4LicOF53q8a3wRtKhKE5z6PfCWt6yibC9naQyQOYZ4rv204icJC4XjHamOJTQIiah9mcaw/132","nickname":"A大鹏"},"count":3.45},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/j5L9Z3JA0GH5Hdyz8ufsvb2AxCSvSsQONB6jtZZ9rgS9yFTbOia6KMoJtNHsGoMTKjgr1wlCyTUaO7N31BaMvEA/132","nickname":"小酥"},"count":3.45},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erj4y6ibwRFBGWMBGLFF9LEjsox9Dvibk1QrElDF2qnhgmVicxxJiaeYibiajCmoibPFFuuWibCEjEDwPiaQyw/132","nickname":"AAA🍎手机批发-13105164111"},"count":3.4000000000000004},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/sZ0JqHc8elfdwlagcHO20IoPQtL3uzibic64C9XeOxlp8nia8w9TXm80SzKic3IqIjkf17cSEtVDUEwMs41AdMP4Yw/132","nickname":"小小玲💕"},"count":3.3200000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q79HDNx5mGqCPpa2joLqlgQpYkNxWlgoXJbCLibb000FRdhjiaKfgD0h39bVico0ZrqIXsAXeedCMSckWPLl9GxFg/132","nickname":"血腥玛丽"},"count":3.3000000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/KJIG1Ivz65cicsIxvwJDLbvHXTb8ma2tbyjXfIb1fcdHO5ljDohdgYyiaaGARCPwRwLZ15ib6ojHvS1B7YibfNvWoQ/132","nickname":"被遺忘的回憶"},"count":3.3000000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epbDc00XGl949ldvfKxAw5ybNqy5ZQTUXsRCicMIjKIAGG19mlBVo8K6MbmrDBkERibCNictjSBtSXbg/132","nickname":"梦大人🌝"},"count":3.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/QwS5kZ3PMvIo2tiazHdlMoCqctiahHmonkpPT9YPu6ugdmTBH9OucM3Qr2W4QlnlpZgMaJXl2icq1IsVNENHCdPmg/132","nickname":"煜"},"count":3.16},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/fQmZdqLPaa5E5gdESW926autCXJvXXjeLZT0mY7gdIrjPIlUWJ7icUOFrFvGu9FpMY1mGXxFic8fyicQt6823vFaQ/132","nickname":"依旧"},"count":3.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eo8944nhkvLIETP9C93OybVmlNG3WQ4B7GCDAsqGtE304PqtTcPiaBqhb4SaU0Gyw66lm3ian90B6rA/132","nickname":"A江泽 暴富项目（关注朋友圈）"},"count":3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/R9h0RnicTHauWZjfMyTYDcyYCz9sbG6IA3cf2icR4mC0js7AkuS8zcmNcB3j3RkPYoibPpSSiczKv2nfcfHJu8b8zg/132","nickname":"Steve👑"},"count":3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epko5Dw8tvicOgSaGxStVr50ZCTYYMj0GlN4icWuQvZ765orTmhoMmRP792xbnjic7sddPrenWvFzhDQ/132","nickname":"书香年华(各种套现各种来)"},"count":3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/48C3rVxKmGwm1Jib85BohdTKy5ehsCuPa9g7pRRgTRwXzsAFW9ibBgVcNSWHRPonuOdMY9IbIeVUfZoBftHvPkbw/132","nickname":"宴寻"},"count":2.9000000000000004},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/FEdEngjt2VQm3iawxaX0xHsn4xW3OHsj3jCs7IGcB7veM1ho0UZEgdqjtX4cGvkJiaH7hiaMZXM5QJvHib1G8lR3Rg/132","nickname":"A-影视会员（换群）招代理"},"count":2.8600000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/sKfc3JgkOg9Sk9m2HLBJrLPNjcrpKCaKTibnO4LLkRChv1zaHpcwjTRiam7icwShX0NuMe5uia4kxPiauFUW4N6UBuQ/132","nickname":"juranGG"},"count":2.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2vzZyDRH051vM4cBYgeHdRL6cL2b9MIicymh3jOI9WGZ9C4axvibeIVO5KPCFo6aKc1M7cVj0ibZRDSPfSkMIfEdw/132","nickname":"妈妈咪呀"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/MnRZdBCibEaiauUyZibaAicaYJdzKTyIl3JNyibQGViaawObxq0SFuicQtbz4CM3U3tEC7f9D5X1cWJtiayLd7Tvl3wfOQ/132","nickname":"AA小聪"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKKEGcj5hFW5Y6Y0ic195Ug13Q66knsHFWDd8LznA0scpE0gEIaK8ojvEdLibicSFSiaH3hjdayuSjqWQ/132","nickname":"。"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ibGPCIwibCianWeh5Rkdjia2cR5jwiaiaSnGZPlVVd6NemUfw5ReuYm0cTMhdmicxGAJqa8L42w6RzQ8NHYibX0pf3zibiaQ/132","nickname":"霁大叔"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DvDIiamGL2iaCh3qcibibNFBQHKLOxia74KvkJo2Ef3hoUFPTd3sDdWab9anPj1FFNRllF1jkOSGvibibvTWmUIibmvrWQ/132","nickname":"锋哥"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q4ib915O6hQRHhMk5zt2sl7h0YjHpF8Yp8hJrLANpCQaybouyIoGe7ib59FaHvOsAb5ScFXESzINTia02pa1laOWA/132","nickname":"清风"},"count":2.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/6X089c3WsspdWvYUiaIDG4u1vyyLMZpc9ibB5RNUltzmPVK6dD4U79eicXa6pAvicibvvUUKNShy9KaUDumX15yhj6g/132","nickname":"宿命"},"count":2.68},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/gVosEHqCWOE5RicFiam8IMQic36YFbLdEzGsPt7PsyH26ibbUFFHOgcV1rEqx916jDibpolMlBnvR6RswibIyUibO9qAA/132","nickname":"a ye 💛"},"count":2.66},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoX9ZkGPL8DAicZFvefFtDACyt9JFtIu5ib1fb518g2kyQlVcKpQxNBuO7Dl8xiaMVNS2UqCx5HiagxBQ/132","nickname":"猥琐滴小狮子"},"count":2.61},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/sJnU3XZziaG8czciaQaac6DrBvqOn3CictfibXBrgdSVPI4ma8hEQyesAfozHBPa6Om1q3aXJtXttvo3U5KExMtmrg/132","nickname":"摄影师大毛"},"count":2.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/c2ZaXk7yvx471b7kxMVB0WChL7w7XaM90M0zf5ygzNVcW6hib17rEQEhGo6nLbJtxpfJaUgUZlot9KBNMibSK8kQ/132","nickname":"A 黎明-关注朋友圈"},"count":2.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLMEXpOEkO2C65EvLtRgTgiaBPLicOf8w8j6bDIpCY2yiateKSDia7az0nPiad6fqGvfITzJiaBkk06YdfQ/132","nickname":"A二哥"},"count":2.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/qXbLjJB4FSy1cibAn3QH01k0MDmPiadCdGerkpe3fkpCBxwaoLFibbXUf7kXWVLhTXQlqG0HU7ymaT593LA11yfFQ/132","nickname":"逝去🐾单純"},"count":2.5100000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/tMrqzs7qJicI548vAianznMMJ7aZvPAgaVUricE5VjmaPtpjS8icoqJZAElficuztZW3z3Jar14QHLKYb8tpQBnwkqg/132","nickname":"🍃一生一世🍂"},"count":2.5100000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DPAiarROoO4JwFOkxmFqRmiaUWedxrMgKx3YCJGUaFic72qI2sXPwCiaLfkz9YfPAM3IMGubneaU1c19XurVW77dWQ/132","nickname":"网赚小胖"},"count":2.5100000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/iag3D0y9ic8REPFjEvaSAVv0tBribY5Nb4gQYUTEtKEBy7wsTbTrNQIicGwLfgZ7xGdPwxkIIrux8HJJk6iach3GHXg/132","nickname":"匆匆那年"},"count":2.5100000000000002},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/qe1uibgwsQEhLgJ4aygeQFXsgvJXhfrdtApqlHoFyrBWvQ75V02ASojuPVAuOVgUPFzQR9QaLGCvve5oONVR8Aw/132","nickname":"@   梦在深巷"},"count":2.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/SVzoO7P7lGT4x3aoic8bica4icbpSEsCiamap3Gp1o7GDHuPL1InBnthQtibfdybbQyPuEGCmds3EiaphbBFDy1IRVTA/132","nickname":"小小玲"},"count":2.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqhf9NQyvibXhF3w5LKw7yicKiaw0he0ruIbsl9Vu8cibGWXT3iaUKyM0JEUhCHyWVItbsx87ZfSJd2Kyw/132","nickname":"心动💫💫💫💫💫"},"count":2.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/7icYslR11jBbhBl4TNnVbBxvgDQLY0b3gFmI4Jib8wJDhNWic46mv2uVWFic93bVCsOVb9VPwrHEu07YIgiasoc01Yw/132","nickname":"梦幻你爸爸"},"count":2.46},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/AoXC8Dwxrs9rIKuRhoTwicn6PEyj7GcGEibTEynhzWl7ia6UuHMAp2rtkL71Ax7zRV2mWW8zRuHibsOVUJIWd1AhkQ/132","nickname":"꯭꯭山꯭鬼꯭"},"count":2.4000000000000004},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEImibiaAEicIGl48qlYT4FUBNCEeIGoRlKHoKFqR0kPyu3Y7n1GviawFexWhrP4mvUyTPepXUGt4jEPUw/132","nickname":"田烁"},"count":2.35},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/4LlxT4sS7e4n5ekMPAoV5136tOJrOTTy9EJ4EnotkFOl8IbFciawdbKp8niaLMSU0UflRZyFzOGI43UVWiaVXrxOg/132","nickname":"浩恰似少年"},"count":2.3000000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erCKCdqOibib2XLhRGatpnXZKWGS7OQsm3ic0aL5uyymdvy3685VKpuDX8KfqFggoIKptD9qKG8sfy0g/132","nickname":"鲛龙入水"},"count":2.3},{"_id":{"masterunionid":"","headimgurl":"","nickname":"笑口常开"},"count":2.3},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/VUQn5YokkVjRn0JjBRvYviaLeDRbraicrY3pic3XKqwNvTAxG0h19eopGS3wVxicczsx4baS42FAM9JTWzSDgI9Cag/132","nickname":"久悠-关注朋友圈"},"count":2.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/CFgRnoibx9v1OWZjoGlicf1kAMKUTW8RGWNc7zm345wfHtJGLicSohNAJGv1oPt5mqAx8nz9ibjSQueiap1FjGwxnKw/132","nickname":"鱼与熊掌。"},"count":2.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/BL7ic7uQTibM3GzNrC0XBiaKnkgiaCCNh4ibMvt4KiaMvhJluWDMwK9RhXbeNLSZzTwlcGHyu1iczsHGwa5YibfQZicxStg/132","nickname":"七月"},"count":2.2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLaaic4OoAlPR6sfViazAOPtmfoaB2KyQ2R2ibJ1R7oGtT77O895zNmEb22zgxyHvBP9vJS7BefTZ7icQ/132","nickname":"风筝"},"count":2.19},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/mYDGEmZhqhtlpDkZxduhoynBQZD43icrTYfrdZJ9Sqc1S7pVjFRBiaLQ8ruEQzqbuf5c7DKmWoTG3US1poib0BlHg/132","nickname":"💋灯红酒绿"},"count":2.18},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/GXR1rhlIANMFGXQsOicCm4RCGXmZODmpmQYk1iciciaOlT7cRJjx1mgwMPFO8OWUFQLo3EDx57V6cwpE7hNCyIlmVw/132","nickname":"S夏崽"},"count":2.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/HacVeFoX7xUGmauAO8dMSMmRALlCxbfuL8icWJODaBXJyDxpte669uvSQVpRvGFlyPOkrGjiamYzc27E0NBfkxmw/132","nickname":"byc"},"count":2.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/5LjBibnE7thgL9UWJTKGXKBrZXnodz8F8tOAFSmdCeJhcsftIRbVxvYIDu2MN6qib0hiaBAWCq2YrI2aX51BS2c1A/132","nickname":"景煜"},"count":2.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/q4DwicZnNOdSN3GxwTAe1iaBqlEK91zkDewTxkJ3qNkkrCzgOTgLGn0Fibw75icoriba7GSFWaFNAiayJ3vibd392YXicw/132","nickname":"曰先森"},"count":2.1},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/v8GZkc2jdibYMlwEEMaSlY3rvl0Kz5V62ZeJxYHthxbiaS8d6ZvEAkkmsoEyYOa2jHxOxY0l64GO1rga8ticDtbiaA/132","nickname":"y"},"count":2.0500000000000003},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/gFE2skMqzrdAK7TibWyeEtrHAC1GxTIxufuUhQEktq3HOG355LsvbhbCUCumfjMURKCvzj4GoG3moy5gaPArVyQ/132","nickname":"A-乔木🎁iOS退款花呗💳套现"},"count":2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IRZbtykMRTCk3khiagiblftEf50Tp9naBTHianfSibmTDPDgQq8E4k2TJxibBC2yAdjNISicyibViaMlb33pe0f8LpoHjg/132","nickname":"私人定制"},"count":2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/TmGsnMI9e9NkKiaoaeZHHvTbnvINTplictR99MFUib6q6sOMoVG2QSaGSnPeoNZr6LHVmwqAYdxiaFIBdYKtuvhPfQ/132","nickname":"刘政而已"},"count":2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/dGa4C9GU5re3dwX9Rl3NgVSa5rlBSkcEtG2fWmBVVJa3E7giaJfmqVwSrTqeSQsq0N9qxzibGTKwBoPmb7q8O5vg/132","nickname":"小王📲爱德数码📲采购"},"count":2},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ZicXFVy7WREp00c3VwZG3Q5FIJlxYKDib33I3G6t1xSIg0gg1MicmjV0IlR6Io4aXpYPqvbkaSRhovpwxib5PTyILw/132","nickname":"A.  懒得起名"},"count":1.96},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLx4jXDGtGssWNsVgG8SNn3CD4HwqsWsOfzooUunxLCoYQ7OgjgoTJNF8RicK5ibsykehia0PMG02JtQ/132","nickname":"Lee"},"count":1.95},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/2mMhyEbKBJDFLGbibKpeRU6fqibuoDHiaWl8wLd7RHH20e2XuLUkb3Fq9JBnTuFF2EoqOdQib41ZdZd1utkufg3cwA/132","nickname":"丶朝晖 （落笔成灰）"},"count":1.9000000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/IIRkkF9md3bkesPXmLPKEmjIxBhQxU2uc2vbhZCquibcb5YOh3veG0GTCZQZxjW3QT9GCE0TY0HR594Uumbicyiaw/132","nickname":"河南测绘职业学院李老师"},"count":1.9},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/KQMZrNVzpNopNz436br7ljI9AiasgqS9SFhEVve4rN2VwEsoRFB7z08cNy6ryAKq4oKAewbuu4iaRRmTCjwVHNAA/132","nickname":"十年"},"count":1.85},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/HCoiaTKCBibRc6X3CB0UrttSI26Gu4DUjS1Kj6NW75KcPLke0wR8MjNQ6DWUvLxONXNN81HIcZLic3nakjyPuwcBQ/132","nickname":"聪先生"},"count":1.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DPicaFGewuSewNtQOJt0CQEyYSXj8RyvZB0CoemFhkCvKcJwmR3xUCyUgMvbzpnx1z8AichTDLPxGbciak0IKkicHw/132","nickname":"💜"},"count":1.8},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/hBV3ichhl4jSn2ibVJyq563OydXEHeFf6mycUFWdqmxD0N9TcTVAe0DWAuLPZo2mg7NZ58xeHI3yWCK90F6cbNoQ/132","nickname":"悠1"},"count":1.74},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erKI8UCshNDMBwT4UWXJ0UpNgB6SibUiaa1DlGh0j8E3KEAjj4WAvEpW694NmGIlibwXn2JfjUt3mulQ/132","nickname":"伊成"},"count":1.7},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/4syv1pWuNClHnibD2k7sWqPlmbWOfXej70VwTkibB8LToXR6icxnruAgBicO5eqGSvHSwfXXooQ9icqFvZW8eBDfVLw/132","nickname":"流"},"count":1.66},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/1PxfmoStkN6Iyaegnawne5utUicwvrBmXOju4fSAgXicjYVdBiawo6S7NWjyljYTNWtRJdaufyBr5CJibtXqXAU5kA/132","nickname":"皮"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKopmg6NADWmjI7BiaeaRczLQz39XHDP6X8dDI6hzAruHdnzQlbib8KnHXGThCsr1bxlky5RPnicSkEQ/132","nickname":"W"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJziaZZwfQ1zCmR0KvZYwwTFsp1JsBVBkmYGz5HRSjwxiaDPZSnDiad05Pnoib7HytUE6eVCHVfoBh2jg/132","nickname":"😉 猴子撸羊毛"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/d7XEM1KC2jiblLTgBUeBqUDkm28dNNnrDgmz8lRqias1FZS64WaQIVv8rq6Fd3cwM4EPOIUy98jxuD7g1F3ncILA/132","nickname":"ambition"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEKQcUk4qEWfIQlslcu6Sqm1nt3AYMOVyicnM4stkeYm1xEmnNGbp8vFLhgMFGJhVDVxbLsY7tddsFQ/132","nickname":"H"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/9tJia3oNBjxqibdpMoCVTbkrMS1qTE7giaFJh9AZmWI6nVkiccV7SZ90baVL0uDjDjbAicr5o06YibuNeyO6LiaIfPGsQ/132","nickname":"璽"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKHBE6jibqdvRR4WqNvnZUa7OLgFBhaxRHMOB72IXXwn0xCs6tFIqDnUiawgymTr5VibCl9wAhoEqJMw/132","nickname":"轰轰轰轰轰"},"count":1.6500000000000001},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJe2v5tzdicP1mDwFp8HiaUqZhtbZUEskmwkzSuwRs8gyJ1KticKQeIQOX89rThsUoUOa36XdJZsq8ew/132","nickname":"中国平安人事部主管"},"count":1.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/6h8xqjbl4SZ6RPibycrkUjDsSFOUMXGvT2IUibf52wLYG8iaVzhdBa9yBjC3ZbAwSjxPpdiavUyQEkQfFMnMyVxTtQ/132","nickname":"い依旧清风🌺关注朋友圈"},"count":1.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/11rM8gpicF1oib0wW7nC7doj7ibHsa8ibNrPf1icFPAdicmJEgl4lYvYY9lJjX10CxwkVHOV40fwBDE5ocfmSX2yqWjA/132","nickname":"朝銘  (单枪匹马）"},"count":1.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eotuZrRx96MsDw19U5PTL6UL63Ch4w5icJIakR9YpuYqQYWPV16icxtbbyzibdptLv2KVvGck9aF4jJA/132","nickname":"妄念@"},"count":1.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/7M35dvMChrHpQhBCRPS2b7rFwpIStEspy71ymfgraIbTia07Xjsg11W74PpnYS3n70cA83cpXWes5LQuGsqsNsg/132","nickname":"A 峰峰数码📱 19905489210"},"count":1.6},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJs1ErIn36IY9DrJ1tCmrAILGZibg8NV3ZGw2HGGgmurw9PcxTPy2Vst85KbZzeMbCII5feggW6Gng/132","nickname":"叶欣1分钟不回弹语音"},"count":1.56},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/ehXdLRRXRc6eOK5kzNv70w4ibrflDsfZXL6hl8LFkeiawhic3VwEEFkBjwPPrQsOLInHc7uo5S6gwFx22w0e6Wzrw/132","nickname":"A   柔柔🇨🇳   靠你们"},"count":1.55},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKiciaxXibypmBe5WQfkxUnbTThPA0fPmdqZH8ellicw6nibRj67IDJZscqzXOu8w2rnAChozSAefwAsXw/132","nickname":"造型师Bill 招代理中"},"count":1.55},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/r9AACegHquYoSrZcuUwhPK8FIGhYsiacw5T3Iscd9VuyUye4vGI09p1I8D8fhjpIz7ofI0qMre1N35QJZS8UlSg/132","nickname":"阿七"},"count":1.55},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/AYVER4O0pe7sKP66e20U5dtKsia8ibqDr3QbHibX1ToDfmibtbIJQGdbmUtMP8JLbGQOPVOjibtqzoPWGLv535k9osw/132","nickname":"阿琦"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/kRfohFsMic7hf8LicRaxYn4hwxP5D5uoFDBB25riacY62FicCwekKyafbyPggiagbsTRS5H9gn4poDu40laUQHPsCGg/132","nickname":"^"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/EkJPeBwvbXDw4IO7iboO6OQkBR2Ov9tMgVSvrLVTMn3nguPLmFEmrKbZUuXuONhmUL4Q1VUMmExN5HDyCa0vD1g/132","nickname":"骄纵"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIKcZJkGjocTuzfxkpSPhDB1JLNMDCDDqpiaxqJgoquaX5HEBk2Ekb8CiahzK4y9iakeqYIAXm4na4zA/132","nickname":"good"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL0VaYQLO269BIsP16hqziauuAB4wu3O84xcHOtR7ibfFXcN6r1QW5OeuAnQJtbYhUJk9jBZOEfBkuA/132","nickname":"欣宝（高冷）🔱"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoQGT3viaptE8U9Na6z9NLJxhY79SjcL2p62NL2JYb14b7woh5ziaTYZ8ObgZIFl25bQ7BhemxRzukg/132","nickname":"我会证明"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erjt1RG1cJic6xtk5yT70co5xPWWM8iaL7Hwb19wtNhtMoDZ1Dmhg9ylrB21UWZKlcTznkalKCgXiatw/132","nickname":"简单灬爱"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83er8yxIEfpcTuLxborwKrFTBaBZdqicptuAKXwVtetwG6sB1qnRtNYicwQjeG3AkYk6ohicWZEGiabJf1g/132","nickname":"龙猫"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq4f7rXYUzc61kX0bdLyZ4fxkFKba0AMfLOz2vhkPUWibaCdPMglIOhYqQhIOicOOxzAIw28h9OgBiaA/132","nickname":"心瘾"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKmRZWNsg7pibmyKjHLDhAWXn55icTSnYqQAg3H47C7ia8hanVibeDZbaF1TEQAxInOJXEovuYLzXU3Dg/132","nickname":"2038袁辉15897770679"},"count":1.5},{"_id":{"masterunionid":"","headimgurl":"http://thirdwx.qlogo.cn/mmopen/vi_32/Omgr0ibW11H3GW9bdFN4daWdw4dXzarwHukXXoDVvOz3pSk0ricfbqHFQdjntjnMjp7EibLxic2U189gSooRDz0pzw/132","nickname":"陌離ღ"},"count":1.5}],"paiming":1000}';
    }

    public function BitcoinTopxx()
    {
        $map = array();
        $dat = $this->xredis->lRange('bic_datayzr', 0, -1);

        if ($dat) {
            foreach ($dat as $key => $str) {
                $dd = json_decode($str, true);
                $map[$key]["_id"] = md5($dd['time']);
                $map[$key]["__v"] = 0;
                $map[$key]["time"] = $dd['time'];
                $map[$key]["price"] = $dd['val'] / 46400;
                $map[$key]["creattime"] = "2019-03-13T13:58:46.152Z";
                $map[$key]["state"] = 0;
            }
            echo json_encode($map);
        }

    }

    public function cashAll()
    {
        $data = array();
        $user = array();

        $list = db::name('user_tixian')->where('uid=' . $this->auth->id . ' and status=1')->order('id desc')->select();
        foreach ($list as $key => $aa) {
            $user[$key]['_id'] = $aa['uid'];
            $user[$key]['__v'] = 0;
            $user[$key]['money'] = $aa['point'];
            $user[$key]['unionid'] = "oxl9I0l45e3veuDKUiRcinTZckS0";
            $user[$key]['rechangopenid'] = "oUmhj5_qdltYfZhBn6DDuafHGMew";
            $user[$key]['nickname'] = "缪隐";
            $user[$key]['headimgurl'] = "";
            $user[$key]['orderid'] = 11;
            $user[$key]['token'] = "oUmhj5_qdltYfZhBn6DDuafHGMew";
            $user[$key]['creattime'] = date('Y-m-d H:i:s', $aa['createtime']);
            $user[$key]['state'] = 1;
            $user[$key]['restmoney'] = $aa['point'];
            $user[$key]['realmoney'] = $aa['point'];
        }
        $data['total'] = 1;
        $data['page'] = 1;
        $data['size'] = 15;
        $data['pageSum'] = 1;
        $data['data'] = $user;

        echo json_encode($data);
        exit;
    }

    //我下注的订单
    private function setmyorder()
    {
        $data = array();
        $where['uid'] = $this->auth->id;

        $str = $this->xredis->get('psgeMeOrderyzr' . $this->auth->id);
        if (empty($str)) {
            $list = Db::name('biquan_dat')->order('id desc')->where($where)->select();
            $this->xredis->set('psgeMeOrderyzr' . $this->auth->id, json_encode($list), 10);
        }
        else {
            $list = json_decode($str, true);
        }
        if ($list) {
            $basedata = $this->xredis->get('basedatayzr');
            foreach ($list as $key => $value) {
                $user = $this->get_user($value['uid']);
                $data[$key]["_id"] = md5($value['id']);
                $data[$key]["__v"] = 0;
                $data[$key]["pay"] = $value['pay'];
                $data[$key]["buytime"] = $value['buytime'];
                $data[$key]["unionid"] = $value['unionid'];
                $data[$key]["userId"] = $value['uid'];
                $data[$key]["nickname"] = $user['nickname'];
                $data[$key]["headimgurl"] = $user['avatar'];
                $data[$key]["restmoney"] = 20;
                $data[$key]["first"] = 0;
                $data[$key]["win"] = $value['peifu'];
                $data[$key]["read"] = 0;
                $data[$key]["yongMoney"] = 1;
                $data[$key]["isControl"] = 0;
                $data[$key]["creattime"] = date('Y-m-dTH:i:sZ', $value['createtime']);//"2019-03-14T03:03:30.498Z";
                $data[$key]["mode"] = $value['mode'];
                $data[$key]["now"] = $value['now'];
                $data[$key]["will"] = $value['result'] > 0 ? $value['result'] : ($this->addon['basedata'] + $basedata + (mt_rand(100, 1000)) / 100);
                $data[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $data[$key]["buyDirection"] = $value['buyDirection'];
                $data[$key]["state"] = $value['status'] == 0 ? 0 : 1;
                $data[$key]["isbot"] = 0;
                $data[$key]["heyueindex"] = 1;
                $data[$key]["heyue"] = "BTC";
            }
        }
        else {
            $list = array();
        }

        $map["total"] = count($list);
        $map["index"] = 1;
        $map["size"] = 20;
        $map["pageSum"] = 1;
        $map["data"] = $data;
        //更新订单

        return $this->xredis->set('str_psgeMeOrderyzr' . $this->auth->id, json_encode($map));;
    }

    //我下注的订单
    public function psgeMeOrderxx()
    {
        //$this->psgeMeOrder();
        $data = array();
        $where['uid'] = $this->auth->id;
        // $str=$this->xredis->get('psgeMeOrderyzr'.$this->auth->id);
        // if (empty($str)) {
        $list = Db::name('biquan_dat')->order('id desc')->where($where)->select();
        //     $this->xredis->set('psgeMeOrderyzr'.$this->auth->id,json_encode($list),60);
        //  }else{
        //     $list=json_decode($str,true);
        //  }
        if ($list) {
            foreach ($list as $key => $value) {
                $user = $this->get_user($value['uid']);
                $data[$key]["_id"] = md5($value['id']);
                $data[$key]["__v"] = 0;
                $data[$key]["pay"] = $value['pay'];
                $data[$key]["buytime"] = $value['buytime'];
                $data[$key]["unionid"] = $value['unionid'];
                $data[$key]["userId"] = $value['uid'];
                $data[$key]["nickname"] = $user['nickname'];
                $data[$key]["headimgurl"] = $user['avatar'];
                $data[$key]["restmoney"] = 20;
                $data[$key]["first"] = 0;
                $data[$key]["win"] = 0;
                $data[$key]["read"] = 0;
                $data[$key]["yongMoney"] = 1;
                $data[$key]["isControl"] = 0;
                $data[$key]["createtime"] = $value['createtime'];
                $data[$key]["mode"] = $value['mode'];
                $data[$key]["now"] = $value['now'];
                $data[$key]["will"] = $value['result'];
                $data[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $data[$key]["buyDirection"] = $value['buyDirection'];
                $data[$key]["status"] = $value['status'];
                $data[$key]["state"] = 0;
                $data[$key]["isbot"] = 0;
                $data[$key]["heyueindex"] = 1;
                $data[$key]["heyue"] = "BTC";
            }
        }
        else {
            $list = array();
        }

        $map["total"] = count($list);
        $map["index"] = 1;
        $map["size"] = 20;
        $map["pageSum"] = 1;
        $map["data"] = $data;
        echo json_encode($map);
    }

    //获得订单结果
    public function getorder()
    {
        $where['orderid'] = $this->request->param('orderId');
        $where['uid'] = $this->auth->id;
        $dat = Db::name('biquan_dat')->where($where)->find();
        $user = $this->get_user($this->auth->id);
        $map["_id"] = $dat['orderid'];
        $map["__v"] = 0;
        $map["pay"] = $dat['pay'];
        $map["buytime"] = $dat['buytime'];
        $map["unionid"] = $dat['unionid'];
        $map["userId"] = $dat['uid'];
        $map["nickname"] = $user['nickname'];
        $map["headimgurl"] = $user['avatar'];
        $map["restmoney"] = 21;
        $map["first"] = 0;
        $map["win"] = $dat['peifu'] > 0 ? $dat['peifu'] : 0;
        $map["read"] = 0;
        $map["yongMoney"] = 0;
        $map["isControl"] = 0;
        $map["creattime"] = date('Y-m-dTH:i:sZ', $dat['createtime']);//"2019-03-17T07:51:17.951Z";
        $map["mode"] = $dat['mode'];
        $map["now"] = (float)$dat['now'];
        if ($dat['result'] == 0) {
            $result = $this->xredis->get('biquanyzr_time_data' . ($dat['buytime'] + 30));
        }
        else {
            $result = (float)$dat['result'];
        }
        $map["will"] = $result;
        $map["result"] = $dat['peifu'] > 0 ? 1 : 0;
        $map["buyDirection"] = $dat['buyDirection'];
        $map["state"] = $dat['peifu'] > 0 ? 1 : 0;
        $map["isbot"] = 0;
        $map["heyueindex"] = 1;
        $map["heyue"] = "BTC";
        echo json_encode($map);
    }

    public function is_weixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    public function setorder()
    {
        //以后押注数据前面要加一个数据正确性验证
        //判断是否微信
        $this->is_weixin();

        $map = $this->request->param();
        $xmap = -3;
        $update = 0;
        $uuuuid['uid'] = $this->auth->id;
        $bbbuytime = Db::name('biquan_dat')->where($uuuuid)->order('buytime desc')->value('buytime');
        if ($bbbuytime == time()) {
            return false;
            die;
        }
        $paupauauuu = Db::name('user')->where('id=' . $this->auth->id)->value('point');
        if ($paupauauuu < $map['pay']) {
            return false;
            die;
        }
        $ordercount = $this->checkdata($map);
        if ($map['pay'] < 5) {
            return false;
            die;
        }
        $raaaa = $this->xredis->get('BitcoinTop20yzr');
        $rbbbbb = json_decode($raaaa);
        $xsspeice = $rbbbbb[0]->price;
        $peocss = $xsspeice / 46400;
        $pssssnow = round($peocss, 5);
        $map['now'] = $pssssnow;

        //获取当前指数
        if ($ordercount >= $this->view->site['ordercount']) {
            return -3;
            exit;
        }
        //事务开始
        // 启动事务
        $koufei = abs(intval($map['pay']));
        $fmap['id'] = $this->auth->id;
        $fmap['point'] = array('egt', $map['pay']);
        $point = Db::name('User')->where($fmap)->value('point');
        $basedata = $this->xredis->get('basedatayzr');

        if ($map['now'] <= 5) {
            $map['now'] = $basedata + $this->addon['basedata'];
        }
        if ($point < $koufei || $map['now'] <= 0) {
            $xmap = -1;
            $resss = -1;
        }
        else {
            Db::startTrans();
            try {
                //扣掉积分
                $r = Db::name('User')->where($fmap)->setDec('point', $koufei);
                if ($r) {

                    $map['now'] = $map['now'] * 46400;
                    $map['status'] = 0;
                    $map['createtime'] = time();
                    $map['buytime'] = time();
                    $map['uid'] = $this->auth->id;
                    $map['result'] = '';
                    $map['peifu'] = 0;
                    $resss = 0;

                    $id = Db::name('biquan_dat')->insertGetid($map);

                     
                    if ($id > 0) {
                        $this->daili->dailicount($this->auth->id, $koufei * 100);
                        //把当前数据缓存到redis中
                        $map['id'] = $id;
                        $dat = $this->save_now($map);
                        $update = 1;
                        $orderid = md5($id);
                        Db::name('biquan_dat')->where('id=' . $id)->setfield('orderid', $orderid);
                        Db::name('biquan_dat')->where('id=' . $id)->setfield('ifkill', $dat['ifkill']);
                        Db::commit();
                    }
                    else {
                        Db::rollback();
                        $xmap = -3;
                        $resss = -3;
                        $update = 0;
                    }
                }
                // 提交事务
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $xmap = -3;
                $resss = -3;
                $update = 0;
            }
            if ($update) {
                $xmap = array();
                $xmap['id'] = $orderid;
                $xmap['now'] = $map['now'];
                $xmap['count'] = $ordercount;
                $this->xredis->del('psgeMeOrder' . $this->auth->id);
                //$res=$this->xredis->get('psgeMeOrder'.$this->auth->id);
                //dump($res);die;
                $this->setmyorder();

            }
        }

        $xmap['state'] = $resss;
        $xmap['createtime'] = $map['createtime'];
        echo json_encode($xmap);
    }

    public function psgeorderxx()
    {
        $str = $this->xredis->get('psgeorderyzr');
        if (empty($str)) {
            $where = 1;
            $list = Db::name('biquan_dat')->where($where)->order('id desc')->select();
            $this->xredis->set('psgeorderyzr', json_encode($list), 60);
        }
        else {
            $list = json_decode($str, true);
        }

        $map["total"] = 300;
        $map["index"] = 1;
        $map["size"] = 300;
        $map["pageSum"] = 1;
        $data = array();
        if ($list) {
            foreach ($list as $key => $value) {
                $user = $this->get_user($value['uid']);
                $data[$key]["_id"] = md5($value['id']);
                $data[$key]["__v"] = 0;
                $data[$key]["pay"] = $value['pay'];
                $data[$key]["buytime"] = $value['buytime'];
                $data[$key]["unionid"] = "";
                $data[$key]["userId"] = $value['uid'];
                $data[$key]["nickname"] = $user['nickname'];
                $data[$key]["headimgurl"] = $user['avatar'];
                $data[$key]["restmoney"] = 38.72;
                $data[$key]["first"] = 0;
                $data[$key]["win"] = 0;
                $data[$key]["read"] = 0;
                $data[$key]["yongMoney"] = 0;
                $data[$key]["isControl"] = 0;
                $data[$key]["creattime"] = "2019-03-13T14:01:39.654Z";
                $data[$key]["mode"] = $value['mode'];
                $data[$key]["now"] = $value['now'] / 46400;
                $data[$key]["will"] = $value['result'] / 46400;
                $data[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $data[$key]["buyDirection"] = $value['buyDirection'];
                $data[$key]["state"] = 0;
                $data[$key]["isbot"] = 0;
                $data[$key]["heyueindex"] = 1;
                $data[$key]["heyue"] = "BTC";
            }
        }
        $map["data"] = $data;
        echo json_encode($map);
    }

    public function psgeorder()
    {
        /*$str=$this->xredis->get('psgeorder');
    if (empty($str)) {
        $where=1;
        $list=Db::name('biquan_dat')->where($where)->order('id desc')->select();
        $this->xredis->set('psgeorder',json_encode($list),60);
    }else{
       $list=json_decode($str,true);
    }

  $map["total"]= 300;
  $map["index"]= 1;
  $map["size"]= 300;
  $map["pageSum"]= 1;
  $data=array();
  if ($list) {
    foreach ($list as $key => $value) {
      $user=$this->get_user($value['uid']);
        $data[$key]["_id"]= md5($value['id']);
        $data[$key]["__v"]= 0;
        $data[$key]["pay"]=  $value['pay'];
        $data[$key]["buytime"]= $value['buytime'];
        $data[$key]["unionid"]= "";
        $data[$key]["userId"]=  $value['uid'];
        $data[$key]["nickname"]= $user['nickname'];
        $data[$key]["headimgurl"]= $user['avatar'];
        $data[$key]["restmoney"]= 38.72;
        $data[$key]["first"]= 0;
        $data[$key]["win"]= 0;
        $data[$key]["read"]= 0;
        $data[$key]["yongMoney"]= 0;
        $data[$key]["isControl"]= 0;
        $data[$key]["creattime"]= "2019-03-13T14:01:39.654Z";
        $data[$key]["mode"]= $value['mode'];
        $data[$key]["now"]= $value['now'];
        $data[$key]["will"]= $value['result'];
        $data[$key]["result"]= $value['peifu']>0?1:0;
        $data[$key]["buyDirection"]= $value['buyDirection'];
        $data[$key]["state"]= 0;
        $data[$key]["isbot"]= 0;
        $data[$key]["heyueindex"]= 1;
        $data[$key]["heyue"]= "BTC";
    }
  }
  $map["data"]=$data;
  echo json_encode($map);*/
        echo $this->xredis->get('str_psgeorderyzr');
    }

    public function topOrderxx()
    {
        $str = $this->xredis->get('topOrder10yzr');
        if (empty($str)) {
            $where['status'] = 1;
            $list = Db::name('biquan_dat')->where($where)->order('id desc')->select();
            $this->xredis->set('topOrder10yzr', json_encode($list), 60);
        }
        else {
            $list = json_decode($str, true);
        }
        $map = array();
        if ($list) {
            foreach ($list as $key => $value) {
                $user = $this->get_user($value['uid']);
                $map[$key]["_id"] = md5($value['id']);
                $map[$key]["__v"] = 0;
                $map[$key]["pay"] = $value['pay'];
                $map[$key]["buytime"] = $value['buytime'];
                $map[$key]["unionid"] = "";
                $map[$key]["userId"] = $value['uid'];
                $map[$key]["nickname"] = $user['nickname'];
                $map[$key]["headimgurl"] = $user['avatar'];
                $map[$key]["restmoney"] = 20;
                $map[$key]["first"] = 0;
                $map[$key]["win"] = 0;
                $map[$key]["read"] = 0;
                $map[$key]["yongMoney"] = 0;
                $map[$key]["isControl"] = 0;
                $map[$key]["creattime"] = "2019-03-13T14:04:05.696Z";
                $map[$key]["mode"] = $value['mode'];
                $map[$key]["now"] = $value['now'] / 46400;
                $map[$key]["will"] = $value['result'] / 46400;
                $map[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $map[$key]["buyDirection"] = 1;
                $map[$key]["state"] = 0;
                $map[$key]["isbot"] = 0;
                $map[$key]["heyueindex"] = 1;
                $map[$key]["heyue"] = "BTC";
            }

        }

        echo json_encode($map);
    }

    public function topOrder10()
    {
        echo $this->xredis->get('str_topOrderyzr');
    }

    public function BitcoinTop20()
    {

        echo $this->xredis->get('BitcoinTop20yzr');
    }

    public function psgeMeOrder()
    {
        $str = $this->xredis->get('str_psgeMeOrderyzr' . $this->auth->id);
        // if (!$str) {
        //   $$str=$this->setmyorder();
        //  }
        echo $str;
    }

    public function getOther()
    {
        $name = $this->request->param('name');
        if ($name == "huilv") {
            echo '{"_id":"5c8ca27150aa092c4e6f520c","name":"huilv","content":"汇率","cid":{"low":"6.50121","heigh":"6.85011","yestoday":"6.52400","today":"6.52300","updowns":"-0.1500","updown":"-0.0100"},"createtime":"2019-03-17T01:24:49.008Z","types":1,"state":1}';
        }
        else {
            $map["content"] = str_replace('http://', '', $_SERVER['HTTP_HOST']);
            $map["types"] = 1;
            $map["state"] = 1;
            $cid["outurl"] = str_replace('http://', '', $_SERVER['HTTP_HOST']) . ',' . str_replace('http://', '', $this->view->site['gotosite']);
            $cid["payurl"] = 'http://' . $_SERVER['HTTP_HOST'];
            $cid["downurl"] = 'http://' . $_SERVER['HTTP_HOST'];
            $map["cid"] = $cid;
            echo json_encode($map);
        }

    }

    public function getOthers()
    {
        echo '[{"_id":"5a4ae89a6024c506f7701176","name":"guestimg","content":"' . $this->view->site['site_kefu'] . '","createtime":"2019-03-13T14:04:34.181Z","types":1,"state":1}]';
    }

    public function yonglist()
    {
        echo "";
    }

    public function getkline()
    {
        $size = $this->request->param('size');
        if ($size == 39) {
            echo '[{"time":"19:41","data":["19:41",303033.52,303093.69,303013.01,303093.69]},{"_id":"5c8a3dfabe44393270a4ee6b","__v":0,"time":"19:40","creattime":"2019-03-14T11:41:46.787Z","data":["19:40",302989.41,303035.64,302989.41,303074.84]},{"_id":"5c8a3dbef4f2f33291c0c30b","__v":0,"time":"19:39","creattime":"2019-03-14T11:40:46.787Z","data":["19:39",303028.51,302989.41,302976.45,303036.63]},{"_id":"5c8a3d82afb3b332990a6e60","__v":0,"time":"19:38","creattime":"2019-03-14T11:39:46.786Z","data":["19:38",303013.6,303028.51,302954.93,303034.86]},{"_id":"5c8a3d46f4f2f33291c0c2d2","__v":0,"time":"19:37","creattime":"2019-03-14T11:38:46.785Z","data":["19:37",303093.83,303013.6,302979,303105.05]},{"_id":"5c8a3d0ac33d59327c1e5951","__v":0,"time":"19:36","creattime":"2019-03-14T11:37:46.791Z","data":["19:36",303074.9,303093.83,303060.36,303139.85]},{"_id":"5c8a3ccef4f2f33291c0c29d","__v":0,"time":"19:35","creattime":"2019-03-14T11:36:46.784Z","data":["19:35",303010.89,303074.9,303010.89,303078.6]},{"_id":"5c8a3c92afb3b332990a6ddc","__v":0,"time":"19:34","creattime":"2019-03-14T11:35:46.782Z","data":["19:34",303052.67,303010.89,302973.45,303082.63]},{"_id":"5c8a3c56c33d59327c1e5784","__v":0,"time":"19:33","creattime":"2019-03-14T11:34:46.781Z","data":["19:33",303051.07,303052.67,303047.58,303103.85]},{"_id":"5c8a3c1a2739ad32768aa106","__v":0,"time":"19:32","creattime":"2019-03-14T11:33:46.780Z","data":["19:32",303013.84,303051.07,302987.83,303056.42]},{"_id":"5c8a3bdebe44393270a4ebf6","__v":0,"time":"19:31","creattime":"2019-03-14T11:32:46.779Z","data":["19:31",302985.02,303013.84,302915.64,303013.84]},{"_id":"5c8a3ba22739ad32768a9f42","__v":0,"time":"19:30","creattime":"2019-03-14T11:31:46.784Z","data":["19:30",302979.12,302985.02,302959.23,303051.14]},{"_id":"5c8a3b66f4f2f33291c0c082","__v":0,"time":"19:29","creattime":"2019-03-14T11:30:46.779Z","data":["19:29",303015.62,302979.12,302958.43,303044.77]},{"_id":"5c8a3b2a4b40033289368ffe","__v":0,"time":"19:28","creattime":"2019-03-14T11:29:46.789Z","data":["19:28",302996.3,303015.62,302946.45,303015.74]},{"_id":"5c8a3aeed4e992326f5d150e","__v":0,"time":"19:27","creattime":"2019-03-14T11:28:46.780Z","data":["19:27",302980.52,302996.3,302957.47,303013.02]},{"_id":"5c8a3ab22739ad32768a9bf7","__v":0,"time":"19:26","creattime":"2019-03-14T11:27:46.778Z","data":["19:26",303202.23,302980.52,302980.52,303209.62]},{"_id":"5c8a3a762ce43a3283d1735a","__v":0,"time":"19:25","creattime":"2019-03-14T11:26:46.777Z","data":["19:25",303176.13,303202.23,303150.96,303213.42]},{"_id":"5c8a3a3a4b40033289368dec","__v":0,"time":"19:24","creattime":"2019-03-14T11:25:46.777Z","data":["19:24",303184.26,303176.13,303130.31,303197.31]},{"_id":"5c8a39fe4b40033289368db8","__v":0,"time":"19:23","creattime":"2019-03-14T11:24:46.777Z","data":["19:23",303295.21,303184.26,303170.7,303306.5]},{"_id":"5c8a39c2f4f2f33291c0bfbd","__v":0,"time":"19:22","creattime":"2019-03-14T11:23:46.777Z","data":["19:22",303355.01,303295.21,303292.78,303355.01]}]';
        }
        elseif ($size == 79) {
            echo '[{"time":"19:42","data":["19:42",303034.31,303107.45,303013.01,303107.45]},{"_id":"5c8a3dfabe44393270a4ee6b","__v":0,"time":"19:40","creattime":"2019-03-14T11:41:46.787Z","data":["19:40",302989.41,303035.64,302989.41,303074.84]},{"_id":"5c8a3dbef4f2f33291c0c30b","__v":0,"time":"19:39","creattime":"2019-03-14T11:40:46.787Z","data":["19:39",303028.51,302989.41,302976.45,303036.63]},{"_id":"5c8a3d82afb3b332990a6e60","__v":0,"time":"19:38","creattime":"2019-03-14T11:39:46.786Z","data":["19:38",303013.6,303028.51,302954.93,303034.86]},{"_id":"5c8a3d46f4f2f33291c0c2d2","__v":0,"time":"19:37","creattime":"2019-03-14T11:38:46.785Z","data":["19:37",303093.83,303013.6,302979,303105.05]},{"_id":"5c8a3d0ac33d59327c1e5951","__v":0,"time":"19:36","creattime":"2019-03-14T11:37:46.791Z","data":["19:36",303074.9,303093.83,303060.36,303139.85]},{"_id":"5c8a3ccef4f2f33291c0c29d","__v":0,"time":"19:35","creattime":"2019-03-14T11:36:46.784Z","data":["19:35",303010.89,303074.9,303010.89,303078.6]},{"_id":"5c8a3c92afb3b332990a6ddc","__v":0,"time":"19:34","creattime":"2019-03-14T11:35:46.782Z","data":["19:34",303052.67,303010.89,302973.45,303082.63]},{"_id":"5c8a3c56c33d59327c1e5784","__v":0,"time":"19:33","creattime":"2019-03-14T11:34:46.781Z","data":["19:33",303051.07,303052.67,303047.58,303103.85]},{"_id":"5c8a3c1a2739ad32768aa106","__v":0,"time":"19:32","creattime":"2019-03-14T11:33:46.780Z","data":["19:32",303013.84,303051.07,302987.83,303056.42]},{"_id":"5c8a3bdebe44393270a4ebf6","__v":0,"time":"19:31","creattime":"2019-03-14T11:32:46.779Z","data":["19:31",302985.02,303013.84,302915.64,303013.84]},{"_id":"5c8a3ba22739ad32768a9f42","__v":0,"time":"19:30","creattime":"2019-03-14T11:31:46.784Z","data":["19:30",302979.12,302985.02,302959.23,303051.14]},{"_id":"5c8a3b66f4f2f33291c0c082","__v":0,"time":"19:29","creattime":"2019-03-14T11:30:46.779Z","data":["19:29",303015.62,302979.12,302958.43,303044.77]},{"_id":"5c8a3b2a4b40033289368ffe","__v":0,"time":"19:28","creattime":"2019-03-14T11:29:46.789Z","data":["19:28",302996.3,303015.62,302946.45,303015.74]},{"_id":"5c8a3aeed4e992326f5d150e","__v":0,"time":"19:27","creattime":"2019-03-14T11:28:46.780Z","data":["19:27",302980.52,302996.3,302957.47,303013.02]},{"_id":"5c8a3ab22739ad32768a9bf7","__v":0,"time":"19:26","creattime":"2019-03-14T11:27:46.778Z","data":["19:26",303202.23,302980.52,302980.52,303209.62]},{"_id":"5c8a3a762ce43a3283d1735a","__v":0,"time":"19:25","creattime":"2019-03-14T11:26:46.777Z","data":["19:25",303176.13,303202.23,303150.96,303213.42]},{"_id":"5c8a3a3a4b40033289368dec","__v":0,"time":"19:24","creattime":"2019-03-14T11:25:46.777Z","data":["19:24",303184.26,303176.13,303130.31,303197.31]},{"_id":"5c8a39fe4b40033289368db8","__v":0,"time":"19:23","creattime":"2019-03-14T11:24:46.777Z","data":["19:23",303295.21,303184.26,303170.7,303306.5]},{"_id":"5c8a39c2f4f2f33291c0bfbd","__v":0,"time":"19:22","creattime":"2019-03-14T11:23:46.777Z","data":["19:22",303355.01,303295.21,303292.78,303355.01]}]';
        }
        else {
            for ($i = 0; $i < 20; $i++) {
                if ($i > 0) {
                    $dat["_id"] = "5c89bc5ef4f2f33291c08467";
                    $dat["__v"] = 0;
                    $dat["creattime"] = "2019-03-14T02:28:46.520Z";
                }
                $dat["time"] = "10:" . (27 - $i);
                $dat["data"] = array("10:27", 301570.48, 301604.04, 301563.99, 301626.12);
                $map[$i] = $dat;
            }
            echo json_encode($map);
        }

    }

    public function rechargeAll()
    {
        $data = array();
        $user = array();

        $list = db::name('history')->where('uid=' . $this->auth->id . ' and status=1')->order('id desc')->select();
        foreach ($list as $key => $aa) {
            $user[$key]['_id'] = $aa['uid'];
            $user[$key]['__v'] = 0;
            $user[$key]['money'] = $aa['cash_fee'];
            $user[$key]['unionid'] = "xx";
            $user[$key]['rechangopenid'] = "xx";
            $user[$key]['nickname'] = "";
            $user[$key]['headimgurl'] = "";
            $user[$key]['orderid'] = $aa['out_trade_no'];
            $user[$key]['token'] = "xx";
            $user[$key]['creattime'] = date('Y-m-d H:i:s', $aa['createtime']);
            $user[$key]['state'] = 1;
            $user[$key]['restmoney'] = $aa['cash_fee'];
        }
        $data['total'] = 1;
        $data['page'] = 1;
        $data['size'] = 15;
        $data['pageSum'] = 1;
        $data['data'] = $user;

        echo json_encode($data);
        exit;

    }

    public function gethomeimg()
    {
        echo '[{"_id":"5a4ae86b6024c506f7701174","name":"homeimg","content":"' . $this->view->site['site_kefu'] . '","createtime":"2019-03-13T14:04:38.701Z","types":1,"state":1},{"_id":"5a4ae8aa6024c506f7701177","name":"homeimg","content":"' . $this->view->site['site_kefu'] . '","createtime":"2019-03-13T14:04:38.701Z","types":1,"state":1},{"_id":"5a4e4b75e147f74bfc2bcb04","name":"homeimg","content":"' . $this->view->site['site_kefu'] . '","createtime":"2019-03-13T14:04:38.701Z","types":1,"state":1}]';
    }

    public function lognlog()
    {
        echo '1';
    }

    public function thrmm123Num()
    {
        $data = array();
        $datas = array();
        $mydaili = $this->daili->mydaili($this->auth->id);

        $ids = '';
        $types = $this->request->param('types');
        switch ($types) {
            case 1:
                $ids = $mydaili['onefatherids'];
                break;
            case 2:
                $ids = $mydaili['twofatherids'];
                break;
            case 3:
                $ids = $mydaili['thrfatherids'];
                break;
            case 4:
                $ids = $mydaili['forfatherids'];
                break;
            case 5:
                $ids = $mydaili['fivfatherids'];
                break;
            case 6:
                $ids = $mydaili['sixfatherids'];
            case 7:
                $ids = $mydaili['sevfatherids'];
                break;
            default:
                # code...
                break;
        }
        $datas = $this->getmyteamlist('fatherid', $this->auth->id, 1, $types);

        $data['total'] = 1;
        $data['index'] = '';
        $data['size'] = 500;
        $data['page'] = 1;
        $data['data'] = $datas;

        echo json_encode($data);
        exit;
    }

    public function getmyteamlist($feile = 'fatherid', $ids, $type = 1, $dengji = 0)
    {
        $datas = array();
        $where = array();
        $where[$feile] = array('in', $ids);
        if ($dengji > 0) {
            $where['dengji'] = $dengji;
        }

        if ($type == 2) {
            $where['createtime'] = array('gt', $this->todaystr);
        }

        $list = db::name('yonjin_jl')->where($where)->order('id desc')->select();

        foreach ($list as $key => $aa) {
            $user = $this->get_user($aa['uid']);
            $datas[$key]['_id'] = "5c89c4a22ce43a3283d133c8";
            $datas[$key]['__v'] = 0;
            $datas[$key]['unionid'] = "oxl9I0l45e3veuDKUiRcinTZckS0";
            $datas[$key]['nickname'] = $user['nickname'];
            $datas[$key]['headimgurl'] = $user['avatar'];
            $datas[$key]['pay'] = $aa['money'] / 100;
            $datas[$key]['rechargetotal'] = $aa['money'] / 100;
            $datas[$key]['grade'] = $aa['dengji'];
            $datas[$key]['addmoney'] = $aa['yonjin'] / 100;
            $datas[$key]['masterunionid'] = "oxl9I0vfNuxP7nMsO5lHizyml4Gs";
            $datas[$key]['creattime'] = date('Y-m-d H:i:s', $aa['createtime']);
        }

        return $datas;

    }

    public function myteamorder()
    {

        $data = array();
        $datas = array();

        $type = $this->request->param('type');
        $datas = $this->getmyteamlist('fatherid', $this->auth->id, $type);

        $data['total'] = 1;
        $data['index'] = '';
        $data['size'] = 30;
        $data['pageSum'] = 1;
        $data['data'] = $datas;

        echo json_encode($data);
        exit;
    }

    public function getallm($ids)
    {
        $datas = array();
        $where = array();
        $wheres = array();
        $where['uid'] = array('in', $ids);
        $where['fatherid'] = $this->auth->id;
        $allget = db::name('yonjin_jl')->where($where)->sum('yonjin');
        $where['createtime'] = array('gt', $this->todaystr);
        $todayget = db::name('yonjin_jl')->where($where)->sum('yonjin');

        $wheres['uid'] = array('in', $ids);
        $all = db::name('biquan_dat')->where($wheres)->sum('pay');
        $wheres['createtime'] = array('gt', $this->todaystr);
        $today = db::name('biquan_dat')->where($wheres)->sum('pay');

        $datas['all'] = $all;
        $datas['today'] = $today;
        $datas['allget'] = $allget / 100;
        $datas['todayget'] = $todayget / 100;

        return $datas;
    }

    public function allgetmoney()
    {
        $data = array();
        $datas = array();
        $mydaili = $this->daili->mydaili($this->auth->id);

        $one = $this->getallm($mydaili['onefatherids']);
        $two = $this->getallm($mydaili['twofatherids']);
        $three = $this->getallm($mydaili['thrfatherids']);
        $four = $this->getallm($mydaili['forfatherids']);
        $five = $this->getallm($mydaili['fivfatherids']);
        $six = $this->getallm($mydaili['sixfatherids']);
        $seven = $this->getallm($mydaili['sevfatherids']);

        $data['one'] = $one;
        $data['two'] = $two;
        $data['three'] = $three;
        $data['four'] = $four;
        $data['five'] = $five;
        $data['six'] = $six;
        $data['seven'] = $seven;

        echo json_encode($data);
        exit;
    }

    public function getmcount()
    {
        $mydaili = $this->daili->mydaili($this->auth->id);
        $todayall = $mydaili['onefather'] + $mydaili['twofather'] + $mydaili['thrfather'] + $mydaili['forfather'] + $mydaili['fivfather'] + $mydaili['sixfather'] + $mydaili['sevfather'];
        echo '{"onenum":' . $mydaili['onefather'] . ',"twonum":' . $mydaili['twofather'] . ',"threenum":' . $mydaili['thrfather'] . ',"fournum":' . $mydaili['forfather'] . ',"fivenum":' . $mydaili['fivfather'] . ',"sixnum":' . $mydaili['sixfather'] . ',"sevennum":' . $mydaili['sevfather'] . ',"todayall":' . $todayall . '}';
    }

    public function getrank()
    {
        echo '[]';
    }

    public function myinfo()
    {
        $name = $this->user['nickname'];
        $allyongjin = db::name('yonjin_jl')->where('fatherid=' . $this->auth->id)->sum('yonjin');
        //首页客服
        $qrcode = db::name('attachment')->where('id=12')->value('url');
        //个人中心客服
        $qrcode1 = db::name('attachment')->where('id=13')->value('url');
        $qrcode1 = $qrcode1 . '?time=' . time();
        $qrcode = $qrcode . '?time=' . time();
        $point = db::name('user_tixian')->where('uid=' . $this->auth->id)->sum('point');
        //查询是否绑定手机号
        $appmobile = db::name('user')->where('id=' . $this->auth->id)->value('appmobile');
        if (!empty($appmobile)) {
            $map["appmobile"] = 1;
        }
        else {
            $map["appmobile"] = 0;
        }
        $map["point"] = sprintf("%.2f", $point);
        $map["yongMoney"] = $allyongjin / 100;
        $map["cashtotal"] = 0;
        $map["money"] = $this->view->user['point'];
        $map['kefuererer'] = $qrcode1;
        $map["state"] = 1;
        $map["unionid"] = $this->auth->id;
        $map["phone"] = "";
        $map["headimgurl"] = $this->user['avatar'];
        $map["rechargetotal"] = 0;
        $map["winlose"] = 0;
        $map["nickname"] = $this->view->user['nickname'];//mb_substr($this->view->user['nickname'],0,4)."：".$this->user['id'];;
        $map["rank"] = 10;
        $map["lv"] = 1;
        $map["creattime"] = "2019-03-09T05:30:51.383Z";
        $map["role"] = "person";
        $map["cashopenid"] = "2";
        $map["qrcode"] = $qrcode;
        //APP下载地址
        $map["xiazaiurl"] = 'http://t.cn/AiOEi1Y3';
        //
        echo json_encode($map);
    }

    public function onlinecount()
    {
        $map['usercount'] = mt_rand(100, 500);
        $map['0'] = 0;
        $map['down'] = 5;
        echo json_encode($map);
    }

    public function urlmake()
    {
        $gotourl = $this->view->site['site_enter'] . "/jxtq.php/Index/User/wxlog/fid/" . $this->auth->id . "/type/1/tid/" . $this->view->site['ewmcount'] . ".html";
        //echo $gotourl;die;
        $url = $gotourl;//'http://meituan.pqmeqs84854.cn/dwz.php?longurl=' . urlencode($gotourl);
        //设置附加HTTP头
        $addHead = array(
            "Content-type: application/json"
        );
        //初始化curl，当然，你也可以用fsockopen代替
        $curl_obj = curl_init();
        //设置网址
        curl_setopt($curl_obj, CURLOPT_URL, $url);
        //附加Head内容
        curl_setopt($curl_obj, CURLOPT_HTTPHEADER, $addHead);
        //是否输出返回头信息
        curl_setopt($curl_obj, CURLOPT_HEADER, 0);
        //将curl_exec的结果返回
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, 1);
        //设置超时时间
        curl_setopt($curl_obj, CURLOPT_TIMEOUT, 15);
        //执行
        $result = curl_exec($curl_obj);
        //关闭curl回话
        curl_close($curl_obj);
        $result = json_decode($result, true);
        //  file_put_contents('./qqq.log',json_encode($result)."\r\n",FILE_APPEND);
        // if($result['code'] ==1){
        // 	$gotourl = $result['ae_url'];
        //  }
        echo '{"data":1,"url":"' . $gotourl . '"}';
    }
    //private function xxxxxxxxxxxxx(){}
    //public function test(){
    //  echo $fatherid=Cache::get('myfather'.$this->auth->id);;
    //if ($fatherid=='') {
    // echo "xx";
    //}
    //}
    //public function clearn(){
    //   Db::query('TRUNCATE TABLE `qz_biquan_dat`');
    //}
    //把某一个时间点的上升下降数据缓存起来，用户ganrao程序
    private function save_now($map = '')
    {
        $nowdat = $this->xredis->get('setorderyzr' . $map['buytime']);
        if ($nowdat) {
            $dat = json_decode($nowdat, true);
            if ($map['buyDirection'] == 1) {
                $dat['up_val'] += $map['pay'];
            }
            else {
                $dat['down_val'] += $map['pay'];
            }
        }
        else {
            $dat['buytime'] = $map['buytime'];
            $dat['now'] = $map['now'];
            //把有押注的时间点推入订单线。
            $this->xredis->lpush('biquanyzr_order_line', json_encode($dat));
            if ($map['buyDirection'] == 1) {
                //涨
                $dat['up_val'] = $map['pay'];
                $dat['down_val'] = 0;
            }
            else {
                //跌
                $dat['up_val'] = 0;
                $dat['down_val'] = $map['pay'];
            }
        }
        $dat['ifkill'] = $this->get_kill($dat);
        $this->xredis->set('setorderyzr' . $map['buytime'], json_encode($dat));
        return $dat;
    }
    //计算本局是否控制
    //0。公平，1.必杀 2，必赢
    private function get_kill($dat = '')
    {
        //是否杀的逻辑算法--begin
        $kill = 0;
        //涨大于跌
        if ($dat['up_val'] > $dat['down_val']) {
            $cha = $dat['up_val'] - $dat['down_val'];
        }
        else {
            //跌大于涨   //计算差额
            $cha = $dat['down_val'] - $dat['up_val'];
        }
        $cha = $cha * 1.9;//输赢大小
        //如果风控值小于等于 当前压住金额  进入风控
        if ($this->addon['waterlever'] <= $cha) {
            $kill = 1;
        }
        else {
            //落入几率
            $x = mt_rand(1, 100);
            //echo $x.'-------';
            //var_dump($this->addon['ifkeep']);die;
            //配置几率 大于等于 随机数  并且  当前  是开启的 进入风控
            if ($this->addon['percent'] >= $x && $this->addon['ifkeep'] == 1) {
                $kill = 1;
            }
        }
        return $kill;
    }

    private static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    public function xredis($select = 0)
    {
        $redisObj = new \Redis();
        $redisConfig = config('cache');
        $redisObj->connect($redisConfig['host'], $redisConfig['port']);
        $redisObj->auth($redisConfig['password']);
        $auth = $redisObj->select($select); //设置密码
        return $redisObj;
    }

    private function countdata($data = '')
    {
        $where['uid'] = $this->auth->id;
        $count = Db::name('biquan_dat')->where($where)->count();
        if ($count) {
            return $count;
        }
        else {
            return 0;
        }

    }

    //对数据安全进行认证
    private function checkdata($data = '')
    {
        $where['uid'] = $this->auth->id;
        $where['status'] = 0;
        $count = Db::name('biquan_dat')->where($where)->count();
        if ($count) {
            return $count;
        }
        else {
            return 0;
        }

    }

    private function get_user($uid = 0, $force = 0)
    {
        if ($uid > 0) {
            $user = json_decode($this->xredis->get('useryzr' . $uid), true);
            if (!$user || $force) {
                $user = Db::name('user')->field('nickname,avatar')->where('id=' . $uid)->find();
                if (!$user) {
                    $user['nickname'] = '游客';
                    $user['avatar'] = '#';
                }
                $this->xredis->set('useryzr' . $uid, json_encode($user));
            }
        }
        return $user;
    }

    /**
     * }
     * }
     * 初始化游戏
     * @param string $name
     * @return array
     */
    private function init_game()
    {
        $run_count = $this->game->cache_get('run_count' . $this->todaystr);

        if (!$run_count) {

            $this->game->cache_set('roomid', 1);
            //$data 当前开奖序列
            $tomap['createtime'] = $this->todaystr;
            $todatay = Db::name('run_count')->where($tomap)->count();
            if (!$todatay) {
                $map['uid'] = 0;
                $map['allin'] = 0;
                $map['allout'] = 0;
                $map['result'] = 0;
                $map['note'] = date('Y/m/d') . "记录！";
                $map['createtime'] = $this->todaystr;;

                Db::name('run_count')->insert($map);

            }

            $this->game->cache_set('shareconfig', $this->view->site);
            $this->game->cache_set('run_count' . $this->todaystr, $this->todaystr);
        }
        $cmap['uid'] = $this->auth->id;
        $cmap['createtime'] = $this->todaystr;

        $user_count = cache::get('user_count' . $this->todaystr . $this->auth->id);
        if (!$user_count) {

            $this->daili->relation($this->auth->id);

            $user_count = Db::name('user_count')->where($cmap)->count();
            if (!$user_count) {

                Db::name('user_count')->insert($cmap);
            }
            $this->game->cache_set('user_count' . $this->todaystr . $this->auth->id, $this->auth->id);
        }

        $this->fangfeng();
        return true;
    }

    private function fangfeng()
    {
        if (!is_file(RUNTIME_PATH . 'enter.php')) {
            $str = '<?php return array(\'site_enter\'=>\'' . $this->view->site['site_enter'] . '\',\'gotosite\'=>\'' . $this->view->site['gotosite'] . '\');';
            $fp = fopen(RUNTIME_PATH . 'enter.php', "w");//写文件输出用于检测先删掉4.txt
            fwrite($fp, $str);
            fclose($fp);
        }
        return true;
    }

    private function is_json($data = '', $assoc = false)
    {
        $data = json_decode($data, $assoc);
        if (($data && (is_object($data))) || (is_array($data) && !empty($data))) {
            return true;
        }
        return false;
    }

    //提现wxcashs
    public function wxcashs()
    {
    	
        $fee = abs($this->request->param('money'));
        if (!is_int($fee)) {
            return false;
        }
        $biquan_dat_c = Db::name('biquan_dat')->where('uid=' . $this->auth->id)->count();
        $yyyy['uid'] = $this->auth->id;
        $yyyy['createtime'] = $this->todaystr;
        $yongjin = Db::name('user_count')->where($yyyy)->value('awardok');
        if ($biquan_dat_c < 2 && $yongjin < 0) {
            $data['data'] = -1;
            $data['msg'] = '请勿刷接口!';
            echo json_encode($data);
            exit;
        }
		
        $createtime = Db::name('user_tixian')->where('uid=' . $this->auth->id)->order('createtime desc')
                        ->value('createtime');
        $res = time() - $createtime;
        if ($res < 30) {
            $data['data'] = -1;
            $data['msg'] = '请勿频繁操作!';
            echo json_encode($data);
            exit;
        }
        
        $data = array();
        $datas = array();
        $umap['uid'] = $this->auth->id;
        $umap['createtime'] = $this->todaystr;
        $this->onlinetixiantime = Db::name('user_count')->where($umap)->value('onlinetixiantime');

        $fee = abs($this->request->param('money'));
        $point = Db::name('user')->where("id", $this->auth->id)->value('point');
        if ($point < $fee) {
            $data['data'] = -1;
            $data['msg'] = "余额不足1";
            echo json_encode($data);
            exit;
        }
         
        if ($point < 0) {
            $data['data'] = -1;
            $data['msg'] = "余额不足2";
            echo json_encode($data);
            exit;
        }
        $jinbi = Db::name('user')->where("id", $this->auth->id)->value('point');
        $onlinetixiantime = $this->onlinetixiantime;
		
        if ($fee < $this->view->site['price']) {
            $data['data'] = -1;
            $data['msg'] = "满" . $this->view->site['price'] . "元，才可申请提现！";
            echo json_encode($data);
            exit;
        }
        if ($this->view->site['txlimit'] <= $onlinetixiantime && $this->view->site['txlimit'] != 0) {
            $data['msg'] = "今天取款次数:" . $onlinetixiantime . "次,请明天再来！";
            $data['data']= -1;
            echo json_encode($data);
            exit;
        }
        // 系统进入维护状态
        if ($this->view->site['txlimit'] <= 0) {
            $data['msg'] = "你以取款" . $onlinetixiantime . "次！";
            $data['data']= -1;
            echo json_encode($data);
            exit;
        }
        //$openid = Db::name('user')->where('id', $this->auth->id)->value('wx');//掌上钱包
        /*$openid = Db::name('user')->where('id', $this->auth->id)->value('fopenid'); //fastpay
        if (!$openid) {

            //header('location: '.$data['url']);
            $data = -1;
            echo json_encode($data);
            exit;
        }*/
        $ydf= Db::name('user')->where('id', $this->auth->id)->value('ydf'); //fastpay
        if (!$ydf) {

            $data['msg'] = "通道错误";
            $data = -1;
            echo json_encode($data);
            exit;
        }
        
        if ($fee <= 0) {
            $data['msg'] = "可兑换金币为0";
            $data['data'] = -1;
            echo json_encode($data);
            exit;
        }
        else {
           
            $paydata = $this->ydf_tixian($ydf, $fee);
				// $paydata =array();
  // $paydata['orderid']='';
  // $paydata['amount']=$fee;
  // $paydata['desc']='提现测试';
  
			// $paydata = $this->ydf_wx_pay($paydata, $ydf);
            return $paydata;

        }
		 $data['data'] = 3;
	    $data['msg'] = "通道错误!";
	    echo json_encode($data);
	    exit;
    }

  
		// function ydf_wx_pay($paydata,$openid){
  // $params =array();
  // $params['appid']="8735ba29-fa1b-42c2-8ab3-534b95b216e9";
  // $params['channel']='wx';
  // $params['order_no']=$paydata['orderid'];
  // $params['amount']=$paydata['amount'];
  // $params['recipient_openid']=$openid;
  // $params['description']=$paydata['desc'];
  // $params['sign']=sign($params,'');
  // $res =get_cur('http://api.0949.xyz/api/api/withdraw',$params,'POST');
  // return $res;
// }

	// function get_cur($url, $data="", $type="GET", $header="")
// {
    // $HTTP_REFERER='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    // curl_setopt($ch, CURLOPT_REFERER, $HTTP_REFERER);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    // curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    // if (!empty($data)) {
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // }

    // if (!empty($header)) {
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    // }

    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $temp = curl_exec($ch);
    // curl_close($ch);
    // return $temp;
// }


// function sign($data,$key){

  // $data = argSort($data);
  // $data = createLinkstring($data);
  // $sign = strtoupper(md5($data.'&key='.$key));

  // return $sign;
// }
// function argSort($para) {

  // ksort($para);
  // reset($para);
  // return $para ;
// }
// function createLinkstring($para) {

  // $arg  = "";

  // foreach ($para as $key=>$val) {
	// $arg.=$key."=".$val."&";
  // }

  // $arg = substr($arg,0,strlen($arg)-1);

  // if( get_magic_quotes_gpc()){ $arg = stripslashes( $arg);}

  // return $arg;
// }

    //获取汇率 接口
    public function huoquhuilvxxxxxx()
    {
        $raaaa = $this->xredis->get('BitcoinTop20yzr');
        $rbbbbb = json_decode($raaaa);
        $xsspeice = $rbbbbb[0]->price;
        $peocss = $xsspeice / 46400;
        $pssssnow = round($peocss, 5);
        return $pssssnow;

    }

    //1.1接收赔付
    private function paytouser($fee, $openid = '')
    {
        // echo 111;die;
        $fee = abs($fee);
        $successpay = 0;
        $back['msg'] = '';
        //费用和用户不可为０
        $point = Db::name('user')->where("id", $this->auth->id)->value('point');
        if ($point < $fee) {
            $data['data'] = -1;
            $data['msg'] = "余额不足3";
            echo json_encode($data);
            exit;
        }
        if ($fee <= 0 || empty($openid)) {
            $back['msg'] = "op:" . $openid . " fee:" . intval($fee);
            $back['status'] = 0;
        }
        else {
            //在线自动赔付 超额记录
            if ($fee >= $this->view->site['autolimit']) {
                $data = -1;
                $where['id'] = $this->auth->id;
                $where['point'] = array('egt', $fee);
                $rr = Db::name('user')->where($where)->setDec('point', abs($fee));
                if ($rr) {
                    $datatixian = array();
                    $datatixian['ttype'] = 'api';
                    $datatixian['point'] = $fee;
                    $datatixian['status'] = 0;
                    $datatixian['name'] = $this->user['username'];
                    $datatixian['uid'] = $this->auth->id;
                    $datatixian['payurl'] = '';
                    $datatixian['note'] = '超额审核提现' . $fee;
                    $datatixian['createtime'] = time();
                    $datatixian['paymentno'] = '';
                    $txid = Db::name('user_tixian')->insert($datatixian);
                    $data = 1;
                }
                $data['msg'] = "请勿非法操作!";
                echo json_encode($data);
                exit;
            }
            //插入提现数据
            $where['id'] = $this->auth->id;
            $where['point'] = array('egt', $fee);
            $rr = Db::name('user')->where($where)->setDec('point', abs($fee));
            if (!$rr) {
                $data['msg'] = "请勿非法操作!";
                return false;
                echo json_encode($data);
                exit;
            }
            //正常赔付
            $huilvhuilv = 6.8;
            //体现记录
            $datatixian = array();
            $datatixian['ttype'] = 'api';
            $datatixian['point'] = $fee;
            $datatixian['status'] = 1;
            $datatixian['name'] = $this->user['username'];
            $datatixian['uid'] = $this->auth->id;
            $datatixian['upoint'] = $huilvhuilv * $fee;
            $datatixian['payurl'] = '';
            $datatixian['note'] = $this->user['point'] - $fee;
            $datatixian['createtime'] = time();
            $datatixian['paymentno'] = time();
            $bpid = Db::name('user_tixian')->insertGetId($datatixian);
            //正常赔付
            $fee = $huilvhuilv * $fee;
            $fee = round($fee, 2);
            
            //$tiresult = $this->tixianzh($fee, $openid, $bpid); // 掌上提现
            
            //$tiresult = $this->tixianfast($fee, $openid, $bpid); // fastpay提现
            $tiresult = $this->ydf_tixian($openid, $fee); // fastpay提现
            return $tiresult;
            
        }
        $back['successpay'] = $successpay;
        //1005 ajax 付款通道
        return $back;
    }
    private function tixianzh($fee, $openid, $bpid) //掌上钱包提现
    {
    	$key = 'asd990421qqq';
        $post_data = array(
            'mid'      => '2016', //在掌上零钱里面获取的uid
            'jine'     => $fee, //要请求发放的金额
            'openid'   => $openid, //第二步获取的openid
            'tixianid' => 10000 + $bpid, //本地的提现id【要求唯一】字符串类型的数字，最大长度11位数,这里判断订单是否重复,不能用时间戳，最好跟本地表的id绑定,(不按照要求后果自负)
            'lailu'    => "UID:".$this->auth->id, //可选参数
        );
        $url = 'http://jfcms12.com/jieru.php';
        $mkey = md5($post_data['mid'] . $fee . $openid . $key);
        $post_data['mkey'] = $mkey;
        $post_data['lx'] = 999;//保持默认
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $outputs = json_decode($output, 1);
        
        file_put_contents('./jftx_err.log',json_encode($post_data).json_encode( $outputs)."\r\n",FILE_APPEND);

        if ($outputs['o'] == 'yes') {
            return true;
        }
        if ($outputs['o'] == 'shenhe') {
            return true;
        }
        //file_put_contents('./jftx_err.log',json_encode( $output)."\r\n",FILE_APPEND);
        return false;
    }
    
    private function ydf_tixian($openid,$fee){
    	$huilvhuilv = 6.8;
    	/*$point = Db::name('user')->where("id", $this->auth->id)->value('point');
        if ($point < $fee) {
            $data['data'] = -1;
            $data['msg'] = "余额不足";
            return json_encode($data);
        }*/
    	$ydf_id ='8735ba29-fa1b-42c2-8ab3-534b95b216e9';
    	$ydf_key ='rk47628guf07k590hme8jdgwlgblnfmk';
    	define("YDF_APPID", $ydf_id);//你的appid
		define("YDF_KEY",$ydf_key);//你的key
		require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
		$pay_data=array();
	    $pay_data['openid']=$openid; //这个是第一步获取的openid
	    $pay_data['amount']=$fee*$huilvhuilv;//价格
	    $pay_data['billno']=md5(time() . mt_rand(1,1000000));
	    $pay_data['uid']=$this->auth->id;;//汇款用户id,你网站的用户id
	    $pay_data['sh']=0;//0为不审核,1为开启审核
	    $pay_data['desc']=$this->view->site['name']."-兑换";//支付备注信息
		$res =ydf_wx_pay($pay_data,$openid);
		$res=json_decode($res,true);
		//var_dump($res);
		//die();
		 if($res['code']=="40011" || $res['code']=="40010"){
		 	 $where['point'] = array('egt', $fee);
             $rr = Db::name('user')->where($where)->setDec('point', abs($fee));
             if($rr){
             	
		        //体现记录
		        $datatixian = array();
		        $datatixian['ttype'] = '云代付';
		        $datatixian['point'] = $fee;
		        $datatixian['status'] = 1;
		        $datatixian['name'] = $this->user['username'];
		        $datatixian['uid'] = $this->auth->id;
		        $datatixian['upoint'] = $huilvhuilv * $fee;
		        $datatixian['payurl'] = '';
		        $datatixian['note'] = $this->user['point'] - $fee;
		        $datatixian['createtime'] = time();
		        $datatixian['paymentno'] = time();
		        $bpid = Db::name('user_tixian')->insertGetId($datatixian);
		        $data['data'] = 1;
                $data['msg'] = "提现成功!";
            	return json($data);
             }
            	//正常赔付
            
		 }else{
		 	$data['data'] = -1;
            $data['msg'] = "提现失败";
            return json($data);
		 }
		$data['data'] = -1;
        $data['msg'] = "提现失败";
        return json($data);
		
    }
    private function tixianfast($fee, $openid, $bpid) //fastpay提现
    {
    	if (!function_exists('pay_openid')) {
			require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
		}
		
		$paydata=array();
		$paydata['openid']=$openid;
		$paydata['amount']=$fee;
		$paydata['billno']=md5(time());
		$paydata['desc']='提现ID:'.$bpid;
		$paydata['uid']=$this->auth->id;
		$data['pay_way']='wepay';
		$paydata['sh']=0;
		$res =fast_pay($paydata);
		$res =json_decode($res,true);
		if($res['return_code']=='SUCCESS'){
			return true;
		}else{
			return $res['return_msg'];
		}
        //file_put_contents('./jftx_err.log',json_encode( $output)."\r\n",FILE_APPEND);
    }

}

?>
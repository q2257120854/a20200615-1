<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;
use think\Db;

/**
 * 会员中心
 */
class User extends Frontend

{

    protected $layout = 'default';

    protected $noNeedLogin = ['login', 'register', 'wxlog', 'jxlogin', 'wxlogin', 'wxtiao', 'loginxxx', 'looginx'];

    protected $noNeedRight = ['*'];

    public function _initialize()

    {

        parent::_initialize();

        $auth = $this->auth;

        $this->wechatObj = new \org\Wechat($this->view->site);

        //监听注册登录注销的事件

        Hook::add('user_login_successed', function ($user) use ($auth) {

            $expire = input('post.keeplogin') ? 30 * 86400 : 0;

            Cookie::set('uid', $user->id, $expire);

            Cookie::set('token', $auth->getToken(), $expire);

        });

        Hook::add('user_register_successed', function ($user) use ($auth) {

            Cookie::set('uid', $user->id);

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

    }

    //手机号登录
    public function loginxxx()
    {
        $turl = 'http://baidu.baijiahao.tke3l.cn';
        //手机号  phone  password
        if (!$_POST['phone'] || !$_POST['password']) {
            $red['status'] = 0;
            $red['msg'] = '手机号密码不能为空';
            echo json_encode($red);
            die;
        }
        $resssssss = $_POST;
        $data['appmobile'] = $resssssss['phone'];
        $auser = db::name('user')->where('appmobile=' . $data['appmobile'])->count();
        if ($auser < 1) {
            $red['status'] = 0;
            $red['msg'] = '手机号不存在';
            echo json_encode($red);
            die;
        }
        $data['apppwd'] = md5($resssssss['password']);
        //查询判断
        $isuser = db::name('user')->where($data)->find();
        if ($isuser) {
            //登录成功
            $nickname = $isuser['nickname'];
            $headimgurl = $isuser['avatar'];
            $openid = $isuser['openid'];
            $fid = $isuser['fatherid'];
            if ($this->view->site) {
                $url = $turl . '/index/' . $this->view->site['default_game'] . '/index';
                if ($this->auth->id) {
                    $red['status'] = 1;
                    $red['url'] = $url;
                    $red['msg'] = '登录成功';
                    echo json_encode($red);
                    die;
                }
                if (!empty($openid)) {
                    $account = $openid;
                    $password = 'asd123';
                    $islogin = $this->auth->login($account, $password);
                    if (!$islogin) {
                        $point = $this->view->site['sendpoint'];
                        $extends['avatar'] = $headimgurl;
                        $extends['nickname'] = $nickname;
                        $this->auth->register($account, $password, $fid, $account, $point, $extends);
                        $islogin = $this->auth->login($account, $password);
                    }
                    if ($islogin) {
                        $red['status'] = 1;
                        $red['url'] = $url;
                        $red['msg'] = '登录成功';
                        echo json_encode($red);
                        die;
                    }

                }

            }
            else {
                $red['status'] = 0;
                $red['msg'] = '系统错误';
                echo json_encode($red);
                die;
            }

        }
        else {
            $red['status'] = 0;
            $red['msg'] = '账号密码不正确';
            echo json_encode($red);
            die;

        }

    }

    /**
     * 会员中心
     */

    public function index()

    {

        $this->view->assign('title', __('User center'));

        return $this->view->fetch();

    }

    public function looginx()
    {
        $this->view->assign('title', __('Register'));
        return $this->view->fetch();
    }

    /**
     * 注册会员
     */

    public function register()

    {

        $url = $this->request->request('url');

        if ($this->auth->id)

            $this->success(__('You\'ve logged in, do not login again'), $url);

        if ($this->request->isPost()) {

            $username = $this->request->post('username');

            $password = $this->request->post('password');

            $email = $this->request->post('email');

            $mobile = $this->request->post('mobile', '');

            $captcha = $this->request->post('captcha');

            $token = $this->request->post('__token__');

            $rule = [

                'username' => 'require|length:3,30',

                'password' => 'require|length:6,30',

                'email' => 'require|email',

                'mobile' => 'regex:/^1\d{10}$/',

                'captcha' => 'require|captcha',

                '__token__' => 'token',

            ];

            $msg = [

                'username.require' => 'Username can not be empty',

                'username.length' => 'Username must be 3 to 30 characters',

                'password.require' => 'Password can not be empty',

                'password.length' => 'Password must be 6 to 30 characters',

                'captcha.require' => 'Captcha can not be empty',

                'captcha.captcha' => 'Captcha is incorrect',

                'email' => 'Email is incorrect',

                'mobile' => 'Mobile is incorrect',

            ];

            $data = [

                'username' => $username,

                'password' => $password,

                'email' => $email,

                'mobile' => $mobile,

                'captcha' => $captcha,

                '__token__' => $token,

            ];

            $validate = new Validate($rule, $msg);

            $result = $validate->check($data);

            if (!$result) {

                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);

            }

            if ($this->auth->register($username, $password, $email, $mobile)) {

                $synchtml = '';

                ////////////////同步到Ucenter////////////////

                if (defined('UC_STATUS') && UC_STATUS) {

                    $uc = new \addons\ucenter\library\client\Client();

                    $synchtml = $uc->uc_user_synregister($this->auth->id, $password);

                }

                $this->success(__('Sign up successful') . $synchtml, $url ? $url : url('user/index'));

            }
            else {

                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);

            }

        }

        //判断来源

        $referer = $this->request->server('HTTP_REFERER');

        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))

            && !preg_match("/(user\/login|user\/register)/i", $referer)) {

            $url = $referer;

        }

        $this->view->assign('url', $url);

        $this->view->assign('title', __('Register'));

        return $this->view->fetch();

    }

    /**
     * 精秀登陆
     */

    public function wxlog()

    {

        if ($this->request->param('tid') != $this->view->site['ewmcount'] && $this->request->param('fid') != 0) {//

            header("location: http://www.baidu.com");
            exit;
        }

        $appid = $this->view->site['appid'];

        if (empty($appid)) {
            echo "用户数据出错！";
        }
        else {
            $burl = $this->view->site["squrl"] . "/index.php/Index/User/wxtiao?fid=" . intval($this->request->param('fid')) . "&myid=" . intval($this->request->param('myid'));//返回链接
            // exit($burl);
            //echo $appid;exit;
            $backurl = urlencode($burl);//编码
            $scope = "snsapi_userinfo";//snsapi_base只获得openid  snsapi_userinfo 可或用户信息
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . $backurl . "&response_type=code&scope=" . $scope . "&state=" . $scope . "#wechat_redirect";//整合链接
            header('Location: ' . $url);//跳转
            exit;
        }

        exit;

    }

    //跳转site_url原生登陆 get_userinfo
    public function wxtiao()
    {
		
        $code = $this->request->request('code');
        if (empty($this->view->site['appid'])) {
            echo "商户APPID为空,请联系该商户！";
            exit;
        }
        if (empty($this->view->site['appsecret'])) {
            echo "商户APPSECRET为空,请联系该商户！";
            exit;
        }
        if (empty($code)) {
            echo "CODE返回为空";
            exit;
        }
        /////////////方式1/////////begin////////
        $res = $this->wechatObj->get_access_token($code);//获取到access_token
        //echo $res;exit;
        // $res={"access_token":"19_Gz4_n9MezxrxXiYSK8AdQbZGEM0yRrFdzg5nDBmQv-SP0KMxgdrlSF7drEdjbipLccHQElJmH1Ti-EEohwYoVA","expires_in":7200,"refresh_token":"19_XxrTzciD0qHjHoLI-tCB9bLRc078rc-hVTg_EP8w3LlrZsziIaSFrFRu2v1rR5mW5KI1VQLqzG934VviBcpebw","openid":"ohUsX5x0xqPwWGB6o44ecAEAllbI","scope":"snsapi_userinfo"}
        $wd = json_decode($res, true);
		//dump($wd);exit;
        $openid = $wd['openid'];
        $uinfo = $this->wechatObj->get_snsapi_userinfo($wd['access_token'], $wd['openid']);
        //nickname，headimgurl
        $nickname = $uinfo['nickname'];
        $headimgurl = $uinfo['headimgurl'];
        $fid = $this->request->param("fid");
        $myid = $this->request->param("myid");
		$burl = $this->view->site["site_url"] . "/index.php/Index/User/wxlogin?fid=" . $fid . "&myid=" . $myid . '&openid=' . $openid . '&nickname=' . $nickname . '&headimgurl=' . $headimgurl;
        /*$url_list = db::name('fh')->where('status=1')->select();
		dump($url_list);exit;
        if ($url_list) {
            $key = array_rand($url_list, 1);
            $burl = trim($url_list[$key]['url']) . "/index.php/Index/User/wxlogin?fid=" . $fid . "&myid=" . $myid . '&openid=' . $openid . '&nickname=' . $nickname . '&headimgurl=' . $headimgurl;
        }
        else {
            $burl = $this->view->site["site_url"] . "/index.php/Index/User/wxlogin?fid=" . $fid . "&myid=" . $myid . '&openid=' . $openid . '&nickname=' . $nickname . '&headimgurl=' . $headimgurl;
        }*/
        //exit($burl);
        //exit('ok');
        header('Location: ' . $burl);//跳转
        exit;
    }

    //原生登陆
    public function wxlogin()//微信登录//获取code-》获取access_token->获取用户资料
    {
		//die('ok');
        $nickname = $this->request->param("nickname");
        $headimgurl = $this->request->param("headimgurl");
        $openid = $this->request->param("openid");
        $fid = $this->request->param("fid");
        $myid = $this->request->param("myid");
        if ($this->view->site) {
            //echo "code:".$code."\n";
            ////////////////防止为空///////////////
            //  echo $openid;exit;
            //=========================================
            $url = '/index/' . $this->view->site['default_game'] . '/index';
            if ($this->auth->id) {
                header('location:' . $url);
                exit;
                // $this->success('登陆中..',$url);
                return;
            }
            if (!empty($openid)) {
                $account = $openid;
                $password = 'asd123';//md5($openid);
                $islogin = $this->auth->login($account, $password);
                if (!$islogin) {

                    $point = $this->view->site['sendpoint'];
                    $extends['avatar'] = $headimgurl;
                    $extends['nickname'] = $nickname;

                    $this->auth->register($account, $password, $fid, $account, $point, $extends);

                    $islogin = $this->auth->login($account, $password);
                }
                if ($islogin) {
                    //$this->site_login($this->view->site['site_url']);
                    $synchtml = '';
                    
                    header('location:' . $url);
                    
                    exit;
                    return;
                    //$this->success(__('Logged in successful') . $synchtml, $url);
                }
                else {
                    $this->error($this->auth->getError());
                }
            }
            else {
                return 'empty openid!';
            }
            //=========================================

        }
        else {
            echo "该用户未设置基本接入信息！";
            exit;
        }
    }

    /**
     * 精秀登陆返回
     */

    public function jxlogin()

    {

        $url = 'index/' . $this->view->site['default_game'] . '/index';

        if ($this->auth->id) {

            $this->success('登陆中..', $url);
            $ggs = $this->view->site['site_url'] . '/index.php/' . $url;

            header("location:" . $ggs);

        }

        if (!empty($this->request->param('oo'))) {

            $fid = $this->request->param('fid');

            $account = $this->request->param('oo');

            $password = "asd123";

            $islogin = $this->auth->login($account, $password);

            if (!$islogin) {
                //print_r($account);
                $point = $this->view->site['sendpoint'];
                $this->auth->register($account, $password, $fid, $account, $point);

                $islogin = $this->auth->login($account, $password);

            }

            if ($islogin) {

                $synchtml = '';

                header('location:' . $url);
                exit;

                // $this->success(__('Logged in successful') . $synchtml, $url);

            }
            else {

                $this->error($this->auth->getError());

            }

        }
        else {

            return 'empty openid!';

        }

    }

    /**
     * 会员登录
     */

    public function login()

    {

        $url = $this->request->request('url');

        if ($this->auth->id)

            $this->success(__('You\'ve logged in, do not login again'), $url);

        if ($this->request->isPost()) {

            $account = $this->request->post('account');

            $captcha = $this->request->post('captcha');

            $password = "asd123";//$this->request->post('password');

            $keeplogin = (int)$this->request->post('keeplogin');

            $token = $this->request->post('__token__');

            $rule = [

                'account' => 'require|length:3,50',

                'captcha' => 'require|captcha',

                'password' => 'require|length:6,30',

                '__token__' => 'token',

            ];

            $msg = [

                'account.require' => 'Account can not be empty',

                'account.length' => 'Account must be 3 to 50 characters',

                'password.require' => 'Password can not be empty',

                'password.length' => 'Password must be 6 to 30 characters',

            ];

            $data = [

                'account' => $account,

                'password' => $password,

                'captcha' => $captcha,

                '__token__' => $token,

            ];

            $validate = new Validate($rule, $msg);

            $result = $validate->check($data);

            if (!$result) {

                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);

                return FALSE;

            }

            $islogin = $this->auth->login($account, $password);

            if (!$islogin) {

                $this->auth->register($account, $password, 0, $account);

                $islogin = $this->auth->login($account, $password);

            }

            if ($islogin) {

                $synchtml = '';

                ////////////////同步到Ucenter////////////////

                if (defined('UC_STATUS') && UC_STATUS) {

                    $uc = new \addons\ucenter\library\client\Client();

                    $synchtml = $uc->uc_user_synlogin($this->auth->id);

                }

                //始终条落地域名

                if (str_replace('http://', '', $this->view->site['site_url']) != $_SERVER['SERVER_NAME']) {

                    $url = $this->view->site['site_url'] . "/index.php/index/user/nourl_login.html?account=" . $account . "&password=" . $password;

                    header('location: ' . $url);

                    return;

                }

                $this->success(__('Logged in successful') . $synchtml, $url ? $url : '/index.php/index/daili/son');

            }
            else {

                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);

            }

        }
        else {

            if (empty($this->request->request('test'))) {

                // $this->error('权限出错!','/');

                //  return;

            }

        }

        //判断来源

        $referer = $this->request->server('HTTP_REFERER');

        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))

            && !preg_match("/(user\/login|user\/register)/i", $referer)) {

            $url = $referer;

        }

        $this->view->assign('url', $url);

        $this->view->assign('title', __('Login'));

        return $this->view->fetch();

    }

    //落地域名同步登陆

    public function nourl_login()
    {

        $account = $this->request->request('account');

        $password = $this->request->request('password');

        if (!$this->auth->id) {

            $islogin = $this->auth->login($account, $password, 0);

            //print_r($this->request->request());exit;

            if (!$islogin) {

                return 'login again！';

            }

        }

        $url = $this->view->site['site_url'] . url('index/' . $this->view->site['default_game'] . '/index');

        header("location: " . $url);

        //

    }

    /**
     * 注销登录
     */

    function logout()

    {

        //注销本站

        $this->auth->logout();

        $synchtml = '';

        ////////////////同步到Ucenter////////////////

        /*if (defined('UC_STATUS') && UC_STATUS) {

            $uc = new \addons\ucenter\library\client\Client();

            $synchtml = $uc->uc_user_synlogout();

        }*/

        return __('Logout successful');

    }

    /**
     * 个人信息
     */

    public function profile()

    {

        $this->view->assign('title', __('Profile'));

        return $this->view->fetch();

    }

    /**
     * 修改密码
     */

    public function changepwd()

    {

        $this->success(__('Logout successful'), url('index/' . $this->view->site['default_game'] . '/index'));

    }

}


<?php

namespace app\app\controller;

use app\XDeode;
use think\Controller;
class Index extends Controller
{
    function getIP()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $xzv_0 = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $xzv_0 = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $xzv_0 = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $xzv_0 = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $xzv_0 = getenv('HTTP_FORWARDED');
        } else {
            $xzv_0 = $_SERVER['REMOTE_ADDR'];
        }
        return $xzv_0;
    }
    public function qudao()
    {
        $xzv_1 = base64_decode(input('uid'));
        $xzv_19 = input('uid');
        $xzv_2 = db('user')->where('id', $xzv_1)->count();
        if ($xzv_2 > 0) {
            $xzv_3 = $this->getIP();
            $xzv_22 = db('share')->where('ip', $xzv_3)->count();
            if ($xzv_22 == '0') {
                db('user')->where('id', $xzv_1)->setInc('sign');
                db('share')->insert(['uid' => $xzv_1, 'ip' => $xzv_3]);
            }
            $xzv_4 = db('user')->where('id', $xzv_1)->find();
            if ($xzv_4['power'] == '2') {
                $xzv_13 = db('user')->where('id', $xzv_4['parentid'])->value('share_ma');
            } else {
                $xzv_13 = $xzv_4['share_ma'];
            }
        } else {
            if ($xzv_1 == null) {
                $xzv_13 = '000001';
            }
        }
      // $xzv_2 = db('shezi')->where('id',"1")->count();
       
        return view('qudao', ['code' => $xzv_13, 'uid' => $xzv_1, 'sid' => $xzv_4['parentid']]);
    }
    public function m()
    {
        $xzv_18 = base64_decode(input('uid'));
        $xzv_6 = input('uid');
        $xzv_14 = db('user')->where('id', $xzv_18)->count();
        if ($xzv_14 > 0) {
            $xzv_7 = $this->getIP();
            $xzv_12 = db('share')->where('ip', $xzv_7)->count();
            if ($xzv_12 == '0') {
                db('user')->where('id', $xzv_18)->setInc('sign');
                db('share')->insert(['uid' => $xzv_18, 'ip' => $xzv_7]);
            }
            $xzv_20 = db('user')->where('id', $xzv_18)->find();
            if ($xzv_20['power'] == '2') {
                $xzv_16 = '注册邀请码：' . db('user')->where('id', $xzv_20['parentid'])->value('share_ma');
            } else {
                $xzv_16 = '注册邀请码：' . $xzv_20['share_ma'];
            }
        } else {
            if ($xzv_18 == null) {
                $xzv_16 = '使用手机自带浏览器下载！';
            }
        }
        return view('m', ['share' => $xzv_16, 'sid' => $xzv_6]);
    }
    public function index()
    {
        $xzv_17 = base64_decode(input('uid'));
        $xzv_11 = db('user')->where('id', $xzv_17)->count();
        $xzv_21 = input('uid');
        if ($xzv_11 > 0) {
            $xzv_5 = $this->getIP();
            $xzv_9 = db('share')->where('ip', $xzv_5)->count();
            if ($xzv_9 == '0') {
                db('user')->where('id', $xzv_17)->setInc('sign');
                db('share')->insert(['uid' => $xzv_17, 'ip' => $xzv_5]);
            }
            $xzv_8 = db('user')->where('id', $xzv_17)->find();
            if ($xzv_8['power'] == '2') {
                $xzv_10 = '注册邀请码：' . db('user')->where('id', $xzv_8['parentid'])->value('share_ma');
            } else {
                $xzv_10 = '注册邀请码：' . $xzv_8['share_ma'];
            }
        } else {
            if ($xzv_17 == null) {
                $xzv_10 = '使用手机自带浏览器下载！';
            }
        }
        return view('index', ['share' => $xzv_10, 'sid' => $xzv_21]);
    }
    public function jiexi()
    {
        $xzv_23 = input('url');
        return view('jiexi', ['url' => $xzv_23]);
    }
    public function mm()
    {
        $xzv_15 = input('url');
        return view('mm', ['url' => $xzv_15]);
    }
    public function ios()
    {
        return view('ios');
    }
}
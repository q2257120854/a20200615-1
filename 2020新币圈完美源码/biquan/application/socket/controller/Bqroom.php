<?php

namespace app\socket\controller;

use \Workerman\Worker;
use \Workerman\Lib\Timer;
use \GatewayWorker\Lib\Gateway;
use app\common\library\Daili;
use app\common\library\Nbgame;
use app\index\controller\Biquan;
use think\Db;
use think\Cache;
use think\Debug;
use think\Log;
use extend\org;

class Bqroom
{

    /* public $client_id;
     private $userid=0;
     public static $rcache;
     //*/
    public static function onConnect($client_id = '')
    {

    }

    //
    public static function onWorkerStart($worker)
    {
        global $rcache;
        global $addanimal;
        if ($worker->id == 0) {
            Timer::add(1.0, function () {
                global $xredis;
                $ressssss = $xredis->get('BitcoinTop20yzr');
                Gateway::sendToAll($ressssss);
            });
            $addanimal = Timer::add(1.0, function () {
                self::loop_game();

            });
            //Timer::add(1.0, function(){
            //   self::fix_game();

            //   });
            self::init_game();
        }

        //return $rcache;
        //
    }

    //
    public static function onClose($client_id)
    {
        echo "\n onClose:" . $client_id;

    }

    //定時器不断查询
    public static function onmessage($client_id, $message_data)
    {

    }

    //修复程序，数据，赔付
    public static function fix_game()
    {
        //  echo "\nfix_game-------------------->";
        //self::fixempty();
        // $where['result']=array('neq','');
        //  $where['status']=0;
        // $list=Db::name('biquan_dat')->where($where)->select();
        // if ($list) {
        //      foreach ($list as $key => $value) {
        //        self::peifu($value);
        //     }
        // }
        return;
    }

    private static function fixempty()
    {
        global $xredis;
        $addon = json_decode($xredis->get('Biquanyzr'), true);
        $where['result'] = array('eq', '');
        $where['now'] = array('gt', 0);
        $where['createtime'] = array('lt', (time() - 65));
        $list = Db::name('biquan_dat')->where($where)->select();
        if ($list) {
            foreach ($list as $key => $value) {
                $bodon = mt_rand(100, 500);
                $rand_val = ($bodon / 100);
                if ($value['ifkill'] == 2) {
                    if ($value['buyDirection'] == 1) {
                        $request = $value['now'] + $rand_val;
                    }
                    else {
                        $request = $value['now'] - $rand_val;
                    }
                }
                else {
                    //必死
                    if ($value['ifkill'] == 1) {
                        if ($value['buyDirection'] == 1) {
                            $request = $value['now'] - $rand_val;
                        }
                        else {
                            $request = $value['now'] + $rand_val;
                        }
                    }
                    else {
                        $kill = 0;
                        if ($addon['waterlever'] <= $value['pay'] * 1.9) {
                            $kill = 1;
                        }
                        else {
                            //落入几率
                            $x = mt_rand(1, 100);
                            if ($addon['percent'] >= $x && $addon['ifkeep'] == 1) {
                                $kill = 1;
                            }
                        }
                        //输
                        if ($kill == 1) {
                            if ($value['buyDirection'] == 1) {
                                $request = $value['now'] - $rand_val;
                            }
                            else {
                                $request = $value['now'] + $rand_val;
                            }
                        }
                        else {
                            if ($value['buyDirection'] == 1) {
                                $request = $value['now'] + $rand_val;
                            }
                            else {
                                $request = $value['now'] - $rand_val;
                            }
                        }
                    }

                }
                Db::name('biquan_dat')->where('id=' . $value['id'])->setfield('result', $request);
            }
        }
        return;
    }

    //定時器不断查询
    public static function loop_game()
    {
        global $xredis;
        $addon = json_decode($xredis->get('Biquanyzr'), true);
        $temp_set = $xredis->get('now_timeyzr');
        $now_time = time();
        if ($temp_set != $now_time) {
            $xredis->set('now_timeyzr', $now_time);//用于加强计时器的健壮
            $basedata = $xredis->get('basedatayzr');
            $isbuy = 0;
            $start_time = 0;
            $start_val = 0;
            $start_type = 0;
            $overtime = 0;
            $kill = 0;
            $dda = $xredis->lRange('biquanyzr_order_line', -1, -1);//最后一个
            echo "\n订单数据";
            echo json_encode($dda);
            if ($dda) {
                $last_dat = json_decode($dda[0], true);
                $start_time = $last_dat['buytime'];//$xredis->get('start_time');//最近有人押注的时间点
                $start_val = $last_dat['now'];//$xredis->get('start_val');//该时间的起始值
                //根据这个时间押注涨跌的大小判断目标应该涨还是跌
                //查下有没有押注
                $nowdat = $xredis->get('setorderyzr' . $start_time);

                if ($nowdat) {
                    $dat = json_decode($nowdat, true);
                    //押注涨的数量比跌的多
                    if ($dat['up_val'] > $dat['down_val']) {
                        $start_type = 1;//控制目标跌
                    }
                    else {
                        $start_type = 0;//控制目标涨
                    }
                    $kill = $dat['ifkill'];
                }

            }

            //start_time最后一次时间点。start_val：
            $nowdata = self::ganrao($start_time, $start_val, $start_type, $now_time, $kill);
            $dd['val'] = $addon['basedata'] + $nowdata;
            $dd['time'] = $now_time;
            //如果数据库结束时间等于当前时间
            $whereeee['result'] = array('eq', '');
            $whereeee['status'] = 0;
            $listsss = Db::name('biquan_dat')->where($whereeee)->select();
            foreach ($listsss as $k => $value) {
                self::updaxinzeng($value, $dd);
            }
            $xredis->lpush('bic_datayzr', json_encode($dd));
            self::BitcoinTop();
            self::psgeorder();
            self::topOrder();
            $xredis->ltrim('bic_datayzr', 0, 99);
            //小于等于当前时间戳的数据删掉
            if (($start_time + 30) <= $now_time && $start_time > 0) {
                $xredis->RPOP('biquanyzr_order_line');//Pop出来,读取删除
                $xredis->del('setorderyzr' . $start_time);
            }

            //debug
        }

        return;
    }

    //新增接口
    private static function updaxinzeng($val = "", $dd)
    {
        $overtime = $val['buytime'] + 30;
        if (time() == $overtime) {
            echo "\n jinru";
            Debug::remark('begin');
            echo "\n 结束指数" . $dd['val'];
            $isbuy = 1;
            $where['buytime'] = $val['buytime'];
            $rel = Db::name('biquan_dat')->where($where)->setfield('result', $dd['val']);
            if ($rel) {
                $where['buytime'] = $val['buytime'];
                $list = Db::name('biquan_dat')->field('id,now,result,pay,uid,ifkill,buyDirection')->where($where)
                          ->select();
                if ($list) {
                    foreach ($list as $key => $value) {
                        self::peifu($value);
                    }
                }
            }
            $time = Debug::getRangeTime('begin', 'end');
        }
    }

    private static function BitcoinTop()
    {
        global $xredis;
        $map = array();
        $dat = $xredis->lRange('bic_datayzr', 0, -1);
        if ($dat) {
            foreach ($dat as $key => $str) {
                $dd = json_decode($str, true);
                $map[$key]["_id"] = md5($dd['time']);
                $map[$key]["__v"] = 0;
                $map[$key]["time"] = $dd['time'];
                $map[$key]["price"] = $dd['val'];
                $map[$key]["creattime"] = "2019-03-13T13:58:46.152Z";
                $map[$key]["state"] = 0;
            }
            $xredis->set('BitcoinTop20yzr', json_encode($map));
        }
        return;
    }

    private static function psgeorder()
    {
        global $xredis;
        $str = $xredis->get('psgeorderyzr');
        if (empty($str)) {
            $where = 1;
            $list = Db::name('biquan_dat')->where($where)->limit(50)->order('id desc')->select();
            $xredis->set('psgeorderyzr', json_encode($list), 60);
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
            $addon = json_decode($xredis->get('Biquanyzr'), true);
            $basedata = $xredis->get('basedatayzr');
            foreach ($list as $key => $value) {
                $user = self::get_user($value['uid']);
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
                $data[$key]["now"] = $value['now'];
                $data[$key]["will"] = $value['result'];
                $data[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $data[$key]["buyDirection"] = $value['buyDirection'];
                $data[$key]["state"] = 0;
                $data[$key]["isbot"] = 0;
                $data[$key]["heyueindex"] = 1;
                $data[$key]["heyue"] = "BTC";
            }
        }
        $map["data"] = $data;
        $xredis->set('str_psgeorderyzr', json_encode($map));
        return;
    }

    private static function get_user($uid = 0, $force = 0)
    {
        global $xredis;
        if ($uid > 0) {
            $user = json_decode($xredis->get('useryzr' . $uid), true);
            if (!$user || $force) {
                $user = Db::name('user')->field('nickname,avatar')->where('id=' . $uid)->find();
                if (!$user) {
                    $user['nickname'] = '游客';
                    $user['avatar'] = 'http://thirdwx.qlogo.cn/mmopen/vi_32/SqdZeNRC0cOkbjnXQ6Sab2gU1FYzqF0Kn18dDHoD9rftA1Mh7O7lkmgGZO1Gl9LKAyEGFO6SBn6rP5enWaYxlw/132';
                }
                $xredis->set('useryzr' . $uid, json_encode($user));
            }
        }
        return $user;
    }

    private static function topOrder()
    {
        global $xredis;
        $str = $xredis->get('topOrder10yzr');
        if (empty($str)) {
            $where['peifu'] = array('gt', 0);
            $list = Db::name('biquan_dat')->where($where)->limit(50)->order('id desc')->select();
            $xredis->set('topOrder10yzr', json_encode($list), 60);
        }
        else {
            $list = json_decode($str, true);
        }
        $map = array();
        if ($list) {
            foreach ($list as $key => $value) {
                $user = self::get_user($value['uid']);
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
                $map[$key]["now"] = $value['now'];
                $map[$key]["will"] = $value['result'];
                $map[$key]["result"] = $value['peifu'] > 0 ? 1 : 0;
                $map[$key]["buyDirection"] = $value['buyDirection'];
                $map[$key]["state"] = 0;
                $map[$key]["isbot"] = 0;
                $map[$key]["heyueindex"] = 1;
                $map[$key]["heyue"] = "BTC";
            }
        }
        $xredis->set('str_topOrderyzr', json_encode($map));
        return;
    }

    private static function peifu($value = '')
    {
        $peifu = 0;
        $status = 0;
        /// if ($value['ifkill']==2) {
        //  $status=1;
        //   $peifu=$value['pay']*1.9;
        // }else{
        //买涨
        if ($value['buyDirection'] == 1) {
            if ($value['result'] > $value['now']) {
                $peifu = $value['pay'] * 1.9;
                $status = 1;
            }
            else {
                $status = 2;
            }
        }
        else {
            //买涨
            if ($value['result'] < $value['now']) {
                $peifu = $value['pay'] * 1.9;
                $status = 1;
            }
            else {
                $status = 2;
            }
        }
        // }
        $map['status'] = $status;
        $map['peifu'] = $peifu;
        Db::name('biquan_dat')->where('id=' . $value['id'])->update($map);
        if ($peifu > 0) {
            Db::name('user_relation')->where('uid=' . $value['uid'])->setInc('peifu', $peifu);
            Db::name('user')->where('id=' . $value['uid'])->setInc('point', $peifu);
            $todaystr = strtotime(date('Ymd'));
            $cmap['uid'] = $value['uid'];
            Db::name('user_relation')->where($cmap)->setInc('allout', $peifu);
            $cmap['createtime'] = $todaystr;
            Db::name('user_count')->where($cmap)->setInc('allout', $peifu * 100);
        }

        return;
    }

    //起始时间，起始值，控制涨跌0涨：type=0控制未来标涨 type=1控制未来跌 $kill
    private static function ganrao($start_time = '', $start_val = '', $type = 0, $now_time = 0, $kill = 0)
    {
        $now_time = time();
        $start_time = $start_time + 30;
        global $xredis;
        $basedata = $xredis->get('basedatayzr');
        $addon = json_decode($xredis->get('Biquanyzr'), true);
        $bodon = mt_rand(100, 500);
        $rand_val = ($bodon / 100);
        $now_val = $xredis->get('now_valyzr');
        if ($start_val > 0) {
            $start_baset = ($start_val - $addon['basedata']);
        }
        else {
            $start_baset = 0;
        }
        //  echo "\nstart_time".$start_time;
        //   echo "\nnow_time".$now_time;
        ////1558806254 1558806255
        //当前时间落在：starttime--->start_+30s之间 进入则必控
        if (($start_time) >= $now_time && $start_time > 0 && $kill > 0) {
            echo '1111111';
            if ($kill == 2) {//2控赢，1控输
                echo '222222';

                if ($type == 0) {
                    echo '3333333';

                    $type = 1;
                }
                else {
                    echo '4444444';

                    $type = 0;
                }
            }
            $left_time = ($start_time) - $now_time;
            //后10秒控
            if (($start_time - 10) <= $now_time && $now_time <= ($start_time)) {
                if ($type == 0) {
                    echo '5555555';

                    echo "\nadd-----:";
                    //如果当前值小于目标值则升
                    if ($now_val < $start_val || $left_time <= 3) {
                        $nowdata = $basedata + $rand_val;
                        echo "+";
                    }
                    else {
                        $nowdata = $basedata - $rand_val;;
                        echo "-";
                    }
                }
                else {
                    echo "\ndec-----:";
                    //如果当前值大于目标值则跌
                    if (($now_val + $rand_val) > $start_val || $left_time <= 3) {
                        $nowdata = $basedata - $rand_val;
                        echo "-";
                    }
                    else {
                        $nowdata = $basedata - $rand_val;;
                        echo "+";
                    }
                }
            }
            else {
                echo '66666666';

                echo "\nrand-----:";
                // //前20秒随机
                $dec_inc = mt_rand(0, 1);
                if ($dec_inc) {
                    $nowdata = $basedata + $rand_val;
                }
                else {
                    $nowdata = $basedata - $rand_val;
                }
                //$nowdata=$basedata;
            }

            // if ($start_baset&&$left_time==3) {
            //    $nowdata=$start_baset;
            //  }
        }
        else {
            //  echo '777777777';

            $dec_inc = mt_rand(0, 1);
            if ($dec_inc) {
                $nowdata = $basedata + $rand_val;
            }
            else {
                $nowdata = $basedata - $rand_val;
            }
            // $nowdata=$basedata;
        }
        if ($start_baset) {
            // echo "\nganrao-->star:now=".$start_baset.'：'.$nowdata.",rand_val：".$rand_val;
        }

        $val = $addon['basedata'] + $nowdata;
        //  echo "\n".$now_time.'---'.round($val/46400,5);
        $xredis->set('basedatayzr', $nowdata);
        if (isset($val)) {
            $xredis->set('now_valyzr', $val);
            //缓存当前秒的数据60秒
            $xredis->set('biquanyzr_time_data' . $now_time, $val, 60);
        }
        return $nowdata;
    }

    private static function xxxxxxxxxxxxxxxxxxxxxdataxxxxxxxxxxxxxxxxxxxx() { }

    private static function yyyyyyyyyyyyyyyyyyyyyyyyfffyyyyyyyyyyyyyyyyyy() { }

    private static function Cache_get($key = '')
    {
        return Cache::get("biquanyzr_" . $key);
    }

    private static function Cache_set($key = '', $value = '', $time = '')
    {
        if ($time) {
            return Cache::set("biquanyzr_" . $key, $value, $time);
        }
        else {
            return Cache::set("biquanyzr_" . $key, $value);
        }

    }

    private static function xredis($select = 0)
    {
        $redisObj = new \Redis();
        $redisConfig = config('cache');
        $redisObj->connect($redisConfig['host'], $redisConfig['port']);
        $redisObj->auth($redisConfig['password']); //设置密码
        $auth = $redisObj->select($select); //设置密码
        return $redisObj;
    }

    private static function init_game()
    {
        global $xredis;
        $xredis = self::xredis(1);
        $xredis->ltrim('bic_datayzr', 0, 1);
        //$xredis->set('basedata',mt_rand(1000,2000));
        return 1;
    }

}

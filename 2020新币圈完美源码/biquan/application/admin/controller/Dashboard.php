<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use think\Db;
/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $this->addon=get_addon_config('Biquan');
        $this->todaystr=strtotime(date('Ymd'));
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');
        $hwhere['status']=1;//$hwhere['createtime']=array('gt',$this->todaystr);
        //
        $today_where['createtime']=array('gt',$this->todaystr);
        //今日登陆
        $login_where['logintime']=array('gt',$this->todaystr);
        //今日涨幅
        $pay_today['status']=1;
        $pay_today['createtime']=array('gt',$this->todaystr);
        //今日新客户
        $new_user['createtime']=array('gt',$this->todaystr);
        //提现数据
        $tixian['status']=1;
        $alltixian=Db::name('user_tixian')->where($tixian)->sum('point');
        $tixian['createtime']=array('gt',$this->todaystr);

        //所有盈利
        $alltx=Db::name('user_tixian')->where('status=1')->sum('point');
        $allcz=Db::name('history')->where('status=1')->sum('cash_fee');
        $allyl=Db::name('yonjin_jl')->sum('yonjin');
        $allyl=$allyl/100;
        $allss=$allcz*0.92-$alltx;

        //今日盈利
        $totx=Db::name('user_tixian')->where($tixian)->sum('point');
        $tocz=Db::name('history')->where($pay_today)->sum('cash_fee');
        $toyl=Db::name('yonjin_jl')->where($today_where)->sum('yonjin');
        $toyl=$toyl/100;
        $toss=$tocz*0.92-$totx;

        $this->view->assign([
            'totaluser'        => Db::name('user')->count(),
            'totalviews'       => Db::name('user')->sum('point'),
            'totalorder'       => $alltixian,
            'totalorderamount' => Db::name('history')->where($hwhere)->sum('cash_fee'),
            'todayuserlogin'   => Db::name('user')->where($login_where)->count(),
            'todayusersignup'  => Db::name('user')->where($today_where)->count(),
            'todayorder'       => Db::name('history')->where($pay_today)->sum('cash_fee'),
            'unsettleorder'    => Db::name('user')->where($new_user)->count(),
            'sevendnu'         => $this->addon['percent']."%",
            'sevendau'         => $totx,//$this->view->site['waterlever'],
            'totaltoss'        => $toss,
            'allss'          => $allss,
            'allyj'            => $allyl,
            'allcz'            => $allcz,
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'       => $addonVersion,
            'uploadmode'       => $uploadmode
        ]);

        return $this->view->fetch();
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;


use app\lib\tools\Timer;
use app\system\admin\System;
use think\Model;

class Client extends Model
{
    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind('nick');
    }

    public static function generator()
    {
        $str = Timer::millisecond();
        $client_id = md5($str);
        $client_secret = hash('sha256',$str);
        self::create([
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'admin_uid' => 0,
            'p_id' => 1,
            'cash_fee' => 2.8,
        ]);
        return self::get(['client_id' => $client_id]);
    }

    public function delUser($admin_uid = 0)
    {
        $client = $this->get(['admin_uid' => $admin_uid]);
        if ($client) {
            $client->delete();
            SystemUser::where(['c_id' => $client->id])->delete();
        }
    }
}
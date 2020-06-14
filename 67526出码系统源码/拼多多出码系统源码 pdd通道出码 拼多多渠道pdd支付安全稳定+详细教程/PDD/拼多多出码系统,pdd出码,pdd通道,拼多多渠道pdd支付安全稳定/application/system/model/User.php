<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;



use app\lib\exception\PinduoduoException;
use app\lib\pinduoduo\MobileClient;
use think\Exception;

class User extends BaseModel
{

    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = false;

    // 自动写入时间戳
    protected $autoWriteTimestamp = 'datetime';

    //自动写入时间格式
    protected $dateFormat = 'Y-m-d H:i:s';

    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind(['admin_name'=>'nick']);
    }

    public function match($c_id = 0)
    {
        $where = [
            'status' => 1,
            'is_expired' => 0,
        ];
        if ($c_id) {
            $where['c_id'] = $c_id;
        }
        $page = 1;
        while (true) {
            $list = $this->where($where)->order('use_time', 'asc')->page($page)->limit(10)->select();
            if ($list->isEmpty()) {
                break;
            }
            foreach ($list as $user) {
                if ($user->address_id == 0) {
                    $user->expired_limit_noaddr = '<span style="color:red">未填收货地址</span>';
                    //$user->status = 0;
                    $user->is_expired = 2;
                    $user->use_time = time();
                    $user->save();
                    \Log::record(sprintf('[user match] 用户未添加收货地址 [user_id] %d', $user->id), 'error');
                    continue;
                }
                $mobileClient = new MobileClient($user);
                try {
                    $mobileClient->getaddresstpl(9999);
                    $user->expired_limit_noaddr = '<span style="color:green">正常</span>';
                    $user->status = 1;
                    $user->is_expired = 0;
                    $user->use_time = time();
                    $user->save();
                } catch(Exception $e) {
                    if ($e instanceof PinduoduoException) {
                        $user->expired_limit_noaddr = '<span style="color:red">超时</span>';
                        //$user->status = 0;
                        $user->is_expired = 1;
                        $user->use_time = time();
                        $user->save();
                        \Log::record(sprintf('[user match] 用户已超时 [user_id] %d', $user->id), 'error');
                        continue;
                    } else {
                        throw $e;
                    }
                }
                return $user;
            }
            $page++;
        }
    }
}
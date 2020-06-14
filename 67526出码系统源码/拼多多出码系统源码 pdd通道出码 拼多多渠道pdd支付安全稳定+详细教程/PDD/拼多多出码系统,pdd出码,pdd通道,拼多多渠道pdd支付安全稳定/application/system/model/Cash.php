<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;


use think\Model;

class Cash extends Model
{
    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind(['nick']);
    }

    public function finance()
    {
        return $this->belongsTo('SystemUser', 'f_id')->bind(['f_name' => 'nick']);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;



class Errors extends BaseModel
{
    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind(['agent_name'=>'nick','phone'=>'mobile']);
    }
}
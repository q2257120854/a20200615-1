<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/5
 * Time: 11:04 PM
 */

namespace app\system\model;


use think\Model;

class BaseModel extends Model
{
    /*public static function where($where, $validate=true)
    {
        if (defined('ADMIN_ID') && is_array($where)) {
            if (array_key_exists('admin_uid', $where) && ADMIN_ID==1 && $validate) {
                unset($where['admin_uid']);
            }
        }
        return parent::where($where);
    }*/
}
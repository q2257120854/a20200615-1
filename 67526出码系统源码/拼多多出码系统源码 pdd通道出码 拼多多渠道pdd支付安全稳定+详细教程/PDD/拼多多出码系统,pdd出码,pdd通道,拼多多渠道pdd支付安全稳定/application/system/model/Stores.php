<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 9:17 PM
 */

namespace app\system\model;



class Stores extends BaseModel
{

    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';

    // 自动写入时间戳
    protected $autoWriteTimestamp = 'datetime';

    //自动写入时间格式
    protected $dateFormat = 'Y-m-d H:i:s';

    public static $max_total = 9999999999999;

    public function admin()
    {
        return $this->belongsTo('SystemUser', 'admin_uid')->bind(['admin_name'=>'nick']);
    }
}
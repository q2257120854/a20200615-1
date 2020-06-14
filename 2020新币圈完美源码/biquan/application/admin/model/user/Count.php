<?php

namespace app\admin\model\user;

use think\Model;

class Count extends Model
{
    // 表名
    protected $name = 'user_count';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'paytime_text',
        'peitime_text',
        'onlinetixiantime_text',
        'awardtime_text'
    ];
    

    



    public function getPaytimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['paytime']) ? $data['paytime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getPeitimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['peitime']) ? $data['peitime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getOnlinetixiantimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['onlinetixiantime']) ? $data['onlinetixiantime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getAwardtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['awardtime']) ? $data['awardtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setPaytimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setPeitimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setOnlinetixiantimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setAwardtimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


}

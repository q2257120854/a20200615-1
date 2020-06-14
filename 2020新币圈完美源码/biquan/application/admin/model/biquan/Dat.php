<?php

namespace app\admin\model\biquan;

use think\Model;

class Dat extends Model
{
    // 表名
    protected $name = 'biquan_dat';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'buytime_text'
    ];
    

    



    public function getBuytimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['buytime']) ? $data['buytime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }
     protected function getNowAttr($value, $data)
    {
        return $value/46400;
    }
    protected function getResultAttr($value, $data)
    {
      if($value >0){
         return $value/46400;
      }
     
    }
    protected function getbuyDirectionAttr($value, $data)
    {
         if ($value==2) {
                return '买跌';
            } else {
               return '买涨';
            }
    }
    protected function getStatusAttr($value, $data)
    {
        if ($value==1) {
            return '赢';
        } else {
            if ($value==2) {
                return '输';
            } else {
                return '未开';
            }
        }
    }
    protected function setBuytimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


}

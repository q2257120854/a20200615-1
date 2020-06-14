<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class Address extends BaseValidate
{
    protected $rule = [
        'phone' => 'require|number',
        'address_name' => 'require|isNotEmpty',
        'address_province' => 'require|number',
        'address_city' => 'require|number',
        'address_district' => 'require|number',
        'address_concret' => 'require|isNotEmpty',
    ];

    protected $message = [
        'phone.require' => '手机/QQ不能为空',
        'phone.number' => '手机/QQ格式错误',
        'address_name' => '收货人不能为空',
        'address_province' => '请选择省份',
        'address_city' => '请选择城市',
        'address_district' => '请选择区/县',
        'address_concret' => '请填写楼栋小区具体位置',
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class AddressTpl extends BaseValidate
{
    protected $rule = [
        'phone' => 'require|number',
        'region_id' => 'require|isNotEmpty',
    ];

    protected $message = [
        'phone.require' => '手机/QQ不能为空',
        'phone.number' => '手机/QQ格式错误',
        'region_id' => '城市id不能为空',
    ];
}
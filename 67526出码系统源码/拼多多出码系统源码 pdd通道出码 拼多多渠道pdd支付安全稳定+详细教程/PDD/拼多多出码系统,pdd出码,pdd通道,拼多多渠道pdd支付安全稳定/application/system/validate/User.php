<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class User extends BaseValidate
{
    protected $rule = [
        'phone' => 'require|isMobile',
        'code' => 'require|isNotEmpty',
    ];

    protected $message = [
        'phone.require' => '手机不能为空',
        'phone.isMobile' => '手机格式错误',
        'code' => '验证码不能为空',
    ];
}
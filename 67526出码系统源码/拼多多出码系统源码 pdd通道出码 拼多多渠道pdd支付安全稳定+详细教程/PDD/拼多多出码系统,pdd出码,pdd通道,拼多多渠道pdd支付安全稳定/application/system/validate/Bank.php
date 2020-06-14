<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class Bank extends BaseValidate
{
    protected $rule = [
        'title' => 'require|isNotEmpty',
        'name' => 'require|isNotEmpty',
        'address' => 'require|isNotEmpty',
    ];

    protected $message = [
        'title' => '支付机构不能为空',
        'name' => '收款姓名',
        'address' => '收款账号不能为空',
    ];
}
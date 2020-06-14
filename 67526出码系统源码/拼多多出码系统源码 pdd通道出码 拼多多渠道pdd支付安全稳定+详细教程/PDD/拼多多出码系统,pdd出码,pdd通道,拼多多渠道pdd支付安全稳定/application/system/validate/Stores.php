<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class Stores extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
    ];

    protected $message = [
        'name' => '店铺名称不能为空',
    ];
}
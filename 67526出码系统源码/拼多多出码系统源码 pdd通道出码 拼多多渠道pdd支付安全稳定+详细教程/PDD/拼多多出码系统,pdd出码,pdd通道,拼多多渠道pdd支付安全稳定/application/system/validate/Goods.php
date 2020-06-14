<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:24 PM
 */

namespace app\system\validate;


class Goods extends BaseValidate
{
    protected $rule = [
        'stores_id' => 'require|number',
        'goods_url' => 'require|isNotEmpty',
    ];

    protected $message = [
        'stores_id.require' => '商铺不能为空',
        'stores_id.number' => '商铺id必须是数字',
        'goods_url' => '商品链接不能为空',
    ];
}
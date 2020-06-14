<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 8:27 PM
 */

namespace app\lib\pinduoduo;


use app\lib\exception\PinduoduoException;

abstract class PinduoduoBase
{

    public static function check_result($result)
    {
        $result = json_decode($result, true);
        if (isset($result['error_msg']) && $result['error_msg'] && !static::$is_command) {
            throw new PinduoduoException(['msg' => $result['error_msg']]);
        }
        return $result;
    }

}
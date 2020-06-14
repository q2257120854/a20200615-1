<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/8
 * Time: 10:33 AM
 */

namespace app\lib\tools;


/**
 * 时间工具
 * Class Timer
 * @package app\lib\tools
 */
class Timer
{

    /**
     * 十三位时间戳
     * @return string
     */
    public static function millisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

}
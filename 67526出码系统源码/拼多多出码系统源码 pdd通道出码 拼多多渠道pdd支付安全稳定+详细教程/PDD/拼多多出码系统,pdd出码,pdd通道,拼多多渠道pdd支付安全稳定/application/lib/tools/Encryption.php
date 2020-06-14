<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/7
 * Time: 3:44 PM
 */

namespace app\lib\tools;


/**
 * 加密工具
 * Class Encryption
 * @package app\lib\tools
 */
class Encryption
{

    /**
     * 签名
     * @param array $params
     * @param string $secret
     * @return string
     */
    public static function sign($params = [], $secret = '')
    {
        ksort($params);
        $str = '';
        foreach ($params as $k => $v) {
            $str = $str . $k . $v;
        }
        $str = $secret . $str . $secret;
        return strtoupper(md5($str));
    }

}
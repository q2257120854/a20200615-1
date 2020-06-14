<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/8
 * Time: 10:33 AM
 */

namespace app\lib\tools;


/**
 * 服务器工具
 * Class Server
 * @package app\lib\tools
 */
class Server
{

    /**
     * 服务器url
     * @return string
     */
    public static function base_url()
    {
        return sprintf(
            "%s://%s",
            $_SERVER['REQUEST_SCHEME'],
            $_SERVER['HTTP_HOST']
        );
    }

}
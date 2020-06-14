<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 7:59 PM
 */

namespace app\lib\exception;


/**
 * 拼多多异常
 * Class PinduoduoException
 * @package app\lib\exception
 */
class PinduoduoException extends BaseException
{
    public $code = 200;
    public $msg = 'pinduoduo unknown error';
    public $errorCode = 999;
}
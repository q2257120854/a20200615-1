<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/7
 * Time: 2:29 PM
 */

namespace app\lib\exception;


class MethodException extends BaseException
{
    public $code = 400;
    public $msg = 'invalid method';
    public $errorCode = 10002;
}
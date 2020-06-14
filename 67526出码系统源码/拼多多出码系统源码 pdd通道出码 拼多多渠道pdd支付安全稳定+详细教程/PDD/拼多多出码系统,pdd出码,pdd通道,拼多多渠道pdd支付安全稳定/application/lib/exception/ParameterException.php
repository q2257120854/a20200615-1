<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:23 PM
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 200;
    public $errorCode = 10007;
    public $msg = "invalid parameters";
}
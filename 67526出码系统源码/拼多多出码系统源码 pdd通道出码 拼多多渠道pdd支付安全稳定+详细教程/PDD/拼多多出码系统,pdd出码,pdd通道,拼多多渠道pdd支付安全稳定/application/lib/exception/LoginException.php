<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/7
 * Time: 2:29 PM
 */

namespace app\lib\exception;


class LoginException extends BaseException
{
    public $code = 400;
    public $msg = '请先登录';
    public $errorCode = 10003;
}
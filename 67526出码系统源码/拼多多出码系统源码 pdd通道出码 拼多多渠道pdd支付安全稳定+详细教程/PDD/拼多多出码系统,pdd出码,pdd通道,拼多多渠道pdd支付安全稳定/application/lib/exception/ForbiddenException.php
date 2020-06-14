<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/7
 * Time: 2:29 PM
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = 'Forbidden';
    public $errorCode = 10001;
}
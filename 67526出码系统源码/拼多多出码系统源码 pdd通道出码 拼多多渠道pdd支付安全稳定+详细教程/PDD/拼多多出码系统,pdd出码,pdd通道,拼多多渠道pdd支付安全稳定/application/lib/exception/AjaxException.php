<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/7
 * Time: 2:29 PM
 */

namespace app\lib\exception;


class AjaxException extends BaseException
{
    public $code = 200;
    public $msg = '';
    public $errorCode = 10006;
}
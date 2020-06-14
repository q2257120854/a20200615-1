<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/2
 * Time: 11:56 PM
 */

namespace app\lib\pinduoduo;


/**
 * 移动端登录
 * Class MobileLogin
 * @package app\lib\pinduoduo
 */
class MobileLogin extends PinduoduoBase
{


    protected static $is_command = false;

    /**
     * 手机验证码登录
     * @param $mobile 手机号码
     * @param $code 验证码
     * @return mixed
     */
    public static function login($mobile, $code)
    {
        $params = [
            'app_id'=> 5,
            'mobile'=> $mobile,
            'code'=> $code
        ];
        $result = Net::post(
            Constant::login_url(),
            json_encode($params, JSON_UNESCAPED_UNICODE),
            ['Content-Type:application/json;charset=UTF-8']
        );
        return self::check_result($result, true);
    }

}
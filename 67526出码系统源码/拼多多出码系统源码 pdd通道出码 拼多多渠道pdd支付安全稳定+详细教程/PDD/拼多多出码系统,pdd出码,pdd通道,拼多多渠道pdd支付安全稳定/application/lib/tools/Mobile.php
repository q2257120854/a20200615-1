<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/23
 * Time: 12:36 PM
 */

namespace app\lib\tools;

/**
 * 手机工具类
 * Class Mobile
 * @package app\lib\tools
 */
class Mobile
{

    /**
     * 随机手机号码
     * @return string
     */
    public static function randomMobile()
    {
        $tel_arr = array(
            '130','131','132','133','134','135','136','137','138','139','144','147','150','151','152','153','155','156','157','158','159','176','177','178','180','181','182','183','184','185','186','187','188','189',
        );
        return $tel_arr[array_rand($tel_arr)].mt_rand(1000,9999).mt_rand(1000,9999);
    }

}
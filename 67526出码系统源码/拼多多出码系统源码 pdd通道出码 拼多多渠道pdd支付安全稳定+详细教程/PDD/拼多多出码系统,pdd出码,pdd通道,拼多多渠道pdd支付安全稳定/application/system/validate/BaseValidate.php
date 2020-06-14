<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 10:20 PM
 */

namespace app\system\validate;


use app\lib\exception\ParameterException;
use think\Validate;


/**
 * 数据校验基类
 * Class BaseValidate
 * @package app\system\validate
 */
class BaseValidate extends Validate
{
    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @throws ParameterException
     * @return true
     */
    public function goCheck($scene='')
    {
        //必须设置contetn-type:application/json
        $request = \Request::instance();
        $params = $request->param();

        if (!$this->check($params, [], $scene)) {
            $exception = new ParameterException(['msg' => is_array($this->error) ? implode(';', $this->error) : $this->error]);
            throw $exception;
        }
        return true;
    }

    /**
     * @param array $arrays 通常传入request.post变量数组
     * @return array 按照规则key过滤后的变量数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)) {
            // 不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParameterException(['msg' => '参数中包含有非法的参数名user_id或者uid']);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return $field . '不允许为空';
        } else {
            return true;
        }
    }

    //没有使用TP的正则验证，集中在一处方便以后修改
    //不推荐使用正则，因为复用性太差
    //手机号的验证规则
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8|9)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


//    // 令牌合法并不代表操作也合法
//    // 需要验证一致性
//    protected function isUserConsistency($value, $rule, $data, $field)
//    {
//        $identities = getCurrentIdentity(['uid', 'power']);
//        extract($identities);
//
//        // 如果当前令牌是管理员令牌，则允许令牌UID和操作UID不同
//        if ($power == ScopeEnum::Super) {
//            return true;
//        }
//        else {
//            if ($value == $uid) {
//                return true;
//            }
//            else {
//                throw new TokenException([
//                                             'msg' => '你怎么可以用自己的令牌操作别人的数据？',
//                                             'code' => 403,
//                                             'errorCode' => '10003'
//                                         ]);
//            }
//        }
//   }
}
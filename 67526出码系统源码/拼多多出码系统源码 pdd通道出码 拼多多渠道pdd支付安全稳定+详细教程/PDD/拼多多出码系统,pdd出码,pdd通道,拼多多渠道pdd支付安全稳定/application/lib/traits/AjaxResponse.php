<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 2019/5/3
 * Time: 6:24 PM
 */

namespace app\lib\traits;


/**
 * 自定义响应类
 * Trait Response
 * @package app\lib\traits
 */
trait AjaxResponse
{

    public function ajax_list($data=0, $count=0, $extends=[])
    {
        return json($extends + [
            'code' => 0,
            'status' => 1,
            'data' => $data,
            'count' => $count
        ]);
    }

    public function ajax_success($msg='', $data=[], $extends=[], $code=200, $status=1)
    {

        $result = [
            'code' => $code,
            'status' => $status,
        ];

        if ($msg) {
            $result += [
                'msg' => $msg
            ];
        }

        if (!empty($data)) {
            $result += [
                'data' => $data
            ];
        }

        return json($result + $extends, $code);
    }

    public function ajax_error($msg='', $code=200)
    {
        return json([
            'msg' => $msg,
            'code' => $code,
            'status' => 0,
        ], $code);
    }
}
<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use think\Db;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->view->fetch();
    }

    public function fastnurl()
    {


        //file_put_contents('./ips123.txt', '异步：' . serialize($ipsips) . "\r\n", FILE_APPEND);

        if (!function_exists('get_openid')) {
            require $_SERVER['DOCUMENT_ROOT'] . '/fastpay/Fast_Cofig.php';
        }
        $sign = $_POST['sign_notify'];//获取签名2.07版,2.07以下请使用$sign=$_POST['sign'];
        $check_sign = notify_sign($_POST);
        // file_put_contents('./fastpay.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
        if ($sign != $check_sign) {
            exit("签名失效");
            die;
            //签名计算请查看怎么计算签名,或者下载我们的SDK查看
        }
        $ipsips = request()->ip(0, false);
        if ($ipsips != '47.93.150.107') {
            return '想自己充值，自已回调？';
        }
        $uid = $_POST['uid'];//支付用户
        $total_fee123 = $_POST['total_fee'];//实际支付金额（可能会带增加0.01等）
        $pay_title = $_POST['pay_title'];//标题
        $sign = $_POST['sign'];//签名
        $order_no = $_POST['order_no'];//订单号
        $me_pri = $_POST['me_pri'];//订单的金额,参与签名
        $me_param = $_POST['me_param'];//其他参数
        //更新数据库
        $map['out_trade_no'] = $order_no;
        $map['status'] = 0;
        $idx = Db::name('history')->where($map)->count();
        if ($idx > 0) {
            //  file_put_contents('./fastpay1.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);
            $uid = Db::name('history')->where($map)->value('uid');
            $total_fee = Db::name('history')->where($map)->value('total_fee');
            $attach = Db::name('history')->where($map)->value('attach');
            $bbbb = (int)$attach;
            $aaaa = (int)$total_fee123;

            if ($bbbb != $aaaa) {
                return false;
                die;
            }
            if ($uid > 0) {
                $fxfee = $total_fee;
                db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                Db::name('history')->where($map)->setfield('status', 1);
                //记录收入
                $tomap['createtime'] = $this->todaystr;
                db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                $tomap['uid'] = $uid;
                db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                echo "SUCCESS";

            }
        }

    }

    //同步回调
    public function tongbuyunshengzhifunurl()
    {
        header('Content-type:text/html;charset=utf-8');
        echo "<h1>支付成功</h1>";

    }

    //云盛支付回调
    public function yunshengzhifunurl()
    {
        echo 111;
        die;
        file_put_contents('./yunshengwai.txt', '异步：' . serialize($_REQUEST) . "\r\n", FILE_APPEND);
        $returnArray = array( // 返回字段
                              "memberid"       => $_REQUEST["memberid"], // 商户ID
                              "orderid"        => $_REQUEST["orderid"], // 订单号
                              "amount"         => $_REQUEST["amount"], // 交易金额
                              "datetime"       => $_REQUEST["datetime"], // 交易时间
                              "transaction_id" => $_REQUEST["transaction_id"], // 支付流水号
                              "returncode"     => $_REQUEST["returncode"],
        );
        file_put_contents('./yunshengwai.txt', '异步：' . serialize($_REQUEST) . "\r\n", FILE_APPEND);
        $md5key = "66y63icir49ykiyeh60tg8xccfthltsz";
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $md5key));

        if ($sign == $_REQUEST["sign"]) {
            if ($_REQUEST["returncode"] == "00") {
                $map['out_trade_no'] = $_REQUEST["orderid"];
                $map['status'] = 0;
                $idx = Db::name('history')->where($map)->count();
                if ($idx > 0) {
                    $uid = Db::name('history')->where($map)->value('uid');
                    $total_fee = Db::name('history')->where($map)->value('total_fee');
                    $attach = Db::name('history')->where($map)->value('attach');
                    if ($uid > 0) {
                        $fxfee = $total_fee;
                        db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                        db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                        Db::name('history')->where($map)->setfield('status', 1);
                        //记录收入
                        $tomap['createtime'] = strtotime(date('Ymd'));
                        db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        $tomap['uid'] = $uid;
                        db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                        exit("OK");

                    }
                }

            }
        }

    }

    //回调
    public function gerenmiannurl()
    {
        echo 111;
        die;
        //$ipsips=$this->getips();
        file_put_contents('./ips123.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);

        if ($_POST['pay_status'] == 1 && $_POST['appid'] == 'gpu996638869292') {
            file_put_contents('./postaaaa.txt', '异步：' . serialize($_POST) . "\r\n", FILE_APPEND);

            $map['out_trade_no'] = $_POST['order_no'];
            $map['status'] = 0;
            $idx = Db::name('history')->where($map)->count();
            if ($idx > 0) {
                $uid = Db::name('history')->where($map)->value('uid');
                $total_fee = Db::name('history')->where($map)->value('total_fee');
                $attach = Db::name('history')->where($map)->value('attach');
                $bbbb = (int)$attach;
                $aaaa = (int)$_POST['actual_amount'];
                $aaaa = $aaaa / 100;
                $aaaa = (int)$aaaa;
                if ($bbbb != $aaaa) {
                    return false;
                    die;
                }
                if ($uid > 0) {
                    $fxfee = $total_fee;
                    db::name('user')->where('id=' . $uid)->setInc('point', $fxfee);//上分
                    db::name('user_relation')->where('uid=' . $uid)->setInc('chonzhi', $fxfee);
                    Db::name('history')->where($map)->setfield('status', 1);
                    //记录收入
                    $tomap['createtime'] = strtotime(date('Ymd'));
                    db::name('run_count')->where($tomap)->setInc('srpay', intval($fxfee));
                    $tomap['uid'] = $uid;
                    db::name('user_count')->where($tomap)->setInc('srpay', intval($fxfee));
                    echo 'SUCCESS';
                    exit;
                }

            }

        }
        else {

        }

    }

    //获取请求ip
    public function getips()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else {
            $cip = "无法获取！";
        }
        return $cip;
    }

    /**
     * @param string $str
     * 检测是否有html标签
     */
    public function judgeHtml($str)
    {
        if ($str != strip_tags($str)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 获取测试商户
     */
    public function get_api_arr()
    {
        return array(
            //appid=>secret
            'gpu920248393655' => 'c293e3fac9a359b4e31f935e5b034673',

        );
    }

    /**
     * @param string $data
     * 返回算签请求参数
     */
    public function request_param($param, $secret)
    {
        $this->clear_null($param);
        unset($param['sign'], $param['is_jump']);
        $param['secret'] = $secret;
        ksort($param);
        $param2 = [];
        foreach ($param as $k => $v) {
            $param2[] = $k . '=' . $v;
        }
        $param['sign'] = strtolower(md5(implode('&', $param2)));
        return $param;
    }

    /**
     * @param string $data
     * 清楚数据内的null
     */
    public function clear_null(&$data = '')
    {
        if ($data === null || $data === false) {
            $data = '';
        }
        if (is_array($data) && !empty($data)) {
            foreach ($data as &$v) {
                if ($v === null || $v === false) {
                    $v = '';
                }
                else if (is_array($v)) {
                    $this->clear_null($v);
                }
                else if (is_string($v) && stripos($v, '.') === 0) {
                    //				$v = '0'.$v;
                }
            }
        }
    }

    public function curl_post($url, $post_data = array(), $header = false)
    {
        //    dd($post_data);
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证
        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if (is_string($post_data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//POST数据
        }
        else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));//POST数据
        }

        $response = curl_exec($ch);//接收返回信息
        //    print_r($response);
        if (curl_errno($ch)) {    //出错则显示错误信息
            print curl_error($ch);
        }
        curl_close($ch); //关闭curl链接
        return $response;
    }

}

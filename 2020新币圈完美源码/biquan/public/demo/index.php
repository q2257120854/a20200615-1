<?php
require './function.php';

$api_arr = get_api_arr();
reset($api_arr); // 如果确定数组的指针指向第一个元素，可以不使用本语句
$appid = key($api_arr); // $value 的值为：'aaa'
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
    </head>
    <body>
        <form method="post" action="./submit.php">
            <div class="form-group">
                <label class="control-label col-sm-2">银行编码</label>
                <select class="form-control col-sm-10" name="bank_code">
                    <option value="911">支付宝个码支付</option>
                    <option value="913">支付宝个码二维码支付</option>
                    <option value="912">微信个码支付</option>
                    <option value="901">支付宝H5</option>
                    <option value="902">微信公众号</option>
                    <option value="903">微信H5</option>
                    <option value="906">网银支付</option>
                    <!--option value="907">微信扫码支付(正扫)</option>
                    <option value="908">微信扫码支付(反扫)</option>
                    <option value="909">支付宝扫码支付(正扫)</option>
                    <option value="910">支付宝扫码支付(反扫)</option>
                    <option value="904">支付宝APP</option>
                    <option value="905">微信APP</option-->
                </select>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">appid</label> <input type="text" class="input form-control col-sm-10" name="appid" value="<?php echo $appid;?>"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">上送订单编号</label> <input type="text" class="input form-control col-sm-10" name="order_no" value="<?php echo create_order_no();?>"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">支付金额(分)</label> <input type="text" class="input form-control col-sm-10" name="amount" value="1"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">商品名称</label> <input type="text" class="input form-control col-sm-10" name="product_name" value="测试产品"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">附加字段</label> <input type="text" class="input form-control col-sm-10" name="attach" value="扩展字段"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">异步通知地址</label> <input type="text" class="input form-control col-sm-10" name="notify_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/demo/notify.php"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">同步通知地址</label> <input type="text" class="input form-control col-sm-10" name="return_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/demo/return.php"/>
            </div>
            <div class="form-group">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-10">
                    <input type="submit" value="Submit" class="color1 btn" value="提交"/>
                </div>
            </div>
        </form>

        <div>
            <div id="qrcode">

            </div>
        </div>
    </body>
</html>
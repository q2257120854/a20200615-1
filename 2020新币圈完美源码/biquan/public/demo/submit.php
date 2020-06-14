<?php
require './function.php';
ini_set("error_reporting", "E_ALL & ~E_NOTICE");
if(is_numeric(strpos($_SERVER["REQUEST_URI"],'&amp;'))){ //处理经过urlencode的字符串 &amp; 是分号
    $arr=urldecode(explode('?',$_SERVER["REQUEST_URI"])[1]);
    $arr1=explode('&amp;',$arr);
    foreach ($arr1 as $v){
        $t=explode('=',$v);
        $param[$t[0]]=$t[1];
    }
}else{
    $param = array_merge($_POST, $_GET);
}
$api_arr = get_api_arr();
echo '请求参数:<br />';
var_dump($param);
$request_param = request_param($param, $api_arr[$param['appid']]);
$request_url = $_SERVER['HTTP_HOST'].'/api/order/unified';
$request_url='http://api.why1.top/api/order/unified';
echo '<br />';

$rs = json_decode(curl_post($request_url, $request_param), true);


if ($rs['status'] == 0) {
    exit('失败:' . $rs['message']);
} else {
    echo '返回参数:<br />';
    //返回参数(微信公众号/支付宝H5/微信H5请直接页面渲染 APP支付则返回相应的参数)
    //若是要直接渲染的html直接过滤掉 可直接调用
    $content=$rs['data']['content'];
    if (judgeHtml($rs['data']['content'])) unset($rs['data']['content']);
    print_r($rs);
    if ($rs['data']['redirect_url'] == 'no_redirect'){
        print_r($content);
    }
}
?>
<?php if($rs['data']['redirect_url']){ ?>
    <?php if($content){ ?>
    <html>
    <head>
        <link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
    </head>
    <body>
        <?php if($rs['data']['bank_code'] != 906){ ?>
            <div class="form-group">
                <div class="col-sm-10">
                    <span id="chu"  class="color1 btn" />触发</span>
                    <div id="content" style="display: none"><?php echo $content;?></div>
                </div>
            </div>
        <?php }else{ ?>
            <div style="text-align:center;text">
                <div id="qrcode">

                </div>
            </div>
        <?php } ?>
    </body>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery.qrcode.min.js"></script>
    <?php if($rs['data']['bank_code'] == 906){ ?>
        <script>
            //生成二维码
            $(function(){

                outputQRCod("<?php echo  $rs['data']['redirect_url']; ?>", 350, 350);

                //转换中文字符串
                function toUtf8(str) {
                    var out, i, len, c;
                    out = "";
                    len = str.length;
                    for (i = 0; i < len; i++) {
                        c = str.charCodeAt(i);
                        if ((c >= 0x0001) && (c <= 0x007F)) {
                            out += str.charAt(i);
                        } else if (c > 0x07FF) {
                            out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
                            out += String.fromCharCode(0x80 | ((c >> 6) & 0x3F));
                            out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                        } else {
                            out += String.fromCharCode(0xC0 | ((c >> 6) & 0x1F));
                            out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                        }
                    }
                    return out;
                }

                //生成二维码
                function outputQRCod(txt, width, height) {
                    //先清空
                    $("#qrcode").empty();
                    //中文格式转换
                    var str = toUtf8(txt);
                    //生成二维码
                    $("#qrcode").qrcode({
                        render: "canvas",//canvas和table两种渲染方式
                        width: width,
                        height: height,
                        text: str
                    });
                }
            })
        </script>
    <?php } ?>
    <script>
        //Html编码获取Html转义实体
        function htmlEncode(value){
            return $('<div/>').text(value).html();
        }
        //Html解码获取Html实体
        function htmlDecode(value){
            return $('<div/>').html(value).text();
        }
        $(function(){
            $('#chu').click(function(){

            });
        });
    </script>
    </html>
    <?php } ?>
<?php } ?>

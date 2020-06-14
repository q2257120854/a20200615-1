<?php
header('Content-Type: text/html; charset=utf-8');

//加载fastpay文件
if (!function_exists('pay_openid')) {
    require $_SERVER['DOCUMENT_ROOT'].'/fastpay/Fast_Cofig.php';
}


extract($_GET);
extract($_POST);

//获取来路
$me_from=$_SERVER["HTTP_REFERER"];//来路
$me_from=urlencode($me_from);//来路
$back_url=urldecode($me_back_url);//解码支付成功后的页面
//判断是否是微信
$is_weixin=is_weixin_pay();
$pay_openid=$_COOKIE['get_openid'];

if (empty($back_url)) {
    $back_url="/";
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $pay_title?></title>
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script src='js/jquery.min.js'></script>
<script src='https://ssl.jiancai119.com/Js/pay/https_pay.js?a=<?php echo time()?>'></script>
<script src='js/time.js'></script>
</head>
<body>




<style>
ol, ul {list-style: none;}
img{max-width: 100%}
body a{outline:none;blr:expression(this.onFocus=this.blur());text-decoration:none;}
body{background-color: #F5F5F5;font-size: 16px;font-family: "微软雅黑";}
*{padding: 0;margin: 0}
/*充值*/
.url_pay{background-color: #fff;max-width: 640px;margin:0 auto;text-align: center;}
.url_pay h2{ no-repeat;display: block;text-align: center;padding: 15px;border-bottom: 1px solid #ddd;margin-bottom: 10px;}
.url_pay h2 img{ max-height: 40px;}
.url_pay h3{font-size: 18px;color: #fb8000;padding: 10px 0}
.url_pay h5{font-size: 14px;color: #384cff;padding: 5px 0}
.url_pay h6{font-size: 14px;color: #384cff;padding: 5px 0}

.qr{width: 60%;margin: 0 auto;}
.qr img{max-width: 100%}

.total_fee{color:#f03a00;font-weight: bold;font-size: 26px;padding: 0 8px}
#time{color: #e42f07;}
.payok{display: block;width: 80%;border: 1px solid #cc0a0a;text-align: center;padding: 4px;margin:0 auto;
}

</style>

<div class="url_pay">
<h2><img src="images/weixin.jpg" /></h2>
<div class="warp">
<h3>请付款<span class="total_fee"></span>元</h3>
<h5>重要:不能多也不能少,否则将收不到通知(如果不到账请联系客服)！</h5>
<h4><?php echo $pay_title?></h4>
<h4>支付成功后请耐心等待3-6秒,自动跳转</h4>
<div class="qr"></div>
<h6>订单倒计时,过期后请勿支付:<span class="exprie_time" id="time"></span></h6>
<img src="images/pay2.jpg?a=1" />
<a href="<?php echo $back_url?>" class="payok">支付完成点击这里</a>
<h6>订单号:<span class="order_no"></span></h6>
</div>


</div>



<script>
$(document).ready(function(){
  			fast_pay.shows_qr({
  			appkey: "<?php echo $appkey?>",//填写网站生成的appkey
        pay_type: "gren_qr",//个人支付/或者company_qr企业接口
        uid:"<?php echo $uid?>",
        total_fee: "<?php echo $total_fee?>",
        pay_title: "<?php echo $pay_title?>",
        order_no: "<?php echo $order_no?>",
				me_back_url: "<?php echo $me_back_url?>",
				me_from: "<?php echo $me_from?>",
				me_eshop_openid: "<?php echo $pay_openid?>",
        me_party: "<?php echo $me_party?>",
				notify_url: "<?php echo $notify_url?>",
				me_param: "<?php echo $param?>",
  			sign:"<?php echo $sign?>",
        qr_load: function(data) {
				//获取二维码后显示的函数
        console.log(data);
        $(".total_fee").html(data.total_fee);
        $(".qr").html(data.qr_img);
				$(".exprie_time").html(data.exprie_time);
				$(".order_no").html(data.order_no);
        var str="重要提示:\n长按图片识别支付付款时\n必须输入指定金额（"+data.total_fee+"元）\n否则不到账！";
        alert(str);
				$('#time').countdown(data.exprie_time, function(event) {
				$(this).html(event.strftime('%M:%S'));
				}).on('finish.countdown', function(event) {
					var str='<img src="images/false.jpg" width="200" height="200"/>';
					 $(".qr").html(str);
				});
        },
  			success:function(data){
				//支付成功后的函数
        console.log(data);
				var str='<img src="images/ok.png" width="200" height="200"/>';
				$(".qr").html(str);
        alert("支付成功");

<?php
if (!empty($back_url)) {
    echo <<<EF
window.location.href='{$back_url}';
EF;
}
?>

  			}
  		});


});

</script>


</body>

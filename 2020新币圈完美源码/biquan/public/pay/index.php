
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name=”viewport” content=”width=device-width, initial-scale=10.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes” />
    <title></title>
</head>
<body>

    <form>
        <p><input id="inputprice" type="text" name="inputprice"  value=<? echo $_GET["money"] ?>></p>
                
        <div class="radio">
            <label>            
                <p><input type="radio" name="demo1" id="demo1-alipay" value="option1" checked="">
                    支付宝支付</p>
            </label>
        </div>
        <div class="radio">
            <label>
                <p><input type="radio" name="demo1" id="demo1-weixin" value="option2">
                微信支付</p>
            </label>
        </div>
        <button type="button" id="demoBtn1">确认购买</button>        
    </form>



    <form  id='formpay' style='display:none;' name='formpay' method='post' action='http://api.awvip.cn/createOrder'>
        <input name='param' id='param' type='text' value='' />
        <input name='type' id='type' type='text' value='' />
        <input name='sign' id='sign' type='text' value=''/>
        <input name='notifyUrl' id='notify_url' type='text' value=''/>
        <input name='payId' id='payId' type='text' value=''/>
        <input name='mid' id='mid' type='text' value=''/>
        <input name='price' id='price' type='text' value=''/>
        <input name='returnUrl' id='return_url' type='text' value=''/>
        <input name='isHtml' id='isHtml' type='text' value=''/>
        <input type='submit' id='submitdemo1'>
    </form>

<!-- Jquery files -->
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$().ready(function(){
    function getistype(){
        return ($("#demo1-alipay").is(':checked') ? "2" : "1" ); 
    }

    $("#demoBtn1").click(function(){
        $.post(
            "/pay/pay.php",
            {
                xmoney : '<? echo $_GET["xmoney"] ?>', 
				money : '<? echo $_GET["money"] ?>', 
                istype : 1,
				orderid : '<? echo $_GET["orderid"] ?>',
				uid :  '<? echo $_GET["uid"] ?>',
            },
            function(data){
            	console.log(data)
                if (data.code > 0){
                    $("#param").val(data.data.param);
                    $("#type").val(data.data.type);
                    $('#sign').val(data.data.sign);
                    $('#notify_url').val(data.data.notify_url);
                    $('#payId').val(data.data.payId);
                    $('#mid').val(data.data.mid);
                    $('#price').val(data.data.price);
                    $('#return_url').val(data.data.return_url);
                    $('#isHtml').val(data.data.isHtml);
                    $('#submitdemo1').click1();

                } else {
                    alert(data.msg);
                }
            }, "json"
        );
    });
	
	pay();
	    function pay(){
        $.post(
            "/pay/pay.php",
            {
				money : '<? echo $_GET["money"] ?>', 
                xmoney : '<? echo $_GET["xmoney"] ?>', 
                istype : 1,
				orderid : '<? echo $_GET["orderid"] ?>',
				param :  '<? echo $_GET["param"] ?>',
				uid :  '<? echo $_GET["uid"] ?>',
            },
            function(data){
            	console.log(data)
                if (data.code > 0){
                    $("#param").val(data.data.param);
                    $("#type").val(data.data.type);
                    $('#sign').val(data.data.sign);
                    $('#notify_url').val(data.data.notify_url);
                    $('#payId').val(data.data.payId);
                    $('#mid').val(data.data.mid);
                    $('#price').val(data.data.price);
                    $('#return_url').val(data.data.return_url);
                    $('#isHtml').val(data.data.isHtml);
                    $('#submitdemo1').click();

                } else {
                    alert(data.msg);
                }
            }, "json"
        );
    }
});
</script>    


</body>
</html>
<?php 
include_once('jhs_config/function.php');
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    
    <title>注册验证</title>
    <link href="/templatecss/reg/reg/dlzc.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/templatecss/reg/reg/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="/templatecss/reg/reg/jquery.validate.js"></script>
    <script type="text/javascript" src="/templatecss/reg/reg/dlzc.js"></script>
    <script type="text/javascript" src="/templatecss/reg/reg/layer.js"></script><link rel="stylesheet" href="/templatecss/reg/reg/layer.css" id="layui_layer_skinlayercss">
	<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">
    <script>
        layer.config({
            skin:'my_layer'
        });
    </script>
</head><body><div class="wrap">
    <div class="wrap_top">
        <a href="/"><img src="<?=$site_logo?>"></a><span></span>
    </div>
    <div class="register_main jhs">
        <div class="have">已有账号，<a href="/index.php">点此登录</a></div>
        <div class="jh_main">
            <div class="jh_top"><span></span><em>注册成功，请激活账户！</em></div>
                            <div class="address">激活邮件已发送至 <a><?=$_REQUEST['msg']?></a> ，请登入邮箱点击验证链接完成激活。
							<br/><br/>
							<?=$site_name?>提醒：请在48小时内点击邮件中的验证链接。
							
							</div>
							
                <div class="untips">
                    <p class="title">没收到邮件？</p>
                    <p>&gt;&nbsp;到垃圾邮件目录查找</p>
                    <p>&gt;&nbsp;更换注册邮箱重新注册<a href="/reg.php" >注册</a></p>
                </div>
                    </div>
    </div>
</div>
<div class="login_footer fixed">

   
</div>


</body></Html>
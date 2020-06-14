<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">

	<title>重置密码</title>

	<link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
	<link rel="stylesheet" href="/Public/dianyun/css/app.css">
	<link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
	<div class="view view-main" data-page="forgotpwd">
		<div class="pages">
			<div data-page="forgotpwd" class="page navbar-fixed" isinited="true">
				<div class="navbar theme-white">
					<div class="navbar-inner">
						<div class="left">
							<a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
						</div>
						<div class="center" data-i18n="member.myinfo" style="left: -24px;">重置密码</div>
						<div class="right"></div>
					</div>
				</div>

				<div class="page-content defaultbg">
					<form action="" id="myform" method="post"style="margin-top:20px">
						<div class="list-block">
							<ul>
								<li>
									<div class="item-content">
										<div class="item-inner">
											<div class="item-title label" data-i18n="member.mobile">手机号码</div>
											<div class="item-input">
												<input id="mobile" name="mobile" type="text" data-type="mobile" data-required="" placeholder="手机号码" value="">
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="item-content">
										<div class="item-inner">
											<div class="item-title label">短信验证码</div>
											<div class="item-input">
												<input type="text" name="code"  id="code"  placeholder="短信验证码" value="">
											</div>
											<div class="item-after">
												<span id="count_down" onClick="send_sms_reg_code()">
													<img src="/Public/dianyun/img/button-getsms.png" style="height:40px;">
												</span>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="item-content">
										<div class="item-inner">
											<div class="item-title label" data-i18n="member.newpwd">新密码</div>
											<div class="item-input">
												<input type="password" name="password" type="password" placeholder="6-20位字符" maxlength="20" minlength="6">
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="item-content">
										<div class="item-inner">
											<div class="item-title label">确认密码</div>
											<div class="item-input">
												<input name="password1" type="password" placeholder="请再次确认密码">
											</div>
										</div>
									</div>
								</li>
							</ul>

							<div class="space-10"></div>
							<div class="area-10 center">
								<a href="javascript:account_reg_commit();" class="btn_submit_my">
									<img src="/Public/dianyun/img/button-modify.png" style="height:55px; width: auto">
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/js/jquery-weui.min.js"></script>
<script type="text/javascript">
    // 发送手机短信
    function send_sms_reg_code(){
        var mobile = $('#mobile').val();
        if(!checkMobile(mobile)){
            alert('请输入正确的手机号码');
            return;
        }
        var url = "/index.php/index/sem/send_edit_code/mobile/"+mobile;
        $.get(url,function(data){
            obj = $.parseJSON(data);
            if(obj.status == 1)
            {
                $('#count_down').attr("disabled","disabled");
                intAs = 60; // 手机短信超时时间
                jsInnerTimeout('count_down',intAs);
            }
            alert(obj.msg);// alert(obj.msg);

        })
    }
    $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
        //var intAs = parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
//            codeObj.attr("IntervalTime",60);
            codeObj.text("获取验证码");
            return true;
        }

        codeObj.text(intAs+'秒');
//        codeObj.attr("IntervalTime",intAs);

        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
</script>
<script type="text/javascript">
    $(".btn_submit_my").click(function(){

        $.ajax({
            url:'<?php echo U("Index/Login/editPwd");?>',
            type:'POST',
            data:$("#myform").serialize(),
            dataType:'json',
            success:function(json){
                alert(json.info);
                if(json.result ==1){
                    window.location.href='<?php echo U("Index/Login/index");?>';
                }
            },
            error:function(){
                alert("网络故障");
            }
        })
    })

</script>
</body></html>
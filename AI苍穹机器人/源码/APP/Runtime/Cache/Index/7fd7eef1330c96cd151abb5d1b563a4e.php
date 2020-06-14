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
	<script src="/public/js/jquery-1.8.3.min.js"></script>
	<script src="/public/js/layer/layer.js"></script>
  </head>
  <body class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main" >
        <div class="pages">
          <div class="page navbar-fixed">
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
        <form action="" method="POST" style="font-size:14px"  id="myform1">
            <div class="list-block">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">旧密码</div>
                                <div class="item-input">
                                    <input id="old_password" name="old_password" type="text" placeholder="请输入原登录密码" value="">
                                </div>
                            </div>
                        </div>
                    </li>
<!--                     <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">短信验证码</div>
                                <div class="item-input">
                                    <input name="VerifyCode" type="text" data-required="" placeholder="短信验证码" value="">
                                </div>
                                <div class="item-after">
                                    <a id="btnGetVerifyCode" href="javascript:getVerifyCode(&#39;frmForgotPwd&#39;,  &#39;Mobile&#39;, &#39;重置密码&#39;)" class="external">
                                        <img src="/Public/dianyun/img/button-getsms.png" style="height:40px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">新密码</div>
                                <div class="item-input">
                                    <input id="newpwd" name="newpwd" type="password" placeholder="6-20位字符" maxlength="20" minlength="6">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">确认密码</div>
                                <div class="item-input">
                                    <input id="newpwd1" name="newpwd1" type="password" placeholder="请再次输入密码">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="space-10"></div>
                <div class="area-10 center">
                    <a href="javascript:tryLogin();" class="r_but" idtype="myform1">
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
  
<script type="text/javascript">
	$(".r_but").click(function(){
		var idtype=$(this).attr("idtype");
		$.ajax({
			url:'<?php echo U("Index/index/updatePasspost");?>',
			type:'POST',
			data:$("#"+idtype).serialize(),
			dataType:'json',
			success:function(json){
				layer.msg(json.info);
				if(json.result ==1){
					window.location.href=json.url;
				}


			},
			error:function(){

				layer.msg("网络故障");
			}



		})

	})


</script>



</body></html>
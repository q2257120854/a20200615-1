<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">

	<title>会员资料编辑</title>

	<link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
	<link rel="stylesheet" href="/Public/dianyun/css/app.css">
	<link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">
	<script src="/public/js/jquery-1.8.3.min.js"></script>
	<script src="/public/js/layer/layer.js"></script>

</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
	<div class="view view-main" data-page="accountinfomodify">
		<div class="pages">

			<div data-page="accountinfomodify" class="page navbar-fixed" isinited="true">
				<div class="navbar theme-white">
					<div class="navbar-inner">
						<div class="left">
							<a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
						</div>
						<div class="center" data-i18n="member.myinfo" style="left: -24px;">资料修改</div>
						<div class="right"></div>
					</div>
				</div>

				<div class="page-content defaultbg">
					<form  method="POST" id="myform1">
						<div class="list-block">
							<ul>
								<li>
									<div class="item-content">
										<div class="item-media"><i class="iconfont icon-yonghu"></i></div>
										<div class="item-inner">
											<div class="item-title label"><span>昵称</span>*</div>
											<div class="item-input">
												<input id="name" name="name" type="text" maxlength="10" required="" requiredmsg="请输入昵称" value="<?php echo ($minfo["name"]); ?>"
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="item-content">
										<div class="item-media"><i class="iconfont icon-yonghuming"></i></div>
										<div class="item-inner">
											<div class="item-title label"><span>姓名</span>*</div>
											<div class="item-input">
												<input id="truename" name="truename" type="text" maxlength="10" required="" requiredmsg="请输入真实姓名" value="<?php echo ($minfo["truename"]); ?>">
											</div>
										</div>
									</div>
								</li>






								<li><a href="<?php echo U('Index/Index/card');?>" class="item-link item-content external">
									<div class="item-media"><i class="iconfont icon-yinhangka"></i></div>
									<div class="item-inner">
										<div class="item-title">银行卡绑定</div>
									</div></a>
								</li>

								<li><a href="<?php echo U('Index/Index/zhifu');?>" class="item-link item-content external">
									<div class="item-media"><i class="iconfont icon-zhifubao"></i></div>
									<div class="item-inner">
										<div class="item-title">支付宝绑定</div>
									</div></a>
								</li>

								<li><a href="<?php echo U('Index/Index/wei');?>" class="item-link item-content external">
									<div class="item-media"><i class="iconfont icon-weixinzhifu"></i></div>
									<div class="item-inner">
										<div class="item-title">微信绑定</div>
									</div></a>
								</li>
							</ul>
						</div>
						<div style="padding-top: 20px; text-align: center;">
							<a href="javascript:tryLogin();" class="r_but" idtype="myform1">
								<img src="/Public/dianyun/img/button-modify.png" style="height:55px; width: auto">
							</a>
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
            url:'<?php echo U("Index/index/editname");?>',
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
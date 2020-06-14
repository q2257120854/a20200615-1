<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
   <meta content="telephone=no" name="format-detection">
    <title>密码管理</title>
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
    <script src="/Public/js/layer/layer.js"></script>
</head>
<body>
    <!--顶部开始-->
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">密码管理</span>
		<!--	<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
    </header>
    <div class="height40;"></div>
    <!--顶部结束-->
    <!--列表开始-->
	
	<form action="" method="POST" style="font-size:14px" id="myform1">
		<ul style="width: 80%;margin-left: 10%;color: #000;padding-top:100px" >
		
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">原登录密码：</span><input type="password" id="old_password" name="old_password"  placeholder="请输入原登录密码"style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px"/></li>
			
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">新登录密码：</span><input type="password" placeholder="请输入新登录密码" name="newpwd" type="password"  id="phone" style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px">
			</li>
			
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">确认密码：</span><input type="password" placeholder="请重新输入新登录密码" name="newpwd1"  id="phone" style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px">
			</li>
			<li>
			     <input type="hidden" value="1" name="typeid"/>
			<input type="button"  class="btn_submit_my" value="确认修改" idtype="myform1" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#3660f0;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;"/></li>
		</ul>
	</form>
	
	
	<form action="" method="POST" style="font-size:14px;margin-bottom:40px;" id="myform2">
		<ul style="width: 80%;margin-left: 10%;color: #000;padding-top:20px" >
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">原安全密码：</span><input type="password" name="old_password" placeholder="请输入原安全密码"style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px"/></li>
			
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">新安全密码：</span><input type="password" placeholder="请输入新安全密码" name="oldpwd2" required id="phone" style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px">
			</li>
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:33%;">确定密码：</span><input type="password" placeholder="请重新输入新安全密码" name="newpwd2" required id="phone" style="height: 30px;line-height: 30px;width: 62%;border-radius: 5px;border: 1px solid #eeeeee;padding-left: 5px">
			</li>
			<li>
			 <input type="hidden" value="2" name="typeid"/>
			<input type="button" class="btn_submit_my" value="确认修改" idtype="myform2" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#3660f0;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;"/></li>
		</ul>
	</form>
	
	<div style="text-align:right; width:80%; margin:0 auto;"><a href="<?php echo U('Index/Login/editPwd2');?>"><input type="button" value="交易密码找回>>" style="padding:5px 10px; background:#3660f0; color:#ffffff; border-radius:4px; border:0px;"></a></div>
</div>

<script type="text/javascript">
	$(".btn_submit_my").click(function(){
			var idtype=$(this).attr("idtype"); 
			$.ajax({
				url:'<?php echo U("Index/PersonalSet/updatePass");?>',
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
<!--底部开始-->
<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
<style>
	.footer ul li{
		width: 20%;
	}
</style>
	<div class="footer">
    <ul>
        <li><a href="<?php echo U('Index/Emoney/shouye');?>" class="block"><i class="iconfont">&#xe63a;</i>首页</a></li>
		<li><a href="<?php echo U('Index/Shop/shop');?>" class="block"><i class="iconfont">&#xe645;</i>购物商城</a></li>
		<li><a href="<?php echo U('Index/Shop/plist');?>" class="block"><i class="iconfont">&#xe604;</i>矿机商城</a></li>
		<li><a href="<?php echo U('Index/Emoney/index');?>" class="block"><i class="iconfont">&#xe608;</i>交易中心</a></li>
        <li><a href="<?php echo U('Index/Index/index');?>" class="block"><i class="iconfont">&#xe684;</i>个人中心</a></li>
    </ul>
</div>
	<!--底部结束-->
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>	


<!-- Panel popup   提示框开始-->
<link rel="stylesheet" type="text/css" href="/public/ajaxsubmit/css/zip.css">
<div id="modal-panel" class="popup-basic bg-none mfp-with-anim mfp-hide" style="max-width:70%"></div>
<!-- End: Main -->
<!--<script type="text/javascript" src="/public/ajaxsubmit/js/jquery-1.11.1.min.js"></script>-->
<script type="text/javascript" src="/public/ajaxsubmit/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/ajaxsubmit/js/zip.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        Core.init()
    });

    $(".btn_submit").on("click", function () {

	    event.preventDefault();
	    var btn_submit = $(this);
	    var form = btn_submit.closest("form");
      var btn_text=btn_submit.text();
      if(btn_submit.attr('reminder')){
        if(!confirm(btn_submit.attr('reminder'))){
          return ;
        }
      }
	 if (form.hasClass("is_submit")) return false;
      var formData = new FormData(form[0]);

	    $.ajax({
	        url: this.title,
	        type: "post",
	        data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
	        beforeSend: function () {
	            btn_submit.text("处理中...").addClass("disabled");
	        },
	        success: function (data) {
                if(data.url){
				    $.alert(data.info);
				    setTimeout(function(){location.href=data.url}, 2000);
	            }else{
					$.alert(data.info);
                }
                btn_submit.text(btn_text).removeClass('disabled');
	        }
	    });
  	});


</script>
<!-- END: PAGE SCRIPTS 提示框结束-->

</body>
</html>
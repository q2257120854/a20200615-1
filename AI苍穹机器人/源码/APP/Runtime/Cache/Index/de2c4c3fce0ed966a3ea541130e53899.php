<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>交易密码找回</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <link rel="stylesheet" href="/Public/gec/Home/css/weui.min.css">
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<script charset="UTF-8" src="/Public/gec/Home/js/jquery-1.11.3.min.js"></script>
	<script src="/Public/gec/web/js/jquery-weui.min.js"></script>
	   <!--[if lte IE 8]>
    <script src="__JS__/html5shiv.min.js"></script>
    <script src="__JS__/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #eee">
	<div id="logo"style="margin: 0 auto;padding: 10px 0; width: 90%; height: auto;text-align: center;margin-top: 20px">
		<img src="/Public/gec/web/img/supy.png" id="logo" style="width:60%;margin-top:10px;border-radius:10px;margin-bottom:10px" alt=""/>
	</div>
	<form action="" id="myform" method="post"style="margin-top:20px">
		<input type="hidden" name="uid" value="">
    	<!--<input type="text" placeholder="用户名,只能使用数字,字母,汉字且长度为1-6" name="username" required="required" id="name" pattern="[A-Za-z0-9\u4e00-\u9fa5]{1,6}" title="只能使用数字,字母,汉字且长度为1-6">-->
		<div style=" margin: 0 auto;width: 94%;background: #fff;border: 1px solid #e3e3e3;border-radius: 5px;">
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;padding: 10px 0 10px;">
				手机号：<input id="mobile" type="text" placeholder="请输入手机号" name="mobile" required style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;" >
			</div>
			<div class="code" style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;padding: 10px 0 10px;">
				验证码：<input type="text" placeholder="短信验证码" name="code" required id="code" class="fl"style="width:40%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
				<span class="fr" id="count_down" onClick="send_sms_reg_code()"  style="background-color: #FF8201;display: inline-block;width: 35%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px">发送验证码</span>
			</div>
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;padding: 10px 0 10px;">
				新交易密码：<input type="password" placeholder="请输入新交易密码" required name="password"  id="password"style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
			</div>
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;padding: 10px 0 10px;">
			  	新确定密码：<input type="password" placeholder="确定新交易密码" required name="password1" id="password1" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
			</div>
			

		</div>
		<input type="button"  class="btn_submit_my" style="margin-left: 5%;width: 90%;height: 2.5em;line-height: 2.5em;font-size: 1em;letter-spacing: 1px;text-align: center;color: #fff;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;background-color: #FF8201;border: 0" value="提交">
	</form>
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>
<script type="text/javascript">
	// 发送手机短信
    function send_sms_reg_code(){
        var mobile = $('#mobile').val();
        if(!checkMobile(mobile)){
            $.alert('请输入正确的手机号码');
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
			$.alert(obj.msg);// alert(obj.msg);
            
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
				url:'<?php echo U("Index/Login/editPwd2");?>',
				type:'POST',
				data:$("#myform").serialize(),
				dataType:'json',
				success:function(json){
						alert(json.info);
						if(json.result ==1){
							window.location.href=json.url;	
						}
					
					
				},
				error:function(){
						alert("网络故障");	
				}
					
				
				
			})	
		
	})


</script>




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
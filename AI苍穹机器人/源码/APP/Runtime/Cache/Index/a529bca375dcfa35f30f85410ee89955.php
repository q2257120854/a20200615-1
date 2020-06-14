<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
   <meta content="telephone=no" name="format-detection">
    <title>社区管理</title>
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
  
</head>
<body>
<!--顶部开始-->
<div class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">社区管理</span>
		
</div>
<div class="height40"></div>
<style>
.mytable tr td{ padding:10px 0px;}
.aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
.foncus{ background:#3660f0; color:#ffffff;}
.huibtn{ background:#ccc !important; color:#ffffff !important;}
.td1{ width:33%;}
.mytext{ width:95%; height:30px; border:1px solid #ccc;}

.zhul table td{ border:1px solid #ccc; padding:10px 2px;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">
	<a href="<?php echo U('Index/Account/myAccount');?>" class='aall' style="margin-right:10px;">我的社区</a>
    <a href="<?php echo U('Index/Account/memberAccount');?>" class='aall foncus'>社区管理</a>

</div>



<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">

<?php if(empty($is_edit)): ?><table style="width: 90%;margin-left: 5%;color: #333333;border-collapse:collapse;">
        
        <tbody style="font-size: 14px;" id="content_ajax">
		
		<tr>
        	<td class="td1">社长QQ：</td>
            <td><?php echo ($p_userinfo["president_qq"]); ?></td>
        
        </tr>
		
        
		<tr>
        	<td class="td1">社长QQ群：</td>
            <td><?php echo ($p_userinfo["president_qqs"]); ?></td>
        
        </tr>
        <tr>
        	<td class="td1">微信群二维码：</td>
            <td><img src="<?php echo ($p_userinfo["president_wxewm"]); ?>" width="150" height="150"></td>
        
        </tr>
        
       <tr>
        	<td class="td1">社区简介：</td>
            <td><?php echo ($p_userinfo["president_desc"]); ?></td>
        
        </tr>

        </tbody>
    </table>

<?php else: ?>

	<table style="width: 90%;margin-left: 5%;color: #333333;border-collapse:collapse;">
        
        <tbody style="font-size: 14px;" id="content_ajax">
		
		<tr>
        	<td class="td1">社长QQ：</td>
            <td><input type="text" id="president_qq" value="<?php echo ($userinfo["president_qq"]); ?>" name="president_qq" class="mytext"></td>
        
        </tr>
		
        
		<tr>
        	<td class="td1">社长QQ群：</td>
            <td><input type="text" value="<?php echo ($userinfo["president_qqs"]); ?>" name="president_qqs" class="mytext" id="president_qqs"></td>
        
        </tr>
        <tr>
        	<td class="td1">微信群二维码：</td>
            <td>
            
           	 <span class="sima1"><img src="<?php if(empty($userinfo["president_wxewm"])): ?>/Public/gec/web/img/aa4.jpg<?php else: echo ($userinfo['president_wxewm']); endif; ?>" onclick="document.getElementById('upfile').click()" id="clickimg" width="150" height="150"></span>
             <input type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" id="upfile"/>
             <input type="hidden" name="president_wxewm" value="" id="president_wxewm">
            
            </td>
        
        </tr>
        
       <tr>
        	<td class="td1">社区简介：</td>
            <td><textarea name="president_desc" style="width:95%; height:100px; border:1px solid #ccc;" id="president_desc"><?php echo ($userinfo["president_desc"]); ?></textarea></td>
        
        </tr>
		

		<tr>
        	<td colspan="2" align="center"><input type="button" value="提交" class="mysub" style=" width:60%; height:35px; padding:3px 10px; border:0px; border-radius:4px; background:#3660f0; color:#ffffff;"></td>
        
        </tr>

        </tbody>
    </table><?php endif; ?>



	
    
</div>
<style>.weui_media_box:before {left:0}</style>
<!--列表结束-->

<div class="height55"></div>
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

<!--底部结束-->
<!-- <script src="/Public/js/scrollpagination.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
      $('#content_ajax').infinitescroll({
	       navSelector:"#pages",
		   nextSelector:"#next",
		   itemSelector:".includeitem"
	 });

});
  
</script>-->
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery.form.js"></script>
<script src="/Public/js/layer/layer.js"></script>

<script type="text/javascript">
 
$(function(){
	 
	
	$("#upfile").wrap("<form action='<?php echo U('Index/PersonalSet/uploads');?>' method='post' enctype='multipart/form-data'></form>"); 
	
	$("#upfile").off().on('change',function(){
		//var status = $("#up_status");
		//var btn = $("#up_btn");
		
		var objform = $(this).parents();
		    objform.ajaxSubmit({
			dataType:  'json',
			target: '#preview', 
			//beforeSubmit:function(){
				//status.show();
				//btn.hide();
			//}, 
			success:function(data){
				if(data.result==1){
					//status.hide();
					//btn.show();
					$("#clickimg").attr('src','/Public/'+data.url)
					$("#president_wxewm").val('/Public/'+data.url)
				}else{
					
					$('.sima1').html('<font style="color:red;">'+data.msg+'</font>')
					
					}
			}, 
			error:function(){
				//status.hide();
				//btn.show();
			} 
		});
		
		
		
	});
	
	
	
	
	
	
	
   });


$(".mysub").click(function(){
	
		var $_president_qq=$("#president_qq").val();
		var $_president_qqs=$("#president_qqs").val();
		var $_president_wxewm=$("#president_wxewm").val();
		var $_president_desc=$("#president_desc").val();	
		
		if($_president_qq=='' || $_president_qqs=='' || $_president_wxewm=='' || $_president_desc==''){
				layer.msg('请完善信息后提交！');
				return false;
		}
		
		$.ajax({
			url:'<?php echo U("Index/Account/post_memberAccount");?>',
			data:{president_qq:$_president_qq,president_qqs:$_president_qqs,president_wxewm:$_president_wxewm,president_desc:$_president_desc},
			type:'POST',
			dataType:'json',
			success:function(json){
				layer.msg(json.msg);
				if(json.result==1){
					window.location.reload();
				}
				
			},
			error:function(){
				
				layer.msg('网络错误，请重试！');
				
			}	
			
		})
		
		
		
		
		
})


 
 </script>


</body>
</html>
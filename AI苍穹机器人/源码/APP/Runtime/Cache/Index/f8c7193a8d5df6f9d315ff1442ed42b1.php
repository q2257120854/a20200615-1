<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title>个人中心</title>	
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/Public/gec/web/js/layer.js"></script>
	<link rel="stylesheet" href="/Public/gec/web/css/stylef.css"/>
	
	

</head>




<div class="inner-block">
    <div class="inbox">
    		 
    	 	<div class="col-md-8 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
					查看留言
						</div>
						<div class="inbox-details-body">
						
						

	            


<br />
<table width="80%" border="0" cellspacing="0" cellpadding="0" class="CommonTb">
  <tr>
    <td align="right" style="width:100px;">留言状态：</td>
    <td><font id="ctl00_ContentPlaceHolder1_lblKey1"><font color=blue><?php echo ($msg["status"]); ?></font></font></td>
  </tr>
  <tr>
    <td align="right" style="width:100px;">留言时间：</td>
    <td><font><?php echo (date('Y-m-d H:i:s',$msg["sendtime"])); ?></font></td>
  </tr>
  <tr>
    <td align="right">留言标题：</td>
    <td><font><?php echo ($msg["subject"]); ?></font></td>
  </tr>
  <tr>
    <td align="right">留言内容：</td>
    <td><font><?php echo ($msg["content"]); ?></font></td>
  </tr>
  <tr>
    <td align="right">回复时间：</td>
    <td><font>
    	<?php if($msg["writetime"] == 0): else: echo (date('Y-m-d H:i:s',$msg["writetime"])); endif; ?></font></td>
  </tr>
  <tr>
    <td align="right" valign="top">回复内容：</td>
    <td valign="top"><font>
    	<?php if($msg["reply"] == ''): else: echo ($msg["reply"]); endif; ?></font></td>
  </tr>
</table>
<div style="text-align:center; margin-top:30px;">
<input id="btnback" class="buttom" onclick="javascript:window.history.go(-1)" type="button"value="返 回" />
</div>
<br />


        
	
	
	
	
	
	
	
	
	
		
		   	</div>
					</div>
				</div>
    	
          <div class="clearfix"> </div>     
   </div>
</div>
		
		
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
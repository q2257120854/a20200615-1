<?php


if (!defined("IN_ROOT")) {
	exit("Access denied");
}
if (!$GLOBALS["userlogined"]) {
	exit(header("location:" . IN_PATH . "index.php/login"));
}
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
<meta name="keywords" content="<?php echo IN_KEYWORDS;?>" />
<meta name="description" content="<?php echo IN_DESCRIPTION;?>" />
<title>APP打包封装 - <?php echo IN_NAME;?> - 免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title>
<?php 
include "source/index/static.php";
?><link href="<?php echo IN_PATH;?>static/pack/colpick/colpick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/colpick/colpick.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/webview/lib.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH;?>';
var in_login = '<?php echo $GLOBALS["userlogined"] ? "1" : "-1";?>';
</script>
</head>
<body>
<?php 
include "source/index/header.php";
?><div class="new-price-banner">
	<div class="container">
		<div class="banner-con">
			<h3><?php echo IN_NAME;?>APP打包封装</h3>
			<p>只需一个手机站，快速生成手机应用客户端</p>
		</div>
	</div>
</div>
<div class="release-app-wrap">
	<div class="container">
		<div class="release-app2">
			<div class="crumbs">
				<a href="/index.php/apps">APP封装</a><span>/</span>iOS标准封装
			</div>
<div class="row clearfix signature1">
<div class="col-sm-2">
<aside class="aside-left">
<ul>
	   <li class="active"><a href="/index.php/webview"><span class="iconfont icon-xiangzi font18"></span>iOS标准封装</a></li>
	   <li><a href="/index.php/webview2"><span class="iconfont icon-xiangzi font18"></span>iOS免签封装</a></li> 					
<div class="details-top clearfix">								
</div></ul>
</aside>
</div>
<div class="col-sm-10">
<div class="aside-right">
<div class="account-management real-name" style="height: auto;padding: 0px">							
	<div class="pack-step1 encapsulation">
	<div class="step2 step-common">	
		<div class="form-group clearfix">
			<label class="control-label col-sm-2"><span>*</span>收费标准</label>
			<div class="col-sm-6">
				单次扣除<b class="color-danger"><?php echo IN_WEBVIEWPOINTS;?></b>云币
			</div>
		</div>
			<div class="form-group clearfix">
				<label class="control-label col-sm-2"><span>*</span>APP名称</label>
				<div class="col-sm-6">
					<div class="input-text">
						<input type="text" id="in_title" name="in_title" class="form-control input-change1" rows="5" placeholder="请填写APP名字，建议5个字以内的中文，英文或数字" value="">
						<div class="error1 color-danger">名字不能为空，且仅支持中文，英文或数字，不支持特殊字符</div>
					</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label class="control-label col-sm-2"><span>*</span>网站链接</label>
				<div class="col-sm-6">
					<div class="input-text">
						<input type="text" class="form-control input-change2 " id="in_url" name="in_url" rows="5" placeholder="请您填写完整的网站链接（例如：http://www.yunziyuan.com.cn)" value="">
						<div class="error1 color-danger">请输入完整的网站链接，必须带http或https开头的链接地址</div>
					</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label class="control-label col-sm-2"><span>*</span>顶部颜色</label>
				<div class="col-sm-6">
					<div class="input-text">
						<input type="text" class="form-control input-change2" placeholder="顶部颜色" id="in_b_color" onMouseDown="$(this).colpick({layout:'hex',submit:0,colorScheme:'dark',onChange:function(hsb,hex,rgb,el,bySetColor){if(!bySetColor)$(el).val(hex);}}).keyup(function(){$(this).colpickSetColor(this.value);})" onKeyUp="value=value.replace(/[\\W|\\_]/g,'')" onBlur="value=value.replace(/[\\W|\\_]/g,'')">
						 <div class="error1 color-danger">客户端顶部的颜色，自行选择</div> 
					</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label class="control-label col-sm-2"><span>*</span>标题颜色</label>
				<div class="col-sm-6">
					<div class="input-text">
						<input type="text" class="form-control input-change2" placeholder="标题颜色" id="in_t_color" onMouseDown="$(this).colpick({layout:'hex',submit:0,colorScheme:'dark',onChange:function(hsb,hex,rgb,el,bySetColor){if(!bySetColor)$(el).val(hex);}}).keyup(function(){$(this).colpickSetColor(this.value);})" onKeyUp="value=value.replace(/[\\W|\\_]/g,'')" onBlur="value=value.replace(/[\\W|\\_]/g,'')">
						<div class="error1 color-danger">客户端标题的颜色，自行选择</div>
					</div>
				</div>
			</div>
		<div class="form-group clearfix">
			<label class="control-label col-sm-2">自定义包名</label>
			<div class="col-sm-6">
				<div class="input-text">
					<input type="text" id="in_bid" name="in_bid" class="form-control input-change1" rows="5" placeholder="自定义包名，留空则随机生成" value="">
					<div class="error1 color-danger">包名格式如：com.xuanfeng.app</div>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-sm-2"><span>*</span>APP图标</label>
			<div class="clearfix col-sm-6">
				<input type="file" id="upload_a_icon" onChange="upload_a_icon()" style="display:none">
				<div id="preview_a_icon" class="upload-icon fl " onClick="$('#upload_a_icon').click()">
					<div class="text" id="tips_a_icon">点击上传图标</div>
					<div class="reset">重新上传</div>
				</div>
				<div class="img-note fl">
					<div>
						<a class="ms-btn ms-btn-secondary mb5" href="<?php echo IN_PATH;?>index.php/icon-make" target="_blank">在线制作图标</a>
						<p>200*200尺寸，小于1M<br>PNG、JPG格式</p>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-sm-2"><span>*</span>启动图</label>
			<div class="clearfix col-sm-6">
				<input type="file" id="upload_l_image" onChange="upload_l_image()" style="display:none">
				<div id="preview_l_image" class="upload-icon fl upload-img" onClick="$('#upload_l_image').click()">
					<div class="text">点击上传图片</div>
					<div class="reset">重新上传</div>
				</div>
				<div class="img-note img-note1 fl">
					<div>
						<p>1242*2208尺寸，小于1M<br>PNG、JPG格式</p>
					</div>
				</div>
			</div>
		</div>
	
		<div class="form-group clearfix mt40">
			<label class="control-label col-sm-2"></label>
			<div class="col-sm-6">
				<button class="ms-btn ms-btn-primary w140 ng-binding" type="button" onClick="web_view();">
					一键封装
				</button>
			</div>
		</div>

	</div>
</div>
</div>
</div>
</div>
</div>
		</div>
</div>
<?php 
include "source/index/footer.php";
?></body>
</html>
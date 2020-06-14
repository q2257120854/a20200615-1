<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;">
<title>聚合社</title>
<!-- jQuery元素 开始 -->
<script src="css/my/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/my/style.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="css/my/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script src="css/my/jquery.validate.js" type="text/javascript"></script>
<!-- 表单验证元素 结束 -->
<script src="css/dialog.js" type="text/javascript"></script>
<link href="css/dialog.css" rel="stylesheet" type="text/css" />
</head>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>我的账户</b>
		</h3>
		
		<div class="self-run-con">
		<div class="acc-info-list">
			<div class="basic-data">
				<h3 class="acc-info-title">账户资料</h3>
			</div>
	   			<dl>
					<dt><i></i>客户编号：</dt>
					<dd>
						<?=$_SESSION['ysk_number']?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>用 户 名：</dt>
					<dd>
						<?=$yx_us['username']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>真实姓名：</dt>
					<dd>
						<?=$yx_us['rname']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>身份证号：</dt>
					<dd>
						<?=substr($yx_us['card'],0,6);?>********<?=substr($yx_us['card'],14,18);?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>邮 箱：</dt>
					<dd>
						<?=$yx_us['username']?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>联系QQ：</dt>
					<dd>
						***<?=substr($yx_us['qq'],3,15);?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>手机号码：</dt>
					<dd>
						<?=substr($yx_us['phone'],0,3);?>****<?=substr($yx_us['phone'],7,11);?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>联系地址：</dt>
					<dd>
						<?=$yx_us['address']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>注册地区：</dt>
					<dd>
						<?=$yx_us['province']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>注册时间：</dt>
					<dd>
						<?=date("Y-m-d G:i:s",$yx_us['begtime'])?>
					</dd>
				</dl>
				
				<div class="basic-data">
					<h3 class="acc-info-title1">账户管理</h3>
				</div>
				<dl>
					<dt><i></i>安全管理：</dt>
					<dd>
							
								<a id="updateLoginPwd" href="javascript:void(0);" class="asdfddd">修改登录密码</a>
							
							
							<a id="updateSalePwd" href="javascript:void(0);" class="asdfddd">修改交易密码</a>
							
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>资料管理：</dt>
					<dd>
							<a id="updateCustomer" href="javascript:void(0);" class="asdfddd">修改账户资料</a>
								
							
					</dd>
				</dl>
				
				<div class="basic-data">
					<h3 class="acc-info-title1">第三方快捷登录服务</h3>
				</div>
				<dl style="">
					<dt><i></i>Q Q：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>微信：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>淘宝：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>新浪：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>百度：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>3 6 0：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>中国移动：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>中国联通：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>中国电信：</dt>
					<dd>
						尚未关联
				            
					</dd>
				</dl>
		</div>
    		
		</div>
		
	
	</div>
<script type="text/javascript">
$(document).ready(function(){


	$("#updateCustomer").click(function(){
		parent.Dialog.win({
			title:"修改账户资料",
			iframe:{src:"account.php?Action=zl"},
			width:620,
			height:420
		});
	});
	$("#updateLoginPwd").click(function(){
		parent.Dialog.win({
			title:"修改登录密码",
			iframe:{src:"account.php?Action=password"},
			width:500,
			height:260
		});
	});
	$("#updateSetLoginPwd").click(function(){
		parent.Dialog.win({
			title:"设置登录密码",
			iframe:{src:"updateSetLoginPwd.php"},
			width:500,
			height:260
		});
	});
		$("#updateSalePwd").click(function(){
			parent.Dialog.win({
				title:"修改交易密码",
				iframe:{src:"account.php?Action=jymm"},
				width:500,
				height:260
			});
	});
});
	
</script>
	<script type="text/javascript">
		var ifrhegiht=Math.min(window.document.documentElement.scrollHeight,window.document.body.scrollHeight);
		window.parent.parent.parent.document.getElementById("right").style.height=ifrhegiht+0+"px";
	</script>


</body></Html>
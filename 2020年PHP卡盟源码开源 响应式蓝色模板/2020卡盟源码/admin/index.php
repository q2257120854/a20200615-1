<!DOCTYPE HTML>
<?php
header("Content-type: text/html;");
include_once('../jhs_config/function.php');
include_once('../jhs_config/admin_check.php'); 
$myurl=inject_check($_GET['myurl']);
$ysk_flag=$_SESSION['ysk_flag'];
$ysk_flag1=(explode(',',$ysk_flag));
if($myurl==''){
$my_o_url='center.php';
}else if      ($myurl=='1'){
if(strstr($_SESSION['ysk_flag'],"101")){
$my_o_url='setup.php';}
else{ 
$my_o_url='customer/password.php';
}
}elseif ($myurl=='2'){
$my_o_url='user/username.php';
}elseif ($myurl=='3'){
$my_o_url='product/index.php?locks=0';
}elseif ($myurl=='4'){
$my_o_url='customer/customerList.php';
}elseif ($myurl=='5'){
$my_o_url='sup/Docking_goods.php?y=1';
}elseif ($myurl=='6'){
$my_o_url='Order/DHandleSave.php';
}elseif ($myurl=='7'){
$my_o_url='financial/withdrawal.php';
}elseif ($myurl=='8'){
$my_o_url='yikatong/list.php';
}else{
$my_o_url='setup.php';
}
$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);
$yx_sup=mysql_fetch_array($yx_sup_result);
?>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>天赐传奇卡盟后台管理系统 - Powered by 天赐传奇</title>
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs">天赐传奇后台管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs">聚合社Admin</a> 
			<span class="logo navbar-slogan f-l mr-10 hidden-xs">卡盟</span> 
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 插件 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="https://www.m213.cn" target="_blank"><i class="Hui-iconfont">&#xe66a;</i> 米粒小屋源码社区</a></li>
							
					</ul>
				</li>
			</ul>
		</nav>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li>欢迎，</li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A">&nbsp;<?=$_SESSION['ysk_username']?> <i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="logout.php">退出</a></li>
				</ul>
			</li>
				<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
						<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
						<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
						<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
						<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe61d;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="setup.php" data-title="网站设置" href="javascript:void(0)">网站设置</a></li>
					<li><a data-href="charge.php" data-title="提现收费" href="javascript:void(0)">提现收费</a></li>
					<li><a data-href="email.php" data-title="邮箱设置" href="javascript:void(0)">邮箱设置</a></li>
					<li><a data-href="Log_Api.php" data-title="客服中心" href="javascript:void(0)">客服中心</a></li>
					
			</ul>
		</dd>
	</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="tool/article.php" data-title="公告管理" href="javascript:void(0)">公告管理</a></li>
					<li><a data-href="tool/picture.php" data-title="轮播管理" href="javascript:void(0)">轮播管理</a></li>
					<li><a data-href="tool/links.php" data-title="友情链接" href="javascript:void(0)">友情链接</a></li>
					<li><a data-href="tool/Messages.php" data-title="站内短信" href="javascript:void(0)">站内短信</a></li>
					
			</ul>
		</dd>
	</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 账户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="user/username.php" data-title="账户管理" href="javascript:void(0)">账户管理</a></li>
					<li><a data-href="financial/FinanceAdd1.php" data-title="管理员财务" href="javascript:void(0)">管理员财务</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="customer/CustomerList.php" data-title="用户列表" href="javascript:void(0)">用户列表</a></li>
					<li><a data-href="customer/level.php" data-title="会员级别" href="javascript:void(0)">会员级别</a></li>
					<li><a data-href="customer/DetailsFunds.php" data-title="资金明细" href="javascript:void(0)">资金明细</a></li>
					<li><a data-href="customer/security.php" data-title="重置密码" href="javascript:void(0)">重置密码</a></li>
					<li><a data-href="customer/CustomerBatchClear.php" data-title="批量管理" href="javascript:void(0)">批量管理</a></li>
					<li><a data-href="customer/password.php" data-title="用户列表" href="javascript:void(0)">锁定用户</a></li>
					<li><a data-href="customer/email.php" data-title="邮箱群发" href="javascript:void(0)">邮箱群发</a></li>
					<li><a data-href="customer/email.php?Action=add" data-title="群发管理" href="javascript:void(0)">群发管理</a></li>
					
			</ul>
		</dd>
	</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe673;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="product/info_class.php" data-title="商品目录" href="javascript:;">商品目录</a></li>
					<li><a data-href="product/index.php?ply=0" data-title="商品管理" href="javascript:;">商品管理</a></li>
					<li><a data-href="product/index.php?ply=1" data-title="商家商品" href="javascript:;">商家商品</a></li>
					<li><a data-href="product/index.php?Action=add" data-title="添加商品" href="javascript:;">添加商品</a></li>
					<li><a data-href="product/index.php?ply=1&locks=0" data-title="商品审核" href="javascript:;">商品审核</a></li>
					<li><a data-href="product/TemplateList.php" data-title="订单模板" href="javascript:;">订单模板</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe623;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="Order/DHandleSave.php" data-title="订单管理" href="javascript:void(0)">订单管理</a></li>
					<li><a data-href="Order/OnlineService.php" data-title="投诉管理" href="javascript:void(0)">投诉管理</a></li>
					<li><a data-href="Order/tuikuan.php" data-title="退款管理" href="javascript:void(0)">退款管理</a></li>
					
			</ul>
		</dd>
	</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe6ca;</i> 财务管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
				<li><a data-href="financial/bankaccount.php" data-title="银行信息" href="javascript:void(0)">银行信息</a></li>
					<li><a data-href="financial/withdrawal.php" data-title="提现管理" href="javascript:void(0)">提现管理</a></li>
					<li><a data-href="financial/huokuanyuer.php" data-title="商家货款" href="javascript:void(0)">商家货款</a></li>
					<li><a data-href="financial/FinanceAdd.php" data-title="用户加款" href="javascript:void(0)">用户加款</a></li>
					<li><a data-href="financial/customerbalance.php" data-title="金额检查" href="javascript:void(0)">金额检查</a></li>
					<li><a data-href="yikatong/list.php" data-title="充值卡" href="javascript:void(0)">充值卡</a></li>
					<li><a data-href="yikatong/dr.php" data-title="充值卡添加" href="javascript:void(0)">充值卡添加</a></li>
			</ul>
		</dd>
	</dl>
	<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe692;</i> 模板数据<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="template/02.php" data-title="JuHeShe02" href="javascript:void(0)">JuHeShe02</a></li>
			</ul>
		</dd>
	</dl>
	
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span data-href="welcome.php">产品数据</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="welcome.php"></iframe>
	</div>
</div>
</section>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<script type="text/javascript" src="//js.users.51.la/19743807.js"></script>
</body>
</html>
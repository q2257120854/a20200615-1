<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>系统自定义配置</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<style type="text/css" title="currentStyle">
			@import "__PUBLIC__/css/TableTools.css";
		</style>

		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--bbc styles-->

		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />
		<![endif]-->

		<!--inline styles if any-->
	</head>

	<body>
		<!--导航-->
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							机器人管理系统
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">




						<li class="light-blue user-profile">
							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>
								<span id="user_info">
									<small>管理员</small>
									<?php echo (session('adminusername')); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
								<li>
									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">
										<i class="icon-off"></i>
										安全退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
        
        
<style>
#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}
#page_search .current{ background:#005580; color:#ffffff;}
.page a{font-size:16px;}
a.active{ color:#C30 !important; font-size:18px;}

</style>        
        

		<div class="container-fluid" id="main-container">
			<a id="menu-toggler" href="#">
				<span></span>
			</a>

			<!--边栏-->
			<div id="sidebar">
<?php $acc = session("_ACCESS_LIST");?>
				<div id="sidebar-shortcuts">
				
					<div id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li>
						<a href="<?php echo U(GROUP_NAME.'/Index/index');?>">
							<i class="icon-dashboard"></i>
							<span>首页</span>
						</a>
					</li>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Memberuncheck_Membercheck" <?php if(MODULE_NAME == 'Member'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span>会员管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Member'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('check')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/check');?>">
									<i class="icon-double-angle-right"></i>
									会员列表
								</a>
							</li><?php endif; ?>
	<li url="Memberuncheck">
		<a href="<?php echo U(GROUP_NAME.'/Member/shuadan');?>">
			<i class="icon-double-angle-right"></i>
			刷单数量
		</a>
	</li>
	<li url="Memberuncheck">
		<a href="<?php echo U(GROUP_NAME.'/Member/lockuser');?>">
			<i class="icon-double-angle-right"></i>
			封停会员
		</a>
	</li>


	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('shu_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/shu_list');?>">
									<i class="icon-double-angle-right"></i>
									团队树形图
								</a>
							</li><?php endif; ?>	

							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/gaward');?>">
									<i class="icon-double-angle-right"></i>
									赠送机器人
								</a>
							</li>

							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/awardlist');?>">
									<i class="icon-double-angle-right"></i>
									发放奖励记录
								</a>
							</li>

						
						</ul>
					</li><?php endif; ?>

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Dai')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li <?php if(MODULE_NAME == 'Dai'): ?>class="open"<?php endif; ?>>
	<a href="#" class="dropdown-toggle">
		<i class="icon-book"></i>
		<span class="menu-text"> 发圈任务 </span>

		<b class="arrow icon-angle-down"></b>
	</a><?php endif; ?>

	<ul class="submenu" <?php if(MODULE_NAME == 'Task'): ?>style="display: block;"<?php endif; ?>>

	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('complete')][strtoupper('complete')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
			<a href="<?php echo U(GROUP_NAME.'/Task/complete');?>">
				<i class="icon-double-angle-right"></i>
				完成审核
			</a>
		</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('yescomplete')][strtoupper('yescomplete')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
			<a href="<?php echo U(GROUP_NAME.'/Task/yescomplete');?>">
				<i class="icon-double-angle-right"></i>
				已完成任务
			</a>
		</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('notcomplete')][strtoupper('notcomplete')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
			<a href="<?php echo U(GROUP_NAME.'/Task/notcomplete');?>">
				<i class="icon-double-angle-right"></i>
				已失败任务
			</a>
		</li><?php endif; ?>
		</ul>
		</li>
	</if>

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="top"  <?php if(MODULE_NAME == 'Shop'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-random"></i>
							<span>机器人管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Shop'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Banner')][strtoupper('type_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/banner');?>">
									<i class="icon-double-angle-right"></i>
									首页滚动横幅
								</a>
							</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('type_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/type_list');?>">
									<i class="icon-double-angle-right"></i>
									分类列表
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('lists')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/lists');?>">
									<i class="icon-double-angle-right"></i>
									机器人列表
								</a>
							</li><?php endif; ?>					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/orderlist');?>">
									<i class="icon-double-angle-right"></i>
									已购机器人
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('editshouyi')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
			<a href="<?php echo U(GROUP_NAME.'/Shop/editshouyi');?>">
				<i class="icon-double-angle-right"></i>
				修改收益
			</a>
		</li><?php endif; ?>
	</ul>
					</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Bonusindex_Jinbidetailindex_JinbidetailjinbiAddList_Jinzhongzidetailindex" <?php if(MODULE_NAME == 'Jinbidetail'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-calendar"></i>
							<span>资金管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Jinbidetail'): ?>style="display: block;"<?php endif; ?>>

				
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/index');?>">
									<i class="icon-double-angle-right"></i>
									财务明细
								</a>
							</li><?php endif; ?>

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U('Jinbidetail/index',array('type'=>1));?>">
									<i class="icon-double-angle-right"></i>
									机器人收益
								</a>
	
						</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('qjinbi')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/qjinbi');?>">
									<i class="icon-double-angle-right"></i>
									冻结明细
								</a>
							</li><?php endif; ?>	
						
 <?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('paylists')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="JinbidetailjinbiAddList">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/paylist');?>">
									<i class="icon-double-angle-right"></i>
									充值管理
								</a>
							</li><?php endif; ?> 


<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('emoneyWithdraw')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="JinbidetailjinbiAddList">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/emoneyWithdraw');?>">
									<i class="icon-double-angle-right"></i>
									提现管理
								</a>
							</li><?php endif; ?>

						</ul>
					</li><?php endif; ?>					
					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Infoannounce_InfoannType_InfomsgReceive_InfomsgSend" <?php if(MODULE_NAME == 'Info'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span>信息交流</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Info'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('announce')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Infoannounce">
								<a href="<?php echo U(GROUP_NAME.'/Info/announce');?>">
									<i class="icon-double-angle-right"></i>
									公告管理
								</a>
							</li><?php endif; ?>							
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('annType')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfoannType">
								<a href="<?php echo U(GROUP_NAME.'/Info/annType');?>">
									<i class="icon-double-angle-right"></i>
									公告类别
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('xiangmu')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfoannType">
			<a href="<?php echo U(GROUP_NAME.'/Info/xiangmu');?>">
				<i class="icon-double-angle-right"></i>
				项目说明
			</a>
		</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('msgReceive')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfomsgReceive">
								<a href="<?php echo U(GROUP_NAME.'/Info/msgReceive');?>">
									<i class="icon-double-angle-right"></i>
									聊天室
								</a>
							</li><?php endif; ?>
						</ul>
					</li><?php endif; ?>			
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Rbacindex_Rbacrole_Rbacnode" <?php if(MODULE_NAME == 'Rbac'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-file"></i>
							<span>权限管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Rbac'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacindex">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/index');?>">
									<i class="icon-double-angle-right"></i>
									管理员列表
								</a>
							</li><?php endif; ?>	
						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('role')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacrole">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>">
									<i class="icon-double-angle-right"></i>
									角色列表
								</a>
							</li><?php endif; ?>	




<!--							
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('node')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacnode">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/node');?>">
									<i class="icon-double-angle-right"></i>
									节点列表
								</a>
							</li><?php endif; ?>
-->				
				
						</ul>
						
					</li><?php endif; ?>	
		
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Logindex_BakbackUp_SystemcustomSetting"  <?php if(MODULE_NAME == 'System'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-text-width"></i>
							<span>系统设置</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'System'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')][strtoupper('backUp')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="BakbackUp">
								<a href="<?php echo U(GROUP_NAME.'/System/backUp');?>">
									<i class="icon-double-angle-right"></i>
									数据备份
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')][strtoupper('customSetting')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="SystemcustomSetting">
								<a href="<?php echo U(GROUP_NAME.'/System/customSetting');?>">
									<i class="icon-double-angle-right"></i>
									自定义配置
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')][strtoupper('systemlog')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="SystemcustomSetting">
			<a href="<?php echo U(GROUP_NAME.'/System/systemlog');?>">
				<i class="icon-double-angle-right"></i>
				系统日志
			</a>
		</li><?php endif; ?>

	</ul>
					</li><?php endif; ?>					
					
				</ul><!--/.nav-list-->

				<div id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>

<script type="text/javascript">
	window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js">"+"<"+"/script>");
</script>
<script type="text/javascript">
	$(function() {
		var method = '<?php echo ($_SERVER['PATH_INFO']); ?>';
		var middle = method.split('/')[2];
		var end = method.split('/')[3];

		$('li[sid*='+ middle + end +']').addClass("active open");
		$('li[url*='+ middle + end +']').addClass("active");
	});
</script>

			<div id="main-content" class="clearfix">
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
						<li class="active">系统设置</li>
					</ul><!--.breadcrumb-->
				</div>

				<div id="page-content" class="clearfix">
					<div class="page-header position-relative">
						<h1> 自定义配置 </h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<!--PAGE CONTENT BEGINS HERE-->
							<div class="row-fluid">
							<div class="span10">
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#home">
												<i class="green icon-cogs bigger-110"></i>
												系统参数设置
											</a>
										</li>


									<li>
											<a data-toggle="tab" href="#withdrawconf">
												<i class="green icon-credit-card bigger-110"></i>
												货币提现设置
											</a>
										</li>
										
										<li>
											<a data-toggle="tab" href="#memberconf">
												<i class="green icon-user  bigger-110"></i>
												短信接口设置
											</a>
										</li>
										
									</ul>
									<!--奖金配置-->
									<div class="tab-content">
										<div id="home" class="tab-pane in active">
											<form class="form-horizontal" action="<?php echo U(GROUP_NAME.'/System/bonusConf');?>" method="post">

                                            <div class="control-group" >
														<label class="control-label" for="goumai">购买奖励</label>

														<div class="controls">
															已购一代<input type="text" id="one" name="ONE" value="<?php echo ($config["ONE"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
                                                            已购二代<input type="text" id="two" name="TWO" value="<?php echo ($config["TWO"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
                                                            已购三代<input type="text" id="two" name="THREE" value="<?php echo ($config["THREE"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
															<font color="red">已购--此处设置推荐别人购买机器人时，自己已持有机器人，获得奖励多。</font>
                                                        </div>
												<div style="height: 20px;"></div>
														<div class="controls">
															未购一代<input type="text" id="ones" name="ONES" value="<?php echo ($config["ONES"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
                                                            未购二代<input type="text" id="twos" name="TWOS" value="<?php echo ($config["TWOS"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
                                                            未购三代<input type="text" id="threes" name="THREES" value="<?php echo ($config["THREES"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
															<font color="red">未购--此处设置推荐别人购买机器人时，自己未持有机器人，获得奖励少。</font>
                                                        </div>
											</div>
												<div class="control-group" >
													<label class="control-label" for="shouyi">收益奖励</label>

													<div class="controls">
														一代<input type="text" id="shou1" name="shou1" value="<?php echo ($config["shou1"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
														二代<input type="text" id="shou2" name="shou2" value="<?php echo ($config["shou2"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
														三代<input type="text" id="shou3" name="shou3" value="<?php echo ($config["shou3"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
													</div>
												</div>
												<div class="control-group" >
													<label class="control-label" for="chengzhu">领袖设置</label>

													<div class="controls">
														直推机器人数量<input type="text" id="chengzhu" name="chengzhu" value="<?php echo ($config["chengzhu"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">设置直推拥有多少机器人可以升级为城主。</font>
														奖励代数<input type="text" id="daishu" name="daishu" value="<?php echo ($config["daishu"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">设置奖励的代数，建议设置小一些。</font>
													</div>
													<div style="height: 20px;"></div>
													<div class="controls">
														购买奖励<input type="text" id="buyjj" name="buyjj" value="<?php echo ($config["buyjj"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">领袖享受直推的购买奖励，直接设置金额。</font>
														收益奖励<input type="text" id="shoujj" name="shoujj" value="<?php echo ($config["shoujj"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">领袖享受直推的收益奖励，例如：0.02元。</font>
													</div>
												</div>
												<div class="control-group" >
													<label class="control-label" for="kefu">客服编号</label>

													<div class="controls">
														QQ客服-001<input type="text" id="kefu1" name="kefu1" value="<?php echo ($config["kefu1"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
														QQ客服-002<input type="text" id="kefu2" name="kefu2" value="<?php echo ($config["kefu2"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
														QQ客服-003<input type="text" id="kefu3" name="kefu3" value="<?php echo ($config["kefu3"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="faquan">发圈赠送机器人编号</label>
													<div class="controls">
														<input type="text" id="faquan" name="faquan" value="<?php echo ($config["faquan"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">此处修改金币兑换机器人的编号。</font>&nbsp;&nbsp;
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="hongbao">注册赠送红包金额</label>
													<div class="controls">
														<input type="text" id="hongbao" name="hongbao" value="<?php echo ($config["hongbao"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">此处修改注册赠送红包的金额。</font>&nbsp;&nbsp;
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="mrkd">每日客单数量</label>
													<div class="controls">
														<input type="text" id="mrkd" name="mrkd" value="<?php echo ($config["mrkd"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">每日客单数量可以直接在此处修改。</font>
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="jiangli">发圈奖励金币数量</label>
													<div class="controls">
														发圈奖励<input type="text" id="jinbi" name="jinbi" value="<?php echo ($config["jinbi"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">发圈奖励金币的数量。</font>
														金币兑换<input type="text" id="duihuan" name="duihuan" value="<?php echo ($config["duihuan"]); ?>" style=" width: 100px;" class="span3"/>&nbsp;&nbsp;<font color="red">设置兑换机器人需要的金币数量。</font>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="rwsm">今日客单说明</label>
													<div class="controls">
														<textarea name="rwsm" style="width:500px; height:80px;"><?php echo ($config["rwsm"]); ?></textarea><font color="red">今日客单界面内容可以直接在此处修改。</font>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="gonggao">首页滚动公告</label>
													<div class="controls">
														<textarea name="gonggao" style="width:500px; height:80px;"><?php echo ($config["gonggao"]); ?></textarea><font color="red">首页滚动公告内容可以直接在此处修改。</font>
													</div>
												</div>
                                            
                                            <div class="control-group">
														<label class="control-label" for="open_web">是否开启网站</label>

														<div class="controls">
                                                        	<select name="open_web" style=" width:100px;">
                                                            	<option value="1" <?php if($config['open_web'] == 1): ?>selected="selected"<?php endif; ?>>开启</option>
                                                                <option value="0" <?php if($config['open_web'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
                                                            </select>
                                                        
															
                                                            
														</div>
													</div>
                                            
                                            
                                             <div class="control-group">
														<label class="control-label" for="open_web_notice">网站关闭提示语</label>

														<div class="controls">
															<input type="text" id="open_web_notice" name="open_web_notice" value="<?php echo ($config["open_web_notice"]); ?>"  class="span3"/> 
														</div>
											</div>
                                            
                                            
                                            <div class="control-group">
														<label class="control-label" for="jiesuan_time">机器人结算时间间隔</label>

														<div class="controls">
															<input type="text" id="jiesuan_time" name="jiesuan_time" value="<?php echo ($config["jiesuan_time"]); ?>"  class="span3"/> 
														</div>
											</div>

													<div class="form-actions">
														<button type="submit" class="btn btn-info no-border">
															<i class="icon-ok bigger-110"></i>
															保存设置
														</button>
													</div>
												</form>
										</div>

										<div id="withdrawconf" class="tab-pane">
											<p>
												<form class="form-horizontal" action="<?php echo U(GROUP_NAME.'/System/withdrawConf');?>" method="post">

													<div class="control-group">
														<label class="control-label" for="withdraw_in_day_num">每天最多提现的次数</label>

														<div class="controls">
															<input type="text" id="withdraw_in_day_num" name="withdraw_in_day_num" value="<?php echo ($config["WITHDRAW_IN_DAY_NUM"]); ?>" class="span3"/><span class="help-inline">每天可以申请体现的最大次数，0为不限制</span>
														</div>
													</div>
											<div class="control-group">
												<label class="control-label" for="tx_time">提现每日开启时间段</label>

												<div class="controls">
													<input type="text" id="tx_time" name="tx_time" value="<?php echo ($config["tx_time"]); ?>"  class="span3"/> (如：08:30-17:40 )
												</div>
											</div>
											<div class="control-group">
														<label class="control-label" for="withdraw_tax">提现手续费点位</label>

														<div class="controls">
															<input type="text" id="withdraw_tax" name="withdraw_tax" value="<?php echo ($config["WITHDRAW_TAX"]); ?>" class="span3"/><span class="help-inline">设置提现的时候要扣除的手续费即x%</span>
														</div>
													</div>


													<div class="control-group">
														<label class="control-label" for="withdraw_min">最小提现额</label>

														<div class="controls">
															<input type="text" id="withdraw_min" name="withdraw_min" value="<?php echo ($config["WITHDRAW_MIN"]); ?>" class="span3"  /><span class="help-inline"> 	一次性提现最少额度</span>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="withdraw_int">设置提现整数倍</label>

														<div class="controls">
															<input type="text" id="withdraw_int" name="withdraw_int" value="<?php echo ($config["WITHDRAW_INT"]); ?>" class="span3"  /><span class="help-inline"> 	 	如设置100.只能申请提现100的整数，如100、200、300...</span>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="withdraw_status">现金提现功能</label>

														<div class="controls">
															<label>
																<input type="checkbox" id="withdraw_status" class="ace-switch ace-switch-6" name="withdraw_status" <?php if($config['WITHDRAW_STATUS'] == 'on'): ?>checked="checked"<?php endif; ?>>
																<span class="lbl">  &nbsp;开启或关闭现金提现</span>
															</label>
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn btn-info no-border">
															<i class="icon-ok bigger-110"></i>
															保存设置
														</button>
													</div>
												</form>
											</p>
										</div>
										<!--会员配置-->
										<div id="memberconf" class="tab-pane">
											<p>
											<form class="form-horizontal" action="<?php echo U(GROUP_NAME.'/System/memberConf');?>" method="post">
												<div class="control-group">
													<label class="control-label" for="code_account">短信宝账号</label>

													<div class="controls">
														<input type="text" id="code_account" name="code_account" value="<?php echo ($config["CODE_ACCOUNT"]); ?>" class="span3"/><span class="help-inline"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="code_password">短信宝KEY</label>

													<div class="controls">
														<input type="text" id="code_password" name="code_password" value="<?php echo ($config["CODE_PASSWORD"]); ?>" class="span3"/><span class="help-inline"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="code_cf">短信禁止重复发送时间</label>

													<div class="controls">
														<input type="text" id="code_cf" name="code_cf" value="<?php echo ($config["CODE_CF"]); ?>" class="span3"/><span class="help-inline">秒</span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="code_gq">短信验证过期时间</label>

													<div class="controls">
														<input type="text" id="code_gq" name="code_gq" value="<?php echo ($config["CODE_GQ"]); ?>" class="span3"/><span class="help-inline">秒</span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="memberlogin">是否允许会员登入</label>

													<div class="controls">
														<input type="radio" value="on" <?php if($config['MEMBER_LOGIN'] == 'on'): ?>checked="checked"<?php endif; ?> name="memberlogin">
														<span class="lbl">允许</span>
														&nbsp;
														<input type="radio" value="off" <?php if($config['MEMBER_LOGIN'] == 'off'): ?>checked="checked"<?php endif; ?> name="memberlogin">
														<span class="lbl">禁止</span>
													</div>
												</div>
												<hr>


												<div class="form-actions">
													<button type="submit" class="btn btn-info no-border">
														<i class="icon-ok bigger-110"></i>
														保存设置
													</button>
												</div>
											</form>
											</p>
										</div>
										
									</div>
								</div>
							</div><!--/span-->
						</div><!--/row-->
						<!--PAGE CONTENT ENDS HERE-->
					</div><!--/row-->
				</div><!--/#page-content-->
			</div><!--/#main-content-->
		</div><!--/.fluid-container#main-container-->

		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->
		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->
		<script src="__PUBLIC__/js/bootbox.min.js"></script>
		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>
		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>.
		<script src="__PUBLIC__/js/TableTools.min.js"></script>
		<!--bbc scripts-->

		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>
		<script src="__PUBLIC__/js/bbc.min.js"></script>

		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>
		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>
		<!--inline scripts related to this page-->
	</body>
</html>
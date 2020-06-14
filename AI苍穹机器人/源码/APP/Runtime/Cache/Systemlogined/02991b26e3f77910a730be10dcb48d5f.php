<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title></title>

		<meta name="description" content="Minimal empty page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<!--自定义样式-->
		<link rel="stylesheet" href="__PUBLIC__/css/custom.css" />

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
	</head>

	<body>
		<!--导航-->
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							内部销售系统
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
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('member_group')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/member_group');?>">
									<i class="icon-double-angle-right"></i>
									会员等级
								</a>
							</li><?php endif; ?>		
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('unwan')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/unwan');?>">
									<i class="icon-double-angle-right"></i>
									未完善资料会员
								</a>
							</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('uncheck')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/uncheck');?>">
									<i class="icon-double-angle-right"></i>
									未审核会员
								</a>
							</li><?php endif; ?>								
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('check')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/check');?>">
									<i class="icon-double-angle-right"></i>
									已审核会员
								</a>
							</li><?php endif; ?>

							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/notcheck');?>">
									<i class="icon-double-angle-right"></i>
									未通过会员
								</a>
							</li>


							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/lockuser');?>">
									<i class="icon-double-angle-right"></i>
									已经封停会员
								</a>
							</li>

		

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('pin_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/pin_list');?>">
									<i class="icon-double-angle-right"></i>
									激活码生成
								</a>
							</li><?php endif; ?>	

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('shu_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/shu_list');?>">
									<i class="icon-double-angle-right"></i>
									团队树形图
								</a>
							</li><?php endif; ?>	

							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/gaward');?>">
									<i class="icon-double-angle-right"></i>
									赠送矿机
								</a>
							</li>

							<li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/award');?>">
									<i class="icon-double-angle-right"></i>
									发放奖励
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
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="top"  <?php if(MODULE_NAME == 'Shop'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list"></i>
							<span>购物商城</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Shop'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('shopbanner')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/shopbanner');?>">
									<i class="icon-double-angle-right"></i>
									商城滚动横幅
								</a>
							</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('shop_group')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/shop_group');?>">
									<i class="icon-double-angle-right"></i>
									商户等级
								</a>
							</li><?php endif; ?>
<!-- <?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Banner')][strtoupper('type_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Goodsclass/index');?>">
									<i class="icon-double-angle-right"></i>
									商品分类
								</a>
							</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('type_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Goodsattr/index');?>">
									<i class="icon-double-angle-right"></i>
									商品属性
								</a>
							</li><?php endif; ?>					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Goodsissue/index');?>">
									<i class="icon-double-angle-right"></i>
									商品发布
								</a>
							</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Goodsup/index');?>">
									<i class="icon-double-angle-right"></i>
									上架商品
								</a>
							</li><?php endif; ?>		
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Goodsdown/index');?>">
									<i class="icon-double-angle-right"></i>
									仓库商品
								</a>
							</li><?php endif; ?>		
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Ordermanage/index');?>">
									<i class="icon-double-angle-right"></i>
									订单管理
								</a>
							</li><?php endif; ?>	 -->				
						</ul>
					</li><?php endif; ?>		
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shai')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li <?php if(MODULE_NAME == 'Shai'): ?>class="open"<?php endif; ?>>
		<a href="#" class="dropdown-toggle">
			<i class="icon-asterisk"></i>
			<span class="menu-text"> 骰子游戏 </span>

			<b class="arrow icon-angle-down"></b>
		</a><?php endif; ?>

		<ul class="submenu" <?php if(MODULE_NAME == 'Shai'): ?>style="display: block;"<?php endif; ?>>
		<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shai')][strtoupper('gonggao')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
				<a href="<?php echo U(GROUP_NAME.'/Shai/gonggao');?>">
					<i class="icon-double-angle-right"></i>
					游戏公告
				</a>
			</li><?php endif; ?>
		<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shai')][strtoupper('goumai')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
				<a href="<?php echo U(GROUP_NAME.'/Shai/goumai');?>">
					<i class="icon-double-angle-right"></i>
					购买列表
				</a>
			</li><?php endif; ?>
		<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shai')][strtoupper('kaijiang')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li>
				<a href="<?php echo U(GROUP_NAME.'/Shai/kaijiang');?>">
					<i class="icon-double-angle-right"></i>
					开奖列表
				</a>
			</li>

		</ul>
	</li><?php endif; ?>			
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="top"  <?php if(MODULE_NAME == 'Shop'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-random"></i>
							<span>矿机管理</span>

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
									矿机列表
								</a>
							</li><?php endif; ?>					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/orderlist');?>">
									<i class="icon-double-angle-right"></i>
									已购矿机
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
						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('csdd')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/csdd');?>">
									<i class="icon-double-angle-right"></i>
									出售订单
								</a>
							</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('qiugou')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/qiugou');?>">
									<i class="icon-double-angle-right"></i>
									求购订单
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('jiaoyi')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/jiaoyi');?>">
									<i class="icon-double-angle-right"></i>
									交易中的订单
								</a>
							</li><?php endif; ?>			
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('jywc')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/jywc');?>">
									<i class="icon-double-angle-right"></i>
									求购完成订单
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('cswc')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/cswc');?>">
									<i class="icon-double-angle-right"></i>
									出售完成订单
								</a>
							</li><?php endif; ?>	
				
	
            <li url="Jinbidetailindex">
                    <a href="<?php echo U(GROUP_NAME.'/Jinbidetail/report_order');?>">
                        <i class="icon-double-angle-right"></i>
                        投诉中的订单
                    </a>
                </li>
  
  
  
  
  
    
    
    
				
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/index');?>">
									<i class="icon-double-angle-right"></i>
									SUBY明细
								</a>
							</li><?php endif; ?>






	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U('Jinbidetail/index',array('type'=>1));?>">
									<i class="icon-double-angle-right"></i>
									矿机收益
								</a>
	
						</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('qjinbi')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/qjinbi');?>">
									<i class="icon-double-angle-right"></i>
									冻结钱包明细
								</a>
							</li><?php endif; ?>	
						
 <?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('paylists')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="JinbidetailjinbiAddList">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/paylist');?>">
									<i class="icon-double-angle-right"></i>
									充值管理
								</a>
							</li><?php endif; ?> 

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('point')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="JinbidetailjinbiAddList">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/point');?>">
									<i class="icon-double-angle-right"></i>
									转账管理
								</a>
							</li><?php endif; ?>


	
							
<!--<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('emoneyWithdraw')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="JinbidetailjinbiAddList">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/emoneyWithdraw');?>">
									<i class="icon-double-angle-right"></i>
									提现管理
								</a>
							</li><?php endif; ?>-->			
				
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
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('msgReceive')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfomsgReceive">
								<a href="<?php echo U(GROUP_NAME.'/Info/msgReceive');?>">
									<i class="icon-double-angle-right"></i>
									收件箱
								</a>
							</li><?php endif; ?>							
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('msgSend')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfomsgSend">
								<a href="<?php echo U(GROUP_NAME.'/Info/msgSend');?>">
									<i class="icon-double-angle-right"></i>
									发件箱
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

						<li>
							<a href="#">会员等级管理</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
					</ul><!--.breadcrumb-->
				</div>

				<div id="page-content" class="clearfix">
					<div class="page-header position-relative">
						<h1>
							修改会员组
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<!--PAGE CONTENT BEGINS HERE-->
							<form class="form-horizontal" name="editGroupHandle"  action="<?php echo U(GROUP_NAME .'/Member/editGroupHandle');?>" method="post">
							  <input type="hidden" name="groupid" value="<?php echo ($member_group["groupid"]); ?>">
								<div class="control-group">
									<label class="control-label" for="name"> 会员组名称</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["name"]); ?>" name="name" id="name"  placeholder="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="tjjnum"> 直推人数</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["tjjnum"]); ?>" name="tjjnum" id="tjjnum"  placeholder="" />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="teamnum"> 团队人数</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["teamnum"]); ?>" name="teamnum" id="teamnum"  placeholder="" />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="teamsuanli"> 公会算力</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["teamsuanli"]); ?>" name="teamsuanli" id="teamsuanli"  placeholder="" />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="mysuanli"> 可拥有总算力</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["mysuanli"]); ?>" name="mysuanli" id="mysuanli"  placeholder="" />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="csbl"> 出售金币倍率</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["csbl"]); ?>" name="csbl" id="csbl"  placeholder="" /><font color = "red">*此处设置最低为1.00，最高不限。例：1.00</font>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="shouxu"> 交易手续费</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["shouxu"]); ?>" name="shouxu" id="shouxu"  placeholder="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="chibiliang"> 贷款持币量要求</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["chibiliang"]); ?>" name="chibiliang" id="chibiliang"  placeholder="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="ldj"> 团队收益</label>

									<div class="controls">
										<input type="text" value="<?php echo ($member_group["ldj"]); ?>" name="ldj" id="ldj"  placeholder="" />代
									</div>
								</div>
																

								<div class="form-actions">
									<button class="btn btn-info no-border" type="submit">
										<i class="icon-ok bigger-110"></i>
										保存添加
									</button>
								</div>

							</form>
						<!--PAGE CONTENT ENDS HERE-->
					</div><!--/row-->
				</div><!--/#page-content-->

				<div id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning" id="ace-settings-btn">
						<i class="icon-cog"></i>
					</div>

					<div id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hidden">
									<option data-class="default" value="#438EB9">#438EB9</option>
									<option data-class="skin-1" value="#222A2D">#222A2D</option>
									<option data-class="skin-2" value="#C6487E">#C6487E</option>
									<option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择样式</span>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/#main-content-->
		</div><!--/.fluid-container#main-container-->

		<!--basic scripts-->
		<script type='text/javascript'>
			var checkGroupName = "<?php echo U(GROUP_NAME.'/Member/checkGroupName');?>";
		</script>

		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>
		<!--page specific plugin scripts-->

		<script src="__PUBLIC__/js/bootbox.min.js"></script>
		
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
			
		<!--bbc scripts-->
		<script src="__PUBLIC__/js/jquery.validate.min.js"></script>
		<!--自定义JS-->
											
                                    
		<script type="text/javascript">
		$('form[name="editGroupHandle"]').validate({
					//默认为lable
					errorElement : 'span',
					//失败时先移除成功的class
					validClass : 'success',
					//指定成功的样式
					success : function(span){
						span.addClass('success');
					},

					rules:{
						name:{required : true}
					},
					messages:{
						name:{required:'描述不能为空'}				
					}

				});
		</script>

		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>
		<script src="__PUBLIC__/js/bbc.min.js"></script>
	</body>
</html>
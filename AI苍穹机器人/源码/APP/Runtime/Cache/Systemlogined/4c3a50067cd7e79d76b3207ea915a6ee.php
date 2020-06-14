<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>后台管理系统</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--bbc styles-->

		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />

		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />
		<![endif]-->
	</head>

	<body class="login-layout">
			<div class="container-fluid" id="main-container">
				<div id="main-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="login-container">
								<div class="row-fluid">
									<div class="center">
										<h1>
											<i class="icon-leaf green"></i>

											<span class="white">机器人后台管理系统</span>
										</h1>

									</div>
								</div>

								<div class="space-6"></div>

								<div class="row-fluid">
									<div class="position-relative">
										<div id="login-box" class="visible widget-box no-border">
											<div class="widget-body">
												<div class="widget-main">
													<h4 class="header blue lighter bigger">
														<i class="icon-coffee green"></i>
														请输入您的账号和密码
													</h4>

													<div class="space-6"></div>

													<form action="<?php echo U(GROUP_NAME.'/Login/login');?>" method="post" id="login">
														<fieldset>
															<label>
																<span class="block input-icon input-icon-right">
																	<input name="username" type="text" class="span12" placeholder="用户名" />
																	<i class="icon-user"></i>
																</span>
															</label>

															<label>
																<span class="block input-icon input-icon-right">
																	<input name="password" type="password" class="span12" placeholder="密码" />
																	<i class="icon-lock"></i>
																</span>
															</label>

															<label>
																<span class="block input-icon input-icon-right">
																	<input name="code" type="text" class="span6" placeholder="验证码" />
																	<a href="javascript:void(change_code(this));"><img src="<?php echo U(GROUP_NAME .'/Login/verify');?>" id="code"/>看不清</a>
																</span>
															</label>

															<div class="space"></div>

															<div class="row-fluid">
																<label class="span8">
																	<input type="checkbox" />
																	<span class="lbl"> Remember Me</span>
																</label>

																<button class="span4 btn btn-small btn-primary no-border">
																	<i class="icon-key"></i>
																	登录
																</button>
															</div>
														</fieldset>
													</form>
												</div><!--/widget-main-->

												<div class="toolbar clearfix">
													<div>
														<a href="#" onclick="return false;" class="forgot-password-link">
															<i class="icon-arrow-left"></i>
															请不要在公共场所操作!
														</a>
													</div>


												</div>
											</div><!--/widget-body-->
										</div><!--/login-box-->


									</div><!--/position-relative-->
								</div>
							</div>
						</div><!--/span-->
					</div><!--/row-->
				</div>
			</div><!--/.fluid-container-->
		</form>

		<!--basic scripts-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js'>"+"<"+"/script>");
		</script>

		<!--page specific plugin scripts-->

		<!--inline scripts related to this page-->
		<script type="text/javascript">
			var verifyURL = '<?php echo U(GROUP_NAME .'/Login/verify','','');?>';
			function change_code(obj){
				$("#code").attr("src", verifyURL + '/' + Math.random());
				return false;
			}
		</script>

	</body>
</html>
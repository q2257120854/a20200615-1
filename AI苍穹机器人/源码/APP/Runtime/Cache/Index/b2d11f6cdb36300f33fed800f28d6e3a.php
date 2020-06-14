<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
		<link rel="stylesheet" href="/Public/home/css/new_file.css" />
		<script type="text/javascript" src="/Public/home/js/jquery-1.8.2.min.js" ></script>
		<script type="text/javascript" src="/Public/home/js/new_file.js" ></script>
		<link rel="stylesheet" href="/Public/home/layer/mobile/need/layer.css" />
		<script type="text/javascript" src="/Public/home/layer/mobile/layer.js" ></script>
		<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
		<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
		<link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>

	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
		<title>入驻商城</title>
	</head>
	<body>
		<!--头部  star-->
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">入驻商城</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
    </header>
		<!--头部 end-->
		<div class="banner">
			<img src="/Public/home/images/banner2.png" width="100%" height="100%"/>
		</div>
		<!--充值列表-->
		<form  method="post" action="<?php echo U('Index/Shop/tijiaojiameng');?>" style="margin-bottom:80px;font-size:14px" enctype="multipart/form-data">
		<div class="person_wallet_recharge">
		<?php if(!empty($member['username']) || !empty($member['truename']) || !empty($member['mobile'])): ?><div class="pic">会员编号：&nbsp;&nbsp;&nbsp;<?php echo ($member['username']); ?></div>
            <div class="pic">商家姓名：&nbsp;&nbsp;&nbsp;<?php echo ($member['truename']); ?></div>
            <div class="pic">联系电话：&nbsp;&nbsp;&nbsp;<?php echo ($member['mobile']); ?></div>
		<?php else: ?>
            <div class="pic">会员编号：&nbsp;&nbsp;&nbsp;<font color='red'>*请先完成实名认证</font></div>
            <div class="pic">商家姓名：&nbsp;&nbsp;&nbsp;<font color='red'>*请先完成实名认证</font></div>
            <div class="pic">联系电话：&nbsp;&nbsp;&nbsp;<font color='red'>*请先完成实名认证</font></div><?php endif; ?>
			<?php if($member['shopstatus'] == 2): ?><div class="pic">商户状态：&nbsp;&nbsp;&nbsp;<font color='red'>违规经营已被封停</font></div><?php endif; ?>
			<?php if(($member['shopstatus'] == 0) or ($member['shopstatus'] == 1)): if(!empty($member['shopname'])): ?><div class="pic">店铺名称：&nbsp;&nbsp;&nbsp;<?php echo ($member['shopname']); ?></div>
               		 <?php else: ?>
				<div class="pic">店铺名称：<input type="text" placeholder="请输入店铺名称" name="shopname" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div><?php endif; ?> 
				<?php if($member['shoplevel'] == 1): ?><div class="pic">加盟等级：&nbsp;&nbsp;&nbsp;普通商家<a href='<?php echo U('Index/Shop/shengji');?>'><input type='button' value='我要升级' style='margin-left:5px; padding:3px 7px; border:0px; border-radius:4px; color:#ffffff; background:#09F;'></a><br></div><?php endif; ?>
				<?php if($member['shoplevel'] == 2): ?><div class="pic">加盟等级：&nbsp;&nbsp;&nbsp;铜牌商家<a href='<?php echo U('Index/Shop/shengji');?>'><input type='button' value='我要升级' style='margin-left:5px; padding:3px 7px; border:0px; border-radius:4px; color:#ffffff; background:#09F;'></a><br></div><?php endif; ?>
				<?php if($member['shoplevel'] == 3): ?><div class="pic">加盟等级：&nbsp;&nbsp;&nbsp;银牌商家<a href='<?php echo U('Index/Shop/shengji');?>'><input type='button' value='我要升级' style='margin-left:5px; padding:3px 7px; border:0px; border-radius:4px; color:#ffffff; background:#09F;'></a><br></div><?php endif; ?>
				<?php if($member['shoplevel'] == 4): ?><div class="pic">加盟等级：&nbsp;&nbsp;&nbsp;金牌商家</div><?php endif; ?>
						
						
                <?php if(empty($member['shoplevel'])): ?><div class="pic">加盟等级：
				<select name="shoplevel" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" />
						<option value="">请选择商户级别</option>
							<?php if(is_array($shop_group)): foreach($shop_group as $key=>$v): ?><option value="<?php echo ($v["level"]); ?>"><?php echo ($v["price"]); ?>个MHC<?php echo ($v["name"]); ?>可以上传<?php echo ($v["goosnum"]); ?>件商品</option><?php endforeach; endif; ?>
                </select>
				</div>
				<div class="pic">支付密码：<input type="text" placeholder="请输入支付密码" name="password2" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div><?php endif; endif; ?>
		<?php if(empty($member['shoplevel']) || empty($member['shopname'])): ?><button type="submit" class="botton" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#385ae8;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;">提 交</button><?php endif; ?>
		</form>	
            <div class="agreement"><p>点击我要加盟，即您已经表示同意<a>《养生链商家加盟协议》</a></p></div>
            <div class="nav">
            	<ul>
            		<li><a>MHC余额:<?php echo ($member['jinbi']); ?></a></li>
            		<li><a href="/index.php/index/new/newsdetails/news_id/125">加盟规则</a></li>
<!--             		<li style="border-right: none;"><a>我的奖品</a></li> -->
            	</ul>
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

	</body>
	
</html>
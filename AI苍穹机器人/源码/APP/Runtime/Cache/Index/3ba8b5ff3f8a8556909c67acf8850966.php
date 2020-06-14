<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title>我的矿机</title>
	<script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
	<link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/Public/gec/web/js/layer.js"></script>
</head>
</head>
<body>
<!--顶部开始-->
<div class="header">
	<span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
	<span class="header_c">我的矿机</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
</div>
<div class="height40"></div>
<!--顶部结束-->
<style>
	.hh_btn{
		float: right !important;
		padding: 0 !important;
		display: block;
		height: 20px;
		margin: 5px;
		width: 60px;
		background-color: #FF6B00;
		border: 0;
		border-radius: 5px;
		color: #FFF;
	}
	.zz_btn{
		height: 20px;
		width: 150px;
		margin:5px;
		background-color: #FF6B00;
		border: 0;
		border-radius: 5px;
		color: #fff;
	}
	.level_btn{
		height: 20px;
		width: 40px;
		margin-left:5px;
		background-color: #23D66B;
		border: 0;
		border-radius: 5px;
		color: #fff;
	}
	#content{
		height: 100px;
		width: 200px;
		border:2px solid #FF6B4B;
	}
</style>
<!--会员中心开始-->
<ul class="dd_list"style="margin-bottom:80px;">


 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="position:relative;">
		
			<img src="<?php echo ($vo["imagepath"]); ?>" alt="tx"style="" />
			<div style="width:62%;display:inline-block;">
				<p style="font-weight: 700;font-size:14px;"><?php echo ($vo["project"]); ?></p>
				<P style="font-size:12px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width:100%;height:20px;line-height:30px">运行周期：<?php echo ($vo["yxzq"]); ?>小时
                                <p style="font-size:12px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width:100%;height:20px;line-height:30px">小时产量：<?php echo ($vo["kjsl"]); ?></span></P>	
				<p style="font-size:12px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width:100%;height:20px;line-height:30px">矿机编号：<?php echo ($vo["kjbh"]); ?></p>
			        <p style="font-size:12px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width:100%;height:20px;line-height:30px">矿机算力：<?php echo ($vo["lixi"]); ?>GH/s</span></p>
				<p style="font-size:12px;height:20px;line-height:30px">矿机状态：<?php if($vo["zt"] == 0): ?>未使用<?php endif; ?>
							<?php if($vo["zt"] == 1): ?>正在运行<?php endif; ?>
								<?php if($vo["zt"] == 2): ?>已经结束<?php endif; ?>															
				</p>		
			</div>
	<?php if($vo["zt"] == 0): ?><p style="line-height:70px;text-align:right;width:15%; display:inline-block;"><a href="<?php echo U('Shop/wakuang',array('id'=>$vo['id']));?>" style=" height:30px;line-height:30px;color: #fff;margin-top: 0px;display:block;position:absolute;right:10px;top:50%;margin-top: -15px;font-size: 16px;padding: 3px 5px;background-color: #3660f0;border: 0px solid #fff;border-radius: 4px;">运行</a></p><?php endif; ?>
	<?php if($vo["zt"] == 1): ?><p style="line-height:70px;text-align:right;width:15%; display:inline-block;"><a href="<?php echo U('Shop/wakuang',array('id'=>$vo['id']));?>" style=" height:30px;line-height:30px;color: #fff;margin-top: -30px;display:block;position:absolute;right:10px;top:30%;margin-top: 0px;font-size:16px;padding: 5px;background-color: #3660f0;border: 0px solid #fff;border-radius: 4px;">查看</a></p><?php endif; ?>			
				<div style="width:60%;display:inline-block;">
					
				</div>

	</li><?php endforeach; endif; else: echo "" ;endif; ?> 
	

	
	
	
	
	
</ul>
<!--会员中心结束-->
<div id="pages"><?php echo ($page); ?></div>
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

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>超市</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="/theme/default/images/favicon.png">
		<link href="/Public/home/css/amazeui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/home/css/style.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
		<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
		<link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
		<script src="/Public/home/js/jquery-1.10.2.min.js"></script>
		<script src="/Public/home/js/time.js"></script>
		<script src="/Public/home/js/search.js"></script>
		<script type="text/javascript" src="/Public/home/js/lazyload.js"></script>
		<style>
			.shop-list-mid .tit a{color: #909090;
    font-size: 1.4rem;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    white-space: normal;
    text-overflow: ellipsis;}
		</style>
	</head>
	<body>
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">MHC商城</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
    </header>
	    <div style="height: 40px;"></div>
	    <ul class="list-nav">
	    	<li class="current"><a href="">综合</a></li>
	    	<li><a href="">销量</a></li>
	    	<li><a href=""><i class="list-price">价格</i></li>
	    	<li><a href="">新品</a></li>
	    </ul>
	    <div class="content-list">
	    	<div class="list-left">
				<?php if(empty($cid)): ?><li><a href="<?php echo U('Shop/search');?>"><font color='#3663F3'>全部</font></a></li>
				<?php else: ?>
					<li><a href="<?php echo U('Shop/search');?>"><font color='#BBB'>全部</font></a></li><?php endif; ?>
				
				<?php if(is_array($classdata)): foreach($classdata as $key=>$vo): if($cid == $vo['cid']): ?><li><a href="<?php echo U('Shop/search',['cid'=>$vo['cid']]);?>"><font color='#3663F3'><?php echo ($vo['cname']); ?></font></a></li>
				<?php else: ?>
					<li><a href="<?php echo U('Shop/search',['cid'=>$vo['cid']]);?>"><font color='#BBB'><?php echo ($vo['cname']); ?></font></a></li><?php endif; endforeach; endif; ?>
	    	</div>
	    	<div class="list-right">
	    		<ul class="list-pro">
				<?php if(is_array($goods_list)): foreach($goods_list as $key=>$ty): ?><li>
	    		<a href="__APP__/index/Shop/index/gid/<?php echo ($ty['gid']); ?>"><img src="/cheng/Public/Goodsuploads/<?php echo ($ty['gpic']); ?>" class="list-pic" /></a>
	    		<div class="shop-list-mid" style="width: 65%;">
                	<div class="tit"><a href="__APP__/index/Shop/index/gid/<?php echo ($ty['gid']); ?>"><?php echo ($ty['gname']); ?></a></div>
                	<div class="am-gallery-desc">MHC币：<?php echo ($ty['spjiage']); ?></div>
                	<p>人民币参考价：<?php echo ($ty['goldprice']); ?></p>
                </div>

	    	</li><?php endforeach; endif; ?>
	    </ul>
	    	</div>
	    </div>
	    
	    <!--底部-->
 <div style="height: 55px;"></div>

 
 
 
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

 
<script src="/Public/home/js/jquery.min.js"></script>
<script src="/Public/home/js/amazeui.min.js"></script>
	</body>
</html>
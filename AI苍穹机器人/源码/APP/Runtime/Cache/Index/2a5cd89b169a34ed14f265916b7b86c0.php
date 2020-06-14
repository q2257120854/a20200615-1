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
		<style>
			.tit{overflow: hidden;}
		</style>
	</head>
	<body>
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">确认订单</span>
    </header>
	    <div style="height: 49px;"></div>

        <div style="background: #eee; height: 10px;"></div>
        <ul class="shopcart-list" style="padding-bottom: 0;">
			<?php if(is_array($cartdata)): foreach($cartdata as $key=>$vo): ?><li>
				<input type="hidden" value="<?php echo ($vo["gid"]); ?>">
                <img src="/Public/Goodsuploads/<?php echo (implode('/60_',explode('/',$vo["gpic"]))); ?>" class="shop-pic" />
                <div class="order-mid">
                	<div class="tit"><?php echo ($vo["gname"]); ?></div>
					<input class="buyprice" type="hidden" value="<?php echo ($vo["goldprice"]); ?>">
					<input class="nums" type="hidden" value="<?php echo ($vo["nums"]); ?>">
                	<div class="order-price">MHC：<?php echo ($vo["spjiage"]); ?> 数量：<?php echo ($vo["nums"]); ?></div>

                </div>

	    	</li><?php endforeach; endif; ?>

	    </ul>
	    <ul class="order-infor">
	    	<li class="order-infor-first">
	    		<span >人民币参考价：</span>
	    		<i ><span id="totalPrice"><?php echo ($jiages); ?></span></i>
	    	</li>
	    	<li class="order-infor-first">
	    		<span >MHC价格：</span>
	    		<i ><span id="totalPrice"><?php echo ($spjiage); ?></span></i>
	    	</li>
	    	<li class="order-infor-first">
	    		<span>运费：</span>
	    		<i><font color="red">与商家协商</font></i>
	    	</li>

	    </ul>
	    <div style="background: #eee; height: 10px;"></div>
	   <form  method="post" action="<?php echo U('Index/Shop/tijiaodingdan');?>" style="margin-bottom:80px;font-size:14px;line-height: 40px" enctype="multipart/form-data">
	   <div class="person_wallet_recharge">
	   <div style="background: #eee; height: 10px;"></div>
		<input type="hidden" name="jiage" value="<?php echo ($spjiage); ?>">
		<input type="hidden" name="gid" value="<?php echo ($gid1); ?>">
		<input type="hidden" name="gname" value="<?php echo ($gname); ?>">
	    <div class="pic">收货人名：&nbsp;&nbsp;&nbsp;<input type="text" placeholder="请输入收货人名称！" name="name" style="height: 30px;line-height: 40px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div>
		<div class="pic">联系电话：&nbsp;&nbsp;&nbsp;<input type="text" placeholder="请输入联系电话！" name="photo" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div>
		<div class="pic">收件地址：&nbsp;&nbsp;&nbsp;<input type="text" placeholder="请输入收件地址！" name="address" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div>
		<div class="pic">交易密码：&nbsp;&nbsp;&nbsp;<input type="password" placeholder="请输入交易密码！" name="password2" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div>
		<div class="pic">备注信息：&nbsp;&nbsp;&nbsp;<input type="text" placeholder="备注信息可选填！" name="remarks" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#3762f2;padding-left: 5px;-webkit-appearance:none;" /></div>
	    <div style="height: 55px;"></div>
	    <div class="shop-fix">
	    	<div class="order-text" id="totalPay_tips">
	    		商品总价（不含运费）：<span id="totalPay"><?php echo ($spjiage); ?></span>
	    	</div>
	    	<button type="submit" class="js-btn">确认支付</button>
	    </div>
	    </div>
		</form>
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
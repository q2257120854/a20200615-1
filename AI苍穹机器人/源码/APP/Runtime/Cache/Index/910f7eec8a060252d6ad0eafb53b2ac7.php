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
		<script>
        	function changeImage(){
              document.getElementById("imgflag").src="/Public/home/images/redherat.png";
           }
        </script>

		<style>
			.am-slider-default .am-control-nav{ text-align: center;}
			.am-slider-default .am-control-nav li a.am-active{ background: #cb2527;}
			.am-slider-default .am-control-nav li a{ border: 0; width: 10px; height: 10px;}
		</style>
	</head>
	<body>
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">商品详情</span>
    </header>
	    <div style="height: 49px;"></div>
	    <!--图片轮换-->
		<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
		  <ul class="am-slides">
		    <li><img src="/cheng/Public/goodsuploads/<?php echo ($sxw_goodsPic[0]); ?>" /></li>
		    <li><img src="/cheng/Public/goodsuploads/<?php echo ($sxw_goodsPic[1]); ?>" /></li>
		    <li><img src="/cheng/Public/goodsuploads/<?php echo ($sxw_goodsPic[2]); ?>" /></li>
		    <li><img src="/cheng/Public/goodsuploads/<?php echo ($sxw_goodsPic[3]); ?>" /></li>
		  </ul>
		</div>
		<div class="detal-info" style="position: relative; width: 100%;">
		<input type="hidden" name="" id="gid" value="<?php echo ($item["gid"]); ?>">
			<p><?php echo ($item["gname"]); ?></p>

			<h2>人民币参考价：<span><?php echo ($item["goldprice"]); ?></span></h2>
			<input id="buyprice" type="hidden" value="<?php echo ($spjiage); ?>">
			<h2>MHC价：<span><?php echo ($spjiage); ?></span></h2>

			<div class="heart">
				<img src="/Public/home/images/herat.png" width="25" id="imgflag" onclick="changeImage()" />
				<p>养生链</p>
			</div>
		</div>
<!-- 		<div class="d-amount">
        	<h4>数量：</h4>
            <div class="d-stock">
              <a class="decrease">-</a>
                <input id="order_num" readonly="" class="text_box" name="" type="text" value="1">

                <a class="increase">+</a>
               <span id="dprice" class="price" style="display:none"> 36</span>
            </div>
        </div> -->
        <div style="background: #eee; height: 10px;"></div>
        <div class="am-tabs detail-list" data-am-tabs>
		  <ul class="am-tabs-nav am-nav am-nav-tabs">
		    <li class="am-active"><a href="#tab1">商品详情</a></li>
		    <li><a href="#tab2">规格参数</a></li>
		  </ul>
		
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active detail " id="tab1" >
		            <p><?php echo (htmlspecialchars_decode($item["gintroduce"])); ?></p>
                    
		    </div>
		    <div class="am-tab-panel am-fade detail " id="tab2">
			<?php echo (htmlspecialchars_decode($item["gspecifications"])); ?>
		    </div>
		  </div>
		</div>
		
		
		<!--底部-->
 <div style=" height: 55px;"></div>
 <ul class="fix-shopping">

	<li><a ytag="23001" href="javascript:alert('亲爱的,恭喜你买到心仪的宝贝,祝您购物愉快!');" class="join" id="btnAddCart">我想对你说</a></li>
 	<li><a href="<?php echo U('Index/Shop/gouwuche',array('gid'=>$item['gid']));?>"  onclick="$('.mod_carttip_close').click()"  class="imm-buy">立即购买</a></li>
 </ul>
  <script>
 		function ajaxhandle(){
			var gid = $('#gid').val();
			var nums = $('#order_num').val();
			var price = $('#buyprice').val();
			$.ajax({
				url:"__CONTROLLER__/gouwuche",
				type:"post",
				data:{gid:gid,nums:nums,price:price},
				// 执行成功执行以下函数，返回值为data
				success:function(data){
					if (data == 1) {
						// 添加购物车成功
						viewCartNums();
						var topcart = $('#btnAddCart').offset().top+60;
						$("#hidecart").css({display:'block',top:topcart});
					}
				}
			});
		}
 </script>
 <script>
	//购物数量加减
	$(function(){
		$('.increase').click(function(){
			var self = $(this);
			var current_num = parseInt(self.siblings('input').val());
			current_num += 1;
			self.siblings('input').val(current_num);
			update_item(self.siblings('input').data('item-id'));
		})		
		$('.decrease').click(function(){
			var self = $(this);
			var current_num = parseInt(self.siblings('input').val());
			if(current_num > 1){
				current_num -= 1;
				self.siblings('input').val(current_num);
				update_item(self.siblings('input').data('item-id'));
			}
		})
	})
</script>

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
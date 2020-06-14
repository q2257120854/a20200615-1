<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>历史开奖记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="/res/touzi/base.css">
    <link rel="stylesheet" href="/res/touzi/style.css">
    <style>
        .flex-cont{
            /*定义为flexbox*/display: -webkit-box;
            display: -webkit-flex;
            display: flex;
        }
        .flex-item{
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
            width: 0%;
        }
        /*导航*/
        .flex-nav{
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            height: 80px;
            line-height: 44px;
            /*定义子元素垂直居中*/
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            /*子元素沿主轴对齐方式均分*/
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            background-color: #000;
            color: #fff;
        }
        .flex-nav .nav-title {
            text-align: center;
            line-height: 1.2;
            width: 0%;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .flex-nav .nav-title p{
            color:#aaa;
            font-size: 12px;
        }
        /*列表*/
        .flex-simple {
            /*定义子元素垂直居中*/
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            padding: 10px 15px;
        }
        .betRecord-ul li{ padding: 5px;  border:1px solid rgba(85, 85, 85, 0.08); margin: 10px; border-right: 5px solid #3D3459; border-radius: 5px; font-size: 15px;}
        .betRecord-ul li:last-child{ border-bottom: none;}
        .s-tit{
            font-size: 14px;
            font-weight: bold;
            color: #353535;
        }
        .s-tit,.s-desc {
            line-height: 1.5;
            font-size: 13px;
        }
        .page a{
            padding: 5px;
        }
        p.p-money{ color: #3D3459; font-weight: 700;}

    </style>
</head>
<body style="background-color: #fff;">
<section>
    <div class="content">
        <ul class="betRecord-ul">
            <div class="lists">
           <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><div class="flex-cont flex-simple"><div class="flex-item s-word"><p class="s-tit">开奖号码：<?php echo ($vo["isid"]); ?></p><p class="s-desc"><?php echo date('Y-m-d H:i',$vo['endtime']);?></p></div><p class="p-money"><?php echo ($vo["id"]); ?>期</p></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
           
        </ul>

<input type="hidden" id="page" value="3">
  <div class="page" style=" padding:10px;margin-bottom: 30px;">
<?php echo ($page); ?>
</div>
</section>

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
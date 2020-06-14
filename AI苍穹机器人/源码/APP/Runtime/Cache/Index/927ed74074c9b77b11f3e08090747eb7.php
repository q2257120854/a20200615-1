<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
   <meta content="telephone=no" name="format-detection">
    <title>转帐记录</title>
    <script src="/Public/btb/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/btb/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/btb/css/jquery-weui.min.css">
    <link href="/Public/btb/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<meta name="__hash__" content="d48f86e015e52fcd2a42243556315aed_7a85c24890d8bce08abc8644bdd9f4a0" /></head>
<style>
.canvas-box {
	position:fixed;
	left:0;
	top:0;
	z-index:-1;
}
</style>
<body>
	<div class="canvas-box"><canvas id="canvas"></canvas></div>
    <!--顶部开始-->
    <header class="header">
        <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
        <span class="header_c">转帐记录</span>
<!-- 		<span style="position: absolute;right: 40px;top: 0px;text-align:center;width:70px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "></span>
        <span class="header_r"><a href="/index.php/Home/Userinfo/index.html"><i class="fa fa-user"></i></a></span> -->
    </header>
    <div class="height40;"></div>
    <!--顶部结束-->
    <!--列表开始-->
<div class="height40"></div>
<style>
.mytable tr td{ padding:10px 0px;}
.aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
.foncus{ background:#385ae8; color:#ffffff;}
.huibtn{ background:#ccc !important; color:#ffffff !important;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">

	<a href="<?php echo U('Index/Financial/kChangeOutList');?>" class='aall'>转出记录</a>
    
    <a href="<?php echo U('Index/Financial/kChangeInList');?>" class='aall foncus' style="margin-right:10px;">转入记录</a>

</div>



<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">

	<table style="width: 90%;margin-left: 5%;color: #333333;border-collapse:collapse;">
        <thead style="font-size: 14px; ">
		
            <tr style="height: 35px;line-height: 35px;">
				 <th  style="border-bottom:2px solid #ddd ">转入时间</th>
                 <th style="border-bottom:2px solid #ddd ">来自对方账户</th>
                 <th style="border-bottom:2px solid #ddd ">转入数量</th>
                 <th style="border-bottom:2px solid #ddd ">留言备注</th>
               
            </tr>

        </thead>
        <tbody style="font-size: 12px;text-align: center" id="content_ajax">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr style="text-align:center" class="includeitem">
                            <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
							<td><?php echo ($vo["outer"]); ?></td>
                            <td><?php echo ($vo["qty"]); ?></td>
                            <td><?php echo ($vo["desc"]); ?></td>
                            
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
 

	<div id="pages">
    	
    	<?php echo ($page); ?>
    	
    </div>
</div>
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
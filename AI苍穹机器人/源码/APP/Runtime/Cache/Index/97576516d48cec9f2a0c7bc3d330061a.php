<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
   <meta content="telephone=no" name="format-detection">
    <title>团队详情</title>
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
    <script src="/Public/gec/web/js/layer.js"></script>
</head>
<body>
<!--顶部开始-->
<div class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">团队详情</span>
		
</div>
<div class="height40"></div>
<style>
.mytable tr td{ padding:10px 0px;}
.aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
.foncus{ background:#3660f0; color:#ffffff;}
.huibtn{ background:#ccc !important; color:#ffffff !important;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">

	<a href="<?php echo U('Index/Account/myAccount');?>" class='aall foncus' style="margin-right:10px;">我的社区</a>
    
    <a href="<?php echo U('Index/Account/memberAccount');?>" class='aall'>社区管理</a>

</div>

<!--顶部结束-->
<ul style="width: 90%;padding: 0 5%;color: #000;background: #faf9fe;">
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%; overflow:hidden;">
           		<span style="display:inline-block;float:left;">社区人数：<?php echo ($userinfo['gamecount']); ?></span>
                <span style="display:inline-block;float:right;">直推人数：<?php echo ($userinfo['parentcount']); ?></span>
            </li>
			<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%;overflow:hidden;">
            	<span style="display:inline-block; float:left;">社区算力：<?php echo ($userinfo['teamgonglv']); ?></span>
                <span style="display:inline-block; float:right;">个人算力：<?php echo ($userinfo['mygonglv']); ?></span>
            </li>
		</ul>
<!--列表开始-->



<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">

    <table style="width: 90%;margin-left: 5%;color: #333333;border-collapse:collapse;">
        <thead style="font-size: 14px; ">
		
            <tr style="height: 35px;line-height: 35px;">
				 <th  style="border-bottom:2px solid #ddd ">我的社区</th>
				 <!--<th style="border-bottom:2px solid #ddd ">正在产币的矿机</th>-->
                 <th style="border-bottom:2px solid #ddd ">等级</th>
                 <th style="border-bottom:2px solid #ddd ">微信号码</th>
                 <th style="border-bottom:2px solid #ddd ">最近登录</th>
               
            </tr>

        </thead>
        <tbody style="font-size: 12px;text-align: center" id="content_ajax">
		 <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="text-align:center" class="includeitem">
                            <td>会员: <?php echo ($v["truename"]); ?></td>
                           <!-- <td><?php echo ($v["zheng"]); ?>台</td>-->
							<td><?php echo group($v['level']);?></td>
                            <td><?php echo ($v["weixin"]); ?></td>
                            <td><?php echo (friend_date($v["logintime"])); ?></td>
                            
            </tr><?php endforeach; endif; ?> 		

        </tbody>
    </table>

	<div id="pages">
    	
    	<?php echo ($page); ?>
    	
    </div>
</div>
<style>.weui_media_box:before {left:0}</style>
<!--列表结束-->

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

<!--底部结束-->
<!-- <script src="/Public/js/scrollpagination.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
      $('#content_ajax').infinitescroll({
	       navSelector:"#pages",
		   nextSelector:"#next",
		   itemSelector:".includeitem"
	 });

});
  
</script>-->
</body>
</html>
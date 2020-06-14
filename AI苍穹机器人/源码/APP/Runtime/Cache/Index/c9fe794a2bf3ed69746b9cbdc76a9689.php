<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
    <meta content="telephone=no" name="format-detection">
    <title>激活码转账</title>
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
    <span class="header_c">我的激活码</span>

</div>
<div class="height40"></div>

<style>
    .mytable tr td{ padding:10px 0px;}
    .aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
    .foncus{ background:#3660f0; color:#ffffff;}
    .huibtn{ background:#ccc !important; color:#ffffff !important;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">

    <a href="<?php echo U('Index/Dai/daik');?>" class='aall' style="margin-right:10px;">申请贷款</a>

    <a href="<?php echo U('Index/Dai/daiklog');?>" class='aall foncus'>审批记录</a>

</div>

<!--顶部结束-->
<!--列表开始-->
<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">


    <table style="width: 90%;margin-left: 5%;color: #fff;margin-top: 20px;border-collapse:collapse;">
        <thead style="font-size: 12px; ">

        <tr style="height: 35px;line-height: 35px;">
            <th  style="border-bottom:2px solid #ddd ">序号</th>
            <th  style="border-bottom:2px solid #ddd ">贷款额度</th>
            <th style="border-bottom:2px solid #ddd ">冻结额度</th>
            <th style="border-bottom:2px solid #ddd ">审批额度</th>

            <th style="border-bottom:2px solid #ddd ">审核状态</th>
        </tr>

        </thead>
        <tbody style="font-size: 10px;text-align: center" id="content_ajax">
        <?php if(is_array($dkmember)): foreach($dkmember as $key=>$v): ?><tr style="text-align:center" class="includeitem">
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["jinbi"]); ?></td>
                <td><?php echo ($v["dyjinbi"]); ?></td>
                <td><?php echo ($v["spjinbi"]); ?></td>

                <td>
                    <?php if($v['status'] == 0): ?><font style="color:#eafff1;">未审核</font><?php endif; ?>
                    <?php if($v['status'] == 1): ?><font style="color:#fd0b0b;">已通过</font><?php endif; ?>
                    <?php if($v['status'] == 2): ?><font style="color:#a1ea2b;">已拒绝</font><?php endif; ?>

                </td>
            </tr><?php endforeach; endif; ?>

        </tbody>
    </table>

    <div id="pages"><?php echo ($page); ?></div>
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
<!--<script src="/Public/js/scrollpagination.js" type="text/javascript"></script>

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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
   <meta content="telephone=no" name="format-detection">
    <title>矿机收益</title>
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
    <script src="/Public/js/layer/layer.js"></script>
</head>
<body>
<!--顶部开始-->
<div class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">矿机收益</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
</div>
<div class="height40"></div>
<!--顶部结束-->
<!--列表开始-->
<style>
.mytable tr td{ padding:10px 0px;}
.aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
.foncus{ background:#3660f0; color:#ffffff;}
.huibtn{ background:#ccc !important; color:#ffffff !important;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">

	<a href="<?php echo U('Index/Financial/ksList',array('zt'=>1));?>" class='aall <?php if($zt == 1): ?>foncus<?php endif; ?>' style="margin-right:10px;">运行中的矿机</a>
    
    <a href="<?php echo U('Index/Financial/ksList',array('zt'=>2));?>" class='aall <?php if($zt == 2): ?>foncus<?php endif; ?>'>已停止的矿机</a>

</div>

<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">
    <table style="width: 90%;margin-left: 5%;color: #333333;margin-top: 20px;border-collapse:collapse;" class="mytable">
        <thead style="font-size: 12px; ">
		
            <tr style="height: 35px;line-height: 35px;">
				<th  style="border-bottom:2px solid #ddd ">名称</th>
				<th style="border-bottom:2px solid #ddd ">编号</th>
                <th style="border-bottom:2px solid #ddd ">已运行</th>
                <th style="border-bottom:2px solid #ddd ">已获得</th>
                  <th style="border-bottom:2px solid #ddd ">操作</th>
               
            </tr>

        </thead>
        <tbody style="font-size: 12px;text-align: center">
			
 <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tr style="text-align:center">
                <td><?php echo ($v["project"]); ?></td>
                <td><?php echo ($v["kjbh"]); ?></td>
                
                <td>
                 <?php if($v['zt'] == 1): echo (set_number($v["a_time"],'0')); ?>小时
                  <?php else: ?>
                  	  --<?php endif; ?>
               </td>
                <td><?php echo (four_number($v["already_profit"])); ?></td>
                <td>
                
                <?php if($v['zt'] == 1): ?><a href="javascript:;"  <?php if($v['is_jiesuan'] == 0): ?>class="huibtn"<?php endif; ?> onClick="jiesuan(<?php echo ($v["id"]); ?>)" style="padding:3px 5px; background:#3660f0; color:#FFFFFF; border-radius:4px;">结算收益</a>
                <?php else: ?>
                	---<?php endif; ?>
                
                
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
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>


<script type="text/javascript">

	


	function jiesuan(id){
				$.ajax({
							url:'<?php echo U("Index/Index/jiesuan");?>',
							type:'POST',
							data:{id:id},
							dataType:'json',
							success:function(json){
								
								 layer.msg(json.info);
								 if(json.result==1){
									window.location.reload();	 
								 }
								 		
								
							},
							error:function(){
								
								layer.msg('网络故障！');	
							}
								
							
						})
			
		
	}

	


</script>











</body>
</html>
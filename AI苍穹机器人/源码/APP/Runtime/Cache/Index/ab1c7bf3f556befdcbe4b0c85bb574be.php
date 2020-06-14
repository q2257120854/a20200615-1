<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title>个人中心</title>	
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/Public/gec/web/js/layer.js"></script>
	<link rel="stylesheet" href="/Public/gec/web/css/stylef.css"/>
	
	

</head>

<body>
	<!--顶部开始-->
	<header class="header">
		<span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
		<span class="header_c">矿机商城</span>
			<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
	</header>
<!-- 	<div class="height40"></div> -->
	<!--顶部结束-->
<style>
      .hh_btn{
          float: right !important;
          padding: 0 !important;
          display: block;
          height: 20px;
          margin: 5px;
          width: 60px;
          background-color: #3660f0;
          border: 0;
          border-radius: 5px;
          color: #FFF;
      }
      .zz_btn{
          height: 20px;
          width: 150px;
          margin:5px;
          background-color: #3660f0;
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
		
		
         <?php
 if(C('recharge_is') ==1){ ?>
    
        <div style="width:80%; border-radius:4px; margin:0 auto;"><a href="<?php echo U('Index/Index/recharge');?>" style="width:100%; padding:3px 5px; color:#ffffff; background:#00CD00; display:inline-block; border-radius:4px; text-align:center; font-size:14px;">矿&nbsp;&nbsp;机&nbsp;&nbsp;限&nbsp;&nbsp;时&nbsp;&nbsp;抢&nbsp;&nbsp;购</a></div>
         <?php }else{?>
         
         	<div style=" width:100%; height:35px;"></div>
         
         <?php }?>
        				
                        
                        
                        
                        
                        <!--<span style="font-size:12px;margin-left:1%;text-align:;center;color:red;">新会员完善银行信息后可在此免费购买微型矿机一台</span>-->
        <ul class="dd_list"；style="margin-bottom:80px;">
		
		
		<?php if(is_array($typeData)): foreach($typeData as $key=>$ty): ?><li style="position:relative;">
				<img src=<?php echo ($ty["thumb"]); ?> />                                                                                                                                               

				<div style="width:60%;display:inline-block;">
					<p><b><?php echo ($ty["title"]); ?></b>
                                        <p>兑换单价：<?php echo ($ty["price"]); ?>MHC</p>
					<P>产量/1小时：<?php echo ($ty["shouyi"]); ?></P>
					<P>矿机算力：<?php echo ($ty["gonglv"]); ?>GH/s</P>
					<P>运行周期：<?php echo ($ty["yszq"]); ?>小时</P>
				</div>
					 <a href="<?php echo U('Index/Shop/pcontent',array('id'=>$ty['id']));?>" style="color: #fff;margin-top: 0px;display:block;position:absolute;right:10px;top:50%;margin-top: -15px;font-size: 16px;padding: 5px;background-color: #3660f0;border: 0px solid #fff;border-radius: 4px;">兑换</a>
				</button><?php endforeach; endif; ?>	
				
				
					 

				
				</ul>
	<!--会员中心结束-->

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
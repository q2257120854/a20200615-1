<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<title>MHC首页</title>
	<script src="/Public/btb/js/jquery-1.8.3.min.js"></script>
	<link rel="stylesheet" href="/Public/btb/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/btb/css/jquery-weui.min.css">
	<link href="/Public/btb/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/btb/sy/css/reset.css">
    <link rel="stylesheet" href="/Public/btb/sy/css/style.css">
    <script type="text/javascript" src="/Public/btb/sy/js/TouchSlide.1.1.js"></script>
	<script src="/Public/btb/js/layer.js"></script>
</head>
<body>
	<!--顶部开始-->
	<header class="header">
		<span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
		<span class="header_c">MHC首页</span>
		<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($userData['ue_truename']); ?></span>
		<span class="header_r"><a href="/Index.php/Home/Index/index/"><i class="fa fa-user"></i></a></span>
	</header>
	<div class="height40"></div>
<div id="slideBox" class="slideBox">
      <div class="bd">
        <ul>
		<?php if(is_array($banner_list)): foreach($banner_list as $key=>$vo): ?><li>
              <a class="pic" href="#"><img src="<?php echo ($vo['path']); ?>" style="height:300 px;"/></a>
            </li><?php endforeach; endif; ?>
        </ul>
      </div>
      <div class="hd">
        <ul></ul>
      </div>
    </div>
<style>
.leat { border-top:1px solid #336be8;}
.panel_hd  {
	background-color: transparent;
    font-size: 15px;
    height: 55px;
    line-height: 55px;
    background: url(/Public/btb/img/title.png) no-repeat center;
    background-size: 70% 70%;
    padding: 0;
    text-align: center;
	color:#336be8;
}
.leat {height:80px;}
.leat img {width:31%; height:70px; float:left;}
.leat p {
	text-indent:10px;
	color:#627bfc; 
	font-size:16px; 
	font-weight:bold;
	display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    white-space: normal;
    text-align: left;
	width:100%;
}
.leat .sgd {
	width:90%;
	margin:10px 5%;
	border-bottom:1px solid #336be8;
	padding-bottom:10px;
}
.qingiumask {
	position:fixed;
	top:0;
	left:0;
	background:rgba(255,255,255,0.3);
	z-index:999;
	display:none;
	width:100%;
	height:100%;
}
.qiugoutan {
	position:fixed;
	top:15%;
	width:86%;
	left:5%;
	background:#fff;
	border-radius:5px;
	height:auto;
	overflow:hidden;
	z-index:10000;
	display:none;
	padding:10px;
}
.spans{
	position:fixed;
	right:4px;
	top:13%;
	background:#2954b4;
	color:#fff;
	font-size:15px;
	padding:3px 9px;
	border-radius:100px;
	display:none;
	z-index:100001;
}
.qiugoutan h2 {
	text-align:center;
	font-size:20px;
	color:#333;
}
.qiugoutan .p_time {
	text-align:center;
	font-size:12px;
	color:#777;
	width:100%;
	
}
.qiugous {
}
</style>
<div class="leat">
	<div class="panel_hd">最新资讯</div>
	<div class="">
	<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="sgd" data-contents='<?php echo ($v["content"]); ?>' data-theme='<?php echo ($v["title"]); ?>' data-time="<?php echo (date("Y-m-d",$v["addtime"])); ?>" >
		<p><?php echo ($v["title"]); ?></p>
		<p style="color:#fff; font-weight:400; margin-top:3px; font-size:12px"><?php echo (date("Y-m-d",$v["addtime"])); ?></p>
	</div><?php endforeach; endif; ?>
	</div>
	<!-- <div class="qingiumask"></div> -->
			<span class="spans">X</span>
	<div class="qiugoutan">
		<div class="qiugous">
			<h2 class="theme">biaodegds</h2>
			<p class="p_time">2018-15 000</p>
			<div class="contents">gsdgdfhbfghbfgbfg</div>
		</div>
	</div>
		<script>
	$(".sgd").click(function(){
		var time=$(this).data('time');
		var contents=$(this).data('contents');
		var theme=$(this).data('theme');
		$('.theme').html(theme);
		$('.contents').html(contents);
		$('.p_time').html(time);
		$(".spans").show();
		$(".qiugoutan").show();
	})
	$(".spans").click(function(){
		$('.theme').html('');
		$('.contents').html('');
		$('.p_time').html('');
		$(".spans").hide();
		$(".qiugoutan").hide();
	})
	
	</script>
	<script>
		function showhidediv(id) {
			console.log(id);
			var qiugou = document.getElementById("qiugou");
			var zhengzai = document.getElementById("chushou");
			var qiugoubg = document.getElementById("qiugou_list");
			var zhengzaibg = document.getElementById('chushou_list');
			if (id == "qiugou") {
				zhengzai.style.display = 'none';
				qiugou.style.display = 'block';
				qiugoubg.style.backgroundColor = "rgba(22, 41, 102,0.6)"
				qiugoubg.style.color = "#627bfc"
				zhengzaibg.style.backgroundColor = "none";
				zhengzaibg.style.color = "#fff";
			}else if(id=='chushou'){
				zhengzai.style.display = 'block';
				qiugou.style.display = 'none';
				qiugoubg.style.backgroundColor = "none";
				qiugoubg.style.color = "#fff";
				zhengzaibg.style.backgroundColor = "rgba(22, 41, 102,0.6)";
				zhengzaibg.style.color = "#627bfc";
			}
		}
	</script>

    <script type="text/javascript">
      TouchSlide({
        slideCell:"#slideBox",
        titCell:"#slideBox .hd ul",
        mainCell:"#slideBox .bd ul",
        effect:"leftLoop",
        autoPage:true,
        autoPlay:true,
        interTime:3000

      });
    </script>
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

	<!--底部结束-->
	<script src="/Public/btb/js/jquery-weui.min.js"></script>
	<p style="display:none;">

</p>
</body>
</html>
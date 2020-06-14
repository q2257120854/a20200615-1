<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0057)http://4.sxhengtaiweiye.com.cn/index.php/index/shop/plist -->
<html class="pixel-ratio-1"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link type="text/css" rel="stylesheet" href="/Public/dianyun/css1/lib.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    <title>租赁机器人</title>


    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

</head>

<body>

  <body onload="onload()" class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main" data-page="coin">
        <div class="pages">
          <link rel="stylesheet" href="/Public/dianyun/css/chat.css">

<div data-page="coin" class="page navbar-fixed toolbar-fixed" isinited="true">
    <div class="navbar theme-white">
        <div class="navbar-inner">
            <div class="left">
                <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
            </div>
            <div class="center" style="left: -24px;">购买机器人</div>
            <div class="right"></div>
        </div>
    </div>

    <div class="page-content">
        <div class="coin-topbg">
            <div class="row">
            <div class="page toolbar-fixed">
                <div style="height:50px;"></div>
                <ul class="dd_list">
                    <?php if(is_array($typeData)): foreach($typeData as $key=>$v): ?><li style="position:relative;">
                            <img src="<?php echo ($v["thumb"]); ?>">
                            <div style="width:60%;display:inline-block;">
                                <p><b><?php echo ($v["title"]); ?></b>
                                </p><p>单价：<?php echo ($v["price"]); ?></p>
                                <p>每小时：<?php echo ($v["shouyi"]); ?></p>
                                <p>限购数量：<?php echo ($v["xiangou"]); ?></p>
                                <p>剩余总量：<?php echo ($v["stock"]); ?></p>
                            </div>
                            <a href="<?php echo U('Robot/buy',array('id'=>$v['id']));?>" style="color: #fff;margin-top: 0px;display:block;position:absolute;right:10px;top:50%;margin-top: -15px;font-size: 16px;padding: 5px;background-color: #20548a;border: 0px solid #fff;border-radius: 4px;">租赁</a>
                        </li><?php endforeach; endif; ?>
                </ul>

            </div>
            </div>
        </div>
        <div class="space-10 bg-gray"></div>


    </div>








</body></html>
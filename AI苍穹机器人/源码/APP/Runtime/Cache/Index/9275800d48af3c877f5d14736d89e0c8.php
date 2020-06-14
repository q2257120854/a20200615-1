<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>领金币</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


  </head>
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
            <div class="center" style="left: -24px;">领金币</div>
            <div class="right"></div>
        </div>
    </div>

    <div class="page-content">
        <div class="coin-topbg">
            <div class="row">
                <div class="col-50" style="text-align: center; ">
                    <img src="/Public/dianyun/img/coin.png" style="width:100px; height: auto; margin-top:25px;">
                </div>
                <div class="col-50">
                    <h3><?php echo ($jifen); ?><span>金币</span></h3>
                </div>
            </div>
        </div>
        <div class="space-10 bg-gray"></div>

        <div class="content-block" style="margin: 15px 0;">
            <div class="row">
                <div class="col-50 h-jgg">
                    <a class="external" href="<?php echo U('Index/Task/duihuan');?>">
                        <div class="h-icon"><img src="/Public/dianyun/img/coin-01.png" style="width:50%;"></div>
                        <div class="h-text">金币兑换</div>
                    </a>
                </div>

                <div class="col-50 h-jgg">
                    <a class="external" href="<?php echo U('Index/index/fenxiang');?>">
                        <div class="h-icon"><img src="/Public/dianyun/img/coin-02.png" style="width:50%;"></div>
                        <div class="h-text">发圈领金币</div>
                    </a>
                </div>

                <div class="col-50 h-jgg">
                    <a class="external" href="<?php echo U('Index/Task/complete');?>">
                        <div class="h-icon"><img src="/Public/dianyun/img/coin-03.png" style="width:50%;"></div>
                        <div class="h-text">上传截图</div>
                    </a>
                </div>

                <div class="col-50 h-jgg">
                    <a class="external" href="<?php echo U('Index/Task/completelog');?>">
                        <div class="h-icon"><img src="/Public/dianyun/img/coin-04.png" style="width:50%;"></div>
                        <div class="h-text">金币记录</div>
                    </a>
                </div>
            </div>

        </div>

        <div class="space-10 bg-gray"></div>
        <div class="area-20">
            <div class="row">
                <div class="col-100">
                    <label class="bold">1、金币有什么作用？</label>
                    <p>金币满<?php echo ($duihuan); ?>个即可兑换一台AI机器人，每天为你赚取600-2000个点击流量。</p>
                    <label class="bold">2、如何领取金币？</label>
                    <p>通过“发圈领金币”中获取发圈图片，并发布到您的朋友圈保留两个小时以上，然后截图上传，公司平台审核后，即可获得随机数量的金币。</p>
                </div>
            </div>
        </div>

    </div>


    <div class="toolbar tabbar tabbar-labels">
        <div class="toolbar-inner">
            <a href="<?php echo U('Index/New/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-home-01.png">
                <span class="tabbar-label">首页</span>
            </a>
            <a href="<?php echo U('Index/Robot/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-robot-01.png">
                <span class="tabbar-label">机器人</span>
            </a>
            <a href="<?php echo U('Index/Task/index');?>" class="tab-link external active">
                <img src="/Public/dianyun/img/tab-coin.png">
                <span class="tabbar-label">领金币</span>
            </a>
            <a href="<?php echo U('Index/Wallet/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-account-01.png">
                <span class="tabbar-label">我的</span>
            </a>
        </div>
    </div>


</div>



</body></html>
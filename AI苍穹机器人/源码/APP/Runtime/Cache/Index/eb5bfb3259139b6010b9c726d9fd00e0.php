<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>项目说明</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


  </head>
  <body onload="onload()" class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main">
        <div class="pages">
          <div class="page navbar-fixed">
    <div class="navbar theme-white">
        <div class="navbar-inner">
            <div class="left">
                <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft"></i>返回</a>
            </div>
            <div class="center" style="left: -24px;">项目说明</div>
            <div class="right"></div>
        </div>
    </div>

    <div class="page-content">
        <div class="content-block">
            <div class="row center">
                <h5 id="lblTitle" class="headerText"><?php echo ($new["title"]); ?></h5>
            </div>

            <div class="space-20"></div>
            <div class="content-text" id="lblContent" style="line-height:200%;"><p><?php echo ($new["content"]); ?></p></div>
        </div>

    </div>

</div>

        </div>
      </div> 
    </div> 
  




</body></html>
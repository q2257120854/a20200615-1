<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>帮助中心</title>

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
            <div class="center" style="left: -24px;">帮助中心</div>
            <div class="right"></div>
        </div>
    </div>

    <div class="page-content infinite-scroll">
        
        <div class="list-block">
            <ul id="noticelist">
                <?php if(is_array($new)): foreach($new as $key=>$v): ?><li><a href="<?php echo U('Index/New/xiangqing',array('id'=>$v['id']));?>" class="item-link item-content external">
                <div class="item-media"><i class="icon iconfont icon-play"></i></div>
                <div class="item-inner">
                    <div class="item-title"><?php echo ($v["id"]); ?>、<?php echo ($v["title"]); ?></div>
                </div></a></li><?php endforeach; endif; ?>
            </ul>
        </div>

        <div class="infinite-scroll-preloader hide">
            <div class="preloader"></div>
        </div>
    </div>

</div>


        </div>
      </div> 
    </div> 
  


</body></html>
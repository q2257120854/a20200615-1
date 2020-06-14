<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>邀请好友</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
    <div class="view view-main" data-page="myextend">
        <div class="pages">
            <div data-page="myextend" class="page navbar-fixed" isinited="true">
                <div class="navbar theme-white">
                    <div class="navbar-inner">
                        <div class="left">
                            <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
                        </div>
                        <div class="center" data-i18n="member.myinfo" style="left: 11px;">分享赚钱</div>
                        <div class="right"><a href="javascript:doMyextend_share()" class="external link">分享给好友</a></div>
                    </div>
                </div>

                <div class="page-content center">
                    <img id="sharedImg" src="<?php echo ($erwei); ?>" style="width:auto; max-width: 100%; height: auto; max-height: 100%;">
                </div>


            </div>


        </div>
    </div>
</div>


</body></html>
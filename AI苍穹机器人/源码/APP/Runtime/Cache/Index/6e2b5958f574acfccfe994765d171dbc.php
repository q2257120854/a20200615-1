<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>分享</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
    <div class="view view-main" data-page="myextendex">
        <div class="pages">
            <style>
                h5 {margin:  4px; margin-top: 10px;}
            </style>

            <div data-page="myextendex" class="page navbar-fixed" isinited="true">
                <div class="navbar theme-white">
                    <div class="navbar-inner">
                        <div class="left">
                            <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
                        </div>
                        <div class="center" data-i18n="member.myinfo" style="left: -10px;">我的推广图片</div>
                        <div class="right"><a href="javascript:doMyextendImage_share()" class="external link">分享</a></div>
                    </div>
                </div>

                <div class="page-content center">
        <div class="share-tips">
            请点击“放大”，截屏图片保存到相册，并复制广告内容，并通过微信客户端分享到您的朋友圈。
        </div>

                    <div class="area-10">

                        <div class="row">
                            <div class="col-20">&nbsp;</div>
                            <div class="col-60">
                                <h5 id="exTitle1">我的推广二维码&nbsp;&nbsp;<a class="blue" href="javascript:viewMyImage(0)">[放大]</a></h5>
                                <div>
                                    <img id="exImage1" class="myExImage" data-tag="" src="<?php echo ($erwei); ?>" style="width:100%;">
                                </div>
                            </div>
                            <div class="col-20">&nbsp;</div>
                        </div>

                        <div class="row">
                            <div class="col-50">
                                <h5 id="exTitle2">宣传页一&nbsp;&nbsp;<a class="blue" href="javascript:viewMyImage(1)">[放大]</a></h5>
                                <div>
                                    <img id="exImage2" class="myExImage" data-tag="" src="/Public/dianyun/img/27ad3fc0de4da8115591fcb8e3134cd7.jpg" style="width:100%;">
                                </div>
                            </div>
                            <div class="col-50">
                                <h5 id="exTitle3">宣传页二&nbsp;&nbsp;<a class="blue1" href="javascript:viewMyImage(2)">[放大]</a></h5>
                                <div>
                                    <img id="exImage3" class="myExImage" data-tag="" src="/Public/dianyun/img/6d89924e65a1d3317f0f2aa90fa55c4f.jpg" style="width:100%;">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="divHelps" style="display: none;">
                        <div class="space-20"></div>
                        <div class="space-10 bg-gray"></div>
                        <div class="space-40"></div>

                        <div class="area-10">
                            <h5>发圈流程图：</h5>
                            <img src="/Public/dianyun/img/faquanmoban1.jpg" style="width:100%; ">
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<script type="text/javascript" src="/Public/tg/framework7.min.js"></script>

<script type="text/javascript" src="/Public/tg/app.js"></script>
<script type="text/javascript" src="/Public/tg/main.js" id="js_main"></script>

<script type="text/javascript" src="/Public/tg/xb-webapp-0.1.js"></script>

</body></html>
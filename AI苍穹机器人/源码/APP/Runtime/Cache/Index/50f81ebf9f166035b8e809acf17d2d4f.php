<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <script src="/public/wx/td/js/mui.min.js"></script>
    <link href="/public/wx/td/css/mui.min.css" rel="stylesheet" />
    <link href="/public/wx/td/css/style.css" rel="stylesheet" />
    <link href="/public/wx/css/style.css" rel="stylesheet" />
    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
    <link rel="stylesheet" href="/public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/public/wx/css/reset.css">
    <link rel="stylesheet" href="/public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/public/wx/css/style.css">
    <script src="/public/wx/js/adaptive.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        adaPtive(); //铺页面调用
        //页面加载时调用
        $(function() { direction(); });
        //用户变化屏幕方向时调用
        $(window).on('orientationchange', function(e) { direction(); });
        //调用adaptive
        function adaPtive(max) { window['adaptive'].desinWidth = 720;
            window['adaptive'].baseFont = 24;
            window['adaptive'].scaleType = 1;
            window['adaptive'].maxWidth = max;
            window['adaptive'].init(); }
        //判断手机屏幕方向
        function direction() { if (window.orientation == 90 || window.orientation == -90) { adaPtive(320); return false; } else if (window.orientation == 0 || window.orientation == 180) { adaPtive(); return false; } }
    </script>
</head>

<body ontouchstart>
<div class="wx-header clearfix flex">
    <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">团队详情</h1>

</div>
<div class="mui-content padding4 bgpink">
    <div id="slider" class="mui-slider jxslider" >
        <div class="mui-slider-group mui-slider-loop">
            <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
            <!-- 第一张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
            <!-- 第二张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
            <!-- 第三张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
            <!-- 第四张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
            <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="/public/wx/images/swiper_banner.jpg">
                </a>
            </div>
        </div>
        <div class="mui-slider-indicator">
            <div class="mui-indicator mui-active"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
        </div>
    </div>

    <div   class="mui-slider kechengsbox">
        <div   class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted kcsidertop">
            <div class="mui-control-item mui-active"><a href="<?php echo U('Index/index/team');?>">一代</a></div>
            <div class="mui-control-item mui-active mui-active"><a href="<?php echo U('Index/index/team1');?>">二代</a></div>
            <div class="mui-control-item mui-active"><a href="<?php echo U('Index/index/team2');?>">三代</a></div>
        </div>
        <div class="mui-slider-group kcslidermain">
            <div class="mui-slider-item mui-control-content mui-active">
                <ul class="mui-table-view kcslidermainli">
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><li class="mui-table-view-cell"><span class="mbiaoqian bg1"><?php echo ($v["id"]); ?></span><?php echo ($v["truename"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($v["username"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="mui-badge mui-badge-inverted kcjiage"><i>￥</i> <?php echo ($v["money"]); ?></span>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>

        </div>
    </div>

</div>

<div class="weui-tabbar">
    <a href="<?php echo U('Index/new/index');?>" class="weui-tabbar__item">
        <!--   <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span> -->
        <div class="weui-tabbar__icon zx">
            <img src="/public/wx/images/tarbar_zx.png" alt="">
        </div>
        <p class="weui-tabbar__label">资讯</p>
    </a>
    <a href="<?php echo U('Index/task/index');?>" class="weui-tabbar__item">
        <div class="weui-tabbar__icon rw">
            <img src="/public/wx/images/tarbar_rw.png" alt="">
        </div>
        <p class="weui-tabbar__label">任务</p>
    </a>
    <a href="<?php echo U('Index/robot/index');?>" class="weui-tabbar__item">

        <div class="weui-tabbar__icon wj">
            <img src="/public/wx/images/tarbar_earth.png" alt="">
        </div>
        <p class="weui-tabbar__label">智能机器人</p>
    </a>
    <a href="<?php echo U('Index/index/index');?>" class="weui-tabbar__item  weui-bar__item--on">
        <div class="weui-tabbar__icon me">
            <img src="/public/wx/images/tarbar_me_on.png" alt="">
        </div>
        <p class="weui-tabbar__label">我</p>
    </a>
</div>

</body>
<script>
    var gallery = mui('#slider');
    gallery.slider({
        interval:1000//自动轮播周期，若为0则不自动播放，默认为0；
    });
</script>
</html>
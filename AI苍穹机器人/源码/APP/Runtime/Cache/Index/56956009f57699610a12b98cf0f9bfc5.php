<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head design-width="750">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>余额明细</title>
    <link rel="stylesheet" href="/public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/public/wx/css/reset.css">
    <link rel="stylesheet" href="/public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/public/wx/css/style.css">

    <link rel="stylesheet" href="/public/wx/ye/css/style.css"/>
    <link rel="stylesheet" href="/public/wx/ye/css/data.css"/>
    <link href="/public/wx/ye/css/iconfont/Rjdaoico.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <script type="text/javascript" src="/public/wx/ye/js/slider.js"></script>
    <!--下拉动画-->
    <link rel="stylesheet" href="/public/wx/ye/css/animate.min.css"/>
    <script type="text/javascript" src="/public/wx/ye/js/wow.min.js"></script>
    <script>
        if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
            new WOW().init();
        };
        $(function(){

        });
    </script>
    <!--下拉动画-->
    <script type="text/javascript">
        function timer(opj){
            $(opj).find('ul').animate({
                marginTop : "-3.0rem"
            },500,function(){
                $(this).css({marginTop : "0.0rem"}).find("a:first").appendTo(this);
            })
        }
        $(function(){
            var num = $('.notice_active').find('a').length;
            if(num > 1){
                var time=setInterval('timer(".notice_active")',3500);
                $('.gg_more a').mousemove(function(){
                    clearInterval(time);
                }).mouseout(function(){
                    time = setInterval('timer(".notice_active")',3500);
                });
            }

            $(".news_ck").click(function(){
                location.href = $(".notice_active .notice_active_ch").children(":input").val();
            })
        });
    </script>


    <script src="/public/wx/lib/jquery-2.1.4.js"></script>
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
    <h1 class="flex-1">余额明细</h1>
</div>


<div class="datamain">
    <div class="h-height"></div>
    <!---头部 结束 --->

    <!---数据转盘 开始--->
    <div class="data-turntable wow zoomIn">
        <div class="Mod xzleft">
            <div class="Mod1"></div>
            <div class="Mod2 xzleft"></div>
            <div class="Mod3"></div>
            <div class="Mod4 xzleft"></div>
            <div class="text">当前余额</div>
            <div class="num" id="sx2"><?php echo ($money); ?></div>
        </div>
    </div>


    <div class="data-juan-list">
        <?php if(is_array($list)): foreach($list as $key=>$v): ?><a class="item-name">
                <div class="coml wow slideInRight">
                    <span><?php echo (date('Y-m-d',$v["addtime"])); ?></span>
                    <dl><?php echo ($v["desc"]); ?></dl>
                </div>
                <div class="comr">
                    <span class="wow slideInLeft">￥<?php if($v["adds"] == 0.00): ?>-<?php echo (two_number($v["reduce"])); else: ?>+<?php echo (two_number($v["adds"])); endif; ?></span>
                </div>
            </a><?php endforeach; endif; ?>
    </div>
</div>


</body>
<!--  weui-tabbar -->
<div class="weui-tabbar">
    <a href="<?php echo U('Index/new/index');?>" class="weui-tabbar__item">
        <!--   <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span> -->
        <div class="weui-tabbar__icon zx">
            <img src="/public/wx/images/tarbar_zx.png" alt="">
        </div>
        <p class="weui-tabbar__label">资讯</p>
    </a>
    <a href="<?php echo U('Index/Robot/pcontent',array('id'=>1));?>" class="weui-tabbar__item">
        <div class="weui-tabbar__icon rw">
            <img src="/public/wx/images/tarbar_rw.png" alt="">
        </div>
        <p class="weui-tabbar__label">租赁机器人</p>
    </a>
    <a href="<?php echo U('Index/task/index');?>" class="weui-tabbar__item">
        <div class="weui-tabbar__icon wj">
            <img src="/public/wx/images/tarbar_earth.png" alt="">
        </div>
        <p class="weui-tabbar__label">任务圈</p>
    </a>
    <a href="<?php echo U('Index/index/index');?>" class="weui-tabbar__item  weui-bar__item--on">
        <div class="weui-tabbar__icon me">
            <img src="/public/wx/images/tarbar_me_on.png" alt="">
        </div>
        <p class="weui-tabbar__label">我</p>
    </a>
</div>
<!--  weui-tabbar -->
<script type="text/javascript">
    $('.inform-list ul li').click(function(){
        var n=$(this).index();
        $(this).addClass('acti').siblings().removeClass('acti');
        $('.inform-text').fadeOut();
        $('.inform-text').eq(n).fadeIn();
    })
</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>任务详情</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="/public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/public/wx/css/reset.css">
    <link rel="stylesheet" href="/public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/public/wx/css/style.css">
    <script src="/public/wx/lib/jquery-2.1.4.js"></script>
    <script src="/public/wx/js/adaptive.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        adaPtive(); //铺页面调用
        //页面加载时调用
        $(function() { direction(); });
        //用户变化屏幕方向时调用
        $(window).on('orientationchange', function(e) { direction(); });
        //调用adaptive
        function adaPtive(max) {
            window['adaptive'].desinWidth = 720;
            window['adaptive'].baseFont = 24;
            window['adaptive'].scaleType = 1;
            window['adaptive'].maxWidth = max;
            window['adaptive'].init();
        }
        //判断手机屏幕方向
        function direction() { if (window.orientation == 90 || window.orientation == -90) { adaPtive(320); return false; } else if (window.orientation == 0 || window.orientation == 180) { adaPtive(); return false; } }
    </script>
</head>

<body ontouchstart>
<div class="wx-header clearfix flex">
    <h1 class="flex-1">任务详情</h1>
    <div class="wx-header-right" id="showMoreLink">
        <i class="iconfont icon-jia"></i>
    </div>
</div>
<!--me-main -->
<div class="weui-msg info-main clearfix">


    <div class="info-silder clearfix">
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide"><img src="<?php echo ($list["image"]); ?>" /></div>
                <div class="swiper-slide"><img src="<?php echo ($list["image1"]); ?>" /></div>
                <div class="swiper-slide"><img src="<?php echo ($list["image2"]); ?>" /></div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

    </div>
    <!--列表开始-->
    <div style="text-align:center;padding-bottom:80px">
        <p><textarea id="copy-num" readonly style="width: 90%;height: 200px;margin-top: 20px;border: 1px solid #39393d;"><?php echo ($list["content"]); ?></textarea></p>

        <p style="margin:20px 0px;">
            <span class="" onclick="jsCopy()" style="cursor:pointer;padding: 18px 10px;color:#FFFFFF;background: #39393d;border-radius: 10px;width: 80%;display:inline-block;margin:0 auto;">复制</span></p>

    </div>
    <!-- moreLink -->
    <div class="moreLink">
        <ul class="morelink-ul">
            <li><a href=""><img src="/public/wx/images/moreLink_msg.png" alt=""><p>发起群聊</p></a></li>
            <li><a href=""><img src="/public/wx/images/moreLink_add.png" alt=""><p>添加朋友</p></a></li>
            <li><a href=""><img src="/public/wx/images/moreLink_sys.png" alt=""><p>扫一扫</p></a></li>
            <li><a href=""><img src="/public/wx/images/moreLink_pay.png" alt=""><p>收付款</p></a></li>
        </ul>
    </div>
    <!-- moreLink -->
</div>
<!--me-main -->
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
    <a href="<?php echo U('Index/task/index');?>" class="weui-tabbar__item  weui-bar__item--on">
        <div class="weui-tabbar__icon wj">
            <img src="/public/wx/images/tarbar_earth_on.png" alt="">
        </div>
        <p class="weui-tabbar__label">任务圈</p>
    </a>
    <a href="<?php echo U('Index/index/index');?>" class="weui-tabbar__item">
        <div class="weui-tabbar__icon me">
            <img src="/public/wx/images/tarbar_me.png" alt="">
        </div>
        <p class="weui-tabbar__label">我</p>
    </a>
</div>
<!--  weui-tabbar -->

<script src="/public/wx/lib/fastclick.js"></script>
<script type='text/javascript' src='/public/wx/js/swiper.js' charset='utf-8'></script>
<script>
    $(function() {
        FastClick.attach(document.body);
        $("#showMoreLink").on('click',function(){
            $(".moreLink").toggle("fast");
        });
        $(".swiper-container").swiper({
            loop: true,
            autoplay: 3000
        });
    });
</script>
<script src="/public/wx/js/jquery-weui.js"></script>
<script type="text/javascript">
    function jsCopy(){
        var e=document.getElementById("copy-num");//对象是copy-num1
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令

        alert('复制成功');

    }


</script>
</body>

</html>
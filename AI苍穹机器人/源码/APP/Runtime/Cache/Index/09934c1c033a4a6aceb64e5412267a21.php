<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>机器人
<html>

<head>
    <title>我</title>
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
    <h1 class="flex-1">我</h1>
    <div class="wx-header-right" id="showMoreLink">
        <i class="iconfont icon-jia"></i>
    </div>
</div>
<!--me-main -->
<div class="weui-msg me-main clearfix">
    <div class="weui-cells" style="margin-top: 0">
        <a class="weui-cell head-cells weui-cell_access" href="<?php echo U('Index/index/personal');?>">
            <div class="weui-cell__hd"><img src="<?php echo ($minfo["pic"]); ?>" alt=""></div>
            <div class="weui-cell__bd flex flex-v">
                <p><?php echo ($minfo["truename"]); ?></p>
                <p>账号：<?php echo (yc_phone($minfo["username"])); ?></p>
            </div>
            <div class="weui-cell__ft">
                <img src="/public/wx/images/me_erwema.jpg" alt="">
            </div>
        </a>
    </div>
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/wallet/index');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_plate.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>钱包</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/msg/addMsg');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_collect.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>聊天室</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/index/team');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_photo.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>我的团队</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/index/tgm');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_card.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>我要推广</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/index/updatepass');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_smile.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>密码设置</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="<?php echo U('Index/index/logout');?>">
            <div class="weui-cell__hd"><img src="/public/wx/images/me_set.png" alt=""></div>
            <div class="weui-cell__bd">
                <p>退出登录</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <!-- moreLink -->
    <div class="moreLink">
        <ul class="morelink-ul">
            <li><a href="<?php echo U('Index/msg/addMsg');?>"><img src="/public/wx/images/moreLink_msg.png" alt=""><p>发起群聊</p></a></li>
            <li><a href="<?php echo U('Index/robot/rank');?>"><img src="/public/wx/images/moreLink_add.png" alt=""><p>排行榜</p></a></li>
            <li><a href="javascript:alert(&#39;当前已是最新版本！&#39;);"><img src="/public/wx/images/moreLink_sys.png" alt=""><p>版本更新</p></a></li>
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

<script src="/public/wx/lib/fastclick.js"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
        $("#showMoreLink").on('click',function(){
            $(".moreLink").toggle("fast");
        })
    });
</script>
<script src="/public/wx/js/jquery-weui.js"></script>
</body>

</html>
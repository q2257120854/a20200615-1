<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>充值记录</title>
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

<body ontouchstart style="background: #fff;">
<div class="wx-header clearfix flex">
    <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">充值记录</h1>
</div>

<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">
    <table style="width: 90%;margin-left: 5%;color: #f10101;margin-top: 50px;border-collapse:collapse;" class="mytable">
        <thead style="font-size: 12px; ">

        <tr style="height: 35px;line-height: 35px;">
            <th  style="border-bottom:2px solid #ddd ">流水号</th>
            <th style="border-bottom:2px solid #ddd ">金额</th>
            <th style="border-bottom:2px solid #ddd ">支付时间</th>
            <th style="border-bottom:2px solid #ddd ">充值方式</th>
        </tr>

        </thead>
        <tbody style="font-size: 12px;text-align: center">

        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="height: 35px;line-height: 35px;">
                <td><?php echo ($v["pay_no"]); ?></td>

                <td><?php echo ($v["money"]); ?></td>
                <td><?php echo (date('Y-m-d',$v["pay_time"])); ?></td>
                <?php if($v['type'] == 1): ?><td>支付宝</td><?php endif; ?>
                <?php if($v['type'] == 3): ?><td>微信</td><?php endif; ?>
            </tr><?php endforeach; endif; ?>

        </tbody>
    </table>

</div>



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
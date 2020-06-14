<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>充值卡充值</title>
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
    <h1 class="flex-1">充值卡充值</h1>
</div>

<form action="<?php echo U('Index/wallet/pinrechargepost');?>" method="POST" id="form1" style="font-size:14px; padding-bottom:26px;">
    <ul style="width: 90%;padding:5% 5%;color: #2f2d2d;padding-top:65px" >
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">当前余额：</span><?php echo ($money); ?>&nbsp;&nbsp;元</li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">充值卡号：</span><input type="txt" placeholder="请输入充值卡卡号" id="pin" name="pin"  style="height: 30px;line-height: 30px;width: 65%;border-radius: 4px;border: none; background:rgb(239, 239, 239);padding-left: 5px;-webkit-appearance:none; color:#39393d;"></li>
        <li style="margin-top:20px;"><input type="button" name="submit" clicked="0"  value="提交" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#39393d;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;"/></li>
        <li style="margin-top:10px;"><span style="color:red">友情提示：如果您没有购买充值卡，可联系客服进行购买。</span></li>
    </ul>
</form>




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
<script>
    $("input[name='submit']").click(function(){
        var btn = $("input[name='submit']");
        if(btn.attr("clicked") == "1"){
            return ;
        }
        btn.attr("clicked","1");
        var pin = $("input[name='pin']").val();
        if(pin == ''){
            $.alert('请输入充值卡卡号');
            btn.attr("clicked","0");
            return ;
        }


        $.showLoading("正在提交");
        $.ajax({
            url:"<?php echo U('Index/wallet/pinrechargepost');?>",
            type:"post",
            data:$("#form1").serialize(),
            dataType:"json",
            success:function(data){
                if(data.status==1){
                    $.alert(data.info,function(){
                        window.location = "<?php echo U('Index/wallet/pinrechargepost');?>";
                    })
                }else{
                    $.alert(data.info);
                    btn.attr("clicked","0");
                }
            },error:function(){
                $.alert("网络错误");
                btn.attr("clicked","0");
            },complete:function(){
                $.hideLoading();
            }
        })
        return false;
    })
</script>
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
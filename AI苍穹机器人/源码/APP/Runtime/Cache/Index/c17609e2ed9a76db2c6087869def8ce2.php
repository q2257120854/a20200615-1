<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection" />
    <script src="/public/wx/bd/js/jquery-1.8.3.min.js"></script>
    <script src="/public/wx/bd/js/layer/layer.js"></script>
    <link href="/public/wx/bd/css/style.css" rel="stylesheet" type="text/css">


    <title>添加银行卡</title>

    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                    recalc = function () {
                        var clientWidth = docEl.clientWidth;
                        if (!clientWidth) return;
                        if(clientWidth>=750){
                            docEl.style.fontSize = '100px';
                        }else{
                            docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                        }
                    };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    </script>

</head>

<body>
<div id="Nav_bar">
    <div class="left"><a href="#"  onclick="history.go(-1)"><img src="/public/wx/bd/img/left_arrow.png"></a></div>
    <div class="center">添加银行卡</div>
    <div class="right"></div>
</div>
<!--中间内容部分-->
<form action="" method="POST" style="font-size:14px"  id="myform1">
    <div id="content">
        <div class="txt01">银行名称
            <select name="id" style="line-height: 30px;border-radius: 5px;border:none;color:#eee; background:#b96262;padding-left: 5px;" />
            <option value="">请选择银行</option>
            <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select></div>
        <div class="txt01">真实姓名：<?php echo ($truename); ?></div>
        <div class="txt01">银行卡号：<input type="text" id="card" name="card" placeholder="请输入银行卡号"></div>
        <div class="txt01">备注说明：<span>银行卡必须与注册时填写的真实姓名一致，因不一致造成提现不到账概不负责！</span></div>

        <input type="button"  class="r_but" value="提交" idtype="myform1"style="width: 100%;line-height: 30px;border-radius: 5px;border: 0px; background-color:#39393d;margin-top: 60px;color: #FFFFFF;-webkit-appearance: none;">
    </div>

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



<script type="text/javascript">
    $(".r_but").click(function(){
        var idtype=$(this).attr("idtype");
        $.ajax({
            url:'<?php echo U("Index/wallet/addcardpost");?>',
            type:'POST',
            data:$("#"+idtype).serialize(),
            dataType:'json',
            success:function(json){
                layer.msg(json.info);
                if(json.result ==1){
                    window.location.href=json.url;
                }


            },
            error:function(){

                layer.msg("网络故障");
            }



        })

    })


</script>

</body>
</html>
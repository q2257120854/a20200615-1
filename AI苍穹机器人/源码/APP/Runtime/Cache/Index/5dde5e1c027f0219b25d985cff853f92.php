<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0019)http://2.js-css.cn/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no">
    <title>全民一猜</title>

    <link rel="stylesheet" href="/res/touzi/base.css">
    <link rel="stylesheet" href="/res/touzi/layer.css">
    <link rel="stylesheet" href="/res/touzi/layer2.css">
    <link rel="stylesheet" href="/res/touzi/style.css">
    <link rel="stylesheet" href="/res/touzi/weui.css">
    <style>

        .close-play{
            position: absolute;
            bottom: 10px;
            left: 35%;
            padding: 0px 40px;
            font-size: 13px;
            background-image: linear-gradient(307deg, #347189, #55784e);
        }

        .bigAndSmall{
            display: inline-block;
            text-decoration: none;
            color: #E4C468;

            border-radius: 5px;
            width: 100%;
        }
        .top-a{
            text-decoration: none;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 10px 10px;
            font-size: 12px;
            display: inline-block;
            margin-top: -20px;
            letter-spacing: 1px;
            background-color: rgba(208, 107, 125, 0.3);
            box-shadow: 0 0 5px 0 rgba(61, 52, 89, 0.3);
        }
        .wrap-a-bigAndSmall{
            text-align: center;
            width: 100%;
            font-size: 18px;
            margin: 8px;
            background-color: #999;
            background-image: -webkit-linear-gradient(hsla(0,0%,100%,.05), hsla(0,0%,0%,.1));
            background-image:    -moz-linear-gradient(hsla(0,0%,100%,.05), hsla(0,0%,0%,.1));
            background-image:     -ms-linear-gradient(hsla(0,0%,100%,.05), hsla(0,0%,0%,.1));
            background-image:      -o-linear-gradient(hsla(0,0%,100%,.05), hsla(0,0%,0%,.1));
            background-image:         linear-gradient(hsla(0,0%,100%,.05), hsla(0,0%,0%,.1));
            border: none;
            border-radius: .5em;
            box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.2),
            inset 0 2px 0 hsla(0,0%,100%,.1),
            inset 0 1.2em 0 hsla(0,0%,100%,0.1),
            inset 0 -.2em 0 hsla(0,0%,100%,.1),
            inset 0 -.25em 0 hsla(0,0%,0%,.25),
            0 .25em .25em hsla(0,0%,0%,.05);
            color: #444;
            cursor: pointer;
            display: inline-block;
            font-family: sans-serif;
            font-size: 1em;
            font-weight: bold;
            line-height: 1.5;
            margin: 0 .5em 1em;
            padding: 40px 0;
            position: relative;
            text-decoration: none;
            text-shadow: 0 1px 1px hsla(0,0%,100%,.25);
            vertical-align: middle;
            background-image: radial-gradient(circle at 60% 48%, #9a5656, #351818);
            color: #fff;
            font-weight: bold;
        }

        .wrap-a-span{
            font-weight: bold;
            font-size:30px;
            text-align: center;
            color: #E4C468;
        }


        .jetton-img{ width: 100px; height: 100px; cursor: pointer;}

        .weui-flex__item{
            margin-bottom: 10px;
        }
        /*文字滚动样式*/
        .sliderbox{position:relative;}/*必须加这句css,否则向左右，上下滚动时会没有效果*/
        .text{  height: 30px;  width: 320px;  overflow: hidden;  margin: 0 auto;  position: absolute;  z-index: 999;  top: 17px;  left: 45px;   color: #E4C468;  }
        .text li{line-height:30px; height: 30px; width: 330px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis;}
        .text li a{  color: #E4C468;}

        @media screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2){
            .wrap-a-bigAndSmall{font-size: 18px;}
            .top-a{    margin-top: -30px;  margin-bottom: -7px;}
        }

        @media screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2){
            .weui-flex__item{
                margin: 6px;
            }
        }
        @media screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3){
            .weui-flex__item{
                margin: 4px;
            }
            .text{left:50px; top:20px;}
        }


        /*支付方式 微信 ---- 余额 样式*/
        .mgr {  position: relative;  width: 16px;  height: 16px;  background-clip: border-box;  -webkit-appearance: none;  -moz-appearance: none;  appearance: none;  margin: -.15px .6px 0 0;
            vertical-align: text-bottom;  border-radius: 50%;  background-color: #fff;  border: 1px solid #d7d7d7;  }
        .mgr-danger {  background-color: #fff;  border: 1px solid #d7d7d7;  }
        .mgr-lg {  width: 19px;  height: 19px;  }
        .mgr-danger:checked {  border: 1px solid #cf3b3a;  }
        .mgr:checked {  border: 1px solid #555;  }
        .mgr-lg:checked:before {  height: 11px;  width: 11px;  border-radius: 50%;  margin: 3px 0 0 3px;  }
        .mgr-danger:checked:before {  background-color: #cf3b3a;  }
        .mgr:checked:before {  height: 10px;  width: 10px;  border-radius: 50%;  margin: 3px 0 0 3px;  }
        .mgr:before {  content: '';  display: block;  height: 0;  width: 0;  -webkit-transition: width .25s,height .25s;  transition: width .25s,height .25s;  }
        .pay{ text-align: center;  margin: 5px;  color: #fff;  font-size: 14px;}

        .fontSize{ color: #fff; font-size: 15px; display: block;  margin-top: -5px; }


        .topInfo{
            text-align: center;
            background-image: radial-gradient(circle at 60% 48%, #9a5656, #351818);
            margin: 5px 0;
            color: #fff;
            letter-spacing: 1px;
            box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.2),
            inset 0 2px 0 hsla(0,0%,100%,.1),
            inset 0 1.2em 0 hsla(0,0%,100%,0.1),
            inset 0 -.2em 0 hsla(0,0%,100%,.1),
            inset 0 -.2em 0 hsla(0,0%,0%,.25),
            0 .25em .2em hsla(0,0%,0%,.05);
        }

        /*缩放效果*/
        .scaleTips{
            -webkit-animation: open 0.2s linear 0.5s infinite alternate;
            -webkit-animation-timing-function: cubic-bezier(0.25, 0.1, 0.25, 1);
            animation: open 0.2s linear 0.5s infinite alternate;
            animation-timing-function: cubic-bezier(0.25, 0.1, 0.25, 1);
            color:#E4C468;
            font-size: 13px;
            transition: all 0.2s ease-in-out;
        }
        @keyframes open { 0% {  transform: scale(1);  } 100% {  transform: scale(0.9);  } }
        @-webkit-keyframes open { 0% {  -webkit-transform: scale(1);  } 100% {  -webkit-transform: scale(0.9);  } }
        @-ms-keyframes open { 0% {  -webkit-transform: scale(1);  } 100% {  -webkit-transform: scale(0.9);  } }
        @-moz-keyframes open { 0% {  -webkit-transform: scale(1);  } 100% {  -webkit-transform: scale(0.9);  } }
        @-o-keyframes open { 0% {  -webkit-transform: scale(1);  } 100% {  -webkit-transform: scale(0.9);  } }

        .getKjHb-div{
            background: url(/Public/Home/images/hongbao/alertHb.png) no-repeat;
            background-size: contain;
            width: 345px;
            height: 380px;
        }
        .getKjHb-a{
            width: 60%;
            border: 1px solid #fff;
            color: #E4C468;
            font-size: 20px;
            font-weight: 700;
            position: relative;
            bottom: -200px;
        }
        .getKjHb-p{
            position: relative;
            top: 85px;
            color: #E4C468;
            font-size: 25px;
            text-align: center;
        }
        .text{
            z-index: 10;
        }
        .text li,.text{
            width: 100%;
            left: 0;
            text-align: center;
        }
    </style>
    <meta name="poweredby" content="besttool.cn">

</head>
<body style="background-color:#250A00;">
<!-- background-image: radial-gradient(circle, #bc40fe, #22291d); -->
<header style=" background: url(/res/touzi/bg.jpg) no-repeat; background-size: cover;">
    <!--  <a href="javascript:;" id="getAward" class="top-a " style="position:absolute; top: 90px; left: 20px;">领取连赢红包</a> -->
    <a href="javascript:;" id="getAward" class="top-a " style="position:absolute; top: 90px; left: 10px;">在线人数:<script language="javascript">var a=parseInt(1500+(Math.random()*1000))+"人";document.write(a);</script></a>
    <a href="<?php echo U('Index/Shai/playlog');?>" id="getAward" class="top-a " style="position:absolute; top: 90px; left: 278px;">投注记录</a> <div class="weui-flex topInfo">


    <div class="weui-flex__item" style=" border-right: 1px solid rgba(153, 153, 153, 0.38);">
        <p>距离开奖时间</p>
        <p id="second_show" style="color:#FFC107;"><span id="miao">00</span>秒</p>
    </div>

    <div class="weui-flex__item">
        <p>上期开奖结果</p>
        <p id="kjResult" style="color:#FFC107;">第<?php echo ($lilist["id"]); ?>期:<?php echo ($lilist["isid"]); ?>点,<?php if($lilist['isid']<=3){ echo '小';}else{ echo '大';}?></p>
    </div>
</div>

    <!--<a href='/User/back.html' class='top-a' style="position:absolute; top: 90px; right: 25px;">收藏游戏</a>-->
    <div class="weui-flex"><!-- style="background: url(/Public/Home/images/bg7.png) no-repeat center; background-size: contain;" -->
        <div class="weui-flex__item" style="margin: 10px auto;">
            <div class="wrap">
                <div class="dice dice_<?php echo ($lilist["isid"]); ?>" id="dice" style="cursor: pointer;"></div>
            </div>
        </div>
    </div>

    <div class="weui-flex" style="text-align: center;margin-top: 15px;">
        <div class="weui-flex__item"> <a href="<?php echo U('Index/Shai/lishi');?>" id="history" class="top-a">历史记录</a></div>
        <div class="weui-flex__item">
            <div class="top-a">
                <div style="color:#fff">最后压注：<span class="type" id="show_number" style="color:#FFF201"> <?php if($mybuy['buyid']){ if($mybuy['buyid']<=6){echo $mybuy['buyid'] ;}elseif($mybuy['buyid']==7){ echo '大';}else{ echo '小';} }else{ echo '无';}?>  </span></div>
                <div style="color:#fff">筹码数：<span class="chouMaNum" id="show_money" style="color:#FFF201"><?php if($mybuy['money']){ echo $mybuy['money']; }else{ echo '0';}?></span></div>
            </div>
        </div>
        <div class="weui-flex__item"><span id="tips" class="top-a" onclick="shuoming();">游戏说明</span></div>
    </div>



</header>
<div class="layui-layer layui-layer-dialog layer-anim" id="layui-layer1" type="dialog" times="1" showtime="0" contype="string" style="z-index: 19891015; top: 213px; left: 50px;display: none;"><div class="layui-layer-title" style="cursor: move;">信息</div><div id="" class="layui-layer-content layui-layer-padding"></div><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;" style="font-size: 26px;margin-top: -10px" onclick="queding()">x</a></span><div class="layui-layer-btn layui-layer-btn-"><a class="layui-layer-btn0" onclick="queding()">确定</a></div><span class="layui-layer-resize"></span></div>

<img src="/res/touzi/457684782019572638.jpg" style="width: 90%;max-width: 400px;left:5%;top: 70px;display: none;position: fixed;z-index: 999;" class="shuoming" onclick="guanming()">
<section style="background-color:#250A00; height: auto; margin-bottom: 50px; position: relative;">
    <figure><img src="/res/touzi/tree.png" style="width: 100%;height: 60px"></figure>
    <div class="content">
        <div class="text" id="text-slideTo">
            <ul class="sliderbox">
                <li class="current" style="z-index: 2;"><a href="javascript:;"><?php echo ($yxgg); ?></a></li>

            </ul>
        </div>
    </div>
    <div class="weui-flex" style="margin-top:10px;">
        <div class="weui-flex__item wrap-a-bigAndSmall"><span onclick="select_num(7)" class="bigAndSmall" id="big" data-num="1"><span class="wrap-a-span">大</span><br><span class="fontSize">1赔1.9</span></span></div>
        <div class="weui-flex__item wrap-a-bigAndSmall"><span onclick="select_num(8)" class="bigAndSmall" id="small" data-num="1"><span class="wrap-a-span">小</span><br><span class="fontSize">1赔1.9</span></span></div>
    </div>
    <div class="forms">
        <div class="weui-flex">
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(1)" > <span class="wrap-a-span">1</span><br /><span class="fontSize">1赔5</span></span></div>
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(2)"> <span class="wrap-a-span">2</span><br /><span class="fontSize">1赔5</span></span></div>
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(3)"> <span class="wrap-a-span">3</span><br /><span class="fontSize">1赔5</span></span></div>
        </div>
        <div class="weui-flex">
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(4)"> <span class="wrap-a-span">4</span><br /><span class="fontSize">1赔5</span></span></div>
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(5)"> <span class="wrap-a-span">5</span><br /><span class="fontSize">1赔5</span></span></div>
            <div class="weui-flex__item wrap-a-bigAndSmall" onclick="select_num(6)"> <span class="wrap-a-span">6</span><br /><span class="fontSize">1赔5</span></span></div>
        </div>
    </div>
</section>

<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
<style>
	.footer ul li{
		width: 20%;
	}
</style>
	<div class="footer">
    <ul>
        <li><a href="<?php echo U('Index/Emoney/shouye');?>" class="block"><i class="iconfont">&#xe63a;</i>首页</a></li>
		<li><a href="<?php echo U('Index/Shop/shop');?>" class="block"><i class="iconfont">&#xe645;</i>购物商城</a></li>
		<li><a href="<?php echo U('Index/Shop/plist');?>" class="block"><i class="iconfont">&#xe604;</i>矿机商城</a></li>
		<li><a href="<?php echo U('Index/Emoney/index');?>" class="block"><i class="iconfont">&#xe608;</i>交易中心</a></li>
        <li><a href="<?php echo U('Index/Index/index');?>" class="block"><i class="iconfont">&#xe684;</i>个人中心</a></li>
    </ul>
</div>
	<!--底部结束-->
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>	


<div id="buy" style="display: none;">
    <div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index:19891014; background-color:rgba(0, 0, 0, 0.2); opacity:0.9; filter:alpha(opacity=90);display: none;"></div>
    <div class="layui-layer layui-layer-page yourclass layer-anim" id="layui-layer1" type="page" times="1" showtime="0" contype="string" style="z-index: 19891015; top: 100.5px; left: 0px;width:100%">
        <div id="" class="layui-layer-content" style="width:100%"><div style=" background-color:rgba(0, 0, 0, 0.59);border-radius: 10px;">
            <div class="weui-flex" id="img" style="">
                <div class="weui-flex__item" onclick="buy_goods(10)">
                    <a href="javascript:void(0);" data-num="10">
                        <img src="/res/touzi/jetton-10.png" data-num="10" class="jetton-img">
                    </a>
                </div>
                <div class="weui-flex__item" onclick="buy_goods(20)">
                    <a href="javascript:void(0);" data-num="20">
                        <img src="/res/touzi/jetton-20.png" data-num="20" class="jetton-img">
                    </a>
                </div>
                <div class="weui-flex__item" onclick="buy_goods(50)">
                    <a href="javascript:void(0);" data-num="50">
                        <img src="/res/touzi/jetton-50.png" data-num="50" class="jetton-img">
                    </a>
                </div>

            </div>
            <div class="weui-flex">
                <div class="weui-flex__item" onclick="buy_goods(100)">
                    <a href="javascript:void(0);" data-num="100">
                        <img src="/res/touzi/jetton-100.png" data-num="100" class="jetton-img">
                    </a></div>

                <div class="weui-flex__item" onclick="buy_goods(150)">
                    <a href="javascript:void(0);" data-num="150">
                        <img src="/res/touzi/jetton-150.png" data-num="150" class="jetton-img">
                    </a>
                </div>
                <div class="weui-flex__item" onclick="buy_goods(200)">
                    <a href="javascript:void(0);" data-num="200">
                        <img src="/res/touzi/jetton-200.png" data-num="200" class="jetton-img">
                    </a>
                </div>

            </div>
            <div class="weui-flex">

                <div class="weui-flex__item" onclick="buy_goods(500)">
                    <a href="javascript:void(0);" data-num="500">
                        <img src="/res/touzi/jetton-500.png" data-num="500" class="jetton-img">
                    </a>
                </div>
                <div class="weui-flex__item" onclick="buy_goods(1000)">
                    <a href="javascript:void(0);" data-num="1000">
                        <img src="/res/touzi/jetton-1000.png" data-num="1000" class="jetton-img">
                    </a>
                </div>
                <div class="weui-flex__item" onclick="buy_goods(2000)">
                    <a href="javascript:void(0);" data-num="2000">
                        <img src="/res/touzi/jetton-2000.png" data-num="2000" class="jetton-img">
                    </a>
                </div>

            </div>
            <p style="text-align: center; color: #fff; font-size: 15px;">本次押注：<span id="ya">大</span></p>
            <div class="pay"><span>支付方式：</span>
                 <input onclick="buytype(2)" type="radio" name="pay" checked="" class="mgr mgr-danger mgr-lg" value="2"> 账户余额 </div>
            <div style="float: left; margin: 0 0 0 80px;"><a href="javascript:void(0);" class="weui-btn weui-btn_mini weui-btn_primary">请选择下注金额</a> </div>
            <div style="float: right; margin: 0 80px 0 0;;"><span class="weui-btn weui-btn_mini weui-btn_primary" onclick="hide()">取消</span></div></div></div><span class="layui-layer-setwin"></span><span class="layui-layer-resize"></span></div><div class="layui-layer-move"></div>


</div>
<input value="0" class="ispay" type="hidden">
<input value="0" class="yanum" type="hidden">
<input value="2" class="buytype" type="hidden">
<script type="text/javascript" src="/res/touzi/jquery-1.7.2-min.js"></script>
<script type="text/javascript" src="/Public/js/jquery-1.7.2-min.js"></script>
<script>
    // 通用ajax表单提交
    function ajaxFormSubmit(seletor){
        if(!seletor || seletor == '')seletor = "form";
        data = $(seletor).serialize();
        layer.load(0, {shade: [0.1,'#fff']});
        $.post($(seletor).attr('action'),data,function(data){
            layer.closeAll();
            _index = layer.msg(data.info);
            if(data.url && data.url != ''){
                // 延迟一秒钟跳转
                setTimeout(function(){
                    location.href = data.url;
                },1000)
            }
            else{
                setTimeout(function(){
                    layer.close(_index);
                },3000)
            }
        })
    }


    layer.loading = function(param){


        layer.load(0, {shade: false});


        //var par =$.extend({},{type: 2,shadeClose:false},param);


        //layer.open(par)


    }


</script>


<script type="text/javascript">
    function buy_goods(money){
        var ispay = $(".ispay").val();
        if(ispay == 0){
            $(".ispay").val(1);
            var yanum = $(".yanum").val();
            var buytype =  $(".buytype").val();
            $.post("/index.php/Index/Shai/cai",{money:money,yanum:yanum,buytype:buytype,uid:'{$id}'},function(d){
                $(".ispay").val(0);
                if(d.status==1){
                        alert(d.info);
                        location.href="/index.php/Index/Shai/index";
                }else if (d.status==2){
                    alert(d.info);
                    location.href="/index.php/Index/Emoney/index";
                }else{
                    alert(d.info);
                }

            });
        }
    }
    function buytype(id){
        $(".buytype").val(id);
    }
    function select_num(num){
        $('.yanum').val(num);
        if(num<=6){
            $("#ya").html(num+'点');
        }
        if(num==7){
            $("#ya").html('大');
        }
        if(num==8){
            $("#ya").html('小');
        }
        $("#buy").show();
    }
    function select_daxiao(type){
        $("#buy").show();
    }
    function queding(){
        $("#layui-layer").hide();
        location.href="/index.php/Index/Shai/index";
    }
    function shuoming(){
        $(".shuoming").show();
    }
    function hide(){
        $("#buy").hide();
    }
    function guanming(){
        $(".shuoming").hide();
    }
    var wait= <?php echo ($miao); ?>;
    //var wait= 10;
    time();
    function time() {

        if (wait == 0) {


            setTimeout(function() {
                        jieshu();
                    },
                    2000);

            $("#second_show").html('正在开奖中...');

            setInterval(function queding(){
                $("#layui-layer").hide();
                //  return;
                location.href="/index.php/Index/Shai/index";
            },20*1000);
        } else {
            wait--;
            var miao = wait;
            if(wait<10){
                miao ='0' + wait;
            }
            $('#miao').html(miao);
            setTimeout(function() {
                        time();
                    },
                    1000);
        }
    }
    function runDice(num){
        var dice = $("#dice");
        dice.attr("class","dice");//清除上次动画后的点数
        dice.css("cursor","default");
        $(".wrap").append("<div id='dice_mask'></div>");//加遮罩
        // var num = Math.floor(Math.random()*6+1);//产生随机数1-6
        dice.animate({left: '+2px'}, 100,function(){
            dice.addClass("dice_t");
        }).delay(200).animate({top:'-2px'},100,function(){
            dice.removeClass("dice_t").addClass("dice_s");
        }).delay(200).animate({opacity: 'show'},600,function(){
            dice.removeClass("dice_s").addClass("dice_e");
        }).delay(100).animate({left:'-2px',top:'2px'},100,function(){
            dice.removeClass("dice_e").addClass("dice_"+num);
            $("#result").html("您掷得点数是<span>"+num+"</span>");
            dice.css('cursor','pointer');
            $("#dice_mask").remove();//移除遮罩
        });

    }

    function jieshu(){
        $.post('/index.php/Index/Shai/kai/?id=<?php echo ($kailist["id"]); ?>',{},function(data){

            if(data){
                if(data.isid<=3){
                    var name = '小';
                }else{
                    var name = '大';
                }
                if(data.type == 1){
                    var all ='您本期未投注，本期共有'+data.cainum+'人下注，其中'+data.zhongnum+'人中奖，赶紧看准时机下注赚钱吧！';
                }else{
                    if(data.money >0){
                        var all ='恭喜您在'+data.id+'期中奖，获得奖金'+data.money+'个币！好棒哦，继续加油哦！';
                    }else{
                        var all ='这次猜错了哦，失败是成功之母，继续努力哦！';
                    }
                }
                runDice(data.isid);
                setInterval(function(){
                    $(".layui-layer-content").html('第'+data.id+'期:'+data.isid+'点,'+name+"<br>"+all);
                    $("#second_show").html(data.isid+'点,'+name);
                    $(".layui-layer").show();
                    $(".dice").removeClass('dice_3');
                    $(".dice").addClass('dice_'+data.isid);
                },5000)



            }else{
                setTimeout('jieshu()',1000);
            }
        },"json");
        /*
         setInterval(function queding(){
         $("#layui-layer").hide();
         //  return;
         location.href="/";
         },10*1000);
         */
    }
    function alertOk(period,number,name,x){
        $(".layui-layer-content").html('第'+period+'期:'+number+'点,'+name+"<br>"+all);
        $("#second_show").html(number+'点,'+name);
        $(".layui-layer").show();
        $(".dice").removeClass('dice_'+x);

        $(".dice").addClass('dice_'+period);
    };

</script>
</body></html>
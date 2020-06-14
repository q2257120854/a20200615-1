<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
    <title>我要转帐</title>
    <script src="/Public/btb/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/btb/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/btb/css/jquery-weui.min.css">
    <link href="/Public/btb/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">

    <link rel="stylesheet" href="/Public/btb/css/styles.css"/>
    <script src="/Public/btb/js/layer.js"></script>
    <script>
        var money = <?php echo ($jinbi); ?>;
		var myname = "<?php echo ($user["username"]); ?>"; 
        var rate = <?php echo ($feil); ?>;
        function clcAmount(){
            var amount = $("[name='outmoney").val();
            var tax = amount*rate;
            var fact_money = parseFloat(amount)+parseFloat(tax);
            $("#tax").html(new Number(tax).toFixed(8));
            $("#fact_money").html(new Number(fact_money).toFixed(8));
        }

    </script>

<meta name="__hash__" content="61805a6acecdc009908bb25bd1d43f9d_0ea909b50ec85486245cf61bd2d6afb4" /></head>
<style>
.canvas-box {
	position:fixed;
	left:0;
	top:0;
	z-index:-1;
}
</style>
<body>
	<div class="canvas-box"><canvas id="canvas"></canvas></div>
<!--顶部开始-->
<!--顶部开始-->
<header class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">我要转帐</span>
<!-- 	<span style="position: absolute;right: 40px;top: 0px;text-align:center;width:70px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "></span>
    <span class="header_r"><a href="/index.php/home/userinfo/index.html/"><i class="fa fa-user"style="margin-right: -20px"></i></a></span> -->
</header>
<div class="height40"></div>
<!--顶部结束-->
<!--顶部结束-->
    <form action="<?php echo U('Index/Financial/kchange');?>" method="POST" id="form1" style="font-size:14px; padding-bottom:26px;">
        <ul style="width: 90%;padding:5% 5%;color: #2f2d2d;padding-top:65px" >
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">可用MHC：</span><?php echo ($jinbi); ?></li><input type="hidden" value="<?php echo (session('username')); ?>" name="outusername">
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">对方账号：</span><input type="txt" placeholder="请输入对方账号" id="inusername" name="inusername" onkeyup="clcAmount()"  required="required" style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"></li>
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">转帐数量：</span><input type="txt" placeholder="请输入转帐数量" id="outmoney" name="outmoney" onkeyup="clcAmount()"  required="required" style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"></li>
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">手续费：</span><span id="tax">0.00000000</span>&nbsp;&nbsp;&nbsp;&nbsp;转帐手续费率:<?php echo ($feilv); ?>%
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">实际扣减：</span><span id="fact_money">0.00000000</span></li>
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">留言备注：</span><input type="txt" placeholder="请输入留言备注" name="desc" required="required"  style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;">
            <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">安全密码：</span><input type="password" placeholder="请输入安全密码" name="safe" required="required"  style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;">
            </li>
<!--             <li class="code" style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">验证码：</span><input type="text" placeholder="请输入验证码" name="code" required="required" id="phone" style="height: 30px;line-height: 30px;width: 30%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"><span class="fr" style="background-color: #d9534f;display: inline-block;width: 30%;text-align: center;font-size: 1em;padding: 2px 0px;border-radius: 5px; color:#fff; font-size:13px;line-height: 26px;margin-left: 1%;">发送验证码</span>
            </li> -->
            <li style="margin-top:20px;"><input type="button" name="submit" clicked="0"  value="提交" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#4042C9;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;"/></li>
      		<li style="margin-top:10px;"><span style="color:red">友情提示：请务必输入正确的对方账号，一旦提交错误账号，不可撤销。</span></li>
      </ul>
	  </form>
<script type="text/javascript">
    //uses classList, setAttribute, and querySelectorAll
    //if you want this to work in IE8/9 youll need to polyfill these
    (function(){
        var d = document,
                accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
                setAria,
                setAccordionAria,
                switchAccordion,
                touchSupported = ('ontouchstart' in window),
                pointerSupported = ('pointerdown' in window);

        skipClickDelay = function(e){
            e.preventDefault();
            e.target.click();
        }

        setAriaAttr = function(el, ariaType, newProperty){
            el.setAttribute(ariaType, newProperty);
        };
        setAccordionAria = function(el1, el2, expanded){
            switch(expanded) {
                case "true":
                    setAriaAttr(el1, 'aria-expanded', 'true');
                    setAriaAttr(el2, 'aria-hidden', 'false');
                    break;
                case "false":
                    setAriaAttr(el1, 'aria-expanded', 'false');
                    setAriaAttr(el2, 'aria-hidden', 'true');
                    break;
                default:
                    break;
            }
        };
//function
        switchAccordion = function(e) {
            console.log("triggered");
            e.preventDefault();
            var thisAnswer = e.target.parentNode.nextElementSibling;
            var thisQuestion = e.target;
            if(thisAnswer.classList.contains('is-collapsed')) {
                setAccordionAria(thisQuestion, thisAnswer, 'true');
            } else {
                setAccordionAria(thisQuestion, thisAnswer, 'false');
            }
            thisQuestion.classList.toggle('is-collapsed');
            thisQuestion.classList.toggle('is-expanded');
            thisAnswer.classList.toggle('is-collapsed');
            thisAnswer.classList.toggle('is-expanded');

            thisAnswer.classList.toggle('animateIn');
        };
        for (var i=0,len=accordionToggles.length; i<len; i++) {
            if(touchSupported) {
                accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
            }
            if(pointerSupported){
                accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
            }
            accordionToggles[i].addEventListener('click', switchAccordion, false);
        }
    })();
</script>
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

<script>
    $("input[name='submit']").click(function(){
        var btn = $("input[name='submit']");
        if(btn.attr("clicked") == "1"){
            return ;
        }
        btn.attr("clicked","1");
        var inusername = $("input[name='inusername']").val();
        var outmoney = $("input[name='outmoney']").val();
        var safe = $("input[name='safe']").val();
        var pd=/^1[3|4|5|7|8][0-9]\d{4,8}$/;
        if(inusername == ''){
            $.alert('请填写对方账户');
            btn.attr("clicked","0");
            return ;
        }
        if(outmoney == ''){
            $.alert('请填写转账数量');
            btn.attr("clicked","0");
            return ;
        }

        if(safe == ''){
            $.alert('请填写安全码');
            btn.attr("clicked","0");
            return ;
        }

        $.showLoading("正在提交");
        $.ajax({
            url:"<?php echo U('Index/Financial/kchange');?>",
            type:"post",
            data:$("#form1").serialize(),
            dataType:"json",
            success:function(data){
                if(data.status==1){
                    $.alert(data.info,function(){
                        window.location = "<?php echo U('Index/Emoney/withdrawList');?>";
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

</body>
</html>
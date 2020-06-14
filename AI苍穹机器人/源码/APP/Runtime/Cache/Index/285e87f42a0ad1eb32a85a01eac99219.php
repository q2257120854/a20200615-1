<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
    <meta content="telephone=no" name="format-detection">
    <title>申请贷款</title>
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
    <script src="/Public/gec/web/js/layer.js"></script>
</head>
<body>
<!--顶部开始-->
<div class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">申请贷款</span>

</div>
<div class="height40"></div>

<style>
    .mytable tr td{ padding:10px 0px;}
    .aall{ border-radius:4px; color:#666666; padding:3px 15px; width:37%; display:inline-block;}
    .foncus{ background:#3660f0; color:#ffffff;}
    .huibtn{ background:#ccc !important; color:#ffffff !important;}
</style>
<div style=" width:100%; margin:10px auto; text-align:center;">

    <a href="<?php echo U('Index/Dai/daik');?>" class='aall foncus' style="margin-right:10px;">申请贷款</a>

    <a href="<?php echo U('Index/Dai/daiklog');?>" class='aall'>审批记录</a>

</div>

<!--列表开始-->
<form action="<?php echo U('Index/Dai/daiksq');?>" method="POST" id="form1" style="font-size:14px; padding-bottom:26px;">
    <ul style="width: 90%;padding:5% 5%;color: #2f2d2d" >
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">会员账号：</span><?php echo ($member['username']); ?></li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">真实姓名：</span><?php echo ($member['truename']); ?></li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">联系电话：</span><?php echo ($member['mobile']); ?></li>
        <input type="hidden" name="username" value="<?php echo ($member['username']); ?>">
        <input type="hidden" name="truename" value="<?php echo ($member['truename']); ?>">
        <input type="hidden" name="mobile" value="<?php echo ($member['mobile']); ?>">
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">贷款金额：</span><input type="txt" placeholder="请输入贷款金额" id="dkje" name="dkje" onkeyup="clcAmount()"  required="required" style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"></li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">抵押金额：</span><input type="txt" placeholder="请输入抵押金额" id="dyje" name="dyje" onkeyup="clcAmount()"  required="required" style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"></li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">银行卡号：</span><input type="txt" placeholder="请输入银行卡号" id="sknumber" name="sknumber" onkeyup="clcAmount()"  required="required" style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;"></li>
        <li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">银行名称：</span>
		<select name="sktype"  style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;">
                <option value="">请选择开户银行</option>
                    <?php if(is_array($bank)): foreach($bank as $key=>$v): ?><option value="<?php echo ($v["abbr"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
                    </select>

                </div>
		<li style="height: 30px;line-height: 30px;margin-top: 5px;width:100%"><span style="display:inline-block;width:30%;">安全密码：</span><input type="password" placeholder="请输入安全密码" name="password2" required="required"  style="height: 30px;line-height: 30px;width: 62%;border-radius: 4px;border: none; background:rgb(58, 85, 225);padding-left: 5px;-webkit-appearance:none; color:#fff;">
        </li>
        <li style="margin-top:20px;"><input type="button" name="submit" clicked="0"  value="提交" style="width: 100%;height: 30px;line-height: 30px;border-radius: 5px;border: 0px; background-color:#4042C9;margin-top: 5px;color: #FFFFFF;-webkit-appearance: none;"/></li>
        <li style="margin-top:10px;"><span style="color:red">友情提示：请务必输入正确的对方账号，一旦提交错误账号，不可撤销。</span></li>
    </ul>
</form>
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
        var username = $("input[name='username']").val();
        var truename = $("input[name='truename']").val();
        var mobile = $("input[name='mobile']").val();
        var dkje = $("input[name='dkje']").val();
        var dyje = $("input[name='dyje']").val();
        var sknumber = $("input[name='sknumber']").val();
        var bank = $("input[name='bank']").val();
        var password2 = $("input[name='password2']").val();
        var pd=/^1[3|4|5|7|8][0-9]\d{4,8}$/;

        if(dkje == ''){
            $.alert('请填写贷款金额');
            btn.attr("clicked","0");
            return ;
        }
        if(dyje == ''){
            $.alert('请填写抵押金额');
            btn.attr("clicked","0");
            return ;
        }

        if(sknumber == ''){
            $.alert('请填写收款银行卡号');
            btn.attr("clicked","0");
            return ;
        }
        if(bank == ''){
            $.alert('请选择开户银行');
            btn.attr("clicked","0");
            return ;
        }
        if(password2 == ''){
            $.alert('请填写交易密码');
            btn.attr("clicked","0");
            return ;
        }

        $.showLoading("正在提交");
        $.ajax({
            url:"<?php echo U('Index/Dai/daiksq');?>",
            type:"post",
            data:$("#form1").serialize(),
            dataType:"json",
            success:function(data){
                if(data.status==1){
                    $.alert(data.info,function(){
                        window.location = "<?php echo U('Index/Dai/daiklog');?>";
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


<div class="height55"></div>
<!--底部开始-->


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

<!--底部结束-->
<!--<script src="/Public/js/scrollpagination.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
     $('#content_ajax').infinitescroll({
          navSelector:"#pages",
          nextSelector:"#next",
          itemSelector:".includeitem"
    });

});

</script>-->
</body>
</html>
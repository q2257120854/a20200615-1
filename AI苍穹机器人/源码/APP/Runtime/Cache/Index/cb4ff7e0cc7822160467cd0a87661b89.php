<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title>个人中心</title>	
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
	<link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/Public/gec/web/js/layer.js"></script>
	<link rel="stylesheet" href="/Public/gec/web/css/stylef.css"/>
	
	

</head>

<div class="listBoxGen">
        <div class="listBoxTitleGen"><div class="showTitle">联络我们</div></div>
            <div class="listBoxContentGen">
                
	            
<div style="padding-left:40px;padding-top:40px;">
<input type="button" name="btnRedirect" value="提交留言" class="buttom" onclick="window.location='<?php echo U('Index/Msg/addMsg');?>'" />
<input type="button" name="btnRedirect" value="留言记录" class="buttom" onclick="window.location='<?php echo U('Index/Msg/msgList');?>'" />
</div>

            </div>
            <br /><br />
        </div>
	</div>
</div>

<!-- Transparent layer --> 
<div id="divBox" style="filter:alpha(opacity=40);-moz-opacity:0.3;opacity:0.3;background-color:#000;width:100%;height:100%;z-index:1000;position: absolute;left:0;top:0;display:none;overflow: hidden;">
</div>
<!-- message layer --> 
<div id="divMsg" style="border:solid 5px #339999;background:#fff;padding:10px;width:780px;z-index:1001; position: absolute; display:none;top:50%; left:50%;margin:-200px 0 0 -400px;"> 
    <div style="padding:3px 15px 3px 15px;text-align:left;vertical-align:middle;" > 
        <div class="IndexShowMsg"> 
            <div id="divShowMsg"></div>
            
        </div> 
        <br/>
        <div id="showbtnCancel" style="text-align:right;"> 
            <input id="btnCancel" type="button" class="buttom" value=" 关闭 " onclick="ShowNo()" /> 
        </div> 
    </div> 
</div> 

    </form>
</body>
</html>
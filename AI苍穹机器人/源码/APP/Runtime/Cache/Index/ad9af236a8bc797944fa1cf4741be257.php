<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>提交任务</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
    <div class="view view-main" data-page="submitTask">
        <div class="pages">
            <link href="/Public/dianyun/css/webuploader.css" rel="stylesheet" type="text/css">

            <div data-page="submitTask" class="page navbar-fixed" isinited="true">
                <div class="navbar theme-white">
                    <div class="navbar-inner">
                        <div class="left">
                            <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
                        </div>
                        <div class="center" style="left: -24px;">上传截图</div>
                        <div class="right"></div>
                    </div>
                </div>

                <div class="page-content">

                    <div class="content-block">
                        <form  method="post" action="<?php echo U('Index/Task/completepost');?>" name ="myform" id="myform">
                            <h3>发朋友圈领取金币</h3>
                            <div class="space-20"></div>

                            <div id="divuploader" class="wu-example center">
                                <div class="btns">
                                        <li>
                                            <span class="sima"><img src="/Public/img/aa4.jpg" onclick="document.getElementById('upfile').click()" id="clickimg" width="120" height="120"></span>

                                            <input type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" id="upfile"/>
                                            <input type="hidden" name="image" value="" id="image">
                                        </li>
                                    </div>
                                </div>

                            <div class="center" style="padding: 30px 15px 15px 15px;">

                                <a href="#" name="submit" onclick="document.getElementById('myform').submit();return false" class="external submitbtn">
                                    <img src="/Public/dianyun/img/hongbaook.png" style="height:55px; width:auto; max-width: 100%;">
                                </a>

                            </div>

                            <div id="divHelps">
                                <div class="space-40"></div>
                                <div style="line-height: 150%;">
                                    <b>任务提交规则：</b><br>
                                    1、已购买过机器的会员每天有1次提交发圈任务的机会。 <br>
                                    2、发圈任务必须将分享图片发布到朋友圈并停留2小时以上。 <br>

                                </div>
                                <div class="space-20"></div>
                                <div>
                                    <h5>发圈流程图：</h5>
                                    <img src="/Public/dianyun/img/faquanmoban1.jpg" style="width:100%; ">
                                </div>
                            </div>
                        </form>
                        <div class="space-40"></div>
                    </div>

                </div>

            </div>


        </div>
    </div>
</div>

<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/js/jquery.form.js"></script>

<script type="text/javascript">
    $(function(){
        $("#upfile").wrap("<form action='<?php echo U('Index/task/uploads');?>' method='post' enctype='multipart/form-data'></form>");
        $("#upfile").off().on('change',function(){
            var objform = $(this).parents();
            objform.ajaxSubmit({
                dataType:  'json',
                target: '#preview',
                success:function(data){
                    if(data.result==1){
                        $("#clickimg").attr('src','/Public/'+data.url)
                        $("#image").val('/Public/'+data.url)
                    }else{
                        $('.sima').html('<font style="color:red;">'+data.msg+'</font>')
                    }
                },
                error:function(){
                }
            });
        });
    });
</script>


</body></html>
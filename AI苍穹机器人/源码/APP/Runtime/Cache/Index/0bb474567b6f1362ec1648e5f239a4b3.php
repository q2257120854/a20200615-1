<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>任务</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="/public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/public/wx/css/reset.css">
    <link rel="stylesheet" href="/public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/public/wx/css/style.css">
    <link rel="stylesheet" href="/public/wx/td/css/new_file.css" type="text/css">
    <script src="/public/wx/bd/js/jquery-1.8.3.min.js"></script>
    <script src="/public/wx/bd/js/layer/layer.js"></script>
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
    <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">发布任务</h1>
</div>


<form  method="post" action="<?php echo U('Index/task/taskpost');?>" style="margin-bottom:80px;font-size:14px" enctype="multipart/form-data">

    <ul style="width: 100%;color: #000" >

        <li style="text-align: center;width:100%"><div style="width: 60px;height: 60px;margin-bottom: 10px;border-radius: 100%" src= ></div></li>
        <!--内容 star-->
        <div class="contaniner fixed-cont">

            <section class="assess">
                <p>
                    <textarea rows="7" id="content" name="content" placeholder="请写下您要转发的文字内容，切记不得转发不良信息哦！～～"></textarea>
                </p>

            </section>

            </section>
        </div>
        <!--内容 end-->
        <li style="height: 45px;line-height: 40px;margin-top: 5px;width:100%; border-bottom: 1px solid rgba(64, 66, 201, 0.4);">发布次数：&nbsp;&nbsp;&nbsp;
            <select name="taskid" style="height: 30px;line-height: 30px;width: 69%;border-radius: 5px;border:none;color:#eee; background:#39393d;padding-left: 5px;-webkit-appearance:none;" />
            <option value="">请选择发布条数</option>
                <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["num"]); ?>人次转发<?php echo ($v["money"]); ?>元</option><?php endforeach; endif; ?>
            </select></li>
        <li style="height: 45px;line-height: 40px;margin-top: 5px;width:100%; border-bottom: 1px solid rgba(64, 66, 201, 0.4);">发布说明：&nbsp;&nbsp;&nbsp;<font style="color:#F00;"><?php echo ($rwsm); ?></font></li>


        <li style="height: 45px;line-height: 40px;margin-top: 5px;width:100%;">配图一：&nbsp;&nbsp;&nbsp;</li>
        <li>
            <span class="sima"><img src="/Public/wx/rw/img/aa4.jpg" onclick="document.getElementById('upfile').click()" id="clickimg" width="120" height="120"></span>

            <input type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" id="upfile"/>
            <input type="hidden" name="image" value="" id="image">
        </li>

        <li style="height: 45px;line-height: 40px;margin-top: 5px;width:100%;">配图二：&nbsp;&nbsp;&nbsp;</li>
        <li>
            <span class="sima1"><img src="/Public/wx/rw/img/aa4.jpg" onclick="document.getElementById('upfile1').click()" id="clickimg1" width="120" height="120"></span>
            <input type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" id="upfile1"/>
            <input type="hidden" name="image1" value="" id="image1">
        </li>
        <li style="height: 45px;line-height: 40px;margin-top: 5px;width:100%;">配图三：&nbsp;&nbsp;&nbsp;</li>
        <li>
            <span class="sima2"><img src="/Public/wx/rw/img/aa4.jpg" onclick="document.getElementById('upfile2').click()" id="clickimg2" width="120" height="120"></span>
            <input type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" id="upfile2"/>
            <input type="hidden" name="image2" value="" id="image2">
        </li>



        <button type="submit" class="btn btn-primary btn-submit btn_submit" style="cursor:pointer;padding: 18px 10px;margin:20px 50px;color:#FFFFFF;background: #39393d;border-radius: 10px;width: 80%;display:inline-block;">提 交</button>



    </ul>
</form>


</body>
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
<script type="text/javascript">
    $('.inform-list ul li').click(function(){
        var n=$(this).index();
        $(this).addClass('acti').siblings().removeClass('acti');
        $('.inform-text').fadeOut();
        $('.inform-text').eq(n).fadeIn();
    })
</script>
<!--底部开始-->
<script src="/Public/wx/rw/js/jquery-1.11.3.min.js"></script>
<script src="/Public/wx/rw/js/jquery.form.js"></script>
<script src="/Public/wx/rw/js/layer.js"></script>

<script type="text/javascript">
    $(function(){
        $("#upfile").wrap("<form action='<?php echo U('Index/Task/uploads');?>' method='post' enctype='multipart/form-data'></form>");
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
<script type="text/javascript">
    $(function(){
        $("#upfile1").wrap("<form action='<?php echo U('Index/Task/uploads');?>' method='post' enctype='multipart/form-data'></form>");
        $("#upfile1").off().on('change',function(){
            var objform = $(this).parents();
            objform.ajaxSubmit({
                dataType:  'json',
                target: '#preview',
                success:function(data){
                    if(data.result==1){
                        $("#clickimg1").attr('src','/Public/'+data.url)
                        $("#image1").val('/Public/'+data.url)
                    }else{
                        $('.sima1').html('<font style="color:red;">'+data.msg+'</font>')
                    }
                },
                error:function(){
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        $("#upfile2").wrap("<form action='<?php echo U('Index/Task/uploads');?>' method='post' enctype='multipart/form-data'></form>");
        $("#upfile2").off().on('change',function(){
            var objform = $(this).parents();
            objform.ajaxSubmit({
                dataType:  'json',
                target: '#preview',
                success:function(data){
                    if(data.result==1){
                        $("#clickimg2").attr('src','/Public/'+data.url)
                        $("#image2").val('/Public/'+data.url)
                    }else{
                        $('.sima2').html('<font style="color:red;">'+data.msg+'</font>')
                    }
                },
                error:function(){
                }
            });
        });
    });
</script>

</html>
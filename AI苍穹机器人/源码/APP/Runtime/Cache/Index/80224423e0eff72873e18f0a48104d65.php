<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8" />
    <title>任务圈</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/public/wx/wx/css/reset.css" />
    <link rel="stylesheet" href="/public/wx/wx/css/animate.css" />
    <link rel="stylesheet" href="/public/wx/wx/css/swiper-3.4.1.min.css" />
    <link rel="stylesheet" href="/public/wx/wx/css/layout.css" />

    <script src="/public/wx/wx/js/jquery-1.9.1.min.js"></script>
    <script src="/public/wx/wx/js/zepto.min.js"></script>
    <script src="/public/wx/wx/js/fontSize.js"></script>
    <script src="/public/wx/wx/js/swiper-3.4.1.min.js"></script>
    <script src="/public/wx/wx/js/wcPop/wcPop.js"></script>

</head>
<body>

<!-- <>微聊主容器 -->
<div class="wechat__panel clearfix">
    <div class="wc__home-wrapper flexbox flex__direction-column">
        <!-- //顶部 -->
        <div class="wc__headerBar fixed">
            <div class="inner flexbox">
                <a class="back splitline" href="javascript:;" onclick="history.back(-1);"></a>
                <h2 class="barTit flex1">任务圈</h2>
            </div>
        </div>

        <!-- //微友圈 -->
        <div class="wc__friendZone">
            <div class="head">
                <img class="cover J__covers" src="/public/wx/wx/img/placeholder/wcZone-bg.jpg" />
                <p class="uname"><?php echo ($member["truename"]); ?></p>
                <a class="avator" href="<?php echo U('Index/index/index');?>"><img src="<?php echo ($member["pic"]); ?>" /></a>
            </div>
            <!-- //列表区 -->
            <div class="cont">
                <div class="inner">
                    <ul class="wc__cmtlist clearfix" id="J__cmtList">
                        <?php if(is_array($list)): foreach($list as $key=>$v): ?><li>
                                <div class="wrap-avt fl"><img src="<?php echo ($v["pic"]); ?>" /></div>
                                <div class="wrap-cmt">
                                    <div class="cmt-hd">
                                        <h2 class="u-name"><?php echo ($v["truename"]); ?></h2>
                                        <div class="post__cnt clearfix">
                                            <p><?php echo ($v["content"]); ?></p>

                                            <?php if(!empty($v['image'])): ?><p><img class="list-img" src="<?php echo ($v["image"]); ?>"></p><?php endif; ?>


                                            <?php if(!empty($v['image1'])): ?><p><img class="list-img" src="<?php echo ($v["image1"]); ?>"></p><?php endif; ?>

                                            <?php if(!empty($v['image2'])): ?><p><img class="list-img" src="<?php echo ($v["image2"]); ?>"></p><?php endif; ?>
                                        </div>
                                        <div class="reply__box clearfix">
                                            <label class="time fl c--999"><?php echo (friend_date($v["addtime"])); ?></label>
											<font style = 'padding-left: 2.5rem;' color="red">转发有<?php echo ($v["jinbi"]); ?>元奖励→</font>
                                            <a class="btn-reply fr" href="<?php echo U('Index/task/detail',array('id'=>$v['id']));?>"></a>
                                            <!-- 评论弹窗 -->

                                        </div>
                                    </div>
                                </div>
                            </li><?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    /** __公共函数 */
    $(function(){
        // ...
    });

    /** __自定函数 */
    $(function(){
        // 赞封面
        $(".J__covers").on("click", function(){
            var coverIdx = wcPop({
                id: 'receivableIntro',
                skin: 'androidSheet',

                btns: [
                    {
                        text: '赞一下这个封面',
                        style: 'line-height: 50px;',
                        onTap() {
                            wcPop.close(coverIdx);
                        }
                    },
                ]
            });
        });

        // 显示点赞、评论框
        $("#J__cmtList li").on("click", ".btn-reply", function(){
            $(this).siblings(".wc__cmtbox").fadeIn(300);
            $(this).parents("li").siblings().find(".wc__cmtbox").hide();
        });
        // 隐藏点赞、评论框
        $(window).on("scroll", function () {
            $(".wc__cmtbox").hide();
        });

        // 评论
        $("#J__cmtList li").on("click", "#J__btnCmt", function(){
            alert(9)
        });
    });
</script>

</body>
</html>
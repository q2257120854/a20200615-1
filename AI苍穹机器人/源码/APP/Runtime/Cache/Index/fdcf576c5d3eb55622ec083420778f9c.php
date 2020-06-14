<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en" class="pixel-ratio-3 retina android android-5 android-5-0"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Public/bao/reset.css">
    <link rel="stylesheet" href="/Public/bao/light7.css">
    <link rel="stylesheet" href="/Public/bao/swiper.css">
    <link rel="stylesheet" href="/Public/bao/style.css">
    <title>抢红包</title>
    <style>
        .swiper-container {
            width: 75%;
            height: 7.5rem;
        }

        .swiper-slide {
            text-align: center;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="page red page-current page-inited" id="page-1544557552531">
        <!-- 这里是页面内容区 -->
        <div class="content redpackage">
            <div class="redpackCont">
                <div class="logo">
                    <img src="/Public/bao/201811122346370772.png" "="" alt="">
                </div>
                <p>恭喜发财，大吉大利！<span class="tixian">可提现</span></p>
                <p>新手专享福利</p>
                <button class="getRed"></button>
                <!-- 幻灯片开始 -->
                <div class="swiper-container redSwiper swiper-container-vertical swiper-container-android">
                    <div class="swiper-wrapper" style="transition-duration: 400ms; transform: translate3d(0px, -120px, 0px);">
                        
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">134****4923</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">136****1939</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide swiper-slide-prev" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">185****1885</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide swiper-slide-active" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">156****0888</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide swiper-slide-next" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">150****9296</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">181****3695</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">138****2231</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">150****5432</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">155****7852</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            
                                <div class="swiper-slide" style="height: 30px; margin-bottom: 10px;">
                                    <p class="name">182****5369</p>
                                    <p class="data"> 8.88 元</p>
                                </div>
                            

                    </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div>
        </div>

        <div class="pop redModal" style="display: none;">
            <div class="curtain"></div>
            <div class="modalRed">
                <div class="redContent">
                    <div class="logo mo-logo">
                         <img src="/Public/bao/201811122346370772.png" "="" alt="">
                    </div>
                    <p>恭喜您获得</p>
                    <p class="price"><?php echo ($hongbao); ?><span>元</span></p>
                </div>
				<form action="<?php echo U('/Index/sem/regsems');?>" method="post">
					<input type="hidden" name="id" value="<?php echo ($uid); ?>">
                    <button class="redbtn">领取到账户</button>
				</form>
            </div>
        </div>
    </div>

    <script src="/Public/bao/jquery.js"></script>
    <script src="/Public/bao/light7.js"></script>
    <script src="/Public/bao/swiper.js"></script>
    <script>

        $(function () {
            $.init();

            var swiper = new Swiper('.redSwiper', {
                init: true,
                direction: 'vertical',
                slidesPerView: 4,
                spaceBetween: 10,
                autoplay: {
                    delay: 2000,//1秒切换一次
                },
                speed: 400
            });


            // 点击领取(按钮动画)

            // 按钮动画
            $('.getRed').click(function () {
                $(this).addClass('btnClass')
                setInterval(function () {
                    $('.redModal').css('display', function () {
                        return 'block'
                    })
                    $(this).removeClass('btnClass')
                }, 2000)
            })







        })
    </script>

</body></html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>个人中心</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

  </head>
  <body onload="onload()" class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main" data-page="myinfo">
        <div class="pages">
          <div data-page="myinfo" class="page navbar-fixed toolbar-fixed" isinited="true">
    <div class="navbar navbar-myinfo">
        <div class="navbar-inner">
            <div class="left"></div>
            <div class="center" style="left: 0px;">我的</div>
            <div class="right"></div>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-30 right" style="padding-top: 15px;">
                <a href="javascript:memberInfoModify();" class="external">
                    <img src="/Public/dianyun/img/noheader.jpg" class="avatar">
                </a>
            </div>
            <div class="col-70">
                <p>
                    <a href="javascript:memberInfoModify();" class="external" style="font-size:20px;"><?php echo ($minfo["truename"]); ?></a>
                </p>
                <p><i class="icon iconfont icon-mobile2"></i> 手机号：<?php echo ($minfo["mobile"]); ?></p>
                <p><i class="icon iconfont icon-qrcode"></i> 推广码：<?php echo ($minfo["id"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;级别:<?php if($minfo['level'] == 0): ?>普通会员<?php else: ?>领袖<?php endif; ?></p>
            </div>
        </div>

        <div class="space-10 bg-gray"></div>

        <div class="row mysubpanelinfo">
            <div class="col-33"><p class="mvalue total-num"><?php echo ($minfo["money"]); ?></p><p class="mtitle">当前余额</p></div>
            <div class="col-33"><p class="mvalue total-num"><?php echo ($count); ?></p><p class="mtitle">AI机器人</p></div>
            <div class="col-33"><p id="myMembersCount" class="mvalue mine-num"><?php echo ($minfo["gamecount"]); ?></p><p class="mtitle">我的伙伴</p></div>
        </div>

        <div class="space-10 bg-gray"></div>

        <div class="list-block">
            <ul class="my-info-menus">
                <li><a href="<?php echo U('Index/Index/personal');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-1.png"></div>
                    <div class="item-inner">
                        <div class="item-title">个人资料</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Index/Index/updatepass');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-2.png"></div>
                    <div class="item-inner">
                        <div class="item-title">修改密码</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Wallet/award');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-3.png"></div>
                    <div class="item-inner">
                        <div class="item-title">我的收益</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Wallet/tixian');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-4.png"></div>
                    <div class="item-inner">
                        <div class="item-title">我要提现</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Index/Index/team');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-5.png"></div>
                    <div class="item-inner">
                        <div class="item-title">我的伙伴</div>
                    </div></a>
                </li>
            </ul>
        </div>

        <div class="space-10 bg-gray"></div>

        <div class="list-block">
            <ul class="my-info-menus">
                <li><a href="<?php echo U('Index/New/help');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-6.png"></div>
                    <div class="item-inner">
                        <div class="item-title">帮助中心</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Index/Index/tgm');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-7.png"></div>
                    <div class="item-inner">
                        <div class="item-title">推荐好友</div>
                    </div></a>
                </li>
                <li><a href="<?php echo U('Index/New/xiangmu');?>" class="item-link item-content external">
                    <div class="item-media"><img src="/Public/dianyun/img/myinfo-8.png"></div>
                    <div class="item-inner">
                        <div class="item-title">关于</div>
                    </div></a>
                </li>
            </ul>
        </div>

        <div class="space-10 bg-gray"></div>

        <div class="area-10 center">
            <a href="<?php echo U('Index/Index/logout');?>" onclick="if(confirm('确认退出当前账号吗？')==false)return false;"class="external submitbtn">
                <img src="/Public/dianyun/img/button-logout.png" style="height:55px; width:auto; max-width: 100%;">
            </a>
        </div>
    </div>

    <div class="toolbar tabbar tabbar-labels">
        <div class="toolbar-inner">
            <a href="<?php echo U('Index/New/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-home-01.png">
                <span class="tabbar-label">首页</span>
            </a>
            <a href="<?php echo U('Index/Robot/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-robot-01.png">
                <span class="tabbar-label">AI机器人</span>
            </a>
            <a href="<?php echo U('Index/Task/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-coin-01.png">
                <span class="tabbar-label">领金币</span>
            </a>
            <a href="<?php echo U('Index/Wallet/index');?>" class="tab-link external active">
                <img src="/Public/dianyun/img/tab-account.png">
                <span class="tabbar-label">我的</span>
            </a>
        </div>
    </div>
</div>



        </div>
      </div> 
    </div> 
  

</body></html>
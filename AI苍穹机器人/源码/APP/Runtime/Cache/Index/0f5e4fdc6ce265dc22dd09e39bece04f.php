<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>AI详情</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


    <link rel="stylesheet" type="text/css" href="/public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style1.css">



</head>
<body onload="onload()" class="framework7-root">
<div class="panel-overlay"></div>
<div class="panel panel-left panel-reveal layout-dark">
</div>

<div class="views">
    <div class="view view-main" data-page="todayworks">
        <div class="pages">
            <style type="text/css">
                .toolbar:before {display: none;}
            </style>

            <div data-page="todayworks" class="page navbar-fixed toolbar-fixed" isinited="true">
                <div class="navbar theme-white">
                    <div class="navbar-inner">
                        <div class="left">
                            <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
                        </div>
                        <div class="center" style="left: -24px;">AI详情</div>
                        <div class="right"></div>
                    </div>
                </div>

                <div class="page-content" style="padding-bottom: 88px;">
                    <div style="margin: 15px;">
                        <div class="row">
                            <div class="col-50" style="font-size:18px;">
                                任务总数： <span id="lblCount" style="font-size:18px;"><?php echo ($mrkd); ?></span>
                            </div>

                            <div class="col-50 center">
                                <span id="lblTime" style="font-size:18px;"><?php echo (date("Y-m-d",$time)); ?></span>
                            </div>
                        </div>
                        <div id="lblDescription" style="line-height: 160%; padding-top: 20px;"><?php echo ($rwsm); ?></div>
                    </div>

                    <div class="neirbg_f">
                        <div class="neirbg_f_in">
                            <h2>AI每隔<?php echo ($jiesuan_time); ?>小时重启一次可领取奖励</h2>
                            <div class="twobf_f">
                                <ul>
                                    <li>
                                        <em>AI机器人数量</em>
                                        <p><?php echo ($count1); ?>   <font>只</font></p>
                                    </li>
                                    <li>
                                        <em>>AI机器人收益</em>
                                        <p><?php echo ($sum); ?><font>元</font></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="zhul" style="padding-bottom:5px;margin-bottom:80px">
                        <table style="width: 90%;margin-left: 5%;color: #333333;margin-top: 20px;border-collapse:collapse;" class="mytable">
                            <thead style="font-size: 12px; ">

                            <tr style="height: 35px;line-height: 35px;">
                                <th  style="border-bottom:2px solid #ddd ">AI名称</th>
                                <th style="border-bottom:2px solid #ddd ">AI机器人编号</th>
                                <th style="border-bottom:2px solid #ddd ">已刷单</th>
                                <th style="border-bottom:2px solid #ddd ">已收益</th>
                                <th style="border-bottom:2px solid #ddd ">操作</th>

                            </tr>
                            </thead>
                            <tbody style="font-size: 12px;text-align: center">
                            <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tr  style="height: 35px;line-height: 35px;">
                                    <td style="border-bottom:2px solid #ddd "><?php echo ($v["project"]); ?></td>
                                    <td style="border-bottom:2px solid #ddd "><?php echo ($v["kjbh"]); ?></td>
                                    <td style="border-bottom:2px solid #ddd ">
                                        <?php if($v['zt'] == 1): echo (set_number($v["a_time"],'0')); ?>小时
                                            <?php else: ?>
                                            --<?php endif; ?>
                                    </td>
                                    <td style="border-bottom:2px solid #ddd "><?php echo (four_number($v["already_profit"])); ?></td>
                                    <td style="border-bottom:2px solid #ddd ">
                                        <?php if($v["zt"] == 1): if($v["is_jiesuan"] == 1): ?><a href="<?php echo U('Robot/jiesuan',array('id'=>$v['id']));?>"  style="padding:3px 5px; background:#20548a; color:#FFFFFF; border-radius:4px;">领取收益</a>
                                            <?php else: ?>
                                                <a href="javascript:alert(&#39;请勿操作，AI机器人正在努力的作业中！&#39;);"  style="padding:3px 5px; background:#333; color:#FFFFFF; border-radius:4px;">正在挂机</a><?php endif; ?>
                                        <?php else: ?>
                                            ----<?php endif; ?>
                                    </td>

                                </tr><?php endforeach; endif; ?>

                            </tbody>

                        </table>
                        <div class="center"  id="pages"><?php echo ($page); ?></div>
                    </div>

                </div>
                </div>

                </div>
                </div>
    <div class="toolbar tabbar tabbar-labels">
        <div class="toolbar-inner">
            <a href="<?php echo U('Index/New/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-home-01.png">
                <span class="tabbar-label">首页</span>
            </a>
            <a href="<?php echo U('Index/Robot/index');?>" class="tab-link external active">
                <img src="/Public/dianyun/img/tab-robot.png">
                <span class="tabbar-label">机器人</span>
            </a>
            <a href="<?php echo U('Index/Task/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-coin-01.png">
                <span class="tabbar-label">领金币</span>
            </a>
            <a href="<?php echo U('Index/Wallet/index');?>" class="tab-link external">
                <img src="/Public/dianyun/img/tab-account-01.png">
                <span class="tabbar-label">我的</span>
            </a>
        </div>
    </div>
                </div>

</body></html>
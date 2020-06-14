<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0036)https://robot.paif.shop/m/todayworks -->
<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>今日客单</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

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
                        <div class="center" style="left: -24px;">今日客单</div>
                        <div class="right"></div>
                    </div>
                </div>

                <div class="page-content" style="padding-bottom: 88px;">
                    <div style="margin: 15px;">
                        <div class="row">
                            <div class="col-50" style="font-size:18px;">
                                客单总数： <span id="lblCount" style="font-size:18px;"><?php echo ($mrkd); ?></span>
                            </div>

                            <div class="col-50 center">
                                <span id="lblTime" style="font-size:18px;"><?php echo (date("Y-m-d",$time)); ?></span>
                            </div>
                        </div>
                        <div id="lblDescription" style="line-height: 160%; padding-top: 20px;"><?php echo ($rwsm); ?></div>
                    </div>

                    <div class="space-10 bg-gray"></div>
                    <div class="space-10"></div>

                    <div class="list-block">
                        <ul id="workslist">
                            <li>
                                <label class="label-checkbox item-content">
                                    <input type="checkbox" name="my-checkbox" value="0">
                                    <div class="item-inner">
                                        <div class="item-title" style="height:60px;">
                                            <div style="font-size:16px; margin-bottom: 5px;">今日头条01</div>
                                            <span class="badge bg-gray">未领取</span>
                                        </div>
                                        <div class="item-after">
                                            <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                        </div>
                                    </div>
                                </label>
                            </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="1">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">微信投票02</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="2">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">抖音流量03</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="3">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">淘宝店铺04</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="4">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">天猫商城05</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="5">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">京东商城06</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="6">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">拼多多07</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="7">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">途牛旅游08</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="8">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">网易阅读09</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="9">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">映客直播10</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="10">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">58同城11</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="11">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">携程旅行12</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="12">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">快手13</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="13">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">大众养生14</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="14">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">快资讯15</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="15">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">虎牙直播16</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="16">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">皮皮虾17</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="17">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">用钱宝18</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="18">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">东方头条19</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="19">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">233小游戏20</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="20">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">去哪借21</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="21">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">吹牛聊天22</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="22">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">趣走23</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="23">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">爱客宝24</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="24">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">快玩转25</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="25">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">玖富钱包26</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="26">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">探探27</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="27">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">宜人财富28</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="28">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">还呗29</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li><li>
                            <label class="label-checkbox item-content">
                                <input type="checkbox" name="my-checkbox" value="29">
                                <div class="item-inner">
                                    <div class="item-title" style="height:60px;">
                                        <div style="font-size:16px; margin-bottom: 5px;">么么直播30</div>
                                        <span class="badge bg-gray">未领取</span>
                                    </div>
                                    <div class="item-after">
                                        <i class="icon icon-form-checkbox" style="width:28px; height:28px;"></i>
                                    </div>
                                </div>
                            </label>
                        </li></ul>
                    </div>

                </div>

                <div class="toolbar tabbar tabbar-labels" style="height: 70px; background: transparent;">
                    <div class="center">
                        <a id="btnGetWorks" href="javascript:works_get();" class="external submitbtn">
                            <img src="/Public/dianyun/img/button-getworks.png" style="height:60px; width:auto; max-width: 100%;">
                        </a>
                    </div>
                </div>

            </div>



        </div>
    </div>
</div>




<div class="modal-overlay"></div></body></html>
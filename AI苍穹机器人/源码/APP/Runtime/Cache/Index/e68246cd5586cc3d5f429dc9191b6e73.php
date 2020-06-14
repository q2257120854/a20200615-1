<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>提现</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">

  </head>
  <body onload="onload()" class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main" data-page="withdrawals">
        <div class="pages">


<div data-page="withdrawals" class="page navbar-fixed" isinited="true">
    <div class="navbar theme-white navbar-noborder">
        <div class="navbar-inner">
            <div class="left">
                <a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
            </div>
            <div class="center" style="left: 4px;">提现</div>
            <div class="right">
                <a href="<?php echo U('Index/Wallet/withdrawn');?>" class="external">提现</a>
            </div>
        </div>
    </div>
    <div class="page-content infinite-scroll">
        <div class="area-10">
            <table cellpadding="0" cellspacing="0" border="0" style="border: none;width:100%;">
                <tbody><tr>
                    <td style="width:49%; vertical-align: top;">
                        <p class="bold bigtext center"><?php echo ($money); ?></p>
                        <p class="center">可提现金额</p>
                    </td>
                    <td style="width:2%; border-right: solid 1px #a5a5a5; width:1px;">&nbsp;
                    </td>
                    <td style="width:49%; vertical-align: top;">
                        <p class="bold bigtext center"><?php echo ($yiti); ?></p>
                        <p class="center">已提现金额</p>
                    </td>
                </tr>
            </tbody></table>
        </div>

        <div class="space-10 bg-gray"></div>
        <div class="space-20"></div>

        
        <div>
            <div class="center red">
                备注：您的提现钱包必须与充值时真实姓名一致，否则不予通过。
            </div>
        </div>
        

        <div class="space-20"></div>

        <div>
            <div class="center">
                <a href="<?php echo U('Index/Wallet/withdrawnlog');?>" class="external submitbtn">
                    <img src="/Public/dianyun/img/button-withdrawalhis.png" style="height:55px; width:auto; max-width: 100%;">
                </a>
            </div>
        </div>

        <div class="area-20">
            提现规则：<br>
            1、工作日5天*24小时提现。<br>
            2、满1元提现、1的倍数提现、0元/笔手续费。<br>
            3、会员首笔提现不限金额，不收取手续费。
        </div>
    </div>

</div>

<script type="text/javascript">
    var m_WithdrawalsLimit = "0";
</script>

        </div>
      </div> 
    </div> 
  


</body></html>
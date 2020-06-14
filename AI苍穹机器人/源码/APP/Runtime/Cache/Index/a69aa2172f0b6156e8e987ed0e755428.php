<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>会员资料</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


  </head>
  <body onload="onload()" class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main" data-page="member-info">
        <div class="pages">
          <script src="/Public/dianyun/js/dist2.js"></script>
<script src="/Public/dianyun/js/dist.js"></script>

<div data-page="member-info" class="page navbar-fixed" isinited="true">
	<div class="navbar theme-white">
		<div class="navbar-inner">
			<div class="left">
				<a href="javascript:history.go(-1);" class="external link"> <i class="icon iconfont icon-angleleft" style="transform: translate3d(0px, 0px, 0px);"></i>返回</a>
			</div>
			<div class="center" style="left: -24px;">会员资料</div>
			<div class="right"></div>
		</div>
	</div>

  <div class="page-content">
     <form id="frmMemberInfo">
        <div class="list-block">
			<ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label"><img src="/Public/dianyun/img/noheader.jpg" class="avatar" style="width:48px;height:48px; margin: 12px 0;"></div>
                            <div class="item-input right">
                                <span class="bold"><?php echo ($minfo["name"]); ?></span>
                            </div>
                        </div>
                    </div>
                </li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label"><span>会员ID</span></div>
							<div class="item-input right">
								<span><?php echo ($minfo["id"]); ?></span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label"><span>上级会员</span></div>
							<div class="item-input right">
								<span><?php echo ($minfo["parent"]); ?></span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label"><span>真实姓名</span></div>
							<div class="item-input right">
								<span><?php echo ($minfo["truename"]); ?></span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label"><span>手机号码</span></div>
							<div class="item-input right">
								<span><?php echo ($minfo["mobile"]); ?></span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">提现银行</div>
							<div class="item-input right">
								<span><?php echo ($list["name"]); ?></span>
							</div>
						</div>
					</div>
				</li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">开户行</div>
                            <div class="item-input right">
                                <span><?php echo ($list["kaihuhang"]); ?></span>
                            </div>
                        </div>
                    </div>
                </li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">银行帐号</div>
							<div class="item-input right">
								<span><?php echo ($list["card"]); ?></span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">提现支付宝</div>
							<div class="item-input right">
								<?php if(empty($minfo['zhifu'])): ?><a class="external" href="<?php echo U('Index/Index/zhifu');?>">
                                        [未设置]
                                    </a>
									<?php else: ?>[已设置]<?php endif; ?>
							</div>
						</div>
					</div>
				</li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">提现微信</div>
                            <div class="item-input right">
								<?php if(empty($minfo['wei'])): ?><a class="external" href="<?php echo U('Index/Index/wei');?>">
										[未设置]
									</a>
									<?php else: ?>[已设置]<?php endif; ?>
							
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">注册时间</div>
                            <div class="item-input right">
                                <span id="lblCreateTime"><?php echo (date("Y-m-d",$minfo["regdate"])); ?></span>
                            </div>
                        </div>
                    </div>
                </li>
			</ul>
		</div>

	 
         <div>
			 <div class="area-20 center">
				 <a href="<?php echo U('Index/Index/edit');?>" class="external btn-submit">
                     <img src="/Public/dianyun/img/button-modify0.png" style="height:55px; width: auto">
                 </a>
			 </div>
         </div>
	 
    </form>
    
  </div>

</div>
        </div>
      </div> 
    </div> 


</body></html>
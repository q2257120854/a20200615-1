<!doctype html>
<html lang="zh">
<head>
<title>如何设置APP相关信息（例如更换图标、选择下载页等）？ - <?php echo IN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="keywords" content="发布与下载,企业签名,封装APP,SDK自动更新">
<meta name="keywords" content="<?php echo IN_KEYWORDS;?>" />
<meta name="description" content="<?php echo IN_DESCRIPTION;?>" />
<link rel="stylesheet" type="text/css" href="/static/cloud/course/css/xiala.css" />
<link rel="stylesheet" type="text/css" href="/static/cloud/course/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/static/cloud/course/css/base.css" />
<link rel="stylesheet" type="text/css" href="/static/cloud/course/css/main.css" />
<link rel="stylesheet" type="text/css" href="/static/cloud/course/css/h5.css" />
<script type="text/javascript" src="/static/cloud/course/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/cloud/course/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/cloud/course/js/vue.js"></script>
<script type="text/javascript" src="/static/cloud/course/js/js.js"></script>
<script>        
	isHideFooter = false;
</script>
</head>
<body>
<?php 
include "source/index/header.php";
?><div id="app">
</header><div class="doc-banner">
<div class="tit"><?php echo IN_NAME;?>文档中心</div>

</div>
<div class="container">

<div class="crumbs"><a href="/index.php/docs">文档中心</a><span>/</span>详情</div>

<div class="doc-details">
<div class="row">
<div class="col-sm-2">
<div class="details-left">
<dl>
<dt class="active clearfix">
<span class="icon icon-small-doc1"></span>
发布与下载
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd style="display: block;">
<a href="/index.php/pack-the-app" class="tit1 " title="打包 iOS 的 IPA 文件">打包 iOS 的 IPA 文件</a>
<a href="/index.php/authentication" class="tit1 " title="实名认证有何作用？需要填写哪些材料？">实名认证有何作用？需要填写哪些材料？</a>
<a href="/index.php/publish_hebing" class="tit1 " title="怎样上传发布APP，合并安卓和苹果链接和二维码?">怎样上传发布APP，合并安卓和苹果链接和二维码?</a>
<a href="/index.php/app-edit" class="tit1 " title="如何设置APP相关信息（例如更换图标、选择下载页等）？">如何设置APP相关信息（例如更换图标、选择下载页等）？</a>
<a href="/index.php/upload-limit" class="tit1 " title="发布APP有无大小限制，超过300M以上的包可以发布吗？">发布APP有无大小限制，超过300M以上的包可以发布吗？</a>
<a href="/index.php/FAQ" class="tit1 " title="常见问题">常见问题</a>
<a href="/index.php/publish-app" class="tit1 active" title="如何发布APP？（或如何获得正式下载链接？）">如何发布APP？（或如何获得正式下载链接？）</a>
<a href="/index.php/difference" class="tit1 " title="正式下载链接VS测试下载链接的区别？">正式下载链接VS测试下载链接的区别？</a>
<a href="/index.php/ipa-install-with-itms-service" class="tit1 " title="配置Plist文件实现在线安装IPA详细教程">配置Plist文件实现在线安装IPA详细教程</a>
<a href="/index.php/umeng" class="tit1 " title="如何申请配置友盟统计？">如何申请配置友盟统计？</a>
<a href="/index.php/point-to" class="tit1 " title="下载页可以绑定自己的域名吗？如何绑定？">下载页可以绑定自己的域名吗？如何绑定？</a>
</dd>
</dl>
<dl>
<dt class=" clearfix">
<span class="icon icon-small-doc2"></span>
企业签名
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd>
<a href="/index.php/updateapp" class="tit1 " title="APP更新签名了，如何操作发布？">APP更新签名了，如何操作发布？</a>
<a href="/index.php/ios-enterprise-certificates" class="tit1 " title="如何做苹果企业签名？">如何做苹果企业签名？</a>
<a href="/index.php/trusted-app" class="tit1 " title="出现证书信任怎么办？可以不信任直接安装吗？">出现证书信任怎么办？可以不信任直接安装吗？</a>
</dd>
</dl>
<dl>
<dt class="">
<span class="icon icon-small-doc3"></span>
封装APP
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd>
<a href="/index.php/installation" class="tit1 " title="封装好的APP，可以直接安装吗？">封装好的APP，可以直接安装吗？</a>
<a href="/index.php/pack-app" class="tit1 " title="封装APP具体教程&功能插件介绍">封装APP具体教程&amp;功能插件介绍</a>
<a href="/index.php/pull-up" class="tit1 " title="URL拉起APP，如何配置？">URL拉起APP，如何配置？</a>
<a href="/index.php/re-edit" class="tit1 " title="封装好的APP还可以重新编辑吗？">封装好的APP还可以重新编辑吗？</a>
</dd>
</dl>
<dl>
<dt class="">
<span class="icon icon-small-doc4"></span>
SDK
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd>
<a href="/index.php/ios-sdk-guide" class="tit1 " title="第八区 iOS SDK 集成教程">第八区 iOS SDK 集成教程</a>
<a href="/index.php/android-sdk-guide" class="tit1 " title="第八区Android SDK集成指南">第八区Android SDK集成指南</a>
</dd>
</dl>
</div>
</div>
<div class="col-sm-10">
<div class="details-right">
<div class="article-tit">如何发布APP？（或如何获得正式下载链接？）</div>
<div class="article-con">
<p><span style="color:#00b0f0">第一步、注册登录第八区网站</span></p><p>网站地址：www.dibaqu.com，在网站右上角有登录和注册按钮</p><p><img src="https://static.dibaqu.com/upload/20181206/15440681258287.png" /></p><p><br /></p><p><span style="color:#00b0f0">第二步、进行实名认证</span></p><p>登录完成后，在右上角，账号左侧，有一行蓝色文字“未实名认证”，点击“未实名认证”进行实名认证。</p><p><img src="https://static.dibaqu.com/upload/20181206/15440689678572.png" /></p><p><br /></p><p>实名认证通过后，即可获得每天1000次的免费下载（仅限300M以内的包）；</p><p>如果未实名，APP每天只能保存24小时，24小时内，只能下载5次。</p><p><br /></p><p><span style="color:#00b0f0">第三步、点击导航栏【发布】页，然后点击立即上传。</span></p><p><img src="https://static.dibaqu.com/upload/20181206/15440748662297.png" /></p><p><br /></p><p>上传中</p><p><img src="https://static.dibaqu.com/upload/20181206/1544075983986.png" /></p><p><br /></p><p><span style="color:#00b0f0">第四步、上传完成</span></p><p><img src="https://static.dibaqu.com/upload/20181206/1544076691940.png" /></p><p><br /></p><p>点击蓝色按钮【查看下载页】，在浏览器地址框，即可看到下载地址。页面上同时有下载二维码。</p><p><img src="https://static.dibaqu.com/upload/20181206/15440771438562.png" /></p><p><br /></p><p><br /></p><p><br /></p><p><span style="color: rgb(0, 176, 240);"><span style="color: rgb(0, 176, 240);"></span></span><br /></p><p><br /></p><p><br /></p> </div>
</div>
</div>
</div>
</div>
</div>
<?php 
include "source/index/footer.php";
?></body>
</html>
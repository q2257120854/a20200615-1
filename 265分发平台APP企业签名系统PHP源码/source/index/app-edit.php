<!doctype html>
<html lang="zh">
<head>
<title>如何设置APP相关信息（例如更换图标、选择下载页等）？ - <?php echo IN_NAME; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="keywords" content="发布与下载,企业签名,封装APP,SDK自动更新">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>" />
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
<?php include 'source/index/header.php'; ?>
<div id="app">
</header><div class="doc-banner">
<div class="tit"><?php echo IN_NAME; ?>文档中心</div>

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
<a href="/index.php/realnameproblem" class="tit1 " title="实名认证有何作用？需要填写哪些材料？">实名认证有何作用？需要填写哪些材料？</a>
<a href="/index.php/publish_hebing" class="tit1 " title="怎样上传发布APP，合并安卓和苹果链接和二维码?">怎样上传发布APP，合并安卓和苹果链接和二维码?</a>
<a href="/index.php/app-edit" class="tit1 active" title="如何设置APP相关信息（例如更换图标、选择下载页等）？">如何设置APP相关信息（例如更换图标、选择下载页等）？</a>
<a href="/index.php/upload-limit" class="tit1 " title="发布APP有无大小限制，超过300M以上的包可以发布吗？">发布APP有无大小限制，超过300M以上的包可以发布吗？</a>
<a href="/index.php/FAQ" class="tit1 " title="常见问题">常见问题</a>
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
</div>
</div>
<div class="col-sm-10">
<div class="details-right">
<div class="article-tit">如何设置APP相关信息（例如更换图标、选择下载页等）？</div>
<div class="article-con">
<p>APP发布完成后，可以对其下载页显示内容，进行编辑。</p><p><br/></p><p>入口页【发布-应用列表】，点击所需APP的【设置按钮】</p><p><br/></p><p>具体设置页面如下：</p><p>鼠标悬停在图标区域，可以重新上传图标；</p><p>具体设置分成基本设置、高级设置、下载页模板</p><p><p><span style="color:#00b0f0">一、基本设置</span></p><p>1. APP名称：可以自由定义APP在下载页显示的名称（仅限于下载页，下载到手机上，还是原先的名称）。也可以不修改，默认读取APP包内的APP名称。</p><p>2. 短连接：支持4-16位字母数字。也可以不修改，使用网站默认提供的短链接。</p><p>3. APP图标：<span style="white-space: normal;">可以自由定义APP在下载页显示的图片（仅限于下载页，下载到手机上，还是原先的名称）。<span style="white-space: normal;">也可以不修改，默认读取APP包内的APP图标。</span></span></p><p><br/></p><p><span style="color:#00b0f0">二、高级设置 （可以都不配置，非必须选项）</span></p><p>1. 信任教程：可以显示或者隐藏底部红色信任教程</p><p>2. 下载方式：可以公开下载，也可以设置密码，让下载的用户输入密码才能下载</p><p>3. 下载限制：可以控制下载次数，或者不限制用户下载</p><p>4. 联系方式：可以留下联系方式，让用户在下载页可以看到联系方式</p><p>5. 苹果商店地址：如APP已经上架苹果商店，可以输入APP在苹果商店的地址，用户点击下载时，直接跳转到苹果商店</p><p>6. 备注：用来备注说明一些提示内容，不会显示在下载页</p><p>7. 应用介绍：可以用一段文字来介绍说明APP的特性、玩法、功能、特点灯</p><p>8. 应用截图：可以在APP中截一些图，用以介绍APP</p><p><img src="/static/cloud/course/img/yingyongshezhi.png"/></p><p><br/></p><p><span style="color:#00b0f0">三、下载页设置</span></p><p><?php echo IN_NAME; ?>网站提供多套下载模板，目前免费对用户开放，可以任意选择下载页展示模板。</p><p><img src="/static/cloud/course/img/yingyongmoban.png"/></p><p><br/></p><p><br/></p>                    </div>
</div>
</div>
</div>
</div>
</div>
<?php include 'source/index/footer.php'; ?>
</body>
</html>
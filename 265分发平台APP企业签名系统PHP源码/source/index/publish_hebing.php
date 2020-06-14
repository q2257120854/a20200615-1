<!doctype html>
<html lang="zh">
<head>
<title>怎样上传发布APP，合并安卓和苹果链接和二维码?- <?php echo IN_NAME;?></title>
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
<div class="doc-banner">
<div class="tit"><?php echo IN_NAME;?>文档中心</div>
</div>
<div class="container">
<!--面包屑导航-->
<div class="crumbs"><a href="/docs">文档中心</a><span>/</span>详情</div>
<!--/面包屑导航-->
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
<a href="/index.php/publish_hebing" class="tit1 active" title="怎样上传发布APP，合并安卓和苹果链接和二维码?">怎样上传发布APP，合并安卓和苹果链接和二维码?</a>
<a href="/index.php/app-edit" class="tit1 " title="如何设置APP相关信息（例如更换图标、选择下载页等）？">如何设置APP相关信息（例如更换图标、选择下载页等）？</a>
<a href="/index.php/upload-limit" class="tit1 " title="发布APP有无大小限制，超过300M以上的包可以发布吗？">发布APP有无大小限制，超过300M以上的包可以发布吗？</a>
<a href="/index.php/FAQ" class="tit1 " title="常见问题">常见问题</a>
</dd>
</dl>
<dl>
<dt class="">
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
<div class="article-tit">怎样上传发布APP，合并安卓和苹果链接和二维码?</div>
<div class="article-con">
<p><?php echo IN_NAME;?>平台支持安卓包.apk和苹果包.ipa上传发布，同时支持安卓APP和苹果APP合并成同一个链接，同一个二维码。</p><p><br/></p><p>具体操作步骤：</p><p>第一、上传APP ，点击导航栏【发布】按钮，点击【上传应用】。</p><p><br/></p><p>上传完成后，显示：</p><p><br/></p><p>点击【<span style="white-space: normal;">查看下载页</span>】，就可以看到：</p><p><br/></p><p>第二、如何合并俩个应用</p><p>在导航栏【发布】页点击【应用列表】，选择想要合并的APP，点击【合并应用】，红色箭头所指按钮。</p><p>例如：想合并考研英语，点击Android安卓的【合并应用】，或者iOS苹果的【合并应用】</p><p><br/></p><p>点击【合并应用】后出现弹框，勾选好所需合并的应用，点击绿色按钮【合并应用】；</p><p><br/></p><p>合并成功后，原先【合并应用】的按钮，变成【取消合并】；</p><p><span style="color:#ff0000">合并成功后，考研英语的安卓或苹果包，任意一个链接，都可以用来下载APP，链接地址将自动根据用户的手机类型，进行安装。</span><p><br/></p>                    </div>
</div>
</div>
</div>
</div>
</div>
<?php 
include "source/index/footer.php";
?></body>
</html>
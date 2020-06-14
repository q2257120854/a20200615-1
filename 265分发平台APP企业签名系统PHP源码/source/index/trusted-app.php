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
<dt class=" clearfix">
<span class="icon icon-small-doc1"></span>
发布与下载
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd>
<a href="/index.php/pack-the-app" class="tit1 " title="打包 iOS 的 IPA 文件">打包 iOS 的 IPA 文件</a>
<a href="/index.php/realnameproblem" class="tit1 " title="实名认证有何作用？需要填写哪些材料？">实名认证有何作用？需要填写哪些材料？</a>
<a href="/index.php/publish_hebing" class="tit1 " title="怎样上传发布APP，合并安卓和苹果链接和二维码?">怎样上传发布APP，合并安卓和苹果链接和二维码?</a>
<a href="/index.php/app-edit" class="tit1 " title="如何设置APP相关信息（例如更换图标、选择下载页等）？">如何设置APP相关信息（例如更换图标、选择下载页等）？</a>
<a href="/index.php/upload-limit" class="tit1 " title="发布APP有无大小限制，超过300M以上的包可以发布吗？">发布APP有无大小限制，超过300M以上的包可以发布吗？</a>
<a href="/index.php/FAQ" class="tit1 " title="常见问题">常见问题</a>
</dd>
</dl>
<dl>
<dt class="active clearfix">
<span class="icon icon-small-doc2"></span>
企业签名
<span class="iconfont icon-arrow-down fr"></span>
<span class="iconfont icon-arrow-up fr"></span>
</dt>
<dd style="display: block;">
<a href="/index.php/updateapp" class="tit1 " title="APP更新签名了，如何操作发布？">APP更新签名了，如何操作发布？</a>
<a href="/index.php/ios-enterprise-certificates" class="tit1 " title="如何做苹果企业签名？">如何做苹果企业签名？</a>
<a href="/index.php/trusted-app" class="tit1 active" title="出现证书信任怎么办？可以不信任直接安装吗？">出现证书信任怎么办？可以不信任直接安装吗？</a>
</dd>
</dl>
</div>
</div>
<div class="col-sm-10">
<div class="details-right">
<div class="article-tit">出现证书信任怎么办？可以不信任直接安装吗？</div>
<div class="article-con">
<p>出现证书信任，都是苹果APP已经做了企业签名，没有点击信任证书，导致APP无法正常打开。</p><p><br/></p><p>如何企业证书信任，有两种方式。<span style="color: rgb(0, 176, 240);"></span><br/></p><p><span style="color:#00b0f0">第一种 从手机中寻找证书信任</span></p><p>1. 点击安装好的APP，以【说拼】为例，点击【说拼】图标，查看证书名称。记住红线部分名称。</p><p><img src="/static/cloud/course/img/anzhuang1.png"/></p><p><br/></p><p>2. 打开手机设置，选择通用</p><p><img src="/static/cloud/course/img/anzhuang2.png"/></p><p><br/></p><p>3. 点击刚才查看的证书名称</p><p><img src="/static/cloud/course/img/anzhuang3.png"/></p><p><br/></p><p>4. 点击信任即可</p><p><img src="/static/cloud/course/img/anzhuang4.png"/></p><p><br/></p><p><span style="color:#00b0f0">第二种、从下载页，直接拉起信任，</span><span style="white-space: normal;color:#00b0f0">点击立即安装后，按钮会变成“信任开发者”</span></p><p>提示：由于APP大小的缘故，建议等到APP安装完成后，再去点击蓝色按钮“信任开发者”</p><p><img src="/static/cloud/course/img/anzhuang5.png"/></p><p><br/></p><p>安装完成之后，点击“信任信任开发者”，将出现以下页面，点击“允许”</p><p><img src="/static/cloud/course/img/anzhuang6.png"/></p><p><br/></p><p>跳出允许后，将会直接打开设置——描述文件，点击证书名称。</p><p><img src="/static/cloud/course/img/anzhuang7.png"/></p><p><br/></p><p>点击证书名称后，点击信任。</p><p><img src="/static/cloud/course/img/anzhuang8.png"/></p><p>信任完成之后，即可正常打开APP使用。</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p>                    </div>
</div>
</div>
</div>
</div>
</div>
<?php include 'source/index/footer.php'; ?>
</body>
</html>
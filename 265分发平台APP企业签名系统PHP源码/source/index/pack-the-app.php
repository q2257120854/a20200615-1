<!doctype html>
<html lang="zh">
<head>
<title>打包iOS的IPA文件 - <?php echo IN_NAME; ?></title>
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
<a href="/index.php/pack-the-app" class="tit1 active" title="打包 iOS 的 IPA 文件">打包 iOS 的 IPA 文件</a>
<a href="/index.php/realnameproblem" class="tit1 " title="实名认证有何作用？需要填写哪些材料？">实名认证有何作用？需要填写哪些材料？</a>
<a href="/index.php/publish_hebing" class="tit1 " title="怎样上传发布APP，合并安卓和苹果链接和二维码?">怎样上传发布APP，合并安卓和苹果链接和二维码?</a>
<a href="/index.php/app-edit" class="tit1 " title="如何设置APP相关信息（例如更换图标、选择下载页等）？">如何设置APP相关信息（例如更换图标、选择下载页等）？</a>
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
                    <div class="article-tit">打包 iOS 的 IPA 文件</div>
                    <div class="article-con">
                        <p><span style="font-family: 微软雅黑; letter-spacing: 0px; font-size: 16px;color:#00b0f0">一、打包IPA方式<span style="text-decoration:underline;"></span></span></p><p><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);letter-spacing: 0;font-size: 16px">IPA 文件，即 iOS 应用的安装包文件，扩展名为<span style="background-color: rgb(255, 255, 0);">&nbsp;</span></span><span style="background-color: rgb(255, 255, 0);"><span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: 微软雅黑; color: rgb(199, 37, 78); letter-spacing: 0px; font-size: 16px;">.ip</span><span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: 微软雅黑; color: rgb(199, 37, 78); letter-spacing: 0px; font-size: 16px;">a</span></span><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);letter-spacing: 0;font-size: 16px"><span style="font-family:微软雅黑">。能否正确的打包</span> IPA 文件，是决定了 IPA 文件做成下载后，是否可以正常安装。</span></p><p><br/></p><p>有两种方式可以打包</p><p>1.&nbsp;<span style="font-family: 微软雅黑; color: rgb(85, 85, 85); letter-spacing: 0px;"><span style="font-family:微软雅黑">使用命令行</span><span style="background-color: rgb(255, 255, 0);">&nbsp;</span></span><span style="font-family: 微软雅黑; letter-spacing: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 0);color:#ff0000">xcodebuild exportArchive -exportFormat ipa</span><span style="font-family: 微软雅黑; color: rgb(85, 85, 85); letter-spacing: 0px;">来完成</span></p><p><span style="font-family: 微软雅黑; color: rgb(85, 85, 85); letter-spacing: 0px;">2.&nbsp;</span><span style="font-family:微软雅黑;color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;">使用</span><span style="font-family: 微软雅黑; letter-spacing: 0px;"> <span style="background-color: rgb(255, 255, 0);color:#ff0000">Xcode </span><span style="color:#555555">打包</span></span></p><p><span style="color:#555555;font-family:微软雅黑">第二种打包方式最为简单，以下文字将详细介绍说明第二种打包方式。</span></p><p><span style="font-family:微软雅黑;color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><br/></span></p><p><span style="font-family: 微软雅黑; letter-spacing: 0px;color:#00b0f0">二、使用Xcode打包</span></p><p><span style="font-family:微软雅黑;color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;">首先在</span><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"> Xcode 中，将编译的目标机器设置成 “iOS Device”，然后点击”Product”–&gt;“Archive”，如图所示：</span></p><p><img src="/static/cloud/course/img/dabao1.png"/><span style="color:#555555;font-family:微软雅黑"></span></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><br/></span></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;">Archive 成功之后，就可以在 Xcode 的 Organizer 中看到相应的文件。然后</span><span style="font-family:微软雅黑;color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;">点击</span><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"> Organizer 中的 “Export” 按钮，如下图所示：</span></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><img src="/static/cloud/course/img/dabao2.png"/></span></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><br/></span></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"></span></p><p><span style=";font-family:微软雅黑;font-size:16px">在接下来的弹出界面中需要选择证书类型，选择方式如下：</span></p><p><span style=";font-family:微软雅黑;font-size:16px"><span style="font-family:微软雅黑">1. 如果是<span style="font-family: 微软雅黑; white-space: normal;">($99)</span>个人或公司苹果开发者账号</span>，请选择 “Save for Ad Hoc Deployment”</span></p><p><span style=";font-family:微软雅黑;font-size:16px"><span style="font-family:微软雅黑">2. 如果是<span style="font-family: 微软雅黑; white-space: normal;">($299)</span>企业苹果开发者账号</span>，请选择 “Save for Enterprice Deployment”</span></p><p><br/></p><p>请查看以下图片：</p><p><img src="/static/cloud/course/img/dabao3.png"/></p><p><br/></p><p><span style=";font-family:微软雅黑;font-size:16pxcolor:#ff0000"><span style="font-family:微软雅黑">提示：请不要选择</span> “Save for iOS App Store Deployment”，否则会出现无法通过<?php echo IN_NAME; ?>安装的情况。</span></p><p><span style=";font-family:微软雅黑;font-size:16px"><span style="font-family:微软雅黑">选择完成后点</span> Next，Xcode 会自动将测试设备的签名信息附加上，并将相应的 IPA 文件导出。</span></p><p><br/></p><p><br/></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><br/></span><br/></p><p><span style="color: rgb(85, 85, 85); font-family: 微软雅黑; letter-spacing: 0px;"><br/></span><br/></p><p><span style="color:#555555;font-family:微软雅黑"><br/></span></p><p><span style="font-family: 微软雅黑; letter-spacing: 0px;color:#555555"><br/></span></p><p><span style="font-family: 微软雅黑; color: rgb(85, 85, 85); letter-spacing: 0px;"></span><br/></p><p><br/></p>                    </div>
                </div>
            </div>
</div>
</div>
</div>
<?php include 'source/index/footer.php'; ?>
</body>
</html>
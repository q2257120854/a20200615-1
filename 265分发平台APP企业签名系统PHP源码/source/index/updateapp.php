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
<a href="/index.php/updateapp" class="tit1 active" title="APP更新签名了，如何操作发布？">APP更新签名了，如何操作发布？</a>
<a href="/index.php/ios-enterprise-certificates" class="tit1 " title="如何做苹果企业签名？">如何做苹果企业签名？</a>
<a href="/index.php/trusted-app" class="tit1 " title="出现证书信任怎么办？可以不信任直接安装吗？">出现证书信任怎么办？可以不信任直接安装吗？</a>
</dd>
</dl>
</div>
</div>
<div class="col-sm-10">
<div class="details-right">
<div class="article-tit">APP更新签名了，如何操作发布？</div>
<div class="article-con">
<p>重要提示：</p><p>1. 每次APP功能有更新，必须要重新更新签名。（更新签名是免费的）</p><p>2. APP签名更新好后，需要重新下载签名包。如果是在<?php echo IN_NAME; ?>发布，需要在【发布】栏，选中需要更新的APP，进行更新链接。</p><p>3. 更新签名，APP的名称和包名（Bundle ID）不能变化。</p><p>4. 更新签名是程序自动签名，10分钟内即可签好。</p><p><br/></p><p>具体操作：</p><p>第一步、在【签名】栏，点击【我的签名】，以APP【考研英语】为例，点击更新；</p><p><br/></p><p>第二步、上传完成后，填写信息（如果测试账号和密码有变化）；</p><p><br/></p><p>更新目前免费，点击按钮【去支持】</p><p><br/></p><p>支付完成后，页面将停留在【等待签名页】，10分钟内，签名将自动完成。</p><p><br/></p><p>签名完成后，进入到如下页面：</p><p>可以点击测试下载链接，用来测试安装到苹果设备上，<span style="color:#ff0000">【注意：测试链接只是用来测试，只有5次下载】</span></p><p>点击【下载签名包】，保存到电脑上。</p><p><br/></p><p>第三步、将签名好的APP包，去【<span style="white-space: normal;">发布</span>】--【应用列表】栏，选择年要更新的APP一行，点击【更新】按钮。</p><p style="white-space: normal;"><br/></p><p style="white-space: normal;">点击更新后，将第二步步骤保存好的APP包（后缀是.ipa文件）进行上传，上传完成后，即可查看APP下载页，链接、二维码和之前一致，没有变化。</p><p style="white-space: normal;"><br/></p><p style="white-space: normal;">同一个APP包，为了保证链接一致，只需要在【发布-应用列表】中，选择所需更新的APP那一行，点击【更新】上传APP即可。</p><p><br/></p><p><br/></p><p><br/></p>                    </div>
</div>
</div>
</div>
</div>
</div>
<?php include 'source/index/footer.php'; ?>
</body>
</html>
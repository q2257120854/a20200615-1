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
<a href="/index.php/ios-enterprise-certificates" class="tit1 active" title="如何做苹果企业签名？">如何做苹果企业签名？</a>
<a href="/index.php/trusted-app" class="tit1 " title="出现证书信任怎么办？可以不信任直接安装吗？">出现证书信任怎么办？可以不信任直接安装吗？</a>
</dd>
</dl>
</div>
</div>
<div class="col-sm-10">
<div class="details-right">
<div class="article-tit">如何做苹果企业签名？</div>
<div class="article-con">
<p>苹果企业签名是专门针对苹果APP，在苹果设备没有越狱，APP没有上架苹果商店的情况下，可以快速解决安装苹果APP安装问题。</p><p><br/></p><p>企业签名购买流程：</p><p>1. 先上传APP包，</p><p>2. 填写APP相关信息（测试账号、密码等），</p><p>3. 购买成功后，等待10分钟左右，程序将自动完成签名。</p><p><br/></p><p>注意事项：</p><p>1.&nbsp;<span style="white-space: normal;">苹果企业签名，只针对苹果APP，安卓不需要签名；</span></p><p><span style="white-space: normal;">2. 凡是在购买期限内，更新都是免费，直接在网站上提交所需更新签名的包，程序将更新签名。</span></p><p><span style="white-space: normal;"><br/></span></p><p>图示：</p><p>登录<?php echo IN_NAME; ?></p><p>第一步、点击【签名】，然后【同意】用户签名协议。</p><p><br/></p><p>第二步、点击上传所需签名的APP，上传网站，目前在线签名，只支持500M以内的包，如果超过500M，请联系网站客服</p><p><span style="white-space: normal;"><br/></span></p><p>第三步、上传完成后，填写APP相关信息。</p><p><span style="white-space: normal;"><br/></span></p><p>第四步、选择套餐，独立版最稳定（购买独立版季度以上，可以支持消息推送）</p><p><br/></p><p>第五步、购买成功，等待10分钟左右，程序将自动签名（如果签名不成功，客服人员将通过QQ与您联系）</p><p><br/></p><p>第六步、签名完成，下载签名包，将签名包上传到【发布】，即可获得正式下载地址。</p><p><br/></p>                    </div>
</div>
</div>
</div>
</div>
</div>
<?php include 'source/index/footer.php'; ?>
</body>
</html>
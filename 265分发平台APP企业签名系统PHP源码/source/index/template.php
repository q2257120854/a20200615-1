<?php
$info = explode('/',isset($_SERVER['PATH_INFO']) ?$_SERVER['PATH_INFO'] : NULL);
$appid = trim(isset($info[2]) ?SafeSql($info[2]) : NULL);
$tmp = trim(isset($info[3]) ?SafeSql($info[3]) : NULL);
$id = bees_decrypt($appid);
if(is_numeric($id)){
	$row = $GLOBALS['db']->getrow("select * from ".tname('appid')." where in_id=".$id);
}
if(!$row or !$tmp) exit(header('location:'.IN_PATH));
$tmpid= substr($tmp,3);
?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta itemprop="name" content="<?php echo IN_NAME; ?>" />
<meta itemprop="image" content="//<?php echo $_SERVER['HTTP_HOST']; ?><?php echo geticon($row['in_icon']); ?>" />
<meta name="description" itemprop="description" content="<?php echo IN_DESCRIPTION; ?>">
<link rel="stylesheet" href="/static/default/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="/static/default/css/style.css" />
<link rel="stylesheet" href="/static/default/css/custom.css">
<link rel="stylesheet" href="/static/default/css/appstyle.css">
<link rel="stylesheet" href="/static/default/css/swiper.min.css" />
<link rel="stylesheet" href="//at.alicdn.com/t/font_780494_9oilb5iic5f.css" />
<link rel="stylesheet" href="/static/default/css/base.css" />
<link rel="stylesheet" href="/static/default/css/main.css" />
<link rel="stylesheet" href="/static/default/css/h5.css" />
<link rel="shortcut icon" href="//<?php echo $_SERVER['HTTP_HOST']; ?>/favicon.ico" type="image/x-icon" />
<script>
    var www_domain = "https://<?php echo $_SERVER['HTTP_HOST']; ?>/";
</script>
</head>
<body>
<input name="url" value="<?php echo $row['in_link']; ?>" type="hidden">
<script type="text/template" id="title">
    <title>{{app_name}}</title>
</script>
<script language="text/template" id="meta">
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="{{keywords}}">
    <meta name="description" content="{{desciption}}">
    <link rel="shortcut icon" href="//<?php echo $_SERVER['HTTP_HOST']; ?>/favicon.ico" type="image/x-icon"/>
    <meta name="baidu-site-verification" content="ukBKOPYfE2"/>
    <meta name="baidu-site-verification" content="xSBa81fLpH"/>
    <meta name="author" content="<?php echo $_SERVER['HTTP_HOST']; ?>">
    <meta property="og:type" content="webpage">
    <meta property="og:url" content="{{web_url}}">
    <meta property="og:title" content="{{app_name}}">
    <meta property="og:description" content="{{app_name}}">
    <meta itemprop="name" content="{{app_name}}" />
    <meta itemprop="image" content="{{icon_300}}" />
    <meta name="description" itemprop="description" content="版本：{{version}}.{{version_code}}, 大小：{{app_size}}">
    <meta name="apple-mobile-web-app-title" content="{{web_url}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
</script>
<?php if($tmpid == 1){ ?>
<script language="text/template" id="content">
        {{if checked}}
        <div class="template-1 template-wrap">
            {{else}}
            <div class="template-1 template-wrap passwords">
                {{/if}}
                <div class="t-bg-1"></div>
                <div class="container">
                    <div class="content clearfix">
                        <div class="c-left fl">
                            <div class="template-common">
                                <div class="t-icon">
                                    <img src="{{icon}}" class="img-responsive">
                                </div>
                                <div class="visible-xs">
                                    <div class="t-name">
                                        <div class="tit">{{app_name}}</div>
                                        <div class="pc-pwd name-info">
                                    <span>
                                        {{VERSION}} {{version}}
                                        {{if version_code}}
                                    （Build {{version_code}}）
                                    {{/if}}
                                    </span>
                                            <span>{{SIZE}} {{app_size}}</span><span>{{UPDATE_TIME}} {{update_dt}}</span>
                                        </div>
                                    </div>
                                </div>
                                {{if checked}}
                                <div id="showtext" style="text-align: center;margin-top:30px;display: none;">
                                    <div style="color: #1abc9c">{{VIEW_IN_DESKTOP}}</div>
                                    <div class="loading"></div>
                                </div>
                                <div class="template-btn-wrap">
                                    <a href="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                        <span class="icon-36 iconfont fl"></span>
                                        <span class="fl">{{DOWNLOAD_INSTALL}}</span>
                                    </a>
                                </div>
                                <div class="t-apply pc-pwd">
                                    {{if support|equals>3}}
                                    {{FOR_IOS_AND_ANDROID}}
                                    {{else}}
                                    {{if support|equals>2}}
                                    {{FOR_ANDROID}}
                                    {{else}}
                                    {{FOR_IOS}}
                                    {{/if}}
                                    {{/if}}
                                </div>
                                {{/if}}

                                <div class="t-code phone-pwd">
                                    <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                    <div class="code-text">{{SCAN_TIPS}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="c-right fl">
                            <div class="template-common">
                                <div class="t-name hidden-xs">
                                    <div class="tit">{{app_name}}</div>
                                    <div class="name-info">
                                <span>
                                    {{VERSION}} {{version}}
                                    {{if version_code}}
                                    （Build {{version_code}}）
                                    {{/if}}
                                </span>
                                        <span>{{SIZE}} {{app_size}}</span>
                                        <span>{{UPDATE_TIME}} {{update_dt}}</span>
                                    </div>
                                </div>
                                <!--密码框-->

                                {{if checked|false}}
                                <div class="template-pwd">
                                    <div class="form-group">
                                        <label>{{REQUIRE_PWD}}</label>
                                        <input type="password" id="password" name="pwd" class="form-control">
                                    </div>
                                    <div class="top-pwd hidden-xs">
                                        <span class="iconfont icon-mima"></span>
                                    </div>
                                    <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()">
                                        {{DOWNLOAD_ENTER}}
                                    </button>
                                    <div class="t-code visible-xs">
                                        <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                        <div class="code-text">{{SCAN_TIPS}}</div>
                                    </div>
                                </div>
                                {{/if}}
                                <!--/密码框-->
                                <hr class="pc-pwd">
                                {{if app_intro}}
                                <div class="t-introduce pc-pwd">
                                    <div class="tit">{{APP_DESCRIPTION}}</div>
                                    <p>{{app_intro}}</p>
                                </div>
                                {{/if}}

                                {{if remark}}
                                <div class="t-introduce pc-pwd">
                                    <div class="tit">{{APP_REMARK}}</div>
                                    <p>{{remark}}</p>
                                </div>
                                {{/if}}
                                {{if qq}}
                                <div class="t-contact pc-pwd">
                                    <div class="tit">{{APP_CONTACT}}</div>
                                    <dl class="clearfix">
                                        <dd class="fl">{{qq}}</dd>
                                    </dl>
                                </div>
                                {{/if}}

                                {{if screenshots}}
                                <div class="app-screen pc-pwd">
                                    <div class="tit">{{APP_SCREENSHOTS}}</div>
                                    <div class="s-responsive">
                                        {{screenshots}}
                                    </div>
                                </div>
                                {{/if}}
                            </div>
                        </div>
                    </div>

</script>
<?php } else if($tmpid == 2){ ?>
 <script language="text/template" id="content">
        {{if checked}}
        <div class="template-2 template-wrap">
            {{else}}
            <div class="template-2 template-wrap passwords">
                {{/if}}
                <div class="t-bg-2"></div>
                <div class="container">
                    <div class="content">
                        <div class="template-common">
                            <div class="t-icon">
                                <img src="{{icon}}" class="img-responsive">
                            </div>
                            <div class="t-name">
                                <div class="tit">{{app_name}}</div>
                                <div class="name-info pc-pwd">
                                <span>{{VERSION}} {{version}}
                                        {{if version_code}}
                                    （Build {{version_code}}）
                                    {{/if}}
                                </span>
                                    <span>{{SIZE}} {{app_size}}</span><span>{{UPDATE_TIME}} {{update_dt}}</span>
                                </div>
                            </div>
                            {{if checked|false}}
                            <!--密码框-->
                            <div class="template-pwd">
                                <div class="form-group">
                                    <label>{{REQUIRE_PWD}}</label>
                                    <input type="password" name="pwd" class="form-control">
                                </div>
                                <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()">
                                    {{DOWNLOAD_ENTER}}
                                </button>
                                <div class="t-code">
                                    <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                    <div class="code-text">{{SCAN_TIPS}}</div>
                                </div>
                            </div>
                            <!--/密码框-->
                            {{/if}}
                            {{if checked}}
                            <div id="showtext" style="text-align: center;margin-top:30px;display: none">
                                <div style="color: #1abc9c">{{VIEW_IN_DESKTOP}}</div>
                                <div class="loading"></div>
                            </div>
                            <div class="template-btn-wrap">				
                                <a href="{{downurl}}" link="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                    <span class="icon-36 iconfont fl"></span>
                                    <span class="fl">
                                    {{DOWNLOAD_INSTALL}}
                                </span>
                                </a>
                            </div>
                            <div class="t-apply pc-pwd">
                                {{if support|equals>3}}
                                {{FOR_IOS_AND_ANDROID}}
                                {{else}}
                                {{if support|equals>2}}
                                {{FOR_ANDROID}}
                                {{else}}
                                {{FOR_IOS}}
                                {{/if}}
                                {{/if}}
                            </div>
                            {{/if}}
                            <div class="t-code pc-pwd">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                            <hr class="pc-pwd">
                            {{if app_intro}}
                            <div class="t-introduce pc-pwd">
                                <div class="tit">{{APP_DESCRIPTION}}</div>
                                <p>{{app_intro}}</p>
                            </div>
                            {{/if}}

                            {{if remark}}
                            <div class="t-introduce pc-pwd">
                                <div class="tit">{{APP_REMARK}}</div>
                                <p>{{remark}}</p>
                            </div>
                            {{/if}}
                            {{if qq}}
                            <div class="t-contact pc-pwd">
                                <div class="tit">{{APP_CONTACT}}</div>
                                <dl class="clearfix">
                                    <dd class="fl">{{qq}}</dd>
                                </dl>
                            </div>
                            {{/if}}
                            {{if screenshots}}
                            <div class="app-screen pc-pwd">
                                <div class="tit">{{APP_SCREENSHOTS}}</div>
                                <div class="s-responsive">
                                    {{screenshots}}
                                </div>
                            </div>
                            {{/if}}
                        </div>
                    </div>
                </div>
            </div>
</script>
<?php } else if($tmpid == 3){ ?>
<script language="text/template" id="content">
    {{if checked}}
    <div class="template-3 template-wrap">
        {{else}}
        <div class="template-3 template-wrap passwords">
            {{/if}}
            <div class="t-bg-3"></div>
            <div class="container">
                <div class="content">
                    <div class="template-common">
                        <div class="t-icon"><img src="{{icon}}" class="img-responsive"></div>
                        <div class="t-name">
                            <div class="tit">{{app_name}}</div>
                            <div class="name-info pc-pwd">
                                <span> {{VERSION}} {{version}}
                                        {{if version_code}}
                                    （Build {{version_code}}）
                                    {{/if}}</span> <span>{{SIZE}} {{app_size}}</span><span>{{UPDATE_TIME}} {{update_dt}}</span>
                            </div>
                        </div>
                        {{if checked|false}}
                        <!--密码框-->
                        <div class="template-pwd">
                            <div class="form-group">
                                <label>{{REQUIRE_PWD}}</label>
                                <input type="password" name="pwd" class="form-control">
                            </div>
                            <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()">{{DOWNLOAD_ENTER}}</button>
                            <div class="t-code">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                        </div>
                        <hr class="pc-pwd">
                        <!--/密码框-->
                        {{/if}}
                        {{if checked}}
                        <div id="showtext" style="text-align: center;margin-top:30px;display: none">
                            <div style="color: #1abc9c">{{VIEW_IN_DESKTOP}}</div>
                            <div class="loading"></div>
                        </div>
                        <div class="template-btn-wrap">
                            <a href="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                <span class="icon-36 iconfont fl"></span>
                                <span class="fl">{{DOWNLOAD_INSTALL}}</span>
                            </a>
                        </div>
                        <div class="t-apply pc-pwd">
                            {{if support|equals>3}}
                            {{FOR_IOS_AND_ANDROID}}
                            {{else}}
                            {{if support|equals>2}}
                            {{FOR_ANDROID}}
                            {{else}}
                            {{FOR_IOS}}
                            {{/if}}
                            {{/if}}
                        </div>
                        {{/if}}
                        <div class="t-code pc-pwd">
                            <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                            <div class="code-text">{{SCAN_TIPS}}</div>
                        </div>
                        {{if app_intro}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_DESCRIPTION}}</div>
                            <p>{{app_intro}}</p>
                        </div>
                        {{/if}}

                        {{if remark}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_REMARK}}</div>
                            <p>{{remark}}</p>
                        </div>
                        {{/if}}
                        {{if qq}}
                        <div class="t-contact pc-pwd">
                            <div class="tit">{{APP_CONTACT}}</div>
                            <dl class="clearfix">
                                <dd class="fl">{{qq}}</dd>
                            </dl>
                        </div>
                        {{/if}}

                        {{if screenshots}}
                        <div class="app-screen pc-pwd">
                            <div class="tit">{{APP_SCREENSHOTS}}</div>
                            <div class="s-responsive">
                                {{screenshots}}
                            </div>
                        </div>
                        {{/if}}
                    </div>
                </div>
            </div>
        </div>
</script>
<?php } else if($tmpid == 4){ ?>
<script language="text/template" id="content">
    {{if checked}}
    <div class="template-4 template-wrap">
        {{else}}
        <div class="template-4 template-wrap passwords">
            {{/if}}
            <div class="t-bg-4 clearfix">
                <div class="container">
                    <div class="content4 clearfix">
                        <div class="t-left fl">
                            <div class="template-common">
                                <div class="t-icon">
                                    <img src="{{icon}}" class="img-responsive">
                                </div>
                                <div class="t-name">
                                    <div class="tit">{{app_name}}</div>
                                    <div class="name-info hidden-xs">
                                       <span>{{VERSION}} {{version}}
                                        {{if version_code}}
                                    （Build {{version_code}}）
                                    {{/if}}</span> <span>{{SIZE}} {{app_size}}</span><span>{{UPDATE_TIME}} {{update_dt}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="t-right fl">
                            <div class="template-common">
                                <div class="t-name visible-xs pc-pwd">
                                    <div class="name-info">
                                        <span>
                                            {{VERSION}} {{version}}
                                            {{if version_code}}
                                            （Build {{version_code}}）
                                            {{/if}}
                                        </span>
                                        <span>{{SIZE}} {{app_size}}</span>
                                        <span>{{UPDATE_TIME}} {{update_dt}}</span>
                                    </div>
                                </div>

                                {{if checked}}
                                <div id="showtext" style="text-align: center;margin-top:30px;display: none">
                                    <div style="color: #1abc9c">{{VIEW_IN_DESKTOP}}</div>
                                    <div class="loading"></div>
                                </div>
                                <div class="template-btn-wrap">
                                    <a href="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                        <span class="icon-36 iconfont fl"></span>
                                        <span class="fl">
                                        {{DOWNLOAD_INSTALL}}
                                        </span>
                                    </a>
                                </div>
                                <div class="t-apply c-pwd">
                                    {{if support|equals>3}}
                                    {{FOR_IOS_AND_ANDROID}}
                                    {{else}}
                                    {{if support|equals>2}}
                                    {{FOR_ANDROID}}
                                    {{else}}
                                    {{FOR_IOS}}
                                    {{/if}}
                                    {{/if}}
                                </div>

                                {{/if}}

                                <div class="t-code phone-pwd">
                                    <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                    <div class="code-text">{{SCAN_TIPS}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content">
                    <div class="template-common">

                        {{if checked|false}}
                        <!--密码框-->
                        <div class="template-pwd">
                            <div class="form-group">
                                <label>{{REQUIRE_PWD}}</label>
                                <input type="password" name="pwd" class="form-control">
                            </div>
                            <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()">{{DOWNLOAD_ENTER}}</button>
                            <div class="t-code visible-xs">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                        </div>
                        <!--/密码框-->
                        {{/if}}

                        <hr class="pc-pwd">
                        {{if app_intro}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_DESCRIPTION}}</div>
                            <p>{{app_intro}}</p>
                        </div>
                        {{/if}}

                        {{if remark}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_REMARK}}</div>
                            <p>{{remark}}</p>
                        </div>
                        {{/if}}
                        {{if qq}}
                        <div class="t-contact pc-pwd">
                            <div class="tit">{{APP_CONTACT}}</div>
                            <dl class="clearfix">
                                <dd class="fl">{{qq}}</dd>
                            </dl>
                        </div>
                        {{/if}}
                        {{if screenshots}}
                        <div class="app-screen pc-pwd">
                            <div class="tit">{{APP_SCREENSHOTS}}</div>
                            <div class="s-responsive">
                                {{screenshots}}
                            </div>
                        </div>
                        {{/if}}
                    </div>
                </div>
            </div>
        </div>
</script>
<?php } else if($tmpid == 5){ ?>
<script language="text/template" id="content">
    {{if checked}}
    <div class="template-5 template-wrap">
        {{else}}
        <div class="template-5 template-wrap passwords">
            {{/if}}
            <div class="left-bg"></div>
            <div class="right-bg"></div>
            <div class="container">
                <div class="content">
                    <div class="template-common">
                        <div class="t-icon">
                            <img src="{{icon}}" class="img-responsive">
                            <div class="bg-shadow hidden-xs"></div>
                            <div class="t-icon code hidden-xs">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                            </div>
                        </div>
                        <div class="t-name-wrap">
                            <div class="t-name">
                                <div class="tit">{{app_name}}</div>
                                <div class="name-info">
                                    <span>
                                            {{VERSION}} {{version}}
                                            {{if version_code}}
                                            （Build {{version_code}}）
                                            {{/if}}
                                        </span>
                                    <span>{{SIZE}} {{app_size}}</span>
                                    <br/>
                                    <span>{{UPDATE_TIME}} {{update_dt}}</span>
                                </div>
                            </div>

                            {{if checked}}
                            <div id="showtext" style="text-align: center;margin-top:30px;display: none">
                                <div style="color: #1abc9c">{{VIEW_IN_DESKTOP}}</div>
                                <div class="loading"></div>
                            </div>

                            <div class="template-btn-wrap">
                                <a href="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                    <span class="icon-36 iconfont fl"></span>
                                    <span class="fl">{{DOWNLOAD_INSTALL}}</span>
                                </a>
                            </div>
                            <div class="t-apply c-pwd">
                                {{if support|equals>3}}
                                {{FOR_IOS_AND_ANDROID}}
                                {{else}}
                                {{if support|equals>2}}
                                {{FOR_ANDROID}}
                                {{else}}
                                {{FOR_IOS}}
                                {{/if}}
                                {{/if}}
                            </div>

                            {{/if}}
                            <div class="t-code pc-pwd visible-xs">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                        </div>

                        {{if checked|false}}
                        <!--密码框-->
                        <div class="template-pwd">
                            <div class="form-group">
                                <label>{{REQUIRE_PWD}}</label>
                                <input type="password" name="pwd" class="form-control">
                            </div>
                            <div class="top-pwd hidden-xs"><span class="iconfont icon-mima"></span></div>
                            <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()"> {{DOWNLOAD_ENTER}}</button>
                            <div class="t-code visible-xs">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                        </div>
                        <!--/密码框-->
                        {{/if}}


                        <hr class="show pc-pwd">

                        {{if app_intro}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_DESCRIPTION}}</div>
                            <p>{{app_intro}}</p>
                        </div>
                        {{/if}}

                        {{if remark}}
                        <div class="t-introduce pc-pwd">
                            <div class="tit">{{APP_REMARK}}</div>
                            <p>{{remark}}</p>
                        </div>
                        {{/if}}
                        {{if qq}}
                        <div class="t-contact pc-pwd">
                            <div class="tit">{{APP_CONTACT}}</div>
                            <dl class="clearfix">
                                <dd class="fl">{{qq}}</dd>
                            </dl>
                        </div>
                        {{/if}}
                        {{if screenshots}}
                        <div class="app-screen pc-pwd">
                            <div class="tit">{{APP_SCREENSHOTS}}</div>
                            <div class="s-responsive">
                                {{screenshots}}
                            </div>
                        </div>
                        {{/if}}
                    </div>
                </div>
            </div>
        </div>
</script>
<?php } else if($tmpid == 6){ ?>
<script language="text/template" id="content">
        {{if checked}}
        <div class="template-6 template-wrap">
            {{else}}
            <div class="template-6 template-wrap passwords">
                {{/if}}
                <div class="t-bg-6 clearfix">
                    <div class="container">
                        <div class="t-top clearfix">
                            <div class="tit fl">{{app_name}}</div>
                            <div class="name-info fr">
                            <span>
                                {{VERSION}} {{version}}
                                {{if version_code}}
                                （Build {{version_code}}）
                                {{/if}}
                            </span>
                                <span>{{SIZE}} {{app_size}}</span>
                                <span>{{UPDATE_TIME}} {{update_dt}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="content">
                        <div class="template-common">
                            <div class="t-icon"><img src="{{icon}}" class="img-responsive"></div>
                            {{if checked}}
                            <hr class="show-hr pc-pwd">
                            <div class="template-btn-wrap">
                                <a href="{{downurl}}" type="ios" class="ms-btn template-btn clearfix pc-pwd down_load">
                                    <span class="icon-36 iconfont fl"></span>
                                    <span class="fl">{{DOWNLOAD_INSTALL}}</span>
                                </a>
                            </div>
                            <div class="t-apply pc-pwd">
                                {{if support|equals>3}}
                                {{FOR_IOS_AND_ANDROID}}
                                {{else}}
                                {{if support|equals>2}}
                                {{FOR_ANDROID}}
                                {{else}}
                                {{FOR_IOS}}
                                {{/if}}
                                {{/if}}
                            </div>
                            {{/if}}

                            {{if checked|false}}
                            <!--密码框-->
                            <div class="template-pwd">
                                <div class="form-group">
                                    <label>{{REQUIRE_PWD}}</label>
                                    <input type="password" name="pwd" class="form-control">
                                </div>
                                <button type="button" class="ms-btn decoding" onclick="DAFU.submitPwd()">{{DOWNLOAD_ENTER}}</button>
                                <div class="t-code visible-xs">
                                    <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                    <div class="code-text">{{SCAN_TIPS}}</div>
                                </div>
                            </div>
                            <!--/密码框-->

                            {{/if}}


                            <div class="t-code pc-pwd">
                                <img src="/source/pack/qrcode/qrcode.php?link={{qrcode_url}}" class="img-responsive">
                                <div class="code-text">{{SCAN_TIPS}}</div>
                            </div>
                            <hr class="pc-pwd">
                            {{if app_intro}}
                            <div class="t-introduce pc-pwd">
                                <div class="tit">{{APP_DESCRIPTION}}</div>
                                <p>{{app_intro}}</p>
                            </div>
                            {{/if}}

                            {{if remark}}
                            <div class="t-introduce pc-pwd">
                                <div class="tit">{{APP_REMARK}}</div>
                                <p>{{remark}}</p>
                            </div>
                            {{/if}}
                            {{if qq}}
                            <div class="t-contact pc-pwd">
                                <div class="tit">{{APP_CONTACT}}</div>
                                <dl class="clearfix">
                                    <dd class="fl">{{qq}}</dd>
                                </dl>
                            </div>
                            {{/if}}
                            {{if screenshots}}
                            <div class="app-screen pc-pwd">
                                <div class="tit">{{APP_SCREENSHOTS}}</div>
                                <div class="s-responsive">
                                    {{screenshots}}
                                </div>
                            </div>
                            {{/if}}
                        </div>
                    </div>
                </div>
            </div>
</script>
<?php } ?>
<div class="modal fade ms-modal" id="reportSuccess" tabindex="-1" role="dialog">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-body">
<div class="text-center">
<div><span class="icon icon-modal-success2"></span></div>
<p class="color-333 bold font16 mt5">{{REPORT_THANKS}}</p>
<p class="color-333 mt5">{{REPORT_MESSAGE}}</p>
<div class="mt15">
<button type="button" class="ms-btn ms-btn-default w90" data-dismiss="modal">{{BUTTON_OK}}</button>
</div>
</div>
</div>
 </div>
</div>
</div>


<div class="modal fade ms-modal auto-hide-modal" id="autoHideTemplateModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-body">
<div class="text-center">
<div class="auto-hide">
<div class="mt5">{{PASSWORD_WRONG}}</div>
</div>
</div>
</div>
</div>
</div>
</div>

<style>
    body{
        padding-bottom: 10px;}
</style>
<script language="text/template" id="copyright">
    <div class="template-footer">
        <div class="container">
            <div class="t-footer">
                <a href="//<?php echo $_SERVER['HTTP_HOST']; ?>?source=down_page" target="_blank">{{DIBAQU}}</a> |
                <a target="_blank" href="//<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/disclaimer?source=down_page">{{DISCLAIMER}}</a> |
                <a href="javascript:;" onclick="DAFU.reportApp()">{{REPORT}}</a>
            </div>
        </div>
    </div>
    <div id="weixin_ios" style="display:none">
    <div class="click_opacity"></div>
    <div class="to_btn">
        {{GO_OUT_WECHAT_IOS_TIP}}
    </div>
</div>
<div id="weixin_android" style="display: none">
    <div class="click_opacity"></div>
    <div class="to_btn">{{GO_OUT_WECHAT_TIP}}
    </div>
</div>


<!--举报弹窗-->
<div class="modal fade ms-modal" id="reportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="report">
                    <form action="" method="post">
                        <div class="tit">{{REPORT_TITLE}}</div>
                        <p>
                            {{REPORT_TIPS}}
                        </p>
                        <div class="form-group">
                            <label>{{REPORT_REASON_ERROR}}<span>*</span></label>
                            <ul class="clearfix">
                                <li>
                                    <span class="icon icon-radio"></span>{{REPORT_DB}}
                                    <input type="radio" class="hidden" value="0">
                                </li>
                                <li>
                                    <span class="icon icon-radio"></span>{{REPORT_HS}}
                                    <input type="radio" class="hidden" value="1">
                                </li>
                                <li>
                                    <span class="icon icon-radio"></span>{{REPORT_QZ}}
                                    <input type="radio" class="hidden" value="2">
                                </li>
                                <li>
                                    <span class="icon icon-radio"></span>{{REPORT_OTHER}}
                                    <input type="radio" class="hidden" value="3">
                                </li>
                            </ul>
                            <div class="error">{{REPORT_REASON_ERROR}}</div>
                        </div>
                        <div class="form-group">
                            <label>{{REPORT_REASON}}<span>*</span></label>
                            <textarea class="form-control" rows="4" id="report-content"
                                      placeholder="{{REPORT_CONTENT_PLACEHOLDER}}"></textarea>
                            <div class="error">{{REPORT_CONTENT_ERROR}}</div>
                        </div>
                        <div class="form-group">
                            <label>{{REPORT_EMAIL_PLACEHOLDER}}<span>*</span></label>
                            <input type="text" class="form-control" name="email"
                                   placeholder="{{REPORT_EMAIL_PLACEHOLDER}}" id="report-email">
                            <div class="error">{{REPORT_EMAIL_ERROR}}</div>
                        </div>
                        <div class="btn-bottom">
                            <button data-dismiss="modal" type="button" class="ms-btn color-hover">{{REPORT_RETUEN}}</button>
                            <button type="button" class="ms-btn ms-btn-primary save">{{REPORT_BUTTON}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
<script src="/static/default/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/default/js/publish/bootstrap_3.3.7.min.js"></script>
<script type="text/javascript" src="/static/default/js/publish/clipboard_1.7.1.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="/static/default/js/publish/markup.js"></script>
<script type="text/javascript" src="/static/default/js/publish/ua-parser.min.js"></script>
<script type="text/javascript" src="/static/default/js/template/wave.js"></script>
<script type="text/javascript" src="/static/default/js/template.js"></script>
<script>
    function autoHideModal(obj1, time) {
        var autoHide = null;
        clearTimeout(autoHide);
        $(obj1).modal('show');
        $(".modal-backdrop").hide();
        autoHide = setTimeout(function () {
            $(obj1).modal("hide");
        }, time);
    }

    // autoHideModal('#pwdModal', 3000);
    var windowWidth = $(window).width();
    if (windowWidth >= 768) {
        $(".template-btn").click(function () {
            $("#autoHideTemplateModal").find(".modal-dialog").removeClass("modal-sm").find(".auto-hide .mt5").text("请在手机上使用浏览器打开本页面，或者手机扫描页面二维码，即可安装");
            autoHideModal('#autoHideTemplateModal', 3000);
        });
    }	
</script>
</body>
</html>
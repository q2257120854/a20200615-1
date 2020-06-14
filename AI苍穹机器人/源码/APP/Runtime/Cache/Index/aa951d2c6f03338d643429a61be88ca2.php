<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>iBangKF在线客服系统</title>
    <link rel="icon" href="data:;base64,=">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <style type="text/css">
        body {
            height: 100%;
            margin: 0;
        }
        #main {
            background-color: #fdfcfc;
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        #main, #iframe1 {
            border: 0;
            padding: 0;
        }
        .center {
            width: 700px;
            height: 560px;
            margin: -280px 0 0 -350px;
            position: absolute;
            top: 50%;
            left: 50%;
            box-shadow: 0 0 30px 0 rgba(0, 0, 0, .20);
            float: none;
            background: 0 0;
        }
        .full {
            width: 100%;
            height: 100%;
            margin: 0;
            position: absolute;
            top: 0;
            left: 0;
            float: none;
            background: 0 0;
        }
    </style>
</head>
<body>
<div id="main">
    <iframe id="iframe1" scrolling="no"></iframe>
</div>
<script>
    var url = 'http://t.ibangkf.com/i/chat-kefu2019.html?l=kefu2019';
    if (/baidu.Transcoder|mini|android|blackberry|googlebot-mobile|iemobile|Mobile|ipad|iphone|ipod|opera mobile|palmos|webos|ucweb|Windows Phone|Symbian|hpwOS/i.test(navigator.userAgent)) {
        css = "full";
        url = url.replace(/\/chat-/, '/schat-');
    } else {
        css = "center";
    }
    document.getElementById('iframe1').className = css;
    document.getElementById('iframe1').src = url;
</script>
</body>
</html>
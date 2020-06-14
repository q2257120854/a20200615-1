var m_osName = "";
var m_isAndroid = false;
var m_isIOS = false;

function initWebAppInfo() {
    var u = navigator.userAgent;
    m_isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
    m_isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
    if (m_isIOS) {
        m_osName = "IOS";
    } else if (m_isAndroid) {
        m_osName = "ANDROID";
    }
}

function notSupport() {
    alert("Not support");
}

initWebAppInfo();

function xb_loadURL(url) {
    var iFrame;
    iFrame = document.createElement("iframe");
    iFrame.setAttribute("src", url);
    iFrame.setAttribute("style", "display:none;");
    iFrame.setAttribute("height", "0px");
    iFrame.setAttribute("width", "0px");
    iFrame.setAttribute("frameborder", "0");
    document.body.appendChild(iFrame);
    iFrame.parentNode.removeChild(iFrame);
    iFrame = null;
}

// JS　NAVITE 函数
// 01: 支付功能：
function xb_onlinePay(provider, payInfo, callBackFunc) {
    // 判断不同的操作系统调用不同的方法:
    if (window.xb) {
        window.xb.onlinePay(provider, payInfo, callBackFunc);
    } else if (window.webkit && window.webkit.messageHandlers) {
        var obj = {"provider": provider, "payInfo": payInfo, "callBackFunc": callBackFunc};
        window.webkit.messageHandlers.onlinePay.postMessage(obj);
    } else {
        //var obj = {"provider": provider, "payInfo": payInfo, "callBackFunc": callBackFunc};
        //var sUrl = "xb://onlinePay/" + JSON.stringify(obj);
        var sUrl = "xb://onlinePay/?provider=" + provider + "&payInfo=" + encodeURIComponent(payInfo) + "&callBackFunc=" + callBackFunc;
        xb_loadURL(sUrl);
    }

}

// 02: 获取位置
function xb_getLocation(level, successCallBack, errorCallBack) {
    // 判断不同的操作系统调用不同的方法:
    if (window.xb) {
        window.xb.getLoaction(level, successCallBack, errorCallBack);
    } else {
        var sUrl = "xb://getLocation/?level=" + level + "&successCallBack=" + successCallBack + "&errorCallBack=" + errorCallBack;
        xb_loadURL(sUrl);
    }

}

// 03: 分享功能：
function xb_shareImages(typ, text, imageUrls, compressSize) {
    if (window.xb) {
        window.xb.shareImages(typ, text, imageUrls, compressSize);
    } else {
        var sUrl = "xb://shareImages/?typ=" + typ + "&text=" + encodeURIComponent(text) + "&imageUrls=" + encodeURIComponent(imageUrls) + "&compressSize=" + compressSize;
        xb_loadURL(sUrl);
    }

}

// 04: 打开URL功能：
function xb_openUrl(url) {
    if (window.xb) {
        window.xb.openUrl(url);
    } else {
        var sUrl = "xb://openURL/" + encodeURIComponent(url);
        xb_loadURL(sUrl);
    }

}

// 05: 复制文字到剪贴板
function xb_copyToClipboard(text, successMsg) {
    if (window.xb) {
        window.xb.copyToClipboard(text, successMsg);
    } else {
        var sUrl = "xb://copyToClipboard/?text=" + encodeURIComponent(text) + "&successMsg=" + encodeURIComponent(successMsg);
        xb_loadURL(sUrl);
    }

}

// 06 : 语音合成：
function xb_voicePlay(data, person, callBackFunc) {
    // 判断不同的操作系统调用不同的方法:
    if (window.xb) {
        window.xb.voicePlay(data, person, callBackFunc);
    } else {
        var sUrl = "xb://voicePlay/?data=" + encodeURIComponent(data) + "&person=" + person + "&callBackFunc=" + callBackFunc;
        xb_loadURL(sUrl);
    }

}

// 07 : 语音识别：
function xb_voiceRecord(action, callBackFunc) {
    // 判断不同的操作系统调用不同的方法:
    if (window.xb) {
        window.xb.voiceRecord(action, callBackFunc);
    } else {
        var sUrl = "xb://voiceRecord/?action=" + action.toString() + "&callBackFunc=" + callBackFunc;
        xb_loadURL(sUrl);
    }

}

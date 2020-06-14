/*
 * 注意：
 * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
 * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
 * 3. 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
 *
 * 如有问题请通过以下渠道反馈：
 * 邮箱地址：weixin-open@qq.com
 * 邮件主题：【微信JS-SDK反馈】具体问题
 * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
 */

/*
 * 功能：统计页面在微信中的UV、PV、分离量
 * 作者：吴沛林
 * 创建时间：2017/1/10
 */
var wxStatistics = {
    siteId: $('#hid_siteId').val(),
    pageType: $('#hid_pageType').val(),//页面类型：0 普通页面，1 文章页面，2产品页面
    getPageId: function () {
        if (wxStatistics.pageType == 0) {
            return $('#pageinfo').val();
        } else {
            return $('#pageinfo').attr('data-entityid');
        }
    },
    init: function () {
        //微信分享统计以及分享数据的显示----------
        if (wxStatistics.isWeiXin()) {
            //记录分享量
            $.post('/WeiXinPromote/GetPromotionByEntityId', {
                siteId: wxStatistics.siteId,
                entityId: wxStatistics.getPageId(),
                entityType: parseInt(wxStatistics.pageType) + 1
            }, function (result) {
                wxStatistics.onWXShare(result.data.ShareTitle, result.data.ShareDesc, result.data.ShareCover, result.data.ShareLink);
            });

            var keepAliveUserIdentity = wxCookieHelper.createUUID();
            var dayUserIdentity = wxCookieHelper.createUUID();

            var keepAliveCookieExist = wxCookieHelper.cookieExist(wxCookieHelper.keepAliveUserIdentity);
            if (!keepAliveCookieExist) {
                wxCookieHelper.setKeepAliveCookie(keepAliveUserIdentity);
            } else {
                keepAliveUserIdentity = wxCookieHelper.getCookie(wxCookieHelper.keepAliveUserIdentity);
            }

            var dayCookieExist = wxCookieHelper.cookieExist(wxCookieHelper.dayUserIdentity);
            if (!dayCookieExist) {
                wxCookieHelper.setDayCookie(dayUserIdentity);
            } else {
                dayUserIdentity = wxCookieHelper.getCookie(wxCookieHelper.dayUserIdentity);
            }

            wxStatistics.sendRequest(keepAliveUserIdentity, dayUserIdentity);
        }
    },
    onWXShareSuccess: function () {
        $.post('/WechatStaistic/sharecount', {
            siteId: wxStatistics.siteId, pageId: wxStatistics.getPageId(), pageType: wxStatistics.pageType
        }, function () { });
    },
    onWXShare: function (title, desc, imgUrl, link) {
        $.post('/WechatStaistic/GetWeixinConfig', { url: window.location.href },
            function (result) {
                wx.config({
                    debug: false,
                    appId: result.appId,
                    timestamp: result.timestamp,
                    nonceStr: result.nonceStr,
                    signature: result.signature,
                    jsApiList: [
                      'checkJsApi',
                      'onMenuShareTimeline',
                      'onMenuShareAppMessage',
                      'onMenuShareQQ',
                      'onMenuShareWeibo',
                      'onMenuShareQZone'
                    ]
                });
                wx.ready(function () {
                    // 2. 分享接口
                    // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
                    wx.onMenuShareAppMessage({
                        title: title,
                        desc: desc,
                        link: link,
                        imgUrl: imgUrl,
                        trigger: function (res) {
                            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                            //alert('用户点击发送给朋友,siteid:' + siteId + ",pageId:" + pageId + ",title:" + title + ",desc:" + desc + ",imgUrl:" + imgUrl + ",link=" + link);
                        },
                        success: function (res) {
                            //alert('已分享');
                            wxStatistics.onWXShareSuccess();
                        },
                        cancel: function (res) {
                            //alert('已取消');
                        },
                        fail: function (res) {
                            //alert(JSON.stringify(res));
                        }
                    });

                    // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
                    wx.onMenuShareTimeline({
                        title: title,
                        desc: desc,
                        link: link,
                        imgUrl: imgUrl,
                        trigger: function (res) {
                            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                            //alert('用户点击分享到朋友圈');
                        },
                        success: function (res) {
                            //alert('已分享');
                            wxStatistics.onWXShareSuccess();
                        },
                        cancel: function (res) {
                            //alert('已取消');
                        },
                        fail: function (res) {
                            //alert(JSON.stringify(res));
                        }
                    });

                    // 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
                    wx.onMenuShareQQ({
                        title: title,
                        desc: desc,
                        link: link,
                        imgUrl: imgUrl,
                        trigger: function (res) {
                            //alert('用户点击分享到QQ');
                        },
                        complete: function (res) {
                            //alert(JSON.stringify(res));
                        },
                        success: function (res) {
                            //alert('已分享');
                            wxStatistics.onWXShareSuccess();
                        },
                        cancel: function (res) {
                            //alert('已取消');
                        },
                        fail: function (res) {
                            //alert(JSON.stringify(res));
                        }
                    });

                    // 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
                    wx.onMenuShareWeibo({
                        title: title,
                        desc: desc,
                        link: link,
                        imgUrl: imgUrl,
                        trigger: function (res) {
                            //alert('用户点击分享到微博');
                        },
                        complete: function (res) {
                            //alert(JSON.stringify(res));
                        },
                        success: function (res) {
                            //alert('已分享');
                            wxStatistics.onWXShareSuccess();
                        },
                        cancel: function (res) {
                            //alert('已取消');
                        },
                        fail: function (res) {
                            //alert(JSON.stringify(res));
                        }
                    });

                    // 2.5 监听“分享到QZone”按钮点击、自定义分享内容及分享接口
                    wx.onMenuShareQZone({
                        title: title,
                        desc: desc,
                        link: link,
                        imgUrl: imgUrl,
                        trigger: function (res) {
                            //alert('用户点击分享到QZone');
                        },
                        complete: function (res) {
                            //alert(JSON.stringify(res));
                        },
                        success: function (res) {
                            //alert('已分享');
                            wxStatistics.onWXShareSuccess();
                        },
                        cancel: function (res) {
                            //alert('已取消');
                        },
                        fail: function (res) {
                            //alert(JSON.stringify(res));
                        }
                    });
                });
            });

        //wx.error(function (res) {
        //    alert(res.errMsg);
        //});
    },
    //识别微信浏览器
    isWeiXin: function () {
        var ua = window.navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == 'micromessenger') {
            return true;
        } else {
            return false;
        }
    },
    /*
    keepAliveUserIdentity:会保持一段时间用户身份标识,可用于统计总UV
    dayUserIdentity:保持一天的用户标识，可用于统计当天的UV
    */
    sendRequest: function (keepAliveUserIdentity, dayUserIdentity) {
        $.ajax({
            url: "/WechatStaistic/pvuv",
            data: {
                siteId: wxStatistics.siteId,
                pageId: wxStatistics.getPageId(),
                pageType: wxStatistics.pageType,
                keepAliveUserIdentity: keepAliveUserIdentity,
                dayUserIdentity: dayUserIdentity
            },
            dataType: 'jsonp',
            jsonp: 'callback',
            type: 'post',
            success: function () { }
        });
    }
};

var wxCookieHelper = {
    keepAliveUserIdentity: 'keepAliveUserIdentity',
    dayUserIdentity: 'dayUserIdentity',
    setDayCookie: function (value) {
        //存储一个有效期到当天晚上23:59:59失效的cookie。
        //参考：http://blog.csdn.net/wangzl1163/article/details/51822185
        var curDate = new Date();
        //当前时间戳  
        var curTamp = curDate.getTime();
        //当日凌晨的时间戳,减去一毫秒是为了防止后续得到的时间不会达到00:00:00的状态  
        var curWeeHours = new Date(curDate.toLocaleDateString()).getTime() - 1;
        //当日已经过去的时间（毫秒）  
        var passedTamp = curTamp - curWeeHours;
        //当日剩余时间  
        var leftTamp = 24 * 60 * 60 * 1000 - passedTamp;
        var leftTime = new Date();
        leftTime.setTime(leftTamp + curTamp);
        //创建cookie  
        document.cookie = wxCookieHelper.dayUserIdentity + "=" + escape(value) + ";expires=" + leftTime.toGMTString();
    },
    setKeepAliveCookie: function (value) {
        var curDate = new Date();
        //当前时间戳  
        var curTamp = curDate.getTime();
        //一年时间  
        var oneYearTamp = 365 * 24 * 60 * 60 * 1000;
        var leftTime = new Date();
        leftTime.setTime(oneYearTamp + curTamp);
        //创建cookie  
        document.cookie = wxCookieHelper.keepAliveUserIdentity + "=" + escape(value) + ";expires=" + leftTime.toGMTString();
    },
    getCookie: function (cookieName) {
        if (document.cookie.length > 0) {
            var c_start = document.cookie.indexOf(cookieName + "=")
            if (c_start != -1) {
                c_start = c_start + cookieName.length + 1
                var c_end = document.cookie.indexOf(";", c_start)
                if (c_end == -1) c_end = document.cookie.length
                return unescape(document.cookie.substring(c_start, c_end))
            }
        }
        return ""
    },
    cookieExist: function (cookieName) {
        var wxCookie = wxCookieHelper.getCookie(cookieName);
        if (wxCookie != null && wxCookie != "") {
            return true;
        }
        else {
            return false;
        }
    },
    createUUID: function () {
        var s = [];
        var hexDigits = "0123456789abcdef";
        for (var i = 0; i < 36; i++) {
            s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
        }
        s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
        s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
        s[8] = s[13] = s[18] = s[23] = "-";

        var uuid = s.join("");
        return uuid;
    }
};

$(function () {
    wxStatistics.init();
});


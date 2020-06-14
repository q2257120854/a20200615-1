/* 主js控制及公共函数 **
 * Author: BaoQL        **
 * Date:  2017-03-01  **/
var myApp = new Framework7({
    modalTitle: "提示",
    modalButtonOk: "确定",
    modalButtonCancel: "取消",
    modalPreloaderTitle: "加载中...",
    modalPasswordPlaceholder: "密码",
    modalUsernamePlaceholder: "用户名",
    onAjaxStart: function (xhr) {
    	myApp.showIndicator();
    },
    onAjaxComplete: function (xhr) {
        myApp.hideIndicator();
    },
    onAjaxError: function (xhr) {
    	myApp.hideIndicator();
    	if (xhr.responseText) {
    		myApp.alert(xhr.responseText);
    	} else {
    		myApp.alert("网络通讯错误");
    	}
    }
});

var $$ = Dom7;
var $ = Dom7;

$$.ajaxSetup({
	timeout: 20000
});

var userinfo = {};

var mainView = myApp.addView('.view-main', {
    dynamicNavbar: false,
    cache: true
});

function doPageInit(pageName) {
    var pageObj = $(".page[data-page=" + pageName + "]");
    var isInited = pageObj.attr("isinited");
    if (isInited == "true") return;
    pageObj.attr("isinited", "true");

    if (pageName.indexOf('-') > 0) {
        pageName = pageName.replace("-","_");
    }
    var fn = pageName + "_init";
    var sScript = 'try{' +
        'if(window.' + fn + ' && typeof(' + fn + ')=="function"){' +
        fn + '(); ' +
        '}' +
        '}catch(e){alert(e);};';
    eval(sScript);
}

function doPageBack(pageName) {
    if (pageName.indexOf('-') > 0) {
        pageName = pageName.replace("-","_");
    }
    var fn = pageName + "_back";
    var sScript = 'try{' +
        'if(window.' + fn + ' && typeof(' + fn + ')=="function"){' +
        fn + '(); ' +
        '}' +
        '}catch(e){alert(e);};';
    eval(sScript);
}

myApp.onPageInit('*', function (page) {
    var pageName = page.name;
    doPageInit(pageName);
});

myApp.onPageBack('*', function (page) {
	var pageName = page.name;
    doPageBack(pageName);
});

function loadPage(pageName, pageTitle) {
	if (pageTitle) {
		// 设置标题
	}
	mainView.router.loadPage(vpath + pageName + ".html"); 
}

function rmPage(pageName) {
	var pg = $(mainView.selector).find('.page[data-page="' + pageName + '"]');
	pg.remove();
	//$("#js_"+ pageName).remove();
}


function Tip(msg, obj) {
    myApp.addNotification({
        message: msg,
        hold: 3000
    });
}

function Alert(msg, yes) {
    myApp.alert(msg, yes);
}

function Confirm(msg, yes, no) {
    myApp.confirm(msg, yes, no);
}


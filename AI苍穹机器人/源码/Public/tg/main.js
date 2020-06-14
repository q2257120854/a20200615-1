/*  会员注册相关 ****************************************************************/
var m_jsCallParams = null;
var m_tradeNo = null;
var m_checkInterval = null;
var m_paySuccessTiped = false;

function accountjoinpay_init(){
    if (convBool(m_accountReg_showTip)) {
        myApp.alert("您还不是VIP会员，请立即升级为VIP会员。");
    }

    tryCheckIsPaied();
}

function account_pay_buildorder() {
    if(!m_isWeixin){
        //postData("/srv/account/accountbuildpayorder?channel=02", null, alipay_buildorder_CallBack, commonErrorCallBack);
        postData("/srv/account/accountbuildpayorder?channel=YunHuiFu", null, YunHuiFu_buildorder_CallBack, commonErrorCallBack);
    } else {
        postData("/srv/account/accountbuildpayorder", null, account_buildorder_Success, commonErrorCallBack);
    }
    setEnabled('.submitbtn', false);
}

function account_buildorder_Success(resp) {
    setEnabled('.submitbtn', true);
    var nResult = resp["Result"];
    if (nResult == -8) {
        var msg = resp["Msg"];
        //var mobile = resp["Data"];
        myApp.alert(msg, function () {
            window.location.href = "/m/my";
        });
        return;
    }

    var data = getResult(resp, true);
    if (!data) return;

    m_jsCallParams = {
        "appId":data.AppID,
        "timeStamp":data.TimeStamp.toString(),
        "nonceStr":data.NonceStr,
        "package":data.Package,
        "signType": data.SignType,
        "paySign": data.PaySign
    };
    m_tradeNo = data.TradeNo;
    callpay();
}

function jsApiCall() {
    WeixinJSBridge.invoke(
        'getBrandWCPayRequest', m_jsCallParams,
        function(res){
            if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                postData("/srv/account/accountpay?tradeno=" + m_tradeNo, null, account_pay_Success, commonErrorCallBack);
                setEnabled('.submitbtn', false);
            } else if(res.err_msg == "get_brand_wcpay_request:cancel" ) {
                myApp.alert("您已取消支付");
            } else {
                myApp.alert("支付失败，详细错误信息如下：\r\n" + JSON.stringify(res));
            }
        }
    );
}

function callpay()
{
    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
        }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
        }
    }else{
        jsApiCall();
    }
}

function account_pay_Success(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp, true);
    //if (!data) return;

    if (!m_paySuccessTiped) {
        m_paySuccessTiped = true;
        myApp.alert("恭喜您，您已成功升级为机器人VIP会员.", function () {
            window.location.href = "/m/my";
        });
    }
}



function alipay_buildorder_CallBack(resp) {
    setEnabled('.submitbtn', true);
    var body = getResult(resp, true);
    if (!body) {
        return;
    }

    var nResult = body["result"];
    if (nResult != 0) {
        Alert(body["msg"]);
        return;
    }

    m_tradeNo = body.data["outtradeno"];
    xb_onlinePay("02", body.data["payinfo"], "alipay_Finish");
}

function alipay_Finish(resp) {
    // {"resultStatus":"6001","result":"","memo":"操作已经取消。"}'
    var data = JSON.parse(resp);
    if (data["resultStatus"] == "9000") {
        // 支付成功
        postData("/srv/account/accountpay?isonline=true&tradeno=" + m_tradeNo, null, account_pay_Success, commonErrorCallBack);
    } else if (data["memo"]){
        Alert(data["memo"]);
    } else {
        Alert("支付失败");
    }
}

//云惠付
function YunHuiFu_buildorder_CallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;

    var payUrl = data["PaySign"];
    //console.log(payUrl);
    if (payUrl.indexOf("https://") == 0 || payUrl.indexOf("http://") == 0) {
        window.location.href = payUrl;
    } else {
        //Alert("支付参数异常或支付方式不支持");
        document.write(payUrl);
    }
}


function tryCheckIsPaied() {
    if (m_checkInterval) {
        clearInterval(m_checkInterval);
        m_checkInterval = null;
    }

    m_checkInterval = setInterval(function () {
        if (m_paySuccessTiped) {
            // 提示过了，就不再检查了。
            clearInterval(m_checkInterval);
            m_checkInterval = null;
        }

        postData("/srv/account/getmyinfo?paiedonly=true", null, account_GetInfo_Success, commonErrorCallBack, true);
    }, 2500);
}

function account_GetInfo_Success(resp) {
    var data = getResult(resp, false);
    if (!data) return;

    if (data == "PAIED") {
        if (!m_paySuccessTiped) {
            m_paySuccessTiped = true;
            myApp.alert("恭喜您，您已成功升级为VIP会员.", function () {
                window.location.href = "/m/my";
            });
        }
    }
}
function accountinfomodify_init(){
    if (m_accountModifyTip) {
        myApp.alert(m_accountModifyTip);
    }

    initCitySelector("#cbbProvice", "#cbbCity", "#cbbArea");
}

function account_modify_commit() {
    var data = getFormData('frmMemberModify');
    if (!data) return;

    setEnabled('.submitbtn', false);
    postData("/srv/account/infomodify?code=" + data["VerifyCode"], data, account_modify_commitSuccess, commonErrorCallBack);
}

function account_modify_commitSuccess(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("资料修改成功", function() {
        window.location.href = "/m/myinfo";
    });
}

function member_info_init(){
    $(".area-id").each(function() {
        $(this).html(getCityName($(this).html()));
    });

    $("#lblCreateTime").html($("#lblCreateTime").html().substring(0, 10));
}

function avatar_modify_commit() {
    var nFileCount = getFileCount("#thelist");
    if (nFileCount > 0) {
        setEnabled('.submitbtn', false);
        m_avatarUploader.upload();
        return;
    } else {
        myApp.alert("请先选择需要上传的头像图片");
    }
}/*  会员注册相关 ****************************************************************/
var m_countdown = 0;

function accountreg_init(){
    if (!$("input[name='ParentUid']").val()) {
        $("input[name='ParentUid']").removeAttr('disabled');
    }

    if (convBool(m_accountReg_showTip)) {
        myApp.alert("您还未注册成为会员。");
    }

    //initCitySelector("#cbbProvice", "#cbbCity", "#cbbArea");
}

function getSmsCode() {
    getVerifyCode("regForm", "Mobile", "用户注册");
}

function account_reg_commit() {
    var data = getFormData('regForm');
    if (!data) return;

    if(!document.getElementById("chkRegAgree").checked){
        myApp.alert("您必须先同意会员注册协议");
        return;
    }

    if (!isMobile(data.Mobile)) {
        myApp.alert("请输入正确的手机号码");
        return;
    }

    //if (data.Password) {
        if (data.Password.length < 6 || data.Password.length > 20) {
            myApp.alert("请输入正确的密码，密码必须为6-20位字符");
            return;
        }
    //}

    if (data.ParentUid.length != 6 && data.ParentUid.length != 11) {
        myApp.alert("请输入推荐码，请咨询你的推荐人获取推荐码");
        return;
    }

    if (data.SmsCode.length != 6) {
        myApp.alert("请输入短信验证码");
        return;
    }

    setEnabled('.submitbtn', false);
    if (m_isWeixin && !m_isGetApp) {
        postData("/srv/account/accountreg?code=" + data["SmsCode"], data, account_reg_commitSuccess, commonErrorCallBack);
    } else {
        postData("/srv/account/addaccount?code=" + data["SmsCode"], data, account_reg_commitSuccess, commonErrorCallBack);
    }
}

function account_reg_commitSuccess(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) {
        refreshCode();
        return;
    }

    if (m_isGetApp) {
        window.location.href = m_regDomain + "/m/getapp?uid=" + $("input[name='Mobile']").val();
    } else {
        window.location.href = m_appDomain + "/m/my";   //"/m/accountjoinpay?canskip=true";
    }
}
/*  FS分销商管理相关 ****************************************************************/

function agentreg_init(){
    initCitySelector("#cbbProvice", "#cbbCity", "#cbbArea");
}

function agent_reg_commit() {
    var data = getFormData('frmAgentReg');
    if (!data) return;

    setEnabled('.submitbtn', false);
    postData("/srv/account/agentreg?code=" + data["VerifyCode"], data, agent_reg_Success, commonErrorCallBack);
}

function agent_reg_Success(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("提交成功，请等待管理员审核，审核后本公众号会将审核结果推送给您", function() {
        window.location.href = "/m/my";
    });
}
var m_alipayUploader = null;
var m_weixinUploader = null;
var m_alipayUploaderOk = false;
var m_weixinUploaderOk = false;

function bankmodify_init() {
    $("#txtBankName").val(m_accbankName);

    createAplipayQrCodeUploader();
    createWeiXinQrCodeUploader();
}

function bank_modify_commit() {
    var data = getFormData('frmBankModify');
    if (!data) return;

    if (m_mondify_Type == 2) {
        if (!data["BankName"]) {
            Alert("请选择银行名称");
            return;
        }
        if (!data["RealName"]) {
            Alert("请输入银行卡开户人姓名");
            return;
        }
        if (!data["BankNo"]) {
            Alert("请输入银行卡号");
            return;
        }
    }

    setEnabled('.submitbtn', false);

    if (m_mondify_Type == 1) {
        var nFileCount = getFileCount("#thelist1");
        if (nFileCount > 0 && !m_alipayUploaderOk) {
            m_alipayUploader.upload();
            return;
        }
    } else if (m_mondify_Type == 3) {
        nFileCount = getFileCount("#thelist2");
        if (nFileCount > 0 && !m_weixinUploaderOk) {
            m_weixinUploader.upload();
            return;
        }
    }

    do_bank_modify_commit();
}

function do_bank_modify_commit() {
    var data = getFormData('frmBankModify');
    if (!data) return;

    setEnabled('.submitbtn', false);
    postData("/srv/account/bankmodify?type=" + m_mondify_Type, data, bank_modify_commitSuccess, commonErrorCallBack);
}

function bank_modify_commitSuccess(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("修改成功", function() {
        if (m_backUrl) {
            window.location.href = m_backUrl;
        } else {
            window.location.href = "/m/accountinfomodify";
        }
    });
}
function postData(url, data, successFun, errorFun, noIndicator) {
	if (!noIndicator) {
        myApp.showIndicator();
    }
    $.ajax({
        type:"POST", 
        url: url, 
        dataType:"json",      
        contentType:"application/json",               
        data:  data == null ? null : JSON.stringify(data),
        success:function(data){
            if (!noIndicator) {
                myApp.hideIndicator();
            }
        	if (successFun) successFun(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (!noIndicator) {
                myApp.hideIndicator();
            }
        	if (errorFun) errorFun(XMLHttpRequest, textStatus, errorThrown);
        }
     });
}

function getResult(resp, showError) {
	if (showError == undefined || showError == null) showError = true;
	if (!resp) {
		if (showError) {
		    myApp.alert("没有返回值");
		}
	} else {            
		var nResult = resp["Result"];
		if (nResult == undefined) {
			if (resp["rows"]) {
                return resp;
            } else if (typeof(resp) == "object") {
                if (!("rows" in resp) && showError)
                    Alert("加载数据失败");
            } else if (showError) {
                Alert("返回的报文不正确");
            }
		} else if (nResult == 0) {
			var data = resp["Data"];
			if (data == null)
			    return true;
			else
			    return data;
		} else if (nResult == -9999) {
			//openDialog("/user/relogin", "用户登录", 400, 240);
			myApp.alert("登录信息已超时，请尝试重新刷新本页面");
		} else if (showError) {
			var msg = resp["Msg"];
			if (!msg)
			    msg = "未知错误";
			myApp.alert(msg);
		}                  
	}
	return null;
}

function setEnabled(obj, enabled) {
	if (enabled) {
		$(obj).removeAttr('disabled');
	} else {
		$(obj).attr('disabled', 'disabled');
	}
}

function tip(msg) {
	myApp.addNotification({
        message: msg,
        hold: 3000
    });
}

function toDecimal2(x) { 
    var f = parseFloat(x); 
    if (isNaN(f)) { 
      return false; 
    } 
    var f = Math.round(x*100)/100; 
    var s = f.toString(); 
    var rs = s.indexOf('.'); 
    if (rs < 0) { 
      rs = s.length; 
      s += '.'; 
    } 
    while (s.length <= rs + 2) { 
      s += '0'; 
    } 
    return s; 
} 

function convInt(v) {
	if (!v)
	   return 0;
	n = parseInt(v);
	if (isNaN(n))
	    return 0;
	else
	    return n;
}

function convFloat(v) {
	if (!v)
	   return 0;
	n = parseFloat(v);
	if (isNaN(n))
	    return 0;
	else
	    return n;
}

function convBool(v) {
	if (!v)
	   return false;
	if (v == true || v ==1 || v == "1" || v == "true" || v == "TRUE")
	   return true;
	return false;
}

function convDate(v) {
	if (!v)
	   return null;
	if (v.indexOf('-') > 0) {
		v = replaceAll(v, "-", "/");
	}
	var npos1 = v.indexOf(' ');
	if (npos1 > 0) {
		var sDate = v.substring(0, npos1);
		var sTime = v.substring(npos1+1);
		var fullDate = sDate.split("/");
		var fullTime = sTime.split(":");
		return new Date(fullDate[0], fullDate[1]-1, fullDate[2], fullTime[0], fullTime[1], fullTime[2]);
	} else {
		var fullDate = v.split("/");
		return new Date(fullDate[0], fullDate[1]-1, fullDate[2], 0, 0, 0);
	}
}

function trim(str) {
	if (!str) return str;
	return str.replace(/(^\s*)|(\s*$$)/g, "");
}

function replaceAll(str, olds, news) {
	str = str.replace(new RegExp(olds,'gm'),news);
	return str;
}

function isUserName(s)   
{
	var patrn=/^[a-zA-Z]{1}([a-zA-Z0-9]|[._-]){1,19}$$/;
	if (!patrn.exec(s)) return false;
	return true;
}

function isMobile(s) {
    var patrn = /^1\d{10}$/;
    if(patrn.test(s))
        return true;
    else
        return false;
}

function isEmail(s){
    var patrn = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$$/;
    if (patrn.test(s)) return true;
    return false;
}

function isCardNo(s){
	var patrn = /^(\d{16}|\d{19})$/;
	if (patrn.test(s)) return true;
    return false;
}

function getFieldValue(ele) {
   var isExclude = ele.attr('data-exclude');
   if (isExclude == '' || isExclude == 'yes') {
	   return null;
   }
   var id = ele.attr("name");
   if (!id) {
	   return null;
   }
   
   var data = {id: id, error: true};
   var typ = ele.attr("type");
   if (typ == 'checkbox') {
	   var isChecked = false;
	   if(ele.is(':checked')) {
		   isChecked = true;
		}
	   data.error = false;
	   data.v = isChecked;
	   return data;
   }
   
   
   var v = ele.val();	
   var fieldName = ele.attr("data-field");
   if (!fieldName) fieldName = id;
   
   var isRequired = false;
   var requiredTag = ele.attr('required');
   if (requiredTag == '' || requiredTag == 'yes') {
	   isRequired = true;
   }
   if (isRequired && !v) {
	   if (ele.attr('requiredmsg')) {
		   tip(ele.attr('requiredmsg'));
	   } else {
		   tip("请输入" + fieldName);
	   }
	   return data;
   }
   
   var minLen = convInt( ele.attr('minlength') );
   if (minLen > 0 && v.length < minLen) {
	   tip(fieldName + "不能少于" + minLen + "个字");
	   return data;
   }
   var maxLen = convInt( ele.attr('maxlength') );
   if (maxLen > 0 && v.length > maxLen) {
       tip(fieldName + "不能多于" + maxLen + "个字");
	   return data;
   }
   
   if (typ == "password" && v == "**********") {
	   return null;
   }
   
   var dataType = ele.attr("data-type");	   
   if (dataType == "int") {
	   v = convInt(v);
   } else if (dataType == "float") {
	   v = convFloat(v);
   } else if (dataType == "date") {
	  // v = convDate(v);
   } else if (dataType == 'mobile') {
	   if (v && !isMobile(v)) {
		   if (ele.attr('validatemsg')) {
			   tip(ele.attr('validatemsg'));
		   } else {
			   tip(fieldName + ": (手机号码不正确)");
		   }
		   return data;
	   }
   } else if (dataType == 'email') {
	   if (v && !isEmail(v)) {
		   if (ele.attr('validatemsg')) {
			   tip(ele.attr('validatemsg'));
		   } else {
			   tip(fieldName + ": (邮箱格式不正确)");
		   }
		   return data;
	   }
   } else if (dataType == 'username') {
	   if (v && !isUserName(v)) {
		   if (ele.attr('validatemsg')) {
			   tip(ele.attr('validatemsg'));
		   } else {
			   tip(fieldName + "格式错误");
		   }
		   return data;
	   }
   } else if (dataType == 'cardno') {
	   if (v && !isCardNo(v)) {
		   if (ele.attr('validatemsg')) {
			   tip(ele.attr('validatemsg'));
		   } else {
			   tip(fieldName + "格式错误");
		   }
		   return data;
	   }
   }
   
   data.error = false;
   data.v = v;
   return data;
}

function setFieldValue(ele, value){
	var typ = ele.attr("type");
	var tagName = ele[0].tagName;
    if (typ == 'checkbox' || typ == 'radio') {
    	var val = ele.prop("value");
    	var values = value.split(",");
    	for (var i=0,len=values.length; i<len; i++){
    		if(val==values[i]){
    			ele.prop("checked", true);
    		}
    	}
    	return;
    }
    if (tagName == 'select' || tagName == 'SELECT') {
    	ele.find("option[value='"+value+"']").prop("selected", true);
    	return;
    }
    ele.val(value);
}

function getFormData(formName) {
	var data = {};
	var isOk = true;
	$("#" + formName).find("input,select,textarea").each(function () {
		var it =getFieldValue( $(this) );
		if (it == null) {
			return true;
		} else if (it.error) {
			isOk = false;
			return false;
		}
		data[it.id] = it.v;
	});
	
	if (isOk) return data;   
    return null;
}

function setFormData(formName, data) {
	$("#" + formName).find("input,select,textarea").each(function () {
		var ele = $(this),
			name = ele.attr("name");
		var val = data[name];
		if(val!==null && val!=='' && val!=='undefined'){
			setFieldValue(ele, val);
		}
	});
}

function commonSuccessCallBack(resp) {
	setEnabled('.submitbtn', true);
	var data = getResult(resp);
    if (!data) return;
}

function commonErrorCallBack(XMLHttpRequest, textStatus, errorThrown) {
	setEnabled('.submitbtn', true);
	myApp.alert("ERROR：" + textStatus);
}

Date.prototype.Format = function (fmt) {
 var o = {
     "M+": this.getMonth() + 1, //月份 
     "d+": this.getDate(), //日 
     "H+": this.getHours(), //小时 
     "m+": this.getMinutes(), //分 
     "s+": this.getSeconds(), //秒 
     "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
     "S": this.getMilliseconds() //毫秒 
 };
 if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
 for (var k in o)
 if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
 return fmt;
};

function goBack(defaultUrl) {
    if (defaultUrl) {
        window.location.href = defaultUrl;
    } else if (m_wxAuthed == "1") {
        history.go(-2);
	} else {
        history.back();
    }
}

function GetUrlVars()
{
    var vars = {}, hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        if (hash.length > 0) {
            vars[hash[0]] = hash[1];
        }
    }
    return vars;
}

function myexpressorder_init() {
    var sUrl = "/srv/orders/getlist?sidx=gettime&sord=desc";
    postData(sUrl, null, myexpressGetList_Success, commonErrorCallBack);
}

function myexpressGetList_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var m_AccType = ["审核中", "已审核", "未通过", "结算中", "已结算"];

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sDate = new Date(it.GetTime).Format("yyyy-MM-dd HH:mm");

        var sHref = "";
        var sStatus = "";
        if (it.IsUpload == 0) {
            sStatus = '<span class="badge bg-red">未提交</span>';
            sHref = "/m/submittask?orderid=" + it.OrderID + "&backurl=history";
        } else {
            var v = it.Status;
            if (v == 1) {
                sStatus = '<span class="badge bg-green">' + m_AccType[v] + '</span>';
            } else if (v == 3) {
                sStatus = '<span class="badge bg-orange">' + m_AccType[v] + '</span>';
            } else if (v == 4) {
                sStatus = '<span class="badge bg-blue">' + m_AccType[v] + '</span>';
            } else {
                sStatus = '<span class="badge bg-biolet">' + m_AccType[v] + '</span>';
            }
            sHref = "javascript:viewExpressImage('" + m_upoladURL + it.DownloadUrl + "')";
        }

        var s = '<li class="item-content">' +
            '<div class="item-media"><img src="/static/m/img/icons/task-history.png" style="width:40px; height:40px;" /></div> ' +
            '<a class="item-inner external" href="' + sHref + '">' +
            '<div class="item-title black" style="padding:5px 0px;">';

        if (it.IsUpload) {
            s += '<div class="">提交时间：' + new Date(it.UploadTime).Format("yy-MM-dd HH:mm") + '</div>';
            s += '<div class="gray">赚取金币<span class="red">' +  it.Amt + '个</span></div>';
        }
        s += '</div>';

        s += '<div class="item-after">' + sStatus + '</div>';
        s += '</a></li>';

        $("#myExpressOrderList").append(s);
    }
}

function viewExpressImage(imgUrl, currentIndex) {
    var opts = {
        zoom: 400,
        backLinkText: "返回"
    };
    if (currentIndex != undefined) {
        opts.photos = imgUrl;
    } else {
        opts.photos = [imgUrl];
    }

    var myPhotoBrowser = myApp.photoBrowser(opts);
    if (currentIndex != undefined) {
        myPhotoBrowser.open(currentIndex);
    } else {
        myPhotoBrowser.open();
    }
}

function viewExpressImage2(linkObj) {
    var imgObj = linkObj.getElementsByTagName("img")[0];
    var sSrc = imgObj.getAttribute("src");
    viewExpressImage(sSrc);
}



function doShare(taskid, orderid) {
    myApp.modal({
        text: "一键分享暂时只支持<b>微信6.7.2及以下版本</b>。",
        title: "一键分享",
        buttons: [
            {text: "取消", onClick: function() {
                    //window.location.href = "/m/viewtask?orderid=" + orderid + "&backurl=task";
                    myApp.closeModal();
                }},
            {text: "分享到朋友圈", bold:true, onClick: function() {
                    postData("/srv/orders/getordersharedinfo?taskid=" + taskid, null, getOrderSharedInfo_Success, commonErrorCallBack);
                }}
        ]
    });


}

function getOrderSharedInfo_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    // 图片：
    var sImages = "";
    for (var i=0; i<data.Files.length; i++) {
        var it = data.Files[i];
        var sImagePath = m_uploadPath + it.UrlPath;
        sImages += sImagePath + ";";
    }
    if (!sImages) {
        return;
    }

    if (resp.Msg) {
        var sMyExtendImg = m_uploadPath + resp.Msg;
        sImages = sImages + sMyExtendImg;
    } else {
        var sUid = m_uid;
        var sMyExtendImg = m_uploadPath + "shared/" + sUid.substring(0, 2) + "/" + sUid.substring(2, 4) + "/" + sUid + ".jpg";
        sImages = sImages + sMyExtendImg;
    }

    //Alert("一键分享暂时只支持微信6.7.2及以下版本，本功能将自动下载任务图片及您的推广二维码并分享到微信朋友圈。", function () {
        xb_shareImages("01", data.Remark + "@@文案复制成功", sImages, "800");
    //});

}
function system_service_init() {
    var data = {Type: "8", QueryTag: "客服页"};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data) + "&getcontent=true",
            null, service_GetServieList_Success, commonErrorCallBack);
}

function advertising_init() {
    var data = {Type: "8", QueryTag: "广告投放页"};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data), null, service_GetServieList_Success, commonErrorCallBack);
}

function service_GetServieList_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var lblName = "lblNo" + i.toString();
        if (!it.Links) {
            it.Links = it.Subject;
        }

        var sLink = '';
        var sContent = "";
        if (it.Content && it.Content.length > 7) {
            sContent = '<span id="' + lblName + '">' + it.Content + '</span>';
        }
        if (it.Links.indexOf("tel:") == 0) {
            sLink = '<a href="' + it.Links + '" class="external">' +
                '           <img src="/static/m/img/bg/button-boda.png" style="width:70px;height: auto;" />' +
                '       </a>';
        } else if (it.Links.indexOf("guestbook") >= 0) {
            sLink = '<a href="' + it.Links + '" class="external">' +
                '           <img src="/static/m/img/bg/button-liuyan.png" style="width:70px;height: auto;" />' +
                '       </a>';
        } else {
            // sLink = '<a href="javascript:serviceDetail(\'' + it.Links + '\', \'' + it.PrevieImgURL + '\');">';
            sLink = '<a href="#" class="external button-clipboard" data-clipboard-target="#' + lblName + '">' +
                '           <img src="/static/m/img/bg/button-fuzhi.png" style="width:70px;height: auto;" />' +
                '       </a>';
        }

        var s = '<div class="col-100 h-jgg2">\n' +
            '                    <div class="row service-bar">\n' +
            '                        <div class="col-20">' + '<img class="avatar" src="' + m_uploadPath + it.PrevieImgURL + '" /></div>\n' +
            '                        <div class="col-50">\n' +
            '                            <label>' + it.Subject + '</label>\n' + sContent +
            '                        </div>\n' +
            '                        <div class="col-30" style="padding-top:10px;">' + sLink + '</div>\n' +
            '                    </div>\n' +
            '                </div>';


        $("#serviceList").append(s);
    }

    var clipboard = new ClipboardJS('.button-clipboard');
    clipboard.on('success', function(e) {
        myApp.alert('复制成功!')
        e.clearSelection();
    });
    clipboard.on('error', function(e) {
        myApp.alert('请选择“拷贝”进行复制!')
    });

}


function serviceDetail(name, img){
    $("#imgQrCode").attr('img', m_uploadPath + img);
    $("#txtQrCode").html(name);

    var html = '<div>' +
        '<div class="center">' +
        '<img src="' + m_uploadPath + img + '" style="width:193px; height: 193px;" />' +
        '</div>' +
        '<div class="center">' +
        '【长按二维码可保存到相册】' +
        '</div>' +
        '</div>';

    myApp.alert(html, name);
}
function forgotpwd_init(){

}

function refreshCode() {
    $("#imgCode").attr("src", "/common/yzm?rnd=" + new Date().getTime());
}

function account_reset_password_commit(){
    var data = {
        Mobile: $("input[name='Mobile']").val(),
        Password: $("input[name='Password']").val(),
        RePassword: $("input[name='RePassword']").val(),
        VerifyCode: $("input[name='VerifyCode']").val()
    };

    if (!isMobile(data.Mobile)) {
        myApp.alert("手机号码格式不正确");
        return;
    }

    if (!data.VerifyCode) {
        myApp.alert("请输入短信校验码");
        return;
    }

    if (data.Password.length < 6) {
        myApp.alert("密码必须由6位或6位以上的字符组成");
        return;
    }
    if (data.Password != data.RePassword) {
        myApp.alert("密码确认不正确");
        return;
    }

    setEnabled('.btn-submit', false);
    var reqData = {UserName: data.Mobile, Password: data.Password};
    postData("/srv/sysdata/changepwd?code=" + data["VerifyCode"], reqData, account_resetPwd_commitSuccess, commonErrorCallBack);
}

function account_resetPwd_commitSuccess(resp) {
    setEnabled('.btn-submit', true);
    var data = getResult(resp);
    if (!data) return;

    myApp.alert("密码重置成功，请使用新密码进行登录.", function() {
        window.location.href = "login?uid=" + $("#txtMobile").val();
    });
}
/*  快件上传 ****************************************************************/
var m_wx_kj_canQuery = false;

function kjquery_init(){
    $("#txtQueryText").focus();
    $("#btnQrCode").click(function () {
        kj_query_selectQrCode();
    });
    $("#btnQuery").click(function () {
        kj_query_doQuery();
    });
}

function kjquery_wxinit(){
    m_wx_kj_canQuery = true
}

function kj_query_selectQrCode(){
    if (!m_wx_kj_canQuery) {
        myApp.tip("请等待页面加载完成后再重试");
        return;
    }

    wx.scanQRCode({
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var result = res.resultStr;
            var arr = result.split(',');
            $("#txtQueryText").val(arr[arr.length-1]);
        }
    });
}

function kj_query_doQuery() {
    var sValue = $("#txtQueryText").val();

    if (!sValue) {
        myApp.alert("请输入要查询的快递单号.");
        return;
    }
    if (sValue.length<5 || sValue.length>30) {
        myApp.alert("快递单号长度不符合要求.");
        return;
    }
    if (!(/^[\w-]+$/.test(sValue))) {
        myApp.alert("快递单号格式不正确.");
        return;
    }

    window.open("https://m.kuaidi100.com/result.jsp?nu=" + sValue);
}
function login_init(){
	//$$("#btnLogin").click(function() {
	//	tryLogin();
	//});

	if (localStorage && localStorage["memberuid"]) {
		$("#txtUid").val(localStorage["memberuid"]);
		//$$("#chkRemember").prop("checked","checked");
	} else {
		//$$("#chkRemember").removeAttr("checked");
	}

    var nHeight = $(window).height();
    nHeight = parseInt(nHeight) - 40;
    $("#divCopyrights").css("top", nHeight + "px");
    $("#divCopyrights").removeClass("hide");
} 

function tryLogin() {
	var sUid = $("#txtUid").val();
	var sPwd = $("#txtPwd").val();
	
	if (!sUid) {
		myApp.alert("请输入用户名");
		return;
	}
	if (!sPwd) {
		myApp.alert("请输入密码");
		return;
	}
    
	setEnabled('#btnLogin', false);
	var data = {UserName:$("#txtUid").val(), Password: $("#txtPwd").val(), Remember: true};
	postData("/srv/sysdata/accountlogin", data, loginSuccessCallBack, loginErrorCallBack);
}

function loginSuccessCallBack(resp) {
	setEnabled('#btnLogin', true);
	if (resp["Result"] == -2) {
        myApp.alert("您的密码未初始化，请重置您的登录密码。", function () {
			window.location.href = "/m/forgotpwd?uid=" + $("#txtUid").val();
        });
		return;
	}

	var data = getResult(resp);
    if (!data) return;
   
   if (localStorage) {
       localStorage["memberuid"] = $("#txtUid").val();
   }
   window.location.href = "my"; //m_backUrl;
}

function loginErrorCallBack(XMLHttpRequest, textStatus, errorThrown) {
	myApp.alert("登录失败:" + textStatus);
	setEnabled('#btnLogin', true);
}

function accountLogout() {
    myApp.confirm("确实要退出当前帐号吗", "提示", function () {
		window.location.href = "/m/logout"
    });
}
/*  我的相关及通用处理 ***************************************/
function my_init() {
    var nPage = 0;
    if (m_pageIdx != "") {
        nPage = convInt(m_pageIdx);
    } else {
        nPage = convInt(localStorage["mainpageidx"]);
    }

    getAdList('.swiper-1', "主页");

    // 公告：
    var data = {Type: "0", QueryTag: ""};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data), null, service_GetNotices_Success, commonErrorCallBack);

    postData("/srv/sysdata/getrobotbuiedhistory", null, service_GetBuiedHistorySuccess, commonErrorCallBack);
}

var m_adCtlName = "";
function getAdList(ctl, tag) {
    m_adCtlName = ctl;
    var data = {Type: "1", QueryTag: tag};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data), null, service_GetAdList_Success, commonErrorCallBack);
}

function service_GetAdList_Success(resp) {
    if (resp.records == 0) {
        getAdList(m_adCtlName, "主页");
        return;
    }

    var data = getResult(resp, true);
    if (!data) return;

    var sHtml = '<div class="swiper-pagination"></div>\n' +
                    '<div class="swiper-wrapper">\n';

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];

        var s = '<div class="swiper-slide"><a href="javascript:goto3rd(\'\', \'' + it.Links + '\');" class="external">\n' +
            '       <img src="' + m_uploadPath + it.PrevieImgURL + '" style="width:100%; height:100%;" />\n' +
            '    </a></div>\n';

        sHtml += s;
    }

    sHtml += '</div>\n';
    $(m_adCtlName).html(sHtml);

    var mySwiper1 = myApp.swiper(m_adCtlName, {
        pagination: m_adCtlName + ' .swiper-pagination',
        spaceBetween: 50,
        speed: 400,
        autoplay: 3000,
        autoplayDisableOnInteraction: false
    });
}

function service_GetBuiedHistorySuccess(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.length; i++) {
        var it = data[i];
        var sDate = new Date(it.BuyTime).Format("MM-dd HH:mm");

        var s = "<li>[" + sDate + "]&nbsp;&nbsp;&nbsp;&nbsp;" + it.Uid + "购买了机器人" + "</li>";
        $("#ulBuyHistory").append(s);
    }
}

function service_GetNotices_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var sHtml = "<ul>";
    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sHref = "/m/noticeitem?type=" + it.TypeID + "&id=" + it.NoticeID;

        var s = '<li><a class="black external" href="' + sHref + '">' + it.Subject + '</a>&nbsp;&nbsp;</li>';

        sHtml += s;
    }
    sHtml+= "</ul>";
    $("#lstNotice").html(sHtml);
}

function goto3rd(appName, url) {
    if (!url) return;
    if (url.indexOf("http") == 0) {
        xb_openUrl(url);
    } else {
        window.location.href = url;
    }
}


function getHongBao() {
    $("#hongbao img").eq(1).attr("src", "/static/m/img/hongbaokai.gif");

    setEnabled('#btnGetHongbao', false);
    postData("/srv/money/gethongbao", null, account_getHongbao_Success, account_getHongbao_Error);
}

function account_getHongbao_Error(XMLHttpRequest, textStatus, errorThrown) {
    setEnabled('#btnGetHongbao', true);
    myApp.alert("ERROR：" + textStatus);
    $("#hongbao img").eq(1).attr("src", "/static/m/img/hongbaokai.png");
}

function account_getHongbao_Success(resp) {
    setEnabled('#btnGetHongbao', true);
    var data = getResult(resp);
    if (!data) {
        $("#hongbao img").eq(1).attr("src", "/static/m/img/hongbaokai.png");
        return;
    };

    $("#hongbaomsg2 b").html( toDecimal2(data.Money/100) + "元");
    setTimeout(function() {
        $("#hongbao img").eq(0).attr("src", "/static/m/img/hongbao_2.png");
        $("#hongbao img").eq(1).hide();
        $("#hongbaomsg1").hide();
        $("#hongbaomsg2").show();
    }, 3000);
}
function myextend_init() {
    //postData("/srv/account/getmyextendcode", null, wx_getMyExtendCodeCallBack, commonErrorCallBack);
}

function myextend_wxinit() {
    var sLink = window.location.protocol + "//"+ window.location.host + "/m/shareqrcode?url=" + encodeURIComponent(m_SharedImageUrl);
    var sImg = window.location.protocol + "//"+ window.location.host + "/static/m/img/logo_b.png";
    wx.onMenuShareAppMessage({
        title: '【机器人】',
        desc: '机器人！', // 分享描述
        link: sLink,
        imgUrl: sImg
    });

    wx.onMenuShareTimeline({
        title: '【机器人】 机器人！',
        link: sLink,
        imgUrl: sImg
    });
}

function myextend_share_getQRCode() {
    postData("/srv/account/getmyextendcode", null, wx_getMyExtendCodeCallBack, commonErrorCallBack);
}

function wx_getMyExtendCodeCallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;

    myApp.alert("系统已将您的推广图片推送到本公众号的聊天记录中。")
}

function hideMask() {
    $(".fullmask").remove();
}
var m_swiperActiveIndex = 0;

function myextendex_init() {
    var vars = GetUrlVars();
    var m_Type = vars["type"];
    if (m_Type == "1") {
        $("#divHelps").show();
    }

    // 广告图：
    var data = {Type: "10", QueryTag: ""};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data), null, myextendex_GetList_Success, commonErrorCallBack);
}

function myextendex_GetList_Success(resp) {
    var data = getResult(resp);
    if (!data) return;

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];

        var sHref = "javascript:viewMyImage(" + i + ")";
        var sTitle = it.Subject + '&nbsp;&nbsp;<a class="blue" href="' + sHref + '">[放大]</a>';
        $("#exTitle" + (i+1)).html(sTitle);
        if (i > 0) {
            $("#exImage" + (i + 1)).attr("src", m_upoladURL + it.PrevieImgURL);
        }
    }

    if (data.rows.length > 0) {
        loadExtendImg(data.rows[0].PrevieImgURL);
    }
}

function loadExtendImg(sTag) {
    postData("/srv/account/getmyextendimg?tag=" + sTag + "&idx=" + m_swiperActiveIndex +
         "&qrcode=" + encodeURIComponent(m_qrCode),
         null, wx_getMyExtendImgCallBack, commonErrorCallBack);
}

function wx_getMyExtendImgCallBack(resp) {
    var data = getResult(resp);
    if (!data) {
        return;
    }
    $("#exImage1").attr("src", data.Url);
}

function viewMyImage(idx) {
    var imagesList = [];
    $(".myExImage").each(function () {
        //imagesList.push( m_upoladURL + data.rows[i].PrevieImgURL );
        imagesList.push($(this).attr("src"));
    });

    var opts = {
        zoom: 400,
        backLinkText: "返回",
        photos: imagesList
    };

    var myPhotoBrowser = myApp.photoBrowser(opts);
    myPhotoBrowser.open(idx);
}
function mymembers_init() {
    postData("/srv/account/getmymemberstat", null, mymembers_stats_Success, commonErrorCallBack);
}

function mymembers_stats_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.length; i++) {
        var it = data[i];
        if (it.ParentLevel == 1) {
            $("#mymember-onelevel").html(it.Cnt);
        } else if (it.ParentLevel == 2) {
            $("#mymember-twolevel").html(it.Cnt);
        } else if (it.ParentLevel == 3) {
            $("#mymember-threelevel").html(it.Cnt);
        }
    }
}


function mymembersdetail_init() {
    //postData("/srv/account/getmymemberstat", null, mymembers_stats2_Success, commonErrorCallBack);

    var nLevel = m_parentLevel;
    postData("/srv/account/getmymembers?parentlevel=" + nLevel, null, mymembersdetail_Success, commonErrorCallBack);
}

function mymembers_stats2_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var firstLevelCount = 0;
    var allLevelCount = 0;
    var todayCount = 0;

    for (var i=0; i<data.length; i++) {
        var it = data[i];
        if (it.ParentLevel == 1) {
            firstLevelCount += (it.Cnt);
        }
        if (it.ParentLevel == 1 || it.ParentLevel == 2) {
            allLevelCount += it.Cnt;
        }
        if (it.ParentLevel == -9) {
            todayCount += it.Cnt;
        }
    }
    $("p.first-num").html(firstLevelCount) + "人";
    $("p.total-num").html(allLevelCount) + "人";
    $("p.today-num").html(todayCount) + "人";
}

function mymembersdetail_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.length; i++) {
        var it = data[i];
        var strLevel = "";
        if (it.Level == 1) {
            strLevel = "VIP"
        } else if (it.Level == 2) {
            strLevel = "营销经理"
        } else if (it.Level == 3) {
            strLevel = "营销总监"
        } else {
            strLevel = "普通会员"
        }

        var sDate = new Date(it.CreateTime).Format("MM-dd HH:mm:ss");
        var sStatus;
        if (it.BuyCount > 0) {
            sStatus = '<span class="badge bg-blue">已购买' + it.BuyCount + '台</span>';
        } else {
            sStatus = '<span class="badge bg-orange">未购买</span>';
        }

        var s = '<li class="">' +
            '<a href="/m/accountinfo.html?uid=' + it.Uid + '" class="external item-link item-content" style="height:80px;">' +
                '<div class="item-media"><img src="' + it.Avatar + '" class="avatar" style="width:44px; height:44px;" /></div>' +
                '<div class="item-inner">' +
                    '<div class="item-title">' + it.NickName + '(' + it.Uid + ')<br />' +
                        '<span class="gray">注册时间：' +  sDate + '</span> <br />' + sStatus +
                    '</div>' +
                '</div>' +
            '</a>' +
            '</li>';
        $("#my-members-list").append(s);
    }

}
function mypoints_init() {
    var sUrl = "/srv/point/getlist?sidx=acctime&sord=desc";
    postData(sUrl, null, myPointGetList_Success, commonErrorCallBack);
}

function myPointGetList_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sDate = new Date(it.AccTime).Format("MM-dd HH:mm:ss");

        var s = '<li class="item-content">' +
            '<div class="item-inner">' +
            '<div class="item-title" style="padding:5px 0px;">' +
            '<div>' +  sDate + '</div>' +
            '<div class="smalltext">' +  it.Remark + '</div>' +
            '</div>';
        if (it.Point > 0) {
            s += '<div class="item-after" style="color:blue;font-size:16px;">+' + it.Point + '</div>';
        } else {
            s += '<div class="item-after" style="color:red;font-size:16px;">' + it.Point + '</div>';
        }
        s += '</div></li>';

        $("#myPointList").append(s);
    }
}

function getPointAccName(accType) {
    if (accType == 10)
        return "积分消费";
    else {
        return "积分收入";
    }
}

var m_myPurseType = -1;

function mypurse_init() {
    document.getElementById("lblIncome").innerHTML = toDecimal2(v_income);

    loadPurseData(0);
}

function loadPurseData(page) {
    var sUrl = "/srv/money/getlist?sidx=acctime&sord=desc&queryType=" + m_myPurseType;
    postData(sUrl, null, myPurseGetList_Success, commonErrorCallBack);
}

function myPurseGetList_Success(resp) {
    var data = getResult(resp, true);

    if (!data || !data.rows || data.rows.length == 0) {
        var s = '<li class="item-content">' +
            '<div class="item-inner"><div class="item-title center" style="padding:5px 0px;">未查询到符合条件的数据</div></div>';
        s += '</div></li>';
        $("#myPurseList").html(s);
        return;
    }

    $("#myPurseList").html("");
    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sDate = new Date(it.AccTime).Format("MM-dd HH:mm:ss");
        var sAccName = getMoneyAccName(it.AccType);
        if (sAccName == "") {
            sAccName = it.Remark;
            it.Remark = "";
        }

        var s = '<li class="item-content">' +
            '<div class="item-inner">' +
            '<div class="item-title" style="padding:5px 0px;">' +
            '<div>' + sAccName + '</div>' +
            '<div class="gray">' +  sDate + '</div>' +
            '<div class="smalltext">' +  it.Remark + '</div>' +
            '</div>';
        if (it.RealChange > 0) {
            s += '<div class="item-after" style="font-size:16px; color:#ff752d">+' + it.RealChange.toFixed(2) + '</div>';
        } else {
            s += '<div class="item-after" style="font-size:16px; color:Green;">' + it.RealChange.toFixed(2) + '</div>';
        }
        s += '</div></li>';

        $("#myPurseList").append(s);
    }
}

function mypurse_changeTab(idx, type) {
    m_myPurseType = type;
    loadPurseData(0);

    $(".mypursedetail-tabA a").removeClass('active');
    $(".mypursedetail-tabA #tabA" + idx).addClass('active');
}

//0, 流量奖，1：分享奖励， 10：提现， 20：手工调整
function getMoneyAccName(accType) {
    if (accType == 1)
        return "分享奖励";
    else if (accType == 10)
        return "提现";
    else if (accType == 20)
        return "手工调整";
    else {
        return "流量奖";
    }
}

function mysubsidy_init() {
    var dt = new Date();
    var mo = "0" + (dt.getMonth() + 1);
    $("#queryyear").val(dt.getFullYear());
    $("#querymonth").val(mo.substring(mo.length-2));
    my_subsidy_query();
}

function my_subsidy_query() {
    var month = $("#queryyear").val() + $("#querymonth").val();
    var sUrl = "/srv/money/statsubsidybyday?month=" + month;
    postData(sUrl, null, mysubsidyGetList_Success, commonErrorCallBack);
}

function mysubsidyGetList_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var m_AccType = ["佣金", "佣金奖励"];
    $("#mySubsidyList").html("");
    $(".total-num").html(0);
    $(".mine-num").html(0);

    var butie = 0.0;
    var jiangli = 0.0;

    for (var i=0; i<data.length; i++) {
        var it = data[i];
        if (it.AccType == 0) {
            butie += it.Amt;
        } else {
            jiangli += it.Amt;
        }

        var s = '<li class="item-content">' +
            '<div class="item-inner">' +
            '<div class="item-title" style="padding:5px 0px;">' +
            '<div><b>' + m_AccType[it.AccType] + '</b></div>' +
            '<div>' +  it.AccDay + '</div>' +
            '</div>';
        if (it.Amt > 0) {
            s += '<div class="item-after blue" style="font-size:16px;">￥' + it.Amt.toFixed(2) + '</div>';
        }
        s += '</div></li>';

        $("#mySubsidyList").append(s);
    }

    $(".total-num").html(butie.toFixed(2));
    $(".mine-num").html(jiangli.toFixed(2));
}
function noticelist_init() {
    loadNoticeList(1);
    //initScroller('.infinite-scroll', null, 500, 20, loadNoticeList);
    if (m_typeid == 10) {
        getAdList('.swiper-1', "会员影视页");
    }
}

function loadNoticeList(nPage) {
    var data = {Type: m_typeid.toString(), QueryTag: ""};
    postData("/srv/sysdata/getnoticelist?request=" + JSON.stringify(data), null, noticeGetList_Success, scrollErrorCallBack);
}

function scrollErrorCallBack(XMLHttpRequest, textStatus, errorThrown) {
    //endScroller();
    commonErrorCallBack(XMLHttpRequest, textStatus, errorThrown);
}

function noticeGetList_Success(resp) {
    //endScroller();
    var data = getResult(resp, true);
    if (!data) return;

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sDate = new Date(it.CreateTime).Format("yyyy-MM-dd HH:mm:ss");

        var s = '<li>' +
            '<a href="javascript:viewNoticeItem(' + it.NoticeID + ')" class="item-link item-content external">' +
            '<div class="item-media"><i class="icon iconfont icon-play"></i></div>' +
            '<div class="item-inner">' +
            '<div class="item-title">' + it.Subject + '</div>' +
            '</div></div>';
        s += '</a></li>';

        $("#noticelist").append(s);
    }
}


function viewNoticeItem(id) {
    window.location.href = "/m/noticeitem?id=" + id + "&typeid=" + m_typeid + "&typename=" + m_typeName;
}

function noticeitem_init() {
    var sUrl = "/srv/sysdata/getnoticeitem";
    var id = GetUrlVars()["id"];
    if (!id) {
        myApp.alert("错误的参数");
        return;
    }

    var data = {NoticeID: convInt(id), TypeID: convInt(m_typeid)};
    postData(sUrl, data, noticeGetInfo_Success, commonErrorCallBack);
}

function noticeGetInfo_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var sDate = new Date(data.CreateTime).Format("yyyy-MM-dd HH:mm:ss");

    $$("#lblTitle").html(data.Subject);
    $$("#lblDate").html(sDate);
    $$("#lblContent").html(data.Content);
}
/*  登录密码、支付密码修改 ****************************************************************/
function changePwd(){
	var formdata = getFormData("frmMyInfo-Pwd");
	if(formdata.password!==formdata.repwd){
		tip(getI18n("reg.pwd.noteq"));
		return;
	}
	formdata.memberid = userinfo.userid;
	postData(basePath + "member/changePwd", formdata, commonSuccessCallBack, commonErrorCallBack);
}

function changePayPwd(){
	var formdata = getFormData("frmMyInfo-PayPwd");
	if(formdata.password!==formdata.repwd){
		tip(getI18n("reg.pwd.noteq"));
		return;
	}
	formdata.memberid = userinfo.userid;
	postData(basePath + "member/changePayPwd", formdata, commonSuccessCallBack, commonErrorCallBack);
}
function submitTask_init(){
    getAdList('.swiper-1', "主页");

    if (!m_isWeixin) {
        createH5Uploader();
    }
}

function submitTask_wxinit(){
    m_wx_canUpload = true
}

function viewTask() {
    var sOrderID = getTaskOrderID();
    if (!sOrderID) {
        Alert("未选择任务");
        return;
    }
    window.location.href = "viewtask?orderid=" + sOrderID;
}

function getTaskOrderID() {
    if (m_taskOrderID) {
        return m_taskOrderID;
    }
    var sOrderID = $("#cbbOrder").val();
    return sOrderID;
}

function task_submit_selectImage(){
    m_wx_upload_mediaIDs = null;
    if (!m_wx_canUpload) {
        myApp.tip("请等待页面加载完成后再重试");
        return;
    }
    wx.chooseImage({
        count: 1, // 默认9
        sizeType: ['original', 'compressed'],
        sourceType: ['album', 'camera'],
        success: function(res) {
            m_wx_upload_mediaIDs = res.localIds[0];
            $("#wx_upload_preview").attr('src', m_wx_upload_mediaIDs);
            $("#divuploader").css("display","none");
            $("#uppreview").css("display","block");
        },
        fail : function (ex) {
            myApp.alert("选择图片失败:" + JSON.stringify(ex));
        }
    });
}

function task_Commit_Upload() {
    var sOrderID = getTaskOrderID();
    if (!sOrderID) {
        myApp.alert("未选择任务");
        return;
    }

    if (!m_wx_upload_mediaIDs || m_wx_upload_mediaIDs.length == 0) {
        myApp.alert("请先选择需要上传的图片");
        task_Commit_Cancel();
        return;
    }

    setEnabled('.submitbtn', false);
    postData("/srv/orders/checkorderstatus?tip=true&orderid="+sOrderID, null, task_Commit_Upload_CallBack, commonErrorCallBack);
}

function task_Commit_Upload_CallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;

    // 上传照片
    wx.uploadImage({
        localId: '' + m_wx_upload_mediaIDs,
        isShowProgressTips: 1,
        success: function(res) {
            serverId = res.serverId;
            task_Commit_Upload_DoUpload(serverId);
            m_wx_upload_mediaIDs = null;
        },
        fail : function (ex) {
            myApp.alert("上传图片失败:" + ex);
        }
    });
}

function task_Commit_Cancel() {
    m_wx_upload_mediaIDs = null;
    $("#uppreview").css("display","none");
    $("#divuploader").css("display","block");
}

function task_Commit_Upload_DoUpload(fileId) {
    var sOrderID = getTaskOrderID();
    if (!sOrderID) {
        myApp.alert("未选择任务");
        return;
    }

    var reqData = {
        "FileID" : fileId,
        "OrderID": sOrderID
    }

    setEnabled('.submitbtn', false);
    postData("/srv/orders/upload", reqData, task_Commit_Upload_DoUpload_CallBack, commonErrorCallBack);
}

function task_Commit_Upload_DoUpload_CallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("上传成功，请等待管理员审核。", function() {
        window.location.href = "/m/history";
    });
}



var m_h5Uploader = null;
function createH5Uploader() {
    if (m_h5Uploader != null) return;
    m_h5Uploader = createFileUploader({
        id: "picker",
        action: "/srv/orders/upload2",
        extensions: "jpeg,jpg,png,gif",
        muliti: false,
        listEle: "#thelist",
        preview: true,
        previewWidth: '100%',
        setData: function(data) {
            //data["OrderID"] = getTaskOrderID();
        },
        success: function(file, resp) {
            var data = getResult(resp);
            setEnabled('.submitbtn', true);

            if (data != null) {
                myApp.alert("上传成功，请等待管理员审核。", function() {
                    window.location.href = "/m/coin";
                });
            }
        },
        error: function(file, reason) {
            myApp.alert( '附件上传失败: ' + reason);
            setEnabled('.submitbtn', true);
        },
        filesChange: function () {
            var nFileCount = getFileCount("#thelist");
            if (nFileCount == 0) {
                $("#btnWxUpload2").addClass('hide');
                $("#divHelps").removeClass('hide');
            } else {
                $("#btnWxUpload2").removeClass('hide');
                $("#divHelps").addClass('hide');
            }
        }
    }, "m_h5Uploader");
}

function task_Commit_forApp() {
    var nFileCount = getFileCount("#thelist");
    if (nFileCount > 0) {
        setEnabled('.submitbtn', false);
        m_h5Uploader.upload();
        return;
    } else {
        myApp.alert("请先选择需要上传的发圈图片");
    }
}
function getDivision(basenum, divisor, dots) {
    if (divisor == 0) return 0;
    var f = parseFloat(basenum) / parseFloat(divisor);

    if (dots == undefined) dots = 2;
    return f.toFixed(dots);
}

function cutDots(num, dots) {
    if (dots == undefined) dots = 0;
    var s = parseFloat(num.toFixed(dots)).toString();
    return s;
}

function getFileSize(si, dots) {
    if (si <= 0)
        return "0KB";
    if (si < 1024)
        return cutDots(si, dots) + "B";

    if (si  < 1024*1024)
        return getDivision(si, 1024, dots) + "KB";

    if (si  < 1024*1024*1024)
        return getDivision(si, 1024*1024, dots) + "MB";

    if (si  < 1024*1024*1024*1024)
        return getDivision(si, 1024*1024*1024, dots) + "GB";

    return getDivision(si, 1024*1024*1024*1024, dots) + "TB";
}

// id, action, extensions, muliti, listEle, (setData), (success), (error)
function createFileUploader(opt, ctlName) {
    if (!ctlName) {
        ctlName = "uploader";
    }

    var acceptObj = null;
    if (opt.extensions) {
        acceptObj = {title: "userTypes", extensions: opt.extensions};
        if (opt.mimeTypes) {
            acceptObj["mimeTypes"] = opt.mimeTypes;
        } else {
            var mimes = "";
            var arr = opt.extensions.split(",")
            for (var i=0; i<arr.length; i++) {
                if (!mimes)
                    mimes = "." + arr[i];
                else
                    mimes += ",." + arr[i];
            }
            acceptObj["mimeTypes"] = mimes;
        }
    }

    var uploader = WebUploader.create({
        swf: '/assets/js/Uploader.swf',
        server: opt.action,
        pick: '#' + opt.id,
        fileVal: 'Filedata',
        accept: acceptObj,
        resize: false
    });

    if (!opt.muliti) {
        uploader.on( 'beforeFileQueued', function( file ) {
            eval(ctlName + ".reset();");
        });
    }

    uploader.on( 'fileQueued', function( file ) {
        var sItem;
        var nIndex = getFileCount(opt.listEle) + 1;

        if (opt.preview) {
            uploader.makeThumb( file, function( error, ret ) {
                if ( error ) {
                    sItem = '<div id="' + file.id + '" class="fileitem">' +
                        '<input type="hidden" value="">' +
                        '<p>' + file.name + '(' + getFileSize(file.size, 2) + ')&nbsp;<a href="javascript:' + ctlName + '.removeFile(\'' + file.id +
                        '\');" style="color:red;">[X]</a></p>' +
                        '</div>';
                } else {
                    sItem = '<div id="' + file.id + '" class="fileitem">' +
                        '<input type="hidden" value="">' +
                        '<p>' + file.name + '(' + getFileSize(file.size, 2) + ')&nbsp;<a href="javascript:' + ctlName + '.removeFile(\'' + file.id +
                        '\');" style="color:red;">[X]</a></p>' +
                        '<img src="' + ret + '" style="width:' + opt.previewWidth + '; height:auto;" />' +
                        '</div>';
                }

                if (opt.muliti) {
                    $(opt.listEle).append(sItem);
                } else {
                    $(opt.listEle).html(sItem);
                }

                if (opt.filesChange) {
                    opt.filesChange();
                }
            });
        } else {
            sItem = '<div id="' + file.id + '" class="fileitem">' +
                '<input type="hidden" value="">' +
                '<p>' + file.name + '(' + getFileSize(file.size, 2) + ')&nbsp;<a href="javascript:' + ctlName + '.removeFile(\'' + file.id +
                '\');" style="color:red;">[X]</a></p>' +
                '</div>';

            if (opt.muliti) {
                $(opt.listEle).append(sItem);
            } else {
                $(opt.listEle).html(sItem);
            }

            if (opt.filesChange) {
                opt.filesChange();
            }
        }
    });

    uploader.on( 'uploadProgress', function (file, percentage) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo( $li ).find('.progress-bar');
        }

        var percentText = cutDots(percentage * 100.0, 2) + '%';
        $li.find('span.state').html('上传中(' + percentText + ')');
        $percent.css( 'width',  percentage * 100 + '%');
    });

    uploader.on( 'fileDequeued', function (file) {
        $("#" + file.id).remove();
        if (opt.filesChange) {
            opt.filesChange();
        }
    });

    uploader.on( 'reset', function () {
        $(opt.listEle).html("");
        if (opt.filesChange) {
            opt.filesChange();
        }
    });

    uploader.on( 'uploadBeforeSend', function (object, data, headers) {
        if (opt.setData) {
            opt.setData(data, headers);
        }
    });

    uploader.on( 'uploadSuccess', function(file, resp) {
        //$( '#'+file.id ).find('.progress').fadeOut();
        $( '#'+file.id ).find('span.state').html("已完成.");

        if (opt.success) {
            opt.success(file, resp);
        }
    });

    uploader.on( 'uploadError', function(file, reason) {
        $( '#'+file.id ).find('span.state').html("上传失败.");

        if (opt.error) {
            opt.error(file, reason);
        }
    });

    uploader.on( 'error', function(reason) {
        $( '#'+file.id ).find('span.state').html("上传失败.");
        if (opt.error) {
            opt.error(null, reason);
        }
    });

    return uploader;
}

function addUploadedFiles(fileController, fileId, fileName, previewPath, previewWidth) {
    var sItem = '<div id="' + fileId + '" class="fileitem">' +
        '<input type="hidden" value="' + fileId + '">' +
        '<p><a href="' + previewPath + '" target="_blank">' + fileName + '</a> &nbsp;<a href="javascript:removeUploadedFile(\'' + fileId +
        '\');" style="color:red;">[X]</a></p>';

    if (fileName.indexOf('.jpeg') > 0 || fileName.indexOf('.jpg') > 0 || fileName.indexOf('.gif') > 0 || fileName.indexOf('.png') > 0) {
        sItem += '<a href="' + previewPath + '" target="_blank"><img src="' + previewPath + '" style="width:' + previewWidth + '; height:auto;" /></a>';
    }

    sItem +=  '</div>';

    $(fileController).append(sItem);
}

function setUploadedFileInfo(objid, fileId, previewPath) {
    var $div = $("#" + objid);
    $div.find("input").val(fileId);
    $div.find("img").attr("src", previewPath);
}

function removeUploadedFile(fileId) {
    $("#" + fileId).remove();
}

function getFileCount(fileController) {
    var nCount = 0;
    $(fileController).children().each(function(){
        var sValue = $(this).find("input").val();
        if (!sValue) {
            nCount++;
        }
    });
    return nCount;
}

function getUploadFiles(fileController) {
    var files = [];
    $(fileController).children().each(function(){
        var it = {ID: $(this).attr("id"), FileID: $(this).find("input").val()};
        if (it.ID && it.FileID) {
            files.push(it);
        }
    });

    return files;
}
function refreshVerfiyCodeImg(imgObjId) {
    var imgObj = document.getElementById(imgObjId);
    imgObj.src = "../common/yzm?rnd=" + (new Date()).getTime();
}

function getVerifyCode(formName, fieldName, opName) {
    var mobile = $("#" + formName).find("[name=" + fieldName + "]").val();
    if ( !isMobile(mobile)) {
        tip("请输入正确的手机号码.");
        return;
    }

    setTimeout(function () {
        myApp.alert("验证码发送成功.");
    }, 2000);
    return;

    var strAction = "doGetVerifyCode('" + formName + "', '" + fieldName + "', '" + opName + "')";
    myApp.modal({
        title:  '请输入图形验证码',
        text: '<div class="center"><img id="imgGetMobileCode_Code" src="../common/yzm?rnd=' + (new Date()).getTime() + '" onclick="refreshVerfiyCodeImg(\'imgGetMobileCode_Code\');" />' +
        '&nbsp;&nbsp;<a href="javascript:refreshVerfiyCodeImg(\'imgGetMobileCode_Code\');">[刷新]</a>' +
        '<br /><br /><input id="edtGetMobileCode_Code" type="text" style="width:100px; height: 30px; font-weight: bold; font-size:14pt;" /></div>' +
        '<div style="padding-top:20px;"><a href="javascript:' + strAction + '" class="external btn-submit">' +
           '<img src="/static/m/img/bg/button-getsms.png" style="height: 50px; width:auto;" /></a></div>',
        buttons: [
            {
                text: '取消',
                onClick: function() {
                }
            }
        ]
    });
}

function doGetVerifyCode(formName, fieldName, opName) {
    var strCode = $$("#edtGetMobileCode_Code").val();
    if (strCode.length != 4) {
        tip("请输入图形验证码.");
        return;
    }
    myApp.closeModal();

    var mobile = $("#" + formName).find("[name=" + fieldName + "]").val();
    var sUrl = "../srv/public/getmobilecode?mobile=" + mobile + "&code=" + strCode;
    if (opName) {
        sUrl += "&op=" + opName;
    }
    postData(sUrl, null, getverifycode_Success, commonErrorCallBack);
}

function getverifycode_Success(resp) {
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("验证码发送成功.");

    var countdown = 30;
    var fun = function() {
        var btn = $("#btnGetVerifyCode");
        if (countdown <= 0) {
            btn.removeAttr('disabled');
            btn.html("获取验证码");
            countdown = 30;
            return;
        } else {
            btn.attr('disabled', 'disabled');
            btn.html("重新获取(" + countdown + ")");
            countdown--;

            setTimeout(function() {
                fun();
            }  ,1000) ;
        }
    };

    fun();
}
// 提现请求：
function doWithdrawals() {
    var a = $("input[name='my-type']:checked").val();
    var nType = convInt(a);
    if (nType <= 0 || nType > 3) {
        nType = 1;
    }

    var nMoney = convInt($("#txtWithdrawals").val());

    var sUrl = "/srv/money/withdrawals";
    var data = {
        Type: nType,
        Amt : nMoney
    };

    myApp.confirm("确实要提现" + nMoney + "元吗？", function () {
        setEnabled('.submitbtn', false);
        postData(sUrl, data, withDrawals_Success, commonErrorCallBack);
    });
}

function withDrawals_Success(resp) {
    setEnabled('.submitbtn', true);
    var nResult = resp["Result"];
    if (nResult != 0) {
        if (nResult == -3) {
            myApp.alert(resp["Msg"], function () {
                var a = $("input[name='my-type']:checked").val();
                var nType = convInt(a);
                if (nType <= 0 || nType > 2) {
                    nType = 1;
                }

                window.location.href = "accountbankmodify?type=" + nType + "&backurl=withdrawals";
            });
            return;
        }
    }

    var data = getResult(resp, true);
    if (!data) return;

    myApp.alert("提现申请成功，请耐心等待到账。", function () {
        window.location.href = "mypurse";
    });
}

function withdrawalshistory_init() {
    var sUrl = "/srv/money/withdrawalshistory?sidx=applyid&sord=desc";
    postData(sUrl, null, withDrawalsHistory_Success, commonErrorCallBack);
}


function withDrawalsHistory_Success(resp) {
    var data = getResult(resp, true);
    if (!data) return;

    var m_AccType = ["未审核", "已审核", "未通过", "提款中", "已完成"];

    for (var i=0; i<data.rows.length; i++) {
        var it = data.rows[i];
        var sDate = new Date(it.ApplyTime).Format("yyyy-MM-dd HH:mm:ss");

        var s = "";
        var v = it.Status;
        if (v == 1) {
            s = '<span style="color:green;">' + m_AccType[v] + '</span>';
        } else if (v == 3) {
            s = '<span style="color:orange;">' + m_AccType[v] + '</span>';
        } else if (v == 4) {
            s = '<span style="color:blue;">' + m_AccType[v] + '</span>';
            it.AuditMsg = "手续费;" + it.ServiceCharge + "元, 实际到账:" + it.Cash + "元";
        } else {
            s = '<span style="color:red;">' + m_AccType[v] + '</span>';
        }

        var s = '<li class="item-content">' +
            '<a class="item-inner external" href="#">' +
            '<div class="item-title" style="padding:5px 0px;">' +
            '<div><b>' + sDate + '</b></div>' +
            '<div>' +  s + '</div>' +
            '<div class="smalltext">' +  it.AuditMsg + '</div>' +
            '</div>';

        if (it.Amt > 0) {
            s += '<div class="item-after" style="font-size:16px; color:#000;">￥' + it.Amt + '</div>';
        }
        s += '</a></li>';

        $("#myWithdrawalHistory").append(s);
    }
}


function addAmount(obj, n, min, max) {
    if (!min) min = 0;
    if (!max) max = 1000;
    var nValue = convInt($(obj).val());
    var nNewValue = nValue + n;
    if (nNewValue < min) return;
    if (nNewValue > max) return;

    $(obj).val(nNewValue);
    return nNewValue;
}
/*  快件上传 ****************************************************************/
var m_wx_upload_mediaIDs = null;
var m_wx_canUpload = false

function wxupload_init(){
    $("#txtOrderNo").focus();
    $("#btnQrCode").click(function () {
        kj_upload_selectQrCode();
    });
}

function wxupload_wxinit(){
    m_wx_canUpload = true
}

function kj_upload_selectQrCode(){
    if (!m_wx_canUpload) {
        myApp.tip("请等待页面加载完成后再重试");
        return;
    }

    wx.scanQRCode({
        needResult: 1,
        scanType: ["qrCode","barCode"],
        success: function (res) {
            var result = res.resultStr;
            var arr = result.split(',');
            $("#txtOrderNo").val(arr[arr.length-1]);
        }
    });
}

function wx_upload_selectImage(){
    m_wx_upload_mediaIDs = null;
    if (!m_wx_canUpload) {
        myApp.tip("请等待页面加载完成后再重试");
        return;
    }
    wx.chooseImage({
        count: 1, // 默认9
        sizeType: ['original', 'compressed'],
        sourceType: ['album', 'camera'],
        success: function(res) {
            m_wx_upload_mediaIDs = res.localIds[0];
            $("#wx_upload_preview").attr('src', m_wx_upload_mediaIDs);
            $("#divuploader").css("display","none");
            $("#uppreview").css("display","block");
        },
        fail : function (ex) {
            myApp.alert("选择图片失败:" + JSON.stringify(ex));
        }
    });
}

function wx_upload_upload() {
    var sValue = $("#txtOrderNo").val();
    if (!sValue) {
        myApp.alert("请输入或扫描要上传的快递单号.");
        return;
    }
    if (sValue.length<5 || sValue.length>30) {
        myApp.alert("快递单号长度不符合要求.");
        return;
    }
    if (!(/^[\w-]+$/.test(sValue))) {
        myApp.alert("快递单号格式不正确.");
        return;
    }

    if (!m_wx_upload_mediaIDs || m_wx_upload_mediaIDs.length == 0) {
        myApp.alert("请先选择需要上传的图片");
        wx_upload_cancel();
        return;
    }

    setEnabled('.submitbtn', false);
    postData("/srv/expressorder/getdayuploadcount?tip=true&orderno="+sValue, null, wx_upload_checkCountCallBack, commonErrorCallBack);
}

function wx_upload_checkCountCallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;

    // 上传照片
    wx.uploadImage({
        localId: '' + m_wx_upload_mediaIDs,
        isShowProgressTips: 1,
        success: function(res) {
            serverId = res.serverId;
            wx_upload_postuploadresult(serverId);
            m_wx_upload_mediaIDs = null;
        },
        fail : function (ex) {
            myApp.alert("上传图片失败:" + ex);
        }
    });
}

function wx_upload_cancel() {
    m_wx_upload_mediaIDs = null;
    $("#uppreview").css("display","none");
    $("#divuploader").css("display","block");
}

function wx_upload_postuploadresult(fileId) {
    var sOrderNo = $("#txtOrderNo").val();

    var reqData = {
        "FileID" : fileId,
        "OrderNo": sOrderNo
    }

    setEnabled('.submitbtn', false);
    postData("/srv/expressorder/upload", reqData, wx_upload_postuploadCallBack, commonErrorCallBack);
}

function wx_upload_postuploadCallBack(resp) {
    setEnabled('.submitbtn', true);
    var data = getResult(resp);
    if (!data) return;
    myApp.alert("上传成功，请等待管理员审核。", function() {
        window.location.href = "/m/expressorders";
    });
}

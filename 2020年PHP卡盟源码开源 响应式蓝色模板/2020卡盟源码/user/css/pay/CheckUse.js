
// 添加错误提示信息
function AddError(obj, msg) {
    obj.html('');
    obj.html('<span class="checkError"></span>' + msg);
}

// 移除错误提示信息
function RemoveError(obj) {
    obj.html('');
    obj.html('<span class="checkRight"></span>');
}

// 检查玩家账号
function CheckUserId(strUserId, obj) {
    strUserId = $.trim(strUserId);
    if (!CheckIsNull(strUserId)) {
        AddError(obj, "玩家账号不能为空");
        return false;
    }

    if (!/^[a-z][a-z0-9]{3,15}$/.test(strUserId) &&
           !/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(strUserId) &&
           !/^(1)\d{10}$/.test(strUserId)) {

        AddError(obj, "账号格式不正确");
        return false;
    }
    else {
        RemoveError(obj);
        return true;
    }
}

// 检查验证码
function CheckCheckCode() {

    var isShow = $('#CheckCodeShow').css("display");

    if (isShow == "none") {
        return true;
    }

    var code = $('#CheckCode').val();
    if (!CheckIsNull(code)) {
        $("#CheckCodeMsgDiv").html("");
        $("#CheckCodeMsgDiv").html('<span class="checkError">验证码不能为空</span>');
        return false;
    } else {
        $("#CheckCodeMsgDiv").html('<span class="checkRight"></span>');
        return true;

    }

    return true;
}

// 检查是否为空
function CheckIsNull(str) {
    if (str == "" || str == "手机/邮箱/普通账号") {
        return false;
    }
    var regu = "^[ ]+$";
    var re = new RegExp(regu);
    if (re.test(str)) {
        return false;
    }
    return true;
}

// 文本框输入时自动过滤空格
function TrimKeyUp(e) {
    var $this = $(this);

    if (e.keyCode != 38 && e.keyCode != 40 && e.keyCode != 13) {
        var $thisVal = $.trim($this.val());
        $this.val($thisVal);
    }
} 

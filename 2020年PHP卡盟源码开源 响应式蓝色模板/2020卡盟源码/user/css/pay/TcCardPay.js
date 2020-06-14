

$(document).ready(function () {

    // 加载验证码
    GetCheckCode();

    //验证充值账号
    $('#UserId').blur(function () { CheckUserId($('#UserId').val(), $('#UserIdMsgDiv')); });

    //二次验证充值账号
    $('#UserId2').blur(function () {

        CheckUserId($('#UserId2').val(), $('#UserId2MsgDiv'));

        if ($.trim($('#UserId').val()) != $.trim($('#UserId2').val())) {
            AddError($('#UserId2MsgDiv'), "输入账号不一致");
        }
    });

    //验证卡号
    $('#CardNo').blur(function () { CheckCardNo(); });

    //验证卡密
    $('#CardPwd').blur(function () { CheckCardPwd(); });

    //检查验证码
    $("#CheckCode").blur(function () { CheckCheckCode(); });

    //切换验证码
    $('#imgCheckCode').click(function () { GetCheckCode() });
    $('#linkCheckCode').click(function () { GetCheckCode() });

    //检查表单 弹出确认充值框
    $('#btnok').click(function () { return formCheck(); });

    //确认充值 提交表单
    $('.payConfirmBtn').click(function () {

        if (!CheckCheckCode()) {
            return false;
        }

        var userid = $.trim($("#UserId").val());
        var cardno = $.trim($("#CardNo").val());
        var cardpwd = $.trim($("#CardPwd").val());
        var checkcode = $.trim($("#CheckCode").val());
        var tid = $.trim($("#Tid").val());

        var data = {
            "UserId": userid,
            "TcCardNo": cardno,
            "TcCardPwd": cardpwd,
            "Captcha": checkcode,
            "Tid": tid
        };

        //验证成功  提交表单
        $.ajax({
            type: "GET",
            url: PostOrderUrl,
            data: data,
            dataType: "jsonp",
            jsonp: "callbackparam",
            success: function (data) {
                // 解析返回内容
                var ReturnCode = data.ReturnCode; //返回代码
                var ReturnMsg = data.ReturnMsg; //返回信息
                var ReturnContent = data.ReturnContent; //返回内容
                if (ReturnCode == "9") {

                    // 充值成功 
                    $.hideDialog('.payConfirm');
                    showComPop(ReturnContent);

                    //刷新验证码
                    GetCheckCode();

                } else {

                    // 充值失败                   
                    showComPop(ReturnMsg);
                    $.hideDialog('.payConfirm');

                    //刷新验证码
                    GetCheckCode();
                }
            },
            error: function () {
                alert('意外错误，请稍后重试!');
            }
        });
    });

});

//窗体验证
function formCheck() {

    var bReturn = false;

    if (CheckUserId($('#UserId').val(), $('#UserIdMsgDiv'))) {
        bReturn = true;
    }

    if (CheckUserId($('#UserId2').val(), $('#UserId2MsgDiv'))) {
        bReturn = true;
    }

    if (!CheckCardNo()) {
        bReturn = false;
    }

    if (!CheckCardPwd()) {
        bReturn = false;
    }

    if ($.trim($('#UserId').val()) != $.trim($('#UserId2').val())) {
        AddError($('#UserId2MsgDiv'), "输入账号不一致");
        bReturn = false;
    }

    if ($('#Channel').val() == "") {
        AddError($('#ChannelMsgDiv'), "请选择充值渠道");
        bReturn = false;
    }

    if ($('#ProductId').val() == "") {
        AddError($('#ProductIdMsgDiv'), "请选择充值金额");
        bReturn = false;
    }

    if (!CheckCheckCode()) {
        bReturn = false;
    }

    if (!bReturn) return false;

    if (bReturn == true) {

        // 表单验证成功 弹出确定充值框    
        showPop(0);
        
        $("#confirm_userid").html("").html($('#UserId').val());
        $("#confirm_cardno").html("").html($("#CardNo").val());

    }
}

//验证充值卡号
function CheckCardNo() {
    var reg = /^[0-9]{16}$/;
    var strCardNo = jQuery.trim($("#CardNo").val());

    if (strCardNo.length == 0) {
        AddError($("#CardNoMsgDiv"), "卡号不能为空");
        return false;
    }

    if (reg.test(strCardNo)) {
        RemoveError($("#CardNoMsgDiv"));
        return true;
    }
    AddError($("#CardNoMsgDiv"), "卡号格式不正确");
    return false;
}

//验证充值卡密码
function CheckCardPwd() {
    var reg = /^[0-9A-Z]{12}$/;
    var strCardPwd = jQuery.trim($("#CardPwd").val());

    if (strCardPwd.length == 0) {
        AddError($("#CardPwdMsgDiv"), "密码不能为空");
        return false;
    }

    if (reg.test(strCardPwd)) {
        RemoveError($("#CardPwdMsgDiv"));
        return true;
    }
    AddError($("#CardPwdMsgDiv"), "密码格式不正确");
    return false;
}
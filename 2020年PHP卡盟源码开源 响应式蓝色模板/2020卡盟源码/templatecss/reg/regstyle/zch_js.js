/**
* Created by Administrator on 2017/3/15.
*/

/* login  */

function LoginFun() {
    $('.input-wrap .login-btn').on('click', LoginCheckInput);
}
var post = {}, ischeckcode = false;
function LoginCheckInput() {
    var ovalU = $.trim($('.login-username').val());
    var ovalP = $.trim($('.login-password').val());
    if (ovalU.length == 0) {
        BirefShow(0);
        $('.biref p').html('请输入正确的登录名!');
        return false;
    } else {
        BirefHide();
    }
    if (ovalP.length == 0) {
        BirefShow(1);
        $('.biref p').html('请输入密码!');
        return false;
    } else {
        if (ovalP.length < 8) {
            BirefShow(1);
            $('.biref p').html('请输入8位数以上的密码!');
            return false;
        } else {
            BirefHide();
        }
    }
}
function BirefShow(num) {
    $('.biref').show();
    $('.input-wrap input').eq(num).focus();
}
function BirefHide() {
    $('.biref').hide();
}
/*   end  login  */


/*  register   */
$("#txtUsername").blur(function () {
    post.username = $("#txtUsername").val();
    if (post.username == "") {
        dealError('.Rg_name', '用户名不能为空');
        return;
    } else if (post.username.length < 6 || post.username.length > 30) {
        dealError('.Rg_name', '用户名长度必须在6-30位之间');
        return;
    } else if (post.password == post.username) {
        dealError('.Rg_name', '用户名不能和密码相同');
        return;
    }
    $.post("../../webnew/Customer/CustomerProcess/CustomerRegister.aspx?action=check-username", post, function (json) {
        if (json.Status.Code == "fail") {
            dealError('.Rg_name', json.Status.Msg);
        } else {
            ischeckcode = true;
            dealError('.Rg_name');
        }
    });
});
$("#txtPassword").blur(function () { rgCheckPassword(); });
$("#txtConfirmPassword").blur(function () { rgCheckPasswordAgain(); });
$("#txtMobile").blur(function () { rgCheckPhone(); });
$("#txtQQ").blur(function () { rgCheckQQCode(); });
function RegisterFun() {
    $('.registerNow').on('click', function () {
        if (!rgCheckName()) {
            AddClass('.Rg_name');
            return false;
        } else {
            RemoverClass(".Rg_name");
            if (!rgCheckPassword()) {
                AddClass('.Rg_password');
                return false;
            } else {
                RemoverClass(".Rg_password");
                if (!rgCheckPasswordAgain()) {
                    AddClass('.Rg_passwordAgain');
                    return false;
                } else {
                    RemoverClass(".Rg_passwordAgain");
                            if (!rgUPCode()) {
                                AddClass(".Rg_UPCode");
                                return false;
                            } else {
                                if (!rgCheckbox()) {
                                    return false;
                                } else {
                                    if (!rgCheckCode()) {
                                        return false;
                                    } else {
                                        formSubmit();
                                    }
                                }
                            }
                }
            }
        }
    });
    $('.party li i').on('mouseover', MoveNavAdd);
    $('.party li i').on('mouseout', MoveNavRemover);
}
function dealError(fid, msg) {

    var sender = $(fid).parents('.input-groups').find('.register-biref')
    if (!msg || msg == '') {
        sender.removeClass(fid);
        sender.hide();
        return;
    } else {
        sender.show();
        sender.find('p').html(msg);
    }
}
//验证用户名
function rgCheckName() {
    post.username = $.trim($('.Rg_name').val());
    if (post.username.length == 0) {
        dealError('.Rg_name', '用户名不能为空');
        return false;
    } else {
        dealError('.Rg_name');
        return true;
    }
}
//验证密码
function rgCheckPassword() {
    var reNum = /^(\d+)$/;
    var reLetter = /^([a-zA-Z]+)$/;
    post.password = $.trim($('.Rg_password').val());
    if (post.password.length < 8) {
        dealError('.Rg_password', '密码长度至少为8位');
        return false;
    } else {
        if (reNum.test(post.password)) {
            dealError('.Rg_password', '密码不能为纯数字');
            return false;
        } else if (reLetter.test(post.password)) {
            dealError('.Rg_password', '密码不能为纯字母');
            return false;
        } else if (post.password == post.username) {
            dealError('.Rg_password', '密码不能和用户名相同');
            return false;
        }
        else {
            dealError('.Rg_password');
            $('.Rg_passwordAgain').on('blur', rgCheckPasswordAgain);
            return true;
        }
    }
}
function rgCheckPasswordAgain() {
    post.password = $.trim($('.Rg_password').val());
    if (post.password == $.trim($('.Rg_passwordAgain').val())) {
        dealError('.Rg_passwordAgain');
        return true;
    } else {
        dealError('.Rg_passwordAgain', '输入的密码不一致');
        return false;
    }
}
//验证交易密码
function rgCheckTradePassword() {
    post.tradePassword = $.trim($('.Rg_TradePassword').val());
    if (post.tradePassword == "") {
        dealError('.Rg_TradePassword', '交易密码不能为空');
    } else if (post.tradePassword.length < 6 || post.tradePassword.length > 30) {
        dealError('.Rg_TradePassword', '密码长度必须在6-30位之间');
    } else {
        dealError('.Rg_TradePassword');
        $('.Rg_TradePasswordAgain').on('blur', rgCheckTradePasswordAgain);
        return true;
    }
}
function rgCheckTradePasswordAgain() {
    post.tradePassword = $.trim($('.Rg_TradePassword').val());
    if (post.tradePassword == $.trim($('.Rg_TradePasswordAgain').val())) {
        dealError('.Rg_TradePasswordAgain');
        return true;
    } else {
        dealError('.Rg_TradePasswordAgain', '输入的密码不一致');
        return false;
    }
}
//验证手机
function rgCheckPhone() {
    var re = /^1[3|4|5|7|8]\d{9}$/;
    post.mobile = $.trim($('.Rg_phone').val());
    if (post.mobile.length != 0) {
        if (re.test(post.mobile)) {
            dealError('.Rg_phone');
            return true;
        } else {
            dealError('.Rg_phone', '手机号格式有误');
            return false;
        }
    }
    return true;
}
//验证QQ
function rgCheckQQCode() {
    var Num = /^[0-9]*$/;
    post.QQ = $.trim($('.Rg_QQCode').val());
    if( post.QQ.length!=0){
        if (Num.test(post.QQ)) {
            if (post.QQ.length < 4) {
                if (post.QQ.length === 0) {
                    dealError('.Rg_QQCode', 'QQ号不能为空');
                    return false;
                } else {
                    dealError('.Rg_QQCode', 'QQ号不能小于4位');
                    return false;
                }
            } else {
                if (post.QQ.length > 11) {
                    dealError('.Rg_QQCode', 'QQ号不能大于11位');
                    return false;
                } else {
                    dealError('.Rg_QQCode');
                    return true;
                }
            }
        } else {
            dealError('.Rg_QQCode', 'QQ格式有误');
            return false;
        }
    }
    return true;
}
//验证上级代理编码
function rgUPCode() {
    post.agency = $('.Rg_UPCode');
    post.agency = $.trim($('.Rg_UPCode').val());
    if (post.agency != "" && post.agency.length < 5) {
        dealError('.Rg_UPCode', '5位或5位以上数字');
        return false;
    } else {
        dealError('.Rg_UPCode');
        return true;
    }
}
//验证码
function rgCheckCode() {
    var oBiref = $('.slide-Ver').parents('.slide-check').find('.register-biref');
    if (window.is_value) {
        RemoverClass('.slide-check');
        oBiref.hide();
        return true;
    } else {
        oBiref.show();
        oBiref.find('p').html('请点击或者滑动验证!');
        return false;
    }
}
function rgCheckbox() {
    var oInp = $('.Re_checkbox');
    if ($('.Re_checkbox').is(':checked')) {
        return true;
    } else {
        $('.Re_checkbox').parents('.checkbox-wrap').addClass('red');
        return false;
    }
}

function MoveNavAdd() {
    if ($(this).hasClass('icon-qq')) {
        $(this).removeClass('icon-qq').addClass('icon-qq1');
    } else {
        $(this).removeClass('icon-weixin').addClass('icon-weixin1');
    }
}
function MoveNavRemover() {
    if ($(this).hasClass('icon-qq1')) {
        $(this).removeClass('icon-qq1').addClass('icon-qq');
    } else {
        $(this).removeClass('icon-weixin1').addClass('icon-weixin');
    }
}
function MessageBiref(that, Message) {
    var oBiref = $(that).parents('.input-groups').find('.register-biref');
    oBiref.find('p').html(Message);
}
function RemoverClass(obj) {
    if ($(obj).parents('.label-groups').hasClass('denger')) {
        $(obj).parents('.label-groups').removeClass('denger');
    }
}
function AddClass(obj) {
    $(obj).focus();
    $(obj).parents('.label-groups').addClass('denger');
}
function updata(num, t) {
    if (num == 60) {
        Off = true;
        $('.Rg-code').prop('disabled', false);
        $('.Rg-code').html('重新发送');
        $('.Rg-code').addClass('hover');
        $('.Rg-code').removeClass('active');
    } else {
        var printnr = t - num;
        $('.Rg-code').attr('disabled', true);
        $('.Rg-code').addClass('active');
        $('.Rg-code').removeClass('hover');
        $('.Rg-code').html('重新发送（' + printnr + '）');
    }
}
function changeButton() {
    var t = 60;
    Off = false;
    $('.Rg_phoneCode').on('blur', rgCheckPhoneCode);
    for (var i = 0; i <= t; i++) {
        window.setTimeout("updata(" + i + "," + t + ")", i * 1000);
    }
}
function rgCheckPhoneCode() {
    var oInp = $.trim($('.Rg_phoneCode').val());
    var oBiref = $('.Rg_phoneCode').parents('.input-groups').find('.register-biref');
    if (oInp.length == 0) {
        oBiref.show();
        oBiref.find('p').html('验证码不能为空');
        return false;
    } else {
        RemoverClass('.Rg_phoneCode');
        oBiref.hide();
        return true;
    }
}
//注册成功跳转
function rgShowEndYes() {
    if (document.documentElement.clientWidth > document.documentElement.offsetWidth - 4) {
        autoHeight();
    }
    $('.ing').hide();
    $('.end').show();
    $('#timer').html("5");
    setTimeout('delayURL()', 5000);
    ChangeTime();
    return true;
}
//注册失败
function rgShowEndNo() {

    if (document.documentElement.clientWidth > document.documentElement.offsetWidth - 4) {
        autoHeight();
    }
    $('.end_left .icoBg').removeClass('icon-yes').addClass('icon-no');
    $('.end_right span').html('注册失败');
    $('.ing').hide();
    $('.end').show();
}

function formSubmit() {
    post.geetest_validate = window.ret_value['validate'];
    $.post("webnew/Customer/CustomerProcess/CustomerRegister.aspx?action=register", post, function (json) {
        if (json.Status.Code == "fail") {
            var msg = json.Status.Msg;
            if (msg.indexOf("用户名") >= 0) {
                dealError('.Rg_name', msg);
            } else if (msg.indexOf("密码") >= 0) {
                dealError('.Rg_password', msg);
            } else if (msg.indexOf("手机") >= 0) {
                dealError('.Rg_phone', msg);
            } else if (msg.indexOf("QQ") >= 0) {
                dealError('.Rg_QQCode', msg);
            } else if (msg.indexOf("验证码") >= 0) {
                var oBiref = $('.slide-Ver').parents('.slide-check').find('.register-biref');
                oBiref.show();
                oBiref.find('p').html('请点击或者滑动验证!');
            } else {
                alert(msg);
            }
            loadYzm();
        } else {//成功
            rgShowEndYes();
        }
    });
}
function ChangeTime() {
    var maxtime = 4;
    function CountDown() {
        if (maxtime >= 0) {
            $('#timer').html(maxtime);
            --maxtime;
        }
        else {
            clearInterval(timer);
        }
    }
    timer = setInterval(function () {
        CountDown();
    }, 1000); 

}


/*   end  register  */

/*  revise_password   */

function Revise_passwordFun() {

    $('#Revise-code').on('click', RechangeButton);
    $('.view-wrap .btn-profile').on('click', function () {
        var that = this;
        if (!reCheckName()) {
            AddClass('.Re_PWname');
            return false;
        } else {
            $.ajax({
                url: '../../webnew/Customer/CustomerProcess/CustomerRegister.aspx?action=check-username',
                type: 'post',
                async: false, //使用同步的方式,true为异步方式
                data: post, //这里使用json对象
                success: function (data) {
                    if (data.Status.Code == "fail") {
                        dealError('.Re_PWname');
                    } else {
                        dealError('.Re_PWname', "用户名不存在");
                        return false;
                    }
                },
                fail: function () {
                    dealError('.Re_PWname', "系统错误！请稍后再次尝试");
                }
            });
        }
        if (!reCheckPhone()) {
            AddClass('.Re_PWphone');
            return false;
        } else {
            $.ajax({
                url: '../../webnew/Customer/CustomerProcess/CustomerRegister.aspx?action=check-pwvalidationphone',
                type: 'post',
                async: false, //使用同步的方式,true为异步方式
                data: post, //这里使用json对象
                success: function (data) {
                    if (data.Status.Code == "fail") {
                        dealError('.Re_PWphone', "输入的手机号码与账户预留手机号码不匹配！");
                        return false;
                    } else {
                        dealError('.Re_PWphone');
                    }
                },
                fail: function () {
                    dealError('.Re_PWphone', "系统错误！请稍后再次尝试");
                }
            });
        }
        if (!rgCheckCode()) {
            return false;
        } else {
            $(".second  .input-groups p").html('手机验证码将发送至  ' + post.mobile.substr(0, 3) + "*****" + post.mobile.substr(7) + '，请查看短信，并填写验证码!');
            NavListFirst(1, that);
            return true;
        }
        return false;
    });
    $('.view-wrap .btn-interest').on('click', function () {
        var that = this;

        if (!reCheckPhoneCode()) {
            AddClass('.Re_PWcode');
            return false;
        } else {
            if (yzCheckCode()) {
                NavListFirst(2, that);
                return true;
            } else {
                return false;
            }
        }
    });
    $('.view-wrap .btn-Password').on('click', function () {

        var that = this;
        var that = this;
        if (!reCheckPassword()) {
            AddClass('.Re_PWpassword');
            return false;
        } else {
            RemoverClass('.Re_PWpassword');
            if (!reCheckPasswordAgain()) {
                AddClass('.Re_PWpasswordAgain');
                return false;
            } else {
                if (!ResetPassWord()) {
                    RemoverClass('.Re_PWpasswordAgain');
                    NavListFirst(3, that);
                    setTimeout('delayURL()', 5000);
                    return true;
                } else {
                    return false;
                }
            }
        }
    });
}
//修改密码
function ResetPassWord() {
    $.ajax({
        url: '../../webnew/Customer/CustomerProcess/CustomerForgotPassword.aspx?action=reset',
        type: 'post',
        async: false, //使用同步的方式,true为异步方式
        data: post, //这里使用json对象
        success: function (data) {
            if (data.Status.Code == "fail") {
                dealError('.Re_PWpasswordAgain', data.Status.Msg);
                return false;
            } else {
                return true;
            }
        },
        fail: function () {
            dealError('.Re_PWpasswordAgain', "系统错误！请稍后再次尝试");
        }
    });

}
function CheckPwPhone() {
    $.ajax({
        url: '../../webnew/Customer/CustomerProcess/CustomerRegister.aspx?action=check-pwphone',
        type: 'post',
        async: false, //使用同步的方式,true为异步方式
        data: post, //这里使用json对象
        success: function (data) {
            if (data.Status.Code == "fail") {
                dealError('.Re_PWphone', data.Status.Msg);
                return false;
            } else {
                return true;
            }
        },
        fail: function () {
            dealError('.Re_PWphone', "系统错误！请稍后再次尝试");
        }
    });
}
//验证手机短信
function yzCheckCode() {
    $.ajax({
        url: '../../webnew/Customer/CustomerProcess/CustomerForgotPassword.aspx?action=ck-code',
        type: 'post',
        async: false, //使用同步的方式,true为异步方式
        data: post, //这里使用json对象
        success: function (data) {
            if (data.Status.Code == "fail") {
                dealError('.Re_PWcode', data.Status.Msg);
                return false;
            } else {
                return true;
            }
        },
        fail: function () {
            dealError('.Re_PWcode', "系统错误！请稍后再次尝试");
        }
    });
}
//验证用户名
function reCheckName() {
    post.username = $.trim($('.Re_PWname').val());
    if (post.username.length == 0) {
        dealError('.Re_PWname', '用户名不能为空');
        return false;
    } else {
        dealError('.Re_PWname');
        return true;
    }
}
//验证手机
function reCheckPhone() {
    var re = /^1[3|4|5|7|8]\d{9}$/;
    post.mobile = $.trim($('.Re_PWphone').val());
    if (re.test(post.mobile)) {
        if (!CheckPwPhone()) {
            dealError('.Re_PWphone');
            return true;
        }
    } else {
        if (post.mobile.length == 0) {
            dealError('.Re_PWphone', '手机号不能为空');
            return false;
        } else {
            dealError('.Re_PWphone', '手机号格式有误');
            return false;
        }
    }
}
function reCheckPhoneCode() {
    post.ckcode = $.trim($('.Re_PWcode').val());
    if (post.ckcode.length == 0) {
        dealError('.Re_PWcode', '验证码不能为空');
        return false;
    } else {
        return true;
    }
}
//发送短信验证码
function RechangeButton() {
    $.post("webnew/Customer/CustomerProcess/CustomerForgotPassword.aspx?action=send-code", post, function (json) {
        if (json.Status.Code == "fail") {
            dealError('.Re_PWcode', json.Status.Msg);
        } else {
            dealError('.Re_PWcode');
            var btnVeriCode = $("#Revise-code")
            timerVeriCode.init(btnVeriCode);
        }
    });
}

function updatare(num, t) {
    if (num == 60) {
        Off = true;
        $('#Revise-code').prop('disabled', false);
        $('#Revise-code').html('重新发送');
        $('#Revise-code').addClass('hover');
        $('#Revise-code').removeClass('active');
    } else {
        var printnr = t - num;
        $('#Revise-code').attr('disabled', true);
        $('#Revise-code').addClass('active');
        $('#Revise-code').removeClass('hover');
        $('#Revise-code').html('重新发送（' + printnr + '）');
    }
}
function NavListFirst(obj1, that) {
    var class1 = '';
    var class2 = '';
    var class3 = '';
    if (obj1 == 1) {
        class1 = '.two';
        class2 = '.first';
        class3 = '.second';
    } else if (obj1 == 2) {
        class1 = '.three';
        class2 = '.second';
        class3 = '.third';
    } else if (obj1 == 3) {
        class1 = '.four';
        class2 = '.third';
        class3 = '.fourth';

    }
    $('#status-buttons').find(class1).addClass('active');
    $(that).parents('#signup-form').find(class2).addClass('ng-leave');
    $(that).parents('#signup-form').find(class3).show();
    $(that).parents('#signup-form').find(class3).addClass('ng-enter');
}
function reCheckPassword() {
    var reNum = /^(\d+)$/;
    var reLetter = /^([a-zA-Z]+)$/;
    post.password = $.trim($('.Re_PWpassword').val());
    if (post.password.length < 8) {
        dealError('.Re_PWpassword', '密码长度至少为8位');
        return false;
    } else {
        if (reNum.test(post.password)) {
            dealError('.Re_PWpassword', '密码不能为纯数字');
            return false;
        } else if (reLetter.test(post.password)) {
            dealError('.Re_PWpassword', '密码不能为纯字母');
            return false;
        } else {
            dealError('.Re_PWpassword');
            RemoverClass('.Re_PWpassword');
            $('.Re_PWpasswordAgain').on('blur', reCheckPasswordAgain);
            return true;
        }
    }
}
function reCheckPasswordAgain() {
    var oInpAgain = $.trim($('.Re_PWpasswordAgain').val());
    if (post.password === oInpAgain) {
        dealError('.Re_PWpasswordAgain');
        return true;
    } else {
        dealError('.Re_PWpassword', '输入的密码不一致');
        return false;
    }
}
function delayURL() {
    window.location.href = "/Default.aspx";
}
function autoHeight() {
    var oh = $(window).height();
    var h1 = $('.register-header').outerHeight();
    var h2 = $('.register-content').outerHeight();
    var h3 = $('.register-footer').outerHeight();
    var oH = h1 + h2 + h3;

    if (oh > oH) {

        $('.register-footer').css({ "position": "absolute", "bottom": 0 });
    } else {
        $('.register-footer').css('position', 'inherit');
    }
}
/* end   revise_password   */


function ThirdLoginFun() {
    $('.registerNow').on('click', function () {
        if (!rgCheckPhone()) {
            AddClass('.Rg_phone');
            return false;
        } else {
            if (!rgCheckQQCode()) {
                AddClass('.Rg_QQCode');
                return false;
            } else {
                return true;
            }
        }
    })
}

/*  revise_phone   */

function Revise_phoneFun() {
    $('.Re_PHphone').on('blur', function () {
        if (!rePHCheckPhone()) {
            return false;
        } else {
            $('#Revise-code').attr('disabled', false);
            $('#Revise-code').addClass('hover');
            $('.Re_PWcode').on('blur', reCheckPhoneCode);
            RemoverClass('.Re_PHphone');
        }
    });
    $('.view-wrap .btn-profile').on('click', function () {

        var that = this;
        if (!rePHCheckPhone()) {
            AddClass('.Re_PHphone');
            return false;
        } else {
            if (!reCheckPhoneCode()) {
                AddClass('.Re_PWcode');
                return false;
            } else {
                NavListFirst(1, that);
                return true;
            }
        }

    });
    $('.Re_PHphoneT').on('blur', function () {
        if (!rePHCheckPhoneT()) {
            return false;
        } else {
            $('#Revise-codeT').attr('disabled', false);
            $('#Revise-codeT').addClass('hover');
            $('.Re_PWcode').on('blur', reCheckPhoneCode);
            RemoverClass('.Re_PHphoneT');
        }
    });
    $('.view-wrap .btn-interest').on('click', function () {
        var that = this;
        if (!rePHCheckPhoneT()) {
            AddClass('.Re_PHphoneT');
            return false;
        } else {
            RemoverClass('.Re_PHphoneT');
            if (!reCheckPhoneCodeT()) {
                AddClass('.Re_PWcodeT');
                return false;
            } else {
                RemoverClass('.Re_PWcodeT');
                NavListFirst(2, that);
                setTimeout('delayURL()', 2000);
                return true;
            }
        }
    })
}

function rePHCheckPhone() {
    var re = /^1[3|4|5|7|8]\d{9}$/;
    var oInp = $.trim($('.Re_PHphone').val());
    var oBiref = $('.Re_PHphone').parents('.label-groups').find('.register-biref');
    if (re.test(oInp)) {
        oBiref.hide();
        $('#Revise-code').on('click', RechangeButton);
        return true;
    } else {
        oBiref.show();
        if (oInp.length == 0) {
            oBiref.find('p').html('手机号不能为空');
            return false;
        } else {
            oBiref.find('p').html('手机号格式有误');
            return false;
        }
    }
}
function rePHCheckPhoneT() {
    var re = /^1[3|4|5|7|8]\d{9}$/;
    var oInp = $.trim($('.Re_PHphoneT').val());
    var oBiref = $('.Re_PHphoneT').parents('.label-groups').find('.register-biref');
    if (re.test(oInp)) {
        oBiref.hide();
        console.log(1);
        $('#Revise-codeT').on('click', RechangeButtonT);
        return true;
    } else {
        oBiref.show();
        if (oInp.length == 0) {
            oBiref.find('p').html('手机号不能为空');
            return false;
        } else {
            oBiref.find('p').html('手机号格式有误');
            return false;
        }
    }
}
function RechangeButtonT() {
    var t = 60;
    Off = false;
    $('.Re_PWcode').on('blur', reCheckPhoneCode);
    for (var i = 0; i <= t; i++) {
        window.setTimeout("updatareT(" + i + "," + t + ")", i * 1000);
    }
}
function updatareT(num, t) {
    if (num == 60) {
        Off = true;
        $('#Revise-codeT').prop('disabled', false);
        $('#Revise-codeT').html('重新发送');
        $('#Revise-codeT').addClass('hover');
        $('#Revise-codeT').removeClass('active');
    } else {
        var printnr = t - num;
        $('#Revise-codeT').attr('disabled', true);
        $('#Revise-codeT').addClass('active');
        $('#Revise-codeT').removeClass('hover');
        $('#Revise-codeT').html('重新发送（' + printnr + '）');
    }
}
function reCheckPhoneCodeT() {
    var oInp = $.trim($('.Re_PWcodeT').val());
    var oBiref = $('.Re_PWcodeT').parents('.label-groups').find('.register-biref');
    if (oInp.length == 0) {
        oBiref.show();
        oBiref.find('p').html('验证码不能为空');
        return false;
    } else {
        RemoverClass('.Re_PWcodeT');
        oBiref.hide();
        return true;
    }
}
/*  end  revise_phone   */

/*   Service   */

function ServiceFun() {
    $('.right-nav').on('mouseover', IDMouseShow);
    $('.right-nav').on('mouseout', IDMouseHide);
    DetailFun();
}

function IDMouseShow() {
    $(this).addClass('on');
    $('.nav-ul').show();
    $('.right-nav p').css('background', '#019ddd');
    $('.right-nav i').removeClass('icon-down').addClass('icon-up');
}
function IDMouseHide() {
    $(this).removeClass('on');
    $('.right-nav p').css('background', '#01aaef');
    $('.nav-ul').hide();
    $('.right-nav i').removeClass('icon-up').addClass('icon-down');
}
function Select(e) {
    e.stopPropagation();
    $('.dropdown-menu').show();
    $('.dropdown-menu li a').on('click', function () {
        var ohtml = $(this).html();
        $('.btnSelect strong').html(ohtml);
        $('.dropdown-menu').hide();
    })
    $(document).on('click', function () {
        $('.dropdown-menu').hide();
    });
}
function autoheight() {
    var oh = $(window).height();
    var h1 = $('.register-header').outerHeight();
    var h2 = $('.content').outerHeight();
    var h3 = $('.register-footer').outerHeight();
    var oH = h1 + h2 + h3;

    if (oh > oH) {

        $('.register-footer').css({ "position": "absolute", "bottom": 0 });
    } else {
        $('.register-footer').css('position', 'inherit');
    }
}

function DetailFun() {
    var Timer = '';
    $('.detail-list').on('mouseover', function () {
        var oDiv = $(this).parent('.h4').find('.detail-nav');
        oDiv.show();
    });
    $('.detail-list').on('mouseout', function () {
        var oDiv = $(this).parent('.h4').find('.detail-nav');
        oDiv.hide();
    });
    $('.detail-nav a').on('mouseover', function () {
        $('.detail-nav a').removeClass('active');
        $(this).addClass('active');
    });
}

var timerVeriCode = {
    init: function (btn) {
        this.btn = btn;
        this.btn.disabled = true;
        $(this.btn).addClass('on');
        $(btn).attr("secLeft", "60");
        this.html = $(btn).html();
        this.trigger()
    },
    trigger: function () {
        var lastSec = $(this.btn).attr("secLeft") * 1;
        $(this.btn).html(lastSec + "秒后重发");
        $(this.btn).attr("secLeft", --lastSec);
        if (lastSec < 0) {
            this.dispose()
        } else {
            setTimeout(function () {
                timerVeriCode.trigger()
            }, 1000)
        }
    },
    dispose: function () {
        this.btn.disabled = false;
        $(this.btn).removeClass('on');
        $(this.btn).html("重新发送");
        $('.input_moblie').attr('disabled', false);
    }
};

function loadYzm() {
    initNECaptcha({
        captchaId: '56188621187d469086d7d8acdd8b267a',
        element: '#captcha_div',
        mode: 'float',
        width: 320,
        onReady: function (instance) {
            // 验证码一切准备就绪，此时可正常使用验证码的相关功能
        },
        onVerify: function (err, data) {
            window.is_value = err == null ? true : false;
            window.ret_value = data;
        }
    }, function onload(instance) {
        // 初始化成功
    }, function onerror(err) {
        // 验证码初始化失败处理逻辑，例如：提示用户点击按钮重新初始化
    })
 }
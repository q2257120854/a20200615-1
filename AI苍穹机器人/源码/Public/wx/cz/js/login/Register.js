/**
 * Created by Administrator on 2018/6/25.
 */
$(function() {
    $('#registerbtn').on('click', function () {
        var phone = $.trim($('#phone').val());
        var GrCode = $.trim($('#GrCode').val());
        var Account = $.trim($('#Account').val());
        var wechat = $.trim($('#wechat').val());
        var loginpassword = $.trim($('#loginpassword').val());
        var ConfirmLogin = $.trim($('#ConfirmLogin').val());
        var VerificationCode = $.trim($('#VerificationCode').val());
        var TransactionPassword = $.trim($('#TransactionPassword').val());
        var ConfirmTransaction = $.trim($('#ConfirmTransaction').val());
        if (!phone) {
            layer.open({
                content: '请输入手机号码!',
                skin: 'msg',
                time: 2 //停留2秒
            });
            $('#phone').focus();
            return false;
        }
        if (!GrCode) {
            layer.open({
                content: '请输入图形验证码!',
                skin: 'msg',
                time: 2
            });
            $('#GrCode').focus();
            return false;
        }
        if (!VerificationCode) {
            layer.open({
                content: '请输入验证码!',
                skin: 'msg',
                time: 2
            });
            $('#VerificationCode').focus();
            return false;
        }
        if (!Account) {
            layer.open({
                content: '请输入支付宝账号!',
                skin: 'msg',
                time: 2
            });
            $('#Account').focus();
            return false;
        }
        if (!wechat) {
            layer.open({
                content: '请输入微信号!',
                skin: 'msg',
                time: 2
            });
            $('#wechat').focus();
            return false;
        }
        if (!loginpassword) {
            layer.open({
                content: '请输入登录密码!',
                skin: 'msg',
                time: 2
            });
            $('#loginpassword').focus();
            return false;
        }
        if (!ConfirmLogin) {
            layer.open({
                content: '请再次输入登录密码!',
                skin: 'msg',
                time: 2
            });
            $('#ConfirmLogin').focus();
            return false;
        }
        if (loginpassword != ConfirmLogin) {
            layer.open({
                content: '你输入的密码格式不正确!',
                skin: 'msg',
                time: 2
            });
            return false;
        }
        if (!TransactionPassword) {
            layer.open({
                content: '请输入交易密码!',
                skin: 'msg',
                time: 2
            });
            $('#TransactionPassword').focus();
            return false;
        }
        if (!ConfirmTransaction) {
            layer.open({
                content: '请再次输入交易密码!',
                skin: 'msg',
                time: 2
            });
            $('#ConfirmTransaction').focus();
            return false;
        }
        if (TransactionPassword != ConfirmTransaction) {
            layer.open({
                content: '你输入的交易密码格式不正确!',
                skin: 'msg',
                time: 2
            });
            return false;
        }
        window.location.href='login.html';
    });
})
//倒计时验证码
var countDown = 10;
function setTime(val) {
    if (countDown == 0) {
        val.removeAttribute("disabled");
        $('.getcode').css({color: '#fff',background:"#23d41e"});
        $('#registerbtn').css({color:'#ff62a4'}).removeAttr('disabled')

        val.value = "获取验证码";
        countDown = 10;
        return;
    } else {
        val.setAttribute("disabled", true);
        $('.getcode').css({color: '#999',background:"#ccc"});
        val.value = "重新发送(" + countDown + ")";
        $('#registerbtn').css({color:'#ccc'}).attr("disabled", true);
        countDown--;
    }
    setTimeout(function () {
        setTime(val)
    }, 1000)
}
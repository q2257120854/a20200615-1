/**
 * Created by Administrator on 2018/6/25.
 */
$(function () {
    $('#Submission').on('click', function () {
        var user = $.trim($('#user').val());
        var NewsPassword = $.trim($('#NewsPassword').val());
        var confirmPassword = $.trim($('#confirmPassword').val());
        var VerificationCode = $.trim($('#VerificationCode').val());
        if (!user) {
            layer.open({
                content: '请输入用户名!',
                skin: 'msg',
                time: 2 //停留2秒
            });
            $('#user').focus();
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
        if (!NewsPassword) {
            layer.open({
                content: '请设置新密码!',
                skin: 'msg',
                time: 2
            });
            $('#NewsPassword').focus();
            return false;
        }
        if (!confirmPassword) {
            layer.open({
                content: '请再次输入新密码!',
                skin: 'msg',
                time: 2
            });
            $('#confirmPassword').focus();
            return false;
        }
        if (NewsPassword != confirmPassword) {
            layer.open({
                content: '你输入的密码格式不正确!',
                skin: 'msg',
                time: 2
            });
            return false;
        }
        window.location.href = 'login.html';
    });
})
//倒计时验证码
var countDown = 10;
function setTime(val) {
    if (countDown == 0) {
        val.removeAttribute("disabled");
        $('.getcode').css({color: '#fff',background:"#23d41e"});
        $('#Submission').css({color:'#ff62a4'}).removeAttr('disabled')

        val.value = "获取验证码";
        countDown = 10;
        return;
    } else {
        val.setAttribute("disabled", true);
        $('.getcode').css({color: '#999',background:"#ccc"});
        val.value = "重新发送(" + countDown + ")";
        $('#Submission').css({color:'#ccc'}).attr("disabled", true);
        countDown--;
    }
    setTimeout(function () {
        setTime(val)
    }, 1000)
}
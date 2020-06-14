
function OpenWin(formurl) {
    //设置新开窗口大小
    var maxh = screen.availHeight - 30;
    var maxw = screen.availWidth - 10;
    OpenWindow = window.open("", "newwin", "height=" + maxh + ", width=" + maxw + ",toolbar=no,scrollbars=" + scroll + ",menubar=no");
    //写成一行   
    OpenWindow.document.write(formurl)
    OpenWindow.document.close()
}

/* 
获取验证码通用方法
*/
function GetCheckCode() {

    var CheckCodeUrl = "//pay.tiancity.com/Pay/Captcha/GetCaptcha";

    $.ajax({
        type: 'GET',
        url: CheckCodeUrl,
        cache: false,
        dataType: "jsonp",
        jsonp: "callbackparam",
        success: function (data) {
          
            var ReturnCode = data.ReturnCode; // 返回值   
            var ReturnContent = eval("(" + data.ReturnContent + ")"); // 返回内容

            if (ReturnCode == "9" && ReturnContent != null) {
                var CaptchaUrl = ReturnContent["CaptchaUrl"]; // 返回验证码url
                var Tid = CaptchaUrl.split('&')[1].split('=')[1]; // Tid   
                $('#imgCheckCode').attr("src", CaptchaUrl);
                $('#Tid').val(Tid);
                $("#CheckCodeShow").removeAttr("style");
                return;
            }
        },
        error: function () {
            //alert('意外错误，请稍后重试[1]!');
        }
    });
}

// 弹框
function showPop(i) {
    if (i == 0) {
        $.showDialog('.payConfirm');
    } else if (i == 1) {
        $.showDialog('.payCompleted');
    } else if (i == 2) {
        $.showDialog('.payFailed');
    }
}
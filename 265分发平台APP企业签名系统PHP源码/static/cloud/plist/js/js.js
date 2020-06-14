// 姹夊瓧 鑻辨枃 瀛楃缁熶竴
function getByteLen(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        if (a.match(/[^\x00-\xff]/ig) != null) {
            len += 2;
        } else {
            len += 1;
        }
    }
    return len;
}

// 楠岃瘉 鍙兘杈撳叆瀛楁瘝
function verifyLetter(val) {
    var letterReg = /[^a-zA-Z]/g;
    return letterReg.test(val);
}

// 楠岃瘉 鐗规畩瀛楃
function verifySpecialCharacters(val) {
    var specialCharactersReg = /[^u4e00-u9fa5w]/g;
    return specialCharactersReg.test(val);
}

// 楠岃瘉 鍙敮鎸佷腑鏂囥€佽嫳鏂囥€佹暟瀛�
function verifyCharacters(val) {
    var charactersReg = /[^\a-\z\A-\Z0-9\u4E00-\u9FA5]/g;
    return charactersReg.test(val);
}

// 楠岃瘉 鍙敮鎸佸瓧姣嶅拰鏁板瓧
function verifyLetterDigital(val) {
    var letterDigitalReg = /[^\w\.\/]/ig;
    return letterDigitalReg.test(val);
}

// 楠岃瘉url
function verifyUrl(val) {
    var urlReg = /^((ht|f)tps?):\/\/([\w\-]+(\.[\w\-]+)*\/)*[\w\-]+(\.[\w\-]+)*\/?(\?([\w\-\.,@?^=%&:\/~\+#]*)+)?/;
    return urlReg.test(val);
}

// 楠岃瘉 Bundle ID
function verifyBundle(val) {
    var bundleReg = /^[a-zA-Z][a-zA-z_0-9]{0,15}(\.[a-zA-z][a-zA-z_0-9]{0,15})/;
    return bundleReg.test(val);
}

// 澧炲姞replaceAll()
String.prototype.replaceAll = function (s1, s2) {
    return this.replace(new RegExp(s1, "gm"), s2);
};

// 淇js toFixed() bug
Number.prototype.toFixed = function (s) {
    changenum = (parseInt(this * Math.pow(10, s) + 0.5) / Math.pow(10, s)).toString();
    index = changenum.indexOf(".");
    if (index < 0 && s > 0) {
        changenum = changenum + ".";
        for (i = 0; i < s; i++) {
            changenum = changenum + "0";
        }
    } else {
        index = changenum.length - index;
        for (i = 0; i < (s - index) + 1; i++) {
            changenum = changenum + "0";
        }
    }
    return changenum;
}

// 閫夐」鍗�
var tab = {
    basis: function (obj) {
        $(obj.el).click(function () {
            var i = $(this).index();
            $(this).addClass("active").siblings().removeClass("active");

            $(obj.elTab).eq(i).show().siblings().hide();
            obj.callBack = obj.callBack || function () {};
            obj.callBack();
        });
    },
    radioRound: function (obj) {
        $(obj.el).click(function () {
            $(obj.el).removeClass("active").find(".icon").removeClass(obj.checkedClass);
            $(this).addClass("active").find(".icon").addClass(obj.checkedClass);
        });
    },
    radioTick: function (obj) {
        $(obj.el).click(function () {
            var i = $(this).index();
            $(this).addClass("active").siblings().removeClass("active");

            if (i == 0) {
                $(obj.elHide).show();
            } else {
                $(obj.elHide).hide();
            }
        });
    }
};
/*
tab.radioTick({
    el: ".radio-tick li"
});
*/
/*
tab.radioRound({
    el: ".radio-round li",
    checkedClass: "icon-radio-checked"
});
*/

// 瀹炴椂鑾峰彇input鐨勮緭鍏ュ€煎苟璧嬪€肩粰鍙︿竴鍏冪礌
var realTime = {
    inputText: function (obj) {
        $(obj.el).bind("input propertychange", function () {
            var thisVal = $(this).val();
            // console.log(thisVal);
            $(obj.elEdit).text(thisVal);
        });
    }
};

// 鍥剧墖绱㈠紩 鍦板潃璧嬪€�
var imgSrc = {
    edit: function (obj) {
        var src = $(obj.el).attr("src");
        src = src.substr(0, src.lastIndexOf("/") + 1);
        $(obj.el).attr("src", src + obj.index + "." + obj.format+"?2018");
    }
};

// 寮圭獥
var Modal = function() { // Modal涓哄尶鍚嶅嚱鏁版墽琛屽畬鐨勮繑鍥炲€�
    function determineModal(obj) {
        $("#determineModal").remove();
        var determineModalHtml = '<div class="modal fade ms-modal" id="determineModal" tabindex="-1" role="dialog">\n' +
            '    <div class="modal-dialog modal-sm" role="document">\n' +
            '        <div class="modal-content">\n' +
            '            <div class="modal-body">\n' +
            '                <div class="text-center">\n' +
            '                    <div class="modal-icon"><span class="icon icon-class mb5"></span></div>\n' +
            '                    <div class="color-333 bold font16 title"></div>\n' +
            '                    <div class="color-333 mt5 modal-p"></div>\n' +
            '                    <div class="mt15">\n' +
            '                        <button type="button" class="ms-btn ms-btn-primary modal-btn" data-dismiss="modal"></button>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>';

        $("body").append(determineModalHtml);
        $("#determineModal").find(".icon-class").addClass(obj.iconClass);
        $("#determineModal").find(".title").text(obj.title);
        $("#determineModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#determineModal").find(".modal-btn").text(obj.btnText);
        $("#determineModal").modal('show');
    };
    function templateModal(obj) {
        $("#templateModal").remove();
        var templateModalHtml = '<div class="modal fade ms-modal" id="templateModal" tabindex="-1" role="dialog">\n' +
            '    <div class="modal-dialog modal-sm" role="document">\n' +
            '        <div class="modal-content">\n' +
            '            <div class="modal-body">\n' +
            '                <div class="template-modal">\n' +
            '                    <div class="m-top">\n' +
            '                        <div class="title1"></div>\n' +
            '                        <div class="title2"></div>\n' +
            '                    </div>\n' +
            '                    <div class="modal-p"></div>\n' +
            '                    <button type="button" class="ms-btn ms-btn-primary modal-btn" data-dismiss="modal"></button>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>\n';

        $("body").append(templateModalHtml);
        $("#templateModal").find(".m-top").css("background-image", "url(/static/default/img/" + obj.imgName +")");
        $("#templateModal").find(".title1").text(obj.title1);
        $("#templateModal").find(".title2").html(obj.title2);
        $("#templateModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#templateModal").find(".modal-btn").text(obj.btnText).addClass(obj.btnClass);
        $("#templateModal").modal('show');
        $("#templateModal").find(".modal-btn").click(obj.callBack);
        if ($("#templateModal").find(".title2").text().length == 0) {
            $("#templateModal").find(".m-top").css({"padding-top": "40px"});
        }
    };
    function generalModal(obj) { // 閫氱敤寮圭獥
        $("#generalModal").remove();
        $(".modal-backdrop").remove();
        var generalModalHtml = '<div class="modal fade ms-modal" id="generalModal" tabindex="-1" role="dialog">\
            <div class="modal-dialog modal-sm" role="document">\
                    <div class="modal-content">\
                        <div class="modal-body">\
                            <div class="text-center">\
                                <div class="modal-icon"><span class="icon icon-class mb5"></span></div>\
                                <div class="color-333 bold font16 title"></div>\
                                <div class="color-333 modal-p"></div>\
                                <div class="">\
                                    <a href="javascript:;" class="ms-btn cancel-btn"></a>\
                                    <button type="button" class="ms-btn ms-btn-primary success-btn"></button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>';

        $("body").append(generalModalHtml).css("padding-right", 0);
        $("#generalModal").find(".icon-class").addClass(obj.iconClass);
        $("#generalModal").find(".title").text(obj.title);
        $("#generalModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#generalModal").find(".success-btn").text(obj.successBtnText);
        $("#generalModal").find(".cancel-btn").text(obj.cancelBtnText);
        if (obj.backdrop) {
            $("#generalModal").modal({backdrop: 'static', keyboard: false});
        } else {
            $("#generalModal").modal("show");
        }
        $("#generalModal").find(".success-btn").click(obj.successCallback);
        $("#generalModal").find(".cancel-btn").click(obj.cancelCallback);
        var iconClassLength = $("#generalModal").find(".icon-class").attr("class").replace(/\s*/g,"").length;
        // console.log(iconClassLength);
        if (iconClassLength == 17) {
            $("#generalModal").find(".modal-icon").hide();
        } else {
            $("#generalModal").find(".modal-icon").show();
        }

        // 鐐瑰嚮鎸夐挳鏄惁鍏抽棴寮圭獥
        $("#generalModal").find(".success-btn").click(function () {
            if (obj.successBtnModal) {
                $("#generalModal").modal("hide");
            }
        });
        $("#generalModal").find(".cancel-btn").click(function () {
            if (obj.cancelBtnModal) {
                $("#generalModal").modal("hide");
            }
        });
    };
    function autoHideModal(obj) { // 鑷姩鍏抽棴寮圭獥
        $(".modal-backdrop").remove();
        $("#autoHideModal").remove();
        var modalHtml = '<div class="modal fade ms-modal auto-hide-modal" id="autoHideModal" tabindex="-1" role="dialog">\
                <div class="modal-dialog modal-sm" role="document">\
                    <div class="modal-content">\
                        <div class="modal-body">\
                            <div class="text-center">\
                                <div class="auto-hide">\
                                    <span class="icon"></span>\
                                    <div class="mt5 text">obj.text</div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>';
        $("body").append(modalHtml);
        $("#autoHideModal .auto-hide .icon").addClass(obj.iconClass);
        $("#autoHideModal .auto-hide .text").html(obj.text);
        var autoHide = null;
        clearTimeout(autoHide);
        $("#autoHideModal").modal('show');
        $(".modal-backdrop").hide();
        autoHide = setTimeout(function(){
            $("#autoHideModal").modal("hide");
        }, obj.time);
        $('#autoHideModal').on('hidden.bs.modal', obj.callBack);
    };
    function deleteAppModal(obj) { // 閫氱敤寮圭獥
        $("#deleteAppModal").remove();
        $(".modal-backdrop").remove();
        var html = '<div class="modal fade ms-modal" id="deleteAppModal" tabindex="-1" role="dialog">\
            <div class="modal-dialog" role="document">\
                <div class="modal-content">\
                    <div class="modal-body">\
                            <div class="text-center">\
                                <div class="modal-icon"><span class="icon icon-class mb5"></span></div>\
                                    <div class="color-333 bold font16 title"></div>\
                                    <div class="color-333 modal-p"></div>\
                                    <div class="form-horizontal">\
                                        <div class="form-group">\
                                            <label class="col-sm-3 control-label">鐧诲綍瀵嗙爜</label>\
                                            <div class="col-sm-8"><input type="password" name="pwd" class="form-control" autocomplete="new-password"></div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-sm-3 control-label"></label>\
                                            <div class="col-sm-8"><span class="error fl font12 color-danger">瀵嗙爜閿欒</span></div>\
                                        </div>\
                                    </div>\
                                    <div>\
                                        <a href="javascript:;" class="ms-btn cancel-btn"></a>\
                                        <button type="button" class="ms-btn ms-btn-primary success-btn"></button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
            </div>';

        $("body").append(html).css("padding-right", 0);
        $("#deleteAppModal").find(".icon-class").addClass(obj.iconClass);
        $("#deleteAppModal").find(".title").text(obj.title);
        $("#deleteAppModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#deleteAppModal").find(".success-btn").text(obj.successBtnText);
        $("#deleteAppModal").find(".cancel-btn").text(obj.cancelBtnText);
        if (obj.backdrop) {
            $("#deleteAppModal").modal({backdrop: 'static', keyboard: false});
        } else {
            $("#deleteAppModal").modal("show");
        }
        $("#deleteAppModal").find(".success-btn").click(obj.successCallback);
        $("#deleteAppModal").find(".cancel-btn").click(obj.cancelCallback);
        var iconClassLength = $("#deleteAppModal").find(".icon-class").attr("class").replace(/\s*/g,"").length;
        // console.log(iconClassLength);
        if (iconClassLength == 17) {
            $("#deleteAppModal").find(".modal-icon").hide();
        } else {
            $("#deleteAppModal").find(".modal-icon").show();
        }

        // 鐐瑰嚮鎸夐挳鏄惁鍏抽棴寮圭獥
        $("#deleteAppModal").find(".success-btn").click(function () {
            if (obj.successBtnModal) {
                $("#deleteAppModal").modal("hide");
            }
        });
        $("#deleteAppModal").find(".cancel-btn").click(function () {
            if (obj.cancelBtnModal) {
                $("#deleteAppModal").modal("hide");
            }
        });
    };

    return {
        determineModal: determineModal, // 甯︾‘瀹氭寜閽� 寮圭獥
        templateModal: templateModal,
        generalModal: generalModal,
        autoHideModal: autoHideModal,
        deleteAppModal: deleteAppModal,

        init: function () { // 璋冪敤鍏ㄩ儴
            this.determineModal();
            this.templateModal();
            this.generalModal();
            this.autoHideModal();
            this.deleteAppModal();
        }
    }
}();

/*
Modal.generalModal({
    backdrop: true, // 鐐瑰嚮闃村奖鏄惁鍏抽棴寮圭獥锛� // true 寮€鍚紱 false 鍏抽棴
    iconClass: "",  // success: icon-modal-success1,  error: icon-modal-error2
    title: '',  // 寮圭獥鏍囬
    p: '', // 寮圭獥鍐呭
    align: 'center', // 寮圭獥鍐呭鎺掑垪椤哄簭 left center right
    cancelBtnText: "鍙栨秷",    // 鍙栨秷鎸夐挳鏂囧瓧
    successBtnText: '纭畾',  // 纭畾鎸夐挳鏂囧瓧
    successBtnModal: false, // 鐐瑰嚮纭畾鎸夐挳鏄惁鍏抽棴寮圭獥 true 鍏抽棴 false 涓嶅叧闂�
    cancelBtnModal: true, // 鐐瑰嚮鍙栨秷鎸夐挳鏄惁鍏抽棴寮圭獥 true 鍏抽棴 false 涓嶅叧闂�
    successCallback: function () {
    },
    cancelCallback: function () {
    }
});
*/
/*
Modal.determineModal({
    iconClass: "icon-modal-success1",  // success: icon-modal-success1,  error: icon-modal-error2
    title: '鎻愮ず',
    p: '璇ラ摼鎺ヤ负娴嬭瘯杩炴帴锛屽彧鑳戒笅杞�<span class="color-danger">5</span>娆°€�<br>寤鸿鎮細<br>1銆佺數鑴戠櫥褰曠鍏尯缃戠珯锛�<br>2銆佺偣鍑诲鑸爮銆愬彂甯冦€戯紝<br>3銆佸皢APP涓婁紶鑷崇綉绔欙紝鍗冲彲鑾峰緱姝ｅ紡涓嬭浇鍦板潃銆�',
    align: 'left',
    btnText: '宸茬煡鏅�'
});
*/
/*
Modal.templateModal({
    imgName: "modal-bg-3.jpg",
    title1: '鎻愮ず',
    title2: '',
    p: '寤鸿鎮細<br>灏藉揩<span class="color-danger">鐢佃剳</span>鐧诲綍绗叓鍖虹綉绔欙紝鍗冲彲浜彈<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>鍏嶈垂璇曠敤灏佽鎵撳寘APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>姣忓ぉ鍏嶈垂璧犻€�<span class="color-danger">1000</span>娆″垎鍙戜笅杞芥鏁�',
    align: 'left', // 灞呭乏 left, 灞呬腑 center, 灞呭彸 right
    btnText: '鐭ラ亾浜�',
    btnClass: "modal-btn2",
    callBack: function(){
        // location.href = "http://www.baidu.com";
    }
});
*/
/*
Modal.autoHideModal({
    iconClass: "icon-modal-success3", // success: icon-modal-success3 error: icon-modal-error3
    text: "鎴戞槸璋�",
    time: 3000,
    callBack: function () {
        alert(123);
    }
});
*/


var Layout = function () {
    function html5Reader(file, img) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (e) {
            img.attr("src", this.result);
        };
    };

    // 涓婁紶鍥剧墖 1浼�1
    function initUploadImg(obj) {
        $(document).on("change", obj.el, function () {
            var file = this.files[0];
            // var name = this.files[0].name; // ie9 鎶ラ敊 鏃犳硶鑾峰彇鏈畾涔夋垨 null 寮曠敤鐨勫睘鎬р€�0鈥�
            var name = $(this).val();
            // console.log(name);
            // 鍒ゆ柇鏂囦欢绫诲瀷
            var type = (name.substr(name.lastIndexOf("."))).toLowerCase();
            // console.log(type);
            var typeModal = '<div class="modal fade" id="typeModal" tabindex="-1" role="dialog">\
                         <div class="modal-dialog modal-sm" role="document">\
                            <div class="modal-content">\
                                <div class="modal-body">\
                                   <div class="text-center">\
                                        <div><span class="icon icon-modal-error2"></span></div>\
                                        <p class="color-333 mt5">鎮ㄤ笂浼犵殑鍥剧墖鏍煎紡涓嶆纭紝璇烽噸鏂颁笂浼狅紒</p>\
                                        <div class="mt15">\
                                           <button type="button" class="ms-btn ms-btn-default w90" data-dismiss="modal">纭畾</button>\
                                        </div>\
                                    </div>\
                               </div>\
                            </div>\
                        </div>\
                    </div>';

            if (type != ".jpg" && type != ".gif" && type != ".jpeg" && type != ".png") {
                $("#typeModal").remove();
                $("body").append(typeModal);
                $("#typeModal").modal("show");
                return false;
            }

            console.log(file.size/(1024*1024));
            if (file.size/(1024*1024) > 1) {
                Modal.generalModal({
                    backdrop: false, // 鐐瑰嚮闃村奖鏄惁鍏抽棴寮圭獥锛� // true 寮€鍚紱 false 鍏抽棴
                    p: '鍥剧墖杩囧ぇ锛岃涓婁紶1M浠ュ唴鐨勫浘鐗�', // 寮圭獥鍐呭
                    align: 'center', // 寮圭獥鍐呭鎺掑垪椤哄簭 left center right
                    successBtnText: '纭畾',  // 纭畾鎸夐挳鏂囧瓧
                    successBtnModal: true, // 鐐瑰嚮纭畾鎸夐挳鏄惁鍏抽棴寮圭獥 true 鍏抽棴 false 涓嶅叧闂�
                });
                $(this).val("");
                return false;
            }

            var eImg = $('<img />');
            $(this).next('img').remove();
            $(this).after(eImg);

            var isIE9 = navigator.userAgent.match(/MSIE 9.0/) != null;

            if (isIE9) {
                $(this).select();
                var reallocalpath = document.selection.createRange().text;

                // 闈濱E6鐗堟湰鐨処E鐢变簬瀹夊叏闂鐩存帴璁剧疆img鐨剆rc鏃犳硶鏄剧ず鏈湴鍥剧墖锛屼絾鏄彲浠ラ€氳繃婊ら暅鏉ュ疄鐜�
                eImg[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";

                // 璁剧疆img鐨剆rc涓篵ase64缂栫爜鐨勯€忔槑鍥剧墖 鍙栨秷鏄剧ず娴忚鍣ㄩ粯璁ゅ浘鐗�
                eImg[0].src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
            } else {
                html5Reader(this.files[0], eImg); // 鍏煎ie10浠ヤ笂锛堝惈ie10锛�
            }

            $(this).parent().addClass('uploaded');
            obj.success();
        });
    };

    function initUploadPic() {
        $(document).on("change", ".thumbnail", function () {
            var file = this.files[0];
            // alert(123);
            // var name = this.files[0].name; // ie9 鎶ラ敊 鏃犳硶鑾峰彇鏈畾涔夋垨 null 寮曠敤鐨勫睘鎬р€�0鈥�
            var name = $(this).val();
            console.log(name);
            // 鍒ゆ柇鏂囦欢绫诲瀷
            var type = (name.substr(name.lastIndexOf("."))).toLowerCase();
            // console.log(type);
            var typeModal = '<div class="modal fade" id="typeModal" tabindex="-1" role="dialog">\
                         <div class="modal-dialog modal-sm" role="document">\
                            <div class="modal-content">\
                                <div class="modal-body">\
                                   <div class="text-center">\
                                        <div><span class="icon icon-modal-error2"></span></div>\
                                        <p class="color-333 mt5">鎮ㄤ笂浼犵殑鍥剧墖鏍煎紡涓嶆纭紝璇烽噸鏂颁笂浼狅紒</p>\
                                        <div class="mt15">\
                                           <button type="button" class="ms-btn ms-btn-default w90" data-dismiss="modal">纭畾</button>\
                                        </div>\
                                    </div>\
                               </div>\
                            </div>\
                        </div>\
                    </div>';

            if (type != ".jpg" && type != ".gif" && type != ".jpeg" && type != ".png") {
                $("#typeModal").remove();
                $("body").append(typeModal);
                $("#typeModal").modal("show");
                return false;
            }

            console.log(file.size/(1024*1024));
            if (file.size/(1024*1024) > 1) {
                Modal.generalModal({
                    backdrop: false, // 鐐瑰嚮闃村奖鏄惁鍏抽棴寮圭獥锛� // true 寮€鍚紱 false 鍏抽棴
                    p: '鍥剧墖杩囧ぇ锛岃涓婁紶1M浠ュ唴鐨勫浘鐗�', // 寮圭獥鍐呭
                    align: 'center', // 寮圭獥鍐呭鎺掑垪椤哄簭 left center right
                    successBtnText: '纭畾',  // 纭畾鎸夐挳鏂囧瓧
                    successBtnModal: true, // 鐐瑰嚮纭畾鎸夐挳鏄惁鍏抽棴寮圭獥 true 鍏抽棴 false 涓嶅叧闂�
                });
                $(this).val("");
                return false;
            }

            var eImg = $('<img />');
            $(this).next('img').remove();
            $(this).after(eImg);

            var isIE9 = navigator.userAgent.match(/MSIE 9.0/) != null;

            if (isIE9) {
                $(this).select();
                var reallocalpath = document.selection.createRange().text;

                // 闈濱E6鐗堟湰鐨処E鐢变簬瀹夊叏闂鐩存帴璁剧疆img鐨剆rc鏃犳硶鏄剧ず鏈湴鍥剧墖锛屼絾鏄彲浠ラ€氳繃婊ら暅鏉ュ疄鐜�
                eImg[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";

                // 璁剧疆img鐨剆rc涓篵ase64缂栫爜鐨勯€忔槑鍥剧墖 鍙栨秷鏄剧ず娴忚鍣ㄩ粯璁ゅ浘鐗�
                eImg[0].src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
            } else {
                html5Reader(this.files[0], eImg); // 鍏煎ie10浠ヤ笂锛堝惈ie10锛�
            }

            $(this).parents('.upload-img').addClass('uploaded');
            $(this).parents('.uploaded-img').addClass('uploaded');
            $(this).parents('.upload-icon').addClass('uploaded');
            $(this).parents('.upload-icon-common').addClass('uploaded');
        });
    };

    // 涓婁紶鍥剧墖 1浼犲
    function initUploadPics(obj) {
        // 妫€娴嬪凡涓婁紶鎴浘涓暟
        function checkImgLength (uploadWrap) {
            var imgLength = $(uploadWrap).find(".uploaded-img").length;
            // console.log("img: " + imgLength);
            if (imgLength >= obj.imgLength) {
                $(uploadWrap).find(".upload-img").hide();
            } else {
                $(uploadWrap).find(".upload-img").show();
            }
        };
        checkImgLength(".upload-img-more");

        // 涓婁紶搴旂敤鎴浘
        $('.upload-img .upload').click(function () {
            $(this).val("");
        });
        $('.upload-img .upload').change(function() {
            var name = this.value; // this.files[0].name; ie鎶ラ敊
            // 鍒ゆ柇鏂囦欢绫诲瀷
            var type = (name.substr(name.lastIndexOf("."))).toLowerCase();
            var typeModal = '<div class="modal fade" id="typeModal" tabindex="-1" role="dialog">\
                         <div class="modal-dialog modal-sm" role="document">\
                            <div class="modal-content">\
                                <div class="modal-body">\
                                   <div class="text-center">\
                                        <div><span class="icon icon-modal-error2"></span></div>\
                                        <p class="color-333 mt5">鎮ㄤ笂浼犵殑鍥剧墖鏍煎紡涓嶆纭紝璇烽噸鏂颁笂浼狅紒</p>\
                                        <div class="mt15">\
                                           <button type="button" class="ms-btn ms-btn-default w90" data-dismiss="modal">纭畾</button>\
                                        </div>\
                                    </div>\
                               </div>\
                            </div>\
                        </div>\
                    </div>';
            var $imgHtml = $('<div class="uploaded-img fl"><input type="file" class="thumbnail"><img /><div class="reset">鏇存崲鍥剧墖</div><span class="icon icon-delete2 delete-img"></span></div>');

            if (type != ".jpg" && type !=".gif" && type != ".jpeg" && type != ".png") {
                $("#typeModal").remove();
                $("body").append(typeModal);
                $("#typeModal").modal("show");
                return false;
            }
            $(this).parents(".upload-img").before($imgHtml);

            var $uploadImg = $imgHtml.find("img");
            var isIE9 = navigator.userAgent.match(/MSIE 9.0/) != null;

            if (isIE9) {
                $(this).select();
                var reallocalpath = document.selection.createRange().text;

                // 闈濱E6鐗堟湰鐨処E鐢变簬瀹夊叏闂鐩存帴璁剧疆img鐨剆rc鏃犳硶鏄剧ず鏈湴鍥剧墖锛屼絾鏄彲浠ラ€氳繃婊ら暅鏉ュ疄鐜�
                $uploadImg[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";

                // 璁剧疆img鐨剆rc涓篵ase64缂栫爜鐨勯€忔槑鍥剧墖 鍙栨秷鏄剧ず娴忚鍣ㄩ粯璁ゅ浘鐗�
                $uploadImg[0].src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
            } else {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]); // $("#id").files[0]
                reader.onload = function (e) {
                    $uploadImg.attr("src", this.result);
                };
            }
            checkImgLength(".upload-img-more");
        });

        // 鍒犻櫎搴旂敤鎴浘
        $(".upload-img-more").on("click", ".delete-img", function (e) {
            var $file = $(this).find(".upload");
            $(this).parents(".uploaded-img").remove();
            $file.val("");
            checkImgLength(".upload-img-more");
            e.stopPropagation();
        });
    };

    // 閫氱煡涓績
    function initMsgCenter() {
        // 鍏ㄩ€�
        $(".user-center1 .message-list .list .all").click(function () {
            var $allIcon = $(this).find(".iconfont");
            var $allIcons = $(".message-list dd .list .checkbox-li .iconfont");
            var checked = $allIcon.hasClass("icon-checkbox-checked1");
            if (checked) {
                $allIcon.removeClass("icon-checkbox-checked1");
                $allIcons.removeClass("icon-checkbox-checked1");
            } else {
                $allIcon.addClass("icon-checkbox-checked1");
                $allIcons.addClass("icon-checkbox-checked1");
            }
        });

        // 鍗曢€�
        $(".user-center1 .message-list dd .list .checkbox-li .iconfont").click(function () {
            var checked = $(this).hasClass("icon-checkbox-checked1");
            var ddLength = $(".message-list dl dd").length;
            var checkedLength = $(".message-list dd .checkbox-li .icon-checkbox-checked1").length + 1;
            var $allIcon = $(".message-list .list .all .iconfont");
            console.log("dd:" + ddLength);
            console.log("icon:" + checkedLength);
            if (checked) {
                $(this).removeClass("icon-checkbox-checked1");
                $allIcon.removeClass("icon-checkbox-checked1");
            } else {
                $(this).addClass("icon-checkbox-checked1");
                if (ddLength == checkedLength) {
                    $allIcon.addClass("icon-checkbox-checked1");
                } else {
                    $allIcon.removeClass("icon-checkbox-checked1");
                }
            }
        });

        // 閫変腑宸茶
        $(".user-center1 .message-list dt .all-read").click(function () {
            var $allChecked = $(".user-center1 .message-list .icon-checkbox1");
            var $checked = $(".user-center1 .message-list dd .checkbox-li .icon-checkbox-checked1");
            var ids = [];
            $checked.each(function () {
                id = $(this).data('id');
                ids.push(id);
            });
            if (ids) {
                var str = ids.join(",");
                var json = {id: str};
                $.post('/notice/read', json, function (data) {
                    if (data.code == 200) {
                        $checked.parents("dd").addClass("read").find(".msg-icon").find(".iconfont").attr("class", "iconfont icon-read");
                        $allChecked.removeClass("icon-checkbox-checked1");
                    }
                }, 'JSON')
            }
        });

        // 閫変腑鍒犻櫎
        $(".user-center1 .message-list dt .selected-delete").click(function () {
            var $allChecked = $(".user-center1 .message-list .icon-checkbox1");
            var $checked = $(".user-center1 .message-list dd .checkbox-li .icon-checkbox-checked1");
            var ids = [];
            $checked.each(function () {
                id = $(this).data('id');
                ids.push(id);
            });
            if (ids) {
                var str = ids.join(",");
                var json = {id: str};
                $.post('/notice/delete', json, function (data) {
                    if (data.code == 200) {
                        $checked.parents("dd").remove();
                        $allChecked.removeClass("icon-checkbox-checked1");
                        window.location.reload();
                    }
                }, 'JSON')
            }
        });
    };

    /*
        function initMsgCenter() {
            // 鍏ㄩ€�
            $(".user-center1 .message-list .list .all").click(function () {
                var $allIcon = $(this).find(".iconfont");
                var $allIcons = $(".message-list dd .list .checkbox-li .iconfont");
                var checked = $allIcon.hasClass("icon-checkbox-checked1");
                if (checked) {
                    $allIcon.removeClass("icon-checkbox-checked1");
                    $allIcons.removeClass("icon-checkbox-checked1");
                } else {
                    $allIcon.addClass("icon-checkbox-checked1");
                    $allIcons.addClass("icon-checkbox-checked1");
                }
            });

            // 鍗曢€�
            $(".user-center1 .message-list dd .list .checkbox-li .iconfont").click(function () {
                var checked = $(this).hasClass("icon-checkbox-checked1");
                var ddLength = $(".message-list dl dd").length;
                var checkedLength = $(".message-list dd .checkbox-li .icon-checkbox-checked1").length + 1;
                var $allIcon = $(".message-list .list .all .iconfont");
                console.log("dd:" + ddLength);
                console.log("icon:" + checkedLength);
                if (checked) {
                    $(this).removeClass("icon-checkbox-checked1");
                    $allIcon.removeClass("icon-checkbox-checked1");
                } else {
                    $(this).addClass("icon-checkbox-checked1");
                    if (ddLength == checkedLength) {
                        $allIcon.addClass("icon-checkbox-checked1");
                    } else {
                        $allIcon.removeClass("icon-checkbox-checked1");
                    }
                }
            });

            // 閫変腑宸茶
            $(".user-center1 .message-list dt .all-read").click(function () {
                var $allChecked = $(".user-center1 .message-list .icon-checkbox1");
                var $checked = $(".user-center1 .message-list dd .checkbox-li .icon-checkbox-checked1");
                $checked.parents("dd").addClass("read").find(".msg-icon").find(".iconfont").attr("class", "iconfont icon-read");
                $allChecked.removeClass("icon-checkbox-checked1");
            });

            // 閫変腑鍒犻櫎
            $(".user-center1 .message-list dt .selected-delete").click(function () {
                var $allChecked = $(".user-center1 .message-list .icon-checkbox1");
                var $checked = $(".user-center1 .message-list dd .checkbox-li .icon-checkbox-checked1");
                $checked.parents("dd").remove();
                $allChecked.removeClass("icon-checkbox-checked1");
            });
        }
    */

    // 鏂囨。涓績
    function initDoc() {
        $(".doc-details .details-left dt").click(function () {
            var $allDt = $(".doc-details .details-left dt");
            var $allDd = $(".doc-details .details-left dd");
            $allDt.removeClass("active");
            $allDd.stop().slideUp();
            $(this).addClass("active").next("dd").stop().slideDown();
            $("html, body").animate({"scrollTop": 0}, 600);
        });
    }

    // 宸ュ叿绠�
    function initToolkit() {
        // 宸ュ叿绠� 鎻愬彇ipa鍖� 楠岃瘉杈撳叆閾炬帴鏄惁姝ｇ‘
        $(".toolkit-common .ipa-top .form-control").bind("input propertychange", function () {
            var val = $(this).val();
            var valLenght = val.length;
            if (valLenght > 0 && !verifyUrl(val)) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 楠岃瘉 app name
        $("input[name=app]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            if (valLength > 0) {
                $(this).parents(".form-group").removeClass("form-error");
            } else {
                $(this).parents(".form-group").addClass("form-error");
            }
        });

        // 楠岃瘉 Bundle ID
        $("input[name=bundle]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            if (!verifyBundle(val)) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 楠岃瘉 IPA涓嬭浇鍦板潃
        $("input[name=downloadLink]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            if (!verifyUrl(val)) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 楠岃瘉 ICON閾炬帴鍦板潃
        $("input[name=link]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            if (!verifyUrl(val)) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        $(".toolkit-new .plist-submit").click(function () {
            var appName = $("input[name=app]").val();
            var bundle = $("input[name=bundle]").val();
            var ipaLink = $("input[name=downloadLink]").val();
            var iconLink = $("input[name=link]").val();

            if (appName.length > 0) {
                $("input[name=app]").parents(".form-group").removeClass("form-error");
            } else {
                $("input[name=app]").parents(".form-group").addClass("form-error");
            }

            if (verifyBundle(bundle)) {
                $("input[name=bundle]").parents(".form-group").removeClass("form-error");
            } else {
                $("input[name=bundle]").parents(".form-group").addClass("form-error");
            }

            if (verifyUrl(ipaLink)) {
                $("input[name=downloadLink]").parents(".form-group").removeClass("form-error");
            } else {
                $("input[name=downloadLink]").parents(".form-group").addClass("form-error");
            }

            if (verifyUrl(iconLink)) {
                $("input[name=link]").parents(".form-group").removeClass("form-error");
            } else {
                $("input[name=link]").parents(".form-group").addClass("form-error");
            }

            var errorLength = $(".toolkit-new .form-error").length;
            if (errorLength == 0) {
                $("form").submit();
            }
        });

        // 楠岃瘉 鍒悕
        $("input[name=alias]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            // console.log(verifyLetter(val));
            if (verifyLetter(val) || valLength == 0) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 楠岃瘉 瀵嗙爜
        $("input[name=pwd]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            // console.log(verifyLetterDigital(val));
            // console.log(verifySpecialCharacters(val));
            if (verifySpecialCharacters(val) || verifyLetterDigital(val) || valLength == 0 || valLength < 6) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 楠岃瘉 缁勭粐鍚嶇О
        $("input[name=organization]").bind("input propertychange", function () {
            var val = $(this).val();
            var valLength = val.length;
            console.log(verifyCharacters(val));
            if (verifyCharacters(val) || valLength == 0 ) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        $(".toolkit-new .android-submit").click(function () {
            var $alias = $("input[name=alias]");
            var $pwd = $("input[name=pwd]");
            var $organization = $("input[name=organization]");

            if ($alias.val().length > 0) {
                $alias.parents(".form-group").removeClass("form-error");
            } else {
                $alias.parents(".form-group").addClass("form-error");
            }
            if ($pwd.val().length > 0) {
                $pwd.parents(".form-group").removeClass("form-error");
            } else {
                $pwd.parents(".form-group").addClass("form-error");
            }
            if ($organization.val().length > 0) {
                $organization.parents(".form-group").removeClass("form-error");
            } else {
                $organization.parents(".form-group").addClass("form-error");
            }

            var errorLength = $(".toolkit-new .form-error").length;
            if (errorLength == 0) {
                $("form").submit();
            }
        });

        // 鍒朵綔鍥炬爣
        $(".make-icon .tab-con img").lazyload({
            container: ".toolkit-make-icon .foreground-map .tab1 .icons-ul",
            skip_invisible: false
        });

        var palette = [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)","rgb(183, 183, 183)",
                "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
                "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
                "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
                "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
                "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
                "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
                "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
                "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
                "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
                "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)",
                "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)",
                "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
                "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
        ];

        // 鍒朵綔鍥炬爣 鑳屾櫙棰滆壊
        $("#colorPicker6").spectrum({
            color: "#157df1",//鍒濆鍖栭鑹�
            showInput: true,//鏄剧ず杈撳叆
            showAlpha: true, // 閫忔槑搴�
            containerClassName: "full-spectrum",
            showInitial: true,//鏄剧ず鍒濆棰滆壊,鎻愪緵鐜板湪閫夋嫨鐨勯鑹插拰鍒濆棰滆壊瀵规瘮
            showPalette: true,//鏄剧ず閫夋嫨鍣ㄩ潰鏉�
            showSelectionPalette: true,//璁颁綇閫夋嫨杩囩殑棰滆壊
            maxPaletteSize: 7,//璁颁綇閫夋嫨杩囩殑棰滆壊鐨勬渶澶ф暟閲�
            preferredFormat: "hex",//杈撳叆妗嗛鑹叉牸寮�,(hex鍗佸叚杩涘埗,hex3鍗佸叚杩涘埗鍙互鐨勮瘽鍙樉绀�3浣�,hsl,rgb涓夊師鑹�,name鑻辨枃鍚嶆樉绀�)
            hideAfterPaletteSelect: true,// 鐐瑰嚮宸︿晶閫夋嫨棰滆壊锛岄潰鏉垮叧闂�
            chooseText: "纭畾",
            cancelText: "鍙栨秷",
            move: function (color) {//閫夋嫨鍣ㄥ彸杈归潰鏉跨Щ鍔ㄦ椂瑙﹀彂
            },
            show: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀烘椂瑙﹀彂
            },
            beforeShow: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀轰箣鍓嶈Е鍙�,杩斿洖false鏃朵笉鏄剧ず
            },
            hide: function (color) {//閫夋嫨鍣ㄩ潰鏉块殣钘忔椂瑙﹀彂
                updateIconBgBackground (color);
            },
            //閫夋嫨鍣ㄩ潰鏉块鑹茶缃�
            palette: palette
        });
        function updateIconBgBackground (color) {
            $(".toolkit-make-icon .m-icon").css("background-color", color);
            $(".toolkit-make-icon .small-bg").css("background-color", color);
            return color;
        }

        // 鍒朵綔鍥炬爣 鍥炬爣鍐呮枃瀛�
        $("#colorPicker8").spectrum({
            color: "#fff",//鍒濆鍖栭鑹�
            showInput: true,//鏄剧ず杈撳叆
            showAlpha: true, // 閫忔槑搴�
            containerClassName: "full-spectrum",
            showInitial: true,//鏄剧ず鍒濆棰滆壊,鎻愪緵鐜板湪閫夋嫨鐨勯鑹插拰鍒濆棰滆壊瀵规瘮
            showPalette: true,//鏄剧ず閫夋嫨鍣ㄩ潰鏉�
            showSelectionPalette: true,//璁颁綇閫夋嫨杩囩殑棰滆壊
            maxPaletteSize: 7,//璁颁綇閫夋嫨杩囩殑棰滆壊鐨勬渶澶ф暟閲�
            preferredFormat: "hex",//杈撳叆妗嗛鑹叉牸寮�,(hex鍗佸叚杩涘埗,hex3鍗佸叚杩涘埗鍙互鐨勮瘽鍙樉绀�3浣�,hsl,rgb涓夊師鑹�,name鑻辨枃鍚嶆樉绀�)
            hideAfterPaletteSelect: true,// 鐐瑰嚮宸︿晶閫夋嫨棰滆壊锛岄潰鏉垮叧闂�
            chooseText: "纭畾",
            cancelText: "鍙栨秷",
            move: function (color) {//閫夋嫨鍣ㄥ彸杈归潰鏉跨Щ鍔ㄦ椂瑙﹀彂
            },
            show: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀烘椂瑙﹀彂
            },
            beforeShow: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀轰箣鍓嶈Е鍙�,杩斿洖false鏃朵笉鏄剧ず
            },
            hide: function (color) {//閫夋嫨鍣ㄩ潰鏉块殣钘忔椂瑙﹀彂
                updateIconName1 (color);
            },
            //閫夋嫨鍣ㄩ潰鏉块鑹茶缃�
            palette: palette
        });
        function updateIconName1 (color) {
            $(".toolkit-make-icon .i-name1, .toolkit-make-icon .i-name2").css("color", color);
            return color;
        }

        // 鍒朵綔鍥炬爣 鏂囧瓧棰滆壊
        $("#colorPicker7").spectrum({
            color: "#fff",//鍒濆鍖栭鑹�
            showInput: true,//鏄剧ず杈撳叆
            showAlpha: true, // 閫忔槑搴�
            containerClassName: "full-spectrum",
            showInitial: true,//鏄剧ず鍒濆棰滆壊,鎻愪緵鐜板湪閫夋嫨鐨勯鑹插拰鍒濆棰滆壊瀵规瘮
            showPalette: true,//鏄剧ず閫夋嫨鍣ㄩ潰鏉�
            showSelectionPalette: true,//璁颁綇閫夋嫨杩囩殑棰滆壊
            maxPaletteSize: 7,//璁颁綇閫夋嫨杩囩殑棰滆壊鐨勬渶澶ф暟閲�
            preferredFormat: "hex",//杈撳叆妗嗛鑹叉牸寮�,(hex鍗佸叚杩涘埗,hex3鍗佸叚杩涘埗鍙互鐨勮瘽鍙樉绀�3浣�,hsl,rgb涓夊師鑹�,name鑻辨枃鍚嶆樉绀�)
            hideAfterPaletteSelect: true,// 鐐瑰嚮宸︿晶閫夋嫨棰滆壊锛岄潰鏉垮叧闂�
            chooseText: "纭畾",
            cancelText: "鍙栨秷",
            move: function (color) {//閫夋嫨鍣ㄥ彸杈归潰鏉跨Щ鍔ㄦ椂瑙﹀彂
            },
            show: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀烘椂瑙﹀彂
            },
            beforeShow: function () {//閫夋嫨鍣ㄩ潰鏉挎樉绀轰箣鍓嶈Е鍙�,杩斿洖false鏃朵笉鏄剧ず
            },
            hide: function (color) {//閫夋嫨鍣ㄩ潰鏉块殣钘忔椂瑙﹀彂
                updateIconName (color);
            },
            //閫夋嫨鍣ㄩ潰鏉块鑹茶缃�
            palette: palette
        });
        function updateIconName (color) {
            $(".toolkit-make-icon .m-icon .m-name").css("color", color);
            return color;
        }

        // 鍒朵綔鍥炬爣 鍒囨崲
        tab.radioTick({
            el: ".toolkit-make-icon .small-bg-list li"
        });

        $(".toolkit-make-icon .small-bg-list li").click(function () {
            var i = $(this).index();
            var url = $(".toolkit-make-icon .m-icon").css("background-image");
            url = url.substr(0, url.indexOf("png") -2);
            $(".toolkit-make-icon .m-icon").css("background-image", url + i + ".png");
            // console.log(url);
        });

        // 鍒朵綔鍥炬爣 閫夐」鍗�
        tab.basis({
            el: ".toolkit-make-icon .foreground-map .tab li",
            elTab: ".toolkit-make-icon .foreground-map .tab-con>div"
        });

        // 鍒朵綔鍥炬爣 閫夋嫨鍥炬爣 鍥炬爣棰勮鍒囨崲
        $(".toolkit-make-icon .foreground-map .tab1 .icons-ul li").click(function () {
            // 娓呯┖鏂囧瓧杈撳叆妗�
            $(".toolkit-make-icon .foreground-map .tab2 .edit-text input[name=editText]").val("");
            // 娓呯┖app name
            $(".toolkit-make-icon .m-icon .m-name").text("");
            calcText();

            var i = $(this).index();
            imgSrc.edit({
                el: ".toolkit-make-icon .m-icon img",
                index: i,
                format: "png?2018"
            });
            $(this).attr({"data-icon": i, "class": "active"}).siblings().attr({"data-icon": "", "class": ""});
            // console.log(src);
            // console.log($img.attr("src"));
        });

        // 鍓嶆櫙鍥句綅缃� 涓婁腑涓�
        tab.radioRound({
            el: ".prospects li",
            checkedClass: "icon-radio-checked"
        });
        $(".prospects li").click(function () {
            var dataP = $(this).attr("data-p");
            if (dataP == 0) {
                $(".toolkit-make-icon .written-content, .toolkit-make-icon .text-color").hide();
            } else {
                $(".toolkit-make-icon .written-content, .toolkit-make-icon .text-color").show();
            }
            if (dataP == 1) {
                $(".toolkit-make-icon .make-icon .i-name1").show();
            } else {
                $(".toolkit-make-icon .make-icon .i-name1").hide();
            }
            if (dataP == 2) {
                $(".toolkit-make-icon .make-icon .i-name2").show();
            } else {
                $(".toolkit-make-icon .make-icon .i-name2").hide();
            }
        });

        // 灞呬笂 灞呬笅 瀹炴椂鏂囧瓧
        realTime.inputText({
            el: ".toolkit-make-icon .written-content input[type=text]",
            elEdit: ".toolkit-make-icon .make-icon .i-name1, .toolkit-make-icon .make-icon .i-name2"
        });

        // 灞呬笂 灞呬笅 瀹炴椂鏂囧瓧 楠岃瘉瀛楁暟
        $(".toolkit-make-icon .written-content input[type=text]").bind("input propertychange", function () {
            var valLength = getByteLen($(this).val());
            if (valLength > 10) {
                $(this).parents(".form-group").addClass("form-error");
            } else {
                $(this).parents(".form-group").removeClass("form-error");
            }
        });

        // 褰㈢姸閫夋嫨 鏍煎紡閫夋嫨
        $(".toolkit-make-icon .m-icon-radio li").click(function () {
            $(this).addClass("active").siblings().removeClass("active");
        });

        // 褰㈢姸閫夋嫨 鍒囨崲鍦嗚銆佹柟瑙�
        $(".toolkit-make-icon .shape-choose li").click(function () {
            var i = $(this).index();
            if (i == 1) {
                $(".toolkit-make-icon .make-icon .m-icon").addClass("radius");
            } else {
                $(".toolkit-make-icon .make-icon .m-icon").removeClass("radius");
            }
        });

        // 鍥剧墖灏哄 閫夋嫨
        // 鍏ㄩ€�
        $(".toolkit-make-icon .img-size dt").click(function () {
            var checked = $(this).find(".icon-checkbox1").hasClass("icon-checkbox-checked1");
            var $dtIcon = $(this).find(".icon-checkbox1");
            var $ddIcon = $(this).parents(".img-size").find("dd").find(".icon-checkbox1");
            if (checked) {
                $dtIcon.removeClass("icon-checkbox-checked1");
                $ddIcon.removeClass("icon-checkbox-checked1");
            } else {
                $dtIcon.addClass("icon-checkbox-checked1");
                $ddIcon.addClass("icon-checkbox-checked1");
            }
        });
        // 澶嶉€�
        $(".toolkit-make-icon .img-size dd").click(function () {
            var checked = $(this).find(".icon-checkbox1").hasClass("icon-checkbox-checked1");
            var $ddIcon = $(this).find(".icon-checkbox1");
            var $dtIcon = $(this).parents(".img-size").find("dt").find(".icon-checkbox1");
            var ddLength = $(".toolkit-make-icon .img-size dd").length;
            if (checked) {
                $dtIcon.removeClass("icon-checkbox-checked1");
                $ddIcon.removeClass("icon-checkbox-checked1");
            } else {
                // $dtIcon.addClass("icon-checkbox-checked1");
                $ddIcon.addClass("icon-checkbox-checked1");
            }
            var ddCheckedLength = $(".toolkit-make-icon .img-size dd .icon-checkbox-checked1").length;

            console.log(ddCheckedLength);
            console.log("dd"+ddLength);

            if (ddLength == ddCheckedLength) {
                $dtIcon.addClass("icon-checkbox-checked1");
            }

        });

        function getByteLen(val) {
            var len = 0;
            for (var i = 0; i < val.length; i++) {
                var a = val.charAt(i);
                if (a.match(/[^\x00-\xff]/ig) != null) {
                    len += 2;
                } else {
                    len += 1;
                }
            }
            return len;
        }

        // 鍒朵綔鍥炬爣 浣跨敤鏂囧瓧鍒朵綔鍥炬爣 涓暟璁＄畻
        function calcText () {
            var $input = $(".toolkit-make-icon input[name=editText]");
            var inputVal = $input.val();
            var inputValLength = getByteLen(inputVal);
            var that = $(".toolkit-make-icon .m-icon .m-name");
            var $img = $(".toolkit-make-icon .m-icon img");
            var $li = $(".toolkit-make-icon .foreground-map .tab1 ul li");
            // console.log(inputValLength);
            if (inputValLength > 0 && inputValLength <= 24) {
                that.text(inputVal);
                $input.parents(".form-group").removeClass("form-error");
                $img.hide();
                $li.attr({"class": "", "data-icon": ""});
                switch (inputVal.length) {
                    case 1:
                        that.css("font-size", "120px");
                        break;
                    case 2:
                        that.css("font-size", "60px");
                        break;
                    case 3:
                        that.css("font-size", "40px");
                        break;
                    case 4:
                        that.css("font-size", "30px");
                        break;
                    default:
                        that.css("font-size", "24px");
                }
            } else if (inputVal.length == 0) {
                that.text("");
                $input.parents(".form-group").removeClass("form-error");
                $img.show();
                $li.eq(0).attr({"class": "active", "data-icon": 0});
                imgSrc.edit({
                    el: ".toolkit-make-icon .m-icon img",
                    index: 0,
                    format: "png?2018"
                });
            } else {
                that.text("");
                $input.parents(".form-group").addClass("form-error");
                $img.hide();
                $li.attr({"class": "", "data-icon": ""});
            }
        }

        // 鍒朵綔鍥炬爣 瀹炴椂鏂囧瓧
        $(".toolkit-make-icon .foreground-map .tab2 .edit-text input[name=editText]").on("input propertychange", function () {
            calcText();
        });
    }

    // 涓汉涓績
    function initUserCenter() {
        // 涓婁紶璧勮川
        $(".upload-qualification .review-btn").click(function () {
            var $add = $(this).parents(".upload-qualification").find(".upload-img-more");
            var imgLength = $(".upload-qualification .uploaded-img").length;
            if (imgLength > 0) {
                if ($add.hasClass("hide-action")) {
                    $add.removeClass("hide-action");
                } else {
                    $add.addClass("hide-action");
                }
            } else {
                $add.removeClass("hide-action");
            }
        });
    }

    // 灏佽鎻掍欢
    function initEncapsulation() {
        // 鍩烘湰淇℃伅 璁惧绫诲瀷 鑻规灉鍑烘彁绀�
        $("#device li").click(function () {
            var device = $(this).data("device");
            if (device == 1) {
                $(this).parents("#device").addClass("form-error");
            } else {
                $(this).parents("#device").removeClass("form-error");
            }
        });
    }

    // 鍙戝竷搴旂敤
    function initReleaseApp() {
        var $expired = $(".release-app2 .aside-right .app-table .app-expired");
        var expiredVisible = $expired.is(":visible");
        if (expiredVisible) {
            $expired.parents("tr").find("td").addClass("disabled");
        } else {
            $expired.parents("tr").find("td").removeClass("disabled");
        }

    }

    // 娣诲姞澶囨敞鍔熻兘
    function initAddNote(obj) {
        $(".add-notes").click(function () {
            var val =  $(this).siblings("input[name=remark]").val();
            $(this).hide().siblings("input[name=remark]").show().val("").focus().val(val);
        });
        $("input[name=remark]").blur(obj.callBack);

        $("input[name=remark]").keydown(function(e){
            var pwdVal = $("input[name=pwd]").val();
            var e = e || window.event;
            if(e.keyCode == 13 || e.which == 13){
                $(this).trigger("blur");
            }
        });
    }

    return {
        initUploadPic: initUploadPic, // 涓婁紶鍥剧墖 1浼�1
        initUploadImg: initUploadImg, // 涓婁紶鍥剧墖 1浼�1
        initUploadPics: initUploadPics, // 涓婁紶鍥剧墖 1浼犲
        initMsgCenter: initMsgCenter, // 閫氱煡涓績
        initDoc: initDoc, //鏂囨。涓績
        initToolkit: initToolkit, // 宸ュ叿绠�
        initUserCenter: initUserCenter, // 涓汉涓績
        initEncapsulation: initEncapsulation, //灏佽
        initReleaseApp: initReleaseApp, // 鍙戝竷搴旂敤
        initAddNote: initAddNote, // 娣诲姞澶囨敞鍔熻兘

        init: function () {
            this.initUploadImg();
            this.initUploadPic();
            this.initMsgCenter();
            this.initUploadPics();
            this.initDoc();
            this.initToolkit();
            this.initUserCenter();
            this.initEncapsulation();
            this.initReleaseApp();
        }
    }
}();

var Upload = function () {
    function img(option) {
        var options = $.extend({max_size:1024*1024 ,prefix:'image'}, option);
        $(options.el).change(function () {
            var This = $(this);
            var $uploading = '<div class="ongoing">姝ｅ湪涓婁紶涓�...</div>'
            var file = this.files[0];
            // 鍒ゆ柇涓婁紶鏂囦欢绫诲瀷
            // var name = this.files[0].name; // ie9 鎶ラ敊 鏃犳硶鑾峰彇鏈畾涔夋垨 null 寮曠敤鐨勫睘鎬р€�0鈥�
            var name = $(this).val();
            // console.log(name);
            var type = (name.substr(name.lastIndexOf(".") + 1)).toLowerCase();
            // console.log(type);
            var typeModal = '<div class="modal fade" id="typeModal" tabindex="-1" role="dialog">\
                         <div class="modal-dialog modal-sm" role="document">\
                            <div class="modal-content">\
                                <div class="modal-body">\
                                   <div class="text-center">\
                                        <div><span class="icon icon-modal-error2"></span></div>\
                                        <p class="color-333 mt5">鎮ㄤ笂浼犵殑鍥剧墖鏍煎紡涓嶆纭紝璇烽噸鏂颁笂浼狅紒</p>\
                                        <div class="mt15">\
                                           <button type="button" class="ms-btn ms-btn-default w90" data-dismiss="modal">纭畾</button>\
                                        </div>\
                                    </div>\
                               </div>\
                            </div>\
                        </div>\
                    </div>';

            if (type != "jpg" && type != "gif" && type != "jpeg" && type != "png") {
                $("#typeModal").remove();
                $("body").append(typeModal);
                $("#typeModal").modal("show");
                return false;
            }
            // console.log(file.size/(1024*1024));

            if (file.size > options.max_size) {
                Modal.generalModal({
                    backdrop: false, // 鐐瑰嚮闃村奖鏄惁鍏抽棴寮圭獥锛� // true 寮€鍚紱 false 鍏抽棴
                    p: '鍥剧墖杩囧ぇ锛岃涓婁紶1M浠ュ唴鐨勫浘鐗�', // 寮圭獥鍐呭
                    align: 'center', // 寮圭獥鍐呭鎺掑垪椤哄簭 left center right
                    successBtnText: '纭畾',  // 纭畾鎸夐挳鏂囧瓧
                    successBtnModal: true, // 鐐瑰嚮纭畾鎸夐挳鏄惁鍏抽棴寮圭獥 true 鍏抽棴 false 涓嶅叧闂�
                });
                $(this).val("");
                return false;
            }

            var $img = $('<img>');
            $(this).next("img").remove();
            $(this).after($img);
            var file = this.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                var content = this.result;
                $img.attr("src", content);
                This.parent().addClass("uploading").append($uploading);

                $.ajax({
                    type: 'POST',
                    url: '/source/index/ajax_profile.php?ac=imageBase64',
                    data: {
                        content: content,
                        prefix: options.prefix
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.code != 200) {
                            alert(res.msg);
                            return false;
                        }
                        $img.attr("src", '//' + res.data.domain + '/' + res.data.key);
                        // console.log('a ' + This.val());
                        This.val("").attr("data-key", res.data.key);
                        // console.log('b ' + This.val());
                        This.parent().addClass("uploaded").removeClass("uploading");
                        This.parent().find(".ongoing").remove();
                        // console.log(res);
                    }
                })
            };
        });
    };

    function isProcess() {
        return $("body .ongoing").length;
    }

    return {
        img: img,
        isProcess: isProcess
    }
}();



$(function () {
    var windowWidth = $(window).width();
    function setRem() {
        var windowWidth = $(window).width();
        if (windowWidth <= 750) {
            var fs = windowWidth / 750 * 6.25 * 100;
            $('html').css('font-size', fs + '%');   // 1rem = 100px;
        }
    };
    setRem();
    $(window).resize(setRem);

    $("[data-toggle='tooltip']").tooltip();

    $("[data-toggle='popover']").popover();

    // 杩斿洖椤堕儴
    $(window).scroll(function () {
        var windowHeight = $(window).height();
        var scrollTop = $(document).scrollTop();
        if (scrollTop > windowHeight) {
            $(".fixed-right .go-top").css("display", "flex");
        } else {
            $(".fixed-right .go-top").hide();
        }
    });

    $(".fixed-right .go-top").click(function () {
        $("html, body").stop().animate({'scrollTop': 0}, 500);
    });

    // 鎵嬫満瀵艰埅
    $(".header .phone-menu").click(function () {
        $(".header .phone-shadow").stop().animate({"left": 0}, 500);
        $(".header .phone-nav-wrap").stop().animate({"left": 0}, 500);
    });

    $(".header .ms-nav .phone-user-center").click(function () {
        var $visibleDl = $(this).find("dl");
        if ($visibleDl.is(":visible")) {
            $visibleDl.stop().slideUp();
            $(this).find(".icon-arrow-down").css({"transform": "rotate(0)"});
        } else {
            $visibleDl.stop().slideDown();
            $(this).find(".icon-arrow-down").css({"transform": "rotate(-180deg)"});
        }
    });

    $(".header .phone-shadow").click(function () {
        $(this).stop().animate({"left": "-200%"}, 500);
        $(".header .phone-nav-wrap").stop().animate({"left": "-200%"}, 500);
    });

    try {
        // 鏃ユ湡鎻掍欢
        $('#datetimepicker1,#datetimepicker2,#datetimepicker3,#datetimepicker4').datetimepicker({
            lang: 'ch',
            timepicker: false,
            format: 'Y/m/d',
        });
    } catch (e) {
        
    }

    var isSafari = /Safari/.test(navigator.userAgent) && !/Chrome/.test(navigator.userAgent);
    if (isSafari) {
        $(".copy").css("top", 0);
    }

    // 浠锋牸鏀粯閫変腑
    $(".price-pay .common ul").on("click", "li:not('.disabled')", function () {
        $(this).addClass("active").siblings().removeClass("active");
        var i = $(this).index();
        if (i == 3) {
            $(this).parents(".common").find(".contrary-transfer").show();
        } else {
            $(this).parents(".common").find(".contrary-transfer").hide();
        }
    });

    // 鎴戠殑搴旂敤 鎮仠鏄剧ず浜岀淮鐮�
    $(".release-app .icon-small-code").hover(function () {
        $(this).find(".qr-code").show();
    }, function () {
        $(this).find(".qr-code").hide();
    });

    // 鎴戠殑搴旂敤 閫夋嫨搴旂敤鍚堝苟
    $('#myModal .app-list').on('click', 'li', function () {
        $(this).addClass('active').siblings().removeClass('active');
    });

    // 鎴戠殑搴旂敤 缂栬緫璁剧疆 閫夐」鍗�
    $(".release-app .app-editor .tab li").click(function () {
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".release-app .app-editor .tab-con>div").eq(index).show().siblings().hide();
    });

    /*
    *鏀圭増瀹屾垚鍚庯紝灏嗕笂鏂圭殑鍒犻櫎
    *鎴戠殑搴旂敤 缂栬緫璁剧疆 閫夐」鍗�
    **/
    $(".release-app2 .app-set .tab li").click(function () {
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".release-app2 .app-set .tab-con>div").eq(index).show().siblings().hide();
    });

    // 鎴戠殑搴旂敤 缂栬緫璁剧疆 鍩烘湰璁剧疆 鍗曢€�
    $(".release-app .app-editor .trust li").click(function () {
        $(".release-app .app-editor .trust li").removeClass("active").find(".icon-radio").removeClass("icon-radio-checked");
        $(this).addClass("active").find(".icon-radio").addClass("icon-radio-checked");
    });

    /*
    *鏀圭増瀹屾垚鍚庯紝灏嗕笂鏂圭殑鍒犻櫎
    *鎴戠殑搴旂敤 缂栬緫璁剧疆 鍩烘湰璁剧疆 鍗曢€�
    * */
    $(".release-app2 .app-set .trust li").click(function () {
        $(".release-app2 .app-set .trust li").removeClass("active").find(".icon-radio").removeClass("icon-radio-checked");
        $(this).addClass("active").find(".icon-radio").addClass("icon-radio-checked");
    });

    // 涓嬭浇瀹夎鏂瑰紡
    $(".release-app2 .app-set .senior .download-way li").click(function () {
        var i = $(this).index();
        if (i == 1) {
            $(this).parents(".form-group").next(".form-group").show();
        } else {
            $(this).parents(".form-group").next(".form-group").hide();
        }

        $(".release-app2 .app-set .download-way li").removeClass("active").find(".icon-radio").removeClass("icon-radio-checked");
        $(this).addClass("active").find(".icon-radio").addClass("icon-radio-checked");
    });

    // 鎺ㄥ箍椤� 灏佽 閫夐」鍗�
    $(".feature-plugin .f-list li").hover(function () {
        var i = $(this).index();
        $(".feature-plugin .f-list li").find(".icon-arrow-top2").hide();
        $(this).find(".icon-arrow-top2").show();
        $(".feature-tab").find("img").eq(i).css("display", "block").siblings().hide();
    }, function () {
    });

    // 鎺ㄥ箍椤� 灏佽 閫夐」鍗�
    $('.good-case .g-con .tab-list li').hover(function () {
        var i = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".good-case .tab-con ul").eq(i).show().siblings().hide();
    }, function () {
    });

    // 涓汉涓績 2鐗� 閫夐」鍗�
    $(".user-center1 .account-management>ul li").click(function () {
        var i = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".user-center1 .account-management .tab>div").eq(i).show().siblings().hide();
    });

    // 涓汉涓績 2鐗� 娑堟伅鎺ユ敹
    $(".user-center1 .msg ol li").click(function () {
        $(this).parents("ol").find("li").removeClass("active").find(".icon").removeClass("icon-radio-checked");
        $(this).addClass("active").find(".icon").addClass("icon-radio-checked");
    });

    // 涓汉涓績 2鐗� 鍙戠エ鍦板潃 澶嶉€夋閫夋嫨
    $(".user-center1 .invoice-management .table .icon-checkbox1").click(function () {
        var that = $(".user-center1 .invoice-management .table .icon-checkbox1");
        that.removeClass("icon-checkbox-checked1");
        $(this).addClass("icon-checkbox-checked1");
    });

    /*
    * 涓汉涓績 2鐗� 鍙戠エ鍦板潃 璁句负榛樿
    * 绗竴涓负榛樿鍦板潃
    * */
    $(".user-center1 .invoice-management table tr").eq(1).find(".set-default").text("榛樿鍦板潃");
    $(".user-center1 .invoice-management table .set-default").click(function () {
        $(".user-center1 .invoice-management table .set-default").text("璁句负榛樿");
        var that = $(this).parents("table").find("tr").first();
        $(this).text("榛樿鍦板潃").parents("tr").insertAfter(that);
        $(".user-center1 .invoice-management .set-default")
    });

    // 澶嶅埗寮圭獥
    function autoCopyHideModal(obj1, time) {
        $('#copyModal').remove();
        var html = '<div class="modal fade ms-modal auto-hide-modal" id="copyModal" tabindex="-1" role="dialog">\
                        <div class="modal-dialog modal-sm" role="document">\
                            <div class="modal-content">\
                                <div class="modal-body">\
                                    <div class="text-center">\
                                        <div class="auto-hide">\
                                            <div>澶嶅埗鎴愬姛</div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>';

        $("body").append(html);
        var autoHide = null;
        clearTimeout(autoHide);
        $(obj1).modal('show');
        $(".modal-backdrop").hide();
        autoHide = setTimeout(function () {
            $(obj1).modal("hide");
        }, time);
    };

    // 澶嶅埗鍔熻兘
    var clipboard = new ClipboardJS('.copy');
    clipboard.on('success', function (e) {
        autoCopyHideModal("#copyModal", 2000);
        e.clearSelection();
    });
    clipboard.on('error', function (e) {
        console.log("澶嶅埗澶辫触!");
    });

    // 鏄剧ず闅愯棌瀵嗙爜
    $(".account-management .pwd .pwd-toggle").click(function () {
        var inputPwd = $(this).siblings("input[name=pwd]");
        var pwdAttr = inputPwd.attr("type");
        if (pwdAttr == "password") {
            inputPwd.attr("type", "text");
            $(this).addClass("icon-eye").removeClass("icon-eye-no");
        } else {
            inputPwd.attr("type", "password");
            $(this).addClass("icon-eye-no").removeClass("icon-eye");
        }
    });

    // 浠锋牸椤� tab閫夐」鍗�
    $(".price-tab ul li").click(function () {
        var i = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".price-con>div").eq(i).show().siblings().hide();
    });
	
    $(".new-price-tab ul li").click(function () {
        var i = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".new-price-con>div").eq(i).show().siblings().hide();
    });
    // 澶у寘鍏ュ彛 渚ф爮楂樺害
    // 澶у寘銆佸皬鍖呭叆鍙� 宸︿晶鏍� 楂樺害銆乵argin-bottom: 15px
    $(".big-bag-upload").prev(".aside-left").css("margin-bottom", "15px").innerHeight("380px");
    $(".small-bag-upload").prev(".aside-left").css("margin-bottom", "15px").innerHeight("380px");

    // 鍒楄〃 APP iOS 瀹夊崜鐗堟湰涓嬫媺鍒囨崲
    $(document).click(function () {
        $(".app-system-select").find("ul").hide();
    });

    $(".app-system-select").click(function (e) {
        var $ul = $(this).find("ul");
        var ulVisible = $ul.is(":visible");
        if (ulVisible) {
            $ul.hide();
        } else {
            $ul.show();
        }
        e.stopPropagation();
    });

    $(".app-system-select ul li").click(function () {
        var thisText = $(this).text();
        $(this).addClass("active").siblings().removeClass("active");
        $(this).parents(".app-system-select").find(".text").text(thisText);
    });

    $(".table-list-wrap .app-table .tr-disabled td").addClass("td-disabled").append('<div class="mask"></div>');

    // 灏佽銆佺鍚嶃€佸垎鍙戣鎯呴〉 鏈疄鍚嶈璇� 鎮仠popover
    $(".app-details .details-bottom .icon-prompt").hover(function () {
        $(".popover1").show();
    }, function () {
        $(".popover1").hide();
    });
    $(".app-details .details-bottom .icon-prompt1").hover(function () {
        $(this).find(".popover1").show();
    }, function () {
        $(this).find(".popover1").hide();
    });

    // 鍒朵綔鍥炬爣ie鎻愮ず
    //娴嬭瘯mime
    function _mime(option, value) {
        var mimeTypes = navigator.mimeTypes;
        for (var mt in mimeTypes) {
            if (mimeTypes[mt][option] == value) {
                return true;
            }
        }
        return false;
    }

    var UA = navigator.userAgent;
    // IE
    // UA.indexOf("MSIE") != -1; // ie10浠ヤ笂宸蹭笉鍐嶆敮鎸�
    var isIE = window.ActiveXObject || "ActiveXObject" in window;
    // Firefox
    var isFirefox = UA.indexOf('Firefox') != -1;
    // Chrome
    var isChrome = UA.indexOf("Chrome") != -1;

    //application/vnd.chromium.remoting-viewer 鍙兘涓�360鐗规湁
    var is360 = _mime("type", "application/vnd.chromium.remoting-viewer");

    // 360鏋侀€熸ā寮�
    if (isChrome && is360) {
        // $(".ie-prompt-360").show();
    }
    // 鍒朵綔鍥炬爣ie鎻愮ず
    if (isIE) {
        $(".ie-prompt").show();
    }

    // 閰嶇疆鎻掍欢 寮曞椤靛垹闄や笂浼犲浘鐗�
    // 鍒犻櫎搴旂敤鎴浘
    $(".plugin-guide .upload-img .icon-delete2").on("click", function (e) {
        $(this).siblings("input").val("");
        $(this).siblings("img").remove();
        $(this).parents(".upload-img").removeClass("uploaded");
        $('.upload-screenshots .thumbnail-s').val("");
        e.stopPropagation();
        e.preventDefault();
    });

    /********************************************************************/

    // 鍘婚櫎鏂囨湰閲屾墍鏈塨r鎹㈣
    function removeBr(obj) {
        $(obj).each(function () {
            var thisTexts = $(this).html();
            if (thisTexts != null) {
                thisTexts = thisTexts.replaceAll('<br>', '');
                $(this).html(thisTexts);
            }
        })
    };

    // 鍏煎骞虫澘
    if (windowWidth <= 768) {
        removeBr(".index-banner .banner-con h2");
        removeBr(".publicity li");
        removeBr(".toolkit li p");
        removeBr(".index-common .con p");
        removeBr(".promote-thumbnail p");
        removeBr(".ms-thumbnail .ms-caption p");
        removeBr(".ms-thumbnail .ms-caption .tit");
    }

    // 鍏煎鎵嬫満
    function phoneFun() {
        var windowWidth = $(window).width();
        if (windowWidth <= 750) {
            $(".service_content li").attr("style", "");

            $(".login-in .login-user").click(function (e) {
                var visible = $(this).find("dl").is(":visible");
                if (visible) {
                    $(this).find("dl").hide();
                } else {
                    $(this).find("dl").show();
                }
                e.stopPropagation();
            });

            $("div").not(".login-in .login-user").click(function () {
                $(".login-in .login-user dl").hide();
            });
        }
    };
    phoneFun();
});
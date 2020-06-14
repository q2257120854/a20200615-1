(function ($) {
    $.fn.jQSelect = function (settings) {
        // alert(settings.id);
        var id = settings.id.toString();
        var $div = this;
        var $cartes = $div.find(".cartes");
        var $lists = $div.find(".lists");

        var listTxt = $cartes.find(".listTxt");
        var listVal = $cartes.find(".listVal");

        var items = $lists.find("ul > li");
        var oLi = null;
        $div.hover(function () {
            //加背景颜色
            var sval = $.trim($div.find("input[type='text']").val());
            oLi = $div.find("li");
            oLi.each(function () {
                if ($.trim($(this).text()) == sval) {
                    $(this).addClass("cgray");
                }
            });
            $(this).addClass("hover");
        }, function () {
            $(this).removeClass("hover");
        });

        //绑定点击事件
        items.click(function () {
            //listVal.val($(this).attr("id"));
            $("#" + id + "").val($(this).attr("id"));
            listTxt.val($(this).text());
            if (oLi != undefined)
                oLi.removeClass("cgray false");
            if ($div != undefined)
                $div.removeClass("hover");
        }).mouseover(function () {
            var cgray = $(this).attr("class");
            //有class属性
            if (cgray) {
                //不包含
                if (cgray.indexOf("cgray") == -1) {
                    $(this).removeClass("cwhite");
                    $(this).addClass("cgray false");
                }
            } else {
                //无class属性
                $(this).removeClass("cwhite");
                $(this).addClass("cgray false");
            }
        }).mouseout(function () {
            var cgray = $(this).attr("class");
            if (cgray.indexOf("false") != -1) {
                $(this).removeClass("cgray false");
                $(this).addClass("cwhite");
            }
        });
    };
})(jQuery);

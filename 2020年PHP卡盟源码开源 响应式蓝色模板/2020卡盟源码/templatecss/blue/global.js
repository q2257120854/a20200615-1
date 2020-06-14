$(function(){
//开始标签，需点击才有变化的
var $tab_dd = $("div.tab_c_nav dl dd")
$tab_dd.click(function(){
if($('div.tool_box').is(":hidden")){
$('div.tool_box').show();
}
$(this).addClass("tab_light").siblings().removeClass("tab_light");
var index = $tab_dd.index(this);
$("div.tab_c_box > div").eq(index).show().siblings("div").hide();
}).hover(function(){
$(this).addClass("tab_hover");
},function(){
$(this).removeClass("tab_hover");
});
//标签导航的最后一个dd不要线
$('div.tab_c_nav dl').each(function() {
$(this).children('dd:last').addClass('last');  
});	
//文本框
$("input.input_search_text").focus(function(){         // 地址框获得鼠标焦点
if($(this).val()==this.defaultValue){
$(this).val("");
}
});
$("input.input_search_text").blur(function(){		  // 地址框失去鼠标焦点
if($(this).val()==""){
$(this).val(this.defaultValue);
}
});
});



$(document).ready(function () {
    //聚焦型输入框验证 
    $(".login_text1").live("focus", function () {
        $(this).siblings("span").hide();
        $(this).parent().siblings("span").hide();
    });
    $(".login_text1").live("blur", function () {
        var val = $(this).val();
        if (val != "") {
            $(this).siblings("span").hide();
        } else {
            $(this).siblings("span").show();
            $(this).parent().siblings("span").show()
        }
    });
    $(".login_text1").each(function () {
        var thisVal = $(this).val();
        //判断文本框的值是否为空，有值的情况就隐藏提示语，没有值就显示
        if (thisVal != "") {
            $(this).siblings("span").hide();
        } else {
            $(this).siblings("span").show();
        }

        //        $(this).focus(function () {
        //            $(this).siblings("span").hide();
        //            $(this).parent().siblings("span").hide()

        //        }).blur(function () {
        //            var val = $(this).val();
        //            if (val != "") {
        //                $(this).siblings("span").hide();
        //            } else {
        //                $(this).siblings("span").show();
        //                $(this).parent().siblings("span").show()
        //            }
        //        });
    });

});
  
  
  
$(document).ready(function(){
$("#hidenav").mouseover(function(){
  $("#others").show();
});
$("#hidenav").mouseout(function(){
  $("#others").hide();
});


});

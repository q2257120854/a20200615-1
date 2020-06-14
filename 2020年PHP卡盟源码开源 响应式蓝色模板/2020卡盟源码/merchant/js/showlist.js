// JavaScript Document
function navList(id) {
    var $obj = $("#fold-menu");
    $obj.find("h4").click(function () {
        $obj.find("h4").attr("style", "");
        $(this).attr("style", "border-left:2px solid #4384D7");
        var $div = $(this).siblings(".list-item");
        if ($(this).parent().hasClass("selected")) {
            $div.slideUp(300);
            $(this).parent().removeClass("selected");

        }
        if ($div.is(":hidden")) {
            $("#fold-menu li").find(".list-item").slideUp(300);
            $("#fold-menu li").removeClass("selected");
            $(this).parent().addClass("selected");
            $div.slideDown(300);


        } else {
            $div.slideUp(300);
            $(this).attr("style", "");
        }
    });
}
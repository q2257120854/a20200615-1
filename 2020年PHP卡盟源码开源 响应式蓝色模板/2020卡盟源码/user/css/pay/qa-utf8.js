// 2016-6-16 add for QAList.html
$(function(){
  $(".tipList li").click(function(){
     if($(this).hasClass("active")){
        $(this).removeClass("active");
        $(this).find("i").html("+");
     }else{
        $(".tipList li").removeClass("active");
        $(".tipList li i").html("+");
        $(this).addClass("active");
        $(this).find("i").html("-");
     }     
  });
});
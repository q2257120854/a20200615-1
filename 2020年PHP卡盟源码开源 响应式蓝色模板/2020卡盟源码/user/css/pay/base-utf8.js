/**
* 功能：纯文本弹框
* 调用方法：showComPop('请输入省份！');
* 作者：陈文琦
* 创建日期：2016/02/26 
*/
function showComPop(txt){
	var comPopHTML = '<div class="payPop payCommon"><p class="popTitle">系统提示<a class="close" href="javascript:$.hideDialog(\'.payCommon\');">1?±?</a></p><div class="popContent"><p class="words">{words}</p></div></div>';
	comPopHTML = comPopHTML.replace("{words}", txt);
	$("body").append(comPopHTML);
	$.showDialog('.payCommon');
}

$(function(){
    $('.h_nav li').hover(function(){
        var txt = $.trim($(this).text());
        if(txt == '兑换中心') return;
        $(this).addClass('liarrow');
    },function(){
        if($(this).children().attr("class")!='cur'){
            $(this).removeClass('liarrow');
        }
    });
    $('.h_nav .cur').parent('li').addClass('liarrow');

    // FIX IE9及以下，不支持placeholder
    if( !('placeholder' in document.createElement('input')) ){  
   
    $('input[placeholder],textarea[placeholder]').each(function(){   
      var that = $(this),   
      text= that.attr('placeholder');   
      if(that.val()===""){   
        that.val(text).addClass('placeholder');   
      }   
      that.focus(function(){   
        if(that.val()===text){   
          that.val("").removeClass('placeholder');   
        }   
      })   
      .blur(function(){   
        if(that.val()===""){   
          that.val(text).addClass('placeholder');   
        }   
      })   
      .closest('form').submit(function(){   
        if(that.val() === text){   
          that.val('');   
        }   
      });   
    });   
  }   
});

var dropdown = function(_p,data){
  var o = new Object;
  o.p=$(_p),
  o.pul=o.p.find(".moxlist ul"),
  o.bindEvt = function(obj,flag){
    obj.find(".selArr").unbind("click").click(function(e){          
      obj.toggleClass("unfold");
      var _text = obj.find("input").val();
      var _move = false;
      obj.find(".moxlist li").each(function(){
        if($(this).html()==_text){
          var _top = ($(this).index()-2)*30;
          obj.find(".moxlist").scrollTop(_top);
          $(this).addClass("on");
          _move = true;
        }
      });
      if(_move==false) obj.find(".moxlist").scrollTop(0);
    });
    obj.unbind("mouseleave").mouseleave(function(){
      obj.removeClass("unfold");
    });
    obj.find("li").each(function(){
      $(this).unbind("click").click(function(){
        obj.find("input").val($(this).text());  
        obj.removeClass("unfold");  
        if(flag) o.pickProvince($(this).text());
      });

      $(this).unbind("hover").hover(function(){
        $(this).siblings().removeClass("on");
      });
    });
  };
  o.pickProvince = function(p){
    o.p.find("input").val(p); 
    o.p.removeClass("unfold");
  };
  o.fill = function(obj,_array){
    var _max = 0;
    $.each(_array,function(i,info){
      if(i==0) obj.parent().siblings("input").val(info);
      if(_max < info.length) _max=info.length;
      var _li = $("<li>").html(info);
      obj.append(_li);
    });
    _max = ((40+13*_max) < 120) ? 120 : (40+13*_max);
    obj.parent().css("width",_max);
  };
  o.fill(o.pul,data);
  o.bindEvt(o.p,true);
  return o;
}
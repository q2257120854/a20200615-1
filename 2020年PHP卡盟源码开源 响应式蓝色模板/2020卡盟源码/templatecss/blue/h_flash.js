//jquer的焦点图片自动播放
$(function(){
	var sw = 0;
	$("div.tab .num dd").mouseover(function(){
		sw = $(".num dd").index(this);
		myShow(sw);
	});
	function myShow(i){
		$("div.tab .num dd").eq(i).addClass("cur").siblings("dd").removeClass("cur");
		$("div.tab ul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}
	//滑入停止动画，滑出开始动画
	$("div.tab").hover(function(){
		if(myTime){
		   clearInterval(myTime);
		}
	},function(){
		myTime = setInterval(function(){
		  myShow(sw)
		  sw++;
		  if(sw==5){sw=0;}
		} , 3000);
	});
	//自动开始
	var myTime = setInterval(function(){
	   myShow(sw)
	   sw++;
	   if(sw==5){sw=0;}
	} , 3000);
});
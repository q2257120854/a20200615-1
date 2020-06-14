// JavaScript Document
//登录输入框
$(document).ready(function(){

	$(".login dd input,.zh").addClass("userName");

	$(".passw dd input,.mima").addClass("password");

	$(".login dd input,.zh").bind("focus keydown",function(){

		$(this).removeClass("userName");

		$(this).parent().addClass("cur");

		})
	$(".login dd input,.zh").bind("focusout",function(){

		if($(this).val()=="")

		{

		$(this).addClass("userName");

		$(this).parent().removeClass("cur");

		}

		else{

			$(this).removeClass("userName");

		    $(this).parent().addClass("cur");

			}

		})
	$(".passw dd input,.mima").bind("focus",function(){

		$(this).removeClass("password");

		})
	$(".passw dd input,.mima").bind("focusout",function(){

		if($(this).val()=="")

		{

		$(this).addClass("password");

		}
		})
})

window.onload = function () {
		var zch=document.body.clientHeight;
		var pmh=document.documentElement.clientHeight;
		   if(pmh>zch){
               jQuery('.login_footer').addClass('fixed');
				}else{
               jQuery('.login_footer').removeClass('fixed');
					}
		
	};
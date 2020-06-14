// JavaScript Document
(function(){
	$.fn.interfaceForm = function(options){
		settings = $.extend({
			objType:"select",
			toObj:"<dl></dl>",
			toObjSelected:"<dt></dt>",
			toObjList:"<dd></dd>",
			isJSP:true,
			jspContainer:'<div class="list"></div>',
			optionEle:"a",
			isAutoReinit:true,
			afterChange:function(){},
			initFinish:function(){}
		},options || {});
		
		return $(this).each(function(){
			
			var objType = settings.objType;
			var self = this;
			var element = $(this).find(objType);
			var toObj,toObjSelected,toObjList,jspContainer;
			var afterChange = settings.afterChange;
			var initFinish = settings.initFinish;
			var isAutoReinit = settings.isAutoReinit;
			var api
			
			var init = function(){
				if( objType == "select"){
					model_select();
				}else{
					return false;	
				}
			}
			
			var model_select = function(){
				
				toObj = $(settings.toObj).appendTo(self);
				toObjSelected = $(settings.toObjSelected).appendTo(toObj);
				toObjList = $(settings.toObjList).appendTo(toObj);
				jspContainer = $(settings.jspContainer).appendTo(toObjList);
				var l = $(element).find("option").length;
				for(var i = 0; i < l ; i++){
					$(jspContainer).append('<a href="###" data-value="' + $(element).find("option").eq(i).val() + '">'+ $(element).find("option").eq(i).text() +'</a>')
				}
				
				toObjSelected.text($(jspContainer).find("a[data-value=" + $(element).val()+ "]").text());
				
				initFinish($(element).val());
				
				
				model_select_fun();
				
				$(element).change(function(){
					
					model_select_fun();
					
					afterChange($(this).val());	
				});
				
			}
			
			var model_select_fun = function(){
				
				//console.log( $(element).attr("disabled") );
				toObjSelected.text($(jspContainer).find("a[data-value=" + $(element).val()+ "]").text());
				
				if( $(element).attr("disabled") ){
					$(toObj).unbind("mouseenter mouseleave");
					$(toObjSelected).unbind("click");
					$(jspContainer).find("a").unbind("click");
					$(toObjSelected).addClass("disabled");
				}else{
					
					$(toObj).unbind("mouseenter mouseleave");
					$(toObjSelected).unbind("click");
					$(jspContainer).find("a").unbind("click");
					$(toObjSelected).addClass("disabled");
					
					$(toObjSelected).removeClass("disabled");
					$(toObj).hover(function(){
					},function(){
						if( ! ( $.browser.msie && $.browser.version < 7 )){
							$(toObjList).hide();
							$(toObjSelected).removeClass("current");
						}
					});
					$(toObjSelected).click(function(e){
						
						
						$(toObjSelected).addClass("current");
						
						$(toObjList).show();
						
						if(isAutoReinit){
							api = $(jspContainer).jScrollPane({"autoReinitialise ":true}).data('jsp');
						}else{
							api = $(jspContainer).jScrollPane().data('jsp');		
						}
						
						api.scrollTo(0,0);
						
						$(self).find(".jspScrollable").mousewheel(function(){return false;});
						
					});
					$(jspContainer).find("a").bind("click",function(e){
						e.preventDefault();
						$(toObjList).hide();
						$(toObjSelected).text($(this).text()).removeClass("current");;
						$(element).val($(this).attr("data-value"));
						//$(element).find(option[text='data-value']).attr("selected", true);
						$(element).trigger("change");
						//console.log($(this).attr("data-value"));
					});
				}
			}
			
			
			var reinit = function(){
				if( objType == "select"){
					$(toObj).remove();
					//$(jspContainer).find("a").unbind("click")
					model_select();
				}else{
					return false;	
				}
			}
			
			
			init();
			
			$(this).extend(this,{reinit:function(){
				reinit();
			},destory:function(){
				$(toObj).unbind("mouseenter mouseleave");
				$(toObjSelected).unbind("click");
				$(jspContainer).find("a").unbind("click");
				$(toObjSelected).addClass("disabled");
				
				$(toObjSelected).removeClass("disabled");
			}
			});
			
			$(this).data("iform",this);
			
		});
		
	}
})(jQuery);




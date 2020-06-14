$(function () {

	/**
	 * 验证用户名
	 * 必须以字母开头，5-17 字母,数字,下划线
	 */
	$.validator.addMethod('user',function(value,element){
		var user = /^[a-zA-Z][\w]{4,16}$/;
		return this.optional(element) || (user.test(value));
	},"以字母开头,5-17 字母、数字、下划线");
	
	//jQuery Validate 添加用户表单验证
	$('form[name="adduser"]').validate({
		//默认为lable
		errorElement : 'span',
		//失败时先移除成功的class
		validClass : 'success',
		//指定成功的样式
		success : function(span){
			span.addClass('success');
		},

		rules:{
			username:{
				required : true,
				user : true,
				//用户名异步传输验证
				remote : {
					url:checkUserName,
					type:'post',
					dataType:'json',
					data:{
						username:function(){
							return $('#username').val();
						}
					}
				}
			},
			password:{
				required : true
			}
		},
		messages:{
			username:{
				required:'账号不能为空',
				remote:'对不起，账号已存在！'
			},
			password:{
				required:'密码不能为空'
			}
		}

	});
});
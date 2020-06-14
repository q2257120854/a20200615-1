
   $(function () {   
            //消息展开
            $('#bTag').mouseover(function () {
                $(this).find("a.msg_txt").css("text-decoration", "none");
            });
            $('#bTag').hover(function () {
                $(this).find("a.msg_txt").css("text-decoration", "none");
                var spanWidth = $(this).width() + 44;
                $(this).find("span.outline").width(spanWidth);
                $(this).find("span.blank").width(spanWidth);
                $(this).addClass('hover');
                $('#bTag1').addClass('hoverb');
                $("#msgBox").fadeIn();
            }, function () {
                //$('#bTag').click(function () { return false; });
                //$('#msgBox').click(function () { return false; });
                $('#bTag').removeClass('hover');
                $('#bTag1').removeClass('hoverb');
                $("#msgBox").hide();
                $("#Msg2").hide();
                $("#Msg1").show();
            });
			
			//返回消息窗口
            $("#returnMsg").click(function () {
                $("#Msg2").hide();
                $("#Msg1").show();
            });
			
			//设置消息
            $("#setMsg").click(function () {
                $("#Msg1").hide();
                $("#Msg2").show();
            });
			});
   
        //登陆
        $('.logins').live({click:function(){
            login();
        }
        });
        //回车
        $(document).keypress(function(e){
            if(e.which == 13){
                login();
            }
        });

        function login(){
            var user = $('#userlogin').val();
            var pass = $('#passlogin').val();
            if(user==""){
                alert("用户名不得为空");
                $('#userlogin').focus();
                return false;
            }
            if(user.length > 15 || user.length < 4){
                alert("请输入4-15位的用户名");
                $('#userlogin').focus();
                return false;
            }
            if(pass==""){
                alert("密码不得为空");
                $('#passlogin').focus();
                return false;
            }
            if(pass.length > 17 || pass.length < 6){
                alert("请输入6-17位的密码");
                $('#passlogin').focus();
                return false;
            }
            $.ajax({
            type: "POST",
            url: "/Index/tablogin",        
            data:$('.login').serialize(), 
                success: function(data){
                    if(data.indexOf('登陆成功')>=0){
                        location.href = "/Main/Index";
                    }else{
                        alert(data);
                    }
                }
            });
        }
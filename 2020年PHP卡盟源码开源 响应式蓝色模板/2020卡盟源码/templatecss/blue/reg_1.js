$(document).ready(function(){
     //判断用户名
    $('#register_btn').css('background','#888888');
    $('#user').blur(function(){
        if($(this).val()==""){
            $('#yzuser').css("color","#FF0000");
            $('#yzuser').html('用户名不得为空');
            $('#register_btn').attr('disabled',true).css('background','#888888');
            return false;
        }
        if($(this).val().length > 15 || $(this).val().length < 4){
            $('#yzuser').css("color","#FF0000");
            $('#register_btn').attr('disabled',true).css('background','#888888');
            $('#yzuser').html('请输入4-15位的用户名');
            return false;
        }
        $.ajax({
        type: "POST",
        url: "tabuser",        
        data:{'user':$(this).val()}, 
            success: function(data){
                $('#yzuser').html(data);
                if(data.indexOf('该用户名可以使用')>=0){
                    $('#yzuser').css("color","#00FF00");
                    $('#register_btn').attr('disabled',false).css('background','');
                }else{
                    $('#yzuser').css("color","#FF0000");
                    $('#register_btn').attr('disabled',true).css('background','#888888');
                }
            }
        });
        return true;   
    });
}) ;

    //是否有上级
    function eriorCheck(){
        document.getElementById('terior').style.display="none";
    }
    function eriorsCheck(){
        document.getElementById('terior').style.display="block";
    }

    //表单验证
    function regform(){
        //用户名
        var user    =   document.getElementById('user'); 
            if(user.value==""){
                alert('用户名不得为空');
                user.focus();
                return false;
            }
            if(user.value.length > 15 || user.value.length < 4){
                alert('请正确输入4-15位用户名');
                user.focus();
                return false;
            }

        //密码
        var pass    =   document.getElementById('pass'); 
            if(pass.value==""){
                alert('密码不得为空');
                pass.focus();
                return false;
            }
            if(pass.value.length >17 || pass.value.length < 6){
                alert('请正确输入6-17位的密码');
                pass.focus();
                return false;
            }
    
        //确认密码
        var qdpass = document.getElementById('qdpass');
            if(qdpass.value != pass.value){
                alert('确认密码与密码不匹配');
                qdpass.focus();
                return false;
            }

        //支付密码
        var Paypass = document.getElementById('Paypass');
            if(Paypass.value==""){
                alert('支付密码不得为空');
                Paypass.focus();
                return false;
            }
            if(Paypass.value.length >17 || Paypass.value.length < 6){
                alert('请正确输入6-17位的支付密码');
                Paypass.focus();
                return false;
            }

        //确认支付密码
        var qdPaypass = document.getElementById('qdPaypass');
            if(qdPaypass.value != Paypass.value){
                alert('确认支付密码与密码不匹配');
                qdPaypass.focus();
                return false;
            }

        //手机号码
        var phone = document.getElementById('phone');
            var re =/^(((1[0-9][0-9]{1})|159|153)+\d{8})$/;
            if(!re.test(phone.value)){
                alert('请填写正确的手机号码');
                phone.focus();
                return false;
            }
    
        //邮箱
        // var email = document.getElementById('email');
        //     var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;  
        //     if(!pattern.test(email.value)){
        //         alert('请输入正确的邮箱地址');
        //         email.focus();
        //         return false;
        //     }

        //QQ
        var qq = document.getElementById('qq');
            if (qq.value == "") {
                alert('QQ号码不能为空');
                qq.focus();
                return false;
            }
            if (!/^[1-9][0-9]{3,10}$/.test(qq.value)) {
                alert('只接受4-11位QQ号码');
                qq.focus();
                return false;
            }

        //验证码
        var yzm = document.getElementById('yzm');
            if(yzm.value==""){
                alert('验证码不得为空');
                yzm.focus();
                return false;
            }
        //注册
        $.ajax({
        type: "POST",
        url: "tabadd",        
        data:$('.form1').serialize(), 
            success: function(data){
                alert(data);
                if(data.indexOf('注册成功')>=0){
                    location.href = "/";
                }
            }
        });          
    return true;
}
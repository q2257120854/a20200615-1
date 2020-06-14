
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>聚合社</title>

<!-- 关闭元素 开始 -->
<script src="css/dialog.close.js" type="text/javascript"></script>
<!-- 关闭元素 结束 -->

<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/my/style.css" rel="stylesheet" type="text/css" />
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script src="css/my/jquery.validate.js" type="text/javascript"></script>
<!-- 表单验证元素 结束 -->
<link href="css/css.css" rel="stylesheet" type="text/css">
<!--[if IE]>
		<script src="js/html5.js"></script>
		<![endif]-->
</head>
 
<body>
<?php
$Action=$_REQUEST['Action'];
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<script>
function cl()
{ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<?php
if ($Action=='zlsave'){

if ($_SESSION['yx_token']!=$_POST['Token']){header('location:/404.php');exit();}

$address=strip_tags(inject_check($_POST['address']));
$rname=strip_tags(inject_check($_POST['rname']));
$qq=strip_tags(inject_check($_POST['qq']));
$phone=strip_tags(inject_check($_POST['phone']));
$email=strip_tags(inject_check($_POST['email']));
$txtPayPwd = strip_tags(inject_check($_POST['txtPayPwd']));

if(md5($txtPayPwd) == $yx_us['passwords']){
mysql_query("update members set qq='$qq',rname='$rname',address='$address',phone='$phone',email='$email'   where number='$_SESSION[ysk_number]'",$conn1); 

echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><br><input id='btnAll' type='button' value='修改成功!'  onClick='cl()' class='tijiao_input' /></center>";
}else{ echo "<script>alert('对不起，您的交易密码不正确！');;self.location=document.referrer;</script>";}
}
if ($Action=='pssave') {
	
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_us['password']!=md5($_POST['password'])) {
echo "<script>alert('对不起，您的账户密码不正确！');;self.location=document.referrer;</script>";
exit();
}
$passwords=md5($_REQUEST['password1']);

mysql_query("update members set password='$passwords'  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><input id='btnAll' type='button' value='修改成功!'  onClick='cl()' class='tijiao_input' /></center>";

}

if ($Action=='jysave') {

if ($yx_us['passwords']!=md5($_REQUEST['password'])) {
echo "<script>alert('对不起，您的交易密码不正确！');;self.location=document.referrer;</script>";
exit();
}
$passwords=md5($_REQUEST['password1']);
mysql_query("update members set passwords='$passwords'  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><input id='btnAll' type='button' value='修改成功!'  onClick='cl()' class='tijiao_input' /></center>";

}
?>


<?php if ($Action=='jymm') {?>
<script language="JavaScript">
<!--
function checkuserinfo()
{
if(checkspace(document.userinfo.password.value)) {
document.userinfo.password.focus();
alert("对不起，原密码不能为空！");
return false;
} 
if(checkspace(document.userinfo.password1.value) || document.userinfo.password1.value.length < 6 || document.userinfo.password1.value.length >20) {
document.userinfo.password1.focus();
alert("密码长度不能为空，在6位到20位之间，请重新输入！");
return false;
}
if(document.userinfo.password1.value != document.userinfo.password2.value) {
document.userinfo.password1.focus();
document.userinfo.password1.value = '';
document.userinfo.password2.value = '';
alert("两次输入的密码不同，请重新输入！");
return false;
}


}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="userinfo" method="post" action="?Action=jysave">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="page-edit-box">

<table class="page-edit">
<tbody>
<tr>
                <td class="td-left" style="width: 25%">
                    当前状态：
                </td>
                <td class="td-right">
                    已启用交易密码
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
<tr>
                <td class="td-left" style="width: 25%">
                    原交易密码：
                </td>
                <td class="td-right">
                    <input name="password" type="password"  id="password" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    新交易密码：
                </td>
                <td class="td-right">
                    <input name="password1" type="password"   id="password1" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    确认新登录密码：
                </td>
                <td class="td-right">
                    <input name="password2" type="password"   id="password2" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        
                    <input type="hidden" id="mm" type="radio" name="mm" value="1" checked="checked" />
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    
                </td>
                <td class="td-right">
                    <input type="submit" name="btnSubmit" onClick="return checkuserinfo();" value="确认修改" id="btnSubmit" class="btn-submit"> 
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
 
</div>  
</form>
<?php } ?>
<?php if ($Action=='zl') {?>
<script language="JavaScript">
<!--
function check_feedback(form1){
if (add.phone.value=="") {alert("联系电话不能为空");add.phone.focus();return false;}
if (add.rname.value=="") {alert("真实姓名不能为空");add.rname.focus();return false;}
if (add.email.value=="") {alert("邮箱不能为空");add.email.focus();return false;}
if (add.qq.value=="") {alert("QQ不能为空");add.qq.focus();return false;}
if (add.address.value=="") {alert("地址不能为空");add.address.focus();return false;}

if(add.email.value.length!=0)
{
if (add.email.value.charAt(0)=="." ||        
add.email.value.charAt(0)=="@"||       
add.email.value.indexOf('@', 0) == -1 || 
add.email.value.indexOf('.', 0) == -1 || 
add.email.value.lastIndexOf("@")==add.email.value.length-1 || 
add.email.value.lastIndexOf(".")==add.email.value.length-1)
{
alert("Email地址格式不正确！");
add.email.focus();
return false;
}
}
else
{
alert("Email地址不能为空！");
add.email.focus();
return false;
}
}
//-->
</script>
<form name="add" method="post" action="?Action=zlsave" onSubmit="return check_feedback(this)">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="content ui-switchable" id="J-trend-tabs" data-tair-key="PERSONAL_USERINFO_HIDDEN" data-behavior-key="trendTabPosition" data-widget-cid="widget-1">
<div class="page-edit-box">
<table class="page-edit" >
<tbody><tr>
                <td class="td-left" style="width: 25%">
                    手机号码：
                </td>
                <td class="td-right">
                    <input name="phone" type="text" value="<?=$yx_us['phone']?>" id="phone" class="btn-text">
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    电子邮箱：
                </td>
                <td class="td-right">
                    <input name="email" type="text" value="<?=$yx_us['email']?>" id="email" class="btn-text">
                     
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    真实姓名：
                </td>
                <td class="td-right">
                    <input name="rname" type="text" value="<?=$yx_us['rname']?>" maxlength="50" id="name" class="btn-text" >
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    联系QQ：
                </td>
                <td class="td-right">
                    <input name="qq" type="text" value="<?=$yx_us['qq']?>" maxlength="12" id="qq" class="btn-text">
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    联系地址：
                </td>
                <td class="td-right">
                    <input name="address" type="text" value="<?=$yx_us['address']?>" maxlength="100" id="address" class="btn-text">
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            
                <tr>
                    <td class="td-left">
                        <span>输入交易密码：</span>
                    </td>
                    <td class="td-right">
                        <input name="txtPayPwd" type="password" id="txtPayPwd" class="btn-text" style="width: 150px;">
                       
                    </td>
                </tr>
            <tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td  class="td-left">
                </td>
                <td class="td-right">
                    <input type="Submit" name="btnSubmit" value="确认修改" id="btnSubmit" class="btn-submit">
                    
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
	
		
	
</div></form>
<?php } ?>
<?php if ($Action=='password') {?>
<script language="JavaScript">
<!--
function checkuserinfo()
{

if(checkspace(document.userinfo.password.value)) {
document.userinfo.password.focus();
alert("对不起，原密码不能为空！");
return false;
} 
if(checkspace(document.userinfo.password1.value) || document.userinfo.password1.value.length < 6 || document.userinfo.password1.value.length >20) {
document.userinfo.password1.focus();
alert("密码长度不能为空，在6位到20位之间，请重新输入！");
return false;
}
if(document.userinfo.password1.value != document.userinfo.password2.value) {
document.userinfo.password1.focus();
document.userinfo.password1.value = '';
document.userinfo.password2.value = '';
alert("两次输入的密码不同，请重新输入！");
return false;
}


}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="userinfo" method="post" action="?Action=pssave">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="page-edit-box">

<table class="page-edit">
<tbody><tr>
                <td class="td-left" style="width: 25%">
                    原登录密码：
                </td>
                <td class="td-right">
                    <input name="password" type="password"  id="password" class="btn-text" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    新登录密码：
                </td>
                <td class="td-right">
                    <input name="password1" type="password"   id="password1" class="btn-text" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    确认新登录密码：
                </td>
                <td class="td-right">
                    <input name="password2" type="password"   id="password2" class="btn-text" style="width: 150px;">
                </td>
            </tr>
            <tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td  class="td-left">
                </td>
                <td class="tdleft">
                    <input type="submit" name="btnSubmit" value="确认修改" id="btnSubmit" onClick="return checkuserinfo();" class="btn-submit" > 
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
</div>
</form>
<?php } ?>

</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
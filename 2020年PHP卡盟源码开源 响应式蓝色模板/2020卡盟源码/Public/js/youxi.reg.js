var customerName = ""; //登录名称

//检验用户名是否存在
function chkNameIsExist() {
var name = $("#customerName").attr("value");
var result = name.match(/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/);
if ($.trim(name) == "") {
customerName = "<font color=red>×用户名不能为空</font>";
}
else if (result == null) {
customerName = "<font color=red>×您确定使用该邮箱？</font>";
}
else {
var datas = "Method=checkCustomerName&customerName=" + name;
$.ajax({
url: "/ajax.php",
type: "post",
data: datas,
dataType:"json",
success: function (result) {

if (result== "1") {
customerName = "<font color=red>×该邮箱已经存在</font>";
}else {
customerName = "OK";
}
},
error: function (ex) {
alert(ex);
},
cache: false,
async: false
});
}
}

/////////////////////////////////////////验证上级代理
function check_agent() {
var agent = $("#agent").attr("value");
if ($.trim(agent)=="" && document.getElementById("checkbox").checked == false) {
agentid = "OK";
}else{
var datas = "Method=checkagent&agent=" + agent;
$.ajax({
url: "/ajax.php",
type: "post",
data: datas,
dataType:"json",
success: function (result) {
if (result== "2") {
agentid = "<font color=red>×找不到该上级</font>";
}else{
agentid = "OK";
}
},
error: function (ex) {
alert(ex);
},
cache: false,
async: false
});
}

}



////////////////////////////////////////////////密码格式是否正确
function check_pwd() {
var pwd = $("#password").val();
var result = pwd.match(/^([a-z]|[A-Z]|[0-9]){6,18}$/);
if (result == null) {
password = "<font color=red>×必须是6-30位的数字或字母</font>";
return false;
} else {
password = "OK";
return true;
}
}
////////////////////////////////////////////////两次输入的登录密码是否一致
function pwdIsSame() {
var pwd = $("#password").val();
var conFirmPwd = $("#qrpassword").val();
var result = conFirmPwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (pwd == conFirmPwd && conFirmPwd != "" && result != null) {
confirmPassword = "OK";
return true;
}
else {
confirmPassword = "<font color=red>×密码不一致或格式不正确</font>";
return false;
}
}



////////////////////////////////////////////////交易密码格式是否正确
function checkTradePwd() {
var pwd = $("#tradePassword").val();
var result = pwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (result == null) {
tradePassword = "<font color=red>×必须是6-30位的数字或字母</font>";
return false;
} else {
tradePassword = "OK";
return true;
}
}

//两次输入交易密码是否相等
function TradePwdIsSame() {
var tradePwd = $("#tradePassword").val();
var tradeConFirmPwd = $("#qrtradePassword").val();
var result = tradeConFirmPwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (tradePwd == tradeConFirmPwd && tradeConFirmPwd != "" && result != null) {
tradePassword = "OK";
return true;
}
else {
tradePassword = "<font color=red>×交易密码不一致或格式不正确<font>";
return false;
}
}





//验证公司名称
function checkcompany() {
var company = $("#company").val();
if (company != "") {
var result = company.match(/^([\u4E00-\u9FA5]){2,20}$/);
if (result == null) {
contactcompany = "<font color=red>×公司格式不合法,必须是2个汉字以上</font>";
return false;
}
else {
contactcompany = "OK";
return true;
}
}
else {
contactcompany = "<font color=red>×公司名称不能为空！</font>";
return false;
}
}

//验证中文名字
function checkChiName() {
var chiName = $("#rname").val();
if (chiName != "") {
var result = chiName.match(/^([\u4E00-\u9FA5]){2,4}$/);
if (result == null) {
contactName = "<font color=red>×姓名格式不合法,必须是2-4个汉字</font>";
return false;
}
else {
contactName = "OK";
return true;
}
}
else {
contactName = "<font color=red>×姓名不能为空！</font>";
return false;
}
}


//验证身份证
function checkPCard() {
var pCard = $("#card").val();
if (pCard != "") {
var result = pCard.match(/^(\d{14}|\d{17})(\d|[xX])$/);
if (result == null) {
identityCard = "<font color=red>×身份证格式不合法,必须是15或18位数字！</font>";
return false;
}
else {
identityCard = "OK";
return true;
}
}
else {
identityCard = "<font color=red>×身份证不能为空！</font>";
return false;
}
}

//验证QQ
function checkQQ() {
var qq = $("#qq").val();
var result = qq.match(/^\d{5,}$/);
if (result == null) {
myQQ = "<font color=red>×不是有效的QQ号码</font>";
return false;
}
else {
myQQ = "OK";
return true;
}
}

//验证11位电话号码
function checkMobile() {
var mobile = $("#phone").val();
/*中国移动拥有号码段为:139,138,137,136,135,134,159,158,157(3G),151,152,150,188(3G),183,187(3G),188;15个号段
中国联通拥有号码段为:130,131,132,155,156(3G),186(3G),185(3G);7个号段
中国电信拥有号码段为:133,153,189(3G),180(3G);4个号码段*/
var result = mobile.match(/^1(([3][456789])|([5][012789])|([8][2378]))[0-9]{8}$/);
result = result || mobile.match(/^1(([3][012])|([5][56])|([8][56]))[0-9]{8}$/);
result = result || mobile.match(/^1(([3][3])|([5][3])|([8][09]))[0-9]{8}$/);
if (result == null) {
myMobile = "<font color=red>×手机号码格式不合法</font>";
return false;
}
else {
myMobile = "OK";
return true;
}
}


function check_area() {
if ($("#province").val() =="") {
Salesarea="<font color=red>×请选择<font>";
return false;
}else {
Salesarea = "OK";
return true;
}
}

//--------------注册协议复选框状态检测---------------------//
function check_agreement(){
if (document.userinfo.Agreed.checked==false){
registration="<font color=red>请勾选<font>";
return false;
}else if(document.userinfo.Agreed.checked==true){
registration = "OK";
return true;
}
}


$(function () {
////////////////////////////////////////////////////////////////////////////////////////////////////////验证用户名
//-------------------------------------------选中状态
$("#customerName").focus(function(){
if ($(this).val() =="") {
chk_use.innerHTML="<font color=green>请填写您的登录邮箱</font>";
}else{
chk_use.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#customerName").blur(function(){
chkNameIsExist();
if (customerName == "OK") {
chk_use.innerHTML="<font color=green>√</font>";
} else {
chk_use.innerHTML=customerName;
}
});		

////////////////////////////////////////////////////////////////////////////////////////////////////////验证用户名 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证会员密码 The Start
$("#password").focus(function(){
if ($(this).val() =="") {
chk_pwd.innerHTML="<font color=green>请输入密码</font>";
}else{
chk_pwd.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#password").blur(function(){
check_pwd();
if (password == "OK") {
chk_pwd.innerHTML="<font color=green>√</font>";
} else {
chk_pwd.innerHTML=password;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证会员密码 The End


////////////////////////////////////////////////////////////////////////////////////////////////////////确认会员密码 The Start
$("#qrpassword").focus(function(){
if ($(this).val() =="") {
chk_qrpwd.innerHTML="<font color=green>请再次输入密码</font>";
}else{
chk_qrpwd.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#qrpassword").blur(function(){
pwdIsSame();
if (confirmPassword == "OK") {
chk_qrpwd.innerHTML="<font color=green>√</font>";
} else {
chk_qrpwd.innerHTML=confirmPassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////确认会员密码 The End


////////////////////////////////////////////////////////////////////////////////////////////////////////验证会员交易密码 The Start
$("#tradePassword").focus(function(){
if ($(this).val() =="") {
chk_tdpwd.innerHTML="<font color=green>请输入密码</font>";
}else{
chk_tdpwd.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#tradePassword").blur(function(){
checkTradePwd();
if (tradePassword == "OK") {
chk_tdpwd.innerHTML="<font color=green>√</font>";
} else {
chk_tdpwd.innerHTML=tradePassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证会员交易密码 The End


////////////////////////////////////////////////////////////////////////////////////////////////////////确认会员密码 The Start
$("#qrtradePassword").focus(function(){
if ($(this).val() =="") {
chk_qrtdpwd.innerHTML="<font color=green>请再次输入密码</font>";
}else{
chk_qrtdpwd.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#qrtradePassword").blur(function(){
TradePwdIsSame();
if (tradePassword == "OK") {
chk_qrtdpwd.innerHTML="<font color=green>√</font>";
} else {
chk_qrtdpwd.innerHTML=tradePassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////确认会员密码 The End


////////////////////////////////////////////////////////////////////////////////////////////////////////选择销售区域 The Start
$("#province").focus(function(){
if ($(this).val() =="") {
chk_area.innerHTML="<font color=green>请选择销售区域</font>";
}else{
chk_area.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#province").blur(function(){
if ($(this).val() =="") {
chk_area.innerHTML="<font color=red>×请选择销售区域</font>";
}else{
chk_area.innerHTML="<font color=green>√</font>";	
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////选择销售区域 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证公司名称 The Start
$("#company").focus(function(){
if ($(this).val() =="") {
chk_company.innerHTML="<font color=green>请输入公司名称</font>";
}else{
chk_company.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#company").blur(function(){
checkcompany();
if (contactcompany == "OK") {
chk_company.innerHTML="<font color=green>√</font>";
} else {
chk_company.innerHTML=contactcompany;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证公司名称 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证本人姓名 The Start
$("#rname").focus(function(){
if ($(this).val() =="") {
chk_rname.innerHTML="<font color=green>请输入本人真实姓名</font>";
}else{
chk_rname.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#rname").blur(function(){
checkChiName();
if (contactName == "OK") {
chk_rname.innerHTML="<font color=green>√</font>";
} else {
chk_rname.innerHTML=contactName;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证本人姓名 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证身份证 The Start
$("#card").focus(function(){
if ($(this).val() =="") {
chk_card.innerHTML="<font color=green>请输入本人真实身份证号码</font>";
}else{
chk_card.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#card").blur(function(){
checkPCard();
if (identityCard == "OK") {
chk_card.innerHTML="<font color=green>√</font>";
} else {
chk_card.innerHTML=identityCard;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证身份证 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证QQ The Start
$("#qq").focus(function(){
if ($(this).val() =="") {
chk_qicq.innerHTML="<font color=green>请输入真实QQ号码</font>";
}else{
chk_qicq.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#qq").blur(function(){
checkQQ();
if (myQQ  == "OK") {
chk_qicq.innerHTML="<font color=green>√</font>";
} else {
chk_qicq.innerHTML=myQQ;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证QQ The End


////////////////////////////////////////////////////////////////////////////////////////////////////////验证手机 The Start
$("#phone").focus(function(){
if ($(this).val() =="") {
chk_phone.innerHTML="<font color=green>请您填写可以和您本人取得联系的手机号码</font>";
}else{
chk_phone.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#phone").blur(function(){
checkMobile();
if (myMobile  == "OK") {
chk_phone.innerHTML="<font color=green>√</font>";
} else {
chk_phone.innerHTML=myMobile;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////验证手机 The End

////////////////////////////////////////////////////////////////////////////////////////////////////////验证代理 The Start
//-------------------------------------------选中状态
$("#agent").focus(function(){
if ($(this).val() =="") {
chk_age.innerHTML="<font color=green>请填写您的上级编号</font>";
}else{
chk_age.innerHTML="<font color=green>您要重新填写？</font>";	
}
});
//-------------------------------------------离开状态
$("#agent").blur(function(){
check_agent();
if (agentid == "OK") {
chk_age.innerHTML="<font color=green>√ </font>";
} else {
chk_age.innerHTML=agentid;
}
});		

////////////////////////////////////////////////////////////////////////////////////////////////////////验证代理 The End




});




//提交总验证
function checkAll() {
if (customerName == "OK" && check_pwd() && pwdIsSame() && checkTradePwd() && TradePwdIsSame() && check_area() && checkcompany() && checkChiName() && checkPCard() && checkQQ() && checkMobile() && check_agreement()  && agentid=="OK" ) {
return true;
}else {
return false;
}
}

function Register(style) {
chkNameIsExist();
if (customerName != "OK")
chk_use.innerHTML=customerName;

check_pwd();
if (password !="OK")
chk_pwd.innerHTML=password;

pwdIsSame();
if (confirmPassword != "OK")
chk_qrpwd.innerHTML=confirmPassword;

checkTradePwd();
if (tradePassword != "OK")
chk_tdpwd.innerHTML=tradePassword;

TradePwdIsSame();
if (tradePassword != "OK")
chk_qrtdpwd.innerHTML=tradePassword;

check_area();
if (Salesarea != "OK")
chk_area.innerHTML="<font color=red>×请选择销售区域</font>";

checkcompany();
if (contactcompany != "OK")
chk_company.innerHTML=contactcompany;

checkChiName();
if (contactName != "OK")
chk_rname.innerHTML=contactName;

checkPCard();
if (identityCard != "OK")
chk_card.innerHTML=identityCard;

checkQQ();
if (myQQ != "OK")
chk_qicq.innerHTML=myQQ;



checkMobile();
if (myMobile != "OK")
chk_phone.innerHTML=myMobile;

check_agreement();
if (registration != "OK")
chk_agr.innerHTML=registration;

check_agent();
if (agentid!="OK")
chk_age.innerHTML=agentid;


if (checkAll() == false) {
return;
}


document.getElementById("register_btn").style.display = "none";
document.getElementById("rewrite_btn").style.display = "none";
document.getElementById("loading").style.display = "inline";

var datas = "Method=Check_Reg_email&customerName=" + $("#customerName").attr("value") + "&password=" + $("#password").attr("value") + "&tradePassword=" + $("#tradePassword").attr("value")  + "&province=" + $("#province").attr("value") + "&city=" + $("#city").attr("value") + "&company=" + encodeURIComponent($("#company").attr("value")) + "&rname=" + encodeURIComponent($("#rname").attr("value")) + "&card=" + $("#card").attr("value") + "&qq=" + $("#qq").attr("value") + "&phone=" + $("#phone").attr("value") + "&address=" + $("#address").attr("value") + "&agent=" + $("#agent").attr("value") + "&begtime=" + $("#begtime").attr("value") + "&Token=" + $("#Token").attr("value");
$.ajax({
url: "/Public/youxi_ajax.php",
type: "post",
data: datas,
dataType: "json",
success: function (result) {
if        (result == "1") {
location.href = "regok.php?msg="+ $("#customerName").attr("value");
}else if (result == "2"){
alert('操作失败，邮件发送失败!请检测您的邮箱是否正确!');window.location='reg.php';
}else if (result == "3"){
alert('操作失败，您有的资料没有正确填写!');window.location='reg.php';
}else if (result == "404"){
alert('操作失败，您不能重复注册!');window.location='reg.php';
}else if (result == "405"){
alert('操作失败，验证错误!');window.location='reg.php';
} 

},
error: function (ex) {
console.log(ex);
},
cache: false
});
}
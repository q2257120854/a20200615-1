window.onload=function() {
var xmlHttp = false;
if (window.XMLHttpRequest) {      //Mozilla¡¢SafariµÈä¯ÀÀÆ÷
xmlHttp = new XMLHttpRequest();
} 
else if (window.ActiveXObject) {    //IEä¯ÀÀÆ÷
try {
xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
var checkImg=document.getElementById("checkImg");
var checkCode=document.getElementById("checkCode");
checkImg.onclick=function() {
checkImg.src="/jhs_config/getcode.php?num="+Math.random();
}
checkCode.onblur=function(){
xmlHttp.open("POST","/jhs_config/getcode.php",true);
xmlHttp.onreadystatechange=function () {
if(xmlHttp.readyState==4 && xmlHttp.status==200) {
var msg=xmlHttp.responseText; 
if(msg=='1')
document.getElementById("checkResult").innerHTML="ÕýÈ·"; 
else
document.getElementById("checkResult").innerHTML="´íÎó";
}
}
xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlHttp.send("validateCode="+checkCode.value);
} 
}
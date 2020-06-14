
<?php
//////////////////////////////////////////////////////////检测图片文件是否是木马文件
function checkfile($filename){
$sqlinarr = array('cast', 'set', 'exec', 'insert', 'select', 'delete', 'update', 'execute', 'from', 'declare', 'varchar', 'script', 'iframe','<?php');
$fp = fopen ($filename,"rb",true);
$content = fread ($fp,filesize ($filename));
fclose ($fp);
foreach ($sqlinarr as $invalue){
if (stripos($content, $invalue) === false){
}else{
unlink($filename);
return "非法文件";
}
}
}

/////////////获取文件上传后缀
function get_extension($file){
return substr($file, strrpos($file, '.')+1);
}

////////////判断金额是否正确
function get_check_price($var){
////////1.判断是否有负数  2. 判断是否是数字  3.判断是否小于0
$tmparray=count(explode("-",$var));
if (preg_match("/^\d*$/",(int)$var)==0 || is_numeric($var)=='' || $var<0 || $tmparray>1){
echo "<script>alert('对不起，输入有误！请重新输入！');history.go(-1);</script>";
exit();
}else{
return 	$var;
}
}

////////////判断金额是否正确
function pot_check_price($var){
////////1.判断是否有负数  2. 判断是否是数字  3.判断是否小于0
if (is_numeric($var)=='' || $var<0 ){
echo "<script>alert('对不起，输入有误！请重新输入！');history.go(-1);</script>";
exit();
}else{
return 	$var;
}
}


////////////////////////////预防数据库被攻击
function check_input($value){
// 去除斜杠
if (get_magic_quotes_gpc()){
$value = stripslashes($value);
}
// 如果不是数字则加引号
if (!is_numeric($value)){
$value = "'" . mysql_real_escape_string($value) . "'";
}
return $value;
}

//---------------------PHP Token 令牌生成
function genToken( $len = 32, $md5 = true ) {
# Seed random number generator
# Only needed for PHP versions prior to 4.2
mt_srand( (double)microtime()*1000000 );
# Array of characters, adjust as desired
$chars = array(
'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',
'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',
'/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',
'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',
'?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',
'=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',
'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'
);
# Array indice friendly number of chars;
$numChars = count($chars) - 1; $token = '';
# Create random token at the specified length
for ( $i=0; $i<$len; $i++ )
$token .= $chars[ mt_rand(0, $numChars) ];
# Should token be run through md5?
if ( $md5 ) {
# Number of 32 char chunks
$chunks = ceil( strlen($token) / 32 ); $md5token = '';
# Run each chunk through md5
for ( $i=1; $i<=$chunks; $i++ )
$md5token .= md5( substr($token, $i * 32 - 32, 32) );
# Trim the token
$token =  substr($md5token, 0, $len);
}
$_SESSION['yx_token']=$token;
return $token;
}

//防御XSS（跨站脚本攻击）的函数
function RemoveXSS($val) {
$val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);  
$search = 'abcdefghijklmnopqrstuvwxyz'; 
$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
$search .= '1234567890!@#$%^&*()'; 
$search .= '~`";:?+/={}[]-_|\'\\'; 
for ($i = 0; $i < strlen($search); $i++) { 
$val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);
}
$ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'); 
$ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
$ra = array_merge($ra1, $ra2); 
$found = true;
while ($found == true) { 
$val_before = $val; 
for ($i = 0; $i < sizeof($ra); $i++) { 
$pattern = '/'; 
for ($j = 0; $j < strlen($ra[$i]); $j++) { 
if ($j > 0) { 
$pattern .= '(';  
$pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
$pattern .= '|';  
$pattern .= '|(&#0{0,8}([9|10|13]);)'; 
$pattern .= ')*'; 
} 
$pattern .= $ra[$i][$j]; 
} 
$pattern .= '/i';  
$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
$val = preg_replace($pattern, $replacement, $val);
if ($val_before == $val) {
$found = false;  
}  
}  
}  
return $val;  
}


/*************************防止PHP注入**********/    
function inject_check($str){
$check=@preg_match('/select|insert|or|and|order|by|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $str); // 进行过滤
if($check){
header('location:/404.php');
exit();
}else{
return $str;
}
}
/***************结束防止PHP注入*****************/    

/***************PAPI_GetSafeParam()用来获取安全的参数值PHP注入*****************/    

define("XH_PARAM_INT",0);
define("XH_PARAM_TXT",1);
function PAPI_GetSafeParam($pi_strName,$pi_Def ="",$pi_iType = XH_PARAM_TXT){
if ( isset($_GET[$pi_strName]) ) 
$t_Val = trim($_GET[$pi_strName]);
else if ( isset($_POST[$pi_strName]))
$t_Val = trim($_POST[$pi_strName]);
else 
return $pi_Def;

// INT
if (XH_PARAM_INT == $pi_iType)
{
if (is_numeric($t_Val))
return $t_Val;
else
return $pi_Def;
}

// String
$t_Val = str_replace("&", "&amp;",$t_Val); 
$t_Val = str_replace("<", "&lt;",$t_Val);
$t_Val = str_replace(">", "&gt;",$t_Val);
if ( get_magic_quotes_gpc() )
{
$t_Val = str_replace("\\\"", "&quot;",$t_Val);
$t_Val = str_replace("\\''", "&#039;",$t_Val);
}
else
{
$t_Val = str_replace("\"", "&quot;",$t_Val);
$t_Val = str_replace("'", "&#039;",$t_Val);
}


//////////////判断如果值为0 则跳转到错误页面
if ($t_Val==0){
header('location:/404.php');
exit();	
}else{
return $t_Val;
}
}
// $t_strUid = PAPI_GetSafeParam("f_uid", 0, XH_PARAM_INT);
// $t_strPwd = PAPI_GetSafeParam("f_pwd", "", XH_PARAM_TXT);
/***************结束防止PHP注入*****************/

?>
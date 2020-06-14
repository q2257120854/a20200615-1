
<?php 
include('jhs_config/function.php');
$Action=$_REQUEST['Action'];
function RenNum(){
srand((double)microtime()*1000000);
$randname=rand(!$j ? 1: 0,79);
return $randname;
}

$k[0]='A1';
$k[1]='B1';
$k[2]='C1';
$k[3]='D1';
$k[4]='E1';
$k[5]='F1';
$k[6]='G1';
$k[7]='H1';
$k[8]='I1';
$k[9]='J1';
$k[10]='A2';
$k[11]='B2';
$k[12]='C2';
$k[13]='D2';
$k[14]='E2';
$k[15]='F2';
$k[16]='G2';
$k[17]='H2';
$k[18]='I2';
$k[19]='J2';
$k[20]='A3';
$k[21]='B3';
$k[22]='C3';
$k[23]='D3';
$k[24]='E3';
$k[25]='F3';
$k[26]='G3';
$k[27]='H3';
$k[28]='I3';
$k[29]='J3';
$k[30]='A4';
$k[31]='B4';
$k[32]='C4';
$k[33]='D4';
$k[34]='E4';
$k[35]='F4';
$k[36]='G4';
$k[37]='H4';
$k[38]='I4';
$k[39]='J4';
$k[40]='A5';
$k[41]='B5';
$k[42]='C5';
$k[43]='D5';
$k[44]='E5';
$k[45]='F5';
$k[46]='G5';
$k[47]='H5';
$k[48]='I5';
$k[49]='J5';
$k[50]='A6';
$k[51]='B6';
$k[52]='C6';
$k[53]='D6';
$k[54]='E6';
$k[55]='F6';
$k[56]='G6';
$k[57]='H6';
$k[58]='I6';
$k[59]='J6';
$k[60]='A7';
$k[61]='B7';
$k[62]='C7';
$k[63]='D7';
$k[64]='E7';
$k[65]='F7';
$k[66]='G7';
$k[67]='H7';
$k[68]='I7';
$k[69]='J7';
$k[70]='A8';
$k[71]='B8';
$k[72]='C8';
$k[73]='D8';
$k[74]='E8';
$k[75]='F8';
$k[76]='G8';
$k[77]='H8';
$k[78]='I8';
$k[79]='J8';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>卡密登录</title>
<link href="Public/css/other.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action==''){
if ($_SESSION['mynumber']!=''){
$_SESSION['mynumber1']=$_SESSION['mynumber'];
}
$_SESSION['mynumber']='';
?>
<form action="?Action=save" method="post" name="myform">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td width="14%" height="32" class="td_left">验证码：</td>
<td width="86%" >
<input name="my" type="text" value="<?=$k[RenNum()];?> <?=$k[RenNum()];?>" style="border:none;font-size:16px; font-family:Arial, Helvetica, sans-serif;" readonly>
</td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">卡密密码：</td>
<td width="86%">
<input name="title"  type="password" id="title" style="border:1px #CCCCCC solid; padding:3px; width:24px;" value="" maxlength="3" /> - 
<input name="title1" type="password" id="title1" style="border:1px #CCCCCC solid; padding:3px; width:24px;" value="" maxlength="3" />
</td>
</tr>

<tr>
<td width="14%" height="32" class="td_left"></td>
<td width="86%"><input name="提交" type="submit" value="确认验证"  class="button_buy" onClick="return checkuserinfo2();" /></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save') {
$allArray1=(explode(' ',$_REQUEST['my']));  
$mysql="select * from Encrypted_card where username='$_SESSION[mynumber1]' ";   //读取数据表
$myc=mysql_query($mysql,$conn1);  //执行该SQl语句
$myr=mysql_fetch_array($myc);
$myka=$myr[$allArray1[0]].$myr[$allArray1[1]];
$mymy=$_REQUEST['title'].$_REQUEST['title1'];
if ($myka!=$mymy){
echo "<script>alert('对不起，验证错误,请重新输入！');window.location='camilo.php';</script>";
}else{
$_SESSION['account']=$_SESSION['myaccount'];
$_SESSION['ysk_number']=$_SESSION['mynumber1'];
$_SESSION['firsts']=$_SESSION['mydiyici'];
$_SESSION['myaccount']='';
$_SESSION['mynumber']='';
$_SESSION['mydiyici']='';
$_REQUEST['kami']='';
echo "<br><br><center><input id='reload' type='button' value='登录成功!'   class='tijiao_input' /></center>";
}


} ?>
</body>
</Html>
<script>
function cl(){ 
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}

// 刷新主页面
document.getElementById('reload').onclick = function () {
art.dialog.data('iframeTools', '我知道你刷新了页面～哈哈'); // plugin.iframe.html可以收到
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false;
};
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>帐户安全设置</title>
		<link href="css/css.css" rel="stylesheet" type="text/css">
		<!--[if IE]>
		<script src="js/html5.js"></script>
		<![endif]-->
</head> 
<body>
<?php
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
include_once('../jhs_config/error.php');
$Action=$_REQUEST['Action'];
$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number'",$conn2);
$yx_sup=mysql_fetch_array($yx_sup_result);
if ($Action==''){?>


<div class="content ui-switchable">
  <div class="table1">
<div class="goodlist">
	<h2>帐户安全设置</h2></div>
</div>

<div style="margin-top: 6px;"></div>
		
	
<table width="100%" border="0" cellspacing="5" cellpadding="5" style="border: 1px solid #e1e1e1;background-color: #FAFAFA;">
<tbody><tr>
<td width="100%" bgcolor="#FAFAFA" style="padding:5px;" valign="top">



<dl style=" border-bottom:1px #CCCCCC dashed; padding:10px 5px;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tbody><tr>
<td width="12%" rowspan="3" align="center"><img src="css/otherimg/s1.jpg" width="28" height="27"></td>
<td width="88%" valign="top" style="font-weight:bold;">多云令</td>
</tr>
<tr>
<td style="color:#83868f;">具有防水、防震防静电保护，有效期长达五年，长时间有效的保护账户安全。 
<a href="#" onClick="Javascript:return confirm('对不起，该功能暂未开放！');">
<span style="color:#014efe; text-decoration:underline">绑定多云令</span></a>
</td>
</tr>
</tbody></table>
</dl>

<dl style=" border-bottom:1px #CCCCCC dashed; padding:10px 5px;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tbody><tr>
<td width="12%" rowspan="3" align="center"><img src="css/otherimg/s2.jpg" width="28" height="27"></td>
<td width="88%" valign="top" style="font-weight:bold;">密保卡</td>
</tr>
<tr>
<td style="color:#83868f;">为账户提供一定的安全保护建议30-60天更换一次密保卡。                                             
<!--<a href="#" onClick="$.dialog.open('safeLevel.php?Action=mibaoka',{title:'密保卡购买',width:600,lock:true, fixed:true});">
<span style="color:#014efe; text-decoration:underline">绑定密保卡</span>
</a>-->
<?php 
$total=mysql_num_rows(mysql_query("select * from `Encrypted_card` where username='$_SESSION[ysk_number]' ",$conn1));
if ($total!='0'){
$myurl="onClick=\"$.dialog.open('safeLevel.php?Action=wsmbk',{title:'密保卡购买',width:600,lock:true, fixed:true});\"";
}else{
$myurl="onClick=\"$.dialog.open('safeLevel.php?Action=mibaoka',{title:'密保卡购买',width:600,lock:true, fixed:true});\"";
}
?>
<a href="#" <?=$myurl?>>
<?php if ($yx_us['power2']=='0') {?>
<span style="color:#014efe; text-decoration:underline">绑定密保卡</span>
<?php }else{?>
<span style="color:#ff0000; text-decoration:underline">已绑定</span>
<?php } ?>
</a>
</td>
</tr>
</tbody></table>
</dl>

<dl style=" border-bottom:1px #CCCCCC dashed; padding:10px 5px;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tbody><tr>
<td width="12%" rowspan="3" align="center"><img src="css/otherimg/s3.jpg" width="28" height="27"></td>
<td width="88%" valign="top" style="font-weight:bold;">手机令牌</td>
</tr>
<tr>
<td style="color:#83868f;">每60秒变更一次密码，有效保护账户安全。 
<a href="#" onClick="Javascript:return confirm('对不起，该功能暂未开放！');"><span style="color:#014efe; text-decoration:underline">绑定手机令牌</span></a>
</td>
</tr>
</tbody></table>
</dl>
<dl style=" border-bottom:1px #CCCCCC dashed; padding:10px 5px;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tbody><tr>
<td width="12%" rowspan="3" align="center"><img src="css/otherimg/s4.jpg" width="28" height="27"></td>
<td width="88%" valign="top" style="font-weight:bold;">交易密码</td>
</tr>
<tr>
<td style="color:#83868f;">转账汇款、提现、商品购买等需要输入交易密码，防止账户资金被盗用。
<a href="javascript:" onClick="$.dialog.open('account.php?Action=jymm',{title:'交易密码设置',width:500,lock:true, fixed:true});">
<span style="color:#ff0000; text-decoration:underline">已启用</span></a></td>
</tr>
</tbody></table>
</dl>
<dl style="padding:10px 5px;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tbody><tr>
<td width="12%" rowspan="3" align="center"><img src="css/otherimg/s5.jpg" width="28" height="27"></td>
<td width="88%" valign="top" style="font-weight:bold;">密保问题</td>
</tr>
<tr>
<td style="color:#83868f;">由用户选定的2个问题及对应答案组成，专门用于找回密码和设置其他密保。 
<?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `Encrypted_problem` where  username='$_SESSION[account]' ",$conn1));?>
<?php if ($total!='0'){?>
<a href="javascript:" onClick="$.dialog.open('safeLevel.php?Action=mibaoedit',{title:'密保问题',width:500,lock:true, fixed:true});">
<span style="color:#ff0000; text-decoration:underline">已启用</span></a>
<?php }else{?>
<a href="javascript:" onClick="$.dialog.open('safeLevel.php?Action=mibao',{title:'密保问题',width:500,lock:true, fixed:true});">
<span style="color:#014efe; text-decoration:underline">启用</span></a>
<?php } ?>
</td>
</tr>
</tbody></table>
</dl>
</td>

</tr>
</tbody></table>
	
		
	
</div>

<?php }elseif ($Action=='mibao'){?>
<form action="safeLevel.php?Action=mibaosave" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">

<table cellspacing="1" cellpadding="2" class="table5" style="margin: 0;width: 100%">
<tbody>
<tr>
                <td class="table5_left" style="width: 25%">
                    密保选项：
                </td>
                <td class="tdleft">
				<div id="form1_1" style="height:0; width:0px; float:left;"></div>
                <script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}
//]]>
</script>
<select name="problem" id="problem"  onchange="switchView1(this.value)">
<option value="" selected="selected">请选择</option>
<option value="我父亲的名字?">我父亲的名字?</option>
<option value="我母亲的名字?">我母亲的名字?</option>
<option value="我母亲的生日?">我母亲的生日?</option>
<option value="我父亲的生日?">我父亲的生日?</option>
<option value="我的小学校名?">我的小学校名?</option>
<option value="我小学班主任名字?">我小学班主任名字?</option>
<option value="我爱人的名字?">我爱人的名字?</option>
<option value="对我一生影响最大的人?">对我一生影响最大的人?</option>
<option value="0">自定义问题!</option>
</select>
                </td>
            </tr>
			
			<tr id="form1_0" style="display:none">
                <td class="table5_left" style="width: 25%;" >
                    自定义问题：
                </td>
                <td class="tdleft">
                 <input name="problem1" type="text" id="problem1"  style="border:1px #CCCCCC solid; padding:3px;">
                </td>
            </tr>
			
			<tr>
                <td class="table5_left" style="width: 25%">
                    回答问题：
                </td>
                <td class="tdleft">
                 <input name="answer1" type="text" id="answer1"  style="border:1px #CCCCCC solid; padding:3px;">
                </td>
            </tr>
			
			<tr>
                <td class="table5_left" style="width: 25%">
                    密保选项：
                </td>
                <td class="tdleft">
				<div id="form2_1" style="height:0; width:0px; float:left;"></div>
                <script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}
//]]>
</script>
<select name="problem" id="problem"  onchange="switchView1(this.value)">
<option value="" selected="selected">请选择</option>
<option value="我父亲的名字?">我父亲的名字?</option>
<option value="我母亲的名字?">我母亲的名字?</option>
<option value="我母亲的生日?">我母亲的生日?</option>
<option value="我父亲的生日?">我父亲的生日?</option>
<option value="我的小学校名?">我的小学校名?</option>
<option value="我小学班主任名字?">我小学班主任名字?</option>
<option value="我爱人的名字?">我爱人的名字?</option>
<option value="对我一生影响最大的人?">对我一生影响最大的人?</option>
<option value="0">自定义问题!</option>
</select>
                </td>
            </tr>
			
			<tr id="form2_0"  style="display:none">
                <td class="table5_left" style="width: 25%; ">
                    自定义问题：
                </td>
                <td class="tdleft">
                <input name="problem3" type="text" id="problem3"  style="border:1px #CCCCCC solid; padding:3px;">
                </td>
            </tr>
			
			<tr>
                <td class="table5_left" style="width: 25%;">
                    回答问题：
                </td>
                <td class="tdleft">
               <input name="answer2" type="text" id="answer2"  style="border:1px #CCCCCC solid; padding:3px;">
                </td>
            </tr>
           
            <tr>
                <td>
                </td>
                <td class="tdleft">
				<input name="提交" type="submit" value="确认提交"   class="input_d" />
                    
					 
                </td>
            </tr>
        </tbody></table>
		
</form>
<?php }elseif ($Action=='mibaosave'){############################密保保存
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
if ($_REQUEST['problem']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['problem']=='0' and $_REQUEST['problem1']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['answer1']==''){
echo "<script>alert('对不起，问题回答不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['problem2']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['problem2']=='0' and $_REQUEST['problem3']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['answer2']==''){
echo "<script>alert('对不起，问题回答不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['problem']=='0'){
$question1=strip_tags($_POST['problem1']);
}else{
$question1=strip_tags($_POST['problem']);
}
if ($_REQUEST['problem2']=='0'){
$question2=strip_tags($_POST['problem3']);
}else{
$question2=strip_tags($_POST['problem2']);
}

$answer1=strip_tags($_POST['answer1']);
$answer2=strip_tags($_POST['answer2']);

if ($_SESSION['yx_token']!=$_POST['Token']){header('location:/404.php');exit();}

mysql_query("insert into `Encrypted_problem` (username,members,question1,answer1,question2,answer2,time) " .
"values ('$_SESSION[account]','$_SESSION[ysk_number]','$question1','$answer1','$question2','$answer2','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='提交成功!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif($Action=='mibaoedit'){
$sql="select * from Encrypted_problem where username='$_SESSION[account]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="safeLevel.php?Action=mibaoedit1" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table5" style="margin: 0;width: 100%">
<tbody>
<tr>
<td class="table5_left" style="width: 25%;">密保问题：</td>
<td class="tdleft"><?=$row['question1']?></td>
</tr>
<tr>
<td class="table5_left" style="width: 25%;">问题回答：</td>
<td class="tdleft"><?=substr($row['answer1'],0,1);?>******</td>
</tr>
<tr>
<td class="table5_left" style="width: 25%;">密保问题：</td>
<td class="tdleft"><?=$row['question2']?></td>
</tr>
<tr>
<td class="table5_left" style="width: 25%;">问题回答：</td>
<td class="tdleft"><?=substr($row['answer2'],0,1);?>******</td>
</tr>
<tr>
<td class="table5_left" style="width: 25%;"></td>
<td class="tdleft"><input name="提交" type="submit" value="更改密保"  class="input_d" /></td>
</tr>
</tbody>
</table>
</form>
<?php }elseif($Action=='mibaoedit1'){
$sql="select * from Encrypted_problem where username='$_SESSION[account]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);?>
<form action="safeLevel.php?Action=mibaoedit2" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table5" style="margin: 0;width: 100%">
<tbody>
<tr>
<td class="table5_left" style="width: 25%;">密保问题：</td>
<td class="td_left"><select name="Encrypted" id="Encrypted">
<option value="<?=$row['answer1']?>"><?=$row['question1']?></option>
<option value="<?=$row['answer2']?>"><?=$row['question2']?></option>
</select></td>
</tr>
<tr>
<td class="table5_left" style="width: 25%;">问题回答：</td>
<td class="td_left"><input name="answer" type="text" id="answer"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>

<tr>
<td class="table5_left" style="width: 25%;"></td>
<td class="td_left"><input name="提交" type="submit" value="确认提交"  class="input_d" /></td>
</tr>
</tbody>
</table>
</form>
<?php }elseif ($Action=='mibaoedit2'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($_REQUEST['Encrypted']!=$_REQUEST['answer']){
echo "<script>alert('对不起，回答错误!');window.location='safeLevel.php?Action=mibaoedit1';</script>";
exit();
}
?>
<form action="safeLevel.php?Action=mibaoeditsave" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td width="14%" height="32" class="td_left">密保选项：</td>
<td width="86%">
<div id="form1_1" style="height:0; width:0px; float:left;"></div>
<script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}
//]]>
</script>
<select name="problem" id="problem"  onchange="switchView1(this.value)">
<option value="" selected="selected">请选择</option>
<option value="我父亲的名字?">我父亲的名字?</option>
<option value="我母亲的名字?">我母亲的名字?</option>
<option value="我母亲的生日?">我母亲的生日?</option>
<option value="我父亲的生日?">我父亲的生日?</option>
<option value="我的小学校名?">我的小学校名?</option>
<option value="我小学班主任名字?">我小学班主任名字?</option>
<option value="我爱人的名字?">我爱人的名字?</option>
<option value="对我一生影响最大的人?">对我一生影响最大的人?</option>
<option value="0">自定义问题!</option>
</select></td>
</tr>

<tr id="form1_0"  style="display:none" >
<td height="32" class="td_left">自定义问题：</td>
<td><input name="problem1" type="text" id="problem1"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td height="32" class="td_left">回答问题：</td>
<td><input name="answer1" type="text" id="answer1"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">密保选项：</td>
<td width="86%">
<div id="form2_1" style="height:0; width:0px; float:left;"></div>
<script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView2(vv){
document.getElementById('form2_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form2_'+vv).style.display = '';//显示选择的.
ss = vv;
}

//]]>
</script>
<select name="problem2" id="problem2"  onchange="switchView2(this.value)">
<option value="" selected="selected">请选择</option>
<option value="我父亲的名字?">我父亲的名字?</option>
<option value="我母亲的名字?">我母亲的名字?</option>
<option value="我母亲的生日?">我母亲的生日?</option>
<option value="我父亲的生日?">我父亲的生日?</option>
<option value="我的小学校名?">我的小学校名?</option>
<option value="我小学班主任名字?">我小学班主任名字?</option>
<option value="我爱人的名字?">我爱人的名字?</option>
<option value="对我一生影响最大的人?">对我一生影响最大的人?</option>
<option value="0">自定义问题!</option>
</select></td>
</tr>

<tr id="form2_0"  style="display:none" >
<td height="32" class="td_left">自定义问题：</td>
<td><input name="problem3" type="text" id="problem3"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td height="32" class="td_left">回答问题：</td>
<td><input name="answer2" type="text" id="answer2"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
  <td height="32" class="td_left">&nbsp;</td>
  <td><input name="提交" type="submit" value="确认提交"  class="button_buy" /></td>
</tr>
</table>
</form>
<?php
############################密保更改保存
}elseif ($Action=='mibaoeditsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}


if ($_REQUEST['problem']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['problem']=='0' and $_REQUEST['problem1']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['answer1']==''){
echo "<script>alert('对不起，问题回答不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}
if ($_REQUEST['problem2']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['problem2']=='0' and $_REQUEST['problem3']==''){
echo "<script>alert('对不起，密保问题不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['answer2']==''){
echo "<script>alert('对不起，问题回答不能为空 !');window.location='safeLevel.php?Action=mibao';</script>";
exit();
}

if ($_REQUEST['problem']=='0'){
$question1=strip_tags($_POST['problem1']);
}else{
$question1=strip_tags($_POST['problem']);
}
if ($_REQUEST['problem2']=='0'){
$question2=strip_tags($_POST['problem3']);
}else{
$question2=strip_tags($_POST['problem2']);
}
$answer1=strip_tags($_POST['answer1']);
$answer2=strip_tags($_POST['answer2']);

mysql_query("update Encrypted_problem set question1='$question1',question2='$question2',answer1='$answer1',answer2='$answer2' where username='$_SESSION[account]'",$conn1); 

echo "<br><br><br><br><center><input id='btnAll' type='button' value='修改成功!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif($Action=='jymm'){?>
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
<table cellspacing="1" cellpadding="3" class="table1">
<tr>
<td class="table1_left">
当前状态：</td>
<td class="tdleft">
<span  class="sm_on">已启用交易密码</span></td>
</tr>
<tr>
<td  class="table1_left" style="width: 25%">
原交易密码：</td>
<td class="tdleft">
<input name="password" type="password" value="" id="password" class="biankuan">
</td>
</tr>

<tr>
<td  class="table1_left" style="width: 25%">
新交易密码：</td>
<td class="tdleft">
<input name="password1" type="password" value="" id="password1" class="biankuan">
</td>
</tr>

<tr>
<td  class="table1_left" style="width: 25%">
确认新登录密码：</td>
<td class="tdleft">
<input name="password2" type="password" value="" id="password2" class="biankuan">
</td>
</tr>
<tr>
<td class="table1_left">
验证操作：</td>
<td class="tdleft">
<table id="radlIsTradePassword" border="0">
<tr>
<td><input id="mm" type="radio" name="mm" value="1" checked="checked" /><u class="green">启用交易密码</u></td><td><input id="mm" type="radio" name="mm" value="0" disabled="disabled" ><u class="red">取消交易密码</u></span></td>
</tr>
</table></td>
</tr>

<tr>
<td></td>
<td class="tdleft"><input type="submit" value="确认设置" class="tijiao_input" onClick="return checkuserinfo();" name="submit"  />
  <input id="Button1" type="button" value="返回" class="fanhui_input" onClick="cl();" /></td>
</tr>
</table>
</form>
<?php }elseif($Action=='jysave') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_us['passwords']!=md5($_POST['password'])){
echo "<script>alert('对不起，您的交易密码不正确！');self.location=document.referrer;</script>";
exit();
}

$passwords=md5($_POST['password1']);

mysql_query("update members set passwords='$passwords'  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><center><img src='/Public/images/biaoqing/007.png' /><br><input id='btnAll' type='button' value='修改成功!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif($Action=='mibaoka'){?>
<form action="safeLevel.php?Action=mibaokasave" method="post" name="myform">
<input name="Token" type="hidden" value="<?=genToken()?>">

<table cellspacing="1" cellpadding="2" class="table5" style="margin: 0;width: 100%">
<tbody><tr>
                <td class="table5_left" style="width: 25%">
                    购买价格：
                </td>
                <td class="tdleft">
                    <?=number_format($Ecard_price,3);?>
                </td>
            </tr>
           
            <tr>
                <td>
                </td>
                <td class="tdleft">
                    <input type="submit" name="btnSubmit" value="确认购买" id="btnSubmit" onClick="return checkuserinfo();" class="input_d"> 
                </td>
            </tr>
        </tbody></table>
</form>
<?php  }elseif ($Action=='mibaokasave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_sup['kuan']-$moprice2<0){
echo "<script>alert('对不起购买失败，SUP余额不足 !');window.location='safeLevel.php?Action=mibaoka';</script>";
exit();
}
if ($yx_us['kuan']-$Ecard_price<0){
echo "<script>alert('对不起购买失败，您的余额不足 !');window.location='safeLevel.php?Action=mibaoka';</script>";
exit();
}
$afters=$yx_us['kuan']-$Ecard_price;
$kuan_s=$yx_sup['kuan']-$moprice2;

$zong1=preg_match("/^\d*$/",(int)$moprice2);
$zong2=preg_match("/^\d*$/",(int)$Ecard_price);
$zong3=preg_match("/^\d*$/",(int)$afters);
$zong4=preg_match("/^\d*$/",(int)$kuan_s);

if ($zong1==0 || $zong2==0 || $zong3==0 || $zong4==0){
header('location:/user/sorry.php?err=2');
exit();
}


###############---------------------------------------------------------------------------更新购买会员的资金明细
mysql_query("insert into `details_funds` set title='购买密保卡',orderid='$dingdanhao',spendings='$Ecard_price',befores='$yx_us[kuan]',afters='$afters',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$afters',zong_kuan=zong_kuan+$Ecard_price where number='$_SESSION[ysk_number]'",$conn1); 
###############---------------------------------------------------------------------------更新购买会员的资金明细 The End

###############---------------------------------------------------------------------------更新主站资金明细
mysql_query("insert into `sup_details_funds` set title='编号：$_SESSION[ysk_number] 的会员购买密保卡',orderid='$dingdanhao',spendings='$moprice2',befores='$yx_sup[kuan]',afters='$kuan_s',number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$moprice2 where number='$yx_sup[number]'",$conn2); 
###############---------------------------------------------------------------------------更新主站资金明细 The End
header('location:card/ka.php');
}elseif($Action=='wsmbk'){
$mysql="select * from Encrypted_card where username='$_SESSION[ysk_number]'";   //读取数据表
$myzyc=mysql_query($mysql,$conn1);  //执行该SQl语句
$myrow=mysql_fetch_array($myzyc);
?>
<form action="safeLevel.php?Action=wsmbksave" method="post" name="myform">
<input name="Token" type="hidden" value="<?=genToken()?>">


<table cellspacing="1" cellpadding="2" class="table5" style="margin: 0;width: 100%">
<tbody>
<tr>
                <td class="table5_left" style="width: 25%">
                    是否绑定：
                </td>
                <td class="tdleft">
                  <select name="power12" id="power12">
<option value="1" <?php if ($row['power2']=='1') {?> selected="selected"<?php } ?>>是</option>
<option value="0" <?php if ($row['power2']=='0') {?> selected="selected"<?php } ?>>否</option>
</select>
                </td>
            </tr>
			
			<tr>
                <td class="table5_left" style="width: 25%">
                    密保卡查看：
                </td>
                <td class="tdleft">
                 <a href="card/<?=$myrow['url']?>" target="_blank">点击查看</a>
                </td>
            </tr>
           
            <tr>
                <td>
                </td>
                <td class="tdleft">
                    <input type="submit" name="btnSubmit" value="确认更改" id="btnSubmit" onClick="return checkuserinfo2();" class="input_d"> 
					 
                </td>
            </tr>
        </tbody></table>
		
	 
</form>
<?php }elseif ($Action=='wsmbksave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
if ($_REQUEST['power2']==0){
$sql=mysql_query("select * from Encrypted_card where username='$_SESSION[ysk_number]'",$conn1);
$row=mysql_fetch_array($sql);
unlink($row['url']); //删除图片文件
mysql_query("delete from Encrypted_card where username ='$_SESSION[ysk_number]'",$conn1); 
mysql_query("update members set power2='0' where number='$_SESSION[ysk_number]'",$conn1); 
}
echo "<br><br><br><br><center><input id='btnAll' type='button' value='提交成功!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif($Action=='souyun'){?>
<form action="safeLevel.php?Action=souyunsave" method="post" name="myform">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td width="14%" height="32" class="td_left">购买价格：</td>
<td width="86%"><?=number_format($cloud_price,3);?> <?=$moneytype?></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">收货人：</td>
<td width="86%"><input name="title" type="text" id="title"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">联系电话：</td>
<td width="86%"><input name="phone" type="text" id="phone"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">收货地址：</td>
<td width="86%"><input name="address" type="text" id="address"  style="border:1px #CCCCCC solid; padding:3px; width:300px;" placeholder="具体到门牌号" > </td>
</tr>
<tr>
<td width="14%" height="32" class="td_left"></td>
<td width="86%"><input name="提交" type="submit" value="确认购买"  class="button_buy" onClick="return checkuserinfo2();" /></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='souyunsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
echo "<script>alert('对不起购买失败，该功能暂未开放!');window.location='safeLevel.php?Action=souyun';</script >";
exit();

###########################多云令购买
if ($yx_sup['kuan']-$moprice2<0){
echo "<script>alert('对不起购买失败，SUP余额不足 !');window.location='safeLevel.php?Action=souyun';</script>";
exit();
}
if ($yx_us['kuan']-$cloud_price<0){
echo "<script>alert('对不起购买失败，您的余额不足 !');window.location='safeLevel.php?Action=souyun';</script>";
exit();
}

$afters=$yx_us['kuan']-$cloud_price;
$kuan_s=$yx_sup['kuan']-$moprice1;

###############---------------------------------------------------------------------------更新购买会员的资金明细
mysql_query("insert into `details_funds` set title='购买多云令',orderid='$dingdanhao',spendings='$cloud_price',befores='$yx_us[kuan]',afters='$afters',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$afters',zong_kuan=zong_kuan+$cloud_price where number='$_SESSION[ysk_number]'",$conn1); 
###############---------------------------------------------------------------------------更新购买会员的资金明细 The End

###############---------------------------------------------------------------------------更新主站资金明细
mysql_query("insert into `sup_details_funds` set title='编号：$_SESSION[ysk_number] 的会员购买搜云令',orderid='$dingdanhao',spendings='$moprice1',befores='$yx_sup[kuan]',afters='$kuan_s',number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$moprice1 where number='$yx_sup[number]'",$conn2); 
###############---------------------------------------------------------------------------更新主站资金明细 The End


mysql_query("insert into `sup_buy_goods` set type='多云令',username='$sup_number',title='$_REQUEST[title]',phone='$_REQUEST[phone]',address='$_REQUEST[address]',price1='$cloud_price',price2='$moprice1',time='$begtime'",$conn2);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='购买成功!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif($Action=='gemail'){?>
<div style="padding:10px;">
<form action="safeLevel.php?Action=gemailsave" method="post" name="myform">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td width="14%" height="32" class="td_left">原邮箱地址：</td>
<td width="86%"><input name="email1" type="text" id="email1"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">新邮箱地址：</td>
<td width="86%"><input name="email" type="text" id="email"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>

<tr>
<td width="14%" height="32" class="td_left"></td>
<td width="86%"><input name="提交" type="submit" value="确认验证"  class="button_buy" onClick="return checkuserinfo2();" /></td>
</tr>
</table>
</form>
</div>
<?php
}elseif ($Action=='gemailsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
if ($_REQUEST['email']==''){
echo "<script>alert('对不起，邮箱地址不能为空!');window.location='safeLevel.php?Action=gemail';</script>";
exit();
}

if ($yx_us['email']!=$_REQUEST['email1']){
echo "<script>alert('对不起，原邮箱输入错误!');window.location='safeLevel.php?Action=gemail';</script>";
exit();
}

$email=strip_tags(inject_check($_POST['email']));

mysql_query("update members set email='$email',power12='1' where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><br><br><br><center>修改成功！<br><br> <input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";


}

if ($Action=='card'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}




	/////////////////////////////////////////调用上传文件组件
include('../jhs_config/upload_class.php');
if ($uploadnames==''){
echo "<script>alert('对不起，您还没有上传资料！');;self.location=document.referrer;</script>";
exit();	
}

mysql_query("update members set card_pic='$uploadnames',card_lock='0' where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('提交成功，请等待客服审核 !');window.location='SafeLevel.php';</script>";
exit();
}?>
</body>
</Html>
<script language="javascript">
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>

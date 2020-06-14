
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome to</title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
if ($_REQUEST['sid']!=''){
$sid=inject_check($_REQUEST['sid']);
$result=mysql_query("select * from  sms  where id='$sid'",$conn1);
$row=mysql_fetch_array($result);
mysql_query("update sms set locks='0'  where id='$sid'",$conn1); 
$_SESSION['my_lock_id']='';
?>
<div style="padding:10px; line-height:240%;">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td width="14%" height="24" class="td_left">发 信 人：</td>
<td width="86%"><?=$row['sendname']?>
</tr>
<tr>
<td width="14%" height="24" class="td_left">短信标题：</td>
<td width="86%"><?=$row['title']?>
</tr>
<tr>
<td width="14%" class="td_left">短信内容：</td>
<td width="86%" style="line-height:240%;"><?=$row['content']?>
</tr>
<tr>
<td width="14%" height="24" class="td_left">发送时间：</td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
</tr>
</table>
<div style="padding-top:10px;">
<center><img src="images/icon_col.gif" onClick="cl()" style="cursor:pointer"></center>
</div>
</div>
<?php mysql_free_result($result);
}elseif ($_REQUEST['id']!=''){
$sid=inject_check($_REQUEST['id']);
$_SESSION['my_gg_id']='';
$_SESSION['Platform_announcement']='';
?>
<div style="padding:10px; line-height:240%;">
<?=$login_prompt?>
<div style="padding-top:10px;">
<center><img src="images/icon_col.gif" onClick="cl()" style="cursor:pointer"></center>
</div>
</div>
<?php }?>
</body>
</Html>
<script>
function cl()
{ 
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
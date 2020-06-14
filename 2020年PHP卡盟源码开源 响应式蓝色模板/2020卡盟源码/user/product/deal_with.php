<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/user_check.php');
$Action=strip_tags($_GET['Action']);
$_SESSION['yDel']='';


///////////////////////////////////////////////////////////商品暂停
if ($Action=='stopsave'){
$content=strip_tags($_POST['content']);
foreach($_SESSION['allArray'] as $value){
mysql_query("update product set state='1',reason='$content' where id='$value'",$conn1);
}
echo "<br><br><br><center><input id='btnAll' type='button' value='处理成功!'  onClick='cl()' class='tijiao_input' /></center>";

///////////////////////////////////////////////////////////商品定价
}elseif ($Action=='pricingsave'){
$pricing=strip_tags($_POST['pricing']);
////-----------------------------判断是否异常
$total=mysql_num_rows(mysql_query("select * from `price_modl` where username='$_SESSION[ysk_number]' and id='$pricing'",$conn1));

if ($total==0){
echo "<script>alert('对不起，您没有选择价格模板！');self.location=document.referrer;</script>";
exit();	
}

//-------------------------------读取数据
$sql=mysql_query("select * from price_modl where username='$_SESSION[ysk_number]' and id='$pricing' ",$conn1);
$row=mysql_fetch_array($sql);
foreach($_SESSION['allArray'] as $value){
mysql_query("update product set pricing='$row[type]',rate='$row[price]' where id='$value'",$conn1);
}

echo "<br><br><br><center><input id='btnAll' type='button' value='处理成功!'  onClick='cl()' class='tijiao_input' /></center>";
}




?>

<?php if($Action=='stop') {?>
<form action="?Action=stopsave" method="post" name="userinfo">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">暂停原因：</td>
<td class="left"><textarea name="content" cols="40" rows="5" id="content" class="biankuan"></textarea>
</td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  /></td>
</tr>
</table>
</form>
<?php }elseif($Action=='pricing'){?>
<form action="?Action=pricingsave" method="post" name="userinfo">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="26%" class="td_left">选择定价模板：</td>
<td width="74%" class="left">
<select name="pricing" id="pricing">
<?php 
$results=mysql_query("select * from price_modl where username='$_SESSION[ysk_number]'  order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['id']?>"><?=$type['title']?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  /></td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function cl(){
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}

function checkmove(){
if(checkspace(document.move.nid.value)) {
document.move.nid.focus();
alert("对不起，参考商品编号不能为空！");
return false;
}
}

function checkuserinfo(){
if(checkspace(document.userinfo.content.value)) {
document.userinfo.content.focus();
alert("对不起，原因不能为空！");
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image3').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url3').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url3').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image4').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url4').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url4').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image5').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url5').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url5').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image6').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url6').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url6').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image7').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url7').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url7').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image8').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url8').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url8').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image9').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url9').val(),
clickFn : function(url, title, width, height, border, align) {
K('#ur19').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$sql=mysql_query("select * from site_config  where id='1'",$conn1);
$row=mysql_fetch_array($sql);

$st_sql="select * from sup_members_site where number='$sup_number'";   //读取数据表
$st_zyc=mysql_query($st_sql,$conn2);  //执行该SQl语句
$st_row=mysql_fetch_array($st_zyc);
if ($Action=="save"){
$bluewhite1=$_POST['bluewhite1'];
$bluewhite2=$_POST['bluewhite2'];
$bluewhite3=$_POST['bluewhite3'];
$bluewhite4=$_POST['bluewhite4'];
$bluewhite5=$_POST['bluewhite5'];
$bluewhite6=$_POST['bluewhite6'];
$bluewhite7=$_POST['bluewhite7'];
$bluewhite8=$_POST['bluewhite8'];
$bluewhite9=$_POST['bluewhite9'];
$bluewhite10=$_POST['bluewhite10'];
$bluewhite11=$_POST['bluewhite11'];
$bluewhite12=$_POST['bluewhite12'];
$bluewhite13=$_POST['bluewhite13'];
$bluewhite14=$_POST['bluewhite14'];
$bluewhite15=$_POST['bluewhite15'];
$bluewhite16=$_POST['bluewhite16'];
$bluewhite17=$_POST['bluewhite17'];
$bluewhite18=$_POST['bluewhite18'];
$bluewhite19=$_POST['bluewhite19'];


mysql_query("update site_config set bluewhite1='$bluewhite1',bluewhite2='$bluewhite2',bluewhite3='$bluewhite3',bluewhite4='$bluewhite4',bluewhite5='$bluewhite5',bluewhite6='$bluewhite6',bluewhite7='$bluewhite7',bluewhite8='$bluewhite8',bluewhite9='$bluewhite9',bluewhite10='$bluewhite10',bluewhite11='$bluewhite11',bluewhite12='$bluewhite12',bluewhite13='$bluewhite13',bluewhite14='$bluewhite14',bluewhite15='$bluewhite15',bluewhite16='$bluewhite16',bluewhite17='$bluewhite17',bluewhite18='$bluewhite18',bluewhite19='$bluewhite19'' where id=1",$conn1); 

echo "<script>alert('修改成功!');self.location=document.referrer;</script>";
}

?>
<form name="add" method="post" action="?Action=save&id=1" >
<table class="page_table" cellpadding="0" cellspacing="1">
<tr><td colspan="2" class="table_top" style="text-align: left;">模版数据设置</td></tr>
<tr>
<td width="10%" class="td_left">模版实例：</td>
<td width="90%" class="left"> <a href="http://www.juheshe.cnuser/juheshe02.png" target="_blank">点我打开示例图像</td>
</tr>	
<tr>
<td width="10%" class="td_left">模板头部标题：</td>
<td width="90%" class="left"><input name="bluewhite1" type="text" style="width:350px;" value="<?=$row['bluewhite1']?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">模板头部标题文字1：</td>
<td width="90%" class="left"><input name="bluewhite2" type="text" style="width:350px;" value="<?=$row['bluewhite2']?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">模板头部标题文字2：</td>
<td width="90%" class="left"><input name="bluewhite3" type="text" style="width:350px;" value="<?=$row['bluewhite3']?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left"></td>
<td width="90%" class="left">模板中部数据</td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部标题：</td>
<td width="90%" class="left"><input name="bluewhite4" type="text" style="width:350px;" value="<?=$row['bluewhite4']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部标题下文字：</td>
<td width="90%" class="left"><textarea cols="70" rows="7" name="bluewhite5" class="biankuan" class="biankuan" /><?=$row['bluewhite5']?></textarea></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第一张图片：</td>
<td width="90%" class="left"><input name="bluewhite6" type="text" style="width:350px;" id="url5" value="<?=$row['bluewhite6']?>" class="biankuan" /><input type="button" id="image5" value="选择图片" class="tijiao_input"></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第二张图片：</td>
<td width="90%" class="left"><input name="bluewhite7" type="text" style="width:350px;" id="url6" value="<?=$row['bluewhite7']?>" class="biankuan" /><input type="button" id="image6" value="选择图片" class="tijiao_input"></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第三张图片：</td>
<td width="90%" class="left"><input name="bluewhite8" type="text" style="width:350px;" id="url7" value="<?=$row['bluewhite8']?>" class="biankuan" /><input type="button" id="image7" value="选择图片" class="tijiao_input"></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第四张图片：</td>
<td width="90%" class="left"><input name="bluewhite9" type="text" style="width:350px;" id="url8" value="<?=$row['bluewhite9']?>" class="biankuan" /><input type="button" id="image8" value="选择图片" class="tijiao_input"></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第一段文字标题：</td>
<td width="90%" class="left"><input name="bluewhite10" type="text" style="width:350px;"  value="<?=$row['bluewhite10']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第二段文字标题：</td>
<td width="90%" class="left"><input name="bluewhite11" type="text" style="width:350px;"  value="<?=$row['bluewhite11']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第三段文字标题：</td>
<td width="90%" class="left"><input name="bluewhite12" type="text" style="width:350px;"  value="<?=$row['bluewhite12']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第四段文字标题：</td>
<td width="90%" class="left"><input name="bluewhite13" type="text" style="width:350px;"  value="<?=$row['bluewhite13']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第一段文字：</td>
<td width="90%" class="left"><input name="bluewhite14" type="text" style="width:350px;"  value="<?=$row['bluewhite14']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第二段文字：</td>
<td width="90%" class="left"><input name="bluewhite15" type="text" style="width:350px;"  value="<?=$row['bluewhite15']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第三段文字：</td>
<td width="90%" class="left"><input name="bluewhite16" type="text" style="width:350px;"  value="<?=$row['bluewhite16']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板中部第四段文字：</td>
<td width="90%" class="left"><input name="bluewhite17" type="text" style="width:350px;"  value="<?=$row['bluewhite17']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left"></td>
<td width="90%" class="left">模板底部数据</td>
</tr>
<tr>
<td width="10%" class="td_left">模板底部联系邮箱：</td>
<td width="90%" class="left"><input name="bluewhite18" type="text" style="width:350px;"  value="<?=$row['bluewhite18']?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">模板底部蓝色栏文字：</td>
<td width="90%" class="left"><input name="bluewhite19" type="text" style="width:350px;"  value="<?=$row['bluewhite19']?>" class="biankuan" /></td>
</tr>

<tr>
<td></td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"></td>
</tr>
</table>
</form>
</body>
</Html>
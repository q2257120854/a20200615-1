
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
////////添加记录
if ($Action=="Addsave"){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$title=strip_tags($_POST['title']);
$address=strip_tags($_POST['address']);
$url=strip_tags($_POST['url']);
$content=strip_tags($_POST['content']);
mysql_query("insert into `advertising`(title,address,url,content,begtime) "."values ('$title','$address','$url','$content','$begtime')",$conn1);
echo "<script>alert('添加成功!');window.location='?Action=add';</script>";
}

////////修改记录
if ($Action=="editsave") {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

$title=strip_tags($_POST['title']);
$address=strip_tags($_POST['address']);
$url=strip_tags($_POST['url']);
$content=strip_tags($_POST['content']);

$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];
if ($y1<>$address){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统广告 "'.$y2.'" 的图片地址');}
if ($y2<>$title){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统广告 "'.$y2.'" 的图片名称');}
if ($y3<>$url){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统广告 "'.$y2.'" 图片链接地址');}
if ($y4<>$content){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统广告 "'.$y2.'" 图片备注说明');}

mysql_query("update advertising set title='$title',address='$address',url='$url',content='$content'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<link href="/Public/yoxi_editor/themes/default/default.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>

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
</head>
<body>
<?php
If  ($Action=="List" or $Action==""){
?>

<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="4%" height="32" align="center" class="table_top">ID</td>
<td align="center" class="table_top">图片名称</td>
<td align="center" class="table_top">链接地址</td>
<td width="14%" align="center" class="table_top">时间</td>
<td width="11%" align="center" class="table_top">操作</td>
</tr>
<?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `advertising` ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from advertising  order by begtime desc,id desc  {$page->limit}"; 


$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><?=$row[id]?></td>
<td align="left"><?=$row[1]?></td>
<td><?=$row[3]?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>">修改</a> <span style="display:none"><a href="?Action=del&Id=<?=$row[id]?>" onclick="Javascript:return confirm('确定要删除吗？');">删除</a> </span></td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="17%" align="left" style="padding-top:15px; padding-bottom:15px;">

<div style="display:none"><input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" onclick="Javascript:return confirm('确定要删除吗？');" class="x3_input" >
</div>
</td>
<td width="83%" style="text-align:right;"><div class="pager"><?=$page->paging();?></div>  </td>
</tr>
</table>
</form>

<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息添加</td>
</tr>

<tr>
<td  class="td_left">图片地址：</td>
<td><input name="address" type="text" id="url3" value="" class="biankuan" /> <input type="button" id="image3" value="选择图片" class="tijiao_input" /></td>
</tr>
<tr>
<td width="10%" class="td_left">图片名称：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">链接地址：</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" class="biankuan"   placeholder="如：http://www.baidu.com"/></td>
</tr>
<tr>
<td width="10%" class="td_left">备注说明：</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" id="content" class="biankuan"></textarea></td>
</tr>


<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from advertising where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row[id]?>">
<input name="y1" type="hidden" value="<?=$row['address']?>">
<input name="y2" type="hidden" value="<?=$row['title']?>">
<input name="y3" type="hidden" value="<?=$row['url']?>">
<input name="y4" type="hidden" value="<?=$row['content']?>">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息修改</td>
</tr>

<tr>
<td  class="td_left">图片地址：</td>
<td><input name="address" type="text" id="url3" value="<?=$row[address]?>" class="biankuan" /> <input type="button" id="image3" value="选择图片" class="tijiao_input" /></td>
</tr>
<tr>
<td width="10%" class="td_left">图片名称：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="<?=$row[title]?>" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">链接地址：</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" class="biankuan" value="<?=$row[url]?>"   placeholder="如：http://www.baidu.com"/></td>
</tr>
<tr>
<td width="10%" class="td_left">备注说明：</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" id="content" class="biankuan"><?=$row[content]?></textarea></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>

<script>

function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>
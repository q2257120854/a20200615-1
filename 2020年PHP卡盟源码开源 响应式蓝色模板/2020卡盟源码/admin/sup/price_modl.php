
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////添加记录
if ($Action=="Addsave") {
$total=mysql_num_rows(mysql_query("select * from `price_modl` where username='admin' ",$conn1));
if ($total>=10){echo "<br><br><br><br><center>对不起，操作失败！最多只能加10个哦！</center>";exit();}

$title=strip_tags($_POST['title']);
$type=get_check_price($_POST['type']);
$price=get_check_price($_POST['price']);
mysql_query("insert into `price_modl`(title,type,price,username,begtime) " ."values ('$title','$type','$price','admin','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='添加成功!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////修改记录
if ($Action=="editsave") {
$title=strip_tags($_POST['title']);
$type=get_check_price($_POST['type']);
$price=get_check_price($_POST['price']);
$Id=get_check_price($_POST['Id']);
mysql_query("update price_modl set title='$title',type='$type',price='$price'  where id='$Id'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";
exit();
}

////////删除单记录
if ($Action=="del") {
mysql_query("delete from price_modl where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
exit();
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from price_modl where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}
?>
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
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>
<div class="gn">
<input id="add" type="button" value="添加类型" class="tijiao_input" onclick="$.dialog.open('sup/price_modl.php?Action=add',{title:'模板添加',width: 600,height: 300,lock:true,fixed:true});" />
</div>

<div class="tishi1">

1、关于逐级增加百分比：比如进货价格是1000元 后面输入框输入“1”代表的是“1%”  也就是每级增加10元<br />
2、关于逐级增加固定值：比如进货价格是1000元 后面输入框输入“1”代表的是“1元” 也就是每级增加1元<br />
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="32%" class="table_top">模板名称</td>
<td width="23%" class="table_top">
类型
</td>
<td width="16%" class="table_top">
参数
</td>
<td width="20%" class="table_top">更新时间</td>
<td width="9%" class="table_top">
修改
</td>

</tr>
<?php
$Rss="SELECT * FROM price_modl   where username='admin' order by begtime desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['title']?></td>
<td><?php if ($Orzx['type']==1){echo "逐级增加百分比";}else{echo "逐级增加固定值";}?></td>
<td><?=$Orzx['price']?></td>
<td><?=date("Y-m-d G:i:s",$Orzx['begtime'])?></td>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a></td>
    <td><a class="a delete" href="?Action=del&Id=<?=$Orzx['id']?>"></a></td>
  </tr>
</table>


 </td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">模板名称：</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left">模板类型：</td>
<td>
<select name="type" id="type">
<option value="1">逐级增加百分比</option>
<option value="2">逐级增加固定值</option>
</select>
</td>
</tr>
<tr>
<td  class="td_left">定义参数：</td>
<td><input name="price" type="text" class="biankuan" style="width:50px;"> 请输入您要定价的数字 </td>
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
$sql="select * from price_modl where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input name="Id" type="hidden" value="<?=$_REQUEST['Id']?>" />

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">模板名称：</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/></td>
</tr>
<tr>
<td  class="td_left">模板类型：</td>
<td>
<select name="type" id="type">
<option value="1" <?php if ($row['type']==1){?> selected="selected"<?php } ?>>逐级增加百分比</option>
<option value="2" <?php if ($row['type']==2){?> selected="selected"<?php } ?>>逐级增加固定值</option>
</select>
</td>
</tr>


<tr>
<td  class="td_left">定义参数：</td>
<td><input name="price" type="text" class="biankuan" style="width:50px;"  value="<?=$row['price']?>"/></td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" />
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
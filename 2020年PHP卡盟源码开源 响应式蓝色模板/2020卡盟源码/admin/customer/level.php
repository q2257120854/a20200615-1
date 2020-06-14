
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
$total=mysql_num_rows(mysql_query("select * from `level` ",$conn1));
if ($total>=10){
echo "<br><br><br><br><center>对不起，操作失败！最多只能加10个哦！</center>";
exit();
}


$title=strip_tags($_POST['title']);
$type=strip_tags($_POST['type']);
$price=get_check_price($_POST['price']);

ysk_date_log(6,$_SESSION['ysk_username'],' 添加了一个名称是 "'.$title.'" 的会员级别');
mysql_query("insert into `level` (title,type,price,time) " ."values ('$title','$type','$price','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='添加成功!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////修改记录
if ($Action=="editsave") {
$title=strip_tags($_POST['title']);
$type=strip_tags($_POST['type']);
$price=get_check_price($_POST['price']);
$y1=strip_tags($_POST['y1']);
$y2=get_check_price($_POST['y2']);
$Id=get_check_price($_POST['Id']);
if ($y1<>$title){
ysk_date_log(6,$_SESSION['ysk_username'],' 将会员级别名称是 "'.$y1.'" 修改成了 "'.$title.'"');
}
if ($y2<>$price){
ysk_date_log(6,$_SESSION['ysk_username'],' 将会员级别名称是 "'.$title.'" 升级费用 "'.$y2.'" 元修改成了 "'.$price.'" 元');
}

mysql_query("update level set title='$title',type='$type',price='$price'  where id='$Id'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";
exit();
}

////////删除单记录
if ($Action=="del") {
mysql_query("delete from level where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
exit();
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from level where id in ($ID_Dele)",$conn1);
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
<input id="add" type="button" value="添加类型" class="tijiao_input" onclick="$.dialog.open('level.php?Action=add',{title:'客户级别添加',width: 600,height: 300,lock:true,fixed:true});" />
</div>

<div class="tishi1">
1、平台启用前请先定义好级别，日后最好不要再添加新的级别，如果需要增加新级别只能是比原有级别更低的级别；<br />
2、每个体系的级别建立请按低级-->高级的顺序添加，将最低级设置为注册后默认级别，比如经销体系中从一般经销商->高级经销商->区域总经销商；直销体系从一般直销商->高级直销商->优秀直销商；<br />
3、系统级别越多，定价工作越复杂，会增加你的日后工作量，所以级别适当适量即可；<br />
4、如果在商品已有定价后再添加的级别，必须为每个商品重新定价，输入新添加级别的销售价格；<br />
5、强烈建议大家将每个体系的级别控制在2-4个，如果相应体系中需要多级别管理，尤其是经销商这块，可以使用模板定价或密价的方式来拉开价格差；<br />
6、经销体系创建后不可删除。
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="25%" class="table_top">
级别名称
</td>
<td width="30%" class="table_top">
级别类型
</td><td width="15%" class="table_top">
图标
</td>
<td width="15%" class="table_top">升级价格</td>
<td width="15%" class="table_top">
修改
</td>

</tr>
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['title']?></td>
<td><?=$Orzx['type']?></td>
<td><img src="/Public/images/v<?=$Orzx['id']?>.png"></td>
<td><?=$Orzx['price']?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a> </td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">客户级别名称：</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left">级别体系选择：</td>
<td><select name="type" id="type">
<option value="经销体系" selected="selected">经销体系</option>
</select></td>
</tr>
<tr>
<td  class="td_left">升级价格：</td>
<td><input name="price" type="text" class="biankuan" style="width:150px;" /></td>
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
$sql="select * from level where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="y1" name="y1" type="hidden" value="<?=$row['title']?>">
<input id="y2" name="y2" type="hidden" value="<?=$row['price']?>">

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">客户级别名称：</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/></td>
</tr>
<tr>
<td  class="td_left">级别体系选择：</td>
<td><select name="type" id="type">
<option value="经销体系" <?php if ($row['type']=='经销体系'){?> selected="selected"<?php } ?>>经销体系</option>
</select></td>
</tr>
<tr>
<td  class="td_left">升级价格：</td>
<td><input name="price" type="text" class="biankuan" style="width:150px;"  value="<?=$row['price']?>"/></td>
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
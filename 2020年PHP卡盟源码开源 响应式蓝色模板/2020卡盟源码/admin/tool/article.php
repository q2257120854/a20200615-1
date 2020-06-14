
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
$keywords=strip_tags($_GET['keywords']);

////////添加记录
if ($Action=="Addsave") {
$title=$_POST['title'];             //信息标题
$color=$_POST['color'];             //标题颜色
$content=$_POST['content'];         //信息内容
$menu=$_POST['menu'];               //信息栏目
$begtime=$_POST['begtime'];       //发布日期
$source=$_SESSION['ysk_username'];       //来源
$hiddens=$_POST['hiddens'];       //来源
ysk_date_log(6,$_SESSION['ysk_username'],'新增了名称为"'.$title.'" 的文章信息');
mysql_query("insert into article (title,color,menu,source,content,begtime,hiddens) " . "values ('$title','$color','$menu','$source','$content','$begtime','$hiddens')",$conn1);
echo "<script>alert('添加成功!');self.location=document.referrer;</script>";
}


if ($Action=='hiddens'){
mysql_query("update article set hiddens='$_REQUEST[sid]' where id='$_REQUEST[Id]'",$conn1); 
echo "<script>alert('操作成功!');self.location=document.referrer;</script>";
}

////////修改记录
if ($Action=="editsave") {
$title=$_POST['title'];             //信息标题
$color=$_POST['color'];             //标题颜色
$content=$_POST['content'];         //信息内容
$source=$_SESSION['ysk_username'];  //来源
$menu=$_POST['menu'];               //信息栏目
$hiddens=$_POST['hiddens'];         //信息隐藏
$begtime=$_POST['begtime'];         //信息时间

$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];
$y5=$_POST['y5'];
if ($y1<>$title){ysk_date_log(6,$_SESSION['ysk_username'],'修改了文章信息 "'.$y1.'" 的标题');}
if ($y2<>$color){ysk_date_log(6,$_SESSION['ysk_username'],'修改了文章信息 "'.$y1.'" 的标题颜色');}
if ($y3<>$menu){ysk_date_log(6,$_SESSION['ysk_username'],'修改了文章信息 "'.$y1.'" 的信息分类');}
if ($y4<>$content){ysk_date_log(6,$_SESSION['ysk_username'],'修改了文章信息 "'.$y1.'" 的信息内容');}
if ($y5<>$begtime){ysk_date_log(6,$_SESSION['ysk_username'],'修改了文章信息 "'.$y1.'" 的信息内容');}

mysql_query("update article set title='$title',color='$color',content='$content',menu='$menu',hiddens='$hiddens' where id='$_POST[Id]'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";

}

////////删除单记录
if ($Action=="del") {
ysk_date_log(6,$_SESSION['ysk_username'],'删除了一条文章信息');
mysql_query("delete from article where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
ysk_date_log(6,$_SESSION['ysk_username'],'删除了一些文章信息');
mysql_query("delete from article where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor-min.js"></script>
<script>
KindEditor.ready(function(K) {
var colorpicker;
K('#colorpicker').bind('click', function(e) {
e.stopPropagation();
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
return;
}
var colorpickerPos = K('#colorpicker').pos();
colorpicker = K.colorpicker({
x : colorpickerPos.x,
y : colorpickerPos.y + K('#colorpicker').height(),
z : 19811214,
selectedColor : 'default',
noColor : '无颜色',
click : function(color) {
K('#color').val(color);
colorpicker.remove();
colorpicker = null;
}
});
});
K(document).click(function() {
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
}
});
});
</script>
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
</head>
<body>


<?php if ($Action=="List" or $Action==""){?>
<a href="?Action=add"><input type="submit" name="btnQuery" value="公告添加" id="btnQuery" class="chaxun_input" /></a>

<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="4%" height="32" align="center" class="table_top">ID</td>
<td width="37%" align="center" class="table_top">信息标题</td>
<td width="18%" align="center" class="table_top">所属类别</td>
<td width="14%" align="center" class="table_top">信息来源</td>
<td width="14%" align="center" class="table_top">发布时间</td>
<td width="13%" align="center" class="table_top">操作</td>
</tr>
<?php
$search="where 1=1 "; 

if ($keywords!='')  $search.=" and title like '%$keywords%' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `article`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from article  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="left"><span style="color:<?=$row['color']?>"><?=$row['title']?></span></td>
<td align="center"><?=$row['menu']?></td>
<td align="center"><?=$row['source']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center">
<?php if ($row['hiddens']=='1' or $row['hiddens']=='') {?>
<a href="?Action=hiddens&Id=<?=$row['id']?>&sid=0">显示</a>
<?php }else{?>
<a href="?Action=hiddens&Id=<?=$row['id']?>&sid=1"><span style="color:#FF0000">隐藏</span></a>
<?php }?>


<a href="?Action=edit&Id=<?=$row[id]?>">修改</a> <a href="?Action=del&Id=<?=$row[id]?>" onclick="Javascript:return confirm('确定要删除吗？');">删除</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="17%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" onclick="test()" class="x3_input" >

</td>
<td width="83%" style="text-align:center;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息添加</td>
</tr>
<tr>
<td width="10%" class="td_left">信息标题：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" />             <input name="color" type="text" id="color" value="" size="7" class="biankuan" /> 
 <input type="button" id="colorpicker" value="打开取色器" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left">发布时间：</td>
<td width="90%" class="left"><input name="begtime" type="text" style="width:350px;" value="<?php $now=mktime(); echo $now;?>" class="biankuan" /></td>
<tr>
<td width="10%" class="td_left"></td>
<td width="90%" class="left">Unix时间戳查询地址：http://tool.chinaz.com/Tools/unixtime.aspx</td>
</tr>
</tr>
<tr>
<td width="10%" class="td_left">信息分类：</td>
<td width="90%" class="left"><select name="menu" id="menu">
<option value="平台公告">平台公告</option>
<option value="帮助信息">帮助信息</option>
<option value="行业动态">行业动态</option>
<option value="新品及调价公告">新品及调价公告</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">信息状态：</td>
<td width="90%" class="left"><select name="hiddens" id="hiddens">
<option value="1" selected="selected">显示</option>
<option value="0">隐藏</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">内容描述：</td>
<td width="90%" class="left"><textarea id="editor_id" name="content" style="width:700px;height:300px;"></textarea></td>
</tr>	
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from article where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="y1" type="hidden" value="<?=$row['title']?>">
<input name="y2" type="hidden" value="<?=$row['color']?>">
<input name="y3" type="hidden" value="<?=$row['menu']?>">
<textarea name="y4" style=" display:none"><?=$row['content']?>
</textarea>
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息修改</td>
</tr>

<tr>
<td width="10%" class="td_left">信息标题：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="<?=$row['title']?>" class="biankuan" /> 
 <input name="color" type="text" id="color" value="<?=$row['color']?>" size="7" class="biankuan" /> 
   <input type="button" id="colorpicker" value="打开取色器" class="tijiao_input"/></td>
</tr>
<tr>
<tr>
<td width="10%" class="td_left">信息分类：</td>
<td width="90%" class="left"><select name="menu" id="menu">
<option value="平台公告" <?php if ($row['menu']=='平台公告'){?> selected="selected" <?php } ?>>平台公告</option>
<option value="帮助信息" <?php if ($row['menu']=='帮助信息'){?> selected="selected" <?php } ?>>帮助信息</option>
<option value="行业动态" <?php if ($row['menu']=='行业动态'){?> selected="selected" <?php } ?>>行业动态</option>
<option value="新品及调价公告" <?php if ($row['menu']=='新品及调价公告'){?> selected="selected" <?php } ?>>新品及调价公告</option>

</select></td>
</tr>
<tr>
<td width="10%" class="td_left">信息状态：</td>
<td width="90%" class="left"><select name="hiddens" id="hiddens">
<option value="1" <?php if ($row['hiddens']=='1'){?> selected="selected" <?php } ?>>显示</option>
<option value="0" <?php if ($row['hiddens']=='0'){?> selected="selected" <?php } ?>>隐藏</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">内容描述：</td>
<td width="90%" class="left"><textarea id="editor_id" name="content" style="width:700px;height:300px;"><?=$row['content']?></textarea></td>
</tr>	


<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</html>
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

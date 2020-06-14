<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
if ($Action=="Addsave") {

$title=strip_tags($_POST['title']);
$custom1=strip_tags($_POST['custom1']);
$type1=strip_tags($_POST['type1']);
if ($_POST['content1']!=""){
$content1=strip_tags($_POST['content1']);
}
if ($_POST['content1-1']!=""){
$content1=strip_tags($_POST['content1-1']);
}


$custom2=strip_tags($_POST['custom2']);
$type2=strip_tags($_POST['type2']);
if ($_POST['content2']!=""){
$content2=strip_tags($_POST['content2']);
}
if ($_POST['content2-1']!=""){
$content2=strip_tags($_POST['content2-1']);
}

$custom3=strip_tags($_POST['custom3']);
$type3=strip_tags($_POST['type3']);

if ($_POST['content3']!=""){
$content3=strip_tags($_POST['content3']);
}
if ($_POST['content3-1']!=""){
$content3=strip_tags($_POST['content3-1']);
}

$custom4=strip_tags($_POST['custom4']);
$type4=strip_tags($_POST['type4']);
if ($_POST['content4']!=""){
$content4=strip_tags($_POST['content4']);
}
if ($_POST['content4-1']!=""){
$content4=strip_tags($_POST['content4-1']);
}

$custom5=strip_tags($_POST['custom5']);
$type5=strip_tags($_POST['type5']);
if ($_POST['content5']!=""){
$content5=strip_tags($_POST['content5']);
}
if ($_POST['content5-1']!=""){
$content5=strip_tags($_POST['content5-1']);
}

$custom6=strip_tags($_POST['custom6']);
$type6=strip_tags($_POST['type6']);
if ($_POST['content6']!=""){
$content6=strip_tags($_POST['content6']);
}
if ($_POST['content6-1']!=""){
$content6=strip_tags($_POST['content6-1']);
}

$custom7=strip_tags($_POST['custom7']);
$type7=strip_tags($_POST['type7']);
if ($_POST['content7']!=""){
$content7=strip_tags($_POST['content7']);
}
if ($_POST['content7-1']!=""){
$content7=strip_tags($_POST['content7-1']);
}
$custom8=strip_tags($_POST['custom8']);
$type8=strip_tags($_POST['type8']);
if ($_POST['content8']!=""){
$content8=strip_tags($_POST['content8']);
}
if ($_POST['content8-1']!=""){
$content8=strip_tags($_POST['content8-1']);
}

ysk_date_log(6,$_SESSION['ysk_username'],'添加了一个 "'.$title.'" 购买模板');
mysql_query("insert into `buy_modl` (title,custom1,type1,content1,custom2,type2,content2,custom3,type3,content3,custom4,type4,content4,custom5,type5,content5,custom6,type6,content6,custom7,type7,content7,custom8,type8,content8,time) "."values ('$title','$custom1','$type1','$content1','$custom2','$type2','$content2','$custom3','$type3','$content3','$custom4','$type4','$content4','$custom5','$type5','$content5','$custom6','$type6','$content6','$custom7','$type7','$content7','$custom8','$type8','$content8',now())",$conn1);

echo "<script>alert('添加成功!');;self.location=document.referrer;</script>";
}

////////修改记录
If ($Action=="editsave") {
$y1=$_POST['y1'];

$title=strip_tags($_POST['title']);
$custom1=strip_tags($_POST['custom1']);
$type1=strip_tags($_POST['type1']);
if ($_POST['content1']!=""){
$content1=strip_tags($_POST['content1']);
}
if ($_POST['content1-1']!=""){
$content1=strip_tags($_POST['content1-1']);
}


$custom2=strip_tags($_POST['custom2']);
$type2=strip_tags($_POST['type2']);
if ($_POST['content2']!=""){
$content2=strip_tags($_POST['content2']);
}
if ($_POST['content2-1']!=""){
$content2=strip_tags($_POST['content2-1']);
}

$custom3=strip_tags($_POST['custom3']);
$type3=strip_tags($_POST['type3']);

if ($_POST['content3']!=""){
$content3=strip_tags($_POST['content3']);
}
if ($_POST['content3-1']!=""){
$content3=strip_tags($_POST['content3-1']);
}

$custom4=strip_tags($_POST['custom4']);
$type4=strip_tags($_POST['type4']);
if ($_POST['content4']!=""){
$content4=strip_tags($_POST['content4']);
}
if ($_POST['content4-1']!=""){
$content4=strip_tags($_POST['content4-1']);
}

$custom5=strip_tags($_POST['custom5']);
$type5=strip_tags($_POST['type5']);
if ($_POST['content5']!=""){
$content5=strip_tags($_POST['content5']);
}
if ($_POST['content5-1']!=""){
$content5=strip_tags($_POST['content5-1']);
}

$custom6=strip_tags($_POST['custom6']);
$type6=strip_tags($_POST['type6']);
if ($_POST['content6']!=""){
$content6=strip_tags($_POST['content6']);
}
if ($_POST['content6-1']!=""){
$content6=strip_tags($_POST['content6-1']);
}

$custom7=strip_tags($_POST['custom7']);
$type7=strip_tags($_POST['type7']);
if ($_POST['content7']!=""){
$content7=strip_tags($_POST['content7']);
}
if ($_POST['content7-1']!=""){
$content7=strip_tags($_POST['content7-1']);
}
$custom8=strip_tags($_POST['custom8']);
$type8=strip_tags($_POST['type8']);
if ($_POST['content8']!=""){
$content8=strip_tags($_POST['content8']);
}
if ($_POST['content8-1']!=""){
$content8=strip_tags($_POST['content8-1']);
}
if ($y1<>$title){
ysk_date_log(6,$_SESSION['ysk_username'],'将手工充值模板 "'.$y1.'" 修改成 "'.$title.'"');
}


mysql_query("update buy_modl set title='$title',custom1='$custom1',type1='$type1',content1='$content1',custom2='$custom2',type2='$type2',content2='$content2',custom3='$custom3',type3='$type3',content3='$content3',custom4='$custom4',type4='$type4',content4='$content4',custom5='$custom5',type5='$type5',content5='$content5',custom6='$custom6',type6='$type6',content6='$content6',custom7='$custom7',type7='$type7',content7='$content7',custom8='$custom8',type8='$type8',content8='$content8'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('修改成功!');;self.location=document.referrer;</script>";

}

////////删除单记录
if ($Action=="del") {
mysql_query("delete from buy_modl where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from buy_modl where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">
//<![CDATA[
var ss = 3;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView2(vv){
document.getElementById('form2_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form2_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView3(vv){
document.getElementById('form3_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form3_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView4(vv){
document.getElementById('form4_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form4_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView5(vv){
document.getElementById('form5_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form5_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView6(vv){
document.getElementById('form6_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form6_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView7(vv){
document.getElementById('form7_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form7_'+vv).style.display = '';//显示选择的.
ss = vv;
}

function switchView8(vv){
document.getElementById('form8_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form8_'+vv).style.display = '';//显示选择的.
ss = vv;
}

//]]>
</script>


</head>
<body>



<?php
If  ($Action=="List" or $Action==""){
?>
<div class="gn">
<input id="add" type="button" value="模板添加" class="tijiao_input" onclick="location.href='TemplateList.php?Action=add'"/>
</div>


<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="42%" class="table_top">模板名称</td>
<td width="14%" class="table_top">自定义1</td>
<td width="14%" class="table_top">自定义2</td>
<td width="14%" class="table_top">自定义3</td>
<td width="8%" class="table_top">修改</td>
<td width="8%" class="table_top">删除</td>

</tr>
<?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `buy_modl`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from buy_modl  order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24" align="left"><?=$row['title']?></td>
<td><?php if ($row['custom1']!="") {?>已定义<?php }else{?>未定义<?php } ?></td>
<td><?php if ($row['custom2']!="") {?>已定义<?php }else{?>未定义<?php } ?></td>
<td><?php if ($row['custom3']!="") {?>已定义<?php }else{?>未定义<?php } ?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$row['id']?>"></a> </td>
<td><a class="a delete" onclick="return confirm('确定删除？');"  href="?Action=del&Id=<?=$row['id']?>"></a></td>
</tr>
<?php 
 }?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:8px; ">
<div class="pager"><?php if ($total!=0){?><?=$page->paging();?><?php }?></div> </td>
</tr>
</table>
</div>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="table_top" colspan="2">模板添加</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 手工充值模板名称：</td>
<td width="87%"><input name="title" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称1：</td>
<td width="87%"><input name="custom1" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型1：</td>
<td><select name="type1" id="type1" onchange="switchView1(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form1_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项1：</td>
<td width="90%" class="left"><input name="content1" type="text" style="width:362px;" class="biankuan" />   多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form1_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项1：</td>
<td width="90%" class="left"><input name="content1-1" type="text" class="biankuan" id="content1-1" style="width:362px;" />
  多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称2：</td>
<td width="87%"><input name="custom2" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型2：</td>
<td><select name="type2" id="type2" onchange="switchView2(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form2_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项2：</td>
<td width="90%" class="left"><input name="content2" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form2_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项2：</td>
<td width="90%" class="left"><input name="content2-1" type="text" class="biankuan" id="content2-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称3：</td>
<td width="87%"><input name="custom3" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型3：</td>
<td><select name="type3" id="type3" onchange="switchView3(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form3_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项3：</td>
<td width="90%" class="left"><input name="content3" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form3_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项3：</td>
<td width="90%" class="left"><input name="content3-1" type="text" class="biankuan" id="content3-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称4：</td>
<td width="87%"><input name="custom4" type="text" class="biankuan" id="custom4" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型4：</td>
<td><select name="type4" id="type4" onchange="switchView4(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form4_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项4：</td>
<td width="90%" class="left"><input name="content4" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form4_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项4：</td>
<td width="90%" class="left"><input name="content4-1" type="text" class="biankuan" id="content4-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称5：</td>
<td width="87%"><input name="custom5" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型5：</td>
<td><select name="type5" id="type5" onchange="switchView5(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form5_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项5：</td>
<td width="90%" class="left"><input name="content5" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form5_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项5：</td>
<td width="90%" class="left"><input name="content5-1" type="text" class="biankuan" id="content5-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称6：</td>
<td width="87%"><input name="custom6" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型6：</td>
<td><select name="type6" id="type6" onchange="switchView6(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form6_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项6：</td>
<td width="90%" class="left"><input name="content6" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form6_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项6：</td>
<td width="90%" class="left"><input name="content6-1" type="text" class="biankuan" id="content6-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称7：</td>
<td width="87%"><input name="custom7" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型7：</td>
<td><select name="type7" id="type7" onchange="switchView7(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form7_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项7：</td>
<td width="90%" class="left"><input name="content7" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form7_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项7：</td>
<td width="90%" class="left"><input name="content7-1" type="text" class="biankuan" id="content7-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left">自定义名称8：</td>
<td width="87%"><input name="custom8" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型8：</td>
<td><select name="type8" id="type8" onchange="switchView8(this.value)">
<option value="0" selected="selected" >不启用此项</option>
<option value="1">文本输入框</option>
<option value="2">密码输入框</option>
<option value="3">单选项</option>
<option value="4">下拉菜单</option>
</select></td>
</tr>
<tr  id="form8_3"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项8：</td>
<td width="90%" class="left"><input name="content8" type="text" style="width:362px;" class="biankuan" /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form8_4"  style="display:none">   
<td width="10%" class="td_left"> 自定义选项8：</td>
<td width="90%" class="left"><input name="content8-1" type="text" class="biankuan" id="content8-1" style="width:362px;" /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
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
$sql="select * from buy_modl where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row[id]?>">
<input name="y1" type="hidden" value="<?=$row['title']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="table_top" colspan="2">模板修改</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 手工充值模板名称：</td>
<td width="87%"><input name="title" type="text" class="biankuan" style="width:150px;"   value="<?=$row['title']?>" /></td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称1：</td>
<td width="87%"><input name="custom1" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom1']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型1：</td>
<td><select name="type1" id="type1" onchange="switchView1(this.value)">
<option value="0" <?php if ($row['type1']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type1']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type1']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type1']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type1']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form1_3"  <?php if ($row['type1']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项1：</td>
<td width="90%" class="left"><input name="content1" type="text" style="width:362px;" class="biankuan" <?php if ($row['type1']=='3') {?> value="<?=$row['content1']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form1_4"   <?php if ($row['type1']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项1：</td>
<td width="90%" class="left"><input name="content1-1" type="text" class="biankuan" id="content1-1" style="width:362px;" <?php if ($row['type1']=='4') {?> value="<?=$row['content1']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称2：</td>
<td width="87%"><input name="custom2" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom2']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型2：</td>
<td><select name="type2" id="type2" onchange="switchView2(this.value)">
<option value="0" <?php if ($row['type2']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type2']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type2']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type2']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type2']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form2_3"   <?php if ($row['type2']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项2：</td>
<td width="90%" class="left"><input name="content2" type="text" style="width:362px;" class="biankuan" <?php if ($row['type2']=='3') {?> value="<?=$row['content2']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form2_4"  <?php if ($row['type2']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项2：</td>
<td width="90%" class="left"><input name="content2-1" type="text" class="biankuan" id="content2-1" style="width:362px;" <?php if ($row['type2']=='4') {?> value="<?=$row['content2']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称3：</td>
<td width="87%"><input name="custom3" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom3']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型3：</td>
<td><select name="type3" id="type3" onchange="switchView3(this.value)">
<option value="0" <?php if ($row['type3']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type3']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type3']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type3']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type3']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form3_3"    <?php if ($row['type3']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项3：</td>
<td width="90%" class="left"><input name="content3" type="text" style="width:362px;" class="biankuan" <?php if ($row['type3']=='3') {?> value="<?=$row['content3']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form3_4"    <?php if ($row['type3']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项3：</td>
<td width="90%" class="left"><input name="content3-1" type="text" class="biankuan" id="content3-1" style="width:362px;" <?php if ($row['type3']=='4') {?> value="<?=$row['content3']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称4：</td>
<td width="87%"><input name="custom4" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom4']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型4：</td>
<td><select name="type4" id="type4" onchange="switchView4(this.value)">
<option value="0" <?php if ($row['type4']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type4']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type4']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type4']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type4']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form4_3"    <?php if ($row['type4']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项4：</td>
<td width="90%" class="left"><input name="content4" type="text" style="width:362px;" class="biankuan" <?php if ($row['type4']=='3') {?> value="<?=$row['content4']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form4_4"    <?php if ($row['type4']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项4：</td>
<td width="90%" class="left"><input name="content4-1" type="text" class="biankuan" id="content4-1" style="width:362px;" <?php if ($row['type4']=='4') {?> value="<?=$row['content4']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>

<tr>
<td width="13%"  class="td_left"> 自定义名称5：</td>
<td width="87%"><input name="custom5" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom5']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型5：</td>
<td><select name="type5" id="type5" onchange="switchView5(this.value)">
<option value="0" <?php if ($row['type5']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type5']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type5']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type5']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type5']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form5_3"    <?php if ($row['type5']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项5：</td>
<td width="90%" class="left"><input name="content5" type="text" style="width:362px;" class="biankuan" <?php if ($row['type5']=='3') {?> value="<?=$row['content5']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form5_4"    <?php if ($row['type5']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项5：</td>
<td width="90%" class="left"><input name="content5-1" type="text" class="biankuan" id="content5-1" style="width:362px;" <?php if ($row['type5']=='4') {?> value="<?=$row['content5']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr>
<td width="13%"  class="td_left"> 自定义名称6：</td>
<td width="87%"><input name="custom6" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom6']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型6：</td>
<td><select name="type6" id="type6" onchange="switchView6(this.value)">
<option value="0" <?php if ($row['type6']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type6']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type6']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type6']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type6']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form6_3"    <?php if ($row['type6']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项6：</td>
<td width="90%" class="left"><input name="content6" type="text" style="width:362px;" class="biankuan" <?php if ($row['type6']=='3') {?> value="<?=$row['content6']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form6_4"    <?php if ($row['type6']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项6：</td>
<td width="90%" class="left"><input name="content6-1" type="text" class="biankuan" id="content6-1" style="width:362px;" <?php if ($row['type6']=='4') {?> value="<?=$row['content6']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>

<tr>
<td width="13%"  class="td_left"> 自定义名称7：</td>
<td width="87%"><input name="custom7" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom7']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型7：</td>
<td><select name="type7" id="type7" onchange="switchView1(this.value)">
<option value="0" <?php if ($row['type7']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type7']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type7']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type7']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type7']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form7_3"    <?php if ($row['type7']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项7：</td>
<td width="90%" class="left"><input name="content7" type="text" style="width:362px;" class="biankuan" <?php if ($row['type7']=='3') {?> value="<?=$row['content7']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form7_4"    <?php if ($row['type7']=='4') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项7：</td>
<td width="90%" class="left"><input name="content7-1" type="text" class="biankuan" id="content7-1" style="width:362px;" <?php if ($row['type7']=='4') {?> value="<?=$row['content7']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>


<tr>
<td width="13%"  class="td_left"> 自定义名称8：</td>
<td width="87%"><input name="custom8" type="text" class="biankuan" style="width:150px;" value="<?=$row['custom8']?>"  /></td>
</tr>
<tr>
<td  class="td_left"> 自定义类型8：</td>
<td><select name="type8" id="type8" onchange="switchView8(this.value)">
<option value="0" <?php if ($row['type8']=='0') {?>selected="selected"<?php } ?> >不启用此项</option>
<option value="1" <?php if ($row['type8']=='1') {?>selected="selected"<?php } ?> >文本输入框</option>
<option value="2" <?php if ($row['type8']=='2') {?>selected="selected"<?php } ?> >密码输入框</option>
<option value="3" <?php if ($row['type8']=='3') {?>selected="selected"<?php } ?> >单选项</option>
<option value="4" <?php if ($row['type8']=='4') {?>selected="selected"<?php } ?> >下拉菜单</option>
</select></td>
</tr>
<tr  id="form8_3"    <?php if ($row['type8']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项8：</td>
<td width="90%" class="left"><input name="content8" type="text" style="width:362px;" class="biankuan" <?php if ($row['type8']=='3') {?> value="<?=$row['content8']?>"<?php } ?>  /> 多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
</tr>
<tr  id="form8_4"    <?php if ($row['type8']=='3') {?>  <?php }else{?> style="display:none" <?php } ?>>   
<td width="10%" class="td_left"> 自定义选项8：</td>
<td width="90%" class="left"><input name="content8-1" type="text" class="biankuan" id="content1-1" style="width:362px;" <?php if ($row['type8']=='4') {?> value="<?=$row['content8']?>"<?php } ?>  /> 
多种选择请用|隔开如：盛大通行证|游戏账号|无选择不用填</td>
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
</Html>
<script>
function test()
{
if(!confirm('确认删除吗？')) return false;
}
</script>
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
<script charset="utf-8" src="/plug/artDialog/artDialog.source.js?skin=aero"></script>
<script charset="utf-8"  src="/plug/artDialog/plugins/iframeTools.source.js"></script>
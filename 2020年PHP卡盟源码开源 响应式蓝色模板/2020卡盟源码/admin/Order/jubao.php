<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
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
$seey=strip_tags($_GET['seey']);
if ($_REQUEST['Del']=='删除'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from goods_report where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
exit();
}

?>
<script type="text/javascript"> 
function Permissions(obj){
var radioss= obj.value;
window.self.document.getElementById("text").value=radioss;
} 
</script> 
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
<?php if($Action=="List" or $Action==""){?>
<div class="Menubox" >
<ul>
<li<?php if ($yy==''or $yy=='1'){?> class="hover"<?php } ?>>
<a href="jubao.php?yy=1">商品举报 (<?=mysql_num_rows(mysql_query("select * from `goods_report` where  online=0",$conn1));?>)</a></li>
</ul>
</div>
<div style="padding:10px 0px;">
<form action="jubao.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td height="32" class="td_left">
搜索关键词：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">客户编号</option>
<option value="username">供货商编号</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">全部</option>
<option value="虚假商品">虚假商品</option>
<option value="误导性商品">误导性商品</option>
<option value="违法商品">违法商品</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询时间段：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询" id="btnQuery" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="?Action=mylove">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="3%" height="32" class="table_top">选择</td>
<td width="37%" class="table_top">商品</td>
<td width="12%" class="table_top">举报类型</td>
<td width="10%" class="table_top">会员编号</td>
<td width="13%" class="table_top">商家编号</td>
<td width="14%" class="table_top">提交时间 </td>
<td width="11%" class="table_top">状态详细</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.=" and $seey like '%$keywords%' "; 
if ($state!='')    $search.=" and type = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_report`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from goods_report  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
$sql1="select * from product where id='$row[proid]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="left"><?=$row1['title']?></td>
<td align="center"><?=$row['type']?></td>
<td><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a href="jubao.php?Action=edit&Id=<?=$row[id]?>">
<?php if ($row['online']=='0') {?>
<b style=" color:#FF0000">等待处理</b>
<?php }else{?>
处理完成
<?php }?>
</a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="21%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" class="x2_input" onclick="return CheckSelect();" ></td>
<td width="79%" align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>    </td>
</tr>
</table>
</form>
</div>
</div>
<?php }elseif($Action=="edit"){  
$sql="select * from goods_report where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);

$sql1="select * from product where id='$row[proid]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
?>
<form action="?Action=editsave" method="post"  id="form1" name="form1">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="type" name="type" type="hidden" value="<?=$row['type']?>">
<input id="title" name="title" type="hidden" value="<?=$row1['title']?>">
<input id="username" name="username" type="hidden" value="<?=$row1['username']?>">
<input id="number" name="number" type="hidden" value="<?=$row['number']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td height="32" colspan="3" align="left" class="table_top">信息处理</td>
</tr>
<tr><td width="18%" class="td_left">举报类型：</td><td colspan="2"><?=$row['type']?></td></tr>
<tr><td width="18%" class="td_left">举报商家：</td><td colspan="2"><?=$row['username']?></td></tr>
<tr><td class="td_left">投诉客户：</td><td colspan="2"><?=$row['number']?></td></tr>
<tr><td class="td_left">投诉时间：</td><td colspan="2"><?=date("Y-m-d G:i:s",$row['begtime'])?></td></tr>
<tr><td class="td_left">投诉内容：</td><td colspan="2"><?=$row['content']?></td></tr>
<tr><td class="td_left">上传截图：</td><td colspan="2"><?php if($row['pic']=='') {?>无<?php }else{?>
<a href="<?=$row['pic']?>" target="_blank">点击预览</a>
<?php }?>

</td></tr>
<tr>
<td  class="td_left">状态处理：</td>
<td colspan="2"><table id="TreatStatus" border="0">
<tr>
<td><input id="online" type="radio" name="online" value="1" <?php if ($row['online']=='1') {?> checked="checked"<?php } ?>>  受理投诉</td>
<td><input id="online" type="radio" name="online" value="2" <?php if ($row['online']=='2') {?> checked="checked"<?php } ?>> <span style="color:#767474">不受理</span></td>
</tr>
</table></td>
</tr>
<tr>
<td  class="td_left">商家错误：</td>
<td colspan="2"><table id="TreatStatus" border="0">
<tr>
<td><input id="sjcw" type="radio" name="sjcw" value="1" <?php if ($row['sjcw']=='1') {?> checked="checked"<?php } ?>>  是</td>
<td><input id="sjcw" type="radio" name="sjcw" value="2" <?php if ($row['sjcw']=='2') {?> checked="checked"<?php } ?>>   否</td>
</tr>
</table></td>
</tr>
<tr>
<td >&nbsp;</td>
<td colspan="2">
<?php if ($row['online']=='1' or $row['online']=='2' or $row['sjcw']=='1' or $row['sjcw']=='2' ) {?> 

<?php }else {?>
<input type="submit" name="btn_edit" value="确认提交" id="btn_edit" class="tijiao_input" />
<?php }?>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="editsave"){ 

if      ($_REQUEST['sjcw']=='1'){
if      ($_REQUEST['type']=='虚假商品') {
$kou=$nlegal_m_5;
}elseif ($_REQUEST['type']=='误导性商品') {
$kou=$nlegal_m_6;
}elseif ($_REQUEST['type']=='违法商品') {
$kou=$nlegal_m_7;
}

if ($_REQUEST['username']!=''){
mysql_query("insert into  `punishment_list`  set title='$_REQUEST[title]被举报$_REQUEST[type]',number='$_REQUEST[username]',deduct='$kou',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$kou where number='$_REQUEST[username]'",$conn1); 
}
}elseif($_REQUEST['sjcw']=='2'){
//------------------------------买家错误

mysql_query("insert into  `punishment_list`  set title='$_REQUEST[title]举报$_REQUEST[type]  经核实是错误的',number='$_REQUEST[number]',deduct='$nlegal_b_1',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades1=bad_grades1+$nlegal_b_1 where number='$_REQUEST[number]'",$conn1); 	
}

mysql_query("update `goods_report`  set sjcw='$_REQUEST[sjcw]',online='$_REQUEST[online]' where id=$_REQUEST[Id]",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
} ?>

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
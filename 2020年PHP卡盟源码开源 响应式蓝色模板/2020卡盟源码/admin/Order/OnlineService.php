<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"> 
function Permissions(obj){
var radioss= obj.value;
//window.self.document.form1.text.value = radioss;
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
$yy=strip_tags($_GET['yy']);
$state=strip_tags($_GET['state']);
$seey=strip_tags($_GET['seey']);

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$sql="delete from Complaints_feedback where id in ($ID_Dele)";
mysql_query($sql,$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}
?>
<?php if ($Action=="List" or $Action==""){?>
<div class="Menubox" >
<ul>
<li<?php if ($yy==''or $yy=='1'){?> class="hover"<?php } ?>>
<a href="?yy=1" >前台供货商(<?=mysql_num_rows(mysql_query("select * from Complaints_feedback where  audit='0' and username!='' and clouds=0",$conn1));
?>)</a></li>
<li<?php if ($yy=='2'){?> class="hover"<?php } ?>><a href="?yy=2">后台平台主 (<?=mysql_num_rows(mysql_query("select * from Complaints_feedback where   audit='0' and username='' and docking=0",$conn1));
?>)</a></li>

</ul>
</div>




<form action="OnlineService.php" method="get">
<input type="hidden" name="yy" value="<?=$yy?>">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
客户编号：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> 
<select name="seey" id="seey">
<option value="number" selected="selected">客户编号</option>
<option value="username">供货商编号</option>
<option value="orerno">订单编号</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">全部</option>
<option value="0">尚未受理</option>
<option value="1">已经受理</option>
<option value="3">无法处理</option>
<option value="2">处理完成</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
查询时间段：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询" id="btnQuery" class="chaxun_input" /></td>
</tr>
</table>
</form>
<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="7%" height="32" class="table_top">ID</td>
<td width="15%" class="table_top">投诉时间</td>
<td width="9%" class="table_top">投诉客户 </td>
<td width="9%" class="table_top">供货商编号</td>
<td width="21%" class="table_top">投诉主题</td>
<td width="11%" class="table_top">充值账户</td>
<td width="17%" class="table_top"> 订单号 </td>
<td width="11%" class="table_top">处理状态</td>
</tr>
<?php
if ($yy=='1' or $yy=='') {
$search="where  username!='' and sid='0' and clouds=0"; 
}else{
$search="where  username=''  and sid='0' and clouds=0"; 
}
if ($StartYear!='' and $EndYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.=" and $seey like '%$keywords%' "; 
if ($state!='')    $search.=" and audit = '$state' "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `Complaints_feedback`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from Complaints_feedback  $search  order by time desc,id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){

$od_result=mysql_query("select * from product_order where orderid='$row[orerno]' ",$conn1);
$od_row=mysql_fetch_array($od_result);
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td><?=$row['title']?></td>
<td><?=$od_row['content1']?></td>
<td style="text-align:center"><a  href="#art1" onclick="art.dialog.open('Order/myorder.php?id=<?=$row['orerno']?>', { title: '直销平台订单详细记录', width: 800, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});"><?=$row['orerno']?></a></td>
<td><a href="?Action=edit&Id=<?=$row['id']?>">

<?php        if ($row['audit']=='0') {?>
<span class='complaint0'>尚未受理</span>
<?php    }elseif($row['audit']=='1') {?>
<span class='complaint1'>受理投诉</span>
<?php    }elseif($row['audit']=='2') {?>
<span class='complaint3'>无法处理</span>
<?php    }elseif($row['audit']=='3') {?>
<span class='complaint2'>已完成处理</span>
<?php } ?></a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9%" align="center" style="padding-top:15px; padding-bottom:15px;"><input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" onclick="Javascript:return confirm('确定要删除吗？');" class="x3_input" ></td>
<td width="91%" align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!=0){?><?=$page->paging();?><?php }?> 

 </td>
</tr>
</table>
</form>


<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$sql="select * from Complaints_feedback where id='$Id' and clouds=0 and sid=0 ";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post"  id="form1" name="form1">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td height="32" colspan="3" align="left" class="table_top">信息处理</td>
</tr>
<tr><td width="18%" class="td_left">类型：</td><td colspan="2"><?=$row['type']?></td></tr>
<tr><td class="td_left">投诉客户：</td><td colspan="2"><?=$row['number']?></td></tr>
<tr><td class="td_left">投诉时间：</td><td colspan="2"><?=date("Y-m-d G:i:s",$row['time'])?></td></tr>
<tr><td class="td_left">投诉主题：</td><td colspan="2"><?=$row['title']?></td></tr>
<?php if ($row['orerno']!='') {?>
<tr><td class="td_left">投诉订单：</td><td colspan="2">
<a  href="#art1" onclick="art.dialog.open('Order/myorder.php?id=<?=$row[orerno]?>', { title: '直销平台订单详细记录', width:900, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});"><?=$row['orerno']?></a></td></tr>
<?php } ?>
<tr><td class="td_left">投诉内容：</td><td colspan="2"><?=$row['content']?></td></tr>
<tr><td class="td_left">回复内容：</td><td colspan="2"><?=$row['reply']?></td></tr>
<tr><td class="td_left">回复内容：</td><td width="29%"><textarea name="text"  id="text" style="height:140px;width:300px;"></textarea></td>
<td width="53%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <?php
$Rss="SELECT * FROM fast_reply where type='投诉反馈'  and username='' order by begtime desc,id desc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>

  <tr>
    <td width="3%"><input name="reply" type="radio" value="<?=$Orzx['content']?>" onclick="Permissions(this)"/> </td>
    <td width="97%"><?=$Orzx['content']?> <a href="ReplayContent.php?Action=del&Id=<?=$Orzx['id']?>">__删除</a></td>
  </tr>



<?php 
}
}
?>
</table>
<div style="width:100%; float:left; padding-top:10px;">
<input name="Button2" type="button" id="Button2" value="新增"   class="tijiao_input"onclick="art.dialog.open('Order/ReplayContent.php?type=投诉反馈', { title: '添加投诉快捷内容', width: 500, height: 200, lock: true, fixed:true,closeFn: function () {location.reload();}});"/>
</div>
</td>
</tr>
<tr>
<td  class="td_left">状态处理：</td>
<td colspan="2"><table id="TreatStatus" border="0">
<tr>
<td><input id="audit" type="radio" name="audit" value="1" <?php if ($row['audit']=='1') {?> checked="checked"<?php } ?>>受理投诉,未完成处理</td><td><input id="audit" type="radio" name="audit" value="2" <?php if ($row['audit']=='2') {?> checked="checked"<?php } ?>><span style="color:#767474">受理投诉,无法处理</span></td><td><input id="audit" type="radio" name="audit" value="3" <?php if ($row['audit']=='3') {?> checked="checked"<?php } ?>><span style="color:#090">受理投诉,已完成处理</span></td>
</tr>
</table></td>
</tr>

<?php if ($nlegal_open=='0' && $sup_rules_module=='0') {?>
<tr>
<td  class="td_left">处罚处理：</td>
<td colspan="2">
<?php if ($row['locks']=='0') {?>
<table id="TreatStatus" border="0">
<tr>
<td><input name="locks" type="radio" id="locks" value="1" checked="checked" > 
买家正确</td>
<td><input id="locks" type="radio"    name="locks" value="2"> 
卖家正确</td>
</tr>
</table>
<?php }elseif ($row['locks']=='1'){?>客服判断买家正确<?php }elseif ($row['locks']=='2'){?>客服判断卖家正确<?php } ?>
</td>
</tr><?php } ?>

<tr>
<td >&nbsp;</td>
<td colspan="2"><input type="submit" name="btn_edit" value="确认提交" id="btn_edit" class="tijiao_input" /></td>
</tr>
</table>
</form>
<?php }elseif($Action=="editsave"){  
$yresult=mysql_query("select * from Complaints_feedback where id='$_REQUEST[Id]'",$conn1);
$row=mysql_fetch_array($yresult);
$zresult=mysql_query("select * from product_order where orderid='$row[orerno]'",$conn1);
$bow=mysql_fetch_array($zresult);

if        ($_REQUEST['locks']=='1' && $sup_rules_module=='0'){
mysql_query("insert into  `punishment_list`  set title='商品纠纷',number='$bow[username]',deduct='$nlegal_m_1',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_m_1 where number='$bow[username]'",$conn1); 
}elseif ($_REQUEST['locks']=='2' && $sup_rules_module=='0'){####卖家正确
mysql_query("insert into  `punishment_list`  set title='商品纠纷',number='$bow[number]',deduct='$nlegal_b_1',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_b_1 where number='$bow[number]'",$conn1); 
}
########违规结束


if ($row['reply']==''){ 
if ($_REQUEST['text']==''){ 
$content=$row['reply'];
}else{
$content=date("Y-m-d H:i:s").' ：'.$_REQUEST['text'];
}
}else{
if ($_REQUEST['text']==''){ 
$content=$row['reply'];
}else{
$content1=date("Y-m-d H:i:s").' ：'.$_REQUEST['text'];
$content=$row['reply'].'<br>'.$content1;
}


}


if ($_REQUEST['locks']!=''){
mysql_query("update `Complaints_feedback`  set begtime='$begtime',audit='$_REQUEST[audit]',reply='$content',locks='$_REQUEST[locks]' where id='$_REQUEST[Id]'",$conn1); 
}else{
mysql_query("update `Complaints_feedback`  set begtime='$begtime',audit='$_REQUEST[audit]',reply='$content' where id='$_REQUEST[Id]'",$conn1); 
}
echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
} ?>

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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
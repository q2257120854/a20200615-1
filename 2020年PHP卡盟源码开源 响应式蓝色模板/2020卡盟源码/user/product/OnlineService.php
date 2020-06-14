
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<body>
<script type="text/javascript"> 
function Permissions(obj){
var radioss= obj.value;
//window.self.document.form1.text.value = radioss;
window.self.document.getElementById("text").value=radioss;
} 
</script> 
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/page_class.php');
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
$state=strip_tags($_GET['state']);
$Action=strip_tags($_GET['Action']);?>
<div id="right">
<?php if ($Action=='') {?>


<form action="OnlineService.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

<tr>
<td height="32" class="td_left">
客户编号：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">客户编号</option>
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
<option value="2">无法处理</option>
<option value="3">处理完成</option>
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
<form action="" method="post"  name="form1" >
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="15%" class="table_top">投诉时间</td>
<td width="11%" class="table_top">投诉客户 </td>
<td width="24%" class="table_top">投诉主题</td>
<td width="15%" align="center" class="table_top">充值账户</td>
<td width="17%" class="table_top"> 订单号 </td>
<td width="11%" class="table_top">处理状态</td>
</tr>
<?php
$search="where  username='$_SESSION[ysk_number]' and clouds=0 and sid=0 "; 
if ($StartYear!='' and $EndYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.=" and $seey like '%$keywords%' "; 
if ($state!='')    $search.=" and audit = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `complaints_feedback`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from complaints_feedback  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){

$od_result=mysql_query("select * from product_order where orderid='$row[orerno]' ",$conn1);
$od_row=mysql_fetch_array($od_result);
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['number']?></td>
<td><?=$row['title']?></td>
<td><?=$od_row['content1']?></td>
<td style="text-align:center"><a  href="#art1" onClick="art.dialog.open('/Username/product/myorder.php?id=<?=$row[orerno]?>', { title: '直销平台订单详细记录', width: 800, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});"><?=$row['orerno']?></a></td>
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
</table></form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td  align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
<?php }?>
<?php if ($Action=='edit') {
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from complaints_feedback where id='$Id' and username='$_SESSION[ysk_number]' and sid=0",$conn1);
$row=mysql_fetch_array($result);
if ($row['id']==''){
echo "<br><br><br><br><center>操作失败，操作异常</center>";
exit();	
}
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
<a  href="#art1" onClick="art.dialog.open('/Username/product/myorder.php?id=<?=$row[orerno]?>', { title: '直销平台订单详细记录', width: 800, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});"><?=$row['orerno']?></a></td></tr>
<?php } ?>
<tr><td class="td_left">投诉内容：</td><td colspan="2"><?=$row['content']?></td></tr>
<tr><td class="td_left">回复内容：</td><td colspan="2"><?=$row['reply']?></td></tr>
<tr><td class="td_left">回复内容：</td><td width="29%"><textarea name="text"  id="text" style="height:140px;width:300px;"></textarea></td>
<td width="53%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$Rss="SELECT * FROM fast_reply where type='投诉反馈'  and username='$_SESSION[ysk_number]'  order by begtime desc,id desc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>

<tr>
<td width="3%"><input name="reply" type="radio" value="<?=$Orzx['content']?>" onClick="Permissions(this)"/> </td>
<td width="97%"><?=$Orzx['content']?> <a href="ReplayContent.php?Action=del&Id=<?=$Orzx['id']?>">__删除</a></td>
</tr>



<?php 
}
}
?>
</table>
<div style="width:100%; float:left; padding-top:10px;">
<input name="Button2" type="button" id="Button2" value="新增"   class="tijiao_input"onclick="art.dialog.open('/Username/product/ReplayContent.php?type=投诉反馈', { title: '添加投诉快捷内容', width: 500, height: 200, lock: true, fixed:true,closeFn: function () {location.reload();}});"/>
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
<tr>
<td >&nbsp;</td>
<td colspan="2"><input type="submit" name="btn_edit" value="确认提交" id="btn_edit" class="tijiao_input" /></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='editsave') {
$text=strip_tags($_POST['text']);
$Id=inject_check($_POST['Id']);
$audit=inject_check($_POST['audit']);

////---------------------验证是否开启文明评论
if ($sup_rules_module=='0'){
if ($nlegal_open=='0') {
if(preg_match("/$nlegal_m_9/i",$text)){
mysql_query("insert into  `punishment_list`  set title='订单投诉出现敏感词语',number='$_SESSION[ysk_number]',deduct='$nlegal_m_8',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_m_8 where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('对不起，内容含有含有敏感字符不允许发布并扣掉 $nlegal_m_8 分！');self.location=document.referrer;</script>";
exit();
}
}
}
////---------------------验证是否开启文明评论 The End

$result=mysql_query("select * from complaints_feedback where id='$Id'",$conn1);
$pro=mysql_fetch_array($result);
//获取订单
if ($pro['docking']!=0){
$sup_result=mysql_query("select * from sup_members_site where id='$pro[docking]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
}


if ($pro['reply']==''){ 
$content=$mytime.' ：'.$text;
}else{
$content=$mytime.' ：'.$text;
$content=$pro['reply'].'<br>'.$content;
}

if ($pro['docking']!=0){
mysql_query("update `complaints_feedback` set audit='$audit',reply='$content',begtime='$begtime' where orerno='$pro[orerno]'",$conn3); 
}

mysql_query("update `complaints_feedback` set audit='$audit',reply='$content',begtime='$begtime' where id='$Id'",$conn1); 
echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
exit();
}
?>
</div>
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
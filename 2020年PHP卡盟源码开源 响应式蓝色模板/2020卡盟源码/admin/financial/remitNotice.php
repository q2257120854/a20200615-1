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
$state=strip_tags($_GET['state']);
$keywords=strip_tags($_GET['keywords']);
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
////////修改记录
If ($Action=="editsave") {
$online=$_POST['online'];               //处理状态
$number=$_POST['number'];               //会员
$godo=mysql_query("update money_order set state='$online' where id='$_POST[Id]'",$conn1); 
if ($online=='2') {

$sql1="select * from money_order where id='$_REQUEST[Id]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);


ysk_date_log(3,$_SESSION['ysk_username'],'处理了一条 "'.$row1['bank_type'].'" 汇款人是 '.$row1['number'].' 汇款金额 "'.$row1['kuan'].'" 元 的汇款通知书！');


$sql="select * from members  where number='$number'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);


$kuan=$_POST['kuan']+$row['kuan'];                   //金额
$title="会员线下汇款入款";
$before=$row['kuan'];
$after=$_POST['kuan']+$row['kuan'];
//////记录会员资金明细
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) "."values ('$title','$_POST[kuan]','$before','$after','$number','$begtime')",$conn1);

//////更新会员资金
mysql_query("update members set kuan='$kuan' where number='$number'",$conn1); 
}
echo "<br><br><br><br><center><input id='btnAll' type='button' value='处理成功!'  onClick='cl()' class='tijiao_input' /></center>";
}
////////删除单记录
If ($Action=="del") {
$sql=mysql_query("select * from money_order  where id ='$_REQUEST[Id]'",$conn1);
$row=mysql_fetch_array($sql);
ysk_date_log(3,$_SESSION['ysk_username'],'删除了一条 "'.$row['bank_type'].'" 汇款人是 '.$row['number'].' 汇款金额" '.$row['kuan'].'" 元 的汇款通知书！');
mysql_query("delete from money_order where id ='$_REQUEST[Id]'",$conn1);
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
<?php
If  ($Action=="List" or $Action==""){
?>


<form action="remitNotice.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td height="32" class="td_left">
客户编号：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
通知书状态：</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">全部汇款</option>
<option value="0">尚未受理</option>
<option value="1">已受理未加款</option>
<option value="2">已受理且加款</option>

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
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="19%" height="32" class="table_top">汇款时间</td>
<td width="23%" class="table_top">汇款客户</td>
<td width="22%" class="table_top">汇款金额</td>
<td width="16%" class="table_top">汇款银行</td>
<td width="14%" class="table_top">处理/详细</td>
<td width="6%" class="table_top">删除</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime>=$muyou1 and begtime<=$muyou2 "; 
if ($keywords!='') $search.=" and number like '%$keywords%' "; 
if ($keywords!='') $search.=" and state = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `money_order`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from money_order  $search order by begtime desc,id desc  {$page->limit}"; 



$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$row['htime']?></td>
<td><?=$row['number']?></td>
<td><?=$row['kuan']?></td>
<td height="24"><?=$row['bank_type']?></td>
<td style="text-align:center"><a href="#art1" onclick="art.dialog.open('financial/remitNotice.php?Action=edit&Id=<?=$row['id']?>', { title: '汇款查看', width: 700, height: 400, lock: true, fixed:true});">
<?php     if ($row['state']=='0') {?><div class="swcl">尚未受理</div>
<?php }elseif ($row['state']=='1') {?><div class="swcl">仅确认处理</div>
<?php }elseif ($row['state']=='2') {?><div class="yjcl">加款并处理</div>
<?php }?>
</a> </td>
<td><a class="a delete" onclick="return confirm('确定删除？');"  href="?Action=del&Id=<?=$row['id']?>"></a></td>
</tr>
<?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>


<?php }elseif($Action=="edit"){  
$sql="select * from money_order where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="kuan" name="kuan" type="hidden" value="<?=$row['kuan']?>">
<input id="number" name="number" type="hidden" value="<?=$row['number']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">

<tr><td class="td_left">提交时间：</td><td><?=date("Y-m-d G:i:s",$row['begtime'])?></td></tr>
<tr><td class="td_left">汇款客户：</td><td><?=$row['number']?></td></tr>
<tr><td class="td_left">汇款日期：</td><td><?=$row['htime']?></td></tr>
<tr><td class="td_left">汇款金额：</td><td><?=$row['kuan']?> 元</td></tr>
<tr><td class="td_left">汇款银行：</td><td><?=$row['bank_type']?></td></tr>
<tr><td class="td_left">汇款备注：</td><td><?=$row['content']?></td></tr>
<tr>
<td  class="td_left">状态处理：</td>
<td><select name="online" id="online">
<option value="0" <?php if ($row['state']=='0') {?> selected="selected"<?php } ?>>尚未处理</option>
<option value="1" <?php if ($row['state']=='1') {?> selected="selected"<?php } ?>>仅确认处理</option>
<option value="2" <?php if ($row['state']=='2') {?> selected="selected"<?php } ?>>加款并处理</option>
</select></td>
</tr>
<tr>
<td >&nbsp;</td>
<td><input type="submit" name="btn_edit" value="确认提交" id="btn_edit" class="tijiao_input" />
<br />
<span class="zs">“仅确认处理”表示将该笔汇款通知书标注为“已受理未加款”<br />
“加款并处理”将转到加款页面，加款成功后同时会将汇款通知书标注为“已受理且加款”</span></td>
</tr>



</table>
</form>
<?php } ?>
</div>
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
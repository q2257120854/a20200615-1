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
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
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
////////批量删除
If ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));
foreach($allArray as $value){
mysql_query("delete from diary where id='$value'",$conn1);
}


echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}
?>
<?php
If  ($Action=="List" or $Action==""){
?>

<form action="FinanceHistory.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td height="32" class="td_left">
会员账户：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" />
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
<td width="6%" height="32" class="table_top">ID</td>
<td width="18%" class="table_top">操作时间</td>
<td width="18%" class="table_top">操作人员</td>
<td width="58%" class="table_top">事件</td>
</tr>
<?php
$search="where content like '%给编号为%' "; 

if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.=" and username like '%$keywords%' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `diary`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from diary  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row['id']?>"></td>
<td height="28"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><?=$row['username']?></td>
<td align="left"> <?=$row['content']?></td>
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
<td width="83%" align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td>
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
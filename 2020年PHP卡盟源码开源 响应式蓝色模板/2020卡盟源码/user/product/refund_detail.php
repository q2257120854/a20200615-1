
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>聚合社</title>
</head>
<link href="../images/right.css" rel="stylesheet" type="text/css" />

<body>
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
?>
<div id="right">
<div class="new_qie">
<div class="new_qie2" style="padding-top:4px;">
<h2>订单退款明细</h2>
</div>
</div>
<form action="refund_detail.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

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

<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="15%">退款时间</th>
<th width="20%">事件</th>
<th width="10%">订单金额(<?=$moneytype?>)</th>
<th width="31%">事件描述</th>
</tr>
<?php
$search="where username='$_SESSION[ysk_number]'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `supplier_refund`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from supplier_refund  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left"><?=$row['title']?></td>
<td><?=number_format($row['price1'],3)?> <?=$moneytype?></td>
<td style="text-align:left"><?=$row['content']?></td>
</tr>
<?php
$price1=$price1+ $row['price1'];
$price2=$price2+ $row['price2'];
$price3=$price3+ $row['price3'];
}?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right" style="text-align:right">本页合计：</td>
  <td><span style="color:red"><?=number_format($price1,3)?> <?=$moneytype?></span></td>
  <td style="color:red">&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right"  style="text-align:right">总共合计：</td>
  <td><?php
$res=mysql_query("SELECT sum(price1)    FROM `supplier_refund` where username='$_SESSION[ysk_number]'  ",$conn1);
$sum=mysql_result($res,0);
?><span style="color:red"><?=number_format($sum,3)?>   <?=$moneytype?></span></td>
  <td style="color:red">&nbsp;</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</div>
</body>
</Html>
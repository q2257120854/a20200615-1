<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
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
$buy=strip_tags($_GET['buy']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>

<div class="new_qie">
<div class="new_qie2" style="padding-top:4px;">
<h2>销售记录查询</h2>
</div>
</div>

<form action="credit.php?buy=<?=$buy?>" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

<tr>
<td height="32" class="td_left">
查询时间段：</td>
<td class="left"><?php include_once('../jhs_config/time.php');?></td>
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

<table cellspacing="1" cellpadding="0" class="table1" style="margin-top:10px;">
<tr>
<th width="27%"><p>下单日期</p></th>
<th width="42%">订单号码</th>
<th width="16%"><?php if ($buy==''){?>我的评价<?php }else{?>卖家评价<?php } ?></th>
<th width="15%"><?php if ($buy==''){?>买家评价<?php }else{?>我的评价<?php } ?></th>
</tr>
<?php
if ($buy==''){
$search="where username='$_SESSION[ysk_number]'"; 
}else{
$search="where number='$_SESSION[ysk_number]'"; 	
}
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from product_order $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['orderid']?></td>
<td><?php if ($row['sell_pl']!=0){?><img src="../Public/images/0<?=$row['sell_pl']?>.png"><?php } ?></td>
<td><?php if ($row['buy_pl']!=0){?><img src="../Public/images/0<?=$row['buy_pl']?>.png"><?php } ?></td>
</tr>
<?php

$nums=$nums+ $row['nums'];
$buyprice=$buyprice+ $row['buyprice'];
$countprice=$countprice+(($row['price']-$row['buyprice'])*$row['nums']);

}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>


</body>
</Html>
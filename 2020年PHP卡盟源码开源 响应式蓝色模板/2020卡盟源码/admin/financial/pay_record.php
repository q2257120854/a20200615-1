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

?>
<form action="pay_record.php" method="get">
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
<td width="16%" height="32" class="table_top">汇款时间</td>
<td width="17%" class="table_top">汇款订单</td>
<td width="17%" class="table_top">汇款客户</td>
<td width="15%" class="table_top">汇款金额</td>
<td width="15%" class="table_top">汇款费率</td>
<td width="20%" class="table_top">汇款平台</td>
</tr>
<?php
$search="where 1=1  and online=1"; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.=" and number like '%$keywords%' "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `pay_record`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from pay_record  $search order by begtime desc,id desc  {$page->limit}"; 


$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><?=$row['orderno']?></td>
<td><?=$row['number']?></td>
<td><?=$row['price']?></td>
<td><?=$row['price1']?></td>
<td height="24"><?=$row['title']?></td>
</tr>

<?php
$price=$price+ $row['price'];
$price1=$price1+ $row['price1'];
}
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="3"><div align="right">本页合计</div></td>
  <td><b style="color:red">
    <?=number_format($price,3);?> 
    元</b></td>
  <td><b style="color:red">
    <?=number_format($price1,3);?> 
    元</b></td>
  <td height="24">&nbsp;</td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="3"><div align="right">总共合计</div></td>
  <td><?php
$res=mysql_query("SELECT sum(price)    FROM `pay_record`  $search ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?> 元</b></td>
  <td><?php
$res1=mysql_query("SELECT sum(price1)    FROM `pay_record`  $search ",$conn1);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?> 元</b></td>
  <td height="24">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td>
</tr>
</table>
</form>

</body>
</Html>
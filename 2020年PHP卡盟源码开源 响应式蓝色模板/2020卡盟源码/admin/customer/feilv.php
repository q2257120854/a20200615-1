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
$Action=strip_tags($_GET['Action']);
$keywords=strip_tags($_GET['keywords']);    //搜索关键词
$StartYear=strip_tags($_GET['StartYear']);  ///////开始年份
$StartMonth=strip_tags($_GET['StartMonth']);///////开始月份
$StartDay=strip_tags($_GET['StartDay']);    ///////开始日期
$StartHour=strip_tags($_GET['StartHour']);  ///////开始小时
$StartMinute=strip_tags($_GET['StartMinute']);///////开始分钟
$EndYear=strip_tags($_GET['EndYear']);       ///////结束年份
$EndMonth=strip_tags($_GET['EndMonth']);     ///////结束月份
$EndDay=strip_tags($_GET['EndDay']);         ///////结束日期
$EndHour=strip_tags($_GET['EndHour']);       ///////结束小时
$EndMinute=strip_tags($_GET['EndMinute']);   ///////结束分钟
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);?>
<form action="feilv.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td class="td_left">
客户编号：</td>
<td class="left" colspan="2">
<input name="keywords" type="text" maxlength="25" id="keywords"  class="biankuan"/>
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
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="12%" align="center" class="table_top"> 客户编号 </td>
<td width="42%" align="center" class="table_top"> 交易类型 </td>
<td  width="11%" align="center" class="table_top"> 交易金额 </td>
<td  width="12%" align="center" class="table_top">手续费</td>
<td width="19%" align="center" class="table_top"> 交易日期 </td>
</tr>
<?php
$search="where incomes>0"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.="  and number='$keywords' "; 
$total=mysql_num_rows(mysql_query("select * from `goods_details`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from goods_details  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="center">
<?=$row['number']?></td>
<td align="left"><?=$row['orderid']?><?=$row['title']?></td>
<td align="center"><?=number_format($row['incomes'],3);?> 元</td>
<td align="center"><?=number_format($row['feilv'],3);?> 元</td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
</tr>
<?php
$incomes=$incomes+ $row['incomes'];
$feilv=$feilv+ $row['feilv'];
}?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
  <td align="center">&nbsp;</td>
  <td align="right"><span style="text-align:right">本页合计：</span></td>
  <td align="center"><b style="color:red"><?=number_format($incomes,3);?> 元</b></td>
  <td align="center"><b style="color:red"><?=number_format($feilv,3);?> 元</b></td>
  <td align="center">&nbsp;</td>
</tr>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
  <td align="center">&nbsp;</td>
  <td align="right">总计：</td>
  <td align="center"><?php
$res1=mysql_query("SELECT sum(incomes)    FROM `goods_details`  $search  ",$conn1);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?>  元</b></td>
  <td align="center"><?php
$res2=mysql_query("SELECT sum(feilv)    FROM `goods_details`  $search  ",$conn1);
$sum2=mysql_result($res2,0);
?><b style="color:red"><?=number_format($sum2,3);?>  元</b></td>
  <td align="center">&nbsp;</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td style="text-align:right;">
<?php if ($total!=0){?><?=$page->paging();?><?php }?>    </td>
</tr>
</table>
</form>
</body>
</Html>
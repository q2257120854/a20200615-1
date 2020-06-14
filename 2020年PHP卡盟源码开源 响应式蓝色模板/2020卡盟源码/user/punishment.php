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
$StartYear=$_REQUEST['StartYear'];           ///////开始年份
$StartMonth=$_REQUEST['StartMonth'];         ///////开始月份
$StartDay=$_REQUEST['StartDay'];             ///////开始日期
$StartHour=$_REQUEST['StartHour'];           ///////开始小时
$StartMinute=$_REQUEST['StartMinute'];       ///////开始分钟
$EndYear=$_REQUEST['EndYear'];               ///////结束年份
$EndMonth=$_REQUEST['EndMonth'];             ///////结束月份
$EndDay=$_REQUEST['EndDay'];                 ///////结束日期
$EndHour=$_REQUEST['EndHour'];               ///////结束小时
$EndMinute=$_REQUEST['EndMinute'];           ///////结束分钟
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>
<div id="right">
<div class="new_qie">
<div class="new_qie2" style="padding-top:4px;">
<h2>违规处理</h2>
</div>
</div>
<form action="" method="post">
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

<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="30%">违规日期</th>
<th width="57%">违规内容</th>
<th width="13%">扣除分数</th>
</tr>
<?php
$search="where number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `punishment_list`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from punishment_list  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="left" style="text-align:left"><?=$row['title']?></td>
<td><?=$row['deduct']?> 分</td>
</tr>
<?php
$deduct=$deduct+$row['deduct'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">本页合计：</td>
<td><b style="color:red"><?php if ($deduct==''){echo 0;}else{echo $deduct;}?> 分</b></td>

</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">总共合计：</td>
<td><?php
$res=mysql_query("SELECT sum(deduct)    FROM `punishment_list`  $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?php if ($sum==''){echo 0;}else{echo $sum;}?> 分</b></td>


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
<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');

$states=strip_tags($_GET['states']);
$keywords=strip_tags($_GET['keywords']);
$keyword=strip_tags($_GET['keyword']);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>
<form name="add" method="get" action="list.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="keywords" id="keywords">
<option selected="selected" value="account">卡号</option>
<option value="username">使用者</option>
<option value="price">卡号金额</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
充值卡状态：</td>
<td class="left">
<select name="states" id="states">
<option selected="selected" value="">全部</option>
<option value="1">已激活</option>
<option value="0">未激活</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
开卡时间：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="23%" class="table_top">卡号</td>
<td width="11%" class="table_top">状态</td>
<td width="17%" class="table_top">开卡时间</td>
<td width="17%" class="table_top">使用时间</td>
<td width="17%" class="table_top">使用者</td>
<td width="15%" class="table_top">金额</td>
</tr>
<?php

$search="where 1=1"; 

if ($keyword!='')  $search.=" and $keywords = '$keyword' "; 
if ($states!='')   $search.=" and states ='$states'"; 
if ($StartYear!='' ) $search.=" and time >=$muyou1 and time <=  $muyou2 "; 

$total=mysql_num_rows(mysql_query("select * from `one_cartoon`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from one_cartoon  $search order by id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){

?>
<tr>
<td height="28" style="text-align:left"><?=$row['account']?></td>
<td><?php if ($row['states']=='0') {?><span style="color:#009900">未激活</span><?php }else{?><font color="red">已激活</font><?php } ?></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?php if ($row['begtime']) {?><?=date("Y-m-d G:i:s",$row['begtime'])?> <?php } ?></td>
<td><?=$row['username']?></td>
<td><?=$row['price']?> 元
</td>

</tr>
<?php
}
?>
</table>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td  align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>

<?php }?>
</div>
</body>
</Html>
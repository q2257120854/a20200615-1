<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
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
$keywords=$_REQUEST['keywords'];             ///////搜索关键词
$type=$_REQUEST['type'];                     ///////搜索状态
$searchgo=$_REQUEST['search'];  
if ($_REQUEST['username']!=''){
$_SESSION['check_number']=$_REQUEST['username'];
}
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

<form action="diary_datas.php" method="post">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
关键字输入：            </td>
<td class="left">
<input name="keywords" type="text" maxlength="300" id="keywords"  class="biankuan" placeholder="请输入搜索关键词">
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：            </td>
<td class="left">
<select name="search" id="search">
<option value="username" selected="selected">操作人员</option>
<option value="content">操作内容</option>
</select>
<select name="type" id="type">
<option selected="selected" value="">全部类型</option>
<option value="1">客户级别操作</option>
<option value="2">客户资料操作</option>
<option value="3">客户资金操作</option>
<option value="4">客户权限操作</option>
<option value="5">商品信息操作</option>
<option value="6">系统操作</option>
<option value="7">订单数据操作</option>
<option value="0">其它</option>
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
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="11%" align="center" class="table_top">操作人员</td>
<td width="11%" align="center" class="table_top">操作类型</td>
<td width="38%" align="center" class="table_top">事件内容</td>

<td width="10%" align="center" class="table_top">操作IP</td>
<td width="8%" align="center" class="table_top">操作地区</td>
<td width="15%" align="center" class="table_top">操作时间</td>
<td width="7%" align="center" class="table_top">其它操作</td>
</tr>
<?php
$search="where 1=1"; 
if ($keywords!='')$search.=" and $searchgo like '%$keywords%'"; 
if ($type!='')$search.=" and type='$type'"; 
if ($StartYear!='')$search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `diary` $search  ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);

$sql="select * from diary  $search  order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left"><?=$row['username']?></td>
<td align="center">
<?php
if    ($row['type']=='0') {
echo "其它";
}elseif($row['type']=='1') {
echo "客户级别操作";
}elseif($row['type']=='2') {
echo "客户资料操作";
}elseif($row['type']=='3') {
echo "客户资金操作";
}elseif($row['type']=='4') {
echo "客户权限操作";
}elseif($row['type']=='5') {
echo "商品信息操作";
}elseif($row['type']=='6') {
echo "系统操作";
}elseif($row['type']=='7') {
echo "订单数据操作";
}
?>
</td>
<td align="left"> <?=$row['content']?></td>

<td align="center"><?=$row['youip']?></td>
<td align="center"><?=$row['area']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center">
<?php if ($row['sid']<>0){?>
<a href="Data_recovery.php?id=<?=$row['id']?>">恢复</a>
<?php }else{?>
-
<?php }?>
</td>
</tr>
<?php
 }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px;">
<?=$page->paging();?>   
</td>
</tr>
</table>
</body>
</Html>
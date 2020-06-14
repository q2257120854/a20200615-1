<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$yy=strip_tags($_GET['yy']);
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
$Action=strip_tags($_POST['Action']);
 
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="Menubox" >
<ul>
<li <?php if ($yy==''or $yy=='1'){?> class="hover"<?php } ?>><a href="DHandleSave.php?yy=1">前台供货商(<?php
$total=mysql_num_rows(mysql_query("select * from product_order where username!='' and trading='0'  and refund!=1   and refund!=2  and sid='0' and docking=0",$conn1));
echo $total;
?>)</a></li>

<li <?php if ($yy=='2'){?> class="hover"<?php } ?>><a href="DHandleSave.php?yy=2" >直销平台(<?php
$total=mysql_num_rows(mysql_query("select * from product_order where username='' and trading='0' and refund!=1   and refund!=2  and sid='0' and docking=0",$conn1));
echo $total;
?>)</a></li>
</ul>
</div>
<form action="DHandleSave.php" method="get">
<input type="hidden" name="yy" value="<?=$yy?>">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
搜索关键词：</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">客户编号</option>
<option value="username">供货商编号</option>
<option value="orderid">订单编号</option>
<option value="content1">充值账号</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">全部</option>
<option value="0">等待处理</option>
<option value="2">充值成功</option>
<option value="3">取消充值</option>
<option value="4">已经退单</option>
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
<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="30%" class="table_top">商品</td>
<td width="14%" class="table_top">订单编号</td>
<td width="10%" class="table_top">供货商编号</td>
<td width="12%" class="table_top">充值账户</td>
<td width="6%" class="table_top">数量</td>
<td width="8%" class="table_top">购买客户</td>
<td width="12%" class="table_top">提交时间 </td>
<td width="8%" class="table_top">状态详细</td>
</tr>
<?php
if ($yy=='1' or $yy=='') {
$search="where username<>''  and refund!=1   and sid=0 and docking=0   "; 
}else{
$search="where username=''   and refund!=1   and sid=0 and docking=0"; 
}

if ($StartYear!='' ) $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.="   and $seey like '%$keywords%' "; 
if ($state!='')    $search.="   and trading = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from product_order  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句

while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="32" align="left"><?=$row['title']?><br><span style="color:#F00"><?=yx_product_class($row['directory'])?></span></td>
<td height="32" align="center"><?=$row['orderid']?></td>
<td height="32" align="center"><?=$row['username']?></td>
<td height="32" align="center"><?=$row['content1']?></td>
<td><?=$row['nums']?></td>
<td><?=$row['number']?></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><a  href="#art1" onClick="art.dialog.open('Order/checkorder.php?id=<?=$row[orderid]?>',{title:'订单详细记录',width:900,height:500,lock:true, fixed:true});">
<?php if      ($row['trading']=='0' || $row['trading']=='1' ) {?>
<span class="complaint0">等待处理</span>
<?php }elseif ($row['trading']=='2') {?>
<span class="complaint1">交易成功</span>
<?php }elseif ($row['trading']=='3') {?>
<span class="complaint3">取消充值</span>
<?php }?></a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>   </td>
</tr>
</table>
</form>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
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
?>
<form name="add" method="post" action="Delivery_list.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
</select></td>
</tr>
</table>
</td>
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
<td width="10%" class="table_top">会员编号</td>
<td width="12%" class="table_top">栏目编号</td>
<td width="30%" class="table_top">店铺名称</td>
<td width="12%" class="table_top">店铺收费</td>
<td width="14%" class="table_top">提交时间</td>
<td width="13%" class="table_top">到期时间</td>
<td width="9%" class="table_top">状态</td>
</tr>
<?php
$keyword=strip_tags($_POST['keyword']);  //搜索关键词
$keywords=strip_tags($_POST['keywords']);//查询条件
$search="where 1=1  "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `delivery_record`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from delivery_record  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr>
<td height="34"><?=$row['number']?></td>
<td align="center"><?=$row['proid']?></td>
<td align="left"><?=$row['title']?></td>
<td><?=$row['price']?></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><?php if ($row['begtime']>$begtime){?>未到期<?php }else{?>已到期<?php } ?></td>
</tr>
<?php
$incomes=$incomes+ $row['price'];
}
?>
<tr>
<td height="32" colspan="3" align="right">本页统计</td>
<td><b style="color:red"><?=number_format($incomes,3);?> 元</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td height="32" colspan="3" align="right">综合统计</td>
<td><?php
$res=mysql_query("SELECT sum(price)    FROM `delivery_record`  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?> 元</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="center"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td> 
</tr>
</table>
</form>
</body>
</Html>
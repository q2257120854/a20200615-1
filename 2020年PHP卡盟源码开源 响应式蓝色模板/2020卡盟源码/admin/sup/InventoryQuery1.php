<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
</head>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$NumberID=$_REQUEST['NumberID']; ?>
<body>
<?php include('head.php');?>
<div class="tishi1" style="line-height: 1.5">
<b>说明：</b> 除了“SUP商品进价调低 ”的，其他所有对接异常的商品用户都无法购买，建议重新进行对接调整。“SUP商品进价调低 ”的商品请重新定价否则会导致利润统计不准。
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td class="table_top" width="70%">
异常类型
</td>
<td class="table_top" width="15%">
异常个数
</td>
<td class="table_top" width="15%">
查看具体
</td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?y=3">所有对接异常的商品</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state<0 and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?y=3&state=0">查看所有异常</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-1&y=3">SUP商品进价调高</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-1' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-1&y=3">查看具体</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-2&y=3">SUP商品进价调低</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-2' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-2&y=3">查看具体</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a  href="Inventoryquery.php?state=-3&y=3">进货商为黑名单</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-3' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-3&y=3">查看具体</a></td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-4&y=3">SUP商品未上架</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-4' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?state=-4&y=3">查看具体</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-5&y=3">SUP商品未通过审核</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-5' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-5&y=3">查看具体</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a id="Repeater1_ctl07_HyperLink1" href="Inventoryquery.php?state=-6&y=3">SUP商品为黑名单</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-6' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?state=-6&y=3">查看具体</a></td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-7&y=3">SUP商品已删除</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-7' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-7&y=3">查看具体</a></td>
</tr>
</table>		
</body>
</Html>
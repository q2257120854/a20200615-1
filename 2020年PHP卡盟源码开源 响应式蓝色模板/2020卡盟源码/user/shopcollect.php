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
$Action=strip_tags($_GET['Action']); 
////////删除单记录
if ($Action=="del"){
$Id=inject_check($_GET['Id']);
mysql_query("delete from shops_favorites where id ='$Id' and username='$_SESSION[ysk_number]'",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}
?>
<div class="right">

<div style="width:100%; border:1px #2677d8 solid; background-color:#25aaff;color:#FFFFFF; font-weight:bold;">
<div style=" padding:10px;">
<table width="300" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="30"><img src="images/dp.jpg" /> </td>
<td width="270">店铺收藏夹</td>
</tr>
</table>
</div>
</div>
<div style="width:100%; border:1px #a8c5ed solid; background-color:#eef7ff; ">
<div style=" padding:10px;">

<table cellspacing="1" cellpadding="0" class="table1">
<tr>
<th width="72%">店铺名称</th>
<th width="16%">收藏时间</th>
<th width="12%">操作</th>
</tr>

<?php

$search="where username='$_SESSION[ysk_number]' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `shops_favorites`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$result=mysql_query("select * from shops_favorites $search   {$page->limit}",$conn1);
while ($row=mysql_fetch_array($result)){
?>

<tbody id="contentDiv">
<tr>
<td height="32" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF; text-align:left;">
<a href="product.php?id=<?=$row['uid']?>"><?=yx_product_class($row['uid'])?></a>

</td>

<td><?=date("Y-m-d G:i:s",$row['begtime'])?>

</td>
<td>
<a href="product.php?id=<?=$row['uid']?>">进入店铺</a>
<a href="?Action=del&Id=<?=$row['id']?>" onClick="Javascript:return confirm('亲,您确定要删除该收藏吗？');">删除</a></td>

</tr>
</tbody>
<?php
}
?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:10px;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?>     </td>
</tr>
</table></div>
</div>

</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
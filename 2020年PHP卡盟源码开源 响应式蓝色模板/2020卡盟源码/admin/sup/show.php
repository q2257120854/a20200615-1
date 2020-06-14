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
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$id=inject_check($_REQUEST['id']);
$sqlc="select * from sup_product where id='$id'";   //读取数据表
$zycc=mysql_query($sqlc,$conn2);  //执行该SQl语句
$rowc=mysql_fetch_array($zycc);
$sql="select * from sup_members where number='$rowc[username]'";   //读取数据表
$zyc=mysql_query($sql,$conn2);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<table cellspacing="1" cellpadding="0" class="table2 notd" >
<tr class="tr1">
<td height="32" style="background: #f7fcfe">商品名称：</td>
<td align="left"><?=$rowc['title']?></td>
</tr>
<?php if ($pss_sjxy_open=='0') {?>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">商家信誉：</td>
<td align="left"><?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($row['praise1']-$row['praise3']))?>

</td>
</tr>
<?php } ?>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">商品面值：</td>
<td align="left"><b style="color:red"><?=number_format($rowc['price1'],3);?>元 </b></td>
</tr>

<tr class="tr1">
<td height="32" style="background: #f7fcfe">商品售价：</td>
<td align="left"><?=number_format($rowc['price2'],3);?> 元</td>
</tr>

<tr class="tr1">
<td height="32" style="background: #f7fcfe">供 货 商：</td>
<td align="left">
<?php if ($rowc['username']=='') {?>云搜卡<?php }else{?><?=$row['company']?><?php } ?>
(<?=$rowc['username']?>)</td>
</tr>


<tr class="tr1">
<td height="32" style="background: #f7fcfe">十天断货：</td>
<td align="left">0 次</td>
</tr>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">发布时间：</td>
<td align="left"><?=date("Y-m-d G:i:s",$rowc['time'])?></td>
</tr>


</table>

</body>
</Html>
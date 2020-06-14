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
$NumberID=$_REQUEST['NumberID'];?>
<?php include('head.php');?>
<div class="new_qie9">
<ul>
<?php
$return=mysql_query("select * from `sup_product_class` where LagID=0  and locks=0  order by Classorder asc,id desc limit 0,10",$conn2);
while($row=mysql_fetch_array($return)){?>
<li><a href="CategoryList.php?NumberID=<?=$row['NumberID']?>&y=<?=$_REQUEST['y']?>" <?php if ($row['NumberID']==$NumberID) {?>class="on"<?php } ?>><?=$row['7']?></a></li>
<?php }?>
</ul>
</div>
<?php
$return=mysql_query("select * from `sup_product_class`where LagID=1 and RootID='$NumberID' and locks='0' order by Classorder asc,id desc",$conn2);
while($row=mysql_fetch_array($return)){?>
<div class="clear"></div>
<div class="cate other_cate">
<dl>
<dt class="cate_dt"><span style="color:<?=$row['color']?>"><?=$row['7']?></span></dt>
<?php
$return1=mysql_query("select * from `sup_product_class`where LagID=2 and PartID='$row[NumberID]' and locks='0' order by Classorder asc,id desc",$conn2);
while($row1=mysql_fetch_array($return1)){?>
<dd><span><a href='ProductList.php?id=<?=$row1['NumberID']?>&y=<?=$_REQUEST['y']?>'><font color='<?=$row1['color']?>'><?=$row1['7']?></font></a></span></dd>
<?php }?>
<div class="clear"></div>
</dl></div>
<?php }?>
</body>
</Html>
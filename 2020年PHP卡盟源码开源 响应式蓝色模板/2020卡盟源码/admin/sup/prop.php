<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link rel="stylesheet" type="text/css" href="css/demo.css" />

</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$total1=mysql_num_rows(mysql_query("select * from `product` where sid<>'0'",$conn1));//Sup
$total2=mysql_num_rows(mysql_query("select * from `product` where sid='0' and username is null",$conn1));//主站
$total3=mysql_num_rows(mysql_query("select * from `product` where sid='0' and username<>''",$conn1));//供货商
$zong=$total1+$total2+$total3;
$total1=round($total1/$zong*100,3);
$total2=round($total2/$zong*100,3);
$total3=round($total3/$zong*100,3);
$totala=$total1*3;
$totalb=$total2*3;
$totalc=$total3*3;
$totala="style=\"height:{$totala}px;\"";
$totalb="style=\"height:{$totalb}px;\"";
$totalc="style=\"height:{$totalc}px;\"";
?>
<h1>Sup 信息比例</h1>
<div class="main" >
<div style="float:left">
<img src="css/HI.png" width="46" height="53" />
</div>
<div class="cube-area">
  
  <!-- The colorful bars -->
  
  <div class="cuboid blue">
<div class="cu-top"></div>
<div class="cu-mid" <?=$totala?>><?=$total1?> %</div>
<div class="cu-bottom"></div>
</div>

<div class="cuboid orange">
<div class="cu-top"></div>
<div class="cu-mid" <?=$totalb?>><?=$total2?> %</div>
<div class="cu-bottom"></div>
</div>

<div class="cuboid green">
<div class="cu-top"></div>
<div class="cu-mid" <?=$totalc?>><?=$total3?> %</div>
<div class="cu-bottom"></div>
</div>

<!-- The perspective div is CSS3 transformed -->

<div class="perspective">
</div>
</div>

</div>






</body>
</Html>

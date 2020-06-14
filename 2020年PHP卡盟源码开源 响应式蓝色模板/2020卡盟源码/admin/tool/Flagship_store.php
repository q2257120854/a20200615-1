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

<form action="" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">入驻时间：</td>

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
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="33%" align="center" class="table_top">店铺名称</td>
<td width="15%" align="center" class="table_top">店铺押金</td>
<td width="13%" align="center" class="table_top">所属类目</td>
<td width="19%" align="center" class="table_top">入驻时间</td>
<td width="20%" align="center" class="table_top">过期时间</td>
</tr>
<?php
$search="where 1=1 ";
if ($StartYear!='') $search.=" and begtime>=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `flagship_shops` $search   ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from flagship_shops $search order by id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left"><?=yx_product_class($row['mid'])?></td>
<td align="center"><?=$row['price']?> 元</td>
<td align="center"><?=yx_product_class($row['uid'])?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['overday'])?></td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  style="text-align:center;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
</body>
</Html>
<script>

function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?> - Powered by 聚合社</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html;">
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="css/jquery.form.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/cool.css?4.1.6"><script type="text/javascript" src="css/jquery.artDialog.js?skin=cool"></script>
<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">
</head>
<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/user_check.php');
$NumberID=strip_tags($_GET['NumberID']); 
$result=mysql_query("select * from product_class where NumberID='$NumberID'",$conn1);
$directory=mysql_fetch_array($result);
$now = strtotime(date('Y-m-d'));
?>
<body  >
<div class="ifra-right_con">
<h3 class="column-title">
			<b id="gooddirmenu">商品目录</b>
		</h3>
<div class="card-search bgfff">
			<form action="search.php" method="get" name="searchs">
				<select id="searchType" name="searchType" style="float:left;">
					<option value="1">搜索商品</option>
				</select>
				<input id="keyword" name="keyword" type="text" class="txt-ipt" maxlength="30" size="14" style="float:left;" onfocus="if(value=='输入游戏名或游戏公司名') {value=''}" onkeyup="gamekeyup()" autocomplete="off" size="14">
				<input id="searchGoods" name="searchGoods" type="submit" value="搜索" class="sear-ipt" style="float:left;">
				
				<a href="javascript:void(0);" style="float:left;padding-left:20px; height:25px;line-height:25px;overflow: hidden;" id="rolltxt">
				 
				</a>
				
			</form>
			
		</div>
		
		<div class="Menubox" style=" margin-top:10px">
<ul>

</ul>
</div>
		<div id="goodDirBox">
<div style="width:100%;">
	<div class="all-goods bgfff">
<?php 
$pro_result=mysql_query("select * from product_class where LagID=1 and RootID='$NumberID' and locks='0'  and isno3=0 order by Classorder asc,id desc",$conn1);
while($pro=mysql_fetch_array($pro_result)){
?>
<table class="table4 margin10" cellspacing="1" cellpadding="0">
<tr>

<th width="100%" colspan="5" align="left"  >
<div >&nbsp;<font  size="2px"; face="微软雅黑" color='<?=$pro['color']?>'><?=$pro['7']?><?php if ($pro['shop_name']!=''){?> <?php }?></font></div>
</th>
</tr>
<?php
$presult=mysql_query("select * from product_class where LagID=2 and PartID='$pro[NumberID]' and locks=0  and isno3=0 order by $shop_sort desc,Classorder asc",$conn1);
$total=mysql_num_rows($presult);
if ($total>0){
?>
<tr> 
<?php
$j=0;
while($pr1=mysql_fetch_array($presult)){
$j++;
?>
<td  height="32" width="20%">
<?php
if($pr1['begtime'] > $now ){?>
<a href="product.php?id=<?=$pr1['NumberID']?>" class="link1">
<span style="color:<?=$pr1['color']?>"><?=$pr1['7']?>
<?php if ($pr1['shop_name']!=''){?> <?php }?>
</span>
</a>
<?php } else{ ?>
<a href="product.php?id=<?=$pr1['NumberID']?>" class="link1">
<span style="color:<?=$pr1['color']?>"><?=$pr1['7']?>
<?php if ($pr1['shop_name']!=''){?><?php }?>
</span>
</a>
 <?php } ?>
</td>

<?php if ($j % 5==0){?></tr><?php }?>

<?php
if ($j==5)$j=0;
}
if ($j!=0){
for ($y=1; $y<=5-$j;$y++) {?><td></td><?php }} ?>
</tr>
<?php } ?>
</table>
<?php } ?></div></div></div>
</div>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function CheckQuery(){
if (document.getElementById("keyword").value == "" || document.getElementById("keyword").value == "输入游戏名或游戏公司名"){
alert("请输入查询关键字！");
 return false;
} 
return true;
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
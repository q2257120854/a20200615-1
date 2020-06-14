<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$keyword=strip_tags($_GET['keyword']);
$check=$_REQUEST['check'];
if ($check!=''){
$_SESSION['ysk_check']=$check;
}
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<!-- 框架元素 开始 -->
<link href="css/rightload.css" type="text/css" rel="stylesheet" />
<!-- 框架元素 结束 -->

<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/stylegoods.css" rel="stylesheet" type="text/css" />
<!-- 基本元素 结束 -->

<!-- 特效元素 开始 -->
<script src="css/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<!-- 特效元素 结束 -->

<!-- 父弹窗元素 开始 -->
<script src="css/dialog.js" type="text/javascript"></script>
<link href="css/dialog.css" rel="stylesheet" type="text/css" />
<!-- 父弹窗元素 结束 -->

<!-- 加密元素 开始 -->
<script type="text/javascript" src="css/RSA.js"></script>  
<script type="text/javascript" src="css/BigInt.js"></script>  
<script type="text/javascript" src="css/Barrett.js"></script>
<!-- 加密元素 结束 -->

<!-- 弹窗元素 开始 -->
<script src="css/layer.js"></script>
<!-- 弹窗元素 结束 -->

</head>
<body>
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



<table cellspacing="1" cellpadding="0" class="table1">
<tr>
<th width="6%">编号</th>
<th width="34%">商品名称</th>
<th width="11%">面值</th>
<th width="11%">购价</th>
<th width="11%">库存状态</th>
<th width="8%">收藏</th>
<th width="12%">购买类型</th>
</tr>
<?php
$search="where  locks=2 and state<2 and state>=0"; 
if ($keyword!='') {$search.=" and title like '%$keyword%' ";}

$total=mysql_num_rows(mysql_query("SELECT * from `product` $search ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$yx_pro_result=mysql_query("select * from product $search order by paixu asc,id desc {$page->limit} ",$conn1);
while ($yx_pro=mysql_fetch_array($yx_pro_result)){?>
<tbody id="contentDiv">
<tr>
<td height="32" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF; "><?=$yx_pro['id']?></td>
<td height="32" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF; text-align:left;">
<a href="#" onClick="$.dialog.open('Product.php?id=<?=$yx_pro['id']?>&Action=js', {title: '商品介绍', width: 500, height: 200, lock: true, fixed:true});">
<span style="color:<?=$yx_pro['color']?>"><?=$yx_pro['title']?></span></a>
<span style="color:#999999">
</span></td>
<td><?=number_format($yx_pro['price1'],3)?> <?=$moneytype?> </td>
<td class="tp" style="color:#F00"><?=ysk_buy_Price($yx_us['level'],$yx_pro['price2'],$yx_pro['pricing'],$yx_pro['rate'])?> <?=$moneytype?></td>
<td align="center">
<?php
if  ($yx_pro['modl']=='卡密' || $yx_pro['modl']=='选号'){
if ($yx_pro['sid']!='0'){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$yx_pro[sid]' and locks=0 ",$conn2));
}else{
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$yx_pro[id]' and locks=0 ",$conn1));
}
$kucun=$kucun_total;
}elseif($yx_pro['modl']=='网盘'){
$kucun="999";
}else{
$kucun=	$yx_pro['kucun'];
}
$yx_inventory=new goods();  
echo $yx_inventory->inventory($kucun)?></td>
<td align="center" style="color:Black;">
					<a href="javascript:alert('收藏成功')">
                <img class="imghand" src="images/shouchang.png" onClick="checkfavorites('Product_favorites',<?=$pro['id']?>)" alt="收藏">
            </a>
					</td>
<td align="center" style="color:Black;">
<?php
$yx_inventory=new goods();  
echo $yx_inventory->buy_button($_SESSION['ysk_number'],$yx_pro['username'],$yx_pro['state'],$yx_pro['modl'],$yx_pro['reason'],$yx_pro['id'],$kucun,$yx_pro['sid'])?>
</td>
</tr>
</tbody>
<?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center; padding-top:10px;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>

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
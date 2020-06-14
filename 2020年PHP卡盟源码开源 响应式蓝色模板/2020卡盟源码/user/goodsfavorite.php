
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>

<meta http-equiv="Content-Type" content="text/html;">


<!-- 基本元素 开始 -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 复选元素 开始 -->
<script src="CheckBoxUtil.js" type="text/javascript"></script>
<!-- 复选元素 结束 -->

<!-- 弹窗元素 开始 -->
<link rel="stylesheet" href="css/cool.css?4.1.6"><script type="text/javascript" src="css/jquery.artDialog.js"></script>
<!-- 弹窗元素 结束 -->
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
////////删除单记录
If ($Action=="del") {
mysql_query("delete from product_favorites where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}
?>
<div class="right">
<div class="" style="display: none; position: absolute;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;"></div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>我的收藏夹</b>
		</h3>
			<div id="box" class="capi-tbl capital">

<table >
<thead>
<tr>
<th width="4%">选择</th>
<th width="5%">商品编号</th>
<th width="38%">商品名称</th>
<th width="11%">面值</th>
<th width="11%">购价</th>
<th width="11%">库存状态</th>
<th width="13%">购买类型</th>
<th width="8%">操作</th>
</tr>
</thead>

<?php

$id=$_REQUEST['id'];    //搜索关键词
$search="where number='$_SESSION[ysk_number]' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_favorites`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sqlp="select * from product_favorites $search   {$page->limit}"; 
$zycp=mysql_query($sqlp,$conn1);  //执行该SQl语句
while ($row2=mysql_fetch_array($zycp)){
$sql="select * from product where id='$row2[pid]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<tbody id="contentDiv">
<tr>
<td><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row['id']?>"></td>
<td><span><?=$row['id']?></span></td>
<td>
<span style="color:<?=$row['color']?>"><?=$row['title']?></span></td>
<td><?=$row['price1']?> <?=$moneytype?> </td>
<td class="tp"><?=$row['price2']?> <?=$moneytype?>
</td>
<td>
<?php
if  ($row['modl']=='卡密' || $row['modl']=='选号'){
if ($row['sid']!='0'){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$row[sid]' and locks=0 ",$conn2));
}else{
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$row[id]' and locks=0 ",$conn1));
}
$kucun=$kucun_total;
}elseif($row['modl']=='网盘'){
$kucun="999";
}else{
$kucun=	$row['kucun'];
}
$yx_inventory=new goods();  
echo $yx_inventory->inventory($kucun)?>
</td>

<td align="center" style="color:Black;">
<?php
$yx_inventory=new goods();  
echo $yx_inventory->buy_button($_SESSION['ysk_number'],$row['username'],$row['state'],$row['modl'],$row['reason'],$row['id'],$kucun,$yx_pro['sid'])?>

</td>
<td><a href="?Action=del&Id=<?=$row2['id']?>" onClick="Javascript:return confirm('亲,您确定要删除该收藏吗？');">删除</a></td>

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
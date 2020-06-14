
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>聚合社</title>
</head>
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
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

<body>
<?php
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$check=strip_tags($_GET['check']); 
$page=strip_tags($_GET['page']); 
$keyword=strip_tags($_POST['keyword']); 
$id=inject_check($_GET['id']);
$gogo=inject_check($_GET['gogo']);
if ($check!=''){
$_SESSION['ysk_check']=$check;
}

//---------------------------------------读取商品目录

$results=mysql_query("select * from product_class where NumberID='$id' ",$conn1);
$directory=mysql_fetch_array($results);

//---------------------------------------读取供货商资料

$goods_result=mysql_query("select * from members  where number='$directory[number]' ",$conn1);
$goods=mysql_fetch_array($goods_result);


if ($Action==''){
$search=" where  locks=2 and state<2 and state>=0"; 
if ($id!='') $search.=" and directory3 = '$id'"; 
if ($keyword!='') $search.=" and title like '%$keyword%'"; 
$total=mysql_num_rows(mysql_query("SELECT * from `product` $search ",$conn1));  //查询总记录！
$zong=mysql_num_rows(mysql_query("select * from `flagship_shops` where mid='$id' ",$conn1));

//列出收藏夹资料
$yresult=mysql_query("select * from product_favorites  where number='$_SESSION[ysk_number]'",$conn1);
while ($pro=mysql_fetch_array($yresult)){
$favorites.=$pro['pid'].',';
}
//构造出id字符串
$strid=substr($favorites,0,strlen($favorites)-1);
//列出收藏夹资料
//$zonger=mysql_num_rows(mysql_query("select * from  product $search and id in($strid) ",$conn1));


//列出收藏夹资料
//$yresult=mysql_query("select * from product $search and id in($strid)",$conn1);
while ($pro=mysql_fetch_array($yresult)){
$favor.=$pro['id'].',';
}
$strid=substr($favor,0,strlen($favor)-1);
//实例化地区
$yx_area=new area(); 
//实例化库存
$yx_inventory=new goods();?>
<script type="text/javascript" language="javascript" >
<!--
function checkfavorites(type,id){
var dataString = 'id='+ id + '&type='+ type;
$("#"+type+"_"+id).fadeIn(400).html('<img src="images/loading.gif" />');
$.ajax({
type: "POST",
url: "ajax.php",
data: dataString,
cache: false,
success: function(result){
if(result){
$("#"+type+"_"+id).html(result);
}
}
});
}

function display(obj){
document.getElementById("box"+obj).style.display="block"; 
}
function disappear(obj){
document.getElementById("box"+obj).style.display="none"; 
}
-->
</script>

<tr>
<td >
<?php if ($total>0){?>
<!--收藏夹-->
<?php if ($zonger>0 && $gogo==''){?><div id="store_bk_d"><ul><li>我的收藏</li></ul></div>
<div id="goodDirBox">
<div  class="goods-col g-list-right" style="width:100%; float:left">
<table class="table2" cellspacing="1" cellpadding="0" border="0" id="gvNews" style="color:#333333;width:100%;border: 1px solid #e1e1e1;">
		<tbody>
		<tr style="color:Black;background-color:#5D7B9D;/* font-weight:bold; */">
			<th scope="col" style="height:25px;width:6%;">编号</th>
			<th scope="col" style="height:25px;width:42%;">商品名称</th>
			<th scope="col" style="height:25px;width:11%;">面值</th>
			<?php if  ($_SESSION['ysk_check']=='1') {?><th scope="col" style="height:25px;width:11%;">购价</th><?php } ?>
			<th scope="col" style="height:25px;width:11%;">库存状态</th>
			<th scope="col" style="height:25px;width:12%;">购买类型</th>
			<th scope="col" style="height:25px;width:7%;">更多</th>
			 
		</tr>
		<?php
$result=mysql_query("select * from product where id in ($strid)  order by paixu asc,id desc",$conn1);
while ($pro=mysql_fetch_array($result)){?>
		<tr  onMouseOver="this.style.backgroundColor='#CCCCCC';" onMouseOut="this.style.backgroundColor='';" style="background-color: rgb(255, 255, 255);">
			<td align="center" style="color:Black;height:20px;">
                       <?=$pro['id']?>
                    </td><td align="left" style="color:Black;">
					<a href="#" onClick="art.dialog.open('/user/Product.php?id=<?=$pro['id']?>&Action=js',{title:'商品介绍',width:500,lock:true,fixed:true});"><span style=" float:left; padding-left:2px;color:<?=$pro['color']?>"><?=$pro['title']?></span></a><span style="color:#999999">
(<?=$yx_area->region($pro['provinces'],$pro['citys'])?>)</span>
                    </td><td align="center" style="color:Black;">
                        <?=number_format($pro['price1'],3)?> <?=$moneytype?>
                    </td>
					<?php if($_SESSION['ysk_check']=='1') {?>
					<td align="center" style="color:Black;">
                        <?=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])?> <?=$moneytype?>
                    </td><?php } ?>
					<td align="center" style="">
                       <?php
if  ($pro['modl']=='卡密' || $pro['modl']=='选号'){
if      ($pro['sid']!=0  && $pro['pid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$pro[sid]' and locks=0 ",$conn2));
}elseif ($pro['pid']!=0  && $pro['sid']==0){
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[pid]' and locks=0 ",$conn3));
}elseif ($pro['pid']==0  && $pro['sid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[id]' and locks=0 ",$conn1));
}
$kucun=$kucun_total;
}elseif($pro['modl']=='网盘'){
$kucun="999";
}else{
$kucun=	$pro['kucun'];
}
echo $yx_inventory->inventory($kucun)?>
                    </td><td align="center" style="color:Black;">
                       <?=$yx_inventory->buy_button($_SESSION['ysk_number'],$pro['username'],$pro['state'],$pro['modl'],$pro['reason'],$pro['id'],$kucun,$pro['sid'])?>
                    </td>
					<td align="center" style="color:Black;" onMouseOver="display(<?=$pro['id']?>)" onMouseOut="disappear(<?=$pro['id']?>)">
                       <div class="box" id="box<?=$pro['id']?>">
<div style="width:100%; float:left">
<span id="Product_favorites_<?=$pro['id']?>">
<a onClick="checkfavorites('Product_favorites',<?=$pro['id']?>)" style="cursor:pointer">收藏</a></span>
</div>
<?php if ($pro['docking']==0 and $pro['sid']==0) {?>
<div style="width:100%; float:left">
<a href="#art1" onClick="art.dialog.open('/user/report.php?id=<?=$pro['id']?>',{title:'举报该商品',width:800,lock:true,fixed:true});">举报</a>
</div>
<?php } ?>
</div>
更多
                    </td>
					
		</tr>
		<?php }?> 
	    </tbody>
	</table>
</div>
<?php } ?>
<!--收藏夹 The End-->

<!--栏目-->
<?php
if ($gogo==''){
$cresult=mysql_query("select * from store_class where username='$directory[number]'",$conn1);
}else{
$cresult=mysql_query("select * from store_class where username='$directory[number]' and id='$gogo'",$conn1);
}
while ($yxc=mysql_fetch_array($cresult)){?>
<div id="store_bk_d"><ul><li><?=$yxc['title']?></li></ul></div>
<div style="width:100%; float:left">





<table class="table2" cellspacing="1" cellpadding="0" border="0" id="gvNews" style="color:#333333;width:100%;border: 1px solid #e1e1e1;">
		<tbody>
		<tr style="color:Black;background-color:#5D7B9D;/* font-weight:bold; */">
			<th scope="col" style="height:25px;width:6%;">编号</th>
			<th scope="col" style="height:25px;width:42%;">商品名称</th>
			<th scope="col" style="height:25px;width:11%;">面值</th>
			<?php if  ($_SESSION['ysk_check']=='1') {?><th scope="col" style="height:25px;width:11%;">购价</th><?php } ?>
			<th scope="col" style="height:25px;width:11%;">库存状态</th>
			<th scope="col" style="height:25px;width:12%;">购买类型</th>
			<th scope="col" style="height:25px;width:7%;">更多</th>
			 
		</tr>
		<?php
$result=mysql_query("select * from product $search and Store_class='$yxc[id]'  order by paixu asc,id desc",$conn1);
while ($pro=mysql_fetch_array($result)){?>
		<tr  onMouseOver="this.style.backgroundColor='#CCCCCC';" onMouseOut="this.style.backgroundColor='';" style="background-color: rgb(255, 255, 255);">
			<td align="center" style="color:Black;height:20px;">
                       <?=$pro['id']?>
                    </td><td align="left" style="color:Black;">
					<a href="#" onClick="art.dialog.open('/user/Product.php?id=<?=$pro['id']?>&Action=js',{title:'商品介绍',width:500,lock:true,fixed:true});"><span style=" float:left; padding-left:2px;color:<?=$pro['color']?>"><?=$pro['title']?></span></a><span style="color:#999999">
(<?=$yx_area->region($pro['provinces'],$pro['citys'])?>)</span>
                    </td><td align="center" style="color:Black;">
                        <?=number_format($pro['price1'],3)?> <?=$moneytype?>
                    </td>
					<?php if($_SESSION['ysk_check']=='1') {?>
					<td align="center" style="color:Black;">
                        <?=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])?> <?=$moneytype?>
                    </td><?php } ?>
					<td align="center" style="color:Black;">
                       <?php
if  ($pro['modl']=='卡密' || $pro['modl']=='选号'){
if      ($pro['sid']!=0  && $pro['pid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$pro[sid]' and locks=0 ",$conn2));
}elseif ($pro['pid']!=0  && $pro['sid']==0){
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[pid]' and locks=0 ",$conn3));
}elseif ($pro['pid']==0  && $pro['sid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[id]' and locks=0 ",$conn1));
}
$kucun=$kucun_total;
}elseif($pro['modl']=='网盘'){
$kucun="999";
}else{
$kucun=	$pro['kucun'];
}
echo $yx_inventory->inventory($kucun)?>
                    </td><td align="center" style="color:Black;">
                       <?=$yx_inventory->buy_button($_SESSION['ysk_number'],$pro['username'],$pro['state'],$pro['modl'],$pro['reason'],$pro['id'],$kucun,$pro['sid'])?>
                    </td>
					
					
		</tr>
		<?php }?> 
	    </tbody>
	</table>
</div>
<?php } ?>
<!--栏目 The End-->


<!--默认栏目-->
<?php
$znum=mysql_num_rows(mysql_query("select * from product $search  and Store_class='0'  order by paixu asc,id desc",$conn1));
if ($znum>0 && $gogo==''){
?>
<body style="height: 733px;"><div style="position: absolute; left: -9999em; top: 312px; width: auto; z-index: 1987;" class="aui_state_focus"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;">消息</div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"><div class="aui_loading"><span>loading..</span></div></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b id="gooddirmenu">商品列表</b>
		</h3>
		
		
		<div id="showDrem" class="card-recomm-list">


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="goods-col g-list-right">
<table>
		<thead>
				<tr>
					<th width="4%">编号</th>
					<th width="34%">商品名称</th>
					<th width="6%">销售价格</th>
					<th width="10%">库存状态</th>
					<th width="4%">收藏商品</th>
					<th width="10%">购买商品&nbsp;&nbsp;&nbsp;</th>
				</tr>
			</thead>
			<tbody>
		<?php
$result=mysql_query("select * from product $search  and Store_class='0' order by paixu asc,id desc",$conn1);
while ($pro=mysql_fetch_array($result)){?>

		<tr  onMouseOver="this.style.backgroundColor='#CCCCCC';" onMouseOut="this.style.backgroundColor='';" style="background-color: rgb(255, 255, 255);">
			<td align="center" style="color:Black;height:20px;">
                       <?=$pro['id']?>
                    </td><td align="left" style="color:Black;">
					<span style=" float:left; padding-left:2px;color:<?=$pro['color']?>"><?=$pro['title']?></span>
                    </td>
					
					<td align="center" style="color:Black;">
                        <?=number_format($pro['price2'],2)?> <?=$moneytype?>
                    </td>
					<td align="center" style="color:Black;">
                       <?php
if  ($pro['modl']=='卡密' || $pro['modl']=='选号'){
if      ($pro['sid']!=0  && $pro['pid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$pro[sid]' and locks=0 ",$conn2));
}elseif ($pro['pid']!=0  && $pro['sid']==0){
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[pid]' and locks=0 ",$conn3));
}elseif ($pro['pid']==0  && $pro['sid']==0){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods` where      pid='$pro[id]' and locks=0 ",$conn1));
}
$kucun=$kucun_total;
}elseif($pro['modl']=='网盘'){
$kucun="999";
}else{
$kucun=	$pro['kucun'];
}
echo $yx_inventory->inventory($kucun)?>
                    </td>
					
					<td align="center" style="color:Black;">
					<a href="javascript:alert('收藏成功')">
                <img class="imghand" src="images/shouchang.png" onClick="checkfavorites('Product_favorites',<?=$pro['id']?>)" alt="收藏">
            </a>
					</td>
					<td align="center" style="color:Black;">
                       <?=$yx_inventory->buy_button($_SESSION['ysk_number'],$pro['username'],$pro['state'],$pro['modl'],$pro['reason'],$pro['id'],$kucun,$pro['sid'])?>
                    </td>
					
					
		</tr>
		<?php }?> 
	    </tbody>
	</table>
</div>
<!--默认栏目 The End-->
<?php }?>
<?php }else{?>

<div id="searchResultTip">
	<div class="have-no-result fn-clear">
		<div class="module-myrecord-msg fn-clear">
			<img src="css/images/juhesheNogoods.jpg" alt="没有交易记录" class="fn-left">

			<div class="fn-left">
				<p class="module-myrecord-msg-txt">该专区没有上架商品</p>
				<a href="juheshe.php?NumberID=H001" target="right" title="逛逛其他专区" class="module-myrecord-msg-link" seed="i-record-more">逛逛其他专区 &gt;&gt;</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>

</td>
</tr>
<!--详细内容 The End-->

</table>
<?php }elseif($Action=='js'){
$id=inject_check($_GET['id']);
$yx_proz_result=mysql_query("select * from product where id='$id' ",$conn1);
$yx_proz=mysql_fetch_array($yx_proz_result);?>
<div style="padding:10px; line-height:240%">
产品名称：<b style="color:<?=$yx_proz['color']?>"><?=$yx_proz['title']?></b><br />
<?php if($yx_proz['content']!='') {?>产品简介：<?=$yx_proz['content']?><br /><?php } ?>
<?php if($yx_proz['matters']!='') {?>注意事项：<?=$yx_proz['matters']?><br /><?php } ?>
<?php if($yx_proz['service']!='') {?>客服联系：
<?php if ($yx_proz['service']!=''){
	
$allArray=(explode("|",$yx_proz['service']));
foreach($allArray as $value){?>
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$value?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$value?>:51" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle"/></a> 
<?php }}?>
</div>
<?php }?>
<?php }elseif ($Action=='a' or $Action=='b'){
$id=inject_check($_GET['id']);
$yx_proz_result=mysql_query("select * from product where id='$id' ",$conn1);
$yx_proz=mysql_fetch_array($yx_proz_result);?>
<div style="padding:10px; line-height:240%;">
<?php if ($Action=='a') {?>
<center>
<h1 style="font-size:14px;"><?=$yx_proz['title']?>
<?php if ($yx_proz['state']=='1'){?>暂停说明<?php }elseif ($yx_proz['state']=='2') {?>禁售说明<?php } ?></h1>
</center>
<hr />
<?=$yx_proz['reason']?>
<?php }else{?>
<center><h1 style="font-size:14px;">购买注意事项</h1></center><hr />
<div style="border:3px #FF0000 dashed; padding:10px; text-align:center; margin-top:10px;">
<?=strip_tags($yx_proz['focus'])?>
</div>
<?php } ?>
<?php if ($yx_proz['state']!='1' and  $yx_proz['state']!='2' ) {?>
<div style="padding:10px; text-align:center;">
<?php if ($yx_proz['modl']=='卡密' or $yx_proz['modl']=='卡密直充') {?>
<input id="btnAll" type="button" value="确认购买"  onClick="location.href='buy_km.php1?id=<?=$yx_proz['id']?>'" class="button_buy" />
<?php }elseif ($yx_proz['modl']=='选号' ) {?>
<input id="btnAll" type="button" value="确认购买"  onClick="location.href='buy_xh.php?id=<?=$yx_proz['id']?>'" class="button_buy" />
<?php }else{?>
<input id="btnAll" type="button" value="确认购买"  onClick="location.href='buy.php?id=<?=$yx_proz['id']?>'" class="button_buy" />
<?php } ?>
</div>
<?php } ?>
</div>
<?php } ?>
</body>
</Html>
<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script charset="utf-8"  src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>

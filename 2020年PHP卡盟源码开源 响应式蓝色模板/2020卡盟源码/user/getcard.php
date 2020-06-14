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
$Action=$_REQUEST['Action'];
if ($Action=='') {?>
<div style="width:100%; border:1px #2677d8 solid; background-color:#25aaff;color:#FFFFFF; font-weight:bold;">
<div style=" padding:10px;">
<table width="300" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="30"><img src="images/dp.jpg" /> </td>
<td width="270">库存提取卡密</td>
</tr>
</table>
</div>
</div>
<div style="width:100%; border:1px #a8c5ed solid; background-color:#eef7ff; ">
<div style=" padding:10px;">
<table cellspacing="1" cellpadding="0" class="table1">
<tr>
<th width="46%">商品名称</th>
<th width="11%">购买时间</th>
<th width="11%">库存数量</th>
<th width="11%">库存取卡</th>
</tr>
<?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order` where buyaction='1' and number='$_SESSION[ysk_number]' ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql=mysql_query("select * from product_order where buyaction='1' and number='$_SESSION[ysk_number]' order by time desc,id desc {$page->limit}",$conn1);
while($row=mysql_fetch_array($sql)){
?>
<tbody id="contentDiv">
<tr>
<td height="32" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF; text-align:left;">
<?=$row['title']?></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['nums']?></td>
<td style="padding-top:5px;"><a  href="#art1" onClick="art.dialog.open('/user/getcard.php?Action=edit&id=<?=$row['orderid']?>',{title:'提取卡密',width: 800,lock:true, fixed:true});"> <img src="images/001.png" /></a></td>
</tr>
</tbody>
<?php } ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:10px;"><?php if ($total!='0'){?><?=$page->paging();?><?php } ?> </td>
</tr>
</table>
</div>
</div>
<?php }elseif ($Action=='edit'){ 
$id=inject_check($_REQUEST[id]);
mysql_query("update product_order set buyaction='0' where orderid='$id' ",$conn1); 

$yx_dresult=mysql_query("select * from product_order  where  orderid='$id'",$conn1);
$ord=mysql_fetch_array($yx_dresult);

$yx_p_result=mysql_query("select * from product where id='$ord[pid]'",$conn1);
$pro=mysql_fetch_array($yx_p_result);

if ($pro['sid']==0 && $pro['pid']==0){
$import_goods='import_goods';
$cloud_key='cloud_key';
$pid=$pro['id'];
$datas='conn1';
}elseif($pro['sid']!=0 && $pro['pid']==0){
$pid=$pro['sid'];
$import_goods='sup_import_goods';
$cloud_key='sup_cloud_key';
$datas='conn2';
}elseif($pro['sid']==0 && $pro['pid']!=0){
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
$pid=$pro['pid'];
$import_goods='import_goods';
$cloud_key='cloud_key';
$datas='conn3';
}
?>
<div style="padding:10px">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr><td width="14%" height="32" class="td_left">商品名称：</td><td width="86%"><?=$ord['title']?></td></tr>
<tr><td height="32" class="td_left">充值地址：</td><td><a href="<?=$ord['url']?>" target="_blank"><?=$ord['url']?></a></td></tr>
<?php if ($ord['passwords']!=''){?>
<tr><td height="32" class="td_left">网盘密码：</td><td><?=$ord['passwords']?></td></tr>
<?php }elseif ($pro['Api']==''){

$kpresul=mysql_query("select * from $import_goods  where orderid='$ord[orderid]' and  locks='1' ",$$datas);
while($kpr=mysql_fetch_array($kpresul)){?>
<tr><td height="32" class="td_left">卡号：</td><td><?=$kpr['card']?></td></tr>
<tr><td height="32" class="td_left">密码：</td><td><?=$kpr['password']?></td></tr>
<tr><td height="32" colspan="2" class="td_left">&nbsp;</td></tr>
<?php } 
}elseif($pro['Api']=='欧飞') {
$doc = new DOMDocument();
$doc->load( 'kami/'.$ord[orderid].'.xml' );
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$cardno = $book->getElementsByTagName( "cardno" );
$cardno = $cardno->item(0)->nodeValue;
$cardpws = $book->getElementsByTagName( "cardpws" );
$cardpws = $cardpws->item(0)->nodeValue;
$expiretime = $book->getElementsByTagName( "expiretime" );
$expiretime = $expiretime->item(0)->nodeValue;	
?>
<tr><td height="32" class="td_left">卡号：</td><td><?=$cardno?></td></tr>
<tr><td height="32" class="td_left">密码：</td><td><?=$cardpws?></td></tr>
<tr><td height="32" class="td_left">到期时间：</td><td><?=$expiretime?></td></tr>
<tr><td height="32" colspan="2" class="td_left">&nbsp;</td></tr>
<?php }} ?>
</table>

<center><br />
<input name="关闭" type="button" class="button_close" id="Button2"  onClick="cl()" value="关闭" /></center>
</div>
<?php } ?>


</body>
</Html>
<script language="javascript">
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
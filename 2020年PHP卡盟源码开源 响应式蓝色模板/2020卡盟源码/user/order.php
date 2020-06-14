<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<script>
function cl()
{ 
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}

function doPrint() { 
bdhtml=window.document.body.innerHTML; 
sprnstr="<!--startprint-->"; //开始打印标识字符串有17个字符
eprnstr="<!--endprint-->"; //结束打印标识字符串
prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); //从开始打印标识之后的内容
prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); //截取开始标识和结束标识之间的内容
window.document.body.innerHTML=prnhtml; //把需要打印的指定内容赋给body.innerHTML
window.print(); //调用浏览器的打印功能打印指定区域
window.document.body.innerHTML=bdhtml; // 最后还原页面
}
</script>
</head>
<body>
<?php 
include_once('../jhs_config/function.php');
$id=inject_check($_GET['id']);    #订单编号
$check=strip_tags($_GET['check']);#是否主站查看该订单
$Token=strip_tags($_GET['Token']);#是否供货商查看该订单
//------------------------------------------------------------------------------------获取主站云端
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number'  ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);
//------------------------------------------------------------------------------------获取订单数据
$order_result=mysql_query("select * from product_order where  orderid='$id'",$conn1);
$order=mysql_fetch_array($order_result);

//====================================================================================安全验证

if ($order['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，没有找到该订单呀!";
exit();
}

if ($check=='' && $Token=='' && $order['number']!=$_SESSION['ysk_number']){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，非法操作!";
exit();
}

if ($check=='' && $Token!='' && $order['username']!=$_SESSION['ysk_number']){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，非法操作!";
exit();
}

//====================================================================================安全验证结束
if     ($order['sid']==0 && $order['docking']==0){
$import_goods='import_goods';
$pid=$order['pid'];
$datas="conn1";
}elseif($order['sid']!=0 && $order['docking']==0){
$pid=$order['sid'];
$import_goods='sup_import_goods';
$datas="conn2";
}elseif($order['pid']!=0 && $order['docking']!=0){
$import_goods='import_goods';
$pid=$order['pid'];
$datas="conn3";
//============获取对接平台数据
$sresult=mysql_query("select * from docking_platform where id='$order[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
}
?>
<!--startprint-->
<table cellspacing="1" cellpadding="3" class="table4">
<?php
$results=mysql_query("select * from refund_event where sid='$order[orderid]'",$conn1);
$rs=mysql_fetch_array($results);
if ($rs['id']!=''){
?>
<tr><th colspan="4" align="left"><span style="color:#FF0000">退款原因</span></th></tr>
<tr>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">主题：</td>
<td colspan="3" align="left" class="tdleft"><?=$rs['title']?></td>
</tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">内容：</td>
<td colspan="3" align="left" class="tdleft"><?=$rs['content']?></td>
</tr>
<?php } ?>
<tr><th colspan="4" align="left">商品情况</th></tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">商品名称：</td>
<td width="40%" align="left" class="tdleft"><?=$order['title']?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">商品类型：</td><td width="40%" class="tdleft"><?=$order['type']?></td>
</tr>
<tr>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">商品面值：</td><td class="tdleft"><?=number_format($order['price'],3)?> <?=$moneytype?></td>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">
卖家：</td>
<td class="tdleft"> <?=$order['username']?> 
<?php 
$gh_result=mysql_query("select * from members where number='$order[username]'",$conn1);
$gh_us=mysql_fetch_array($gh_result);?>
信誉：<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($gh_us['praise1']-$gh_us['praise3']))?>
</td>
</tr>
<tr><th colspan="4" align="left">订单详细</th></tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">订单号码：</td>
<td width="40%" align="left" class="tdleft"><?=$order['orderid']?> </td>
<td width="14%"  align="right" bgcolor="#F1FAFF">购买数量：</td><td width="40%" class="tdleft"><?=$order['nums']?></td>
</tr>

<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">购买金额：</td>
<td width="40%" align="left" class="tdleft"><?=$order['buyprice']?> * <?=$order['nums']?> = <?=$order['zongprice']?> <?=$moneytype?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">网络IP：</td><td width="40%" class="tdleft"><?=$order['youip']?>(<?=$order['network']?>)</td>
</tr>
<?php if ($order['type']=='卡密' || $order['type']=='卡密直充' || $order['type']=='选号' || $order['type']=='网盘') {?>
<?php if ($order['type']=='卡密' || $order['type']=='卡密直充' || $order['type']=='选号' || $order['type']=='网盘') {?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">充值网址：</td>
<td colspan="3" align="left" class="tdleft"><a href="<?=$order['url']?>" target="_blank"><?=$order['url']?></a></td>
</tr>
<?php } ?>

<?php
if ($order['Api']=='欧飞'){
$doc = new DOMDocument();
$doc->load( 'kami/'.$order['orderid'].'.xml' );
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$cardno = $book->getElementsByTagName( "cardno" );
$cardno = $cardno->item(0)->nodeValue;
$cardpws = $book->getElementsByTagName( "cardpws" );
$cardpws = $cardpws->item(0)->nodeValue;
$expiretime = $book->getElementsByTagName( "expiretime" );
$expiretime = $expiretime->item(0)->nodeValue;
?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">账户：</td><td width="40%" align="left" class="tdleft"><?=$cardno?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">密码：</td><td width="40%" class="tdleft"><?=$cardpws?></td>
</tr>
<?php
}
}elseif($order['type']=='网盘' && $order['passwords']!=''){?>
<tr>
<td width="14%"  align="right" bgcolor="#F1FAFF">密码：</td><td colspan="3" class="tdleft"><?=$order['passwords']?>  </td>
</tr>
<?php
}elseif ($order['type']=='卡密' ||  $order['type']=='选号'  && $order['Api']==''){
$kpresul=mysql_query("select * from $import_goods  where orderid='$order[orderid]' and  locks='1' ",$$datas);
while($kpr=mysql_fetch_array($kpresul)){?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">卡号：</td><td width="40%" align="left" class="tdleft"><?=$kpr['card']?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">密码：</td><td width="40%" class="tdleft"><?=$kpr['password']?></td>
</tr>
<?php
}}}
?>



<?php if ($order['custom1']!='' or $order['custom2']!='' ) {?>
<tr>
<?php if ($order['custom1']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom1']?>：</td>
<td width="40%" align="left" class="tdleft"><?=$order['content1']?></td>
<?php } ?>
<?php if ($order['custom2']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom2']?>：</td><td width="40%" class="tdleft"><?=$order['content2']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom3']!='' or $order['custom4']!='' ) {?>
<tr>
<?php if ($order['custom3']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom3']?>：</td>
<td width="40%" align="left" class="tdleft"><?=$order['content3']?></td>
<?php } ?>
<?php if ($order['custom4']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom4']?>：</td><td width="40%" class="tdleft"><?=$order['content4']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom5']!='' or $order['custom6']!='' ) {?>
<tr>
<?php if ($order['custom5']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom5']?>：</td>
<td width="40%" align="left" class="tdleft"><?=$order['content5']?></td>
<?php } ?>
<?php if ($order['custom6']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom6']?>：</td><td width="40%" class="tdleft"><?=$order['content6']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom7']!='' or $order['custom8']!='' ) {?>
<tr>
<?php if ($order['custom7']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom7']?>：</td>
<td width="40%" align="left" class="tdleft"><?=$order['content7']?></td>
<?php } ?>
<?php if ($order['custom8']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom8']?>：</td><td width="40%" class="tdleft"><?=$order['content8']?></td>
<?php } ?>
</tr>
<?php } ?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">订单状态：</td>
<td colspan="3" align="left" class="tdleft"><?php
$yordeal=new oo_order();  
echo $yordeal->yordeal($order['trading'])?></td>

</tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">订单回复：</td>
<td colspan="3" align="left" class="tdleft"> <?=$order['reply']?></td>
</tr>
<!--endprint-->
<tr>
<td colspan="4" align="center" style="height:60px;"> 
<input id="Button1" type="button" value="打印订单" class="xx_button1"  onClick="doPrint()" style="margin-right:30px;cursor:pointer;"/></td>
</tr>
</table>
</body>
</Html>

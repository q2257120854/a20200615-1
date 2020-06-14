<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$id=inject_check($_GET['id']);
$Action=strip_tags($_GET['Action']);
$ord_sql=mysql_query("select * from product_order where orderid='$id' ",$conn1);  ####订单
$order=mysql_fetch_array($ord_sql);
if ($order['id']==''){
echo "<br><br><br><br><center>操作失败，订单异常</center>";
exit();	
}

if ($order['docking']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，没有找到该订单呀!";
exit();
}


if ($order['sid']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，没有找到该订单呀!";
exit();
}


$greturn=mysql_query("select * from members where number='$order[number]'",$conn1);       ####购买者
$gmz_row=mysql_fetch_array($greturn);
$preturn=mysql_query("select * from complaints_feedback where orerno='$id'",$conn1); ####读取申诉时间
$fee_row=mysql_fetch_array($preturn);
$yx_us_result=mysql_query("select * from members where number='$order[username]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

if ($order['locks']!=0){
//获取对接平台数据
$sup_result=mysql_query("select * from sup_members_site where id='$order[locks]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
$doc_sql=mysql_query("select * from product_order where orderid='$id' ",$conn3);        
$doc=mysql_fetch_array($doc_sql);

}

if ($fee_row['time']){
$dates=$fee_row['time'];
}else{
$dates=$order['refundtime'];
}
?>
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save&id=<?=$_REQUEST['id']?>" method="post">
<table cellspacing="1" cellpadding="3" class="table4">
<?php
$results=mysql_query("select * from refund_event where sid='$order[orderid]'",$conn1);  
$rs=mysql_fetch_array($results);
$aa=mysql_num_rows($results);
if($aa!=0){
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
<tr><th colspan="4" align="left">订单详细</th></tr>
<tr>
<td width="14%" height="32"  class="tdleri">订单编号：</td>
<td width="32%" align="left" class="tdleft"><?=$order['orderid']?></td>
<td width="16%" class="tdleri">提交时间/处理时间：</td>
<td width="38%" class="tdleft"><?=date("Y-m-d G:i:s",$order['time'])?> / 
<?php      if ($order['begtime']!=''){?>
<?=date("Y-m-d G:i:s",$order['begtime'])?>
<?php  }elseif($order['refundtime']!=''){?>
<?=date("Y-m-d G:i:s",$order['refundtime'])?>
<?php } ?>
</td>
</tr>
<tr>
<td width="14%" height="32"  class="tdleri">订单状态：</td><td colspan="3"class="tdleft"><?php
$yordeal=new oo_order();  
echo $yordeal->yordeal($order['trading'])?>
</td>
</tr>
<?php if ($order['custom1']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom1']?>：</td><td colspan="3"class="tdleft"><?=$order['content1']?></td></tr>
<?php }?>
<?php if ($order['custom2']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom2']?>：</td><td colspan="3"class="tdleft"><?=$order['content2']?></td></tr>
<?php }?>
<?php if ($order['custom3']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom3']?>：</td><td colspan="3"class="tdleft"><?=$order['content3']?></td></tr>
<?php }?>
<?php if ($order['custom4']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom4']?>：</td><td colspan="3"class="tdleft"><?=$order['content4']?></td></tr>
<?php }?>
<?php if ($order['custom5']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom5']?>：</td><td colspan="3"class="tdleft"><?=$order['content5']?></td></tr>
<?php }?>
<?php if ($order['custom6']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom6']?>：</td><td colspan="3"class="tdleft"><?=$order['content6']?></td></tr>
<?php }?>
<?php if ($order['custom7']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom7']?>：</td><td colspan="3"class="tdleft"><?=$order['content7']?></td></tr>
<?php }?>
<?php if ($order['custom8']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom8']?>：</td><td colspan="3"class="tdleft"><?=$order['content8']?></td></tr>
<?php }?>
<tr><th colspan="4" align="left">商品信息</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">商品名称：</td>
<td width="32%" align="left" class="tdleft"><?=$order['title']?></td>
<td width="16%" class="tdleri">供货商</td>
<td width="38%" class="tdleft"><?=$yx_us['company']?> （<?=$order['username']?>）
信誉：<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($yx_us['praise1']-$yx_us['praise3']))?> 
</td>
</tr>

<tr>
<td width="14%" height="32" class="tdleri">单价|数量|总价：</td>
<td colspan="3" align="left" class="tdleft"><?=$order['buyprice']?> 元 | <?=$order['nums']?> 个 | <?=$order['zongprice']?> 元</td>
</tr>
<tr><th colspan="4" align="left">客户信息</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">购买客户：</td>
<td width="32%" align="left" class="tdleft"><?=$order['number']?> 
信誉：<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->Buyers_integral(($gmz_row['praise4']-$gmz_row['praise6']))?></td>
<td width="16%" class="tdleri">网络IP</td>
<td width="38%" class="tdleft"><?=$order['youip']?>-<?=$order['network']?></td>
</tr>
<tr><th colspan="4" align="left">订单管理</th></tr>

<tr>
<td width="14%" height="32" class="tdleri">退款状态：</td>
<td colspan="3"  class="tdleft">
<?php if  ($order['refund']=='1') {?><span style="font-weight:bold;color:red">申请退款</span><?php }?>
<?php if  ($order['refund']=='2') {?><span style="font-weight:bold;color:#999999">取消退款</span><?php }?>
<?php if  ($order['refund']=='3') {?><span style="font-weight:bold;color:red">退款失败</span><?php }?>
<?php if  ($order['refund']=='4') {?><span style="font-weight:bold;color:#00a000">退款成功</span><?php }?></td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri">退单方式：</td>
<td colspan="3"  class="tdleft"><input name="yo3" type="radio" value="1" checked="checked" /> 
客户承担经销商利润退单</td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri"><span class="tdleft">退款方式</span>：</td>
<td colspan="3"  class="tdleft"><input name="yo4" type="radio" value="1" checked="checked" /> 全额退款
<input name="yo4" type="radio" value="0" /> 按天退款
<input name="yo4" type="radio" value="2" /> 不退款
</td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri"><span class="tdleft">备注信息</span>：</td>
<td colspan="3"  class="tdleft">
<input name="reply" type="text" id="reply" class="biankuan"  style="width:400px" value="<?=$order['reply']?>"/></td>
</tr>
<tr>
<td height="62" colspan="4" align="center" >
<?php if ($order['trading']!='3' && $order['refund']!='2'  && $order['refund']!='4' ) {?>
<input name="提交" type="submit" class="chaxun_input"  value="确认处理"/>
<?php }else{ ?>
该订单已经处理过了！
<?php } ?>
</td>
</tr>
</table>
<table cellspacing="1" cellpadding="3" class="table4" style="margin-top:10px;">
<tr bgcolor="#ecf5ff">
<th>客户</th>
<th>交易类型</th>
<th>变动类型</th>
<th>交易金额</th>
<th>交易日期</th>
</tr>
<?php
$Rss="SELECT * FROM details_funds  where orderid like '%$order[orderid]%'   order by begtime desc,id desc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){

$sqll="select * from members where number='$Orzx[number]'";   //读取数据表
$zycl=mysql_query($sqll,$conn1);  //执行该SQl语句
$rowl=mysql_fetch_array($zycl);
?>
<tr>
<td align="center"><?=$rowl['username']?><span class="cidcss">(<?=$Orzx['number']?>)</span></td>
<td align="center"><?=$Orzx['title']?></td>
<td align="center">
<?php if      ($Orzx['incomes']==0 && $Orzx['spendings']==0  ) {?>
-
<?php }elseif ($Orzx['afters'] > $Orzx['befores']) {?>
<font color="#0000FF">增加</font>
<?php }else{?>
<font color="#ff0000">减少</font>
<?php }?>
</td>
<td align="center">
<?php if ($Orzx['afters']-$Orzx['befores']>=0) {?>
<?=number_format($Orzx['incomes'],3)?> 
<?php }else{?>
<?=number_format($Orzx['spendings'],3)?>
<?php } ?>
</td>
<td align="center"><?=date("Y-m-d G:i:s",$Orzx['begtime'])?></td>
</tr>
<?php
 }
 }?>
</table>
</form>
<?php
//------------------------------执行订单处理
}elseif ($Action=='save'  && $order['trading']!='3') {
$yo4=inject_check($_POST['yo4']);
$reply=strip_tags($_POST['reply']);
$total=mysql_num_rows(mysql_query("select * from `details_funds` where orderid='$id' and   title='订单退款' ",$conn1));
//-------------------预防多次退款
if ($total!=0){
echo "<br><br><br><br><center>操作失败！该订单存在异常！！</center>";
exit();
}

//-------------订单不处理 不退款情况
if ($yo4=='2'){
mysql_query("update `product_order`  set refund=3  where orderid='$id' ",$conn1); ///////更新订单
if ($order['locks']!=0){
mysql_query("update `product_order`  set refund=3  where orderid='$id'",$conn3); ///////更新平台订单
}
//-------------订单处理情况
}else{
$zongas=$order['zongas'];##总抽成
##############################################################################全额退款	
if ($yo4==1 or $order['overdue']=='0'){
$zong=$order['zongprice'];
if ($order['locks']!=0){$doczong=$doc['zongprice'];}
}else{ 
##############################################################################按天退款  
$Single_days=Ysk_Single_days($order['overdue'],$order['begtime'],$dates);
if ($Single_days<0){
echo "<br><br><br><br><center>操作失败！该订单已过期！！</center>";
exit();
}
$zong=Ysk_Single_back($order['overdue'],$order['begtime'],$dates,$order['zongprice']);
if ($order['locks']!=0){$doczong=Ysk_Single_back($order['overdue'],$order['begtime'],$dates,$doc['zongprice']);}
}
//-------验证是否交易完成的订单 如果是则扣除供货商押金
if ($order['trading']!=0 and $order['username']!='') {
if (($yx_us['frozen_kuan']-$yx_us['min_amount'])-$zong<0) {
echo "<script>alert('对不起，供货商冻结金额不足无法退单!');self.location=document.referrer;</script>";
exit();
}
}
//-------验证是否交易完成的订单 如果是则扣除供货商押金 The End
$kou_kuan=$zong;                     ////供货商实际要扣掉的款 购买价格+抽成价格
$jia_kuan=$gmz_row['kuan']+$zong;    ////购买人加款
//---------------------------------------------------------------------------------------------------------------////供货资金明细
if ($order['trading']!=0 && $order['trading']!=1){
$kou_title='扣押金'.number_format($kou_kuan,3).'元';
mysql_query("insert into `supplier_refund` (title,price1,price2,price3,content,username,begtime) " . "values ('$_REQUEST[id] 订单退款','$zong','$zongas','$zong','$kou_title','$order[username]','$begtime')",$conn1);///////////供货商退款明细
mysql_query("update `members`  set frozen_kuan=frozen_kuan-$kou_kuan where number='$yx_us[number]'",$conn1); 
//----------------------------------------------------------------------------------------------------------------////供货资金明细 End
}
//---------------------------------------------------------------------------------------------------------------------////会员资金明细
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('订单退款','$id','$zong','$gmz_row[kuan]','$jia_kuan','$order[number]','$begtime')",$conn1);
mysql_query("update `members`        set kuan='$jia_kuan'  where number='$order[number]'",$conn1); 
//--------------------------------------------------------------------------------------------------------------------////会员资金明细 End

//------------------------------------------------------------------------------////平台会员资金明细
if ($order['locks']!=0){
$greturn1=mysql_query("select * from members where number='$doc[number]'",$conn3); 
$doc_us=mysql_fetch_array($greturn1);
$doc_luan=$doczong+$doc_us['kuan'];
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('订单退款','$id','$doczong','$doc_us[kuan]','$doc_luan','$doc[number]','$begtime')",$conn3);
mysql_query("update `members`  set kuan='$doc_luan'  where number='$doc[number]'",$conn3); 
///////更新平台订单
mysql_query("update `product_order`  set trading='3',reply='$reply',refund=4  where orderid='$id'",$conn3);
}
//------------------------------------------------------------------------------////平台会员资金明细
///////更新订单
mysql_query("update `product_order`  set trading='3',reply='$reply',refund=4  where orderid='$id'",$conn1);




//-------------订单处理情况 The End
}

echo "<br><br><br><br><center><input id='btnAll' type='button' value='处理成功!'  onClick='cl()' class='tijiao_input' /></center>";
}
?>
</body>
</Html>
<script>
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
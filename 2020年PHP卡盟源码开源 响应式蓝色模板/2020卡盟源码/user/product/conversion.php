<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
function clearNoNum(obj)
{
//先把非数字的都替换掉，除了数字和.
obj.value = obj.value.replace(/[^\d.]/g,"");
//必须保证第一个为数字而不是.
obj.value = obj.value.replace(/^\./g,"");
//保证只有出现一个.而没有多个.
obj.value = obj.value.replace(/\.{2,}/g,".");
//保证.只出现一次，而不能出现两次以上
obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
</head>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/error.php');
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
$Action=strip_tags($_GET['Action']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
if ($_POST['passwords']!='' && md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('对不起，交易密码错误！');history.go(-1);</script>";
exit();
}
?>
<body>

<div class="new_qie">
<ul style="float:right; padding-top:4px;">
<li><a href="conversion.php"           <?php if ($_REQUEST['Action']=='') {?>class="on"<?php } ?>>货款转余额</a></li>
<li><a href="conversion.php?Action=g2" <?php if ($_REQUEST['Action']=='g2') {?>class="on"<?php } ?>>供货明细</a></li>
<li><a href="conversion.php?Action=g3" <?php if ($_REQUEST['Action']=='g3') {?>class="on"<?php } ?>>记录查询</a></li>
</ul>
<div class="new_qie2" style="padding-top:4px;">
<h2><?php if ($Action==''){echo "货款转余额";}elseif($Action=='g2'){"供货明细";}elseif($Action=='g3'){"记录查询";} ?></h2>
</div>
</div>
<?php if ($Action==''){?>
<form action="?Action=save" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style=" margin-top:10px;">
<tr>
<td class="table1_left">货款余额：</td>
<td class="tdleft"><span class="red"><?=$yx_us['goods_kuan']?></span> <?=$moneytype?> </td>
</tr>
<tr>
<td class="table1_left"> 转款金额： </td>
<td class="tdleft"><input name="Amount" type="text" id="Amount" class="biankuan" onKeyUp="clearNoNum(this)" />
&nbsp;<?=$moneytype?>  </td>
</tr>
<tr><td class="table1_left"> 交易密码：</td><td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="请输入您的交易密码" />
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;</td>
<td class="tdleft"><input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" />
<input name="button" type="button" class="fanhui_input" id="button" onClick="history.go(-1);" value="返回" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='save'){

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
if ($_POST['passwords']==''){echo "<script>alert('对不起，交易密码不能为空！');history.go(-1);</script>";exit();}
$Amount=get_check_price($_POST['Amount']);


if ($Amount<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}

if ($yx_us['kuan']<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}

if (($yx_us['goods_kuan']-$Amount)<0) {
echo "<script language=\"javascript\">alert('对不起，货款金额不足！');history.go(-1);</script>";
exit();
}

$price=get_check_price($yx_us['goods_kuan']-$Amount);

////////更新到供货明细里面
mysql_query("insert into `goods_details` (title,orderid,spendings,befores,afters,number,begtime) " . "values ('货款转余额','$pro_orderid','$Amount','$yx_us[goods_kuan]','$price','$_SESSION[ysk_number]','$begtime')",$conn1);
/////////////记录转余额
mysql_query("insert into `goods_yuer` (title,price,number,begtime) " . "values ('货款转余额','$Amount','$_SESSION[ysk_number]','$begtime')",$conn1);
############更新供货商的金额
mysql_query("update members set goods_kuan='$price' where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('提交成功，等待客服审核!');window.location='conversion.php?Action=g3';</script>";
exit();
}elseif ($_GET['Action']=='g2') {?>
<form action="conversion.php" method="get">
<input name="Action" type="hidden" value="g2">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
查询时间段：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" value="确认查询" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="14%">交易日期</th>
<th width="20%">交易类型</th>
<th width="14%">收入(<?=$moneytype?>)</th>
<th width="14%">支出(<?=$moneytype?>)</th>
<th width="14%">变化前(<?=$moneytype?>)</th>
<th width="14%">变化后(<?=$moneytype?>)</th>
</tr>
<?php
$search="where number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_details`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from goods_details  $search order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left">
<?php if ($row['title']=='(订单退款)' or $row['title']=='(商品出售)') {?>
<a  href="#art1" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>&Token=<?=genToken()?>', { title: '订单详细信息', width: 800, height: 600, lock: true, fixed:true});"><?=$row['orderid']?></a>
<?php }else{?>
<?=$row['orderid']?> 
<?php }?>
<?=$row['title']?></td>
<td><?=number_format($row['incomes'],3);?> <?=$moneytype?></td>
<td><?=number_format($row['spendings'],3);?>  <?=$moneytype?></td>
<td><?=number_format($row['befores'],3);?> <?=$moneytype?></td>
<td><?=number_format($row['afters'],3);?><?=$moneytype?></td>
</tr>
<?php
$incomes=$incomes+ $row['incomes'];
$spendings=$spendings+ $row['spendings'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">本页合计：</td>
<td><b style="color:red"><?=number_format($incomes,3);?> <?=$moneytype?></b></td>
<td height="24" align="center" ><b style="color:red"><?=number_format($spendings,3);?> <?=$moneytype?></b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">总共合计：</td>
<td><?php
$res=mysql_query("SELECT sum(incomes)    FROM `goods_details` where number='$_SESSION[ysk_number]'  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?> <?=$moneytype?></b></td>
<td align="right"><?php
$res1=mysql_query("SELECT sum(spendings) FROM `goods_details` where number='$_SESSION[ysk_number]'   ",$conn1);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?>  <?=$moneytype?></b></td>

<td style="color:red">&nbsp;</td>
<td style="color:red">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center; "><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
</form>

<?php }elseif ($Action='g3') {?>
<form action="conversion.php" method="get">
<input name="Action" type="hidden" value="g3">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

<tr>
<td height="32" class="td_left">
查询时间段：</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" value="确认查询" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="21%">交易日期</th>
<th width="57%">交易类型</th>
<th width="14%">金额(<?=$moneytype?>)</th>
<th width="8%">状态</th>
</tr>
<?php

$search="where  number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_yuer`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from goods_yuer  $search order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left">供货款转余额</td>
<td><?=number_format($row['price'],3)?> <?=$moneytype?></td>
<td><?php if ($row['online']=='0') {?>等待审核<?php }else{?><b style="color:#FF0000">已处理</b><?php } ?></td>
</tr>
<?php
$incomes=$incomes+ $row['price'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">本页合计：</td>
<td><b style="color:red"><?=number_format($incomes,3)?> <?=$moneytype?></b></td>
<td height="24" align="center" >&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">总共合计：</td>
<td><?php
$res=mysql_query("SELECT sum(price)    FROM `goods_yuer`   $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3)?> <?=$moneytype?></b></td>
<td align="right">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
</form>

<?php } ?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
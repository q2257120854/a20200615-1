<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
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
<div class="new_qie">
<div class="new_qie2" style="padding-top:4px;">
<h2>申请促销列表</h2>
</div>
</div>
<?php if ($Action==''){?>
<form action="promotional.php" method="get">
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
<input type="submit" value="确认查询" class="chaxun_input" /><a href="promotional.php?Action=add" class="input_add">提交申请</a>
</td>
</tr>
</table>
</form>
<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="25%">显示时间</th>
<th width="31%">店铺名称</th>
<th width="31%">文字介绍</th>
<th width="13%">费用(<?=$moneytype?>)</th>
</tr>
<?php
$search="where username='$_SESSION[ysk_number]'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `ysk_promotional`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from ysk_promotional  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?> - <?=date("Y-m-d G:i:s",$row['begtime']+86400)?></td>
<td style="text-align:left">
<?=yx_product_class($row['proclass'])?>
</td>
<td style="text-align:left"><?=cnsubstr($row['content'],0,24) ?></td> 
<td><?=number_format($row['price'],3)?> <?=$moneytype?></td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
<?php }elseif ($Action=='add'){?>
<form  action="?Action=save" method="post"  id="add" name="add">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="3" class="table1" style="margin-top:10px;">
<tr>
<td width="10%" class="table1_left">选择店铺：
</td>
<td width="90%" class="tdleft">
<select name="ClassID" id="ClassID">
<?php 
$results=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' and LagID=2 order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['NumberID']?>" <?php if($type['NumberID']==$row['directory3']){ ?> selected="selected"<?php }?>><?=$type['7']?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td width="10%" class="table1_left">商品编号一：
</td>
<td width="90%" class="tdleft"><input name="Pid1" type="text" id="Pid1" class="biankuan"></td>
</tr>
<tr>
<td width="10%" class="table1_left">商品编号二：
</td>
<td width="90%" class="tdleft"><input name="Pid2" type="text" id="Pid2" class="biankuan"></td>
</tr>
<tr>
<td width="10%" class="table1_left">简短介绍：
</td>
<td width="90%" class="tdleft"><input name="content" type="text" id="content" class="biankuan"></td>
</tr>
<tr>
<td width="10%" class="table1_left">费用：
</td>
<td width="90%" class="tdleft"><?=$pmt_price?> <?=$moneytype?></td>
</tr>


<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="Submit" value="下一步"  id="Submit" class="tijiao_input" onClick="return checkuserinfo();"/>
<input id="Button1" type="button" value="返回" class="fanhui_input" onClick="history.go(-1);" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$Pid1=pot_check_price($_POST['Pid1']);
$Pid2=pot_check_price($_POST['Pid2']);
$content=pot_check_price($_POST['content']);

$Pid=$Pid1.','.$Pid2;
$ClassID=strip_tags($_POST['ClassID']);
$price=$yx_us['kuan']-$pmt_price;
if ($Pid1==$Pid2){
echo "<script>alert('操作失败，商品编号不能重复！');;self.location=document.referrer;</script>";
exit();	
}

/*判断会员余额是否足够*/
if ($price<0){
echo "<script>alert('操作失败，您的余额不足！');;self.location=document.referrer;</script>";
exit();	
}


/*判断id 和 店铺目录是否是该会员所有和该Id是否存在*/
$total=mysql_num_rows(mysql_query("select * from `product` where  username='$_SESSION[ysk_number]' and id in ($Pid)",$conn1));
if ($total==2){
/*更新数据 先判断总数据是否大于4 大于的则时间加一天*/
$zong=mysql_num_rows(mysql_query("select * from `ysk_promotional` where locks=1",$conn1));
if($zong<4){
$locks=1;
}else{
$begtime=$begtime+86400;
$locks=0;	
}

mysql_query("insert into `ysk_promotional` set locks='$locks',proclass='$ClassID',proid='$Pid',price='$pmt_price',username='$_SESSION[ysk_number]',begtime='$begtime',content='$content'",$conn1);

/*增加资金明细 扣除会员金额*/
mysql_query("insert into `details_funds` set title='申请了商家促销',spendings='$pmt_price',befores='$yx_us[kuan]',afters='$price',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$price' where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('提交成功!');window.location='promotional.php';</script>";
exit();
}else{
echo "<script>alert('对不起，您输入的商品编号有误请重新核对！');;self.location=document.referrer;</script>";
exit();
}
?>
<?php } ?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.Pid1.value)) {
document.add.Pid1.focus();
alert("操作失败，商品编号一不能为空");
return false;
}


if(checkspace(document.add.Pid2.value)) {
document.add.Pid2.focus();
alert("操作失败，商品编号二不能为空");
return false;
}


}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
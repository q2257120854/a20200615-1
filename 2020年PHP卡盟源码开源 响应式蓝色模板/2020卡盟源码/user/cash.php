
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<!-- 框架元素 开始 -->
<link href="css/rightload.css" type="text/css" rel="stylesheet">
<!-- 框架元素 结束 -->

<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<!-- 特效元素 开始 -->
<script src="css/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<!-- 特效元素 结束 -->

<!-- 加密元素 开始 -->
<script type="text/javascript" src="css/util/RSA.js"></script>  
<script type="text/javascript" src="css/BigInt.js"></script>  
<script type="text/javascript" src="css/Barrett.js"></script>
<!-- 加密元素 结束 -->

<!-- 弹窗元素 开始 -->
<script src="css/layer.js"></script><link rel="stylesheet" href="css/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
<!-- 弹窗元素 结束 -->
<style type="text/css">
	.red_money_parent{display:none; width: 100%; height: 100%; position: fixed; z-index: 2; top: 0px; left: 0px; overflow: hidden;}
</style>
<script type="text/javascript">
	window.onscroll = function(){ 
		var t = document.documentElement.scrollTop || document.body.scrollTop;  
		if(window.frames["right"].document.getElementById("input_top")!=null){
			window.frames["right"].document.getElementById("input_top").value = t;
		}
		
	};
</script>
<link href="images/right.css" rel="stylesheet" type="text/css" />
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
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
include_once('../jhs_config/error.php');
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$begtime=strip_tags($_POST['begtime']);         //时间
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>
<div class="ifra-right_con">
		<h3 class="column-title">
			<b id="title">申请提现</b>
			<span class="col-t-g">
				<input id="tab" value="1" type="hidden">
				<input tab="1" name="clickTitle"  onclick="window.location = 'AccountMoneyHistory.php'" type="button" value="提现记录" class="spl-btn">
			</span>
		</h3>
		<div id="rechargeBox">

<?php if ($_REQUEST['Go']=='1') {?>
<form action="?Action=save" method="post" name="add">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<table cellspacing="1" cellpadding="2" class="table1" style="margin: 0">
<tr>
<td class="table1_left">余额：</td>
<td class="tdleft"><span class="red"><?=$yx_us['kuan']?></span> <?=$moneytype?> </td>
</tr>

<tr>
<td class="table1_left"> 提现金额： </td>
<td class="tdleft"><input name="Amount" type="text" id="Amount" class="biankuan" onKeyUp="clearNoNum(this)"  v/>
&nbsp;元  </td>
</tr>
<tr>
<td class="table1_left">账户类型： </td>
<td class="tdleft"><select name="type" id="type">
<option value="支付宝">支付宝</option>
<option value="财付通">财付通</option>
</select>
</td>
</tr>
<tr>
<td class="table1_left">收款账户： </td>
<td class="tdleft"><input name="account" type="text" id="account" class="biankuan"/>
</td>
</tr>
<tr>
<td class="table1_left">收款姓名： </td>
<td class="tdleft"><input name="rname" type="text" id="rname" class="biankuan"/>
</td>
</tr>
<tr>
<td class="table1_left">交易密码： </td>
<td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="请输入您的交易密码" /></td>
</tr>
<tr>
<td class="table1_left">&nbsp;</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();">
<input name="button" type="button" class="fanhui_input" id="button" onClick="history.go(-1);" value="返回" />
</td>
</tr>
</table>
</form>
<?php }elseif ($_REQUEST['Action']=='save') {


if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('操作失败，交易密码错误！');history.go(-1);</script>";
exit();
}

if (!$_POST['account']) {
echo "<script language=\"javascript\">alert('对不起，收款账户不能为空！');history.go(-1);</script>";
exit();
}

if (!$_POST['rname']) {
echo "<script language=\"javascript\">alert('对不起，收款姓名不能为空！');history.go(-1);</script>";
exit();
}


############获取手续费
if      ($_POST['Amount']<'1000'){
$poundage=$site_charge1;
}elseif ($_POST['Amount']<'5000'){
$poundage=$site_charge2;
}elseif ($_POST['Amount']<'10000'){
$poundage=$site_charge3;
}elseif ($_POST['Amount']<'10000000'){
$poundage=$site_charge4;
}

$zong=$poundage+$_POST['Amount'];
///// 判断余额是否够转账 然后再判断是否有该收款人的编号

if ($_POST['Amount']<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}

if ($yx_us['kuan']<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}


if ($yx_us['kuan']<$zong) {
echo "<script language=\"javascript\">alert('对不起，您的账户余额不够！');history.go(-1);</script>";
exit();
}

if ($_POST['Amount']<0) {
echo "<script language=\"javascript\">alert('对不起，提现金额不能低于0！');history.go(-1);</script>";
exit();
}

//*******************************************************************万恶的黑客修改模板
get_check_price($_POST['Amount']);
get_check_price(($yx_us['kuan']-$zong));
get_check_price($yx_us['kuan']);
//*******************************************************************万恶的黑客修改模板 The End

$type=strip_tags($_POST['type']);
$account=strip_tags($_POST['account']);
$rname=strip_tags($_POST['rname']);
$Amount=strip_tags($_POST['Amount']);
/////记录提现信息
mysql_query("insert into `balance_cash` (number,type,account,rname,price,audit,begtime) " .
"values ('$_SESSION[ysk_number]','$type','$account','$rname','$Amount','0','$begtime')",$conn1);



/////记录会员资金明细
$title="余额提现";
$before=$yx_us['kuan'];
$after=$yx_us['kuan']-$Amount;
$after10=$yx_us['kuan']-$Amount-$poundage;
$before10=$yx_us['kuan']-$Amount;
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime)"."values ('$title','0','$_REQUEST[Amount]','$before','$after','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime)"."values ('提现手续费','0','$poundage','$before10','$after10','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan='$after10'   where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
exit();

}?>

<?php if ($_REQUEST['Go']=='2') {?>
<form action="Cash.php?Go=2" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">查询时间段：</td>
<td class="left"><?php include_once('../jhs_config/time.php');?></td>
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

<td width="18%" align="center" class="table_top">提现日期</td>
<td width="12%" align="center" class="table_top">提现类型</td>
<td width="24%" align="center" class="table_top">账户账户</td>
<td width="14%" align="center" class="table_top">收款姓名</td>
<td width="15%" align="center" class="table_top">提现金额</td>
<td width="17%" align="center" class="table_top">状态</td>
</tr>
<?php
$search="where  number='$_SESSION[ysk_number]'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `balance_cash`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from balance_cash $search order by begtime desc,id desc {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><?=$row['type']?></td>
<td align="center"><?=$row['account']?></td>
<td align="center"><?=$row['rname']?> </td>
<td align="center"><?=$row['price']?></td>
<td align="center">
<?php if ($row['audit']=='0'){?>
<font color="red">等待处理</font>
<?php }else{?>
已汇款，请查收
<?php }?>
</td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center; padding-top:10px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</form>

<?php } ?>

</div>
</div>
</body>
</Html>
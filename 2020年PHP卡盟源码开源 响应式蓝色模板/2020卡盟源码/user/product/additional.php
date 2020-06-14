
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>聚合社</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />

<link href="../css/rightload.css" type="text/css" rel="stylesheet">
<!-- 框架元素 结束 -->

<!-- jQuery元素 开始 -->
<script src="../css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="../css/style.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<!-- 特效元素 开始 -->
<script src="../css/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<!-- 特效元素 结束 -->

<!-- 父弹窗元素 开始 -->
<script src="../css/dialog.js" type="text/javascript"></script>
<link href="../css/dialog.css" rel="stylesheet" type="text/css">
<!-- 父弹窗元素 结束 -->

<!-- 加密元素 开始 -->
<script type="text/javascript" src="../css/RSA.js"></script>  
<script type="text/javascript" src="../css/BigInt.js"></script>  
<script type="text/javascript" src="../css/Barrett.js"></script>
<!-- 加密元素 结束 -->

<!-- 弹窗元素 开始 -->
<script src="../css/layer.js"></script><link rel="stylesheet" href="/user/css/skin/default/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
<!-- 弹窗元素 结束 -->
<style type="text/css">
	.red_money_parent{display:none; width: 100%; height: 100%; position: fixed; z-index: 2; top: 0px; left: 0px; overflow: hidden;}
</style>
</head>
<body>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
$begtime=strip_tags($_POST['begtime']);
?>
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

<div class="ifra-right_con">
		<h3 class="column-title">
			<b id="title">追加供货押金</b>

		</h3>
<div id="rechargeBox">
<div class="self-run-con" id="div1">

<?php if ($_REQUEST['Action']=='') {?>

<form action="?Action=save" method="post" name="add">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />

<table cellspacing="1" cellpadding="2" class="table1" style=" margin-top:10px;">
<tr>
<td class="table1_left">余额：</td>
<td class="tdleft"><span class="red"><?=$yx_us['kuan']?></span> <?=$moneytype?> </td>
</tr>
<tr>
<td class="table1_left">已冻结：</td>
<td class="tdleft"><span class="red"><?=number_format($yx_us['frozen_kuan'],3);?></span> <?=$moneytype?> </td>
</tr>

<tr>
<td class="table1_left"> 追加金额： </td>
<td class="tdleft"><input name="Amount" type="text" id="Amount" class="biankuan" onKeyUp="clearNoNum(this)" />
&nbsp;<?=$moneytype?>  </td>
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
<?php }elseif ($_REQUEST['Action']=='save'){
	
$Amount=get_check_price($_POST['Amount']);

if (md5($_REQUEST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('操作失败，交易密码错误！');history.go(-1);</script>";
exit();
}	



if ($Amount<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}

if ($yx_us['kuan']<0){
echo "<script>alert('对不起，金额异常不能为空！');history.go(-1);</script>";exit();
}



if ($yx_us['kuan']<$Amount){
echo "<script language=\"javascript\">alert('操作失败，您的账户余额不够！');history.go(-1);</script>";
exit();
}

$after=$yx_us['kuan']-$Amount;
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " .
"values ('追加供货押金','$_REQUEST[Amount]','$yx_us[kuan]','$after','$_SESSION[ysk_number]','$begtime')",$conn1);
$frozen_kuan=$yx_us['frozen_kuan']+$_REQUEST['Amount'];
mysql_query("update members set kuan='$after',frozen_kuan='$frozen_kuan'   where number='$_SESSION[ysk_number]'",$conn1); 

echo "<script>alert('提交成功!');;self.location=document.referrer;</script>";
exit();



}?>


</div>
</body>
</Html>
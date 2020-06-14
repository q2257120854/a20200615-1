
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>聚合社</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- jQuery元素 开始 -->
<script src="http://www.shoulekm.com:80/js/main/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="http://www.shoulekm.com:80/front/2016/11/08/01/css/style.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="http://www.shoulekm.com:80/js/main/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script src="http://www.shoulekm.com:80/js/main/jquery.validate.js" type="text/javascript"></script>
<!-- 表单验证元素 结束 -->

<!-- 时间元素 开始 -->
<link href="http://www.shoulekm.com:80/css/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="http://www.shoulekm.com:80/js/jQueryUI/jquery-ui.js" type="text/javascript"></script>
<script src="http://www.shoulekm.com:80/js/util/DateUtil.js" type="text/javascript"></script>
<!-- 时间元素 结束 -->


<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
include_once('../jhs_config/error.php');
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
$begtime=strip_tags($_POST['begtime']);         //时间
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);

?>

<div class="ifra-right_con">
		<h3 class="column-title">
			<b id="title">超级转账</b>
			<span class="col-t-g">
				<input type="hidden" id="tab" value="1">
				<input onclick="window.location = 'Transfer.php?Go=1'" type="button" value="账户间转款" class="spl-btn">
				<input onclick="window.location = 'Transfer.php?Go=2'" type="button" value="转款记录查询" class="spl-btn">
			</span>
		</h3>
<div id="rechargeBox">
<div class="self-run-con" id="div1">
<?php if ($_REQUEST['Go']=='1') {?>
<form action="?Action=save" method="post">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<dl>
			<dt>余额：</dt>
			<dd><span style="color: red;" id="acc_use_money"><?=$yx_us['kuan']?></span>&nbsp;<?=$moneytype?></dd>
		</dl>
		<dl>
			<dt>转入用户编号：</dt>
			<dd><input type="text" class="text1" style="width:150px;" name="CustomerID" id="CustomerID"><span style="color: red;" id="CustomerID" ></span></dd>
		</dl>
	<dl>
			<dt>转款金额：</dt>
			<dd><input type="text" class="text1" style="width:150px;" name="Amount" id="Amount"> <?=$moneytype?><span style="color: red;" onKeyUp="clearNoNum(this)" id="Amount"></span></dd>
		</dl>
<dl class="se-g-intro">
			<dt>转款备注：</dt>
			<dd>
				<textarea class="textarea1" style="width:400px;" rows="2" cols="10" name="Comment" id="Comment"></textarea>
			</dd>
		</dl>
		<dl>
			<dt><span style="color: red;">交易密码：</span></dt>
			<dd><input type="password" class="text1" style="width:150px;" name="passwords" id="passwords"></dd>
		</dl>
		

					<dl class="save-return">
			<input type="submit" id="btnSubmit" class="save-btn" value="确认转账">
			<input type="button" id="btn_back" name="btn_sub" class="return-btn" onclick="window.location = 'wallet.php'"  value="我的钱包">
		</dl>

</form>
<?php }elseif($Action=='save') {
//*******************************************************************万恶的黑客修改模板
$Amount=get_check_price($_POST['Amount']);
get_check_price($yx_us['kuan']-$Amount);
$CustomerID=strip_tags($_POST['CustomerID']); 
$Comment=strip_tags($_POST['Comment']);
//*******************************************************************万恶的黑客修改模板 The End



if ($Amount=='' || $Amount=='0' || $Amount<'0' ) {
echo "<script language=\"javascript\">alert('对不起，您的转账金额异常！');history.go(-1);</script>";
exit();
}

if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('操作失败，交易密码错误！');history.go(-1);</script>";
exit();
}


///// 判断余额是否够转账 然后再判断是否有该收款人的编号
if ($CustomerID==$_SESSION['ysk_number']) {
echo "<script language=\"javascript\">alert('对不起，您不能自己给自己转账哦！');history.go(-1);</script>";
exit();
}

if ($yx_us['kuan']<$_POST['Amount']) {
echo "<script language=\"javascript\">alert('对不起，您的账户余额不够！');history.go(-1);</script>";
exit();
}

if ($_POST['Amount']<0) {
echo "<script language=\"javascript\">alert('对不起，金额异常！');history.go(-1);</script>";
exit();
}




$result=mysql_query("select * from members where number='$CustomerID' ",$conn1);
$yx=mysql_fetch_array($result);
if ($yx){
$after=$yx['kuan']+$Amount;
$title="来自编号：$_SESSION[ysk_number] 转账";
$before=$yx['kuan'];

mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('$title','$Amount','$before','$after','$CustomerID','$begtime')",$conn1);
mysql_query("update members set kuan=$after  where number='$CustomerID'",$conn1); 


/////会员转账明细
mysql_query("insert into `transfer_detail` (payee,drawee,price,content,begtime)"."values ('$CustomerID','$_SESSION[ysk_number]','$_REQUEST[Amount]','$Comment','$begtime')",$conn1);


/////记录会员资金明细
$bibokuan1=$yx_us['kuan']-$Amount;

$title1="给编号：$CustomerID 转账";
$after1=$bibokuan1;

mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime)"."values ('$title1','$Amount','$yx_us[kuan]','$after1','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan=$after1  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('转账成功!');self.location=document.referrer;</script>";
exit();
}else{
echo "<script language=\"javascript\">alert('转入用户错误！');history.go(-1);</script>";
exit();
}


}?>

<?php if ($_REQUEST['Go']=='2') {?>


<form name="form1" method="post" action="">
 <div class="capi-tbl capital">
<table>

<thead>
                <tr align="center">
                    <th width="5%">编号</th>
                    <th width="10%">转账时间</th>
                    <th width="12%">收款用户</th>
                    <th width="8%">转账金额</th>
                    <th width="10%">交易备注</th>
                </tr>
            </thead>

<?php


$search="where drawee='$_SESSION[ysk_number]'"; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime<=$muyou2 ";
$total=mysql_num_rows(mysql_query("SELECT * FROM `transfer_detail`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from transfer_detail $search order by begtime desc,id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="center"><?=$row['id']?> </td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><?=$row['payee']?></td>
<td align="center"><?=number_format($row['price'],3)?> <?=$moneytype?></td>
<td align="left"><?=$row['content']?> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td style="text-align:center; padding-top:10px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?>  </td>
</tr>
</table>
</form></div>

<?php } ?>
</div>
</div></div>
</body>
</Html>

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

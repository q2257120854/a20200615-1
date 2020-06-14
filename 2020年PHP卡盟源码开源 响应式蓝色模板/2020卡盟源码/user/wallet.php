<head>
<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$Action=strip_tags($_GET['Action']);
$layout=strip_tags($_GET['layout']); 
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

if     ($layout=='1'  && $yx_us['power5']==1){
$yourl='product/DHandleSave.php';
}elseif($layout=='1'  && $yx_us['power5']!=1){
$yourl='sorry.php';
}elseif($layout=='2' ){
$yourl='dealers/CustomerList.php';
}else{
$yourl='juheshe.php?NumberID=H001';
}


if ($_SESSION['Platform_announcement']=='1' and $login_prompt!=''){
$_SESSION['my_gg_id']=1;
}
###########读取强制阅读的短信
$result=mysql_query("select * from sms where username='$_SESSION[ysk_number]' and locks='1' order by begtime desc,id desc limit 0,1",$conn1);
$row=mysql_fetch_array($result);
if($row['id']!=''){
$_SESSION['my_lock_id']=$row['id'];
}
mysql_free_result($result);
?>
    <html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/wallet.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->
</head>
<body>
	<div class="ifra-right_con my-wallet-right">
		<h3 class="column-title">
			<b>我的钱包</b>
		</h3>
		<div class="my-wallet-list">
			<div class="my-account">
				<em class="m-acc-balance">您的账户余额：<i>￥<?=number_format($yx_us['kuan'],3);?></i></em>
				<span class="ope">
					<a href="javascript:(0)" id="cardpay" class="ope01">我要充值</a>
					<a target="right" href="Transfer.php?Go=1" class="ope02">我要转账</a>
					<a target="right" href="Cash.php?Go=1" class="ope03">我要提现</a>
					
				</span>
			</div>
			
			<div class="data-time wallet-data">
				<div class="data-tab-bd">
					<ul>
						<li class="first">
							<em class="col01"></em>
							<i>可用余额</i>
							<b><?=number_format($yx_us['kuan'],3);?> <?=$moneytype?></b>
						</li>
						<li>
							<em class="col02"></em>
							<i>冻结金额</i>
							<b><?=number_format($yx_us['frozen_kuan'],3);?> <?=$moneytype?></b>
						</li>
						<li>
							<em class="col03"></em>
							<i>消费总额</i>
							<b><?=number_format($yx_us['zong_kuan'],3);?> <?=$moneytype?></b>
						</li>
						<li>
							<em class="col02"></em>
							<i>未转收入</i>
							<b>
								<?=number_format($yx_us['goods_kuan'],3);?> <?=$moneytype?>
							</b>
						</li>
					</ul>
				</div>
			</div>
			<div class="also-do">
				<h3>您还可以：</h3>
				<ul class="fix">
					<li>
						<a target="right" href="product/additional.php" class="left_img"><img src="images/wallet2.png"></a>
						<span><a target="right" href="product/additional.php">追加冻结押金</a></span>
					</li>
					<li>
						<a href="<?=$cardpay_url?>" target="_blank" class="left_img"><img src="images/wallet3.png"></a>
						<span><a  href="<?=$cardpay_url?>" target="_blank">充值卡购买</a>
					</span>
					</li>
					
					<li>
						<a target="right" href="hShoppingrecord.php" class="left_img"><img src="images/wallet4.png"></a>
						<span><a target="right" href="Shoppingrecord.php">消费记录查询</a>
					</span>
					</li>
					<li>
						<a target="right" href="AccountMoneyHistory.php" class="left_img"><img src="images/wallet1.png"></a>
						<span><a target="right" href="AccountMoneyHistory.php">账户资金明细</a>
					</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var ifrhegiht=Math.min(window.document.documentElement.scrollHeight,window.document.body.scrollHeight);
		window.parent.document.getElementById("right").style.height=ifrhegiht+100+"px";
	</script>

</body></Html>
<script type="text/javascript">
$(document).ready(function(){
 $('.dropdown').hover(function () {
        $(this).toggleClass('hover');
    });

	
	 	$("#cardpay").click(function(){
		parent.Dialog.win({
			title:"账户充值",
			iframe:{src:"cardpay.php"},
			width:1000,
			height:730
		});

	});
	
	

});
</script>

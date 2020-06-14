
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>账户充值</title>
<meta name="keywords" content="聚合社 - 顾及" />
</head>

	<link href="images/right.css" rel="stylesheet" type="text/css" />
    <link href="css/pay/base-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/common-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/layout-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/ui-utf8.css" type="text/css" rel="stylesheet" />
	<link href="css/pay/style.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="css/pay/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="css/pay/base-utf8.js" charset="UTF-8"></script>
    <script type="text/javascript" src="css/pay/common.min-utf8.js" charset="UTF-8"></script>
    <script type="text/javascript" src="css/pay/qa-utf8.js "></script>

    <script type="text/javascript" src="css/pay/BaseUse.js"></script>
    <script type="text/javascript" src="css/pay/CheckUse.js"></script>   
    <script type="text/javascript" src="css/pay/TcCardPay.js" charset="UTF-8"></script>

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$begtime=strip_tags($_POST['begtime']);         //时间
$pay=$_REQUEST['pay'];
if ($pay=='' or $pay=='1'){
$payurl='../payment/alipay/alipayapi.php';
$payck='1';
}else{
$payurl='../payment/tenpay/tenpay.php';
$payck='2';
}
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



<div class="right">

<?php if ($_REQUEST['Go']=='' && $Action=='') {?>
<br><br><br>


<form action="?Action=save1" method="post">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<div class="main">
        <div class="layout_top">
            <div class="layout_top"><ul class="clearfix"><li class="lineNo" id="SRUserPay"><a href="pay.php" >在线充值<em>推荐</em></a></li>
			
			<li id="SRTcCardPay"><a href="cardpay.php" class="on">充值卡充值</a></li>
			
			<li id="SRTcCardPay"><a href="javascript:alert('未开发完成')">消费卡充值</a></li>
			</ul> </div>
        
        </div>
       <!-- content:start -->
<div class="content pt25">
    <table class="conTable">
	<input name="Token" type="hidden" value="<?=genToken()?>">
        <tbody>
		<center><div class="card_title"><i></i><span>充值卡购买地址：<a href="<?=$cardpay_url?>" target="_blank"><?=$cardpay_url?></a>&nbsp;&nbsp;(点击链接从新窗口打开)</span></div></center>
		<tr>
            <th>
                用户编号：
            </th>
            <td>
                <input type="text" class="inputTxt account" id="UserId" name="UserId"disabled="disabled"  value="<?=$yx_us['number']?>">
            </td>
        </tr>
        <tr>
            <th>
                充值卡卡号：
            </th>
            <td>
                <input type="text" class="inputTxt account" placeholder="请输入充值卡卡号" id="account" name="account">
            </td>
        </tr>
        <tr>
            <th>
                充值卡密码：
            </th>
            <td>
                <input type="password" class="inputTxt account" placeholder="请输入充值卡密码" id="password" name="password"><br/>
                
            </td>
        </tr>
        <tr>
            <th>
            </th>
			</form>
            <td class="btnBox">
			
			<input type="submit" name="btnSubmit" value="确认充值" id="btnSubmit" class="btn" />
               
            </td>
        </tr>
    </tbody></table>
    <div class="tips">
        <p class="title">
            常见问题</p>
        <ul class="tipList">
            <li class="">
               <font size="3"> <i>+</i><a href="javascript:;">什么是平台充值卡？</a>  </font>  
                <p>
                    （1）是由我们平台发行的电子储值卡，可以用来给账户进行充值<br>
                    （2）充值卡只限于本平台注册用户充值使用<br>
                    （3）充值卡的“卡号”和“密码”均有大小写字母以及数字组成<br>
                </p>   
            </li>
			 <li class="">
                <font size="3"><i>+</i><a href="javascript:;">哪里可以买到这类充值卡？</a>    </font>  
                <p>
                    （1）可以在上方的购买链接里买到<br>
                </p>   
            </li>
        </ul>
    </div>
</div>
    </div>





<?php }elseif ($Action=='save'){
	
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if (!$_REQUEST['price']){
echo "<script>alert('汇款金额不能为空!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['time']){
echo "<script>alert('汇款时间不能为空!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['note']){
echo "<script>alert('汇款备注不能为空!');window.history.back(-1);</script>";
exit();
}

//--------------------------------检测资金安全
get_check_price($_POST['price']);
//--------------------------------检测资金安全 End

$type=strip_tags($_POST['type']);
$note=strip_tags($_POST['note']);
inject_check($_POST['type']);
inject_check($_POST['price']);

$result=mysql_query("select * from rem_account   where id='$type'",$conn1);
$yx=mysql_fetch_array($result);
if (!$yx){
echo "<script>alert('汇款银行不能为空!');window.history.back(-1);</script>";
exit();
}

$price=$_POST['price'];             //汇款金额
$time=$_POST['time'];               //汇款时间
$bank_type=$yx['bank_type'];     //汇款银行
mysql_query("insert into `money_order` (bank_type,kuan,htime,content,number,begtime) " . "values ('$bank_type','$price','$time','$note','$_SESSION[ysk_number]','$begtime')",$conn1);
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
	
}elseif ($Action=='save1') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

$result=mysql_query("select * from one_cartoon  where account='$_REQUEST[account]' and password='$_REQUEST[password]' ",$conn1);
$yx_cz=mysql_fetch_array($result);
if ($yx_cz){
if ($yx_cz['states']=='1'){
echo "<script language=\"javascript\">alert('对不起，充值卡已被激活！');window.history.back(-1);</script>";  
exit(); 
}
$czkuan=$yx_us[kuan]+$yx_cz[price];
mysql_query("update one_cartoon set states='1',username='$_SESSION[ysk_number]',begtime='$begtime' where id='$yx_cz[id]' ",$conn1); 
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime) " .
"values ('充值卡$_REQUEST[account]充值','$yx_cz[price]','0','$yx_us[kuan]','$czkuan','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan=kuan+$yx_cz[price]  where number='$_SESSION[ysk_number]' ",$conn1); 
echo "<script>alert('充值成功!');self.location=document.referrer;</script>";
}else{
echo "<script language=\"javascript\">alert('对不起，充值卡账户或密码错误！');window.history.back(-1);</script>";  
exit(); 
}

}?>
</div>
</body>
</Html>
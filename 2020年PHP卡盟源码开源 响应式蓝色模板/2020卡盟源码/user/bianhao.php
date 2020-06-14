<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
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
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php 
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
include('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$proid=check_input($_GET['id']);

$result=mysql_query("select * from bianhao_list where id='$proid'",$conn1);
$row=mysql_fetch_array($result);

//---验证是否有该数据

if($row['type']==1 || $row['type']==''){
	header('location:/user/sorry.php?err=1');
	exit();
}

$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);       ###获取Sup资料
$yx_sup=mysql_fetch_array($yx_sup_result);
?>
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save&id=<?=$proid?>" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">购买编号：</td>
<td><?=$row['title']?></td>
</tr>
<tr>
<td height="32" class="td_left">编号价格：</td>
<td><?=$row['price']?> 元</td>
</tr>
<tr>
<td height="32" class="td_left">注意事项：</td>
<td style="color:#FF0000; font-weight:bold">购买编号后所有您当前的编号数据将被清空,请您确定所有订单都处理完成后购买</td>
</tr>
<tr>
<td height="32" colspan="2" align="center" >
<input name="提交" type="submit" class="button_buy"  value="下一步"  onclick="Javascript:return confirm('您确定购买该编号？购买后所有数据都会清空,请您确定所有订单都处理完成后购买！');"></td>
</tr>
</table>
</form>
<?php }elseif($Action=='save'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

$afters=$yx_us['kuan']-$row['price'];

if ($afters<0){
echo "<br><br><br><br><center>很抱歉，您的余额不足请充值后重新操作!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

if ($row['price']<0){
echo "<br><br><br><br><center>很抱歉，您的余额不足请充值后重新操作!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

$price=($row['price']*0.05);//购买编号 Sup抽成5%
if (($yx_sup['kuan']-$price)<0) {
echo "<br><br><br><br><center>很抱歉，SUP余额不足无法购买!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}
$kuan_s=$yx_sup['kuan']-$price;

//*******************************************************************万恶的黑客修改模板
get_check_price($kuan_s);
get_check_price($afters);
//*******************************************************************万恶的黑客修改模板 The End


///-------------------------------------------更新sup 资金明细
mysql_query("insert into `sup_details_funds` set title='下级购买编号',spendings='$price',befores='$yx_sup[kuan]',afters='$kuan_s',number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$price where number='$yx_sup[number]'",$conn2); 
///-------------------------------------------更新sup 资金明细 The End
mysql_query("insert into `details_funds` set title='购买编号：$row[title]',spendings='$row[price]',befores='$yx_us[kuan]',afters='$afters',number='$row[title]',begtime='$begtime'",$conn1);


mysql_query("update members set agent='$row[title]' where agent in ($_SESSION[ysk_number])",$conn1);///////更新下级会员的代理编号
///////更新店铺收藏夹
mysql_query("update shops_favorites   set username='$row[title]' where username in ($_SESSION[ysk_number])",$conn1);
///////更新产品收藏夹
mysql_query("update product_favorites set number='$row[title]' where number in ($_SESSION[ysk_number])",$conn1);
///////更新店铺分类
mysql_query("update store_class set username='$row[title]' where username in ($_SESSION[ysk_number])",$conn1);
mysql_query("delete from encrypted_card     where username ='$_SESSION[ysk_number]'",$conn1);///////清空密保卡
mysql_query("delete from encrypted_problem  where members ='$_SESSION[ysk_number]'",$conn1);///////清空密保问题
mysql_query("delete from punishment_list where number ='$_SESSION[ysk_number]'",$conn1);///////清空违规列表
mysql_query("delete from sign_in         where number ='$_SESSION[ysk_number]'",$conn1);///////清空签到列表
mysql_query("delete from pay_record      where number ='$_SESSION[ysk_number]'",$conn1);///////清空充值列表
mysql_query("delete from password_lock   where number ='$_SESSION[ysk_number]'",$conn1);///////清空密码锁定列表
mysql_query("delete from complaints_feedback   where number='$_SESSION[ysk_number]'",$conn1);///////清空会员投诉买家反馈
mysql_query("delete from complaints_feedback   where username='$_SESSION[ysk_number]'",$conn1);///////清空会员投诉卖家反馈
mysql_query("delete from balance_cash          where number='$_SESSION[ysk_number]'",$conn1);///////清空会员余额提现
mysql_query("delete from transfer_detail       where number='$_SESSION[ysk_number]'",$conn1);///////清空会员转账明细
mysql_query("delete from details_funds         where number='$_SESSION[ysk_number]'",$conn1);///////会员资金明细
mysql_query("delete from money_order           where number='$_SESSION[ysk_number]'",$conn1);///////汇款通知书
mysql_query("delete from product_order         where `sid`=0 and `docking`=0 and  username='$_SESSION[ysk_number]'",$conn1);///////产品订单卖家
mysql_query("delete from product_order         where number='$_SESSION[ysk_number]'",$conn1);///////产品订单买家
mysql_query("delete from product               where `sid`=0 and `docking`=0 and  username='$_SESSION[ysk_number]'",$conn1);///////商品
mysql_query("delete from sms                   where username='$_SESSION[ysk_number]'",$conn1);///////短信消息接收者
mysql_query("delete from sms                   where sendname='$_SESSION[ysk_number]'",$conn1);///////短信消息发送人
mysql_query("delete from supplier_refund       where username='$_SESSION[ysk_number]'",$conn1);///////供货商退款明细
mysql_query("delete from goods_details         where number='$_SESSION[ysk_number]'",$conn1);  ///////供货商供货明细
mysql_query("delete from goods_yuer            where number='$_SESSION[ysk_number]'",$conn1);///////供货商货款转余额明细

mysql_query("update members set kuan='$afters',number='$row[title]',bad_grades=0,bad_grades1=0,praise1=0,praise2=0,praise3=0,praise4=0,praise5=0,praise6=0,power2=0 where number='$_SESSION[ysk_number]'",$conn1); /////扣掉会员钱 并 绑定编号
$_SESSION['account']=$yx_us['username'];     //存储会员号
$_SESSION['ysk_number']=$row[title]; //存储会员类型
mysql_query("update bianhao_list set type='1',begtime='$begtime' where id='$_REQUEST[id]'",$conn1); 
echo "<br><br><br><center><input id='btnAll' type='button' value='申请成功!'  onClick='cl()' class='tijiao_input' /></center>";
}?>
</body>
</Html>

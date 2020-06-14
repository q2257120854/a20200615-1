
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<script>
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<body>
<?php 
header("Content-Type: text/html; charset=gb2312");
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
include_once('../jhs_config/Share_out_as.php');
$Action=strip_tags($_GET['Action']); 
$proid=check_input($_GET['id']);
$begtime=strip_tags($_POST['begtime']);
//------获取商品
$pro_result=mysql_query("select * from product where id='$proid'",$conn1);
$pro=mysql_fetch_array($pro_result);

//-------获取主站云端
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);


if ($pro['id']==''){
echo "<br><br><br><br><center>很抱歉，您购买的商品不存在!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}
//--------------------------------------------------获取费率级其它资料
//******************************************本地资料
if    ($pro['sid']==0 && $pro['pid']==0){
$fl_result=mysql_query("select *  from product_class where NumberID='$pro[directory2]'",$conn1);
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;
$yx_row_result=mysql_query("select * from buy_modl  where  id='$pro[buy_md]'",$conn1);
$yx_row=mysql_fetch_array($yx_row_result);	
//******************************************Sup资料
}elseif($pro['sid']!=0 && $pro['pid']==0){
$sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2); 
$sup=mysql_fetch_array($sup_result);
$directory4=substr($pro[directory4],0,7);
$yx_row_result=mysql_query("select * from sup_buy_modl  where  id='$pro[buy_md]'",$conn2);##购买模板
$yx_row=mysql_fetch_array($yx_row_result);	
$fl_result=mysql_query("select *  from sup_product_class where NumberID='$directory4'",$conn2);##获取费率
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;
//******************************************平台对接资料
}elseif($pro['sid']==0 && $pro['pid']!=0){
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//获取会员资料
$yx_row_result=mysql_query("select * from buy_modl  where  id='$pro[buy_md]'",$conn3);
$yx_row=mysql_fetch_array($yx_row_result);	
$doc_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$doc_us=mysql_fetch_array($doc_result);
$directory4=substr($pro[directory4],0,7);
$fl_result=mysql_query("select *  from product_class where NumberID='$directory4'",$conn3);##获取费率
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;
//验证平台产品状态 还有是否价格异常
$doc_pro_result=mysql_query("select * from product where id='$pro[pid]'",$conn3);
$doc_pro=mysql_fetch_array($doc_pro_result);
//-------验证商品是否存在
if($doc_pro==''){
mysql_query("delete from product where id ='$proid'",$conn1);
echo "<br><br><br><br><center>购买失败，您购买的商品刚才被删除了!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();	

}

//-------验证价格
if ($pro['price']<>$doc_pro['price2']){
$price2=ysk_buy_Price($yx_us['level'],$doc_pro['price2'],$doc_pro['pricing'],$doc_pro['rate']);
//-------价格更新模块
mysql_query("update product set price2='$price2',price='$doc_pro[price2]' where id='$pro[id]'",$conn1);
echo "<script language=JavaScript>location.replace(location.href);</script>";
exit();
}
//-------验证审核状态
if ($doc_pro['locks']!=2){
echo "<br><br><br><br><center>购买失败，您购买的商品异常!";
exit();
}
//-------验证状态
if ($doc_pro['state']==1){
echo "<br><br><br><br><center>购买失败，该产品已暂停销售!";
exit();
}

if ($doc_pro['state']==2){
echo "<br><br><br><br><center>购买失败，该产品已禁售销售!";
exit();
}

if ($doc_pro['state']==4){
echo "<br><br><br><br><center>购买失败，该产品已下架!";
exit();
}


}
//------防止被客串购买

if(strstr($pro['modl'],"卡密")==true || strstr($pro['modl'],"卡密直充")==true || strstr($pro['modl'],"网盘")==true || strstr($pro['modl'],"选号")==true ){
echo "对不起,系统异常！";
exit();
}
//------防止被客串购买 The End
//------安全验证
ysk_buy_error($pro['state']);                                                          #######状态异常
ysk_buy_area($pro['provinces'],$yx_us['province'],$pro['citys'],$yx_us['city']);       #######地区异常
echo ysk_buy_Api($pro['Api'],'库存',$pro['Api_id'],$pro['id'],0,0,0,0);                #######APi库存检测
echo ysk_buy_Api($pro['Api'],'购价',$pro['Api_id'],$pro['id'],0,0,0,0);                #######APi购价检测
ysk_buy_Sup($pro['sid'],$sup['kuan'],$pro['price'],1);                                 #######Sup购价检测
//------安全验证 The End
if ($Action==''){
$custom1=$yx_row['custom1'];
$type1=$yx_row['type1'];
$content1=$yx_row['content1'];
$custom2=$yx_row['custom2'];
$type2=$yx_row['type2'];
$content2=$yx_row['content2'];
$custom3=$yx_row['custom3'];
$type3=$yx_row['type3'];
$content3=$yx_row['content3'];
$custom4=$yx_row['custom4'];
$type4=$yx_row['type4'];
$content4=$yx_row['content4'];
$custom5=$yx_row['custom5'];
$type5=$yx_row['type5'];
$content5=$yx_row['content5'];
$custom6=$yx_row['custom6'];
$type6=$yx_row['type6'];
$content6=$yx_row['content6'];
$custom7=$yx_row['custom7'];
$type7=$yx_row['type7'];
$content7=$yx_row['content7'];
$custom8=$yx_row['custom8'];
$type8=$yx_row['type8'];
$content8=$yx_row['content8'];?>
<form action="?Action=buy_one&id=<?=$pro['id']?>" method="post" name="userinfo">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<input name="id"       type="hidden"   value="<?=$pro['id']?>"/>
<input name="custom1"  type="hidden"   value="<?=$custom1?>"/>
<input name="custom2"  type="hidden"   value="<?=$custom2?>"/>
<input name="custom3"  type="hidden"   value="<?=$custom3?>"/>
<input name="custom4"  type="hidden"   value="<?=$custom4?>"/>
<input name="custom5"  type="hidden"   value="<?=$custom5?>"/>
<input name="custom6"  type="hidden"   value="<?=$custom6?>"/>
<input name="custom7"  type="hidden"   value="<?=$custom7?>"/>
<input name="custom8"  type="hidden"   value="<?=$custom8?>"/>
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr><td width="27%" height="32" class="td_left">商品名称：</td><td width="73%"><?=$pro['title']?> </td></tr>
<tr><td height="32" class="td_left">商品类型：</td><td><?=$pro['modl']?></td></tr>
<tr>
<td height="32" class="td_left">购买数量：</td>
<td>
<select name="nums" id="nums">
<option value="" selected="selected">请选择...</option>
<?php 
if ($pro['kucun']>=10){
$hi_kucun=10;
}else{
$hi_kucun=$pro['kucun'];
}
for ($i=1; $i<=$hi_kucun;$i++){?>
<option value="<?=$i?>"><?=$i?></option>
<?php } ?>
</select>
</td>
</tr>

<tr><td height="32" class="td_left">商品面值：</td><td><?=number_format($pro['price1'],3)?> <?=$moneytype?></td></tr>
<tr><td height="32" class="td_left">购买单价：</td><td style="color:#FF0000; font-weight:bold"><?=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])?> <?=$moneytype?></td></tr>
<?php if ($custom1!=''){?><tr><td height="32" class="td_left"><?=$custom1?>：</td>
<td><?=ysk_buy_modl($type1,1,$content1)?><?php if($custom1=='固话号码'){echo '格式为：区号-号码 如：021-8888888';}?></td></tr><?php }?>
<?php if ($custom2!=''){?><tr><td height="32" class="td_left"><?=$custom2?>：</td><td><?=ysk_buy_modl($type2,2,$content2)?></td></tr><?php }?>
<?php if ($custom3!=''){?><tr><td height="32" class="td_left"><?=$custom3?>：</td><td><?=ysk_buy_modl($type3,3,$content3)?></td></tr><?php }?>
<?php if ($custom4!=''){?><tr><td height="32" class="td_left"><?=$custom4?>：</td><td><?=ysk_buy_modl($type4,4,$content4)?></td></tr><?php }?>
<?php if ($custom5!=''){?><tr><td height="32" class="td_left"><?=$custom5?>：</td><td><?=ysk_buy_modl($type5,5,$content5)?></td></tr><?php }?>
<?php if ($custom6!=''){?><tr><td height="32" class="td_left"><?=$custom6?>：</td><td><?=ysk_buy_modl($type6,6,$content6)?></td></tr><?php }?>
<?php if ($custom7!=''){?><tr><td height="32" class="td_left"><?=$custom7?>：</td><td><?=ysk_buy_modl($type7,7,$content7)?></td></tr><?php }?>
<?php if ($custom8!=''){?><tr><td height="32" class="td_left"><?=$custom8?>：</td><td><?=ysk_buy_modl($type8,8,$content8)?></td></tr><?php }?>
<tr><td class="td_left"> 购买备注：</td><td><textarea name="txtComment" rows="5" cols="40" id="txtComment"  class="biankuan"></textarea></td></tr>
</table>
<div id="BuyNext" class="tijiao">
<input name="提交" type="submit" class="button_buy" id="btnBuyNext" onClick="return checkuserinfo();" value="下一步" />
<input name="重置" type="reset" class="button_close" id="Button2"  value="重置" />
</div>
</form>
<?php }elseif ($Action=='buy_one') {
inject_check($_POST['nums']);
inject_check($_POST['id']);
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}

if ($_POST['nums']==''     or $_POST['nums']<=0){
echo "<script>alert('对不起，您没有选择购买数量！');history.go(-1);</script>";
exit();
}

if ($_POST['content1']=='' && $_POST['custom1']!=''){
echo "<script>alert('对不起，$_POST[custom1] 不能为空！');history.go(-1);</script>";
exit();
}


if ($_POST['content2']=='' && $_POST['custom2']!=''){
echo "<script>alert('对不起，$_POST[custom2] 不能为空！');history.go(-1);</script>";
exit();
}


if ($_POST['content3']=='' && $_POST['custom3']!=''){
echo "<script>alert('对不起，$_POST[custom3] 不能为空！');history.go(-1);</script>";
exit();
}


echo ysk_buy_Api($pro['Api'],'话费',$pro['Api_id'],$_POST['content2'],$pro['price1'],$_POST['nums'],$_POST['content1'],$pro['Api_buy_type']);#######APi话费直充
ysk_buy_Sup($pro['sid'],$sup['kuan'],$pro['price'],$_POST['nums']);#######Sup购价检测
?>
<form action="?Action=buy_two&id=<?=$pro['id']?>" method="post" name="userinfo">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<input name="id"         type="hidden" value="<?=$_POST['id']?>"/>
<input name="nums"       type="hidden" value="<?=$_POST['nums']?>"/>
<input name="txtComment" type="hidden" value="<?=$_POST['txtComment']?>"/>
<input name="custom1"  type="hidden"   value="<?=$_POST['custom1']?>"/>
<input name="custom2"  type="hidden"   value="<?=$_POST['custom2']?>"/>
<input name="custom3"  type="hidden"   value="<?=$_POST['custom3']?>"/>
<input name="custom4"  type="hidden"   value="<?=$_POST['custom4']?>"/>
<input name="custom5"  type="hidden"   value="<?=$_POST['custom5']?>"/>
<input name="custom6"  type="hidden"   value="<?=$_POST['custom6']?>"/>
<input name="custom7"  type="hidden"   value="<?=$_POST['custom7']?>"/>
<input name="custom8"  type="hidden"   value="<?=$_POST['custom8']?>"/>
<input name="content1"  type="hidden"  value="<?=$_POST['content1']?>"/>
<input name="content2"  type="hidden"  value="<?=$_POST['content2']?>"/>
<input name="content3"  type="hidden"  value="<?=$_POST['content3']?>"/>
<input name="content4"  type="hidden"  value="<?=$_POST['content4']?>"/>
<input name="content5"  type="hidden"  value="<?=$_POST['content5']?>"/>
<input name="content6"  type="hidden"  value="<?=$_POST['content6']?>"/>
<input name="content7"  type="hidden"  value="<?=$_POST['content7']?>"/>
<input name="content8"   type="hidden" value="<?=$_POST['content8']?>"/>
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr><td width="27%" height="32" class="td_left">商品名称：</td><td width="73%"><?=$pro['title']?></td></tr>
<tr><td height="32" class="td_left">商品类型：</td> <td><?=$pro['modl']?></td> </tr>
<tr><td height="32" class="td_left">购买数量：</td> <td><?=$_REQUEST['nums']?> 个</td></tr>
<tr><td height="32" class="td_left">商品面值：</td><td><?=number_format($pro['price1'],3)?> <?=$moneytype?></td></tr>
<tr><td height="32" class="td_left">购买单价：</td><td><?=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']),3)?> <?=$moneytype?></td> </tr>
<tr><td height="32" class="td_left">应收金额：</td><td><?=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])*$_POST['nums'],3)?> <?=$moneytype?></td> </tr>
<?php if ($_POST['custom1']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom1']?>：</td><td><?=$_POST['content1']?></td></tr>
<?php }?>
<?php if ($_POST['custom2']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom2']?>：</td><td><?=$_POST['content2']?></td></tr>
<?php }?>
<?php if ($_POST['custom3']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom3']?>：</td><td><?=$_POST['content3']?></td></tr>
<?php }?>
<?php if ($_POST['custom4']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom4']?>：</td><td><?=$_POST['content4']?></td></tr>
<?php }?>
<?php if ($_POST['custom5']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom5']?>：</td><td><?=$_POST['content5']?></td></tr>
<?php }?>
<?php if ($_POST['custom6']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom6']?>：</td><td><?=$_POST['content6']?></td></tr>
<?php }?>
<?php if ($_POST['custom7']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom7']?>：</td><td><?=$_POST['content7']?></td></tr>
<?php }?>
<?php if ($_POST['custom8']!='') {?>
<tr><td height="32" class="td_left"><?=$_POST['custom8']?>：</td><td><?=$_REQUEST['content8']?></td></tr>
<?php }?>
<tr><td class="td_left"> 购买备注：</td><td><?=$_POST['txtComment']?></td></tr>
<tr><td class="td_left"> 交易密码：</td><td><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="请输入您的交易密码" />
</td>
</tr>
</table>
<div id="BuyNext" class="tijiao">
<input name="提交" type="submit" class="button_buy" id="btnBuyNext" onClick="return checkuserinfo();" value="确认购买" />

</div>
</form>
<?php }if ($Action=='buy_two'){
$nums=inject_check($_POST['nums']);
$id=inject_check($_POST['id']);
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
if (md5($_POST['passwords'])==''){
echo "<script>alert('对不起，交易密码不能为空！');history.go(-1);</script>";
exit();
}
if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script>alert('对不起，交易密码错误!');window.location='buy.php?id=$id';</script>";
exit();
}
$zongprice=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])*$nums; 
$buyprice=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']); 
$Local_Ip=Local_Ip();

if ($buyprice<0 || $zongprice<0){
echo "<br><br><br><br><center>很抱歉，您的余额不足请充值后重新操作!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

if ($yx_us['kuan']<0 || $yx_us['kuan']-$zongprice<0){
echo "<br><br><br><br><center>很抱歉，您的余额不足请充值后重新操作!<br><br><input id='btnAll' type='button' value='点击关闭'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}
//*******************************************************************万恶的黑客修改模板
get_check_price($zongprice);
get_check_price($buyprice);
get_check_price($yx_us['kuan']);
get_check_price(($yx_us['kuan']-$zongprice));
get_check_price($nums);
//*******************************************************************万恶的黑客修改模板 The End
$custom1=strip_tags($_POST['custom1']);
$content1=strip_tags($_POST['content1']); 
$custom2=strip_tags($_POST['custom2']);
$content2=strip_tags($_POST['content2']); 
$custom3=strip_tags($_POST['custom3']);
$content3=strip_tags($_POST['content3']); 
$custom4=strip_tags($_POST['custom4']);
$content4=strip_tags($_POST['content4']); 
$custom5=strip_tags($_POST['custom5']);
$content5=strip_tags($_POST['content5']); 
$custom6=strip_tags($_POST['custom6']);
$content6=strip_tags($_POST['content6']); 
$custom7=strip_tags($_POST['custom7']);
$content7=strip_tags($_POST['content7']); 
$custom8=strip_tags($_POST['custom8']);
$content8=strip_tags($_POST['content8']); 
$txtComment=strip_tags($_POST['txtComment']); 
$buyaction=$_POST['buyaction']; 
$afters=$yx_us['kuan']-$zongprice;
$network=ysk_network(Local_Ip());


////////////////////////////////////////////购物模块划分


if ($pro['sid']==0 && $pro['pid']==0){
$feilv=$zongprice*$feilv;
////////////////////////////////////////////主站购物The End
}elseif($pro['sid']!=0 && $pro['pid']==0){
###############---------------------------------------------------------------------------Sup购价检测
ysk_buy_Sup($pro['sid'],$sup['kuan'],$pro['price'],$nums);
###############---------------------------------------------------------------------------判断是否是API直充
if ($pro['Api_buy_type']==3){#游戏 
echo ysk_buy_Api($pro['Api'],'直充',$dingdanhao,$content2,$pro['Api_id'],$nums,$content1,$pro['Api_buy_type']); 
}else{                       #话费 
echo ysk_buy_Api($pro['Api'],'直充',$dingdanhao,$content2,$pro['price1'],$nums,$content1,$pro['Api_buy_type']);  
}
###############---------------------------------------------------------------------------判断是否是API直充 The End

###############---------------------------------------------------------------------------Sup购买者扣款
$sup_kou=$pro['price']*$nums;
$kuan_s=$sup['kuan']-$sup_kou;
$poundage=$pro['price']*$nums*$feilv;

mysql_query("insert into `sup_details_funds` set title='商品购买',orderid='$dingdanhao',spendings='$sup_kou',befores='$sup[kuan]',afters='$kuan_s',number='$sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$sup_kou where number='$sup[number]'",$conn2); 
###############-------------------------------------------------------------------Sup订单更新
mysql_query("insert into `sup_product_order` set orderid='$dingdanhao',pid='$pro[sid]',buyaction='$buyaction',trading='0',type='$pro[modl]',price='$pro[price1]',buyprice='sup_buyprice',nums='$nums',zongprice='$sup_kou',zongas='$poundage',feilv='$poundage',docking='$pro[docking]',txtcomment='$txtcomment',number='$sup[number]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',begtime='$begtime',custom1='$custom1',content1='$content1',custom2='$custom2',content2='$content2',custom3='$custom3',content3='$content3',custom4='$custom4',content4='$content4',custom5='$custom5',content5='$content5',custom6='$custom6',content6='$content6',custom7='$custom7',content7='$content7',custom8='$custom8',content8='$content8',title='$pro[title]',url='$pro[url]',Api='$pro[Api]',Api_id='$pro[Api_id]',overdue='$pro[overdue]',directory='$pro[directory4]'",$conn2);
////////////////////////////////////////////Sup购物The End
}elseif($pro['sid']==0 && $pro['pid']!=0){

//******************************************平台资料获取	
$doc_zong=$nums*$pro['price2'];
$doc_kuan=$doc_us['kuan']-$doc_zong;
$feilv=$doc_zong*$feilv;

if ($doc_us['kuan']<$doc_zong){
echo "<br><br><br><br><center>购买失败，平台资金不足，请联系主站客服!";
exit();
}
//******************************************更新库存和销售量	
mysql_query("update product set kucun=kucun-$nums,sales=sales+$nums where id='$pro[pid]'",$conn3);
###############---------------------------------------------------------------------------更新购买会员的资金明细
mysql_query("insert into `details_funds` set title='商品购买',orderid='$dingdanhao',spendings='$doc_zong',befores='$doc_us[kuan]',afters='$doc_kuan',number='$sus[username]',begtime='$begtime'",$conn3);
mysql_query("update members set kuan=$doc_kuan,zong_kuan=zong_kuan+$doc_zong where number='$sus[username]'",$conn3); 
###############---------------------------------------------------------------------------新增订单
mysql_query("insert into `product_order` set locks='$supdoc[id]',Api='$pro[Api]',Api_id='$pro[Api_id]',title='$pro[title]',orderid='$dingdanhao',pid='$pro[pid]',sid='$pro[sid]',buyaction='$buyaction',trading='0',type='$pro[modl]',price='$pro[price1]',buyprice='$pro[price2]',nums='$nums',zongprice='$doc_zong',zongas='0',feilv='$feilv',txtcomment='$txtComment',number='$sus[username]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',custom1='$custom1',content1='$content1',custom2='$custom2',content2='$content2',custom3='$custom3',content3='$content3',custom4='$custom4',content4='$content4',custom5='$custom5',content5='$content5',custom6='$custom6',content6='$content6',custom7='$custom7',content7='$content7',custom8='$custom8',content8='$content8',url='$pro[url]',overdue='$pro[overdue]',directory='$pro[directory4]'",$conn3);
////////////////////////////////////////////平台对接购物The End
}

###############---------------------------------------------------------------------------更新库存和销售量
mysql_query("update product set kucun=kucun-$nums,sales=sales+$nums where id='$proid'",$conn1);
###############---------------------------------------------------------------------------更新购买会员的资金明细
mysql_query("insert into `details_funds` set title='商品购买',orderid='$dingdanhao',spendings='$zongprice',befores='$yx_us[kuan]',afters='$afters',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$afters',zong_kuan=zong_kuan+$zongprice where number='$_SESSION[ysk_number]'",$conn1); 
###############---------------------------------------------------------------------------更新购买会员的资金明细 The End
###############---------------------------------------------------------------------------新增订单
mysql_query("insert into `product_order` set docking='$pro[docking]',docid='$pro[pid]',Api='$pro[Api]',Api_id='$pro[Api_id]',title='$pro[title]',orderid='$dingdanhao',pid='$pro[id]',sid='$pro[sid]',buyaction='$buyaction',trading='0',type='$pro[modl]',price='$pro[price1]',buyprice='$buyprice',nums='$nums',zongprice='$zongprice',zongas='0',feilv='$feilv',txtcomment='$txtComment',number='$_SESSION[ysk_number]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',custom1='$custom1',content1='$content1',custom2='$custom2',content2='$content2',custom3='$custom3',content3='$content3',custom4='$custom4',content4='$content4',custom5='$custom5',content5='$content5',custom6='$custom6',content6='$content6',custom7='$custom7',content7='$content7',custom8='$custom8',content8='$content8',url='$pro[url]',overdue='$pro[overdue]',directory='$pro[directory3]'",$conn1);
###############---------------------------------------------------------------------------新增订单 The End


echo "<br><br><br><br><center><input id='btnAll' type='button' value='购买成功!'  onClick='cl()' class='tijiao_input' /></center>";}?>
</body>
</Html>

<script language="javascript">
function checkuserinfo()
{
<?php if ($Action=='') {?>
if(checkspace(document.userinfo.nums.value)) {
document.userinfo.nums.focus();
alert("购买失败，请选择购买数量！");
return false;
}
<?php if ($custom1!=''){?>
if(checkspace(document.userinfo.content1.value)) {
document.userinfo.content1.focus();
alert("购买失败，<?=$custom1?>！");
return false;
}
<?php } ?>

<?php if ($custom2!=''){?>
if(checkspace(document.userinfo.content2.value)) {
document.userinfo.content2.focus();
alert("购买失败，<?=$custom2?>！");
return false;
}
<?php } ?>

<?php if ($custom3!=''){?>
if(checkspace(document.userinfo.content3.value)) {
document.userinfo.content3.focus();
alert("购买失败，<?=$custom3?>！");
return false;
}
<?php } ?>

<?php if ($custom4!=''){?>
if(checkspace(document.userinfo.content4.value)) {
document.userinfo.content4.focus();
alert("购买失败，<?=$custom4?>！");
return false;
}
<?php } ?>

<?php 
if ($custom1!='' && $custom2!=''){
$tmcount1=count(explode("输入",$custom1));
$tmcount2=count(explode("重复",$custom2));
if ($tmcount1>1 && $tmcount2>1 ){?>

if(document.userinfo.content1.value != document.userinfo.content2.value) {
document.userinfo.content1.focus();
document.userinfo.content1.value = '';
document.userinfo.content2.value = '';
alert("购买失败,两次输入的资料不正确请重新输入！");
return false;
}




<?php } } ?>

<?php }else{?>
if(checkspace(document.userinfo.passwords.value)) {
document.userinfo.passwords.focus();
alert("购买失败，请输入交易密码！");
return false;
}
<?php }?>
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
<?php
//echo '贪玩点卡智能建站·全开源卡盟系统 免费下载：www.kycard.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

function ysk_buy_modl($var,$var1,$var2){
if      ($var==1){
echo "<input name=\"content".$var1."\" type=\"text\" class=\"biankuan\">";
}elseif ($var==2){
echo "<input name=\"content".$var1."\" type=\"password\" class=\"biankuan\">";
}elseif ($var==3){
$allArray=(explode('|', $var2)); 
foreach($allArray as $value){  
echo "<input name=\"content".$var1."\" type=\"radio\" value=\"{$value}\">";
}
}elseif ($var==4){
$allArray=(explode('|', $var2)); 
echo"<select name=\"content".$var1."\" id=\"content".$var1."\">";
foreach($allArray as $value){  
echo "<option  value=\"{$value}\">{$value}</option>";
}
}
}

function ysk_buy_area($var,$var1,$var2,$var3){
if ($var!='' ){
if ($var!='全国' && $var!=$var1){
echo   "<center><br><br><br><br><br><br>购买失败，错误原因：该商品只面向".$var."地区用户！</center>"; 
exit();
}elseif ($var!='全国' && $var2!=$var3){
echo   "<center><br><br><br><br><br><br>购买失败，错误原因：该商品只面向".$var2."地区用户！</center>"; 
exit();
}
}
}

//会员抽成
function Share_out_as($var,$var1,$var2,$var3,$var4,$var5){ #代理  抽成级数  购买数量 商品Id 订单号码
global $conn1,$begtime;
$yx_us_result=mysql_query("select * from members where number='$var5' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

$pro_result=mysql_query("select * from product where id='$var3'",$conn1);
$pro=mysql_fetch_array($pro_result);

///////////////////////////////////////////////////////////////////////////////////////////////////////////一级抽成
if ($var1>=1){
$agentsql=mysql_query("select * from members where number='$var' ",$conn1);
$agent=mysql_fetch_array($agentsql);

if ($agent){
$The_toy1=ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']);//下级购价
$The_toy2=ysk_buy_Price($agent['level'],$pro['price2'],$pro['pricing'],$pro['rate']);//自己购价

if (($The_toy1-$The_toy2)>0){
$price=($The_toy1-$The_toy2)*$var2;//最终抽成 等于下级与自己的差价
$afters=$agent['kuan']+$price;
$zongas=$price;
//-------------------------------------------------------------------------------------------------------------新增抽成
mysql_query("insert into `commission_record` set title='下级购买商品',orderid='$var4',nums='$var2',price1='$The_toy1',customers1='$var5',price2='$The_toy2',customers2='$var',begtime='$begtime'",$conn1);
//-------------------------------------------------------------------------------------------------------------新增资金明细
mysql_query("insert into `details_funds` set title='下级购买商品',orderid='$var4',incomes='$price',befores='$agent[kuan]',afters='$afters',number='$var',begtime='$begtime'",$conn1);
//-------------------------------------------------------------------------------------------------------------更新会员资料
mysql_query("update members set kuan='$afters' where number='$var'",$conn1); 
}
}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////二级抽成
if ($var1>=2){
$agentsql1=mysql_query("select * from members where number='$agent[agent]' ",$conn1);
$agent1=mysql_fetch_array($agentsql1);
if ($agent1){
$The_toy3=ysk_buy_Price($agent1['level'],$pro['price2'],$pro['pricing'],$pro['rate']);
if (($The_toy2-$The_toy3)>0){
$price=($The_toy2-$The_toy3)*$var2;
$afters=$agent1['kuan']+$price;
$zongas=$zongas+$price;
mysql_query("insert into `commission_record` set title='下级购买商品',orderid='$var4',nums='$var2',price1='$The_toy2',customers1='$agent[number]',price2='$The_toy3',customers2='$agent[agent]',begtime='$begtime'",$conn1);
mysql_query("insert into `details_funds` set title='下级购买商品',orderid='$var4',incomes='$price',befores='$agent1[kuan]',afters='$afters',number='$agent[agent]',begtime='$begtime'",$conn1);
//-------------------------------------------------------------------------------------------------------------更新会员资料
mysql_query("update members set kuan='$afters' where number='$agent[agent]'",$conn1); 
}
}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////三级抽成
if ($var1>=3){
$agentsql2=mysql_query("select * from members where number='$agent1[agent]' ",$conn1);
$agent2=mysql_fetch_array($agentsql2);
if ($agent2){
$The_toy4=ysk_buy_Price($agent2['level'],$pro['price2'],$pro['pricing'],$pro['rate']);
if (($The_toy3-$The_toy4)>0){
$price=($The_toy3-$The_toy4)*$var2;
$afters=$agent2['kuan']+$price;
$zongas=$zongas+$price;
mysql_query("insert into `commission_record` set title='下级购买商品',orderid='$var4',nums='$var2',price1='$The_toy3',customers1='$agent1[number]',price2='$The_toy4',customers2='$agent1[agent]',begtime='$begtime'",$conn1);
mysql_query("insert into `details_funds` set title='下级购买商品',orderid='$var4',incomes='$price',befores='$agent2[kuan]',afters='$afters',number='$agent1[agent]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$afters' where number='$agent1[agent]'",$conn1); 
}
}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////四级抽成
if ($var1>=4){
$agentsql3=mysql_query("select * from members where number='$agent2[agent]' ",$conn1);
$agent3=mysql_fetch_array($agentsql3);
if ($agent3){
$The_toy5=ysk_buy_Price($agent3['level'],$pro['price2'],$pro['pricing'],$pro['rate']);
if (($The_toy4-$The_toy5)>0){
$price=($The_toy4-$The_toy5)*$var2;
$afters=$agent3['kuan']+$price;
$zongas=$zongas+$price;
mysql_query("insert into `commission_record` set title='下级购买商品',orderid='$var4',nums='$var2',price1='$The_toy4',customers1='$agent2[number]',price2='$The_toy5',customers2='$agent2[agent]',begtime='$begtime'",$conn1);
mysql_query("insert into `details_funds` set title='下级购买商品',orderid='$var4',incomes='$price',befores='$agent3[kuan]',afters='$afters',number='$agent2[agent]',begtime='$begtime'",$conn1);
//-------------------------------------------------------------------------------------------------------------更新会员资料
mysql_query("update members set kuan='$afters' where number='$agent2[agent]'",$conn1); 
}
}
}
return $zongas;
}
?>
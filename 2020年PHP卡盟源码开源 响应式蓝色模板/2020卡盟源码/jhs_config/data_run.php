
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

##########################平台对接订单更新

##########################平台对接订单



##########################  商品更改操作发送对应站内信给会员
$result=mysql_query("select * from Goods_change ",$conn1);
while($rs=mysql_fetch_array($result)){

//*****************判断条件 0 修改 1 删除

if($rs['locks']==0){

$results=mysql_query("select * from product_favorites where pid='$rs[uid]' and title<>'$rs[title]' ",$conn1);
while($rss=mysql_fetch_array($results)){
$content='你收藏的商品名称为“'.$rss['title'].'”被修改成了“'.$rs['title'].'”';
mysql_query("insert into `sms` (title,content,state,locks,username,sendname,begtime) " ."values ('你收藏的商品名称被修改了','$content','0','1','$rss[number]','系统管理员','$begtime')",$conn1);

mysql_query("update product_favorites set title='$rs[title]' where id='$rss[id]'",$conn1);

}


}else{
	
$results=mysql_query("select * from product_favorites where pid='$rs[uid]' and title<>'$rs[title]' ",$conn1);
while($rss=mysql_fetch_array($results)){
$content='你收藏的商品名称为“'.$rss['title'].'”已被删掉了';
mysql_query("insert into `sms` (title,content,state,locks,username,sendname,begtime) " ."values ('你收藏的商品已经被删除了','$content','0','1','$rss[number]','系统管理员','$begtime')",$conn1);
mysql_query("delete from product_favorites where id='$rss[id]'",$conn1);
}
	
}
	
	

//////////////////////////信息操作好删除该信息
mysql_query("delete from Goods_change where id='$rs[id]'",$conn1);
}
##########################  商品更改操作发送对应站内信给会员 The End

##########################  判断旗舰店是否到期
$result=mysql_query("select * from flagship_shops where overday<'$begtime' ",$conn1);
while($rs=mysql_fetch_array($result)){
mysql_query("delete from flagship_shops where id ='$rs[id]'",$conn1);
}
##########################  判断旗舰店是否到期结束

##########################  更新旗舰店押金
$result=mysql_query("select * from flagship_shops ",$conn1);
while($rs=mysql_fetch_array($result)){
$uxresult=mysql_query("select * from members  where number='$rs[username]'",$conn1);
$user=mysql_fetch_array($uxresult);	
mysql_query("update `flagship_shops` set price='$user[frozen_kuan]' where id='$rs[id]'",$conn1); 
}
##########################  更新旗舰店押金


##########################  买家交易完成后超过72小时未评价 默认给卖家好评
$result=mysql_query("select * from product_order where trading=2 and buy_pl=0 ",$conn1);
while($rs=mysql_fetch_array($result)){
if ($begtime-$rs['begtime']>=259200){
mysql_query("update members set praise1=praise1+1 where number='$rs[username]'",$conn1); 
mysql_query("update product_order set buy_pl=1 where id='$rs[id]'",$conn1); 
}
}
##########################  买家交易完成后超过72小时未评价 默认给卖家好评结束


##########################  买家申请退款，72小时未处理退款并扣分
if ($sup_auto_refund=='0') {
$result=mysql_query("select * from product_order where refund=1  ",$conn1);
while($rs=mysql_fetch_array($result)){ 
if ($nlegal_open=='0'){##############################################################是否开启违规处罚
if ($begtime-$rs['refundtime']>=259200){
mysql_query("insert into  `punishment_list`  set title='$rs[orderid]退款超过72小时未处理',number='$rs[username]',deduct='$nlegal_m_4',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_m_4 where number='$rs[username]'",$conn1); 
}
//--------------------------------------------------------------------------------------------------订单退款
$uresult=mysql_query("select * from members  where number='$rs[number]'",$conn1);
$user=mysql_fetch_array($uresult);
$mresult=mysql_query("select * from members  where number='$rs[username]'",$conn1);
$mai=mysql_fetch_array($mresult);
$presult=mysql_query("select * from  product  where id='$rs[pid]'",$conn1);
$pro=mysql_fetch_array($presult);
$zongas=number_format($rs['zongas'],3);
$zongprice=number_format($rs['zongprice'],3);
$jia_kuan=$user['kuan']+$zongprice;  
if (($mai['frozen_kuan']-$mai['min_amount'])-$rs['zongprice']>0) {//如果供货商金额满足退款金额则退款
$kuan=$mai['frozen_kuan']-$zongprice;
$kou_title='扣押金'.number_format($zongprice,3).'元';
mysql_query("insert into `supplier_refund` (title,price1,price2,price3,content,username,begtime) " . "values ('$rs[orderid] 订单退款','$zongprice','$zongas','$zongprice','$kou_title','$rs[username]','$begtime')",$conn1);
mysql_query("update `members`  set frozen_kuan='$kuan'  where number='$rs[username]'",$conn1); 
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('订单退款','$rs[orderid]','$zongprice','$user[kuan]','$jia_kuan','$rs[number]','$begtime')",$conn1);
mysql_query("update `members`       set kuan='$jia_kuan'  where number='$rs[number]'",$conn1); 
mysql_query("update `product_order` set trading='3',refund='4' where orderid='$rs[orderid]'",$conn1); 
}

}
}
}
##########################  买家申请退款，72小时未处理退款并扣分  The End


if ($nlegal_open=='0'){
#####买家达到处罚积分上线时候
$xresult=mysql_query("select * from members where bad_grades1>='$nlegal_b_4'",$conn1);
while($user=mysql_fetch_array($xresult)){
$kuan=$user['kuan']-$nlegal_b_5;
if ($kuan<0){$kuan=0;}
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " . "values ('卖家违规达到 $nlegal_b_4 分 扣款','$nlegal_b_5','$user[kuan]','$kuan','$user[number]','$begtime')",$conn1);
mysql_query("update members set kuan='$kuan',bad_grades1='0',overdue='$nlegal_b_6',freeze_time='$begtime',wg_rds1=wg_rds1+1 where number='$user[number]'",$conn1);
}
#####卖家达到处罚积分上线时候  The End


#####卖家达到处罚积分上线时候
$xresult=mysql_query("select * from members where bad_grades>='$nlegal_m_10'",$conn1);
while($user=mysql_fetch_array($xresult)){
$kuan=$user['kuan']-$nlegal_m_11;
if ($kuan<0){$kuan=0;}
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " . "values ('卖家违规达到 $nlegal_m_10 分 扣款','$nlegal_m_11','$user[kuan]','$kuan','$user[number]','$begtime')",$conn1);
mysql_query("update members set kuan='$kuan',bad_grades='0',overdue='$nlegal_m_12',freeze_time='$begtime',wg_rds2=wg_rds2+1  where number='$user[number]'",$conn1);
}
#####卖家达到处罚积分上线时候  The End
}


##########更新店铺资料
$xresult=mysql_query("select * from product_class  where LagID='2' and number<>''",$conn1);
while($pro=mysql_fetch_array($xresult)){
$uxresult=mysql_query("select * from members  where number='$pro[number]'",$conn1);
$user=mysql_fetch_array($uxresult);	
$$praise2=$user[praise1]-$user[praise3];
mysql_query("update `product_class`  set praise1='$user[praise1]',praise2='$praise2',price='$user[frozen_kuan]'  where number='$user[number]'",$conn1); 
}
##########更新店铺资料  The End

##########同步SUP投诉反馈


##########同步SUP投诉反馈  The End
$xresult=mysql_query("select * from complaints_feedback  where sid<>0 and audit=0 ",$conn1);
while($pro=mysql_fetch_array($xresult)){
$bresult=mysql_query("select * from sup_complaints_feedback  where number='$pro[number]' and username='$pro[username]' and orerno='$pro[orerno]' ",$conn2);
$books=mysql_fetch_array($bresult);
mysql_query("update `complaints_feedback`  set reply='$books[reply]',audit='$books[audit]',begtime='$books[begtime]'  where id='$pro[id]'",$conn1); 
}


##########同步SUP订单数据
$xresult=mysql_query("select * from product_order  where sid<>0 and trading<3 and refund<>4",$conn1);
while($pro=mysql_fetch_array($xresult)){
$bresult=mysql_query("select * from sup_product_order where number='$sup_number' and orderid='$pro[orderid]'",$conn2);
$spro=mysql_fetch_array($bresult);
$uresults=mysql_query("select * from members  where number='$pro[number]'",$conn1);
$users=mysql_fetch_array($uresults);
//**------------------------------------------------------------------------------------------------------------------更新主站订单数据
mysql_query("update `product_order`  set trading='$spro[trading]',sell_pl='$spro[sell_pl]',reply='$spro[reply]',begtime='$spro[begtime]',refundtime='$spro[refundtime]' where id='$pro[id]'",$conn1);
//**------------------------------------------------------------------------------------------------------------------如果订单是退款的话
if  ($spro['trading']=='3' || $spro['refund']=='4'){ //---------------------------------------------------------------订单退款开始了
//**------------------------------------------------------------------------------------------------------------------判断是否全额退款
$tresult=mysql_query("select * from sup_details_funds where number='$sup_number' and orderid='$pro[orderid]' and title='订单退款'",$conn2);
$tpro=mysql_fetch_array($tresult);
if ($tpro['incomes']==$spro['zongprice']){//--------------------------------------------------------------------------如果退款金额等于订单金额则全额退款
$kuan=$users['kuan']+$pro['zongprice'];
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('订单退款','$pro[orderid]','$pro[zongprice]','$users[kuan]','$kuan','$pro[number]','$begtime')",$conn1);
}else{//--------------------------------------------------------------------------------------------------------------退款金额小于实际订单金额 则按天退款
$roresult=mysql_query("select * from  product  where id='$pro[pid]'",$conn1);
$ro=mysql_fetch_array($roresult);
//*************************************************************************************************获取按天退款的时间
$preturn=mysql_query("select * from complaints_feedback where orerno='$pro[orderid]'",$conn1); 
$fee_row=mysql_fetch_array($preturn);
$price=Ysk_Single_back($ro['overdue'],$pro['begtime'],$fee_row['time'],$pro['zongprice']);//**************************获取按天退款金额
$kuan=$users['kuan']+$price;
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('订单退款','$pro[orderid]','$price','$users[kuan]','$kuan','$pro[number]','$begtime')",$conn1);
}
mysql_query("update `members` set kuan='$kuan'  where number='$pro[number]'",$conn1); //******************更新会员账户金额
}
}
##########同步SUP订单数据  The End

##########SUP异常检测
#=====SUP商品进价调高=====#
$xresult=mysql_query("select * from product  where sid<>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]' and price2>$pro[price2]",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-1'  where id='$pro[id]'",$conn1); 
}
}
#=====SUP商品进价调低=====#
$xresult=mysql_query("select  * from product  where sid<>0 and state>=0 ",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where id='$pro[sid]' and price2<$pro[price2]",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-2'  where id='$pro[id]'",$conn1); 
}
}
#=====进货商为黑名单=====#
$xresult=mysql_query("select  * from product  where sid<>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]' and  state='-3'",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-3'  where id='$pro[id]'",$conn1); 
}
}
#=====SUP商品未上架=====#
$xresult=mysql_query("select  * from product  where sid <>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]' and  state=1",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-4'  where id='$pro[id]'",$conn1); 
}
}
#=====SUP商品未通过审核=====#
$xresult=mysql_query("select  * from  product  where sid <>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]' and  locks<>2",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-5'  where id='$pro[id]'",$conn1); 
}
}
#=====SUP商品为黑名单=====#
$xresult=mysql_query("select  * from product  where sid <>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]' and  state='-6'",$conn2));
if($total!=0){
mysql_query("update `product`  set state='-6'  where id='$pro[id]'",$conn1); 
}
}
#=====SUP商品已删除=====#
$xresult=mysql_query("select  * from  product  where sid <>0 and state>=0",$conn1);
while($pro=mysql_fetch_array($xresult)){
$total=mysql_num_rows(mysql_query("select * from sup_product where  id='$pro[sid]'",$conn2));
if($total==0){
mysql_query("update `product`  set state='-7'  where id='$pro[id]'",$conn1); 
}
}
##########SUP异常检测  The End
?>
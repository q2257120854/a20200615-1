<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$id=$_REQUEST['id'];
$sql=mysql_query("select * from diary where id='$id'",$conn1);
$row=mysql_fetch_array($sql);
//**********************************************************如果操作类型是商品的话
if     ($row['type']=='5'){
$total=mysql_num_rows(mysql_query("select * from `product` where id='$row[sid]' ",$conn1));
$back_result=mysql_query("select * from product_back  where pid='$row[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($total==0){
//**********************************************************如果该商品被删除则新增一条数据
mysql_query("insert into product set sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',pid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]'",$conn1);
$myid=mysql_insert_id($conn1);
//--------------------------------------------或者新增Id值更新到 卡密 或者 网盘中
if      ($back['modl']=='网盘'){
mysql_query("update  cloud_key set pid='$myid' where pid in ($back[pid])",$conn1);
}elseif($back['modl']=='卡密' || $back['modl']=='选号'){
mysql_query("update  import_goods set pid='$myid' where pid in ($back[pid])",$conn1);
}
ysk_date_log(5,$_SESSION['ysk_username'],'恢复了一条名称为 "'.$back['title'].'" 的商品信息');
echo "<script>alert('恢复成功!');self.location=document.referrer;</script>";
exit();
}else{
//**********************************************************如果该商品存在则覆盖资料
mysql_query("update  product set sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',reason='$back[reason]',time='$back[time]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',pid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]' where id='$back[pid]'",$conn1);	
ysk_date_log(5,$_SESSION['ysk_username'],'恢复了一条名称为 "'.$back['title'].'" 的商品信息');
echo "<script>alert('恢复成功!');self.location=document.referrer;</script>";
exit();
}


//**********************************************************如果操作类型是客户资料操作
}elseif($row['type']=='2'){
$total=mysql_num_rows(mysql_query("select * from `members` where id='$row[sid]' ",$conn1));
$back_result=mysql_query("select * from members_back  where uid='$row[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($total==0){
mysql_query("insert into members set wg_rds1='$back[wg_rds1]',wg_rds2='$back[wg_rds2]',level='$back[level]',logins='$back[logins]',firsts='$back[firsts]',locks='$back[locks]',integral='$back[integral]',agent='$back[agent]',number='$back[number]',username='$back[username]',password='$back[password]',passwords='$back[passwords]',company='$back[company]',rname='$back[rname]',card='$back[card]',qq='$back[qq]',email='$back[email]',phone='$back[phone]',address='$back[address]',kuan='$back[kuan]',goods_kuan='$back[goods_kuan]',zong_kuan='$back[zong_kuan]',frozen_kuan='$back[frozen_kuan]',max_amount='$back[max_amount]',min_amount='$back[min_amount]',site_credit='$back[site_credit]',praise1='$back[praise1]',praise2='$back[praise2]',praise3='$back[praise3]',praise4='$back[praise4]',praise5='$back[praise5]',praise6='$back[praise6]',bad_grades='$back[bad_grades]',bad_grades1='$back[bad_grades1]',ban_reason='$back[ban_reason]',overdue='$back[overdue]',freeze_time='$back[freeze_time]',begtime='$back[begtime]',power1='$back[power1]',power2='$back[power2]',power3='$back[power3]',power4='$back[power4]',power5='$back[power5]',power6='$back[power6]',power7='$back[power7]',power8='$back[power8]',power9='$back[power9]',power10='$back[power10]',power11='$back[power11]',power12='$back[power12]',province='$back[province]',city='$back[city]',sign_in='$back[sign_in]',xlevel='$back[xlevel]',wing='$back[wing]',time='$back[time]',lost_time='$back[lost_time]',log_time='$back[log_time]',lost_ip='$back[lost_ip]',log_ip='$back[log_ip]',lost_dz='$back[lost_dz]',log_dz='$back[log_dz]',card_pic='$back[card_pic]',card_lock='$back[card_lock]',zongren='$back[zongren]',Api_qq='$back[Api_qq]',power13='$back[power13]',power14='$back[power14]',power15='$back[power15]',error='$back[error]',erdu1='$back[erdu1]',DocApi1='$back[DocApi1]'",$conn1);
ysk_date_log(5,$_SESSION['ysk_username'],'恢复了一条编号是 "'.$back['number'].'" 的会员信息');
echo "<script>alert('恢复成功!');self.location=document.referrer;</script>";
exit();
}else{
//**********************************************************如果该会员存在则覆盖资料
mysql_query("update  members set rname='$back[rname]',card='$back[card]',email='$back[email]',phone='$back[phone]',qq='$back[qq]',address='$back[address]' where id='$back[uid]'",$conn1);	
ysk_date_log(5,$_SESSION['ysk_username'],'恢复了一条编号是 "'.$back['number'].'" 的会员信息');
echo "<script>alert('恢复成功!');self.location=document.referrer;</script>";
exit();
}
}else{
echo "系统异常";
}
?>
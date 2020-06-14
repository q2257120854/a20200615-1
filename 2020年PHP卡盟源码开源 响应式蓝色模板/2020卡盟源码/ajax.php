<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php 
include_once('jhs_config/function.php');
$Method=$_POST['Method'];
$customerName=$_POST['customerName'];
$agent=$_POST['agent'];
//验证有无该代理
if    ($Method=="checkagent"){
$total=mysql_num_rows(mysql_query("select * from `members`  where  number='$agent' ",$conn1));
if ($total==0){
echo "2";
}else{
echo "1";
}
//判断用户名是否重复
}elseif    ($Method=="checkCustomerName"){
$total=mysql_num_rows(mysql_query("select * from `sup_username_reg`  where username='$customerName' or email='$customerName'",$conn2));
if ($total==0){
echo "2";
}else{
echo "1";
}


}
?>
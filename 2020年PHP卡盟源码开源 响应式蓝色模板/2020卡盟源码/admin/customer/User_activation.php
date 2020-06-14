<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$keywords=strip_tags($_POST['content']);
$keyword=strip_tags($_POST['content']);
$agent=strip_tags($_POST['agent']);
?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="User_activation.php">用户激活</a></li>
</ul>
</div>

<form name="add" method="post" action="User_activation.php?Action=save">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin:10px 0px;">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="<?=$keyword?>" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="keywords" id="keywords">
<option <?php if ($keywords=='content'){?>selected="selected"<?php } ?> value="username">用户名</option>
<option <?php if ($keywords=='content'){?>selected="selected"<?php } ?> value="email">电子邮箱</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
上级编号：</td>
<td class="left">
<input name="agent" type="text" maxlength="25" id="agent" value="<?=$agent?>" /> 
可以留空
</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认激活"  class="chaxun_input" />
</td>
</tr>
</table>
</form>


<?php if($Action=="save"){

if ($agent!=''){
//-------------判断是否有该上级
$zong=mysql_num_rows(mysql_query("select * from `members` where number='$agent' ",$conn1));
if ($zong==0){
echo "对不起激活失败，没有找到该上级！";
exit();	
}
}


//------------验证主站是否有该用户了
$total=mysql_num_rows(mysql_query("select * from `members` where $keywords='$keyword' ",$conn1));
if ($total>0){
echo "对不起激活失败，该用户已经激活了呀！";
exit();	
}

//------------验证云端是否有该用户存在

$total=mysql_num_rows(mysql_query("select * from `check_reg` where $keywords='$keyword' ",$conn2));
if ($total==0){
echo "对不起激活失败，没有找到该用户呀！";
exit();	
}else{
	
//------------查询到数据进行复制更新

$result=mysql_query("select * from check_reg where $keywords='$keyword' ",$conn2);
$row=mysql_fetch_array($result);
	
///////////////////////////////////////////////////////////////////////////搜索编号记录
$bh_result=mysql_query("select * from  bianhao_list",$conn1);
while($bh=mysql_fetch_array($bh_result)){
$strid.=$bh['title'].',';
}
$strid=substr($strid,0,strlen($strid)-1);//构造出id字符串
///////////////////////////////////////////////////////////////////////////查询记录不在靓号列表的一条记录
if ($strid!=''){
$us_result=mysql_query("select * from members where  number NOT IN($strid) order by number desc limit 1 ",$conn1);
}else{
$us_result=mysql_query("select * from members  order by number desc limit 1 ",$conn1);
}
$user=mysql_fetch_array($us_result);
$Uid=$user['number']+1;
///////////////////////////////////////////////////////////////////////////进行最后验证是否重复

$total=mysql_num_rows(mysql_query("select * from `members` where  number='$Uid' order by number desc ",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$Uid=$Uid+1;
}
$total=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title='$Uid'",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$zong=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title>'$Uid'",$conn1));
for($i=1;$i<=$zong;$i++){
$result=mysql_query("select * from  bianhao_list  where title='$Uid' ",$conn1);
$row=mysql_fetch_array($result);
if ($row){
$Uid=$Uid+1;
}
}
}
///////////////////////////////////////////////////////////////////////////进行最后验证是否重复 THE End


////////////////////////////////////////////////////////////////////////////进行记录的更新
$network=ysk_network(Local_Ip());
$Local_Ip=Local_Ip();
if      ($agent!='' and $site_agent==$agent){
$site_leve=$site_leve;
}elseif ($agent=='' and $site_agent!='' ){
$site_leve=$site_leve;
}else{
$site_leve='1';
}

mysql_query("insert into `members` set level='$site_leve',agent='$agent',number='$Uid',username='$row[username]',password='$row[password]',passwords='$row[passwords]',company='$row[company]',rname='$row[rname]',card='$row[card]',qq='$row[qq]',email='$row[email]',phone='$row[phone]',address='$row[address]',begtime='$begtime',province='$row[province]',city='$row[city]',time='$begtime',lost_time='$begtime',log_time='$begtime',lost_ip='$Local_Ip',log_ip='$Local_Ip',lost_dz='$network',log_dz='$network'  ",$conn1);
if ($agent!=''){
mysql_query("update members set xlevel=xlevel+1 where number='$agent'",$conn1); 
}

echo "激活成功！";
exit();	
}

} ?>
</body>
</Html>

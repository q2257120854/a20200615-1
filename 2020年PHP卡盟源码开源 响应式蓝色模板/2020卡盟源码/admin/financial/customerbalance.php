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
$Action=$_REQUEST['Action'];


////////修改货款记录
If ($Action=="djsave"){
if ($admin['passwords']!=$papa){
echo "<script>alert('对不起，您的操作密码有误！!');self.location=document.referrer;</script>";
exit();
}

$price=get_check_price($_POST['frozen_kuan']);
$biao_kuan=get_check_price($_POST['biao_kuan']);
$di_kuan=get_check_price($_POST['di_kuan']);
$id=inject_check($_GET['Id']);
$sql="select * from members where id='$id'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
if ($row['kuan']<$price) {
echo "<script language=\"javascript\">alert('对不起，该会员余额不足转冻结的钱！');history.go(-1);</script>";
exit();
}
$zzkuan1=$row['kuan']-$price;
$zzkuan2=$row['frozen_kuan']+$price;
$zzkuan3=$row['biao_kuan']+$biao_kuan;
$zzkuan4=$row['di_kuan']+$di_kuan;
if ($price!='0' or $price!='' ){
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('余额转冻结款','$price','$row[kuan]','$zzkuan1','$row[number]','$begtime')",$conn1);

}
mysql_query("update members set max_amount='$zzkuan3',min_amount='$zzkuan4',kuan='$zzkuan1',frozen_kuan='$zzkuan2' where id='$id'",$conn1); 
echo "<script>alert('提交成功!');;window.location='?Action=List';</script>";
}
////////修改货款记录
If ($Action=="hksave") {
	if ($admin['passwords']!=$papa){
echo "<script>alert('对不起，您的操作密码有误！!');self.location=document.referrer;</script>";
exit();
}
$price=get_check_price($_POST['price']);
$id=inject_check($_POST['Id']);
$sql="select * from members where id='$id'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
if ($row['goods_kuan']<$price) {
echo "<script language=\"javascript\">alert('对不起，该会员货款不足转余额的钱！');history.go(-1);</script>";
exit();
}
$zzgoods_kuan=$row['goods_kuan']-$price;
$zzkuan=$row['kuan']+$price;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime)"."values ('供货款转余额','$price','$row[kuan]','$zzkuan','$row[number]','$begtime')",$conn1);

mysql_query("update members set goods_kuan='$zzgoods_kuan',kuan='$zzkuan' where id='$id'",$conn1); 
echo "<script>alert('提交成功!');;window.location='?Action=List';</script>";
}


?>
<?php if ($Action=="List" or $Action==""){ ?>

<form name="add" method="get" action="customerbalance.php" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
<option value="username">用户名</option>
<option value="rname">联系人姓名</option>
<option value="qq">QQ号码</option>
<option value="phone">手机号码</option>
</select>

<select name="level" id="level">
<option selected="selected" value="">全部级别</option>
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<option value="<?=$Orzx['id']?>"><?=$Orzx['title']?></option>
<?php 
} }?>
</select>


<select name="locks" id="locks">
<option selected="selected" value="">全部状态</option>
<option value="0">开通</option>
<option value="1">禁止</option>
</select>

</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="12%" class="table_top">
<?php if ($_REQUEST['a']=='desc'){?>
<a href="?paixu=number&a=asc&abcd=<?=$_REQUEST['abcd']?>">编号</a>
<?php }else{ ?>
<a href="?paixu=number&a=desc&abcd=<?=$_REQUEST['abcd']?>">编号</a>
<?php }?></td>
<td width="13%" class="table_top">用户名</td>
<td width="12%" class="table_top">公司名称</td>
<td width="12%" class="table_top">客户级别</td>

<td width="8%" class="table_top">
<?php if ($_REQUEST['b']=='desc'){?>
<a href="?paixu=kuan&b=asc&abcd=<?=$_REQUEST['abcd']?>">余额</a>
<?php }else{ ?>
<a href="?paixu=kuan&b=desc&abcd=<?=$_REQUEST['abcd']?>">余额</a>
<?php }?></td>
<td width="8%" class="table_top"><?php if ($_REQUEST['c']=='desc'){?>
<a href="?paixu=goods_kuan&c=asc&abcd=<?=$_REQUEST['abcd']?>">货款</a>
  <?php }else{ ?>
  <a href="?paixu=goods_kuan&c=desc&abcd=<?=$_REQUEST['abcd']?>">货款</a>
  <?php }?></td>
<td width="8%" class="table_top">
冻结金额</td>
<td width="10%" class="table_top">已消费</td>
</tr>
<?php
$keyword=strip_tags($_GET['keyword']);    //搜索关键词
$keywords=strip_tags($_GET['keywords']);  //查询条件
$level=strip_tags($_GET['level']);        //查询等级
$locks=strip_tags($_GET['locks']);        //是否禁止
$paixu=strip_tags($_GET['paixu']);        //排序类型
$abcd=strip_tags($_GET['abcd']);          //下级代理
$search="where 1=1 "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
if ($level!='')    $search.=" and level ='$level'"; 
if ($locks!='')    $search.=" and locks ='$locks'"; 
if ($abcd!='')     $search.=" and agent ='$abcd'"; 
$sorting="";
if ($paixu!='' and $_REQUEST['a']!='' ) $sorting.=" order by  $paixu $_REQUEST[a],id desc "; 
if ($paixu!='' and $_REQUEST['b']!='' ) $sorting.=" order by  $paixu $_REQUEST[b],id desc "; 
if ($paixu!='' and $_REQUEST['c']!='' ) $sorting.=" order by  $paixu $_REQUEST[c],id desc "; 
if ($paixu=='') $sorting.=" order by  number desc "; 
$total=mysql_num_rows(mysql_query("SELECT id,level,username,number,company,kuan,goods_kuan,frozen_kuan,zong_kuan FROM `members`  $search ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);

$sql="select id,level,username,number,company,kuan,goods_kuan,frozen_kuan,zong_kuan  from members $search $sorting  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td><?=$row['company']?></td>
<td><?php
$sql1="select * from level where id='$row[level]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
?><?=$row1['title']?></td>
<td><?=number_format($row['kuan'],3);?></td>
<td><a href="?Action=hk&id=<?=$row['id']?>"><span style="color:#009933; text-decoration:underline"><?=number_format($row['goods_kuan'],3);?></span></a></td>
<td><a href="?Action=dj&id=<?=$row['id']?>"><span style="color:#009933; text-decoration:underline"><?=number_format($row['frozen_kuan'],3);?></span>   </a>  </td>
	<td><?=number_format($row['zong_kuan'],3);?></td>
</tr>
<?php
$myprice1=$myprice1+$row['kuan'];
$myprice2=$myprice2+$row['goods_kuan'];
$myprice3=$myprice3+$row['frozen_kuan'];
$myprice4=$myprice4+$row['zong_kuan'];
}
?>
<tr>
<td height="28">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>本页合计：</td>
<td><b style="color:red"><?=number_format($myprice1,3)?>元</b></td>
<td><b style="color:red"><?=number_format($myprice2,3)?>元</b></td>
<td><b style="color:red"><?=number_format($myprice3,3)?>元</b></td>
<td><b style="color:red"><?=number_format($myprice4,3)?>元</b></td>
</tr>

<tr>
<td height="28">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>总共合计：</td>
<td><?php
$res=mysql_query("SELECT sum(kuan)    from members $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?>元</b></td>
<td><?php
$res=mysql_query("SELECT sum(goods_kuan)    from members $search  ",$conn1);
$sum1=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum1,3);?>元</b>
</td>
<td><?php
$res=mysql_query("SELECT sum(frozen_kuan)    from members $search  ",$conn1);
$sum2=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum2,3);?>元</b>
</td>
<td><?php
$res=mysql_query("SELECT sum(zong_kuan)    from members $search  ",$conn1);
$sum3=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum3,3);?>元</b>
</td>
</tr>
<tr style="">
<td colspan="8">
<?php if ($total!=0){?><?=$page->paging();?><?php }?>     
</td>
</tr>
</table>
</form>
</div>
<?php }elseif($Action=="dj"){  
$sql="select * from members where id='$_REQUEST[id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=djsave" method="post" name="add">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">冻结金额修改</td>
</tr>
<tr>
<td class="td_left">会员编号：</td>
<td class="td_right"><?=$row['number']?></td>
</tr>
<tr>
<td class="td_left">会员余额：</td>
<td class="td_right"><?=number_format($row['kuan'],3);?> 元</td>
</tr>
<tr>
<td class="td_left">冻结金额：</td>
<td class="td_right"><?=number_format($row['frozen_kuan'],3);?> 元</td>
</tr>
<tr>
<td class="td_left">标准金额：</td>
<td class="td_right"><?=number_format($row['max_amount'],3);?> 元
</td>
</tr>

<tr>
<td class="td_left">最低保留金额：</td>
<td class="td_right"><?=number_format($row['min_amount'],3);?> 元
</td>
</tr>
<tr>
<td class="td_left">添加标准金额：</td>
<td class="td_right"><input name="biao_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> 元
</td>
</tr>
<tr>
<td class="td_left">添加最低保留金额：</td>
<td class="td_right"><input name="di_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> 元
</td>
</tr>
<tr>
<td class="td_left">确认冻结加款：</td>
<td class="td_right"><input name="frozen_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> 元
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">安全验证</td>
</tr>
<tr>
<td width="10%" class="td_left">请输入您的操作密码：</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="确认修改" id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
<input type="button" value="关闭" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="hk"){  
$sql="select * from members where id='$_REQUEST[id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=hksave" method="post" name="add" >
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">自有商品收入转余额</td>
</tr>
<tr>
<td width="10%" class="td_left"> 客户编号 ：</td>
<td width="90%" class="left"><?=$row['number']?>
</td>
</tr>
<tr>
<td width="10%" class="td_left"> 未转收入 ：</td>
<td width="90%" class="left"><?=$row['goods_kuan']?> 元</td>
</tr>

<tr>
<td width="10%" class="td_left"> 转余额的金额 ：</td>
<td width="90%" class="left">
<input name="price" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> 元
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">安全验证</td>
</tr>
<tr>
<td width="10%" class="td_left">请输入您的操作密码：</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>

<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
</td>
</tr>
</table>
</form>
<?php } ?>

</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){



if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("对不起，您还没有输入您的操作密码呢！");
return false;
}

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
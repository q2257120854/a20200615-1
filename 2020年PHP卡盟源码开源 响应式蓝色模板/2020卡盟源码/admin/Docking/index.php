<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$wrresult=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2);
$wrongs=mysql_fetch_array($wrresult);


////////添加记录
if ($Action=="Addsave"){
$appuid=encrypt($_POST['appuid'],'D','nowamagic');
$appkey=strip_tags($_POST['appkey']);
$number=strip_tags($_POST['number']);

$sup_result=mysql_query("select * from sup_members_site where domain_name='$appuid' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('127.0.0.1',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料

///////------------验证该记录是否存在
$total=mysql_num_rows(mysql_query("select * from `docking_platform` where uid='$appuid' and key='$appkey' and username='$number' ",$conn1));
if ($total!=0){
echo "<center><br><br><br><br>操作失败，该平台您已经对接过了！</center>";
exit();
}
//////-------------验证对接平台是否存在云端
$total=mysql_num_rows(mysql_query("select * from `sup_members_site` where domain_name='$appuid' ",$conn2));
if ($total==0){
echo "<center><br><br><br><br>操作失败，APP UID不存在！</center>";
exit();
}
//////-------------验证是否对接自己
if ($wrongs['domain_name']==$appuid){
echo "<center><br><br><br><br>操作失败，您不可以对接自身平台！</center>";
exit();
}

//////-------------验证该资料是否存在
$total=mysql_num_rows(mysql_query("select * from `members` where number='$number' and DocApi1='$appkey' and power13=1 ",$conn3));
if ($total==0){
echo "<center><br><br><br><br>操作失败，APP KEY不存在11！</center>";
exit();
}
//////-------------验证该资料是否存在 The End

/////------如果资料都正确则更新数据

ysk_date_log(6,$_SESSION['ysk_username'],'新增了一条网址为 "'.$appuid.'" 平台对接！');
mysql_query("insert into `docking_platform` set uid='$appuid',keykey='$appkey',mydatabase='$sup[mydatabase]',username='$number',begtime='$begtime' ",$conn1); 



echo "<br><br><br><br><center><input id='btnAll' type='button' value='对接成功!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////修改记录
If ($Action=="editsave") {
$Id=inject_check($_POST['Id']);
$appkey=strip_tags($_POST['appkey']);
$number=strip_tags($_POST['number']);
$result=mysql_query("select * from docking_platform where id='$Id' ",$conn1);
$row=mysql_fetch_array($result);

//----获取云端数据

$sup_result=mysql_query("select * from sup_members_site where domain_name='$row[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');

//////-------------验证对接平台是否存在云端
$total=mysql_num_rows(mysql_query("select * from `sup_members_site` where domain_name='$row[uid]' ",$conn2));
if ($total==0){
echo "<script language=\"javascript\">alert('操作失败，APP UID不存在！');history.go(-1);</script>";
exit();
}

//////-------------验证该资料是否存在
$total=mysql_num_rows(mysql_query("select * from `members` where number='$number' and DocApi1='$appkey' and power13=1 ",$conn3));
if ($total==0){
echo "<script language=\"javascript\">alert('操作失败，APP KEY不存在22！');history.go(-1);</script>";
exit();
}
//////-------------验证该资料是否存在 The End
if ($number!=$row['username']){
ysk_date_log(6,$_SESSION['ysk_username'],'把网址为 "'.$row['uid'].'" 平台对接编号修改成了'.$number);
}

if ($appkey!=$row['keykey']){
ysk_date_log(6,$_SESSION['ysk_username'],'把网址为 "'.$row['uid'].'" 平台对接APP KEY修改成了'.$appkey);
}

mysql_query("update `docking_platform` set keykey='$appkey',username='$number' where id='$Id' ",$conn1); 
echo "<script>alert('修改成功!');;window.location='index.php';</script>";

}

////////删除单记录
If ($Action=="del") {
$Id=inject_check($_GET['Id']);
$sql=mysql_query("select * from docking_platform  where id ='$Id'",$conn1);
$row=mysql_fetch_array($sql);
ysk_date_log(6,$_SESSION['ysk_username'],'删除了一条网址为 "'.$row['uid'].'" 平台对接！');

mysql_query("delete from docking_platform where id ='$Id'",$conn1);
mysql_query("delete from product where docking in($Id)",$conn1);
//删除对应产品

echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}

?>
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
</head>
<body>
<?php if($Action=="List" or $Action==""){?>

<div class="gn">
<input id="add" type="button" value="添加对接" class="tijiao_input" onclick="$.dialog.open('Docking/index.php?Action=add', {title: '平台对接', width:600, height:211,lock: true,fixed:true});" />
</div>


<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="18%" height="32" class="table_top">平台域名</td>
<td width="11%" class="table_top">平台编号</td>
<td width="14%" class="table_top">平台等级</td>
<td width="9%" class="table_top">平台资金</td>
<td width="22%" class="table_top"> APP KEY </td>
<td width="14%" class="table_top">对接时间</td>
<td width="6%" class="table_top">修改</td>
<td width="6%" class="table_top">删除</td>
</tr>
<?php
$result=mysql_query("select * from  docking_platform   order by begtime desc,id desc ",$conn1);
while($row=mysql_fetch_array($result)){

$sup_result=mysql_query("select * from sup_members_site where domain_name='$row[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料

//**************************************************************获取会员数据
$yx_us_result=mysql_query("select * from members where number='$row[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);
//**************************************************************获取会员数据 The End

?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="32"><?=$row['uid']?></td>
<td><?=$row['username']?></td>
<td><?php
$levelresult=mysql_query("select * from level where id='$yx_us[level]'",$conn3);
$level=mysql_fetch_array($levelresult);
echo $level['title'];?></td>
<td><?=number_format($yx_us['kuan'],3)?> 元</td>
<td><?=$row['keykey']?></td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$row['id']?>"></a> </td>
<td><a class="a delete" onclick="return confirm('确定删除？');"  href="?Action=del&Id=<?=$row['id']?>"></a></td>
</tr>
<?php }?>
</table>
</div>
<?php }elseif($Action=="add"){  ?>
<form name="userinfo" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">APP UID：</td>
<td><input name="appuid" type="text" class="biankuan" style="width:350px;"></td>
</tr>
<tr>
<td  class="td_left">APP KEY ：</td>
<td><input name="appkey" type="text" class="biankuan" style="width:350px;" ></td>
</tr>
<tr>
<td  class="td_left">平台编号：</td>
<td><input name="number" type="text" class="biankuan" style="width:150px;"  ></td>
</tr>
<td>
</td>
<td>
<input type="submit" value="确认添加" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$sql="select * from docking_platform where id='$Id'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">平台域名：</td>
<td><?=$row['uid']?></td>
</tr>
<tr>
<td  class="td_left">平台编号 ：</td>
<td><input name="number" type="text" class="biankuan" style="width:150px;" value="<?=$row['username']?>" ></td>
</tr>
<tr>
<td  class="td_left">APP KEY：</td>
<td><input name="key" type="text" class="biankuan" style="width:350px;"  value="<?=$row['keykey']?>"></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){

if(checkspace(document.userinfo.appuid.value)) {
document.userinfo.appuid.focus();
alert("操作失败，APP UID 不能为空！");
return false;
}

if(checkspace(document.userinfo.appkey.value)) {
document.userinfo.appkey.focus();
alert("操作失败，APP KEY 不能为空！");
return false;
}

if(checkspace(document.userinfo.number.value)) {
document.userinfo.number.focus();
alert("操作失败，平台编号不能为空！");
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
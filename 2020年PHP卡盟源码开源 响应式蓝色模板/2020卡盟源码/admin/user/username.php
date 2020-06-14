
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];

if ($Action=="addsave") {
$username=strip_tags($_POST['username']);
$rname=strip_tags($_POST['rname']);
$email=strip_tags($_POST['email']);
$begtime=$_POST['begtime'];       
$password=md5(strip_tags($_POST['password'])); 
$passwords=md5(strip_tags($_POST['passwords']));


$total=mysql_num_rows(mysql_query("select * from `administrator` where username='$username'",$conn1));
if ($total>0){
echo "<script language=\"javascript\">alert('对不起，账户已经存在了请重新输入！');window.history.back(-1);</script>";
}else{  
ysk_date_log(6,$_SESSION['ysk_username'],'新增了一个名称为 "'.$username.'" 系统管理员');
mysql_query("insert into `administrator`(username,rname,password,passwords,email,begtime) "."values ('$username','$rname','$password','$passwords','$email','$begtime')",$conn1);
echo "<script>alert('添加成功!');;window.location='username.php';</script>";
}

}

////////设置会员权限
If ($Action=="locksave") {
$mudi=$_POST['lock'];
$mudi=implode(",", $mudi);
$y1=$_POST['y1'];
$y2=$_POST['y2'];
if ($y1<>$mudi){
ysk_date_log(6,$_SESSION['ysk_username'],'给系统管理'.$y2.'修改了一些操作权限');
}
mysql_query("update administrator set flag='$mudi' where id='$_REQUEST[id]'",$conn1); 
echo "<script>alert('修改成功!');window.location='username.php';</script>";
}

////////修改记录
If ($Action=="editsave") {
$rname=strip_tags($_POST['rname']);
$username=strip_tags($_POST['username']);
$password=strip_tags($_POST['password']);
$passwords=strip_tags($_POST['passwords']);
$email=strip_tags($_POST['email']);
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$y4=strip_tags($_POST['y4']);
$y5=strip_tags($_POST['y5']);
if ($y1<>$rname){ysk_date_log(6,$_SESSION['ysk_username'],'把备注名称 "'.$y1.'" 修改成"'.$rname.'"');}
if ($y2<>$username){ysk_date_log(6,$_SESSION['ysk_username'],'把会员账户 "'.$y2.'" 修改成"'.$username.'"');}
if ($y5<>$email){ysk_date_log(6,$_SESSION['ysk_username'],'把绑定邮箱 "'.$y5.'" 修改成"'.$email.'"');}

mysql_query("update administrator set username='$_POST[username]',rname='$_POST[rname]' where id='$_REQUEST[id]'",$conn1);
if ($password<>''){
$password1=md5($password);
if ($y3<>$password1){ysk_date_log(6,$_SESSION['ysk_username'],'把会员账户 "'.$y2.'" 密码修改成"'.$password.'"');}
mysql_query("update administrator set password='$password1' where id='$_REQUEST[id]'",$conn1);	
}
if ($passwords<>''){
$passwords1=md5($passwords);
if ($y4<>$passwords1){ysk_date_log(6,$_SESSION['ysk_username'],'把会员账户 "'.$y2.'" 操作密码修改成"'.$passwords.'"');}
mysql_query("update administrator set passwords='$passwords1' where id='$_REQUEST[id]'",$conn1);	
}

echo "<script>alert('修改成功!');;window.location='username.php';</script>";
}

////////删除单记录
if ($Action=="del") {

ysk_date_log(6,$_SESSION['ysk_username'],'删除一个名称为 "'.$_REQUEST['name'].'" 的系统管理员');
mysql_query("delete from administrator where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');window.location='username.php';</script>";
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from administrator where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');window.location='username.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>

<link rel="stylesheet" href="../css/layui.css" media="all">
<link rel="stylesheet" href="../css/admin.css" media="all">
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript">

function diag(var1,var2){

var user = window.prompt("安全操作","请在此输入您的操作密码");
window.location.href="username.php?Action=del&Id="+var1+"&name="+var2+"&papa="+user;
}
</script>
<?php If  ($Action==""){ ?>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">管理中心 - Powered by <a href="http://www.juheshe.cn" target="_blank">聚合社</a></div>
	  <div class="layui-card-body" style="padding: 15px;">
<div style="padding-bottom: 10px;"> <a href="?Action=add" class="layui-btn layui-btn-sm layui-btn-normal">添加管理员</a>
		  </div>
		  <table class="layui-table admin-table">
<div class="layui-table-header"><thead>
                <tr>
                    <th width="80px" style="text-align:center">编号</th>
					<th width="200px" style="text-align:center">会员账户</th>
					<th width="300px" style="text-align:center">备注名称</th>
                    <th width="300px" style="text-align:center">账户余额</th>
                    <th width="500px" style="text-align:center">开通时间</th>
                    <th width="200px" style="text-align:center">管理权限</th>
                    <th width="200px" style="text-align:center">操作日志</th>
                    <th width="200px" style="text-align:center">操作</th>
                </tr>
            </thead>
			</div></div>
<?php

$total=mysql_num_rows(mysql_query("SELECT * FROM `administrator`  ",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from administrator   order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><?=$row[id]?></td>
<td align="center"><?=$row['username']?></td>
<td align="center"><?=$row['rname']?></td>
<td align="center"><?=$row['amount']?></td>
<td align="center"> <?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=lock&id=<?=$row['id']?>" class="layui-btn layui-btn-sm">权限设置</a></td>
<td align="center"><a href="diary_datas.php?username=<?=$row['username']?>" class="layui-btn layui-btn-sm layui-btn-normal">查看日志</a></td>
<td align="center"><a href="?Action=edit&id=<?=$row['id']?>" class="layui-btn layui-btn-sm layui-btn-radius">编辑</a> 
  <?php if ($_SESSION['ysk_founder']!='1') {?>
  <a href="#"  onClick="Javascript:return confirm('对不起，您不是创始人无法删除用户！');" class="layui-btn layui-btn-sm layui-btn-danger">删除</a>
  <?php }else{?>
  <?php if ($_SESSION['ysk_username']==$row['username']){?>
  <?php }else{?>
  <a href="#"  onclick="diag(<?=$row['id']?>,'<?=$row['rname']?>')" class="layui-btn layui-btn-sm layui-btn-danger">删除</a>
  <?php }?>
  <?php }?> </td>
</tr>
<?php
 }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px;">
<?=$page->paging();?>   
</td>
</tr>
</table>
<?php  }elseif ($Action=="add") { ?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{


if(checkspace(document.add.rname.value)) {
document.add.rname.focus();
alert("对不起，备注名称不能为空！");
return false;
}

if(checkspace(document.add.username.value)) {
document.add.username.focus();
alert("对不起，会员账户不能为空！");
return false;
}

if(checkspace(document.add.password.value)) {
document.add.password.focus();
alert("对不起，会员密码不能为空！");
return false;
}

if(checkspace(document.add.passwords.value)) {
document.add.passwords.focus();
alert("对不起，会员操作密码不能为空！");
return false;
}



if(document.add.email.value.length!=0)
{
if (document.add.email.value.charAt(0)=="." ||        
document.add.email.value.charAt(0)=="@"||       
document.add.email.value.indexOf('@', 0) == -1 || 
document.add.email.value.indexOf('.', 0) == -1 || 
document.add.email.value.lastIndexOf("@")==document.add.email.value.length-1 || 
document.add.email.value.lastIndexOf(".")==document.add.email.value.length-1)
{
alert("Email地址格式不正确！");
document.add.email.focus();
return false;
}
}
else{
alert("Email地址不能为空！");
document.add.email.focus();
return false;
}

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
<form name="add" method="post" action="?Action=addsave" >

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息添加</td>
</tr>
<input name="begtime" readonly="readonly" type="hidden"  value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<tr>
<td width="10%" class="td_left">备注名称：</td>
<td width="90%" class="left"><input name="rname" type="text" style="width:150px;" value="" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">会员账户：</td>
<td width="90%" class="left"><input name="username" type="text" style="width:150px;" value="" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">登录密码：</td>
<td width="90%" class="left"><input name="password" type="text" style="width:150px;" value="" class="biankuan" /> </td>
</tr>
<tr>
<td width="10%" class="td_left">操作密码：</td>
<td width="90%" class="left"><input name="passwords" type="text" style="width:150px;" value="" class="biankuan" />【操作密码涉及重要操作，请谨慎！】 </td>
</tr>
<tr>
<td width="10%" class="td_left">绑定邮箱：</td>
<td width="90%" class="left"><input name="email" type="text" style="width:150px;" value="" class="biankuan" /> </td>
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
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php  }elseif ($Action=="lock"){ 
$sql=mysql_query("select * from administrator where id='$_REQUEST[id]'",$conn1);
$row=mysql_fetch_array($sql);
$ysk_flagh=(explode(',',$row['flag']));
?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{
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

<form name="add" method="post" action="?Action=locksave&id=<?=$row[id]?>" >
<input name="y1" type="hidden" value="<?=$row['flag']?>">
<input name="y2" type="hidden" value="<?=$row['rname']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">

<tr>
<td class="table_top"> 常规管理 </td>
</tr>

<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="101" <?php if(in_array('101',$ysk_flagh)==true){?>checked="checked"<?php }?>> 基本设置
<input name="lock[]" type="checkbox" id="lock[]" value="102" <?php if(in_array('102',$ysk_flagh)==true){?>checked="checked"<?php }?>> 收费设置
<input name="lock[]" type="checkbox" id="lock[]" value="103" <?php if(in_array('103',$ysk_flagh)==true){?>checked="checked"<?php }?>> 收款设置
<input name="lock[]" type="checkbox" id="lock[]" value="104" <?php if(in_array('104',$ysk_flagh)==true){?>checked="checked"<?php }?>> 邮箱设置
<input name="lock[]" type="checkbox" id="lock[]" value="105" <?php if(in_array('105',$ysk_flagh)==true){?>checked="checked"<?php }?>> 广告设置
<input name="lock[]" type="checkbox" id="lock[]" value="106" <?php if(in_array('106',$ysk_flagh)==true){?>checked="checked"<?php }?>> API设置
<input name="lock[]" type="checkbox" id="lock[]" value="107" <?php if(in_array('107',$ysk_flagh)==true){?>checked="checked"<?php }?>> 轮播管理
<input name="lock[]" type="checkbox" id="lock[]" value="108" <?php if(in_array('108',$ysk_flagh)==true){?>checked="checked"<?php }?>> 友情链接
<input name="lock[]" type="checkbox" id="lock[]" value="109" <?php if(in_array('109',$ysk_flagh)==true){?>checked="checked"<?php }?>> 文章管理
<input name="lock[]" type="checkbox" id="lock[]" value="110" <?php if(in_array('110',$ysk_flagh)==true){?>checked="checked"<?php }?>> 站内信息
<input name="lock[]" type="checkbox" id="lock[]" value="111" <?php if(in_array('111',$ysk_flagh)==true){?>checked="checked"<?php }?>> 防注册机

</td>
</tr>

<tr>
<td  class="table_top">系统管理</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="201" <?php if(in_array('201',$ysk_flagh)==true){?>checked="checked"<?php }?>> 账户管理
<?php if ($sup_number_module=='0') {?>
<input name="lock[]" type="checkbox" id="lock[]" value="202" <?php if(in_array('202',$ysk_flagh)==true){?>checked="checked"<?php }?>> 编号管理
<?php } ?>
<input name="lock[]" type="checkbox" id="lock[]" value="203" <?php if(in_array('203',$ysk_flagh)==true){?>checked="checked"<?php }?>> 旗舰店管理
<?php if ($sup_rules_module=='0') {?>
<input name="lock[]" type="checkbox" id="lock[]" value="204" <?php if(in_array('204',$ysk_flagh)==true){?>checked="checked"<?php }?>> 违规管理
<?php } ?>

</td>
</tr>
<tr>
<td  class="table_top">商品管理</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="301" <?php if(in_array('301',$ysk_flagh)==true){?>checked="checked"<?php }?>> 目录管理
<input name="lock[]" type="checkbox" id="lock[]" value="302" <?php if(in_array('302',$ysk_flagh)==true){?>checked="checked"<?php }?>> 商品管理
<input name="lock[]" type="checkbox" id="lock[]" value="303" <?php if(in_array('303',$ysk_flagh)==true){?>checked="checked"<?php }?>> 价格模板管理
<input name="lock[]" type="checkbox" id="lock[]" value="304" <?php if(in_array('304',$ysk_flagh)==true){?>checked="checked"<?php }?>> 购买模板管理
<input name="lock[]" type="checkbox" id="lock[]" value="305" <?php if(in_array('305',$ysk_flagh)==true){?>checked="checked"<?php }?>> 供货商商品管理
<input name="lock[]" type="checkbox" id="lock[]" value="306" <?php if(in_array('306',$ysk_flagh)==true){?>checked="checked"<?php }?>> 供货商商品审核
<input name="lock[]" type="checkbox" id="lock[]" value="307" <?php if(in_array('307',$ysk_flagh)==true){?>checked="checked"<?php }?>> 平台对接
<input name="lock[]" type="checkbox" id="lock[]" value="308" <?php if(in_array('308',$ysk_flagh)==true){?>checked="checked"<?php }?>> 其他管理
</td>
</tr>
<tr>
<td  class="table_top">客户管理</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="401" <?php if(in_array('401',$ysk_flagh)==true){?>checked="checked"<?php }?>> 供货商列表
<input name="lock[]" type="checkbox" id="lock[]" value="402" <?php if(in_array('402',$ysk_flagh)==true){?>checked="checked"<?php }?>> 会员级别设置
<input name="lock[]" type="checkbox" id="lock[]" value="403" <?php if(in_array('403',$ysk_flagh)==true){?>checked="checked"<?php }?>> 会员列表
<input name="lock[]" type="checkbox" id="lock[]" value="404" <?php if(in_array('404',$ysk_flagh)==true){?>checked="checked"<?php }?>> 资金明细
<input name="lock[]" type="checkbox" id="lock[]" value="405" <?php if(in_array('405',$ysk_flagh)==true){?>checked="checked"<?php }?>> 批量设置
<input name="lock[]" type="checkbox" id="lock[]" value="406" <?php if(in_array('406',$ysk_flagh)==true){?>checked="checked"<?php }?>> 上下级定义
<input name="lock[]" type="checkbox" id="lock[]" value="407" <?php if(in_array('407',$ysk_flagh)==true){?>checked="checked"<?php }?>> 下级VIP网站列表
<input name="lock[]" type="checkbox" id="lock[]" value="408" <?php if(in_array('408',$ysk_flagh)==true){?>checked="checked"<?php }?>> 安全管理
<input name="lock[]" type="checkbox" id="lock[]" value="409" <?php if(in_array('409',$ysk_flagh)==true){?>checked="checked"<?php }?>> 密码锁定
<input name="lock[]" type="checkbox" id="lock[]" value="410" <?php if(in_array('410',$ysk_flagh)==true){?>checked="checked"<?php }?>> 
用户激活
<input name="lock[]" type="checkbox" id="lock[]" value="411" <?php if(in_array('411',$ysk_flagh)==true){?>checked="checked"<?php }?>> 真实资料验证
<input name="lock[]" type="checkbox" id="lock[]" value="412" <?php if(in_array('412',$ysk_flagh)==true){?>checked="checked"<?php }?>> 域名备案
</td>
</tr>
<tr>
<td  class="table_top">SUP平台信息</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="501" <?php if(in_array('501',$ysk_flagh)==true){?>checked="checked"<?php }?>> Sup信息
</td>
</tr>


<tr>
<td  class="table_top">订单管理</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="601" <?php if(in_array('601',$ysk_flagh)==true){?>checked="checked"<?php }?>> 供货订单记录
<input name="lock[]" type="checkbox" id="lock[]" value="602" <?php if(in_array('602',$ysk_flagh)==true){?>checked="checked"<?php }?>> Sup订单管理
<input name="lock[]" type="checkbox" id="lock[]" value="603" <?php if(in_array('603',$ysk_flagh)==true){?>checked="checked"<?php }?>> 平台对接订单
</td>
</tr>


<tr>
<td  class="table_top">财务管理</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="701" <?php if(in_array('701',$ysk_flagh)==true){?>checked="checked"<?php }?>> 提现管理
<input name="lock[]" type="checkbox" id="lock[]" value="702" <?php if(in_array('702',$ysk_flagh)==true){?>checked="checked"<?php }?>> 汇款帐号
<input name="lock[]" type="checkbox" id="lock[]" value="703" <?php if(in_array('703',$ysk_flagh)==true){?>checked="checked"<?php }?>> 汇款通知书
<input name="lock[]" type="checkbox" id="lock[]" value="704" <?php if(in_array('704',$ysk_flagh)==true){?>checked="checked"<?php }?>> 货款转余额
<input name="lock[]" type="checkbox" id="lock[]" value="705" <?php if(in_array('705',$ysk_flagh)==true){?>checked="checked"<?php }?>> 财务加/扣款
<input name="lock[]" type="checkbox" id="lock[]" value="706" <?php if(in_array('706',$ysk_flagh)==true){?>checked="checked"<?php }?>> 记录
<input name="lock[]" type="checkbox" id="lock[]" value="707" <?php if(in_array('707',$ysk_flagh)==true){?>checked="checked"<?php }?>> 客服加/扣款
<input name="lock[]" type="checkbox" id="lock[]" value="708" <?php if(in_array('708',$ysk_flagh)==true){?>checked="checked"<?php }?>> 记录
<input name="lock[]" type="checkbox" id="lock[]" value="709" <?php if(in_array('709',$ysk_flagh)==true){?>checked="checked"<?php }?>> 提成明细
<input name="lock[]" type="checkbox" id="lock[]" value="710" <?php if(in_array('710',$ysk_flagh)==true){?>checked="checked"<?php }?>> 金额检查
<input name="lock[]" type="checkbox" id="lock[]" value="711" <?php if(in_array('711',$ysk_flagh)==true){?>checked="checked"<?php }?>> 在线付款明细
</td>
</tr>

<tr>
<td  class="table_top">充值卡管理</td>
</tr>


<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="801" <?php if(in_array('801',$ysk_flagh)==true){?>checked="checked"<?php }?>>  充值卡管理
<input name="lock[]" type="checkbox" id="lock[]" value="802" <?php if(in_array('802',$ysk_flagh)==true){?>checked="checked"<?php }?>>  充值卡导入
</td>
</tr>

<tr>
<td  class="table_top">请输入您的操作密码</td>
</tr>


<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td>
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>


</table>
</form>
<?php  }elseif ($Action=="edit") { 
 $sql="select * from administrator where id='$_REQUEST[id]'";   //读取数据表
 $zyc=mysql_query($sql,$conn1);  //执行该SQl语句
 $row=mysql_fetch_array($zyc);
?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{
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
<form name="add" method="post" action="?Action=editsave&id=<?=$row[id]?>" >
<input name="y1" type="hidden" value="<?=$row['rname']?>">
<input name="y2" type="hidden" value="<?=$row['username']?>">
<input name="y3" type="hidden" value="<?=$row['password']?>">
<input name="y4" type="hidden" value="<?=$row['passwords']?>">
<input name="y5" type="hidden" value="<?=$row['email']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息修改</td>
</tr>
<tr>
<td width="10%" class="td_left">备注名称：</td>
<td width="90%" class="left"><input name="rname" type="text" style="width:150px;" value="<?=$row[rname]?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">会员账户：</td>
<td width="90%" class="left"><input name="username" type="text" style="width:150px;" value="<?=$row[username]?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">登录密码：</td>
<td width="90%" class="left"><input name="password" type="password" style="width:150px;" value="" class="biankuan" /> 不修改留空</td>
</tr>
<tr>
<td width="10%" class="td_left">操作密码：</td>
<td width="90%" class="left"><input name="passwords" type="password" style="width:150px;" value="" class="biankuan" /> 不修改留空</td>
</tr>
<tr>
<td width="10%" class="td_left">绑定邮箱：</td>
<td width="90%" class="left"><input name="email" type="email" style="width:150px;" value="<?=$row[email]?>" class="biankuan" /> </td>
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
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>

</table>
</form>
<?php
 }
 ?>
</body>
</Html>
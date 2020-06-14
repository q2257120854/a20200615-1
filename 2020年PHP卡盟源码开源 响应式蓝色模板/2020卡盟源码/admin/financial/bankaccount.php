
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////添加记录
if ($Action=="Addsave"){
$bank_type=strip_tags($_POST['bank_type']);     //银行类型
$bankaccount=strip_tags($_POST['bankaccount']); //银行账户
$accountname=strip_tags($_POST['accountname']); //持卡人姓名
$bankcity=strip_tags($_POST['bankcity']);       //开户地区

ysk_date_log(6,$_SESSION['ysk_username'],'新增了一条 "'.$bank_type.'" 收款人是 '.$accountname.' 的汇款账户！');
mysql_query("insert into `rem_account` (bank_type,bankaccount,accountname,bankcity,time) "."values ('$bank_type','$bankaccount','$accountname','$bankcity','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='添加成功!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////修改记录
If ($Action=="editsave") {
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$y4=strip_tags($_POST['y4']);
$bank_type=strip_tags($_POST['bank_type']);    //银行类型
$bankaccount=strip_tags($_POST['bankaccount']);//银行账户
$accountname=strip_tags($_POST['accountname']);//持卡人姓名
$bankcity=strip_tags($_POST['bankcity']);      //开户地区
if ($y1<>$bank_type){ysk_date_log(6,$_SESSION['ysk_username'],'把汇款账户 银行类型"'.$y1.'" 修改成 '.$bank_type.'');}
if ($y2<>$bankaccount){ysk_date_log(6,$_SESSION['ysk_username'],'把汇款账户 银行账户"'.$y2.'" 修改成 '.$bankaccount.'');}
if ($y3<>$bankcity){ysk_date_log(6,$_SESSION['ysk_username'],'把汇款账户 开户地区"'.$y3.'" 修改成 '.$bankcity.'');}
if ($y4<>$accountname){ysk_date_log(6,$_SESSION['ysk_username'],'把汇款账户 持卡人姓名"'.$y4.'" 修改成 '.$accountname.'');}
$godo=mysql_query("update rem_account set bank_type='$bank_type',bankaccount='$bankaccount',accountname='$accountname',bankcity='$bankcity'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";

}

////////删除单记录
If ($Action=="del") {
$sql=mysql_query("select * from rem_account  where id ='$_REQUEST[Id]'",$conn1);
$row=mysql_fetch_array($sql);
ysk_date_log(3,$_SESSION['ysk_username'],'删除了一条 "'.$row['bank_type'].'" 收款人是 '.$row['accountname'].' 的汇款账户！');
mysql_query("delete from rem_account where id ='$_REQUEST[Id]'",$conn1);
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
<input id="add" type="button" value="添加账户" class="tijiao_input" onclick="$.dialog.open('?Action=add', {title: '汇款账户添加', width: 600, height: 300,lock: true,fixed:true});" />
</div>


<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="19%" height="32" class="table_top">银行类型</td>
<td width="23%" class="table_top">银行账号</td>
<td width="22%" class="table_top">持卡人姓名</td>
<td width="24%" class="table_top">开户地区</td>
<td width="6%" class="table_top">修改</td>
<td width="6%" class="table_top">删除</td>
</tr>
<?php
$Rss="SELECT * FROM rem_account  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['bank_type']?></td>
<td><?=$Orzx['bankaccount']?></td>
<td><?=$Orzx['accountname']?></td>
<td height="24"><?=$Orzx['bankcity']?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a> </td>
<td><a class="a delete" onclick="return confirm('确定删除？');"  href="?Action=del&Id=<?=$Orzx['id']?>"></a></td>
</tr>
<?php 
} }?>

</table>
</div>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">银行类型：</td>
<td><select name="bank_type" id="bank_type">
<option value="" selected="selected">请选择银行</option>
<option value="农业银行">农业银行</option>
<option value="工商银行">工商银行</option>
<option value="招商银行">招商银行</option>
<option value="支付宝">支付宝</option>
<option value="浦发银行">浦发银行</option>
<option value="交通银行">交通银行</option>
<option value="建设银行">建设银行</option>
<option value="中国银行">中国银行</option>
<option value="兴业银行">兴业银行</option>
<option value="华夏银行">华夏银行</option>
<option value="民生银行">民生银行</option>
<option value="邮政储蓄">邮政储蓄</option>
<option value="商业银行">商业银行</option>
<option value="广发银行">广发银行</option>
<option value="深发银行">深发银行</option>
<option value="光大银行">光大银行</option>
<option value="中信银行">中信银行</option>
<option value="北京银行">北京银行</option>
<option value="上海银行">上海银行</option>
<option value="浙商银行">浙商银行</option>
<option value="宁波银行">宁波银行</option>
<option value="信用社">信用社</option>
<option value="财付通">财付通</option>
<option value="江苏银行">江苏银行</option>
<option value="成都银行">成都银行</option>
<option value="内蒙古银行">内蒙古银行</option>
<option value="平安银行">平安银行</option>
<option value="盛付通">盛付通</option>
<option value="国付宝">国付宝</option>
<option value="手机支付">手机支付</option>

</select></td>
</tr>
<tr>
<td  class="td_left"> 银行账号 ：</td>
<td><input name="bankaccount" type="text" class="biankuan" style="width:350px;"  placeholder="银行卡号" /></td>
</tr>
<tr>
<td  class="td_left">开户地区：</td>
<td><input name="bankcity" type="text" class="biankuan" style="width:250px;"    placeholder="某省某市"/></td>
</tr>
<tr>
<td  class="td_left">持卡人姓名：</td>
<td><input name="accountname" type="text" class="biankuan" style="width:150px;"  placeholder="4个汉字以内"/></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from rem_account where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="y1" name="y1" type="hidden" value="<?=$row['bank_type']?>">
<input id="y2" name="y2" type="hidden" value="<?=$row['bankaccount']?>">
<input id="y3" name="y3" type="hidden" value="<?=$row['bankcity']?>">
<input id="y4" name="y4" type="hidden" value="<?=$row['accountname']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">银行类型：</td>
<td><select name="bank_type" id="bank_type">
<option value="" >请选择银行</option>
<option value="农业银行" <?php if ($row['bank_type']=='农业银行'){?>selected="selected"<?php } ?>>农业银行</option>
<option value="工商银行" <?php if ($row['bank_type']=='工商银行'){?>selected="selected"<?php } ?>>工商银行</option>
<option value="招商银行" <?php if ($row['bank_type']=='招商银行'){?>selected="selected"<?php } ?>>招商银行</option>
<option value="支付宝"   <?php if ($row['bank_type']=='支付宝')  {?>selected="selected"<?php } ?>>支付宝</option>
<option value="浦发银行"  <?php if ($row['bank_type']=='浦发银行'){?>selected="selected"<?php } ?>>浦发银行</option>
<option value="交通银行" <?php if ($row['bank_type']=='交通银行'){?>selected="selected"<?php } ?>>交通银行</option>
<option value="建设银行" <?php if ($row['bank_type']=='建设银行'){?>selected="selected"<?php } ?>>建设银行</option>
<option value="中国银行" <?php if ($row['bank_type']=='中国银行'){?>selected="selected"<?php } ?>>中国银行</option>
<option value="兴业银行" <?php if ($row['bank_type']=='兴业银行'){?>selected="selected"<?php } ?>>兴业银行</option>
<option value="华夏银行" <?php if ($row['bank_type']=='华夏银行'){?>selected="selected"<?php } ?>>华夏银行</option>
<option value="民生银行" <?php if ($row['bank_type']=='民生银行'){?>selected="selected"<?php } ?>>民生银行</option>
<option value="邮政储蓄" <?php if ($row['bank_type']=='邮政储蓄'){?>selected="selected"<?php } ?>>邮政储蓄</option>
<option value="商业银行" <?php if ($row['bank_type']=='商业银行'){?>selected="selected"<?php } ?>>商业银行</option>
<option value="广发银行" <?php if ($row['bank_type']=='广发银行'){?>selected="selected"<?php } ?>>广发银行</option>
<option value="深发银行" <?php if ($row['bank_type']=='深发银行'){?>selected="selected"<?php } ?>>深发银行</option>
<option value="光大银行" <?php if ($row['bank_type']=='光大银行'){?>selected="selected"<?php } ?>>光大银行</option>
<option value="中信银行" <?php if ($row['bank_type']=='中信银行'){?>selected="selected"<?php } ?>>中信银行</option>
<option value="北京银行" <?php if ($row['bank_type']=='北京银行'){?>selected="selected"<?php } ?>>北京银行</option>
<option value="上海银行" <?php if ($row['bank_type']=='上海银行'){?>selected="selected"<?php } ?>>上海银行</option>
<option value="浙商银行" <?php if ($row['bank_type']=='浙商银行'){?>selected="selected"<?php } ?>>浙商银行</option>
<option value="宁波银行" <?php if ($row['bank_type']=='宁波银行'){?>selected="selected"<?php } ?>>宁波银行</option>
<option value="信用社"   <?php if ($row['bank_type']=='信用社'){?>selected="selected"<?php } ?>>信用社</option>
<option value="财付通"   <?php if ($row['bank_type']=='财付通'){?>selected="selected"<?php } ?>>财付通</option>
<option value="江苏银行" <?php if ($row['bank_type']=='江苏银行'){?>selected="selected"<?php } ?>>江苏银行</option>
<option value="成都银行" <?php if ($row['bank_type']=='成都银行'){?>selected="selected"<?php } ?>>成都银行</option>
<option value="内蒙古银行"<?php if ($row['bank_type']=='内蒙古银行'){?>selected="selected"<?php } ?>>内蒙古银行</option>
<option value="平安银行"  <?php if ($row['bank_type']=='平安银行'){?>selected="selected"<?php } ?>>平安银行</option>
<option value="盛付通"    <?php if ($row['bank_type']=='盛付通'){?>selected="selected"<?php } ?>>盛付通</option>
<option value="国付宝"    <?php if ($row['bank_type']=='国付宝'){?>selected="selected"<?php } ?>>国付宝</option>
<option value="手机支付"  <?php if ($row['bank_type']=='手机支付'){?>selected="selected"<?php } ?>>手机支付</option>

</select></td>
</tr>
<tr>
<td  class="td_left"> 银行账号 ：</td>
<td><input name="bankaccount" type="text" class="biankuan" style="width:350px;" value="<?=$row['bankaccount']?>"  placeholder="银行卡号" /></td>
</tr>
<tr>
<td  class="td_left">开户地区：</td>
<td><input name="bankcity" type="text" class="biankuan" style="width:250px;"  value="<?=$row['bankcity']?>"   placeholder="某省某市"/></td>
</tr>
<tr>
<td  class="td_left">持卡人姓名：</td>
<td><input name="accountname" type="text" class="biankuan" style="width:150px;"   value="<?=$row['accountname']?>"  placeholder="4个汉字以内"/></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</html>

<script>

function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
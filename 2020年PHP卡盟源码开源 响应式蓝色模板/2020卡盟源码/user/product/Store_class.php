<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/user_check.php');
include('../../jhs_config/error.php');
$Action=$_REQUEST['Action'];
$total=mysql_num_rows(mysql_query("select * from `Store_class` where username='$_SESSION[ysk_number]' ",$conn1));
////////添加记录
if ($Action=="del"){
$Id=inject_check($_GET['Id']);
mysql_query("delete from Store_class where id ='$Id' and  username='$_SESSION[ysk_number]'",$conn1);
mysql_query("update `product` set `Store_class`='0' where username='$_SESSION[ysk_number]'  and Store_class in ($Id)",$conn1);
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}



if ($Action=="Addsave") {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}


if ($total>=$yx_us['erdu1']){echo "<br><br><br><center>对不起，操作失败！最多只能加{$yx_us['erdu1']}个哦！</center>";exit();}
$title=strip_tags($_POST['title']);
mysql_query("insert into `Store_class`(title,username) " ."values ('$title','$_SESSION[ysk_number]')",$conn1);
echo "<br><br><br><center><input id='btnAll' type='button' value='添加成功!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////修改记录
If ($Action=="editsave") {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$title=strip_tags($_POST['title']);
mysql_query("update Store_class set title='$title'  where id='$_POST[Id]' and username='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('修改成功!');;window.location='?Action=List';</script>";
exit();
}

if ($Action=="buysave") {
$erdu=pot_check_price($_POST['erdu']);
$price=pot_check_price($site_price_1*$erdu);

/*判断会员余额是否足够*/
if ($yx_us['kuan']-$price<0){
echo "<script>alert('操作失败，您的余额不足！');;self.location=document.referrer;</script>";
exit();	
}

mysql_query("insert into `details_funds` set title='购买{$erdu}个店铺栏目额度',spendings='$price',befores='$yx_us[kuan]',afters='$price',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan=kuan-$price,erdu1=erdu1+$erdu where number='$_SESSION[ysk_number]'",$conn1); 

echo "<br><br><br><center><input id='btnAll' type='button' value='购买成功!'  onClick='cl()' class='tijiao_input' /></center>";


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
<?php if ($Action=="List" or $Action==""){?>
<div class="gn">
<input type="button" value="添加分类" class="tijiao_input" onclick="$.dialog.open('product/Store_class.php?Action=add',{title:'分类添加',width: 600,lock:true,fixed:true});" />

<input  type="button" value="额度购买" class="tijiao_input" onclick="$.dialog.open('product/Store_class.php?Action=buy',{title:'额度购买',width: 600,lock:true,fixed:true});" />


可用额度：<span style="color: #0a0;"><?=$yx_us['erdu1']-$total?></span> 个

</div>



<table cellspacing="1" cellpadding="0" class="page_table"  style="margin-top:10px;">
<tr>
<td align="left" class="table_top">分类名称</td>
<td width="10%" class="table_top">
  修改
</td>

</tr>
<?php
$Rss="SELECT * FROM Store_class   where username='$_SESSION[ysk_number]' order by id desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24" align="left"><?=$Orzx['title']?></td>
<td>
<a href="?Action=edit&Id=<?=$Orzx[id]?>">修改</a>
<a href="?Action=del&Id=<?=$Orzx[id]?>" onclick="Javascript:return confirm('确定要删除吗？');">删除</a> 
</td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">分类名称：</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" maxlength="10" /> 10个字以内</td>
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
$Id=inject_check($_GET['Id']);
$sql="select * from Store_class where id='$Id' and username='$_SESSION[ysk_number]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input name="Id" type="hidden" value="<?=$_REQUEST['Id']?>" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">分类名称：</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/>
  10个字以内</td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认修改"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="buy"){  ?>
<form name="add" method="post" action="?Action=buysave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">额度购买：</td>
<td><select name="erdu" id="erdu">
<option value="1" selected="selected">1个 <?=number_format($site_price_1,3)?> <?=$moneytype?></option>
<option value="2">2个 <?=number_format($site_price_1*2,3)?> <?=$moneytype?></option>
<option value="3">3个 <?=number_format($site_price_1*3,3)?> <?=$moneytype?></option>
<option value="4">4个 <?=number_format($site_price_1*4,3)?> <?=$moneytype?></option>
<option value="5">5个 <?=number_format($site_price_1*5,3)?> <?=$moneytype?></option>
<option value="6">6个 <?=number_format($site_price_1*6,3)?> <?=$moneytype?></option>
<option value="7">7个 <?=number_format($site_price_1*7,3)?> <?=$moneytype?></option>
<option value="8">8个 <?=number_format($site_price_1*8,3)?> <?=$moneytype?></option>
<option value="9">9个 <?=number_format($site_price_1*9,3)?> <?=$moneytype?></option>
<option value="10">10个 <?=number_format($site_price_1*10,3)?> <?=$moneytype?></option>
</select></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认购买"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php } ?>
</body>
</Html>
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
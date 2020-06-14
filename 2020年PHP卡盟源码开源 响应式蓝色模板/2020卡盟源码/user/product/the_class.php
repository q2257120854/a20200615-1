<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
$Action=$_REQUEST['Action'];
$vip_locks=(explode(',',$vip_locks));
if ($vip_flag1==1){
header('location:/user/sorry.php');
}
if ($Action=='mylove'){
$locks=$_POST['locks'];
$hiddens=$_POST['hiddens'];
if ($hiddens==''){$hiddens=0;}
if ($locks!=''){
$locks= implode(",",$locks);
}
if ($_REQUEST['Del']=='提交'){
mysql_query("update vip_site set locks='' where vip_number='$_SESSION[ysk_number]'",$conn1);
mysql_query("update vip_site set locks='$locks',hiddens='$hiddens' where vip_number='$_SESSION[ysk_number]'",$conn1);
echo "<script>alert('修改成功!');window.location='the_class.php';</script>";
exit();
}



}
?>
<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="page_table" width="100%" style="margin-top:10px;">
<tr>
<td width="92%" align="center" class="table_top">目录名称</td>
<td width="8%" align="center" class="table_top">是否隐藏</td>
</tr>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left">上级站全部目录 
</td>
<td align="center">
<input name="hiddens" type="checkbox" value="1" <?php if ($vip_hiddens==1){?>checked="checked"<?php }?>>


</td>
</tr>
<?php
$search="where isno3=0 and LagID=0"; 
$sql=mysql_query("select * from product_class $search   order by Classorder asc,id desc ",$conn1);
while ($row=mysql_fetch_array($sql)){?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left"  bgcolor="#f6fcff" style="padding-left:10px;"><span style="color:<?=$row['color']?>"><?=$row['7']?></span>
</td>
<td align="center"  bgcolor="#f6fcff">
<input name="locks[]" type="checkbox" value="<?=$row['NumberID']?>" <?php if(in_array($row['NumberID'],$vip_locks)==true){?> checked="checked"<?php } ?>>
</td>
</tr>

<?php
$search1="where LagID=1 and PartID='$row[NumberID]'  order by Classorder asc,id desc "; 
$sql1=mysql_query("select * from product_class $search1",$conn1);
while ($row1=mysql_fetch_array($sql1)){?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left">--<span style="color:<?=$row1['color']?>"><?=$row1['7']?></span>
</td>
<td align="center"  bgcolor="#f6fcff">
<input name="locks[]" type="checkbox" value="<?=$row1['NumberID']?>" <?php if(in_array($row1['NumberID'],$vip_locks)==true){?> checked="checked"<?php } ?>>
</td>
</tr>
<?php
$search2="where LagID=2 and PartID='$row1[NumberID]'  order by Classorder asc,id desc "; 
$sql2=mysql_query("select * from product_class $search2  ",$conn1);
while ($row2=mysql_fetch_array($sql2)){?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left">----------<span style="color:<?=$row2['color']?>"><?=$row2['7']?></span>
</td>
<td align="center"  bgcolor="#f6fcff">
<input name="locks[]" type="checkbox" value="<?=$row2['NumberID']?>" <?php if(in_array($row2['NumberID'],$vip_locks)==true){?> checked="checked"<?php } ?>>
</td>
</tr>
<?php } ?>
<?php } ?>


<?php } ?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" style="padding-top:15px; padding-bottom:15px;">

<input type="submit" name="Del" id="Del" value="提交" class="x2_input"></td>
</tr>
</table>
</form>

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
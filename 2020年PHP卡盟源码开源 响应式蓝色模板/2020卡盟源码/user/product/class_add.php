<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<script>
function hideDiv()
{
document.getElementById("div2").style.display = "block";
document.getElementById("div3").style.display = "block";
}
function hideDiv1()
{
document.getElementById("div2").style.display = "none";
document.getElementById("div3").style.display = "none";
}
</script>
<script language="javascript">
function chg(obj)
{
if(obj.options[obj.selectedIndex].value =="-1")
document.getElementById("overday").style.display="";
else
document.getElementById("overday").style.display="none";
}

function chg1(obj)
{
if(obj.options[obj.selectedIndex].value =="1")
document.getElementById("price").style.display="";
else
document.getElementById("price").style.display="none";
}
</script>

<script language="JavaScript" type="text/javascript">
function clearNoNum(obj)
{
//先把非数字的都替换掉，除了数字和.
obj.value = obj.value.replace(/[^\d.]/g,"");
//必须保证第一个为数字而不是.
obj.value = obj.value.replace(/^\./g,"");
//保证只有出现一个.而没有多个.
obj.value = obj.value.replace(/\.{2,}/g,".");
//保证.只出现一次，而不能出现两次以上
obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/user_check.php');
$Action=$_REQUEST['Action'];
$NumberID=str_replace("H","S",$_POST['NumberID']);
////////添加记录
If ($Action=="Addsave"){
include('../../jhs_config/upload_class.php');
$Store_icon=$uploadnames;
$overdue=strip_tags($_POST['overdue']);
$overday=strip_tags($_POST['overday']);
$hot=strip_tags($_POST['hot']);
$PartID=strip_tags($_POST['PartID']);
$LagID=strip_tags($_POST['LagID']);
$Classorder=strip_tags($_POST['Classorder']);
$yClass=strip_tags($_POST['Class']);
$Store_title=strip_tags($_POST['Store_title']);
$feilv=strip_tags($_POST['feilv']);
$isno1=strip_tags($_POST['isno1']);
$isno2=strip_tags($_POST['isno2']);
$price=strip_tags($_POST['price']);
$qicq=strip_tags($_POST['qicq']);


if ($hot==''){
$hot=0;
}
if ($overday==''){
$overday=$overdue;
}
if ($hot==1){
$begtime=strtotime("+".$overday." days", time());
}

get_check_price($overday);

$sql="select * from product_class where NumberID='$NumberID'  and number='$_SESSION[ysk_number]' and isno3='1' ";   //读取数据表
$login=mysql_query($sql,$conn1);               //执行该SQl语句
if ($row = mysql_fetch_row($login))
{echo "<script language=\"javascript\">alert('识别码 $NumberID 不能重复，请重新添加！');javascript:history.go(-1);</script>";
}else{
$yoy=substr(str_replace("S","H",$_POST['RootID']),0,4);
mysql_query("insert into product_class set hot='$hot',locks=0,NumberID='$NumberID',RootID='$yoy',PartID='$PartID',LagID='$LagID',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',feilv='$sub_price',number='$_SESSION[ysk_number]',overdue='$overdue',overday='$overday',time='$begtime',price='$price',isno1='$isno1',isno2='$isno2',isno3='1',qicq='$qicq'",$conn1);
echo "<script>alert('添加成功!');self.location=document.referrer;</script>";
}
}

////////修改记录
If ($Action=="editsave") {

include('../../jhs_config/upload_class.php');
$Store_icon=$uploadnames;
$mytime=$_POST['mytime'];
$overdue=strip_tags($_POST['overdue']);
$overday=strip_tags($_POST['overday']);
$hot=strip_tags($_POST['hot']);
$PartID=strip_tags($_POST['PartID']);
$LagID=strip_tags($_POST['LagID']);
$Classorder=strip_tags($_POST['Classorder']);
$yClass=strip_tags($_POST['Class']);
$Store_title=strip_tags($_POST['Store_title']);
$feilv=strip_tags($_POST['feilv']);
$isno1=strip_tags($_POST['isno1']);
$isno2=strip_tags($_POST['isno2']);
$price=strip_tags($_POST['price']);
$number=strip_tags($_POST['number']);
$qicq=strip_tags($_POST['qicq']);
if ($overdue==''){
$begtime1=$mytime;
}elseif($overday!=''){
$begtime1=strtotime('+'.$overday.' day',time()); ####续费时间
}else{
$begtime1=strtotime('+'.$overdue.' day',time()); ####续费时间
}
$begtime1=$begtime1+($mytime-$begtime);
if ($hot==''){
$hot=0;
}


mysql_query("update product_class set hot='$hot',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',overdue='$overdue',overday='$overday',time='$begtime1',price='$price',isno1='$isno1',isno2='$isno2',qicq='$qicq'  where id='$_POST[id]' and number='$_SESSION[ysk_number]'",$conn1);

echo "<script>alert('修改成功!');window.location='info_class.php';</script>";
}

////////删除单记录
If ($Action=="del") {
$sql1="delete from product_class where NumberID ='$_REQUEST[Id]'  and number='$_SESSION[ysk_number]'  and isno3='1'";
mysql_query($sql1,$conn1);   //////  删除小类别

echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}

////////批量删除
If ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$sql="delete from product_class where id in ($ID_Dele)";
mysql_query($sql,$conn1);
echo "<script>alert('删除成功!');window.location='?Action=List';</script>";
}
?>
<?php
If  ($Action=="") {
$len=strlen($_REQUEST['Id']);
$Id=str_replace("H","S",$_REQUEST['Id']);
if ($len==4){
###################二级目录
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=1 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=1 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'  order by id desc  limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],4,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID=str_replace("H","S",$_REQUEST['Id']);
$LagID=1;
}elseif ($len==7){
###################三级目录
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=2 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1' ",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=2 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'  order by id desc  limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],7,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID=str_replace("H","S",$_REQUEST['Id']);
$LagID=2;
}
$lmyen=strlen($J);
If ($lmyen==1){
$JJ=str_replace("H","S",$_REQUEST['Id'])."00$J";
}elseif ($lmyen==2){
$JJ=str_replace("H","S",$_REQUEST['Id'])."0$J";
}
elseif ($lmyen==3){
$JJ=str_replace("H","S",$_REQUEST['Id'])."$J";
}




?>
<form action="?Action=Addsave" method="post" name="myform" enctype="multipart/form-data">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">添加栏目</strong></td>
</tr>
<tr >
<td width="7%" height="35" align="right" class="td_left">识别号：</td>
<td width="93%"><input name="NumberID" type="text" id="NumberID"  value="<?php echo $JJ ?>" class="biankuan"/>  </td>
</tr>
<tr>
<td height="35" align="right" class="td_left">栏目名称：</td>
<td><input name="Class" type="text" id="Class"  class="biankuan"/> 

<input name="RootID" type="hidden" id="RootID" value="<?php echo $RootID ?>" />
<input name="PartID" type="hidden" id="PartID" value="<?php echo $PartID ?>" />
<input name="LagID"  type="hidden" id="LagID" value="<?php echo $LagID ?>" /> </td>
</tr>

<?php If ($len==7){?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   QQ在线客服   ：</td>
<td width="93%"><input name="qicq" type="text" id="qicq"  value="" class="biankuan"/></td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺名称 ：</td>
<td width="93%"><input name="Store_title" type="text" id="Store_title"  value="" class="biankuan"/> 
</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺logo ：</td>
<td width="93%"> <input name="upfile" type="file" id="upfile" ></td>
</tr>


<tr>
<td width="7%" height="35" align="right" class="td_left"> 是否热门：</td>
<td width="93%" valign="top" style="padding-top:15px;"><div style="float:left; padding-left:2px;"><input name="hot" id="hot" type="checkbox" onClick="on_hide();" value="1"> 
</div>
<div style="float:left; padding-left:10px;">
<select style="display:none;" name="overdue" id="overdue" onchange="chg(this)">
<option value="7">一周</option>
<option value="30">一个月</option>
<option value="90">三个月</option>
<option value="0">永久</option>
<option value="-1">其它</option>
</select>
</div>
<div style="float:left; padding-left:10px;">
<input id="overday" name="overday" style="width:30px;display:none" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > 
</div>
<script>
function on_hide(){
document.getElementById("overdue").style.display = (document.getElementById("hot").checked == true) ? "block" : "none";
}
</script>
</td>
</tr>
<?php } ?>



<tr>
<td height="35" align="right" class="td_left">排序：</td>
<td><input name="Classorder" type="text" id="Classorder" value="<?php echo $J ?>" class="biankuan"  onKeyPress	= "return regInput(this, /^[0-9]*$/, String.fromCharCode(event.keyCode))"> </td>
</tr>
<tr>
<td height="35" align="right">&nbsp;</td>
<td>
<input type="submit" name="Submit" value="提交"  class="tijiao_input"/>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$sql="select * from product_class where id='$Id' and number='$_SESSION[ysk_number]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);

if ($row['id']==''){
echo "<script>alert('操作失败，没有找到该目录!');self.location=document.referrer;</script>";
exit();
}

?>

<form action="?Action=editsave" method="post" name="myform" enctype="multipart/form-data">
<input name="mytime" type="hidden" id="mytime"   value="<?=$row['time']?>"/>
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">修改栏目</strong></td>
</tr>
<tr>
<td width="7%" height="35" align="right"  class="td_left">栏目名称：</td>
<td width="93%"><input name="id" type="hidden" id="id"   value="<?=$row['id']?>"/>
<input class="biankuan" name="Class" type="text" id="Class"  value="<?=$row[7]?>"/></td>
</tr>

<?php if (strlen($row['NumberID'])=='10') {?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   QQ在线客服   ：</td>
<td width="93%"><input name="qicq" type="text" id="qicq"  value="<?=$row['qicq']?>" class="biankuan"/>多个中间用|隔开</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺名称 ：</td>
<td width="93%"><input name="Store_title" type="text" id="Store_title"  value="<?=$row['Store_title']?>" class="biankuan"/> 
</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺logo ：</td>
<td width="93%"><input name="Store_icon" type="hidden" value="<?=$row['Store_icon']?>"> 
<input name="upfile" type="file" id="upfile" ></td>
</tr>


<tr>
<td width="7%" height="35" align="right" class="td_left"> 是否热门：</td>
<td width="93%">
<input name="hot" type="checkbox" id="hot" value="1" <?php if ($row['hot']=='1') {?>checked="checked"<?php } ?> >
</td>
</tr>
<?php if  ($row['hot']=='1') {?>
<tr>
<td width="21%" height="35" align="right" class="td_left">过期时间：</td>
<td width="79%">
<?php if ($row['overdue']==0){?>
永久
<?php }else{?>
<?php echo $time=date("Y-m-d",$row['time']);   // 格式化日期?>
<?php } ?>
</td>
</tr>
<?php } ?> 
<tr>
<td width="21%" height="35" align="right" class="td_left">是否续费：</td>
<td width="79%"><div style="float:left;">
<select  name="overdue" id="overdue" onchange="chg(this)">
<option value="" selected="selected">请选择</option>
<option value="7">一周</option>
<option value="30">一个月</option>
<option value="90">三个月</option>
<option value="0">永久</option>
<option value="-1">其它</option>
</select>
</div>
<div style="float:left; padding-left:10px;">
<input id="overday" name="overday" style="width:30px;display:none" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > 
</div>

</td>
</tr>






<?php } ?>
<tr>
<td height="35" align="right"  class="td_left"> 排序：</td>
<td><input name="Classorder" type="text" id="Classorder"  value="<?=$row[Classorder]?>" class="biankuan" onKeyPress	= "return regInput(this, /^[0-9]*$/, String.fromCharCode(event.keyCode))"></td>
</tr>
<tr>
<td height="35" align="right">&nbsp;</td>
<td>
<input type="submit" name="Submit" value="修改" class="tijiao_input" /></td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
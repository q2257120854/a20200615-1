
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
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
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor-min.js"></script>
<script>
KindEditor.ready(function(K) {
var colorpicker;
K('#colorpicker').bind('click', function(e) {
e.stopPropagation();
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
return;
}
var colorpickerPos = K('#colorpicker').pos();
colorpicker = K.colorpicker({
x : colorpickerPos.x,
y : colorpickerPos.y + K('#colorpicker').height(),
z : 19811214,
selectedColor : 'default',
noColor : '无颜色',
click : function(color) {
K('#color').val(color);
colorpicker.remove();
colorpicker = null;
}
});
});
K(document).click(function() {
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
}
});
});
</script>
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image3').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url3').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url3').val(url);
editor.hideDialog();
}
});
});
});
});
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
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];

////////添加记录

If ($Action=="Addsave") {
$overdue=$_POST['overdue'];
$overday=$_POST['overday'];
$hot=$_POST['hot'];
$NumberID=$_POST['NumberID'];
$PartID=$_POST['PartID'];
$LagID=$_POST['LagID'];
$Classorder=$_POST['Classorder'];
$yClass=$_POST['Class'];
$Store_icon=$_POST['Store_icon'];
$Store_title=$_POST['Store_title'];
$feilv=$_POST['feilv'];
$color=$_POST['color'];
$isno1=$_POST['isno1'];
$isno2=$_POST['isno2'];
$price=$_POST['price'];
$qicq=$_POST['qicq'];
$number=$_POST['number'];
$shop_name=trim($_POST['shop_name']);
if ($hot==''){

$hot=0;
}
if ($overday==''){
$overday=$overdue;
}
if ($hot==1){
$begtime=strtotime("+".$overday." days", time());
}

$sql="select * from product_class where NumberID='$_POST[NumberID]'";   //读取数据表
$login=mysql_query($sql,$conn1);               //执行该SQl语句
if ($row = mysql_fetch_row($login))
{echo "<script language=\"javascript\">alert('识别码$_POST[NumberID]不能重复，请重新添加！');javascript:history.go(-1);</script>";
}else{
$yoy=substr($_POST[RootID],0,4);
mysql_query("insert into product_class set hot='$hot',locks=0,NumberID='$NumberID',RootID='$yoy',PartID='$PartID',LagID='$LagID',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',feilv='$feilv',overdue='$overdue',overday='$overday',time='$begtime',number='$number',price='$price',isno1='$isno1',isno2='$isno2',color='$color',qicq='$qicq',shop_name='$shop_name'",$conn1);

ysk_date_log(6,$_SESSION['ysk_username'],'添加了一个 "'.$yClass.'" 分类');//--------------------执行操作日志
echo "<script>alert('添加成功!');self.location=document.referrer;</script>";
}
}

////////修改记录
If ($Action=="editsave") {
$mytime=$_POST['mytime'];
$overdue=$_POST['overdue'];
$overday=$_POST['overday'];
$hot=$_POST['hot'];
$NumberID=$_POST['NumberID'];
$PartID=$_POST['PartID'];
$LagID=$_POST['LagID'];
$Classorder=$_POST['Classorder'];
$yClass=$_POST['Class'];
$Store_icon=$_POST['Store_icon'];
$Store_title=$_POST['Store_title'];
$feilv=$_POST['feilv'];
$color=$_POST['color'];
$isno1=$_POST['isno1'];
$isno2=$_POST['isno2'];
$price=$_POST['price'];
$number=$_POST['number'];
$qicq=$_POST['qicq'];
$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];
$y5=$_POST['y5'];
$y6=$_POST['y6'];
$y7=$_POST['y7'];
$y8=$_POST['y8'];
$y9=$_POST['y9'];
$shop_name=trim($_POST['shop_name']);

if ($y1<>$yClass){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$y1.'" 修改成了 "'.$yClass.'"');}
if ($y2<>$isno1 && $isno1<>''){
if ($isno1==1){
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录"'.$y1.'" 开启QQ业务模块 ');
}else{
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录"'.$y1.'" 关闭QQ业务模块 ');
}
}
if ($y3<>$feilv && $feilv<>''){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 费率 "'.$y3.'" 修改成了 "'.$feilv.'"');}
if ($y4<>$number && $number<>''){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 供货商平台编号 "'.$y4.'" 修改成了 "'.$number.'"');}
if ($y5<>$qicq && $qicq<>''){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" QQ在线客服 "'.$y5.'" 修改成了 "'.$qicq.'"');}
if ($y6<>$Store_title && $Store_title<>''){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 店铺名称 "'.$y6.'" 修改成了 "'.$Store_title.'"');}
if ($y7<>$Store_icon && $Store_icon<>''){ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 修改了店铺logo');}

if ($y8<>$isno2 && $isno2<>''){
if ($isno2==1){
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 开启可自由申请供货');
}else{
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 关闭可自由申请供货');
}
}

if ($y9<>$hot && $hot<>''){
if ($hot==1){
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 开启了热门商品目录');
}else{
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 关闭了热门商品目录');
}
}

if ($overdue==''){
$begtime1=$mytime;
}elseif($overday!=''){
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 热门目录续费 "'.$overday.'" 天');
$begtime1=strtotime('+'.$overday.' day',time()); ####续费时间
}else{
ysk_date_log(6,$_SESSION['ysk_username'],'把商品目录 "'.$yClass.'" 热门目录续费 "'.$overdue.'" 天');	
$begtime1=strtotime('+'.$overdue.' day',time()); ####续费时间

}
$begtime1=$begtime1+($mytime-$begtime);

if ($hot==''){
$hot=0;
}
echo $overdue;

mysql_query("update product_class set hot='$hot',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',feilv='$feilv',color='$color',overdue='$overdue',overday='$overday',time='$begtime1',number='$number',price='$price',isno1='$isno1',isno2='$isno2',qicq='$qicq',shop_name='$shop_name'  where id='$_POST[id]'",$conn1);

echo "<script>alert('修改成功!');window.location='info_class.php';</script>";
}

////////删除单记录
If ($Action=="del") {
$sql1="delete from product_class where NumberID ='$_REQUEST[Id]'";
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
if ($Action=="") {

if ($_REQUEST['Id']==''){
###################大目录
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=0   ",$conn1));  ###判断大目录是否有数据
if ($total!='0'){
$mysql="select * from product_class   where LagID=0  order by NumberID desc,id desc   limit 1";   //读取数据表
$myzyc=mysql_query($mysql,$conn1);  //执行该SQl语句
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],1,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID=0;  
$PartID=0;
$LagID=0;

$len=strlen($J);
If ($len==1){
$JJ="H00$J";
}elseif ($len==2){
$JJ="H0$J";
}elseif ($len==3){
$JJ="H$J";
}
###################大目录结束

}else{
$len=strlen($_REQUEST['Id']);

if ($len==4){
###################二级目录
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=1 and PartID='$_REQUEST[Id]' ",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=1 and PartID='$_REQUEST[Id]' order by NumberID desc,id desc  limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],4,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID="$_REQUEST[Id]";
$LagID=1;
}elseif ($len==7){
###################三级目录
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=2 and PartID='$_REQUEST[Id]' ",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=2 and PartID='$_REQUEST[Id]'  order by NumberID desc,id desc limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],7,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID="$_REQUEST[Id]";
$LagID=2;

}
$lmyen=strlen($J);
If ($lmyen==1){
$JJ="$_REQUEST[Id]00$J";
}elseif ($lmyen==2){
$JJ="$_REQUEST[Id]0$J";
}
elseif ($lmyen==3){
$JJ="$_REQUEST[Id]$J";
}


}

?>
<form action="?Action=Addsave" method="post" name="myform" onsubmit="return CheckPost();">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">添加目录</strong></td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left">目录颜色 ：</td>
<td width="93%"><input name="color" type="text" id="color"  value="<?=$row['color']?>" class="biankuan"> 
<input type="button" id="colorpicker" value="打开取色器" class="tijiao_input"/></td>
</td>
</tr>
<tr style="display:none">
<td width="7%" height="35" align="right" class="td_left">识别号：</td>
<td width="93%"><input name="NumberID" type="text" id="NumberID"  value="<?php echo $JJ ?>" class="biankuan"/>  </td>
</tr>
<tr>
<td height="35" align="right" class="td_left">目录名称：</td>
<td><input name="Class" type="text" id="Class"  class="biankuan"/> 
<?php If ($len==7){?>

<?php }?>
<input name="RootID" type="hidden" id="RootID" value="<?php echo $RootID ?>" />
<input name="PartID" type="hidden" id="PartID" value="<?php echo $PartID ?>" />
<input name="LagID"  type="hidden" id="LagID" value="<?php echo $LagID ?>" /> </td>
</tr>
<?php If ($len<4){?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   开启QQ业务模块   ：</td>
<td width="93%">
<input name="isno1" type="checkbox" id="isno1" value="1" /></td>
</tr><?php } ?>
<?php If ($len==4){?>
<tr>
<td width="7%" height="35" align="right" class="td_left">目录收费 ：</td>
<td width="93%"><input name="feilv" type="text" id="feilv"  value="" class="biankuan"  onkeyup="clearNoNum(this)"> 百分比 
</td>
</tr>
<?php } ?>
<?php If ($len==7){?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   供货商平台编号   ：</td>
<td width="93%"><input name="number" type="text" id="number"  value="" class="biankuan"/></td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left">   QQ在线客服   ：</td>
<td width="93%"><input name="qicq" type="text" id="qicq"  value="" class="biankuan"/>多个中间用|隔开</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺名称 ：</td>
<td width="93%"><input name="Store_title" type="text" id="Store_title"  value="" class="biankuan"/>  




</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> 店铺logo ：</td>
<td width="93%"><input name="Store_icon" type="text" id="url3" value="" class="biankuan"  style="width:250px;"/> 
<input type="button" id="image3" value="选择图片"   class="tijiao_input"/> 尺寸：139 * 65 pixels</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left">可自由申请供货：</td>
<td width="93%"> <input name="isno2" id="isno2" type="checkbox"  value="1"> </td>
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
$sql="select * from product_class where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="myform" onsubmit="return CheckPost();">
<input name="y1" type="hidden" value="<?=$row['7']?>">
<input name="y2" type="hidden" value="<?=$row['isno1']?>">
<input name="y3" type="hidden" value="<?=$row['feilv']?>">
<input name="y4" type="hidden" value="<?=$row['number']?>">
<input name="y5" type="hidden" value="<?=$row['qicq']?>">
<input name="y6" type="hidden" value="<?=$row['Store_title']?>">
<input name="y7" type="hidden" value="<?=$row['Store_icon']?>">
<input name="y8" type="hidden" value="<?=$row['isno2']?>">
<input name="y9" type="hidden" value="<?=$row['hot']?>">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">修改栏目</strong></td>
</tr>
<tr>
<td width="7%" height="35" align="right"  class="td_left">栏目名称：</td>
<td width="93%"><input name="id" type="hidden" id="id"   value="<?=$row['id']?>"/>
<input class="biankuan" name="Class" type="text" id="Class"  value="<?=$row[7]?>"/>
<?php if (strlen($row['NumberID'])=='10') {?>
<select name="shop_name" id="shop_name">
<?php if ($shop_name!='') {
$allArray=(explode("\n",$shop_name));    ////用 explode 把 回车 的内容隔开成数组
foreach($allArray as $value) 
{
?>
<option value="<?=$value?>" <?php if ($row['shop_name']==$value){?> selected="selected"<?php }?>><?=$value?></option>
<?php
}
} 
?>
</select>
<?php } ?>
</td>
</tr>

<?php if (strlen($row['NumberID'])=='7') {?>
<tr>
<td width="7%" height="35" align="right" class="td_left">栏目收费 ：</td>
<td width="93%"><input name="feilv" type="text" id="feilv"  value="<?=$row['feilv']?>" class="biankuan" onkeyup="clearNoNum(this)"> 
</td>
</tr>

<tr>
<td width="7%" height="35" align="right" class="td_left">目录颜色 ：</td>
<td width="93%"><input name="color" type="text" id="color"  value="<?=$row['color']?>" class="biankuan"> 
<input type="button" id="colorpicker" value="打开取色器" class="tijiao_input"/></td>
</td>
</tr>
<?php } ?>
<?php if (strlen($row['NumberID'])=='10') {?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   供货商平台编号   ：</td>
<td width="93%"><input name="number" type="text" id="number"  value="<?=$row['number']?>" class="biankuan"/></td>
</tr>
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
<td width="93%"><input name="Store_icon" type="text" id="url3" value="<?=$row['Store_icon']?>" class="biankuan"  style="width:250px;"/> 
<input type="button" id="image3" value="选择图片"   class="tijiao_input"/>  尺寸：139 * 65 pixels</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left">可自由申请供货：</td>
<td width="93%"><input name="isno2" type="checkbox" id="isno2" value="1" <?php if ($row['isno2']=='1') {?>checked="checked"<?php } ?> >
</td>
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



<?php
}
?>
</body>
</Html>
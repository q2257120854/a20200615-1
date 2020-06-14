<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.bigcolorpicker.js"></script>
<script language="javascript">
$(function(){
$("#bn").bigColorpicker("f3");
$("#f333").bigColorpicker("f3","L",6);
});

function checkuserinfo()
{
if(checkspace(document.add.rate.value)) {
document.add.rate.focus();
alert("操作失败，售价不能为空！");
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
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/sorting.php');
$Action=strip_tags($_GET['Action']);
$type=strip_tags($_GET['type']);
$keywords=strip_tags($_GET['keywords']);
if ($type!=''){
$_SESSION['stype']=$type;	
}
$type=$_SESSION['stype'];
?>
</head>
<body>
<?php if ($Action==""){?>
<form action="search.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
关键字输入：            </td>
<td class="left">
<input name="keywords" type="text" maxlength="300"  value="<?=$keywords?>" class="biankuan" placeholder="请输入搜索关键词">
</td>
</tr>
<tr>
<td height="32" class="td_left">
对接平台：            </td>
<td class="left">
<select name="type" id="type">
<option <?php if ($type==''){?>selected="selected"<?php } ?> value="">请选择</option>
<?php
$result=mysql_query("select * from  docking_platform   order by begtime desc,id desc ",$conn1);
while($row=mysql_fetch_array($result)){
?>
<option <?php if ($row['uid']==$type){?>selected="selected"<?php } ?> value="<?=$row['uid']?>"><?=$row['uid']?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询" id="btnQuery" class="chaxun_input" />

</td>
</tr>
</table>
</form>
<?php if ($type!=''){?>
<form name="form1" method="post" action="?Action=mylove&type=<?=$type?>">
<table cellspacing="1" cellpadding="0" class="table4" style=" margin-top:10px;">
<tr>
<td width="5%" height="32" align="center" class="table_top">选择</td>
<td width="30%" align="center" class="table_top">商品名称</td>
<td width="7%" align="center" class="table_top">供货商编号</td>
<td width="7%" align="center" class="table_top"> 类型/模板 </td>
<td width="7%" align="center" class="table_top">购价</td>
<td width="7%" align="center" class="table_top"> 面值</td>
<td width="6%" align="center" class="table_top">状态</td>
<td width="12%" align="center" class="table_top">发布时间</td>
<td width="6%" align="center" class="table_top">操作</td>
</tr>
<?php
$sup_result=mysql_query("select * from sup_members_site where domain_name='$type' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料

function ysk_buy_Pricea($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn3;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn3));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}


$sresult=mysql_query("select * from docking_platform where uid='$type' ",$conn1);
$sus=mysql_fetch_array($sresult);


$yx_us_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);


//---------------进行对接验证
$result=mysql_query("select  distinct(pid)   from product where docking='$sus[id]' ",$conn1);
while($rs=mysql_fetch_array($result)){
$dockingid.=$rs['pid'].',';
}
$strid=substr($dockingid,0,strlen($dockingid)-1);
//---------------进行对接验证 The End
$search="where 1=1 and locks=2"; 
if ($keywords!='') $search.=" and title like '%$keywords%'"; 
if ($strid!='')    $search.=" and id  NOT IN($strid)"; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `product` $search   ",$conn3));  //查询总记录！
$num="100";
$page=new page($total,$num);
$sql="select * from product  $search  order by paixu asc,id desc,begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn3);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
	

?>

<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="left" style=" text-align:left; line-height:200%;">
<?=$row['title']?></td>
<td align="center"><?=$row['username']?></td>
<td align="center" style="color:#0000ff"><?=$row['modl']?></td>
<td align="center" style="color:#F00"><?=ysk_buy_Pricea($yx_us['level'],$row['price2'],$row['pricing'],$row['rate'])?> 元</td>
<td align="center"><?=$row['price1']?> 元</td>
<td align="center"><?=ysk_state($row['state'])?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>&sid=<?=$sus['id']?>">对接</a></td>
</tr><?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" style="padding-top:15px; padding-bottom:15px;">

<input type="button" value="全选" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="对接" class="x3_input" onClick="Javascript:return confirm('确定对接吗？');" >
</td>
<td  align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
<?php }?>

<?php }elseif ($Action=='edit'){
$Id=inject_check($_GET['Id']);
$sid=inject_check($_GET['sid']);
//-------------------------------------获取对接数据
$sresult=mysql_query("select * from docking_platform where id='$sid' ",$conn1);
$sus=mysql_fetch_array($sresult);


//-------------------------------------获取数据对应的云端资料
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料
function ysk_buy_Pricea($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn3;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn3));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}
//-------------------------------------获取数据对应的会员资料
$yx_us_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);
$presult=mysql_query("select * from product where id='$Id'",$conn3);
$pro=mysql_fetch_array($presult);	
?>
<form name="add" method="post" action="?Action=save&Id=<?=$Id?>&sid=<?=$sid?>">
<table class="page_table4" cellpadding="0" cellspacing="1">  
<tr>
<td class="td_left"><span style="padding: 0pt 5px; color: red;">*</span>商品名称：</td>
<td class="left">
<input name="title" type="text" style="width:350px;" value="<?=$pro['title']?>" class="biankuan" />
<input name="color" type="text" id="f3" value="<?=$pro['color']?>" size="7" class="biankuan" /> 
<input id="bn" type="button" value="选色" class="tijiao_input"/>       </td>
</tr>
<tr>
<td height="32" class="td_left">
<span style="padding: 0pt 5px; color: red;">*</span>商品时限：</td>
<td class="left">
<?php if ($pro['overdue']=='0'){echo"不限制";}else{echo$pro['overdue']."天";}?>
</td>
</tr>
<tr>
<td height="32" class="td_left">
销售区域：</td>
<td class="left"><?php
$yx_area=new area();  
echo $yx_area->region($pro['provinces'],$pro['citys'])?>
</td>
</tr>
<tr>
<td class="td_left">
<span style="padding: 0pt 5px; color: red;">*</span>所属商品目录：</td>
<td class="left">
<div style="width: 350px; height:200px; overflow: auto; border:1px #CCC solid; padding:4px;">
<?php
$presult=mysql_query("select * from  product_class  where LagID=1  and isno3=0 order by Classorder asc,id desc",$conn1);
while($prow=mysql_fetch_array($presult)){?>
<input name="ClassID[]" type="checkbox" value="<?=$prow['NumberID']?>"  disabled="disabled"> <?=$prow['7']?> <br />
<?php
$zresult=mysql_query("select * from  product_class where  LagID=2 and  PartID='$prow[NumberID]' order by Classorder asc,id desc",$conn1);
while($pr=mysql_fetch_array($zresult)){?>
----<input name="ClassID[]" type="checkbox" value="<?=$pr['NumberID']?>"> <?=$pr['7']?><br />
<?php
}
} 
?>
</div>
</td>
</tr>
<tr>
<td width="10%" class="td_left">商品面值：</td>
<td width="90%" class="left"><?=$pro['price1']?> 元</td>
</tr>
<tr>
<td width="10%" class="td_left">进货价格：</td>
<td width="90%" class="left">
<?=ysk_buy_Pricea($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate'])?>
元 <select name="pricing" id="pricing">
<option value="1">逐级增加百分比</option>
<option value="2">逐级增加固定值</option>
</select>
<input name="rate" type="text" style="width:60px;" onkeyup="clearNoNum(this)"/>  
比如进货价格100 按百分比增加 后面写入 1的时候 代表1% 也就是每级增加1元
</td>
</tr>
<tr>
<td></td>
<td>
<input type="submit" name="btnSubmit" value="确认对接" id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();" /><input type="button" value="返回前页" class="fanhui_input" onclick="history.go(-1);" />                </td>
</tr>
</table>
</form>
<?php }elseif($Action=='save'){
if($_POST['rate']==''){
echo "<script>alert('操作失败，进货价格不能为空！');self.location=document.referrer;</script>";
exit();	
}
if ($_POST['ClassID']==''){
echo "<script language=\"javascript\">alert('对不起，您没有选择商品栏目哦！');history.go(-1);</script>";
exit();
}
//---------------------------------------单个对接数据	
$Id=inject_check($_GET['Id']);
$sid=inject_check($_GET['sid']);
$pricing=pot_check_price($_POST['pricing']);
$rate=pot_check_price($_POST['rate']);

$title=strip_tags($_POST['title']);
$color=strip_tags($_POST['color']);
$ClassID=$_POST['ClassID'];
//----------------------------------重置商品定价数据
if($pricing==1){
$pricing=1;	
}else{
$pricing=2;	
}
if($rate!=''){
$rate=$rate;	
}else{
$rate=1;	
}

//-------------------------------------获取对接数据
$sresult=mysql_query("select * from docking_platform where id='$sid' ",$conn1);
$sus=mysql_fetch_array($sresult);


//-------------------------------------获取数据对应的云端资料
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料

function ysk_buy_Pricea($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn3;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn3));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}
$presult=mysql_query("select * from product where id='$Id'",$conn3);
$pro=mysql_fetch_array($presult);

$yx_us_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);
$price2=ysk_buy_Pricea($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']);

foreach($ClassID as $value){
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);
mysql_query("insert into product set pricing='$pricing',rate='$rate',kucun='$pro[kucun]',overdue='$pro[overdue]',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$pro[directory3]',punit='$pro[punit]',modl='$pro[modl]',buy_md='$pro[buy_md]',price='$pro[price2]',price1='$pro[price1]',price2='$price2',url='$pro[url]',content='$pro[content]',focus='$pro[focus]',service='$pro[service]',time='$begtime',provinces='$pro[provinces]',citys='$pro[citys]',pid='$pro[id]',docking='$sid',username='$pro[username]',paixu='$pro[paixu]',locks=2",$conn1);
}

echo "<script>alert('对接成功!');window.location='search.php';</script>";
exit();	

//------批量定价

}elseif($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));
$type=strip_tags($_GET['type']); 
$sup_result=mysql_query("select * from sup_members_site where domain_name='$type' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料

function ysk_buy_Pricea($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn3;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn3));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}

?>
<form name="add" method="post" action="?Action=Addsave" >
<input name="type" type="hidden" value="<?=$type?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">批量对接</td>
</tr>
<?php foreach($allArray as $value){
$presult=mysql_query("select * from product where id='$value'",$conn3);
$pro=mysql_fetch_array($presult);?>
<tr>
<td width="10%" class="td_left"> 商品名称：</td>
<td width="90%" class="left">
<input name="ID_Dele[]" type="hidden" value="<?=$value?>" />
<input name="title[]" type="text" style="width:350px;" value="<?=$pro['title']?>" class="biankuan" /> </td>
</tr>
<?php } ?>
<tr>
<td width="10%" class="td_left"> 商品售价：</td>
<td width="90%" class="left"><select name="pricing" id="pricing">
<option value="1">逐级增加百分比</option>
<option value="2">逐级增加固定值</option>
</select>
<input name="rate" type="text" style="width:60px;" onkeyup="clearNoNum(this)"/>  
比如进货价格100 按百分比增加 后面写入 1的时候 代表1% 也就是每级增加1元

</tr>
<tr>
<td width="10%" class="td_left">信息分类：</td>
<td width="90%" class="left">
<div style="width: 350px; height:200px; overflow: auto; border:1px #CCC solid; padding:4px;">
<?php
$presult=mysql_query("select * from  product_class  where LagID=1 and isno3=0 order by Classorder asc,id desc",$conn1);
while($prow=mysql_fetch_array($presult)){?>
<input name="ClassID[]" type="checkbox" value="<?=$prow['NumberID']?>"  disabled="disabled"> <?=$prow['7']?> <br />
<?php
$zresult=mysql_query("select * from  product_class where  LagID=2 and  PartID='$prow[NumberID]' order by Classorder asc,id desc",$conn1);
while($pr=mysql_fetch_array($zresult)){?>
----<input name="ClassID[]" type="checkbox" value="<?=$pr['NumberID']?>"> <?=$pr['7']?><br />
<?php
}
} 
?>

</div></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认对接"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='Addsave'){
$type=strip_tags($_POST['type']); 
$orderid=$_POST['ID_Dele'];
$title=$_POST['title'];
$pricing=pot_check_price($_POST['pricing']);
$rate=pot_check_price($_POST['rate']);
$ClassID= implode(",",$_POST['ClassID']);
$allArray=(explode(',',$ClassID));
if ($_POST['ClassID']==''){
echo "<script language=\"javascript\">alert('对不起，您没有选择商品栏目哦！');history.go(-1);</script>";
exit();
}
if($_POST['rate']==''){
echo "<script>alert('操作失败，进货价格不能为空！');self.location=document.referrer;</script>";
exit();	
}
$sresult=mysql_query("select * from docking_platform where uid='$type' ",$conn1);
$sus=mysql_fetch_array($sresult);

$sup_result=mysql_query("select * from sup_members_site where domain_name='$type' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************获取数据库资料
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************获取数据库资料
function ysk_buy_Pricea($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn3;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn3));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}

$yx_us_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);



//----------------------------------重置商品定价数据
if($pricing==1){
$pricing=1;	
}else{
$pricing=2;	
}
if($rate!=''){
$rate=$rate;	
}else{
$rate=1;	
}
foreach($allArray as $value) { 
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);
for($i=0;$i<count($orderid);$i++){//主键数组内有几个项目既循环几次更新。
$presult=mysql_query("select * from product where id='$orderid[$i]'",$conn3);
$pro=mysql_fetch_array($presult);
$price2=ysk_buy_Pricea($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']);
mysql_query("insert into product set pricing='$pricing',rate='$rate',kucun='$pro[kucun]',overdue='$pro[overdue]',title='$title[$i]',color='$pro[color]',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$pro[directory3]',punit='$pro[punit]',modl='$pro[modl]',buy_md='$pro[buy_md]',price='$pro[price2]',price1='$pro[price1]',price2='$price2',url='$pro[url]',content='$pro[content]',focus='$pro[focus]',service='$pro[service]',time='$begtime',provinces='$pro[provinces]',citys='$pro[citys]',pid='$pro[id]',docking='$sus[id]',username='$pro[username]',paixu='$pro[paixu]',locks=2",$conn1);
}
}	
echo "<script>alert('对接成功!');;window.location='search.php';</script>";
exit();

}?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
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
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
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/sorting.php');
if ($vip_flag1==1){
header('location:/user/sorry.php');
}

$Action=$_REQUEST['Action'];
$big=$_REQUEST['big'];
if ($big!=''){
$big=$_REQUEST['big'];
$sid=$_REQUEST['sid'];
}else{
$big='H001';
$sid=$_REQUEST['sid'];
}

############################------------------------排序程序开始了
$id=$_REQUEST['id'];
$mid=$_REQUEST['mid'];
$nav=$_REQUEST['nav'];
if     ($mid==1){
$search="where number='$_SESSION[ysk_number]' and LagID=1";
}elseif($mid==2){
$search="where number='$_SESSION[ysk_number]' and LagID=2 and PartID='$nav'";
}


if     ($Action=="move1"){//******************************************************************************************************************置顶
#######读取最开始ID
$sql=mysql_query("select * from product_class  $search order by Classorder asc limit 1",$conn1);
$row=mysql_fetch_array($sql);                          
$sorting=$row['Classorder']-0.5;
mysql_query("update product_class set Classorder='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move2"){
//******************************************************************************************************************上移
$sql=mysql_query("select * from product_class  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product_class $search and Classorder<'$row[Classorder]'  order by `Classorder` desc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product_class set Classorder='$row1[Classorder]' where id='$row[id]'",$conn1); 
mysql_query("update product_class set Classorder='$row[Classorder]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move3"){//******************************************************************************************************************下移
$sql=mysql_query("select * from product_class  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product_class $search and Classorder>'$row[Classorder]'  order by `Classorder` asc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product_class set Classorder='$row1[Classorder]' where id='$row[id]'",$conn1); 
mysql_query("update product_class set Classorder='$row[Classorder]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move4"){//******************************************************************************************************************尾页
#######读取最后ID
$sql=mysql_query("select * from product_class  $search order by Classorder desc limit 1",$conn1);
$row=mysql_fetch_array($sql);
$sorting=$row['Classorder']+0.5;
mysql_query("update product_class set Classorder='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();

}


############## 禁止
if ($Action=='close'){
mysql_query("update product_class set locks='1' where id='$_REQUEST[id]'",$conn1);
echo "<script>alert('提交成功!');self.location=document.referrer;</script>"; 
}
if ($Action=='open'){
mysql_query("update product_class set locks='0' where id='$_REQUEST[id]'",$conn1);
echo "<script>alert('提交成功!');self.location=document.referrer;</script>"; 
}


if ($Action=='mydel'){
$len=strlen($_REQUEST['Id']);
if      ($len=='4'){
mysql_query("delete from product        where directory1 in ($_REQUEST[Id])",$conn1);
mysql_query("delete from product_class  where RootID     in ($_REQUEST[Id])",$conn1);
}elseif ($len=='7'){
mysql_query("delete from product        where directory2 in ('$_REQUEST[Id]')",$conn1);
mysql_query("delete from product_class  where NumberID='$_REQUEST[Id]'",$conn1); 
mysql_query("delete from product_class  where PartID     in ('$_REQUEST[Id]')",$conn1);
}elseif ($len=='10'){
mysql_query("delete from product        where directory3 in ('$_REQUEST[Id]')",$conn1);

mysql_query("delete from product_class  where NumberID='$_REQUEST[Id]'",$conn1); 


}

echo "<script>alert('删除成功!');self.location=document.referrer;</script>";

}

if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////用 explode 把 | 的内容隔开成数组
if ($_REQUEST['Del']=='显示'){foreach($allArray as $value){mysql_query("update product_class set locks='0' where id='$value'",$conn1);}  
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
}
if ($_REQUEST['Del']=='隐藏'){foreach($allArray as $value){mysql_query("update product_class set locks='1' where id='$value'",$conn1);}  
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
}


}
?>
<div class="Menubox" >
<ul>
<?php
$result=mysql_query("select * from product_class where LagID=0  order by Classorder asc,id desc limit 0,20",$conn1);
while($nav=mysql_fetch_array($result)){?>
<li <?php if ($nav['3']==$big){?>class="hover"<?php } ?>><a href="info_class.php?big=<?=$nav['3']?>&sid=<?=$nav['0']?>"><?=$nav['7']?></a></li>
<?php }?>
</ul>
</div>
<div class="gn" style="margin-top:10px;">
<a href="class_add.php?Id=<?=str_replace("H","S",$big)?>"><img src="../images/a1.jpg"></a>
</div>


<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="page_table" width="100%" style="margin-top:10px;">
<tr>
<td width="5%" height="32" align="center" class="table_top">选择</td>
<td width="11%" align="center" class="table_top">编号</td>
<td width="44%" align="center" class="table_top">目录名称</td>
<td width="13%" align="center" class="table_top">排序</td>
<td width="8%" align="center" class="table_top">状态</td>
<td width="11%" align="center" class="table_top">添加目录</td>
<td width="8%" align="center" class="table_top">操作</td>
</tr>
<?php
$status=$_REQUEST['status'];                 //商品状态
$template=$_REQUEST['template'];             //商品模板
$type=$_REQUEST['type'];                     //搜索条件
$keywords=$_REQUEST['keywords'];             //搜索关键词
$search="where number='$_SESSION[ysk_number]' "; 
if ($big!='')   $search.=" and RootID='$big' and LagID=1"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class`  $search   ",$conn1)); 
$num="30";
$page=new page($total,$num);
$sql="select * from product_class   $search   order by Classorder asc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
	
#######读取最开始ID
$result1=mysql_query("select * from product_class  $search order by Classorder asc limit 1",$conn1);
$row1=mysql_fetch_array($result1);
#######读取最后ID
$result2=mysql_query("select * from product_class  $search order by Classorder desc limit 1",$conn1);
$row2=mysql_fetch_array($result2);
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="center"><?=$row['3']?></td>
<td align="left">
<?php if ($_REQUEST['id']==$row['3']){?>
<a class="sort sort2" href="?big=<?=$big?>"></a><b style="color:<?=$row['color']?>"><?=$row['7']?></b>
<?php }else{?>
<a class="sort sort1" href="?big=<?=$big?>&id=<?=$row['3']?>"></a><b style="color:<?=$row['color']?>"><?=$row['7']?></b>
<?php }?>
</td>
<td>
<div class="dirction">
<?=sorting('top',$row1['id'],$row['id'],1,1)?>
<?=sorting('up',$row1['id'],$row['id'],1,1)?>
<?=sorting('down',$row2['id'],$row['id'],1,1)?>
<?=sorting('bottom',$row2['id'],$row['id'],1,1)?>
</div>
</td>
<td align="center">
  <?php if ($row['locks']=='0') {?>
  <a title="显示" class="a open" href="?Action=close&id=<?=$row['0']?>"></a>
  <?php }else{?>
  <a title="隐藏" class="a open close" href="?Action=open&id=<?=$row['0']?>"></a>
  <?php } ?>
</td>
<td align="center"><a  href="class_add.php?Id=<?=$row[NumberID]?>">添加下级目录</a></td>
<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><a  href="class_add.php?Action=edit&Id=<?=$row['id']?>"  class="a edit"></a></td>
<td><a href="info_class.php?Action=mydel&Id=<?=$row[NumberID]?>" class="a delete" onclick="Javascript:return confirm('确定要删除吗？');"></a> </td>
</tr>
</table>



</td>
</tr>
<?php
if ($_REQUEST['id']!='' and $_REQUEST['id']==$row['3'] ){

$Rss="SELECT * FROM product_class where LagID=2 and PartID='$_REQUEST[id]'  order by Classorder asc,id desc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){
	
#######读取最开始ID
$result3=mysql_query("select * from product_class  where LagID=2 and PartID='$_REQUEST[id]'  order by Classorder asc limit 1",$conn1);
$row3=mysql_fetch_array($result3);
#######读取最后ID
$result4=mysql_query("select * from product_class  where LagID=2 and PartID='$_REQUEST[id]'  order by Classorder desc limit 1",$conn1);
$row4=mysql_fetch_array($result4);
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$Orzx[id]?>"></td>
<td align="center"><?=$Orzx['3']?></td>
<td align="left">-------- <font color="<?=$Orzx['color']?>"><?=$Orzx['7']?></font></td>
<td>

<div class="dirction">
<?=sorting('top',$row3['id'],$Orzx['id'],2,$Orzx['PartID'])?>
<?=sorting('up',$row3['id'],$Orzx['id'],2,$Orzx['PartID'])?>
<?=sorting('down',$row4['id'],$Orzx['id'],2,$Orzx['PartID'])?>
<?=sorting('bottom',$row4['id'],$Orzx['id'],2,$Orzx['PartID'])?>
</div></td>
<td align="center">
  <?php if ($Orzx['locks']=='0') {?>
  <a title="显示" class="a open" href="?Action=close&id=<?=$Orzx['0']?>"></a>
  <?php }else{?>
  <a title="隐藏" class="a open close" href="?Action=open&id=<?=$Orzx['0']?>"></a>
  <?php } ?>
</td>
<td align="center"></td>
<td align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><a href="class_add.php?Action=edit&Id=<?=$Orzx[id]?>" class="a edit"></a></td>
<td><a href="info_class.php?Action=mydel&Id=<?=$Orzx[NumberID]?>" class="a delete" onclick="Javascript:return confirm('确定要删除吗？');"></a> </td>
</tr>
</table>

</td>
</tr>
<?php }} } ?>

<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="48%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="全选" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="显示" class="x2_input">
<input type="submit" name="Del" id="Del" value="隐藏" class="x2_input"></td>
<td width="52%" style="text-align:center;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?>  </td>
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
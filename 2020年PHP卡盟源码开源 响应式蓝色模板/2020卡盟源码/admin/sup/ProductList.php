<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
<link rel="stylesheet" href="/public/images/page.css" type="text/css" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php if ($Action=='') {?>
<?php include('head.php');?>
<div class="Nowcate">
<span class="Nowcatedt">当前目录</span><em>&raquo;</em><a href="CategoryList.php?y=1&NumberID=<?=substr($_REQUEST['id'],0,4);?>">商品目录</a>
<em>&raquo;</em>
<?php
$sqlfl="select * from sup_product_class where NumberID='$_REQUEST[id]'";   //读取数据表
$zycfl=mysql_query($sqlfl,$conn2);  //执行该SQl语句
$rowfl=mysql_fetch_array($zycfl);
?>
<a href="ProductList.php?y=1&NumberID=<?=$rowfl['NumberID']?>"><?=$rowfl['7']?></a>
</div>

<div class="Sort"></div>
<div class="gongqiu">
<form name="form1" method="post" action="search.php?Action=mylove">
<table cellspacing="0" cellpadding="0" class="table2 table22">
<tr>
<th width="4%">选择</th>
<th width="54%">商品名称</th>
<th width="12%">商品类型</th>
<th width="10%">面值</th>
<th width="10%">进价</th>
<th width="10%">对接状态</th>
</tr>
<?php
$id=$_REQUEST['id'];    //搜索关键词
$search="where locks='2' "; 
if ($id!='') $search.=" and directory3 = '$id' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `sup_product`  $search",$conn2));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from sup_product $search  order by time desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn2);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){

$sqlzz="select * from sup_members where number='$row[username]'";   //读取数据表
$zyczz=mysql_query($sqlzz,$conn2);  //执行该SQl语句
$rowzz=mysql_fetch_array($zyczz);
$total=mysql_num_rows(mysql_query("SELECT * FROM `product` where sid='$row[id]' ",$conn1));
?>
<tr class="tr1 trevent">
<td>
<?php if($total==0){?> 
<input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>">
<?php } ?>

</td>
<td class="shangpin1">
 <a  href="#art1" onclick="art.dialog.open('sup/show.php?id=<?=$row['id']?>&y=<?=$_REQUEST['y']?>',{title:'商品介绍',width:800,lock:true, fixed:true});"  class="product">
<span><?=$row['title']?></span></a>
<br>
商品状态：<?=ysk_state($row['state'])?>
<br />
<span class="ashanghu">
销售区域：<?php
$yx_area=new area();  
echo $yx_area->region($row['provinces'],$row['citys'])?>
<br />
供货商：<?php if ($row['username']=='') {?>云搜卡<?php }else{?><?=$rowzz['company']?><?php } ?>
(<?=$row['username']?>)</span><span class="ashijian">发布时间：<?=date("Y-m-d G:i:s",$row['time'])?></span></td>
<td><?=$row['modl']?>
</td>
<td><?=number_format($row['price1'],3);?>元 </td>
<td><?=number_format($row['price2'],3);?>元 </td>
<td>
<?php if($total!=0){?> 
<a  href="#"  class="a_fabu a_fabu2">已对接</a>
<?php }else{?>
<a  href="#art1" onclick="art.dialog.open('sup/docking.php?id=<?=$row['id']?>',{title: '发布到平台',width:960,height:600,lock:true,fixed:true});" class="a_fabu a_fabu1">未对接</a>
<?php } ?>

</td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="padding-top:10px;"><input type="button" value="全选" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="批量对接" class="x4_input" onclick="Javascript:return confirm('确定要批量对接吗？');" ></td>
<td ><?=$page->paging();?></td>
</tr>
</table>
</form>
</div>
</div>
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
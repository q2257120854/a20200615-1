<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
if ($Action=="del") {
mysql_query("update members set card_pic='' where id ='$_REQUEST[id]'",$conn1);
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='删除'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("update members set card_pic='' where id in ($ID_Dele)",$conn1); 
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}

if ($Action=="save") {
$card_pic=strip_tags($_POST['card_pic']);
$Id=strip_tags($_POST['Id']);
$online=strip_tags($_POST['online']);
$mypage=strip_tags($_POST['mypage']);
mysql_query("update members set card_lock='$online' where id='$Id'",$conn1); 
if ($online==2){
mysql_query("update members set card_pic='' where id='$Id'",$conn1); 
$Filename='../..'.$card_pic;
if(file_exists($Filename)){
if(unlink($Filename)){
//echo "文件删除成功！";
}else{
//echo "文件删除失败！";
}	
}else{
//echo"目标文件不存在呀！";
}

}
echo "<script>alert('处理成功!');window.location='?y=1&page=1';</script>";
}
?>
<div class="Menubox" >
<ul>
<li <?php if ($_REQUEST['y']=='') {?>class="hover"<?php }?>><a href="identity.php">已审核</a></li>
<li <?php if ($_REQUEST['y']=='1') {?>class="hover"<?php }?>><a href="identity.php?y=1">未审核</a></li>
</ul>
</div>

<?php if  ($Action=="List" or $Action==""){?>
<form name="add" method="post" action="identity.php" >
<input id="ClassID" name="ClassID" type="hidden" value="">
<input id="y" name="y" type="hidden" value="<?=$_REQUEST['y']?>">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
<option value="username">客户名称</option>
</select></td>
</tr>
</table>








</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="4%" class="table_top">ID</td>
<td width="11%" class="table_top">编号</td>
<td width="15%" class="table_top">客户名</td>

<td width="15%" class="table_top">真实姓名</td>
<td width="14%" class="table_top">身份证号码</td>
<td width="15%" class="table_top">联系电话</td>
<td width="15%" class="table_top">邮箱地址</td>
<td width="11%" class="table_top">操作</td>
</tr>
<?php
$keyword=$_REQUEST['keyword'];    //搜索关键词
$keywords=$_REQUEST['keywords'];  //查询条件
$search="where 1=1 and card_pic<>'' ";
if ($_REQUEST['y']=='1') $search.=" and card_lock=0 "; 
if ($_REQUEST['y']!='1') $search.=" and card_lock=1 "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `members`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from members $search    order by time desc {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){


?>
<tr>
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td><?=$row['rname']?></td>
<td><?=$row['card']?></td>
<td><?=$row['phone']?></td>
<td><?=$row['email']?></td>
<td>
<?php if ($_REQUEST['y']!='1'){?>
<a href="<?=$row['card_pic']?>" target="_blank">查看</a>
<?php }else{?>
<a href="?Action=edit&id=<?=$row['id']?>&y=<?=$_REQUEST['y']?>&mypage=<?=$_REQUEST['page']?>">查看</a>
<?php } ?>
 | <a href="?Action=del&id=<?=$row['id']?>">删除</a></td>
</tr>
<?php
}
?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="全选" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="删除" class="x3_input" onclick="return CheckSelect();"></td> 
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){  
$sql="select * from members where id='$_REQUEST[id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=save" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="mypage" name="mypage" type="hidden" value="<?=$_REQUEST['mypage']?>">
<input id="card_pic" name="card_pic" type="hidden" value="<?=$row['card_pic']?>">
<table class="page_table4" cellpadding="0" cellspacing="1" style="margin-top:10px;">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息审核</td>
</tr>
<tr>
<td width="10%" class="td_left">平台编号：</td>
<td width="90%" class="left"><?=$row['number']?></td>
</tr>
<tr>
<td width="10%" class="td_left">会员名称：</td>
<td width="90%" class="left"><?=$row['username']?></td>
</tr>


<tr>
<td class="td_left">联系人姓名：</td>
<td class="left"><?=$row['rname']?></td>
</tr>
<tr>
<td class="td_left">身份证号：</td>
<td class="left"><?=$row['card']?></td>
</tr>

<tr>
<td class="td_left">身份证电子档：</td>
<td class="left"><a href="<?=$row['card_pic']?>" target="_blank">点击查看</a></td>
</tr>
<tr>
<td class="td_left">审核状态：</td>
<td class="left"><select name="online" id="online">
<option value="1" selected="selected">审核通过</option>
<option value="2">审核失败</option>
</select></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认提交"  id="btnSubmit" class="tijiao_input" />
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

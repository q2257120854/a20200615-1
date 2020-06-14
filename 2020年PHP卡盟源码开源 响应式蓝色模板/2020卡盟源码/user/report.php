<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
?>
<script>
function cl()
{ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>

</head>
<body>
<div style="padding:10px ">
<?php if ($Action=='') {
$proid=check_input($_GET[id]);
$sql1="select * from product where id='$proid' and docking=0 and sid=0";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
if ($row1['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>操作失败，没有找到该商品呀!";
exit();
}
?>
<form action="?Action=save" method="post"  enctype="multipart/form-data">
<input name="id" type="hidden" value="<?=$row1['id']?>">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">商品信息：</td>
<td><?=$row1['title']?></td>
</tr>
<tr>
<td height="32" class="td_left">商品面值：</td>
<td><?=$row1['price1']?> <?=$moneytype?></td>
</tr>
<tr>
<td height="32" class="td_left">举报类型：</td>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="3%"><input name="jubao" type="radio" value="虚假商品" checked="checked" /> </td>
<td width="11%">虚假商品</td>
<td width="4%"><input name="jubao" type="radio" value="误导性商品"> </td>
<td width="12%">误导性商品</td>
<td width="4%"><input name="jubao" type="radio" value="违法商品"> </td>
<td width="66%">违法商品</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="32" class="td_left">上传截图：</td>
<td><input name="upfile" type="file" id="upfile" size="40" /></td>
</tr>
<tr>
<td height="32" class="td_left">举报内容：</td>
<td><textarea name="content" cols="70" rows="7" class="biankuan" id="content"></textarea>
</td>
</tr>
<tr>
<td height="32" colspan="2" align="center" ><input name="提交" type="submit" class="button_buy"  value="下一步" /></td>
</tr>
</table>
</form>

<?php }elseif ($Action=='save') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
inject_check($_POST['id']);

$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_report`  where proid='$_REQUEST[id]' and number='$_SESSION[ysk_number]'",$conn1)); 
if ($_POST['content']==''){
echo "<script language=\"javascript\">alert('对不起亲，您没有写举报内容哦！');self.location=document.referrer;</script>";
}elseif($total!='0'){
echo "<script language=\"javascript\">alert('对不起亲，您不能重复举报同一个商品！');self.location=document.referrer;</script>";
}elseif($total=='0'){	
/////////////////////////////////////////调用上传文件组件
include_once('../jhs_config/upload_class.php');

$jubao=strip_tags($_POST['jubao']);
$content=strip_tags($_POST['content']);

mysql_query("insert into `goods_report` (proid,online,type,pic,number,username,content,begtime,sjcw)"."values ('$_POST[id]','$_REQUEST[online]','$jubao','$uploadname','$_SESSION[ysk_number]','$row1[username]','$content','$begtime','0')",$conn1);
}
?>
 
<center><br /><br /><img src="../Public/images/blue/08.png"><br /><br />恭喜您举报成功，等待系统审核<br /><br />
<input name="关闭" type="button" class="button_close" id="Button2"  onClick="cl()" value="关闭" /></center>
<?php } ?>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
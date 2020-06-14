<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////修改记录
If ($Action=="save") {
$price=get_check_price($_POST['price']);
if ($price<0){
echo "<script language=\"javascript\">alert('对不起，金额异常！');history.go(-1);</script>";
exit();
}

$rs=file($_FILES ['file'] ['tmp_name']);
$num=count($rs);
$money=$num*$price;
ysk_date_log(6,$_SESSION['ysk_username'],'导入 '.$num.' 张加款卡 面值为 "'.$price.'" 总共导入金额为 "'.$money.'" 元');
foreach($rs as $k=>$v){
$rs1=explode(' ',$v);
$yx1=trim(strip_tags($rs1[0]));
$yx2=trim(strip_tags($rs1[1]));
 //var_dump($rs1);exit;
$total=mysql_num_rows(mysql_query("SELECT * FROM `one_cartoon` where  account='$yx1' ",$conn1));
if ($total==0){
mysql_query("insert into one_cartoon (price,account,password,time)"."values ('$price','$yx1','$yx2','$begtime')",$conn1);
}
}



echo "<script>alert('导入成功!');self.location=document.referrer;</script>";
}

?>
<body>
<?php if ($Action=='') {?>
<script>
function import_check(){
var f_content = document.getElementById('file').value;
var fileext=f_content.substring(f_content.lastIndexOf("."),f_content.length)
fileext=fileext.toLowerCase()
if ( fileext !='.txt') {
alert("对不起，导入数据格式必须是.txt格式文件哦，请您调整格式后重新上传，谢谢 ！");            
return false;
}
}
</script>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="?Action=save" onsubmit="return import_check();">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr><td colspan="2" class="table_top" style="text-align: left;">加款卡导入</td></tr>
<tr>
<td class="td_left">导入说明</td>
<td>账户必须是字母开头 格式为.txt 文件 账户空格密码1行1个</td>
</tr>
<tr>
<td class="td_left">卡号文件</td>
<td>
<input name="file" type="file" id="file" size="40" /></td>
</tr>
<tr>
<td class="td_left">加款卡面值：</td>
<td class="left"><select name="price" id="price">
<option value="1" selected="selected">1元</option>
<option value="5">5元</option>
<option value="10">10元</option>
<option value="50">50元</option>
<option value="100">100元</option>
<option value="300">300元</option>
<option value="1000">1000元</option>
<option value="5000">5000元</option>
</select></td>
</tr>


<tr>
<td></td>
<td>
<input type="submit" name="btnSubmit" value="确认导入"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>

<?php } ?>
</body>
</Html>

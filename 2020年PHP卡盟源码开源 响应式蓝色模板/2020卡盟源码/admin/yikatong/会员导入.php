<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/css.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../editor/kindeditor.js"></script>
<script charset="utf-8" src="../editor/lang/zh_CN.js"></script>
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
</head>
<?php
include('../../jhs_config/conn.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////修改记录
If ($Action=="save") {
$price=$_POST['price'];     //// 金额
$time=date("Y-m-d h:i:s");  ///   时间

$rs=file($_FILES ['file'] ['tmp_name']);
foreach($rs as $k=>$v){
$rs1=explode('	',$v);

$Rss="select * from members order  by id desc limit 1 ";        //读取数据表
$Orz=mysql_query($Rss,$conn1);
$Orzx=mysql_fetch_array($Orz);
$youid=$Orzx['id']+2;
 //var_dump($rs1);exit;
 
if ($rs1[3]=="注册用户（V1） "){
 $site_level='1';
}elseif ($rs1[3]=="白金用户（V2） "){
 $site_level='2';
}elseif ($rs1[3]=="钻石用户（V3） "){
 $site_level='3';
}elseif ($rs1[3]=="高级经销商（V4） "){
 $site_level='4';
}elseif ($rs1[3]=="特级经销商（V5） "){
 $site_level='5';
}elseif ($rs1[3]=="至尊经销商（V6） "){
 $site_level='6';
}elseif ($rs1[3]=="精英总代理（V7） "){
 $site_level='7';
}elseif ($rs1[3]=="皇冠总代理（V8） "){
 $site_level='8';
}
 $Local_Ip=Local_Ip();
$sql="insert into members (id,type,level,username,password,passwords,number,agent,company,rname,card,qq,email,phone,address,kuan,goods_kuan,frozen_kuan,zong_kuan,biao_kuan,di_kuan,integral,buy_fen,mai_fen,chengfa1,chengfa2,fabegtime,fahits,buyer_credit,seller_credit,power1,power2,power3,power4,power5,power6,power7,power8,power9,power10,power11,power12,power13,power14,power15,power16,power17,power18,power19,power20,power21,power22,power23,power24,power25,power26,power27,power28,power29,power30,locks,time,lost_time,login_time,lost_ip,login_ip,lost_dz,login_dz,ban,pingjia0,pingjia1,pingjia2,pingjia3,pingjia4,pingjia5,pingjia6,pingjia7,begtime,qiandaojf,giftjf,vipedu,diyici) " .
"values ('','','$site_level','$rs1[1]','password','$passwords','$rs1[0]','$rs1[4]','$rs1[2]','$rname','$rs1[7]','$rs1[6]','$rs1[8]','$rs1[5]','$address','0','0','0','$rs1[10]','0','0','0','0','0','0','0','','','0','0','0','0','0','0','0','1','0','0','0','1','0','0','1','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',now(),now(),now(),'$Local_Ip','$Local_Ip','$yydz','$yydz','','0','0','0','0','0','0','0','0','$begtime','0','0','0','0')";
mysql_query($sql,$conn1);
}



echo "<script>alert('导入成功!');;self.location=document.referrer;</script>";
}

?>
<body>
<?php if ($Action=='') {?>
<div style="padding:10px;">
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
<tr><td colspan="2" class="table_top" style="text-align: left;">充值卡导入</td></tr>

<tr>
<td class="td_left">卡号文件</td>
<td>
<input name="file" type="file" id="file" size="40" /></td>
</tr>
<tr>
<td class="td_left">一卡通面值：</td>
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

</div>
<?php } ?>
</body>
</Html>

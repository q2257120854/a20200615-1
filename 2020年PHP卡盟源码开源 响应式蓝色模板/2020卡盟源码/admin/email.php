<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
	</head>
<?php
include('../jhs_config/function.php');
include('../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
if ($Action=="save") {
$smtp_email=$_POST['smtp_email']; 
$send_email=$_POST['send_email'];
if ($_POST['send_email_password']!=''){
$send_email_password=encrypt($_POST['send_email_password'],'E','nowamagic');
}else{
$send_email_password=$_POST['y3'];
}

$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
if ($y1<>$smtp_email){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统邮箱的SMTP服务');}
if ($y2<>$send_email){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统邮箱的发送邮箱');}
if ($send_email_password!=''){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统邮箱的邮箱密码');}
mysql_query("update site_config set smtp_email='$smtp_email',send_email='$send_email',send_email_password='$send_email_password' where id=1",$conn1); 
echo "<script>alert('设置成功!');;self.location=document.referrer;</script>";
}

?>
<body>

<?php
$result=mysql_query("select * from site_config where id='1'",$conn1);
$row=mysql_fetch_array($result);
?>
<form name="add" method="post" action="?Action=save&id=1" >
<input name="y1" type="hidden" value="<?=$row['smtp_email']?>">
<input name="y2" type="hidden" value="<?=$row['send_email']?>">
<input name="y3" type="hidden" value="<?=$row['send_email_password']?>">
<br>
<div class="layui-card">
          <div class="layui-card-body">
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg12">
                  <label class="layui-form-label">SMTP服务：</label>
                  <div class="layui-input-block">
                    <input type="text" name="smtp_email" value="<?=$row['smtp_email']?>" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
				<br>
				 <div class="layui-col-lg12">
                  <label class="layui-form-label">发送邮箱：</label>
                  <div class="layui-input-block">
                    <input type="text" name="send_email" value="<?=$row['send_email']?>" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
				 <div class="layui-col-lg12">
                  <label class="layui-form-label">邮箱密码：</label>
                  <div class="layui-input-block">
                    <input type="password" name="send_email_password" value="<?=$row['send_email_password']?>" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit="" lay-filter="component-form-element">立即提交</button>
                </div>
              </div>
            </form>
          </div>
        </div>
</form>

</body>
</Html>

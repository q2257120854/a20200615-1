
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
</head>
<?php
include('../jhs_config/function.php');
include('../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$qq1=strip_tags($_POST['qq1']);
$qq2=strip_tags($_POST['qq2']);
$qq3=strip_tags($_POST['qq3']);
$qq4=strip_tags($_POST['qq4']);
$phoe1=strip_tags($_POST['phoe1']);
$phoe2=strip_tags($_POST['phoe2']);
$phoe3=strip_tags($_POST['phoe3']);
$address=strip_tags($_POST['address']);

$sql=mysql_query("select * from site_config  where id='1'",$conn1);
$row=mysql_fetch_array($sql);
if ($Action=="save"){
if ($appkey==''){
$appkey=$row['appkey'];
}
if ($appid==''){
$appid=$row['appid'];
}

if ($row['api_qq']<>$api_qq){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统QQ验证');}
if ($row['appkey']<>$appkey){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统QQ APP ID');}
if ($row['appid']<>$appid){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统QQ APP KEY');}
if ($row['qq1']<>$qq1){ysk_date_log(6,$_SESSION['ysk_username'],'修改了系统qq1');}

mysql_query("update site_config set qq1='$qq1',qq2='$qq2', qq3='$qq3',qq4='$qq4',phoe1='$phoe1',phoe2='$phoe2',phoe3='$phoe3',address='$address'where id=1",$conn1); 

echo "<script>alert('修改成功!');self.location=document.referrer;</script>";
}

?>
<body>
<div class="x-body">
 <div class="layui-form-item">
<div class="layui-card">
      <div class="layui-card-header">客服信息</div>
	  <form name="add" method="post" action="?Action=save" >
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">咨询 QQ：</label>
            <div class="layui-input-block">
              <input type="text" name="qq1" lay-verify="qq1" autocomplete="off" value="<?=$row['qq1']?>" class="layui-input">
            </div>
          </div>
          </div>     
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">业务 QQ：</label>
            <div class="layui-input-block">
              <input type="text" name="qq2" lay-verify="qq2" autocomplete="off" value="<?=$row['qq2']?>" class="layui-input">
            </div>
          </div>
          </div>  
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">加款 QQ：</label>
            <div class="layui-input-block">
              <input type="text" name="qq3" lay-verify="qq3" autocomplete="off" value="<?=$row['qq3']?>"class="layui-input">
            </div>
          </div>
          </div>  		
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">投诉 QQ：</label>
            <div class="layui-input-block">
              <input type="text" name="qq4" lay-verify="qq4" autocomplete="off" value="<?=$row['qq4']?>"class="layui-input">
            </div>
          </div>
          </div> 
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">客服电话：</label>
            <div class="layui-input-block">
              <input type="text" name="phoe1" lay-verify="phoe1" autocomplete="off" value="<?=$row['phoe1']?>" class="layui-input">
            </div>
          </div>
          </div> 	
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">业务电话：</label>
            <div class="layui-input-block">
              <input type="text" name="phoe2" lay-verify="phoe2" autocomplete="off" value="<?=$row['phoe2']?>" class="layui-input">
            </div>
          </div>
          </div> 	
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">加款电话：</label>
            <div class="layui-input-block">
              <input type="text" name="phoe3" lay-verify="phoe3" autocomplete="off" value="<?=$row['phoe3']?>" class="layui-input">
            </div>
          </div>
          </div> 
      <div class="layui-card-body" style="padding: 15px;">
          <div class="layui-form-item">
            <label class="layui-form-label">联系地址：</label>
            <div class="layui-input-block">
              <input type="text" name="address" lay-verify="address" autocomplete="off" value="<?=$row['address']?>" class="layui-input">
            </div>
          </div>
          </div> 		  
         <div class="layui-input-block">
                  <button class="layui-btn" lay-submit="" lay-filter="component-form-element">保存数据</button>
				  
                </div><br>
      </div>
    </div>
	      </div>
    </div>
</form>
</body>
</Html>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/jquery-1.9.1.js" type="text/javascript"></script>    
    <style type="text/css"></style>
</head>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
?>
<body style="background-color:#e5e5e5;" marginwidth="0" marginheight="0">
    <div class="m-top">
        <a href="/Merchant" class="list-title l01">供货商后台</a>
        <a href="/user/product/DHandleSave.php" target="frame_content">手工订单(<font color="red"> <?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order` where trading='0'  and refund!=1   and refund!=2  and sid=0 and username='$_SESSION[ysk_number]' and docking=0",$conn1));
echo $total;
?> </font>)</a>
        <a href="/user/product/OnlineService.php" target="frame_content">投诉订单(<font color="red"> <?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `complaints_feedback` where audit='0'  and username='$_SESSION[ysk_number]' and clouds=0 ",$conn1));
echo $total;
?> </font>)</a>
<a href="/user/product/tuikuan.php" target="frame_content">退款订单(<font color="red"><?php 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order` where refund='1' and username='$_SESSION[ysk_number]' and docking=0",$conn1));
echo $total;
?> </font>)</a>

		
       
    </div>



</body>
</Html>
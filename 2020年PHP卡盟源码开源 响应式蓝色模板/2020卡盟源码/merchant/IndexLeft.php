<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- 基本元素 开始 -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" charset="utf-8" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.superslide.2.1.1.js"></script>
    <script type="text/javascript" src="js/showlist.js"></script>
    <!-- 基本元素 结束 -->
</head>
<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$Action=strip_tags($_GET['Action']);
$layout=strip_tags($_GET['layout']); 
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

if     ($layout=='1'  && $yx_us['power5']==1){
$yourl='product/DHandleSave.php';
}elseif($layout=='1'  && $yx_us['power5']!=1){
$yourl='sorry.php';
}elseif($layout=='2' ){
$yourl='dealers/CustomerList.php';
}else{
$yourl='right.php';
}


if ($_SESSION['Platform_announcement']=='1' and $login_prompt!=''){
$_SESSION['my_gg_id']=1;
}
###########读取强制阅读的短信
$result=mysql_query("select * from sms where username='$_SESSION[ysk_number]' and locks='1' order by begtime desc,id desc limit 0,1",$conn1);
$row=mysql_fetch_array($result);
if($row['id']!=''){
$_SESSION['my_lock_id']=$row['id'];
}
mysql_free_result($result);
?>
<body style="background-color:#353D45;">
    <div>
        <div class="l-side">
            <div class="operate">
                <ul id="fold-menu">
                    <li selected>
                        <h4 style="border-left:2px solid #4384D7">订单管理</h4>
                        <div class="list-item none" style="display: block;">
                            <span><a href="/user/product/DHandleSave.php" target="frame_content">手工订单列表(<font color="yellow"> <?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order` where trading='0'  and refund!=1   and refund!=2  and sid=0 and username='$_SESSION[ysk_number]' and docking=0",$conn1));
echo $total;
?> </font>)</a></span>
                            <span><a href="/user/product/OnlineService.php" target="frame_content">订单投诉处理(<font color="yellow"> <?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `complaints_feedback` where audit='0'  and username='$_SESSION[ysk_number]' and clouds=0 ",$conn1));
echo $total;
?> </font>)</a></span>
                            <span><a href="/user/product/tuikuan.php" target="frame_content">维权退款处理(<font color="yellow"> <?php 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order` where refund='1' and username='$_SESSION[ysk_number]' and docking=0",$conn1));
echo $total;
?> </font>)</a></span>
                            
                        </div>
                    </li>
                    <li>
                        <h4>商品管理</h4>
                        <div class="list-item none">
                            <span><a href="/user/product/index.php" target="frame_content">供货商品管理</a></span>
                            <span><a href="/user/product/index.php?Action=add" target="frame_content">发布供货商品</a></span>
							<span><a href="/user/product/red_name.php" target="frame_content">独立销售专区</a></span>
							<span><a href="/user/product/price_modl.php" target="frame_content">价格模版管理</a></span>

                        </div>
                    </li>

                    <li>
                        <h4>财务管理</h4>
                        <div class="list-item none">
                            <span><a href="/user/product/History.php" target="frame_content">入账明细</a></span>
							<span><a href="/user/product/refund_detail.php" target="frame_content">订单退款明细</a></span>
                            <span><a href="/user/product/additional.php" target="frame_content">追加供货押金</a></span>
							 <span><a href="/user/product/conversion.php" target="frame_content">货款转余额</a></span>
							<span><a href="/user/cash.php?Go=1" target="frame_content">申请账户提现</a></span>
                        </div>
                    </li>
                    
                </ul>
                <script type="text/javascript" language="javascript">
                    navList();
                </script>
            </div>
        </div>
    </div>
</body>
</Html>

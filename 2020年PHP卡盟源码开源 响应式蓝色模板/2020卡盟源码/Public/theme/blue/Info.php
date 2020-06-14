<?php
inject_check($_REQUEST['id']);
$yid =inject_check(PAPI_GetSafeParam("id",0,XH_PARAM_INT));
$sql1="select * from article where id='$yid'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);
///////////////////////////////////////////////////////////////////////上一篇文章地址
$pre="select * from article where id<'$yid' order by id desc limit 0,1 ";
$Rspre=mysql_query($pre,$conn1);
$aa=mysql_num_rows($Rspre);
if($aa!=0){
$pre_row=mysql_fetch_array($Rspre);
$pre_id=$pre_row[Id];
$pre_Title=$pre_row[Title];
}

///////////////////////////////////////////////////////////////////////下一篇文章地址
$next="select * from article where id>'$yid' order by id asc limit 0,1 ";
$Rsnext=mysql_query($next,$conn1);
$aa=mysql_num_rows($Rsnext);
if($aa!=0){
$next_row=mysql_fetch_array($Rsnext);
$next_id=$next_row[Id];
$next_Title=$next_row[Title];
}

if       ($row1['menu']=='平台公告'){
$ymenu="1";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=7;IE=9;IE=8">
<title><?=$row1['title']?>-<?=$row1['menu']?>-<?=$site_name?> - Powered by 聚合社</title>
<meta content="<?=$site_keywords?>" name="keywords">
<meta content="<?=$site_description?>" name="description">
<link rel="shortcut icon" type="image/x-icon" href="http://www.nitiangou.cn/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="/templatecss/blue/hcjane.css" />
<link href="/templatecss/blue/global.css" rel="stylesheet" type="text/css" />
<link href="/templatecss/blue/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/templatecss/blue/jquery.js"></script>
<script type="text/javascript" src="/templatecss/blue/hcjane.js"></script>
<script type="text/javascript" src="/templatecss/blue/reg.js"></script>
<script type="text/javascript" src="/templatecss/blue/login.js"></script>
</head>
<body id="nav_btn01">
   <?php include('head.php');?>
    <!--end导航-->
    <div class="clear_div2 i_center_bj">
        <div class="clear_div d_center" style="background: #fff;">
            <dl class="blue_th">
                <dd class="th">动态内容</dd>
            </dl>
            <h1 class="clear_div th display_th"><?=$row1['title']?></h1>
            <div class="clear_div display_date">
                <span>发布时间：<?=date("Y-m-d",$row1['begtime'])?></span></div>
                <div class="clear_div display_wen">
                    <?=$row1[content]?>               </div>
            </div>
        </div>
    </div>
 <?php include('foot.php');?>
</body>
</html>
</body>
</html>
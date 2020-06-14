<html xmlns="http://www.w3.org/1999/xhtml" style="height: 100%">
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
?>

<head>

   <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/ui-dialog.css" />
    <title>供货商户控制台</title>
	
    <script type="text/javascript" charset="utf-8" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/dialog-plus-min.js"></script>
</head>

<body style="background-color:#e5e5e5;">
    <div class="top-nav">
        <h2><font size="4">商户控制台</font></h2>
        <ul>
            <li style="float:right;"><em class="n09"></em><a href="/logout.php" onclick="return confirm('确定退出？');">安全退出</a></li>
            <li style="float:right;background-color:#141d26;"><em class="n01"></em><a href="/" target="frame_content">首页</a></li>
        </ul>
    </div>
    <iframe src="IndexMain.php" width="100%" height="1000px" marginwidth="0" frameborder="no">
</iframe></body>
</Html>
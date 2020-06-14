
<?php
session_start();
unset($_SESSION['ysk_username']);
unset($_SESSION['ysk_flag']);
unset($_SESSION['ysk_founder']);
echo "<script language=\"javascript\">alert('你已成功退出！');window.location.href='login.php';</script>";
?>


<?php
session_start();
unset($_SESSION['ysk_number']);
unset($_SESSION['account']);
unset($_SESSION['diyici']);
unset($_SESSION['Platform_announcement']);
echo "<script language=\"javascript\">alert('你已成功退出！');window.location.href='/index.php';</script>";
?>

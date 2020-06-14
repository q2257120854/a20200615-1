<?php
//echo '贪玩点卡智能建站·全开源卡盟系统 免费下载：www.kycard.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
if($_SESSION['ysk_number']=='' || !isset($_SESSION['ysk_number'])  ){
echo "<script language=\"javascript\">alert('非法操作，此功能只对会员开放！');window.location.href='/index.php';</script>";
exit();
}
?>
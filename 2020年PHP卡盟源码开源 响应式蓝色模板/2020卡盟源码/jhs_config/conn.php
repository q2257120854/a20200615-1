<?php
//echo '聚合社卡盟源码 ';
//echo '后台显示的安装时间就是本文件的最后修改时间';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
} 

global $dbhost;
global $dbuser;
global $dbpassword;
global $dbname;
$dbhost ='localhost'; 	//数据库地址
$dbuser = 'xxxxx';     	//数据库用户名
$dbpassword ='xxxxx';    //数据库密码
$dbname = 'xxxxx'; 		//数据库主机名

$conn1 = mysql_connect($dbhost,$dbuser, $dbpassword,true);
mysql_select_db($dbname, $conn1);
mysql_query("set names 'GBK'"); 


?>

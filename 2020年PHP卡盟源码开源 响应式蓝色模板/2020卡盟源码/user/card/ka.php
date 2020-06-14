<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>密保卡生成</title>
</head>
<body>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<?php include('../../jhs_config/function.php');?>
<?php
//密码卡
$m=secretCode();
//var_dump($m);
function secretCode($row=8,$col=10){
$width=$col*50+100;
$height=$row*20+100;
//生成画布，分配颜色
$img=imagecreate($width,$height);
$bg=imagecolorallocate($img,0x99,0x66,0x00);
$text=imagecolorallocate($img,0,0,0);

//生成编号
$src=bianhao();
imagestring($img,4,20,20,$src,$text);
imagettftext($img,18,0,250,30,$text,'hua.ttf','密码表');//输出标题
//生成x坐标编号
$string='ABCDEFGHIJ';

for($i=0;$i<$col;$i++){
$str=$string[$i];
$x=50+50*$i+25; 
$y=35;
imagechar($img,4,$x,$y,$str,$text);

}

//生成y坐标编号
for($i=0;$i<$row;$i++){
$x=38;
$y=53+$i*20;
imagechar($img,4,$x,$y,($i+1),$text);


}
//生成随机密码数组
$array_code=array();
while(count($array_code)<$col*$row){

$int1=mt_rand(0,9);

$int2=mt_rand(0,9);

$int3=mt_rand(0,9);

if($int1!=$int2 or $int2!=$int3 or $int3!=$int1){   

$code=strval($int1.$int2.$int3);
}
array_push($array_code,$code);  //密码压入数组中
array_unique($array_code);  //删除重复值,有bug最后一个数值不能做出判断
}



//循环输出密码表
for($i=0;$i<count($array_code);$i++){ 
$intx=$i%10;
if($i%10==0){
$inty=$i/10;
}
$x1=50+50*$intx;
$x2=50+50*($intx+1);
$x3=$x1+15;  
$y1=50+20*$inty;
$y2=50+20*($inty+1);
$y3=$y1+3;
imagerectangle($img,$x1,$y1,$x2,$y2,$text);//生成正方形框
imagestring($img,3,$x3,$y3,$array_code[$i],$text);//写入密码 
}
//生成图像输出
$yyy= uniqid("code_").'.png';
$_SESSION['mylo']=$yyy;  

imagepng($img,$yyy);
echo '<img src='.$yyy.'>'; #######输出图片
imagedestroy($img);

//把x和y一起循环组合在一起，作为数组的下标，以便取出使用

for($j=0;$j<$row;$j++){   //行循环
for($i=0;$i<$col;$i++){  //列循环


$key.=$string[$i].($j+1).'/';//string为标标
//// $string[$i].($j+1);      #####获取字母排序 比如A1  B1 

}
}
rtrim($key,'/');//处理字符串最后#,不起作用
$key=explode('/',$key);
array_pop($key);//清除空元素
$pwd=array_combine($key,$array_code);
$ClassID= implode(",",$pwd);
$allArray=(explode(',',$ClassID));   
 
for ($i = 0; $i <= 79; $i++) { 
$_SESSION['ch'.$i]=   $allArray[$i];
} 
}

#########读取密保卡资料 判断该用户是否绑定过密保卡

$total=mysql_num_rows(mysql_query("SELECT * FROM `Encrypted_card` where  username='$_SESSION[ysk_number]' ",$conn1));
if ($total!='0'){
########如果存在则替换之前的密保卡 并删除 之前密保卡图片
$sql="select * from Encrypted_card where username='$_SESSION[ysk_number]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
unlink($row['url']); //删除图片文件
 
$godo=mysql_query("update Encrypted_card set url='$_SESSION[mylo]',A1='$_SESSION[ch0]',B1='$_SESSION[ch1]',C1='$_SESSION[ch2]',D1='$_SESSION[ch3]',E1='$_SESSION[ch4]',F1='$_SESSION[ch5]',G1='$_SESSION[ch6]',H1='$_SESSION[ch7]',I1='$_SESSION[ch8]',J1='$_SESSION[ch9]',A2='$_SESSION[ch10]',B2='$_SESSION[ch11]',C2='$_SESSION[ch12]',D2='$_SESSION[ch13]',E2='$_SESSION[ch14]',F2='$_SESSION[ch15]',G2='$_SESSION[ch16]',H2='$_SESSION[ch17]',I2='$_SESSION[ch18]',J2='$_SESSION[ch19]',A3='$_SESSION[ch20]',B3='$_SESSION[ch21]',C3='$_SESSION[ch22]',D3='$_SESSION[ch23]',E3='$_SESSION[ch24]',F3='$_SESSION[ch25]',G3='$_SESSION[ch26]',H3='$_SESSION[ch27]',I3='$_SESSION[ch28]',J3='$_SESSION[ch29]',A4='$_SESSION[ch30]',B4='$_SESSION[ch31]',C4='$_SESSION[ch32]',D4='$_SESSION[ch33]',E4='$_SESSION[ch34]',F4='$_SESSION[ch35]',G4='$_SESSION[ch36]',H4='$_SESSION[ch37]',I4='$_SESSION[ch38]',J4='$_SESSION[ch39]',A5='$_SESSION[ch40]',B5='$_SESSION[ch41]',C5='$_SESSION[ch42]',D5='$_SESSION[ch43]',E5='$_SESSION[ch44]',F5='$_SESSION[ch45]',G5='$_SESSION[ch46]',H5='$_SESSION[ch47]',I5='$_SESSION[ch48]',J5='$_SESSION[ch49]',A6='$_SESSION[ch50]',B6='$_SESSION[ch51]',C6='$_SESSION[ch52]',D6='$_SESSION[ch53]',E6='$_SESSION[ch54]',F6='$_SESSION[ch55]',G6='$_SESSION[ch56]',H6='$_SESSION[ch57]',I6='$_SESSION[ch58]',J6='$_SESSION[ch59]',A7='$_SESSION[ch60]',B7='$_SESSION[ch61]',C7='$_SESSION[ch62]',D7='$_SESSION[ch63]',E7='$_SESSION[ch64]',F7='$_SESSION[ch65]',G7='$_SESSION[ch66]',H7='$_SESSION[ch67]',I7='$_SESSION[ch68]',J7='$_SESSION[ch69]',A8='$_SESSION[ch70]',B8='$_SESSION[ch71]',C8='$_SESSION[ch72]',D8='$_SESSION[ch73]',E8='$_SESSION[ch74]',F8='$_SESSION[ch75]',G8='$_SESSION[ch76]',H8='$_SESSION[ch77]',I8='$_SESSION[ch78]',J8='$_SESSION[ch79]'  where username='$_SESSION[ysk_number]'",$conn1); 

########如果不存在则更新一条数据
}else{
$mysql="insert into Encrypted_card (id,username,url,A1,B1,C1,D1,E1,F1,G1,H1,I1,J1,A2,B2,C2,D2,E2,F2,G2,H2,I2,J2,A3,B3,C3,D3,E3,F3,G3,H3,I3,J3,A4,B4,C4,D4,E4,F4,G4,H4,I4,J4,A5,B5,C5,D5,E5,F5,G5,H5,I5,J5,A6,B6,C6,D6,E6,F6,G6,H6,I6,J6,A7,B7,C7,D7,E7,F7,G7,H7,I7,J7,A8,B8,C8,D8,E8,F8,G8,H8,I8,J8,time) " . "values ('','$_SESSION[ysk_number]','$_SESSION[mylo]','$_SESSION[ch0]','$_SESSION[ch1]','$_SESSION[ch2]','$_SESSION[ch3]','$_SESSION[ch4]','$_SESSION[ch5]','$_SESSION[ch6]','$_SESSION[ch7]','$_SESSION[ch8]','$_SESSION[ch9]','$_SESSION[ch10]','$_SESSION[ch11]','$_SESSION[ch12]','$_SESSION[ch13]','$_SESSION[ch14]','$_SESSION[ch15]','$_SESSION[ch16]','$_SESSION[ch17]','$_SESSION[ch18]','$_SESSION[ch19]','$_SESSION[ch20]','$_SESSION[ch21]','$_SESSION[ch22]','$_SESSION[ch23]','$_SESSION[ch24]','$_SESSION[ch25]','$_SESSION[ch26]','$_SESSION[ch27]','$_SESSION[ch28]','$_SESSION[ch29]','$_SESSION[ch30]','$_SESSION[ch31]','$_SESSION[ch32]','$_SESSION[ch33]','$_SESSION[ch34]','$_SESSION[ch35]','$_SESSION[ch36]','$_SESSION[ch37]','$_SESSION[ch38]','$_SESSION[ch39]','$_SESSION[ch40]','$_SESSION[ch41]','$_SESSION[ch42]','$_SESSION[ch43]','$_SESSION[ch44]','$_SESSION[ch45]','$_SESSION[ch46]','$_SESSION[ch47]','$_SESSION[ch48]','$_SESSION[ch49]','$_SESSION[ch50]','$_SESSION[ch51]','$_SESSION[ch52]','$_SESSION[ch53]','$_SESSION[ch54]','$_SESSION[ch55]','$_SESSION[ch56]','$_SESSION[ch57]','$_SESSION[ch58]','$_SESSION[ch59]','$_SESSION[ch60]','$_SESSION[ch61]','$_SESSION[ch62]','$_SESSION[ch63]','$_SESSION[ch64]','$_SESSION[ch65]','$_SESSION[ch66]','$_SESSION[ch67]','$_SESSION[ch68]','$_SESSION[ch69]','$_SESSION[ch70]','$_SESSION[ch71]','$_SESSION[ch72]','$_SESSION[ch73]','$_SESSION[ch74]','$_SESSION[ch75]','$_SESSION[ch76]','$_SESSION[ch77]','$_SESSION[ch78]','$_SESSION[ch79]',now())";
}
mysql_query($mysql,$conn1);
mysql_query("update members set power2='1' where number='$_SESSION[ysk_number]'",$conn1); 
function bianhao(){
static $t=17754;
$t++;
}

echo "<br><center><b style='line-height:240%;'>请手动把密保卡图片另存下来，请谨慎保管以免丢失！</b><br><input id='btnAll' type='button' value='点击关闭!'  onClick='cl()' class='tijiao_input' /></center>";
?>

</body>
</Html>

<script>
function cl()
{ 
var win = art.dialog.open.origin;//来源页面
// 如果父页面重载或者关闭其子对话框全部会关闭
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
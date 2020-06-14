<?php
//echo '贪玩点卡智能建站·全开源卡盟系统 免费下载：www.kycard.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

function sorting($var,$var1,$var2,$var3,$var4){ //--类型  置顶置底Id  本身Id  子目录  上级编号
     if($var3==1){
$url='&mid=1';
}elseif($var3==2){
$url='&mid=2&nav='.$var4;
}
if ($var=='top'){
if ($var1==$var2){
echo "<a title='移动到最顶部' class='move top1'></a>";
}else{
echo "<a title='移动到最顶部' class='move top' href='?Action=move1&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////我是置顶
}elseif ($var=='up'){
if ($var1==$var2){
echo "<a title='往上移一行' class='move up1'></a>";
}else{
echo "<a title='往上移一行' class='move up' href='?Action=move2&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////我是上移一行
}elseif ($var=='down'){
if ($var1==$var2){
echo "<a title='往下移一行' class='move down1'></a>";
}else{
echo "<a title='往下移一行' class='move down' href='?Action=move3&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////我是下移一行
}elseif ($var=='bottom'){
if ($var1==$var2){
echo "<a title='往下移一行' class='move bottom1'></a>";
}else{
echo "<a title='往下移一行' class='move bottom' href='?Action=move4&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////我是下移一行
}

}
?>
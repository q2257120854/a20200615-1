
<?php
session_start();
include_once('conn.php');
include_once('520sfconn.php');
include_once('config.php');
include_once('yx_safe.php');
date_default_timezone_set('PRC');        ######设置时间为北京时间
$mytime=date("Y-m-d G:i:s");
$begtime=strtotime(date("Y-m-d G:i:s"));

////////////////////////////获取本地IP地址
function Local_Ip() {  
if($_SERVER['HTTP_CLIENT_IP']){  
$LocalIp=$_SERVER['HTTP_CLIENT_IP'];  
}elseif($_SERVER['HTTP_X_FORWARDED_FOR']){  
$LocalIp=$_SERVER['HTTP_X_FORWARDED_FOR'];  
}else{  
$LocalIp=$_SERVER['REMOTE_ADDR'];  
}  
return $LocalIp;  
}  
////////////////////////////获取本地IP地址 The End


if (strtotime($Exp_time)-$begtime=0) {
header('location:/404.php?error=401');
}elseif($Exp_sup_open=='1'){ 
header('location:/404.php?error=409');
}


function cnsubstr($str,$start,$len) { 
$strlen=$start+$len; 
for($i=0;$i<$strlen;$i++) { 
if(ord(substr($str,$i,1))>0xa0) { 
$tmpstr.=substr($str,$i,2); 
$i++; 
} 
else 
$tmpstr.=substr($str,$i,1); 
} 
return $tmpstr; 
} 
$dingdanhao = date("Y-m-dH-i-s");
$dingdanhao = str_replace("-","",$dingdanhao);
$dingdanhao .= rand(1000,2000);

function shanchu($str){
$str = trim($str);
$str = preg_replace('/\n/', '', $str);
$str = preg_replace('/\r/', '', $str);
return $str;
}

//定义验证座机号码的正则表达式
function gtel($gtel){
$check="/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$/";   
$bool=preg_match($check,$gtel,$counts); 
return $bool;
}

//定义验证手机号码的正则表达式
function mtel($mtel){
$check="/^13(\d{9})$|^15(\d{9})$|^189(\d{8})$/";        
$bool=preg_match($check,$mtel,$counts);    
return $bool;
}

//定义验证email的正则表达式
function email($email){
$check="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";    
$bool=preg_match($check,$email,$counts);
return $bool;
}



########################################### 自定义获取摄影分类
function yx_product_class($val){
global $conn1;
$mysql=mysql_query("select * from `product_class`  where NumberID='$val'",$conn1);
$row=mysql_fetch_array($mysql);
if  ($row['NumberID']!=''){
echo $row['7'];
}else{
}
}

function ysk_network($var){
$url='http://www.ip138.com/ips138.asp?ip='.$var.'&action=2';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
curl_close($ch);
preg_match('/本站主数据：(?<mess>(.*))市(.*)<\/li><li>/',$content,$arr);
if(strripos($arr['mess'],"省")>0)
return substr($arr['mess'],strripos($arr['mess'],"省")+2,100);
else
return $arr['mess'];
}
#########################################################################商品自定义内容

##########################商品时限
function ysk_overdue($var){
switch ($var) { 
case   "0": 
return $result="永久"; 
break; 
default: 
return $result=$var." 天"; 
break; 
}
}

##########################订单 按天退款
function Ysk_Single_back($var,$var1,$var2,$var3){    //过期时间  处理日期  退单日期 订单金额 
if ($var==0){
///////////////////////////////////永久性商品退全款
$price=$var3;
}else{
$time=$var2-$var1;
$days=$var-($time/86400); 
$price=($var3/$var)*$days;
if ($price>$var3){
$price=$var3;
}else{
$price=$price;
}

}
return $price;
}
##########################订单 按天退款日期
function Ysk_Single_days($var,$var1,$var2){    //过期时间  当前日期  退单日期 
if ($var==0){
$days=999;
}else{
$time=$var2-$var1;
$days=$var-($time/86400); 
}
return $days;
}
##########################商品状态
function ysk_state($var){
switch ($var) { 
case   "1": 
return $result="<font color=\"#1d1dff\">暂停</font>"; 
break; 
case   "2": 
return $result="<font color=\"red\">禁售</font>"; 
break;
case   "3": 
return $result="<font color=\"#009900\">禁售</font>"; 
break; 
case   "4": 
return $result="<font color=\"#666\" style=\"TEXT-DECORATION: line-through\">已下架</font>"; 
break; 
case   "-1": 
return $result="<font color=\"#009900\">SUP商品进价调高</font>"; 
break; 
case   "-2": 
return $result="<font color=\"#009900\">SUP商品进价调低</font>"; 
break; 
case   "-3": 
return $result="<font color=\"#009900\">进货商为黑名单</font>"; 
break; 
case   "-4": 
return $result="<font color=\"#009900\">SUP商品未上架</font>"; 
break; 
case   "-5": 
return $result="<font color=\"#009900\">SUP商品未通过审核</font>"; 
break;
case   "-6": 
return $result="<font color=\"#009900\">SUP商品为黑名单</font>"; 
break; 
case   "-7": 
return $result="<font color=\"#009900\">SUP商品已删除</font>"; 
break; 
default: 
return $result="<font color=\"#009900\">销售</font>"; 
break; 
}
}

##########################商品锁定
function ysk_locks($var,$var1){
switch ($var) { 
case   "0": 
return $result="<font color=\"#1d1dff\">待审核</font> - "; 
break; 
case   "1": 
return $result="<font color=\"red\">审核失败</font> - 原因：".$var1." - "; 
break;
default: 
return $result="<font color=\"#009900\">已审核</font> - "; 
break; 
}
}


##商品地区
class area{
function region($var,$var1){
if ($var=='全国'){
return "全国";	
}else{
return	$var.'-'.$var1;
}
}
}

//广告链接
function youxi_gg_url($id){
global $conn1;
$result=mysql_query("select * from advertising where id='$id'",$conn1);
$row=mysql_fetch_array($result);
return $row['url'];
mysql_free_result($result);
}

//广告图片地址
function youxi_gg_ad($id){
global $conn1;
$result=mysql_query("select * from advertising where id='$id'",$conn1);
$row=mysql_fetch_array($result);
return $row['address'];
mysql_free_result($result);
}


##########################自定义错误列表
function ysk_error($var,$var1){
switch ($var) { 
case   "401": 
echo "<script>alert('登录失败，错误原因：您没有输入账户或密码!');self.location=document.referrer;</script>";exit();
break; 
case   "402": 
echo "<script>alert('登录失败，错误原因：您的密码已多次输入错误,被锁定请联系客服人员解锁！');self.location=document.referrer;</script>";exit();
break;
case   "403": 
echo "<script>alert('登录失败，错误原因：您的帐号已经被禁用了！原因：$var1');self.location=document.referrer;</script>";exit();
break; 
case   "404": 
echo "<script>alert('登录失败，错误原因：违规冻结！$var1 小时后才可以登录！');self.location=document.referrer;</script>";exit();
break; 
case   "405": 
echo "<script>alert('登录失败，错误原因：密码错误，还剩 $var1 次将被锁定！');self.location=document.referrer;</script>";exit();
break; 
case   "406": 
return $error="购买失败，错误原因：该商品只面向 ".$var1." 地区用户！"; 
break; 
case   "407": 
echo "<script>alert('登录失败，错误原因：身为卖家违规，被禁止登录，解冻时间".$var1." ！');self.location=document.referrer;</script>";exit();
break; 
case   "409": 
echo "<script>alert('登录失败，错误原因：没有找到该用户呀!');self.location=document.referrer;</script>";exit();
break; 
default: 
return $error="登录成功！"; 
break; 
}
}

function ysk_buy_Sup($var,$var1,$var2,$var3){
if ($var!=0){
$var4=$var2*$var3;
if ($var1<$var4){
echo   "<center><br><br>购买失败，错误原因：SUP余额不足！</center>"; 
exit();
}
}
}

function ysk_buy_Price($var,$var1,$var2,$var3){//等级 售价 购价方式 购价金额
#先获取等级总数
global $conn1;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn1));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}


function ysk_buy_error($var){
switch ($var) { 
case   "1": 
echo   "<center><br><br>购买失败，错误原因：该商品已经暂停销售！</center>"; 
exit();
break; 
case   "2": 
echo   "<center><br><br>购买失败，错误原因：该商品已经禁止销售！</center>"; 
exit();
case   "-1": 
echo   "<center><br><br>购买失败，错误原因：商品价格异常！</center>"; 
exit();
case   "-2": 
echo   "<center><br><br>购买失败，错误原因：进货商为黑名单！</center>"; 
exit();
case   "-3": 
echo   "<center><br><br>购买失败，错误原因：该商品未上架！</center>"; 
exit();
case   "-4": 
echo   "<center><br><br>购买失败，错误原因：该商品未通过审核！</center>"; 
exit();
case   "-5": 
echo   "<center><br><br>购买失败，错误原因：该商品已删除！</center>"; 
exit();
case   "-6": 
echo   "<center><br><br>购买失败，错误原因：该商品已删除！</center>"; 
exit();
}
}

///////封装类

##订单类
class oo_order{
##库存查询
function yordeal($var){
if ($var==0){
return "<b style='color:#0000ff'>等待处理</b>";
}elseif($var==2){
return "<b style='color:#FF0000'>交易成功</b>";
}elseif($var==3){
return "<b style='color:#CCCCCC'>取消充值</b>";
}elseif($var==4){
return "<s style='color:#CCCCCC'>已经退单</s>";
}	
}
}

##积分类
class integral{
//////卖家积分
function seller_integral($num){
if($num==''){
return "0 分";
}elseif($num<'50'){
return $num." 分";
}elseif($num>='50' and $num<='200'){
return "<img src='/Public/images/credit/b1.gif' style='vertical-align:middle'>";
}elseif($num>='201' and $num<='1000'){
return "<img src='/Public/images/credit/b2.gif' style='vertical-align:middle'>";
}elseif($num>='1001' and $num<='5000'){
return "<img src='/Public/images/credit/b3.gif' style='vertical-align:middle'>";
}elseif($num>='5001' and $num<='10000'){
return "<img src='/Public/images/credit/b4.gif' style='vertical-align:middle'>";
}elseif($num>='10001' and $num<='20000'){
return "<img src='/Public/images/credit/b5.gif' style='vertical-align:middle'>";
}elseif($num>='20001' and $num<='40000'){
return "<img src='/Public/images/credit/b6.gif' style='vertical-align:middle'>";
}elseif($num>='40001' and $num<='80000'){
return "<img src='/Public/images/credit/b7.gif' style='vertical-align:middle'>";
}elseif($num>='80001' and $num<='160000'){
return "<img src='/Public/images/credit/b8.gif' style='vertical-align:middle'>";
}elseif($num>='160001' and $num<='260000'){
return "<img src='/Public/images/credit/b9.gif' style='vertical-align:middle'>";
}elseif($num>='260001' and $num<='700000'){
return "<img src='/Public/images/credit/b10.gif' style='vertical-align:middle'>";
}elseif($num>='700001' and $num<='1200000'){
return "<img src='/Public/images/credit/b11.gif' style='vertical-align:middle'>";
}elseif($num>='1200001' and $num<='2000000'){
return "<img src='/Public/images/credit/b12.gif' style='vertical-align:middle'>";
}elseif($num>='2000001' and $num<='5000000'){
return "<img src='/Public/images/credit/b13.gif' style='vertical-align:middle'>";
}elseif($num>='5000001' and $num<='10000000'){
return "<img src='/Public/images/credit/b14.gif' style='vertical-align:middle'>";
}elseif($num>='10000001'){
return "<img src='/Public/images/credit/b15.gif' style='vertical-align:middle'>";
}
}
//////买家积分
function Buyers_integral($num){
if($num==''){
return "0 分";
}elseif($num<'4'){
return $num."分";
}elseif($num>='4' and $num<='10'){
return "<img src='/Public/images/credit/m1.gif' style='vertical-align:middle'>";
}elseif($num>='11' and $num<='50'){
return "<img src='/Public/images/credit/m2.gif' style='vertical-align:middle'>";
}elseif($num>='51' and $num<='100'){
return "<img src='/Public/images/credit/m3.gif' style='vertical-align:middle'>";
}elseif($num>='101' and $num<='200'){
return "<img src='/Public/images/credit/m4.gif' style='vertical-align:middle'>";
}elseif($num>='201' and $num<='400'){
return "<img src='/Public/images/credit/m5.gif' style='vertical-align:middle'>";
}elseif($num>='401' and $num<='800'){
return "<img src='/Public/images/credit/m6.gif' style='vertical-align:middle'>";
}elseif($num>='801' and $num<='1600'){
return "<img src='/Public/images/credit/m7.gif' style='vertical-align:middle'>";
}elseif($num>='1601' and $num<='3200'){
return "<img src='/Public/images/credit/m8.gif' style='vertical-align:middle'>";
}elseif($num>='3201' and $num<='6400'){
return "<img src='/Public/images/credit/m9.gif' style='vertical-align:middle'>";
}elseif($num>='6401' and $num<='12800'){
return "<img src='/Public/images/credit/m10.gif' style='vertical-align:middle'>";
}elseif($num>='12801' and $num<='58000'){
return "<img src='/Public/images/credit/m11.gif' style='vertical-align:middle'>";
}elseif($num>='58001' and $num<='158000'){
return "<img src='/Public/images/credit/m12.gif' style='vertical-align:middle'>";
}elseif($num>='158001' and $num<='458000'){
return "<img src='/Public/images/credit/m13.gif' style='vertical-align:middle'>";
}elseif($num>='458001' and $num<='1580000'){
return "<img src='/Public/images/credit/m14.gif' style='vertical-align:middle'>";
}elseif($num>='1580001'){
return "<img src='/Public/images/credit/m15.gif' style='vertical-align:middle'>";
}
}
}

##商品类
class goods{
##库存查询
function inventory($var){
if($var<=0){
return "<span style='color:#ff0000'>缺货</span>";
}elseif($var>1){
return "<span style='color:#0000ff'>库存正常</span>";
}	
}


//买家 卖家  status的值  产品类型  matters的值  商品ID  库存 supid
function buy_button($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){
if ($var3=='卡密' || $var3=='卡密直充'  || $var3=='网盘'){
$varz="<button class='layui-btn layui-btn-xs layui-btn-danger'>购买卡密</button>";
}elseif ($var3=='选号'){
$varz="<button class='layui-btn layui-btn-xs layui-btn-warm'>选号购买</button>";
}elseif ($var3=='人工代充' ){
$varz="<button class='layui-btn layui-btn-xs layui-btn-normal'>立即充值</button>";
}else{
$varz="<button class='layui-btn layui-btn-xs layui-btn-normal'>官方直充</button>";
}
if ($var==$var1 && $var7==0){
return "自有商品";
}elseif($var6<=0){
return "<a href=\"#art1\" onClick=\"Javascript:return confirm('购买失败，该商品暂时缺货！');\">{$varz}</a>";
}elseif($var2!=0){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/product.php?id={$var5}&Action=a',{title:'信息说明',width: 800,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var4!=''){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/product.php?id={$var5}&Action=b',{title:'购买产品',width: 800,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var3=='卡密' || $var3=='卡密直充' || $var3=='网盘'){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy_km.php?id={$var5}',{title:'购买卡密产品',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var3=='选号'){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy_xh.php?id={$var5}',{title:'购买选号产品',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}else{
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy.php?id={$var5}',{title:'购买产品',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}
}


//买家 卖家  status的值  产品类型  matters的值  商品ID  库存 supid
function buy_home_button($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){

if ($var==$var1 && $var7==0){
return "onClick=\"Javascript:return confirm('购买失败，您不能购买自己的商品！');\"";
}elseif($var==''){
return "onClick=\"Javascript:return confirm('购买失败，该功能只对会员开放！');\"";
}elseif($var6<=0){
return "onClick=\"Javascript:return confirm('购买失败，该商品暂时缺货！');\"";
}elseif($var2!=0){
return "onClick=\"$.dialog.open('/user/product.php?id={$var5}&Action=a',{title:'信息说明',width: 800,lock:true,fixed:true});\"";
}elseif($var4!=''){
return "onClick=\"$.dialog.open('/user/product.php?id={$var5}&Action=b',{title:'购买产品',width: 800,lock:true,fixed:true});\"";
}elseif($var3=='卡密' || $var3=='卡密直充' || $var3=='网盘'){
return "onClick=\"$.dialog.open('/user/buy_km.php?id={$var5}',{title:'购买卡密产品',width:700,height:450,lock:true,fixed:true});\"";
}elseif($var3=='选号'){
return "onClick=\"$.dialog.open('/user/buy_xh.php?id={$var5}',{title:'购买选号产品',width:700,height:450,lock:true,fixed:true});\"";
}else{
return "onClick=\"$.dialog.open('/user/buy.php?id={$var5}',{title:'购买产品',width:700,height:450,lock:true,fixed:true});\"";
}
}
}

function ysk_buy_Api($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){## APi来源  操作  APIid  商品Id  购买单价 购买数量 订单号 充值类型
global $api_ofpay_u,$api_ofpay_p,$conn1,$conn2;
if ($var=='欧飞'){
if ($var1=='库存'){
$doc = new DOMDocument();
$doc->load( 'http://api2.ofpay.com/queryleftcardnum.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p.'&cardid='.$var2.'&version=6.0' );
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$innum = $book->getElementsByTagName( "innum" );
$innum = $innum->item(0)->nodeValue; 
}
if ($innum<=0){echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：库存不足！</center>"; exit();}
}elseif($var1=='购价'){
$doc = new DOMDocument();
$doc->load( 'http://api2.ofpay.com/querycardinfo.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p.'&cardid='.$var2.'&version=6.0');
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$inprice = $book->getElementsByTagName( "inprice" );
$inprice = $inprice->item(0)->nodeValue; 
}
$pro_result=mysql_query("select * from sup_product where id='$var3' and price<'$inprice'",$conn2);
$pro=mysql_fetch_array($pro_result);
$price=$pro['price2']-$pro['price'];  #####得到原有的利润
$xprice=$inprice+$price;              #####得到现有的利润
mysql_query("update sup_product set price='$inprice',price2='$xprice' where id='$pro[id]'",$conn2); 
if ($pro){echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：商品价格异常,请重新购买！</center>"; exit();}

}elseif($var1=='卡密'){
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$var2.$var5.$var6.$youxitime.'OFCARD'));
$post_data = array();
$post_data['cardid']        =$var2;                       ##商品的编码
$post_data['cardnum']       =$var5;                       ##购买数量
$post_data['sporder_id']    =$var6;                       ##订单编号
$post_data['sporder_time']  =$youxitime;                  ##订单时间
$post_data['md5_str']       =$of_md5_str;                 ##MD5加密
$post_data['version']       ='6.0';                       ##固定值
$url='http://api2.ofpay.com/order.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
$sxe = new SimpleXMLElement($result);
$sxe->asXML('kami/'.$var6.'.xml');
if(strstr($result,"账户金额不足")!=false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：404异常，请联系客服！</center>"; exit();
}elseif(strstr($result,"此商品暂不可用")!=false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：商品异常！</center>"; exit();
}
}elseif($var1=='话费' && $var7==1){
//---------------------------------------------------------------------------------------------------------------------------------手机判断是否可以充值
$mianzhi=$var4*$var5;
$handle = fopen ("http://api2.ofpay.com/telcheck.do?phoneno=$var6&price=$mianzhi&userid=$api_ofpay_u", "rb"); 
$contents = ""; 
while (!feof($handle)) { 
$contents.= fread($handle, 8192); 
} 
fclose($handle); 

if (strstr($contents,"成功")==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：商品已断货或者您的手机号码无法充值！</center>"; exit();
}//---------------------------------------------------------------------------------------------------------------手机判断是否可以充值 The End
}elseif($var1=='话费' && $var7==2){
//----------------------------------------------------------------------------------------------------------------固话判断是否可以话费充值
$mianzhi=$var4*$var5;
if ($var3=='电信'){$ovar3='1';}else{$ovar3='2';}
$handle = fopen ("http://api2.ofpay.com/fixtelquery.do?userid=$api_ofpay_u&userpws=$api_ofpay_p&teltype=$ovar3&phoneno=$var6&pervalue=$mianzhi&version=6.0", "rb"); 
$contents = ""; 
while (!feof($handle)) { 
$contents .= fread($handle, 8192); 
} 
fclose($handle); 
if (strstr($contents,"成功")==false ){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：商品已断货或者您的固话无法充值！</center>"; exit();
}//---------------------------------------------------------------------------------------------------------------固话判断是否可以话费充值 The End
}elseif($var1=='直充' && $var7==1){//---------------------------------------------------------------手机话费直充
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.'140101'.$mianzhi.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['cardid']        ='140101';                    ##快冲 慢充 快充：140101，慢充：170101(只支持移动)
$post_data['cardnum']       =$mianzhi;                    ##面值
$post_data['sporder_id']    =$var2;                       ##订单编号
$post_data['sporder_time']  =$youxitime;                  ##订单时间
$post_data['game_userid']   =$var6;                       ##手机号码
$post_data['md5_str']       =$of_md5_str;                 ##MD5加密
$post_data['ret_url']       =$caourl;                     ##返回页面
$post_data['version']       ='6.0';                       ##固定值
$url='http://api2.ofpay.com/onlineorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
if(strstr($result,"金额不足")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：404异常，请联系客服！</center>"; exit();
}

}elseif($var1=='直充' && $var7==2){//---------------------------------------------------------------固话话费直充
if ($var3=='电信'){$ovar3='1';}else{$ovar3='2';}
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$mianzhi.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['teltype']       =$ovar3;                      ##运营商 1、电信 2、联通
$post_data['cardnum']       =$mianzhi;                    ##面值
$post_data['sporder_id']    =$var2;                       ##订单编号
$post_data['sporder_time']  =$youxitime;                  ##订单时间
$post_data['game_userid']   =$var6;                       ##固话号码
$post_data['md5_str']       =$of_md5_str;                 ##MD5加密
$post_data['ret_url']       =$caourl;                     ##返回页面
$post_data['version']       ='6.0';                       ##固定值
$url='http://api2.ofpay.com/fixtelorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
if(strstr($result,"金额不足")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：404异常，请联系客服！</center>"; exit();
}
}elseif($var1=='直充' && $var7==3){//---------------------------------------------------------------游戏直充
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$var4.$var5.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['cardid']        =$var4;                           ##商品编号
$post_data['cardnum']       =$var5;                           ##数量
$post_data['sporder_id']    =$var2;                           ##订单编号
$post_data['sporder_time']  =$youxitime;                      ##订单时间
$post_data['game_userid']    =urlencode($var6);               ##游戏账户
$post_data['game_userpsw']   ='';      ##游戏密码
$post_data['game_area']      ='';      ##游戏大区
$post_data['game_srv']       ='';      ##游戏所在服务器组
$post_data['md5_str']       =$of_md5_str;                 ##MD5加密
$post_data['ret_url']       =$caourl;                     ##返回页面
$post_data['version']       ='6.0';                       ##固定值
$url='http://api2.ofpay.com/onlineorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
if(strstr($result,"金额不足")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：404异常，请联系客服！</center>"; exit();
}elseif(strstr($result,"缺少必需参数")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：缺少必需参数！</center>"; exit();
}elseif(strstr($result,"此商品暂不可用")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：此商品暂不可用！</center>"; exit();
}elseif(strstr($result,"MD5串验证错误")!==false){
echo "<center><br><br><br><br><br><br><br><br>购买失败，错误原因：MD5串验证错误！</center>"; exit();
}




}
##########################欧飞 The End
}	
}

function sortArray($array,$choice){
$values = array_values($array);//建立一个数字索引的数组
$ch=$choice==0?min:max;//参数$choice为0按从小到大排列，否则其他都默认为按从大到小
do {
$val = $ch($values);//找出最大或最小值
$key = array_search($val,$values);//取得最大值的键名
$result[$key] = $val;//将最大值存入新数组
unset($values[$key]);
}while (count($values)>0);
return $result;
}


/*********************************************************************
函数名称:encrypt
函数作用:加密解密字符串
使用方法:
加密     :encrypt('str','E','nowamagic');
解密     :encrypt('被加密过的字符串','D','nowamagic');
参数说明:
$string   :需要加密解密的字符串
$operation:判断是加密还是解密:E:加密   D:解密
$key      :加密的钥匙(密匙);
*********************************************************************/
function encrypt($string,$operation,$key='')
{
$key=md5($key);
$key_length=strlen($key);
$string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
$string_length=strlen($string);
$rndkey=$box=array();
$result='';
for($i=0;$i<=255;$i++)
{
$rndkey[$i]=ord($key[$i%$key_length]);
$box[$i]=$i;
}
for($j=$i=0;$i<256;$i++)
{
$j=($j+$box[$i]+$rndkey[$i])%256;
$tmp=$box[$i];
$box[$i]=$box[$j];
$box[$j]=$tmp;
}
for($a=$j=$i=0;$i<$string_length;$i++)
{
$a=($a+1)%256;
$j=($j+$box[$a])%256;
$tmp=$box[$a];
$box[$a]=$box[$j];
$box[$j]=$tmp;
$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
}
if($operation=='D')
{
if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
{
return substr($result,8);
}
else
{
return'';
}
}
else
{
return str_replace('=','',base64_encode($result));
}
}

//============================================登陆日记
function ysk_date_log($var,$var1,$var2,$var3=0){
global $conn1,$begtime;
$network=ysk_network(Local_Ip());
if ($network==''){
$network='-';
}else{
$network=$network;
}
$Local_Ip=Local_Ip();
mysql_query("insert into `diary` (type,username,content,begtime,youip,area,sid)"."values ('$var','$var1','$var2','$begtime','$Local_Ip','$network','$var3')",$conn1);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');?>


<form name="add" method="post" action="ghslist.php" >
<input id="ClassID" name="ClassID" type="hidden" value="">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
关键字输入：</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
查询条件：</td>
<td class="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">客户编号</option>
<option value="Store_title">店铺名称</option>
</select></td>
<td width="90%"><iframe frameborder=0 id=FrmRight name=right src="../product/Class.Php?NumberID=<?=$_SESSION['ClassIDkiki']?>" style="HEIGHT:30px; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 1"></iframe></td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="确认查询"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="6%" class="table_top">编号</td>
<td width="10%" class="table_top">店铺名称</td>
<td width="8%" class="table_top">余额</td>
<td width="8%" class="table_top">货款</td>
<td width="8%" class="table_top">冻结金额</td>
<td width="6%" class="table_top">账户状态</td>
<td width="7%" class="table_top">违规记录</td>
<?php if ($sup_credit_module=='0') {?>
<td width="6%" class="table_top">信誉</td>
<?php } ?>
<td width="8%" class="table_top">好评</td>
<td width="7%" class="table_top">中评</td>
<td width="8%" class="table_top">差评</td>
</tr>
<?php
if ($_POST[ClassID]!=''){
$_SESSION['ClassIDkiki']=$_POST[ClassID];    //存储会员号
}
$keyword=$_REQUEST['keyword'];    //搜索关键词
$keywords=$_REQUEST['keywords'];  //查询条件
$ClassID=$_REQUEST['ClassID'];    //查询栏目
$locks=$_REQUEST['locks'];        //是否禁止
$paixu=$_REQUEST['paixu'];        //排序类型
$abcd=$_REQUEST['abcd'];          //下级代理
$search="where 1=1  and number<>'' "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
if ($ClassID!='')  $search.=" and NumberID ='$ClassID'"; 
if ($locks!='')    $search.=" and locks ='$locks'"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from product_class  $search order by number asc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){
$result=mysql_query("select * from members where number='$row[number]'",$conn1);
$user=mysql_fetch_array($result);?>
<tr>
<td height="28"><?=$row['number']?></td>
<td><?=$row['Store_title']?></td>

<td><?=number_format($user['kuan'],3);?></td>
<td><?=number_format($user['goods_kuan'],3);?></td>
<td>
<a href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$user['id']?>&Action=frozen',{title:'冻结金额',width:500,height:280,lock:true, fixed:true});"><span style="color:#009933; text-decoration:underline"><?=number_format($user['frozen_kuan'],3);?></span>   </a></td>
<td>
<?php if ($user['locks']=='0') {?>
<a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$user['id']?>&Action=locks',{title:'账户状态',width:500,height:300,lock:true, fixed:true});"> <span style="color:#009933; text-decoration:underline">开通</span>  </a> 
<?php }else{?>     
<a  href="#art1" onclick="art.dialog.open('frozen.php?id=<?=$user['id']?>&Action=locks',{title:'账户状态',width:500,height:300,lock:true, fixed:true});"> <span style="color:#FF0000; text-decoration:underline">禁用</span> </a> 
<?php }?></td>
<td><?=$user['wg_rds2']?>次</td>
<?php if ($sup_credit_module=='0') {?>
<td><?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($user['praise1']-$user['praise3']))?>

</td>
<?php } ?>
<td><?=$user['praise1']?> 分</td>
<td><?=$user['praise2']?> 分</td>
<td><?=$user['praise3']?> 分</td>
</tr>
<?php
}
?>
</table>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>

</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
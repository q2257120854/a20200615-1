
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 复选元素 开始 -->
<script src="css/CheckBoxUtil.js" type="text/javascript"></script>
<!-- 复选元素 结束 -->
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$state=strip_tags($_GET['state']);
$keywords=strip_tags($_GET['keywords']);
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from complaints_feedback where   number='$_SESSION[ysk_number]' and id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}
?>

<?php if ($Action=='') {?>
<div class="ifra-right_con">
<h3 class="column-title">
			<b>投诉信息列表</b>
			<span class="col-t-g">
				<input id="btnAdd" type="button" value="提交投诉" onclick="window.location = 'AddComplain.php'"class="spl-btn">
			</span>
		</h3>

		<form name="saleForm" id="saleForm">
			<div class="capi-search">
				<dl>
					<dt>订单号</dt>
					<dd>
						<input type="tex">
					</dd>
				</dl>
				<dl>
					<dt>查询条件</dt>
		  			<dd>
		  				<select name="state">
							<option value="0">查询全部</option>
							<option value="1">尚未处理</option>
							<option value="2">已经受理</option>
							<option value="3">处理完成</option>
							<option value="4">无法处理</option>
						</select>
		  			</dd>
				</dl>
				<dl class="opear">
					<dt>
						<input name="nowPage" id="nowPage" value="1" type="hidden">
					</dt>
					<dd>
						<input id="btn_search_user" type="button" value="查询" class="btn1">
					</dd>
				</dl>
			</div>
		</form>
		<div id="paramBox" class="capi-tbl capital">
		
		
<form action="" method="post"  name="form1" >
<div id="paramBox" class="capi-tbl capital">

<table >
 <thead>
<tr>
<th width="10%">
选择</th>
<th width="20%">
投诉时间</th>
<th width="37%">
投诉主题</th>
<th width="20%">
订单号</th>
<th width="13%">
处理状态</th>
</tr>
</thead>
<?php


$search="where  number='$_SESSION[ysk_number]' "; 
if ($state!='')    $search.=" and audit = '$state' "; 
if ($keywords!='') $search.=" and orerno = '$keywords' "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `complaints_feedback`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from complaints_feedback $search order by time desc,id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
while ($row=mysql_fetch_array($zyc)){

?>
<tbody>
<tr class="trd">
<td><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row['id']?>"></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['title']?></td>
<td><?=$row['orerno']?></td>
<td><a href="?Action=edit&Id=<?=$row[id]?>">
<?php if      ($row['audit']=='0') {?>
<span class='complaint0'>尚未受理</span>
<?php }elseif ($row['audit']=='1') {?>
<span class='complaint1'>等待处理</span>
<?php }elseif ($row['audit']=='2') {?>
<span class='complaint2'>无法处理</span>
<?php }elseif ($row['audit']=='3') {?>
<span class='complaint3'>完成处理</span>
<?php }?>
</a></td>
</tr>

<?php } ?>
<tr>
<td align="left"><input type="button" value="全选" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="删除" onClick="Javascript:return confirm('确定要删除吗？');" class="x3_input" ></td>
<td colspan="4" align="left"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr> 

</table></form>

<?php }elseif($Action=='edit'){
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from complaints_feedback  where id='$Id' and number='$_SESSION[ysk_number]' ",$conn1);
$row=mysql_fetch_array($result);
if ($row['id']==''){
echo "<script>alert('操作失败，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
?>
<form action="?Action=editsave" method="post"  id="form1" name="form1">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="3" class="table1" style="margin: 0">
<tr>
<td class="table1_left">
投诉类型：
</td>
<td class="tdleft"><?=$row['type']?>
</td>
</tr>
<?php if ($row['orerno']!='') {?>
<tr><td class="table1_left">订 单 号：</td><td class="tdleft"><?=$row['orerno']?></td></tr>
<?php } ?>
<tr><td class="table1_left">投诉主题：</td><td class="tdleft"><?=$row['title']?></td></tr>
<tr><td class="table1_left">提交时间：</td><td class="tdleft"><?=date("Y-m-d G:i:s",$row['time'])?></td></tr>
<tr><td class="table1_left">历次提交时间：</td><td class="tdleft"><?=$row['content']?></td></tr>
<tr><td class="table1_left">受理状态：</td><td class="tdleft">
<?php if      ($row['audit']=='0') {?>
<span style="color:red">尚未受理</span>
<?php }elseif ($row['audit']=='1') {?>
<span style="color:red">等待处理</span>
<?php }elseif ($row['audit']=='2') {?>
<span style="color:red">无法处理</span>
<?php }elseif ($row['audit']=='3') {?>
<span style="color:red">完成处理</span>
<?php }?></td></tr>
<tr><td class="table1_left">回复内容：</td><td class="tdleft"><?=$row['reply']?></td></tr>
<?php if ($row['begtime']!=''){?>
<tr><td class="table1_left">处理时间：</td><td class="tdleft"><?=date("Y-m-d G:i:s",$row['begtime'])?></td></tr>
<?php } ?>
<tr>
<td class="table1_left">
新投诉内容：
</td>
<td class="tdleft">
<textarea name="txtNewComplaint" rows="2" cols="20" id="txtNewComplaint" class="input0"  style="width: 500px; height: 130px"></textarea>

</td>
</tr>
<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="Submit" value="重新提交"  class="tijiao_input" />
<input id="Button1" type="button" value="返回" class="fanhui_input" onClick="history.go(-1);" />
</td>
</tr>
</table>
</form>
</div>
<?php } ?>
<?php if ($Action=='editsave') {
$txtNewComplaint=strip_tags($_POST['txtNewComplaint']);
$Id=inject_check($_POST['Id']);
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
////---------------------验证是否开启文明评论
if ($sup_rules_module=='0'){
if ($nlegal_open=='0') {
if(preg_match("/$nlegal_b_3/i",$txtNewComplaint)){
mysql_query("insert into  `punishment_list`  set title='订单投诉出现敏感词语',number='$_SESSION[ysk_number]',deduct='$nlegal_b_2',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_b_2 where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('对不起，内容含有含有敏感字符不允许发布并扣掉 $nlegal_b_2 分！');self.location=document.referrer;</script>";
exit();
}
}
}
////---------------------验证是否开启文明评论 The End



$result=mysql_query("select * from complaints_feedback where id='$Id' and number='$_SESSION[ysk_number]'",$conn1);
$pro=mysql_fetch_array($result);

if ($pro['content']==''){ 
$content=$mytime.' ：'.$txtNewComplaint;
}else{
$content=$mytime.' ：'.$txtNewComplaint;
$content=$pro['content'].'<br>'.$content;
}

$result=mysql_query("select * from product_order where orderid='$pro[orerno]' and number='$_SESSION[ysk_number]'",$conn1);
$order=mysql_fetch_array($result);
if ($order['docking']!=0){
$sresult=mysql_query("select * from docking_platform where id='$order[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
}

if ($order['docking']!=0){
mysql_query("update `complaints_feedback`     set audit='0',content='$content',time='$begtime' where orerno='$pro[orerno]'",$conn3); 
}

if ($pro['sid']!=0){
mysql_query("update `sup_complaints_feedback`  set audit='0',content='$content',time='$begtime' where orerno='$pro[orerno]'",$conn2); 
}

mysql_query("update `complaints_feedback`  set audit='0',content='$content',time='$begtime' where id='$Id'",$conn1); 
echo "<script>alert('提交成功!');self.location=document.referrer;</script>";
exit();
}
?>
</div>
</body>
</Html>
<script>
function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>
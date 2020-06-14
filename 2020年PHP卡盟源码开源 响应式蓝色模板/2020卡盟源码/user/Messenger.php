
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>聚合社</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<link href="css/sms/style.css" rel="stylesheet" type="text/css" />
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<script src="css/jquery.form.js" type="text/javascript"></script>
<script src="css/CheckBoxUtil.js" type="text/javascript"></script>
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
include_once('../jhs_config/error.php');
$Action=$_REQUEST['Action'];
$yy=$_REQUEST['yy'];
////////批量删除
If ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from sms where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');self.location=document.referrer;</script>";
}

if ($Action=='readingsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$state=strip_tags(inject_check($_POST['state']));
$reply=strip_tags($_POST['reply']);
mysql_query("update sms set state='$state',reply='$reply'  where id='$_REQUEST[id]'",$conn1); 
echo "<script>alert('回复成功!');window.location='Messenger.php';</script>";
}


if ($Action=='Addsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$title=strip_tags($_POST['title']);             //短信标题
$username=strip_tags($_POST['username']);       //接收者
$content=strip_tags($_POST['content']);         //内容
$begtime=strip_tags($_POST['begtime']);         //时间
$allArray=(explode('|', $username));////用 explode 把 | 的内容隔开成数组
$online=$_POST['online'];           //发送类型
if ($online=='0'){
foreach($allArray as $value) { 
$total=mysql_num_rows(mysql_query("SELECT * FROM `members` where  number='$value' ",$conn1));
if ($total=='0'){
echo "<script>alert('对不起，没有找到 $value 编号的会员！');window.location='Messenger.php';</script>";
exit();
}
mysql_query("insert into `sms` (title,content,state,locks,username,sendname,begtime) " ."values ('$title','$content','0','0','$value','$_SESSION[ysk_number]','$begtime')",$conn1);
}
}else{
$result=mysql_query("select * from members where agent='$_SESSION[ysk_number]' ",$conn1);
while ($pro=mysql_fetch_array($result)){
mysql_query("insert into `sms` (title,content,state,locks,username,sendname,begtime) " ."values ('$title','$content','0','0','$pro[number]','$_SESSION[ysk_number]','$begtime')",$conn1);
}
}

echo "<script>alert('短信发送成功!');window.location='Messenger.php';</script>";
}
?>
<div class="ifra-right_con">
<h3 class="column-title">
			<b id="title">站内信</b>
			<span class="col-t-g">
				<input id="tab" value="1" type="hidden">
				<input onclick="window.location = '?Action=send'" tab="1" type="button" value="短信发送" class="notck_btn">
				<input onclick="window.location = 'Messenger.php?yy=0'" name="clickTitle" tab="1" type="button" value="收件箱" class="spl-btn">
				<input onclick="window.location = 'Messenger.php?yy=1'" name="clickTitle" tab="2" type="button" value="发件箱" class="spl-btn">
			</span>
		</h3>

<?php if ($Action=='') {?>


<form action="" method="post"  name="form1" >
<div id="inBoxShow" class="capi-tbl capital">
<table >
<thead>
<tr>
<th width="10%">状态</th>
<th width="16%">收到时间</th>
<th width="59%">短信标题</th>
<th width="15%">发送对象</th>
</tr>
</thead>
<?php
if ($yy!='1'){
$search="where  username='$_SESSION[ysk_number]' "; 
}else{
$search="where  sendname='$_SESSION[ysk_number]' "; 
}

$total=mysql_num_rows(mysql_query("SELECT * FROM `sms`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$result = mysql_query("SELECT * FROM sms $search order by begtime desc,id desc {$page->limit}", $conn1);
if ($total!='0'){
while ($row=mysql_fetch_array($result)){

?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td>
<?php if ($row['reply']!='') {?>
<a href="javascript:void(0);" target="right" style="color:blue;">已回复</a>
<?php }else if ($row['state']=='0') {?>
<a href="javascript:void(0);" target="right" style="color:red;">未阅读</a>
<?php }else if ($row['state']=='1') {?>
<a href="javascript:void(0);" target="right" style="color:green;">已阅读</a>
<?php } ?>
</td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td class="tdleft">
<a href="?Action=reading&id=<?=$row['id']?>&yy=<?=$yy?>"><?=$row['title']?></a></td>
<td><?=$row['sendname']?></td>
</tr>
<?php } }?>

<tr style="">
<td colspan="5">
<table cellspacing="0" cellpadding="0" width="100%">

<td width="87%">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?>	</td>
</tr>
</table>
</td>
</tr>
</table>
</form>

<?php }elseif ($Action=='reading'){
$sql1="select * from sms where id='$_REQUEST[id]'";   //读取数据表
$zyc1=mysql_query($sql1,$conn1);  //执行该SQl语句
$row1=mysql_fetch_array($zyc1);

if ($row1['sendname']!=$_SESSION['sup_number']) {
mysql_query("update sms set locks='0',state='1'  where id='$_REQUEST[id]'",$conn1); 
}
?>
<div class="self-run-con">
<form action="?Action=readingsave&id=<?=$_REQUEST['id']?>" method="post">
<input name="state" type="hidden" value="2" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style="margin-top:10px;">
<?php if ($row1['sendname']!=$_SESSION['sup_number']) {?>
<tr>
<td class="table1_left">发 信 人：</td>
<td class="tdleft"><?=$row1['sendname']?></td>
</tr>
<?php }else{?>

<tr>
<td class="table1_left">收 件 人：</td>
<td class="tdleft"><?=$row1['username']?></td>
</tr>
<?php }?>
<tr>
<td class="table1_left"> 短信标题：</td>
<td class="tdleft"><?=$row1['title']?></td>
</tr>
<tr>
<td class="table1_left">短信内容：</td>
<td class="tdleft">
<textarea name="MessageContent" rows="8" cols="70" readonly="readonly" id="MessageContent" class="input0" style="width: 500px; height: 130px"><?=$row1['content']?></textarea>
</td>
</tr>
<tr>
<td class="table1_left">
收到时间：</td>
<td class="tdleft">
<?=date("Y-m-d G:i:s",$row1['begtime'])?>
</td>
</tr>
<?php if ($row1['sendname']!=$_SESSION['sup_number']) {?>
<tr>
<p hidden><?=date("Y-m-d G:i:s",$row['begtime'])?></p>
<td class="table1_left">回复此信：</td>
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<td class="tdleft">
<textarea name="reply" rows="8" cols="70"  id="reply" class="input0" style="width: 500px; height: 130px"><?=$row1['reply']?></textarea>
</td>
</tr>
<?php }else{?>
<tr>
<td class="table1_left">对方回复：</td>
<td class="tdleft">
<?=$row1['reply']?>
</td>
</tr>
<?php }?>
<tr>
<td class="table1_left">&nbsp;

</td>
<td class="tdleft">
<?php if ($row1['sendname']!=$_SESSION['sup_number']) {?>
<input type="submit" name="btnSubmit" value="回复此信" id="btnSubmit" class="tijiao_input" />
<?php } ?>
<input id="Button1" type="button" value="返回" class="tijiao_input" onClick="history.go(-1);" />
</td>
</tr>
</table></div>
</form>
<?php }elseif ($Action=='send'){?>
<script type="text/javascript">
//<![CDATA[
var ss = 1;//当前显示的
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//隐藏上一个显示的
document.getElementById('form1_'+vv).style.display = '';//显示选择的.
ss = vv;
}
//]]>
</script>
<form name="add" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="ifra-right_con">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<div class="self-run-con">
			<form id="sendMessForm" name="sendMessForm" action="doSendMes.htm" method="post">
				<dl>
					<dt>短信接收人类型：</dt>
					<dd>
						<select name="online" id="online" onChange="switchView1(this.value)">   
<option selected="selected" value="0">指定用户</option>
</select>
					</dd>
				</dl>
				<dl id="mess_senduser" >
					<dt>客户编号：</dt>
					<dd><input type="text" name="username" id="username" value="" style="width:200px;">&nbsp;多个客户请编号中间用 | 隔开</dd>
				</dl>
				<dl>
					<dt>短信主题：</dt>
					<dd><input type="text" name="title" id="title" style="width:400px;"><span></span></dd>
				</dl>
				<dl class="se-g-intro">
					<dt>短信内容：</dt>
					<dd><textarea style="width:400px;height:100px;" name="content" id="content"></textarea><span></span></dd>
				</dl>
				<dl class="save-return">
					<input type="submit" id="btnSubmit" class="save-btn" value="确认发送">
					<input type="button" class="return-btn" value="返回列表" onclick="javascript:history.go(-1);">
				</dl>
			</form>
		</div>


<?php } ?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
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

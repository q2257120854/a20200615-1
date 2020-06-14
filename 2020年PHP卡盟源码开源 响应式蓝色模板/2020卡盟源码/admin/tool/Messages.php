<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
$send=strip_tags($_GET['send']);   //发送/接收
$state=strip_tags($_GET['state']); //阅读状态
$begtime=$_POST['begtime'];       //发送时间
if ($Action=="Addsave") {
$online=strip_tags($_POST['online']);       //发送类型
$title=strip_tags($_POST['title']);        //短信标题
$lock=strip_tags($_POST['lock']);         //是否强制查看
$username=strip_tags($_POST['username']);//接收者
$username1=strip_tags($_POST['username1']);
$content=strip_tags($_POST['content']); //内容
$sendname='平台管理员';             //发送者

ysk_date_log(6,$_SESSION['ysk_username'],'新增了一条 "'.$title.'" 的站内消息');

if ($title==''){
echo "<script language=\"javascript\">alert('对不起，信息主题不能为空！');history.go(-1);</script>";
exit();
}
if ($content==''){
echo "<script language=\"javascript\">alert('对不起，信息描述不能为空！');history.go(-1);</script>";
exit();
}

$allArray=(explode('|',$username));
if     ($online=='0'){
foreach($allArray as $value){ 
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$value',sendname='$sendname',begtime='$begtime'",$conn1);
}
}elseif ($online=='1'){
$result=mysql_query("select * from members where level='$username1'",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$user[number]',sendname='$sendname',begtime='$begtime'",$conn1);
}
}
}elseif ($online=='2'){
$result=mysql_query("select * from members ",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$user[number]',sendname='$sendname',begtime='$begtime'",$conn1);

}
}
}
echo "<script>alert('发送成功!');self.location=document.referrer;</script>";
}



////////删除单记录
if ($Action=="del") {
ysk_date_log(6,$_SESSION['ysk_username'],'删除了一条站内消息');
mysql_query("delete from sms where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('删除成功!');window.location='Messages.php';</script>";
}

////////批量删除
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
ysk_date_log(6,$_SESSION['ysk_username'],'删除了一些站内消息');
mysql_query("delete from sms where id in ($ID_Dele)",$conn1);
echo "<script>alert('删除成功!');window.location='Messages.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>

<link rel="stylesheet" href="../css/layui.css" media="all">
<link rel="stylesheet" href="../css/admin.css" media="all">
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">短信管理中心 - Powered by <a href="http://www.juheshe.cn" target="_blank">聚合社</a></div>
	   <div class="layui-card-body" style="padding: 15px;">
<div style="padding-bottom: 10px;">
		  <input type="button" value="全选" onClick="CheckAll()" class="layui-btn layui-btn-sm" /><input type="submit" name="Del" id="Del" value="删除" onclick="test()" class="layui-btn layui-btn-danger layui-btn-sm" > 
&nbsp;  &nbsp;
<a href="messages.php?send=1" class="layui-btn layui-btn-sm layui-btn-normal">收件箱</a>
<a href="messages.php?send=2" class="layui-btn layui-btn-sm layui-btn-normal">发件箱</a>&nbsp;  &nbsp; &nbsp;  &nbsp;  <a href="?Action=add" class="layui-btn layui-btn-sm layui-btn-normal">推送短信</a>
	<br/>	
	<br/>
<?php if($Action==""){?>
<form name="form1" method="post" action="">
<table class="layui-table admin-table">
<div class="layui-table-header"><thead>
                <tr>
                    <th width="50px" style="text-align:center">选择</th>
					<th width="60px" style="text-align:center">状态</th>
                    <th width="80px" style="text-align:center">发送人</th>
                    <th width="200px" style="text-align:center">收件人</th>
                    <th width="600px" style="text-align:center">短信标题</th>
                    <th width="200px" style="text-align:center">发送时间</th>
                    <th width="210px" style="text-align:center">操作</th>
                </tr>
            </thead>
			</div></div>
<?php
$search="where 1=1 "; 
if ($send!='' and $send=='1') $search.=" and username='平台管理员'"; 
if ($send!='' and $send!='1') $search.=" and sendname='平台管理员'"; 
if ($state!='') $search.=" and state = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `sms`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$zyc=mysql_query("SELECT * FROM `sms` $search  order by begtime desc,id desc  {$page->limit}",$conn1); 
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="center"><?php if ($row['reply']!='') {?>
<button class="layui-btn layui-btn-normal layui-btn-xs">已复</button>
<?php }else if ($row['state']=='0') {?>
<button class="layui-btn layui-btn-danger layui-btn-xs">未读</button>
<?php }else if ($row['state']=='1') {?>
<button class="layui-btn layui-btn-primary layui-btn-xs">已读</button>
<?php } ?>
</td>
<td align="center"><?=$row['sendname']?></td>
<td align="center"><?=$row['username']?></td>
<td align="center"><?=$row['title']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>" class="layui-btn layui-btn-xs layui-btn-normal">查看</a> <a href="?Action=del&Id=<?=$row[id]?>" class="layui-btn layui-btn-xs layui-btn-danger" onclick="Javascript:return confirm('确定要删除吗？');">删除</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="83%"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td>
</tr>
</table>
</form>

<?php }elseif($Action=="add"){  ?>
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
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">信息添加</td>
</tr>
<tr>
<td width="10%" class="td_left"> 接收人类型：</td>
<td width="90%" class="left">	  <select name="online" id="online" onchange="switchView1(this.value)">   
<option selected="selected" value="">请选择</option>
<option value="2">全部用户</option>
<option value="0">指定用户</option>
<option value="1">指定级别</option>

</select>   </td>
</tr>

        
            
<tr  id="form1_0"  style="display:none">   
<td width="10%" class="td_left">  接收人：</td>
<td width="90%" class="left"><input name="username" type="text" id="username" style="width:362px;" class="biankuan" />  多个客户请编号中间用 | 隔开  </td>
</tr>
				
<tr  id="form1_1"  style="display:none">   
<td width="10%" class="td_left"> 
接收人：</td>
<td width="90%" class="left">  <select name="username1" id="username1">  
<option  value="" selected="selected">请选择</option> 
<?php
$result=mysql_query("select * from level order by id desc",$conn1);
if ($result){
while($level=mysql_fetch_array($result)){?>
<option value="<?=$level['id']?>"><?=$level['title']?></option>
<?php 
}
}?>  </select></td>
      </tr>
            
<tr>
<td width="10%" class="td_left">信息主题：</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<input name="begtime" readonly="readonly" type="hidden"  value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<tr>
<td width="10%" class="td_left">信息内容：</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" class="biankuan" id="content"></textarea></td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="确认添加"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from sms where id='$_REQUEST[Id]'";   //读取数据表
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_fetch_array($zyc);
?>

<table cellspacing="1" cellpadding="2" class="page_table4" style="margin: 0">
<tr>
<td class="td_left">发 信 人：</td>
<td class="left"><?=$row['sendname']?></td>
</tr>
<tr>
<td class="td_left"> 短信标题：</td>
<td class="left"><?=$row['title']?></td>
</tr>
<tr>
<td class="td_left">短信内容：</td>
<td class="left"><?=$row['content']?>
</td>
</tr>
<tr>
<td class="td_left">
收到时间：</td>
<td class="left"><?=date("Y-m-d G:i:s",$row['begtime'])?>
</td>
</tr>
<tr>
<td class="td_left">对方回复：</td>
<td class="left"><?=$row['reply']?>
</td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input id="Button1" type="button" value="返回" class="tijiao_input" onclick="history.go(-1);" />
</td>
</tr>
</table>
<?php } ?>
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
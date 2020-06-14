
<link href="../images/index.css" type=text/css rel=stylesheet>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
?>
<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="middle"> 
<?php 
$NumberIDStr=$_REQUEST['NumberID'];
$orz1="select * from product_class  where LagID=0 order by Classorder asc";   //读取数据表
$Rss1=mysql_query($orz1,$conn1);                  //执行该SQl语句
$num=mysql_num_rows($Rss1);
$NumberID1 = substr ("$NumberIDStr", 0,4);    //截取代码从第1位置开始截取3个， PHP中 0代表初始的位置
if($num!=0){     

?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>请选择分类...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID1==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php } 
?>


<?php 
$orz1="select * from product_class  where PartID='$NumberID1' order by Classorder asc";   //读取数据表
$Rss1=mysql_query($orz1,$conn1);                     //执行该SQl语句
$num=mysql_num_rows($Rss1);
$NumberID2 = substr ("$NumberIDStr", 0,7);    //截取代码从第1位置开始截取3个， PHP中 0代表初始的位置
if($num!=0){ ?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>请选择分类...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID2==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php }?>

<?php 
$len=strlen($NumberIDStr);
if ($len>=7) {?>
<?php 
$orz1="select * from product_class  where PartID='$NumberID2' order by Classorder asc";   //读取数据表
$Rss1=mysql_query($orz1,$conn1);                  //执行该SQl语句
$num=mysql_num_rows($Rss1);
$NumberID3 = substr ("$NumberIDStr", 0,10);    //截取代码从第1位置开始截取3个， PHP中 0代表初始的位置
if($num!=0){ ?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>请选择分类...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID3==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php } 
}
mysql_close(); 
?>

</td>
</tr>
</table>

<script language="JavaScript">
var id = '<?=$NumberIDStr?>';
//window.parent.document.myform.Class.value = id;			
window.parent.document.getElementById("ClassID").value=id;

</script>


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>账户资金明细</title>
		<link href="css/css.css" rel="stylesheet" type="text/css">
	
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<link href="images/right.css" rel="stylesheet" type="text/css" />
		<!--[if IE]>
		<script src="js/html5.js"></script>
		<![endif]-->

<!-- 弹窗元素 开始 -->
<link rel="stylesheet" href="css/cool.css?4.1.6"><script type="text/javascript" src="css/jquery.artDialog.js"></script>
<!-- 弹窗元素 结束 -->
</head>

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>
<div class="i-trend">
    <div class="content ui-switchable">
 
  <div class="body ui-switchable-content">
    
    <div class="panel fn-hide consume ui-switchable-panel" style="display: block;">
     
<div class="record-recent ui-box">
<form action="accountMoneyHistory.php" method="get">
    <div class="ui-box-title">
        <div class="ui-box-title-border sl-linear">
		
		<table style="width: 100%;">
		<tbody>
		
			<td colspan="2">
				<h3 style="margin-top: 5px;">查询时段：</h3>
			

<span style="display: inline-block;vertical-align: middle;">
<?php include_once('../jhs_config/time.php');?>
   
	</span>
       
        </td>
		</tbody>
		</table>
		<div class="chaxun-go">
                <input type="submit" name="btnQuery" value="查  询" id="btnQuery" class="input_d" />
               
                <input type="submit" name="btnImport" value="导出记录" id="btnImport" class="input_d">
                
            </div>

        </div>
    </div>
	</form>
	
	
	
    
</div><div style="margin-top: 10px;"></div>
</div>
</div>

    
  </div>

</div>

<table class="table2" cellspacing="1" cellpadding="0" border="0" id="gvNews" style="color:#333333;width:100%;border: 1px solid #e1e1e1;">
                <tbody><tr class="tr1">
                    <th width="17%">
                        交易日期</th>
                    <th width="20%">
                        交易类型</th>
                    <th width="11%">
                        收入(<?=$moneytype?>)</th>
                    <th width="11%">
                        支出<?=$moneytype?></th>
                    <th width="13%">
                        变化前<?=$moneytype?></th>
                    <th width="13%">
                        变化后<?=$moneytype?></th>
                   <!-- <th width="10%">
                        账号对象</th>
                    <th width="5%">
                        详细</th>-->
                </tr>
                
                    <?php
$search="where number='$_SESSION[ysk_number]' and title!='单号退款'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `details_funds`  $search",$conn1));  //查询总记录！
$num="30";
$page=new page($total,$num);
$sql="select * from details_funds  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //执行该SQl语句
$row=mysql_num_rows($zyc);
if($row == 0){
?>
<tr>
<td colspan="6">
<div class="ui-box-container" style="display:;">

<style type="text/css" media="screen">
	.ui-poptip .ui-poptip-box{
		min-height: 25px;
	}
</style>
<div id="searchResultTip">
	<div class="have-no-result fn-clear">
		<div class="module-myrecord-msg fn-clear">
			<div class="fn-left">
				<p class="module-myrecord-msg-txt">您最近没有交易记录</p>
			</div>
		</div>
	</div>
</div>
    </div>
	</td>
	<tr>
<?php 
} ?><?php
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#CCCCCC';" onMouseOut="this.style.backgroundColor='';" style=" text-align:center;  ">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td >
<?php
$tmparray=count(explode("下级",$row['title']));
$tmparray1=count(explode("财付通充值",$row['title']));
$tmparray2=count(explode("支付宝充值",$row['title']));
$tmparray3=count(explode("购买域名备案",$row['title']));
$tmparray4=count(explode("购买域名",$row['title']));
if ($tmparray>1 || $tmparray1>1 || $tmparray2>1 || $tmparray3>1  || $tmparray4>1){?>
<?=$row['orderid']?>
<?php }else{?>
<a  href="#art1" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>', {title:'订单详细信息',width:800,lock:true,fixed:true});"><?=$row['orderid']?></a>
<?php }?>

<?=$row['title']?></td> 
<td><?=number_format($row['incomes'],3)?> <?=$moneytype?></td>
<td><?=number_format($row['spendings'],3)?> <?=$moneytype?></td>
<td><?=number_format($row['befores'],3)?> <?=$moneytype?></td>
<td><?=number_format($row['afters'],3)?> <?=$moneytype?></td>
 
</tr>
<?php
$incomes=$incomes+$row['incomes'];
$spendings=$spendings+ $row['spendings'];
}?>

 

<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right" style="text-align:right">本页合计：</td>
  <td><b style="color:red"><?=number_format($incomes,3)?><?=$moneytype?></b></td>
  <td height="24" align="center" ><b style="color:red"><?=number_format($spendings,3)?><?=$moneytype?></b></td>
    

  <td height="24" align="right" style="text-align:right">&nbsp;</td>
  <td style="color:red">&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right"  style="text-align:right">总共合计：</td>
  <td><?php
$res=mysql_query("SELECT sum(incomes)    FROM `details_funds`  $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?><?=$moneytype?></b></td>
  <td align="center"><?php
$res1=mysql_query("SELECT sum(spendings) FROM `details_funds`  $search   ",$conn1);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?><?=$moneytype?></b></td>
  <td align="right">&nbsp;</td>
  <td style="color:red">&nbsp;</td>
</tr>

            </tbody></table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px; padding-right:50px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>

<div class="ui-box-container" style="display:none;">

<style type="text/css" media="screen">
	.ui-poptip .ui-poptip-box{
		min-height: 25px;
	}
</style>
<div id="searchResultTip">
	<div class="have-no-result fn-clear">
		<div class="module-myrecord-msg fn-clear">
			<img src="css/images/baby.jpg" alt="没有交易记录" class="fn-left">
			<div class="fn-left">
				<p class="module-myrecord-msg-txt">您最近没有交易记录</p>
				<a target="_blank" href="" title="查看所有交易记录" class="module-myrecord-msg-link" seed="i-record-more">查看所有交易记录 &gt;&gt;</a>
			</div>
		</div>
	</div>
</div>
    </div>
	
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
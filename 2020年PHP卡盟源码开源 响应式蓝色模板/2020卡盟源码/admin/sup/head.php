<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
$y=$_REQUEST['y'];
?>
<div class="qie2">
<ul>
<li><a href="../right.php">SUP首页</a></li>
<li <?php if ($y=='1') {?>class="on"<?php } ?>><a href="CategoryList.php?y=1&NumberID=H001">目录列表</a></li>
<li <?php if ($y=='3') {?>class="on"<?php } ?>><a href="InventoryQuery.php?y=3">对接中</a></li>
<li <?php if ($y=='4') {?>class="on"<?php } ?>><a href="DHandleSave.php">充值中</a></li>
<li <?php if ($y=='5') {?>class="on"<?php } ?>><a href="InventoryQuery1.php?y=5">异常管理</a></li>
<li class="right">
<div class="sousuo">
<form action="search.php" method="post">
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="78%" align="right" ></td>
<td width="16%" align="right"><input id="keywords" name="keywords" class="ss2" type="text" maxlength="20" /></td>
<td width="6%" align="left"><input type="image" src="images/go.jpg"  ></td>
</tr>
</table>
</form>
</div>
</li>
</ul>
</div>
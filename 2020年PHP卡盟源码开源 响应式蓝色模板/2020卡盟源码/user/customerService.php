<html><head>
<meta http-equiv="Content-Type" content="text/html;">
<!-- jQuery元素 开始 -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="css/customerService.css" rel="stylesheet" type="text/css">
<!-- 基本元素 结束 -->

<title>聚合社</title>
</head>
<?php 
include_once('../jhs_config/function.php');
?>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>联系客服</b>
		</h3>
		<div class="self-run-con">
			<dl>
				<dt>客服电话：</dt>
				<dd><?=$phoe1?></dd>
			</dl>
			<dl>
				<dt>业务电话：</dt>
				<dd><?=$phoe2?></dd>
			</dl>
			<dl>
				<dt>加款电话：</dt>
				<dd><?=$phoe3?></dd>
			</dl>
			<dl>
				<dt>业务QQ：</dt>
				<dd>
					
                 		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$qq1?>&amp;site=qq&amp;menu=yes" title=""><img src="http://wpa.qq.com/pa?p=2:<?=$qq1?>:41" border="0" title="联系官方客服" alt="联系官方客服"></a>
                  	
				</dd>
			</dl>
			<dl>
				<dt>加款QQ：</dt>
				<dd>
					
                 		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$qq2?>&amp;site=qq&amp;menu=yes" title=""><img src="http://wpa.qq.com/pa?p=2:<?=$qq2?>:41" border="0" title="联系官方客服" alt="联系官方客服"></a>
                  	
				</dd>
			</dl>
			<dl>
				<dt>投诉QQ：</dt>
				<dd>
					
                 		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$qq3?>&amp;site=qq&amp;menu=yes" title=""><img src="http://wpa.qq.com/pa?p=2:<?=$qq3?>:41" border="0" title="联系官方客服" alt="联系官方客服"></a>
                  	
				</dd>
			</dl>
			<dl>
				<dt>联系地址：</dt>
				<dd><?=$address?></dd>
			</dl>
		</div>
	</div>
  

</body></Html>
<div class="navBox">
				<div class="logo left">
					<img src="<?=$site_logo?>" alt="" draggable="false">
				</div>
				<div class="navBox_right right">
					<ul class="nav left">
						
												<li class="left"><a href="/" >网站首页</a></li>
												<?php if ($site_menu!='') {
$allArray=(explode("\n",$site_menu));    ////用 explode 把 回车 的内容隔开成数组
foreach($allArray as $value) 
{
$allArray1=(explode('，',$value));       ////用 explode 把 ， 的内容隔开成数组
?>
<li class="left"><a href="<?=$allArray1[1]?>" target="_blank"><?=$allArray1[0]?></a></li>
<?php
} 
} ?>
											</ul>
					<a class="btn_common login left active" href="/reg.php">注册</a>
				</div>
			</div>
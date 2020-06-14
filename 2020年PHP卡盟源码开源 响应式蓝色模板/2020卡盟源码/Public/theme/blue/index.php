<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$site_name?>-<?=$site_title?> - Powered by 聚合社</title>
<meta content="<?=$site_keywords?>" name="keywords">
<meta content="<?=$site_describe?>" name="description">
<link rel="stylesheet" type="text/css" href="/templatecss/blue/HcJane.css" />
<link href="/templatecss/blue/global.css" rel="stylesheet" type="text/css" />
<link href="/templatecss/blue/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/templatecss/blue/jquery.js"></script>
<script type="text/javascript" src="/templatecss/blue/Hcjane.js"></script>
<script type="text/javascript" src="/templatecss/blue/reg.js"></script>
</head>
<body id="nav_btn01">
   <?php include('head.php');?>
<link href="/templatecss/blue/login.css" rel="stylesheet" type="text/css" />
<div class="banner_bj">
    <div class="banner_bj_c">
        <div class="banner_c">
	<script type="text/javascript" src="/Public/theme/003/js/jquery.1.7.2.min.js" ></script>
	<script type="text/javascript" src="/Public/theme/003/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/Public/theme/003/js/jquery.yx_rotaion.js"></script>
            <div class="tab h_flash">
			<?php
$Rss="SELECT * FROM shuffling  where menu='首页大图' order by begtime desc,id desc limit 0,9 ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
                <ul>
                    <li style="display:list-item;"><a href='<?=$Orzx['url']?>' target='_blank'><img src='<?=$Orzx['address']?>' width='705' height='270' /></a></li> 
<?php
}
}?>		</ul>		
            </div>
   
				<div class="h_login">
                    <div class="login-wrap">
                        <div class="login-top">
                            <div class="input-wrap">
				<form action="/login_check.php" method="post" >
							<input name="Token" type="hidden" value="<?=genToken()?>">
                        <dl class="clear_div h_login">
                           <input class="login-username" type="text" placeholder="请输入邮箱" name="username"
                                    id="userlogin" />
                            </div>
                            <div class="input-wrap">
                                <input class="login-password" type="password" value="" placeholder="请输入密码" name="password"
                                    id="passlogin" />
                            </div>
                            <div class="input-wrap login-btn">
                                <button type="submit"  class="login_btn1 logins" tabindex="3" id="inside">立即登录</button>
									
									
                                <ul class="clear">
									<a href="/reg.php"><li>立即注册</li></a>
                                </ul>
                            </div>
                        </div>
                    </div>

            
                <!--end标签内容-->
            </div>
            <!--end登录-->
        </div>
        <!--end动画和登录-->
    </div>
    <!--end蓝色背景中-->
</div>
<div id="box" style="display: none;">
</div>
<!-- 验证弹出层 end -->
<!--end蓝色背景-->
<div class="clear_div h_center">
    <div class="clear_div h_one">
        <!-- 左 -->
        <div class="">
            <div class="">
                <dl class="blue_th">
                    <dd class="th">
                        平台动态
                    </dd>
                    <dt>
                        <a href="/news.php" class="china">更多 &gt;&gt;</a>
                    </dt>
                </dl>

                <div class="blue_border">
	
                    <ul class="clear_div h_ann">
											<?php
$result=mysql_query("select * from  article  where menu='平台公告' and hiddens<>'0' order by begtime desc,id desc limit 0,8 ",$conn1);
while($row=mysql_fetch_array($result)){ 
?>
                        <li title="<?=$row['title']?>"><span class="date"><?=date("Y-m-d",$row['begtime'])?></span><a style="color:<?=$row['color']?>;" href="Info.php?id=<?=$row['id']?>"><?=$row['title']?></a></li>
				<?php
}
?>					</ul>
                </div>
                <!--end边框-->
            </div>

                   
                <div class="clear_div h_contact">
                    <dl class="blue_th">
                        <dd class="th">
                            联系方式
                        </dd>
                    </dl>

                    <div class="blue_border">
                        <ul class="clear_div th h_contact">
                            <li>
                                <dl>
                                    <dt>
                                        <img src="/templatecss/blue/qq.png" alt="在线咨询时间" width="31" height="31">
                                    </dt> <dd>
                                          客服QQ:<span class="tel"><?=$qq1?></span>
                                        <p>业务QQ:<span class="tel"><?=$qq2?></span></p>
                                        <p>加款QQ:<span class="tel"><?=$qq3?></span></p>
                                    </dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>
                                        <img src="/templatecss/blue/tel.png" alt="电话" width="31" height="31">
                                    </dt>
                                    <dd>
                                        客服电话:<span class="tel"><?=$phoe1?></span>
                                        <p>业务客服:<span class="tel"><?=$phoe2?></span></p>
                                        <p>加款客服:<span class="tel"><?=$phoe3?></span></p>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--end边框-->
                </div>
                <!--end联系我们-->
            </div>
        </div>

      

    <script type="text/javascript" src="/templatecss/blue/global.js"></script>
    <script src="/templatecss/blue/browsercompatible.js" type="text/javascript"></script>
    <script src="/templatecss/blue/jquery-webox.js" type="text/javascript"></script>

    <dl class="h_link_th">
        <dd class="th">
            友情链接
        </dd>
    </dl>
    <ul class="clear_div h_link">
        <?php
$Rss="SELECT * FROM bobo_links  order by begtime desc,id desc limit 0,16 ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
        <li><a target="_blank" href="<?=$Orzx['url']?>" rel="nofollow"><?=$Orzx['title']?></a></li>				<?php
}
}?>   </ul>
</div>
<?php include('foot.php');?>

</body>
</html>
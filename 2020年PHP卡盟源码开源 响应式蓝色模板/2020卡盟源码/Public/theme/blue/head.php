 <div class="header">
        <dl class="top">
           
            <dd>
                <a href="javascript:" id="JuHeShe.CN" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage(location.href);">设为首页</a>
                <a onclick="window.external.addFavorite('http://'+document.domain,document.title);" href="javascript:"  id="JuHeShe.CN">加入收藏</a>
                <a href="/news.php">平台动态</a></dd>
        </dl>
    </div>
    <!--end头文件-->
    <div class="header_c">
        <div class="header_c_t">
            <div style="float:left;margin-top:10px;width:680px;height:80px;">
            <div style="float:left;">
                <a href="/">
                    <img src="<?=$site_logo?>"  alt="<?=$site_name?>" />
                </a>
            </div>
            </div>
            <!--end标志-->
            <div class="header_r">
                <ul class="t_tool_nav th">
                    <li id="liAgent" class="t_1"><a id="JuHeShe.CN">电脑端 </a></li>
                    <li id="liYKT" class="t_2"><a id="JuHeShe.CN">手机端</a></li>
                </ul>
            </div>
            <!--end头文件右-->
        </div>
        <!--end头文件中内容-->
    </div>
    <!--end头文件中-->
    <div class="nav">
        <ul class="nav th">
            <li id="nav_hover01" ><a href="/"><span>首 页</span></a></li>
            <li  ><a href="/reg.php"><span>用户注册</span></a></li>
            <li  ><a href="/news.php"><span>平台动态</span></a></li>
			<?php if ($site_menu!='') {
$allArray=(explode("\n",$site_menu));    ////用 explode 把 回车 的内容隔开成数组
foreach($allArray as $value) 
{
$allArray1=(explode('，',$value));       ////用 explode 把 ， 的内容隔开成数组
?>
<li><a href="<?=$allArray1[1]?>" target="_blank"><span><?=$allArray1[0]?></span></a></li>
<?php
} 
} ?>
              
        </ul>
    </div>
    <!--end导航-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include_once('jhs_config/function.php');
?>


<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>会员注册-<?=$site_name?></title>
<meta name="keywords" content="<?=$site_keywords?>">
<meta name="description" content="<?=$site_describe?>">
<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">

    <link href="/templatecss/reg/regstyle/zch_css.css" rel="stylesheet" type="text/css" />
    <script src="/templatecss/reg/regstyle/load.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/youxi.reg.js"></script>
	</head>
	<body>
<header class="register-header">
    <div class="wrap clear">
        <ul class="left-logo clear">
            <li><div id="AgentLogo"><a href="/"><img src="<?=$site_logo?>" /></a></div></li>
            <li class="welcome-reg">欢迎注册</li>
        </ul>
        <div class="right-login">
            <p>已有账号?<a href="/">立即登录</a></p>
        </div>
    </div>
</header>
<body class="mainbg" onload = "MyTest()">

<div class="register-content">
	
    <div class="ing">
	        	<form name="userinfo" method="post" runat="server">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">

	
        <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">登录邮箱<span>*</span></label>
                <label class="input-right">
                    <input value="" id="customerName"  name="customerName" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="请使用您常用的邮箱进行注册"  id="txtUsername"/>
                </label>
            </div>
            <div class="register-biref">
                <span class="icoBg biref-x"></span>
                <p>必填项，不能为空！</p>
            </div>
</div>
        <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">登录密码<span>*</span></label>
                <label class="input-right">
                    <input value="" id="password"  name="password"  type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="密码由6-18位英文(区分大小写)和数字的组合"  id="txtUsername"/>
                </label>
            </div>
</div>
       <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">确认密码<span>*</span></label>
                <label class="input-right">
                    <input value="" id="qrpassword" name="qrpassword" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="请再次确认登录密码"  id="txtUsername"/>
                </label>
            </div>
</div>
       <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">联系Q Q <span>*</span></label>
                <label class="input-right">
                    <input value="" id="qq"name="qq" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="请输入您常用QQ号码"  id="txtUsername"/>
                </label>
            </div>
</div>

				<input id="tradePassword" name="tradePassword" type="hidden"  value="123456"  />
				<input id="qrtradePassword" name="qrtradePassword"  type="hidden"  value="123456" />
				<input id="province" name="province" type="hidden"  value="中华人民共和国" />
				<input id="card" name="card" type="hidden"  value="370280000910000" />
				<input id="company" name="company" type="hidden"  value="注册用户" />
				<input id="rname" name="rname"  type="hidden"  value="注册用户" />
				<input id="begtime" name="begtime" type="hidden" value="<?php $now=mktime(); echo $now;?>"/>
				<input id="phone" name="phone"  type="hidden"  value="13777777777" />
				<input id="address" name="address"  type="hidden"  value="未设置" />
			<!--	<input style="width: 20px; border: none;" id="Theme1_Radio_No" type="radio" name="Theme1$ParentID" checked="checked" onClick="ParentIDCheck();">
					<label style="width: 20px;border: none;" for="Theme1_Radio_No">无</label>&nbsp;&nbsp;&nbsp;&nbsp;
					
				<input style="width: 20px; border: none;" id="Theme1_Radio_Yes" type="radio" name="Theme1$ParentID" onClick="ParentIDCheck();">
					<label style="width: 20px;border: none;" for="Theme1_Radio_Yes">有</label>
					
                    
                    <input style="width: 138px;border-color:oranger; border-width:2px;display: none;" type="text" id="agent"  name="agent" value="<?=$_SESSION['youxi']?>"/><span id="chk_agr"> 
					</span>-->
					<input type="hidden" style=" width:auto"  name="checkbox" id="checkbox" onClick="on_hide();" >
<input type="hidden" id="agent" name="agent" style="width: 100px;border-color:oranger; border-width:2px;display: none;" value="<?=$_SESSION['youxi']?>"/><span id="chk_agr"></span>
<script>
function on_hide(){
document.getElementById("agent").style.display = (document.getElementById("checkbox").checked == true) ? "" : "none";
}
</script>
        </div>
        <div class="checkbox-wrap">
            <label><input type="checkbox" checked class="Re_checkbox" checked="checked" id="Agreed" value="0">阅读并同意<a href="#art1"  onClick="art.dialog.open('/xy.php', { title: '会员注册协议', width: 800, height:500, lock: true, fixed:true,closeFn: function () {location.reload();}});" >《<?=$site_name?> 网站服务协议》</a></label>
        </div>
        <div class="register-btn">
            <input id="register_btn" value="立即注册" type="button" class="registerNow btn-yellow" onClick="Register('black')" style=" width:100%; height:45px"></input>
           <div class='loading' id="loading" style="display: none">
<img src='/Public/images/loading.gif' /><span>请稍后...</span>
</div>
        </div>
				 
				         <div class="party">
            <p><span class="left"></span>第三方登陆<span class="right"></span></p>
            <ul class="clear">
                <li class="QQ"><a><i class="icon-qq"></i></a></li>
                <li class="WX"><a><i class="icon-weixin"></i></a></li>
            </ul>
        </div>
<input type="hidden" id="register_btn" class="blue_btn" style=" width:124px; height:37px" value="立即注册" onClick="Register('black')" />
<input type="hidden" id="rewrite_btn" class="blue_btn" style=" width:124px; height:37px" value="重新填写" onClick="regReset()" />

</div>
            </form>
 
   <script>
 function ParentIDCheck(){
if(document.getElementById("Theme1_Radio_No").checked)
{
	document.getElementById("agent").style.display="none";
}
else
{
	document.getElementById("agent").style.display="";
}
}

</script>
 
 
 
 

</div>

 
</body>
</html>
<script language = "javascript">
//创建两个省份下的城市数组
var cityArr = new Array();
cityArr["北京"] = new Array("北京市");
cityArr["天津"] = new Array("天津市");
cityArr["上海"] = new Array("上海市");
cityArr["重庆"] = new Array("重庆市");
cityArr["河北"] = new Array("石家庄市","保定市","邯郸市","秦皇岛市","张家口市","唐山市","承德市","廊坊市","沧州市","衡水市","邢台市");
cityArr["山西"] = new Array("太原市","临汾市","大同市","运城市","晋中市","长治市","晋城市","阳泉市","吕梁市","忻州市","朔州市","临猗市","清徐市");
cityArr["内蒙古"] = new Array("呼和浩特","包头","赤峰","鄂尔多斯","通辽","呼伦贝尔","巴彦淖尔市","乌兰察布","锡林郭勒盟","兴安盟","乌海","阿拉善盟","海拉尔");
cityArr["辽宁"] = new Array("沈阳","大连","鞍山","锦州","抚顺","营口","盘锦","朝阳","丹东","辽阳","本溪","葫芦岛","铁岭","阜新","庄河","瓦房店");
cityArr["吉林"] = new Array("长春","吉林","四平","延边","松原","白城","通化","白山","辽源");
cityArr["黑龙江"] = new Array("哈尔滨","大庆","齐齐哈尔","牡丹江","绥化","佳木斯","鸡西","双鸭山","鹤岗","黑河","伊春","七台河","大兴安岭");
cityArr["江苏"] = new Array("苏州","南京","无锡","常州","徐州","南通","扬州","盐城","淮安","连云港","泰州","宿迁","镇江","沭阳","大丰");
cityArr["浙江"] = new Array("杭州","宁波","温州","金华","嘉兴","台州","绍兴","湖州","丽水","衢州","舟山","乐清","瑞安","义乌");
cityArr["安徽"] = new Array("合肥","芜湖","蚌埠","阜阳","淮南","安庆","宿州","六安","淮北","滁州","马鞍山","铜陵","宣城","亳州","黄山","池州","巢湖","和县","霍邱","桐城");
cityArr["福建"] = new Array("福州","厦门","泉州","莆田","漳州","宁德","三明","南平","龙岩","武夷山");
cityArr["江西"] = new Array("南昌","赣州","九江","宜春","吉安","上饶","萍乡","抚州","景德镇","新余","鹰潭","永新");
cityArr["山东"] = new Array("青岛","济南","烟台","潍坊","临沂","淄博","济宁","泰安","聊城","威海","枣庄","德州","日照","东营","菏泽","滨州","莱芜","章丘","垦利","诸城");
cityArr["河南"] = new Array("郑州","洛阳","新乡","南阳","许昌","平顶山","安阳","焦作","商丘","开封","濮阳","周口","信阳","驻马店","漯河","三门峡","鹤壁","济源","明港","鄢陵","禹州","长葛");
cityArr["湖北"] = new Array("武汉","宜昌","襄阳","荆州","十堰","黄石","孝感","黄冈","恩施","荆门","咸宁","鄂州","随州","潜江","天门","仙桃","神农架");
cityArr["湖南"] = new Array("长沙","株洲","益阳","常德","衡阳","湘潭","岳阳","郴州","邵阳","怀化","永州","娄底","湘西","张家界");
cityArr["广东"] = new Array("深圳","广州","东莞","佛山","中山","珠海","惠州","江门","汕头","湛江","肇庆","茂名","揭阳","梅州","清远","阳江","韶关","河源","云浮","汕尾","潮州","台山","阳春","顺德");
cityArr["广西"] = new Array("南宁","柳州","桂林","玉林","梧州","北海","贵港","钦州","百色","河池","来宾","贺州","防城港","崇左");
cityArr["海南"] = new Array("海口","五指山","琼海","文昌","万宁","东方","定安","屯昌","澄迈","临高","白沙","昌江","乐东","陵水","保亭","琼中","西沙","南沙","中沙","三亚","儋州");
cityArr["四川"] = new Array("成都","绵阳","德阳","南充","宜宾","自贡","乐山","泸州","达州","内江","遂宁","攀枝花","眉山","广安","资阳","凉山","广元","雅安","巴中","阿坝","甘孜");
cityArr["贵州"] = new Array("贵阳","遵义","黔东南","黔南","六盘水","毕节","铜仁","安顺","黔西南");
cityArr["云南"] = new Array("昆明","曲靖","大理","红河","玉溪","丽江","文山","楚雄","西双版纳","昭通","德宏","普洱","保山","临沧","迪庆","怒江");
cityArr["西藏"] = new Array("拉萨","日喀则","山南","林芝","昌都","那曲","阿里");
cityArr["陕西"] = new Array("西安","咸阳","宝鸡","渭南","汉中","榆林","延安","安康","商洛","铜川");
cityArr["甘肃"] = new Array("兰州","天水","白银","庆阳","平凉","酒泉","张掖","武威","定西","金昌","陇南","临夏","嘉峪关","甘南");
cityArr["青海"] = new Array("西宁","海西","海北","果洛","海东","黄南","玉树","海南");
cityArr["宁夏"] = new Array("银川","吴忠","石嘴山","中卫","固原");
cityArr["新疆"] = new Array("乌鲁木齐","克拉玛依","吐鲁番","哈密","昌吉","和田","阿克苏","喀什","克孜勒苏","柯尔克孜","巴音郭楞","博尔塔拉","伊犁","哈萨克","塔城","阿勒泰","库尔勒","石河子","阿拉尔","图木舒克","五家渠");
cityArr["其他地区"] = new Array("香港","澳门","台湾");

//写一个查询的目标函数
function test(){
//找到相应的省份和城市
var provinces = document.getElementById("province");
var citys = document.getElementById("city");
//清空
citys.length = 0;
//使用嵌套循环找到省份说对应的城市
for(var i in cityArr){
//循环省份数组里面的value数据
if(i==provinces.value){
//如果确定是该省份下的城市，那么循环遍历
for(var j in cityArr[i]){
//
citys.add(new Option(cityArr[i][j],cityArr[i][j]));
}
}
}
}
//写一个驱动这个函数
function MyTest(){
//找到级别最大的索引ID
var province = document.getElementById("province");
for(var i in cityArr){
province.add(new Option(i,i));
}
}
</script>

<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/PUBLIC/btb/css/lib.css?2">
	<link rel="stylesheet" href="/PUBLIC/gec/web/js/morris.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
	<meta content="telephone=no" name="format-detection">
	<title>交易中心</title>
	<script src="/PUBLIC/gec/web/js/jquery-1.8.3.min.js"></script>
	<link rel="stylesheet" href="/PUBLIC/gec/web/css/weui.min.css"/>
	<link rel="stylesheet" href="/PUBLIC/gec/web/css/jquery-weui.min.css">
	<link href="/PUBLIC/gec/web/css/font-awesome.min.css" rel="stylesheet">
	<link href="/PUBLIC/gec/web/fonts/iconfont.css" rel="stylesheet">
	<script src="/PUBLIC/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/PUBLIC/gec/web/css/style.css"/>
	<style>
        #chartNav{
		display:none;
            width: 100%;
            height: 30px;
            background: #3660f0;
        }
        #chartNav a{
            float: left;
            width: 100%;
            line-height: 30px;
            -ms-text-align-last: center;
            text-align-last: center;
			text-align:center;
            color: #666666;
        }
        #chartNav a:hover,#chartNav a.active{
            background:#3660f0;
            color: #fff;
            -webkit-transform: all 0.3s;
            -moz-transform: all 0.3s;
            -ms-transform: all 0.3s;
            -o-transform: all 0.3s;
            transform: all 0.3s;
        }
		 #myhend{
            width: 100%;
            height: 40px;
            overflow: hidden;
            border-bottom:1px solid #ddd;
            color: #767676;
        }
        #myhend>div{
            float: left;
            width:calc( 50% - 20px );
            text-align: left;
            height:100%;
            line-height: 40px;
            font-size: 16px;
            font-weight: 600;
			padding-left:0;
			padding-left:18px;
        }
		 #myhend>div:last-child{
		 text-align:center;
		 color:#3660f0;
		 font-size:24px;
		 }
        #myhend>div>p{
		   float:left;
            width: 50%;
            height: 20px;
            line-height: 20px;
            font-size: 12px;
            font-weight: 500;
			text-align:left;
        }
		#mynav{
			width:100%;
			height:30px;
			line-height:30px;
			border-bottom:1px solid #ddd;
		}
		#mynav a{
			float:left;
			width:50%;
			text-align:center;
			line-height:30px;
			color:#3660f0;
		}
		#mynav a:hover{
			transition:all 0.5s;
			background:#3660f0;
			color:#fff;
		}
		#mynav a.active{
			transition:all 0.5s;
			background:#3660f0;
			color:#fff;
		}
    </style>
</head>
<body>
	<!--顶部开始-->
	<header class="header">
		<span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
		<span class="header_c">交易中心</span>
		<!--<span style="position: absolute;right: 40px;top: 0px;text-align:center;width:70px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($userData['ue_truename']); ?></span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
	</header>
	<div class="height40"></div>
	<section class="content">
    <div class="row">
        <div class="col-md-13">
            <div class="box box-info">
                <div class="box-header with-border">
                     <!--<h3 class="box-title" style="color: #333;/* background:#FF4500; */ text-align: center;border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;font-size: 18px;padding: 10px 0;">价格走势图</h3>-->
                </div>
				    <div id="myhend">
                    <div>
                        <p>幅:&nbsp;<font color="red"><?php echo ($fu); ?>%</font></p>
                        <p>量:&nbsp;<font color="red"><?php echo ($liang); ?></font></p>
						 <p>最高:&nbsp;<font color="red"><?php echo ($gao); ?></font></p>
                        <p>最低:&nbsp;<font color="red"><?php echo ($di); ?></font></p>
                    </div>
					  <div><font color="red">$:<?php echo ($zuihou); ?></font></div>
                </div>
                <div id="chartNav"></div>
				<div id="mynav">
				 <a class="active">分时线</a>
				 <a>日线</a>
				</div>
				 <!-- <div class="box-body chart-responsive" > -->
<!-- <div class="box-body chart-responsive" style="background-image: url('__PUBLIC__/user2/images/kx.png');"> -->
                    <div id="chart" style="width:100%;height:200px;"></div>
            </div>
        </div>
    </div>
</section>
	<!--顶部结束-->
	<!--矿车列表-->
	<div style="width: 90%;margin-left: 5%;margin-top: 20px;overflow:hidden;border-radius:5px">
		<p id="qiugou_list"onclick='showhidediv("qiugou")'style="float: left;width: 50%;text-align: center;background-color:#3660f0;height: 30px;line-height: 30px;color:#fff;border-bottom-left-radius: 5px;border-top-left-radius: 5px">买入MHC</p>
		<p id="chushou_list" onclick='showhidediv("chushou")'style="float: left;width: 50%;text-align: center;background-color: #fff;height: 30px;line-height: 30px;border-top-right-radius: 5px;border-bottom-right-radius: 5px">卖出MHC</p>
	</div>
	<div id="qiugou" style="padding-bottom:50px;margin-top:0px;width:100%;margin-left:0%">
	<form  id="qiugou" class="mmform" style="margin-top: 25px" action="/Index.php/Home/Info/myjiaoyis" method= "POST" onsubmit="return false" >
		<input type="text" name="lkb" id="gmsl" placeholder="请输入要购买数量" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')"
 style="width:60%"/>
		<input type="text" name="price" id="mmp" placeholder="请输入购买单价"style="width:60%" />
		<!--<input type="password" name="password_m" id="password_m" placeholder="请输入手机验证码"style="width:60%"/>
        <span class="fr" id="count_down2" onClick="send_sms_reg_code2()" style="background-color: #3660f0; float:right;display: inline-block; height:30px; line-height:30px;width: 33%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px">发送验证码</span>
        -->
        
		<button type="submit" id="mmm" style="float:right;width:33%;margin-top:-25px;background-color:#3660f0;height: 30px;line-height: 30px;background-color:#3660f0;height: 30px;line-height: 30px;border-radius:5px;border:0px;color:#fff">买入</button>
	</form>

      <div style="width:90%; margin:0 auto;">
    	<form action="<?php echo U('index/emoney/index');?>" method="get">
       <input type="text" name="p_id" style=" width:60%;" placeholder="请输入会员手机号">
       	   <input type="submit" style=" width:33%;height: 30px; float:right;line-height: 30px;background-color:#3660f0;height: 30px;line-height: 30px;border-radius:5px;border:0px;color:#fff; text-align:center;" value="查找用户">
        
        
        </form>
    
       </div>
    
	<table class="jyzx_list" style="margin-top:20px;margin-bottom:80px;border-collapse:collapse;table-layout: fixed">
		<thead>
			<tr style="width:100%;">
				<th style="padding:10px 0;width:30%">会员</th>
				<th style="padding:10px 0;width:15%">级别</th>
				<th style="padding:10px 0;width:15%">数量</th>
				<th style="padding:10px 0;width:15%">总价($)</th>
				<th style="padding:10px 0;width:25%">状态</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="margin-bottom:100px">
				<td class="name" style="padding:10px 0;text-align:center;overflow:hidden;white-space: nowrap;"><?php echo (yc_phone($v["p_user"])); ?></td>
				<td class="range iconfont" style="padding:10px 0;text-align:center;font-size:12px;"><?php echo group($v[p_level]);?></td>
				<td class="lkMoney" style="padding:10px 0;text-align:center;"><font color="red"><?php echo ($v["lkb"]); ?></font></td>
				<td style="padding:10px 0;text-align:center;"><span  class="money" ><font color="red"><?php echo ($v["jb"]); ?></font></span></td>
				<?php if($v["zt"] == 0): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
					<button style="background-color: 	#3660f0;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" class="btnchushou">卖出</button>
				</td><?php endif; ?>
				<?php if($v["zt"] == 1): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
					<button style="background-color:#666;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" >交易中</button>
				</td><?php endif; ?>
				<?php if($v["zt"] == 2): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
					<button style="background-color: 	#3660f0;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" class="wancheng">交易完成</button>
				</td><?php endif; ?>
			</tr><?php endforeach; endif; ?>

		</tbody>
	</table>
	</div>
	<div id="chushou" style="display: none; padding-bottom:50px;position:relative;" >
	<form id="qiugou" class="nnform" style="margin-top: 25px" action="/Index.php/Home/Info/cslkb" method= "POST" onsubmit="return false">
		<input type="text" name="lkb" id="mcsl" placeholder="请输入要卖出数量"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" style="width:60%"/>
		<input type="text" name="price" id="mcpic" placeholder="卖出单价为当前最低价"style="width:60%"/>
       <!-- <input type="text" name="password_n" id="password_n" placeholder="请输入手机验证码"style="width:60%"/>
        <span class="fr" id="count_down" onClick="send_sms_reg_code()" style="background-color: #3660f0; float:right;display: inline-block; height:30px; line-height:30px;width: 33%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px">发送验证码</span>-->
		<?php if($level > 0): ?><!--<input type="text" name="zdjy" id="mmp" placeholder="请输入指定买家手机号"style="width:60%"/>--><?php endif; ?>
        
        <!--<p style="width:36%; font-size:12px; color:#F00; line-height:18px; position:absolute; top:10px; right:3px;">定向交易：输入对方的手机号码，交易价格将不受市场限制！</p>-->
        
		<button type="submit" id="nnn" style="float:right;width:33%;margin-top:-22px;background-color:#3660f0;height: 30px;line-height: 30px;background-color:#3660f0;height: 30px;line-height: 30px;border-radius:5px;border:0px;color:#fff">卖出</button>
	</form>
    
     
    
    
		<table class="jyzx_list" style="margin-top:20px;margin-bottom:80px;border-collapse:collapse;table-layout: fixed">
			<thead>
			<tr style="width:100%;">
				<th style="padding:10px 0;width:30%">会员</th>
				<th style="padding:10px 0;width:15%">级别</th>
				<th style="padding:10px 0;width:15%">数量</th>
				<th style="padding:10px 0;width:15%">总价($)</th>
				<th style="padding:10px 0;width:25%">状态</th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($lists)): foreach($lists as $key=>$v): ?><tr style="margin-bottom:100px">
					<td class="name" style="padding:10px 0;text-align:center;overflow:hidden;white-space: nowrap;"><?php echo (yc_phone($v["p_user"])); ?></td>
					<td class="range iconfont" style="padding:10px 0;text-align:center;font-size:12px"><?php echo group($v[p_level]);?></td>
					<td class="lkMoney" style="padding:10px 0;text-align:center;"><font color="red"><?php echo ($v["lkb"]); ?></font></td>
					<td class="money" style="padding:10px 0;text-align:center;"><font color="red"><?php echo ($v["jb"]); ?></font></td>
					<?php if($v["zt"] == 0): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
							<button style="background-color: 	#3660f0;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" class="btnsc">买入</button>
						</td><?php endif; ?>
					<?php if($v["zt"] == 1): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
							<button style="background-color:#666;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" >交易中</button>
						</td><?php endif; ?>
					<?php if($v["zt"] == 2): ?><td style="padding:5px 0;text-align:center;"><input class="ppid" type="hidden" value="<?php echo ($v["id"]); ?>">
							<button style="background-color: 	#3660f0;width: 100%;height: 90% ;border: 0px;border-radius: 5px;color: #FFFFFF;cursor: pointer;" class="wancheng">交易完成</button>
						</td><?php endif; ?>
				</tr><?php endforeach; endif; ?>

			</tbody>
		</table>
	</div>
<!--底部开始-->
<link href="/Public/btb/fonts/iconfont.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
<style>
	.footer ul li{
		width: 20%;
	}
</style>
	<div class="footer">
    <ul>
        <li><a href="<?php echo U('Index/Emoney/shouye');?>" class="block"><i class="iconfont">&#xe63a;</i>首页</a></li>
		<li><a href="<?php echo U('Index/Shop/shop');?>" class="block"><i class="iconfont">&#xe645;</i>购物商城</a></li>
		<li><a href="<?php echo U('Index/Shop/plist');?>" class="block"><i class="iconfont">&#xe604;</i>矿机商城</a></li>
		<li><a href="<?php echo U('Index/Emoney/index');?>" class="block"><i class="iconfont">&#xe608;</i>交易中心</a></li>
        <li><a href="<?php echo U('Index/Index/index');?>" class="block"><i class="iconfont">&#xe684;</i>个人中心</a></li>
    </ul>
</div>
	<!--底部结束-->
<script src="/Public/gec/reg/js/jquery-1.11.3.min.js"></script>
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>	

	
	
	
	
	
	   <script src="/PUBLIC/gec/user2/js/jquery.dataTables.min.js"></script>
<script src="/PUBLIC/gec/user2/js/dataTables.bootstrap.min.js"></script>
<script src="/PUBLIC/gec/user2/js/jQuery-2.1.4.min.js"></script>
<script src="/PUBLIC/gec/web/js/echarts.min.js"></script>
<script src="/PUBLIC/gec/chart/mychart.js"></script>
<script src="/PUBLIC/gec/user2/js/bootstrap.min.js"></script>
<script src="/PUBLIC/gec/user2/js/morris.min.js"></script>
<script src="/PUBLIC/gec/user2/js/raphael-min.js"></script>
	<!--底部结束-->
	<script src="/PUBLIC/gec/web/js/jquery-weui.min.js"></script>
	<script>
		function showhidediv(id) {
			console.log(id);
			var qiugou = document.getElementById("qiugou");
			var zhengzai = document.getElementById("chushou");
			var qiugoubg = document.getElementById("qiugou_list");
			var zhengzaibg = document.getElementById('chushou_list');
			if (id == "qiugou") {
				zhengzai.style.display = 'none';
				qiugou.style.display = 'block';
				qiugoubg.style.backgroundColor = " 	#3660f0"
				qiugoubg.style.color = "#fff"
				zhengzaibg.style.backgroundColor = "#fff";
				zhengzaibg.style.color = "#000";
			}else if(id=='chushou'){
				zhengzai.style.display = 'block';
				qiugou.style.display = 'none';
				qiugoubg.style.backgroundColor = "#fff";
				qiugoubg.style.color = "#000";
				zhengzaibg.style.backgroundColor = " 	#3660f0";
				zhengzaibg.style.color = "#fff";
			}
		}
	</script>
	
	
	
	
<script>

    $(function(){
        var s='<div id="popUpBox" style="position:absolute;top:30%;width:100%;height:100%;display:none;background-color:#DDD">'+
            '<div style="margin:0 auto;width: 90%;height:150px;background-color: #fff;padding:15px 0 10px;border-radius: 10px">'+
            '<div style="text-align:center;font-size:1.2em;margin-top:15px;">是否确认提交？</div><input class="opid" type="hidden" value="" />'+
            '<div style="text-align:center;margin-top:35px;"><button style="font-size:1.2em;padding:5px 10px;background-color:#fff;border-radius: 5px;border: 0px;color:green"  id="confirmBtn">确认</button>&nbsp;&nbsp;<button style="padding:5px 10px;font-size:1.2em;border: 0px;background-color:#fff;border-radius: 5px" id="confirmBtnFalse">取消</button></div>'+
            '</div>'+
            '</div>';
        $("body").append(s);
    })


$(".btnchushou").click(function(){
    	var huilv=$(this).parent().parent().find(".money").html();
        $("#popUpBox").find(".opid").val($(this).parent().find(".ppid").val());
        $.ajax({
            url:"<?php echo U('Emoney/huilv');?>",
            type:"get",
            data:{id:$("#UpBox").find(".opid").val(),huilv:huilv},
            dataType:"json",
            success:function(data){
                console.log(data);
				var html='';
					html+='USD：'+huilv+'<br>'+'RMB：'+data.rmb+'<br>'
					html+='<input type="password" name="password_m" id="password_m" placeholder="请输入交易密码"style="width:40%; height:33px;  border:1px solid #ccc;"/>';
					//html+='<span class="fr" id="count_down2" onClick="send_sms_reg_code2()" style="background-color: #3660f0; display: inline-block; height:30px; line-height:30px;width: 29%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px; color:#ffffff;margin-left:5px;">发送</span>';
				
                $.confirm(html,"确定提交？",function(){
					
					var mobile_code=$("#password_m").val();
						if(mobile_code == ''){
							$.alert('请输入交易密码');
							 //layer.msg('请输入验证码');
							 return false;	
						}
						
						
						
						
                    $.ajax({
                        url:"<?php echo U('Emoney/chushou');?>",
                        type:"get",
                        data:{id:$("#popUpBox").find(".opid").val(),mobile_code:mobile_code},
                        dataType:"json",
                        success:function(data){
                            console.log(data);
                            if(data.status==1){
                                $.alert(data.msg,function(){
                                    location.href="/Index.php/index/Emoney/myjiaoyi";
                                });
                            }else{
                                $.alert(data.msg);
                            }
                        },
                        error:function(){
                            $.alert("网络错误请重试");
                        }
                    })

                })

            },
            error:function(){
                $.alert("网络错误请重试");
            }
        })

});

</script>


<!--价格走势图开始-->
<script type="text/javascript">
$(function(){ 
 	 $("#mmm").bind("click",function(){
		 
			var password_m=$("#password_m").val();
			var price=$("#mmp").val();
            var sum=/^[1-9]*[1-9][0-9]*$/;
            if($("#gmsl").val()==''){
				$.alert("请输入数量");
				return false;
			}
			if(sum.test($("#gmsl").val())){
			}else{
				$.alert("第一个数字不能为0");
				return false;
			}
            if(price==""){
                $.alert("请输入价格");
                return false;
            }
            if(!isNaN(price)){
            }else{
                $.alert("请输入数字");
                return false;
            }
			/* if(password_m==""){
                $.alert("请输入交易密码");
                return false;
            }*/
			
			
            $.showLoading("正在提交");
            $.ajax({
                url:"/Index.php/index/Emoney/myjiaoyis",
                type:"post",
                data:$(".mmform").serialize(),
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        $.alert(data.info,function(){
                            location.href="/Index.php/index/Emoney/index";
                        })
                    }else{
                        $.alert(data.info);
                    }
                },
                error:function(){
                    $.alert("网络错误");
                },
                complete:function(){
                    $.hideLoading();
                }
            })
			
			
			
		 
	}) 


})


</script>

<script type="text/javascript">
$(function(){
        $("#nnn").bind("click",function(){
			var password_n=$("#password_n").val();
            var price=$("#mcpic").val();
            var sum=/^[1-9]*[1-9][0-9]*$/;
            if($("#mcsl").val()==''){
				$.alert("请输卖出数量");
				return false;
			}
			if(sum.test($("#mcsl").val())){
			}else{
				$.alert("第一个数字不能为0");
				return false;
			}
            console.log(price);
            if(price==""){
                $.alert("请输入价格");
                return false;
            }
            if(!isNaN(price)){
            }else{
                $.alert("请输入数字");
                return false;
            }
			
			/* if(password_n==""){
                $.alert("请输入手机验证码");
                return false;
            }*/
			

           var html='';
					html+='<input type="text" name="password_n" id="password_n" placeholder="请输入交易密码"style="width:40%; height:33px;  border:1px solid #ccc;"/>';
					//html+='<span class="fr" id="count_down" onClick="send_sms_reg_code()" style="background-color: #3660f0; display: inline-block; height:30px; line-height:30px;width: 29%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px; color:#ffffff;margin-left:5px;">发送</span>';
				
                $.confirm(html,"确定提交？",function(){
					
						var mobile_code_n=$("#password_n").val();
						if(mobile_code_n == ''){
							//$.alert('请输入验证码');
							 layer.msg('请输入交易密码');
							 return false;	
						}
						
						
					$.ajax({
							url:"/Index.php/index/Emoney/cslkb/mobile_code_n/"+mobile_code_n,
							type:"post",
							data:$(".nnform").serialize(),
							dataType:"json",
							success:function(data){
								if(data.status==1){
									$.alert(data.info,function(){
										location.href="/Index.php/index/Emoney/index";
									})
								}else{
									$.alert(data.info);
								}
							},error:function(){
								$.alert("单价错误");
							},complete:function(){
								$.hideLoading();
							}
						})
						
						
					
					
		        });
			

        })
    })



</script>

<script type="text/javascript">
$.ajax({
        url:"<?php echo U('Emoney/getgp');?>",
        type:"post",
        data:null,
        dataType:"json",
        success:function(data){
            chart.oldData=data;
            start(chart);
        },error:function(){
            console.log('没有获取到数据');
        }
    })
    //配置信息
    function start(chart){
        chart.deploy={
            //配置导航信息
            nav:{
                //导航容器的id 默认为chartNav
                navId:"chartNav",
                //设置导航信息
                data:[
                    {
                        title:"分时线",
                        //每条数据额间隔时间 单位为妙
                        interval:"60",
                        //按钮图标
                        icon:"",
                        //按钮class类 需要至少有一个active
                        class:"active",
                        //图标的类型0为折线图,1为kline线图  candlestick
                        type:0,
                        //显示数据的条数 不存在的话为无穷大 0为不显示,-1为无穷大
                        num:1440
                    }
                ]
            }
        };
        chart.start();
    }
    $("#mynav a").bind("click",function(){
        $("#mynav a").removeClass("active");
        $(this).addClass("active");
    })
    $("#mynav a").eq(0).bind("click",function(){
        $.ajax({
            url:"<?php echo U('Emoney/getgp');?>",
            type:"post",
            data:null,
            dataType:"json",
            success:function(data){
                chart.oldData=data;
                start(chart);
            },error:function(){
                console.log('没有获取到数据');
            }
        })
    })
    var cht = chart.mychart;
    var option = chart.option;
	
    $("#mynav a").eq(1).bind("click",function(){
        $.ajax({
            url:"<?php echo U('Emoney/getgps');?>",
            type:"post",
            data:null,
            dataType:"json",
            success:function(data){
                option.series.type='candlestick';
                option.tooltip.formatter=function(data){
                    return "时间:"+data[0].name+"<br>"+
                        "开盘"+data[0].data[0]+"<br>"+
                        "收盘"+data[0].data[1]+"<br>"+
                        "最低"+data[0].data[2]+"<br>"+
                        "最高"+data[0].data[3]+"<br>";
                }
                var time=[];
                var dt=[];
                for(var key in data){
                    var tt=new Date(data[key].date*1000);
                    var mm=tt.getMonth()+1;
                    var dd=tt.getDate();
                    time.push(mm+"月"+dd+"日");
                    dt[key]=[];
                    dt[key].push(data[key].jinkai);
                    dt[key].push(data[key].zuoshou);
                    dt[key].push(data[key].jrzd);
                    dt[key].push(data[key].jrzg);
                }
                option.xAxis.data=time;
                option.series.data=dt;
                cht.setOption(option);
            },error:function(){
                console.log('没有获取到数据');
            }
        })
    })


</script>




<!--价格走势图结束-->

	
<script>
    $(function(){
        var s='<div id="UpBox" style="position:absolute;top:30%;width:100%;height:100%;display:none;background-color:#DDD">'+
            '<div style="margin:0 auto;width: 90%;height:150px;background-color: #fff;padding:15px 0 10px;border-radius: 10px">'+
            '<div style="text-align:center;font-size:1.2em;margin-top:15px;">是否确认提交？</div><input class="opid" type="hidden" value="" />'+
            '<div style="text-align:center;margin-top:35px;"><button style="font-size:1.2em;padding:5px 10px;background-color:#fff;border-radius: 5px;border: 0px;color:green"  id="firmBtn">确认</button>&nbsp;&nbsp;<button style="padding:5px 10px;font-size:1.2em;border: 0px;background-color:#fff;border-radius: 5px" id="confirmBtnFalse">取消</button></div>'+
            '</div>'+
            '</div>';
        $("body").append(s);
    })
    $(function(){



        $(".btnsc").bind("click",function(){


            var huilv=$(this).parent().parent().find(".money").html();
            $("#popUpBox").find(".opid").val($(this).parent().find(".ppid").val());
            $.ajax({
                url:"<?php echo U('Emoney/huilv');?>",
                type:"get",
                data:{id:$("#UpBox").find(".opid").val(),huilv:huilv},
                dataType:"json",
                success:function(data){
                    console.log(data);
                    $.confirm("USD："+huilv+"<br>"+"RMB："+data.rmb,"确定提交？",function(){
                        $.ajax({
                            url:"<?php echo U('Emoney/lksc');?>",
                            type:"get",
                            data:{id:$("#popUpBox").find(".opid").val()},
                            dataType:"json",
                            success:function(data){
                                console.log(data);
                                if(data.status==1){
                                    $.alert(data.msg,function(){
                                        location.href="/Index.php/index/Emoney/myjiaoyi";
                                    });
                                }else{
                                    $.alert(data.msg);
                                }
                            },
                            error:function(){
                                $.alert("网络错误请重试");
                            }
                        })

                    })

                },
                error:function(){
                    $.alert("网络错误请重试");
                }
            })





        })




    })
</script>
	<!-- 汇率转换 -->
	<script>
    $(function(){
		$(".money").bind("click",function(){
			var huilv=$(this).html();
			$.ajax({
				url:"<?php echo U('/Index.php/index/Emoney/huilv');?>",
				type:"get",
				data:{id:$("#UpBox").find(".opid").val(),huilv:huilv},
				dataType:"json",
				success:function(data){
				console.log(data);
					$.modal({
                        title: data.name,
                        text: "美元："+huilv+"<br>"+"人民币："+data.rmb,
                        buttons:[
                            { text: "确定", className: "default", onClick: function(){ } },
                        ]
                    })
				},
				error:function(){
					$.alert("网络错误请重试");
				}
			})
		})
		$("#firmBtnFalse").bind("click",function(){
			$("#UpBox").fadeOut();
		})
		})
</script>


<script type="text/javascript">
	// 发送手机短信
    function send_sms_reg_code(){
        var mobile = '<?php echo $mymobile;?>';
		
		
		if(!checkMobile(mobile)){
            layer.msg('请输入正确的手机号码');
            return;
        }
	
		
        var url = "/index.php/index/sem/send_sms_reg_code22/mobile/"+mobile;
        $.get(url,function(data){
            obj = $.parseJSON(data);
            if(obj.status == 1)
			{
				$('#count_down').attr("disabled","disabled");				
				intAs = 60; // 手机短信超时时间
                jsInnerTimeout('count_down',intAs);						
			}
			layer.msg(obj.msg);// alert(obj.msg);
            
        })
    }
   $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
      //var intAs = parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
//            codeObj.attr("IntervalTime",60);
            codeObj.text("获取验证码");
            return true;
        }

        codeObj.text(intAs+'秒');
//        codeObj.attr("IntervalTime",intAs);

        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
function checkMobile(tel) {
    var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
    if (reg.test(tel)) {
        return true;
    }else{
        return false;
    };
}
</script>



<script type="text/javascript">
	// 发送手机短信
    function send_sms_reg_code2(){
        var mobile = '<?php echo $mymobile;?>';
		
		
		if(!checkMobile(mobile)){
            //$.alert('请输入正确的手机号码');
			layer.msg('请输入正确的手机号码');
            return;
        }
	
		
        var url = "/index.php/index/sem/send_sms_reg_code22/mobile/"+mobile;
        $.get(url,function(data){
            obj = $.parseJSON(data);
            if(obj.status == 1)
			{
				$('#count_down2').attr("disabled","disabled");				
				intAs = 60; // 手机短信超时时间
                jsInnerTimeout('count_down2',intAs);						
			}
			//$.alert(obj.msg);// alert(obj.msg);
			layer.msg(obj.msg);
			
            
        })
    }
   $('#count_down2').removeAttr("disabled");
   

</script>


</body>
</html>
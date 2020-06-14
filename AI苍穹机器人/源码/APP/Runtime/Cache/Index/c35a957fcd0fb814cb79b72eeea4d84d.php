<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/Public/btb/css/lib.css?2">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta content="telephone=no" name="format-detection">
    <title>我的交易</title>
    <meta name="Keywords" content="PAAM" />
    <meta name="Description" content="PAAM" />
    <script src="/Public/gec/web/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/Public/gec/web/css/weui.min.css"/>
    <link rel="stylesheet" href="/Public/gec/web/css/jquery-weui.min.css">
    <script src="/Public/gec/web/js/layer.js"></script>
    <link href="/Public/gec/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/gec/web/fonts/iconfont.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/gec/web/css/style.css"/>
	
	<script src="/Public/gec/web/js/ajaxUplod.js"></script>
</head>
<body>
<style>



</style>

<!--顶部开始-->
<header class="header">
    <span class="header_l"><a href="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i></a></span>
    <span class="header_c">我的交易</span>
		<!--<span style="position: absolute;right: 10%;top: 0px;text-align:center;width:20%;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;font-size: 12px; "><?php echo ($memberinfo['username']); ?> </span>
		<span class="header_r"><a href="<?php echo U(GROUP_NAME .'/personal_set/myInfo');?>"><i class="fa fa-user"></i></a></span>-->
</header>
<div class="height40"></div>
<!--顶部结束-->
<!--矿车列表-->
<div style="width: 90%;margin-left: 5%;margin-top: 20px;overflow:hidden;border-radius:5px">
    <p id="qiugoubg"onclick='showhidediv("qiugou")'style="float: left;width: 25%;text-align: center;background-color: #fff;height: 30px;line-height: 30px;">我的买入</p>
    <p id="chushoubg"onclick='showhidediv("chushou")'style="float: left;width: 25%;text-align: center;background-color: #3662f2;height: 30px;line-height: 30px;color:#fff">我的卖出</p>
    <p id="zzjybg" onclick='showhidediv("zzjy")'style="float: left;width: 25%;text-align: center;background-color: #3662f2;;height: 30px;line-height: 30px;color:#fff">正在交易</p>
    <p id="ywcjybg" onclick='showhidediv("ywcjy")'style="float: left;width: 25%;text-align: center;background-color: #3662f2;;height: 30px;line-height: 30px;color:#fff">历史记录</p>
</div>
<div id="qiugou" style="-left: 5%;margin-bottom:80px;margin-top:30px">
        <ul class="myjy_head"style="font-weight: 700;width:100%;margin-left:0%;margin-top:-5px">
            <li style="width: 30%">编号</li>
            <li style="width: 15%">数量</li>
            <li style="width: 15%">价格($)</li>
            <li style="width: 20%">是否取消</li>
            <li style="width: 20%">状态</li>
        </ul>
    <div>
	<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="myjy_body"style="width:100%;margin-left:0%;margin-top:10px">
            <li style="width: 30%;height: 30px;overflow: hidden;display: inline-block"><?php echo ($v["p_user"]); ?></li>
            <li style="width: 15%;"><?php echo ($v["lkb"]); ?></li>
            <li style="width: 15%;"class="money"><?php echo ($v["jb"]); ?></li>
            <li style="width: 20%;"><a href="<?php echo U('Emoney/delqiugou',array('id'=>$v['id']));?>" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">取消</a></li>
            <li style="width: 20%;">
                <?php if($v["zt"] == 0): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">未交易</a><?php endif; ?>
                <?php if($v["zt"] == 1): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">交易中</a><?php endif; ?>
                <?php if($v["zt"] == 2): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">交易完成</a><?php endif; ?>
            </li>
        </ul><?php endforeach; endif; ?>	
    </div>
 </div>
<div id="chushou" style="-left: 5%;margin-bottom:80px;margin-top:30px;display: none;width: 90%; margin-left: 5%;">
    <ul class="myjy_head"style="font-weight: 700;width:100%;margin-left:0%;margin-top:-5px;">
        <li style="width: 30%">编号</li>
        <li style="width: 15%">数量</li>
        <li style="width: 15%">价格($)</li>
        <li style="width: 20%">是否取消</li>
        <li style="width: 20%">状态</li>
    </ul>
    <div>
        <?php if(is_array($cslkb)): foreach($cslkb as $key=>$v): ?><ul class="myjy_body"style="width:100%;margin-left:0%;margin-top:10px">
                <li style="width: 30%;height: 30px;overflow: hidden;display: inline-block"><?php echo ($v["p_user"]); ?></li>
                <li style="width: 15%;"><?php echo ($v["lkb"]); ?></li>
                <li style="width: 15%;" class="money"><?php echo ($v["jb"]); ?></li>
                <li style="width: 20%;"><a href="<?php echo U('Emoney/del',array('id'=>$v['id']));?>" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">取消</a></li>
                <li style="width: 20%;">
                    <?php if($v["zt"] == 0): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">未交易</a><?php endif; ?>
                    <?php if($v["zt"] == 1): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">交易中</a><?php endif; ?>
                    <?php if($v["zt"] == 2): ?><a href="#" style="width: 90%;margin-left: 5%;display: block;height: 30px;line-height: 30px;text-align: center;background-color: #3662f2;border-radius: 5px;color: #FFFFFF">交易完成</a><?php endif; ?>
                </li>
            </ul><?php endforeach; endif; ?>
    </div>
</div>
<div id="zzjy" style="display:none;margin-bottom:80px;">
    <div>
	
        <ul class="myjy_head"style="font-weight: 700">
            <li style="width: 10%">操作</li>
            <li style="width: 25%">卖家</li>
            <li style="width: 25%">买家</li>
            <li style="width: 20%">数量</li>
            <li style="width: 20%">总价($)</li>
        </ul>
		
    </div>
    <div class="myjiaoyi_list">
	<?php if(is_array($lists)): foreach($lists as $key=>$v): ?><ul class="myjy_body">
            <li style="width: 10%;"><input type="radio" <?php if($key == 0): ?>checked="checked"<?php endif; ?> name="xz" class="xz redio_all" value="<?php echo ($v["id"]); ?>" for="xxx"/></li>
            
           <?php
 if($v['datatype']=='qglkb'){ ?> 
            	
                 <li style="width: 25%;height: 30px;text-align:center;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo ($v["g_user"]); ?></li>
            	 <li style="width: 25%"><?php echo ($v["p_user"]); ?></li>
                
                
            <?php }else{ ?>
            	 <li style="width: 25%;height: 30px;text-align:center;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo ($v["p_user"]); ?></li>
            	 <li style="width: 25%"><?php echo ($v["g_user"]); ?></li>
            
            <?php } ?>
            
           
            
            
            <li style="width: 20%"><?php echo ($v["lkb"]); ?></li>
            <li style="width: 20%" class="money"><?php echo ($v["jb"]); ?></li>
        </ul><?php endforeach; endif; ?>
	
            <?php if(is_array($lists)): foreach($lists as $key=>$v): ?><!-- 求购莱肯币菜单显示 -->
                <?php
 if($v['datatype']=='qglkb'){ ?>
                    <ul class="myjy_tj clode_<?php echo ($v["id"]); ?>";style="margin-bottom:80px">
                    <?php if($v["p_user"] == $_SESSION['username']): ?><li style="position: relative;">
                   	 <div class="pic_show single">
                                    <?php if(empty($v['imagepath'])): ?><button type="button" name="IconPath" class="upload_one<?php echo ($v["id"]); ?> fl" onclick="document.getElementById('upfileid_<?php echo ($v["id"]); ?>').click()" id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">上传图片</button>
                                    <input  type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" class="upfile" id="upfileid_<?php echo ($v["id"]); ?>"  jtype="qglkb"/>
                                    
                                    
                                     <?php else: ?>
                                     <!--<button type="button" name="IconPath"  id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">已经上传</button>-->
                                     
                                      <button type="button" name="IconPath" class="upload_one<?php echo ($v["id"]); ?> fl" onclick="document.getElementById('upfileid_<?php echo ($v["id"]); ?>').click()" id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">已经上传</button>
                                    <input  type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" class="upfile" id="upfileid_<?php echo ($v["id"]); ?>"  jtype="qglkb"/><?php endif; ?>
                                  <div class="show_box fr single">
        
                                        <ul id="lst_photo_other">
        
                                            <li>
        
                                            </li>
        
                                        </ul>
        
                                    </div>
        
                                </div>
                        
                     </li><?php endif; ?>
                
                    <?php if($v["g_user"] == $_SESSION['username']): ?><li><input type="button" class="ckpicture" value="查看图片" data-pic="请输入图片地址" style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;  -webkit-appearance: none;"/></li><?php endif; ?>
                    <?php if($v["p_user"] == $_SESSION['username']): ?><li class="bl2"<a><button class="btnmaijia"style=" width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">对方信息</button></a></li><?php endif; ?>
                    <?php if($v["g_user"] == $_SESSION['username']): ?><li class="bl2"><a><button class="btnmai"style=" width: 100%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">对方信息</button></a></li><?php endif; ?>
                    <?php if($ts == 0): ?><li class="bl2">
                     <button class="btntoushu"style=" width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">投诉<input class="tsid" type="hidden" value="1"/></button>
                    </li><?php endif; ?>
                    
                    <?php if($v["p_user"] == $_SESSION['username']): ?><li class="bl3" style="background-color:#3662f2"><a href="#" class="quxiao" style="background-color:#3662f2">取消交易</a></li><?php endif; ?>
                    
                    
                    <?php if($v["g_user"] == $_SESSION['username']): ?><li class="bl3" style="background-color:#3662f2"><a href="#" class="wancheng" style="background-color:#3662f2">完成交易</a></li><?php endif; ?>
                    
                </ul>
                <?php }?>
                
                <!-- 出售莱肯币显示菜单 -->
                <?php
 if($v['datatype']=='cslkb'){ ?>
                <ul class="myjy_tj clode_<?php echo ($v["id"]); ?>";style="margin-bottom:80px">
                
                    <li style="position: relative;">
                    <div class="pic_show single">
                                <?php if($v["g_user"] == $_SESSION['username']): if(empty($v['imagepath'])): ?><button type="button" name="IconPath" class="upload_one<?php echo ($v["id"]); ?> fl" onclick="document.getElementById('upfileid_<?php echo ($v["id"]); ?>').click()" id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">上传图片</button>
                                    <input   type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" class="upfile" id="upfileid_<?php echo ($v["id"]); ?>" jtype="cslkb"/>
                                    
                                   
                                   
                                   <?php else: ?>
                                     <!--<button type="button" name="IconPath"  id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">已经上传</button>-->
                                      <button type="button" name="IconPath" class="upload_one<?php echo ($v["id"]); ?> fl" onclick="document.getElementById('upfileid_<?php echo ($v["id"]); ?>').click()" id="photo_other"style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;">已经上传</button>
                                    <input   type="file" style=" opacity:0;filter:alpha(opacity=80);cursor:pointer;" name="photoimg" class="upfile" id="upfileid_<?php echo ($v["id"]); ?>" jtype="cslkb"/><?php endif; endif; ?>	
                                  <div class="show_box fr single">
        
                                        <ul id="lst_photo_other">
        
                                            <li>
        
                                            </li>
        
                                        </ul>
        
                                    </div>
        
                                </div>
                        
                        </li>
        
                <?php if($v["p_user"] == $_SESSION['username']): ?><li><input type="button" class="ckpicture" value="查看图片" data-pic="请输入图片地址" style="font-size:14px; width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;  -webkit-appearance: none;"/></li><?php endif; ?>   
                
                <?php if($v["g_user"] == $_SESSION['username']): ?><li class="bl2"<a><button class="btnmai"style=" width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">对方信息</button></a></li><?php endif; ?> 	
                <?php if($v["p_user"] == $_SESSION['username']): ?><li class="bl2"><a><button class="btnmaijia"style=" width: 100%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">对方信息</button></a></li><?php endif; ?> 	
                    
                    <li class="bl2">
                     <button class="btntoushu"style=" width: 95%;height: 30px;border:0px;border-radius: 5px;background-color: #3662f2;display: block;line-height: 30px;color: #000000;font-size:14px;">投诉<input class="tsid" type="hidden" value="1"/></button>
                    </li>
                
                <?php if($v["g_user"] == $_SESSION['username']): ?><li class="bl3" style="background-color:#3662f2"><a href="#" class="csquxiao" style="background-color:#3662f2">取消</a></li><?php endif; ?>
                
                <?php if($v["p_user"] == $_SESSION['username']): ?><li class="bl3" style="background-color:#3662f2"><a href="#" class="cswancheng" style="background-color:#3662f2">完成交易</a></li><?php endif; ?>
                    
                </ul>
                
               <?php } endforeach; endif; ?>
    </div>
	 <div style="width:90%;margin-left:5%;padding-top:30px;font-size:12px">
		<P>交易提示：</P>
		<P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;为保护您的资金安全，请使用您个人资料内绑定的支付方式向对方绑定的收款账号内付款，付款后请上传付款凭证图片，如使用绑定账户以外的账户交易，系统无法监管，会检测为虚假交易。</P>
	</div>
</div>
<div id="ywcjy"style="display: none;margin-bottom:80px;margin-top:-50px">
    <table class="jyzx_list" style="margin-top:60px;border-collapse:collapse;width:90%;margin-left:5%">
        <thead>
        <tr style="width:100%;">
            <th style="padding:10px 0;width: 10%">日期</th>
            <th style="padding:10px 0;width: 30%">卖家</th>
            <th style="padding:10px 0;width: 30%">买家</th>
            <th style="padding:10px 0;width: 15%">数量</th>
            <th style="padding:10px 0;width: 25%">总价</th>
          
        </tr>
        </thead>
        <tbody >
		 <?php if(is_array($oob)): foreach($oob as $key=>$s): ?><tr>
            <td style="height:30px;line-height:30px;padding-left:10px;text-align:center;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo date("Y-m-d",strtotime($s['jydate']));?></td>
            <!--<td style="height:30px;line-height:30px;text-align:center;font-size:12px; "class=" iconfont">
            <?php if($s['datatype'] == 'qglkb'): ?>买入
            <?php else: ?>
            	卖出<?php endif; ?>
           
            
            
            </td>-->
            
            
            
              <?php
 if($s['datatype']=='qglkb'){ ?> 
            	
            <td style="height:30px;line-height:30px;text-align:center;"><?php echo ($s["g_user"]); ?></td>
            <td style="height:30px;line-height:30px;text-align:center;"><?php echo ($s["p_user"]); ?></td>
                
                
            <?php }else{ ?>
            	<td style="height:30px;line-height:30px;text-align:center;"><?php echo ($s["p_user"]); ?></td>
                <td style="height:30px;line-height:30px;text-align:center;"><?php echo ($s["g_user"]); ?></td>
            
            <?php } ?>
            
            
            <td style="height:30px;line-height:30px;text-align:center;"><?php echo ($s["lkb"]); ?></td>
            <td style="height:30px;line-height:30px;text-align:center;" ><?php echo ($s["jb"]); ?></td>
            
        </tr><?php endforeach; endif; ?>

        </tbody>
    </table>
    
    
 <div id="pages"><?php echo ($page); ?></div>   
</div>
<!--底部开始-->
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

	<!--底部结束-->
<script src="/Public/gec/web/js/jquery-weui.min.js"></script>	




	
<script>


    document.getElementById('photo').addEventListener('change',function(e){
        var files = this.files;
        var img = new Image();
        var reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onload = function(e){
            var mb = (e.total/1024)/1024;
            if(mb>= 2){
                alert('文件大小大于2M');
                return;
            }
            img.src = this.result;
            img.style.height="100%";
            document.getElementById('click').innerHTML = '';
            document.getElementById('click').appendChild(img);
            $(".div1").css({"background":"#FFF"});
            $(".div2").html("<span style='float:right;margin-right:5px;color:#e4393c;'>成功</span>")
        }
    });
</script>
<!--底部结束-->


<!-- 汇率转换 -->
	<script>
    $(function(){
		$(".money").bind("click",function(){
			var huilv=$(this).html();
			$("#UpBox").fadeOut();
			$.ajax({
				url:"<?php echo U('Emoney/huilv');?>",
				type:"get",
				data:{id:$("#UpBox").find(".opid").val(),huilv:huilv},
				dataType:"json",
				success:function(data){
				console.log(data);
					$.modal({
                        title: data.name,
                        text: "美元："+huilv+"<br>"+"人民币："+data.rmb+"<br>"+"比特币："+data.btc,
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
<script>
     function showhidediv(id) {
        console.log(id);
        var qiugou = document.getElementById("qiugou");
        var chushou=document.getElementById("chushou");
        var zhengzai = document.getElementById("zzjy");
        var wancheng = document.getElementById('ywcjy');
        var qiugoubg = document.getElementById("qiugoubg");
        var chushoubg=document.getElementById("chushoubg");
        var zhengzaibg = document.getElementById('zzjybg');
        var wancehngbg = document.getElementById('ywcjybg');
        if (id == "zzjy") {
            wancheng.style.display = 'none';
            zhengzai.style.display = 'block';
            qiugou.style.display = 'none';
            chushou.style.display = 'none';
            qiugoubg.style.backgroundColor = "#3662f2"
			qiugoubg.style.color = "#fff"
            chushoubg.style.backgroundColor = "#3662f2"
            chushoubg.style.color = "#fff"
            zhengzaibg.style.backgroundColor = "#fff";
			zhengzaibg.style.color = "#000";
            wancehngbg.style.backgroundColor = "#3662f2";
			wancehngbg.style.color = "#fff";
        }else if (id =='chushou') {
            zhengzai.style.display = 'none';
            wancheng.style.display = 'none';
            qiugou.style.display = 'none';
            chushou.style.display='block';
            chushoubg.style.backgroundColor = "#fff";
            qiugoubg.style.backgroundColor = "#3662f2";
            zhengzaibg.style.backgroundColor = "#3662f2";
            wancehngbg.style.backgroundColor = "#3662f2";
            qiugoubg.style.color= "#fff"
            zhengzaibg.style.color = "#fff";
            wancehngbg.style.color = "#fff";
            chushoubg.style.color = "#000";
        }else if (id =='ywcjy') {
                zhengzai.style.display = 'none';
                wancheng.style.display = 'block';
                qiugou.style.display = 'none';
                chushou.style.display = 'none';
                qiugoubg.style.backgroundColor = "#3662f2"
                chushoubg.style.backgroundColor = "#3662f2"
                zhengzaibg.style.backgroundColor = "#3662f2";
				qiugoubg.style.color= "#fff"
				chushoubg.style.color= "#fff"
                zhengzaibg.style.color = "#fff";
                wancehngbg.style.backgroundColor = "#fff";
				wancehngbg.style.color = "#000";
            }else if(id=='qiugou'){
                chushou.style.display='none';
                zhengzai.style.display = 'none';
                wancheng.style.display = 'none';
                qiugou.style.display = 'block';
                qiugoubg.style.backgroundColor = "#fff";
				qiugoubg.style.color = "#000";
                zhengzaibg.style.backgroundColor = "#3662f2";
                chushoubg.style.backgroundColor = "#3662f2";
                wancehngbg.style.backgroundColor = "#3662f2";
				zhengzaibg.style.color = "#fff";
                wancehngbg.style.color = "#fff";
                chushoubg.style.color = "#fff";
                }
    }
	
	//showhidediv("ywcjy");
</script>
<?php if(isset($_GET['p']) && !empty($_GET['p'])){?>
<script type="text/javascript">
	showhidediv("ywcjy");
</script>
<?php } ?>
<!--投诉-->
<script>
    $(".btntoushu").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.showLoading();
            $.ajax({
                url:"<?php echo U('Emoney/gettime');?>",
                type:"get",
                data:{id:oid},
                dataType:"json",
                success:function(data){
                    var time=new Date().getTime();
                    var time2=data*1000;
                    if(time>time2){
                       $.prompt("请输入您要投诉的内容", function () {
                                $.ajax({
                                    url: "<?php echo U('Emoney/tousu');?>",
                                    ype: "get",
                                    data: {id: oid, txt: $("#weui-prompt-input").val()},
                                    success: function (data) {
                                        console.log(data);
                                        $.alert(data);
                                    },
                                    error: function () {
                                        alert("网络错误请重试");
                                    }
                                });
                            })

                    }else{
                        var time1=parseInt(time/1000);
                        var dd=parseInt(parseInt(time2)/1000-time1);
                        var h=parseInt(dd/3600);
                        var m=parseInt(dd%3600/60);
                        var s=parseInt(dd%3600%60);
                        console.log(dd,h,m,s);
                        h=h.toString().length==1?"0"+h:h;
                        m=m.toString().length==1?"0"+m:m;
                        s=s.toString().length==1?"0"+s:s;
                        var str=h+":"+m+":"+s;
                        $.alert(str,'现在无法投诉',function(){
                          location.reload();
                        });
                        var djs=setInterval(function(){
                            time1++;
                            dd=parseInt(parseInt(time2)/1000-time1);
                            h=parseInt(dd/3600);
                            m=parseInt(dd%3600/60);
                            s=parseInt(dd%3600%60);
                            h=h.toString().length==1?"0"+h:h;
                            m=m.toString().length==1?"0"+m:m;
                            s=s.toString().length==1?"0"+s:s;
                            str=h+":"+m+":"+s;
                            if(parseInt(h)<=0&&parseInt(m)<=0&&parseInt(s)<=0){
                               $(".weui_dialog_bd").html("可以投诉了,请重新点击");
                               clearInterval(djs);
                            }else{
                               $(".weui_dialog_bd").html(str);
                            }
                        },1000);
                    }

                },error:function(){
                    console.log("网络错误");
                },complete:function(){
                    $.hideLoading();
                }    
            });
        }
    })
</script>
<!--卖家信息-->
<script>
    $(".btnmaijia").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.ajax({
                url:"<?php echo U('Emoney/mjxx');?>",
                type: "get",
                data: {id: oid, txt: $("#weui-prompt-input").val()},
                success: function (data) {
				console.log(data);
                    $.modal({
                        title: data.name,
                        text: "<div style='text-align:left'><i class='fa fa-usd' style='color: #00FF00;width: 12px;margin:0 auto;font-size: 1.2em;margin-left: -2px;'></i>："+data.meiyuan+"&nbsp;&nbsp;美金<br/>"+"<i class='fa fa-jpy' style='color: #FF0000;width: 12px;margin:0 auto;font-size: 1.2em;margin-left: -2px;'></i>："+data.rmb+"&nbsp;&nbsp;元人民币<br>"+"手机号："+data.username+"<a href='tel:"+data.username+"'><input type='button' value='拨打电话' style='margin-left:5px; padding:3px 7px; border:0px; border-radius:4px; color:#ffffff; background:#09F;'></a><br>"+"姓名："+data.truename+"<br><img src=\""+data.alipay_voucher+"\" width='30%'><br/><font style='color:#F00;'>友情提示：长按图片，点击保存，请认真核对交易信息或者电话沟通确认交易！</font></div>",
                        buttons:[
                            { text: "确定", className: "default", onClick: function(){ } },
                        ]
                    })
                },
                error: function () {
                    $.alert("网络错误请重试");
                }
            });
            }
    })
</script>
<!--买家信息-->
<script>
    $(".btnmai").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.ajax({
                url:"<?php echo U('Emoney/maijia');?>",
                type: "get",
                data: {id: oid, txt: $("#weui-prompt-input").val()},
                success: function (data) {
				console.log(data);
                    $.modal({
                        title: data.name,
                        text: "<div style='text-align:left'><i class='fa fa-usd' style='color: #00FF00;width: 12px;margin:0 auto;font-size: 1.2em;margin-left: -2px;'></i>："+data.meiyuan+"&nbsp;&nbsp;美金<br/>"+"<i class='fa fa-jpy' style='color: #FF0000;width: 12px;margin:0 auto;font-size: 1.2em;margin-left: -2px;'></i>："+data.rmb+"&nbsp;&nbsp;元人民币<br>"+"手机号："+data.username+"<a href='tel:"+data.username+"'><input type='button' value='拨打电话' style='margin-left:5px; padding:3px 7px; border:0px; border-radius:4px; color:#ffffff; background:#09F;'></a><br>"+"姓名："+data.truename+"<br><img src=\""+data.alipay_voucher+"\" width='30%'><br/><font style='color:#F00;'>友情提示：长按图片，点击保存，请认真核对交易信息或者电话沟通确认交易！</font></div>",

                        buttons:[
                            { text: "确定", className: "default", onClick: function(){ } },
                        ]
                    })
                },
                error: function () {
                    $.alert("网络错误请重试");
                }
            });
            }
    })
</script>
<!--图片-->
<script>
    $(".ckpicture").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.ajax({
                url:"<?php echo U('Emoney/cktp');?>",
                type: "get",
                data: {id: oid},
                success: function (data) {
				  $.modal({
                        title:"",
                        text: "<img src=\""+data+"\" width='60%'>",
                        buttons:[
                            { text: "确定", className: "default", onClick: function(){ } },
                        ]
                    })
                },
                error: function () {
                    $.alert("网络错误请重试");
                }
            });
        }
    })
    $(".quxiao").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.confirm("您确定要取消订单吗？",function(){
                $.ajax({
                    url:"<?php echo U('Emoney/qxdd');?>",
                    type: "post",
                    data: {id: oid},
					dataType:"json",
                    success: function (json) {
						
                       if(json.result==1){
							 $.alert(json.msg, function () {
                                location.href ="<?php echo U('Emoney/myjiaoyi');?>";
                            });
						}else{
							 $.alert(json.msg);
						}
						
                    },
                    error: function () {
                        $.alert("网络错误请重试");
                    }
                });
            })
        }
    })
	//出售取消
	 $(".csquxiao").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else {
            $.confirm("您确定要取消订单吗？",function(){
                $.ajax({
                    url:"<?php echo U('Emoney/csqx');?>",
                    type: "post",
                    data: {id: oid},
					dataType:"json",
                    success: function (json) {
						
						if(json.result==1){
							 $.alert(json.msg, function () {
                                location.href ="<?php echo U('Emoney/myjiaoyi');?>";
                            });
						}else{
							 $.alert(json.msg);
						}
						
						
                    },
                    error: function () {
                        $.alert("网络错误请重试");
                    }
                });
            })
        }
    })
	
	
    $(".wancheng").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else if(<?php echo ($tp); ?>==2){
			$.alert("请等待对方付款完成！");
		}else{
            $.confirm("您确定要完成订单吗？",function(){
                $.ajax({
                    url:"<?php echo U('Emoney/wancheng');?>",
                    type: "get",
                    data: {id: oid},
                    success: function (data) {
					dataType:"json",
					console.log(data.msg);
                        if (data.status == 1) {
                            $.alert(data.msg, function () {
                                location.href ="/Index.php/index/Emoney/myjiaoyi";
                            });
                        } else {

                        $.alert(data);
                    }
                    },
                    error: function() {
                        $.alert("网络错误请重试");
                    }
                });
            })
        }
    })
	
	
	//出售订单完成
	$(".cswancheng").bind("click",function() {
        var oid="";
        $(".xz").map(function(index,item){
            if($(this).is(":checked")){
                oid=$(this).val();
            }
        })
        if(oid==""){
            $.alert("请选择要操作的订单");
        }else if(<?php echo ($tp); ?>==2){
			$.alert("请等待对方付款完成！");
		}else{
            $.confirm("您确定要完成订单吗？",function(){
                $.ajax({
                    url:"<?php echo U('Emoney/cswancheng');?>",
                    type: "get",
                    data: {id: oid},
                    success: function (data) {
					dataType:"json",
					console.log(data.msg);
                        if (data.status == 1) {
                            $.alert(data.msg, function () {
                                location.href ="/Index.php/index/Emoney/myjiaoyi";
                            });
                        } else {

                        $.alert(data);
                    }
                    },
                    error: function() {
                        $.alert("网络错误请重试");
                    }
                });
            })
        }
    })
</script>

<!--取消交易-->




<script type="text/javascript">
	$(".myjy_tj").hide();
	var order_id = $("input[name='xz']:checked").val();
	$(".clode_"+order_id).show();
	$(".redio_all").click(function(){
		$(".myjy_tj").hide();
		var order_id_a = $("input[name='xz']:checked").val();
		$(".clode_"+order_id_a).show();
		
	})
	

</script>




<script src="/Public/gec/web/js/jquery.form.js"></script>
<script src="/Public/js/layer/layer.js"></script>


<script type="text/javascript">
 
$(function(){
	 
	
	$(".upfile").wrap("<form action='' method='post' enctype='multipart/form-data'></form>"); 
	
	$(".upfile").off().on('change',function(){
		
		var order_id = $("input[name='xz']:checked").val();
		if(order_id==""){
			$.alert("请选中需要操作的订单！");
			return false;
				
		}
		
		var jtype=$(this).attr("jtype");
		
		
		
		var objform = $(this).parents();
			objform.attr("action","/index.php/index/emoney/uploadsmax/id/"+order_id+"/jtype/"+jtype);
			
			
			
		    objform.ajaxSubmit({
			dataType:  'json',
			//target: '#preview', 
			//beforeSubmit:function(){
				//status.show();
				//btn.hide();
			//}, 
			success:function(data){
				layer.msg(data.msg);
				
				if(data.result==1){
					
					$(".upload_one"+order_id).html(data.msg);
					//window.location.reload();
					
					$("#upfileid_"+order_id).attr("disabled","disabled");
					
				}else{
					
					$(".upload_one"+order_id).html('<font style="color:red;">'+data.msg+'</font>')
					
				}
			}, 
			error:function(){
				//status.hide();
				//btn.show();
			} 
		});
		
		
		
	});
	
	
	
	
	
	
	
   });


 
 </script>












</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/vipinside_1.css" />
    <link rel="stylesheet" type="text/css" href="css/systemcss_1.css" />
    <script type="text/javascript" charset="utf-8" src="js/jquery-1.11.2.min_1.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jquery.form.min_1.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jquery.colorpicker_1.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jqselect_1.js"></script>
    <script type="text/javascript" src="js/jquery.validate_1.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //add validator method
            jQuery.validator.addMethod("isel", function (value, element) {
                var dir = $("input[name='dirs']").val();
                if (dir == "" || dir == null) {
                    return false;
                }
                return true;
            }, "请选择目录.");
            jQuery.validator.addMethod("isurl", function (value, element) {
                var regx = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
                if (value == "" || value == null) {
                    return true;
                }
                if (regx.test(value)) {
                    return true;
                }
                return false;
            }, "请输入正确的网址.");
            jQuery.validator.addMethod("qqformat", function (value, element) {
                if (value == "" || value == null) {
                    return true;
                }
                var regx = /^\d{5,11}$/;
                var qqs = value.split(";");
                var falg = false;
                $.each(qqs, function (i) {
                    falg = regx.test(qqs[i]) ? true : false;
                });
                return falg;
            }, "请输入正确的qq");
            jQuery.validator.addMethod("emailformat", function (value, element) {
                if (value == "" || value == null) {
                    return true;
                }
                var mail_arr = value.split(";");
                //alert(mail_arr);
                var regx = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                var flag = false;
                $.each(mail_arr, function (i) {
                    flag = !regx.test(mail_arr[i]) ? false : true;
                });
                return flag;
            }, "请输入正确的邮箱地址");

            jQuery.validator.addMethod("numcount", function (value, element) {
                var pattern = /^[1-9]\d*$/;
                return this.optional(element) || pattern.test(value);
            });
            jQuery.validator.addMethod("timescount", function (value, element) {
                var pattern = /^[0-9]\d*$/;
                return this.optional(element) || pattern.test(value);
            });
            //validation
            $("#form1").validate({
                rules: {
                    ProductName: "required",
                    FaceValue: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    BuyCountStartNum: {
                        required: true,
                        numcount: true
                    },
                    BuyCountEndNum: {
                        required: true,
                        numcount: true
                    },
                    buyTimes: {
                        required: true,
                        timescount: true
                    },
                    dirs: "isel",
                    PrescriptionDateTime: "digits",
                    RechargeUrl: "isurl",
                    qqString: "qqformat",
                    emailString: "emailformat"
                },
                messages: {
                    ProductName: {
                        required: "请填写商品名称."
                    },
                    FaceValue: {
                        required: "请输入面值.",
                        number: "面值为数字类型",
                        min: "商品面值不得小于0"
                    },
                    BuyCountStartNum: {
                        required: "不能为空",
                        numcount: "格式错误"
                    },
                    BuyCountEndNum: {
                        required: "不能为空",
                        numcount: "格式错误"
                    },
                    buyTimes: {
                        required: "不能为空",
                        timescount: "格式错误"
                    },
                    PrescriptionDateTime: {
                        digits: "请输入正确的售后天数."
                    }
                },
                errorPlacement: function (error, element) {
                    $(element).parent().children('span').last().html(error);
                }
            });
            $("input[name='bold']").click(function () {
                if ($(this).prop("checked")) {
                    $("input[name='ProductName']").css("font-weight", "bold");
                    $("input[name='ProductTitleIsBold']").val("True");
                } else {
                    $("input[name='ProductName']").css("font-weight", "normal");
                    $("input[name='ProductTitleIsBold']").val("False");
                }
            });
            $("#cp3").colorpicker({
                fillcolor: true,
                success: function (o, color) {
                    $("input[name='goodTitleStyle']").val(color);
                    $("#ProductName").css("color", color);
                }
            });
            //设置目录
            $("input[name='dirBox']").click(function () {
                var catalog = []
                $.each($("input[name='dirBox']:checked"), function (item,i) {
                    catalog.push($(this).val());
                });
                $("input[name='dirs']").val(catalog.join(","));
            });
            SaleStateChange();
        });
        //销售状态
        function SaleStateChange() {
            if ($("input[name='SaleState']:checked").val() == "2") {
                $("#tr_reason").show();
            }
            else {
                $("#tr_reason").hide();
            }
        }
    </script>

</head>
<body>
    <div id="scontainer">
        <div class="right_title">
            <div class="class_name yahei">
                <h1>
                    <a class="white" href="javascript:" onclick="window.history.go(-1)"><strong>返回列表</strong></a>&nbsp;-&nbsp;添加商品
                </h1>
            </div>
            <div class="right_subnav">
                当前位置：<a>供货商商品管理</a> &gt; <a>添加商品</a>
            </div>
        </div>
        <form name="form1" method="post" id="form1">
            <input type="hidden" name="goodId" value="0" />
            <div class="right_container">
                <table cellpadding="0" cellspacing="0" class="number_reg">
                    <tr>
                        <td class="table_th" colspan="2">
                            <strong>注：</strong>以下带<label style="color: red;">*</label>内容项为必填项
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info">
                            <span style="color: red;">*</span><label for="ProductName">商品名称</label>：
                        </td>
                        <td class="num_reg_input">
                            <input Style="width:430px;color:;font-weight:;" class="sort_input" id="ProductName" maxlength="300" name="ProductName" type="text" value="" />
                            <img src="picture/colorpicker_1.png" id="cp3" style="cursor:pointer;" />
                            <label><input type="checkbox" name="bold"  />粗体</label>
                            <input type="hidden" name="ProductTitleIsBold" value="True" />
                            <input type="hidden" name="goodTitleStyle" />
                            <span style="color: red;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info">
                            <span style="color: red;">*</span><label for="FaceValue">商品面值</label>：
                        </td>
                        <td class="num_reg_input tdleft">
                            <input class="sort_input" data-val="true" data-val-number="字段 FaceValue 必须是一个数字。" data-val-required="FaceValue 字段是必需的。" id="FaceValue" name="FaceValue" type="text" value="0" />
                            <label class="prompt"><?=$moneytype?></label>&nbsp;&nbsp;<span style="color: red;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info">
                            <span style="color: red;">*</span><label>所属商品目录</label>：
                        </td>
                        <td class="num_reg_input tdleft">
                            <div style="width: 580px; height: 170px; overflow: auto; border: 1px solid #e0e0e0;">
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:;">1111</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">【平台公告】本站为好卡售系统官方货源站，欢迎好卡售系列（包括分销系统）旗下同系统主站对接+串货本站货源，上万商品随意购买</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">【平台公告】本站为好卡售系统官方货源站，欢迎好卡售系列（包括分销系统）旗下同系统主站对接+串货本站货源，上万商品随意购买</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">【每周有特价】本栏目下商品每周上架的商品种类不一，天天更新放入新商品！微信充值机器人：LLKA52 全天24小时，自动免手续费充值！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111379" />---- 【免费送】亲们┇免费送活动商品</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111378" />---- 【青春】推荐┇QQ蓝钻┇全天秒单</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111380" />---- 【青果】推荐┇QQ豪华黄┇全天秒单</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【平台公告】：感谢昨天的失败者．今天的坚持者．明天的成功者．这么久对本卡盟平台的厚爱与支持．手机APP软件下载：http://fir.im/haokashou</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【平台公告】：全新面貌．全新功能．期待您的品鉴．所有功能．所有商品全部正常．可正常购买．</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【平台公告】：全新面貌．全新功能．期待您的品鉴．所有功能．所有商品全部正常．可正常购买．</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">【每周有特价】本栏目下商品每周上架的商品种类不一，天天更新放入新商品！微信充值机器人：LLKA52 全天24小时，自动免手续费充值！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112091" />---- 【免费送】亲们┇免费送活动商品</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112090" />---- 【青春】推荐┇QQ蓝钻┇全天秒单</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112092" />---- 【青果】推荐┇QQ豪华黄┇全天秒单</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【平台公告】：感谢昨天的失败者．今天的坚持者．明天的成功者．这么久对本卡盟平台的厚爱与支持．手机APP软件下载：http://fir.im/haokashou</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———无法充值加款请联系站长QQ：81048575 手动加款---免手续费--- 觉得此平台好用，请分享你身边的朋友们噢！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———新注册的代理们：卡盟代理级别→LV１→LV２→LV３→LV４→LV５→LV６→LV７→LV8（最高级别拿货价最便宜）！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【售后客服】———对订单有任何问题联系~7&#215;24小时在线客服QQ：【55732730】客服QQ：【865842042】站长QQ：【81048575】！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———让你的朋友来平台注册代理填写你的编号（他消费后你还有提成返利赚哦）———【享受网赚】！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———新注册的代理们：卡盟代理级别→LV１→LV２→LV３→LV４→LV５→LV６→LV７→LV8（最高级别拿货价最便宜）！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———无法充值加款请联系站长QQ：81048575 手动加款---免手续费--- 觉得此平台好用，请分享你身边的朋友们噢！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【温馨提示】———让你的朋友来平台注册代理填写你的编号（他消费后你还有提成返利赚哦）———【享受网赚】！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【售后客服】———对订单有任何问题联系~7&#215;24小时在线客服QQ：【55732730】客服QQ：【865842042】站长QQ：【81048575】！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台对接】———优势商品|每天都低价丨天天有惊喜丨全网最低价格丨本平台支持全网任意系统对接★☆对接返现百分之3%-5%余额丨大力扶持中小型站长！ </span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台对接】———优势商品|每天都低价丨天天有惊喜丨全网最低价格丨本平台支持全网任意系统对接★☆对接返现百分之3%-5%余额丨大力扶持中小型站长！ </span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台充值】———微信免手续费加款：LLKA52  全天24小时自动充值，转账备注平台编号，自动加款，无需手续费，秒到账！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台充值】———QQ免手续费加款：810450107  全天24小时自动充值，转账备注平台编号，自动加款，无需手续费，秒到账！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台充值】———微信免手续费加款：LLKA52  全天24小时自动充值，转账备注平台编号，自动加款，无需手续费，秒到账！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">✅【平台充值】———QQ免手续费加款：81040253  全天24小时自动充值，转账备注平台编号，自动加款，无需手续费，秒到账！</span></label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 各类影视会员，爱奇艺+腾讯视频+优酷+芒果TV+搜狐视频+乐视视频，官方激活码业务，绝对低价+稳定！★★★欢迎大家批发</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111296" />---- ☆爱奇艺会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111297" />---- ☆腾讯视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111298" />---- ☆优酷视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111299" />---- ☆搜狐视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111300" />---- ☆乐视影视会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111301" />---- ☆芒果TV会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111302" />---- ☆豪华绿+音乐包☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111303" />---- ☆腾讯文学会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111304" />---- ☆QQ付费音乐包☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111305" />---- ☆迅雷白金会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111306" />---- ☆东鹏特饮红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111307" />---- ☆腾讯体育会员☆丨正规直充（官方卡） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111308" />---- ☆可口可乐抽奖码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111309" />---- ☆酷我音乐会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111310" />---- ☆酷狗音乐会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111311" />---- ☆蒙牛现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111312" />---- ☆营优可红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111313" />---- ☆壳牌微信红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111314" />---- ☆百威现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111315" />---- ☆康师傅绿茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111316" />---- ☆康师傅红茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111317" />---- ☆腾讯现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111318" />---- ☆太古可口可乐红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111319" />---- ☆沃百富现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111320" />---- ☆伊利巧乐兹红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111321" />---- ☆蒙牛冰淇淋红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111322" />---- ☆康师傅茉莉茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111323" />---- ☆美年达微信红包码☆丨正规直充（官方卡）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 各类影视会员，爱奇艺+腾讯视频+优酷土豆，官方直充业务，绝对低价+稳定！★★★欢迎大家批发</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112146" />---- ☆爱奇艺会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112147" />---- ☆腾讯视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112149" />---- ☆搜狐视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112150" />---- ☆乐视影视会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112151" />---- ☆芒果TV会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112152" />---- ☆豪华绿+音乐包☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112148" />---- ☆优酷视频会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112153" />---- ☆腾讯文学会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112154" />---- ☆QQ付费音乐包☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112155" />---- ☆迅雷白金会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112156" />---- ☆东鹏特饮红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112157" />---- ☆腾讯体育会员☆丨正规直充（官方卡） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112158" />---- ☆可口可乐抽奖码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112159" />---- ☆汽车报价红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112160" />---- ☆酷我音乐会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112161" />---- ☆酷狗音乐会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112162" />---- ☆康师傅奶茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112163" />---- ☆蒙牛现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112164" />---- ☆营优可红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112165" />---- ☆壳牌微信红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112166" />---- ☆街电白银会员☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112167" />---- ☆百威现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112168" />---- ☆康师傅绿茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112169" />---- ☆康师傅红茶红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112170" />---- ☆腾讯现金红包码☆丨正规直充（官方卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112171" />---- ☆太古可口可乐红包码☆丨正规直充（官方卡）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-QQ空间代刷业务(7*24小时自动发货) -完美售后★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111338" />---- 下单秒刷-特色名片赞（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111341" />---- 下单秒刷-低价名片赞（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111340" />---- 下单秒刷-招牌快刷名片赞（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111342" />---- 下单秒刷-特价QQ名片赞（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111325" />---- 下单秒刷-平台直供名片赞（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111344" />---- 下单秒刷-QQ个性标签赞（日刷20万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111343" />---- 下单秒刷-特价空间人气（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111326" />---- 下单秒刷-官方直供人气（日刷50万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111345" />---- 下单秒刷-招牌空间人气（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111339" />---- 下单秒刷-牛逼人气（日刷千万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111327" />---- 下单秒刷-QQ空间留言（日刷1000） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111336" />---- 下单秒刷-秒刷说说赞（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111328" />---- 下单秒刷-官方说说赞（日刷1000）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111329" />---- 下单秒刷-说说浏览（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111330" />---- 下单秒刷-说说转发（日刷1000）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111331" />---- 下单秒刷-QQ空间主页赞（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111332" />---- 下单1-24小时刷-包月说说赞（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111333" />---- 下单秒拉-QQ圈圈赞（拉满）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111334" />---- 下单1-24小时刷-厘米秀（日刷200）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111335" />---- 下单秒刷-腾讯名片赞（日刷100万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111337" />---- 下单1-12小时刷-说说评论（日刷2000）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 各类影视会员，爱奇艺+腾讯视频+优酷+芒果TV+搜狐视频+乐视视频，官方直充业务，活动价钱商品，特价年费直充业务，先买先赚！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111348" />---- ☆爱奇艺会员☆丨年费直充（活动卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111349" />---- ☆优酷视频会员☆丨年费直充（活动卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111350" />---- ☆腾讯视频会员☆丨年费直充（活动卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111351" />---- ☆网易云音乐会员☆丨年费直充（活动卡）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111352" />---- ☆百度贴吧会员☆丨年费直充（活动卡）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-快手粉丝业务代刷(7*24小时自动发货) -完美售后★★★     在线获取快手ID地址：http://t.cn/Rn7Yepb</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111778" />---- 下单秒刷-特价快手粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111782" />---- 下单秒刷-真人快手粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111783" />---- 下单秒刷-招牌快手粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111777" />---- 下单秒刷-直供快手双击（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111784" />---- 下单秒刷-特色快手双击（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111779" />---- 下单秒刷-直供快手播放（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111785" />---- 下单秒刷-特色快手播放（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111781" />---- 下单秒刷-特价快手评论（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111787" />---- 下单秒刷-招牌快手评论（日刷2万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111786" />---- 下单秒刷-特价快手直播点亮（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111788" />---- 下单秒刷-特价快手直播人气（开播后下单）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-QQ空间代刷业务(7*24小时自动发货) -完美售后★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112083" />---- 下单秒刷-招牌快刷名片赞（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112085" />---- 下单秒刷-特价QQ名片赞（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112068" />---- 下单秒刷-平台直供名片赞（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112084" />---- 下单秒刷-低价名片赞（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112081" />---- 下单秒刷-特色名片赞（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112087" />---- 下单秒刷-QQ个性标签赞（日刷20万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112086" />---- 下单秒刷-特价空间人气（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112069" />---- 下单秒刷-官方直供人气（日刷50万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112088" />---- 下单秒刷-招牌空间人气（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112082" />---- 下单秒刷-牛逼人气（日刷千万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112070" />---- 下单秒刷-QQ空间留言（日刷1000） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112079" />---- 下单秒刷-秒刷说说赞（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112071" />---- 下单秒刷-官方说说赞（日刷1000）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112072" />---- 下单秒刷-说说浏览（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112073" />---- 下单秒刷-说说转发（日刷1000）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112074" />---- 下单秒刷-QQ空间主页赞（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112075" />---- 下单1-24小时刷-包月说说赞（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112076" />---- 下单秒拉-QQ圈圈赞（拉满）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112077" />---- 下单1-24小时刷-厘米秀（日刷200）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112078" />---- 下单秒刷-腾讯名片赞（日刷100万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112080" />---- 下单1-12小时刷-说说评论（日刷2000）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-快手粉丝业务代刷(7*24小时自动发货) -完美售后★★★     在线获取快手ID地址：http://t.cn/Rn7Yepb</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112133" />---- 下单秒刷-特价快手粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112137" />---- 下单秒刷-真人快手粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112138" />---- 下单秒刷-招牌快手粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112132" />---- 下单秒刷-直供快手双击（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112139" />---- 下单秒刷-特色快手双击（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112134" />---- 下单秒刷-直供快手播放（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112140" />---- 下单秒刷-特色快手播放（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112136" />---- 下单秒刷-特价快手评论（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112142" />---- 下单秒刷-招牌快手评论（日刷2万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112141" />---- 下单秒刷-特价快手直播点亮（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112143" />---- 下单秒刷-特价快手直播人气（开播后下单）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-全民K歌业务代刷(7*24小时自动发货) -完美售后★★★ 在线获取全民k歌歌曲ID地址：http://t.cn/Rn7Yepb</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112121" />---- 下单秒刷-特价全民K歌粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112122" />---- 下单秒刷-招牌全民K歌粉丝（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112123" />---- 下单秒刷-直供全民K歌鲜花（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112124" />---- 下单秒刷-特色全民K歌鲜花（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112125" />---- 下单秒刷-特价全民K歌播放（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112126" />---- 下单秒刷-真人全民K歌播放（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112127" />---- 下单秒刷-特价全民K歌评论（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112128" />---- 下单秒刷-真人全民K歌评论（日刷3万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112129" />---- 下单秒刷-直供全民K歌转发（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112130" />---- 下单秒刷-特色全民K歌转发（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112131" />---- 下单秒刷-招牌全民K歌经验（日刷10万）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-全民K歌业务代刷(7*24小时自动发货) -完美售后★★★ 在线获取全民k歌歌曲ID地址：http://t.cn/Rn7Yepb</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111354" />---- 下单秒刷-特价全民K歌粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111355" />---- 下单秒刷-招牌全民K歌粉丝（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111356" />---- 下单秒刷-直供全民K歌鲜花（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111357" />---- 下单秒刷-特色全民K歌鲜花（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111358" />---- 下单秒刷-特价全民K歌播放（日刷10万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111359" />---- 下单秒刷-真人全民K歌播放（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111360" />---- 下单秒刷-特价全民K歌评论（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111361" />---- 下单秒刷-真人全民K歌评论（日刷3万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111362" />---- 下单秒刷-直供全民K歌转发（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111363" />---- 下单秒刷-特色全民K歌转发（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111364" />---- 下单秒刷-招牌全民K歌经验（日刷10万）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-火山小视频业务代刷(7*24小时自动发货) -完美售后★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112095" />---- 下单秒刷-特价火山视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112096" />---- 下单秒刷-真人火山视频粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112097" />---- 下单秒刷-招牌火山视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112098" />---- 下单秒刷-直供火山视频双击（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112099" />---- 下单秒刷-特色火山视频双击（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112100" />---- 下单秒刷-特价火山视频评论（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112101" />---- 下单秒刷-招牌火山视频评论（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112102" />---- 下单秒刷-直供火山视频分享（日刷3万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112103" />---- 下单秒刷-招牌火山视频分享（日刷1万）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-抖音短视频业务代刷(7*24小时自动发货) -完美售后★★★ 如何获取抖音作品id教程：复制作品链接地址，比如：https://www.douyin.com/share/video/6462278424017767695， “video”后面的“6462278424017767695”就是作品id哦！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112105" />---- 下单秒刷-特价抖音视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112106" />---- 下单秒刷-真人抖音视频粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112107" />---- 下单秒刷-招牌抖音视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112108" />---- 下单秒刷-直供抖音视频双击（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112109" />---- 下单秒刷-特色抖音视频双击（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112110" />---- 下单秒刷-直供抖音视频播放（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112111" />---- 下单秒刷-特色抖音视频播放（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112112" />---- 下单秒刷-直供抖音视频分享（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112113" />---- 下单秒刷-招牌抖音视频分享（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112114" />---- 下单秒刷-特价抖音视频评论（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112115" />---- 下单秒刷-招牌抖音视频评论（日刷3万）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-抖音短视频业务代刷(7*24小时自动发货) -完美售后★★★ 如何获取抖音作品id教程：复制作品链接地址，比如：https://www.douyin.com/share/video/6462278424017767695， “video”后面的“6462278424017767695”就是作品id哦！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111366" />---- 下单秒刷-特价抖音视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111367" />---- 下单秒刷-真人抖音视频粉丝（日刷5万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111368" />---- 下单秒刷-招牌抖音视频粉丝（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111369" />---- 下单秒刷-直供抖音视频双击（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111370" />---- 下单秒刷-特色抖音视频双击（日刷2万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111371" />---- 下单秒刷-直供抖音视频播放（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111372" />---- 下单秒刷-特色抖音视频播放（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111373" />---- 下单秒刷-直供抖音视频分享（日刷3万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111374" />---- 下单秒刷-招牌抖音视频分享（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111375" />---- 下单秒刷-特价抖音视频评论（日刷1万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111376" />---- 下单秒刷-招牌抖音视频评论（日刷3万）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-球球大作战业务代刷(7*24小时自动发货) -完美售后★★★网址链接请输入短域名，每天都会给您领取</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112117" />---- 下单秒刷-球球大作战棒棒糖（周刷20个） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112118" />---- 下单秒刷-球球大作战龙蛋（周刷210个） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-球球大作战业务代刷(7*24小时自动发货) -完美售后★★★网址链接请输入短域名，每天都会给您领取</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111669" />---- 下单秒刷-球球大作战棒棒糖（周刷20个） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111670" />---- 下单秒刷-球球大作战龙蛋（周刷210个） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-QQ游戏欢乐豆斗地主+新浪微博粉丝代刷(7*24小时自动发货) -完美售后★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111382" />---- 下单秒刷-电脑版QQ游戏欢乐豆（日刷800万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111383" />---- 下单秒刷-电脑+安卓版QQ游戏欢乐豆（日刷800万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111388" />---- 下单秒刷-苹果版QQ游戏欢乐豆（日刷800万）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111384" />---- 下单秒刷-特价新浪微博粉丝（日刷1万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111385" />---- 下单秒刷-真人新浪微博粉丝（日刷3万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111386" />---- 下单秒刷-招牌新浪微博点赞（日刷3万） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111387" />---- 下单秒刷-特色新浪微博点赞（日刷5万） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆ 全软件下单就自动开始刷【价格优势，全网最低价】-QQ飞车业务电脑版代刷(1-48小时开始刷)  -完美售后★★★ 异地登录冻结，新密码提交地址：www.daiguagaimi.com</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111390" />---- 下单1-48小时刷-QQ飞车雷诺180天</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111391" />---- 下单1-48小时刷-QQ飞车永久大黄蜂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111392" />---- 下单1-48小时刷-QQ飞车永久大Q吧</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111393" />---- 下单1-48小时刷-QQ飞车永久剃刀车</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111394" />---- 下单1-48小时刷-QQ飞车全套剧情代跑</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">平台自营：好点社区空间业务卡密--全国最大的空间业务卡密平台 www.52faka.cn  串货+购买+对接，首选好点社区！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111632" />---- 【好点社区】QQ个性标签赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111584" />---- 【好点社区】低价活动名片赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111585" />---- 【好点社区】特价名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111586" />---- 【好点社区】手工名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111587" />---- 【好点社区】快刷名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111633" />---- 【好点社区】活动空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111588" />---- 【好点社区】快刷空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111589" />---- 【好点社区】特价空间访客『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111590" />---- 【好点社区】秒刷空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111591" />---- 【好点社区】官方空间说说赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111592" />---- 【好点社区】秒刷空间说说赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111593" />---- 【好点社区】空间说说评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111594" />---- 【好点社区】快刷空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111595" />---- 【好点社区】空间说说浏览『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111596" />---- 【好点社区】QQ厘米秀鲜花『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111597" />---- 【好点社区】包月说说点赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111598" />---- 【好点社区】快手直播爱心『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111599" />---- 【好点社区】快手僵尸粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111600" />---- 【好点社区】快手真人粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111601" />---- 【好点社区】快手双击代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111602" />---- 【好点社区】快手播放代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111603" />---- 【好点社区】快手评论代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111604" />---- 【好点社区】全民K歌粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111605" />---- 【好点社区】全民K歌鲜花『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111606" />---- 【好点社区】全民K歌播放『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111607" />---- 【好点社区】全民K歌评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111608" />---- 【好点社区】全民K歌转发『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111609" />---- 【好点社区】微博僵尸粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111610" />---- 【好点社区】微博真人粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111611" />---- 【好点社区】微博说说点赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111612" />---- 【好点社区】QQ电脑欢乐豆『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111613" />---- 【好点社区】QQ安卓欢乐豆『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111614" />---- 【好点社区】好友动态秒赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111615" />---- 【好点社区】全天苹果X在线『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111616" />---- 【好点社区】电脑管家代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111617" />---- 【好点社区】勋章墙代挂王『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111618" />---- 【好点社区】电脑全天在线『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111619" />---- 【好点社区】QQ情侣黄钻『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111620" />---- 【好点社区】手机圈圈赞99『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111621" />---- 【好点社区】斗战神VIP图标『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111622" />---- 【好点社区】QQ飞车雷诺车『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111623" />---- 【好点社区】QQ全套代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111624" />---- 【好点社区】快手直播人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111625" />---- 【好点社区】空间主页刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111626" />---- 【好点社区】飞车全套剧情『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111627" />---- 【好点社区】包月说说浏览『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111628" />---- 【好点社区】球球大作战代点『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111629" />---- 【好点社区】说说视频播放量『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111630" />---- 【好点社区】包月QQ空间访客『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111631" />---- 【好点社区】自定义空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111634" />---- 【好点社区】抖音视频粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111635" />---- 【好点社区】抖音视频双击『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111636" />---- 【好点社区】抖音视频播放『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111637" />---- 【好点社区】抖音视频评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111638" />---- 【好点社区】抖音视频分享『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111639" />---- 【好点社区】快手直播人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111640" />---- 【好点社区】微视视频播放量『卡密』</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">▶▷▶丨卡盟特色商品专区①丨优势商品丨每日主打爆款丨欢迎您加入我们平台 - 这里是您的网赚平台 - 祝您玩得开心玩得快乐</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111397" />---- 【好点】QQ修改成5-6位短位账号</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111417" />---- 【好点】修改QQ认证空间业务</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111398" />---- 【好点】修改QQ龄/999年好友可见</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111399" />---- 【好点】CF超值极品大礼包领取</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111421" />---- 【信达】0<?=$moneytype?>QQ等级代挂/全套等级代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111400" />---- 【好点】最新QQ好友群发器业务</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111401" />---- 【好点】下单秒啦/刷圈圈赞99+</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111402" />---- 【好点】修改QQ腾讯认证官方图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111403" />---- 【好点】QQ好友真人克隆业务</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111404" />---- 【好点】待删QQ空间说说/QQ空间留言</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111405" />---- 【好点】QQ群全功能娱乐机器人</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111406" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111407" />---- 【好点】手机短信业务强力轰炸</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111408" />---- 【好点】电脑版QQ飞车/180天雷诺车</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111410" />---- 【好点】各类影视视频/VIP会员版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111409" />---- 【好点】QQ8钻会员+7皇冠+资料</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111411" />---- 【好点】QQ空间说说手机标识</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111412" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111413" />---- 【好点】CF超值极品大礼包领取</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111414" />---- 【好点】520表白网站完美制作</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111415" />---- 【好点】QQ亮钻助手/各种辅助</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111416" />---- 【好点】QQ飞车/180天雷诺车</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111418" />---- 【好点】各类8位极品靓号绝版号</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111419" />---- 【好点】QQ空间说说打赏红包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111420" />---- 【好点】破解网吧/开通无限时间</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111422" />---- 【好点】QQ资料信息全部清空</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111423" />---- 【好点】各类游戏皮肤修改盒子</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111424" />---- 【好点】三个月黄钻仅需16<?=$moneytype?></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111425" />---- 【世才】等级代挂/全套代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111426" />---- 【华城】三网实体无限流量卡</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111427" />---- 【苏晨】QQ全套等级代挂专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111428" />---- 【好点】0<?=$moneytype?>QQ等级代挂/全套等级代挂 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">▶▷▶丨对接特色商品专区②丨理论永久业务丨优势商品丨◀◁◀点亮各种QQ永久图标</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111430" />---- 【理论永久】QQ会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111431" />---- 【理论永久】超级会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111432" />---- 【理论永久】QQ绿钻图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111433" />---- 【理论永久】腾讯视频会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111434" />---- 【理论永久】斗战神图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111435" />---- 【理论永久】腾讯公益图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111436" />---- 【理论永久】乐斗达人图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111437" />---- 【理论永久】情侣黄钻图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111438" />---- 【理论永久】热血VIP图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111439" />---- 【理论永久】火影VIP图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111440" />---- 【理论永久】腾讯图书会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111441" />---- 【理论永久】QQ黄钻图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111442" />---- 【理论永久】心悦会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111443" />---- 【理论永久】QQ蓝钻图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111444" />---- 【理论永久】超Q纪念版图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111445" />---- 【理论永久】QQ红钻图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111446" />---- 【理论永久】付费音乐包图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111447" />---- 【理论永久】CF穿越火线图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111448" />---- 【理论永久】爱奇艺会员图标</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111449" />---- 【理论永久】豪华黄钻图标 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">平台免费业务专区，免费回馈代理。真正的0<?=$moneytype?>购 不限制购买次数，方便大家招收代理（平台官方独家赞助）正在进行中！！！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111454" />---- 卡盟代理福利（1）QQ群号：178936740（欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111456" />---- 卡盟代理福利（2）QQ群号：163200233 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111453" />---- 卡盟代理福利（3）QQ群号：601923903 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111455" />---- 卡盟代理福利（3）QQ群号：601923903 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111457" />---- 卡盟代理福利（4）QQ群号：654558569 （欢迎加入） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111458" />---- 卡盟代理福利（5）QQ群号：437666794 （欢迎加入） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111459" />---- 卡盟代理福利（6）QQ群号：674238066 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111451" />---- 卡盟代理福利（7）QQ群号：658781540 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111452" />---- 卡盟代理福利（8）QQ群号：622108358 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111460" />---- 卡盟代理福利（7）QQ群号：658781540 （欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111461" />---- 卡盟代理福利（9）QQ群号：695215905（欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111462" />---- 卡盟代理福利（10）QQ群号：710938946（欢迎加入）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111463" />---- 卡盟代理福利（11）QQ群号：178936740（欢迎加入）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#0000FF;">▶▷▶ LT-QQ图标点亮业务丨请注意商品注意事项 以免产生售后纠纷（注：业务开通过程中一般会软件登入账号！如果不能接受请勿下单！）◀◁◀</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111478" />---- 【文儿】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111482" />---- 【白菜】联通业务||联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111488" />---- 【南瓜】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111489" />---- 【传奇】QQ图标┇联通业务 （欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111472" />---- 【苦瓜】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111487" />---- 【香蕉】QQ图标┇联通业务（欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111474" />---- 【葡萄】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111485" />---- 【橘子】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111486" />---- 【苹果】QQ图标┇联通业务 （欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111475" />---- 【芒果】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111476" />---- 【樱桃】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111484" />---- 【辣椒】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111465" />---- 【蓝莓】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111466" />---- 【青果】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111467" />---- 【柿子】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111468" />---- 【柚子】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111469" />---- 【香梨】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111470" />---- 【山楂】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111471" />---- 【荔枝】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111477" />---- 【酸梅】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111479" />---- 【瑜伽】QQ图标┇联通业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111481" />---- 【冬瓜】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111483" />---- 【面包】QQ图标┇联通业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111480" />---- 【无忌】QQ图标┇联通业务（众人秒单）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111473" />---- 【晚枫】QQ图标┇联通业务（欢迎对接）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">▶▷▶ DX-QQ图标点亮业务丨请注意商品注意事项 以免产生售后纠纷（注：业务开通过程中一般会软件登入账号！如果不能接受请勿下单！）◀◁◀</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111506" />---- 【好点】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111499" />---- 【西瓜】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111503" />---- 【木瓜】QQ图标┇点播业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111504" />---- 【桃子】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111505" />---- 【核桃】QQ图标┇电信业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111509" />---- 【土豆】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111513" />---- 【甜瓜】QQ图标┇电信业务（欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111508" />---- 【星玥】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111496" />---- 【香瓜】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111495" />---- 【草莓】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111514" />---- 【豹子】QQ图标┇联通业务 （欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111511" />---- 【橙子】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111491" />---- 【鸡蛋】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111492" />---- 【秒单】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111493" />---- 【甘蔗】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111494" />---- 【瑶瑶】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111497" />---- 【胖哥】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111498" />---- 【花花】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111500" />---- 【汤圆】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111501" />---- 【雪碧】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111502" />---- 【辣条】QQ图标┇点播业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111512" />---- 【包子】QQ图标┇电信业务（欢迎对接） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111515" />---- 【天娱】QQ图标┇电信业务 （欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111510" />---- 【博恩】QQ图标┇电信业务（欢迎对接）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111507" />---- 【鸿福】QQ图标┇联通业务（欢迎对接）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">独家专区：各大影视软件，爱奇艺+腾讯视频+优酷土豆视频+搜狐视频，尊享VIP会员特权，全程VIP会员观看！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111517" />---- 【官方】爱奇艺视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111518" />---- 【官方】腾讯视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111519" />---- 【官方】优酷土豆视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111520" />---- 【官方】芒果TV视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111521" />---- 【官方】搜狐视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111522" />---- 【官方】爱奇艺视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111523" />---- 【官方】腾讯视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111524" />---- 【官方】优酷土豆视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111525" />---- 【官方】芒果TV视频/VIP会员版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111526" />---- 【官方】搜狐视频/VIP会员版本 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">独家专区：各大影视软件，爱奇艺+腾讯视频+优酷土豆视频+搜狐视频，免广告，全程无广告观看！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111528" />---- 【官方】爱奇艺视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111529" />---- 【官方】腾讯视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111530" />---- 【官方】优酷土豆视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111531" />---- 【官方】芒果TV视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111532" />---- 【官方】搜狐视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111533" />---- 【官方】爱奇艺视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111534" />---- 【官方】腾讯视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111535" />---- 【官方】优酷土豆视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111536" />---- 【官方】芒果TV视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111537" />---- 【官方】搜狐视频/免广告版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111538" />---- 【官方】酷狗音乐/尊享会员版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111539" />---- 【官方】酷我音乐/尊享会员版本</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111540" />---- 【官方】爱奇艺TV电视/无广告版本 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111541" />---- 【官方】PPTV视频/免广告版本</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:;">【DNF地下城与勇士游戏】网盘软件下载地址：www.vipkm.cccpan.com;登陆密码520】</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111543" />---- DNF地下城与勇士区（A）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111544" />---- DNF地下城与勇士区（B）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111545" />---- DNF地下城与勇士区（C）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111546" />---- DNF地下城与勇士区（D）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111547" />---- DNF地下城与勇士区（E）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#;">绝地求生游戏-此大区下载网盘 http://www.vipkm.cccpan.com密码520 （超过3天没更新买的，出现卡密错误的后果自负）红颜色代表最近卖的好的 </span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111549" />---- 绝地求生游戏区（A）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111550" />---- 绝地求生游戏区（B）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111551" />---- 绝地求生游戏区（C）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111552" />---- 绝地求生游戏区（D）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111553" />---- 绝地求生游戏区（E）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【荒野行动游戏专区】网盘游戏软件下载地址： www.vipkm.cccpan.com;登陆密码520】</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111555" />---- 荒野行动游戏区（A）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111556" />---- 荒野行动游戏区（B）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111557" />---- 荒野行动游戏区（C）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111558" />---- 荒野行动游戏区（D）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111559" />---- 荒野行动游戏区（E）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:;">【刺激战场游戏专区】网盘软件下载地址：www.vipkm.cccpan.com;登陆密码520】 </span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111561" />---- 刺激战场手游区（A） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111562" />---- 刺激战场手游区（B） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111563" />---- 刺激战场手游区（C） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111564" />---- 刺激战场手游区（D） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111565" />---- 刺激战场手游区（E） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">王者荣耀皮肤全场七折，官方直充，官方渠道，全网最低价的货源，下单秒充！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111567" />---- 【王者荣耀】288点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111568" />---- 【王者荣耀】388点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111569" />---- 【王者荣耀】488点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111570" />---- 【王者荣耀】588点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111571" />---- 【王者荣耀】788点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111572" />---- 【王者荣耀】888点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111573" />---- 【王者荣耀】988点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111574" />---- 【王者荣耀】1188点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111575" />---- 【王者荣耀】1688点券皮肤</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111576" />---- 【王者荣耀】2888点券皮肤</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF00FF;">租号专区：各大影视会员账号出租，爱奇艺+腾讯视频+优酷土豆视频+搜狐视频，用最少的钱，享受正常的影视会员特权，这就是出租号！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111578" />---- ☆爱奇艺会员☆丨正规账号（出租号） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111581" />---- ☆腾讯视频会员☆丨正规账号（出租号）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111579" />---- ☆优酷视频会员☆丨正规账号（出租号）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111580" />---- ☆芒果TV会员☆丨正规账号（出租号） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111582" />---- ☆爱奇艺会员☆丨正规账号（出租号） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">★★★【特价回馈代理，点亮各种QQ图标】（点亮时间1-3天，请勿催单！不能接受请勿下单！谢谢配合！）★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111741" />---- ★点亮图标┇心悦成长值</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111718" />---- ★点亮图标┇QQ|斗地主 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111719" />---- ★点亮图标┇QQ|炫舞 ★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111720" />---- ★点亮图标┇Q|宠大乐斗</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111721" />---- ★点亮图标┇纵横九州★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111722" />---- ★点亮图标┇全民超神★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111723" />---- ★点亮图标┇QQ|天堂★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111724" />---- ★点亮图标┇QQ| TNT★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111725" />---- ★点亮图标┇QQ|水浒★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111726" />---- ★点亮图标┇夜店之王★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111727" />---- ★点亮图标┇轩辕世界★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111728" />---- ★点亮图标┇炫舞时代★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111729" />---- ★点亮图标┇七雄争霸★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111730" />---- ★点亮图标┇上古世纪★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111731" />---- ★点亮图标┇蜀山传奇★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111732" />---- ★点亮图标┇勇者之塔★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111733" />---- ★点亮图标┇NBA|篮球</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111734" />---- ★点亮图标┇洛克王国★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111735" />---- ★点亮图标┇ Q Q 堂 ★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111736" />---- ★点亮图标┇传奇霸业★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111737" />---- ★点亮图标┇王朝霸域★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111738" />---- ★点亮图标┇剑灵洪门★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111739" />---- ★点亮图标┇轩辕传奇★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111740" />---- ★点亮图标┇幻想世界★</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111742" />---- ★点亮图标┇QQ|枪神纪★ </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">★★★腾讯QQ空间专区丨个人售后品牌店铺丨完美无忧丨打造精品批发平台★★★</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111642" />---- 【秒刷】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111643" />---- 【特色】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111644" />---- 【大大】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111645" />---- 【超人】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111646" />---- 【急速】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111647" />---- 【小小】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111648" />---- 【帅总】QQ空间业务店铺</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111649" />---- 【大大】QQ空间业务店铺 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111650" />---- 【小林】QQ空间业务店铺 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111651" />---- 【玫瑰】QQ空间业务店铺 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">▶▷▶丨对接特色商品专区丨官方点劵业务丨优势商品丨◀◁◀王者荣耀手游点劵充值</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111653" />---- 【白菜】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111666" />---- 【特供】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111662" />---- 【浩然】王者荣耀特价点券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111665" />---- 【杰宝】王者荣耀特价点劵 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111654" />---- 【泰坦】王者荣耀特价点劵</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111655" />---- 【雪月】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111656" />---- 【旺财】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111657" />---- 【花花】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111658" />---- 【美女】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111659" />---- 【天明】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111660" />---- 【泡沫】王者荣耀特价点卷 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111661" />---- 【康静】王者荣耀特价点卷</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111663" />---- 【小丰】王者荣耀特价点劵</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111664" />---- 【宝宝】王者荣耀特价点劵</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111667" />---- 【盛<?=$moneytype?>】王者荣耀特价点卷</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">苹果全天代挂专区：代挂 苹果7+苹果8+苹果X 系列，全天稳定代挂，自己和好友都可见！</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111675" />---- 【火爆】稳定代挂/ 苹果X 稳定在线</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111672" />---- 【火爆】稳定代挂/ 苹果8 稳定在线</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111674" />---- 【火爆】稳定代挂/ 苹果8 plus在线</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111671" />---- 【火爆】稳定代挂/ 苹果7 plus在线</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111676" />---- 【火爆】稳定代挂/ 苹果7 稳定在线</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">▶▷▶丨对接特色商品专区丨官方钻石业务丨优势商品丨◀◁◀CF手游钻石充值 </span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111988" />---- 【星空】枪战王者特价钻石</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111989" />---- 【夜猫】CF手游特价钻石</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111991" />---- 【赵信】CF手游特价钻石 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111992" />---- 【包子】CF手游特价钻石 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111993" />---- 【小白】CF手游特价钻石 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【好点云秒赞】24H离线秒赞秒评论（100多种妙赞和代挂功能）秒赞网：www.52taoao.com 可以放心秒赞+代挂+秒评</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111678" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111679" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111680" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111681" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111682" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111683" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111684" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111685" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111686" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111687" />---- 【好点】24H离线秒赞/代挂/秒评论</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111688" />---- 【好点】24H离线秒赞/代挂/秒评论 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111689" />---- 【好点】24H离线秒赞/代挂/秒评论 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111690" />---- 【好点】24H离线秒赞/代挂/秒评论 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111691" />---- 【好点】24H离线秒赞/代挂/秒评论 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111692" />---- 【好点】24H离线秒赞/代挂/秒评论 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">全网最稳定专业的（完美售后）QQ升级代挂下单专区（7*24小时软件自动处理欢迎对接）</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111744" />---- ☆【加速升级】QQ勋章墙代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111745" />---- ☆【加速升级】QQ电脑在线代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111746" />---- ☆【加速升级】QQ管家代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111747" />---- ☆【加速升级】QQ音乐代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111748" />---- ☆【加速升级】手机游戏代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111749" />---- ☆【加速升级】iphone在线代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111750" />---- ☆【加速升级】会员成长值代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111751" />---- ☆【加速升级】花藤三项代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111752" />---- ☆【加速升级】花藤营养代挂</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111753" />---- ☆【加速升级】QQ电脑在线代挂 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">好淘劵：www.656ka.cn    淘宝天猫优惠券，领取优惠券后，商品仅需三折左右，省钱神器！ </span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111695" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111696" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111697" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111698" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111699" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111700" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111701" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111702" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111703" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111704" />---- 好淘劵/淘宝天猫优惠券</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">☆☆☆热销商品|官方供货|即换随用丨★★★欢迎大家批发</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111706" />---- 【官方】秒升8级黄钻</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111707" />---- 【官方】秒升8级绿钻</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111708" />---- 【官方】官方7折|年费Q钻</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111709" />---- 【官方】秒升8级黄钻 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111710" />---- 【官方】秒升8级黄钻 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">营销软件→帮助您迅速增长人气，如微信群发器，QQ群发器，涨粉，好友克隆等等 ，任性就是实力 |，给力就是第一 </span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111712" />---- 【营销】QQ好友真人克隆/涨人气</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111713" />---- 【营销】QQ好友+QQ群群发器/电脑版</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111714" />---- 【营销】QQ好友+QQ群群发器/手机版</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111715" />---- 【营销】微信好友+微信群群发器/电脑版</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111716" />---- 【营销】QQ好友真人克隆/涨人气</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">腾讯电脑版网络游戏道具/CDKEY/手工充值专区（本专区为抽奖商品，不能接受勿拍，商品描述一致）欢迎各位主站站长对接</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112040" />---- 【神器】CF穿越火线类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112041" />---- 【神器】QQ飞车类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112042" />---- 【神器】DNF地下城类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112043" />---- 【神器】LOL英雄联盟类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112044" />---- 【神器】ＱＱ逆战→（商城）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112045" />---- 【女神】CF穿越火线类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112046" />---- 【女神】QQ飞车类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112047" />---- 【女神】DNF地下城类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112048" />---- 【女神】LOL英雄联盟类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112049" />---- 【女神】ＱＱ逆战→（商城）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112050" />---- 【绝版】CF穿越火线类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112051" />---- 【绝版】QQ飞车类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112052" />---- 【绝版】DNF地下城类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112053" />---- 【绝版】LOL英雄联盟类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112054" />---- 【绝版】ＱＱ逆战→（商城）</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112055" />---- 【极品】CF穿越火线类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112056" />---- 【极品】QQ飞车类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112057" />---- 【极品】DNF地下城类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112058" />---- 【极品】LOL英雄联盟类专区</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112059" />---- 【极品】ＱＱ逆战→（商城）</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">腾讯手游网络游戏道具/CDKEY/手工充值专区（本专区为抽奖商品，不能接受勿拍，商品描述一致）欢迎各位主站站长对接</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112019" />---- ☆【特色】王者荣耀大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112020" />---- ☆【特色】CF手游超值大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112021" />---- ☆【特色】QQ飞车手游大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112022" />---- ☆【特色】雷霆战机大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112023" />---- ☆【特色】天天酷跑大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112024" />---- ☆【猫咪】王者荣耀大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112025" />---- ☆【猫咪】CF手游超值大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112026" />---- ☆【猫咪】QQ飞车手游大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112027" />---- ☆【猫咪】雷霆战机大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112028" />---- ☆【猫咪】天天酷跑大礼包</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112029" />---- ☆【玫瑰】王者荣耀大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112030" />---- ☆【玫瑰】CF手游超值大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112031" />---- ☆【玫瑰】QQ飞车手游大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112032" />---- ☆【玫瑰】雷霆战机大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112033" />---- ☆【玫瑰】天天酷跑大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112034" />---- ☆【瑶瑶】王者荣耀大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112035" />---- ☆【瑶瑶】CF手游超值大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112036" />---- ☆【瑶瑶】QQ飞车手游大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112037" />---- ☆【瑶瑶】雷霆战机大礼包 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112038" />---- ☆【瑶瑶】天天酷跑大礼包 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【QQ号码交易】独家专属商城★★★强烈要求卡盟站长对接此区：本站优势商品（效率+速度+安全+优惠）</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111755" />---- 【富贵】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111756" />---- 【牛牛】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111757" />---- 【夜宵】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111758" />---- 【宝贝】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111759" />---- 【联想】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111760" />---- 【小哥】QQ号码商城</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111761" />---- 【顶尖】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111762" />---- 【风暴】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111763" />---- 【小远】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111764" />---- 【皇朝】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111765" />---- 【小小】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111766" />---- 【王牌】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111767" />---- 【天子】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111768" />---- 【八哥】QQ号码商城 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111769" />---- 【芒果】QQ号码商城 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">依捷网盘教程地址：http://1161978995.cccpan.com/ 登录密码521（网络硬盘（软件共享、学习教程、网赚信息、QQ技术、网站模板等）</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111968" />---- 【依捷】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111969" />---- 【刀哥】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111970" />---- 【黑客】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111971" />---- 【神话】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111972" />---- 【孤城】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111973" />---- 【阿龙】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111974" />---- 【兔兔】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111975" />---- 【林军】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111976" />---- 【小黑】网盘|软件|教程|技术</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111977" />---- 【大牛】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111978" />---- 【威哥】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111979" />---- 【娃娃】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111980" />---- 【释怀】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111981" />---- 【天神】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111982" />---- 【莫凡】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111983" />---- 【男神】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111984" />---- 【天涯】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111985" />---- 【天雪】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111986" />---- 【傲世】网盘|软件|教程|技术 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111987" />---- 【守望】网盘|软件|教程|技术 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">▶▷▶丨对接特色商品专区③丨各类游戏辅助丨优势商品丨◀◁◀ 依捷网盘教程地址：http://1161978995.cccpan.com/ 登录密码521</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111772" />---- 【依捷】CF/LOL游戏辅助</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111773" />---- 【DNF】游戏辅助</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111774" />---- 【LOL】游戏辅助</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111775" />---- 【CF】游戏辅助</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111776" />---- 【QQ飞车】游戏辅助</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">【游戏卡密专区】 官方卡密 | 激活码 | CDKEY | 会员卡 | 即提即用 丨想什么时候充就什么时候充 | 真正的秒到账 ★★★欢迎大家批发 | （7X24小时自动发货）</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="112016" />---- ☆荒野行动礼包☆丨正规卡密（官方卡） </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112017" />---- ☆刺激战场手游礼包☆丨正规卡密（官方卡） </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">土豪社区空间业务卡密--全国最大的空间业务卡密平台 www.um88888.com 站长推荐对接串货</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111790" />---- 【土豪社区】特快名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111791" />---- 【土豪社区】快刷名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111792" />---- 【土豪社区】特价名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111793" />---- 【土豪社区】手工名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111794" />---- 【土豪社区】特快空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111795" />---- 【土豪社区】超速空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111796" />---- 【土豪社区】快刷空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111797" />---- 【土豪社区】特价空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111798" />---- 【土豪社区】手工空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111799" />---- 【土豪社区】包月空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111800" />---- 【土豪社区】快手真人粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111801" />---- 【土豪社区】快手粉丝代刷『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111802" />---- 【土豪社区】快手双击代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111803" />---- 【土豪社区】快手播放代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111804" />---- 【土豪社区】欢乐豆安卓版『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111805" />---- 【土豪社区】欢乐豆苹果版『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111806" />---- 【土豪社区】快刷空间留言『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111807" />---- 【土豪社区】特价空间留言『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111808" />---- 【土豪社区】映客直播粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111809" />---- 【土豪社区】新浪真人粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111810" />---- 【土豪社区】新浪僵尸粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111811" />---- 【土豪社区】秒刷说说刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111812" />---- 【土豪社区】空间说说刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111813" />---- 【土豪社区】包月说说刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111814" />---- 【土豪社区】空间说说浏览『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111815" />---- 【土豪社区】空间日志访问『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111816" />---- 【土豪社区】空间主页刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111817" />---- 【土豪社区】手机圈圈刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111818" />---- 【土豪社区】全民Ｋ歌鲜花『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111819" />---- 【土豪社区】全民Ｋ歌关注『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111820" />---- 【土豪社区】全民Ｋ歌评论『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111821" />---- 【土豪社区】全民Ｋ歌试听『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111822" />---- 【土豪社区】全民Ｋ歌经验『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111823" />---- 【土豪社区】全民超神图标『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111824" />---- 【土豪社区】卡盟Logo制作『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111825" />---- 【土豪社区】手机控照片墙『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111826" />---- 【土豪社区】动态精品头像『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111827" />---- 【土豪社区】举牌照代制作『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111828" />---- 【土豪社区】广告业务名片『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111829" />---- 【土豪社区】手机微信投票『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111830" />---- 【土豪社区】花椒直播粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111831" />---- 【土豪社区】认证空间粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111832" />---- 【土豪社区】火山视频粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111833" />---- 【土豪社区】火山视频双击『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111834" />---- 【土豪社区】火山视频评论『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111835" />---- 【土豪社区】抖音视频粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111836" />---- 【土豪社区】抖音视频双击『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111837" />---- 【土豪社区】抖音视频评论『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111838" />---- 【土豪社区】抖音视频播放『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111839" />---- 【土豪社区】特快名片刷赞『卡密』</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">起点社区空间业务卡密--全国最大的空间业务卡密平台 www.qidiansq.com 站长推荐对接串货</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111841" />---- 【起点社区】快刷名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111842" />---- 【起点社区】特价名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111843" />---- 【起点社区】手工名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111844" />---- 【起点社区】超速空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111845" />---- 【起点社区】快刷空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111846" />---- 【起点社区】特价空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111847" />---- 【起点社区】手工空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111848" />---- 【起点社区】包月空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111849" />---- 【起点社区】快手粉丝代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111850" />---- 【起点社区】快手双击代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111851" />---- 【起点社区】快手播放代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111852" />---- 【起点社区】欢乐豆安卓版『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111853" />---- 【起点社区】欢乐豆苹果版『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111854" />---- 【起点社区】快刷空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111855" />---- 【起点社区】特价空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111856" />---- 【起点社区】真人空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111857" />---- 【起点社区】映客直播粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111858" />---- 【起点社区】新浪僵尸粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111859" />---- 【起点社区】新浪顶级粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111860" />---- 【起点社区】新浪超级粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111861" />---- 【起点社区】新浪达人粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111862" />---- 【起点社区】新浪博文点赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111863" />---- 【起点社区】新浪博文转发『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111864" />---- 【起点社区】新浪博文评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111865" />---- 【起点社区】新浪博文阅读『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111866" />---- 【起点社区】空间说说刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111867" />---- 【起点社区】真人说说刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111868" />---- 【起点社区】包月说说刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111869" />---- 【起点社区】空间说说浏览『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111870" />---- 【起点社区】包月说说浏览『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111871" />---- 【起点社区】空间说说转发『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111872" />---- 【起点社区】包月说说转发『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111873" />---- 【起点社区】空间日志访问『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111874" />---- 【起点社区】空间日志转载『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111875" />---- 【起点社区】空间日志刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111876" />---- 【起点社区】空间日志分享『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111877" />---- 【起点社区】空间主页刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111878" />---- 【起点社区】手机圈圈刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111879" />---- 【起点社区】全民Ｋ歌鲜花『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111880" />---- 【起点社区】全民Ｋ歌粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111881" />---- 【起点社区】全民Ｋ歌评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111882" />---- 【起点社区】全民Ｋ歌经验『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111883" />---- 【起点社区】全民Ｋ歌试听『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111884" />---- 【起点社区】全民超神图标『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111885" />---- 【起点社区】腾讯微云图标『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111886" />---- 【起点社区】卡盟Logo制作『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111887" />---- 【起点社区】手机控照片墙『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111888" />---- 【起点社区】动态精品头像『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111889" />---- 【起点社区】举牌照代制作『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111890" />---- 【起点社区】广告业务名片『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111891" />---- 【起点社区】飞车徒弟代练『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111892" />---- 【起点社区】飞车雷诺代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111893" />---- 【起点社区】飞车满级代练『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111894" />---- 【起点社区】ＱＱ空间解封『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111895" />---- 【起点社区】秒赞好友说说『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111896" />---- 【起点社区】好友秒赞秒评『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111897" />---- 【起点社区】电脑管家加速『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111898" />---- 【起点社区】电脑在线加速『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111899" />---- 【起点社区】电脑全天代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111900" />---- 【起点社区】苹果7plus在线『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111901" />---- 【起点社区】苹果在线代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111902" />---- 【起点社区】手机在线代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111903" />---- 【起点社区】会员成长代领『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111904" />---- 【起点社区】ＱＱ音乐加速『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111905" />---- 【起点社区】ＱＱ钱包签到『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111906" />---- 【起点社区】勋章每天代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111907" />---- 【起点社区】绿钻成长代领『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111908" />---- 【起点社区】ＱＱ全套升级『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111909" />---- 【起点社区】花藤营养代养『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111910" />---- 【起点社区】花藤三项代养『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111911" />---- 【起点社区】手机微信投票『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111912" />---- 【起点社区】厘米秀送鲜花『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111913" />---- 【起点社区】花椒直播粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111914" />---- 【起点社区】美拍刷播放量『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111915" />---- 【起点社区】认证空间粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111916" />---- 【起点社区】永久情侣黄钻『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111917" />---- 【起点社区】球球作战棒棒『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111918" />---- 【起点社区】贪吃蛇刷金币『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111919" />---- 【起点社区】ＱＱ群机器人『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111920" />---- 【起点社区】斗战神ＶＩＰ『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111921" />---- 【起点社区】心悦会员图标『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111922" />---- 【起点社区】手机游戏代挂『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111923" />---- 【起点社区】全民Ｋ歌转发『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111924" />---- 【起点社区】球球作战龙蛋『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111925" />---- 【起点社区】ＣＦ超值礼包『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111926" />---- 【起点社区】飞车剧情代过『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111927" />---- 【起点社区】飞车Ａ车代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111928" />---- 【起点社区】飞车Ｂ车代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111929" />---- 【起点社区】特快名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111930" />---- 【起点社区】快手作品评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111931" />---- 【起点社区】快手真人粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111932" />---- 【起点社区】抖音视频粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111933" />---- 【起点社区】抖音视频双击『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111934" />---- 【起点社区】抖音视频播放『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111935" />---- 【起点社区】抖音视频评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111936" />---- 【起点社区】火山视频粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111937" />---- 【起点社区】火山视频双击『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111938" />---- 【起点社区】火山视频评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111939" />---- 【起点社区】快刷名片刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111940" />---- 【起点社区】特价名片刷赞『卡密』</label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">豪情社区空间业务卡密--全国最大的空间业务卡密平台 http://haoqing.95jw.cn 站长推荐对接串货</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111942" />---- 【豪情社区】特快名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111943" />---- 【豪情社区】快刷名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111944" />---- 【豪情社区】特价名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111945" />---- 【豪情社区】手工名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111946" />---- 【豪情社区】特快空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111947" />---- 【豪情社区】快刷空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111948" />---- 【豪情社区】特价空间人气『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111949" />---- 【豪情社区】手工空间人气『卡密』  </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111950" />---- 【豪情社区】快手真人粉丝『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111951" />---- 【豪情社区】快手粉丝代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111952" />---- 【豪情社区】快手双击代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111953" />---- 【豪情社区】快手评论代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111954" />---- 【豪情社区】快手播放代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111955" />---- 【豪情社区】快手直播爱心『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111956" />---- 【豪情社区】空间留言代刷『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111957" />---- 【豪情社区】秒刷说说刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111958" />---- 【豪情社区】空间说说刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111959" />---- 【豪情社区】空间说说浏览『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111960" />---- 【豪情社区】全民Ｋ歌鲜花『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111961" />---- 【豪情社区】全民Ｋ歌关注『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111962" />---- 【豪情社区】全民Ｋ歌评论『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111963" />---- 【豪情社区】全民Ｋ歌试听『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111964" />---- 【豪情社区】全民Ｋ歌经验『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111965" />---- 【豪情社区】特快名片刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="111966" />---- 【豪情社区】快刷名片刷赞『卡密』 </label><br />
                                        <label><input type="checkbox" disabled="disabled"  /><span style="color:#FF0000;">惠民社区空间业务卡密--全国最大的空间业务卡密平台 www.hmshequ.com 站长推荐对接串货</span></label><br />
                                                <label><input type="checkbox" name="dirBox" value="111995" />---- 【惠民社区】特价手机刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111996" />---- 【惠民社区】快刷手机刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111997" />---- 【惠民社区】秒刷手机刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111998" />---- 【惠民社区】超速手机刷赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="111999" />---- 【惠民社区】秒刷空间留言『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112000" />---- 【惠民社区】秒刷空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112001" />---- 【惠民社区】特快空间人气『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112002" />---- 【惠民社区】代刷快手粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112003" />---- 【惠民社区】快手作品播放『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112004" />---- 【惠民社区】快手作品双击『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112005" />---- 【惠民社区】快手作品评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112006" />---- 【惠民社区】全民K歌粉丝『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112007" />---- 【惠民社区】全民K歌评论『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112008" />---- 【惠民社区】全民K歌鲜花『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112009" />---- 【惠民社区】全民K歌试听『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112010" />---- 【惠民社区】真人说说秒赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112011" />---- 【惠民社区】普通说说秒赞『卡密』</label><br />
                                                <label><input type="checkbox" name="dirBox" value="112012" />---- 【惠民社区】特价手机刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112013" />---- 【惠民社区】快刷手机刷赞『卡密』 </label><br />
                                                <label><input type="checkbox" name="dirBox" value="112014" />---- 【惠民社区】秒刷手机刷赞『卡密』 </label><br />

                            </div><input name="dirs" type="hidden" value="" /><span style="color: red;"></span>
                        </td>
                    </tr>
                            <tr>
                                <td class="num_reg_info"><label for="SaleTypeID">销售范围</label></td>
                                <td class="num_reg_input tdleft">
                                    <label><input checked="checked" data-val="true" data-val-number="字段 SaleTypeID 必须是一个数字。" data-val-required="SaleTypeID 字段是必需的。" id="SaleTypeID" name="SaleTypeID" type="radio" value="0" />全部代理 (需要审核)</label>
                                    <label><input id="SaleTypeID" name="SaleTypeID" type="radio" value="1" />面向下级代理</label>
                                </td>
                            </tr>

                    <tr>
                        <td class="num_reg_info"><label for="Unit">数量单位名称</label></td>
                        <td class="num_reg_input tdleft">
                            <input Value="个" class="sort_input" id="Unit" name="Unit" type="text" value="" />
                            <label class="prompt">如：个/<?=$moneytype?>/月</label><span></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"><label for="PrescriptionDateTime">有效售后天数</label></td>
                        <td class="num_reg_input tdleft">
                            <input Value="0" class="sort_input" data-val="true" data-val-number="字段 PrescriptionDateTime 必须是一个数字。" data-val-required="PrescriptionDateTime 字段是必需的。" id="PrescriptionDateTime" name="PrescriptionDateTime" type="text" value="0" />
                            <label class="prompt">0表示无限制，部分退单以此计算退款金额</label>
                            <span style="color: red;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info">是否允许销售</td>
                        <td class="num_reg_input tdleft">
                            <label><input checked="checked" data-val="true" data-val-number="字段 SaleState 必须是一个数字。" data-val-required="SaleState 字段是必需的。" id="SaleState" name="SaleState" onclick="SaleStateChange()" type="radio" value="1" />销售状态</label>
                            <label><input id="SaleState" name="SaleState" onclick="SaleStateChange()" type="radio" value="0" />禁售状态</label>
                            <label><input id="SaleState" name="SaleState" onclick="SaleStateChange()" type="radio" value="2" />暂停状态</label>
                        </td>
                    </tr>
                    <tr id="tr_reason">
                        <td class="num_reg_info"><label for="PauseReason">商品暂停销售原因</label></td>
                        <td class="num_reg_input tdleft">
                            <textarea Style="width:300px;height:52px;" class="sort_textarea" cols="20" id="PauseReason" maxlength="500" name="PauseReason" rows="2">
</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"><label for="ProductIntroduction">商品简介</label></td>
                        <td class="num_reg_input tdleft">
                            <textarea Style="width:300px;height:52px;" class="sort_textarea" cols="20" id="ProductIntroduction" maxlength="1000" name="ProductIntroduction" rows="2">
</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"><label for="ProductNotes">注意事项</label></td>
                        <td class="num_reg_input tdleft">
                            <textarea Style="width:300px;height:52px;" class="sort_textarea" cols="20" id="ProductNotes" maxlength="1000" name="ProductNotes" rows="2">
</textarea>
                            <br /><span class="prompt">客户购买时候会在第一屏提示，可不填写！</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"><label for="RechargeUrl">充值网址</label></td>
                        <td class="num_reg_input tdleft">
                            <input class="sort_input" id="RechargeUrl" maxlength="300" name="RechargeUrl" type="text" value="" />
                            <label class="prompt">充卡的网址，非卡密可不填写，只有卡密商品才显示</label><span class="error"></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="num_reg_info"><label for="BuyCountStartNum">购买数量限制</label></td>
                        <td class="num_reg_input tdleft">
                            起购量 <input Style="width:40px;" Value="1" class="sort_input" data-val="true" data-val-number="字段 BuyCountStartNum 必须是一个数字。" data-val-required="BuyCountStartNum 字段是必需的。" id="BuyCountStartNum" maxlength="2" name="BuyCountStartNum" type="text" value="0" />个
                            截止量 <input Style="width:40px;" Value="10" class="sort_input" data-val="true" data-val-number="字段 BuyCountEndNum 必须是一个数字。" data-val-required="BuyCountEndNum 字段是必需的。" id="BuyCountEndNum" maxlength="2" name="BuyCountEndNum" type="text" value="0" />个
                            <label class="prompt">请填写大于等于1的整数</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"><label for="MaxBuyCount">单人购买次数</label></td>
                        <td class="num_reg_input">
                            <input class="input1" data-val="true" data-val-number="字段 MaxBuyCount 必须是一个数字。" data-val-required="MaxBuyCount 字段是必需的。" id="MaxBuyCount" maxlength="3" name="MaxBuyCount" type="text" value="0" />
                            <span></span>
                            <label class="prompt">请填写大于等于0小于200的整数 0为不限制 </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="num_reg_info"></td>
                        <td class="num_reg_input tdcontent" style="border: 0;">
                            <input type="button" name="goodInfoSub" value="确认保存" id="Submit" class="s_functionl" />
                            <input type="button" value="返回" class="linksitemail" onclick="history.go(-1);" />
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>

    <script type="text/javascript"> 
        $(function () {
            //submit form
            $("input[name='goodInfoSub']").click(function () {
                $("input[name='goodInfoSub']").attr("disabled", "disabled");
                if (!$("#form1").valid()) {
                    $("input[name='goodInfoSub']").attr("disabled", false);
                }
                //购买数量
                var BuyCountStartNum = $("#BuyCountStartNum").val();
                var BuyCountEndNum = $("#BuyCountEndNum").val();
                if (BuyCountEndNum > 10000) {
                    alert("购买截止数量不能大于10000");
                    $("input[name='goodInfoSub']").attr("disabled", false);
                    return false;
                }
                if (BuyCountEndNum - BuyCountStartNum > 1000) {
                    alert("购买截止量-购买起始量不能大于1000");
                    $("input[name='goodInfoSub']").attr("disabled", false);
                    return false;
                }
                $("#form1").ajaxForm({
                    url: "/viphome/Supply/SelfProductSave",
                    success: function (data) {
                        alert(data.msg);
                        if (confirm("确定继续添加，取消查询已发布的商品？")) {
                            location.href = "/viphome/Supply/SelfProductAdd";
                        }
                        else {
                            location.href = "/viphome/Supply/ProductManage";
                        }
                    },
                    error: function (xhr, type, exception) {
                        alert(eval('(' + xhr.responseText + ')').msg);
                    }
                });
                $("#form1").submit();
            });
        })
    </script>
</body>

</Html>
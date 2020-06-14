<?php
$sresult=mysql_query("select * from site_config where id=1",$conn1);
$row=mysql_fetch_array($sresult);
$site_jump=$row['site_jump'];                ####登录跳转
$appid=$row['appid'];
$appkey=$row['appkey'];
$site_reg=$row['site_reg'];                  ####注册开关
$moneytype=$row['moneytype'];                ####网站货币
$site_leve=$row['site_leve'];                ####注册等级
$site_agent=$row['site_agent'];              ####注册上级
$site_as=$row['site_as'];                    ####抽成级数
$site_template=$row['site_template'];        ####网站模版
$begtime=$row['begtime'];     				 ####网站修改时间
$bluewhite1=$row['bluewhite1'];       		 ####模版数据
$bluewhite2=$row['bluewhite2'];       		 ####模版数据
$bluewhite3=$row['bluewhite3'];       		 ####模版数据
$bluewhite4=$row['bluewhite4'];       		 ####模版数据
$bluewhite5=$row['bluewhite5'];       		 ####模版数据
$bluewhite6=$row['bluewhite6'];       		 ####模版数据
$bluewhite7=$row['bluewhite7'];       		 ####模版数据
$bluewhite8=$row['bluewhite8'];       		 ####模版数据
$bluewhite9=$row['bluewhite9'];       		 ####模版数据
$bluewhite10=$row['bluewhite10'];       	 ####模版数据
$bluewhite11=$row['bluewhite11'];       	 ####模版数据
$bluewhite12=$row['bluewhite12'];       	 ####模版数据
$bluewhite13=$row['bluewhite13'];       	 ####模版数据
$bluewhite14=$row['bluewhite14'];       	 ####模版数据
$bluewhite15=$row['bluewhite15'];       	 ####模版数据
$bluewhite16=$row['bluewhite16'];       	 ####模版数据
$bluewhite17=$row['bluewhite17'];       	 ####模版数据
$bluewhite18=$row['bluewhite18'];       	 ####模版数据
$bluewhite19=$row['bluewhite19'];       	 ####模版数据
$bluewhite20=$row['bluewhite20'];       	 ####模版数据
$bluewhite21=$row['bluewhite21'];       	 ####模版数据
$bluewhite22=$row['bluewhite22'];       	 ####模版数据
$bluewhite23=$row['bluewhite23'];       	 ####模版数据
$themecode=$row['themecode'];        		 ####网站模版代码
$themecolor=$row['themecolor'];        		 ####网站模版色系
$site_title=$row['site_title'];              ####网站标题
$site_name=$row['site_name'];                ####网站名称
$site_url=$row['site_url'];                  ####网站网址
$cardpay_url=$row['cardpay_url'];            ####充值卡网址
$wap_url=$row['wap_url'];                 	 ####wap网址
$site_logo=$row['site_logo'];                ####网站站标
$login_logo=$row['login_logo'];                ####网站站标
$site_describe=$row['site_describe'];        ####网站描述
$site_keywords=$row['site_keywords'];        ####网站关键词
$site_copyright=$row['site_copyright'];      ####网站版权说明
$site_menu=$row['site_menu'];                ####菜单导航
$smtp_email=$row['smtp_email'];              ####邮箱SMTP服务
$send_email=$row['send_email'];              ####发件箱
$send_email_password=$row['send_email_password'];####邮箱密码
$sup_number=$row['number'];                  ####Sup编号
$shop_sort=$row['shop_sort'];                ####店铺排序
$shop_name=$row['shop_name'];                ####店铺后缀
$login_reg=$row['login_reg'];                ####注册协议
$login_prompt=$row['login_prompt'];          ####登录提示
$javascript=$row['javascript'];              ####代码调用
$site_price1=$row['site_price1'];            ####建站价格1
$version1=$row['version1'];                  ####建站版本1
$level1=$row['level1'];                      ####建站等级1
$site_domain1=$row['domain1'];               ####是否赠送域名
$site_record1=$row['record1'];               ####是否赠送备案
$site_price2=$row['site_price2'];            ####建站价格2
$version2=$row['version2'];                  ####建站版本2
$level2=$row['level2'];                      ####建站等级2
$site_domain2=$row['domain2'];               ####是否赠送域名
$site_record2=$row['record2'];               ####是否赠送备案
$site_price3=$row['site_price3'];            ####建站价格3
$version3=$row['version3'];                  ####建站版本3
$level3=$row['level3'];                      ####建站等级3
$site_domain3=$row['domain3'];               ####是否赠送域名
$site_record3=$row['record3'];               ####是否赠送备案
$site_price4=$row['site_price4'];            ####建站价格4
$version4=$row['version4'];                  ####建站版本4
$level4=$row['level4'];                      ####建站等级4
$site_domain4=$row['domain4'];               ####是否赠送域名
$site_record4=$row['record4'];               ####是否赠送备案
$site_charge1=$row['charge1'];               ####提现费用1
$site_charge2=$row['charge2'];               ####提现费用2
$site_charge3=$row['charge3'];               ####提现费用3
$site_charge4=$row['charge4'];               ####提现费用4
$api_qq=$row['api_qq'];                      ####QQ验证
$site_rate=$row['site_rate'];                ####建站费率D
$site_alipay=$row['alipay'];                 ####支付宝收款账户
$site_tenpay=$row['tenpay'];                 ####财付通收款账户
$site_tenpay_key=$row['tenpay_key'];         ####财付通密钥
$Ecard_price=$row['site_sup_p2'];            ####密保卡价格
$cloud_price=$row['site_sup_p1'];            ####搜云令价格
$site_sup_p3=$row['site_sup_p3'];            ####域名价格
$site_sup_p4=$row['site_sup_p4'];            ####备案价格
$Shop_red_price1=$row['Shop_red_price1'];
$Shop_red_price2=$row['Shop_red_price2'];
$Shop_red_price3=$row['Shop_red_price3'];
$Shop_red_price4=$row['Shop_red_price4'];
$sub_price=$row['subprice'];                       ####分站商品费率
$site_icon=$row['site_icon'];
$pmt_price=$row['pmt_price'];                      ####商家促销价格
$fship_price1=$row['fship_price1'];                ####旗舰店按月收费
$fship_price2=$row['fship_price2'];                ####旗舰店按年收费
$fship_price3=$row['fship_price3'];                ####旗舰店最低冻结金额
$catalogue=$row['catalogue'];                      ####默认显示的商品目录    
$site_price_1=$row['price_1'];                     ####店铺目录购买价格
$qqchat=$row['qqchat'];                            ####qq客服开关
$qqaccount=$row['qqaccount'];                      ####qq客服资料
$qq1=$row['qq1'];                      ####qq客服资料
$qq2=$row['qq2'];                      ####qq客服资料
$qq3=$row['qq3'];                      ####qq客服资料
$qq4=$row['qq4'];                      ####qq客服资料
$phoe1=$row['phoe1'];          ####客服电话
$phoe2=$row['phoe2'];          ####客服电话
$phoe3=$row['phoe3'];          ####客服电话
$address=$row['address'];          ####地址
$ProductRecommend=$row['ProductRecommend'];   		####商品推荐
mysql_free_result($sresult);


$sresult=mysql_query("select * from punishment where id=1",$conn1);
$row=mysql_fetch_array($sresult);
$nlegal_open=$row['wg_open'];      ##处罚开关
$nlegal_b_1=$row['bwg_1'];         ##买家商品纠纷
$nlegal_b_2=$row['bwg_2'];         ##文明规范纠纷
$nlegal_b_3=$row['bwg_3'];         ##关键词
$nlegal_b_4=$row['bwg_4'];         ##买家上限分数
$nlegal_b_5=$row['bwg_5'];         ##买家上限扣款
$nlegal_b_6=$row['bwg_6'];         ##买家冻结账户
$nlegal_m_1=$row['mwg_1'];         ##卖家商品纠纷
$nlegal_m_2=$row['mwg_2'];         ##违规商品
$nlegal_m_3=$row['mwg_3'];         ##违规商品关键词
$nlegal_m_4=$row['mwg_4'];         ##72小时未退款扣分
$nlegal_m_5=$row['mwg_5'];         ##虚假商品
$nlegal_m_6=$row['mwg_6'];         ##误导性商品
$nlegal_m_7=$row['mwg_7'];         ##违法商品
$nlegal_m_8=$row['mwg_8'];         ##文明规范纠纷
$nlegal_m_9=$row['mwg_9'];         ##关键词
$nlegal_m_10=$row['mwg_10'];       ##卖家上限分数
$nlegal_m_11=$row['mwg_11'];       ##卖家上限扣款
$nlegal_m_12=$row['mwg_12'];       ##卖家冻结账户



#####################SUP 官方配置
$sresult=mysql_query("select * from sup_site_config where id=1",$conn2);
$row=mysql_fetch_array($sresult);
$api_ofpay_u=$row['api_ofpay_u'];#欧飞账户
$api_ofpay_p=$row['api_ofpay_p'];#欧飞密码
$sup_site_url=$row['site_url'];#官网地址
mysql_free_result($sresult);

#####################SUP 官方插件价格
$sresult=mysql_query("select * from sup_sell_price where id=1",$conn2);
$row=mysql_fetch_array($sresult);
$moprice1=$row['price1'];
$moprice2=$row['price2'];
$moprice3=$row['price3'];
$moprice4=$row['price4'];
mysql_free_result($sresult);

#####################SUP 官方插件价格
$sresult=mysql_query("select * from sup_members_site where number='$sup_number'",$conn2);
$row=mysql_fetch_array($sresult);
$pss_price1=$row['price1'];                 ### 建站费用
$pss_price2=$row['price2'];                 ### 次年续费
$pss_price3=$row['price3'];                 ### 分站额度1个费用
$pss_price4=$row['price4'];                 ### 分站额度10个费用
$pss_price5=$row['price5'];                 ### 分站额度30个费用
$pss_price6=$row['price6'];                 ### 分站续费
$pss_dk_open=$row['dk_open'];               ### 点卡进销平台
$pss_jf_open=$row['jf_open'];               ### 积分兑换平台
$pss_ykt_open=$row['ykt_open'];             ### 一卡通平台
$pss_bbs_open=$row['bbs_open'];             ### 用户交流论坛
$pss_seo_open=$row['seo_open'];             ### 快速推广模块
$sup_auto_refund=$row['wqtk_open'];         ### 订单维权自动退款
$sup_rules_module=$row['wgcf_open'];        ### 违规处罚模块
$sup_credit_module=$row['sjxy_open'];       ### 商家信誉模块
$pss_kjdg_open=$row['kjdg_open'];           ### 快捷导购模块
$sup_order_refund=$row['ddpl_open'];        ### 订单批量 退款 / 按天退款模块
$pss_hyczz_open=$row['hyczz_open'];         ### 会员成长值升级模块
$pss_sppm_open=$row['sppm_open'];           ### 商品竞拍模块
$sup_number_module=$row['yhbh_open'];       ### 用户编号购买模块
$pss_xszd_open=$row['xszd_open'];           ### 新手指导模块
$pss_email_open=$row['email_open'];         ### 邮件群发模块
$pss_sms_open=$row['sms_open'];             ### 短信群发模块
$pss_khd_open=$row['khd_open'];             ### ipone 安卓客户端
$pss_sjlp_open=$row['sjlp_open'];           ### 手机令牌模块
$pss_dtmb_open=$row['dtmb_open'];           ### 动态密保模块
$pss_mbk_open=$row['mbk_open'];             ### 密保卡模块
$pss_api_open=$row['api_open'];             ### Api外部调用模块
$pss_ptspdy_open=$row['ptspdy_open'];       ### 平台间商品调用模块
$pss_tbdp_open=$row['tbdp_open'];           ### 淘宝店铺对接
$pss_wyqs_open=$row['wyqs_open'];           ### 5173对接
$pss_sales=$row['sales'];                   ### 每月最大销量
$pss_edu1=$row['edu1'];                     ### 经销商证书认证
$pss_edu2=$row['edu2'];                     ### 网站基本风格
$pss_edu3=$row['edu3'];                     ### 每月最大销量
$Exp_time=$row['dbegtime'];                 ###到期时间
$Exp_sup_open=$row['locks'];                ###Sup控制主站开关
$Exp_sup_why=$row['whys'];                  ###Sup关闭主站原因

mysql_free_result($sresult);

?>
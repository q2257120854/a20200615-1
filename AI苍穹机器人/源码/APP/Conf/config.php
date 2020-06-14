<?php
return array(
	//'配置项'=>'配置值' *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
	'APP_GROUP_LIST'           =>  'Index,systemlogined',
	'DEFAULT_GROUP'            =>  'Index',
	'TMPL_VAR_IDENTIFY'        =>  'array',
    //URL设置 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'URL_MODEL'                 => 1,
    //设置独立分组
    'APP_GROUP_MODE'            =>  1,          //启用独立分组 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'APP_GROUP_MODE`ROUP_PATH'            =>  'Modules',
	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',        // 数据库类型 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'DB_HOST'               =>  '127.0.0.1',    // 服务器地址 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'DB_NAME'               =>  'zz',   // 数据库名
    'DB_USER'               =>  'zz',         // 用户名
    'DB_PWD'                =>  'hbjrGbpFDjCfaJty',             // 密码 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'DB_PORT'               =>  '3306',         // 端口 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'DB_PREFIX'             =>  'ds_',          // 数据库表前缀 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'SESSION_TYPE'          =>  'Db',           //将session写入数据库 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
	
	
    // 缓存类型为File
    'type'  =>  'File', 
    // 缓存有效期为永久有效
    'expire'=>  0, 
    //缓存前缀
    'prefix'=>  'shop',
	
		/* 无法加载模块错误补丁 */
	'URL_CASE_INSENSITIVE'  => true,         //不区分大小写 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    //多语言配置
    'LANG_SWITCH_ON'        => true,
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_LIST'        => 'zh-cn,zh-tw,en-us', // 允许切换的语言列表 用逗号分隔 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
	'VAR_FILTERS'	=>	'stripslashes,strip_tags,htmlspecialchars', *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    //调试信息显示
    'SHOW_PAGE_TRACE'       =>    false,        // 显示页面Trace信息 *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
    //公司名称
    'COMPANY_NAME'          =>  'FC',
    //加载扩展配置
    'LOAD_EXT_CONFIG'       => 'system,tuopu,tuopuq,tuopu1,tuopu2',
    'API_URL'               => "http://".$_SERVER['HTTP_HOST']    //$_SERVER['HTTP_HOST'] *此程序由苍穹网络科技工作室分享，三岁半乐网：https://www.sansuib.com
);
?>
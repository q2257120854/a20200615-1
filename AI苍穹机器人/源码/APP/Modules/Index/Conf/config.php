<?php 
	return array(
		'LOGIN_THEME' =>	'default',//默认登录主题
		'DEFAULT_THEME' =>	'default',//默认主题
		'TMPL_PARSE_STRING'	=>	array('__PUBLIC__'=>__ROOT__. '/' . APP_NAME . '/Modules/Index/Tpl/default/Public',
									'__LOGINTHEME__'=>__ROOT__. '/Public/LoginTheme/default'
									 ),
		'URL_HTML_SUFFIX'	=>	'',
		'TMPL_ACTION_ERROR'=>'Public:error',
    	'TMPL_ACTION_SUCCESS'=>'Public:success',
	);
?>
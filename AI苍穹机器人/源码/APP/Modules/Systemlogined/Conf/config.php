<?php
	return array(
		'RBAC_SUPERADMIN'	=>	'admin',	//超级管理员名称
		'ADMIN_AUTH_KEY'	=>	'superadmin',	//超级管理员识别
		
		'USER_AUTH_ON'		=>	true,	//是否开启验证
		'USER_AUTH_TYPE'	=>	1,	//验证类型1:登录 2：时时
		'USER_AUTH_KEY'		=>	'id',	//用户认证识别号

		'NOT_AUTH_MODULE'	=>	'Index',	//无需认证的控制器
		'NOT_AUTH_ACTION'	=>	'editMemberGroup,editFl,editFeng,addJinbi,addJinbiHandle,addBaodan,addBaodanHandle,deleteGroup,editMember,editMemberHandle,inMember,deleteMember,add_member_group,addGroupHandle,editMemberGroup,editGroupHandle,checkGroupName,pin_list,pinAdd,pinaddHandle,deletePin,tuopu,tuopu2,add_product,addProductHandle,editProduct,editProductHandle,delProduct,add_type,addTypeHandle,addSon,addSonHandle,delType,editType,editTypeHandle,checkTypeName,upload,delOrder,editOrder,editOrderHandle,addAnnounceType,addAnnounceTypeHandle,editAnnounceType,editAnnounceTypeHandle,deleteAnnounceType,addAnnounce,addAnnounceHandle,editAnnounce,editAnnounceHandle,deleteAnnounce,ajaxMsgReceive,replyMessage,deleteMessage,editUser,editUserHandle,deleteUser,editNode,editNodeHandle,deleteNode,deleteNodeHandle,addUser,addUserHandle,checkUserName,addRole,addRoleHandle,checkRoleName,addNode,addNodeHandle,editRole,editRoleHandle,deleteRole,access,setAccess,systemLog,bonusConf,withdrawConf,transferConf,rechargeConf,memberConf,clearData',	//无需认证的动作方法

		'RBAC_ROLE_TABLE'	=>	'ds_role',//角色表名称
		'RBAC_USER_TABLE'	=>	'ds_role_user',	//角色与用户的中间表名称
		'RBAC_ACCESS_TABLE'	=>	'ds_access',	//权限表名称
		'RBAC_NODE_TABLE'	=>	'ds_node',	//节点表名称


		'TMPL_PARSE_STRING'	=>	array('__PUBLIC__'=>__ROOT__. '/' . APP_NAME . '/Modules/Systemlogined/Tpl/Public' ),
		'URL_HTML_SUFFIX'	=>	'',
		'LISTROWS'			=>	10,
	);
?>
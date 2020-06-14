<?php
	/**
	 * 用户与角色关联模型
	 */
	Class UserRelationModel extends RelationModel{
		//定义主表名称
		protected $tableName = 'user';

		//定义关联关系
		protected $_link = array(
			'role'=>array(
				'mapping_type'=>MANY_TO_MANY,//多对多关系
				'foreign_key'=>'user_id',//主表在中间表中的字段名称
				'relation_key'=>'role_id',//副表在中间表中的字段名称
				'relation_table'=>'ds_role_user',
				'mapping_fields'=>'id,name,remark'
				)
			);

	}
?>
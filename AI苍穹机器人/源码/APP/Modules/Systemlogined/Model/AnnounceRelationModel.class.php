<?php  
	/**
	 * 公告与公告类别的关系模型
	 */
	Class AnnounceRelationModel extends RelationModel{
		//定义主表名称
		protected $tableName = 'announce';

		//定义关联关系
		protected $_link = array(
			'announcetype'=>array(
				'mapping_type'=>BELONGS_TO,
				'foreign_key'=>'tid',
				'mapping_order'=>'addtime desc'
				),
			
			);

	}
?>
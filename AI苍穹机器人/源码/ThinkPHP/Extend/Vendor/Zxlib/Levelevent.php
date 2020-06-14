<?php
	/**
	 * 级别事件类
	 */
	class Levelobj{
		//当前用户的状态判断如果为空则不判断
		public $where;
		//执行方式[sql,SQL语句][execute,执行语句][function,执行函数]
		//[userupdate,直接对用户RS进行更新(多项目需要用:分隔,字段需要用[]括起)](附加关键字[会员编号][总PV][报单金额])
		public $runmode;
		//执行指令
		public $runstr;  

	}
?>
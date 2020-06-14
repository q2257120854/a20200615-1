<?php
	/**
	 * 级别定义类
	 */
	class Levelobj{

		public $lv;
		public $name;
		//自动升级设定
		public $upstr;
		//自动升级模式
		public $upmode;
		//计算金额
		public $pvmoney;
		//级别事件
		public $leveleventnum = -1;
		public $pv;
		//实交金额
		public $p_money;
		//如果为空则不增加时效计算,如果为字符则按照时间规则来计算D为天W为星期M为月
		public $uplvdatemode;
		//如果uplvdatemode有内容，则此处指定长度
		public $uplvdatenum;
		public $style;
		public $uptimemode = 0;
		public $levelevent = array();

		public function addEvent($leveleventobj){
			$this->leveleventnum ++;
			$levelevent[$this->leveleventnum] = $leveleventobj;
		}

		/**
		 * 获取实交金额
		 * @return [type] [description]
		 */
		public function getMoney(){
			return $this->p_money;
		}

		/**
		 * 设置计算金额和实付金额
		 * @param [type] $newvalue [description]
		 */
		public function setMoney($newvalue){
			$this->p_money = $this->vNewValue;
			$this->pvmoney = $this->vNewValue;
		}

	}
?>
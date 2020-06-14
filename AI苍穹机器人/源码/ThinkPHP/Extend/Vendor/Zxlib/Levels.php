<?php
	/**
	 * 级别集合类
	 */
	class Levelsobj{
		public $id;
		public $treeid;
		//级别名称
		public $name = '会员级别';
		//如果执行自动升级操作,在结算前还是在结算后[0结算前][1结算后]
		public $autouptime = 0;
		//如果autouptime为2，那么是否根据，autoup_g_treename限定只处理其上属相关部门的级别，以便节省结算效率
		public $autouptime2treenoly;
		//自动升级如果有网体参照,则标明网体结构名,如"代网"
		public $autoup_g_treename = '';
		//自动升级如果有网体参照,则标明参考字段名,如"团队业绩"
		public $autoup_g_rowname = '';
		//级别设定数量
		public $levelnum = -1;
		//会员级别集合
		public $level = array();
		//显示会员级别
		public $displv = true;
		//显示申请会员级别
		public $dispreglv = true;
		//升级模式,默认为userwhere表示用户条件判断，同时还有sqlwhere'为整体SQL判断
		public $uplvmode = 'userwhere';

		/**
		 * 校验级别信息是否存在
		 * @return [bool] [description]
		 */
		public function checkLevelNum($val){
			$result = false;
			if (!is_numeric($val)) {
				return $result;
			}
			for ($i=0; $i <= $this->levelnum ; $i++) { 
				if ($level[$i]->lv == intval($val)) {
					$result = true;
				}
			}
			return $result;
		}
		
		/**
		 * 增加等级设定
		 */
		public function addLevel($level_obj){
			$this->levelnum ++;
			$level[$this->levelnum] = $level_obj;
		}

		/**
		 * 取得等级数据信息
		 * @return [type] [description]
		 */
		public function getLvName($num,$clsname){
			$name = '';
			for ($i=0; $i <= count($this->level)-1 ; $i++) { 
				if ($level[$i]->lv == $num) {
					switch ($clsname) {
						case 'name':
							$name = $level[$i]->name;
							break;
						case 'pv':
							$name = $level[$i]->pv;
							break;
						case 'money':
							$name = $level[$i]->money;
							break;
						case 'pvmoney':
							$name = $level[$i]->pvmoney;
							break;
						case 'style':
							$name = $level[$i]->style;
							break;
					}
				}
			}
			return $name;
		}

		/**
		 * 级别数据转换
		 * @return [type] [description]
		 */
		public function getV2V($v1,$c1,$c2){
			$result = null;
			switch ($c1) {
				case 'lv':
					$result = 0;
					break;
				case 'name':
					$result = '';
					break;
				case 'pv':
					$result = 0;
					break;
				case 'money':
					$result = 0;
					break;
			}

			for ($i=0; $i <= count($this->level)-1 ; $i++) { 
				$find = false;
				switch ($c1) {
					case 'lv':
						$level[$i]->lv == $v1 and $find = true;
						break;
					case 'name':
						$level[$i]->name == $v1 and $find = true;
						break;
					case 'pv':
						$level[$i]->pv == $v1 and $find = true;
						break;
					case 'money':
						$level[$i]->money == $v1 and $find = true;
						break;
				}
				if ($find) {
					switch ($c2) {
						case 'lv':
							$result = $level[$i]->lv;
							break;
						case 'name':
							$result = $level[$i]->name;
							break;
						case 'pv':
							$result = $level[$i]->pv;
							break;
						case 'money':
							$result = $level[$i]->money;
							break;
					}
				}
			}
			return $result;
		}

		/**
		 * 取得等级数据信息
		 * @param  [type] $num [description]
		 * @return [string]      [description]
		 */
		public function getLevelName($num){
			$name = '';
			for ($i=0; $i <= count($this->level)-1 ; $i++) { 
				if ($level[$i]->lv == $num) {
					$name = $level[$i]->name;
				}
			}
			return $name;
		}

		/**
		 * 带样式的等级数据信息
		 * @param  [type] $num [description]
		 * @return [type]      [description]
		 */
		public function getLevelNameStyle($num){
			$name = '';
			for ($i=0; $i <= count($this->level)-1 ; $i++) { 
				if ($level[$i]->lv == $num) {
					$name = $level[$i]->name;
					if ($level[$i]->style != '') {
						$name = '<font style='.$level[$i]->style .'>'. $name . '</font>';
					}
				}
			}
			return $name;
		}
	}

?>
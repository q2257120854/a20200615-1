<?php  
	/**
	 * 网体集合类
	 */
	class Trees{
		//程序ID
		public $id;
		//网体数量     
		public $treenum = -1;
		//奖金的统一名称
		public $prizename = '佣金';
		public $DefaultRegTree;
		public $caltime = '';
		public $adminloginhost = '';
		public $loadsqldatanum = -1;
		public $loadsqldata = array();
		public $loadphpdatanum = -1;
		public $loadphpdata = array();
		public $tablebak = false;
		public $tablebakday = 5;
		//设置对接接口密码
		public $postpass = '';
		//设置对接接口MD5加密级别
		public $md5size = 32;
		//是否开启结算功能，秒结系统关闭，如果存在混合结算模式的系统目前还需要改良
		public $usecal = true;
		public $caldaynum = -1;
		public $ignorenotcalday = false;
		//系统总配置项目
		//是否启用SMSOPEN'当如果不需要启用SMSOPEN同时没有任何会员需要登入时。则关闭信息交流项目
		public $smsopen = true;
		public $ui_userleftframe = true;
		public $ui_adminleftframe = true;
		//是否启用三级密码
		public $pass3 = false;
		//是否启用密保问题
		public $passwt = false;
		//表名
		public $tree = array();

		//目前发现在创建数据库的时候有使用
		public function loadSql($sqlfilepath){
			$this->loadsqldatanum++;
			$this->loadsqldata[$this->loadsqldatanum] = $sqlfilepath;
		}
		
		public function loadPhp($phpfilepath){
			//..........
		}
		
		public function loadMod($mod_name){
			//..........
		}

		public function getMenuNum($menuuser,$menulx){
			//获取菜单ID,暂时不使用
		}

		/**
		 * 添加网体
		 * @param [type] $treeobj [description]
		 */
		public function addTree($tree_obj){
			$this->treenum++;
			$this->tree[$this->treenum] = $tree_obj;
			$this->tree[$this->treenum]->id = $this->treenum;
		}

		/**
		 * 根据网体名字获取网体对象
		 * @param  [type] $name [description]
		 * @return [type]       [description]
		 */
		public function getTree($name){
			for ($i=0; $i <= $this->treenum; $i++) { 
				if ($tree[$i]->tablename == $name) {
					return $this->tree[$i];
				}
			}
		}
		
		/**
		 * 添加语言,-----------以后再加------------
		 */
		public function addLang($lang_id,$lang_lname,$lang_name){
			//......
		}

		/**
		 * 会员总账归零
		 * @return [type] [description]
		 */
		public function clearAdd(){
			for ($i=0; $i <= $this->treenum; $i++) {
				//公司总账部份
				$this->tree[$i]->addyj = 0;//新增业绩
				$this->tree[$i]->addhy = 0;//新增会员数
				$this->tree[$i]->addjj = 0;//当天总奖金
				$this->tree[$i]->addff = 0;//当天发放

				for ($j=0; $j <= $this->tree[$i]->zzmnum ; $j++) { 
					$this->tree[$i]->zzm[$j]->addyj = 0;
				}

				for ($k=0; $k <= $tree[$i]->tlenum ; $k++) { 
					$this->tree[$i]->tle[$k]->addff = 0;
					$this->tree[$i]->tle[$k]->addjj = 0;
				}
			}
		}
		

	}
?>
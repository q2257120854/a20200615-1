<?php 
	/**
	 * 网体类
	 */
	class Tree{
		//外网接口登入密码
		public $postpass = '';
		public $menutitle;
		//外网登入用户不存在时候的提示
		public $postlogin_nousermsg = '';
		//登入失败时转跳的SALE注册ID
		public $postlogin_nousersaleid = -1;
		//是否禁止死点登录  
		public $lock_D_login = true;
		//登入失败的锁定次数
		public $login_error_locknum = 0;
		//是否通过IP形式进行锁定
		public $login_error_lockforip = false;
		//是否通过IP形式进行锁定  
		public $login_error_lockmsg = '您已经多次错误登陆，请明日在试。';
		//语言信息
		public $lstrdata = '简[会员]繁[會員]英[Member]日[メンバー]韩[&#54924;&#50896;]';
		public $l_name = 'huiyuan';
		//要关闭的字段
		public $closefun = '';//要关闭的字段
		//如果前台没有公共注册项目的时候，所展示的图片
		public $noregimg;
		//登入码    
		public $logincode = '';               
		public $p_id;
		//设置别名
		public $p_nametitle;
		//整体称谓，为人或者为店，或者为公司，默认为人
		public $alltitle = '人';
		public $zzmwhere = '';
		//------------会员编号生成信息,考虑放在Conf中以配置文件的形式--------------
		//会员编号是否增加日期信息
		public $aiddate = true;
		//会员编号的编号最小长度
		public $aidnumlen = 3;
		//会员编号初始大小
		public $aidnum = 1;
		//会员编号左字符    
		public $aidlstr = '';
		//会员左边是否以区号开    
		public $aidcity;
		//会员编号是否允许人工输入
		public $aidedit = 0;
		public $aidrcstr = 'slen-5-12|ennum';
		//随机数编号
		public $aidrnd;
		//-------------会员编号生成信息---------------
		//表名
		public $tablename;
		//是否允许前台登入
		public $login;    
		public $loginhost = '';
		//是否显示有关虚点的信息
		public $guestdisp = true;
		//如果存在虚点。保留天数
		public $clearguestday = 0;
		//是否允许删除实点会员
		public $overdel = true;
		//是否有非必要字段，一般在第二或者以上网体不需要装载这些内容  
		public $memodata = true;
		//是否使用代理
		public $agency = false;   
		//允许省代理
		public $agency_province = true;
		//允许市代理
		public $agency_city = true;
		//代理信息唯一性模式[0]平级模式(省代下可以存在市代)[1]越级模式(省代下不允许出现市代)
		public $agency_only = 0;
		//用户允许修改自己的姓名信息
		public $ud_name = true;
		//用户允许修改自己的银行帐号
		public $ud_bank = true;  
		//用户允许修改自己的省市信息
		public $ud_where = true; 
		//用户允许修改自己的联系电话
		public $ud_tel = true;   
		//级别集合数量
		public $levelsnum = -1;
		//级别集合
		public $levels = array(); 
		//网体列数
		public $modenum = -1;  
		//网体列
		public $mode = array();   
		//报单注册设定
		public $salenum = -1;  
		//报单注册
		public $sale = array();   
		//结算数
		public $tlenum = -1;
		//结算
		public $tle = array();
		//功能数
		public $funnum = -1;
		//功能
		public $fun = array();    
		//总帐累计设定数
		public $zzmnum = -1;   
		//总帐累计设定
		public $zzm = array();	
		//总帐特定数字内容
		public $zzotherrow = array();
		//总长特定数字字段信息
		public $zzotherrownum = -1;
		//允许让其他人看到此网体的报单
		public $looksalenum = -1;  
		//允许让其他人看到此网体的报单
		public $looksale = array();
		//允许让其他人看到此网体的奖金
		public $lookbonusnum = -1; 
		//允许让其他人看到此网体的奖金
		public $lookbonus = array();  
		//审核权限数组
		public $acc = array();
		public $accnum = -1;
		//登入SESSION数
		public $tsessionnum = -1;
		//登入SESSION
		public $tsession = array();
		//跨网修改资料的权限数
		public $editnum = -1;    
		//跨网修改资料的权限
		public $edit = array();     
 		//它网登入
		public $ologinnum = -1;
		//它网登入
		public $ologin = array();
		public $dosqlnum = -1;
		public $dosql = array();
		public $ulp2num = -1;
		//会员需2级密码确认的报表名称，或者权限名称
		public $ulp2 = array();     
		public $state = array();
		public $statenum = -1;
		public $menu = array();
		public $menunum = -1;
		//定义显示此网体的报单注册审核的DOGIF附加条件数组
		public $saleAccountlock = array();
		public $saleAccountlocknum = -1;
		//---------------显示部分
		public $disp_userindex = false;
		//显示报单信息中的PV值
		public $disp_salepv = true;       
		//会员查看自己报单记录的附加条件
		public $disp_salelookwhere = '';
		public $disp_selectname = false;
		public $disp_regdate = true;
		public $disp_Accountdate = true;
		public $disp_Caldate = true;
		//是否在会员体系显示报单记录菜单
		public $disp_usersale = true;    
		public $disp_logintime = false;

		//状态部分
		public $state_S = '实点';
		public $state_X = '虚点';
		public $state_D = '死点';

		//公司总帐部分
		//新增会员数
		public $addhy = 0;
		//新增业绩
		public $addyj = 0;
		//当天总奖金
		public $addjj = 0;
		//当天发放
		public $addff = 0;
		//名称部分
		//菜单项5个主菜单的显示内容
		public $menu1name = '个人信息';
		public $menu2name = '财务信息';
		public $menu3name = '团队信息';
		public $menu4name = '信息交流';
		public $menu5name = '业务管理';
		public $menueditmename = '个人资料修改';
		public $menubuyname = '我的报单信息';
		public $menumailname = '沟通邮件';
		
		//报单金额名称
		public $mname = '报单金额'; 
		//PV值名称
		public $pvname = '报单PV'; 
		//购物金额名称
		public $imname = '购物金额'; 
		//购物PV名称
		public $ipvname = '购物PV';
		
		//初始化
		public function __construct(){
			$this->addState('实点', 'S', '正式注册并进行财务审核的会员', '#144388');
			$this->addState('虚点', 'X', '正式注册并进行财务审核的会员', 'Orange');
			$this->addState('死点', 'D', '正式注册并进行财务审核的会员', 'Red');
		}
		
		//---------------属性设置-------------------
		
		public function getId(){
			return $this->p_id;
		}
		
		public function setId($newid){
			$this->p_id = $newid;
			for ($i = 0; $i <= $this->salenum; $i++) {
				$this->sale[$i]->sale_treeid = $this->p_id;
			}
			
			for ($i = 0; $i <= $this->funnum; $i++) {
				$this->fun[$i]->treeid = $this->p_id;
			}
			
			for ($i = 0; $i <= $this->levelsnum; $i++) {
				$this->levels[$i]->treeid = $this->p_id;
			}
		}
		
		//---------------属性设置完成-------------------
		
		public function getlstr(){
			//......语言相关，暂不处理
		}
		
		//验证关闭的字段
		public function chkclose($f_name){
			$result = false;
			if ($this->closefun == '') {
				return false;
			}
			$closefunarr = explode(',', $this->closefun);
			for ($i = 0; $i <= count($closefunarr); $i++) {
				if ($f_name == $closefunarr[$i]) {
					$result = true;
				}
			}
			return $result;
		}

		/**
		 * 导入菜单
		 * @param unknown $menuname
		 * @param unknown $menuuser
		 * @param unknown $menulx
		 * @param unknown $menuurl
		 */
		public function loadMenu($menuname,$menuuser,$menulx,$menuurl){
			$this->menunum++;
			$this->menu[0][$this->menunum] = $menuname;
			$this->menu[1][$this->menunum] = $menuuser;
			$this->menu[2][$this->menunum] = $menulx;
			$this->menu[3][$this->menunum] = $menuurl;
		}
		
		/**
		 * 显示=>是否有必要显示未审核会员功能
		 * @return [type] [description]
		 */
		public function dispUserGuest(){
			$return = false;
			for ($i=0; $i <= $this->salenum; $i++) {
				if ($this->sale[$i]->mode == 0 && !$this->sale[$i]->confirm) {
					$return = true;
				}
			}
			return $return;
		}
		
		public function dispSaleGuest(){
			$return = false;
			for ($i=0; $i <= $this->salenum; $i++) {
				if (($this->sale[$i]->mode == 0 || $this->sale[$i]->mode == 1 || $this->sale[$i]->mode == 2) && !$this->sale[$i]->confirm) {
					$return = true;
				}
			}
		}
		
		/**
		 * 对称呼进行获取
		 * @return [type] [description]
		 */
		public function getNameTitle(){
			if ($this->p_nametitle != '') {
				return $this->p_nametitle;
			}else{
				return $this->tablename;
			}
		}

		/**
		 * 对称呼进行设置
		 * @param [type] $v [description]
		 */
		public function setNameTitle($v){
			$this->p_nametitle = $v;
		}


		//---------------------开始添加相关的对象---------------------
		/**
		 * 增加网体字段
		 * @param [type] $modeobj [description]
		 */
		public function addMode($mode_obj){
			$this->modenum++;
			$this->mode[$this->modenum] = $mode_obj;
			$this->mode[$this->modenum]->treeid = $this->getId();
			$this->mode[$this->modenum]->id = $this->modenum;
		}

		/**
		 * 增加等级设定
		 * @param [type] $levelsobj [description]
		 */
		public function addLevels($levels_obj){
			$this->levelsnum++;
			$this->levels[$this->levelsnum] = $levels_obj;
			$this->levels[$this->levelsnum]->id = $this->levelsnum;
			$this->levels[$this->levelsnum]->treeid = $this->getId();
		}

		/**
		 * 增加注册设定
		 * @param [type] $saleobj [description]
		 */
		public function addSale($sale_obj){
			$this->salenum++;
			$this->sale[$this->salenum] = $sale_obj;
			if ($this->sale[$this->salenum]->lvname != '') {
				$this->sale[$this->salenum]->lvobj = $this->getLevels($this->sale[$this->salenum]->lvname);
			}
			$this->sale[$this->salenum]->id = $this->salenum;
		}

		/**
		 * 结算功能设定
		 * @param [type] $tleobj [description]
		 */
		public function addTle($tle_obj){
			$this->tlenum++;
			$tle_obj->id = $this->tlenum;
			$this->tle[$this->tlenum] = $tle_obj;
		}

		/**
		 * 增加功能设定
		 * @param [type] $funobj [description]
		 */
		public function addFun($fun_obj){
			$this->funnum++;
			$this->fun[$this->funnum] = $fun_obj;
			$this->fun[$this->funnum]->treeid = $this->p_id;
			$this->fun[$this->funnum]->id = $this->funnum;
		}

		/**
		 * 增加功能设定
		 * @param [type] $zzmobj [description]
		 */
		public function addZzm($zzm_obj){
			$this->zzmnum++;
			$this->zzm[$this->zzmnum] = $zzm_obj;
		}

		/**
		 * 增加总帐附加字段
		 * @return [type] [description]
		 */
		public function addZzoTherRow($s_name,$s_sql,$s_default){
			$this->zzotherrownum++;
			$this->zzotherrow[0][$this->zzotherrownum] = $s_name;
			$this->zzotherrow[1][$this->zzotherrownum] = $s_sql;
			$this->zzotherrow[2][$this->zzotherrownum] = $s_default;
		}
	
		/**
		 * 增加跨网报单信息查看
		 * @param unknown $looksaleobj
		 * @param unknown $looksale_quanxian
		 */
		public function addLookSale($looksale_obj,$looksale_quanxian){
			$this->looksalenum++;
			$this->looksale[0][$this->looksalenum] = $looksale_obj;
			$this->looksale[1][$this->looksalenum] = $looksale_quanxian;
		}
		
		/**
		 * 增加跨网奖金信息查看
		 * @param unknown $lookbonus_obj
		 */
		public function addLookBonus($lookbonus_obj){
			$this->lookbonusnum++;
			$this->lookbonus[$this->lookbonusnum] = $lookbonus_obj;
		}
		
		/**
		 * 增加跨网奖金信息编辑
		 * @param unknown $edit_tree
		 * @param unknown $edit_quanxian
		 * @param unknown $edit_gifstr
		 */
		public function addEdit($edit_tree,$edit_quanxian,$edit_gifstr){
			$this->editnum++;
			$this->edit[0][$this->editnum] = $edit_tree;
			$this->edit[1][$this->editnum] = $edit_quanxian;
			$this->edit[2][$this->editnum] = $edit_gifstr;
		} 
		
		/**
		 * 定义报单审核功能
		 */
		public function addAcc($acc_tablename,$acc_salelb,$acc_bankname,$acc_gif,$acc_ohteronly){
			$this->accnum++;
			$this->acc[0][$this->accnum] = $acc_tablename;
			$this->acc[1][$this->accnum] = $acc_salelb;
			$this->acc[2][$this->accnum] = $acc_bankname;
			$this->acc[3][$this->accnum] = $acc_gif;
			$this->acc[4][$this->accnum] = $acc_ohteronly;
		}

		/**
		 * 增加信息查看的校验函数
		 * @param unknown $chkedit_name
		 * @return boolean
		 */
		public function chkEdit($chkedit_name){
			if ($this->editnum == -1) {
				return false;
			}
			
			for ($i = 0; $i <= $this->editnum; $i++) {
				if ($this->edit[0][$i] == $_SESSION['usertree']) {
					if ($chkedit_name == '') {
						return true;
					}else{
						if ($this->edit[1][$i] == 'all') {
							return true;
						}
						$chkedit_qxarr = explode(',', $this->edit[1][$i]);
						for ($k = 0; $k <= count($chkedit_qxarr)-1; $k++) {
							if ($chkedit_qxarr[$k] == $chkedit_name) {
								return true;
							}
						}
					}
					
				}
			}
			return false;
		}
		
		/**
		 * 增加SESSION (连接输出内容,跨网登入名称,绑定外网会员编号的字段,如果在没有查询到的时候是否显示)
		 * @param unknown $o_astr
		 * @param unknown $o_treename
		 * @param unknown $o_bhrow
		 * @param unknown $o_nofinddisp
		 * @param unknown $o_nofindmsg
		 */
		public function AddOlogin($o_astr,$o_treename,$o_bhrow,$o_nofinddisp,$o_nofindmsg){
			$this->ologinnum++;
			$this->ologin[0][$this->ologinnum] = $o_astr;
			$this->ologin[1][$this->ologinnum] = $o_treename;
			$this->ologin[2][$this->ologinnum] = $o_bhrow;
			$this->ologin[3][$this->ologinnum] = $o_nofinddisp;
			$this->ologin[4][$this->ologinnum] = $o_nofindmsg;
		}
		
		public function addSession($tsession_obj){
			$this->tsessionnum++;
			$this->tsession[$this->tsessionnum] = $tsession_obj;
		}
		
		/**
		 * 增加二级密码限制
		 * @param unknown $ulp2_obj
		 */
		public function addUlp2($ulp2_objval){
			$this->ulp2num++;
			$this->ulp2[$this->ulp2num] = $ulp2_objval;
		}
		
		/**
		 * 增加dosql，MODE分别有"caldoaddval",在结算时执行报单处理与业绩添加之前,其他的暂未添加
		 * @param unknown $d_objmode
		 * @param unknown $d_objval
		 * @param unknown $d_gifstr
		 */
		public function addDoSql($d_objmode,$d_objval,$d_gifstr){
			$this->dosqlnum++;
			$this->dosql[0][$this->dosqlnum] = 	$d_objmode;
			$this->dosql[1][$this->dosqlnum] = 	$d_objval;
			$this->dosql[2][$this->dosqlnum] = 	$d_gifstr;
		}
		
		/**
		 * 暂时不写，貌似没用
		 * @param unknown $modename
		 */
		public function runDoSql($modename){
			
		}
		
		/**
		 * 最得总账
		 * @param unknown $zzmname
		 * @return number
		 */
		public function getAddyj($zzmname){
			if ($zzmname == '') {
				return $this->addyj;
			}
			$result = 0;
			for ($i = 0; $i <= $this->zzmnum; $i++) {
				if ($this->zzm[$i] == $zzmname) {
					$result = $this->zzm[$i]->addjy;
				}
			}
			return $result;
		}
		/**
		 * 根据名字取得网体结构对象
		 * @param unknown $modename
		 * @return NULL
		 */
		public function getMode($modename){
			$result = null;
			for ($i = 0; $i <= $this->modenum; $i++) {
				if ($this->mode[$i]->treename == $modename) {
					$result = $this->mode[$i];
				}
			}
			return $result;
		}
		
		/**
		 * 根据名字取得结算对象
		 * @param unknown $tlename
		 * @return multitype:
		 */
		public function getTle($tlename){
			for ($i = 0; $i <= $this->tlenum; $i++) {
				if ($this->tle[$i]->name == $tlename) {
					return $this->tle[$i];
				}
			}
		}
		/**
		 * 取得网体结构所属的网体名,无法分析mode=1的网络体系
		 * @param unknown $modename
		 */
		public function getModeFrom($modename){
			if (is_object($this->getMode($modename))) {
				$getmodefromobj = $this->getMode($modename);
				switch ($getmodefromobj->mode) {
					case 0:
					case 2:
					case 5:
						return $this->tablename;
						break;
					case 3:
					case 4:
						return $getmodefromobj->formtree;
						break;
				}
			}else{
				return $modename;
			}
		}
		
		/**
		 * 取得FUN结构类
		 * @param unknown $funname
		 * @return multitype:
		 */
		public function getFun($funname){
			for ($i = 0; $i <= $this->funnum; $i++) {
				if ($this->fun[$i]->name == $funname) {
					return $this->fun[$i];
				}
			}
		}
		
		/**
		 * 取得级别集合类
		 * @param unknown $levelsname
		 * @return multitype:
		 */
		public function getLevels($levelsname){
			for ($i = 0; $i <= $this->levelsnum; $i++) {
				if ($this->levels[$i]->name == $levelsname) {
					return $this->levels[$i];
				}
			}
		}
		
		/**
		 * 取会员姓名
		 * @param unknown $dealerid
		 */
		public function getDealerName($dealerid){
			 return M($this->tablename)->where(array('account'=>$dealerid))->getField('nickname');
		}
		
		/**
		 * 取会员移动电话
		 * @param unknown $dealerid
		 */
		public function getDealerPhone($dealerid){
			return M($this->tablename)->where(array('account'=>$dealerid))->getField('mobile');
		}
		
		/**
		 * 取会员地址
		 * @param unknown $dealerid
		 */
		public function getDealerAdd($dealerid){
			return M($this->tablename)->where(array('account'=>$dealerid))->getField('address');
		}
		
		/**
		 * 通过ID取得当前网体配置对象
		 * @return multitype:
		 */
		public function getNowMode(){
			$modeid = $_REQUEST['modeid'];
			if (is_numeric($modeid) && $modeid!= '') {
				$modeid = intval($modeid);
				for ($i = 0; $i <= $this->modenum; $i++) {
					if ($i == $modeid) {
						return $this->mode[$i];
					}
				}
				return $this->mode[0];
			}else{
				return $this->mode[0];
			}
		}
		
		/**
		 * 通过ID取得当前报单配置对象
		 * @return multitype:
		 */
		public function getNowSale(){
			$saleid = $_REQUEST['saleid'];
			if (is_numeric($saleid) && $saleid != '') {
				$saleid = intval($saleid);
				for ($i = 0; $i <= $this->salenum; $i++) {
					if ($i == $saleid) {
						return $this->sale[$i];
					}
				}
				return $this->sale[0];
			}else{
				return $this->sale[0];
			}
		}
		
		/**
		 * 通过ID取得当前结算对象
		 * @return multitype:
		 */
		public function getNowTle(){
			$tleid = $_REQUEST['tleid'];
			if (is_numeric($tleid) && $tleid != '') {
				$tleid = intval($tleid);
				for ($i = 0; $i <= $this->tlenum; $i++) {
					if ($i == $tleid) {
						return $this->tle[$i];
					}
				}
				return $this->tle[0];
			}else{
				return $this->tle[0];
			}			
		}
		
		/**
		 * 通过ID取得当前功能对象
		 * @return multitype:
		 */
		public function getNowFun(){
			$funid = $_REQUEST['funid'];
			if (is_numeric($funid) && $funid != '') {
				$funid = intval($funid);
				for ($i = 0; $i < $this->funnum; $i++) {
					if ($i == $funid) {
						return $this->fun[$i];
					}
				}
				return $this->fun[0];
			}else{
				return $this->fun[0];
			}
		}
		
		/**
		 * 分为SQL和DATALIST
		 * @param unknown $mode
		 */
		public function getSaleOtherRow($mode){
			//....
		}
		
		
		public function dispTleNum(){
			$result = 0;
			for ($i = 0; $i <= $this->tlenum; $i++) {
				if (!$this->tle[$i]->nullmode) {
					$result ++;
				}
			}
			return $result;
		}
		
		/**
		 * 返回会员总数量
		 * @return number
		 */
		public function userNum(){
			return M($this->tablename)->count();
		}
		
		/**
		 * 增加状态
		 * @param unknown $s_name
		 * @param unknown $s_zt
		 * @param unknown $s_str
		 * @param unknown $s_colour
		 */
		public function addState($s_name,$s_zt,$s_str,$s_colour){
			$this->statenum++;
			$this->state[0][$this->statenum] = $s_name;
			$this->state[1][$this->statenum] = $s_zt;
			$this->state[2][$this->statenum] = $s_str;
			$this->state[3][$this->statenum] = $s_colour;	
		}
		
		/**
		 * 验证状态是否存在
		 * @param unknown $s_name
		 * @param unknown $s_val
		 * @return boolean
		 */
		public function chkState($s_name,$s_val){
			$result = false;
			for ($i = 0; $i <= $this->statenum; $i++) {
				if ($s_val == $this->state[1][$i] && $s_name == $this->state[0][$i]) {
					$result = true;
				}
			}
			return $result;
		}
		
		/**
		 * 对此会员的下级网体进行判断
		 * @param unknown $chkdel_hybh
		 */
		public function chkdel($chkdel_hybh){
			$result = '';
			for ($i = 0; $i <= $this->modenum; $i++) {
				$mode = $this->mode[$i];
				switch ($mode->mode) {
					//级差或双轨检测
					case 0:
					case 2:
					case 5:
						if (M($this->tablename)->where(array($mode->treename.'_upaccount' => $chkdel_hybh))->count()) {
							$result = '此会员已有推荐或安置会员，所以无法删除!'; 
						};
						break;
					//跨网检测
					case 4:
						if (M($mode->formtree)->where(array($mode->treename.'_upaccount' => $chkdel_hybh))->count()) {
							$result = '此会员已有推荐或安置会员，所以无法删除!'; 
						};
						break;
					
				}
			}
			return $result;
		}
		
		/**
		 * 审核报单
		 * @param unknown $s_dataid			数据库
		 * @param unknown $s_accountname	操作人名称
		 * @param unknown $accountmode		审核模式:	0为标准审核、1为自行审核、2为后台、3为网上支付
		 */
		public function doSaleAccount($s_dataid,$s_accountname,$accountmode){
			$result = '';
			$sale = M($this->tablename.'sale')->where(array('id'=>$s_dataid))->find();
			if (!$sale) {
				return '报单记录未查到';
			}
			
			if ($sale['bdstatus'] == '已确认' || $sale['bdstatus'] == '已生效') {
				return '此报单已被确认过，无需确认';
			}
			
			if ($sale['bdstatus'] == '未确认') {
				$condition_if = true;
				$sale = $this->sale[$sale['salenum']];
				
				if ($accountmode == 10) {
					$conditionrow = $sale->conditionrow;
					if ($sale->conditionaccrow != '') {
						$conditionrow = $sale->conditionaccrow;
					}
					//待添加.....
					
				}
			}
			
		}
		
		
		
		
		
		

	}
?>

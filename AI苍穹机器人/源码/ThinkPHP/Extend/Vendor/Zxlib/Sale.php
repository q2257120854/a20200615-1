<?php 
	/**
	 * 报单类
	 */
	class Sale{
		public $id;
		public $sale_treeid;        
		public $lvobj;        //使用的会员级别集合
		public $lvname = '';       //级别名称
		public $use = true;          //是否被使用
		public $rnddecimal = true;   //是否启动流水款项随机小数,在非自动生效的前提下
		public $valaddnum = -1;    //追加字段数据长度
		public $usetreenum = -1;   //允许注册数据长度
		public $autoinnum = -1;    //自动添加
		public $reglocknum = -1;   //注册时的校验
		public $oversqlnum = -1;   //注册时的校验
		public $valadd = array();     //注册确认后可以追加的金额字段,第一参数为字段，第二参数为[0为结算时处理][1为生效时处理]，第三参数为要添加的内容
		public $usetree = array();    //允许使用的注册会员网体，ADMIN为管理员
		public $autoin = array();      //多点添加模式
		public $reglock = array();     //注册时的校验
		public $oversql = array();     //成功后扩展SQL
		public $otherrow= array();    //扩展
		public $otherrownum = -1;   //扩展
		public $deltree = array();     //设置可以删除此报单的网体，只会在业务管理中的LOOKSALE项目中体现.
		public $deltreenum = -1;    //设置可以删除此报单的网体数
		public $delforuser = false;    //如果当此单为注册单类型时，是否联动删除掉所属会员。但是删除会员时结算会员不能够在进行删除。
		public $discount = array();    //折扣设定，二维数组，第一为级别，第二为折扣数
		public $discountnum = -1;
		public $treedbh = array();     //设置网体默认编号数据
		public $treedbhnum = -1;    //设置网体默认编号数据的长度
		public $oversms = array();
		public $oversmsnum = -1;
		public $lockme = true;        //当允许使用注册会员网体是会员网体本身,则是否绑定自身会员编号,补级与消费注册模式有效,如果扣费代理为本网体会员,则此项需要关闭.
		public $menulook = true;      //是否允许在菜单上显示此项目
		public $name;          //"注册单"//报单项名称
		public $mode;          //[0级别注册形][1级别升级型][2金额消费型]
		public $guestreg = true;      //是否运行进行公共注册
		public $confirm = false;       //用户注册情况下是否直接确认
		public $setmoney = false;      //注册时是否可以自己设定金额
		public $setpv = false;         //注册时是否可以自己设定金额
		public $setlevel = true;      //注册时是否可以自己设置级别
		public $dlevel = 0;        //默认注册级别
		public $overdel = 2;       //是否允许删除生效报单[0不能删除][1可以删除已确认和未审核][2可以删除全部报单]
		public $moneyif = 'money';       //金额校验模式分为money与pv,默认为money
		public $moneymin = 0;      //最小消费额度
		public $moneymax = 0;      //最大消费额度
		public $moneyminmsg = '您的消费金额不能小于[val].';   //金额小于提示
		public $moneymaxmsg = '您的消费金额不能大于[val].';  //金额大于提示
		public $condition = 0;     //条件模式[0无条件][1款项满足]
		public $conditionmode = '';//锁定的mode网体名称，当为会员注册模式时，要直接绑定的网体字段，以免别人开出其他代理的实单，如果为跨网，只能绑定为3的跨网MODE
		public $conditionrow = ''; //要操作的电子货币
		public $conditionlog = true;//如果当condition不为0的时候，将根据condition的值建立记录字段
		public $conditionby = 'auto';       //要扣除电子货币的项目[sale_m,item_m]
		public $conditionby_kval = 0;  //
		public $conditionby_kval_x = true; //是否要乘以PV值
		public $conditionAccount = false;
		public $conditionreturn = true;   //删除已确认报单时，是否返还扣款？
		public $conditionmaxratio = 100; //需要使用电子货币的数量最大比例，默认为100，如果小于100，则注册强制为虚单，并扣除电子货币，扣除后减少流水额项目。
		public $sysbankdispmode = 0;   //虚点注册银行显示信息模式0为自动，1为强制为公司
		public $nullmode = false;           //空点模式
		public $othername = '';          //别名
		public $otherAccountname = '';  //审核别名
		public $buy1mode = 'pvmoney';   //金额差额按照PVMONEY来收取
		public $m1add = false;             //是否开启公排加入
		public $m1addrow = '';           //参照基数字段（报单），如果为空则为1
		public $m1addval = 1;          //加入点基数默认为1
		public $m1treename = '';         //公排网体名
		public $uplv_difference = true;
		public $bankmemo = false;           //是否增加对电子货币对象的备注输入
		public $sendmemo = false;           //说是否允许添加物流信息
		public $uplstartnum = 2;        //升级单的时候显示的最小级别
		public $formlooktree = '';       //是否可以进行报单信息查看透视。根据报单来源体系的TREE体系进行透视查看
		public $otheraccount = false;      //是否允许支付宝以及直接电子货币支付审核
		public $otherformNo = false;       //是否启用自定义来源编号
		public $otherformNoname;    //显示名称
		public $otherformNotreename = '';//自定义来源编号的所属MODE名称，比如专卖店
		public $otherformNowhere;   //允许作为自定义来源编号的条件如[会员级别]>1
		public $otherformNolock = true;   //锁定状态，如果为锁定，则来源编号为指定otherformNotreename上级编号，如果不锁定则还可以在注册时修改
		public $otherformNoedit = true;   //在非锁定情况下，是否可以自行编辑来源编号
		public $otherformNodispbank = true;//如果为自定义来源编号情况下，是否显示其来源编号的汇款信息
		public $otherformNoinnull = true; //是否可以允许改成非必填项目
		public $selectstate = false;       //自定义会员状态
		public $postpass = '';           //如果设置内容则开启外部注册接口，并且设置MD5校验信息
		public $disptreetel;        //注册以后要显示的制定网体人员的联系方式
		public $runscal = false;            //执行完成后是否激发秒结函数默认为关闭状态
		public $mode1upmax = 0;         //升级模式最大跨度，0为无限
		public $protocol_src = '';      //协议
		//专门针对激活而使用的变量
		public $b_reg;
		public $b_sale;
		public $b_yeji;
		public $b_bonus;
		public $b_msg;
		//针对购物所需要用的函数
		public $buyitemname = '';    //设置购物的时候的物品表名字。如果为空表示非购物模式
		public $buyitemmoney = '';    //设置购物时候的物品表的金额字段
		public $buyitempmoney = '';  //设置购物时候的物品表的积分字段
		public $buyitemmoney_l_name = 'amount';    //设置购物时候的物品表的金额字段
		public $buyitempmoney_l_name = 'pv';   //设置购物时候的物品表的积分字段
		public $dispitemmoney = true;
		public $dispitempmoney = true;
		public $pass2 = false;
		public $pass3 = false;
		public $passid = false;
		public $winopen = true;
		public $payacc = true; //如果为虚点状态是否允许通过在线支付进行审核
		public $payovermsg = '支付成功';//支付成功显示信息
		public $notaccmsg = '此订单已经登记，将在公司审核完成后生效';
		
		public function getMsg($msgmode){
			$msg = '';
			switch ($msgmode) {
				case 'notacc':
					$msg = $this->notaccmsg;
					break;
				case 'payover':
					$msg = $this->payovermsg;
					break;
			}
			return $msg;		
		}
		
		/**
		 * 取得报单要扣除电子货币款项的参考值
		 * @param unknown $sale_m
		 * @param unknown $sale_p
		 * @param unknown $item_m
		 * @param unknown $item_p
		 * @return number
		 */
		public function getConditionBy($sale_m,$sale_p,$item_m,$item_p){
			$t_conditionby = $this->conditionby;
			if ($t_conditionby == 'auto') {
				if ($this->buyitemname == '') {
					$t_conditionby = 'sale_m';
				}else{
					$t_conditionby = 'item_m';
				}
			}
			$result = 0;
			if (strpos($t_conditionby, 'sale_m') > 0) {
				$result += $sale_m;
			}	
			if (strpos($t_conditionby, 'sale_p') > 0) {
				$result += $sale_p;
			}
			if (strpos($t_conditionby, 'item_m') > 0) {
				$result += $item_m;
			}
			if (strpos($t_conditionby, 'item_p') > 0) {
				$result += $item_p;
			}
			if ($this->conditionby_kval_x) {
				$result += $this->conditionby_kval * $sale_p;
			}else{
				$result += $this->conditionby_kval;
			}
			return (float)$result;		
		}
		
		/**
		 * 获取名称
		 * @return unknown
		 */
		public function getName($trees){
			$result = '';
			if ($this->othername != '') {
				$result = $this->othername;
			}else{
				$result = $trees->tree[$this->sale_treeid]->tablename;
				switch ($this->mode) {
					case 0:
						$result .= '注册';//会员注册
						break;
					case 1:
						$result .= '升级';//会员升级
						break;
					case 2:
						$result .= '续费';//会员续费
						break;
					case 3:
						$result .= '状态变更';//会员状态变更
						break;
				}
				if ($this->nullmode) {
					$result .= '(空)';
				}
			}
			return $result;
		}
		
		/**
		 * 
		 * @return string
		 */
		public function getAccountName(){
			if ($this->otherAccountname != '') {
				return $this->otherAccountname;
			}else{
				switch ($this->mode) {
					case 0:
					case 2:
						return $this->name.'审核';
						break;
				}
			}
		}
		
		/**
		 * 验证是否可以删除
		 * @return boolean
		 */
		public function chkDelete($tree){
			$result = false;

			for ($i = 0; $i <= $tree->salenum ; $i++) {
				for ($j = 0; $j <= $this->deltreenum; $j++) {
					if ($this->deltree[$j] == $_SESSION['usertree']) {
						$result = true;
					}
				}
			}
			return $result;
		}
		
		/**
		 * 网体默认编号数据的长度
		 * @param unknown $s_treename
		 * @param unknown $s_bh
		 */
		public function addTreeDbh($s_treename,$s_bh){
			$this->treedbhnum++;
			$this->treedbh[0][$this->treedbhnum] = $s_treename;
			$this->treedbh[1][$this->treedbhnum] = $s_bh;
		}
		
		/**
		 * 
		 * @param unknown $trees
		 * @param unknown $f_treename
		 * @return string
		 */
		public function getDbh($trees,$f_treename){
			$str = '';
			for ($i = 0; $i <= $this->treedbhnum; $i++) {
				if ($this->treedbh[0][$i] == $f_treename) {
					$str = $this->treedbh[1][$i];
				}
			}
			if ($str == '') {
				$autobh = $trees->tree[$this->sale_treeid]->getmode($f_treename);
				if ($autobh->autobh) {
					switch ($autobh->mode) {
						case 0:
						case 2:
						case 5:
							if ($_SESSION['usertree'] == $trees->tree[$this->sale_treeid]->tablename) {
								$str = $_SESSION['username'];
							}
							break;
						case 3:
							//getdbh=sqlval("select "&f_treename&"_上级编号 from "&trees.tree(sale_treeid).tablename&" where 会员编号='"&session("username")&"'",conn)
							break;
					}
				}
			}
			return $str;
		}
		
		
		public function addAutoIn($a_lvid,$a_treename,$a_rownum,$a_cengnum,$maxusernum,$downlv){
			$this->autoinnum++;
			$this->autoin[0][$this->autoinnum] = $a_lvid;
			$this->autoin[1][$this->autoinnum] = $a_treename;
			$this->autoin[2][$this->autoinnum] = $a_rownum;
			$this->autoin[3][$this->autoinnum] = $a_cengnum;
			$this->autoin[4][$this->autoinnum] = $maxusernum;
			$this->autoin[5][$this->autoinnum] = $downlv;
		}
		
		public function addOverSql($a_sqlstr,$a_gifstr){
			$this->oversqlnum++;
			$this->oversql[0][$this->oversqlnum] = $a_sqlstr;
			$this->oversql[1][$this->oversqlnum] = $a_gifstr;
		}
		//添加额外报单项目，名称，类型，长度，默认值
		public function addOtherRow($a_rowname,$a_rowmode,$a_rowlen,$a_rowdval,$a_indata){
			$this->otherrownum++;
			$this->otherrow[0][$this->otherrownum] = $a_rowname;
			$this->otherrow[1][$this->otherrownum] = $a_rowmode;
			$this->otherrow[2][$this->otherrownum] = $a_rowlen;
			$this->otherrow[3][$this->otherrownum] = $a_rowdval;
			$this->otherrow[4][$this->otherrownum] = $a_indata;
		}
		
		public function doOverSql($dobh,$f_rs_id){
			for ($i = 0; $i <= $this->oversqlnum; $i++) {
				$dooversql_sqlstr = $this->oversql[0][$i];
				$dooversql_gifstr = $this->oversql[1][$i];
				switch ($this->mode) {
					case 0://注册
						$dooversql_sessiontop = '';
						break;
					case 1://升级
						$dooversql_sessiontop = 'buy1';
						break;
					case 2://消费
						$dooversql_sessiontop = 'buy2';
					break;
				}
				//待处理
				//$dooversql_sqlstr = str_replace('total_pv', $replace, $subject)	
			}
		}
		
		
		public function addRegLock($lockifstr,$msgstr,$stepnum){
			$this->reglocknum++;
			$this->reglock[0][$this->reglocknum] = $lockifstr;
			$this->reglock[1][$this->reglocknum] = $msgstr;
			$this->reglock[2][$this->reglocknum] = $stepnum;
		}
		
		public function checkRegLock($stepid){
			$result = true;
			for ($i = 0; $i <= $this->reglocknum; $i++) {
				if ($this->reglock[2][$i] == $stepid) {
					$checkreglockif = $this->reglock[0][$i];
					if ($checkreglockif) {
						$msgstr = $this->reglock[1][$i];
						$msgstr = str_replace('[reg_sale_money]', session('reg_sale_money'), $msgstr);
						$msgstr = str_replace('[reg_sale_pv]', session('reg_sale_pv'), $msgstr);
						
						if ($this->reglock[1][$i] != '') {
							//...弹出$msgstr
						}
						return false;
					}
				}
			}
			return $result;
		}
		
		public function addDelTree($name){
			$this->deltreenum++;
			$this->deltree[$this->deltreenum] = $name;
		}
		
		public function addDiscount($s_lv,$s_discount){
			$this->discountnum++;
			$this->discount[0][$this->discountnum] = $s_lv;
			$this->discount[1][$this->discountnum] = $s_discount;
		}
		
		public function addVal($rowname,$objval,$objmode,$where,$salewhere){
			$this->valaddnum++;
			$this->valadd[0][$this->valaddnum] = $rowname;
			$this->valadd[1][$this->valaddnum] = $objval;
			$this->valadd[2][$this->valaddnum] = $objmode;
			$this->valadd[3][$this->valaddnum] = $where;
			$this->valadd[4][$this->valaddnum] = $salewhere;
		}
		
		//可操作网体,GUEST为TRUE时，表示当前操作网体为虚点时也可以报单
		public function addUseTree($objval,$guest){
			$this->usetreenum++;
			$this->usetree[0][$this->usetreenum] = $objval;
			$this->usetree[0][$this->usetreenum] = $objval;
		}
		/**
		 * 根据网体名称查询是否允许报单
		 * @param unknown $treename
		 * @return boolean
		 */
		public function conCheckUseTree($treename){
			$result = false;
			for ($i = 0; $i <= $this->usetreenum; $i++) {
				if ($this->usetree[0][$i] == $treename) {
					$result = true;
				}
			}
			return $result;
		}
		
		public function checkUseTree($treename,$hyzt){
			$result = '权限不足';
			for ($i = 0; $i <= $this->usetreenum; $i++) {
				if ($this->usetree[0][$i] == $treename) {
					if ($this->usetree[1][$i] || (!$this->usetree[1][$i] and $hyzt == '实点')) {
						//验证二级密码	待考虑
					}else{
						$result = '您不是实点会员不能操作';
					}
					
					if ($treename == 'admin') {
						$nullstr = '';
						$this->nullmode and $nullstr = '(空)';
						switch ($this->mode) {
							case 0:
								//验证后台权限.....待完成
								$result = '';
								break;
							case 1:
								$result = '';
								break;
							case 2:
								$result = '';
								break;
							case 3:
								$result = '';
								break;
						}						
					}
				}	
			}
			return $result;	
		}
		
		/**
		 * 自动处理，金额增加
		 * @param unknown $sale_rs
		 * @param unknown $dovaladd_mode
		 */
		public function doValAdd($trees,$sale_rs,$dovaladd_mode){
			//推荐-XXX
			//ITEM-XXXxN'发送卡
			//TOITEM-YYY'对购买的YYY型号的物品,其数量发送到XXX
			$tree_obj = $trees->tree[$this->sale_treeid];
			$user_rs = M($tree_obj->tablename)->where(array('account'=>$sale_rs['account']))->find();
			for ($i = 0; $i <= $this->valaddnum; $i++) {
				if ($this->valadd[2][$i] = $dovaladd_mode && dogif(null, null, "", $this->valadd[3][$i], "", $user_rs) && dogif(null, null, '', $this->valadd[4][$i], '', $sale_rs)) {
					//如果存在跨网增加的情况下
					$valaddtodata = explode('-', $this->valadd[0][$i]);
					switch ($valaddtodata[0]) {
						//当有购物信息
						case 'ITEMTO':
						
						break;
						
						default:
							;
						break;
					} 
				}
			}
			
			
		}
		
		/**
		 * 反向处理doValAdd
		 * @param unknown $sale_rs
		 */
		public function unDoValAdd($sale_rs){
			
		}
		
		/**
		 * 
		 * @param unknown $rsobj
		 */
		public function doConditionReturn($rsobj){
			
		}
		
		/**
		 * 报单完成后的短信发送
		 * @param unknown $s_confirm
		 * @param unknown $s_userrs
		 */
		public function doOverSms($s_confirm,$s_userrs){
			
		}
		
	
		
		
	}
?>
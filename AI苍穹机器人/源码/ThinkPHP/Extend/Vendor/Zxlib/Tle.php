<?php
	/**
	 * 系统结算类
	 * @author Administrator
	 *
	 */ 
	class Tle{
		
		public $id;
		public $treeId;
		//奖金名称
		public $name = '奖金';
		public $l_name = 'prize';
		//结转金额
		public $prize_outnum = 0;
		//奖金模式数量
		public $prizenum = -1;
		//奖金封顶模式数量
		public $topnum = -1;
		//如果存在网站使用费，是否在此奖金项目里边进行扣除
		public $netuse = true;
		//奖金转字段
		public $prizeadd = array();
		//奖金转字段数目
		public $prizeaddnum = -1;
		//奖金模式数组		
		public $otherrow = array();
		//其他字段
		public $otherrownum = -1 ;
		//奖金模式数组		
		public $prize = array();
		//封顶
		public $top = array();
		//'结算模式 [-1秒结][0日结日发][1日结周发][2周结周发][3日结月发][4周结月发][5月结月发][6年结年发]		
		public $TleMode;     
		//结算日期
		public $TleDay;      
		//结算天的分时时间
		public $TleTime = '';
		//获得此奖金的条件
		public $getwhere = '';
		//结转时获得此奖金的条件
		public $tlegetwhere ='';
		//结转发放此奖金的条件
		public $tleoutwhere = '';
		//给发电子货币的条件		
		public $tlebankwhere = '';
		//是否单独显示此奖金的拨比
		public $dispbb = true;
		//是否显示收入为0的奖金		
		public $dispnull = true;
	
		public $addff = 0;
		public $addjj = 0;
		//定义累计项目名称
		public $zzmname = '';     
		public $nullmode = false;
		public $ui_bankdisp = true;
		public $ui_indexdisp = false;
		public $othername = '';
		public $kval = 0;
		public $Dialoutval = 0;
		public $composition = false;
		//用于秒结存储订单数据		
		public $saledataid = 0;
		//用于秒结存储订单数据
		public $saledatapv;
		//用于秒结存储订单数据		
		public $saledatamoney;
		//用于秒结存储订单数据
		public $saledatabh;
		//秒结汇总模式。1为day,2为month		
		public $scalsummode = 1;
		//秒结会员初始数据更新到_SCAL表中的模式all为全部 空为不操作 mode.name为针对报单所属网络
		public $inscalmode = '';
		//根据PV执行秒结程序循环
		public $scalforpv = false;
		
		public function addCom($userid,$buydate,$caldate,$giveid,$givelv,$prizename,$prizenum){
			$data['userid'] = $userid;
			$data['buydate'] = $buydate;
			$data['caldate'] = $caldate;
			$data['giveid'] = $giveid;
			$data['givelv'] = $givelv;
			$data['prizename'] = $prizename;
			$data['prizenum'] = $prizenum;
			
			
		}
		
		public function runmakeexe(){
			
		}
		
		
		
		
		
	}
	
?>
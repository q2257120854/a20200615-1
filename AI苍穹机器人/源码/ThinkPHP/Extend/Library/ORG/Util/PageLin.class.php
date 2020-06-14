<?php
/**
 * 分页类，支持PHP5+
 *
 * @author 林坤源 (文豆版)
 * @version 5.2.7 最后修改时间 2012年12月03日
 * @link http://www.lamsonphp.com
 * @example 
 * 可以在实例化的时候一起初始化此类的公共变量，只要传递一个关联数组做参数即可；
	$page = new Page(1000, array('txtMode'=>-2));
	echo $page -> pageList();
 * PS: 生成分页工具栏后还会产生一个JS的全局变量 lamPageObj = {para:"", pageVar: ""};
 * 需要依赖的资源：
	类： 
	函数：  
	变量：  
 *
 */
class PageLin
{
	const VERSION = '5.2.7'; //本类版本
	public $leftDmt = ''; //页码的左边定界符，例如 [
	public $rightDmt = ''; //页码的右边定界符，例如 ]
	public $pageVar = 'page'; //page变量名，用来控制url页。比如说xxx.php?page=2中的page
	public $always = false; //（当总记录数不足一页）是否总是显示分页
	public $count = 0; //数据的总条数(一般要通过数据库的select count(1)语句获得)
	public $per = 20; //每页显示多少条记录
	public $total = 0; //总页数
	public $nums = 10; //页面的数目
	public $part = 2; //部分时的页码个数(取值只能1>=$part<=3，默认为2)
	public $txtMode = - 2; //是否显示提示文本 -2：长模式在前面  -1：简短模式在前面  0：不提示   1：简短模式在后面   2：长模式在后面
	public $phpActName = ''; //通过这个PHP函数来设置分页地址（适合于伪静态或真静态分页）
	public $jsActName = ''; //通过这个js函数来设置分页地址
	public $para = ''; //除了分页外的其它附带参数(写成&键=值的形式)
	public $autoCss = true; //是否自动输出自带的CSS(如果设置为false，别忘了手工加载css样式)
	public $pgSign = '№'; //页码占位符(必须为一些不常用的特殊字符,例如§┠№)
	public $select = true; //是否显示下拉列表
	public $debug = false; //是否为调试模式
	public $model = 'default'; //默认的分页模型,内部会转换成 _mainDefault
	public $style = 'default'; //默认的分页样式表名,内部会转换成 lamDefault
	protected $_currPg = 1; // 当前页
	protected $_outPut = ''; //输出分页
	protected $_index;
	static $_minstanCnt = 1; //实例化的数量
	public static $lang = array('fst_txt' => '首页', 'pre_txt' => '上一页', 'nxt_txt' => '下一页', 'lst_txt' => '尾页', 'unit' => '条记录', 'show_per' => '每页显示', 'has_total' => '总共有', 'not_found_model' => '找不到名称为 %s 的分页样式', 'tothe' => '&nbsp;转到：第', 'page_unit' => '页', 'not_found_php' => '找不到名称为 %s 的分页处理函数');

	/**
	 * 构造函数
	 * @param int $count 数据的总记录数
	 * @param array $array 初始化本类的公共属性的关联数组
	 */
	public function __construct($count = 0, $array = array())
	{
		foreach($array as $k=>$v)
		{
			$this -> $k = $v;
		}
				
		$this->count = max((int)$count, 0);	//数据的总条数
		
		$this->_prePageList();

		if($this->para=='')
		{
			$g = $_GET;
			unset($g[$this->pageVar]);
			$this->para = http_build_query($g);
		}
	}

	/**
	 * 调用前的一些检验
	 */
	protected function _prePageList()
	{
		if(! in_array($this->part, array(1, 2, 3)))
		{
			$this->part = 2;
		}
		
		$this->_currPg = max(( int ) $_GET[$this->pageVar], 1); //当前页
		

		if(( int ) $this->per <= 0)
		{
			$this->per = 20; //每页显示条数
		}
		
		$this->total = ceil($this->count / $this->per); //总页数
		

		if($this->_currPg > $this->total && $this->count > 0)
		{
			$this->_currPg = $this->total;
		}
	}

	/**
	 * 外部调用此函数输出列表
	 * @param string $style 分页样式表名
	 * @param string $model 分页模型名
	 */
	public function pageList($style = '', $model = '')
	{
		$this->_prePageList();
		
		if(($this->count <= 0) or ($this->count <= $this->per && ! $this->always)) //如果总记录数小于等于0 或者 记录数不足一页而且 always为否
		{
			return '';
		}
		$this->style = 'lam' . ucfirst($style ? $style : $this->style);
		
		return $this->_cssPageList() . $this->_pageList('_main' . ucfirst($model ? $model : $this->model)) . $this->_jsPageList();
	}
	
	//pageList的预处理函数
	protected function _pageList($mainfunc = '')
	{
		$txt = '<span id="LamPagePer">' . self::$lang['show_per'] . "<em>$this->per</em>".self::$lang['unit'].",</span><span id=\"LamPageTotal\">" . self::$lang['has_total'] . "<em>$this->count</em>".self::$lang['unit']."</span>";
		$shorttxt = self::$lang['has_total'] . ":<em>$this->count</em>".self::$lang['unit']." ($this->_currPg/$this->total " . self::$lang['page_unit'] . ') ';
		
		$this->_outPut = "<div id=\"LamPageBar\"><div class=\"lamPage $this->style\">";
		
		$this->_outPut .= ($this->txtMode == - 2 ? $txt : ($this->txtMode == - 1 ? $shorttxt : ''));
		
		$this->_frontItem();
		
		$this->_index = ceil($this->nums / 2); //5
		

		if(method_exists($this, $mainfunc))
		{
			$this->$mainfunc();
		}
		elseif($this->debug)
		{
			die(sprintf(self::$lang['not_found_model'], $mainfunc));
		}
		
		$this->_behindItem();
		
		$this->_outPut .= ($this->txtMode == 2 ? $txt : ($this->txtMode == 1 ? $shorttxt : ''));
		
		$this->_selectItem();
		
		$this->_outPut .= '</div></div>';
		return $this->_outPut;
	}
	
	//显示首页和上一页
	protected function _frontItem()
	{
		//显示首页
		if(self::$lang['fst_txt'])
		{
			if($this->_currPg == 1)
			{
				$this->_outPut .= '<span class="disabled">' . $this->leftDmt . self::$lang['fst_txt'] . $this->rightDmt . '</span>';
			}
			else
			{
				$this->_outPut .= '<a class="fst" href="' . $this->_pu(1) . '">' . $this->leftDmt . self::$lang['fst_txt'] . $this->rightDmt . '</a>';
			}
		}
		//显示上一页
		if(self::$lang['pre_txt'])
		{
			if($this->_currPg == 1)
			{
				$this->_outPut .= '<span class="disabled">' . $this->leftDmt . self::$lang['pre_txt'] . $this->rightDmt . '</span>';
			}
			else
			{
				$this->_outPut .= '<a class="pre" href="' . $this->_pu($this->_currPg - 1) . '">' . $this->leftDmt . self::$lang['pre_txt'] . $this->rightDmt . '</a>';
			}
		}
	}
	
	//显示下一页和尾页
	protected function _behindItem()
	{
		//显示下一页
		if(self::$lang['nxt_txt'])
		{
			if($this->_currPg == $this->total)
			{
				$this->_outPut .= '<span class="disabled">' . $this->leftDmt . self::$lang['nxt_txt'] . $this->rightDmt . '</span>';
			}
			else
			{
				$this->_outPut .= '<a class="nxt" href="' . $this->_pu($this->_currPg + 1) . '">' . $this->leftDmt . self::$lang['nxt_txt'] . $this->rightDmt . '</a>';
			}
		}
		//显示尾页
		if(self::$lang['lst_txt'])
		{
			if($this->_currPg == $this->total)
			{
				$this->_outPut .= '<span class="disabled">' . $this->leftDmt . self::$lang['lst_txt'] . $this->rightDmt . '</span>';
			}
			else
			{
				$this->_outPut .= '<a class="lst" href="' . $this->_pu($this->total) . '">' . $this->leftDmt . self::$lang['lst_txt'] . $this->rightDmt . '</a>';
			}
		}
	}
	
	//返回当前页面
	public function getCurrPg()
	{
		return $this->_currPg;
	}
	
	//返回总页数
	public function getTotalPg()
	{
		return $this->total; //总页数;
	}
	
	//返回SQL中的 limit部分
	public function limit()
	{
		$offset = ($this->getCurrPg() - 1) * $this->per; /* 从索引为几的记录开始查询 */
		return " LIMIT $this->per OFFSET $offset";
	}

	/**
	 * 显示下拉列表 开始
	 */
	protected function _selectItem()
	{
		if(! $this->select)
		{
			return '';
		}
		$str = '';
		$num = self::$_minstanCnt ++;
		$url = addslashes("$this->para&$this->pageVar=");
		$urlstr = $this->_pu($this->pgSign);
		$this->_outPut .= self::$lang['tothe'];
		//如果超出 40000 页，容易发生浏览器 当机的情况，所以当超出40000页时，换成输入框
		if($this->total > 40000)
		{
			$this->_outPut .= '<input type="text" size="5" class="_LamPageIptItem" value="' . $this->_currPg . '" onchange="page_select_item' . $num . '(this.value)" /> / ' . $this->total;
		}
		else
		{
			for($i = 1; $i <= $this->total; ++ $i)
			{
				$str .= '<option value="' . $i . '">' . $i . '</option>';
			}
			$this->_outPut .= "<select id=\"_LamPageSelectItem$num\" onchange=\"page_select_item$num(this.value)\">$str</select>
				<script>try{document.getElementById('_LamPageSelectItem$num').selectedIndex = ($this->_currPg-1);}catch(e){}</script>";
		}
		$this->_outPut .= "<script>function page_select_item$num(n){n=parseInt(n);if('$this->jsActName'!=''){{$this->jsActName}(n);}else{window.location = '$urlstr'.replace('$this->pgSign', n);}}</script>";
		$this->_outPut .= self::$lang['page_unit'];
	}

	/**
	 * *********************************************************** 主体函数列表 以_main开头，加上model的名称(首字母大写) ***********************************************************
	 */
	
	//风格：首页，上一页，下一页，尾页
	protected function _mainSimple()
	{
	}
	
	//风格:首页，上一页，连续页码(5,6,7,8)，下一页，尾页
	protected function _mainDefault()
	{
		if($this->_currPg <= $this->_index)
		{
			$star = 1;
			$stop = min($this->total, $this->nums);
		}
		elseif($this->_currPg <= ($this->total - $this->_index))
		{
			$star = $this->_currPg - ($this->_index - 1);
			$stop = $this->_currPg + $this->_index;
		}
		else
		{
			$star = $this->total - $this->nums + 1;
			$stop = $this->total;
		}
		for($i = max($star, 1); $i <= $stop; ++ $i)
		{
			if($this->_currPg != $i)
				$this->_outPut .= '<a href="' . $this->_pu($i) . '">' . $this->leftDmt . $i . $this->rightDmt . '</a>';
			else
				$this->_outPut .= '<span class="current">' . $this->leftDmt . $i . $this->rightDmt . '</span>';
		}
	}
	
	//风格:首页，上一页，1,2,…连续页码…，201，202，下一页，尾页
	protected function _mainDetail()
	{
		$tt1 = $this->nums + $this->part; //10+2
		$tt2 = $this->total - $this->nums + 1;
		$tt3 = $this->nums - $this->part;
		
		if($this->total <= $tt1)
		{
			$star = 1;
			$stop = $this->total;
			$case = 1;
		}
		else
		{
			if($this->_currPg <= $tt3)
			{
				$star = 1;
				$stop = $this->nums;
				$case = 2;
			}
			elseif($this->_currPg < $this->total - $this->_index - $this->part)
			{
				$star = $this->_currPg - $this->_index;
				$stop = $this->_currPg + $this->_index - 1;
				$case = 3;
			}
			elseif($this->_currPg >= $tt2)
			{
				$star = $tt2;
				$stop = $this->total;
				$case = 4;
			}
			else
			{
				$star = $this->_currPg - $this->_index + 1;
				$stop = $this->_currPg + $this->_index;
				$case = 5;
			}
		}
		
		if(in_array($case, array(3, 4, 5)))
		{
			for($j = 1; $j <= $this->part; ++ $j)
			{
				$this->_outPut .= '<a href="' . $this->_pu($j) . '">' . $this->leftDmt . $j . $this->rightDmt . '</a>';
			}
			$this->_outPut .= '<span class="omit">...</span>';
		}
		
		for($i = $star; $i <= $stop; ++ $i)
		{
			if($this->_currPg != $i)
			{
				$this->_outPut .= '<a href="' . $this->_pu($i) . '">' . $this->leftDmt . $i . $this->rightDmt . '</a>';
			}
			else
			{
				$this->_outPut .= '<span class="current">' . $this->leftDmt . $i . $this->rightDmt . '</span>';
			}
		}
		
		if(in_array($case, array(2, 3, 5)))
		{
			$this->_outPut .= '<span class="omit">...</span>';
			for($j = $this->part; $j > 0; -- $j)
			{
				$this->_outPut .= '<a href="' . $this->_pu($this->total - $j + 1) . '">' . $this->leftDmt . ($this->total - $j + 1) . $this->rightDmt . '</a>';
			}
		}
	}

	/**
	 * ********************************************************* 输出每一个分页地址 *********************************************************
	 */
	protected function _pu($num)
	{
		$url = $this->para . '&' . $this->pageVar . '=' . $num;
		if($this->phpActName != '')
		{
			if(! function_exists($this->phpActName))
			{
				if($this->debug)
				{
					die(str_replace(self::$lang['not_found_php'], $this->phpActName));
				}
				else
				{
					return '?' . $url;
				}
			}
			else
			{
				$func = $this->phpActName;
				return $func($url);
			}
		}
		
		return '?' . trim($url, '&');
	}
	
	//输出默认css样式
	protected function _cssPageList()
	{
		return $this->autoCss ? '<style type="text/css">
		#LamPageBar .lamPage{padding:3px; margin:3px; text-align:center; font-size:13px; font-family:tahoma,helvetica,sans-serif, "宋体";}
		#LamPageBar .lamPage a, #LamPageBar .lamPage span, #LamPageBar .lamPage em{padding:2px 3px; text-decoration:none; display:inline-block;}
		#LamPageBar .lamPage .current{font-weight:bold;}
		#LamPageBar .lamPage select{margin:0 4px;}
		
		/*css lamson*/
		#LamPageBar input._LamPageIptItem{border:none; border-bottom:#5EB0DF 1px solid;}
				
		/**
		 * css lamGreenBlack style pagination
		 * @author 林坤源
		 * @version 3.0 最后修改时间 2012年09月14日
		 * @link http://www.lamsonphp.com
		 */
		#LamPageBar .lamDefault{color:#555;}
		#LamPageBar .lamDefault a{
			border:#999 1px solid; color:#555;
			background:-webkit-linear-gradient(#FFFFFF, #B1D2F5);
			background:-moz-linear-gradient(#FFFFFF, #E8F6FF);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF,endColorstr=#FFE8F6FF,grandientType=0);	
		}
		#LamPageBar .lamDefault a, #LamPageBar .lamDefault span{padding:0 3px; margin:0 3px; height:24px; line-height:24px; min-width:14px; _width:14px; _white-space:nowrap;}
		#LamPageBar .lamDefault em{color:#F60;}
		#LamPageBar .lamDefault a:hover, #LamPageBar .lamDefault a:active, #LamPageBar .lamDefault .current{
			border:#FF9600 1px solid; color:#FF6500;
			background:-webkit-linear-gradient(#FFF, #FFDFC6);
			background:-moz-linear-gradient(#FFF, #FFDFC6);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFF,endColorstr=#FFFFDFC6,grandientType=0);	
		}
		#LamPageBar .lamDefault .disabled{border:#f3f3f3 1px solid; color:#CCC;}
		</style>' : '';
	}
	
	//输出js动态绑定分布按钮的点击事件
	protected function _jsPageList()
	{
		return '<script type="text/javascript"> var lamPageObj = {para:"' . addslashes($this->para) . '", pageVar:"' . $this->pageVar . '"};' . ($this->jsActName ? '(function(){
			var LamPageBarAs = document.getElementById("LamPageBar").getElementsByTagName("a");
			for(var i in LamPageBarAs)
			{
				LamPageBarAs[i].onclick = function(){
					var _n = this.innerHTML;
					if("' . $this->leftDmt . '"!=""){_n = _n.replace("' . $this->leftDmt . '", "");}
					if("' . $this->rightDmt . '"!=""){_n = _n.replace("' . $this->rightDmt . '", "");}
					return ' . $this->jsActName . '(_n);
				}
			}
		})();' : '') . '</script>';
	}
	
	//析构函数
	public function __destruct()
	{
	}
}
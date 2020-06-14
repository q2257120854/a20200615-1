<?php
	Class CommonAction extends Action{
	  	
	  	/**
	  	 * 验证登录
	  	 * @return [type] [description]
	  	 */
	  	public function _initialize(){
	  		header("Content-Type:text/html; charset=utf-8");

	  		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
	  			$this->redirect(GROUP_NAME.'/Login/index');
	  		}
	  		//检查无需验证的控制器或方法
	  		$noAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));

	  		if (C('USER_AUTH_ON') && !$noAuth) {
	  			import('ORG.Util.RBAC');
	  			//如果是单入口对应一个项目的话，下面的GROUP_NAME不用填写
	  			RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
	  		}
	  	}

	  	public function index(){
	  		$map = $this -> _search();

			if (method_exists($this, '_search_filter')) {
				$this -> _search_filter($map);
			}
			$name = $this -> getActionName();
			$model = D($name);
			
			if (!empty($model)) {
				$this -> _list($model, $map);
			}
			$this -> display();
	  	}

		//生成查询条件
		protected function _search($name = '', $view = false) {
			$map = array();
			$request = array_filter(array_keys(array_filter($_REQUEST)), "filter_search_field");
			if (empty($name)) {
				$name = $this -> getActionName();
			}
			$model = D($name);
			if ($view) {
				$fields = get_view_fields($model);
			} else {
				$fields = $model -> getDbFields();
			}

			foreach ($request as $val) {
				if (!in_array(substr($val, 3), $fields)) {
					continue;
				}

				if (substr($val, 0, 3) == "be_") {
					if (isset($_REQUEST["en_" . substr($val, 3)])) {
						if (strpos($val, "date")) {
							$map[substr($val, 3)] = array( array('egt', date_to_int(trim($_REQUEST[$val]))), array('elt', date_to_int(trim($_REQUEST["en_" . substr($val, 3)]))));
						}
						if (strpos($val, "time")) {
							$map[substr($val, 3)] = array( array('egt', date_to_int(trim($_REQUEST[$val]))), array('elt', date_to_int(trim($_REQUEST["en_" . substr($val, 3)]))));
							//$map[substr($val, 3)] = array( array('egt', trim($_REQUEST[$val])), array('elt', trim($_REQUEST["en_" . substr($val, 3)])));
						}
					}
				}
				if (substr($val, 0, 3) == "li_") {
					$map[substr($val, 3)] = array('like', '%' . trim($_REQUEST[$val]) . '%');
				}
				if (substr($val, 0, 3) == "eq_") {
					$map[substr($val, 3)] = array('eq', trim($_REQUEST[$val]));
				}
				if (substr($val, 0, 3) == "gt_") {
					$map[substr($val, 3)] = array('egt', trim($_REQUEST[$val]));
				}
				if (substr($val, 0, 3) == "lt_") {
					$map[substr($val, 3)] = array('elt', trim($_REQUEST[$val]));
				}
			}
			return $map;
		}

		
		protected function _list($model, $map, $sortBy = '', $asc = false) {
			//排序字段 默认为主键名
			if (isset($_REQUEST['_order'])) {
				$order = $_REQUEST['_order'];
			} else {
				$order = !empty($sortBy) ? $sortBy : $model -> getPk();
			}
			//排序方式默认按照倒序排列
			//接受 sost参数 0 表示倒序 非0都 表示正序
			if (isset($_REQUEST['_sort'])) {
				$sort = $_REQUEST['_sort'] ? 'asc' : 'desc';
			} else {
				$sort = $asc ? 'asc' : 'desc';
			}
			//取得满足条件的记录数

			$count_model = clone $model;
			//取得满足条件的记录数
			if (!empty($count_model -> pk)) {
				$count = $count_model -> where($map) -> count($model -> pk);
			} else {
				$count = $count_model -> where($map) -> count();
			}
			if ($count > 0) {
				import("ORG.Util.Page");
				//创建分页对象
				$listRows = 20;

				$p = new Page($count, $listRows);
				//分页查询数据
				$voList = $model -> where($map) -> order("`" . $order . "` " . $sort) -> limit($p -> firstRow . ',' . $p -> listRows) -> select();

				$p -> parameter = $this -> _search;
				//分页显示
				$page = $p -> show();
				//列表排序显示
				$sortImg = $sort;
				//排序图标
				$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';
				//排序提示
				$sort = $sort == 'desc' ? 1 : 0;
				//排序方式
				//模板赋值显示

				$name = $this -> getActionName();
				$this -> assign('list', $voList);
				$this -> assign('sort', $sort);
				$this -> assign('order', $order);
				$this -> assign('sortImg', $sortImg);
				$this -> assign('sortType', $sortAlt);
				$this -> assign("page", $page);
			}
			return;
		}


	}
?>
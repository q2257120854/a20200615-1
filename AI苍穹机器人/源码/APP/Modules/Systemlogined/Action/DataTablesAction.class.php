<?php  
	
	Class DataTablesAction extends Action{

		/**
		 * 异步获取数据返回Json
		 * @param  [string] $sTable       [表名]
		 * @param  [string] $sIndexColumn [主键名]
		 * @param  [array] $aColumns     [查询的字段]
		 * @return [json]               []
		 */
		public function get($sTable,$sIndexColumn,$aColumns){
			//分页设置
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
			}

			//排序
			$sOrder = "";
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
						 	($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}

			//过滤
			$sWhere = "";
			if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
					{
						$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
					}
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}

			//单字段过滤
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
			}

			//构造SQL
			$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM   $sTable
				$sWhere
				$sOrder
				$sLimit
			";
			//执行SQL
			$db = new Model();
			
			$rResult = $db->query($sQuery);

			/* Data set length after filtering */
			$sQuery = "
				SELECT FOUND_ROWS()
			";
			$rResultFilterTotal = $db->query($sQuery);
			$iFilteredTotal = $rResultFilterTotal[0]['FOUND_ROWS()'];

			/* Total data set length */
			$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   $sTable
			";
			$rResultTotal = $db->query($sQuery);
			$iTotal = $rResultTotal[0]['COUNT(id)'];

			// 输出
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);

			// Return array of values
			foreach($rResult as $aRow) {
				$row = array();			
				for ( $i = 0; $i < count($aColumns); $i++ ) {
					if ( $aColumns[$i] == "logtime" ) {
						// 格式化特殊字段
						$row[] = date('Y-m-d H:i:s',$aRow[ $aColumns[$i] ]);
					}
					else if ( $aColumns[$i] == 'logtype' ){
						$row[] = $aRow[ $aColumns[$i] ] =='admin' ? '管理员操作' : '会员操作';
					}
					else if ( $aColumns[$i] != ' ' ) {
						$row[] = $aRow[ $aColumns[$i] ];
					}
				}
				$output['aaData'][] = $row;
			}
			echo $_GET['callback'].'('.json_encode( $output ).');';
		}
	}
?>
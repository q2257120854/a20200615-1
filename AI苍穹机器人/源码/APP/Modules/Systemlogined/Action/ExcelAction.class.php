<?php  

	/**
	* 会员管理控制器
	*/
	class ExcelAction extends CommonAction{
		
		//现金数据导出EXCEL
		public function jinbi() {  
		    $map = array();
	        if (isset($_GET['start']) && !empty($_GET['start'])) {
	        	$map['addtime'] = array("egt",strtotime($_GET['start']));			
	        }
	        if (isset($_GET['end']) && !empty($_GET['end'])) {
	        	$map['addtime'] = array("elt",strtotime($_GET['end'])); 
	        }			
			$list = M('jinbidetail')->where($map)->order('id ASC')->select();  
			import('@.ORG.PHPExcel.PHPExcel');  
		    Vendor('Excel.PHPExcel');
			Vendor('Excel.PHPExcel.Writer.Excel2007');
			// Create new PHPExcel object    
			$objPHPExcel = new PHPExcel();  
			// Set properties    
			$objPHPExcel->getProperties()->setCreator("ctos")  
					->setLastModifiedBy("ctos")  
					->setTitle("Office 2007 XLSX Test Document")  
					->setSubject("Office 2007 XLSX Test Document")  
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
					->setKeywords("office 2007 openxml php")  
					->setCategory("Test result file");  
		  
			// set width    
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);  			
			// 设置行高度    
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
		  
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		  
			// 字体和样式  
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(14);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
		  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		  
			// 设置水平居中    
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  			
		  
			//  合并  
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');  
		  
			// 表头  
			$objPHPExcel->setActiveSheetIndex(0)  
					->setCellValue('A1', '现金明细报表')  
					->setCellValue('A2', 'ID')
					->setCellValue('B2', '会员')  
					->setCellValue('C2', '现金变动')  
					->setCellValue('D2', '会员余额')  
					->setCellValue('E2', '描述')
					->setCellValue('F2', '日期');
		  
			// 内容  
			for ($i = 0, $len = count($list); $i < $len; $i++) {  
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['id']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['member']);  
                if($list[$i]['adds']>0){
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '+'.$list[$i]['adds']);  
				}else{
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '-'.$list[$i]['reduce']);  
				}				
				
				$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $list[$i]['balance']); 
                $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $list[$i]['desc']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), date("Y-m-d H:i:s",$list[$i]['addtime']));			
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':F' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':F' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
				$objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
			}  
		  
			// Rename sheet    
			$objPHPExcel->getActiveSheet()->setTitle('现金明细报表');  
		  
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet    
			$objPHPExcel->setActiveSheetIndex(0);  
		  
			// 输出  
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-Disposition: attachment;filename="现金明细报表.xls"');  
			header('Cache-Control: max-age=0');  
		  
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter->save('php://output');  
		}  		
      //现金提现
		public function tixian() {  
		    $map = array();
	        if (isset($_GET['start']) && !empty($_GET['start'])) {
	        	$map['addtime'] = array("egt",strtotime($_GET['start']));			
	        }
	        if (isset($_GET['end']) && !empty($_GET['end'])) {
	        	$map['addtime'] = array("elt",strtotime($_GET['end'])); 
	        }			
			$list = M('emoneydetail')->where($map)->order('id ASC')->select();  
			import('@.ORG.PHPExcel.PHPExcel');  
		    Vendor('Excel.PHPExcel');
			Vendor('Excel.PHPExcel.Writer.Excel2007');
			// Create new PHPExcel object    
			$objPHPExcel = new PHPExcel();  
			// Set properties    
			$objPHPExcel->getProperties()->setCreator("ctos")  
					->setLastModifiedBy("ctos")  
					->setTitle("Office 2007 XLSX Test Document")  
					->setSubject("Office 2007 XLSX Test Document")  
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
					->setKeywords("office 2007 openxml php")  
					->setCategory("Test result file");  
		  
			// set width    
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);  
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30); 			
			// 设置行高度    
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
		  
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		  
			// 字体和样式  
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(14);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
		  
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		  
			// 设置水平居中    
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
            $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 			
		  
			//  合并  
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');  
		  
			// 表头  
			$objPHPExcel->setActiveSheetIndex(0)  
					->setCellValue('A1', '提现明细报表')  
					->setCellValue('A2', 'ID')
					->setCellValue('B2', '会员')  
					->setCellValue('C2', '提现金额')  
					->setCellValue('D2', '手续费')  
					->setCellValue('E2', '实发金额')
					->setCellValue('F2', '申请时间')
					->setCellValue('G2', '处理状态');
		  
			// 内容  
			for ($i = 0, $len = count($list); $i < $len; $i++) {  
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['id']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['member']);  
                if(C("WITHDRAW_TAX_IN") == 0){
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), abs($list[$i]['amount']));  
				}else{
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), abs($list[$i]['amount'])-abs($list[$i]['charge']));  
				}				
				
				    $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $list[$i]['charge']); 
                if(C("WITHDRAW_TAX_IN") == 0){
					$objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), abs($list[$i]['amount'])-abs($list[$i]['charge']));  
				}else{
					$objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), abs($list[$i]['amount']));  
					
				}
                $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), date("Y-m-d H:i:s",$list[$i]['addtime']));
                if($list[$i]['operatetime']==0){
					$objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), '待审核');  
				}else{
					$objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), date("Y-m-d H:i:s",$list[$i]['operatetime']).'已通过');  
				}					
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':G' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':G' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
				$objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
			}  
		  
			// Rename sheet    
			$objPHPExcel->getActiveSheet()->setTitle('提现明细报表');  
		  
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet    
			$objPHPExcel->setActiveSheetIndex(0);  
		  
			// 输出  
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-Disposition: attachment;filename="提现明细报表.xls"');  
			header('Cache-Control: max-age=0');  
		  
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter->save('php://output');  
		}  	
	 		//现金数据导出EXCEL
		public function jinzhongzi() {  
		    $map = array();
	        if (isset($_GET['start']) && !empty($_GET['start'])) {
	        	$map['addtime'] = array("egt",strtotime($_GET['start']));			
	        }
	        if (isset($_GET['end']) && !empty($_GET['end'])) {
	        	$map['addtime'] = array("elt",strtotime($_GET['end'])); 
	        }			
			$list = M('jinzhongzidetail')->where($map)->order('id ASC')->select();  
			import('@.ORG.PHPExcel.PHPExcel');  
		    Vendor('Excel.PHPExcel');
			Vendor('Excel.PHPExcel.Writer.Excel2007');
			// Create new PHPExcel object    
			$objPHPExcel = new PHPExcel();  
			// Set properties    
			$objPHPExcel->getProperties()->setCreator("ctos")  
					->setLastModifiedBy("ctos")  
					->setTitle("Office 2007 XLSX Test Document")  
					->setSubject("Office 2007 XLSX Test Document")  
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
					->setKeywords("office 2007 openxml php")  
					->setCategory("Test result file");  
		  
			// set width    
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);  			
			// 设置行高度    
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
		  
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		  
			// 字体和样式  
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(14);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
		  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		  
			// 设置水平居中    
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  			
		  
			//  合并  
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');  
		  
			// 表头  
			$objPHPExcel->setActiveSheetIndex(0)  
					->setCellValue('A1', '粮票明细报表')  
					->setCellValue('A2', 'ID')
					->setCellValue('B2', '会员')  
					->setCellValue('C2', '现金变动')  
					->setCellValue('D2', '会员余额')  
					->setCellValue('E2', '描述')
					->setCellValue('F2', '日期');
		  
			// 内容  
			for ($i = 0, $len = count($list); $i < $len; $i++) {  
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['id']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['member']);  
                if($list[$i]['adds']>0){
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '+'.$list[$i]['adds']);  
				}else{
					$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '-'.$list[$i]['reduce']);  
				}				
				
				$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $list[$i]['balance']); 
                $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $list[$i]['desc']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), date("Y-m-d H:i:s",$list[$i]['addtime']));			
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':F' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':F' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
				$objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
			}  
		  
			// Rename sheet    
			$objPHPExcel->getActiveSheet()->setTitle('粮票明细报表');  
		  
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet    
			$objPHPExcel->setActiveSheetIndex(0);  
		  
			// 输出  
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-Disposition: attachment;filename="粮票明细报表.xls"');  
			header('Cache-Control: max-age=0');  
		  
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter->save('php://output');  
		}   


	 	//奖金数据导出EXCEL
		public function jiangjin() {  
		    $map = array();
			$list = M("member") ->order('id desc') -> select();
	        if (isset($_POST['start']) && $_POST['start']!='') {
	        	$map['addtime'] = array("egt",strtotime($_POST['start'])); 
	        }
	        if (isset($_POST['end']) && $_POST['end']!='') {
	        	$map['addtime'] = array("elt",strtotime($_POST['end'])); 
	        }			
			foreach($list as $k=>$v){
				//前
				
				$map['member'] = array("eq",$v['username']); 
				$map['desc']   = array("eq",'分红红包'); 
				//分红红包
				$list[$k]['y_fh'] =  M('jiangjin')->where($map)->sum('adds');
				unset($map['desc']);
				$map['desc']   = array("eq",'合伙人红包'); 
				//合伙人红包
				$list[$k]['y_hh'] =  M('jiangjin')->where($map)->sum('adds');
				unset($map['desc']);
				$map['desc']   = array("eq",'静态红包'); 				
				//静态红包
				$list[$k]['y_jt'] =  M('jiangjin')->where($map)->sum('adds');	
				unset($map['desc']);
				$list[$k]['y_count'] =  $list[$k]['y_fh'] + $list[$k]['y_hh'] + $list[$k]['y_jt'];	
				
				
				//现金
				$map['type']   = array("neq",0); 
				$list[$k]['jinbi'] =  M('jinbidetail')->where($map)->sum('adds');
				unset($map['type']);
				//粮票
				$map['type']   = array("neq",0); 
				$list[$k]['jinzhongzi'] =  M('jinzhongzidetail')->where($map)->sum('adds');
				unset($map['type']);
                //实际
              	$list[$k]['shiji'] = $list[$k]['jinbi']+$list[$k]['jinzhongzi'];
                //税费
                $list[$k]['shuifei'] = $list[$k]['y_count'] * C("SHUI1") * 0.01;
                //爱心基金 
				$list[$k]['aixinjijin'] = $list[$k]['y_count'] * C("SHUI2") * 0.01;
			}
			import('@.ORG.PHPExcel.PHPExcel');  
		    Vendor('Excel.PHPExcel');
			Vendor('Excel.PHPExcel.Writer.Excel2007');
			// Create new PHPExcel object    
			$objPHPExcel = new PHPExcel();  
			// Set properties    
			$objPHPExcel->getProperties()->setCreator("ctos")  
					->setLastModifiedBy("ctos")  
					->setTitle("Office 2007 XLSX Test Document")  
					->setSubject("Office 2007 XLSX Test Document")  
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
					->setKeywords("office 2007 openxml php")  
					->setCategory("Test result file");  
		  
			// set width    
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);  			
			// 设置行高度    
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
		  
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		  
			// 字体和样式  
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(13);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
		  
			$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		  
			// 设置水平居中    
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 			
		  
			//  合并  
			$objPHPExcel->getActiveSheet()->mergeCells('A1:L1');  
		  
			// 表头  
			$objPHPExcel->setActiveSheetIndex(0)  
					->setCellValue('A1', '奖金明细报表')  
					->setCellValue('A2', '会员编号')
					->setCellValue('B2', '姓名')  
					->setCellValue('C2', '手机号码')  
					->setCellValue('D2', '静态红包')  
					->setCellValue('E2', '合伙人红包')
					->setCellValue('F2', '分红红包')
					->setCellValue('G2', '合计')
					->setCellValue('H2', '税费')  
					->setCellValue('I2', '爱心基金')  
					->setCellValue('J2', '实际金额')  
					->setCellValue('K2', '现金')
					->setCellValue('L2', '粮票');					
		  
			// 内容  
			for ($i = 0, $len = count($list); $i < $len; $i++) {  
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['username']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['truename']);  
                $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $list[$i]['mobile']);  
                if(empty($list[$i]['y_jt'])){
					$list[$i]['y_jt']=0;
				}				
				$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $list[$i]['y_jt']); 
                if(empty($list[$i]['y_hh'])){
					$list[$i]['y_hh']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $list[$i]['y_hh']);
                if(empty($list[$i]['y_fh'])){
					$list[$i]['y_fh']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $list[$i]['y_fh']);	
                if(empty($list[$i]['y_count'])){
					$list[$i]['y_count']=0;
				}				
				$objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $list[$i]['y_count']);
                if(empty($list[$i]['shuifei'])){
					$list[$i]['shuifei']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $list[$i]['shuifei']);  
                if(empty($list[$i]['aixinjijin'])){
					$list[$i]['aixinjijin']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $list[$i]['aixinjijin']);  
                if(empty($list[$i]['shiji'])){
					$list[$i]['shiji']=0;
				}				
				$objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), $list[$i]['shiji']); 
                if(empty($list[$i]['jinbi'])){
					$list[$i]['jinbi']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('K' . ($i + 3), $list[$i]['jinbi']);
                if(empty($list[$i]['jinzhongzi'])){
					$list[$i]['jinzhongzi']=0;
				}				
                $objPHPExcel->getActiveSheet(0)->setCellValue('L' . ($i + 3), $list[$i]['jinzhongzi']);					
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':L' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':L' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
				$objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
			}  
		  
			// Rename sheet    
			$objPHPExcel->getActiveSheet()->setTitle('奖金明细报表');  
		  
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet    
			$objPHPExcel->setActiveSheetIndex(0);  
		  
			// 输出  
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-Disposition: attachment;filename="奖金明细报表.xls"');  
			header('Cache-Control: max-age=0');  
		  
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter->save('php://output');  
		} 

	 	//会员数据导出EXCEL
		public function member() {  
		    $map = array();
			$list = M("member") ->where(array("status"=>1))->order('id desc') -> select();			
			import('@.ORG.PHPExcel.PHPExcel');  
		    Vendor('Excel.PHPExcel');
			Vendor('Excel.PHPExcel.Writer.Excel2007');
			// Create new PHPExcel object    
			$objPHPExcel = new PHPExcel();  
			// Set properties    
			$objPHPExcel->getProperties()->setCreator("ctos")  
					->setLastModifiedBy("ctos")  
					->setTitle("Office 2007 XLSX Test Document")  
					->setSubject("Office 2007 XLSX Test Document")  
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
					->setKeywords("office 2007 openxml php")  
					->setCategory("Test result file");  
		  
			// set width    
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);  
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20); 			
			// 设置行高度    
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
		  
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		  
			// 字体和样式  
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(13);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFont()->setBold(true);  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
		  
			$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		  
			// 设置水平居中    
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 			
			$objPHPExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
			$objPHPExcel->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 		  
			//  合并  
			$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');  
		  
			// 表头  
			$objPHPExcel->setActiveSheetIndex(0)  
					->setCellValue('A1', '会员信息表')  
					->setCellValue('A2', '会员编号')
					->setCellValue('B2', '手机号码')  
					->setCellValue('C2', '昵称')  
					->setCellValue('D2', '安置层')  
					->setCellValue('E2', '安置会员')
					->setCellValue('F2', '左区业绩')
					->setCellValue('G2', '右区业绩')
					->setCellValue('H2', '推荐会员')  
					->setCellValue('I2', '推荐人数')  
					->setCellValue('J2', '注册时间')  
					->setCellValue('K2', '审核时间')
					->setCellValue('L2', '现金')
					->setCellValue('M2', '粮票')
					->setCellValue('N2', '分红累计');					
		  
			// 内容  
			for ($i = 0, $len = count($list); $i < $len; $i++) {  
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['username']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['mobile']);  
                $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $list[$i]['nickname']);  				
				$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $list[$i]['manage_ceng'].'层'); 
                if($list[$i]['my_jd'] == 'left'){
					$list[$i]['weizhi']=$list[$i]['fparent'].'(左区)';
				}elseif($list[$i]['my_jd'] == 'right'){
					$list[$i]['weizhi']=$list[$i]['fparent'].'(右区)';
				}else{
					$list[$i]['weizhi']='';
				}
                $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $list[$i]['weizhi']); 				
                $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $list[$i]['leftpro'].'('.$list[$i]['leftnum'].')人');			
                $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $list[$i]['rightpro'].'('.$list[$i]['rightnum'].')人');				
				$objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $list[$i]['parent']);				
                $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $list[$i]['parentcount']);  			 				
				$objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), date("Y-m-d H:i",$list[$i]['regdate'])); 			
                $objPHPExcel->getActiveSheet(0)->setCellValue('K' . ($i + 3), date("Y-m-d H:i",$list[$i]['checkdate']));			
                $objPHPExcel->getActiveSheet(0)->setCellValue('L' . ($i + 3), $list[$i]['jinbi']);
				$objPHPExcel->getActiveSheet(0)->setCellValue('M' . ($i + 3), $list[$i]['jinzhongzi']);
				$objPHPExcel->getActiveSheet(0)->setCellValue('N' . ($i + 3), $list[$i]['fhsum']);				
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':N' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
				$objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':N' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
				$objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
			}  
		  
			// Rename sheet    
			$objPHPExcel->getActiveSheet()->setTitle('会员信息表');  
		  
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet    
			$objPHPExcel->setActiveSheetIndex(0);  
		  
			// 输出  
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-Disposition: attachment;filename="会员信息表.xls"');  
			header('Cache-Control: max-age=0');  
		  
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter->save('php://output');  
		}   		
	}

?>
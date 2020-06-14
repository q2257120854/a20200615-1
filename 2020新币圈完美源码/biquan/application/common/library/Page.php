<?php
namespace app\common\library;

class page{
    // 起始行数
    public $firstRow	;
    // 列表每页显示行数
    public $listRows	;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页总页面数
    public $totalPages  ;
    // 总行数
    public $totalRows  ;
    // 当前页数
    public $nowPage    ;
    // 分页的栏的总页数
    public $coolPages   ;
    // 分页栏每页显示的页数
    public $rollPage   ;
	// 分页url定制
	public $urlrule;
 

    /*
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     +----------------------------------------------------------
     */
    public function __construct($totalRows,$listRows,$p='') {
        $this->totalRows = $totalRows;
        $this->parameter = '';
        $this->rollPage = 2;
        $this->listRows = !empty($listRows)?$listRows:15;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
		if($p){
			$this->nowPage =$p;
			}else{
			$this->nowPage  = !empty($_GET['p'])?intval($_GET['p']):1;
		}
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }
 
	public function  show(){

		if($this->totalRows == 0 OR $this->listRows == 0 OR $this->totalPages <= 1){
			return '';
		}
		$urlrule =  str_replace('%7B%24page%7D','{$page}',$this->urlrule);  

		if(!$urlrule){		
			$p = 'p';			
			$nowCoolPage      = ceil($this->nowPage/$this->rollPage);
			$url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
			$parse = parse_url($url);
			 
			$urlrule = $urlrule."?".$p.'={$page}';
		}
		$pre_page = $this->nowPage-1;
		$next_page = $this->nowPage +1;
		if($this->nowPage >=$this->totalPages){
			$next_page =  $this->nowPage = $this->totalPages;
		}
		if($this->nowPage <= 1){
			$pre_page =  $this->nowPage = 1;
		}

		$output = '';
		$output .= '<li><a class="a1">总记录数'.$this->totalRows.'</a></li>';
		$output .= '<li><a href="'.$this->pageurl($urlrule, 1,$this->parameter).'" id="first_page">首页</a></li>';
		$output .= '<li><a href="'.$this->pageurl($urlrule, $pre_page,$this->parameter).'" id="previous">上一页</a></li>';
		$show_nums = $this->rollPage*2+1;// 显示页码的个数
	
		if($this->totalPages <= $show_nums){
			for($i = 1;$i<=$this->totalPages;$i++){
				if($i == $this->nowPage){
					$output .= '<li style="background-color: #03A9F4;color: #fff;"><a id="page_now" href="'.$this->pageurl($urlrule,$this->nowPage,$this->parameter).'">'.$i.'</a></li>';
				}else{
					$output .= '<li><a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a></li>';
				}
			}
		}else{
			if($this->nowPage < (1+$this->rollPage)){
				for($i = 1;$i<=$show_nums;$i++){
					if($i == $this->nowPage){
						$output .=  '<li><a id="page_now" href="'.$this->pageurl($urlrule,$this->nowPage,$this->parameter).'">'.$i.'</a></li>';
					}else{
						$output .= '<li><a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a></li>';
					}
				}			
			}else if($this->nowPage >= ($this->totalPages - $this->rollPage)){
				for($i = $this->totalPages - $show_nums ; $i <= $this->totalPages ; $i++){
					if($i == $this->nowPage){
						$output .=  '<li><a id="page_now" href="'.$this->pageurl($urlrule,$this->nowPage,$this->parameter).'">'.$i.'</a></li>';
					}else{
						$output .= '<li><a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a></li>';
					}
				}
			}else{
				$start_page = $this->nowPage - $this->rollPage;
				$end_page = $this->nowPage + $this->rollPage;
				for($i = $start_page ; $i<=$end_page ; $i++){
					if($i == $this->nowPage){
						$output .=  '<li><a id="page_now" href="'.$this->pageurl($urlrule,$this->nowPage,$this->parameter).'">'.$i.'</a></li>';
					}else{
						$output .= '<li><a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a></li>';
					}
				}
			}
		}
		
		$output .='<li><a id="next" data-page="'.$next_page.'" href="'.$this->pageurl($urlrule,$next_page,$this->parameter).'">下一页</a></li>'; 
		$output .='<li><a id="Last_page" href="'.$this->pageurl($urlrule,$this->totalPages,$this->parameter).'">尾页</a></li>';
		return $output;
	}

	public function pageurl($urlrule, $page, $array = array())
	{
		@extract($array, EXTR_SKIP);

		if(is_array($urlrule))
		{
			//$urlrules = explode('|', $urlrule);
			$urlrule = $page < 2 ? $urlrule[0] : $urlrule[1];
		}
		
		$url = str_replace('{$page}', $page, $urlrule);
		return $url;
	}

}
?>
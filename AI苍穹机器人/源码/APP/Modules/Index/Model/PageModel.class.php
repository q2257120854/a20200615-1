<?php
    /**
    *   file: page.class.php 
    *   完美分页类 Page 
    */
class PageModel extends Model{
    private $total;                         //数据表中总记录数
    private $listRows;                      //每页显示行数
    private $limit;                         //SQL语句使用limit从句,限制获取记录个数
    private $uri;                           //自动获取url的请求地址
    private $pageNum;                       //总页数
    private $page;                          //当前页   
    private $config = array(
                        'head' => "条记录", 
                        'prev' => "上一页", 
                        'next' => "下一页", 
                        'first'=> "首页", 
                        'last' => "末页"
                    );                      //在分页信息中显示内容，可以自己通过set()方法设置
    private $listNum = 10;                  //默认分页列表显示的个数

    /**
    *   构造方法，可以设置分页类的属性
    *   @param  int $total      计算分页的总记录数
    *   @param  int $listRows   可选的，设置每页需要显示的记录数，默认为25条
    *   @param  mixed   $query  可选的，为向目标页面传递参数,可以是数组，也可以是查询字符串格式
    *   @param  bool    $ord    可选的，默认值为true, 页面从第一页开始显示，false则为最后一页
    */
    public function __construct($total, $listRows=40, $query="", $ord=true){
        $this->total = $total;
        $this->listRows = $listRows;
        $this->uri = $this->getUri($query);
        $this->pageNum = ceil($this->total / $this->listRows);
        /*以下判断用来设置当前面*/
        if(!empty($_GET["page"])) {
            $page = $_GET["page"]>$this->pageNum?$this->pageNum:$_GET["page"];
        }else{
            if($ord)
                $page = 1;
            else
                $page = $this->pageNum;
        }

        if($total > 0) {
            if(preg_match('/\D/', $page) ){
                $this->page = 1;
            }else{
                $this->page = $page;
            }
        }else{
            $this->page = 0;
        }
        
        $this->limit = "LIMIT ".$this->setLimit();
    }

    /**
    *   用于设置显示分页的信息，可以进行连贯操作
    *   @param  string  $param  是成员属性数组config的下标
    *   @param  string  $value  用于设置config下标对应的元素值
    *   @return object          返回本对象自己$this， 用于连惯操作
    */
    function set($param, $value){
        if(array_key_exists($param, $this->config)){
            $this->config[$param] = $value;
        }
        return $this;
    }
    
    /* 不是直接去调用，通过该方法，可以使用在对象外部直接获取私有成员属性limit和page的值 */
    function __get($args){
        if($args == "limit" || $args == "page")
            return $this->$args;
        else
            return null;
    }
    
    /**
    *    按指定的格式输出分页
    *    @param  int 0-7的数字分别作为参数，用于自定义输出分页结构和调整结构的顺序，默认输出全部结构
    *    @return string  分页信息内容
    */
    function fpage(){
        $arr = func_get_args();
        $html[0] = $this->firstprev();
        $html[1] = $this->pageList();
        $html[2] = $this->nextlast();
        $html[3] = $this->goPage();

        $fpage = '<div class="mod_page" id="pageBarBottom">';
        if(count($arr) < 1)
            $arr = array(0, 1,2,3);
            
        for($i = 0; $i < count($arr); $i++)
            $fpage .= $html[$arr[$i]];
    
        $fpage .= '</div>';
        return $fpage;
    }
    
    /* 在对象内部使用的私有方法，*/
    private function setLimit(){
        if($this->page > 0)
            return ($this->page-1)*$this->listRows.", {$this->listRows}";
        else
            return 0;
    }

    /* 在对象内部使用的私有方法，用于自动获取访问的当前URL */
    private function getUri($query){    
        $request_uri = $_SERVER["REQUEST_URI"]; 
        $url = strstr($request_uri,'?') ? $request_uri :  $request_uri.'?';
        
        if(is_array($query))
            $url .= http_build_query($query);
        else if($query != "")
            $url .= "&".trim($query, "?&");
    
        $arr = parse_url($url);

        if(isset($arr["query"])){
            parse_str($arr["query"], $arrs);
            unset($arrs["page"]);
            $url = $arr["path"].'?'.http_build_query($arrs);
        }
        
        if(strstr($url, '?')) {
            if(substr($url, -1)!='?')
                $url = $url.'&';
        }else{
            $url = $url.'?';
        }
        
        return $url;
    }

    /* 在对象内部使用的私有方法，用于获取当前页开始的记录数 */
    private function start(){
        if($this->total == 0)
            return 0;
        else
            return ($this->page-1) * $this->listRows+1;
    }

    /* 在对象内部使用的私有方法，用于获取当前页结束的记录数 */
    private function end(){
        return min($this->page * $this->listRows, $this->total);
    }

    /* 在对象内部使用的私有方法，用于获取上一页和首页的操作信息 */
    private function firstprev(){
        if($this->page > 1) {
            $str = "<a href='javascript:' class='mod_page_lk' pages='".($this->page - 1)."'>{$this->config['prev']}</a>";
            if ($this->page > 6) {
                $str .= "<a href='javascript:' class='mod_page_lk' pages='1'>1</a>";
            }
            if ($this->page > 7) {
                $str .= "<span class='mod_page_etc'>...</span>";
            }            
            return $str;
        }
    }

    /* 在对象内部使用的私有方法，用于获取页数列表信息 */
    private function pageList(){
        $linkPage = "&nbsp;<b>";
        
        $inum = floor($this->listNum/2);
        /*当前页前面的列表 */
        for($i = $inum; $i >= 1; $i--){
            $page = $this->page-$i;

            if($page >= 1)
                $linkPage .= "<a href='javascript:' class='mod_page_lk' pages='{$page}'>{$page}</a>&nbsp;";
        }
        /*当前页的信息 */
        if($this->pageNum > 1)
            $linkPage .= "<span class='mod_page_on'>{$this->page}</span>";
        
        /*当前页后面的列表 */
        for($i=1; $i <= $inum; $i++){
            $page = $this->page+$i;
            if($page <= $this->pageNum)
                $linkPage .= "<a href='javascript:' class='mod_page_lk' pages='{$page}'>{$page}</a>";
            else
                break;
        }
        $linkPage .= '</b>';
        return $linkPage;
    }

    /* 在对象内部使用的私有方法，获取下一页和尾页的操作信息 */
    private function nextlast(){
        if($this->page != $this->pageNum) {
            if ($this->pageNum - $this->page > 6) {
                $str = "<span class='mod_page_etc'>...</span>";
            }
            if ($this->pageNum - $this->page > 5) {
                $str .= "<a href='javascript:' class='mod_page_lk' pages='{$this->pageNum}'>{$this->pageNum}</a>";
            }
            $str .= "<a href='javascript:' class='mod_page_lk' pages='".($this->page + 1)."' >{$this->config['next']}</a>";            
            return $str;
        }
    }

    /* 在对象内部使用的私有方法，用于显示和处理表单跳转页面 */
    private function goPage(){
            if($this->pageNum > 1) {
            return '<span class="mod_page_turn">共'.$this->total.'页，到第<input id="pageinput" name="inputItem" pagetag="input" value="'.$this->page.'" type="text">页</span><button pagetag="jumper" value="go" class="mod_page_go">确定</button></span>';
        }
    }

    /* 在对象内部使用的私有方法，用于获取本页显示的记录条数 */
    private function disnum(){
        if($this->total > 0){
            return $this->end()-$this->start()+1;
        }else{
            return 0;
        }
    }
}

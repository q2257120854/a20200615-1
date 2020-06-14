<?php
    class GoodsSearchModel extends Model{
        private $cid;
        private $bid;
        private $attr;
        private $sort;
        private $price;
        private $stockfilter;
        private $searchval;
        private $sql;

        public function __set($name,$value){
            $this -> $name = $value;
        }

        /**
        *查询商品列表
        *@return $result  array  返回数组
        */
        public function select(){
            $g = M();
            if (isset($this->limit) && $this->limit) {
                $limits = " {$this->limit}";
            }
            $result =  $g -> query($this->defaultSQl().$this->where().$limits);
            $result = $this -> attrSolve($result);
            return $result;
        }

        /**
        *统计商品数量
        *@return count($res)  int 商品总数
        */
        public function count(){
            $c = M();
            $count = $c -> query("SELECT gattribute attr FROM sx_goods {$this -> where()}");
            $res = $this -> attrSolve($count);
            return count($res);
        }

        public function where(){
            if (isset($this->bid) && $this->bid) {
                 $where[] = "bid = {$this->bid}";
            }

            if (isset($this->cid) && $this->cid) {
                $c = D('ClassView');
                $curr = $c -> findClass($this->cid);
                $where[] = "gclassification IN (SELECT cid FROM `sx_classify` WHERE `cpath` LIKE '{$curr['bpath']}%' OR cid = {$this->cid})";
            }

            if (isset($this->price) && $this->price) {
                $pricearr = explode('-', $this -> price);
                if ($pricearr[1] == '+') {
                    $where[] = "goldprice >= {$pricearr[0]}";
                }else{
                    $where[] = "goldprice BETWEEN {$pricearr[0]} AND {$pricearr[1]}";
                }            
            }

            if (isset($this->stockfilter) && $this->stockfilter) {
                $where[] = "(goodnums - gsellnums) > 0";
            }

            if (isset($this->searchval) && $this->searchval) {
                $where[] = "gname like '%{$this -> searchval}%'";
            }
            $where[] = "issale = 1";

            switch ($this -> sort) {
                case '1':
                    $goodssort = "ORDER BY gsellnums DESC";
                    break;
                
                case '2':
                    $goodssort = "ORDER BY gsellnums DESC";
                    break;

                case '3':
                    $goodssort = "ORDER BY gprice ASC";
                    break;
                
                case '4':
                    $goodssort = "ORDER BY gprice DESC";
                    break;
                
                default:
                    $goodssort = "ORDER BY gid ASC";
                    break;
            }

            $wheres = 'WHERE '.implode(' AND ',$where).' '.$goodssort;
            return $wheres;
        }  

        private function attrSolve($arr){
            if (!isset($this->attr) || !$this->attr) {
                return $arr;
            }

            $attrs = explode('-', $this->attr);
            foreach ($attrs as $v) {
                if ($v) {
                    $newattr[] = $v;
                }
            }
            foreach ($arr as $key => $value) {
                $goodsattr = explode(',', $value['attr']);
                foreach ($newattr as $vo) {
                    if (!in_array($vo, $goodsattr)) {
                        unset($arr[$key]);
                    }
                }
            }
            return $arr;
        }

        private function defaultSQl(){
            return "SELECT gid,gclassification cid,gname,gpic,goldprice,gsellnums,gattribute attr FROM sx_goods ";
        }
    }
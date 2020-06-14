<?php
    class ClassViewModel extends Model{
        /**
        *查询指定当前分类信息
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function findClass($cid){
            $c = M("classify");
            $map['cid'] = $cid;
            return $class = $c -> field("cid,cname,concat(cpath,'-',cid) as bpath") -> find($map['cid']);
        }

    	/**
        *查询指定当前分类的子分类
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
    	public function childClass($cid){
    		$c = M("classify");
            $map['parentid'] = array('eq',$cid);
            return $class = $c -> where($map) -> field("cid,cname,concat(cpath,'-',cid) as bpath") -> order('cid asc') -> select();
    	}

        /**
        *查询指定当前分类的所有子分类
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function allChild($cid){
            $curr = $this -> findClass($cid);
            $c = M("classify");
            $path['cpath'] = array("like","{$curr['bpath']}%");
            return $child = $c -> where($path) -> field("cid,cname,concat(cpath,'-',cid) as bpath") -> order('bpath asc') ->select();
        }

        /**
        *查询指定当前分类的所有父级分类
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function allParent($cid){
            $curr = $this->findClass($cid);
            $path = explode('-', $curr['bpath']);
            foreach ($path as $value) {
                if ($value != 0) {
                    $parent[] =  $this->findClass($value);
                }            
            }
            return $parent;
        }

        /**
        *查询指定当前分类下得所有末级分类
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function childEnd($cid){
            $c = M("classify");
            $curr = $this -> allChild($cid);
            foreach ($curr as $k => $v) {
                $bottom['cpath'] = array('like',"%{$v['bpath']}");
                if (!$c->where($bottom)->select()) {
                     $class[] = $v;
                }
            }
            return $class;
        }

        /**
        *查询指定当前分类含有的品牌
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function classBrand($cid){
            $c = D('BrandClassView');
            return $c -> where("cid = $cid") -> order("brandpic desc") -> select();
        }

        /**
        *查询指定当前分类下得所有品牌,包括子分类所含有的
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function childBrand($cid){
            $c = M("classify");
            $class = $this -> allChild($cid);
            $class['curr'] = $this -> findClass($cid);
            foreach ($class as  $value) {
                $brand = $this -> classBrand($value['cid']);
                foreach ($brand as $value) {
                    $brands[] = $value;
                }
            }
            return arr_unique($brands);
        }
    }
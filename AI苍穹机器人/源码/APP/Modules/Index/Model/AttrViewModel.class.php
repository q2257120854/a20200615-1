<?php
    /**
    *分类属性查询类
    */
    class AttrViewModel extends Model{
        /**
        *查询指定分类得所有属性包括父级含有的属性
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function allAttr($cid){
            $c = D('ClassView');
            $a = M('attribute');
            $g = M('goodstoattr');
            $class = $c -> allParent($cid);
            foreach ($class as $value) {
                $map['cid'] = array('eq',$value['cid']);
                $res = $a -> where($map) -> order("attrsort asc") ->select();
                foreach ($res as $v) {
                    $maps['attrid'] = array('eq',$v['attrid']);
                    $attr = $g -> where($maps) -> order('id') -> select();
                    $attrs[$v['attrid']]['value'] = $attr;
                    $attrs[$v['attrid']]['attrname'] = $v['attrname'];
                    $attrs[$v['attrid']]['attrid'] = $v['attrid'];
                }
            }
            return $attrs;
        }

        /**
        *查询指定分类所含有的属性
        *@param $cid     int    指定分类的id号
        *@return $attrs  array  返回数组
        */
        public function findAttr($attr){
            $arr = explode('-', $attr);
            $attrs = join(',',$arr);
            $a = M();
            $res = $a -> table('sx_goodstoattr g,sx_attribute a') 
                      -> where("g.id in({$attrs}) AND g.attrid = a.attrid") 
                      -> field('id,attrvalue,attrname')
                      -> select();
            return $res;
        }
    }
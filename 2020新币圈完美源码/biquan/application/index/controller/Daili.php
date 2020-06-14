<?php



namespace app\index\controller;
use app\common\controller\Frontend;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;
use think\Db;
use app\common\library\Page;
//use app\common\library\Daili;
/**

 * 会员中心

 */

class Daili extends Frontend

{



    protected $layout = 'default';

    protected $noNeedLogin = [];

    protected $noNeedRight = ['*'];



    public function _initialize()

    {

      parent::_initialize();
      $this->view->assign('title','');
      $this->todaystr=strtotime(date('Ymd'));
      if ($this->view->user['level']!=13) {
        echo "ID:".$this->view->user['id']."你不是授权代理13";exit;
      }
    }
    /**

     * 会员中心

     */

    public function index()

    {

        

        return $this->view->fetch();

    }
public function son($uid=0,$today=0,$return=0)

    {
      $uid=$uid==0?$this->auth->id:$uid;
      $daili=new \app\common\library\Daili('','');//
       $dailis=$daili->mydaili($uid);
       $ids='';
       $ids.=$dailis['onefatherids']?$dailis['onefatherids']:'';
       $ids.=$dailis['twofatherids']?','.$dailis['twofatherids']:'';
       $ids.=$dailis['thrfatherids']?','.$dailis['thrfatherids']:'';
       $ids.=$dailis['forfatherids']?','.$dailis['forfatherids']:'';
       $ids.=$dailis['fivfatherids']?','.$dailis['fivfatherids']:'';
       $ids.=$dailis['sixfatherids']?','.$dailis['sixfatherids']:'';
       $ids.=$dailis['sevfatherids']?','.$dailis['sevfatherids']:'';
       $ids.=$dailis['eigfatherids']?','.$dailis['eigfatherids']:'';
       $ids.=$dailis['nigfatherids']?','.$dailis['nigfatherids']:'';
       $ids.=$dailis['tenfatherids']?','.$dailis['tenfatherids']:'';
       $ids.=$dailis['elefatherids']?','.$dailis['elefatherids']:'';
       $ids.=$dailis['twefatherids']?','.$dailis['twefatherids']:'';
       $ids.=$dailis['thifatherids']?','.$dailis['thifatherids']:'';
       $ids.=$dailis['foufatherids']?','.$dailis['foufatherids']:'';
       $ids.=$dailis['twefatherids']?','.$dailis['twefatherids']:'';
      // echo $ids;exit;
      
      $this->assign('uid',$uid);
      $this->assign('today',$today);
       $p = $this->request->param('p') ? $this->request->param('p') : 1;
        $this->view->assign('title', '我的下级');
       //$where['onecount|twocount|thrcount|forcount|fivcount|sixcount|sevcount|eigcount|nigcount|tencount|elecount|twecount|thicount|foucount|fifcount'] = $uid;

       $where['uid']=array('in',$ids);
        $count = Db::name('user_relation')->where($where)->count();

        if ($return) {
           $page = new Page($count, $count, $p);
        }else{
           $page = new Page($count, 20, $p);
            $page->parameter='uid='.$uid;
            if ($today>0) {
              $page->parameter.="&today=1";
            }
        }
        
        $list = Db::name('user_relation')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id desc')->select();
        //print_r($list);exit;
        $dat = '';
$map['sum_allin']=0;//Db::name('user_relation')->where($where)->sum('allin');;
$map['sum_allout']=0;//Db::name('user_relation')->where($where)->sum('allout');
$map['sum_tixian']=0;//Db::name('user_relation')->where($where)->sum('tixian');
$map['sum_chonzhi']=0;//Db::name('user_relation')->where($where)->sum('chonzhi');

        if ($list) {
$lever_name=array("onecount","twocount","thrcount","forcount","fivcount","sixcount","sevcount","eigcount","nigcount","tencount","elecount","twecount","thicount","foucount","fifcount");
$yonjin_name=array("onepoint","twopoint","thrpoint","forpoint","fivpoint","sixpoint","sevpoint","eigpoint","nigpoint","tenpoint","elepoint","twepoint","thipoint","foupoint","fifpoint");
$map=array();
$map['sum_allin']=Db::name('user_relation')->where($where)->sum('allin');;
$map['sum_allout']=Db::name('user_relation')->where($where)->sum('allout');
$map['sum_tixian']=Db::name('user_relation')->where($where)->sum('tixian');
$map['sum_chonzhi']=Db::name('user_relation')->where($where)->sum('chonzhi');

            foreach ($list as $key => $value) {
               $user=Db::name('user')->field('username,nickname,createtime,id,point,status')->where('id='.$value['uid'])->find();
                  $dat[$key] = $user;
                  $dat[$key]['allin'] =$value['allin'];
                  $dat[$key]['allout'] =$value['allout'];
                  $dat[$key]['tixian'] =$value['tixian'];
                  $dat[$key]['chonzhi'] =$value['chonzhi'];
                //循环找出级别
                $dat[$key]['son_point']=0;
                $dat[$key]['son_lever']=0;
                foreach ($lever_name as $kk => $vv) {
                    if ($value[$vv]==$uid) {
                      $dat[$key]['son_lever']=$kk+1;
                      $dat[$key]['son_point']=$this->view->site[$yonjin_name[$kk]];
                      $dat[$key]['lever_name']=$yonjin_name[$kk];
                    }
                 } 
                $dat[$key]['createtime'] = date('Y/m/d', $user['createtime']);
                $dat[$key]['username'] = mb_substr($user['username'],0,5);
                $dat[$key]['nickname'] = mb_substr($user['nickname'],0,5);
                //基本数据统计
                if ($today>0) {
                   $cwhere['createtime']=array('egt',$this->todaystr,($this->todaystr+868400));
                   $cwhere['createtime']=array('elt',($this->todaystr+868400));
                }
            
                 $dat[$key]['liu_award'] =($dat[$key]['allin']*$dat[$key]['son_point'])/100;

                
                $xwhere['onecount|twocount|thrcount|forcount|fivcount|sixcount|sevcount|eigcount|nigcount|tencount|elecount|twecount|thicount|foucount|fifcount'] =$user['id'];
                 $dat[$key]['all_son'] =Db::name('user_relation')->where($xwhere)->count();
                $dat[$key]['son'] =Db::name('user')->where('fatherid='.$user['id'])->count();

            }
        }
        
        if ($return) {
          $map['dat']=$dat;
          $map['page']=$page->show();
           return $map;
        }else{
         //$dat['map']=$map;
          $this->assign('map', $map);
          $this->assign('list', $dat);
          //print_r($dat);exit;
          $this->assign('page', $page->show());
          return $this->view->fetch('../application/index/view/user/'.$this->request->action().'.html');
        }
        

    }
public function fixdata($uid=0){
     $where['updatetime']=array('lt',(time()));
     $userlist=Db::name('user')->field('id')->where($where)->select();
     foreach ($userlist as $key => $value) {
       $daili=new \app\common\library\Daili('','');//
       $daili->relation($value['id']);
       echo "\n<br/>".$value['id'];
     }

}
 public function day($uid=0)
    {
       $uid=$uid>0?$uid:$this->auth->id;
       $where['uid'] = $uid;
       $list = Db::name('user_count')->where($where)->order('id desc')->select();
 
       foreach ($list as $key => $value) {
          $map[$key]=$value;
          $map[$key]['allin']=$value['allin']/100;
          $map[$key]['allout']=$value['allout']/100;
          $map[$key]['wup']=$value['wup']/100;
          $map[$key]['wdown']=$value['wdown']/100;


$map[$key]['point']=Db::name('user')->where('id='.$value['uid'])->value('point');
       }
 
        $this->assign('list',$map);
        return $this->view->fetch('../application/index/view/user/'.$this->request->action().'.html');

    }

 public function count($uid=0)
    {
      $uid=$uid>0?$uid:$this->auth->id;
       $where['onecount|twocount|thrcount|forcount|fivcount|sixcount|sevcount|eigcount|nigcount|tencount|elecount|twecount|thicount|foucount|fifcount'] = $uid;
       $list = Db::name('user_relation')->where($where)->order('id desc')->select();
        $map['sum_allin']=0;//$value['allin'];
        $map['sum_allout']=0;//$value['allout'];
        $map['sum_liuin']=0;//$value['liuin'];
        $map['sum_peifu']=0;//$value['liuin'];
        $map['sum_chonzhi']=0;
        $map['sum_point']=0;
        $map['sum_tixian']=0;
        $map['liuin_award']=0;

       foreach ($list as $key => $value) {
        if ($this->request->param('today')==1) {
          $wherex['uid']=$value['uid'];
          $wherex['createtime']=$this->todaystr;
          $user_count=Db::name('user_count')->cache(600)->field('allin,allout,wup,wdown')->where($wherex)->find();
          $map['sum_allin']+=$user_count['allin']/100;
          $map['sum_allout']+=$user_count['allout']/100;
          $map['sum_liuin']+=$value['liuin'];
          $map['sum_tixian']+=$user_count['wdown']/100;
          $map['sum_chonzhi']+=$user_count['wup']/100;
          $map['sum_point']+=Db::name('user')->where('id='.$value['uid'])->value('point');
        }else{
          $map['sum_allin']+=$value['allin'];
          $map['sum_allout']+=$value['allout'];
          $map['sum_liuin']+=$value['liuin'];
          $map['sum_tixian']+=$value['tixian'];
          $map['sum_chonzhi']+=$value['chonzhi'];
          $map['sum_point']+=Db::name('user')->where('id='.$value['uid'])->value('point');
        }
          
       }
       $daili=new \app\common\library\Daili('','');//
       
       $fatherid=$daili->myfaher($uid);
       $this->assign('fatherid',$fatherid);
        $this->assign('dat',$map);
        return $this->view->fetch('../application/index/view/user/'.$this->request->action().'.html');

    }
    public function _empty()

    {
        return $this->view->fetch('../application/index/view/user/'.$this->request->action().'.html');

    }
 

}


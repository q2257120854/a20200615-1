<?php

namespace app\admin\controller\game;

use app\common\controller\Backend;
use app\common\library\Wxpay;
use think\Db;

/**
 * 充值历史
 *
 * @icon fa fa-circle-o
 */
class Tixian extends Backend
{
    
    /**
     * Tixian模型对象rpint
     * @var \app\admin\model\game\Tixian
     */
    protected $model = null;
    protected $noNeedRight = ['start', 'pause', 'change', 'detail', 'cxselect', 'searchlist' ,'index'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\game\Tixian;

    }

    //1.1接收赔付
  private  function paytouser($tid){
    return false;
    $rr=0;
    $Config=$this->view->site;
    //print_r($Config);exit;
    //echo $Config['cert_pem'];exit;
      $tdata=db::name('user_tixian')->where('id='.$tid)->find();

      $openid=db::name('user')->where('id='.$tdata['uid'])->value('openid');
      $fee=$tdata['point'];
      $Config['appid']=$this->view->site['appid'];
      $Config['appsecret']=$this->view->site['appsecret'];
      $Config['paykey']=$this->view->site['paykey'];
      $Config['mchid']=$this->view->site['mchid'];
      $pay=new Wxpay($Config);
   
      $fee=abs($fee);
      $successpay=0;
      $back['msg']='';
      //费用和用户不可为０
      if($fee<=0 || empty($openid)){
        $back['msg']="op:".$openid." fee:".intval($fee);
        $back['status']=0;
      }else{
           //在线自动赔付
              
              //$wcmap['paykey']=" ";
              $paymap=$this->view->site;
              //调用支付--begin
              $data['openid']=$openid;
              $data['check']='NO_CHECK';//FORCE_CHECK,OPTION_CHECK
              $data['re_user_name']=$tdata['uid'];
              $data['amount']=$fee*100;//不得低于1元
              $data['trade_no']=md5(time());
              $data['desc']="payonline";
              $data['ip']=request()->ip();
              Db::startTrans();
              try
              {

                $r=$pay->paytouser($data);

                
              //调用赔付接口 -end
              if($r['result_code']=='SUCCESS'){
                //体现记录
                $datatixian=array();

                $datatixian['status']=1; 
                $datatixian['note']='已补'; 
                $datatixian['paymentno']= $r['payment_no'];

                $txid=Db::name('user_tixian')->where('id='.$tid)->update($datatixian);

                $rr= Db::name('user')->where("id=".$tdata['uid'])->setDec('point',abs($fee));

                //制作秘钥
                unset($paramater);
                $orderid=$tdata['uid'].time();
                $paramater['orderid']=$orderid;
                $paramater['out_trade_no']= $r['partner_trade_no'];
                $paramater['payment_no']= $r['payment_no'];
                $bsign='muse';
                
                $pwhere['uid']=$tdata['uid'];
                $pwhere['createtime']=strtotime(date('Ymd'));
                Db::name('user_count')->where($pwhere)->setInc('onlinetixiantime');
                //记录赔付反馈
                $successpay=1;
                $back['msg']='取款ok';
              }else{
                //print_r($r);
                $back['status']=0;
                $back['msg'].= (request()->ip())."-(".$r['return_msg'].','.$r['err_code_des'].")";

                
                
                $successpay=-1; 
              } 
                 
                 if ($rr) {
                   Db::commit();
                   $data['openid']=$openid;
                 } else {
                   Db::rollback();
                   $data['openid']='xx';
                 }
              }
              catch (Exception $e)
              {
                  $this->setError($e->getMessage());
                  Db::rollback();
                 // return FALSE;
              }
              
        
      }
     $back['successpay']=$successpay;
    //1005 ajax 付款通道
return $back;
  }



    public function repay()
    {
        $ids=$this->request->param('ids');
 
        $url=Db::name('user_tixian')->where('id='.$ids)->value('payurl');
        $dat=$this->http_get($url);
        $data=json_decode($dat,true);
        
        if (!empty($data['payment_no'])) {
           Db::name('user_tixian')->where('id='.$ids)->setfield('paymentno',$data['payment_no']);
           echo "取款ok";
        }else{
            print_r($data);
        }
      
      
    }
    private function http_get($url){//带json发送，无json数据

        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
        return $result;
        }   
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}

<?php
namespace app\index\controller;
use think\Controller;

class Ysapp extends Base
{

  public function fenl(){
    $so =db('type')->where('type_pid','0')->where('type_status','1')->where('type_mid','1')->select();
    return  json_encode($so);
  }
   public function ffenl(){
     $data=input();
     $pid=$data['id']+1;
    $so =db('type')->where('type_pid',$pid)->where('type_status','1')->where('type_mid','1')->select();
    return  json_encode($so);
  }
  public function wzpid(){
     $id=$_GET['id'];
     $so =db('art')->where('art_id', $id)->find();
      return  json_encode($so);
  }
  
   public function shouye(){
    $so =db('vod')->limit(0,4)->order('vod_time desc')->whereor('type_id','3')->select();
    $so1 =db('vod')->limit(0,6)->order('vod_time desc')->whereor('type_id','4')->select();
    $so2 =db('vod')->limit(0,6)->order('vod_time desc')->where('type_id_1','2')->select();
    $so3 =db('vod')->limit(0,6)->order('vod_time desc')->where('type_id_1','1')->select();
    $arr['zy']['data']=$so;
    $arr['dm']['data']=$so1;
    $arr['dy']['data']=$so3;
    $arr['dsj']['data']=$so2;
    return  json_encode($arr);
  }
  public function sosuo(){
     $name=$_GET['name'];
    //->where('fl','NEQ','福利片')
     $so =db('vod')->limit(0,21)->order('vod_time desc')->where('vod_name', 'like', '%'.$name.'%')->select();
    $arr['dsj']['data']=$so;
      return  json_encode($arr);
  }
  public function sosuoid(){
     $id=$_GET['id'];
    //->where('fl','NEQ','福利片')
     $so =db('vod')->order('vod_time desc')->where('vod_id', $id)->select();
    
      return  json_encode($so);
  }

  public function gxsosuo(){
     $name=$_GET['name'];
     $yeshu=$_GET['yema'];
   
    if($yeshu==1){
      $zuixiao=0;
        $zuida=21;
      }else{
      $zuixiao=($yeshu*21)-20;
        $zuida=$yeshu*21;
      }
    $count =db('vod')->order('vod_time desc')->where('vod_name', 'like', '%'.$name.'%')->count();
    if($zuixiao>$count){
      return json(['code' => '0','msg'=>'已经加载完了，没有了呦！']);
    }else{
     $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_name', 'like', '%'.$name.'%')->select();
    $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
  }
  
  public function dsjsy1(){
    $shaix=$_GET['shaix'];
    $so =db('vod')->limit(0,21)->order('vod_time desc')->where('type_id',$shaix)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
  }
  
  
  public function dsjsy(){
     $leix=$_GET['leix'];
    $shaix=$_GET['shaix'];
    if($leix==0){
      if($shaix==1){
      $dfs='国产';
      }else if($shaix==2){
      $dfs='香港';
      }else if($shaix==3){
      $dfs='韩国';
      }else if($shaix==4){
      $dfs='欧美';
      }else if($shaix==5){
      $dfs='日本';
      }else if($shaix==6){
      $dfs='台湾';
      }else if($shaix==7){
      $dfs='海外';
      }
      
    if($shaix==0){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->where('vod_class','国产剧')->whereor('vod_class','香港剧')->whereor('vod_class','韩国')->whereor('vod_class','欧美')->whereor('vod_class','台湾')->whereor('vod_class','日本')->whereor('vod_class','海外')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix==8){
     $so =db('vod')->limit(0,21)->order('vod_time desc')->where('type_id','22')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix!=0){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->where('vod_class',$dfs)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
      
    }else if($leix==1){
      if($shaix==1){
      $dfs='动作';
      }else if($shaix==2){
      $dfs='喜剧';
      }else if($shaix==3){
      $dfs='爱情';
      }else if($shaix==4){
      $dfs='科幻';
      }else if($shaix==5){
      $dfs='恐怖';
      }else if($shaix==6){
      $dfs='剧情';
      }else if($shaix==7){
      $dfs='战争';
      }
      if($shaix==0){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->where('vod_class','动作')->whereor('vod_class','喜剧')->whereor('vod_class','爱情')->whereor('vod_class','科幻')->whereor('vod_class','恐怖')->whereor('vod_class','剧情')->whereor('vod_class','战争')->select();
     $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix==8){
     $so =db('vod')->limit(0,21)->order('vod_time desc')->where('type_id','23')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix!=0){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->where('vod_class',$dfs)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
      
    }else if($leix==2){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->whereor('vod_class','动漫')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($leix==3){
    $so =db('vod')->limit(0,21)->order('vod_time desc')->whereor('vod_class','综艺')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
    
    
  }
  public function dsjjzgd(){
     $leix=$_GET['leix'];
     $yeshu=$_GET['yema'];
    $shaix=$_GET['shaix'];
    
      if($yeshu==1){
      $zuixiao=0;
        $zuida=21;
      }else{
      $zuixiao=($yeshu*21)-20;
        $zuida=$yeshu*21;
      }
    
    if($leix==0){
      if($shaix==1){
      $dfs='国产';
      }else if($shaix==2){
      $dfs='香港';
      }else if($shaix==3){
      $dfs='韩国';
      }else if($shaix==4){
      $dfs='欧美';
      }else if($shaix==5){
      $dfs='日本';
      }else if($shaix==6){
      $dfs='台湾';
      }else if($shaix==7){
      $dfs='海外';
      }
      
      if($shaix==0){
      $count =db('vod')->order('vod_time desc')->where('vod_class','国产')->whereor('vod_class','香港')->whereor('vod_class','韩国')->whereor('vod_class','欧美')->whereor('vod_class','台湾')->whereor('vod_class','日本')->whereor('vod_class','海外')->count();
      }else if($shaix==8){
      $count =db('vod')->order('vod_time desc')->where('type_id','22')->count();
      }else if($shaix!=0){
      $count =db('vod')->order('vod_time desc')->where('vod_class',$dfs)->count();
      }
      
    }else if($leix==1){
      if($shaix==1){
      $dfs='动作';
      }else if($shaix==2){
      $dfs='喜剧';
      }else if($shaix==3){
      $dfs='爱情';
      }else if($shaix==4){
      $dfs='科幻';
      }else if($shaix==5){
      $dfs='恐怖';
      }else if($shaix==6){
      $dfs='剧情';
      }else if($shaix==7){
      $dfs='战争';
      }
      if($shaix==0){
      $count =db('vod')->order('vod_time desc')->where('vod_class','动作')->whereor('vod_class','喜剧')->whereor('vod_class','爱情')->whereor('vod_class','科幻')->whereor('vod_class','恐怖')->whereor('vod_class','剧情')->whereor('vod_class','战争')->count();
      }else if($shaix==8){
      $count =db('vod')->order('vod_time desc')->where('type_id','23')->count();
      }else if($shaix!=0){
      $count =db('vod')->order('vod_time desc')->where('vod_class',$dfs)->count();
      }
    }else if($leix==2){
      $count =db('vod')->order('vod_time desc')->where('vod_class','动漫')->count();
    }else if($leix==3){
    $count =db('vod')->order('vod_time desc')->where('vod_class','综艺')->count();
    }
    
    if($zuixiao>$count){
   return json(['code' => '0','msg'=>'已经加载完了，没有了呦！']);
    }else{
      if($leix==0){
        if($shaix==0){
    $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class','国产')->whereor('vod_class','香港')->whereor('vod_class','韩国')->whereor('vod_class','欧美')->whereor('vod_class','台湾')->whereor('vod_class','日本')->whereor('vod_class','海外')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix==8){
     $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('type_id','22')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix!=0){
    $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class',$dfs)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
        
        
    }else if($leix==1){
        if($shaix==0){
   $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class','动作')->whereor('vod_class','喜剧')->whereor('vod_class','爱情')->whereor('vod_class','科幻')->whereor('vod_class','恐怖')->whereor('vod_class','剧情')->whereor('vod_class','战争')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix==8){
    $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('type_id','23')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }else if($shaix!=0){
    $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class',$dfs)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
        
      }else if($leix==2){
       $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class','动漫')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
      }else if($leix==3){
       $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('vod_class','综艺')->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
      }
    }
  }
  
  
  
  
  
  
  public function dsjjzgd1(){
     $yeshu=$_GET['yema'];
    $shaix=$_GET['shaix'];
      if($yeshu==1){
      $zuixiao=0;
        $zuida=21;
      }else{
      $zuixiao=($yeshu*21)-20;
        $zuida=$yeshu*21;
      }
    $count =db('vod')->order('vod_time desc')->where('type_id',$shaix)->count();
    if($zuixiao>$count){
   return json(['code' => '0','msg'=>'已经加载完了，没有了呦！']);
    }else{
    $so =db('vod')->limit($zuixiao,$zuida)->order('vod_time desc')->where('type_id',$shaix)->select();
      $arr['dsj']['data']=$so;
      return  json_encode($arr);
    }
    
    
  }
  
  
  
}

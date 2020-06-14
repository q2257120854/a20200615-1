<?php
$data =array(
 'vip'=> array(
 "data"=> array(
 array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
 array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
    array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
    array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
    array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
    array(
   'name'=>'爱奇艺',
   'linkurl'=>'https://m.iqiyi.com/vip',
   'picurl'=>'/public/uploads/20190517/c5dd59e4f1fdf11fb2abdc8b658da13c.jpeg',
 ),
   
 )
 ),

  
  
  
);


$data1 =array(
 'url2'=>'http://jx.du2.cc/?url=',
 'url3'=>'http://jx1.123cf.top/?url=',
  'url4'=>'http://jx1.123cf.top/?url=',
  'url5'=>'http://jx1.123cf.top/?url=',
  'url6'=>'http://jx1.123cf.top/?url=',
  'url7'=>'http://jx1.123cf.top/?url=',
  'url8'=>'http://jx1.123cf.top/?url=',
  'url9'=>'http://jx1.123cf.top/?url=',
  'url10'=>'http://jx1.123cf.top/?url=',
);
$data_json1 = json_encode($data1);
$data_json = json_encode($data);
header('Content-type:text/json');
if($_GET['sn']=="jk"){
echo $data_json1;
}else{
echo $data_json;
}

?>
<?php
$player=$_POST['json'];       
//$player ='http://www.zuidazy.net/?m=vod-detail-id-60595.html';
		$tvinfo = file_get_contents($player);
        $tvinfo = preg_replace("/([\r\n|\n|\t| ]+)/",'',$tvinfo);
		$tvzz = '#<li><inputtype="checkbox"name="copy_sel"valu[\s\S]+?</ul>#';
        $t = '#<li><inputtype="checkbox"name="copy_sel"value="(.*?)"checked=""/>(.*?)http#';
        $t1 = '#<divclass="vodh"><h2>(.*?)</h2>#';
        $t2 = '#</h2><span>(.*?)</span><label>#';
        $t3 = '#<li>主演：<span>(.*?)</span>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		preg_match_all($t, $tvarr[0][0], $huoqu);
        preg_match_all($t1, $tvinfo, $name);
        preg_match_all($t2, $tvinfo, $qj);
        preg_match_all($t3, $tvinfo, $zy);
        preg_match_all($t,$tvarr[0][2], $xz);

 $lblj=array_reduce($huoqu[1],"myfunction");
function myfunction($v1,$v2)
{
return $v1 . "&*" . $v2;
}
$lbname= array_reduce($huoqu[2],"myfunction1");
function myfunction1($v1,$v2)
{
return $v1 . $v2;
}
$xiazai= array_reduce($xz[1],"myfunction2");
function myfunction2($v1,$v2)
{
return $v1 ."$*". $v2;
}
      //  echo count($huoqu[1]);
   //   var_dump($xz[1]);
 
//  echo $tvarr[0][0];


$data =array(
 'sl'=>count($huoqu[1]),
 'lblj'=>$lblj,
   'lbname'=>$lbname,
   'name'=>$name[1][0],
    'qj'=>$qj[1][0],
    'zy'=>$zy[1][0],
  'xiazai'=>$xiazai,
);
$data_json = json_encode($data);
header('Content-type:text/json');

    echo $data_json;



?>
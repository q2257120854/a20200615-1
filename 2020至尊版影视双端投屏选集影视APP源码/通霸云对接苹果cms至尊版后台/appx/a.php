<?php
//电视剧
	$player ='http://www.zuidazy.net/?m=vod-type-id-12.html';
		$tvinfo = file_get_contents($player);
		$tvzz = '#<li><span class="xing_vb1">影片名称</span>[\s\S]+?</div>[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		//var_dump($tvarr);
		$t = '#<li><span class="tt"></span><span class="xing_vb4"><a href="(.*?)" target="_blank">(.*?)</a></span> <span class="xing_vb5">(.*?)</span> <span class="xing_vb6">(.*?)</span></li>#';
		preg_match_all($t, $tvarr[0][0], $lianjie);
//var_dump($lianjie);
	//	$totalLink=count($lianjie);
		//var_dump($totalLink);
		$lianjie1=$lianjie[1][0];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo1 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo1, $dsj1);

	    $lianjie1=$lianjie[1][1];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dsj2);

 $lianjie1=$lianjie[1][2];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dsj3);

 $lianjie1=$lianjie[1][3];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dsj4);


 $lianjie1=$lianjie[1][4];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dsj5);

 $lianjie1=$lianjie[1][5];
		$dsjdz1="http://www.zuidazy.net".$lianjie1;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dsj6);




//电影

	$player ='http://www.zuidazy.net/?m=vod-type-id-1.html';
		$tvinfo = file_get_contents($player);
		$tvzz = '#<li><span class="xing_vb1">影片名称</span>[\s\S]+?</div>[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		//var_dump($tvarr);
		$t = '#<li><span class="tt"></span><span class="xing_vb4"><a href="(.*?)" target="_blank">(.*?)</a></span> <span class="xing_vb5">(.*?)</span> <span class="xing_vb6">(.*?)</span></li>#';
		preg_match_all($t, $tvarr[0][0], $lianjie1);
   //var_dump($lianjie1);
	//	$totalLink=count($lianjie);
		//var_dump($totalLink);
		$lianjie11=$lianjie1[1][0];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo1 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo1, $dy1);

	    $lianjie11=$lianjie1[1][1];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dy2);

 $lianjie11=$lianjie1[1][2];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dy3);

 $lianjie11=$lianjie1[1][3];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dy4);


 $lianjie11=$lianjie1[1][4];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dy5);

 $lianjie11=$lianjie1[1][5];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dy6);




//动漫

	$player ='http://www.zuidazy.net/?m=vod-type-id-4.html';
		$tvinfo = file_get_contents($player);
		$tvzz = '#<li><span class="xing_vb1">影片名称</span>[\s\S]+?</div>[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		//var_dump($tvarr);
		$t = '#<li><span class="tt"></span><span class="xing_vb4"><a href="(.*?)" target="_blank">(.*?)</a></span> <span class="xing_vb5">(.*?)</span> <span class="xing_vb6">(.*?)</span></li>#';
		preg_match_all($t, $tvarr[0][0], $lianjie2);
   //var_dump($lianjie1);
	//	$totalLink=count($lianjie);
		//var_dump($totalLink);
		$lianjie111=$lianjie2[1][0];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo1 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo1, $dm1);

	    $lianjie111=$lianjie2[1][1];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dm2);

        $lianjie111=$lianjie2[1][2];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dm3);

        $lianjie111=$lianjie2[1][3];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dm4);


        $lianjie111=$lianjie2[1][4];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dm5);

        $lianjie111=$lianjie2[1][5];
		$dsjdz1="http://www.zuidazy.net".$lianjie111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $dm6);





//综艺

	$player ='http://www.zuidazy.net/?m=vod-type-id-3.html';
		$tvinfo = file_get_contents($player);
		$tvzz = '#<li><span class="xing_vb1">影片名称</span>[\s\S]+?</div>[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		//var_dump($tvarr);
		$t = '#<li><span class="tt"></span><span class="xing_vb4"><a href="(.*?)" target="_blank">(.*?)</a></span> <span class="xing_vb5">(.*?)</span> <span class="xing_vb6">(.*?)</span></li>#';
		preg_match_all($t, $tvarr[0][0], $lianjie3);
   //var_dump($lianjie1);
	//	$totalLink=count($lianjie);
		//var_dump($totalLink);
		$lianjie1111=$lianjie3[1][0];
		$dsjdz1="http://www.zuidazy.net".$lianjie1111;
        $tvinfo1 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo1, $zy1);

	    $lianjie1111=$lianjie3[1][1];
		$dsjdz1="http://www.zuidazy.net".$lianjie11;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $zy2);

 $lianjie1111=$lianjie3[1][2];
		$dsjdz1="http://www.zuidazy.net".$lianjie1111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $zy3);

 $lianjie1111=$lianjie3[1][3];
		$dsjdz1="http://www.zuidazy.net".$lianjie1111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $zy4);


 $lianjie1111=$lianjie1[1][4];
		$dsjdz1="http://www.zuidazy.net".$lianjie1111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $zy5);

 $lianjie1111=$lianjie3[1][5];
		$dsjdz1="http://www.zuidazy.net".$lianjie1111;
        $tvinfo2 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo2, $zy6);






//var_dump($lianjie1[1][0]);


$data =array(
  //电视剧
 'vip'=> array(
 "data"=> array(
 array(
   'name'=>$dsj1[2],
   'picurl'=>$dsj1[1],
   'gxnr'=>$lianjie[4][0],
   'splj'=>"http://www.zuidazy.net".$lianjie[1][0]
 ),
 array(
   'name'=>$dsj2[2],
   'picurl'=>$dsj2[1],
   'gxnr'=>$lianjie[4][1],
    'splj'=>"http://www.zuidazy.net".$lianjie[1][1]
 ),
    array(
   'name'=>$dsj3[2],
   'picurl'=>$dsj3[1],
   'gxnr'=>$lianjie[4][2],
       'splj'=>"http://www.zuidazy.net".$lianjie[1][2]
 ),
    array(
   'name'=>$dsj4[2],
   'picurl'=>$dsj4[1],
   'gxnr'=>$lianjie[4][3],
       'splj'=>"http://www.zuidazy.net".$lianjie[1][3]
 ),
    array(
   'name'=>$dsj5[2],
   'picurl'=>$dsj5[1],
   'gxnr'=>$lianjie[4][4],
       'splj'=>"http://www.zuidazy.net".$lianjie[1][4]
 ),
    array(
   'name'=>$dsj6[2],
   'picurl'=>$dsj6[1],
   'gxnr'=>$lianjie[4][5],
       'splj'=>"http://www.zuidazy.net".$lianjie[1][5]
 ),
   
 )
 ),
  //电影
'dy'=>array(
 "data"=> array(
 array(
  'name'=> $dy1[2],
   'picurl'=> $dy1[1],
   'gxnr'=> $lianjie1[4][0],
    'splj'=>"http://www.zuidazy.net".$lianjie1[1][0],
 ),
   array(
  'name'=> $dy2[2],
   'picurl'=> $dy2[1],
   'gxnr'=> $lianjie1[4][1],
     'splj'=>"http://www.zuidazy.net".$lianjie1[1][1],
 ),
   array(
  'name'=> $dy3[2],
   'picurl'=> $dy3[1],
   'gxnr'=> $lianjie1[4][2],
     'splj'=>"http://www.zuidazy.net".$lianjie1[1][2],
 ),
   array(
  'name'=> $dy4[2],
   'picurl'=> $dy4[1],
   'gxnr'=> $lianjie1[4][3],
     'splj'=>"http://www.zuidazy.net".$lianjie1[1][3],
 ),
   array(
  'name'=> $dy5[2],
   'picurl'=> $dy5[1],
   'gxnr'=> $lianjie1[4][4],
     'splj'=>"http://www.zuidazy.net".$lianjie1[1][4],
 ),
   array(
  'name'=> $dy6[2],
   'picurl'=> $dy6[1],
   'gxnr'=> $lianjie1[4][5],
     'splj'=>"http://www.zuidazy.net".$lianjie1[1][5],
 ),
 
 )
),
  //动漫
  'dm'=>array(
 "data"=> array(
 array(
  'name'=> $dm1[2],
   'picurl'=> $dm1[1],
   'gxnr'=> $lianjie2[4][0],
   'splj'=>"http://www.zuidazy.net".$lianjie2[1][0],
 ),
   array(
  'name'=> $dm2[2],
   'picurl'=> $dm2[1],
   'gxnr'=> $lianjie2[4][1],
     'splj'=>"http://www.zuidazy.net".$lianjie2[1][1],
 ),
   array(
  'name'=> $dm3[2],
   'picurl'=> $dm3[1],
   'gxnr'=> $lianjie2[4][2],
     'splj'=>"http://www.zuidazy.net".$lianjie2[1][2],
 ),
   array(
  'name'=> $dm4[2],
   'picurl'=> $dm4[1],
   'gxnr'=> $lianjie2[4][3],
     'splj'=>"http://www.zuidazy.net".$lianjie2[1][3],
 ),
   array(
  'name'=> $dm5[2],
   'picurl'=> $dm5[1],
   'gxnr'=> $lianjie2[4][4],
     'splj'=>"http://www.zuidazy.net".$lianjie2[1][4],
 ),
   array(
  'name'=> $dy6[2],
   'picurl'=> $dy6[1],
   'gxnr'=> $lianjie2[4][5],
     'splj'=>"http://www.zuidazy.net".$lianjie2[1][5],
 ),
 
 )
),
  //综艺
    'zy'=>array(
 "data"=> array(
 array(
  'name'=> $zy1[2],
   'picurl'=> $zy1[1],
   'gxnr'=> $lianjie3[4][0],
   'splj'=>"http://www.zuidazy.net".$lianjie3[1][0],
 ),
   array(
  'name'=> $zy2[2],
   'picurl'=> $zy2[1],
   'gxnr'=> $lianjie3[4][1],
     'splj'=>"http://www.zuidazy.net".$lianjie3[1][1],
 ),
   array(
  'name'=> $zy3[2],
   'picurl'=> $zy3[1],
   'gxnr'=> $lianjie3[4][2],
     'splj'=>"http://www.zuidazy.net".$lianjie3[1][2],
 ),
   array(
  'name'=> $zy4[2],
   'picurl'=> $zy4[1],
   'gxnr'=> $lianjie3[4][3],
     'splj'=>"http://www.zuidazy.net".$lianjie3[1][3],
 ),
   array(
  'name'=> $zy5[2],
   'picurl'=> $zy5[1],
   'gxnr'=> $lianjie3[4][4],
     'splj'=>"http://www.zuidazy.net".$lianjie3[1][4],
 ),
   array(
  'name'=> $zy6[2],
   'picurl'=> $zy6[1],
   'gxnr'=> $lianjie3[4][5],
     'splj'=>"http://www.zuidazy.net".$lianjie3[1][5],
 ),
 
 )
),
);
$data_json = json_encode($data);
header('Content-type:text/json');

    echo $data_json;

		//	echo json_encode($list, JSON_UNESCAPED_UNICODE);
?>



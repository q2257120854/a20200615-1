<?php
     //   $player='http://www.zuidazy.net/index.php?m=vod-search&wd='.$_POST['json'].'&submit=search';
$player='http://www.zuidazy.net/index.php?m=vod-search&wd=12&submit=search';
		$tvinfo = file_get_contents($player);
		$tvzz = '#<li><span class="xing_vb1">影片名称</span>[\s\S]+?</div>[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
		//var_dump($tvarr);
		$t = '#<li><span class="tt"></span><span class="xing_vb4"><a href="(.*?)" target="_blank">(.*?)<span>(.*?)</span></a></span> <span class="xing_vb5">(.*?)</span> <span class="xing_vb6">(.*?)</span></li>#';
		preg_match_all($t, $tvarr[0][0], $lianjie);
//var_dump($lianjie[4]);
	//	$totalLink=count($lianjie);
		//var_dump($totalLink);
//echo count($lianjie[0]);
      $lianjie1="";
        $name="";
        for($i=0;$i<=count($lianjie[0]);$i++){
        if($lianjie[4][$i]<>"伦理片"&& $lianjie[4][$i]<>"福利片"&& $lianjie[4][$i]<>"福利片"){
        $lianjie12=$lianjie[1][$i];
		$dsjdz1="http://www.zuidazy.net".$lianjie12;
        $tvinfo1 = file_get_contents($dsjdz1);
		$dsjimg1=' <img class="lazy" src="(.*?)" alt="(.*?)" />';
        preg_match_all($dsjimg1, $tvinfo1, $dsj1);
        $lianjie1=$lianjie1."%%%".$dsjdz1;
        $name=$name."$$#".$lianjie[2][$i];
        
        }
        
        };
      echo $lianjie1;



?>
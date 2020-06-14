<?php

        $player=$_GET['jxdz'];
		$tvinfo = file_get_contents($player);
        $tvinfo = preg_replace("/([\r\n|\n|\t| ]+)/",'',$tvinfo);
		$tvzz = '#<divclass="content"style="text-align:left">[\s\S]+?</div>#';
		preg_match_all($tvzz, $tvinfo, $tvarr);
  // var_dump($tvarr[0][0]); 

   echo $tvarr[0][0];

?>
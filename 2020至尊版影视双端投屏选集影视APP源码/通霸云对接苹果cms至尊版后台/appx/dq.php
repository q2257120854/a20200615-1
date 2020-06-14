<?php
        $hosturl = $_SERVER['HTTP_HOST'];
        $updatehost = 'http://cmscs1.jc3c.cn/update.php';
        $updatehosturl = $updatehost . '?a=client_check_time&v=' . $ver . '&u=' . $hosturl;
        $domain_time = file_get_contents($updatehosturl);
        if($domain_time == '0'){
            $domain_time = '[授权版本：授权已过期，请联系客服QQ:824358630]';
        }else{
            $domain_time = '授权版本：(青衫源码商业版)--到期时间：(' . date("Y-m-d", $domain_time) . ')';
        }

unset($domain);

?>
<?php

        $version = './Data/version.php';
        $ver = $ver['ver'];
        $ver = substr($ver,-3);
        $updatehost = 'http://cmscs1.jc3c.cn/update.php';
        $lastver = file_get_contents(($updatehost . '?a=check&v=') . $ver);
        if($lastver !== $ver){
            $updateinfo = ('<p class="red">最新版本为： ' . $lastver) . '</p><span>
		   <button onclick="getZce()">点击这里在线升级</button>
           </span>';
            $chanageinfo = file_get_contents(($updatehost . '?a=chanage&v=') . $lastver);
        }else{
            $updateinfo = ('<p class="red">最新版本为： ' . $lastver) . '</p><span>已经是最新系统 不需要升级</span>';
        }
      echo $updateinfo;
  
?>
<html>
  <body>
    <span class="download-appBtn"  onClick="getZce()">点击领全网会员</span> 
    </body>
<Script type="text/javascript">
function calc()
{
 layer.msg('请输入手机号领取');
  
}
</Script>
  <script type="text/javascript">
  function getZce() {
    
     layer.msg('请输入手机号领取');
      
    
    }
  }

</script>

</html>
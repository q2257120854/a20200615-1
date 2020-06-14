<?php
$msg = "<font color=red size=5>充值成功，请退出app重新登录！</font>";
echo "<script>layer.open({content:'".$msg."',btn: '<font color=green size=5>'+'如提示未充值成功请重新登录'+'</font>',shadeClose: false,yes: function(){layer.open({content: '如提示未充值成功请重新登录',time: 2,skin:'msg'}); }});</script>";
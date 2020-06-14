<!DOCTYPE html>
<html>
<head>
<?php 
include_once('../../jhs_config/function.php');

?>

  <!DOCTYPE html>
  <html lang="zh">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>聚合社</title>

  </head>
  <body>
  <header>
    <p>
      <span>商户登录  <?=$site_url?></span>
	   <br>
    </p>
  </header>
<form method="post" action="login_check.php">
              <input type="text" name="username" value="邮箱" >
			  <br> <br>
              <input type="text" name="password" value="密码" >
			   <br> <br>
              <button type="submit">登录</button>
			   <br> <br>
          
        </form>

  </body>
  </Html>
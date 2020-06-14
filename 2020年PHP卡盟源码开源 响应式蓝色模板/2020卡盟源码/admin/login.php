

<?php 
include_once('../jhs_config/function.php');
?>
  <!DOCTYPE html>
  <html lang="zh">
  <head>
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录 - 聚合社卡盟后台管理系统</title>
    <link rel="stylesheet" href="webstyle/login.css">
    <style>
      .form-group-email { position: relative;}
      .ue-passport-select-wrap {
        top:34px;
        left: 0;
        display:none
      }
      .ue-passport-select-wrap .domain-list{
        border: 1px solid #ccc;
        padding-left: 13px;
      }
      .pprt-form .login-err {
        min-height: 20px;
        padding-left: 5px;
      }
      .portrait img {
        border-radius: 50%;
        margin-right: 10px;
      }
      .info-box .logout-err { padding-left: 20px;}
      .user-info {
        padding-top: 20px;
      }
      .user-info .logout-btn {
        margin-top: 12px;
        float: right;
      }
      .ui-passport-input-txt, .ue-validcode-change {
        display: inline-block;
      }
      .ui-passport-input-txt {
        margin-right: 5px;
      }
      .ue-passport-validcode-input {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
      }
    </style>
  
    <script src="webstyle/passport.js"></script>
  </head>
  <body>
  <?php If ($_REQUEST['Action']=="") { ?>
  <header>
    <i></i>
    <p>
      <span>Admin </span>
      <span>v1.4</span>
      <small>聚合社</small>
    </p>
  </header>
  <div id="container">
    <div id="pprt-wrap" class="login-form">
      <div class="pprt-form-box">
<form method="post" action="?Action=save">
          <div class="form-group">
              <div class="login-err text-danger"></div>
          </div>
          <div class="form-group form-group-email">
              <input class="form-control" type="text" name="username" placeholder="账户" autofocus="autofocus" required="required" maxlength="50">
              <div class="ue-passport-select-wrap"></div>
          </div>
          <div class="form-group">
              <input class="form-control" type="password" name="password" placeholder="密码" required="required" maxlength="50" onpaste="return false">
          </div>
          <div class="form-group ue-passport-validcode-container"></div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">登录</button>
          </div>
		  <div>&#22823;&#37327;&#28304;&#30721;&#65292;&#25345;&#32493;&#26356;&#26032;&#65306;&#119;&#119;&#119;&#46;&#109;&#50;&#49;&#51;&#46;&#99;&#110;</div>
        </form>
      </div>
      <div class="wait-box" style="display: none">
        <div class="logging-in"></div>
        <div class="logging-out"></div>
      </div>
    </div>
    <footer>
      <a href="http://www.juheshe.cn/">
        <img src="http://www.juheshe.cn/logo.png">
      </a>
      <p>Copyright &copy; 聚合社卡盟系统 &nbsp; <span data-role="copyright">2018</span> &nbsp;juheshe.cn</p>
    </footer>
  </div>
  <?php }else{
$username=$_POST['username'];        //// 会员账户
$password=md5($_POST['password']);   //// 会员密码
$total=mysql_num_rows(mysql_query("SELECT * FROM `administrator` where  username='$_POST[username]' and password='$password'  ",$conn1));
if ($total=='0'){
echo "<script language=\"javascript\">alert('登录失败，帐号或者密码错误！');history.go(-1);</script>";
exit();
}
ysk_date_log(0,$username,'登录系统');//--------------------执行操作日志
$yx_us_result=mysql_query("select * from administrator  where username='$username' and password='$password'  ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$_SESSION['ysk_username']=$username;
$_SESSION['ysk_flag']=$yx_us['flag']; 
$_SESSION['ysk_founder']=$yx_us['founder'];  
echo "<script language=\"javascript\">window.location.href='index.php';</script>";           
exit();
}

?>
  </body>
  </Html>

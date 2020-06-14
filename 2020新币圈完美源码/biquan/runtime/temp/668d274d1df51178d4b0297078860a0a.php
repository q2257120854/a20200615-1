<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/bayebiquan/public/../application/index/view/user/login.html";i:1558774062;s:66:"/www/wwwroot/bayebiquan/application/index/view/layout/default.html";i:1561535542;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<link rel="stylesheet" type="text/css" href="<?php echo $site['site_url']; ?>/game/xxx/css/common.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $site['site_url']; ?>/game/xxx/css/mui.min.css" />

      <script src="<?php echo $site['site_url']; ?>/game/xxx/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
	  <script src="<?php echo $site['site_url']; ?>/game/xxx/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
	  <script src="<?php echo $site['site_url']; ?>/game/xxx/js/rem.js" type="text/javascript" charset="utf-8"></script>

   
  

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-bottom: 46px">
      

            <div id="content-container" class="container">
    <div class="user-section login-section">
        <div class="logon-tab clearfix"> <a class="active"><?php echo __('Sign in'); ?></a> </div>
        <div class="login-main"> 
            <form name="form" id="login-form" class="form-vertical" method="POST" action="">
                <input type="hidden" name="url" value="<?php echo $url; ?>" />
                <?php echo token(); ?>
                <div class="form-group">
                    <label class="control-label" for="account"><?php echo __('Mobile'); ?></label>
                    <div class="controls">
                        <input class="form-control input-lg" id="account" type="text" name="account" value="" data-rule="required" placeholder="<?php echo __('Email/Mobile/Username'); ?>" autocomplete="off">
                        <div class="help-block"></div>
                    </div>
                </div>
                 
                 <div class="form-group">
                    <label class="control-label"><?php echo __('Captcha'); ?></label>
                    <div class="controls">
                        <div class="input-group input-group-lg">
                            <input type="text" name="captcha" class="form-control" placeholder="<?php echo __('Captcha'); ?>" data-rule="required;length(4)" style="border-radius: 0;" />
                            <span class="input-group-addon" style="padding:0;border:none;">
                                <img src="<?php echo captcha_src(); ?>" width="140" height="42" onclick="this.src = '<?php echo captcha_src(); ?>?r=' + Math.random();"/>
                            </span>
                        </div>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo __('Sign in'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/html" id="resetpwdtpl">
   
</script>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->

<script type="text/javascript">
   
</script>

</body>
</html>

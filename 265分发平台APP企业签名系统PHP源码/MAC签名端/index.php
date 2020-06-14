<?php
ini_set('date.timezone', 'PRC');
$api = 'https://www.265f.com/';
$secret = '935e464f17bf93d21b8dd0c794a930f0';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>签名监控</title>
<script type="text/javascript" src="<?php echo $api; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript">
var ajax = function(conf) {
        var xhr = null;
        try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
                try {
                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                        xhr = new XMLHttpRequest();
                }
        }
        xhr.open("GET", conf.url, true);
        xhr.withCredentials = true;
        xhr.send(null);
        xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                        conf.success(xhr.responseText);
                }
        };
};
function remote() {
        ajax({
                url:"<?php echo $api; ?>source/index/oauth.php?secret=<?php echo $secret; ?>",
                success:function(text) {
                        if (isNaN(text)) {
                                $("#_sign").append(text);
                        }
                        $("#_count").text($("#_sign tr").length - 1);
                }
        });
}
setInterval('remote()', 6000);
</script>
</head>
<body>
<table id="_sign" style="text-align:center;width:100%;border:1px solid #09C"><tr><td style="color:#09C"><?php echo date('Y-m-d H:i:s'); ?> / <b id="_count">0</b></td></tr></table>
</body>
</html>
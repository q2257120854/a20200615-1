<?php


include "../../system/db.class.php";
$ac = isset($_GET["ac"]) ? $_GET["ac"] : NULL;
if ($ac == "mobileconfig") {
	include "../../system/user.php";
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: text/html;charset=" . IN_CHARSET);
	$GLOBALS["userlogined"] or exit("return_0");
	$GLOBALS["erduo_in_points"] < IN_WEBVIEWPOINTS and exit("return_1");
	$GLOBALS["db"]->query("update " . tname("user") . " set in_points=in_points-" . IN_WEBVIEWPOINTS . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
	$ssl = is_ssl() ? "https://" : "http://";
	$title = unescape(SafeRequest("title", "get"));
	$url = SafeRequest("url", "get");
	$aicon = str_replace($ssl . $_SERVER["HTTP_HOST"] . IN_PATH . "data", IN_ROOT . "data", SafeRequest("aicon", "get"));
	$dir = IN_ROOT . "data/tmp";
	$time = $GLOBALS["erduo_in_userid"] . "-" . time();
	creatdir($dir . "/" . $time);
	$str = file_get_contents(IN_ROOT . "./static/pack/mobileconfig/ios.mobileconfig");
	$data = fread(fopen($aicon, "r"), filesize($aicon));
	$base64 = chunk_split(base64_encode($data));
	$str = str_replace(array("[name]", "[link]", "[icon]", "[bid]"), array(convert_charset($title), $url, trim($base64), substr(md5($time), 8, 16)), $str);
	fwrite(fopen($dir . "/" . $time . ".mobileconfig", "w"), $str);
	echo $time;
} else {
	if (!empty($_FILES)) {
		$filepart = pathinfo($_FILES["mobileconfig"]["name"]);
		$fileext = strtolower($filepart["extension"]);
		if (in_array($fileext, array("jpg", "jpeg", "gif", "png"))) {
			$time = date("YmdHis") . rand(2, pow(2, 24)) . "." . $fileext;
			$dir = IN_ROOT . "data/tmp";
			@move_uploaded_file($_FILES["mobileconfig"]["tmp_name"], $dir . "/" . $time);
			echo $time;
		} else {
			echo "return_0";
		}
	}
}
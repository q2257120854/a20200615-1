<?php


include "../../system/db.class.php";
include "../../system/user.php";
$GLOBALS["userlogined"] or exit("-1");
Chk_authkey();
$id = intval($_GET["id"]);
$time = SafeRequest("time", "get");
preg_match("/^(\\d+\\-\\d+)\$/", $time) or exit("-2");
$tmp = IN_ROOT . "data/tmp/" . $time . ".mobileconfig";
is_file($tmp) or exit("-2");
$xml_size = intval(filesize($tmp));
$explode = explode("-", $time);
$icontime = md5($explode[0] . "-" . $explode[1] . "-" . rand(2, pow(2, 24))) . ".png";
$apptime = md5($explode[1] . "-" . $explode[0] . "-" . rand(2, pow(2, 24))) . ".mobileconfig";
is_file(IN_ROOT . "data/attachment/" . $apptime) and exit("-2");
IN_VERIFY > 0 and $GLOBALS["erduo_in_verify"] != 1 and exit("-3");
$xml_size + $GLOBALS["erduo_in_spaceuse"] > $GLOBALS["erduo_in_spacetotal"] and exit("-4");
$mc = file_get_contents($tmp);
$signedfile = IN_ROOT . "data/attachment/" . $apptime;
$sslpath = IN_ROOT . "data/cert/";
if (function_exists("exec") && is_file($sslpath . "server.crt")) {
	exec("openssl smime -sign -in " . $tmp . " -out " . $signedfile . " -signer " . $sslpath . "server.crt -inkey " . $sslpath . "server.key -certfile " . $sslpath . "ca-bundle.crt -outform der -nodetach");
} else {
	rename($tmp, $signedfile);
}
$xml_bid = preg_match_all("/<key>PayloadIdentifier<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/", $mc, $c) ? SafeSql(isset($c[2][1]) ? $c[2][1] : $c[2][0]) : "*";
$xml_name = preg_match("/<key>Label<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/", $mc, $c) ? SafeSql(detect_encoding($c[2])) : NULL;
if (!$xml_name) {
	$xml_name = preg_match("/<key>PayloadDisplayName<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/", $mc, $c) ? SafeSql(detect_encoding($c[2])) : "*";
}
$xml_icon = preg_match("/<key>Icon<\\/key>([\\s\\S]+?)<data>([\\s\\S]+?)<\\/data>/", $mc, $c) ? $c[2] : NULL;
if ($id) {
	getfield("appid", "in_uid", "in_id", $id) == $GLOBALS["erduo_in_userid"] or exit("-5");
	getfield("appid", "in_bid", "in_id", $id) == $xml_bid and getfield("appid", "in_name", "in_id", $id) == $xml_name or exit("-6");
} else {
	$id = $GLOBALS["db"]->getone("select in_id from " . tname("appid") . " where in_bid='" . $xml_bid . "' and in_name='" . $xml_name . "' and in_form='iOS' and in_uid=" . $GLOBALS["erduo_in_userid"]);
}
$basedir = IN_ROOT . "data/image/app";
$imgdir = date("Y") . "/" . date("m") . "/" . date("d");
creatdir($basedir . "/" . $imgdir);
$newfile = $basedir . "/" . $imgdir . "/" . $icontime;
$in_icon = $imgdir . "/" . $icontime;
file_put_contents($newfile, base64_decode($xml_icon));
$deduct = getDeduct($xml_size);
$originalName = $apptime;
$xml_mnvs = "8.0";
$xml_bsvs = "1.0.0";
$xml_bvs = "1";
$xml_nick = $xml_team = "*";
$xml_type = 1;
$xml_udids = "";
if ($id) {
	$old = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $id);
	@unlink(IN_ROOT . "data/image/app/" . $old["in_icon"]);
	$GLOBALS["db"]->query("update " . tname("appid") . " set in_name='" . $xml_name . "',in_type=" . $xml_type . ",in_size=" . $xml_size . ",in_form='iOS',in_mnvs='" . $xml_mnvs . "',in_bid='" . $xml_bid . "',in_bsvs='" . $xml_bsvs . "',in_bvs='" . $xml_bvs . "',in_nick='" . $xml_nick . "',in_team='" . $xml_team . "',in_udids='" . $xml_udids . "',in_icon='" . $in_icon . "',in_app='" . $apptime . "',in_originalName='" . $originalName . "',in_updatetime='" . time() . "' where in_id=" . $id);
	$GLOBALS["db"]->query("update " . tname("app") . " set in_release=0 where in_appid=" . $id);
} else {
	$link = creatLink($id);
	$GLOBALS["db"]->query("Insert " . tname("appid") . " (in_uid,in_uname,in_name,in_icon,in_form,in_bid,in_mnvs,in_bsvs,in_bvs,in_type,in_nick,in_team,in_udids,in_app,in_originalName,in_downloads,in_deduct,in_size,in_link,in_addtime,in_updatetime) values (" . $GLOBALS["erduo_in_userid"] . ",'" . $GLOBALS["erduo_in_username"] . "','" . $xml_name . "','" . $in_icon . "','iOS','" . $xml_bid . "','" . $xml_mnvs . "','" . $xml_bsvs . "','" . $xml_bvs . "'," . $xml_type . ",'" . $xml_nick . "','" . $xml_team . "','" . $xml_udids . "','" . $apptime . "','" . $originalName . "',0," . $deduct . "," . $xml_size . ",'" . $link . "','" . time() . "','" . time() . "')");
	$id = $GLOBALS["db"]->insert_id();
}
$GLOBALS["db"]->query("Insert " . tname("app") . " (in_uid,in_uname,in_name,in_appid,in_form,in_bid,in_mnvs,in_bsvs,in_bvs,in_type,in_nick,in_team,in_udids,in_app,in_originalName,in_deduct,in_size,in_addtime) values (" . $GLOBALS["erduo_in_userid"] . ",'" . $GLOBALS["erduo_in_username"] . "','" . $xml_name . "','" . $id . "','iOS','" . $xml_bid . "','" . $xml_mnvs . "','" . $xml_bsvs . "','" . $xml_bvs . "'," . $xml_type . ",'" . $xml_nick . "','" . $xml_team . "','" . $xml_udids . "','" . $apptime . "','" . $originalName . "'," . $deduct . "," . $xml_size . ",'" . time() . "')");
$GLOBALS["db"]->query("update " . tname("user") . " set in_spaceuse=in_spaceuse+" . $xml_size . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
echo "1";
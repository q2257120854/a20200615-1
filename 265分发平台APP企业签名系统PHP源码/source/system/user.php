<?php


if (!defined("IN_ROOT")) {
	exit("Access denied");
}
if (IN_OPEN == 0) {
	exit(html_message("维护通知", IN_OPENS));
}
$userid = isset($_COOKIE["in_userid"]) ? intval($_COOKIE["in_userid"]) : 0;
$username = isset($_COOKIE["in_username"]) ? SafeSql($_COOKIE["in_username"]) : NULL;
$userpassword = isset($_COOKIE["in_userpassword"]) ? SafeSql($_COOKIE["in_userpassword"]) : NULL;
if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
	$sql = "select * from " . tname("user") . " where in_islock=0 and in_userid=" . $userid . " and in_mail='" . $username . "' and in_userpassword='" . $userpassword . "'";
} else {
	$sql = "select * from " . tname("user") . " where in_islock=0 and in_userid=" . $userid . " and in_username='" . $username . "' and in_userpassword='" . $userpassword . "'";
}
if (preg_match("/0?(13|14|15|18)[0-9]{9}/", $username)) {
	$sql = "select * from " . tname("user") . " where in_islock=0 and in_userid=" . $userid . " and in_mobile='" . $username . "' and in_userpassword='" . $userpassword . "'";
}
$result = $GLOBALS["db"]->query($sql);
if ($row = $GLOBALS["db"]->fetch_array($result)) {
	$userlogined = true;
	$Field = $GLOBALS["db"]->query("SHOW FULL COLUMNS FROM " . tname("user"));
	while ($rows = $GLOBALS["db"]->fetch_array($Field)) {
		$Variable = "erduo_" . $rows["Field"];
		${$Variable} = $row[$rows["Field"]];
	}
} else {
	$userlogined = false;
}
Chk_authkey();
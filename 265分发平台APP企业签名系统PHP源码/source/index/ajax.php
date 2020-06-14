<?php


include "../system/db.class.php";
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
if (!session_id()) {
	session_start();
}
Chk_authkey();
$ac = SafeRequest("ac", "get");
if ($ac == "login") {
	$user = SafeRequest("user", "post");
	$password = SafeRequest("password", "post");
	$pwd = substr(md5($password), 8, 16);
	if (!$user || !$password) {
		echo json_encode(array("code" => "404", "msg" => "账号和密码不能为空！"));
		exit;
	}
	$row = $GLOBALS["db"]->getrow("select * from " . tname("user") . " where (in_username='" . $user . "' or in_mail='" . $user . "' or in_mobile='" . $user . "') and in_userpassword='" . $pwd . "'");
	if (!$row) {
		echo json_encode(array("code" => "404", "msg" => "用户名/邮箱/手机或密码错误！"));
		exit;
	}
	if ($row["in_islock"] == 1) {
		echo json_encode(array("code" => "404", "msg" => "账户已被锁定，请联系管理员！"));
		exit;
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_userid=" . $row["in_userid"] . " and DATEDIFF(DATE(in_logintime),'" . date("Y-m-d") . "')=0")) {
		$GLOBALS["db"]->query("update " . tname("user") . " set in_loginip='" . getonlineip() . "',in_logintime='" . date("Y-m-d H:i:s") . "' where in_userid=" . $row["in_userid"]);
	} else {
		$GLOBALS["db"]->query("update " . tname("user") . " set in_points=in_points+" . IN_LOGINPOINTS . ",in_loginip='" . getonlineip() . "',in_logintime='" . date("Y-m-d H:i:s") . "' where in_userid=" . $row["in_userid"]);
	}
	setcookie("in_userid", $row["in_userid"], time() + 86400, IN_PATH);
	setcookie("in_username", $row["in_username"], time() + 86400, IN_PATH);
	setcookie("in_userpassword", $pwd, time() + 86400, IN_PATH);
	echo json_encode(array("code" => "200", "msg" => "登录成功，请稍等..."));
	exit;
} elseif ($ac == "reg") {
	$username = SafeRequest("nickname", "post");
	$mailcode = SafeRequest("code", "post");
	$mail = SafeRequest("email", "post");
	$password = SafeRequest("password", "post");
	$repassword = SafeRequest("repassword", "post");
	$pwd = substr(md5($password), 8, 16);
	$seccode = SafeRequest("seccode", "post");
	if (empty($seccode) || $seccode != $_SESSION["code"]) {
		echo json_encode(array("code" => "404", "msg" => "图形验证码错误"));
		exit;
	}
	if (strlen($password) < 6) {
		echo json_encode(array("code" => "404", "msg" => "密码最小长度为 6 个字符"));
		exit;
	}
	if ($password != $repassword) {
		echo json_encode(array("code" => "404", "msg" => "两次输入的密码不一致"));
		exit;
	}
	if (!preg_match("/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+\$/", $mail)) {
		echo json_encode(array("code" => "404", "msg" => "邮箱格式有误，请更改"));
		exit;
	}
	if (IN_MAILOPEN) {
		$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mailreg") . " where in_uid='" . $mail . "' and in_code='" . $mailcode . "' order by in_id desc");
		if (!$mid) {
			echo json_encode(array("code" => "404", "msg" => "邮箱验证码错误"));
			exit;
		}
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_username='" . $username . "'")) {
		echo json_encode(array("code" => "404", "msg" => "用户名已经被注册"));
		exit;
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mail='" . $mail . "'")) {
		echo json_encode(array("code" => "404", "msg" => "邮箱已被占用，请更改"));
		exit;
	}
	$setarr = array("in_username" => $username, "in_mail" => $mail, "in_userpassword" => $pwd, "in_regdate" => date("Y-m-d H:i:s"), "in_loginip" => getonlineip(), "in_logintime" => date("Y-m-d H:i:s"), "in_verify" => 0, "in_islock" => 0, "in_points" => IN_LOGINPOINTS, "in_filesize" => IN_UPSIZE * 1048576, "in_spaceuse" => 0, "in_spacetotal" => IN_REGSPACE * 1048576);
	$in_userid = inserttable("user", $setarr, 1);
	setcookie("in_userid", $in_userid, time() + 86400, IN_PATH);
	setcookie("in_username", $username, time() + 86400, IN_PATH);
	setcookie("in_userpassword", $pwd, time() + 86400, IN_PATH);
	if ($in_userid) {
		echo json_encode(array("code" => "200", "msg" => "注册成功"));
		exit;
	} else {
		echo json_encode(array("code" => "404", "msg" => "系统出错，请重试"));
		exit;
	}
} elseif ($ac == "send_reg") {
	IN_MAILOPEN or exit(json_encode(array("code" => "404", "msg" => "邮件服务暂未开启，请联系管理员")));
	$mail = SafeRequest("email", "post");
	$uid = $GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mail='" . $mail . "'");
	if ($uid) {
		echo json_encode(array("code" => "404", "msg" => "邮箱已被占用，请更改"));
		exit;
	}
	$mcode = rand_code();
	$cookie = "in_send_regmail";
	empty($_COOKIE[$cookie]) or exit(json_encode(array("code" => "404", "msg" => "请等待 60 秒后再重新获取")));
	setcookie($cookie, "have", time() + 60, IN_PATH);
	$ssl = is_ssl() ? "https://" : "http://";
	$title = convert_charset(IN_NAME . "[" . $mail . "]账号注册【验证码】");
	$html = "您的注册验证码是：" . $mcode . "<br />为了保证您的账户安全,请勿向任何人提供此验证码。<br />如非本人操作，请忽略此邮件！<br />本邮件由系统自动发送，请勿直接回复。<br />官方网址：" . $ssl . $_SERVER["HTTP_HOST"] . IN_PATH;
	$re = send_email($mail, $title, $html);
	if (!$re) {
		echo json_encode(array("code" => "404", "msg" => "抱歉，邮件码未能发送成功！"));
		exit;
	} else {
		$setarr = array("in_uid" => $mail, "in_code" => $mcode, "in_addtime" => date("Y-m-d H:i:s"));
		inserttable("mailreg", $setarr, 1);
		echo json_encode(array("code" => "200", "msg" => "邮件码已发送至邮箱，请注意查收！"));
		exit;
	}
} elseif ($ac == "send") {
	IN_MAILOPEN or exit(json_encode(array("code" => "404", "msg" => "邮件服务暂未开启，请联系管理员")));
	$mail = SafeRequest("email", "post");
	$uid = $GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mail='" . $mail . "'");
	if (!$uid) {
		echo json_encode(array("code" => "404", "msg" => "邮箱不存在，请更改！"));
		exit;
	}
	$mcode = rand_code();
	$cookie = "in_send_mail";
	empty($_COOKIE[$cookie]) or exit(json_encode(array("code" => "404", "msg" => "请等待 60 秒后再重新获取")));
	$ssl = is_ssl() ? "https://" : "http://";
	$title = convert_charset(IN_NAME . "[" . $mail . "]操作密码【验证码】");
	$html = "您的操作验证码是：" . $mcode . "<br />为了保证您的账户安全,请勿向任何人提供此验证码。<br />如非本人操作，请忽略此邮件！<br />本邮件由系统自动发送，请勿直接回复。<br />官方网址：" . $ssl . $_SERVER["HTTP_HOST"] . IN_PATH;
	$re = send_email($mail, $title, $html);
	if (!$re) {
		echo json_encode(array("code" => "404", "msg" => "抱歉，邮件码未能发送成功！"));
		exit;
	} else {
		$setarr = array("in_uid" => $uid, "in_ucode" => $mail . $mcode, "in_addtime" => date("Y-m-d H:i:s"));
		inserttable("mail", $setarr, 1);
		setcookie($cookie, "have", time() + 30, IN_PATH);
		echo json_encode(array("code" => "200", "msg" => "邮件码已发送至邮箱，请注意查收！"));
		exit;
	}
} elseif ($ac == "lost") {
	$mail = SafeRequest("email", "post");
	$password = SafeRequest("password", "post");
	$repassword = SafeRequest("repassword", "post");
	$pwd = substr(md5($password), 8, 16);
	$mcode = SafeRequest("code", "post");
	$uid = $GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mail='" . $mail . "'");
	if (!$uid) {
		echo json_encode(array("code" => "404", "msg" => "邮箱不存在，请更改！"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mail") . " where in_uid=" . $uid . " and in_ucode='" . $mail . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "邮件码有误，请更改！"));
		exit;
	}
	if (strlen($password) < 6) {
		echo json_encode(array("code" => "404", "msg" => "密码最小长度为 6 个字符"));
		exit;
	}
	if ($password != $repassword) {
		echo json_encode(array("code" => "404", "msg" => "两次输入的密码不一致"));
		exit;
	}
	$GLOBALS["db"]->query("delete from " . tname("mail") . " where in_id=" . $mid);
	updatetable("user", array("in_userpassword" => $pwd), array("in_userid" => $uid));
	echo json_encode(array("code" => "200", "msg" => "重置成功，请登录..."));
	exit;
} elseif ($ac == "feedback") {
	$type = SafeRequest("type", "post");
	$desc = SafeRequest("content", "post");
	$qq = SafeRequest("qq", "post");
	$upimg = SafeRequest("screenshots", "post");
	if (!$desc || !$qq) {
		echo json_encode(array("code" => "404", "msg" => "反馈内容和QQ不能为空！"));
		exit;
	}
	$setarr = array("type" => $type, "desc" => $desc, "qq" => $qq, "addtime" => date("Y-m-d H:i:s"));
	$in_id = inserttable("ticket", $setarr, 1);
	if ($in_id) {
		echo json_encode(array("code" => "200", "msg" => "提交反馈成功"));
	} else {
		echo json_encode(array("code" => "404", "msg" => "系统出错"));
	}
	exit;
} elseif ($ac == "jsonFormat") {
	$link = SafeRequest("link", "get");
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_link='" . $link . "'");
	$user = $GLOBALS["db"]->getrow("select * from " . tname("user") . " where in_userid='" . $row["in_uid"] . "'");
	$data = array();
	if (!$row || $user["in_verify"] != 1 && IN_VERIFY > 0 || ($user["in_points"] <= $row["in_deduct"] or $row["in_applimit"] >= $row["in_downloads"] && $row["in_applimit"] != 0)) {
		$data["info"] = array("template" => "error");
	} else {
		if ($row["in_applock"] == 1) {
			$template = "error";
		} else {
			$template = "tmp" . $row["template"];
		}
		if ($row["in_kid"]) {
			$support = "3";
		} else {
			if ($row["in_form"] == "iOS") {
				$support = "1";
			} elseif ($row["in_form"] == "Android") {
				$support = "2";
			}
		}
		$data["info"] = array("app_intro" => $row["in_appintro"] ? $row["in_appintro"] : $row["in_name"], "app_name" => $row["in_name"], "app_size" => formatsize($row["in_size"]), "desciption" => IN_DESCRIPTION, "downurl" => "/source/pack/upload/install/install.php?id=" . bees_encrypt($row["in_id"]), "ext" => $row["in_form"], "icon" => geticon($row["in_icon"]), "icon_300" => geticon($row["in_icon"]), "id" => bees_encrypt($row["in_id"]), "keywords" => IN_KEYWORDS, "qq" => $row["in_contact"], "qrcode_url" => getlink($row["in_id"]), "remark" => $row["in_remark"], "show_guide" => $row["in_tutorial"], "support" => $support, "template" => $template, "template_language" => $row["template_language"], "update_dt" => date("Y-m-d H:i:s", $row["in_updatetime"]), "user" => array("is_publish" => 1), "version" => $row["in_bsvs"], "version_code" => $row["in_bvs"], "web_url" => getlink($row["in_id"]));
		$data["checked"] = empty($row["in_apppwd"]) ? 1 : "";
		$data["icon"] = geticon($row["in_icon"]);
		$data["qrcode_url"] = getlink($row["in_id"]);
		$data["show_ad"] = $user["in_svip"] > 1 ? 0 : 1;
		$data["show_guide"] = $row["in_tutorial"];
	}
	echo json_encode(array("code" => "200", "data" => $data, "time" => time()));
} elseif ($ac == "adsense") {
	echo "<div class=\"row-fluid text-center\" style=\"position:fixed;bottom:0;z-index:99;width:100%;\">\n\t<div class=\"col-xs-12\">\n\t<a href=\"" . IN_ADLINK . "\" target=\"_blank\"><img style=\"display:inline-block;max-width:100%;position:fixed;bottom:0;z-index:99;margin:auto;left:0;\" src=\"" . IN_ADIMG . "\"></a>\n\t</div>\n\t</div>";
} elseif ($ac == "report") {
	$appid = bees_decrypt(SafeRequest("app_id", "post"));
	$reason = SafeRequest("type", "post");
	$note = SafeRequest("message", "post");
	$appname = SafeRequest("app_name", "post");
	$email = SafeRequest("email", "post");
	if (!$appid || !$note || !$reason || !$email) {
		echo json_encode(array("code" => "404", "msg" => "反馈内容和email不能为空！"));
		exit;
	}
	$setarr = array("appid" => $appid, "appname" => $appname, "email" => $email, "reason" => $reason, "note" => $note, "addtime" => date("Y-m-d H:i:s"));
	$in_id = inserttable("report", $setarr, 1);
	if ($in_id) {
		echo json_encode(array("code" => "200", "msg" => "提交反馈成功"));
	} else {
		echo json_encode(array("code" => "404", "msg" => "系统出错"));
	}
	exit;
}
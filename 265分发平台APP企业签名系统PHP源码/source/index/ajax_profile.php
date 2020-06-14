<?php


include "../system/db.class.php";
include "../system/user.php";
require_once "../qiniuoss/autoload.php";
use Qiniu\Auth;
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
$GLOBALS["userlogined"] or exit(json_encode(array("code" => "10001", "msg" => "请先登录后再操作！")));
$ac = SafeRequest("ac", "get");
if ($ac == "del") {
	$id = bees_decrypt(SafeRequest("id", "post"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $id);
	$row or exit(json_encode(array("code" => "404", "msg" => "版本记录不存在！")));
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "404", "msg" => "不是您的应用！")));
	$sql = "select * from " . tname("app") . " where in_uid=" . $GLOBALS["erduo_in_userid"] . " and in_appid=" . $id . " order by in_addtime desc";
	$result = $GLOBALS["db"]->query($sql)->fetchAll();
	foreach ($result as $item) {
		$GLOBALS["db"]->query("delete from " . tname("app") . " where in_id=" . $item["in_id"]);
		$GLOBALS["db"]->query("update " . tname("user") . " set in_spaceuse=in_spaceuse-" . $item["in_size"] . " where in_userid=" . $item["in_uid"]);
		$fname = str_replace(array(".ipa", ".apk", ".mobileconfig"), "", $item["in_app"]);
		if ($item["remote"] == 1) {
			$accessKey = IN_REMOTEAK;
			$secretKey = IN_REMOTESK;
			$bucket = IN_REMOTEBK;
			$auth = new Auth($accessKey, $secretKey);
			$config = new \Qiniu\Config();
			$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
			$err = $bucketManager->delete($bucket, $item["in_app"]);
			if ($err) {
			}
		} else {
			@unlink(IN_ROOT . "./data/attachment/" . $fname . ".mobileprovision");
			@unlink(IN_ROOT . "./data/attachment/" . $item["in_app"]);
		}
	}
	$GLOBALS["db"]->query("delete from " . tname("appid") . " where in_id=" . $id);
	$GLOBALS["db"]->query("delete from " . tname("salt") . " where in_aid=" . $id);
	$GLOBALS["db"]->query("delete from " . tname("signlog") . " where in_aid=" . $id);
	updatetable("appid", array("in_kid" => 0), array("in_id" => $row["in_kid"]));
	@unlink(IN_ROOT . "./data/image/app/" . $row["in_icon"]);
	echo json_encode(array("code" => "200", "msg" => "删除成功！"));
	exit;
} elseif ($ac == "setUseHistory") {
	$id = bees_decrypt(SafeRequest("id", "post"));
	$app_id = bees_decrypt(SafeRequest("app_id", "post"));
	$desc = SafeRequest("desc", "post");
	$row = $GLOBALS["db"]->getrow("select * from " . tname("app") . " where in_id='" . $id . "' and in_appid='" . $app_id . "' and in_uid=" . $GLOBALS["erduo_in_userid"]);
	$row or exit(json_encode(array("code" => "404", "msg" => "版本记录不存在！")));
	$GLOBALS["db"]->query("update " . tname("appid") . " set in_name='" . $row["in_name"] . "',in_size='" . $row["in_size"] . "',in_mnvs='" . $row["in_mnvs"] . "',in_bid='" . $row["in_bid"] . "',in_bsvs='" . $row["in_bsvs"] . "',in_bvs='" . $row["in_bvs"] . "',in_app='" . $row["in_app"] . "',in_originalName='" . $row["in_originalName"] . "',in_updatetime='" . time() . "' where in_id=" . $app_id);
	$GLOBALS["db"]->query("update " . tname("app") . " set in_release=0 where in_appid=" . $app_id);
	updatetable("app", array("in_release" => 1), array("in_id" => $id));
	echo json_encode(array("code" => "200", "msg" => "发布成功！"));
	exit;
} elseif ($ac == "delHistory") {
	$id = bees_decrypt(SafeRequest("id", "post"));
	$app_id = bees_decrypt(SafeRequest("app_id", "post"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("app") . " where in_id='" . $id . "' and in_appid='" . $app_id . "' and in_uid=" . $GLOBALS["erduo_in_userid"]);
	$row or exit(json_encode(array("code" => "404", "msg" => "版本记录不存在！")));
	$GLOBALS["db"]->query("delete from " . tname("app") . " where in_id=" . $id);
	$GLOBALS["db"]->query("update " . tname("user") . " set in_spaceuse=in_spaceuse-" . $row["in_size"] . " where in_userid=" . $row["in_uid"]);
	$fname = str_replace(array(".ipa", ".apk", ".mobileconfig"), "", $row["in_app"]);
	if ($row["remote"] == 1) {
		$accessKey = IN_REMOTEAK;
		$secretKey = IN_REMOTESK;
		$bucket = IN_REMOTEBK;
		$auth = new Auth($accessKey, $secretKey);
		$config = new \Qiniu\Config();
		$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
		$err = $bucketManager->delete($bucket, $row["in_app"]);
		if ($err) {
		}
	} else {
		@unlink(IN_ROOT . "./data/attachment/" . $fname . ".mobileprovision");
		@unlink(IN_ROOT . "./data/attachment/" . $row["in_app"]);
	}
	echo json_encode(array("code" => "200", "msg" => "删除成功！"));
	exit;
} elseif ($ac == "getHistory") {
	$id = bees_decrypt(SafeRequest("id", "get"));
	$app_id = bees_decrypt(SafeRequest("app_id", "get"));
	$row = $GLOBALS["db"]->getrow("select in_desc from " . tname("app") . " where in_id='" . $id . "' and in_appid='" . $app_id . "' and in_uid=" . $GLOBALS["erduo_in_userid"]);
	$row or exit(json_encode(array("code" => "404", "msg" => "版本记录不存在！")));
	$data = array("desc" => $row["in_desc"]);
	echo json_encode(array("code" => "200", "data" => $data));
	exit;
} elseif ($ac == "updateHistory") {
	$id = bees_decrypt(SafeRequest("id", "post"));
	$app_id = bees_decrypt(SafeRequest("app_id", "post"));
	$desc = SafeRequest("desc", "post");
	$row = $GLOBALS["db"]->getrow("select * from " . tname("app") . " where in_id='" . $id . "' and in_appid='" . $app_id . "' and in_uid=" . $GLOBALS["erduo_in_userid"]);
	$row or exit(json_encode(array("code" => "404", "msg" => "版本记录不存在！")));
	updatetable("app", array("in_desc" => $desc), array("in_id" => $id));
	echo json_encode(array("code" => "200", "msg" => "修改成功"));
	exit;
} elseif ($ac == "edit") {
	$id = bees_decrypt(SafeRequest("id", "post"));
	$link = SafeRequest("url", "post");
	$name = unescape(SafeRequest("app_name", "post"));
	$icon = SafeRequest("icon", "post");
	$tutorial = SafeRequest("show_guide", "post");
	$password = SafeRequest("password", "post");
	$limit_num = SafeRequest("limit_num", "post");
	$qq = SafeRequest("qq", "post");
	$appstore_url = SafeRequest("appstore_url", "post");
	$remark = SafeRequest("remark", "post");
	$app_intro = SafeRequest("app_intro", "post");
	$template_language = SafeRequest("template_language", "post");
	$template = SafeRequest("template", "post");
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $id);
	$row or exit(json_encode(array("code" => "-2", "msg" => "应用不存在或已被删除！")));
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "-3", "msg" => "您不能编辑别人的应用！")));
	in_array($link, array("data", "source", "static")) and exit(json_encode(array("code" => "-4", "msg" => "短链地址不规范！")));
	is_numeric($link) and exit(json_encode(array("code" => "-4", "msg" => "短链地址不能为纯数字！")));
	$one = $GLOBALS["db"]->getone("select in_id from " . tname("appid") . " where in_link='" . $link . "' and in_id<>" . $id);
	$link and $one and exit(json_encode(array("code" => "-5", "msg" => "短链地址已被占用！")));
	if (!empty($_FILES)) {
		$in_icon = stristr($row["in_icon"], "/") ? substr(strrchr($row["in_icon"], "/"), 1) : $row["in_icon"];
		$filepart = pathinfo($_FILES["icon"]["name"]);
		if (in_array(strtolower($filepart["extension"]), array("jpg", "jpeg", "gif", "png"))) {
			$file = IN_ROOT . "data/image/app/" . $in_icon;
			@move_uploaded_file($_FILES["icon"]["tmp_name"], $file);
			$GLOBALS["db"]->query("update " . tname("appid") . " set in_icon='" . $in_icon . "' where in_id=" . $id);
		}
	}
	$GLOBALS["db"]->query("update " . tname("appid") . " set in_name='" . $name . "',in_link='" . $link . "',in_tutorial='" . $tutorial . "',in_apppwd='" . $password . "',in_applimit='" . $limit_num . "',in_contact='" . $qq . "',in_appstore='" . $appstore_url . "',in_remark='" . $remark . "',in_appintro='" . $app_intro . "',template_language='" . $template_language . "',template='" . $template . "' where in_id=" . $id);
	echo json_encode(array("code" => "200", "msg" => "修改成功"));
	exit;
} elseif ($ac == "info") {
	$mobile = SafeRequest("mobile", "get");
	$qq = SafeRequest("qq", "get");
	$firm = unescape(SafeRequest("firm", "get"));
	$job = unescape(SafeRequest("job", "get"));
	updatetable("user", array("in_mobile" => $mobile, "in_qq" => $qq, "in_firm" => $firm, "in_job" => $job), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	echo "1";
} elseif ($ac == "pwd") {
	$old = substr(md5(SafeRequest("oldpassword", "post")), 8, 16);
	$new = substr(md5(SafeRequest("password", "post")), 8, 16);
	$repass = substr(md5(SafeRequest("repassword", "post")), 8, 16);
	if ($new != $repass) {
		echo json_encode(array("code" => "404", "msg" => "两次输入的密码不一致"));
		exit;
	}
	if ($old != $GLOBALS["erduo_in_userpassword"]) {
		echo json_encode(array("code" => "404", "msg" => "当前密码有误，请重试！"));
		exit;
	}
	updatetable("user", array("in_userpassword" => $new), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	echo json_encode(array("code" => "200", "msg" => "恭喜，密码修改成功！"));
	exit;
} elseif ($ac == "send_verify") {
	$mcode = SafeRequest("code", "post");
	$mail = SafeRequest("email", "post");
	$real_nick = unescape(SafeRequest("real_nick", "post"));
	$real_card = SafeRequest("real_card", "post");
	$card_front = SafeRequest("card_front", "post");
	$card_back = SafeRequest("card_back", "post");
	$card_hand = SafeRequest("card_hand", "post");
	if (!$mcode || !$real_nick || !$real_card || !$card_front || !$card_back || !$card_hand) {
		echo json_encode(array("code" => "404", "msg" => "资料填写不完整！"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mail") . " where in_uid=" . $GLOBALS["erduo_in_userid"] . " and in_ucode='" . $mail . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "邮件码有误，请更改！"));
		exit;
	}
	updatetable("user", array("in_nick" => $real_nick, "in_card" => $real_card, "in_imgzm" => $card_front, "in_imgfm" => $card_back, "in_imgsc" => $card_hand, "in_verify" => 2, "in_type" => 1), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	$title = IN_NAME . "实名认证待审核通知!";
	$body = "有新的实名认证信息需要审核<br>注册邮箱：" . $mail . "<br>姓名：" . $real_nick . "<br>提交时间：" . date("Y-m-d H:i:s");
	send_email(IN_MAIL, $title, $body);
	echo json_encode(array("code" => "200", "msg" => "提交成功！"));
	exit;
} elseif ($ac == "send_verify_qiye") {
	$real_name = unescape(SafeRequest("real_name", "post"));
	$idcard = SafeRequest("idcard", "post");
	$card_enterprise = SafeRequest("card_enterprise", "post");
	$mcode = SafeRequest("code", "post");
	$mail = SafeRequest("email", "post");
	$card_front = SafeRequest("card_front", "post");
	$card_back = SafeRequest("card_back", "post");
	$card_hand = SafeRequest("card_hand", "post");
	if (!$mcode || !$card_front || !$card_back || !$card_hand || !$real_name || !$idcard || !$card_enterprise) {
		echo json_encode(array("code" => "404", "msg" => "资料填写不完整！"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mail") . " where in_uid=" . $GLOBALS["erduo_in_userid"] . " and in_ucode='" . $mail . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "邮件码有误，请更改！"));
		exit;
	}
	updatetable("user", array("in_nameqy" => $real_name, "in_cardqy" => $idcard, "in_imgqy" => $card_enterprise, "in_imgzm" => $card_front, "in_imgfm" => $card_back, "in_imgsc" => $card_hand, "in_verify" => 2, "in_type" => 2), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	$title = IN_NAME . "实名认证待审核通知!";
	$body = "有新的实名认证信息需要审核<br>注册邮箱：" . $mail . "<br>公司名称：" . $real_name . "<br>提交时间：" . date("Y-m-d H:i:s");
	send_email(IN_MAIL, $title, $body);
	echo json_encode(array("code" => "200", "msg" => "提交成功！"));
	exit;
} elseif ($ac == "add_space") {
	$mb = intval(SafeRequest("mb", "get"));
	$mb > 0 or exit("-2");
	$points = $mb * IN_SPACEPOINTS;
	$GLOBALS["erduo_in_points"] < $points and exit("-3");
	$GLOBALS["db"]->query("update " . tname("user") . " set in_spacetotal=in_spacetotal+" . $mb * 1048576 . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
	$GLOBALS["db"]->query("update " . tname("user") . " set in_points=in_points-" . $points . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
	echo "1";
} elseif ($ac == "each_del") {
	$aid = bees_decrypt(SafeRequest("aid", "post"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $aid);
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "404", "msg" => "您不能解除别人的应用！")));
	updatetable("appid", array("in_kid" => 0), array("in_id" => $aid));
	updatetable("appid", array("in_kid" => 0), array("in_id" => $row["in_kid"]));
	echo json_encode(array("code" => "200", "msg" => "解除合并成功！"));
	exit;
} elseif ($ac == "each_add") {
	$aid = bees_decrypt(SafeRequest("aid", "post"));
	$kid = bees_decrypt(SafeRequest("kid", "post"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $aid);
	$row or exit(json_encode(array("code" => "404", "msg" => "应用不存在或已被删除！")));
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "404", "msg" => "您不能合并别人的应用！")));
	getfield("appid", "in_uid", "in_id", $kid) == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "404", "msg" => "您不能合并别人的应用！")));
	getfield("appid", "in_form", "in_id", $kid) == $row["in_form"] and exit(json_encode(array("code" => "404", "msg" => "应用平台一致，不能合并！")));
	updatetable("appid", array("in_kid" => $kid), array("in_id" => $aid));
	updatetable("appid", array("in_kid" => $aid), array("in_id" => $kid));
	echo json_encode(array("code" => "200", "msg" => "合并成功！"));
	exit;
} elseif ($ac == "high_speed") {
	$id = intval(SafeRequest("id", "get"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("app") . " where in_id=" . $id);
	$row or exit("-2");
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit("-3");
	IN_SPEEDPOINTS > 0 or exit("-4");
	$GLOBALS["erduo_in_points"] < IN_SPEEDPOINTS and exit("-5");
	$GLOBALS["db"]->query("update " . tname("user") . " set in_points=in_points-" . IN_SPEEDPOINTS . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
	updatetable("app", array("in_highspeed" => 1), array("in_id" => $id));
	echo "1";
} elseif ($ac == "remove_ad") {
	$id = intval(SafeRequest("id", "get"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("app") . " where in_id=" . $id);
	$row or exit("-2");
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit("-3");
	IN_ADPOINTS > 0 or exit("-4");
	$GLOBALS["erduo_in_points"] < IN_ADPOINTS and exit("-5");
	$GLOBALS["db"]->query("update " . tname("user") . " set in_points=in_points-" . IN_ADPOINTS . " where in_userid=" . $GLOBALS["erduo_in_userid"]);
	updatetable("app", array("in_removead" => 1), array("in_id" => $id));
	echo "1";
} elseif ($ac == "reemail") {
	$mail = SafeRequest("email", "post");
	$remail = SafeRequest("remail", "post");
	$mcode = SafeRequest("code", "post");
	if ($mail == $remail) {
		echo json_encode(array("code" => "404", "msg" => "邮箱没有变化"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mail") . " where in_uid=" . $GLOBALS["erduo_in_userid"] . " and in_ucode='" . $mail . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "邮件码有误，请更改！"));
		exit;
	}
	if (!preg_match("/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+\$/", $remail)) {
		echo json_encode(array("code" => "404", "msg" => "邮箱格式有误，请更改"));
		exit;
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mail='" . $remail . "'")) {
		echo json_encode(array("code" => "404", "msg" => "新邮箱已被占用，请更改"));
		exit;
	}
	updatetable("user", array("in_mail" => $remail), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	echo json_encode(array("code" => "200", "msg" => "恭喜，邮箱修改成功，请刷新！"));
	exit;
} elseif ($ac == "send_sms") {
	$phone = SafeRequest("phone", "post");
	$mcode = rand_code();
	$cookie = "in_send_sms";
	empty($_COOKIE[$cookie]) or exit(json_encode(array("code" => "404", "msg" => "请等待 60 秒后再重新获取")));
	$uid = $GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mobile='" . $phone . "'");
	if ($uid) {
		echo json_encode(array("code" => "404", "msg" => "新手机号已被占用，请更改"));
		exit;
	}
	$body = "您的操作验证码是：" . $mcode . "，为了保证您的账户安全,请勿向任何人提供此验证码。";
	$re = send_sms($phone, $body);
	if (!$re) {
		echo json_encode(array("code" => "404", "msg" => "抱歉，验证码未能发送成功！"));
		exit;
	} else {
		$setarr = array("in_mobile" => $phone, "in_code" => $mcode, "in_ip" => getonlineip(), "in_addtime" => date("Y-m-d H:i:s"));
		inserttable("mobile", $setarr, 1);
		setcookie($cookie, "have", time() + 30, IN_PATH);
		echo json_encode(array("code" => "200", "msg" => "验证码发送成功，请注意查收！"));
		exit;
	}
} elseif ($ac == "rephone") {
	$password = SafeRequest("password", "post");
	$pwd = substr(md5($password), 8, 16);
	$phone = SafeRequest("phone", "post");
	$mcode = SafeRequest("code", "post");
	if ($pwd != $GLOBALS["erduo_in_userpassword"]) {
		echo json_encode(array("code" => "404", "msg" => "当前密码有误，请重试！"));
		exit;
	}
	if ($GLOBALS["erduo_in_mobile"] == $phone) {
		echo json_encode(array("code" => "404", "msg" => "手机号没有变化"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mobile") . " where in_mobile=" . $phone . " and in_code='" . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "验证码有误，请更改！"));
		exit;
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mobile='" . $phone . "'")) {
		echo json_encode(array("code" => "404", "msg" => "手机号已被占用，请更改"));
		exit;
	}
	updatetable("user", array("in_mobile" => $phone), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	echo json_encode(array("code" => "200", "msg" => "恭喜，手机号修改成功，请刷新！"));
	exit;
} elseif ($ac == "bind_mobile") {
	$phone = SafeRequest("phone", "post");
	$mcode = SafeRequest("code", "post");
	if ($GLOBALS["erduo_in_mobile"] == $phone) {
		echo json_encode(array("code" => "404", "msg" => "手机号没有变化"));
		exit;
	}
	$mid = $GLOBALS["db"]->getone("select in_id from " . tname("mobile") . " where in_mobile=" . $phone . " and in_code='" . $mcode . "'");
	if (!$mid) {
		echo json_encode(array("code" => "404", "msg" => "验证码有误，请更改！"));
		exit;
	}
	if ($GLOBALS["db"]->getone("select in_userid from " . tname("user") . " where in_mobile='" . $phone . "'")) {
		echo json_encode(array("code" => "404", "msg" => "手机号已被占用，请更改"));
		exit;
	}
	updatetable("user", array("in_mobile" => $phone), array("in_userid" => $GLOBALS["erduo_in_userid"]));
	echo json_encode(array("code" => "200", "msg" => "手机号绑定成功！"));
	exit;
} elseif ($ac == "cleanStatistics") {
	$id = bees_decrypt(SafeRequest("appId", "post"));
	$row = $GLOBALS["db"]->getrow("select * from " . tname("appid") . " where in_id=" . $id);
	$row["in_uid"] == $GLOBALS["erduo_in_userid"] or exit(json_encode(array("code" => "404", "msg" => "您不能操作别人的应用！")));
	$GLOBALS["db"]->query("delete from " . tname("downhistory") . " where appid='" . $id . "' and uid=" . $row["in_uid"]);
	echo json_encode(array("code" => "200", "msg" => "已清空下载记录！"));
	exit;
} elseif ($ac == "imageBase64") {
	$file_data = SafeRequest("content", "post");
	$prefix = SafeRequest("prefix", "post");
	if (preg_match("/^(data:\\s*image\\/(\\w+);base64,)/", $file_data, $result)) {
		$img_base64 = str_replace($result[1], "", $file_data);
		$img_base64 = base64_decode($img_base64);
		$fileext = $result[2];
		if (in_array(strtolower($fileext), array("pjpeg", "jpeg", "jpg", "gif", "bmp", "png"))) {
			$filename = date("dHis") . rand(2, pow(2, 24)) . "." . $fileext;
			$basedir = IN_ROOT . "data/image/" . $prefix;
			$imgdir = date("Y") . "/" . date("m") . "/" . date("d");
			creatdir($basedir . "/" . $imgdir);
			$filepath = $basedir . "/" . $imgdir . "/" . $filename;
			try {
				file_put_contents($filepath, $img_base64);
				$img_path = IN_PATH . "data/image/" . $prefix . "/" . $imgdir . "/" . $filename;
				$data = array("domain" => $_SERVER["HTTP_HOST"], "key" => $img_path);
				echo json_encode(array("code" => "200", "data" => $data, "time" => time()));
				exit;
			} catch (Exception $e) {
				exit(json_encode(array("code" => "404", "msg" => "上传出错！")));
			}
		}
	}
	exit(json_encode(array("code" => "404", "msg" => "上传出错！")));
} elseif ($ac == "discount") {
	$service_id = SafeRequest("id", "get");
	switch ($service_id) {
		case "1003":
			$id = 1;
			$price = IN_BEESCOINONE;
			break 1;
		case "1004":
			$id = 2;
			$price = IN_BEESCOINTWOX;
			break 1;
		case "1005":
			$id = 3;
			$price = IN_BEESCOINTHREEX;
			break 1;
		case "1006":
			$id = 4;
			$price = IN_BEESCOINP;
			break 1;
		case "1007":
			$id = 5;
			$price = IN_BEESCOINI;
			break 1;
		case "1008":
			$id = 6;
			$price = IN_BEESCOINS;
			break 1;
		case "1009":
			$id = 7;
			$price = IN_FOUNDATION;
			break 1;
		case "1010":
			$id = 8;
			$price = IN_BASEQUARTER;
			break 1;
		case "1011":
			$id = 9;
			$price = IN_BASICANNUAL;
			break 1;
	}
	$data = array("money" => $price);
	$data["discount"] = array("id" => $id, "price" => $price, "quantity" => 1, "service_id" => $service_id);
	$data["html"] = "<li class=\"clearfix active\" ><span class=\"icon icon-radio fl\"></span><span>1个</span><input type=\"hidden\" name=\"price\" value=\"" . $price . ".00\"><input type=\"hidden\" name=\"discount_id\" value=\"" . $id . "\"></li>";
	echo json_encode(array("code" => "200", "data" => $data));
	exit;
} elseif ($ac == "pay") {
	$discount_id = SafeRequest("discount_id", "post");
	$pay_channel = SafeRequest("pay_channel", "post");
	$sign_id = bees_decrypt(SafeRequest("sign_id", "post"));
	if (!$discount_id || !$pay_channel) {
		exit(json_encode(array("code" => "404", "msg" => "参数错误！")));
	}
	$pay_id = create_order_no($erduo_in_userid);
	if ($discount_id == 1) {
		$points = intval(IN_RMBPOINTS * IN_BEESCOINONE);
		$price = IN_BEESCOINONE;
		$pay_param = 1;
	} elseif ($discount_id == 2) {
		$points = intval(IN_RMBPOINTS * IN_BEESCOINTWOY);
		$price = IN_BEESCOINTWOX;
		$pay_param = 1;
	} elseif ($discount_id == 3) {
		$points = intval(IN_RMBPOINTS * IN_BEESCOINTHREEY);
		$price = IN_BEESCOINTHREEX;
		$pay_param = 1;
	} elseif ($discount_id == 4) {
		$points = 1;
		$tag = "初级会员";
		$pay_param = 2;
		$price = IN_BEESCOINP;
	} elseif ($discount_id == 5) {
		$points = 2;
		$tag = "中级会员";
		$pay_param = 2;
		$price = IN_BEESCOINI;
	} elseif ($discount_id == 6) {
		$points = 3;
		$tag = "高级会员";
		$pay_param = 2;
		$price = IN_BEESCOINS;
	} elseif ($discount_id == 7) {
		$points = 1;
		$tag = $sign_id . "-包月签名";
		$pay_param = 3;
		$price = IN_FOUNDATION;
	} elseif ($discount_id == 8) {
		$points = 3;
		$tag = $sign_id . "-包季签名";
		$pay_param = 3;
		$price = IN_BASEQUARTER;
	} elseif ($discount_id == 9) {
		$points = 12;
		$tag = $sign_id . "-包年签名";
		$pay_param = 3;
		$price = IN_BASICANNUAL;
	}
	$pay_type = $pay_channel == "alipay" ? 1 : 2;
	$pay_tag = $discount_id < 4 ? "购买" . $points . "云币" : $tag;
	$setarr = array("in_uid" => $erduo_in_userid, "in_uname" => $erduo_in_username, "pay_id" => $pay_id, "pay_tag" => $pay_tag, "pay_points" => $points, "pay_money" => $price, "pay_type" => $pay_type, "pay_param" => $pay_param, "pay_status" => 1, "creat_time" => time());
	inserttable("paylog", $setarr);
	$url = "/index.php/to-pay?trade_id=" . $pay_id . "&channel=" . $pay_channel;
	$data = array("trade_id" => $pay_id, "channel" => $pay_channel, "url" => $url);
	echo json_encode(array("code" => "200", "data" => $data, "time" => time()));
	exit;
}
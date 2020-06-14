function upload_a_icon() {
    var upfile = $("#upload_a_icon")[0].files[0];
    if (in_login < 1) {
        alert("请先登录");
        return false;
    }
    if (upfile.size > 1048576) {
        alert("图标不能大于1M");
        return false;
    }
    var fd = new FormData();
    fd.append("webview", upfile);
    var a_icon_xhr = new XMLHttpRequest();
    a_icon_xhr.open("post", in_path + "source/pack/webview/ajax.php");
    a_icon_xhr.onload = complete_a_icon;
    a_icon_xhr.onerror = failed_a_icon;
    a_icon_xhr.upload.onprogress = progress_a_icon;
    a_icon_xhr.send(fd);
}
function progress_a_icon(evt) {
    var per = Math.round(evt.loaded / evt.total * 100);
    $("#tips_a_icon").text(per + "%");
    if (per > 99) {
        $("#tips_a_icon").text("请稍等...");
    }
}
function complete_a_icon(evt) {
    var response = evt.target.responseText;
    if (response == "return_0") {
        alert("文件不规范");
    } else {
        $("#preview_a_icon").html('<img width="100" height="100" src="' + in_path + "data/tmp/" + response + '">');
    }
}
function failed_a_icon() {
    alert("上传异常");
}
function upload_l_image() {
    var upfile = $("#upload_l_image")[0].files[0];
    if (in_login < 1) {
        alert("请先登录");
        return false;
    }
    if (upfile.size > 2097152) {
        alert("图片不能大于2M");
        return false;
    }
    var fd = new FormData();
    fd.append("webview", upfile);
    var l_image_xhr = new XMLHttpRequest();
    l_image_xhr.open("post", in_path + "source/pack/webview/ajax.php");
    l_image_xhr.onload = complete_l_image;
    l_image_xhr.onerror = failed_l_image;
    l_image_xhr.upload.onprogress = progress_l_image;
    l_image_xhr.send(fd);
}
function progress_l_image(evt) {
    var per = Math.round(evt.loaded / evt.total * 100);
    $("#tips_l_image").text(per + "%");
    if (per > 99) {
        $("#tips_l_image").text("请稍等...");
    }
}
function complete_l_image(evt) {
    var response = evt.target.responseText;
    if (response == "return_0") {
        alert("文件不规范");
    } else {
        $("#preview_l_image").html('<img width="200" height="200" src="' + in_path + "data/tmp/" + response + '">');
    }
}
function failed_l_image() {
    alert("上传异常");
}
function web_view() {
    var xhr = new XMLHttpRequest();
    if (in_login < 1) {
        alert("请先登录后再操作！");
        return;
    }
    if ($("#in_title").val() == "") {
        $("#in_title").focus();
        return;
    }
    if ($("#in_url").val() == "") {
        $("#in_url").focus();
        return;
    }
    if ($("#in_b_color").val() == "") {
        $("#in_b_color").focus();
        return;
    }
    if ($("#in_t_color").val() == "") {
        $("#in_t_color").focus();
        return;
    }
    if ($("#preview_a_icon img").length < 1) {
        alert("请上传应用图标！");
        return;
    }
    if ($("#preview_l_image img").length < 1) {
        alert("请上传启动图片！");
        return;
    }
    $(".ng-binding").attr("disabled", "disabled").text("生成中...");
    xhr.open("GET", in_path + "source/pack/webview/ajax.php?ac=webview&title=" + escape($("#in_title").val()) + "&url=" + $("#in_url").val() + "&bcolor=" + $("#in_b_color").val() + "&tcolor=" + $("#in_t_color").val()+"&bid=" + $("#in_bid").val() + "&aicon=" + $("#preview_a_icon img")[0].src + "&limage=" + $("#preview_l_image img")[0].src, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if (xhr.responseText == "return_0") {
                    $(".ng-binding").text("请先登录");
                } else if (xhr.responseText == "return_1") {
                    $(".ng-binding").text("点数不足");
                } else {
                    $(".ng-binding").text("上传中...");
                    ReturnValue(xhr.responseText,$("#in_title").val());
                }
            } else {
                $(".ng-binding").text("通讯异常");
            }
        }
    };
    xhr.send(null);
}
function ReturnValue(response,appname) {
	data={
		id:0,
		time:response,
		filename:appname+'.ipa'
	};
	$.post(in_path + "source/pack/upload/index-ipa.php", data, function (result) {
		if (result == -1) {
			alert("请先登录后再操作！");
		} else if (result == -2 || result == -5) {
			alert("Access denied");
		} else if (result == -3) {
			alert("未进行实名认证或认证审核中！");
		} else if (result == -4) {
			alert("应用容量不足！");
		} else{
			location.href = in_path + "index.php/apps";
		}
	})
}
<?php


$GLOBALS["�ڝ�瘋"] = "defined";
if (!defined("IN_ROOT")) {
	exit("Access denied");
}
?><link rel="stylesheet" href="/static/default/css/fineuploader.css"/>
<div class="release-app-wrap">
	<div class="container">
		<div class="release-app2 ">
			<div class="crumbs">
				<a href="/index.php/apps">我的应用</a><span>/</span>上传应用
			</div>
			<div class="row clearfix">
				<div class="col-sm-2">
					<aside class="aside-left">
					<ul>
						<li class="active"><a href="/index.php/publish"><span class="iconfont icon-upload1"></span>上传应用</a>
						</li>
						<li><a href="/index.php/apps"><span class="iconfont icon-41"></span>应用列表</a></li>
					</ul>
					</aside>
				</div>
				<div class="col-sm-10">
					<div class="aside-right">
						<div class="release-app">
							<div class="upload-file">
								<div class="row tag-box tag-box-v5" id="container" style="height: 450px !important;">
									<div class="span12">
										<div id="bootstrapped-fine-uploader">
										</div>
										<div class="qq-uploader-selector qq-uploader span12">
											<div id="upprocess" style="display: none;">
												<span class="qq-drop-processing-selector qq-drop-processing">
												<span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
												</span>
												<div class="upload-app-icon" id="loading">
													<img src="<?php echo IN_PATH;?>static/default/img/loadicon.png">
												</div>
												<div class="loadend">
												</div>
												<ul class="qq-upload-list-selector qq-upload-list">
													<li>
													<div style="margin-bottom:20px;">
														<span id="upload-app-name">正在解析...</span>
													</div>
													<div style="margin-bottom:20px;">
														正在上传中，请不要关闭浏览器
													</div>
													<div class="qq-progress-bar-container-selector progress progress-striped active">
														<div class="qq-progress-bar-selector progress-bar progress-bar-warning" role="progressbar">
														</div>
													</div>
													<span class="qq-upload-spinner-selector qq-upload-spinner alreadyup" style="width: auto;font-size: 14px"></span>
													<span class="qq-upload-file-selector qq-upload-file"></span>
													<span class="qq-upload-size-selector qq-upload-size tolsize" style="width: auto;font-size: 14px"></span>
													<br/>
													<br/>
													<a class="qq-upload-cancel-selector btn-u btn-u-default ms-btn ms-btn-default" href="javascript:;" id="changest">暂停上传</a>
													<span class="qq-upload-status-text-selector qq-upload-status-text"></span>
													<div id="retry" style="display:none; margin-top:20px;">
														<a class="btn-u btn-u-default" href="javascript:void(0);" onclick="javascript:retry();">重新上传</a>
													</div>
													</li>
												</ul>
											</div>
											<div class="col-md-12">
												<div class="qq-upload-button-selector" style="width: auto;" id="upbtn">
													<div>
														<button class="ms-btn ms-btn-primary upload-btn" id="uploadstart" style="width: 240px; padding: 0; height: 60px; font-size: 18px; line-height: 58px;">
														<span class="iconfont icon-upload"></span>
														<span class="text">立即上传</span>
														</button>
													</div>
													<div style="margin-top:20px;">
													</div>
														点击按钮选择应用的安装包，或拖拽文件到此区域
													<br/>
														（支持.ipa或.apk文件，单个文件最大支持
													<span style="color:red;font-size: 14px">
														<?php echo $GLOBALS["erduo_in_filesize"] > 0 ? $GLOBALS["erduo_in_filesize"] / 1048576 : 0;?>M
													</span>）
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="warn-prompt-wrap clearfix">
				<dl class="clearfix fr warn-prompt-1">
					<dt class="fl">提示：</dt>
					<dd>请您确认上传的APP，符合《<a href="/index.php/about/specification" target="_blank" class="color-hover"><?php echo IN_NAME;?>应用审核规范</a>》，如违反规范，APP将做删除处理，屡次上传将被封禁账号。
					<br/>根据最新审核规范，不接受如下APP上传本平台：色情类、直播类、金融类、区块链虚拟币等。如已上传，将做删除处理。
					</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/static/default/js/publish/plupload.full.min.js"></script>
<script type="text/javascript" src="/static/default/js/publish/qiniu.min.js"></script>
<script type="text/javascript" src="/static/default/js/publish/app-info-parser.min.js"></script>
<script type="text/javascript" src="/static/default/js/publish/parse.min.js"></script>
<script>
	var allowsize          = <?php echo $GLOBALS["erduo_in_spacetotal"] - $GLOBALS["erduo_in_spaceuse"];?>; //存储空间剩余
    var singlesize         = <?php echo $GLOBALS["erduo_in_filesize"];?>; //单文件上传限制
    var iLocalId           = "<?php echo $id;?>";  //更新应用ID
	var mandatory          = <?php echo IN_VERIFY;?>;  //强制认证状态
	var certification      = <?php echo $GLOBALS["erduo_in_verify"];?>;  //实名认证状态
	let bundleId           = "<?php echo $in_bid;?>";  //更新应用包名
    let ext                = "<?php echo $ext;?>";  //更新应用类型
    let parser             = new packageParser();
    parser.init({
		qndomain: "<?php echo IN_REMOTEDK;?>",
        upload: "/source/qiniuoss/saveInfo.php",
        autoClickUploadStart: iLocalId, //应用id更新
        postField: {iLocalId: iLocalId},
        parseCallback: function (file, appInfo) {
            if (file.size > singlesize) {
				throw new Error("单文件大小，超过" + Math.floor((singlesize / 1024 / 1024) * 100) / 100 + "MB，请开通或升级会员。");
            } else {
                if (file.size > allowsize) {
                    throw new Error('应用空间容量不足，请开通或升级会员。');
                }
			}			
            if (iLocalId && (bundleId != appInfo.packageName || ext != appInfo.ext)) {
                throw new Error('不是同一个应用无法更新');
            }
            if (mandatory == 1 && certification != 1) {
                throw new Error('未进行实名认证或认证审核中');
            }			
        },
        saveCallback: function (data) {
            if (data.code == 200) {
                window.location.href = "/index.php/publish_success?id=" + data.appid;
            } else {
                if (data.msg) {
                    Modal.determineModal({
                        iconClass: "icon-modal-error2",  // success: icon-modal-success1,  error: icon-modal-error2
                        title: data.msg,
                        p: '',
                        align: 'left',
                        btnText: '确定'
                    });
                } else {
                    alert('上传文件失败,请稍后重试');
                }
            }
        },
    });
</script>
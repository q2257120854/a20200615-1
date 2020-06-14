<div class="modal inmodal fade in" id="selApp" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header task-sel-app-modal-header">
				<h4 class="modal-title">选择 App</h4>
			</div>
			<form id="selForm" novalidate="novalidate">
				<input id="appid" name="appid" value="20802" type="hidden">
				<input id="mType" name="mType" value="ipa" type="hidden">
				<div class="modal-body task-sel-app-modal-body">
					<div class="panel-body">
						<div class="tab-content" style="border: 0">
							<div id="tab-1" class="tab-pane active" mtype="app">
								<div class="row" style="height:340px; overflow-y:auto;overflow-x:hidden">
									<div class="wrapper wrapper-content" style="padding-bottom:0px;">
										<div id="loading" style="display: none;">
											<div class="sk-spinner sk-spinner-wandering-cubes">
												<div class="sk-cube1">
												</div>
												<div class="sk-cube2">
												</div>
											</div>
										</div>
										<div class="row" id="appContainer">
										</div>
									</div>
								</div>
								<input id="mAKey" name="mAKey" value="" type="hidden">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p style="float:left;padding-top:10px;padding-left:10px;">
					合并后的两个应用，进入任一个应用的单页，扫描二维码，会根据你的手机系统自动帮你下载相应的版本。</p>
					<button class="btn btn-info" data-dismiss="modal" href="javascript:void(0)">取消</button>
					<button type="button" id="btnMerge" class="btn btn-success">合并应用</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal inmodal fade in" id="cancel_dialog" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header task-sel-app-modal-header">
				<h4 class="modal-title">解除合并</h4>
			</div>
			<div class="modal-body task-sel-app-modal-body">
				<div class="panel-body">
					<div id="cancel_container">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-info" data-dismiss="modal" href="javascript:void(0)" onclick="$('#myModal').modal('hide');">取消</button>
				<button type="button" id="btnCancel" class="btn btn-warning">取消合并</button>
			</div>
		</div>
	</div>
</div>

<script>
    $('.cancel_merge').click(function (event) {
		event.preventDefault();
        var id = $(this).attr('app_id');
        $.get('/index.php/apps_cancelMerge?id=' + id, function (html) {
            $('#btnCancel').unbind();
            $('#cancel_container').html(html);
            $('#cancel_dialog').modal('show');
            $('#btnCancel').click(function () {
                $.post('/source/index/ajax_profile.php?ac=each_del', {aid: id}, function (data) {
                    if (data.code == 200) {
                        $('#cancel_dialog').modal('hide');
                        alert(data.msg, function () {
                            window.location.reload();
                        });
                        return true;
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
                return true;
            });
        });
    });

    $('.btn-success').click(function (e) {
		e.preventDefault();	
        var id = $(this).attr('app_id');
        $.get('/index.php/apps_merge?id=' + id, function (html) {
            $("#btnMerge").unbind();
            $('#appContainer').html(html);
            $('#appContainer .ibox').click(function () {
                $('#appContainer .ibox .caption').each(function () {
                    $(this).hide();
                })
                $(this).find('.caption').show();
            });
            $('#selApp').modal('show');

            $('#btnMerge').click(function () {
                var kid = $("#appContainer .ibox .caption:visible").find('input').val();
                if (!kid) {
                    alert('请选择要合并的应用');
                    return false;
                }
                $.post('/source/index/ajax_profile.php?ac=each_add', {aid: id, kid: kid}, function (data) {
                    if (data.code == 200) {
                        $('#selApp').modal('hide');
                        alert(data.msg, function () {
                            window.location.reload();
                        });
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            });
        });
    });
</script>
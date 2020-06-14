/**
 * 弹框
 * @param _title 标题
 * @param _width 宽度
 * @param _height 高度
 * @returns artDialog对象
 */
function Dialog(_title,_width,_height,_id) {
	_id == undefined || _id == null ? "Dialog" : _id;
	try {
		var dialog = $.dialog({
			title:_title,
			width:_width,
			height:_height,
			id:_id,
			zIndex:2,
			lock:true,
			opacity:0.1,
			fixed:true
		});
		return dialog;
	} catch (e) {
		return $.dialog({title:"弹框"});
	}
}
/**
 * 关闭artDialog
 * @param dialog_id dialog id
 */
function closeDialog(dialog_id) {
	try {
		$.dialog.list[dialog_id].close();
	} catch (e) {
		$.dialog.list['Dialog'].close();
	}
}
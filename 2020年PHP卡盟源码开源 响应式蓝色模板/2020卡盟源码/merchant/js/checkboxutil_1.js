//jQuery函数
jQuery.extend({
	/**
	 * 全选
	 * @param checkBoxName 传入checkbox的名称 根据名称全选
	 */
	checkAll:function(checkBoxName){
		var ckas = $("input[type=checkbox][name='"+checkBoxName+"']");
		ckas.each(function(i){
			this.checked = true;
		});
	},
	/**
	 * 反选
	 * @param checkBoxName 传入checkbox的名称 根据名称反选
	 */
	inversCheck:function(checkBoxName){
		var coxs = $("input[type=checkbox][name='"+checkBoxName+"']");
		coxs.each(function(i) {
			this.checked = !this.checked;
		});
	},
	/**
	 * 执行批量操作时  获取选中的所有checkBox的value值
	 * @param checkBoxName 传入checkbox name
	 * @returns 返回拼接的值 比如：1,2,3,4
	 */
	getDelIds:function(checkBoxName){
		//获取选中的checkbox
		var vals = $("input[type=checkbox][name='"+checkBoxName+"']:checked");
		//保存选中checkbox的value
		var values="";
		//遍历并且添加到values数组内
		$.each(vals,function(i){
					values += $(vals[i]).val()
							+ (((i + 1) == vals.length) ? "" : ",");
		});
		return values;
	},
	getDelIdss:function(checkBoxName){
		//获取选中的checkbox
		var vals = $("input[type=checkbox][name='"+checkBoxName+"']:checked");
		//保存选中checkbox的value
		var values="";
		//遍历并且添加到values数组内
		$.each(vals,function(i){
					values += $(vals[i]).attr("id")+(((i + 1) == vals.length) ? "" : ",");
		});
		return values;
	},
	/**
	 * 判断是否有选中
	 * @param checkBoxName 传入checkBoxName根据name去判断是否选中
	 * @returns {Boolean}
	 */
	isChecked:function(checkBoxName){
		var coxs = $("input[type=checkbox][name='"+checkBoxName+"']:checked").length;
		if(coxs <= 0){
			alert("请选择指定行后操作！");
			return false;
		}
		return true;
	},
	getAllId:function(checkBoxName){
		var vals = $("input[type=checkbox][name='"+checkBoxName+"']");
		var values="";
		vals.each(function(i){
			values += $(vals[i]).val()
				+ (((i + 1) == vals.length) ? "" : ",");
		});
		return values;
	}
});
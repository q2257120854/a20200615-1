jQuery.extend({
	checkAll : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']");
		b.each(function(c) {
			this.checked = true
		})
	},
	checkAll2017 : function(a,t) {
		var chk = t.attr("class");
		if ("selected"!=chk) {
			t.attr("class","selected");
		}else{
			t.attr("class","");
		}
		
		var b = $("input[type=checkbox][name='" + a + "']");
		b.each(function(c) {
			this.checked = true
		});
	},
	inversCheck : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']");
		b.each(function(c) {
			this.checked = !this.checked
		})
	},
	inversCheck2017 : function(a,t) {
		var chk = t.attr("class");
		if ("selected"!=chk) {
			t.attr("class","selected");
		}else{
			t.attr("class","");
		}
		
		var b = $("input[type=checkbox][name='" + a + "']");
		b.each(function(c) {
			this.checked = !this.checked;
		});
	},
	getDelIds : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']:checked");
		var c = "";
		$.each(b, function(d) {
			c += $(b[d]).val() + (((d + 1) == b.length) ? "" : ",")
		});
		return c
	},
	getDelIdss : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']:checked");
		var c = "";
		$.each(b, function(d) {
			c += $(b[d]).attr("id") + (((d + 1) == b.length) ? "" : ",")
		});
		return c
	},
	getDelIdsNoCheck : function(a) {
		var b = $("input[name='" + a + "']");
		var c = "";
		$.each(b, function(d) {
			c += $(b[d]).attr("alt") + (((d + 1) == b.length) ? "" : ",")
		});
		return c
	},
	getalts : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']:checked");
		var c = "";
		$.each(b, function(d) {
			c += $(b[d]).attr("alt") + (((d + 1) == b.length) ? "" : ",")
		});
		return c
	},
	isChecked : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']:checked").length;
		if (b <= 0) {
			alert("请选择指定行后操作！");
			return false
		}
		return true
	},
	getAllId : function(a) {
		var b = $("input[type=checkbox][name='" + a + "']");
		var c = "";
		b.each(function(d) {
			c += $(b[d]).val() + (((d + 1) == b.length) ? "" : ",")
		});
		return c
	}
});
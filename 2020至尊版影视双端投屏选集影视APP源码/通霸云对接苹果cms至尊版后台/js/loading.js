$(function() {
	var Loading = {
		interface : '#loaidng',
		options : {
			times : {
				show : 10,
				hide : 1000
			}
		},
		init : function(options) {
			if (arguments.length) {
				this.initOptions(this.options, options);
			}
			return this;
		},
		initOptions : function(_defaults, _options) {
			var self = this;
			for ( var i in _defaults) {
				for ( var key in _options) {
					if (i == key) {
						if (typeof (_defaults[i]) == 'object') {
							self.initOptions(_defaults[i], _options[key]);
						} else {
							_defaults[i] = _options[key];
						}
					}
				}
			}
		},
		beforShow : function(callback) {
			this.show(callback);
		},
		show : function(callback) {
			var self = this;
			$(self.interface).fadeIn(self.options.times.show, callback);
		},
		afterShow : function(callback) {
			callback();
		},
		beforHide : function(callback) {
			callback();
		},
		hide : function(callback) {
			var self = this;
			$(self.interface).fadeOut(self.options.times.hide, callback);
		},
		afterHide : function(callback) {
			callback();
		}
	};
	window.ylframe.modules.Loading = Loading;
});
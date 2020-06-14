(function(doc, win) {
	var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function() {
			var clientWidth = docEl.clientWidth;
			if(!clientWidth)
				return;
			var fontSize = 100 * (clientWidth / 750);
			if(fontSize > 80) {
				fontSize = 80;
			}
			docEl.style.fontSize = fontSize + 'px';
		};
	if(!doc.addEventListener)
		return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
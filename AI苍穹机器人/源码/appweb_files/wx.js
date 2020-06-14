var is_weixin = (function(){return navigator.userAgent.toLowerCase().indexOf('micromessenger') !== -1})();
window.onload = function() {
	var winHeight = typeof window.innerHeight != 'undefined' ? window.innerHeight : document.documentElement.clientHeight; //兼容IOS，不需要的可以去掉
	var btn = document.getElementById('J_weixin');
	var tip = document.getElementById('weixin-tip');
	var close = document.getElementById('close');
	if (is_weixin) {
		btn.onclick = function(e) {
			tip.style.height = winHeight + 'px'; //兼容IOS弹窗整屏
			tip.style.display = 'block';
			return false;
		}
		close.onclick = function() {
			tip.style.display = 'none';
		}
	}
}


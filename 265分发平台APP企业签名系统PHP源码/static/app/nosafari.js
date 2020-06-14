//本脚本解决点击后跳出safari的问题
(function(){	
	if ("standalone" in window.navigator && window.navigator.standalone) {
		var d, l = false;
		document.addEventListener("click", function(i) {
			d = i.target;
			while (d.nodeName !== "A" && d.nodeName !== "HTML") d = d.parentNode;
			if ("href" in d && d.href.indexOf("http") !== -1 && (d.href.indexOf(document.location.host) !== -1 || l)) {
				i.preventDefault();
				document.location.href = d.href
			}
		}, false)
	}
}());
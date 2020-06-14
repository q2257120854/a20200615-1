/**
 * Created by Administrator on 2017/6/20.
 */
    //rem的计算方法
!(function (g, dom, size) {
    var tid = null;
    var refreshRem = function() {
        var iScreen = dom.documentElement.clientWidth;
        if (iScreen > size) iScreen = size;

        dom.documentElement.style.fontSize = iScreen / size * 100 + 'px';
    };

    g.addEventListener('resize', function() {
        clearTimeout(tid);
        tid = setTimeout(refreshRem, 300);
    }, false);

    g.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            clearTimeout(tid);
            tid = setTimeout(refreshRem, 300);
        }
    }, false);

    refreshRem();

})(window, document, 750);

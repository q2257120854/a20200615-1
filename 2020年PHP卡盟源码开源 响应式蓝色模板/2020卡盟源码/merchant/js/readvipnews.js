if (typeof (vipnewslist) != "undefined") {
    var maxNum = vipnewslist.length > 8 ? 8 : vipnewslist.length;
    for (var i = 0; i < maxNum; i++) {
        document.writeln("<li title='" + vipnewslist[i].AnnTitle + "'><span class='date'>" + vipnewslist[i].AnnTime + "</span><a  target='_blank' style='color: " + vipnewslist[i].TitleType + "' href='" + vipnewslist[i].AnnUrl + "'>" + vipnewslist[i].AnnTitle + "</a></li>");
    }
}
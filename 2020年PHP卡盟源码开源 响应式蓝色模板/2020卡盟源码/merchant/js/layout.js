// jQuery tree plugin
$.fn.tree = function (settings) {
    var o = $.extend({
        expanded: ''
    }, settings);

    return $(this).each(function () {
        if (!$(this).parents('.tree').length) {
            //save reference to tree UL
            var tree = $(this);

            //add the role and default state attributes
            if (!$('body').is('[role]')) { $('body').attr('role', 'application'); }
            //add role and class of tree
            tree.attr({ 'role': 'tree' }).addClass('tree');
            //set first node's tabindex to 0
            tree.find('a:eq(0)').attr('tabindex', '0');
            //set all others to -1
            tree.find('a:gt(0)').attr('tabindex', '-1');
            //add group role and tree-group-collapsed class to all ul children
            tree.find('ul').attr('role', 'group').addClass('tree-group-collapsed');
            //add treeitem role to all li children
            tree.find('li').attr('role', 'treeitem');
            //find tree group parents
            tree.find('li:has(ul)')
				.attr('aria-expanded', 'false')
				.find('>a')
				.addClass('tree-parent tree-parent-collapsed');

            //expanded at load		
            tree
			.find(o.expanded)
			.attr('aria-expanded', 'true')
				.find('>a')
				.removeClass('tree-parent-collapsed')
				.next()
				.removeClass('tree-group-collapsed');


            //bind the custom events
            tree
            //expand a tree node
			.bind('expand', function (event) {
			    var target = $(event.target) || tree.find('a[tabindex=0]');
			    target.removeClass('tree-parent-collapsed');
			    target.next().hide().removeClass('tree-group-collapsed').slideDown(150, function () {
			        $(this).removeAttr('style');
			        target.parent().attr('aria-expanded', 'true');
			    });
			})
            //collapse a tree node
			.bind('collapse', function (event) {
			    var target = $(event.target) || tree.find('a[tabindex=0]');
			    target.addClass('tree-parent-collapsed');
			    target.next().slideUp(150, function () {
			        target.parent().attr('aria-expanded', 'false');
			        $(this).addClass('tree-group-collapsed').removeAttr('style');
			    });
			})
			.bind('toggle', function (event) {
			    var target = $(event.target) || tree.find('a[tabindex=0]');
			    //check if target parent LI is collapsed
			    if (target.parent().is('[aria-expanded=false]')) {
			        //call expand function on the target
			        target.trigger('expand');
			    }
			        //otherwise, parent must be expanded
			    else {
			        //collapse the target
			        target.trigger('collapse');
			    }
			})
            //shift focus down one item		
			.bind('traverseDown', function (event) {
			    var target = $(event.target) || tree.find('a[tabindex=0]');
			    var targetLi = target.parent();
			    if (targetLi.is('[aria-expanded=true]')) {
			        target.next().find('a').eq(0).focus();
			    }
			    else if (targetLi.next().length) {
			        targetLi.next().find('a').eq(0).focus();
			    }
			    else {
			        targetLi.parents('li').next().find('a').eq(0).focus();
			    }
			})
            //shift focus up one item
			.bind('traverseUp', function (event) {
			    var target = $(event.target) || tree.find('a[tabindex=0]');
			    var targetLi = target.parent();
			    if (targetLi.prev().length) {
			        if (targetLi.prev().is('[aria-expanded=true]')) {
			            targetLi.prev().find('li:visible:last a').eq(0).focus();
			        }
			        else {
			            targetLi.prev().find('a').eq(0).focus();
			        }
			    }
			    else {
			        targetLi.parents('li:eq(0)').find('a').eq(0).focus();
			    }
			});


            //and now for the native events
            tree
			.focus(function (event) {
			    //deactivate previously active tree node, if one exists
			    tree.find('[tabindex=0]').attr('tabindex', '-1').removeClass('tree-item-active');
			    //assign 0 tabindex to focused item
			    $(event.target).attr('tabindex', '0').addClass('tree-item-active');
			})
			.click(function (event) {
			    //save reference to event target
			    var target = $(event.target);
			    //check if target is a tree node
			    if (target.is('a.tree-parent')) {
			        target.trigger('toggle');
			        target.eq(0).focus();
			        //return click event false because it's a tree node (folder)
			        return false;
			    }
			})
			.keydown(function (event) {
			    var target = tree.find('a[tabindex=0]');
			    //check for arrow keys
			    if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
			        //if key is left arrow 
			        if (event.keyCode == 37) {
			            //if list is expanded
			            if (target.parent().is('[aria-expanded=true]')) {
			                target.trigger('collapse');
			            }
			                //try traversing to parent
			            else {
			                target.parents('li:eq(1)').find('a').eq(0).focus();
			            }
			        }
			        //if key is right arrow
			        if (event.keyCode == 39) {
			            //if list is collapsed
			            if (target.parent().is('[aria-expanded=false]')) {
			                target.trigger('expand');
			            }
			                //try traversing to child
			            else {
			                target.parents('li:eq(0)').find('li a').eq(0).focus();
			            }
			        }
			        //if key is up arrow
			        if (event.keyCode == 38) {
			            target.trigger('traverseUp');
			        }
			        //if key is down arrow
			        if (event.keyCode == 40) {
			            target.trigger('traverseDown');
			        }
			        //return any of these keycodes false
			        return false;
			    }
			        //check if enter or space was pressed on a tree node
			    else if ((event.keyCode == 13 || event.keyCode == 32) && target.is('a.tree-parent')) {
			        target.trigger('toggle');
			        //return click event false because it's a tree node (folder)
			        return false;
			    }
			});
        }
    });
};
$(function () {
    $('#files').tree({
        expanded: 'li:first'
    });
});


// jquery 分页
$(function () {
    var b = $("#chapter").children();
    var a = 0;
    var c = b.length;
    var d = c - 1;
    $("#total").html(c);
    $("#down").click(function () {
        if (a < d) {
            ++a;
            $("#chapter > ul:eq(" + a + ")").show();
            $("#chapter > ul:eq(" + a + ")").siblings().hide();
            $("#num").empty();
            $("#num").html((a + 1));
        }
        else { a = d; }
    })
    $("#up").click(function () {
        if (a > 0) {
            --a;
            $("#chapter > ul:eq(" + a + ")").show();
            $("#chapter > ul:eq(" + a + ")").siblings().hide();
        }
        $("#num").empty();
        $("#num").html((a + 1));
    });
});


//点击文字变输入文本
$(document).ready(function () {
    $(".sortname").click(function () {
        if ($(this).find(".sort_input").attr("type") == "text") { return false; }
        var name = $.trim($(this).html());
        var m = $.trim($(this).text());
        $(this).html("<input type=text value='' name='' class='sort_input'>");
        $(this).find(".sort_input").focus();
        $(this).find(".sort_input").bind("blur", function () {
            var n = $.trim($(this).val());
            if (n != m && n != "") {
                $(this).parent().html(n);
            } else {
                $(this).parent().html(name);
            }
        });
    });
});

//表格控制行颜色
function grid(o, a, b, c, d) {

    var t = document.getElementById(o).getElementsByTagName("tr");

    for (var i = 1; i < t.length; i++) {

        t[i].style.backgroundColor = (t[i].sectionRowIndex % 2 == 0) ? a : b;

        t[i].onmouseover = function () {
            if (this.x != "1") this.style.backgroundColor = c;
        }

        t[i].onmouseout = function () {
            if (this.x != "1") this.style.backgroundColor = (this.sectionRowIndex % 2 == 0) ? a : b;
        }
        /*syj 后添加
        t[i].onclick = function () {
            if (this.x != "1") {
                var oinput = this.getElementsByTagName("input");
                for (var i = 0; i < oinput.length; i++) {
                    if (oinput[i].type == "checkbox") {
                        if (oinput[i].checked) {
                            oinput[i].checked = false;
                        } else {
                            oinput[i].checked = true;
                        }
                    }
                }
            }
            return false;
        }*/
    }
}

//获取当前时间
var initializationTime = (new Date()).getTime();
function showLeftTime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var time_str = hours + ":" + minutes + "";
    document.getElementById('input_show').value = time_str;
    try {
        document.getElementById('input_show1').value = time_str;
    }
    catch (e) {

    }

}

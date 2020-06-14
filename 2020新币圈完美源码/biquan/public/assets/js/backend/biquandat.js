define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'biquandat/index',
                    add_url: 'biquandat/add',
                    edit_url: 'biquandat/edit',
                    del_url: 'biquandat/del',
                    multi_url: 'biquandat/multi',
                    table: 'biquan_dat',
                }
 
                
            });

//////////////////////////


//定时执行，5秒后执行
    var t1=window.setTimeout(refreshCount, 1000 * 5);;
    function refreshCount() {
     var freshstatus = localStorage.getItem("fresh-status"); 
     if (freshstatus==1) {
        $(".btn-reflash").html('<i class="fa fa-plus"></i>自动刷新中...');
        $(".btn-refresh").click();
     }else{
        $(".btn-reflash").html('<i class="fa fa-plus"></i>开启自动刷新');
     }
      window.setTimeout(refreshCount, 1000 * 5);
    }
    

            $(document).on("click", ".btn-reflash", function () {
                 var freshstatus = localStorage.getItem("fresh-status"); 
               if (freshstatus==1) {
                   localStorage.setItem("fresh-status", 0);
                   $(".btn-reflash").html('<i class="fa fa-plus"></i>开启自动刷新');
               }else{
                   localStorage.setItem("fresh-status", 1);
                   $(".btn-reflash").html('<i class="fa fa-plus"></i>自动刷新中...');
               }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'uid', title: __('用户ID')},
                        {field: 'buytime', title: __('开始时间'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'pay', title: __('下注金额')},
                        {field: 'peifu', title: __('peifu')},
                        {field: 'status', title: __('状态')},
                       // {field: 'createtime', title: __('创建时间'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'buyDirection', title: __('目标涨跌')},
                        //{field: 'mode', title: __('模式')},
                       // {field: 'unionid', title: __('庄家点数')},
                        {field: 'now', title: __('当前指数')},
                        {field: 'ifkill', title: __('是否控制'), searchList: {"2": '放水',"1": '必杀', "0": '公平'}, formatter: Table.api.formatter.label},
                        {field: 'result', title: __('结果指数')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,
                              buttons: [
                                {
                                    name: 'detail',
                                    text: __('点杀'),
                                    title: __('点杀'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-bomb',
                                    url: 'biquandat/dankon/type/1/',
                                    callback: function (data) {
                                        alert(data);
                                    },
                                    visible: function (row) {
                                        //返回true时按钮显示,返回false隐藏
                                        return true;
                                    }
                                },
                                {
                                    name: 'detail',
                                    text: __('公平'),
                                    title: __('公平'),
                                    classname: 'btn btn-xs btn-success btn-dialog',
                                    icon: 'fa fa-yelp',
                                    url: 'biquandat/dankon/type/2/',
                                    callback: function (data) {
                                        alert(data);
                                    },
                                    visible: function (row) {
                                        //返回true时按钮显示,返回false隐藏
                                        return true;
                                    }
                                },
                                {
                                    name: 'detail',
                                    text: __('放水'),
                                    title: __('放水'),
                                    classname: 'btn btn-xs btn-danger btn-dialog',
                                    icon: 'fa fa-warning',
                                    url: 'biquandat/dankon/type/3/',
                                    callback: function (data) {
                                        alert(data);
                                    },
                                    visible: function (row) {
                                        //返回true时按钮显示,返回false隐藏
                                        return true;
                                    }
                                }
                                ]
                        }
                    ]
                ]
            });

            

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
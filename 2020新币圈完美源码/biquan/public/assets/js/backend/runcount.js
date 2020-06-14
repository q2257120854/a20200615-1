define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'runcount/index',
                    add_url: 'runcount/add',
                    edit_url: 'runcount/edit',
                    del_url: 'runcount/del',
                    multi_url: 'runcount/multi',
                    table: 'run_count',
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
                       // {field: 'uid', title: __('Uid')},
                      // {field: 'srpay', title: __('Srpay')},
                        {field: 'wup', title: __('Wup')},
                        {field: 'wdown', title: __('Wdown')},
                        {field: 'kfdown', title: __('Kfdown')},
                        {field: 'kfup', title: __('Kfup')},
                        {field: 'allin', title: __('Allin')},
                       // {field: 'xallin', title: __('Xallin')},
                        {field: 'allout', title: __('Allout')},
                       // {field: 'result', title: __('Result')},
                       // {field: 'paytime', title: __('Paytime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'note', title: __('Note')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'usercount/index',
                    add_url: 'usercount/add',
                    edit_url: 'usercount/edit',
                    del_url: 'usercount/del',
                    multi_url: 'usercount/multi',
                    table: 'user_count',
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
                        {field: 'uid', title: __('Uid')},
                       // {field: 'wup', title: __('Wup')},
                       // {field: 'wdown', title: __('Wdown')},
                        {field: 'allin', title: __('Allin')},
                      //  {field: 'xallin', title: __('Xallin')},
                        {field: 'allout', title: __('Allout')},
                        {field: 'srpay', title: __('Srpay'), operate:'BETWEEN'},
                        {field: 'kfdown', title: __('Kfdown'), operate:'BETWEEN'},
                        {field: 'kfup', title: __('Kfup')},
                      //  {field: 'result', title: __('Result')},
                        {field: 'paytime', title: __('Paytime'), operate:'RANGE'},
                        {field: 'peitime', title: __('Peitime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'onlinetixiantime', title: __('Onlinetixiantime')},
                       // {field: 'award', title: __('Award')},
                        {field: 'awardok', title: __('Awardok')},
                        {field: 'acount', title: __('Acount')},
                        {field: 'xcount', title: __('Xcount')},
                        {field: 'xxcount', title: __('Xxcount')},
                        {field: 'xxxcount', title: __('Xxxcount')},
                        {field: 'xxxxcount', title: __('Xxxxcount')},
                        //{field: 'awardtime', title: __('Awardtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        //{field: 'status', title: __('Status')},
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
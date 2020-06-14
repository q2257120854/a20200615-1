define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'game/gamehistory/index',
                    add_url: 'game/gamehistory/add',
                    edit_url: 'game/gamehistory/edit',
                    del_url: 'game/gamehistory/del',
                    multi_url: 'game/gamehistory/multi',
                    table: 'user',
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
                        {field: 'id', title: __('Id'), sortable: true},
                       // {field: 'group.name', title: __('Group')},
                        {field: 'uid', title: __('uid'), operate: 'LIKE'},
                        {field: 'money', title: __('money'), operate: 'LIKE'},
                        {field: 'num', title: __('num'), operate: 'LIKE'},
                        {field: 'numx', title: __('numx'), operate: 'LIKE'},
                       // {field: 'avatar', title: __('Avatar'), formatter: Table.api.formatter.image, operate: false},
                       // {field: 'level', title: __('Level'), operate: 'BETWEEN', sortable: true},
                       // {field: 'gender', title: __('Gender'), visible: false, searchList: {1: __('Male'), 0: __('Female')}},
                        {field: 'xiazhu', title: __('xiazhu'), operate: 'BETWEEN', sortable: true},
                        {field: 'successions', title: __('Successions'), visible: false, operate: 'BETWEEN', sortable: true},
                        {field: 'maxsuccessions', title: __('Maxsuccessions'), visible: false, operate: 'BETWEEN', sortable: true},
                        {field: 'createtime', title: __('createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'loginip', title: __('Loginip'), formatter: Table.api.formatter.search},
                        {field: 'jointime', title: __('Jointime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                       // {field: 'joinip', title: __('Joinip'), formatter: Table.api.formatter.search},
                        {field: 'result', title: __('result'), formatter: Table.api.formatter.status, searchList: {normal: __('Normal'), hidden: __('Hidden')}},
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
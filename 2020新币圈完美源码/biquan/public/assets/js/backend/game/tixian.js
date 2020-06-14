define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'game/tixian/index',
                    add_url: 'game/tixian/add',
                    edit_url: 'game/tixian/edit',
                    del_url: 'game/tixian/del',
                    multi_url: 'game/tixian/multi',
                    table: 'user_tixian',
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
                        {field: 'name', title: __('Name')},
                        {field: 'uid', title: __('Uid')},
                        {field: 'point', title: __('Point'), operate:'BETWEEN'},
                        {field: 'upoint', title: __('Upoint'), operate:'BETWEEN'},
                        {field: 'ttype', title: __('Ttype')},
                       // {field: 'filedata', title: __('Filedata')},
                       // {field: 'payurl', title: __('Payurl'), formatter: Table.api.formatter.url},
                       // {field: 'account', title: __('Account')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status')},
                        {field: 'note', title: __('Note')},
                        {field: 'paymentno', title: __('Paymentno')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,
                         buttons: [
                                {
                                    name: 'detail',
                                    text: __('手工取款'),
                                    title: __('手工取款i,多点没问题'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-list',
                                    url: 'game/tixian/repay',
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
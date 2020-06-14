define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'game/history/index',
                    add_url: 'game/history/add',
                    edit_url: 'game/history/edit',
                    del_url: 'game/history/del',
                    multi_url: 'game/history/multi',
                    table: 'history',
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
                       // {field: 'pid', title: __('Pid')},
                       //{field: 'tid', title: __('Tid')},
                        {field: 'uid', title: __('Uid')},
                        {field: 'attach', title: __('Attach')},
                        //{field: 'bank_type', title: __('Bank_type')},
                       // {field: 'openid', title: __('Openid')},
                        {field: 'out_trade_no', title: __('Out_trade_no')},
                        {field: 'cash_fee', title: __('Cash_fee')},
                        //{field: 'total_fee', title: __('Total_fee')},
                       // {field: 'cid', title: __('Cid')},
                        {field: 'trade_type', title: __('Trade_type')},
                        {field: 'transaction_id', title: __('Transaction_id')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'note', title: __('Note')},
                       // {field: 'typeid', title: __('Typeid')},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.flag},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
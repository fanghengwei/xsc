define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'foreigncompanyblacklist/index',
                    add_url: 'foreigncompanyblacklist/add',
                    edit_url: 'foreigncompanyblacklist/edit',
                    del_url: 'foreigncompanyblacklist/del',
                    multi_url: 'foreigncompanyblacklist/multi',
                    table: 'foreign_company_black_list',
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
                        {field: 'nationality', title: __('Nationality')},
                        {field: 'pessport', title: __('Pessport')},
                        {field: 'contace_information', title: __('Contace_information')},
                        {field: 'reporter', title: __('Reporter')},
                        {field: 'reson', title: __('Reson')},
                        {field: 'creater_id', title: __('Creater_id')},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'companyschoolblacklist/index',
                    add_url: 'companyschoolblacklist/add',
                    edit_url: 'companyschoolblacklist/edit',
                    // del_url: 'companyschoolblacklist/del',
                    multi_url: 'companyschoolblacklist/multi',
                    table: 'company_school_black_list',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                clickToSelect: false, //是否启用点击搜索
                commonSearch: true, //是否启用顶部搜索
                dblClickToEdit: false, //是否启用双击编辑
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'),visible:false,operate:false},
                        {field: 'name', title: __('Name')},
                        {field: 'contact_name', title: __('Contact Name'),operate:false},
                        {field: 'contace_information', title: 'Contact information',operate:false},
                        {field: 'reporter', title: __('Reporter')},
                        {field: 'reason', title: __('Reason'),operate:false},
                        {field: 'recorder', title: __('Recorder')},
                        {field: 'create_time', title: __('Create Time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime,operate:false},
                        {field: 'update_time', title: __('Update Time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime,visible:false,operate:false},
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
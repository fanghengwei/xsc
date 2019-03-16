define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'companyschool/index',
                    add_url: 'companyschool/add',
                    edit_url: 'companyschool/edit',
                    del_url: 'companyschool/del',
                    multi_url: 'companyschool/multi',
                    table: 'company_school',
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
                        {field: 'type', title: __('Type')},
                        {field: 'city', title: __('City')},
                        {field: 'contact_name', title: __('Contact_name')},
                        {field: 'phone', title: __('Phone')},
                        {field: 'wechat', title: __('Wechat')},
                        {field: 'agent_company', title: __('Agent_company')},
                        {field: 'agent_fee', title: __('Agent_fee')},
                        {field: 'arriving_time', title: __('Arriving_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'work_visa_provided', title: __('Work_visa_provided')},
                        {field: 'non_native_acceptable', title: __('Non_native_acceptable')},
                        {field: 'housing', title: __('Housing')},
                        {field: 'newfield', title: __('Newfield')},
                        {field: 'salsary_rang_low', title: __('Salsary_rang_low')},
                        {field: 'salsary_rang_high', title: __('Salsary_rang_high')},
                        {field: 'Vacancy', title: __('Vacancy')},
                        {field: 'blacklist', title: __('Blacklist')},
                        {field: 'blacklist_reason', title: __('Blacklist_reason')},
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'foreignteschers/index',
                    add_url: 'foreignteschers/add',
                    edit_url: 'foreignteschers/edit',
                    del_url: 'foreignteschers/del',
                    multi_url: 'foreignteschers/multi',
                    table: 'foreign_teschers',
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
                        {field: 'contact_information', title: __('Contact_information')},
                        {field: 'working_status', title: __('Working_status')},
                        {field: 'gender', title: __('Gender')},
                        {field: 'type', title: __('Type'), searchList: {"0":__('Type 0'),"1":__('Type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'age', title: __('Age')},
                        {field: 'resource', title: __('Resource')},
                        {field: 'nationality', title: __('Nationality')},
                        {field: 'passport', title: __('Passport')},
                        {field: 'degree', title: __('Degree')},
                        {field: 'certificate', title: __('Certificate')},
                        {field: 'visa_status', title: __('Visa_status')},
                        {field: 'arriving_time', title: __('Arriving_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'expected_salary', title: __('Expected_salary')},
                        {field: 'chinese', title: __('Chinese')},
                        {field: 'expected_city_1', title: __('Expected_city_1')},
                        {field: 'expected_city_2', title: __('Expected_city_2')},
                        {field: 'company_type', title: __('Company_type')},
                        {field: 'credit_score', title: __('Credit_score')},
                        {field: 'follow_up_status', title: __('Follow_up_status')},
                        {field: 'remarks', title: __('Remarks')},
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
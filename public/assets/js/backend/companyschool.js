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
                        {field: 'type', title: __('Type'), searchList: {"Public school":__('Public school'),"Private school":__('Private school'),"Kindergarten":__('Kindergarten'),"International school\\nInternational school\\n\\nInternational school\\n\\nInternational school\\n\\nInternational school\\n\\nInternational school\\n\\n":__('International school\\ninternational school\\n\\ninternational school\\n\\ninternational school\\n\\ninternational school\\n\\ninternational school\\n\\n'),"University":__('University'),"Adults training school":__('Adults training school'),"Kids training school":__('Kids training school'),"Education Company":__('Education company'),"Enterprises":__('Enterprises'),"Others":__('Others')}, formatter: Table.api.formatter.normal},
                        {field: 'city', title: __('City')},
                        {field: 'contact_name', title: __('Contact_name')},
                        {field: 'phone', title: __('Phone')},
                        {field: 'wechat', title: __('Wechat')},
                        {field: 'agent_company', title: __('Agent_company')},
                        {field: 'agent_fee', title: __('Agent_fee')},
                        {field: 'arriving_time', title: __('Arriving_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'work_visa_provided', title: __('Work_visa_provided'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.normal},
                        {field: 'non_native_acceptable', title: __('Non_native_acceptable'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.normal},
                        {field: 'housing', title: __('Housing'), searchList: {"Housing in Campus":__('Housing in campus'),"Apartment":__('Apartment')}, formatter: Table.api.formatter.normal},
                        {field: 'salsary_rang_low', title: __('Salsary_rang_low')},
                        {field: 'salsary_rang_high', title: __('Salsary_rang_high')},
                        {field: 'Vacancy', title: __('Vacancy')},
                        {field: 'blacklist', title: __('Blacklist'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.normal},
                        {field: 'blacklist_reason', title: __('Blacklist_reason')},
                        {field: 'creater_id', title: __('Creater_id')},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'companyschool/index',
                    add_url: 'companyschool/add',
                    edit_url: 'companyschool/edit',
                    // del_url: 'companyschool/del',
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
                clickToSelect: false, //是否启用点击搜索
                commonSearch: true, //是否启用顶部搜索
                dblClickToEdit: false, //是否启用双击编辑
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'),visible:false,operate:false,sortable: true},
                        {field: 'type', title: __('Company Type'), searchList: {"Public school":__('Public school'),"Private school":__('Private school'),"Kindergarten":__('Kindergarten'),"International school":__('International school'),"University":__('University'),"Adults training school":__('Adults training school'),"Kids training school":__('Kids training school'),"Education Company":__('Education company'),"Enterprises":__('Enterprises'),"Others":__('Others')}, formatter: Table.api.formatter.normal},
                        {field: 'city', title: __('City'),visible:false},
                        {field: 'salsary_rang', title: __('Salsary Rang'),visible:false,operate:false,},
                        {field: 'housing', title: __('Housing'), searchList: {"Housing in Campus":__('Housing in campus'),"Apartment":__('Apartment')}, formatter: Table.api.formatter.normal},
                        {field: 'work_visa_provided', title: __('Work Visa Provided'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.normal},
                        {field: 'non_native_acceptable', title: __('Non-Native acceptable'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.normal},
                        {field: 'arriving_time', title: __('Arriving Time'), operate:'RANGE', addclass:'datetimerange',visible:false},
                        {field: 'vacancy', title: __('Vacancy No.'),operate:false},
                        {field: 'job_title', title: __('Job Title'),operate:false},
                        {field: 'contact_name', title: __('Contact Name'),operate:false},
                        {field: 'phone', title: __('Phone'),operate:false},
                        {field: 'wechat', title: __('Wechat'),visible:false,operate:false},
                        {field: 'agent_company', title: __('Agent Company'),visible:false,operate:false,},
                        {field: 'agent_fee', title: __('Agent Fee'),visible:false,operate:false,},
                        {field: 'recruitment_details', title: __('Recruitment Details'),visible:false,operate:false},
                        {field: 'username', title: __('Recorder')},
                        // {field: 'create_time', title: __('Create Time'), operate:'RANGE', addclass:'datetimerange',operate:false,},
                        // {field: 'update_time', title: __('Update Time'), operate:'RANGE', addclass:'datetimerange',visible:false,operate:false},
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
            },
        }
    };
    return Controller;
});
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'foreignteachers/index',
                    add_url: 'foreignteachers/add',
                    edit_url: 'foreignteachers/edit',
                    multi_url: 'foreignteachers/multi',
                    jump: 'foreignteachers/ckeckfollow',
                    table: 'foreign_teachers',
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
                        // {checkbox: true},
                        { field: 'resource',visible:false,operate:false, title: __('Resource')},
                        { field: 'type',visible:false, title: __('Type'), searchList: {"Public":__('Public'),"Private":__('Private')}, formatter: Table.api.formatter.normal},
                        { field: 'name', title: __('Name')},
                        { field: 'nationality', title: __('Nationality'), searchList: {"Angola":__('Angola'),"Afghanistan":__('Afghanistan'),"Albania":__('Albania'),"Algeria":__('Algeria'),"Andorra":__('Andorra'),"Anguilla":__('Anguilla'),"Antigua and Barbuda":__('Antigua and barbuda'),"Argentina":__('Argentina'),"Armenia":__('Armenia'),"Ascension":__('Ascension'),"Australia":__('Australia'),"Austria":__('Austria'),"Azerbaijan":__('Azerbaijan'),"Bahamas":__('Bahamas'),"Bahrain":__('Bahrain'),"Bangladesh":__('Bangladesh'),"Barbados":__('Barbados'),"Belarus":__('Belarus'),"Belgium":__('Belgium'),"Belize":__('Belize'),"Benin":__('Benin'),"Bermuda Is.":__('Bermuda is.'),"Bolivia":__('Bolivia'),"Botswana":__('Botswana'),"Brazil":__('Brazil'),"Brunei":__('Brunei'),"Bulgaria":__('Bulgaria'),"Burkina-faso":__('Burkina-faso'),"Burma":__('Burma'),"Burundi":__('Burundi'),"Cameroon":__('Cameroon'),"Canada":__('Canada'),"Cayman Is.":__('Cayman is.'),"Central African Republic":__('Central african republic'),"Chad":__('Chad'),"Chile":__('Chile'),"China":__('China'),"Colombia":__('Colombia'),"Congo":__('Congo'),"Cook Is.":__('Cook is.'),"Costa Rica":__('Costa rica'),"Cuba":__('Cuba'),"Cyprus":__('Cyprus'),"Czech Republic":__('Czech republic'),"Denmark":__('Denmark'),"Djibouti":__('Djibouti'),"Dominica Rep.":__('Dominica rep.'),"Ecuador":__('Ecuador'),"Egypt":__('Egypt'),"EI Salvador":__('Ei salvador'),"Estonia":__('Estonia'),"Ethiopia":__('Ethiopia'),"Fiji":__('Fiji'),"Finland":__('Finland'),"France":__('France'),"French Guiana":__('French guiana'),"Gabon":__('Gabon'),"Gambia":__('Gambia'),"Georgia":__('Georgia'),"Germany":__('Germany'),"Ghana":__('Ghana'),"Gibraltar":__('Gibraltar'),"Greece":__('Greece'),"Grenada":__('Grenada'),"Guam":__('Guam'),"Guatemala":__('Guatemala'),"Guinea":__('Guinea'),"Guyana":__('Guyana'),"Haiti":__('Haiti'),"Honduras":__('Honduras'),"Hongkong":__('Hongkong'),"Hungary":__('Hungary'),"Iceland":__('Iceland'),"India":__('India'),"Indonesia":__('Indonesia'),"Iran":__('Iran'),"Iraq":__('Iraq'),"Ireland":__('Ireland'),"Israel":__('Israel'),"Italy":__('Italy'),"Ivory Coast":__('Ivory coast'),"Jamaica":__('Jamaica'),"Japan":__('Japan'),"Jordan":__('Jordan'),"Kampuchea (Cambodia )":__('Kampuchea (cambodia )'),"Kazakstan":__('Kazakstan'),"Kenya":__('Kenya'),"Korea":__('Korea'),"Kuwait":__('Kuwait'),"Kyrgyzstan":__('Kyrgyzstan'),"Laos":__('Laos'),"Latvia":__('Latvia'),"Lebanon":__('Lebanon'),"Lesotho":__('Lesotho'),"Liberia":__('Liberia'),"Libya":__('Libya'),"Liechtenstein":__('Liechtenstein'),"Lithuania":__('Lithuania'),"Luxembourg":__('Luxembourg'),"Macao":__('Macao'),"Madagascar":__('Madagascar'),"Malawi":__('Malawi'),"Malaysia":__('Malaysia'),"Maldives":__('Maldives'),"Mali":__('Mali'),"Malta":__('Malta'),"Mariana Is":__('Mariana is'),"Martinique":__('Martinique'),"Mauritius":__('Mauritius'),"Mexico":__('Mexico'),"Moldova":__('Moldova')," Republic of":__(' republic of'),"Monaco":__('Monaco'),"Mongolia":__('Mongolia'),"Montserrat Is":__('Montserrat is'),"Morocco":__('Morocco'),"Mozambique":__('Mozambique'),"Namibia":__('Namibia'),"Nauru":__('Nauru'),"Nepal":__('Nepal'),"Netheriands Antilles":__('Netheriands antilles'),"Netherlands":__('Netherlands'),"New Zealand":__('New zealand'),"Nicaragua":__('Nicaragua'),"Niger":__('Niger'),"Nigeria":__('Nigeria'),"North Korea":__('North korea'),"Norway":__('Norway'),"Oman":__('Oman'),"Pakistan":__('Pakistan'),"Panama":__('Panama'),"Papua New Cuinea":__('Papua new cuinea'),"Paraguay":__('Paraguay'),"Peru":__('Peru'),"Philippines":__('Philippines'),"Poland":__('Poland'),"French Polynesia":__('French polynesia'),"Portugal":__('Portugal'),"Puerto Rico":__('Puerto rico'),"Qatar":__('Qatar'),"Reunion":__('Reunion'),"Romania":__('Romania'),"Russia":__('Russia'),"Saint Lueia":__('Saint lueia'),"Saint Vincent":__('Saint vincent'),"Samoa Eastern":__('Samoa eastern'),"Samoa Western":__('Samoa western'),"San Marino":__('San marino'),"Sao Tome and Principe":__('Sao tome and principe'),"Saudi Arabia":__('Saudi arabia'),"Senegal":__('Senegal'),"Seychelles":__('Seychelles'),"Sierra Leone":__('Sierra leone'),"Singapore":__('Singapore'),"Slovakia":__('Slovakia'),"Slovenia":__('Slovenia'),"Solomon Is":__('Solomon is'),"Somali":__('Somali'),"South Africa":__('South africa'),"Spain":__('Spain'),"Sri Lanka":__('Sri lanka'),"St.Lucia":__('St.lucia'),"St.Vincent":__('St.vincent'),"Sudan":__('Sudan'),"Suriname":__('Suriname'),"Swaziland":__('Swaziland'),"Sweden":__('Sweden'),"Switzerland":__('Switzerland'),"Syria":__('Syria'),"Taiwan":__('Taiwan'),"Tajikstan":__('Tajikstan'),"Tanzania":__('Tanzania'),"Thailand":__('Thailand'),"Togo":__('Togo'),"Tonga":__('Tonga'),"Trinidad and Tobago":__('Trinidad and tobago'),"Tunisia":__('Tunisia'),"Turkey":__('Turkey'),"Turkmenistan":__('Turkmenistan'),"Uganda":__('Uganda'),"Ukraine":__('Ukraine'),"United Arab Emirates":__('United arab emirates'),"United Kiongdom":__('United kiongdom'),"United States of America":__('United states of america'),"Uruguay":__('Uruguay'),"Uzbekistan":__('Uzbekistan'),"Venezuela":__('Venezuela'),"Vietnam":__('Vietnam'),"Yemen":__('Yemen'),"Yugoslavia":__('Yugoslavia'),"Zimbabwe":__('Zimbabwe'),"Zaire":__('Zaire'),"Zambia":__('Zambia')}, formatter: Table.api.formatter.normal},
                        { field: 'passport',visible:false,operate:false, title: __('Passport No.')},
                        { field: 'age',visible:false, operate:false,title: __('Age')},
                        { field: 'gender',operate:false, title: __('Gender'), searchList: {"Female":__('Female'),"Male":__('Male')}, formatter: Table.api.formatter.normal},
                        { field: 'degree',visible:false,operate:false, title: __('Degree'), searchList: {"High school or below":__('High school or below'),"College":__('College'),"Bachelor":__('Bachelor'),"Master":__('Master'),"Doctor":__('Doctor')}, formatter: Table.api.formatter.normal},
                        { field: 'certificate',visible:false,operate:false, title: __('Certificate'), searchList: {"TEFL":__('Tefl'),"Teacher certificate":__('Teacher certificate'),"Others":__('Others'),"None":__('None')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        { field: 'chinese',visible:false,operate:false, title: __('Chinese Level'), searchList: {"HSK 1":__('Hsk 1'),"HSK 2":__('Hsk 2'),"HSK 3":__('Hsk 3'),"HSK 4":__('Hsk 4'),"HSK 5":__('Hsk 5'),"HSK 6":__('Hsk 6'),"None":__('None')}, formatter: Table.api.formatter.normal},
                        { field: 'housing',visible:false,operate:false, title: __('Housing'), searchList: {"None":__('None'),"Housing in Campus":__('Housing in Campus'),"Apartment provided":__('Apartment provided'),"Housing allowance":__('Housing allowance')}, formatter: Table.api.formatter.normal},
                        {field: 'job_title', title: __('Job Title'),visible:false,operate:false},
                        { field: 'expected_city_1', title: __('Expected City')},
                        { field: 'company_type',visible:false, title: __('Company Type'), searchList: {"Public school":__('Public school'),"Private school":__('Private school'),"Kindergarten":__('Kindergarten'),"International school":__('International school'),"University":__('University'),"Adults training school":__('Adults training school'),"Kids training school":__('Kids training school'),"Enterprises":__('Enterprises'),"Others":__('Others')}, formatter: Table.api.formatter.normal},
                        { field: 'expected_salary',visible:false,  operate:false,title: __('Expected Salary')},
                        
                        { field: 'visa_status',visible:false,operate:false, title: __('Visa_status'), searchList: {"Work Visa":__('Work visa'),"Tourist Visa":__('Tourist visa'),"Family Visa":__('Family visa'),"Student Visa":__('Student visa'),"Business Visa":__('Business visa'),"Permenant Visa":__('Permenant visa'),"Other Visa":__('Other visa')}, formatter: Table.api.formatter.status},
                        { field: 'working_status', title: __('Working Status'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.status},
                        { field: 'arriving_time',visible:false, title: __('Arriving Time'), operate:'RANGE', addclass:'datetimerange'},
                        { field: 'credit_score',visible:false,operate:false, title: __('Credit Score'), searchList: {"0 Ponint":__('0 ponint'),"1 Ponint":__('1 ponint'),"2 Ponints":__('2 ponints'),"3 Ponints":__('3 ponints'),"4 Ponints":__('4 ponints'),"5 Ponints":__('5 ponints')}, formatter: Table.api.formatter.normal},
                        { field: 'attachment_files',visible:false,operate:false, title: __('Attachment Files')},
                        { field: 'contact_information',visible:false,operate:false, title: __('Contact Information')},
                        { field: 'recorder',visible:false, title: __('Recorder'),searchList:Config.admin_list},
                        { field: 'follow_name', operate:false,title: __('Follow-up Person')},
                        { field: 'follow_up_status', title: __('Follow-up Status'), searchList: {"Interviewing":__('Interviewing'),"Signed":__('Signed'),"Visa processing":__('Visa processing'),"Arrived":__('Arrived'),"Agent fee paid":__('Agent fee paid'),"Failed":__('Failed')}, formatter: Table.api.formatter.status},
                        { field: 'follow', title:'Follow', table: table, operate:false, formatter: Controller.api.formatter.buttons },
                        { field: 'blacklist', title:'BlackList', table: table, operate:false, formatter: Controller.api.formatter.blacklist },
                        { field: 'remarks',visible:false, title: __('Remarks')},
                        // { field: 'operate', title: __('Edit'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,operate:false},
                        {
                            field: 'operate',
                            title: __('Operate'),
                            buttons: [
                                {
                                    name: 'check follow',
                                    text: 'check follow',
                                    title: 'check follow',
                                    // icon: 'fa fa-check',s
                                    classname: 'btn btn-xs btn-success btn-view btn-dialog',
                                    url: $.fn.bootstrapTable.defaults.extend.jump,
                                    success: function () {
                                        layer.close();
                                    }
                                },


                            ],
                            table: table,
                            events: Table.api.events.operate,
                            formatter: Table.api.formatter.operate
                        },
                        // 默认不显示的
                        { field: 'create_time',operate:false, visible:false,title: __('Create Time'), addclass:'datetimerange'},
                        { field: 'update_time', visible:false,operate:false,title: __('Update Time'),  addclass:'datetimerange'},
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $(document).on('click','.btn-follow',function(){
                var ids = ($(this).attr('pid'));
                layer.open({
                    type: 2,
                    title: 'Follow-up',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['893px', '600px'],
                    content: 'foreignteachers/show_follow?ids='+ids,
                    end: function () {
                        table.bootstrapTable('refresh',{})
                    }
                });
            });
            $(document).on('click','.btn-blacklist',function(){
                if(!confirm('Add to blacklist？')){return 0;}
                var ids = ($(this).attr('pid'));
                $.ajax({
                    url:'/admin/foreignteachers/add_blacklist?ids='+ids,
                    type:'get',
                    success:function(res) {
                        if(res.code==1){
                            Toastr.success('添加成功');
                        }else{
                            Toastr.error(res.msg);
                        }
                    },
                })
            });
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
            formatter:{
                buttons: function (value,row,index) {
                    html = '<a href=javascript:; pid="'+row.id+'"class="btn btn-xs btn-info btn-follow" title="Follow-up"><i class="fa fa-commenting-o"> Follow-up</i></a>';
                    return html;
                },
                blacklist: function (value,row,index) {
                    html = '<a href=javascript:; pid="'+row.id+'"class="btn btn-xs btn-info btn-blacklist" title="Black-list"><i style="width: 72px;" class="fa fa-rocket fa-fw"> Black-list</i></a>';
                    return html;
                },
            },
        }
    };
    return Controller;
});
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'foreignteachersblacklist/index',
                    add_url: 'foreignteachersblacklist/add',
                    edit_url: 'foreignteachersblacklist/edit',
                    multi_url: 'foreignteachersblacklist/multi',
                    table: 'foreign_teachers_black_list',
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
                        {field: 'id',visible:false,operate:false, title: __('Id')},
                        {field: 'name', title: __('Name')},
                        {field: 'nationality', title: __('Nationality'), searchList: {"Angola":__('Angola'),"Afghanistan":__('Afghanistan'),"Albania":__('Albania'),"Algeria":__('Algeria'),"Andorra":__('Andorra'),"Anguilla":__('Anguilla'),"Antigua and Barbuda":__('Antigua and barbuda'),"Argentina":__('Argentina'),"Armenia":__('Armenia'),"Ascension":__('Ascension'),"Australia":__('Australia'),"Austria":__('Austria'),"Azerbaijan":__('Azerbaijan'),"Bahamas":__('Bahamas'),"Bahrain":__('Bahrain'),"Bangladesh":__('Bangladesh'),"Barbados":__('Barbados'),"Belarus":__('Belarus'),"Belgium":__('Belgium'),"Belize":__('Belize'),"Benin":__('Benin'),"Bermuda Is.":__('Bermuda is.'),"Bolivia":__('Bolivia'),"Botswana":__('Botswana'),"Brazil":__('Brazil'),"Brunei":__('Brunei'),"Bulgaria":__('Bulgaria'),"Burkina-faso":__('Burkina-faso'),"Burma":__('Burma'),"Burundi":__('Burundi'),"Cameroon":__('Cameroon'),"Canada":__('Canada'),"Cayman Is.":__('Cayman is.'),"Central African Republic":__('Central african republic'),"Chad":__('Chad'),"Chile":__('Chile'),"China":__('China'),"Colombia":__('Colombia'),"Congo":__('Congo'),"Cook Is.":__('Cook is.'),"Costa Rica":__('Costa rica'),"Cuba":__('Cuba'),"Cyprus":__('Cyprus'),"Czech Republic":__('Czech republic'),"Denmark":__('Denmark'),"Djibouti":__('Djibouti'),"Dominica Rep.":__('Dominica rep.'),"Ecuador":__('Ecuador'),"Egypt":__('Egypt'),"EI Salvador":__('Ei salvador'),"Estonia":__('Estonia'),"Ethiopia":__('Ethiopia'),"Fiji":__('Fiji'),"Finland":__('Finland'),"France":__('France'),"French Guiana":__('French guiana'),"Gabon":__('Gabon'),"Gambia":__('Gambia'),"Georgia":__('Georgia'),"Germany":__('Germany'),"Ghana":__('Ghana'),"Gibraltar":__('Gibraltar'),"Greece":__('Greece'),"Grenada":__('Grenada'),"Guam":__('Guam'),"Guatemala":__('Guatemala'),"Guinea":__('Guinea'),"Guyana":__('Guyana'),"Haiti":__('Haiti'),"Honduras":__('Honduras'),"Hongkong":__('Hongkong'),"Hungary":__('Hungary'),"Iceland":__('Iceland'),"India":__('India'),"Indonesia":__('Indonesia'),"Iran":__('Iran'),"Iraq":__('Iraq'),"Ireland":__('Ireland'),"Israel":__('Israel'),"Italy":__('Italy'),"Ivory Coast":__('Ivory coast'),"Jamaica":__('Jamaica'),"Japan":__('Japan'),"Jordan":__('Jordan'),"Kampuchea (Cambodia )":__('Kampuchea (cambodia )'),"Kazakstan":__('Kazakstan'),"Kenya":__('Kenya'),"Korea":__('Korea'),"Kuwait":__('Kuwait'),"Kyrgyzstan":__('Kyrgyzstan'),"Laos":__('Laos'),"Latvia":__('Latvia'),"Lebanon":__('Lebanon'),"Lesotho":__('Lesotho'),"Liberia":__('Liberia'),"Libya":__('Libya'),"Liechtenstein":__('Liechtenstein'),"Lithuania":__('Lithuania'),"Luxembourg":__('Luxembourg'),"Macao":__('Macao'),"Madagascar":__('Madagascar'),"Malawi":__('Malawi'),"Malaysia":__('Malaysia'),"Maldives":__('Maldives'),"Mali":__('Mali'),"Malta":__('Malta'),"Mariana Is":__('Mariana is'),"Martinique":__('Martinique'),"Mauritius":__('Mauritius'),"Mexico":__('Mexico'),"Moldova":__('Moldova')," Republic of":__(' republic of'),"Monaco":__('Monaco'),"Mongolia":__('Mongolia'),"Montserrat Is":__('Montserrat is'),"Morocco":__('Morocco'),"Mozambique":__('Mozambique'),"Namibia":__('Namibia'),"Nauru":__('Nauru'),"Nepal":__('Nepal'),"Netheriands Antilles":__('Netheriands antilles'),"Netherlands":__('Netherlands'),"New Zealand":__('New zealand'),"Nicaragua":__('Nicaragua'),"Niger":__('Niger'),"Nigeria":__('Nigeria'),"North Korea":__('North korea'),"Norway":__('Norway'),"Oman":__('Oman'),"Pakistan":__('Pakistan'),"Panama":__('Panama'),"Papua New Cuinea":__('Papua new cuinea'),"Paraguay":__('Paraguay'),"Peru":__('Peru'),"Philippines":__('Philippines'),"Poland":__('Poland'),"French Polynesia":__('French polynesia'),"Portugal":__('Portugal'),"Puerto Rico":__('Puerto rico'),"Qatar":__('Qatar'),"Reunion":__('Reunion'),"Romania":__('Romania'),"Russia":__('Russia'),"Saint Lueia":__('Saint lueia'),"Saint Vincent":__('Saint vincent'),"Samoa Eastern":__('Samoa eastern'),"Samoa Western":__('Samoa western'),"San Marino":__('San marino'),"Sao Tome and Principe":__('Sao tome and principe'),"Saudi Arabia":__('Saudi arabia'),"Senegal":__('Senegal'),"Seychelles":__('Seychelles'),"Sierra Leone":__('Sierra leone'),"Singapore":__('Singapore'),"Slovakia":__('Slovakia'),"Slovenia":__('Slovenia'),"Solomon Is":__('Solomon is'),"Somali":__('Somali'),"South Africa":__('South africa'),"Spain":__('Spain'),"Sri Lanka":__('Sri lanka'),"St.Lucia":__('St.lucia'),"St.Vincent":__('St.vincent'),"Sudan":__('Sudan'),"Suriname":__('Suriname'),"Swaziland":__('Swaziland'),"Sweden":__('Sweden'),"Switzerland":__('Switzerland'),"Syria":__('Syria'),"Taiwan":__('Taiwan'),"Tajikstan":__('Tajikstan'),"Tanzania":__('Tanzania'),"Thailand":__('Thailand'),"Togo":__('Togo'),"Tonga":__('Tonga'),"Trinidad and Tobago":__('Trinidad and tobago'),"Tunisia":__('Tunisia'),"Turkey":__('Turkey'),"Turkmenistan":__('Turkmenistan'),"Uganda":__('Uganda'),"Ukraine":__('Ukraine'),"United Arab Emirates":__('United arab emirates'),"United Kiongdom":__('United kiongdom'),"United States of America":__('United states of america'),"Uruguay":__('Uruguay'),"Uzbekistan":__('Uzbekistan'),"Venezuela":__('Venezuela'),"Vietnam":__('Vietnam'),"Yemen":__('Yemen'),"Yugoslavia":__('Yugoslavia'),"Zimbabwe":__('Zimbabwe'),"Zaire":__('Zaire'),"Zambia":__('Zambia')}, formatter: Table.api.formatter.normal},
                        {field: 'passport_no',operate:false, title: __('Passport_no')},
                        {field: 'contact_information',operate:false, title: __('Contact Information')},
                        {field: 'reason_for_blacklist',operate:false, title: __('Reason For Blacklist')},
                        {field: 'reporter', title: __('Reporter')},
                        // {field: 'creater_id',visible:false,operate:false, title: __('Creater_id')},
                        // {field: 'contace_name',visible:false,operate:false, title: __('Contace_name')},
                        {field: 'create_time',visible:false,operate:false, title: __('Create Time'),  addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time',visible:false,operate:false, title: __('Update Time'), addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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
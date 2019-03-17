define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'foreignteachers/index',
                    add_url: 'foreignteachers/add',
                    edit_url: 'foreignteachers/edit',
                    del_url: 'foreignteachers/del',
                    multi_url: 'foreignteachers/multi',
                    table: 'foreign_teachers',
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
                        {field: 'working_status', title: __('Working_status'), searchList: {"No":__('No'),"Yes":__('Yes')}, formatter: Table.api.formatter.status},
                        {field: 'gender', title: __('Gender'), searchList: {"Female":__('Female'),"Male":__('Male')}, formatter: Table.api.formatter.normal},
                        {field: 'type', title: __('Type'), searchList: {"Public":__('Public'),"Private":__('Private')}, formatter: Table.api.formatter.normal},
                        {field: 'age', title: __('Age')},
                        {field: 'resource', title: __('Resource')},
                        {field: 'nationality', title: __('Nationality'), searchList: {"中国":__('中国'),"阿尔巴尼亚":__('阿尔巴尼亚'),"阿尔及利亚":__('阿尔及利亚'),"阿富汗":__('阿富汗'),"阿根廷":__('阿根廷'),"阿拉伯联合酋长国":__('阿拉伯联合酋长国'),"阿鲁巴":__('阿鲁巴'),"阿曼":__('阿曼'),"阿塞拜疆":__('阿塞拜疆'),"阿森松岛":__('阿森松岛'),"埃及":__('埃及'),"埃塞俄比亚":__('埃塞俄比亚'),"爱尔兰":__('爱尔兰'),"爱沙尼亚":__('爱沙尼亚'),"安道尔":__('安道尔'),"安哥拉":__('安哥拉'),"安圭拉":__('安圭拉'),"安提瓜岛和巴布达":__('安提瓜岛和巴布达'),"奥地利":__('奥地利'),"奥兰群岛":__('奥兰群岛'),"澳大利亚":__('澳大利亚'),"巴巴多斯岛":__('巴巴多斯岛'),"巴布亚新几内亚":__('巴布亚新几内亚'),"巴哈马":__('巴哈马'),"巴基斯坦":__('巴基斯坦'),"巴拉圭":__('巴拉圭'),"巴勒斯坦":__('巴勒斯坦'),"巴林":__('巴林'),"巴拿马":__('巴拿马'),"巴西":__('巴西'),"白俄罗斯":__('白俄罗斯'),"百慕大":__('百慕大'),"保加利亚":__('保加利亚'),"北马里亚纳群岛":__('北马里亚纳群岛'),"贝宁":__('贝宁'),"比利时":__('比利时'),"冰岛":__('冰岛'),"波多黎各":__('波多黎各'),"波兰":__('波兰'),"波斯尼亚和黑塞哥维那":__('波斯尼亚和黑塞哥维那'),"玻利维亚":__('玻利维亚'),"伯利兹":__('伯利兹'),"博茨瓦纳":__('博茨瓦纳'),"不丹":__('不丹'),"布基纳法索":__('布基纳法索'),"布隆迪":__('布隆迪'),"布韦岛":__('布韦岛'),"朝鲜":__('朝鲜'),"丹麦":__('丹麦'),"德国":__('德国'),"东帝汶":__('东帝汶'),"多哥":__('多哥'),"多米尼加":__('多米尼加'),"多米尼加共和国":__('多米尼加共和国'),"俄罗斯":__('俄罗斯'),"厄瓜多尔":__('厄瓜多尔'),"厄立特里亚":__('厄立特里亚'),"法国":__('法国'),"法罗群岛":__('法罗群岛'),"法属波利尼西亚":__('法属波利尼西亚'),"法属圭亚那":__('法属圭亚那'),"法属南部领地":__('法属南部领地'),"梵蒂冈":__('梵蒂冈'),"菲律宾":__('菲律宾'),"斐济":__('斐济'),"芬兰":__('芬兰'),"佛得角":__('佛得角'),"弗兰克群岛":__('弗兰克群岛'),"冈比亚":__('冈比亚'),"刚果":__('刚果'),"刚果民主共和国":__('刚果民主共和国'),"哥伦比亚":__('哥伦比亚'),"哥斯达黎加":__('哥斯达黎加'),"格恩西岛":__('格恩西岛'),"格林纳达":__('格林纳达'),"格陵兰":__('格陵兰'),"古巴":__('古巴'),"瓜德罗普":__('瓜德罗普'),"关岛":__('关岛'),"圭亚那":__('圭亚那'),"哈萨克斯坦":__('哈萨克斯坦'),"海地":__('海地'),"韩国":__('韩国'),"荷兰":__('荷兰'),"荷属安地列斯":__('荷属安地列斯'),"赫德和麦克唐纳群岛":__('赫德和麦克唐纳群岛'),"洪都拉斯":__('洪都拉斯'),"基里巴斯":__('基里巴斯'),"吉布提":__('吉布提'),"吉尔吉斯斯坦":__('吉尔吉斯斯坦'),"几内亚":__('几内亚'),"几内亚比绍":__('几内亚比绍'),"加拿大":__('加拿大'),"加纳":__('加纳'),"加蓬":__('加蓬'),"柬埔寨":__('柬埔寨'),"捷克共和国":__('捷克共和国'),"津巴布韦":__('津巴布韦'),"喀麦隆":__('喀麦隆'),"卡塔尔":__('卡塔尔'),"开曼群岛":__('开曼群岛'),"科科斯群岛":__('科科斯群岛'),"科摩罗":__('科摩罗'),"科特迪瓦":__('科特迪瓦'),"科威特":__('科威特'),"克罗地亚":__('克罗地亚'),"肯尼亚":__('肯尼亚'),"库克群岛":__('库克群岛'),"拉脱维亚":__('拉脱维亚'),"莱索托":__('莱索托'),"老挝":__('老挝'),"黎巴嫩":__('黎巴嫩'),"立陶宛":__('立陶宛'),"利比里亚":__('利比里亚'),"利比亚":__('利比亚'),"列支敦士登":__('列支敦士登'),"留尼旺岛":__('留尼旺岛'),"卢森堡":__('卢森堡'),"卢旺达":__('卢旺达'),"罗马尼亚":__('罗马尼亚'),"马达加斯加":__('马达加斯加'),"马尔代夫":__('马尔代夫'),"马耳他":__('马耳他'),"马拉维":__('马拉维'),"马来西亚":__('马来西亚'),"马里":__('马里'),"马其顿":__('马其顿'),"马绍尔群岛":__('马绍尔群岛'),"马提尼克":__('马提尼克'),"马约特岛":__('马约特岛'),"曼岛":__('曼岛'),"毛里求斯":__('毛里求斯'),"毛里塔尼亚":__('毛里塔尼亚'),"美国":__('美国'),"美属萨摩亚":__('美属萨摩亚'),"美属外岛":__('美属外岛'),"蒙古":__('蒙古'),"蒙特塞拉特":__('蒙特塞拉特'),"孟加拉":__('孟加拉'),"秘鲁":__('秘鲁'),"密克罗尼西亚":__('密克罗尼西亚'),"缅甸":__('缅甸'),"摩尔多瓦":__('摩尔多瓦'),"摩洛哥":__('摩洛哥'),"摩纳哥":__('摩纳哥'),"莫桑比克":__('莫桑比克'),"墨西哥":__('墨西哥'),"纳米比亚":__('纳米比亚'),"南非":__('南非'),"南极洲":__('南极洲'),"南乔治亚和南桑德威奇群岛":__('南乔治亚和南桑德威奇群岛'),"瑙鲁":__('瑙鲁'),"尼泊尔":__('尼泊尔'),"尼加拉瓜":__('尼加拉瓜'),"尼日尔":__('尼日尔'),"尼日利亚":__('尼日利亚'),"纽埃":__('纽埃'),"挪威":__('挪威'),"诺福克":__('诺福克'),"帕劳群岛":__('帕劳群岛'),"皮特凯恩":__('皮特凯恩'),"葡萄牙":__('葡萄牙'),"乔治亚":__('乔治亚'),"日本":__('日本'),"瑞典":__('瑞典'),"瑞士":__('瑞士'),"萨尔瓦多":__('萨尔瓦多'),"萨摩亚":__('萨摩亚'),"塞尔维亚":__('塞尔维亚'),"塞拉利昂":__('塞拉利昂'),"塞内加尔":__('塞内加尔'),"塞浦路斯":__('塞浦路斯'),"塞舌尔":__('塞舌尔'),"沙特阿拉伯":__('沙特阿拉伯'),"圣诞岛":__('圣诞岛'),"圣多美和普林西比":__('圣多美和普林西比'),"圣赫勒拿":__('圣赫勒拿'),"圣基茨和尼维斯":__('圣基茨和尼维斯'),"圣卢西亚":__('圣卢西亚'),"圣马力诺":__('圣马力诺'),"圣皮埃尔和米克隆群岛":__('圣皮埃尔和米克隆群岛'),"圣文森特和格林纳丁斯":__('圣文森特和格林纳丁斯'),"斯里兰卡":__('斯里兰卡'),"斯洛伐克":__('斯洛伐克'),"斯洛文尼亚":__('斯洛文尼亚'),"斯瓦尔巴和扬马廷":__('斯瓦尔巴和扬马廷'),"斯威士兰":__('斯威士兰'),"苏丹":__('苏丹'),"苏里南":__('苏里南'),"所罗门群岛":__('所罗门群岛'),"索马里":__('索马里'),"塔吉克斯坦":__('塔吉克斯坦'),"泰国":__('泰国'),"坦桑尼亚":__('坦桑尼亚'),"汤加":__('汤加'),"特克斯和凯克特斯群岛":__('特克斯和凯克特斯群岛'),"特里斯坦达昆哈":__('特里斯坦达昆哈'),"特立尼达和多巴哥":__('特立尼达和多巴哥'),"突尼斯":__('突尼斯'),"图瓦卢":__('图瓦卢'),"土耳其":__('土耳其'),"土库曼斯坦":__('土库曼斯坦'),"托克劳":__('托克劳'),"瓦利斯和福图纳":__('瓦利斯和福图纳'),"瓦努阿图":__('瓦努阿图'),"危地马拉":__('危地马拉'),"维尔京群岛，美属":__('维尔京群岛，美属'),"维尔京群岛，英属":__('维尔京群岛，英属'),"委内瑞拉":__('委内瑞拉'),"文莱":__('文莱'),"乌干达":__('乌干达'),"乌克兰":__('乌克兰'),"乌拉圭":__('乌拉圭'),"乌兹别克斯坦":__('乌兹别克斯坦'),"西班牙":__('西班牙'),"希腊":__('希腊'),"新加坡":__('新加坡'),"新喀里多尼亚":__('新喀里多尼亚'),"新西兰":__('新西兰'),"匈牙利":__('匈牙利'),"叙利亚":__('叙利亚'),"牙买加":__('牙买加'),"亚美尼亚":__('亚美尼亚'),"也门":__('也门'),"伊拉克":__('伊拉克'),"伊朗":__('伊朗'),"以色列":__('以色列'),"意大利":__('意大利'),"印度":__('印度'),"印度尼西亚":__('印度尼西亚'),"英国":__('英国'),"英属印度洋领地":__('英属印度洋领地'),"约旦":__('约旦'),"越南":__('越南'),"赞比亚":__('赞比亚'),"泽西岛":__('泽西岛'),"乍得":__('乍得'),"直布罗陀":__('直布罗陀'),"智利":__('智利'),"中非共和国":__('中非共和国')}, formatter: Table.api.formatter.normal},
                        {field: 'passport', title: __('Passport')},
                        {field: 'degree', title: __('Degree'), searchList: {"High school or below":__('High school or below'),"College":__('College'),"Bachelor Master":__('Bachelor master'),"Doctor":__('Doctor'),"":__('')}, formatter: Table.api.formatter.normal},
                        {field: 'certificate', title: __('Certificate'), searchList: {"TEFL":__('Tefl'),"Teacher certificate":__('Teacher certificate'),"Others":__('Others'),"None":__('None')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'visa_status', title: __('Visa_status'), searchList: {"Yes":__('Yes'),"No":__('No')}, formatter: Table.api.formatter.status},
                        {field: 'arriving_time', title: __('Arriving_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'expected_salary', title: __('Expected_salary')},
                        {field: 'chinese', title: __('Chinese'), searchList: {"HSK 1":__('Hsk 1'),"HSK 2":__('Hsk 2'),"HSK 3":__('Hsk 3'),"HSK 4":__('Hsk 4'),"HSK 5":__('Hsk 5'),"HSK 6":__('Hsk 6'),"None":__('None')}, formatter: Table.api.formatter.normal},
                        {field: 'expected_city_1', title: __('Expected_city_1')},
                        {field: 'expected_city_2', title: __('Expected_city_2')},
                        {field: 'company_type', title: __('Company_type'), searchList: {"Public school":__('Public school'),"Private school":__('Private school'),"Kindergarten":__('Kindergarten'),"International school":__('International school'),"University":__('University'),"Adults training school":__('Adults training school'),"Kids training school":__('Kids training school'),"Enterprises":__('Enterprises'),"Others":__('Others')}, formatter: Table.api.formatter.normal},
                        {field: 'credit_score', title: __('Credit_score'), searchList: {"0 Ponint":__('0 ponint'),"1 Ponint":__('1 ponint'),"2 Ponints":__('2 ponints'),"3 Ponints":__('3 ponints'),"4 Ponints":__('4 ponints'),"5 Ponints":__('5 ponints')}, formatter: Table.api.formatter.normal},
                        {field: 'follow_up_status', title: __('Follow_up_status'), searchList: {"Interviewing":__('Interviewing'),"Signed":__('Signed'),"Visa processing":__('Visa processing'),"Arrived":__('Arrived'),"Agent fee paid":__('Agent fee paid'),"Failed":__('Failed')}, formatter: Table.api.formatter.status},
                        {field: 'attachment_files', title: __('Attachment_files')},
                        {field: 'creater_idd', title: __('Creater_idd')},
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
<?php

namespace app\admin\model;

use app\admin\library\Auth;
use think\Db;
use think\Model;

class Foreignteachers extends Model
{
    // 表名
    protected $name = 'foreign_teachers';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = true;
    protected $updateTime = true;
    
    // 追加属性
    protected $append = [
        'working_status_text',
        'gender_text',
        'type_text',
        'nationality_text',
        'degree_text',
        'certificate_text',
        'visa_status_text',
        'chinese_text',
        'company_type_text',
        'credit_score_text',
        'follow_up_status_text'
    ];

    /**
     * RetrieveClass constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(empty($this->table)) $this->table = config('alias.ft');
    }

    //region  基础
    public function getWorkingStatusList()
    {
        return ['Under contract' => __('Under contract'),'Looking for job now' => __('Looking for job now'),'Wait-and-see' => __('Wait-and-see')];
    }     

    public function getGenderList()
    {
        return ['Female' => __('Female'),'Male' => __('Male')];
    }     

    public function getTypeList()
    {
        return ['Public' => __('Public'),'Private' => __('Private')];
    }     

    public function getNationalityList()
    {
        return ['Angola' => __('Angola'),'Afghanistan' => __('Afghanistan'),'Albania' => __('Albania'),'Algeria' => __('Algeria'),'Andorra' => __('Andorra'),'Anguilla' => __('Anguilla'),'Antigua and Barbuda' => __('Antigua and barbuda'),'Argentina' => __('Argentina'),'Armenia' => __('Armenia'),'Ascension' => __('Ascension'),'Australia' => __('Australia'),'Austria' => __('Austria'),'Azerbaijan' => __('Azerbaijan'),'Bahamas' => __('Bahamas'),'Bahrain' => __('Bahrain'),'Bangladesh' => __('Bangladesh'),'Barbados' => __('Barbados'),'Belarus' => __('Belarus'),'Belgium' => __('Belgium'),'Belize' => __('Belize'),'Benin' => __('Benin'),'Bermuda Is.' => __('Bermuda is.'),'Bolivia' => __('Bolivia'),'Botswana' => __('Botswana'),'Brazil' => __('Brazil'),'Brunei' => __('Brunei'),'Bulgaria' => __('Bulgaria'),'Burkina-faso' => __('Burkina-faso'),'Burma' => __('Burma'),'Burundi' => __('Burundi'),'Cameroon' => __('Cameroon'),'Canada' => __('Canada'),'Cayman Is.' => __('Cayman is.'),'Central African Republic' => __('Central african republic'),'Chad' => __('Chad'),'Chile' => __('Chile'),'China' => __('China'),'Colombia' => __('Colombia'),'Congo' => __('Congo'),'Cook Is.' => __('Cook is.'),'Costa Rica' => __('Costa rica'),'Cuba' => __('Cuba'),'Cyprus' => __('Cyprus'),'Czech Republic' => __('Czech republic'),'Denmark' => __('Denmark'),'Djibouti' => __('Djibouti'),'Dominica Rep.' => __('Dominica rep.'),'Ecuador' => __('Ecuador'),'Egypt' => __('Egypt'),'EI Salvador' => __('Ei salvador'),'Estonia' => __('Estonia'),'Ethiopia' => __('Ethiopia'),'Fiji' => __('Fiji'),'Finland' => __('Finland'),'France' => __('France'),'French Guiana' => __('French guiana'),'Gabon' => __('Gabon'),'Gambia' => __('Gambia'),'Georgia' => __('Georgia'),'Germany' => __('Germany'),'Ghana' => __('Ghana'),'Gibraltar' => __('Gibraltar'),'Greece' => __('Greece'),'Grenada' => __('Grenada'),'Guam' => __('Guam'),'Guatemala' => __('Guatemala'),'Guinea' => __('Guinea'),'Guyana' => __('Guyana'),'Haiti' => __('Haiti'),'Honduras' => __('Honduras'),'Hongkong' => __('Hongkong'),'Hungary' => __('Hungary'),'Iceland' => __('Iceland'),'India' => __('India'),'Indonesia' => __('Indonesia'),'Iran' => __('Iran'),'Iraq' => __('Iraq'),'Ireland' => __('Ireland'),'Israel' => __('Israel'),'Italy' => __('Italy'),'Ivory Coast' => __('Ivory coast'),'Jamaica' => __('Jamaica'),'Japan' => __('Japan'),'Jordan' => __('Jordan'),'Kampuchea (Cambodia )' => __('Kampuchea (cambodia )'),'Kazakstan' => __('Kazakstan'),'Kenya' => __('Kenya'),'Korea' => __('Korea'),'Kuwait' => __('Kuwait'),'Kyrgyzstan' => __('Kyrgyzstan'),'Laos' => __('Laos'),'Latvia' => __('Latvia'),'Lebanon' => __('Lebanon'),'Lesotho' => __('Lesotho'),'Liberia' => __('Liberia'),'Libya' => __('Libya'),'Liechtenstein' => __('Liechtenstein'),'Lithuania' => __('Lithuania'),'Luxembourg' => __('Luxembourg'),'Macao' => __('Macao'),'Madagascar' => __('Madagascar'),'Malawi' => __('Malawi'),'Malaysia' => __('Malaysia'),'Maldives' => __('Maldives'),'Mali' => __('Mali'),'Malta' => __('Malta'),'Mariana Is' => __('Mariana is'),'Martinique' => __('Martinique'),'Mauritius' => __('Mauritius'),'Mexico' => __('Mexico'),'Moldova' => __('Moldova'),' Republic of' => __(' republic of'),'Monaco' => __('Monaco'),'Mongolia' => __('Mongolia'),'Montserrat Is' => __('Montserrat is'),'Morocco' => __('Morocco'),'Mozambique' => __('Mozambique'),'Namibia' => __('Namibia'),'Nauru' => __('Nauru'),'Nepal' => __('Nepal'),'Netheriands Antilles' => __('Netheriands antilles'),'Netherlands' => __('Netherlands'),'New Zealand' => __('New zealand'),'Nicaragua' => __('Nicaragua'),'Niger' => __('Niger'),'Nigeria' => __('Nigeria'),'North Korea' => __('North korea'),'Norway' => __('Norway'),'Oman' => __('Oman'),'Pakistan' => __('Pakistan'),'Panama' => __('Panama'),'Papua New Cuinea' => __('Papua new cuinea'),'Paraguay' => __('Paraguay'),'Peru' => __('Peru'),'Philippines' => __('Philippines'),'Poland' => __('Poland'),'French Polynesia' => __('French polynesia'),'Portugal' => __('Portugal'),'Puerto Rico' => __('Puerto rico'),'Qatar' => __('Qatar'),'Reunion' => __('Reunion'),'Romania' => __('Romania'),'Russia' => __('Russia'),'Saint Lueia' => __('Saint lueia'),'Saint Vincent' => __('Saint vincent'),'Samoa Eastern' => __('Samoa eastern'),'Samoa Western' => __('Samoa western'),'San Marino' => __('San marino'),'Sao Tome and Principe' => __('Sao tome and principe'),'Saudi Arabia' => __('Saudi arabia'),'Senegal' => __('Senegal'),'Seychelles' => __('Seychelles'),'Sierra Leone' => __('Sierra leone'),'Singapore' => __('Singapore'),'Slovakia' => __('Slovakia'),'Slovenia' => __('Slovenia'),'Solomon Is' => __('Solomon is'),'Somali' => __('Somali'),'South Africa' => __('South africa'),'Spain' => __('Spain'),'Sri Lanka' => __('Sri lanka'),'St.Lucia' => __('St.lucia'),'St.Vincent' => __('St.vincent'),'Sudan' => __('Sudan'),'Suriname' => __('Suriname'),'Swaziland' => __('Swaziland'),'Sweden' => __('Sweden'),'Switzerland' => __('Switzerland'),'Syria' => __('Syria'),'Taiwan' => __('Taiwan'),'Tajikstan' => __('Tajikstan'),'Tanzania' => __('Tanzania'),'Thailand' => __('Thailand'),'Togo' => __('Togo'),'Tonga' => __('Tonga'),'Trinidad and Tobago' => __('Trinidad and tobago'),'Tunisia' => __('Tunisia'),'Turkey' => __('Turkey'),'Turkmenistan' => __('Turkmenistan'),'Uganda' => __('Uganda'),'Ukraine' => __('Ukraine'),'United Arab Emirates' => __('United arab emirates'),'United Kiongdom' => __('United kiongdom'),'United States of America' => __('United states of america'),'Uruguay' => __('Uruguay'),'Uzbekistan' => __('Uzbekistan'),'Venezuela' => __('Venezuela'),'Vietnam' => __('Vietnam'),'Yemen' => __('Yemen'),'Yugoslavia' => __('Yugoslavia'),'Zimbabwe' => __('Zimbabwe'),'Zaire' => __('Zaire'),'Zambia' => __('Zambia')];
    }     

    public function getDegreeList()
    {
        return ['High school or below' => __('High school or below'),'College' => __('College'),'Bachelor' => __('Bachelor'),'Master' => __('Master'),'Doctor' => __('Doctor')];
    }     

    public function getCertificateList()
    {
        return ['TEFL' => __('Tefl'),'Teacher certificate' => __('Teacher certificate'),'Others' => __('Others'),'None' => __('None')];
    }     

    public function getVisaStatusList()
    {
        return ['Working Visa' => __('Working Visa'),'Tourist Visa' => __('Tourist Visa'),'Family Visa' => __('Family Visa'),'Student Visa' => __('Student Visa'),'Business Visa' => __('Business Visa'),'Permenant Visa' => __('Permenant Visa'),'Other Visa' => __('Other Visa')];
    }     

    public function getChineseList()
    {
        return ['HSK 1' => __('Hsk 1'),'HSK 2' => __('Hsk 2'),'HSK 3' => __('Hsk 3'),'HSK 4' => __('Hsk 4'),'HSK 5' => __('Hsk 5'),'HSK 6' => __('Hsk 6'),'None' => __('None')];
    }     

    public function getCompanyTypeList()
    {
        return ['Public school' => __('Public school'),'Private school' => __('Private school'),'Kindergarten' => __('Kindergarten'),'International school' => __('International school'),'University' => __('University'),'Adults training school' => __('Adults training school'),'Kids training school' => __('Kids training school'),'Enterprises' => __('Enterprises'),'Others' => __('Others')];
    }     

    public function getCreditScoreList()
    {
        return ['0 Ponint' => __('0 ponint'),'1 Ponint' => __('1 ponint'),'2 Ponints' => __('2 ponints'),'3 Ponints' => __('3 ponints'),'4 Ponints' => __('4 ponints'),'5 Ponints' => __('5 ponints')];
    }     

    public function getFollowUpStatusList()
    {
        return ['Interviewing' => __('Interviewing'),'Signed' => __('Signed'),'Visa processing' => __('Visa processing'),'Arrived' => __('Arrived'),'Agent fee paid' => __('Agent fee paid'),'Failed' => __('Failed')];
    }     

    public function getWorkingStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['working_status']) ? $data['working_status'] : '');
        $list = $this->getWorkingStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getGenderTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['gender']) ? $data['gender'] : '');
        $list = $this->getGenderList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getNationalityTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['nationality']) ? $data['nationality'] : '');
        $list = $this->getNationalityList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getDegreeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['degree']) ? $data['degree'] : '');
        $list = $this->getDegreeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getCertificateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['certificate']) ? $data['certificate'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getCertificateList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }

    public function getVisaStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['visa_status']) ? $data['visa_status'] : '');
        $list = $this->getVisaStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getChineseTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['chinese']) ? $data['chinese'] : '');
        $list = $this->getChineseList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getCompanyTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['company_type']) ? $data['company_type'] : '');
        $list = $this->getCompanyTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getCreditScoreTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['credit_score']) ? $data['credit_score'] : '');
        $list = $this->getCreditScoreList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getFollowUpStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['follow_up_status']) ? $data['follow_up_status'] : '');
        $list = $this->getFollowUpStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setCertificateAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

    public function admin()
    {
        return $this->belongsTo('Admin', 'recorder_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function follow()
    {
        return $this->belongsTo('Follow', 'follow_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function city1()
    {
        return $this->belongsTo('Areas', 'expected_city_1', 'code', [], 'LEFT')->setEagerlyType(0);
    }

    public function city2()
    {
        return $this->belongsTo('Areas', 'expected_city_2', 'code', [], 'LEFT')->setEagerlyType(0);
    }
    //endregion

    //region  查
    public function getList($input) {
        list($where, $sort, $order, $offset, $limit) = $this->check($input);

        //权限查看：方恒伟

        $group = session('admin.group');
        if($group==1){//管理员查看所有
            $total = Db::table($this->table)
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = Db::table($this->table)
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
        }else{//不是管理员
            $total = Db::table($this->table)
                ->where($where)
                ->where(function($query){
                    $query->where(['type'=>'Public'])->whereOr(function($query){
                        $query->where(['type'=>'Private','recorder_id|follow_id'=>session('admin.id')]);
                    });
                })
                ->order($sort, $order)
                ->count();

            $list = Db::table($this->table)
                ->where($where)
                ->where(function($query){
                    $query->where(['type'=>'Public'])->whereOr(function($query){
                        $query->where(['type'=>'Private','recorder_id|follow_id'=>session('admin.id')]);
                    });
                })
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
        }

        foreach ($list as &$val) {
            $city1 = Db::table(config('alias.areas'))->field('province,city')->where('code',$val['expected_city_1'])->select();
            if($city1){
                $val['expected_city_1'] = $city1[0]['province'].' '.$city1[0]['city'];
            }else{
                $val['expected_city_1'] = '';
            }

            $country = Db::table(config('alias.country'))->where('id',$val['nationality'])->value('country');
            $val['nationality'] = $country;
        }
        return ['total'=>$total,'rows'=>$list];
    }

    public function check($input) {
        $sort =$input['sort'] ?? 'id';
        $order =$input['order'] ?? 'DESC';
        $offset =$input['offset'] ?? 0;
        $limit =$input['limit'] ?? 0;
        $where = [];

        if (isset($input['filter'])) {
            $search = json_decode($input['filter']);
            // name
            if (!empty($search->name)) $where['name']= ['like','%'.addslashes($search->name).'%'];
            // expected_city_1
            if (!empty($search->expected_city_1)) $where['expected_city_1']= ['like','%'.addslashes($search->expected_city_1).'%'];
            // type
            if (!empty($search->type)) $where['type']= ['=',addslashes($search->type)];
            // working_status
            if (!empty($search->working_status)) $where['working_status']= ['=',addslashes($search->working_status)];
            // nationality
            if (!empty($search->nationality)) $where['nationality']= ['=',addslashes($search->nationality)];
            // company_type
            if (!empty($search->company_type)) $where['company_type']= ['=',addslashes($search->company_type)];
            //recorder
            if (!empty($search->recorder)) $where['recorder_id']= ['=',addslashes($search->recorder)];
            // follow_up_status
            if (!empty($search->follow_up_status)) $where['follow_up_status']= ['=',addslashes($search->follow_up_status)];
            //arriving_time
            if (!empty($search->arriving_time)) {
                $time = explode(' - ',$search->arriving_time);
                if(!empty($time['0']) && !empty($time['1'])) $where['arriving_time']=['BETWEEN',[$time['0'],$time['1']]];
            }
        }

        return [$where, $sort, $order, $offset, $limit];
    }

    public function getOne($ids) {
        $row = Db::table($this->table)
            ->where('id',$ids)
            ->find();
        $salarys = explode('~',$row['expected_salary']);
        $row['expected_salary_low'] = isset($salarys[0]) ? $salarys[0] : 0;
        $row['expected_salary_high'] = isset($salarys[1]) ? $salarys[1] : 1;
        return $row;
    }

    public function ckeckfollow($id) {
        $row = Db::table(config('alias.follow'))
            ->where('follow_up_id', $id)
            ->order('follow_up_time','desc')
            ->find();
        $user = Db::table(config('alias.admin'))->where('id',$row['follow_up_were'])->value('nickname');
        $row['follow_up_were'] = $user;
        return $row;
    }
    //endregion

    //region  增
    public function add($input) {
        $row = $input['row'];
        $user = Auth::instance();
        $name = Db::table(config('alias.admin'))->where('id',$user->id)->value('nickname');
        //组装数据
        $data = [
            'recorder' => $name,
            'recorder_id' => $user->id,
            'create_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
            'expected_salary' => $row['expected_salary_low'].'~'.$row['expected_salary_high'],
        ];
        $insert_data = array_merge($row,$data);
        unset($insert_data['expected_salary_low']);
        unset($insert_data['expected_salary_high']);
        $insert_id = Db::table($this->table)->insertGetId($insert_data);
        if(!$insert_id) TEA('field');
        return $insert_id;
    }
    //endregion

    //region  改
    public  function change($input) {
        $insert = $input['row'];
        //组装数据
        $data = [
            'update_time' => date('Y-m-d H:i:s',time()),
            'expected_salary' => $insert['expected_salary_low'].'~'.$insert['expected_salary_high'],
        ];
        $insert = array_merge($insert,$data);
        unset($insert['expected_salary_low']);
        unset($insert['expected_salary_high']);
        $upd=Db::table($this->table)->where('id',$input['ids'])->update($insert);
        if($upd===false)  TEA('field');

    }

    public function change_follow($input) {
        $user = Auth::instance();
        $name = Db::table(config('alias.admin'))->where('id',$user->id)->value('nickname');
        $upd=Db::table($this->table)->where('id',$input['ids'])->update([
            'follow_up_status'=>$input['status'],
            'remarks'=>$input['remarks'],
            'follow_id'=>$user->id,
            'follow_name'=>$name,
            'update_time' => date('Y-m-d H:i:s',time()),
            'type' => 'Private',
        ]);

        $check = [
            'follow_up_were'=>$user->id,
            'follow_up_time'=>date('Y-m-d H:i:s',time()),
            'follow_up_status'=>$input['status'],
            'remarks'=>$input['remarks'],
            'follow_up_id'=>$input['ids']
        ];

        Db::table(config('alias.follow'))->insert($check);
        if($upd===false)  TEA('field');
    }
    //endregion
}

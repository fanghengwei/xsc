<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class Foreignteachersblacklist extends Model
{
    // 表名
    protected $name = 'foreign_teachers_black_list';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'nationality_text',
        'create_time_text',
        'update_time_text'
    ];

    /**
     * RetrieveClass constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(empty($this->table)) $this->table = config('alias.ftbl');
    }
    

    
    public function getNationalityList()
    {
        return ['Angola' => __('Angola'),'Afghanistan' => __('Afghanistan'),'Albania' => __('Albania'),'Algeria' => __('Algeria'),'Andorra' => __('Andorra'),'Anguilla' => __('Anguilla'),'Antigua and Barbuda' => __('Antigua and barbuda'),'Argentina' => __('Argentina'),'Armenia' => __('Armenia'),'Ascension' => __('Ascension'),'Australia' => __('Australia'),'Austria' => __('Austria'),'Azerbaijan' => __('Azerbaijan'),'Bahamas' => __('Bahamas'),'Bahrain' => __('Bahrain'),'Bangladesh' => __('Bangladesh'),'Barbados' => __('Barbados'),'Belarus' => __('Belarus'),'Belgium' => __('Belgium'),'Belize' => __('Belize'),'Benin' => __('Benin'),'Bermuda Is.' => __('Bermuda is.'),'Bolivia' => __('Bolivia'),'Botswana' => __('Botswana'),'Brazil' => __('Brazil'),'Brunei' => __('Brunei'),'Bulgaria' => __('Bulgaria'),'Burkina-faso' => __('Burkina-faso'),'Burma' => __('Burma'),'Burundi' => __('Burundi'),'Cameroon' => __('Cameroon'),'Canada' => __('Canada'),'Cayman Is.' => __('Cayman is.'),'Central African Republic' => __('Central african republic'),'Chad' => __('Chad'),'Chile' => __('Chile'),'China' => __('China'),'Colombia' => __('Colombia'),'Congo' => __('Congo'),'Cook Is.' => __('Cook is.'),'Costa Rica' => __('Costa rica'),'Cuba' => __('Cuba'),'Cyprus' => __('Cyprus'),'Czech Republic' => __('Czech republic'),'Denmark' => __('Denmark'),'Djibouti' => __('Djibouti'),'Dominica Rep.' => __('Dominica rep.'),'Ecuador' => __('Ecuador'),'Egypt' => __('Egypt'),'EI Salvador' => __('Ei salvador'),'Estonia' => __('Estonia'),'Ethiopia' => __('Ethiopia'),'Fiji' => __('Fiji'),'Finland' => __('Finland'),'France' => __('France'),'French Guiana' => __('French guiana'),'Gabon' => __('Gabon'),'Gambia' => __('Gambia'),'Georgia' => __('Georgia'),'Germany' => __('Germany'),'Ghana' => __('Ghana'),'Gibraltar' => __('Gibraltar'),'Greece' => __('Greece'),'Grenada' => __('Grenada'),'Guam' => __('Guam'),'Guatemala' => __('Guatemala'),'Guinea' => __('Guinea'),'Guyana' => __('Guyana'),'Haiti' => __('Haiti'),'Honduras' => __('Honduras'),'Hongkong' => __('Hongkong'),'Hungary' => __('Hungary'),'Iceland' => __('Iceland'),'India' => __('India'),'Indonesia' => __('Indonesia'),'Iran' => __('Iran'),'Iraq' => __('Iraq'),'Ireland' => __('Ireland'),'Israel' => __('Israel'),'Italy' => __('Italy'),'Ivory Coast' => __('Ivory coast'),'Jamaica' => __('Jamaica'),'Japan' => __('Japan'),'Jordan' => __('Jordan'),'Kampuchea (Cambodia )' => __('Kampuchea (cambodia )'),'Kazakstan' => __('Kazakstan'),'Kenya' => __('Kenya'),'Korea' => __('Korea'),'Kuwait' => __('Kuwait'),'Kyrgyzstan' => __('Kyrgyzstan'),'Laos' => __('Laos'),'Latvia' => __('Latvia'),'Lebanon' => __('Lebanon'),'Lesotho' => __('Lesotho'),'Liberia' => __('Liberia'),'Libya' => __('Libya'),'Liechtenstein' => __('Liechtenstein'),'Lithuania' => __('Lithuania'),'Luxembourg' => __('Luxembourg'),'Macao' => __('Macao'),'Madagascar' => __('Madagascar'),'Malawi' => __('Malawi'),'Malaysia' => __('Malaysia'),'Maldives' => __('Maldives'),'Mali' => __('Mali'),'Malta' => __('Malta'),'Mariana Is' => __('Mariana is'),'Martinique' => __('Martinique'),'Mauritius' => __('Mauritius'),'Mexico' => __('Mexico'),'Moldova' => __('Moldova'),' Republic of' => __(' republic of'),'Monaco' => __('Monaco'),'Mongolia' => __('Mongolia'),'Montserrat Is' => __('Montserrat is'),'Morocco' => __('Morocco'),'Mozambique' => __('Mozambique'),'Namibia' => __('Namibia'),'Nauru' => __('Nauru'),'Nepal' => __('Nepal'),'Netheriands Antilles' => __('Netheriands antilles'),'Netherlands' => __('Netherlands'),'New Zealand' => __('New zealand'),'Nicaragua' => __('Nicaragua'),'Niger' => __('Niger'),'Nigeria' => __('Nigeria'),'North Korea' => __('North korea'),'Norway' => __('Norway'),'Oman' => __('Oman'),'Pakistan' => __('Pakistan'),'Panama' => __('Panama'),'Papua New Cuinea' => __('Papua new cuinea'),'Paraguay' => __('Paraguay'),'Peru' => __('Peru'),'Philippines' => __('Philippines'),'Poland' => __('Poland'),'French Polynesia' => __('French polynesia'),'Portugal' => __('Portugal'),'Puerto Rico' => __('Puerto rico'),'Qatar' => __('Qatar'),'Reunion' => __('Reunion'),'Romania' => __('Romania'),'Russia' => __('Russia'),'Saint Lueia' => __('Saint lueia'),'Saint Vincent' => __('Saint vincent'),'Samoa Eastern' => __('Samoa eastern'),'Samoa Western' => __('Samoa western'),'San Marino' => __('San marino'),'Sao Tome and Principe' => __('Sao tome and principe'),'Saudi Arabia' => __('Saudi arabia'),'Senegal' => __('Senegal'),'Seychelles' => __('Seychelles'),'Sierra Leone' => __('Sierra leone'),'Singapore' => __('Singapore'),'Slovakia' => __('Slovakia'),'Slovenia' => __('Slovenia'),'Solomon Is' => __('Solomon is'),'Somali' => __('Somali'),'South Africa' => __('South africa'),'Spain' => __('Spain'),'Sri Lanka' => __('Sri lanka'),'St.Lucia' => __('St.lucia'),'St.Vincent' => __('St.vincent'),'Sudan' => __('Sudan'),'Suriname' => __('Suriname'),'Swaziland' => __('Swaziland'),'Sweden' => __('Sweden'),'Switzerland' => __('Switzerland'),'Syria' => __('Syria'),'Taiwan' => __('Taiwan'),'Tajikstan' => __('Tajikstan'),'Tanzania' => __('Tanzania'),'Thailand' => __('Thailand'),'Togo' => __('Togo'),'Tonga' => __('Tonga'),'Trinidad and Tobago' => __('Trinidad and tobago'),'Tunisia' => __('Tunisia'),'Turkey' => __('Turkey'),'Turkmenistan' => __('Turkmenistan'),'Uganda' => __('Uganda'),'Ukraine' => __('Ukraine'),'United Arab Emirates' => __('United arab emirates'),'United Kiongdom' => __('United kiongdom'),'United States of America' => __('United states of america'),'Uruguay' => __('Uruguay'),'Uzbekistan' => __('Uzbekistan'),'Venezuela' => __('Venezuela'),'Vietnam' => __('Vietnam'),'Yemen' => __('Yemen'),'Yugoslavia' => __('Yugoslavia'),'Zimbabwe' => __('Zimbabwe'),'Zaire' => __('Zaire'),'Zambia' => __('Zambia')];
    }     


    public function getNationalityTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['nationality']) ? $data['nationality'] : '');
        $list = $this->getNationalityList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getCreateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['create_time']) ? $data['create_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getUpdateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['update_time']) ? $data['update_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setCreateTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setUpdateTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function getList($input) {
        list($where, $sort, $order, $offset, $limit) = $this->check($input);

        $total = Db::table($this->table)
            ->where($where)
            ->order($sort, $order)
            ->count();

        $list = Db::table($this->table)
            ->where($where)
            ->order($sort, $order)
            ->limit($offset, $limit)
            ->select();

        foreach ($list as &$v) {
            $len = strlen($v['reason_for_blacklist']);
            $v['reason_for_blacklist'] = mb_substr($v['reason_for_blacklist'],0,20);
            if ($len>20) {
                $v['reason_for_blacklist'] .= '......';
            }
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
            // nationality
            if (!empty($search->nationality)) $where['nationality']= ['=',addslashes($search->nationality)];
            //reporter
            if (!empty($search->reporter)) $where['reporter']= ['like','%'.addslashes($search->reporter).'%'];
        }

        return [$where, $sort, $order, $offset, $limit];
    }

    /**
     * 编辑时获取一条数据
     * @param $ids
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author xsc
     * @date 2019-03-23 23:30:10
     */
    public function getOne($ids) {
        $row = Db::table($this->table)
            ->where('id',$ids)
            ->find();
        return $row;
    }

    //region  改
    /**
     * 修改数据
     * @param array $input
     * @return Model|void
     * @author xsc
     * @date 2019-03-23 23:35:13
     */
    public  function change($input) {
        $insert = $input['row'];
        //组装数据
        $data = [
            'update_time' => date('Y-m-d H:i:s',time()),
        ];
        $insert = array_merge($insert,$data);
        $upd=Db::table($this->table)->where('id',$input['ids'])->update($insert);
        if($upd===false)  TEA('field');

    }
    //endregion
}

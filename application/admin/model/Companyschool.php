<?php

namespace app\admin\model;

use app\admin\library\Auth;
use think\Db;
use think\Model;

class Companyschool extends Model
{
    // 表名
    protected $name = 'company_school';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'type_text',
        'work_visa_provided_text',
        'non_native_acceptable_text',
        'housing_text',
        'blacklist_text'
    ];


    /**
     * RetrieveClass constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(empty($this->table)) $this->table = config('alias.cs');
    }
    public function getTypeList()
    {
        return ['Public school' => __('Public school'),'Private school' => __('Private school'),'Kindergarten' => __('Kindergarten'),'International school\nInternational school\n\nInternational school\n\nInternational school\n\nInternational school\n\nInternational school\n\n' => __('International school\ninternational school\n\ninternational school\n\ninternational school\n\ninternational school\n\ninternational school\n\n'),'University' => __('University'),'Adults training school' => __('Adults training school'),'Kids training school' => __('Kids training school'),'Education Company' => __('Education company'),'Enterprises' => __('Enterprises'),'Others' => __('Others')];
    }     

    public function getWorkVisaProvidedList()
    {
        return ['No' => __('No'),'Yes' => __('Yes')];
    }     

    public function getNonNativeAcceptableList()
    {
        return ['No' => __('No'),'Yes' => __('Yes')];
    }     

    public function getHousingList()
    {
        return ['Housing in Campus' => __('Housing in campus'),'Apartment' => __('Apartment')];
    }     

    public function getBlacklistList()
    {
        return ['No' => __('No'),'Yes' => __('Yes')];
    }     

    public function getTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getWorkVisaProvidedTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['work_visa_provided']) ? $data['work_visa_provided'] : '');
        $list = $this->getWorkVisaProvidedList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getNonNativeAcceptableTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['non_native_acceptable']) ? $data['non_native_acceptable'] : '');
        $list = $this->getNonNativeAcceptableList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getHousingTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['housing']) ? $data['housing'] : '');
        $list = $this->getHousingList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getBlacklistTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['blacklist']) ? $data['blacklist'] : '');
        $list = $this->getBlacklistList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function add($input) {
        $user = Auth::instance();
        $row = $input['row'];
        //组装数据
        $data = [
            'creater_id' => $user->id,
            'vacancy' => 1,
            'recruitment_details' => 1,
            'create_time' => date("Y-m-d H:i:s", time()),
            'update_time' => date("Y-m-d H:i:s", time()),
        ];
        $set_data = array_merge($row,$data);
        unset($set_data['Vacancy']);
        unset($set_data['blacklist_reason']);
        $insert_id = Db::table($this->table)->insertGetId($set_data);
        if(!$insert_id) TEA('field');
        return $insert_id;
    }
}

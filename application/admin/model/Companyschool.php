<?php

namespace app\admin\model;

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
        'housing_text'
    ];
    

    
    public function getTypeList()
    {
        return ['Public school' => __('Public school'),'Private school' => __('Private school'),'Kindergarten' => __('Kindergarten'),'International school' => __('International school'),'University' => __('University'),'Adults training school' => __('Adults training school'),'Kids training school' => __('Kids training school'),'Education Company' => __('Education company'),'Enterprises' => __('Enterprises'),'Others' => __('Others')];
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




}

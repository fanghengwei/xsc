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
        'housing_text'
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

    //region  查

    /**
     * 列表数据
     * @param $input
     * @return array
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author xsc
     * @date 2019-03-23 23:30:56
     */
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
            $username = Db::table(config('alias.admin'))
                ->field('nickname')
                ->where("id",$v['creater_id'])
                ->find();
            $v['username'] = $username['nickname'];
        }

        return ['total'=>$total,'rows'=>$list];
    }

    /**
     * 查询时条件搜索
     * @param $input
     * @return array
     * @author xsc
     * @date 2019-03-23 23:30:36
     */
    public function check($input) {
        $sort =$input['sort'] ?? 'create_time';
        $order =$input['order'] ?? 'DESC';
        $offset =$input['offset'] ?? 0;
        $limit =$input['limit'] ?? 0;
        $where = [];

        if (isset($input['filter'])) {
            $search = json_decode($input['filter']);
            // type
            if (!empty($search->type)) $where['type']= ['=',addslashes($search->type)];

            //work_visa_provided
            if (!empty($search->work_visa_provided)) $where['work_visa_provided']= ['=',addslashes($search->work_visa_provided)];

            //non_native_acceptable
            if (!empty($search->non_native_acceptable)) $where['non_native_acceptable']= ['=',addslashes($search->non_native_acceptable)];

            //housing
            if (!empty($search->housing)) $where['housing']= ['=',addslashes($search->housing)];

            //arriving_time
            if (!empty($search->arriving_time)) {
                $time = explode(' - ',$search->arriving_time);
                if(!empty($time['0']) && !empty($time['1'])) $where['arriving_time']=['BETWEEN',[$time['0'],$time['1']]];
            }
            //recorder
            if (!empty($search->username)) {
                $users = Db::table(config('alias.admin'))->where('nickname','like','%'.addslashes($search->username).'%')->column('id');
                $where['creater_id'] = ['in',$users];
            }


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

    public function areas()
    {
        $city = Db::table(config('alias.areas'))
            ->where('pid', '<>', 0)
            ->field('pid as parentId,code as id,city as name,letter')
            ->select();
        return $city;
    }
    //endregion

    //region  增
    /**
     * 增加数据
     * @param $input
     * @return int|string
     * @author xsc
     * @date 2019-03-23 23:34:56
     */
    public function add($input) {
        $row = $input['row'];
        $user = Auth::instance();
        //组装数据
        $data = [
            'creater_id' => $user->id,
            'create_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ];
        $insert_data = array_merge($row,$data);
        $insert_id = Db::table($this->table)->insertGetId($insert_data);
        if(!$insert_id) TEA('field');
        return $insert_id;
    }
    //endregion

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

    //region  删
    public function del($input) {
        $del=Db::table($this->table)->where('id',$input['ids'])->delete();
        if($del===false)  TEA('field');
    }
    //endregion



}

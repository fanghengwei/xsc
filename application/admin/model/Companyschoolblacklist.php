<?php

namespace app\admin\model;

use app\admin\library\Auth;
use think\Db;
use think\Model;

class Companyschoolblacklist extends Model
{
    // 表名
    protected $name = 'company_school_black_list';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'create_time_text',
        'update_time_text'
    ];

    /**
     * RetrieveClass constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(empty($this->table)) $this->table = config('alias.csbl');
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
            $v['recorder'] = $username['nickname'];
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
//        dd($input);
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
}

<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\Foreignteachersblacklist;
use app\common\controller\Backend;
use think\Db;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Foreignteachers extends Backend
{
    
    /**
     * Foreignteachers模型对象
     * @var \app\admin\model\Foreignteachers
     */
    protected $model = null;

    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    protected $noNeedRight = [
        'show_follow',
        'add_blacklist',
        'getCityList',
    ];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Foreignteachers;

        $AdminModel = new Admin();
        $admin_list = $AdminModel->getAdmin();
        $this->assignconfig('admin_list',$admin_list);
        $this->view->assign("workingStatusList", $this->model->getWorkingStatusList());
        $this->view->assign("genderList", $this->model->getGenderList());
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("nationalityList", $this->model->getNationalityList());
        $this->view->assign("degreeList", $this->model->getDegreeList());
        $this->view->assign("certificateList", $this->model->getCertificateList());
        $this->view->assign("visaStatusList", $this->model->getVisaStatusList());
        $this->view->assign("chineseList", $this->model->getChineseList());
        $this->view->assign("companyTypeList", $this->model->getCompanyTypeList());
        $this->view->assign("creditScoreList", $this->model->getCreditScoreList());
        $this->view->assign("followUpStatusList", $this->model->getFollowUpStatusList());
    }

    /**
     * 查看
     */
    public function index() {
        if ($this->request->isAjax()) {
            //过滤/获取参数
            $this->request->filter(['trim']);
            $input=$this->request->param();
            //呼叫M层进行处理
            $result=$this->model->getList($input);
            return json($result);
        }
        return $this->view->fetch();
    }

    public function add() {
        if ($this->request->isPost()) {
            //过滤/获取/验证参数
            $this->request->filter(['trim']);
            $input= $this->request->param();
            //呼叫M层进行处理
            $this->model->add($input);
            $this->success('success');
        }
        //返回界面

        $expected_city_1_list = Db::table('xsc_areas')->where(['pid'=>0])->order('code')->select();
        $this->assign('expected_city_1_list',$expected_city_1_list);
        $expected_city_2_list = Db::table('xsc_areas')->where(['pid'=>110000])->order('code')->select();
        $this->assign('expected_city_2_list',$expected_city_2_list);
        return $this->view->fetch();
    }

    public function getCityList(){
        $html ='';
        $expected_city_2_list = Db::table('xsc_areas')->where(['pid'=>input('pid')])->order('code')->select();
        if($expected_city_2_list){
            foreach ($expected_city_2_list as $city){
                $html .= "<option value='{$city['code']}'>{$city['city']}</option>";
            }
        }
        $html .='';
        return $html;
    }

    public function show_follow($ids = NULL){
        if ($this->request->isPost()) {
            //过滤/获取/id判断/验证参数
            $this->request->filter(['trim']);
            $input= $this->request->param();
            if(empty($input['ids']) || !is_numeric($input['ids'])) TEA(__('Parameter %s is not valid', 'ids'));
            //呼叫M层进行处理
            $this->model->change_follow($input);
            $this->success('success');
        }
        //返回界面
        $row=$this->model->getOne($ids);
        if(empty($row)) $this->error('Not found');
        $this->view->assign("teacher", $row);
        $this->view->assign("key", $row['follow_up_status']);
        return $this->view->fetch();
    }

    public function add_blacklist($ids = NULL){
        //过滤/获取/id判断/验证参数
        $this->request->filter(['trim']);
        $input= $this->request->param();
        if(empty($input['ids']) || !is_numeric($input['ids'])) TEA(__('Parameter %s is not valid', 'ids'));
        //呼叫M层进行处理
        $teacher = Db::table('xsc_foreign_teachers')->where(['id'=>$ids])->find();
        if($teacher){
            $data = [
                'name'=>$teacher['name'],
                'nationality'=>$teacher['nationality'],
                'passport_no'=>$teacher['passport'],
                'contact_information'=>$teacher['contact_information'],
                'reporter'=>1,
                'creater_id'=>$teacher['recorder_id'],
                'contace_name'=>1
            ];
            $Foreignteachersblacklist = new Foreignteachersblacklist();
            if(Db::table('xsc_foreign_teachers_black_list')->where(['passport_no'=>$teacher['passport']])->find()){
                $this->error('护照号重复');
            }
            $result = $Foreignteachersblacklist->insertGetId($data);
            if($result){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->success('查无此teacher');
        }
    }

    //region  改
    public function edit($ids = NULL) {
        if ($this->request->isPost()) {
            //过滤/获取/id判断/验证参数
            $this->request->filter(['trim']);
            $input= $this->request->param();
            if(empty($input['ids']) || !is_numeric($input['ids'])) TEA(__('Parameter %s is not valid', 'ids'));

            //权限验证
            if(session('admin.group')!=1){
                $teacher = Db::table('xsc_foreign_teachers')->where(['id'=>$input['ids']])->find();
                if($teacher['recorder_id']!=session('admin.id')){
                    $this->error('只有超级管理员和创建人才能修改！');
                }
            }
            //呼叫M层进行处理
            $this->model->change($input);
            $this->success('success');
        }
        //返回界面
        $row=$this->model->getOne($ids);
        if(empty($row)) $this->error('Not found');
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }
    //endregion
}

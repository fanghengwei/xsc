<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\common\controller\Backend;

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
        return $this->view->fetch();
    }

    public function show_follow(){
        if ($this->request->isPost()) {
            $this->model->where(['id'=>input('id')])->update(['follow_up_status'=>input('status'),'remarks'=>input('remarks')]);

            $teacher = $this->model->get(['id'=>input('ids')]);
            $this->assign('teacher',$teacher);
            $this->assign('key',$teacher['follow_up_status']);
        }else{
            $teacher = $this->model->get(['id'=>input('ids')]);
            $this->assign('teacher',$teacher);
            $this->assign('key',$teacher['follow_up_status']);
        }
        return $this->view->fetch();
    }

    //region  改
    public function edit($ids = NULL) {
        if ($this->request->isPost()) {
            //过滤/获取/id判断/验证参数
            $this->request->filter(['trim']);
            $input= $this->request->param();
            if(empty($input['ids']) || !is_numeric($input['ids'])) TEA(__('Parameter %s is not valid', 'ids'));
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

<?php

namespace app\admin\controller;

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
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}

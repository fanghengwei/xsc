<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Foreignteachersblacklist extends Backend
{
    
    /**
     * Foreignteachersblacklist模型对象
     * @var \app\admin\model\Foreignteachersblacklist
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Foreignteachersblacklist;
        $this->view->assign("nationalityList", $this->model->getNationalityList());
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



}

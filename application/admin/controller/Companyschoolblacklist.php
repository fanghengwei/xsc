<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Companyschoolblacklist extends Backend
{
    
    /**
     * Companyschoolblacklist模型对象
     * @var \app\admin\model\Companyschoolblacklist
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Companyschoolblacklist;

    }

    //region  查
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
    //endregion

    //region  增
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
    //endregion

    //region  改
    /**
     * 修改数据
     * @param null $ids
     * @return string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author xsc
     * @date 2019-03-23 23:46:28
     */
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

<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\exception\HttpResponseException;
use think\Response;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Companyschool extends Backend
{
    
    /**
     * Companyschool模型对象
     * @var \app\admin\model\Companyschool
     */
    protected $model = null;
    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    protected $noNeedRight = [
        'getAreas',
    ];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Companyschool;
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("workVisaProvidedList", $this->model->getWorkVisaProvidedList());
        $this->view->assign("nonNativeAcceptableList", $this->model->getNonNativeAcceptableList());
        $this->view->assign("housingList", $this->model->getHousingList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


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

    public function getAreas()
    {
        $list = $this->model->areas();
        $this->api_response($list);
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

    //region  删
    /**
     * 删除数据
     * @param string $ids
     * @author xsc <xsctx7788@126.com>
     * @date 2019-03-23 23:45:41
     */
    public  function  del($ids='')
    {
        //参数检测
        $input= $this->request->param();
        if(empty($input['ids'])) TEA(__('Parameter %s can not be empty', 'ids'));
        //删除
        $this->model->del($input);
        $this->success('delete success');
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

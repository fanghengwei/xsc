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
        $admin_list = $AdminModel->select();
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
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with(['admin','follow','city1','city2'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['admin','follow','city1','city2'])
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function add(){
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validate($validate);
                    }
                    $params['create_time']=date("Y-m-d H:i:s");
                    $params['update_time']=date("Y-m-d H:i:s");
                    $result = $this->model->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($this->model->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
}

<?php

namespace app\admin\model;

use think\Model;
use think\Session;

class Areas extends Model
{

    protected $name = 'areas';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

}

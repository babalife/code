<?php

/**
 * Created by PhpStorm.
 * User: babalife
 * Date: 2020/12/12
 * Time: 9:54 上午
 * Git: https://github.com/babalife
 */

namespace app\admin\controller;
use app\admin\business\AdminUser as AdminUserBus;
use app\common\basic\Result;

class User extends BaseAuth
{
    // 渲染列表页
    public function index()
    {
        return view();
    }

    // 查询用户
    public function list()
    {
        $list = (new AdminUserBus())->getPageList();
        return Result::success($list);
    }

}
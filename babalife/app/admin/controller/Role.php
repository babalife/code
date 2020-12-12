<?php


namespace app\admin\controller;

use app\admin\business\AdminUserRole;
use app\admin\validate\AdminUserRole as AdminUserRoleValidate;
use app\common\basic\Result;

// 用户角色控制器
class Role extends BaseAuth
{
    // 列表页面渲染
    public function index()
    {
        return view();
    }

    // 编辑页面渲染
    public function roleform()
    {
        return view();
    }

    // 列表数据
    public function lists()
    {
        
    }

    // 新增
    public function save()
    {
        $data = input('post.');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserRole())->insertDate($data);
        if ($result) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 编辑
    public function edit($id)
    {

    }

    // 修改
    public function update($id)
    {

    }

    // 删除
    public function delete($id)
    {

    }
}
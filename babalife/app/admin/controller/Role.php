<?php


namespace app\admin\controller;

use app\admin\business\AdminUserRole as AdminUserRoleBus;
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
    public function list()
    {
        $result = (new AdminUserRoleBus())->getPageList();
        if ($result) {
            return Result::success($result);
        }

        return Result::error('获取失败');
    }

    // 新增
    public function save()
    {
        $data = input('post.');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserRoleBus())->insertDate($data);
        if ($result) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 编辑
    public function edit($id)
    {
        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $menuInfo = (new AdminUserRoleBus())->getById($id);
        if ($menuInfo) {
            return Result::success($menuInfo);
        }

        return Result::error('获取失败');
    }

    // 修改
    public function update($id)
    {
        $data = input('post.');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserRoleBus())->updateById($id, $data);
        if ($result) {
            return Result::success($result, '修改成功');
        }

        return Result::error('修改失败');
    }

    // 删除
    public function delete($id)
    {
        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserRoleBus())->delById($id);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }
}
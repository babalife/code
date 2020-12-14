<?php


namespace app\admin\controller;

use app\admin\business\AdminRole as AdminRoleBus;
use app\admin\business\AdminRoleMenu as AdminRoleMenuBus;
use app\admin\validate\AdminRole as AdminUserRoleValidate;
use app\common\basic\Result;
use think\facade\Request;

// 用户角色控制器
class Role extends BaseAuth
{
    // 列表页面渲染
    public function index()
    {
        return view();
    }

    // 列表数据
    public function list()
    {
        $result = (new AdminRoleBus())->getPageList();
        if ($result) {
            return Result::success($result);
        }

        return Result::error('获取失败');
    }

    // 新增
    public function save()
    {
        $data = Request::only(['name', 'desc'], 'post');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new AdminRoleBus())->insertDate($data);
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

        $menuInfo = (new AdminRoleBus())->getById($id);
        if ($menuInfo) {
            return Result::success($menuInfo);
        }

        return Result::error('获取失败');
    }

    // 修改
    public function update($id)
    {
        $data = Request::only(['name', 'desc'], 'post');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('update')->check(['id' => $id, 'name'=>$data['name']])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminRoleBus())->updateById($id, $data);
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

        $result = (new AdminRoleBus())->delById($id);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }

    // 批量删除
    public function deleteAll()
    {
        $ids = input('post.ids', '', 'trim');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('id')->check(['id' => $ids])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminRoleBus())->delByIds($ids);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }

    // 设置角色菜单
    public function setRoleMenu()
    {
        $data = Request::only(['role_id', 'menu_ids'], 'post');

        $validate = new AdminUserRoleValidate();
        if (!$validate->scene('role_menu')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new AdminRoleMenuBus())->setRoleMenu($data);
        if ($result) {
            return Result::success([], '操作成功');
        }

        return Result::error('操作失败');
    }
}
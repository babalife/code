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
use app\admin\business\AdminUserRole as AdminUserRoleBus;
use app\admin\validate\AdminUser as AdminUserValidate;
use app\common\basic\Result;
use think\facade\Request;

class User extends BaseAuth
{
    // 渲染列表页
    public function index()
    {
        return view();
    }

    // 查询用户
    public function pageList()
    {
        $result = (new AdminUserBus())->getPageLists();
        if ($result) {
            return Result::success($result);
        }

        return Result::error('获取失败');
    }

    // 新增
    public function save()
    {
        $data = Request::only(['id', 'username', 'nick_name', 'role_id', 'status'], 'post');

        $validate = new AdminUserValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }
        $time = time();
        $roleId = $data['role_id'];
        unset($data['role_id']);

        $data['last_login_ip'] = \request()->ip();
        $data['password'] = md5(md5('admin'));

        $result = (new AdminUserBus())->insertDate($data);
        $roleResult = (new AdminUserRoleBus())->insertDate(['user_id' => $result, 'role_id' => $roleId]);
        if ($result && $roleResult) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 修改
    public function update($id)
    {
        $data = Request::only(['id', 'username', 'nick_name', 'status'], 'post');
        $roleId = input('post.role_id');

        $validate = new AdminUserValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        // 用户表修改
        $result = (new AdminUserBus())->updateById($id, $data);
        // 角色关联表修改
        if ($roleId) {
            $roleResult = (new AdminUserRoleBus())->updateById($id, ['role_id' => $roleId]);
        }
        if ($result) {
            return Result::success($result, '修改成功');
        }

        return Result::error('修改失败');
    }

    // 删除
    public function delete($id)
    {
        $validate = new AdminUserValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserBus())->delById($id);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }

    // 批量删除
    public function deleteAll()
    {
        $ids = input('post.ids', '', 'trim');

        $validate = new AdminUserValidate();
        if (!$validate->scene('id')->check(['id' => $ids])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminUserBus())->delByIds($ids);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }
}
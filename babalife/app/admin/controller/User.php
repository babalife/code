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
use app\admin\validate\AdminUser as AdminUserValidate;
use app\common\basic\Result;
use app\common\basic\Str;
use think\Exception;
use think\facade\Request;

class User extends BaseAuth
{
    // 渲染列表页
    public function index()
    {
        return view();
    }

    // 渲染修改密码页
    public function password()
    {
        return view();
    }

    // 设置密码
    public function setpass()
    {
        $data = Request::only(['oldPassword', 'password', 'repassword'], 'post');

        $validate = new AdminUserValidate();
        if (!$validate->scene('setpass')->check($data)) {
            return Result::error($validate->getError());
        }

        $adminUser = getSessionAdminUser();
        // 校验原密码
        if (Str::userEncrypt($data['oldPassword']) !== $adminUser['password']) {
            return Result::error('原密码不正确，请重新输入');
        }

        try {
            $result = (new AdminUserBus())->updateById($adminUser['id'], ['password' => Str::userEncrypt($data['password'])]);
        } catch (Exception $e) {
            return Result::error($e->getMessage());
        }
        if ($result) {
            return Result::success([], '修改密码成功');
        }

        return Result::error('修改密码失败');
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
        $data = Request::only(['username', 'nick_name', 'role_id'], 'post');

        $validate = new AdminUserValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        try {
            $result = (new AdminUserBus())->insertDate($data);
        } catch (Exception $e) {
            return Result::error($e->getMessage());
        }

        if ($result) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 修改
    public function update($id)
    {
        $data = Request::only(['id', 'username', 'nick_name', 'status', 'role_id'], 'post');

        $validate = new AdminUserValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        // 用户表修改
        try {
            $result = (new AdminUserBus())->updateById($id, $data);
        } catch (Exception $e) {
            return Result::error($e->getMessage());
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

    // 重置密码
    public function reset()
    {
        $id = input('post.id', '', 'intval');

        $validate = new AdminUserValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $updateData = [
            'password' => Str::userEncrypt('123456')
        ];
        try {
            $result = (new AdminUserBus())->updateById($id, $updateData);
        } catch (Exception $e) {
            return Result::error($e->getMessage());
        }
        if ($result) {
            return Result::success([], '重置成功');
        }

        return Result::error('重置失败');
    }
}
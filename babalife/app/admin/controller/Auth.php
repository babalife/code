<?php


namespace app\admin\controller;


use app\admin\business\AdminUser as AdminUserBus;
use app\admin\validate\AdminUser as AdminUserValidate;
use app\common\basic\Result;
use think\Exception;
use think\facade\Request;

class Auth extends Base
{
    // 登录页
    public function login()
    {
        return view();
    }

    // 登录
    public function check()
    {
        $data = Request::only(['username', 'password'], 'post');

        $validate = new AdminUserValidate();
        if (!$validate->scene('login')->check($data)) {
            return Result::error($validate->getError());
        }

        try {
            $result = (new AdminUserBus())->login($data);
        } catch (Exception $e) {
            return Result::error($e->getMessage());
        }

        if ($result) {
            return Result::success([], '登录成功');
        }

        return Result::error('登录失败');
    }

    // 退出登录
    public function logout()
    {
        setSessionAdminUser(null);
        redirect(url('/admin/auth/login'))->send();
    }
}
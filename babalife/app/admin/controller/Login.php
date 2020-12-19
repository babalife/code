<?php


namespace app\admin\controller;
use app\admin\business\AdminUser as AdminUserBus;
use app\admin\validate\AdminUser as AdminUserValidate;
use app\common\basic\Result;
use think\Exception;
use think\facade\Request;

//登录
class Login extends Base
{
    public function index()
    {
        return view();
    }

    public function login()
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

}
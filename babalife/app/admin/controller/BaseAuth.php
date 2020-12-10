<?php


namespace app\admin\controller;

// 鉴权控制器
class BaseAuth extends Base
{
    protected $user = null;

    // 登录校验
    protected function initialize()
    {
        if (!$this->isLogin()){
            redirect(url('/admin/login/index'))->send();
        }
    }

    // 是否登录
    public function isLogin(){

        // 本地调试模式，线上.dev设置为 false
        if (env('APP_DEBUG', false)){
            return true;
        }

        $user = session('admin_user');
        if ($user && $user['id']) {
            $this->user = $user;
            return true;
        }

        return false;
    }
}
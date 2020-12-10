<?php


namespace app\controller;

// 鉴权控制器
class BaseAuth extends Base
{
    protected $user = null;

    // 登录校验
    protected function initialize()
    {
        if (!$this->isLogin()){
            redirect(url('/index'))->send();
        }
    }

    // 是否登录
    public function isLogin(){
        $user = session('index_user');

        if ($user && $user['id']) {
            $this->user = $user;
            return true;
        }

        return false;
    }
}
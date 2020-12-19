<?php


namespace app\admin\controller;

// 鉴权控制器
use think\Exception;
use think\facade\Db;

class BaseAuth extends Base
{
    protected $user = null;

    // 登录校验
    protected function initialize()
    {
        // 未登录
        if (!$this->isLogin()) {
            redirect(url('/admin/login/index'))->send();
        }

        // 菜单权限校验
        $this->isMenu();
    }

    // 是否登录
    public function isLogin()
    {
        // 本地调试模式，线上.dev设置为 false
//        if (env('APP_DEBUG', false)) {
//            $this->user = Db::name('admin_user')->find(12);
//            return true;
//        }

        $user = session(config('code.session.admin'));
        if ($user && $user['id']) {
            $this->user = $user;
            return true;
        }

        return false;
    }

    // 菜单权限校验
    public function isMenu()
    {
        $menu = strtolower(request()->controller());
        if ($menu != 'index' && !in_array($menu, $this->user['authority'])) {
            echo '无权限访问';
            exit;
        }
    }
}
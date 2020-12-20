<?php


namespace app\admin\controller;
use app\admin\business\AdminUserRole as AdminUserRoleBus;

// 鉴权控制器
class BaseAuth extends Base
{
    protected $user = null;

    // 菜单访问白名单
    protected $menu_white = ['index', 'auth'];

    // 登录校验
    protected function initialize()
    {
        // 未登录
        if (!$this->isLogin()) {
            redirect(url('/admin/auth/login'))->send();
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

        $user = getSessionAdminUser();
        if ($user && $user['id']) {
            $this->user = $user;
            return true;
        }

        return false;
    }

    // 菜单权限校验
    public function isMenu()
    {
        // 判断是否登录
        $adminUser = getSessionAdminUser();
        if (empty($adminUser)) {
            exit('请先登录');
        }

        // 默认超级用户角色，不校验
        $result = (new AdminUserRoleBus())->getById($this->user['id']);
        if ($result['role_id'] == '1') {
            return;
        }

        $menu = strtolower(request()->controller());
        if (!in_array($menu, $this->menu_white) && !in_array($menu, $this->user['authority'])) {
            echo '无权限访问';
            exit;
        }
    }
}
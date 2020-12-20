<?php

namespace app\admin\controller;

use app\admin\business\AdminMenu as MenuBus;
use app\admin\business\AdminRoleMenu as AdminRoleMenuBus;
use app\common\basic\Arr;

class Index extends BaseAuth
{
    // iframe全局页面
    public function index()
    {
        // 默认数据
        $homeInfo = [
            'adminName' => '后台管理系统',
            'name' => '控制面板',
            'href' => '/admin/index/dashboard'
        ];

        // 顶部数据
        $headInfo = [
            // 管理员名称
            'name' => $this->user['nick_name'],
            // 菜单，可设置上下分割线，top_line/bottom_line
            'menu' => [
                ['name' => '修改密码', 'path' => '/admin/user/password'],
                ['name' => '菜单管理', 'path' => '/admin/menu/index'],
                ['name' => '退出', 'path' => '/admin/auth/logout', 'top_line' => true],
            ]
        ];


        // 左侧菜单数据
        $menuList = [];

        // 根据角色id，查询菜单
        $roleMenu = (new AdminRoleMenuBus())->getMenuIds();
        if (isset($roleMenu['menu']['menu_ids'])) {

            $menuList = (new MenuBus())->getMenuNormalListsByMenuIds('*', $roleMenu['menu']['menu_ids']);

            // 存储菜单权限
            $adminUser = getSessionAdminUser();
            $adminUser['authority'] = array_column($menuList, 'authority');
            setSessionAdminUser($adminUser);
        }

        // 得到菜单树
        $menuInfo = Arr::getTree($menuList);

        return view('', [
            'homeInfo' => $homeInfo,
            'headInfo' => $headInfo,
            'menuInfo' => $menuInfo
        ]);
    }

    // 控制面板
    public function dashboard()
    {
        return view();
    }
}

<?php

namespace app\admin\controller;

use app\admin\business\AdminMenu as MenuBus;
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
                ['name' => '基本资料', 'path' => '/admin/user/index'],
                ['name' => '菜单管理', 'path' => '/admin/menu/index'],
                ['name' => '退出', 'path' => '/admin/logout/index', 'top_line' => true],
            ]
        ];

        // 左侧菜单数据
        $menuInfo = Arr::getTree((new MenuBus())->getMenuNormalLists());

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

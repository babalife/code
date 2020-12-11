<?php
namespace app\admin\controller;

use app\BaseController;
use app\admin\business\Menu as MenuBus;
use app\common\basic\Arr;

class Index extends Base
{
    // iframe全局页面
    public function index()
    {
        $homeInfo = [
            'name' => '控制面板',
            'href' => '/admin/index/dashboard'
        ];
        $logoInfo = [];
        $menuInfo = Arr::getTree((new MenuBus())->getMenuNormalLists());

        return view('', [
            'homeInfo' => $homeInfo,
            'menuInfo'=> $menuInfo
        ]);
    }

    // 控制面板
    public function dashboard()
    {
        return view();
    }
}

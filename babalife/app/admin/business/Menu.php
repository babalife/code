<?php


namespace app\admin\business;
use app\admin\model\Menu as MenuModel;

// 菜单管理业务逻辑
class Menu extends BaseBus
{
    // 数据模型初始化
    public function __construct()
    {
        $this->model = new MenuModel();
    }

}
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

    // 新增
    public function insertDate($data)
    {
        try {
            $result = $this->model->save($data);
        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }

    // 分页查询
    public function getMenuLists($page = 10)
    {
        try {
            $lists = $this->model->paginate($page);
        } catch (\Exception $e) {
            $lists = [];
        }

        return $lists?$lists->toArray():$lists;
    }

    // 指定id查询
    public function getMenuById($id)
    {
        try {
            $menu = $this->model->find($id);
        } catch (\Exception $e) {
            $menu = false;
        }

        return $menu;
    }

    // 指定id删除
    public function delMenuById($id)
    {
        try {
            $result = $this->model->where('id', $id)->delete();
        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }
}
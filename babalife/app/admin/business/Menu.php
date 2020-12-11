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
    public function getMenuPageLists($page = 10)
    {
        try {
            $lists = $this->model->where('pid', 0)->order('sort', 'asc')->paginate($page);
            if ($lists) {
                $lists = $lists->toArray();
                $listsChild = $this->model->whereIn('pid', implode(',', array_column($lists['data'], 'id')))->select()->toArray();
                $lists['data'] = array_merge($lists['data'], $listsChild);
            }
        } catch (\Exception $e) {
            $lists = [];
        }

        return $lists;
    }

    // 一级菜单查询
    public function getTopMenuLists()
    {
        try {
            $lists = $this->model->order('sort', 'asc')->where('pid', 0)->select();
        } catch (\Exception $e) {
            $lists = [];
        }

        return $lists ? $lists->toArray() : $lists;
    }

    // 所有菜单查询
    public function getMenuNormalLists()
    {
        try {
            $lists = $this->model->order('sort', 'asc')->where('status', 1)->select();
        } catch (\Exception $e) {
            $lists = [];
        }

        return $lists ? $lists->toArray() : $lists;
    }

    // 指定id查询
    public function getMenuById($id)
    {
        try {
            $menu = $this->model->find($id);
        } catch (\Exception $e) {
            $menu = [];
        }

        return $menu;
    }

    // 指定id删除
    public function delMenuById($id)
    {
        try {
            $result = $this->model->where('id', $id)->delete();
            $this->model->where('pid', $id)->delete();
        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }

    // 指定id更新数据
    public function updateMenuById($id, $data)
    {
        $data['update_time'] = time();

        try {
            $result = $this->model->where('id', $id)->save($data);
        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }
}
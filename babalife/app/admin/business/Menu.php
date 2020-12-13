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

    // 指定id删除，重写
    public function delById($id)
    {
        try {
            $result = parent::delById($id);
            $this->model->where('pid', $id)->delete();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 指定ID更新，重写
    public function updateById($id, $data)
    {
        try {
            $result = parent::updateById($id, $data);
            $this->model->where('pid', $id)->save(['status' => $data['status']]);
        } catch (\Exception $e) {
            $result = [];
        }
        return $result;
    }
}
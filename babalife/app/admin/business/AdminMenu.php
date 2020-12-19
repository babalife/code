<?php


namespace app\admin\business;

use app\admin\model\AdminMenu as MenuModel;
use app\admin\business\AdminRoleMenu as AdminRoleMenuBus;
use app\common\basic\Arr;

// 菜单管理业务逻辑
class AdminMenu extends BaseBus
{
    // 数据模型初始化
    public function __construct()
    {
        $this->model = new MenuModel();
    }

    // 根据菜单ids查询菜单
    public function getMenuNormalListsByMenuIds($filed = '*', $menuIds = '')
    {
        try {
            $lists = $this->model
                ->field($filed)
                ->whereIn('id', $menuIds)
                ->order('sort', 'asc')
                ->where('status', 1)
                ->select();
        } catch (\Exception $e) {
            $lists = [];
        }

        return $lists ? $lists->toArray() : $lists;
    }

    // 查询所有正常菜单
    public function getMenuNormalLists($filed = '*')
    {
        try {
            $lists = $this->model
                ->field($filed)
                ->order('sort', 'asc')
                ->where('status', 1)
                ->select();
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

    // 菜单树，数据列表
    public function treeList($id = 0)
    {
        try {
            // 获取正常数据
            $filed = 'name as title, id, pid';
            $list = $this->getMenuNormalLists($filed);
            $roleMenu = (new AdminRoleMenuBus())->getByRoleId($id);
            $noChecked = array_values(array_column($list, 'pid'));
            foreach ($list as $index => $item) {
                $list[$index]['spread'] = true;
                if ($roleMenu && strpos($roleMenu['menu_ids'], (string)$item['id']) !== false) {
                    if (!in_array($item['id'], $noChecked)) {
                        $list[$index]['checked'] = true;
                    }
                }
            }
            // 组成tree树
            $list = Arr::getTree($list, 'pid', 'children');
        } catch (\Exception $e) {
            $list = [];
        }

        return $list;
    }
}
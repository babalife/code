<?php


namespace app\admin\business;

use app\admin\model\AdminMenu as MenuModel;
use app\common\basic\Arr;

// 菜单管理业务逻辑
class AdminMenu extends BaseBus
{
    // 数据模型初始化
    public function __construct()
    {
        $this->model = new MenuModel();
    }

    // 所有菜单查询
    public function getMenuNormalLists($filed = '*')
    {
        try {
            $lists = $this->model->field($filed)->order('sort', 'asc')->where('status', 1)->select();
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
    public function treeList()
    {
        try {
            // 获取正常数据
            $filed = 'name as title, id, pid';
            $list = $this->getMenuNormalLists($filed);
            foreach ($list as &$item) {
                $item['spread'] = true;
            }
            // 组成tree树
            $list = Arr::getTree($list, 'pid', 'children');
        } catch (\Exception $e) {
            $list = [];
        }

        return $list;
    }
}
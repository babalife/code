<?php


namespace app\admin\business;

use app\admin\model\AdminUserRole as AdminUserRoleModel;

class AdminUserRole extends BaseBus
{
    public function __construct()
    {
        $this->model = (new AdminUserRoleModel());
    }

    public function getById($id, $field = '*')
    {
        try {
            $result = $this->model->where('user_id', $id)->find();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 重写
    public function updateById($id, $data)
    {
        try {
            $result = $this->model->where('user_id', $id)->save($data);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 重写
    public function delById($id)
    {
        try {
            $result = $this->model->where('user_id', $id)->delete();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 重写
    public function delByIds($ids)
    {
        try {
            $result = $this->model->whereIn('user_id', $ids)->delete();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 根据用户id，查菜单Ids
    public function getMenuIdsByUserId($userId)
    {
        try {
            $result = $this->model->with('menu')->where('user_id', $userId)->find();
        } catch (\Exception $e) {
            $result = [];
        }
        return $result;
    }
}
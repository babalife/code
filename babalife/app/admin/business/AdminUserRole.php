<?php


namespace app\admin\business;

use app\admin\model\AdminUserRole as AdminUserRoleModel;

class AdminUserRole extends BaseBus
{
    public function __construct()
    {
        $this->model = (new AdminUserRoleModel());
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
}
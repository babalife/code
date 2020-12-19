<?php

/**
 * Created by PhpStorm.
 * User: babalife
 * Date: 2020/12/14
 * Time: 9:08 下午
 * Git: https://github.com/babalife
 */

namespace app\admin\business;

use app\admin\model\AdminRoleMenu as AdminRoleMenuModel;
use function mysql_xdevapi\getSession;

class AdminRoleMenu extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminRoleMenuModel();
    }

    // 设置角色菜单权限
    public function setRoleMenu($data)
    {
        try {
            if ($this->getByRoleId($data['role_id'])) {
                // 存在角色则修改
                $result = $this->model->where('role_id', $data['role_id'])->save($data);
            } else {
                // 不存在则新增
                $result = $this->insertDate($data);
            }
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 根据角色ID查询
    public function getByRoleId($id)
    {
        try {
            $result = $this->model->where('role_id', $id)->find();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 得到登录的角色菜单ids
    public function getMenuIds()
    {
        $adminUser = getSessionAdminUser();
        return (new AdminUserRole())->getMenuIdsByUserId($adminUser['id']);
    }
}
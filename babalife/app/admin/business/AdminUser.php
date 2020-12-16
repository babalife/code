<?php

/**
 * Created by PhpStorm.
 * User: babalife
 * Date: 2020/12/12
 * Time: 9:54 上午
 * Git: https://github.com/babalife
 */

namespace app\admin\business;

use app\admin\model\AdminUser as AdminUserModel;
use app\admin\model\AdminUserRole as AdminUserRoleModel;
use think\facade\Db;


class AdminUser extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminUserModel();
    }

    // 查询用户列表
    public function getPageLists($limit = 10)
    {
        $field = 'u.*, r.name as role_name';
        try {
            $list = Db::name('admin_user')
                ->alias('u')
                ->join('admin_user_role ur', 'ur.user_id = u.id', 'left')
                ->join('admin_role r', 'r.id = ur.role_id', 'left')
                ->field($field)
                ->paginate($limit);
        } catch (\Exception $e) {
            $list = [];
        }

        return $list ? $list->toArray() : $list;
    }
}
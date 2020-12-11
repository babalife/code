<?php


namespace app\admin\business;
use app\admin\model\AdminUserRole as AdminUserRoleModel;

class AdminUserRole extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminUserRoleModel();
    }
}
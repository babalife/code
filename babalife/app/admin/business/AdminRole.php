<?php


namespace app\admin\business;
use app\admin\model\AdminRole as AdminUserRoleModel;

class AdminRole extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminUserRoleModel();
    }
}
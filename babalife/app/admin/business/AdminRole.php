<?php


namespace app\admin\business;
use app\admin\model\AdminRole as AdminRoleModel;

class AdminRole extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminRoleModel();
    }
}
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


class AdminUser extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminUserModel();
    }
}
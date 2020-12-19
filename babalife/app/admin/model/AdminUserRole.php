<?php

/**
 * Created by PhpStorm.
 * User: babalife
 * Date: 2020/12/16
 * Time: 7:32 上午
 * Git: https://github.com/babalife
 */

namespace app\admin\model;


class AdminUserRole extends BaseModel
{
    public function menu()
    {
        return $this->hasOne(AdminRoleMenu::class, 'role_id', 'role_id');
    }
}
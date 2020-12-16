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
    public function role()
    {
        return $this->hasOne(AdminRole::class, 'id', 'role_id');
    }

    // 根据用户id获取角色信息
    public function getRoleByUserIds($ids)
    {
        return $this->with('role')->whereIn('user_id', $ids)->select();
    }
}
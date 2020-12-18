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
use app\common\basic\Str;
use think\Exception;
use think\facade\Db;


class AdminUser extends BaseBus
{
    public function __construct()
    {
        $this->model = new AdminUserModel();
    }

    // 登录
    public function login($data)
    {
        // 判断用户是否存在
        $adminUser = $this->getAdminUserNormalByUsername($data['username']);
        if (empty($adminUser)) {
            throw new Exception('该用户不存在');
        }

        // 判断密码是否正确
        if (Str::userEncrypt($data['password'], $adminUser['create_time']) != $adminUser['password']) {
            throw new Exception('密码错误');
        }

        // 将需要信息记录 mysql 中
        $updateData = [
            'last_login_ip' => request()->ip(),
            'last_login_time' => time(),
            'update_time' => time()
        ];
        $result = $this->updateById($adminUser['id'], $updateData);
        if (empty($result)) {
            throw new Exception('登录失败');
        }

        // 记录session
        session(config('code.session.admin'), $adminUser);
        return true;
    }

    // 添加用户
    public function insertDate($data)
    {
        // 判断该用户是否存在
        $this->getAdminUserByUsername($data['username'], config(''));
        // 组装要记录的数据
        // 用户和角色关联建立关系
    }

    // 根据账号查询用户信息
    public function getAdminUserByUsername($username, $status)
    {
        try {
            $result = $this->model
                ->where('status', config('code.mysql.table_normal'))
                ->where('username', $username)
                ->find();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 查询用户列表
    public function getPageLists($limit = 10)
    {
        $field = 'u.*, r.name as role_name, r.id as role_id';
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
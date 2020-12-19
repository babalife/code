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
use app\admin\business\AdminUserRole as AdminUserRoleBus;
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
        $adminUser = $this->getAdminUserByUsername($data['username']);
        if (!$adminUser) {
            throw new Exception('该用户不存在');
        }

        // 判断密码是否正确
        if (Str::userEncrypt($data['password']) != $adminUser['password']) {
            throw new Exception('密码错误');
        }

        // 判断用户是否可用
        if ($adminUser['status'] != config('code.mysql.table_normal')) {
            throw new Exception('账号已停用');
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
        setSessionAdminUser($adminUser);
        return true;
    }

    // 添加用户
    public function insertDate($data)
    {
        // 判断该用户是否存在
        $adminUser = $this->getAdminUserByUsername($data['username']);
        if ($adminUser) {
            throw new Exception('该账号已存在，请重新输入');
        }

        // 事务开启
        $this->model->startTrans();

        // 添加用户
        $data['password'] = Str::userEncrypt('123456');
        $result = $this->model->save($data);
        if (!$result) {
            $this->model->rollback();
            throw new Exception('添加用户失败');
        }

        // 用户和角色关联建立关系
        $insertData = [
            'user_id' => $this->model->id,
            'role_id' => $data['role_id']
        ];
        $result = (new AdminUserRoleBus())->insertDate($insertData);
        if (!$result) {
            $this->model->rollback();
            throw new Exception('角色关联失败');
        }

        // 事务提交
        $this->model->commit();
        return true;
    }

    // 更新数据
    public function updateById($id, $data)
    {
        if (isset($data['username'])) {
            // 判断该用户是否存在
            $adminUser = $this->getAdminUserByUsername($data['username']);
            if ($adminUser && $adminUser['id'] != $id) {
                throw new Exception('该账号已存在，请重新输入');
            }
        }

        // 修改角色关联
        if (isset($data['role_id'])) {
            (new AdminUserRoleBus())->updateById($id, ['role_id' => $data['role_id']]);
            unset($data['role_id']);
        }

        // 修改成功，更新数据到session
        $result = parent::updateById($id, $data);
        if ($result) {
            $adminUser = $this->getById($id);
            $sessionAdminUser = getSessionAdminUser();
            $adminUser['authority'] = $sessionAdminUser['authority'];
            setSessionAdminUser($adminUser);
        }

        return $result;
    }

    // 根据账号查询用户信息
    public function getAdminUserByUsername($username)
    {
        try {
            $result = $this->model
                ->where('username', $username)
                ->find();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 根据账号查询正常用户信息
    public function getAdminUserNormalByUsername($username)
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
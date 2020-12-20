<?php

/**
 * Created by PhpStorm.
 * User: babalife
 * Date: 2020/12/15
 * Time: 7:36 下午
 * Git: https://github.com/babalife
 */

namespace app\admin\validate;


use think\Validate;

class AdminUser extends Validate
{
    //校验规则
    protected $rule = [
        'id' => 'require',
        'username' => 'require',
        'nick_name' => 'require',
        'role_id' => 'require',
        'password' => 'require|checkLong',
        'oldPassword' => 'require|checkLong',
        'repassword' => 'require|checkLong|passwordCheck',
    ];

    //提示消息
    protected $message = [
        'id' => '用户编号不能为空',
        'nick_name' => '用户名称不能为空',
        'role_id' => '角色编号必须',
        'username' => '账号不能为空',
        'password.require' => '密码不能为空',
        'password.checkLong' => '密码长度6到16个字符',
        'oldPassword' => '旧密码不能为空',
        'repassword' => '确认密码不能为空',
        'oldPassword.checkLong' => '密码长度6到16个字符',
        'repassword.checkLong' => '密码长度6到16个字符',
        'repassword.passwordCheck' => '密码长度6到16个字符',
    ];

    //校验条件
    protected $scene = [
        'save' => ['username', 'nick_name', 'role_id'],
        'login' => ['username', 'password'],
        'setpass' => ['password', 'oldPassword', 'repassword'],
        'id' => ['id']
    ];

    // 校验长度
    public function checkLong($val)
    {
        $len = strlen($val);
        if ($len >= 6 && $len <= 16) {
            return true;
        }

        return false;
    }

    // 两次密码是否一致
    public function passwordCheck($value, $rule, $data = [])
    {
        if ($value === $data['repassword']) {
            return true;
        }
        return false;
    }
}
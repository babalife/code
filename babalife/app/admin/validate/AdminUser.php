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
        'password' => 'require',
    ];

    //提示消息
    protected $message = [
        'id' => '用户编号不能为空',
        'nick_name' => '用户名称不能为空',
        'role_id' => '角色编号必须',
        'username' => '账号不能为空',
        'password' => '密码不能为空',
    ];

    //校验条件
    protected $scene = [
        'save' => ['username', 'nick_name', 'role_id'],
        'login' => ['username', 'password'],
        'id' => ['id']
    ];
}
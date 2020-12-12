<?php


namespace app\admin\validate;


use think\Validate;

class AdminUserRole extends Validate
{
    //校验规则
    protected $rule = [
        'id' => 'require',
        'name' => 'require',
        'desc' => 'require',
    ];

    //提示消息
    protected $message = [
        'id' => '角色编号必填',
        'name' => '角色名称必须',
        'path' => '角色描述必须',
    ];

    //校验条件
    protected $scene = [
        'save' => ['name', 'path', 'sort', 'pid'],
        'id' => ['id']
    ];
}
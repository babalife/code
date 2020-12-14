<?php


namespace app\admin\validate;


use think\Validate;

class AdminRole extends Validate
{
    //校验规则
    protected $rule = [
        'id' => 'require',
        'name' => 'require',
        'desc' => 'require',
        'role_id' => 'require',
        'menu_ids' => 'require',
    ];

    //提示消息
    protected $message = [
        'id' => '角色编号必填',
        'name' => '角色名称必须',
        'path' => '角色描述必须',
        'role_id' => '角色编号必须',
        'menu_ids' => '菜单编号必须',
    ];

    //校验条件
    protected $scene = [
        'save' => ['name', 'path', 'sort', 'pid'],
        'update' => ['id', 'name'],
        'role_menu' => ['role_id', 'menu_ids'],
        'id' => ['id']
    ];
}
<?php


namespace app\admin\validate;


use think\Validate;

class AdminMenu extends Validate
{
    //校验规则
    protected $rule = [
        'name' => 'require',
        'path' => 'require',
        'sort' => 'require',
        'pid' => 'require',
        'id' => 'require',
        'type' => 'require'
    ];

    //提示消息
    protected $message = [
        'name' => '菜单名称必须',
        'authority' => '权限标识必须',
        'path' => '菜单路径必须',
        'sort' => '菜单排序必须',
        'pid' => '菜单父节点必须',
        'type' => '菜单类型必须',
        'id' => '菜单编号必填'
    ];

    //校验条件
    protected $scene = [
        'save' => ['name', 'sort', 'type'],
        'update' => ['id', 'name', 'sort', 'type'],
        'id' => ['id']
    ];
}
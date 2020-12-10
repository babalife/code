<?php


namespace app\admin\controller;

// 菜单管理控制器
use app\common\basic\Result;

class Menu extends BaseAuth
{
    //页面渲染
    public function index()
    {
        return view();
    }

    //列表数据
    public function list()
    {
        $data = [
            ['id' => 1, 'pid' => 0, 'name' => '张三', 'icon' => 'add-1', 'path' => '/admin/index', 'status' => 1, 'sort' => 11],
            ['id' => 2, 'pid' => 0, 'name' => '啊', 'icon' => 'add-1', 'path' => '/admin/index', 'status' => 1, 'sort' => 22],
            ['id' => 3, 'pid' => 1, 'name' => '鹅鹅鹅', 'icon' => 'add-1', 'path' => '/admin/index', 'status' => 1, 'sort' => 33],
            ['id' => 4, 'pid' => 2, 'name' => 'www', 'icon' => 'add-1', 'path' => '/admin/index', 'status' => 1, 'sort' => 44]
        ];
        return Result::success($data);
    }

    // 新增
    public function save()
    {
        return 'save';
    }

    // 编辑
    public function edit($id)
    {
        return 'edit' . $id;
    }

    // 更新
    public function update($id)
    {
        return 'update' . $id;
    }

}
<?php


namespace app\admin\controller;

use app\admin\validate\Menu as MenuValidate;
use app\common\basic\Result;
use app\admin\business\Menu as MenuBus;

// 菜单管理控制器
class Menu extends BaseAuth
{
    //页面渲染
    public function index()
    {
        return view();
    }

    // 编辑界面渲染
    public function menuform()
    {
        $id = input('param.id', 0, 'intval');
        $info = (new MenuBus())->getMenuById($id);
        $lists = (new MenuBus())->getTopMenuLists();
        return view('', [
            'list' => $lists,
            'info' => $info
        ]);
    }

    // 分页数据
    public function list()
    {
        $lists = (new MenuBus())->getMenuPageLists();
        if ($lists) {
            return Result::success($lists);
        }

        return Result::error('获取失败');
    }

    // 新增
    public function save()
    {
        $data = input('post.');

        $validate = new MenuValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new MenuBus())->insertDate($data);
        if ($result) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 编辑
    public function edit($id)
    {
        $validate = new MenuValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $menuInfo = (new MenuBus())->getMenuById($id);
        if ($menuInfo) {
            return Result::success($menuInfo);
        }

        return Result::error('获取失败');
    }

    // 更新
    public function update($id)
    {
        $data = input('post.');

        $validate = new MenuValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new MenuBus())->updateMenuById($id, $data);
        if ($result) {
            return Result::success($result, '修改成功');
        }

        return Result::error('修改失败');
    }

    // 删除
    public function delete($id)
    {
        $validate = new MenuValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new MenuBus())->delMenuById($id);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }
}
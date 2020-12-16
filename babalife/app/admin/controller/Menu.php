<?php


namespace app\admin\controller;

use app\admin\validate\AdminMenu as MenuValidate;
use app\admin\business\AdminMenu as AdminMenuBus;
use app\common\basic\Result;
use think\facade\Request;

// 菜单管理控制器
class Menu extends BaseAuth
{
    //页面渲染
    public function index()
    {
        return view();
    }

    // 数据列表
    public function list()
    {
        $lists = (new AdminMenuBus())->getList('sort', 'asc');
        foreach ($lists as &$list) {
            $list['open']=true;
        }
        if ($lists) {
            return json([
                'code' => 0,
                'msg' => 'OK',
                'data' => $lists,
                'count' => count($lists)
            ]);
        }

        return Result::error('未查询到数据');
    }

    // 新增
    public function save()
    {
        $data = Request::only(['pid', 'name', 'icon', 'path', 'status', 'type', 'sort', 'authority'], 'post');

        $validate = new MenuValidate();
        if (!$validate->scene('save')->check($data)) {
            return Result::error($validate->getError());
        }

        $result = (new AdminMenuBus())->insertDate($data);
        if ($result) {
            return Result::success([], '新增成功');
        }

        return Result::error('新增失败');
    }

    // 更新
    public function update($id)
    {
        $data = Request::only(['pid', 'name', 'icon', 'path', 'status', 'type', 'sort', 'authority'], 'post');

        $validate = new MenuValidate();
        if (!$validate->scene('id')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminMenuBus())->updateById($id, $data);
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

        $result = (new AdminMenuBus())->delById($id);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }

    // 批量删除
    public function deleteAll()
    {
        $ids = input('post.ids', '', 'trim');

        $validate = new MenuValidate();
        if (!$validate->scene('id')->check(['id' => $ids])) {
            return Result::error($validate->getError());
        }

        $result = (new AdminMenuBus())->delByIds($ids);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }

    /**
     *  菜单tree列表
     */
    public function treeList()
    {
        $id = input('param.id');
        $list = (new AdminMenuBus())->treeList($id);
        return Result::success($list);
    }
}
<?php


namespace app\admin\controller;

use app\admin\validate\Menu as MenuValidate;
use app\common\basic\Result;
use app\admin\business\Menu as MenuBus;
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
        $lists = (new MenuBus())->getList('sort', 'asc');
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
        $data = Request::only(['pid','name','icon','path','status','type','sort','authority'], 'post');

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

    // 更新
    public function update($id)
    {
        $data = Request::only(['pid','name','icon','path','status','type','sort','authority'], 'post');

        $validate = new MenuValidate();
        if (!$validate->scene('update')->check(['id' => $id])) {
            return Result::error($validate->getError());
        }

        $result = (new MenuBus())->updateById($id, $data);
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

        $result = (new MenuBus())->delById($id);
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

        $result = (new MenuBus())->delByIds($ids);
        if ($result) {
            return Result::success([], '删除成功');
        }

        return Result::error('删除失败');
    }
}
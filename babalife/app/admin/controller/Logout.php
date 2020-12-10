<?php


namespace app\admin\controller;

//退出登录
use app\common\basic\Result;

class Logout extends BaseAuth
{
    public function index()
    {
        session(config('code.session.admin'), null);
        return Result::success([], '退出成功');
    }
}
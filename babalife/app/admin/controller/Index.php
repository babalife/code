<?php
namespace app\admin\controller;

use app\BaseController;

class Index extends Base
{
    public function index()
    {
        session('test', '123');
        return 'admin';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}

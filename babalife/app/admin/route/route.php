<?php
use think\facade\Route;

// 菜单资源路由
Route::resource('menu', 'admin/menu')->only(['index', 'save', 'edit', 'update']);
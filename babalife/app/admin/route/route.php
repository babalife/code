<?php

use think\facade\Route;

// 菜单资源路由
Route::resource('menu', 'admin/menu')->only(['index', 'save', 'update', 'delete']);

// 用户角色路由
Route::resource('role', 'admin/role')->only(['index', 'save', 'edit', 'update', 'delete']);
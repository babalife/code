<?php

use think\facade\Route;

// 菜单资源路由
Route::resource('menu', 'admin/menu')->only(['index', 'save', 'update', 'delete']);
Route::delete('menu', 'admin/menu/deleteAll');

// 用户角色路由
Route::resource('role', 'admin/role')->only(['index', 'save', 'edit', 'update', 'delete']);
Route::delete('role', 'admin/role/deleteAll');

<?php
use think\facade\Route;

// 菜单资源路由
Route::resource('menu', 'admin/menu')->only(['index', 'save', 'edit', 'update', 'delete']);

// 用户角色路由
Route::resource('role', 'admin/adminuserrole')->only(['index', 'save', 'edit', 'update', 'delete']);
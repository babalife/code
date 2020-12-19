<?php
// 应用公共文件

// 获取 session 用户信息
function getSessionAdminUser()
{
    return session(config('code.session.admin'));
}

// 设置 session 用户信息
function setSessionAdminUser($adminUser)
{
    return session(config('code.session.admin'), $adminUser);
}
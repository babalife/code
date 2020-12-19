<?php


namespace app\common\basic;

// 字符串控制器类
class Str
{

    // 用户登录密码加密
    public static function userEncrypt($password)
    {
        return md5(md5($password . 'admin_user'));
    }
}
<?php


namespace app\common\basic;

// 数组处理基础库
class Arr
{
    /**
     * 分类树，支持无限极分类
     * @param $data
     * @return array
     */
    public static function getTree($data)
    {
        $items = [];
        // 数据格式化
        foreach ($data as $v) {
            $items[$v['id']] = $v;
        }
        // 拼接树
        $tree = [];
        foreach ($items as $id => $item) {
            // 通过pid找父类数组，找到则将本次数据添加至父类数组 list 中，跳出本次循环
            if (isset($items[$item['pid']])) {
                // 次级分类
                $items[$item['pid']]['list'][] = &$items[$id];
            } else {
                // 顶级分类
                $tree[] = &$items[$id];
            }
        }
        return $tree;
    }
}
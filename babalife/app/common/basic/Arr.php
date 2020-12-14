<?php


namespace app\common\basic;

// 数组处理基础库
class Arr
{
    /**
     * 分类树，支持无限极分类
     * @param $data
     * @param string $parent 父节点名称
     * @param string $child 子节点集合名称
     * @return array
     */
    public static function getTree($data, $parent = 'pid', $child = 'list')
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
            if (isset($items[$item[$parent]])) {
                // 次级分类
                $items[$item[$parent]][$child][] = &$items[$id];
            } else {
                // 顶级分类
                $tree[] = &$items[$id];
            }
        }
        return $tree;
    }
}
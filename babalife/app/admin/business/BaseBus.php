<?php


namespace app\admin\business;

// 业务逻辑基础库
use think\facade\Log;

class BaseBus
{
    protected $model = null;

    // 数据列表
    public function getList($order = 'id', $sort = 'asc', $field = '*')
    {
        try {
            $result = $this->model->field($field)->order($order, $sort)->select();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result ? $result->toArray() : $result;
    }

    // 数据分页列表
    public function getPageList($limit = 10, $field = '*')
    {
        try {
            $result = $this->model->field($field)->order('id', 'asc')->paginate($limit);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result?$result->toArray():$result;
    }

    // 新增数据
    public function insertDate($data)
    {
        try {
            $result = $this->model->save($data);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 指定ID查询
    public function getById($id, $field = '*')
    {
        try {
            $result = $this->model->field($field)->find($id);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 指定IDS查询
    public function getByIds($ids, $field = '*')
    {
        try {
            $result = $this->model->whereIn('id', $ids)->field($field)->select();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result?$result->toArray():$result;
    }

    // 指定ID删除
    public function delById($id)
    {
        try {
            $result = $this->model->where('id', $id)->delete();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 指定IDS删除
    public function delByIds($ids)
    {
        try {
            $result = $this->model->whereIn('id', $ids)->delete();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }

    // 指定ID更新数据
    public function updateById($id, $data)
    {
        $data['update_time'] = time();

        try {
            $result = $this->model->where('id', $id)->save($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $result = [];
        }

        return $result;
    }
}
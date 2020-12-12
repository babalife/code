<?php


namespace app\admin\business;

// 业务逻辑基础库
class BaseBus
{
    protected $model = null;

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
    public function getById($id)
    {
        try {
            $result = $this->model->find($id);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
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

    // 指定ID更新数据
    public function updateById($id, $data)
    {
        $data['update_time'] = time();

        try {
            $result = $this->model->where('id', $id)->save($data);
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }
}
<?php


namespace app\common\basic;

// 通用API处理
class Result
{
    /**
     * 通用成功API数据
     * @param $data
     * @param string $msg
     * @param int $code
     * @return \think\response\Json
     */
    public function success($data, $msg = 'OK', $code =0 ){
        return json([
            'data' => $data,
            'msg' => $msg,
            'code' => $code
        ]);
    }

    /**
     * 通用失败API数据
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return \think\response\Json
     */
    public function error($msg = 'Error', $code = 1, $data = []){
        return json([
            'data' => $data,
            'msg' => $msg,
            'code' => $code
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Bedinfo;
use Illuminate\Http\Request;

class ApiBedController extends Controller
{
    // 查询空余的床位
    public function bedSpare()
    {
        $model = new Bed();
        $data = $model->where('bedstatus',0)->get();
        if($data){
            return ['status' => '1', 'res' => '查询成功','data'=>$data];
        }else{
            return ['status' => '0', 'res' => '查询失败','data'=>''];
        }
    }

    public function addInfo(Request $request)
    {
        $regid = $request->input('regid');
        $bedids = $request->input('bedids');
        $docid = $request->input('uid');
        $mark = $request->input('mark');

        $flag = 1;
        foreach ($bedids as $k => $v){
            $model = new Bedinfo();
            $bedModel = new Bed();
            $model->biRID = $regid;
            $model->bibedID = $v;
            $model->bidocID = $docid;
            $model->biremark = $mark;
            $model->bistatus = 1;
            if (!$model->save()){
                $flag = 0;
            }
            $bed = $bedModel->find($v);
            $bed->bedstatus = 1;
            if (!$bed->save()){
                $flag = 0;
            }
        }

        if($flag){
            return ['status' => '1', 'res' => '操作成功'];
        }else{
            return ['status' => '0', 'res' => '操作失败'];
        }
    }
}

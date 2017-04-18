<?php

namespace App\Http\Controllers;

use App\Models\Registe;
use Illuminate\Http\Request;

class RegController extends Controller
{
    // 挂号信息查询
    public function GetRegInfo(Request $request)
    {
        $uid = $request->input('uid');
        $model = new Registe();
        $data = $model->selectAll($uid);
        foreach ($data as $item) {
            $model->checkRegID($item['id']);
        }

        if($data){
            return ['status'=>1,'res'=>'查询成功','data'=>$data];
        }else{
            return ['status'=>0,'res'=>'查询失败'];
        }
    }

    public function setInitData(Request $request)
    {
        $uid = $request->input('uid');
        $depid = $request->input('departmentID');
    }
}

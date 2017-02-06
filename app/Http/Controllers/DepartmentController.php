<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Validator;

class DepartmentController extends Controller
{
    //创建科室
    public function create(Request $request)
    {
        $data = $request->input();
        $data = [
            'depname' => '骨科',
            'depdocID' => '621701317880',
            'depinfo' => '骨科',
        ];

        //validator类验证
        $validator = Validator::make($data, [
            'depname' => 'required',
            'depdocID' => 'required',
            'depinfo' => 'required',
        ],[

        ],[
            'depname' => '科室名',
            'depdocID' => '科室主治医生',
            'depinfo' => '科室介绍',
        ]);
        if($validator->fails()){
//            return redirect()->back()->withErrors($validator);
            return ['status'=>'0','res'=>'验证信息有错误'];
        }

        $doc = new Department();
        $res = $doc->add($data);
        return $res;
    }
}

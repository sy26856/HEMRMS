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
            'depdepID' => '1',
            'depinfo' => '骨科',
        ];

        //validator类验证
        $validator = Validator::make($data, [
            'depname' => 'required',
            'depdepID' => 'required',
            'depinfo' => 'required',
        ],[

        ],[
            'depname' => '科室名',
            'depdepID' => '科室所属科室',
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

<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Validator;
class DoctorController extends Controller
{
    // 创建医生
    public function create(Request $request)
    {
        $data = $request->input();
        $data = [
            'docname' => '赵丽华',
            'password' => '123456',
            'docIDCard' => '123456789012345673',
            'docphoneNum' => '12345678903',
            'docsex' => 'f',
            'docgrade' => '1',
            'departmentID' => '2',
            'docinfo' => '年龄:45,家庭:57fgfdcds'
        ];

        //validator类验证
        $validator = Validator::make($data, [
            'docname' => 'required',
            'docIDCard' => 'required|unique:doctors',
            'docphoneNum'=>'required|unique:doctors',
            'password' => 'required|min:6',
            'docsex' => 'required',
            'docgrade' => 'required',
            'departmentID' => 'required',
            'docinfo' => 'required|max:255'
        ],[

        ],[
            'docname'=>'医生姓名',
            'docIDCard'=>'医生工号',
            'docphoneNum' => '电话号码',
            'docsex' => '医生性别',
            'docgrade' => '医生等级',
            'departmentID' => '医生科室',
            'docinfo' => '医生简介'
        ]);
        if($validator->fails()){
//            return redirect()->back()->withErrors($validator);
            return ['status'=>'0','res'=>'验证信息有错误'];
        }

        $doc = new Doctor();
        $res = $doc->add($data);
        return $res;
    }

}

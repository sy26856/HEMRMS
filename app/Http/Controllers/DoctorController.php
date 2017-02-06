<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Validator;
class DoctorController extends Controller
{
    public function isLogin()
    {
        //判断是否登陆
        if(session('doctor') == null || session('doctor')['docID'] == null){
            return 0;
        }else{
            return 1;
        }
    }
    //医生首页面
    public function index(){
        if($this->isLogin() == 0){
            return redirect('doclogin');
        }
        return view('doctor.home');
    }

    //医生登陆
    public function login(Request $request)
    {
        $data = $request->all();
        $password = $data['password'];
        $docID = $data['docID'];
        $validator = Validator::make($data, [
            'docID' => 'required',
            'captcha' => 'required|captcha',
        ],[

        ],[
            'docID'=>'医生工号',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $doctor = new Doctor();
        $data = $doctor->where('docID',$docID)->first();
        if($data !== null && \Hash::check($password,$data['password'])){
            session(['doctor'=>$data]);
            return redirect('/doc/index');
        }else{
            return redirect()->back()->withErrors(['docID'=>'用户名或密码不正确']);
        }
    }
    // 创建医生
    public function create(Request $request)
    {
        $data = $request->input();
        $data = [
            'docname' => '苏是',
            'password' => '123456',
            'docIDCard' => '123456789012345674',
            'docphoneNum' => '12345678904',
            'docsex' => 'f',
            'docgrade' => '2',
            'departmentID' => '6',
            'docinfo' => '年龄:36,家庭:57fgfdcds'
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
            'docIDCard'=>'医生身份证',
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

    //退出登录
    public function logout()
    {
        session()->forget('doctor');
        return redirect('doclogin');
    }
}

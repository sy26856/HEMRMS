<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Validator;
class DoctorController extends Controller
{
    //医生个人信息查询
    public function inforead()
    {
        return $this->showview();
    }

    //医生个人信息修改
    public function infoedit()
    {
        return $this->showview();
    }

    //医生修改登录密码
    public function changepsw()
    {
        return $this->showview();
    }

    //过往就诊记录
    public function passrecord()
    {
        return $this->showview();
    }

    //就诊信息录入
    public function writerecord()
    {
        return $this->showview();
    }

    //判断是否登陆
    public function isLogin()
    {
        if(session('doctor') == null || session('doctor')['docID'] == null){
            return 0;
        }else{
            return 1;
        }
    }

    public function showview()
    {
        if($this->isLogin() == 0){
            return redirect('doclogin');
        }
        return view('doctor.home');
    }
    //医生首页面
    public function index(){
        return $this->showview();
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
    
    //获取医生所在的科室名
    public function getDepartmentName(Request $request)
    {
        $departmentid = $request->input('departmentid');
        if($departmentid !== null){
            $dep = new Department();
            $departmentres = $dep->findname($departmentid);
            return $departmentres;
        }else{
            return ['status'=>0,'res'=>"没有相应参数"];
        }
    }
}

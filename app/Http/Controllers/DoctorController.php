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
    public function passRecord()
    {
        return $this->showview();
    }

    //就诊信息录入
    public function writeRecord()
    {
        return $this->showview();
    }

    // 检查项目
    public function checkPro()
    {
        return $this->showview();
    }

    public function todayRecord()
    {
        return $this->showview();
    }

    //判断是否登陆
    public function isLogin()
    {
        if (session('doctor') == null || session('doctor')['docID'] == null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function showview()
    {
        if ($this->isLogin() == 0) {
            return redirect('doclogin');
        }
        return view('doctor.home');
    }

    //医生首页面
    public function index()
    {
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
        ], [

        ], [
            'docID' => '医生工号',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $doctor = new Doctor();
        $data = $doctor->where('docID', $docID)->first();
        if ($data !== null && \Hash::check($password, $data['password'])) {
            session(['doctor' => $data]);
            return redirect('/doc/index');
        } else {
            return redirect()->back()->withErrors(['docID' => '用户名或密码不正确']);
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
            'docphoneNum' => 'required|unique:doctors',
            'password' => 'required|min:6',
            'docsex' => 'required',
            'docgrade' => 'required',
            'departmentID' => 'required',
            'docinfo' => 'required|max:255'
        ], [

        ], [
            'docname' => '医生姓名',
            'docIDCard' => '医生身份证',
            'docphoneNum' => '电话号码',
            'docsex' => '医生性别',
            'docgrade' => '医生等级',
            'departmentID' => '医生科室',
            'docinfo' => '医生简介'
        ]);
        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator);
            return ['status' => '0', 'res' => '验证信息有错误'];
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
        if ($departmentid !== null) {
            $dep = new Department();
            $departmentres = $dep->findname($departmentid);
            return $departmentres;
        } else {
            return ['status' => 0, 'res' => "没有相应参数"];
        }
    }

    //医生修改登录密码方法
    public function docchangepsw(Request $request)
    {
        $userid = $request->input('userid');
        $password = $request->input('password');
        if ($userid == null || $password == null) {
            return ['status' => '0', 'res' => '参数错误'];
        }
        $user = Doctor::find($userid);
        if ($user == null) {
            return ['status' => '0', 'res' => '无此用户,参数错误'];
        };
        $user->password = bcrypt($password);
        if ($user->save()) {
            return ['status' => '1', 'res' => '密码修改成功'];
        } else {
            return ['status' => '0', 'res' => '密码修改失败'];
        }
    }

    //检查旧密码是否有误
    public function checkpsw(Request $request)
    {
        $userid = $request->input('userid');
        $password = $request->input('password');
        if ($userid == null || $password == null) {
            return ['status' => '0', 'res' => '参数错误'];
        }
        $user = Doctor::find($userid);
        if ($user == null) {
            return ['status' => '0', 'res' => '无此用户,参数错误'];
        };
        $userpsw = $user->password;
        //对密码进行验证
        if (\Hash::check($password, $userpsw)) {
            return ['status' => '1', 'res' => '旧密码验证一致'];
        }
        return ['status' => '0', 'res' => '与旧密码不一致'];
    }

    //修改个人信息
    public function docchangeinfo(Request $request)
    {
        $userid = $request->input('userid');
        $phoneNum = $request->input('docphoneNum');
        $sex = $request->input('docsex');
        $info = $request->input('docinfo');
        if ($userid == null || $phoneNum == null || $sex == null || $info == null) {
            return ['status' => '0', 'res' => '参数错误'];
        }
        $user = Doctor::find($userid);
        if ($user == null) {
            return ['status' => '0', 'res' => '无此用户,参数错误'];
        };

        $user->docphoneNum = $phoneNum;
        $user->docsex = $sex;
        $user->docinfo = $info;
        if ($user->save()) {
            session(['doctor' => $user]);
            return ['status' => '1', 'res' => '个人信息修改成功', 'user' => $user];
        } else {
            return ['status' => '0', 'res' => '保存修改失败'];
        }
    }


    //获得user
    public function getUser(Request $request)
    {
        $id = $request->input('userid');
        if ($id == null) {
            return ['status' => '0', 'res' => '参数错误'];
        }
        $user = Doctor::find($id);
        if ($user == null) {
            return ['status' => '0', 'res' => '无此用户,参数错误'];
        } else {
            return ['status' => '1', 'res' => '请求成功', 'user' => $user];
        }
    }


}

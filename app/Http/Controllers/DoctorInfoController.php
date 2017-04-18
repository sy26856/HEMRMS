<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorInfoController extends Controller
{
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

    // 医院基本信息
    public function docinfo()
    {
        // 医生基本信息
        return $this->showview();
    }

    public function depinfo()
    {
        // 科室基本信息
        return $this->showview();
    }

    public function bedinfo()
    {
        // 床位基本信息
        return $this->showview();
    }

    public function proinfo()
    {
        // 检查项目基本信息
        return $this->showview();
    }

    // 查询出医生的所有信息
    public function getDocInfo()
    {
        $doctorModel = new Doctor();
        $doctor = $doctorModel->selectAll();
        if ($doctor){
            $status = 1;
        }else{
            $status = 0;
        }
        return ['status'=>$status,'data'=>$doctor];
    }

    // 查询某个医生的信息
    public function getOneDocInfo(Request $request)
    {
        $name = $request->input('searchName');
        $doctorModel = new Doctor();
        $doctor = $doctorModel->findByName($name);
        if ($doctor){
            $status = 1;
        }else{
            $status = 0;
        }
        return ['status'=>$status,'data'=>$doctor];
    }
}

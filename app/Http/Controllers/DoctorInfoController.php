<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Bedinfo;
use App\Models\Doctor;
use App\Models\Registe;
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

    // 获得患者姓名
    public function getName(Request $request)
    {
        $regid = $request->input('regid');
        $regModel = new Registe();
        $data = $regModel
            ->join('users','registes.userId','=','users.id')
            ->where('registID',$regid)
            ->select('users.name')
            ->get();
        if ($data){
            $status = 1;
        }else{
            $status = 0;
            $data = [];
        }
        return ['status'=>$status,'data'=>$data];
    }

    public function outHos(Request $request)
    {
        $regid = $request->input('regid');
        $regModel = new Registe();
        $bedModel = new Bed();
        $bedinfoModel = new Bedinfo();

        $reg = $regModel
            ->where('registID','=',$regid)->update(['status'=>0]);
        $bedidArr = $bedinfoModel->where('biRID','=',$regid)->select('bibedID')->get();
        $bedid = $bedidArr[0]['bibedID'];
        $bedinfo = $bedinfoModel->where('biRID','=',$regid)->update(['bistatus'=>0]);

        $bed = $bedModel
            ->where('id','=',$bedid)->update(['bedstatus'=>0]);
        if($bed && $bedinfo && $reg) {
            return ['status'=>1,'info'=>'更新数据成功'];
        }else{
            return ['status'=>0,'info'=>'更新数据失败'];
        }
    }
}

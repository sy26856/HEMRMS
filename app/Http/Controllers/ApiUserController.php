<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Bedinfo;
use App\Models\Doctor;
use App\Models\Outinfo;
use App\Models\Registe;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    //
    public function checkOutPro(Request $request)
    {
        $regid = $request->input('regid');
        $outInfoModel = new Outinfo();
        $outData = $outInfoModel
            ->join('projects', 'outinfos.outproID', '=', 'projects.id')
            ->join('registes','outinfos.outRID','=','registes.registID')
            ->join('doctors','outinfos.outdocID','=','doctors.id')
            ->join('users','registes.userId','=','users.id')
            ->where('outRID',$regid)
            ->orderBy('created_at','desc')
            ->select('outinfos.*','projects.proname','doctors.docname','users.name')
            ->get();
        if($outData){
            return ['status' => '1', 'res' => '查询成功','data'=>$outData];
        }else{
            return ['status' => '0', 'res' => '查询失败','data'=>''];
        }
    }

    public function checkOutReg(Request $request)
    {
        $model = new Registe();
        $regid = $request->input('regid');

        $res = $model
            ->where('registID', '=',$regid)
            ->where('status', '=',1)
            ->where('diagnose','=',0)
            ->get();
        if(empty($res[0])){
            return ['status' => '0', 'res' => '挂号id有误'];
        }else{
            return ['status' => '1', 'res' => '查询成功'];
        }
    }

    public function checkInReg(Request $request)
    {
        $model = new Registe();
        $regid = $request->input('regid');

        $res = $model
            ->where('registID', '=', $regid)
            ->where('status', '=', 1)
            ->where('diagnose', '=', 1)
            ->get();
        if (empty($res[0])) {
            return ['status' => '0', 'res' => '挂号id有误'];
        } else {
            return ['status' => '1', 'res' => '查询成功'];
        }
    }

    public function readOutPro(Request $request)
    {
        $id = $request->input('id');
        $outInfoModel = new Outinfo();
        $outData = $outInfoModel
            ->join('doctors','outinfos.outdocID','=','doctors.id')
            ->where('outinfos.id','=',$id)
            ->select('outinfos.outresult','doctors.docname')
            ->get();
        if($outData){
            return ['status' => '1', 'res' => '查询成功','data' => $outData[0]];
        }else{
            return ['status' => '0', 'res' => '查询失败','data' => ''];
        }
    }

    public function checkBed(Request $request)
    {
        $regid = $request->input('regid');
        $bedModel = new Bed();
        $bedinfoModel = new Bedinfo();

        $data = $bedinfoModel
            ->join('beds','bedinfos.bibedID','=','beds.id')
            ->join('doctors','bedinfos.bidocID','=','doctors.id')
            ->join('registes','bedinfos.biRID','=','registes.registID')
            ->join('users','registes.userId','=','users.id')
            ->where('bedinfos.bistatus','=',1)
            ->where('beds.bedstatus','=',1)
            ->where('biRID','=',$regid)
            ->select('bedinfos.*','beds.bedsite','doctors.docname','users.name')
            ->get();

        if(count($data) !== 0){
            return ['status' => '1', 'res' => '查询成功','data' => $data[0]];
        }else{
            return ['status' => '0', 'res' => '查询失败','data' => ''];
        }
    }

    public function passRecord(Request $request)
    {
        $regid = $request->input('regid');
        $regModel = new Registe();
        $docModel = new Doctor();
        $regdata = $regModel
            ->join('users','registes.userId','=','users.id')
            ->join('outinfos','registes.registID','=','outinfos.outRID')
            ->join('projects','projects.id','=','outinfos.outproID')
            ->join('doctors','doctors.id','=','outinfos.outdocID')
            ->where('registes.registID','=',$regid)
            ->select('users.name','registes.diagnose','outinfos.*','projects.proname','doctors.docname')
            ->get();
        foreach ($regdata as $key=>$val){
            if($val['diagnose'] == 1){
                $regdata[$key]['diagnoseStatus'] = '门诊';
            }else{
                $regdata[$key]['diagnoseStatus'] = '住院';
            }
            $regdata[$key]['time'] = date('Y-m-d',strtotime($val['created_at']));
            if($val['outprodocID'] == 0){
                $regdata[$key]['status'] = '未检查';
                $regdata[$key]['outdoctor'] = '';
            }else{
                $docname = $docModel->where('id',$val['outprodocID'])->select('docname')->get();
                $regdata[$key]['status'] = '已检查';
                $regdata[$key]['outdoctor'] = $docname[0]['docname'];
            }
            $regdata[$key]['result'] = $val['outresult'];

        }
        return ['status' => '1', 'res' => '查询成功','data' => $regdata];
    }
}

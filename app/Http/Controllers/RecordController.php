<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Drug;
use App\Models\Getdrug;
use App\Models\Outinfo;
use App\Models\Project;
use App\Models\Registe;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    // 医生就诊
    public function checkReg(Request $request)
    {
        $model = new Registe();
        $regid = $request->input('regid');

        $res = $model
            ->where('registID', '=',$regid)
            ->where('status', '=',1)
            ->get();
        if(empty($res[0])){
            return ['status' => '0', 'res' => '挂号id有误'];
        }else{
            return ['status' => '1', 'res' => '查询成功'];
        }
    }

    // 是否是住院id
    public function checkHosReg(Request $request)
    {
        $model = new Registe();
        $regid = $request->input('regid');

        $res = $model
            ->where('registID', '=',$regid)
            ->where('status', '=',1)
            ->where('diagnose','=',1)
            ->get();
        if(empty($res[0])){
            return ['status' => '0', 'res' => '挂号id有误'];
        }else{
            return ['status' => '1', 'res' => '查询成功'];
        }
    }

    public function setInitData(Request $request)
    {
        $uid = $request->input('uid');
        $depID = $request->input('departmentID');

        $depModel = new Department();
        $drugModel = new Drug();
        $proModel = new Project();

        $data['depName'] = $depModel->where('id',$depID)->select('depname')->get();

        $data['drugs'] = $drugModel->where('drugdepID',$depID)->orderBy('created_at','asc')->get();

        $data['projects'] = $proModel->where('prodepID',$depID)->orderBy('created_at','asc')->get();
        if ($data){
            return ['status' => '1', 'res' => '查询成功','data'=>$data];
        }else{
            return ['status' => '0', 'res' => '查询失败'];
        }
    }

    public function writeRecord(Request $request)
    {
        $drugs = $request->input('selectDrug');
        $projects = $request->input('selectProject');
        $depid = $request->input('depid');
        $docid = $request->input('docid');
        $suggest = $request->input('suggest');
        $regid = $request->input('regid');

        $flag = 1;
        foreach ($drugs as $k=>$v){
            $getDrug = new Getdrug();
            $getDrug->gdRID = $regid;
            $getDrug->gddocID = $docid;
            $getDrug->gdsugnum = 1;
            $getDrug->gdoperatorID = 0;
            $getDrug->gdnum = 0;
            $getDrug->gddrugID = $v;
            if (!$getDrug->save()){
                $flag = 0;
            }
        }


        foreach ($projects as $k=>$v){
            $outInfo = new Outinfo();
            $outInfo->outRID = $regid;
            $outInfo->outdepID = $depid;
            $outInfo->outdocID = $docid;
            $outInfo->outsuggest = $suggest;
            $outInfo->outprodocID = 0;
            $outInfo->outresult = '';
            $outInfo->outproID = $v;
            if (!$outInfo->save()){
                $flag = 0;
            }
        }

        if ($flag == 1){
            return ['status' => '1', 'res' => '数据插入成功'];
        }else{
            return ['status' => '0', 'res' => '数据插入失败'];
        }
    }

    //
    public function getTodayRecord(Request $request)
    {
        $uid = $request->input('uid');

        $outInfoModel = new Outinfo();

        $outData = $outInfoModel
            ->join('projects', 'outinfos.outproID', '=', 'projects.id')
            ->join('registes','outinfos.outRID','=','registes.registID')
            ->join('users','registes.userId','=','users.id')
            ->where('outdocID',$uid)
            ->orderBy('created_at','desc')
            ->select('outinfos.*','projects.proname','users.name')
            ->get();

        foreach ($outData as $k=>$v){
            if($v['outprodocID'] == 0){
                $outData[$k]['checkType'] = '未检查';
            }else{
                $outData[$k]['checkType'] = '已检查';
            }
        }
        return ['status' => '1', 'res' => '查询成功','data'=>$outData];
    }

    // 检查项目
    public function checkPro(Request $request)
    {
        $uid = $request->input('uid');
        $depid = $request->input('depid');
        $regid = $request->input('regid');

        $outInfoModel = new Outinfo();
        $outData = $outInfoModel
            ->join('projects', 'outinfos.outproID', '=', 'projects.id')
            ->join('registes','outinfos.outRID','=','registes.registID')
            ->join('users','registes.userId','=','users.id')
            ->where('outdepID',$depid)
            ->where('outRID',$regid)
            ->orderBy('created_at','desc')
            ->select('outinfos.*','projects.proname','users.name')
            ->get();
        if($outData){
            return ['status' => '1', 'res' => '查询成功','data'=>$outData];
        }else{
            return ['status' => '0', 'res' => '查询失败','data'=>''];
        }
    }

    public function resCheck(Request $request)
    {
        $uid = $request->input('uid');
        $id = $request->input('id');
        $regid = $request->input('regid');
        $drugs = $request->input('drugs');
        $res = $request->input('res');
        $outInfoModel = new Outinfo();

        $flag = 1;
        foreach ($drugs as $k=>$v){
            $getDrug = new Getdrug();
            $getDrug->gdRID = $regid;
            $getDrug->gddocID = $uid;
            $getDrug->gdsugnum = 1;
            $getDrug->gdoperatorID = 0;
            $getDrug->gdnum = 0;
            $getDrug->gddrugID = $v;
            if (!$getDrug->save()){
                $flag = 0;
            }
        }

        $outData = $outInfoModel->find($id);
        $outData->outresult = $res;
        $outData->outprodocID = $uid;
        if($outData->save()){
            return ['status' => '1', 'res' => '更新成功'];
        }else{
            return ['status' => '0', 'res' => '更新失败'];
        }
    }

    public function readPro(Request $request)
    {
        $id = $request->input('id');
        $outInfoModel = new Outinfo();
        $outData = $outInfoModel->where('id','=',$id)->select('outresult')->get();
        if($outData){
            return ['status' => '1', 'res' => '查询成功','data' => $outData[0]];
        }else{
            return ['status' => '0', 'res' => '查询失败','data' => ''];
        }
    }
}
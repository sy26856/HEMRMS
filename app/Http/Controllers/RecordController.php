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
        $depid = $request->input('depid');

        $outInfoModel = new Outinfo();
        $getDrugModel = new Getdrug();

        $outData = $outInfoModel->where('outdocID',$uid)->orderBy('created_at','desc')->get();
        $drugData = $getDrugModel->where('gddocID',$uid)->orderBy('created_at','desc')->get();

        $data = [];
        $proIDs = [];
        $drugIDs = [];
        foreach ($outData as $ok => $ov){
            if (!array_key_exists($ov['outRID'],$data)){
                $data[$ov['outRID']] = [];
                $data[$ov['outRID']]['outsuggest'] = $ov['outsuggest'];
                $data[$ov['outRID']]['created_at'] = $ov['created_at'];
            }
            array_push($proIDs,$ov['outproID']);
        }
        foreach ($drugData as $dk => $dv){
            array_push($proIDs,$ov['gddrugID']);
        }

        return ['status' => '1', 'res' => '查询成功','data'=>$data];
    }
}
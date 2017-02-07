<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //添加科室
    public function add(array $data)
    {
        $this->depname = $data['depname'];
        $this->depdocID = $data['depdocID'];
        $this->depinfo = $data['depinfo'];
        if($this->save()){
            return ['status'=>1,'res'=>'department insert success'];
        }else{
            return ['status'=>0,'res'=>'department insert fail'];
        }
    }

    //寻找科室名称
    public function findname($id)
    {
        $dep = $this->find($id);
        if($dep !== null){
            return ['status'=>1,'res'=>"请求成功",'departmentName'=> $dep['depname']];
        }else{
            return ['status'=>0,'res'=>"没有相应科室名"];
        }
    }
}

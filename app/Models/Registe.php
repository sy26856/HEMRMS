<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registe extends Model
{
    //修改挂号状态
    public function changeStatus($id)
    {
        $res = $this->find($id);
        $res->status = 1;
        if($res->save()){
            return true;
        }else{
            return false;
        }
    }

    //添加挂号信息
    public function add(array $data)
    {
        $this->userId = $data['userid'];
        $this->diagnose = $data['diagnose'];
        $time = substr(date('Ymd',time()),2,6);
        $ran = mt_rand('10000','99999');
        $str = substr($data['phoneNum'],-6);
        $this->registID = $data['diagnose'].$ran.$str.$time;
        if($this->save()){
            return ['status'=>1,'res'=>'挂号成功','registID'=>$this->registID,'id'=>$this->id];
        }else{
            return ['status'=>0,'res'=>'挂号失败'];
        }
    }

    //检查有没有可用挂号
    public function checkRegID($id)
    {
        $regOutID = $this->where(['userId'=>$id,'status'=>1,'diagnose'=>0])->orderBy('created_at','desc')->first();
        if($regOutID !== null){
            //判断半天是否过期了
            $passtime=strtotime(date('Y-m-d H:i:s',strtotime("-12 hour")));
            $time = strtotime($regOutID->created_at);
            if($time < $passtime){
                $regOutID->status = 0;
                $regOutID->save();
                $regOutID = null;
            }
        }
        $regInnerID = $this->where(['userId'=>$id,'status'=>1,'diagnose'=>1])->orderBy('created_at','desc')->first();
        return ['status'=>1,'regInnerID'=>$regInnerID,'regOutID'=>$regOutID];

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //添加医生
    public function add(array $data)
    {
        $time = substr(date('Ymd',time()),2,6);
        $random = mt_rand(1000,9999);
        $this->docname = $data['docname'];
        $this->password = bcrypt($data['password']);
        $this->docIDCard = $data['docIDCard'];
        $this->docphoneNum = $data['docphoneNum'];
        $this->docsex = $data['docsex'];
        $this->docgrade = $data['docgrade'];
        $this->departmentID = $data['departmentID'];
        $this->docinfo = $data['docinfo'];
        $this->docID = $data['departmentID'].$data['docgrade'].$time.$random;

        if($this->save()){
            return ['status'=>1,'res'=>'doctor insert success'];
        }else{
            return ['status'=>0,'res'=>'doctor insert fail'];
        }
    }
}

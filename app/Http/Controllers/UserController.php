<?php

namespace App\Http\Controllers;

use App\Models\Registe;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //检查旧密码是否有误
    public function checkpsw(Request $request)
    {
        $userid = $request->input('userid');
        $password = $request->input('password');
        if($userid == null || $password == null){
            return ['status'=>'0','res'=>'参数错误'];
        }
        $user = User::find($userid);
        if($user == null){
            return ['status'=>'0','res'=>'无此用户,参数错误'];
        };
        $userpsw = $user->password;
        //对密码进行验证
        if(\Hash::check($password,$userpsw)){
            return ['status'=>'1','res'=>'旧密码验证一致'];
        }
        return ['status'=>'0','res'=>'与旧密码不一致'];
    }

    //修改密码
    public function changepsw(Request $request)
    {
        $userid = $request->input('userid');
        $password = $request->input('password');
        if($userid == null || $password == null){
            return ['status'=>'0','res'=>'参数错误'];
        }
        $user = User::find($userid);
        if($user == null){
            return ['status'=>'0','res'=>'无此用户,参数错误'];
        };
        $user->password = bcrypt($password);
        if($user->save()){
            return ['status'=>'1','res'=>'密码修改成功'];
        }else{
            return ['status'=>'0','res'=>'密码修改失败'];
        }
    }

    //修改个人信息
    public function changeinfo(Request $request)
    {
        $userid = $request->input('userid');
        $user = User::find($userid);
        $user->name = $request->input('name');
        $user->sex = $request->input('sex');
        $user->phoneNum = $request->input('phoneNum');
        $str = $request->input('birthday');
        if(substr($str,0,1) == '"'){
            $user->birthday = substr($str,1,10);
        }else{
            $user->birthday = $str;
        }

        if($user->save()){
            return ['status'=>1,'res'=>'修改个人信息成功'];
        }
        return ['status'=>0,'res'=>'修改个人信息失败'];
    }

    //生成挂号码
    public function makeregister(Request $request)
    {
        $userid = $request->input('userid');
        $user = User::find($userid);
        $user->money -= 5;
        $registe = new Registe();
        $res = $registe->add($request->all());
        if($res['status'] == 1){
            if($res['status'] == 1){
                if($user->save()){
                    if($registe->changeStatus($res['id'])){
                        return $res;
                    }
                }
            }
        }
        return ['status'=>0,'res'=>'挂号失败'];
    }

    //检查是否已经有可用的挂号id
    public function checkRegID(Request $request){
        $userid = $request->input('userid');
        $registe = new Registe();
        $res = $registe->checkRegID($userid);
        return $res;
    }
}
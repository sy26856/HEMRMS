<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HosInfoController extends Controller
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
    public function inhos()
    {
        // 住院手续办理
        return $this->showview();
    }

    public function outhos()
    {
        // 出院手续办理
        return $this->showview();
    }
}

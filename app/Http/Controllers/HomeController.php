<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function inforead()
    {
        return view('home');
    }
    public function infoedit()
    {
        return view('home');
    }

    public function changepsw()
    {
        return view('home');
    }

    public function registes()
    {
        return view('home');
    }

    public function guahaoinfo()
    {
        return view('home');
    }
}

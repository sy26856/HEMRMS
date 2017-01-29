<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //批量赋值
    protected $fillable = ['name','password','phoneNum','IDCard','sex','birthday','money'];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
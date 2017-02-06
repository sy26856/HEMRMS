@extends('layouts.app')

@section('rightNavbar')
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">用户登录</a></li>
            <li><a href="{{ url('/register') }}">用户注册</a></li>
            <li><a href="{{ url('/doclogin') }}">>>&nbsp;&nbsp;医生登录入口</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            退出登录
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="color: #777;">用户登录</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('phoneNum') ? ' has-error' : '' }}">
                                <label for="phoneNum" class="col-md-4 control-label">用户手机号码:</label>

                                <div class="col-md-6">
                                    <input id="phoneNum" type="phoneNum" class="form-control" name="phoneNum" value="{{ old('phoneNum') }}" placeholder="手机号码" required autofocus>

                                    @if ($errors->has('phoneNum'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phoneNum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">用户登录密码:</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="登录密码">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="captcha" class="col-md-4 control-label">验证码:</label>

                                <div class="col-md-6">
                                    <div class="col-md-8" style="margin-left: -15px;">
                                        <input id="captcha" type="text" class="form-control" name="captcha" required placeholder="验证码">
                                    </div>
                                    <div class="col-md-2" style="margin-left: -10px;">
                                        <img style="cursor: pointer;" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}' + Math.random()">
                                    </div>
                                    <br><br>
                                    @if ($errors->has('captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 记住密码
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        用户登录
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        忘记密码?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

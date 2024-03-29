@extends('layouts.app')

@section('rightNavbar')
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        <li><a href="#" style="color: #20A0FF;">医生登录</a></li>
        <li><a href="{{ url('/login') }}"><<&nbsp;返回用户登录</a></li>
    </ul>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="color: #777;">医生登录</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/doc/login') }}">
                            {{ csrf_field() }}

                            <div id="errshow" class="form-group{{ $errors->has('docID') ? ' has-error' : '' }}">
                                <label for="phoneNum" class="col-md-4 control-label">医生工号:</label>

                                <div class="col-md-6">
                                    <input id="docID" type="text" class="form-control" name="docID" value="{{ old('docID') }}" placeholder="医生工号" required autofocus>

                                    @if ($errors->has('docID'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('docID') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">登录密码:</label>

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
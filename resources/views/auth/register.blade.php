@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="color: #777;">用户注册</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户姓名:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="用户姓名">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block" style="display: none;color:red;font-size: 12px;font-weight: normal" id="nameMsg">
                                        <strong id="nameMsgContent"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phoneNum') ? ' has-error' : '' }}">
                            <label for="phoneNum" class="col-md-4 control-label">电话号码:</label>

                            <div class="col-md-6">
                                <input id="phoneNum" type="text" class="form-control" name="phoneNum" value="{{ old('phoneNum') }}" required placeholder="电话号码">

                                @if ($errors->has('phoneNum'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phoneNum') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block" style="display: none;color:red;font-size: 12px;font-weight: normal" id="phoneNumMsg">
                                        <strong id="phoneNumMsgContent"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('IDCard') ? ' has-error' : '' }}">
                            <label for="IDCard" class="col-md-4 control-label">身份证:</label>

                            <div class="col-md-6">
                                <input id="IDCard" type="text" class="form-control" name="IDCard" value="{{ old('IDCard') }}" required placeholder="身份证">

                                @if ($errors->has('IDCard'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('IDCard') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block" style="display: none;color:red;font-size: 12px;font-weight: normal" id="IDCardMsg">
                                        <strong id="IDCardMsgContent"></strong>
                                    </span>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">性别:</label>

                            <sex></sex>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">生日:</label>

                            <birth></birth>
                            <span class="help-block" style="display: none;color:red;font-size: 12px;margin-left:20px;font-weight: normal" id="birthMsg">
                                        <strong id="birthMsgContent"></strong>
                                    </span>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">登录密码:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="用户登录密码">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block" style="display: none;color:red;font-size: 12px;font-weight: normal" id="pswMsg">
                                        <strong id="pswMsgContent"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="确认密码">
                                <span class="help-block" style="display: block;color:red;font-size: 12px;font-weight: normal" id="pswConMsg">
                                        <strong id="pswConMsgContent"></strong>
                                    </span>
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
                                    <div class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="regbtn">
                                    用户注册
                                </button>

                                <button type="reset" class="btn btn-warning col-md-offset-1">
                                    重&nbsp;&nbsp;置
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="js/register.js"></script>
@endsection
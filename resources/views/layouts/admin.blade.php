<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="style/css/ch-ui.admin.css">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/rollbar.css">
    <style>

    </style>
    <link rel="stylesheet" href="style/font/css/font-awesome.min.css">
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <!--头部 开始-->
    <div class="top_box">
        <div class="top_left">
            <div class="logo">{{config('app.name')}}</div>
            <ul>
                <li><a href="{{url('/home')}}" class="active">首页</a></li>
            </ul>
        </div>
        <div class="top_right">
            <ul>
                <li>欢迎:&nbsp;{{ Auth::user()->name }}&nbsp;登录</li>
                <li><a href="pass.html" target="main">修改密码</a></li>
                <li>
                    <logout></logout>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!--头部 结束-->

    <!--左侧导航 开始-->
    <div class="menu_box" id="leftbar">
        <userleftbar></userleftbar>
    </div>
    <!--左侧导航 结束-->

    <!--主体部分 开始-->
    <div class="main_box">
        <router-view></router-view>
    </div>
    <!--主体部分 结束-->

    <!--底部 开始-->
    <div class="bottom_box" style="text-align: center">
        CopyRight © 2017. Powered By zmj.
    </div>
    <!--底部 结束-->
</div>
</body>
</html>
<!-- Scripts -->
<script src="/js/app.js"></script>
<script>
$(function(){
$("#leftbar").panel({iWheelStep:32});
});
</script>
<script src="/js/zUI.js"></script>
<script type="text/javascript" src="style/js/ch-ui.admin.js"></script>
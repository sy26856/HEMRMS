<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Laravel</title>

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div id="app">
                    <example></example>
                </div>
                <div id="jq">
                    hahahaha
                </div>
                <button type="button" class="btn btn-danger">按钮</button>
                <button type="button" class="btn btn-warning">按钮</button>
            </div>
        </div>
    </body>
</html>
<script src="{{asset('js/app.js')}}"></script>
<script>
    var content = $('#jq').text();
    console.log(content)
</script>

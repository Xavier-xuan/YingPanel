<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">

            <!-- 侧边栏 Start -->
            <div class="col-md-4" id="sidebar">
                <!-- 侧边栏选项 Start -->
                <div class="sidebar-item">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>总览</span>
                </div>

                <div class="sidebar-item">
                    <i class="glyphicon glyphicon-cloud"></i>
                    <span>服务器</span>
                </div>

                <div class="sidebar-item">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>个人设置</span>
                </div>


                @if(Auth::user()->hasRole('admin'))
                    <div class="sidebar-item">
                        <i class="glyphicon glyphicon-cog"></i>
                        <span>管理中心</span>
                    </div>
                @endif

                <div class="sidebar-item logout">
                    <i class="glyphicon glyphicon-log-out"></i>
                    <span>退出登录</span>
                </div>
                <!-- 侧边栏选项 End -->

            </div>
        </div>

        <!-- 侧边栏 End -->


        <!-- Content -->
        <div>
            <div class="col-md-8" id="content">
                @yield('content')
            </div>
        </div>


    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('common.head')

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <!-- 侧边栏 -->
            @include('common.sidebar')
        </div>
    </div>


    <div class="container-fluid" id="content">

        <div class="panel panel-default">
            <div class="panel-body">
                <!-- 导航栏 Start -->

                <ul class="nav nav-tabs">
                    @if(Auth::user()->can('view website overview'))
                        <li role="presentation" class="{{active_class(if_route('admin.overview'))}}">
                            <a href="{{route('admin.overview')}}">平台总览</a>
                        </li>
                    @endif

                    @if(Auth::user()->can('manage all hosts'))

                        <li role="presentation" class="{{active_class(if_route_pattern('admin.host.*'))}}">
                            <a href="{{route('admin.host.list')}}">主机管理</a>
                        </li>
                    @endif
                    @if(Auth::user()->can('manage website settings'))

                        <li role="presentation" class="{{active_class(if_route_pattern('admin.setting.*'))}}">
                            <a href="{{route('admin.setting.show')}}">网站设置</a>
                        </li>
                    @endif
                </ul>
                <!-- 导航栏 End -->

                <!-- 内容 Start -->
                <div style="padding-top: 1em;">
                    @include('common.alerts')
                    @yield('content')
                </div>

                <!-- 内容 End -->
            </div>
        </div>

    </div>


</div>

</body>
</html>

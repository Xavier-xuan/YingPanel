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

    <!-- Content -->
    <div class="container-fluid" id="content">
        @include('common.alerts')
        @yield('content')
    </div>


</div>


</body>
</html>

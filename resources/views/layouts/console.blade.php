<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('common.head')

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <!-- 侧边栏 -->
            @include('common.sidebar')
        </div>
    </div>

    <!-- Content -->
    <div class="container" id="content">
        @yield('content')
    </div>


</div>


</body>
</html>

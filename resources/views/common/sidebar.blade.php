<!-- 侧边栏 Start -->
<div class="col-md-4" id="sidebar">
    <!-- 侧边栏选项 Start -->
    <div class="sidebar-item {{active_class(if_route('home'),'active')}}" href="{{route('home')}}">
        <i class="glyphicon glyphicon-home"></i>
        <span>总览</span>
    </div>

    <div class="sidebar-item {{active_class(if_uri_pattern('server*'),'active')}}" href="{{route('server.list.my')}}">
        <i class="glyphicon glyphicon-cloud"></i>
        <span>服务器</span>
    </div>

    <div class="sidebar-item">
        <i class="glyphicon glyphicon-user"></i>
        <span>个人设置</span>
    </div>


    @if(Auth::user()->can('enter the backstage'))
        <div class="sidebar-item {{active_class(if_uri_pattern('admin*'),'active')}}" href="{{ route('admin.overview') }}">
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
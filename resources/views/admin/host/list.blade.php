@extends('layouts.admin')

@section('content')
    <div class="table-responsive">
        @include('common.alerts')
        <table class="table table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>标识</th>
                <th>IP</th>
                <th>端口</th>
                <th>服务器数量</th>
                <th>操作</th>
            </tr>
            </thead>

            @if(count($hosts) != 0)
                <tbody>
                @foreach($hosts as $host)
                    <tr>
                        <th>{{$host->id}}</th>
                        <th>{{$host->name}}</th>
                        <th>{{$host->ip}}</th>
                        <th>{{$host->port}}</th>
                        <th>{{count($host->servers())}}</th>
                        <th>
                            <button class="btn btn-warning btn-sm">管理</button>
                            <button class="btn btn-danger btn-sm">删除</button>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            @endif
        </table>
        @if(count($hosts) == 0)
            <div style="margin: 4em auto;text-align: center">
                这里毛都没有，赶快<a href="#" data-toggle="modal" data-target="#addHost">添加一台主机</a>吧！
            </div>
        @else
            <div style="text-align: right">
                <a href="#" data-toggle="modal" data-target="#addHost">添加一台主机 >>></a>
            </div>
        @endif

    <!-- 添加主机模态框 Start -->
        @if(count($errors) > 0)
            <script>
                $(function () {
                    $("#addHost").modal('show');
                })(jQuery);
            </script>
        @endif
        <div class="modal fade" id="addHost" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">添加主机</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form class="form-horizontal col-md-offset-1" action="{{route('admin.host.store')}}"
                                  method="post">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-3 control-label">标识</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('ip') ? ' has-error' : '' }}">
                                    <label for="ip" class="col-md-3 control-label">IP</label>

                                    <div class="col-md-6">
                                        <input id="ip" type="text" class="form-control" name="ip"
                                               value="{{ old('ip') }}" required>

                                        @if ($errors->has('ip'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('ip') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('port') ? ' has-error' : '' }}">
                                    <label for="port" class="col-md-3 control-label">端口</label>

                                    <div class="col-md-6">
                                        <input id="port" type="number" min="0" class="form-control" name="port"
                                               value="{{ old('port') }}" required>

                                        @if ($errors->has('port'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('port') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('verify_code') ? ' has-error' : '' }}">
                                    <label for="verify_code" class="col-md-3 control-label">安全校验码</label>

                                    <div class="col-md-6">
                                        <input id="verify_code" type="text" class="form-control" name="verify_code"
                                               value="{{ old('verify_code') }}" required>

                                        @if ($errors->has('verify_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('verify_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="$('form').submit();">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 添加主机模态框 End -->
    </div>
@endsection
